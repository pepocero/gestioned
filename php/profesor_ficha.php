<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
$idProfe = Input::get('idProfe');
//echo $idProfe;
//echo "<br>";
$datos_profe = $db->query("SELECT * FROM aa_profesores WHERE id = ?",[$idProfe])->results();

$datos = json_encode($datos_profe, JSON_UNESCAPED_UNICODE);
//echo $datos;




?>

<div class="container col d-flex justify-content-center">
  <p class="titulo"> FICHA DE PROFESOR</p>
</div>

<!-- TARJETA DATOS PROFESOR QUE SE LLENA CON JAVASCRIPT -->
<div id="contenedor-tarjeta"></div>

<div class="container col d-flex justify-content-center">
<div class="card me-3">
  <div class="card-header text-center text-white bg-primary">
    ALGO PARA EL PROFESOR
  </div>
  <div class="card-body">
    <h5 class="card-title text-center">Special title treatment</h5>
    <p class="card-text text-center">With supporting text below as a natural lead-in to additional content.</p>
    <div class="text-center">
        <a href="#" class="btn btn-primary mx-auto">Go somewhere</a>
    </div>    
  </div>
</div>



<div class="card me-3">
  <div class="card-header text-center text-white bg-primary">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title text-center">Special title treatment</h5>
    <p class="card-text text-center">With supporting text below as a natural lead-in to additional content.</p>
    <div class="text-center">
        <a href="#" class="btn btn-primary mx-auto">Go somewhere</a>
    </div> 
  </div>
</div>
</div>





<div style="height: 25vw;"></div> 


<script>

    let idProfe = <?php echo $idProfe; ?>;    

</script>



<script src="../js/profesor_ficha.js"></script>

