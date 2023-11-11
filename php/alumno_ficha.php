<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
$idAlumno = Input::get('idAlumno');
echo $idAlumno;
echo "<br>";
$datos_alumno = $db->query("SELECT * FROM aa_alumnos WHERE id = ?",[$idAlumno])->results();

$datos = json_encode($datos_alumno, JSON_UNESCAPED_UNICODE);
//echo $datos;

$profesores = $db->query("SELECT id, Apellido, Nombre FROM aa_profesores WHERE iduser = ?", [$userId])->results();
$array = array();
foreach ($profesores as $value) {
    $array[] = array(
        'value' => $value->id,
        'label' => $value->Apellido . ", " . $value->Nombre,
    );
}

$profesores = json_encode($array, JSON_UNESCAPED_UNICODE);

$condiciones = $db->query("SELECT id, condicion FROM aa_condiciones")->results();
$array2 = array();
foreach ($condiciones as $val) {
    $array2[] = array(
        'value' => $val->id,
        'label' => $val->condicion,
    );
}

$condiciones = json_encode($array2, JSON_UNESCAPED_UNICODE);

?>

<div class="container col d-flex justify-content-center">
  <p class="titulo"> FICHA DE ALUMNO</p>
</div>

<!-- TARJETA DATOS ALUMNO QUE SE LLENA CON JAVASCRIPT -->
<div id="contenedor-tarjeta"></div>

<div class="container col d-flex justify-content-center">
<div class="card me-3">
  <div class="card-header text-center text-white bg-primary fw-bolder">
    APUNTAR AL ALUMNO A UNA CARRERA
  </div>
  <div class="card-body">
    <!--<h5 class="card-title text-center">Inscribirlo a una carrera</h5>-->
    <p class="card-text text-center">Haciendo clic en el botón, te llevará a la página de inscripcion de carreras.</p>
    <div class="text-center">
        <a href="inscripcion_carreras.php" class="btn btn-primary mx-auto">Inscribir a Carreras</a>
    </div>    
  </div>
</div>

<div class="card me-3">
  <div class="card-header text-center fw-bolder bg-warning">
    INSCRIPCION A MATERIAS
  </div>
  <div class="card-body">
    <!--<h5 class="card-title text-center">Inscribirlo a una materia</h5>-->
    <p class="card-text text-center">Haciendo clic en el botón, te llevará a la página de inscripcion de materias.</p>
    <div class="text-center">
      <form action="inscripcion_materias.php" method="post" id="formulario">
        <input type="hidden" name="idAlumno" id="idAlumno" value="<?php echo $idAlumno; ?>"/>
        <button type="submit" class="btn btn-warning mx-auto fw-bold">Inscribir a materias</button>
      </form>
    </div> 
  </div>
</div>

<div class="card me-3">
  <div class="card-header text-center text-white bg-primary fw-bolder">
    CERTIFICADOS ANALITICOS
  </div>
  <div class="card-body">
    <!--<h5 class="card-title text-center">Carreras a la que está apuntado</h5>-->
    <p class="card-text text-center">Aquí se pueden ver las carreras a la que está apuntado y al seleccionar una se puede obtener un certificado analítico</p>
    <div class="text-center">
        <select id="select_carreras"></select>
        <!-- Formulario para ir a la pagina del certificado analitico -->
        <form action="../ajax/certificado_analitico.php" method="post" id="form_analitico">
          <input name="idAlumno" id="idAlumno" value="<?php echo $idAlumno; ?>" hidden/>
          <input name="id_carrera" id="id_carrera" hidden/>
        </form>
          <button id="submit_analitico" class="btn btn-primary mx-auto">Ver certificado analítico</button>
    </div> 
  </div>
</div>
</div>





<div style="height: 5vw;"></div> 

<div class="container col d-flex justify-content-center">
  <p class="titulo"> Notas de Cutrimestres</p>
</div>

<div class="container col d-flex justify-content-center">
    <div id="tabla_cuatrimestres"></div>
</div>

<div style="height: 7vw;"></div> 

<div class="container col d-flex justify-content-center">
  <p class="titulo"> Notas de Acreditación</p>
</div>

<div class="container col d-flex justify-content-center">
    <div id="tabla_acreditacion"></div>
</div>



<div style="height: 25vw;"></div> 


<script>

    let idAlumno = <?php echo $idAlumno; ?>;
    let profes = <?php echo $profesores; ?>;
    let condiciones = <?php echo $condiciones; ?>;
    

</script>


<script src="../js/alumno_ficha.js"></script>

