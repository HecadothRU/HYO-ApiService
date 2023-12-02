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

    $alexaData = getAlexaRankData($domain);

    if ($alexaData) {
        echo json_encode([
            "domain" => $domain,
            "global_rank" => $alexaData["global_rank"],
            "top_country" => $alexaData["top_country"],
            "top_country_rank" => $alexaData["top_country_rank"],
            "backlinks" => $alexaData["backlinks"]
        ]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Failed to fetch Alexa data for {$domain}."]);
    }
}

function getAlexaRankData($domain) {
    $url = "https://www.alexa.com/siteinfo/{$domain}";
    $html = file_get_contents($url);

    // Scrape global rank
    preg_match('/<strong class="metrics-data align-vmiddle">(.*)<\/strong>/', $html, $globalRankMatch);

    // Scrape top country and its rank
    preg_match('/<div class="CountryRank">(.*)<\/div>/', $html, $topCountryRankMatch);
    preg_match('/<span class="country-name">(.*)<\/span>/', $html, $topCountryMatch);

    // Scrape backlinks
    preg_match('/<span class="font-4 box1-alexa">(.*)<\/span>/', $html, $backlinksMatch);

    if ($globalRankMatch && $topCountryRankMatch && $topCountryMatch && $backlinksMatch) {
        $alexaData = [
            'global_rank' => trim(strip_tags($globalRankMatch[1])),
            'top_country' => trim(strip_tags($topCountryMatch[1])),
            'top_country_rank' => trim(strip_tags($topCountryRankMatch[1])),
            'backlinks' => trim(strip_tags($backlinksMatch[1]))
        ];

        return $alexaData;
    }

    return false;
}
?>
