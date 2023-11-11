<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
$tabla = Input::get('control');


    $campos = $db->query("SELECT * FROM aa_campos_fijos")->results();
    $campos_extras = $db->query("SELECT * FROM aa_campos_extras WHERE iduser = ? AND tabla = ?", [$userId, $tabla])->results();

    //Unir los dos arrays
    $campos_unidos = array_merge($campos, $campos_extras);

    echo json_encode($campos_unidos, JSON_UNESCAPED_UNICODE);


?>


