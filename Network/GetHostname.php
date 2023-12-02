<?php

header('Content-Type: application/json');

function getServerIP($host) {
  $ip = gethostbyname($host);
  return $ip === $host ? false : $ip;
}

$host = $_GET['host'] ?? '';

if (empty($host)) {
    http_response_code(400);
    echo json_encode(['error' => 'Host parameter is required.']);
    exit;
}

$response = [
    'host' => $host,
    'ip' => getServerIP($host)
];

echo json_encode($response);

?>
