<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

//Redirect::to(currentPage());

?>



<link href="../css/tabulator/simple.css" rel="stylesheet">


<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Alfa Slab One', cursive; font-size: 3vw;"> Crear / Editar Materias</p>
</div>

<div class="container col d-flex justify-content-center">
    <div class="alert alert-warning col-4" role="alert">
    La primer tabla indica las carreras que ya has creado.
    La segunda tabla muestra las materias que ya has creado para la carrera seleccionada.
    </div>
</div>

<div style="height: 3rem;"></div>


<div class="container col-8">
    <div class="container col d-flex justify-content-center bg-primary text-white">
        <p style="font-family: 'Kanit', sans-serif; font-size: 1.7vw;"> CARRERAS</p>
    </div>
    <div id="tab_carreras"></div>
    <div style="height: 2rem;"></div>        
</div>

<div class="container col-8">
    <div class="container col d-flex justify-content-center bg-primary text-white">
        <p style="font-family: 'Kanit', sans-serif; font-size: 1.7vw;"> Materias de la carera seleccionada</p>
    </div>
    <div id="tab_materias"></div>
    <div style="height: 2rem;"></div>        
</div>

<div style="height: 23rem;"></div>

<script src="../js/sweetalert.js"></script>
<script src="../js/crear_materia.js"></script>
