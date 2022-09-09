<?php
require 'vendor/autoload.php'; 

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("test@thesoftking.com", "Example User");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("abirkhan75@gmail.com", "a User");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    // print $response->statusCode() . "<br><br><br>";
    // print_r($response->headers()). "<br><br><br>";
    // print $response->body() . "<br><br><br>";
} catch (Exception $e) {
    // echo 'Caught exception: '. $e->getMessage() ."\n";
}