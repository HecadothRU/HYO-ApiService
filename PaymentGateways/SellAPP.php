<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'require.php';
require_once 'controllers/Sales.php';

$sales = new SalesController;

$secret = " "; // the webhook secret you generated on SellApp
$signature = $_SERVER['HTTP_SIGNATURE']; // Retrieving the HMAC signature sent by our servers
$computedSignature = hash_hmac('sha256', file_get_contents('php://input'), $secret); // Validating the HMAC signature sent by our servers

function readOrderInfo($response) {

    if (!isset($response->event)) {
        return null;
    }
    $event = $response->event;
    if ($event != 'order.completed') {
        return null;
    }
    $data = $response->data;

    $eventid = $data->id;
    $storeid = $data->store_id;

    $payment = $data->payment;
    $gateway = $payment->gateway;
    $gatewaydata = $gateway->data;
    $datatotal = $gatewaydata->total;
    $currency = $datatotal->currency;
    $amountTotal = $datatotal->total;
    $amountInclusive = $amountTotal->inclusive;
    $amountExclusive = $amountTotal->exclusive;

    $units = $datatotal->units;

    $customer_info = $data->customer_information;
    $ip = $customer_info->ip;
    $email = $customer_info->email;
    $customerid = $customer_info->id;

    $product_variants = $data->product_variants;
    $variant = $product_variants[0];
    $additional_info = $variant->additional_information;
    $username = null;
    $product = null;
    $serial = null;
    foreach ($additional_info as $info) {
        if ($info->label == 'Site Username') {
            $username = $info->value;
        }
        if ($info->label == 'Product Name') {
            $product = $info->value;
        }
    }
    $deliverable = $variant->deliverable;
    $deliverableData = $deliverable->data;
    $serials = $deliverableData->serials;
    if (count($serials) > 0) {
        $serials = $serials[0];
    }

    return array(
        'eventid' => $eventid,
        'storeid' => $storeid,
        'customerid' => $customerid,
        'currency' => $currency,
        'units' => $units,
        'ip' => $ip,
        'email' => $email,
        'username' => $username,
        'serials' => $serials,
        'product' => $product,
        'amountInclusive' => $amountInclusive,
        'amountExclusive' => $amountExclusive,
    );
}

// Testing Sift
//if (1) {
//    $response = json_decode(file_get_contents('LOCALSTRING2.TXT', JSON_THROW_ON_ERROR));
//    var_dump($response);
//    $order_info = readOrderInfo($response);
//    if ($order_info != null) {
//
//      //INV-699295-SID18022 41921:699295
//      print_r("INV#". $order_info['eventid'] ."-SID". $order_info['storeid'] ."". $order_info['customerid'] ."");
//    }
//} else {
//  print_r("Invalid Request, Strint Mismatch or Falsified Request, try again.");
//}


if (hash_equals($computedSignature, $signature)) {
    $response = json_decode(file_get_contents('php://input', JSON_THROW_ON_ERROR));
    $order_info = readOrderInfo($response);
    if ($order_info != null) {
      //$invString = "INV#". $order_info['eventid'] ."-SID". $order_info['storeid'] ."". $order_info['customerid'] .""
    $sales->uploadCompletedOrder("INV#". $order_info['eventid'] ."-SID". $order_info['storeid'] ."". $order_info['customerid'] ."", "Completed", $order_info['product'], $order_info['units'], $order_info['currency'], $order_info['amountInclusive'], $order_info['amountExclusive'], $order_info['username'], $order_info['email'], $order_info['ip'], $order_info['serials']);
    }
} else {
}
