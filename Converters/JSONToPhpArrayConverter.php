<?php
// https://yourserver.com/api.php?json={"key":"value"}
// Set the content type to JSON
header('Content-Type: application/json');

// Check if the 'json' parameter is set in the GET request
if (isset($_GET['json'])) {
    // Get the JSON data from the 'json' GET parameter
    $json_data = $_GET['json'];

    // Convert the JSON data to a PHP array
    $php_array = json_decode($json_data, true);

    // Check if the JSON was successfully converted to a PHP array
    if (json_last_error() === JSON_ERROR_NONE) {
        // Return the PHP array as JSON
        echo json_encode(['success' => true, 'data' => $php_array]);
    } else {
        // Return an error message if the JSON conversion failed
        echo json_encode(['success' => false, 'message' => 'Invalid JSON input.']);
    }
} else {
    // Return an error message if the 'json' parameter is missing
    echo json_encode(['success' => false, 'message' => 'Missing "json" parameter.']);
}
