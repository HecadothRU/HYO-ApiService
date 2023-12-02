<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ipAddress = $_GET["ip"] ?? "";

    if (empty($ipAddress)) {
        http_response_code(400);
        echo json_encode(["error" => "IP parameter is required."]);
        exit;
    }

    $commonSubdomains = [
        'www',
        'mail',
        'ftp',
        'blog',
        'dev',
        'test',
        'admin',
        'webmail',
        'support',
        'shop',
        // Add more subdomains if necessary
    ];

    $websites = findWebsitesOnIpAddress($ipAddress, $commonSubdomains);
    echo json_encode(["ip" => $ipAddress, "websites" => $websites]);
}

function findWebsitesOnIpAddress($ipAddress, $subdomains) {
    $websites = [];

    foreach ($subdomains as $subdomain) {
        $domain = "{$subdomain}.{$ipAddress}";

        if (checkdnsrr($domain, 'ANY')) {
            $websiteIp = gethostbyname($domain);

            if ($websiteIp === $ipAddress) {
                $websites[] = $domain;
            }
        }
    }

    return $websites;
}
?>
