<?php
header('Content-Type: application/json');

$response = '';

if (isset($_GET['url'])) {
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $fileContent = file_get_contents($url);

        if ($fileContent !== false) {
            $jsonData = json_decode($fileContent);

            if (json_last_error() === JSON_ERROR_NONE) {
                $response = json_encode($jsonData, JSON_PRETTY_PRINT);
            } else {
                http_response_code(400);
                $response = json_encode([
                    'error' => 'The provided content is not valid JSON.',
                ], JSON_PRETTY_PRINT);
            }
        } else {
            http_response_code(400);
            $response = json_encode([
                'error' => 'Unable to fetch the file content.',
            ], JSON_PRETTY_PRINT);
        }
    } else {
        http_response_code(400);
        $response = json_encode([
            'error' => 'Invalid URL provided.',
        ], JSON_PRETTY_PRINT);
    }
} else {
    http_response_code(400);
    $response = json_encode([
        'error' => 'No URL provided.',
    ], JSON_PRETTY_PRINT);
}

echo $response;
