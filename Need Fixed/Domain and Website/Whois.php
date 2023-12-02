<?php
header("Content-Type: application/json");

function whoisLookup($domain) {
    $whoisServer = "whois.iana.org";
    $port = 43;

    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if (!$socket) {
        http_response_code(500);
        echo json_encode(["error" => "Unable to create socket: " . socket_strerror(socket_last_error())]);
        exit;
    }

    $connection = socket_connect($socket, $whoisServer, $port);
    if (!$connection) {
        http_response_code(500);
        echo json_encode(["error" => "Unable to connect to $whoisServer: " . socket_strerror(socket_last_error($socket))]);
        exit;
    }

    socket_write($socket, $domain . "\r\n");
    $response = '';
    while (($buffer = socket_read($socket, 1024)) !== false) {
        $response .= $buffer;
    }

    socket_close($socket);

    return $response;
}

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match('/^\/whois\/(.+)$/', $uri, $matches)) {
    $domain = $matches[1];
    $response = whoisLookup($domain);
    echo json_encode(["domain" => $domain, "whois" => $response]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
}
