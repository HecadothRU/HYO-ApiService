<?php

// Enable CORS for all domains
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

// Function to get location data for a given host or IP address
function get_location_data($host) {
    $ip = gethostbyname($host);

    if (filter_var($ip, FILTER_VALIDATE_IP)) {
        $ipApiUrl = "http://ip-api.com/json/{$ip}";
        $locationData = json_decode(file_get_contents($ipApiUrl), true);

        if ($locationData['status'] === 'success') {
            return [
                'host' => $host,
                'ip' => $ip,
                'country' => $locationData['country'],
                'region' => $locationData['regionName'],
                'city' => $locationData['city'],
                'latitude' => $locationData['lat'],
                'longitude' => $locationData['lon']
            ];
        }
    }

    return null;
}

// Check for the 'host' parameter
if (isset($_GET['host'])) {
    $host = $_GET['host'];
    $locationData = get_location_data($host);

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
