<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;


?>



<link rel="stylesheet" type="text/css" href="../css/custom.css">

<div style="height: 3rem;"></div> <!-- Espacio vertical -->


<div class="container col d-flex justify-content-center">
  <p class="titulo"> VER FICHA DE UN ALUMNO EN PARTICULAR</p>
</div>
<!-- Alert -->
<div class="alert alert-warning alert-dismissible fade show col-4 mx-auto" role="alert">
  <strong>¡Atención!</strong> Para ver la ficha de un profesor, primero debe buscarlo en la tabla de abajo. <strong>Doble clic para acceder.</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<div style="height: 1rem;"></div> <!-- Espacio vertical -->



<div class="container col-md-8">
  <div id="select-stats" class="bg-primary text-white text-center fs-1" style="height:6rem;"></div>

  <div id="example-table"></div>
  <div style="height: 1.7rem;"></div> <!-- Espacio vertical -->
  <button type="button" class="col btn btn-secondary" id="boton">VER FICHA</button>

</div>

<div style="height: 10rem;"></div> <!-- Espacio vertical -->

<!-- FORMULARIO OCULTO PARA ENVIAR ID -->
<form method="POST" action="profesor_ficha.php" id="formStudent">
   <input type="text" id="idProfe" name="idProfe" hidden="true" value="">      
</form> 



<!--FOOTER-->
 <?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>


<script src="../js/buscar_profesor.js"></script> 