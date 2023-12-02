<?php
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

    $isAvailable = isDomainAvailable($domain);
    echo json_encode(["domain" => $domain, "isAvailable" => $isAvailable]);
}

function isDomainAvailable($domain) {
    $domainParts = explode('.', $domain);
    $extension = end($domainParts);

    if (checkdnsrr($domain, 'ANY')) {
        return false;
    }

    return true;
}
?>
