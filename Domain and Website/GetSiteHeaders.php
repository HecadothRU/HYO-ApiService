<?php
// Enable CORS for all domains
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Function to get headers of a website
function get_website_headers($url) {
    $headers = get_headers($url);
    $headers_assoc = [];

    if ($headers !== false) {
        foreach ($headers as $header) {
            $header_parts = explode(":", $header, 2);
            if (count($header_parts) === 2) {
                $headers_assoc[trim($header_parts[0])] = trim($header_parts[1]);
            }
        }
    }

    return $headers_assoc;
}

// Check for the URL parameter
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $headers = get_website_headers($url);

    if (!empty($headers)) {
        http_response_code(200);
        echo json_encode($headers);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Failed to get headers for $url"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing 'url' parameter"]);
}
?>
