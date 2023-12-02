<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Access-Control-Allow-Methods, Authorization, X-Requested-With");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $baseCurrency = $_GET["base"] ?? "USD";
    $targetCurrency = $_GET["target"] ?? "EUR";
    $amount = $_GET["amount"] ?? 100;

    // Set your API keys here
    $currencyStackApiKey = "YOUR_CURRENCYSTACK_API_KEY";
    $coinGeckoApiKey = "YOUR_COINGECKO_API_KEY";

    $result = convertCurrency($baseCurrency, $targetCurrency, $amount, $currencyStackApiKey, $coinGeckoApiKey);
    echo json_encode(["amount" => $amount, "base" => $baseCurrency, "target" => $targetCurrency, "result" => $result]);
}

function convertCurrency($baseCurrency, $targetCurrency, $amount, $currencyStackApiKey, $coinGeckoApiKey) {
    $currencyStackUrl = "https://api.currencystack.io/currency?base={$baseCurrency}&target={$targetCurrency}&apikey={$currencyStackApiKey}";
    $coinGeckoUrl = "https://api.coingecko.com/api/v3/simple/price?ids={$baseCurrency}&vs_currencies={$targetCurrency}";

    $isFiat = isFiatCurrency($baseCurrency);

    if ($isFiat) {
        $conversionRate = getConversionRateFromCurrencyStack($currencyStackUrl);
    } else {
        $conversionRate = getConversionRateFromCoinGecko($coinGeckoUrl, $baseCurrency, $targetCurrency);
    }

    return $amount * $conversionRate;
}

function isFiatCurrency($currencyCode) {
    $cryptoCurrencies = ['BTC', 'ETH', 'XRP', 'LTC', 'BCH', 'BNB', 'USDT', 'EOS', 'BSV', 'XLM'];
    return !in_array(strtoupper($currencyCode), $cryptoCurrencies);
}

function getConversionRateFromCurrencyStack($url) {
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data['exchange_rate'];
}

function getConversionRateFromCoinGecko($url, $baseCurrency, $targetCurrency) {
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    return $data[strtolower($baseCurrency)][strtolower($targetCurrency)];
}
/*
base (optional): The base currency (default: "USD")
target (optional): The target currency (default: "EUR")
amount (optional): The amount to be converted (default: 100)
https://yourserver.com/converter.php?base=USD&target=EUR&amount=100
*/
?>
