<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = 1;
$profesores = $db->query("SELECT id, Apellido, Nombre FROM aa_profesores WHERE iduser = ?", [$userId])->results();
$array = array();
foreach ($profesores as $value) {
    $array[] = array(
        'value' => $value->id,
        'label' => $value->Apellido . ", " . $value->Nombre,
    );
}

$profesores = json_encode($array, JSON_UNESCAPED_UNICODE);
echo $profesores;

?>
