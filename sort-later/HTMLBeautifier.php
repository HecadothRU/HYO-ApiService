<?php
header('Content-Type: text/html; charset=utf-8');

$response = '';

if (isset($_GET['url'])) {
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $fileContent = file_get_contents($url);

        if ($fileContent !== false) {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $doc->preserveWhiteSpace = false;
            $doc->formatOutput = true;

            if (@$doc->loadHTML($fileContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD)) {
                $response = $doc->saveHTML();
            } else {
                http_response_code(400);
                $response = 'Error: The provided content is not valid HTML.';
            }
            libxml_clear_errors();
        } else {
            http_response_code(400);
            $response = 'Error: Unable to fetch the file content.';
        }
    } else {
        http_response_code(400);
        $response = 'Error: Invalid URL provided.';
    }
} else {
    http_response_code(400);
    $response = 'Error: No URL provided.';
}

echo $response;
