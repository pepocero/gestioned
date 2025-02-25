<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
if (!securePage($_SERVER['PHP_SELF'])){die();}

// Establece el encabezado 'Content-Type' a 'application/json'
header('Content-Type: application/json');

$userId = $user->data()->id;
$idAlumno = Input::get('idAlumno');

//$datos_alumno = $db->query("SELECT * FROM aa_alumnos WHERE id = ?",[$idAlumno])->results();
//echo json_encode($datos_alumno, JSON_UNESCAPED_UNICODE);

$datos_alumno = $db->query("SELECT *
FROM aa_alumnos 
WHERE id = ?
AND iduser = ?",[$idAlumno,$userId])->results();

//$datos_extras = $db->query("SELECT * FROM aa_campos_alumnos WHERE idAlumno = ? AND iduser = ?", [$idAlumno,$userId])->results();

    //Unir los dos arrays
    //$all_data = array_merge($datos_alumno, $datos_extras);

    echo json_encode($datos_alumno, JSON_UNESCAPED_UNICODE);

?>