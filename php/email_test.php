<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$send_now = "no";

if($send_now == "yes"){

$to = "pepocero@gmail.com";
$subject = "Test email using PHP";
$body = "This is a test email message";

sendinblue($to,$subject,$body,$to_name = "");

}



// PROBADO Y FUNCIONA!!!!


?>

