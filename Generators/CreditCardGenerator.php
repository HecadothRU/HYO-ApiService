<?php
header("Content-Type: application/json");

function generateCreditCardNumber($prefix, $length) {
    $number = $prefix;
    for ($i = 0; $i < $length - strlen($prefix); $i++) {
        $number .= mt_rand(0, 9);
    }
    return $number;
}

function generateExpirationDate() {
    $minYear = date('Y') + 3;
    $maxYear = date('Y') + 8;
    $year = mt_rand($minYear, $maxYear);
    $month = mt_rand(1, 12);
    return sprintf("%02d/%d", $month, $year);
}

function generateCVV() {
    return mt_rand(100, 999);
}

function generateName() {
    $firstNames = ["John", "Jane", "Michael", "Mary", "James", "Sarah", "David", "Emily"];
    $lastNames = ["Smith", "Johnson", "Brown", "Davis", "Miller", "Taylor", "Wilson", "Clark"];

    $firstName = $firstNames[array_rand($firstNames)];
    $lastName = $lastNames[array_rand($lastNames)];

    return "$firstName $lastName";
}
function generateDateOfBirth() {
    $minYear = date('Y') - 80;
    $maxYear = date('Y') - 18;
    $year = mt_rand($minYear, $maxYear);
    $month = mt_rand(1, 12);
    $day = mt_rand(1, 28); // To avoid issues with February
    return sprintf("%04d-%02d-%02d", $year, $month, $day);
}

function generateAddress() {
    $streetNames = ["Main St", "Elm St", "Washington Ave", "Oak St", "Maple St", "Pine St", "Cedar St", "Birch St"];
    $cities = ["New York", "Los Angeles", "Chicago", "Houston", "Philadelphia", "Phoenix", "San Antonio", "San Diego"];
    $states = ["NY", "CA", "IL", "TX", "PA", "AZ", "TX", "CA"];
    $zipCodes = ["10001", "90001", "60601", "77001", "19101", "85001", "78201", "92101"];

    $streetNumber = mt_rand(100, 999);
    $streetName = $streetNames[array_rand($streetNames)];
    $city = $cities[array_rand($cities)];
    $state = $states[array_rand($states)];
    $zipCode = $zipCodes[array_rand($zipCodes)];

    return "$streetNumber $streetName, $city, $state $zipCode";
}
$cardPrefixes = [
    'visa' => ['4'],
    'mastercard' => ['51', '52', '53', '54', '55'],
    'discover' => ['6011'],
    'amex' => ['34', '37'],
    'diners' => ['300', '301', '302', '303', '304', '305', '36', '38'],
    'bankcard' => ['5610'],
    'jcb' => ['35'],
    'enroute' => ['2014', '2149'],
    'switch' => ['4903', '4911', '4936', '5641', '6333', '6759', '6334', '6767']
];

$cardType = isset($_GET['card_type']) ? $_GET['card_type'] : 'visa';
$prefix = $cardPrefixes[$cardType][array_rand($cardPrefixes[$cardType])];

$lengths = [
    'visa' => 16,
    'mastercard' => 16,
    'discover' => 16,
    'amex' => 15,
    'diners' => 14,
    'bankcard' => 16,
    'jcb' => 16,
    'enroute' => 15,
    'switch' => 16
];

$cardNumber = generateCreditCardNumber($prefix, $lengths[$cardType]);
$cvv = generateCVV();
$expirationDate = generateExpirationDate();
$name = generateName();
$addy = generateAddress();
$dob = generateDateOfBirth();

$response = [
    'name' => $name,
    'dob' => $dob,
    'address' => $addy,
    'card_type' => $cardType,
    'card_number' => $cardNumber,
    'cvv' => $cvv,
    'expiration_date' => $expirationDate
];

echo json_encode($response, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
?>
