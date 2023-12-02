<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sourceCurrency = $_GET["source"] ?? "USD";

    // Set your Open Exchange Rates API key here
    $openExchangeRatesApiKey = "YOUR_OPENEXCHANGERATES_API_KEY";

    $exchangeRates = getExchangeRates($sourceCurrency, $openExchangeRatesApiKey);
    echo json_encode(["source" => $sourceCurrency, "exchange_rates" => $exchangeRates]);
}

function getExchangeRates($sourceCurrency, $apiKey) {
    $url = "https://openexchangerates.org/api/latest.json?base={$sourceCurrency}&app_id={$apiKey}";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data['rates'];
}
?>
