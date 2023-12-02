<?php

header('Content-Type: application/json');

function getBitcoinBalance($address) {
    $apiUrl = "https://blockchain.info/q/addressbalance/{$address}";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
    ]);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
        exit;
    }

    curl_close($curl);

    $balanceSatoshis = intval($response);
    $balanceBitcoins = $balanceSatoshis / 1e8;

    return $balanceBitcoins;
}

$bitcoinAddress = $_GET['address'] ?? '';

if (empty($bitcoinAddress)) {
    http_response_code(400);
    echo json_encode(['error' => 'Address parameter is required.']);
    exit;
}

$response = [
    'address' => $bitcoinAddress,
    'balance' => getBitcoinBalance($bitcoinAddress)
];

echo json_encode($response);

?>
