<?php
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

//get the phone number from map
print_r($_POST);
$contact_number = $_POST['u_contact_no1']; 
$u_first_name = $_POST['u_first_name'];
$u_first_name = trim($u_first_name,'"');

// Your Account SID and Auth Token from twilio.com/console
$account_sid = 'your sid';
$auth_token = 'your token';
// In production, these should be environment variables. E.g.:
// $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

// A Twilio number you own with SMS capabilities
$twilio_number = "+15028920174";

$client = new Client($account_sid, $auth_token);
$client->messages->create(
    // Where to send a text message (your cell phone?)
    //'+94772688765',
    $contact_number,
    array(
        'from' => $twilio_number,
        'body' => 'Hello '.$u_first_name.'! This is GCMS. Please login to your GCMS portal & confirm the amounts of waste you disposed to the truck. Thank you.',
    )
);
