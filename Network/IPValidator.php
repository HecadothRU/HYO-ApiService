<?php

header('Content-Type: application/json');

function isValidIpAddress($ip) {
    return filter_var($ip, FILTER_VALIDATE_IP);
}

$ipAddress = $_GET['ip'] ?? '';

if (empty($ipAddress)) {
    http_response_code(400);
    echo json_encode(['error' => 'IP parameter is required.']);
    exit;
}

$response = [
    'ip' => $ipAddress,
    'isValid' => isValidIpAddress($ipAddress)
];

echo json_encode($response);

?>
