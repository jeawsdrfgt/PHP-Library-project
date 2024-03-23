<?php
require 'vendor/autoload.php';
use AfricasTalking\SDK\AfricasTalking;
include "connection.php";

// Set your app credentials
$username   = "sandbox";
$apiKey     = "21174c823fbc830504f6050fc0e99fed04342d3e6a5579f6375fb6cb84c52bdc";

// Initialize the SDK
$AT         = new AfricasTalking($username, $apiKey);

// Get the SMS service
$sms        = $AT->sms();

// Set the numbers you want to send to in international format
$recipients = '[PhoneNumber]';

// Set your message
$message    = "Dear Student, your book return period has expired. Please return the book issued and contact your system Admin";

// Set your shortCode or senderId
$from       = "Sandbox";


try {
    // Thats it, hit send and we'll take care of the rest
    $result = $sms->send([
        'to'      => $recipients,
        'message' => $message,
        'from'    => $from
    ]);

    print_r($result);
} catch (Exception $e) {
    echo "Error: ".$e->getMessage();
}