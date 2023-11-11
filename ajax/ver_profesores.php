<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
    
$profesores = $db->query("SELECT * FROM aa_profesores WHERE iduser = ?", [$userId])->results();
    


echo json_encode($profesores, JSON_UNESCAPED_UNICODE);

?>