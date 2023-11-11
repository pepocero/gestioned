<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

$carreras = $db->query("SELECT * FROM aa_carreras WHERE iduser = ?",[$userId])->results();
//echo json_encode($carreras, JSON_UNESCAPED_UNICODE);

$alumnos = $db->query("SELECT * FROM aa_alumnos WHERE iduser = ?",[$userId])->results();
//$id_alumno = $alumnos[0]->id;
?>

<div class="container col d-flex justify-content-center">
  <p class="titulo"> INSCRIPCION A CARRERAS</p>
</div>

<!-- Alerta -->
<div class="alert alert-primary col-5 mx-auto" role="alert">
    Primero seleccione a un alumno de la tabla de la izquierda y luego seleccione una carrera de la tabla de la derecha
</div>


<div class="container col d-flex justify-content-center">
    <div>
        <div class="bg-primary me-3 p-2 text-center text-white">ALUMNOS </div>
        <div id="tabla_alumnos" class="me-3"></div>
    </div>

    <div>
        <div class="bg-primary p-2 text-center text-white">CARRERAS </div>
        <div id="tabla_carreras"></div>
    </div>
    
</div>

<div class="container col d-flex justify-content-center mt-5">
  <button type="button" class="btn btn-danger me-5" id="btn_apuntar_alumno">Apuntar al alumno seleccionado en la carrera seleccionada</button>
  <button type="button" class="btn btn-warning me-5" id="deselect-row">Limpiar selección</button>
</div>

<div style="height: 2rem;"></div>

<div id="tabla" class="col-4 mx-auto">
  <div class="bg-primary p-2 text-center text-white">CARRERAS A LA QUE ESTA APUNTADO EL ALUMNO SELECCIONADO </div>
  <div id="tabla_incripcion"></div>
</div>


<div style="height: 22rem;"></div>
<!-- Cargar css de tabulator 
<link href="../css/tabulator/celeste.css" rel="stylesheet">
-->
<script src="../js/inscripcion_carreras.js"></script>
