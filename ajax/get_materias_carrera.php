<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {
    
    $idCarrera = Input::get('idCarrera');
    $get_materias = $db->query("SELECT aa_materias.id, aa_materias.materia, aa_materias.anio, aa_carreras.carrera 
    FROM aa_materias, aa_carreras
    WHERE aa_materias.iduser = ? AND aa_materias.carrera = ? AND aa_carreras.id = aa_materias.carrera", [$userId, $idCarrera])->results();
    echo json_encode($get_materias, JSON_UNESCAPED_UNICODE);

}//Fin Input Exists
?>
