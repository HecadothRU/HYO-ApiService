<?php
// Get the domain input from the query string
$domain = isset($_GET['domain']) ? $_GET['domain'] : '';

if (!empty($domain)) {
    // URL encode the domain input
    $encodedDomain = urlencode($domain);

    // Set the QR code image size
    $size = 200;

    // Generate the QR code image URL using the Google Charts API
    $qrCodeImageUrl = "https://chart.googleapis.com/chart?cht=qr&chs={$size}x{$size}&chl={$encodedDomain}";

    // Return the QR code image URL as JSON
    header('Content-Type: application/json');
    echo json_encode(['qr_code_image_url' => $qrCodeImageUrl]);
} else {
    // Return an error message if the domain is not provided
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(['error' => 'Missing domain']);
}
