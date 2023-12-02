<?php

header('Content-Type: application/json');

function getGifs($keyword, $apiKey) {
    $apiUrl = "https://pixabay.com/api/?key={$apiKey}&q=" . urlencode($keyword) . "&image_type=animated";

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

    $responseData = json_decode($response, true);

    $gifUrls = [];
    foreach ($responseData['hits'] as $gifData) {
        $gifUrls[] = $gifData['webformatURL'];
    }

    return $gifUrls;
}

$apiKey = 'your_api_key_here'; // Replace this with your Pixabay API key
$keyword = $_GET['keyword'] ?? '';

if (empty($keyword)) {
    http_response_code(400);
    echo json_encode(['error' => 'Keyword parameter is required.']);
    exit;
}

$response = [
    'keyword' => $keyword,
    'gifUrls' => getGifs($keyword, $apiKey)
];

echo json_encode($response);

?>
