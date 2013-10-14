<?php
require_once('recaptchalib.php');
require('../../../../wp-blog-header.php');
global $root;
global $qode_options;

$publickey = $qode_options['recaptcha_public_key'];
$privatekey = $qode_options['recaptcha_private_key']; 

if ($publickey == "") $publickey = "6LeT2twSAAAAAPylqZtsa_rCKZMM9OwOnC3feRpR";
if ($privatekey == "") $privatekey = "6LeT2twSAAAAAPhekNXyLNWCqirHEmuGsyAgu24w";



$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);

//echo $_POST["recaptcha_challenge_field"] . " | " . $_POST["recaptcha_response_field"];
//print_r($resp);

$use_captcha = $qode_options['use_recaptcha'];
if ($resp->is_valid || $use_captcha == "no") {
?>success<?php

$email_to = $qode_options['receive_mail'];
$email_from = $qode_options['email_from'];
$subject = $qode_options['email_subject'];


$text = "Name: " . $_POST["name"] . "<br/>";
$text .= "Email: " . $_POST["email"] . "<br/>";
$text .= "WebSite: " . $_POST["website"] . "<br/>";
$text .= "Message: " . $_POST["message"];


$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html; charset=utf-8" . "\r\n"; 
$headers .= "From: $email_from" . "\r\n";
mail($email_to, $subject, $text, $headers);



}
else 
{
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .  "(reCAPTCHA said: " . $resp->error . ")");
}
 


?>