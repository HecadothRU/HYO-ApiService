<?php
header("Content-Type: application/json");

function checkHostStatus($host, $port = 80, $timeout = 5) {
    $isUp = false;

    $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
    if ($fp) {
        $isUp = true;
        fclose($fp);
    }

    return $isUp;
}

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match('/^\/status\/([^\/]+)(?:\/(\d+))?$/', $uri, $matches)) {
    $host = $matches[1];
    $port = isset($matches[2]) ? (int)$matches[2] : 80;
    $isUp = checkHostStatus($host, $port);
    echo json_encode(["host" => $host, "port" => $port, "status" => $isUp ? "up" : "down"]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
}
