<?php
header('Content-Type: text/css; charset=utf-8');

function format_css($css) {
    $formatted_css = '';
    $indent = 0;
    $in_rule = false;

    $lines = explode("\n", $css);

    foreach ($lines as $line) {
        $line = trim($line);

        if (empty($line)) {
            continue;
        }

        if (preg_match('/[{}]/', $line)) {
            if (strpos($line, '}') !== false) {
                $indent--;
            }

            $formatted_css .= str_repeat('    ', $indent) . $line . PHP_EOL;

            if (strpos($line, '{') !== false) {
                $indent++;
            }
        } else {
            if ($in_rule) {
                $formatted_css .= str_repeat('    ', $indent);
            }

            $formatted_css .= $line . PHP_EOL;
            $in_rule = true;
        }
    }

    return $formatted_css;
}

$response = '';

if (isset($_GET['url'])) {
    $url = filter_var($_GET['url'], FILTER_SANITIZE_URL);

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $fileContent = file_get_contents($url);

        if ($fileContent !== false) {
            $response = format_css($fileContent);
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
