<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

//

?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">



<link href="../css/tabulator/simple.css" rel="stylesheet">

<style>
    #formulario {
  display: flex;
  justify-content: center;
  align-items: center;
  /*height: 100vh;*/
}

</style>

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Alfa Slab One', cursive; font-size: 3vw;"> Alumnos</p>
</div>


<div style="height: 3rem;"></div>



<div class="container col-6">
    <div class="accordion" id="accordionExample">  
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed  bg-info text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        PERSONALIZAR LOS CAMPOS EXTRAS DE FORMULARIO DE LOS ALUMNOS
        </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
                <button class="btn btn-primary" id="btn_add_campo">Agregar Campo</button>
                <div id="tab_campos_alumnos"></div>
        </div>
        </div>
    </div>
    </div>
</div>

<div style="height: 3rem;"></div>

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Alfa Slab One', cursive; font-size: 3vw;"> Formulario de ingreso de alumnos</p>
</div>

<div class="container col-8">
   
</div>

<script src="../js/sweetalert.js"></script>
<script src="../js/alumnos_ingreso.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>