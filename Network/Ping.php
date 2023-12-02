<?php
// ping_api.php
header('Content-Type: application/json');

function pingDomain($domain, $count = 4) {
    $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    $pingCommand = $isWindows ? "ping -n {$count} {$domain}" : "ping -c {$count} {$domain}";

    exec($pingCommand, $output, $status);

    if ($status !== 0) {
        return ['error' => "An error occurred while trying to ping {$domain}."];
    }

    return ['domain' => $domain, 'result' => $output];
}

$domain = $_GET['domain'] ?? '';

if (empty($domain)) {
    http_response_code(400);
    echo json_encode(['error' => 'A domain name is required.']);
    exit;
}

$response = pingDomain($domain);
echo json_encode($response);
