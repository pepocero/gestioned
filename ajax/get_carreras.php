<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
//$db->query("SELECT email FROM users WHERE username = ? AND logins > ?", [$name, $logins]);
$get_carreras = $db->query("SELECT * FROM aa_carreras WHERE iduser = ?", [$userId])->results();

echo json_encode($get_carreras, JSON_UNESCAPED_UNICODE);
?>
