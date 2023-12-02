<?php
// ISSUE: DOES NOT GRAB IP HISTORY
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $domain = $_GET["domain"] ?? "";

    if (empty($domain)) {
        http_response_code(400);
        echo json_encode(["error" => "Domain parameter is required."]);
        exit;
    }

    // Set your SecurityTrails API key here
    $securityTrailsApiKey = "YOUR_SECURITYTRAILS_API_KEY";

    $ipHistory = getDomainIpHistory($domain, $securityTrailsApiKey);
    echo json_encode(["domain" => $domain, "ip_history" => $ipHistory]);
}

function getDomainIpHistory($domain, $apiKey) {
    $url = "https://api.securitytrails.com/v1/domain/{$domain}/history/a";
    $options = [
        'http' => [
            'header'  => "Content-Type: application/json\r\n" .
                         "APIKEY: {$apiKey}\r\n",
            'method'  => 'GET'
        ]
    ];
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $data = json_decode($response, true);

    $ipHistory = [];
    if (isset($data['data']['items'])) {
        foreach ($data['data']['items'] as $item) {
            $ipHistory[] = [
                'ip' => $item['ip'],
                'first_seen' => $item['first_seen'],
                'last_seen' => $item['last_seen']
            ];
        }
    }

    return $ipHistory;
}
?>
