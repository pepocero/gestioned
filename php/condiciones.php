<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}


?>

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Alfa Slab One', cursive; font-size: 3vw;"> Condiciones de las Materias</p>
</div>

<div class="container col d-flex justify-content-center">
    <div class="alert alert-primary col-6" role="alert">
    Aquí se establecen las notas con las que se aprueba cada materia dependiendo de su condición.<br/>
    <i>Por ejemplo, si la condición es "Regular" y la nota es 4, entonces el alumno aprueba la materia con un 4.</i>
    </div>
</div>

<div class="container col d-flex justify-content-center">
    <div class="alert alert-secondary col-6" role="alert">
    <li>Para editar una celda, hacer <strong>doble clic</strong> en ella.</li>
    <li>Para guardar los cambios, hacer <strong> ENTER</strong>.</li>
    </div>
</div>

<div class="container col d-flex justify-content-center">
    <div id="tabla_condiciones"></div>
</div>

<div class="container col d-flex justify-content-center">
    <button type="button" class="btn btn-primary" id="btn_nueva_condicion">Crear nueva condicion</button>
</div>


<script src="../js/condiciones.js"></script>