<?php
// Include the Africa's Talking SDK
require 'vendor/autoload.php';

use AfricasTalking\SDK\AfricasTalking;

// Initialize Africa's Talking
$username = "sandbox";
$apiKey = "b34aae06b75b96d102679bfecf11d9f9d4cb9f65f62f5a0ad8e3d27b7937b366";

$AT = new AfricasTalking($username, $apiKey);

// Set up your database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select expired books
$sql = "SELECT * FROM issueinfo WHERE returndate < NOW()";
$result = $conn->query($sql);

// If there are expired books, send SMS
if ($result->num_rows > 0) {
    // Initialize SMS service
    $sms = $AT->sms();

    // Set up message
    $message = "Some books have expired!";

    // Set up recipients
    $recipients = array(
        array("PhoneNumber" => "PHONE_NUMBER1"),
        array("PhoneNumber" => "PHONE_NUMBER2")
    );

    // Send SMS
    try {
        $response = $sms->send([
            'to' => $recipients,
            'message' => $message
        ]);

        print_r($response);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Close database connection
$conn->close();
?>
