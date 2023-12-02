<?php
header('Content-Type: application/json');

if (isset($_GET['url'])) {
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $fileContent = file_get_contents($url);

        if ($fileContent !== false) {
            $strippedContent = strip_tags($fileContent);
            $response = [
                'status' => 'success',
                'content' => $strippedContent,
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Unable to fetch the file content.',
            ];
        }
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Invalid URL provided.',
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'No URL provided.',
    ];
}

echo json_encode($response);
