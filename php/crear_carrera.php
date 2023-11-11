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
  <p class="titulo"> Crear Carreras</p>
</div>


<div style="height: 3rem;"></div>


<div class="container col-5">
    <div class="container bg-primary text-end">
        <button id="btn_add_carrera" class="btn btn-primary" ><i class="fa-solid fa-square-plus fa-xl animate__animated animate__pulse animate__infinite" style="color: white;"></i> </button> 
    </div>
    <div id="tab_carreras"></div>
    <div style="height: 2rem;"></div>    
</div>



<script src="../js/crear_carreras.js"></script>
