<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

$idAlumno = Input::get('idAlumno');


//$carreras = $db->query("SELECT * FROM aa_carreras WHERE iduser = ?",[$userId])->results();
//echo json_encode($carreras, JSON_UNESCAPED_UNICODE);

$alumnos = $db->query("SELECT * FROM aa_alumnos WHERE iduser = ?",[$userId])->results();
//$id_alumno = $alumnos[0]->id;
?>

<div class="container col d-flex justify-content-center">
  <p class="titulo"> INSCRIPCION A MATERIAS</p>
</div>

<!-- Alerta -->
<div class="alert alert-primary col-8 mx-auto" role="alert">
    <li>Primero selecciona la fecha,luego la carrera y por último el año. Aparecerá un cuadro con todas las materias pertenecientes a a esa carrera en ese año.</li>
    <li>Si la carrera a la que quieres apuntarlo no aparece en el listado, es porque el alumno no está inscripto a dicha carrera. Apúntalo y vuelve aquí.</li>
</div>

<!-- FRORMULARIO OCULTO -->
<form id="form_inscripcion" method="POST" action="../ajax/inscripcion_materias.php" hidden>
  <input type="text" name="sendIdalumno" id="sendIdalumno" value="<?php echo $idAlumno;?>" placeholder="Id Alumno">
  <input type="text" name="sendFecha" id="sendFecha" placeholder="Fecha">
  <input type="text" name="sendCarrera" id="sendCarrera" placeholder="Carrera">
  <input type="text" name="sendMateria" id="sendMateria" placeholder="Materia">
  <input type="text" name="sendCond" id="sendCond" value="1" placeholder="Condicion">
</form>  



<div class="container col d-flex justify-content-center">
      <div class="form-group col-md-2">
        <label for="fechaInscripcion">Fecha Inscripción</label>
        <input type="date" id="fechaInscripcion" class="form-control">
      </div>


      <div class="form-group col-md-3" id="carrera">    
        <label for="selectCarrera">Carrera</label>
        <select class="form-select" id="selectCarrera" name="selectCarrera">
          <option value="0" selected>Seleccionar una carrera</option>
          <?php
              $listCarreras = $db->query("SELECT aa_carreras.id, aa_carreras.carrera
                                          FROM aa_carreras, aa_inscripcion_carrera
                                          WHERE aa_inscripcion_carrera.idcarrera = aa_carreras.id AND aa_inscripcion_carrera.iduser = ? AND aa_inscripcion_carrera.idalumno = ?",[$userId,$idAlumno])->results();

              foreach ($listCarreras as $carrera) {
                  // $idCarrera = $carrera->id;
                  // $nameCarrera = $carrera->carrera;
                echo "<option value='"; echo $carrera->id; echo "'>";
                echo $carrera->carrera; echo "</option>";
              }

          ?>
        </select>
      </div>
      
      <div class="form-group col-md-3">
        <label for="select_anios">Año</label>
          <select class="form-select col-5" id="select_anios">
              <option value="0">Selecciona un año</option>
          </select>
      </div>
    
</div>

<!-- Espacio vertical -->
<div style="height: 1rem;"></div>
<div class="container col d-flex justify-content-center">
  <div id="tabla_materias" class="col-6"></div>
</div>


<div class="container col d-flex justify-content-center mt-5">
  <button type="button" class="btn btn-danger me-5" id="btn_apuntar_alumno">Apuntar al alumno seleccionado en la carrera seleccionada</button>
  <button type="button" class="btn btn-warning me-5" id="btn_clear">Limpiar selección</button>
</div>





<!-- Cargar css de tabulator 
<link href="../css/tabulator/celeste.css" rel="stylesheet">
-->
<script src="../js/inscripcion_materias.js"></script>
