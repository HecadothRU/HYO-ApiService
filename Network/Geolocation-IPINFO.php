<?php

// Replace this with your IPinfo.io API access token
$ipinfoAccessToken = 'YOUR_IPINFO_API_ACCESS_TOKEN';

// Enable CORS for all domains
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Function to get location data for a given host or IP address
function get_location_data($host, $ipinfoAccessToken) {
    $ip = gethostbyname($host);

    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $ipinfoApiUrl = "https://ipinfo.io/{$ip}/json?token={$ipinfoAccessToken}";
        $locationData = json_decode(file_get_contents($ipinfoApiUrl), true);

        if (!empty($locationData)) {
            return [
                'host' => $host,
                'ip' => $ip,
                'country' => $locationData['country'],
                'region' => $locationData['region'],
                'city' => $locationData['city'],
                'loc' => $locationData['loc']
            ];
        }
    }

    return null;
}

// Check for the 'host' parameter
if (isset($_GET['host'])) {
    $host = $_GET['host'];
    $locationData = get_location_data($host, $ipinfoAccessToken);

    if ($locationData !== null) {
        http_response_code(200);
        echo json_encode($locationData);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Failed to get location data for host: $host"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing 'host' parameter"]);
}

?>
