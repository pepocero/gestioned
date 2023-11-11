<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
$tabla = Input::get('control');


    $campos_extras = $db->query("SELECT * FROM aa_campos_extras WHERE iduser = ? AND tabla = ?", [$userId, $tabla])->results();
    echo json_encode($campos_extras, JSON_UNESCAPED_UNICODE);





?>


