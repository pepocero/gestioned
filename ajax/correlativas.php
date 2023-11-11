<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;




$get = $db->query("SELECT aa_correlativas.id, aa_correlativas.materia AS mate, aa_correlativas.correlativa AS corre,
(
    SELECT aa_materias.materia AS m
     FROM aa_materias
     WHERE mate = aa_materias.id AND aa_materias.iduser = $userId 
) AS Materia1,
(
    SELECT aa_materias.anio AS any
     FROM aa_materias
     WHERE mate = aa_materias.id AND aa_materias.iduser = $userId
    ORDER BY any
) AS anio,

(
    SELECT aa_carreras.carrera
     FROM aa_carreras, aa_materias
     WHERE mate = aa_materias.id AND aa_materias.carrera = aa_carreras.id AND aa_materias.iduser = $userId
) AS carrera1, aa_correlativas.correlativa AS corr,

(
    SELECT aa_materias.materia AS ma
     FROM aa_materias
     WHERE corr = aa_materias.id AND aa_materias.iduser = $userId
) AS correlativa,

(
    SELECT aa_materias.anio AS ano
     FROM aa_materias
     WHERE corr = aa_materias.id AND aa_materias.iduser = $userId
) AS Año,

(
    SELECT aa_carreras.carrera
     FROM aa_carreras, aa_materias
     WHERE corr = aa_materias.id AND aa_materias.carrera = aa_carreras.id AND aa_materias.iduser = $userId
) AS carrera2

FROM aa_correlativas, aa_materias
WHERE aa_correlativas.materia = aa_materias.id AND aa_materias.iduser = $userId
ORDER BY aa_correlativas.id ASC, `carrera1` ASC, mate ASC
")->results();

echo json_encode($get, JSON_UNESCAPED_UNICODE);

?>