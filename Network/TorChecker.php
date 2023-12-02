<?php

header('Content-Type: application/json');

function isTorExitNode($ip) {
    $torExitListUrl = 'https://check.torproject.org/torbulkexitlist';

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $torExitListUrl,
        CURLOPT_RETURNTRANSFER => true,
    ]);

    $torExitList = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
        exit;
    }

    curl_close($curl);

    $torExitNodes = array_filter(explode("\n", $torExitList));

    return in_array($ip, $torExitNodes);
}

$ipAddress = $_GET['ip'] ?? '';

if (empty($ipAddress)) {
    http_response_code(400);
    echo json_encode(['error' => 'IP parameter is required.']);
    exit;
}

$response = [
    'ip' => $ipAddress,
    'isTorExitNode' => isTorExitNode($ipAddress)
];

echo json_encode($response);

?>
