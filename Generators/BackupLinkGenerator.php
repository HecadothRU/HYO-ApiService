<?php

function backupLink($url, $backupDirectory = './backups/') {
    $content = file_get_contents($url);

    if ($content === false) {
        throw new Exception("Could not fetch content from the URL.");
    }

    if (!file_exists($backupDirectory)) {
        mkdir($backupDirectory, 0777, true);
    }

    $filename = $backupDirectory . date('Ymd-His') . '_' . preg_replace('/[^a-zA-Z0-9\-\.]/', '_', parse_url($url, PHP_URL_HOST)) . '.html';

    if (file_put_contents($filename, $content) === false) {
        throw new Exception("Could not save the backup file.");
    }

    return $filename;
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['url'])) {
        try {
            $backupFilename = backupLink($data['url']);
            http_response_code(200);
            echo json_encode(['message' => 'Backup created successfully.', 'filename' => $backupFilename]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Missing "url" parameter in the request.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed. Use POST method.']);
}

?>
