<?php
header("Content-Type: application/json");

function isValidCreditCard($number, $cardTypes) {
    foreach ($cardTypes as $type => $pattern) {
        if (preg_match($pattern, $number)) {
            return $type;
        }
    }
    return false;
}

$creditCardTypes = array(
    'visa'          =>  "/^4\d{3}-?\d{4}-?\d{4}-?\d{4}$/",
    'mastercard'    =>  "/^5[1-5]\d{2}-?\d{4}-?\d{4}-?\d{4}$/",
    'discover'      =>  "/^6011-?\d{4}-?\d{4}-?\d{4}$/",
    'amex'          =>  "/^3[4,7]\d{13}$/",
    'diners'        =>  "/^3[0,6,8]\d{12}$/",
    'bankcard'      =>  "/^5610-?\d{4}-?\d{4}-?\d{4}$/",
    'jcb'           =>  "/^35\d{14}$/",
    'enroute'       =>  "/^(2014|2149)\d{11}$/",
    'switch'        =>  "/^(4903|4911|4936|5641|6333|6759|6334|6767)\d{12}$/"
);

$cardNumber = isset($_GET['card_number']) ? $_GET['card_number'] : '';
$response = array('valid' => false, 'card_type' => null);

if (!empty($cardNumber)) {
    $cardType = isValidCreditCard($cardNumber, $creditCardTypes);
    if ($cardType) {
        $response['valid'] = true;
        $response['card_type'] = $cardType;
    }
}

echo json_encode($response);
?>
