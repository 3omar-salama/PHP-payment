<?php
// execute-payment.php
require 'vendor/autoload.php';

$config = require('config.php');

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $config['client_id'],
        $config['client_secret']
    )
);

$apiContext->setConfig($config['settings']);

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $paymentId = $_GET['paymentId'];
    $payment = Payment::get($paymentId, $apiContext);

    $execution = new PaymentExecution();
    $execution->setPayerId($_GET['PayerID']);

    try {
        $result = $payment->execute($execution, $apiContext);
        echo "Payment successful!";
    } catch (Exception $ex) {
        echo "Exception: " . $ex->getMessage();
        exit;
    }
} else {
    echo "User canceled the payment.";
}