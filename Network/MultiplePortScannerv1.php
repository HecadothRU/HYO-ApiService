<?php

header('Content-Type: application/json');

function scanPorts($host, $timeout = 1) {
  $openPorts = [];

  for ($port = 1; $port <= 65535; $port++) {
      $socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

      if ($socket) {
          socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, ['sec' => $timeout, 'usec' => 0]);
          $connection = @socket_connect($socket, $host, $port);

          if ($connection) {
              $openPorts[] = $port;
          }

          socket_close($socket);
      }
}

$host = $_GET['host'] ?? '';

if (empty($host)) {
    http_response_code(400);
    echo json_encode(['error' => 'Host parameter is required.']);
    exit;
}

$response = [
    'host' => $host,
    'open_ports' => scanPorts($host)
];

echo json_encode($response);

?>
