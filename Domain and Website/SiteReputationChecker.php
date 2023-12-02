<?php

header("Content-Type: application/json");

$apiKey = 'YOUR_API_KEY'; // Replace with your Google Safe Browsing API key

function checkUrlSafety($apiKey, $urlToCheck)
{
    $apiUrl = 'https://safebrowsing.googleapis.com/v4/threatMatches:find?key=' . $apiKey;

    $requestData = [
        'client' => [
            'clientId' => 'your_client_name',
            'clientVersion' => '1.0',
        ],
        'threatInfo' => [
            'threatTypes' => [
                'THREAT_TYPE_UNSPECIFIED',
                'MALWARE',
                'SOCIAL_ENGINEERING',
                'UNWANTED_SOFTWARE',
                'POTENTIALLY_HARMFUL_APPLICATION',
            ],
            'platformTypes' => ['ANY_PLATFORM'],
            'threatEntryTypes' => ['URL'],
            'threatEntries' => [['url' => $urlToCheck]],
        ],
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($requestData),
        ],
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($apiUrl, false, $context);
    $responseJson = json_decode($response, true);

    return $responseJson;
}

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && preg_match('/^\/check\/([^\/]+)$/', $uri, $matches)) {
    $urlToCheck = $matches[1];
    $response = checkUrlSafety($apiKey, $urlToCheck);
    $isSafe = empty($response);

    echo json_encode([
        "url" => $urlToCheck,
        "isSafe" => $isSafe,
        "threats" => $isSafe ? [] : array_map(function ($match) {
            return $match['threatType'];
        }, $response['matches']),
    ]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "Not found"]);
}
