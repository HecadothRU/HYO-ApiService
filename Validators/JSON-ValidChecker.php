<?php
header("Content-Type: application/json");

// Check if the 'json' parameter is provided in the URL
if (isset($_GET['json'])) {
    $json = $_GET['json'];

    // Check if the provided JSON code is valid
    if (isValidJson($json)) {
        $response = [
            'status' => 'success',
            'message' => 'The provided JSON code is valid.',
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'The provided JSON code is not valid.',
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'No JSON code provided. Please provide a JSON code using the "json" parameter in the URL.',
    ];
}

echo json_encode($response);

// Function to check if the provided JSON code is valid
function isValidJson($json) {
    json_decode($json);
    return json_last_error() === JSON_ERROR_NONE;
}
