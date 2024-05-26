<?php
// payment.php
require 'vendor/autoload.php';

$config = require('config.php');

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $config['client_id'],
        $config['client_secret']
    )
);

$apiContext->setConfig($config['settings']);

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$amount = new Amount();
$amount->setTotal('100.00'); // Set the amount
$amount->setCurrency('USD');

$transaction = new Transaction();
$transaction->setAmount($amount);
$transaction->setDescription('Payment description');

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('https://8c23-197-62-237-1.ngrok-free.app/payment/execute-payment.php?success=true')
             ->setCancelUrl('https://8c23-197-62-237-1.ngrok-free.app/payment/execute-payment.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
        ->setPayer($payer)
        ->setTransactions([$transaction])
        ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    header("Location: " . $payment->getApprovalLink());
    exit;
} catch (Exception $ex) {
    echo "Exception: " . $ex->getMessage();
    exit;
}