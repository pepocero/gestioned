<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}


$userId = $user->data()->id;


?>

<div style="height: 7vh;"></div><!-- Espacio Vertical -->

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Anton', sans-serif; font-size: 3vw;"> Ver materias y sus correlativas </p>
</div>

<div style="height: 4vh;"></div><!-- Espacio Vertical -->

<div class="container col-md-12">        
    <div id="tablaCorrelativas"></div>
</div>

<div style="height: 15vh;"></div><!-- Espacio Vertical -->

<hr>

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Anton', sans-serif; font-size: 3vw;"> Agregar una nueva correlativa </p>
</div>

<div class="container col d-flex justify-content-center"> 
    <div class="form-group col-md-3" id="carrera">    
    <label for="selectCarrera">Carrera</label>
    <select class="form-select" id="selectCarrera" name="selectCarrera">
        <option value="0" selected>Seleccionar una carrera</option>
        <?php
            $listCarreras = $db->query("SELECT * FROM aa_carreras WHERE iduser = ?",[$userId])->results();
            foreach ($listCarreras as $carrera) {
                // $idCarrera = $carrera->id;
                // $nameCarrera = $carrera->carrera;
            echo "<option value='"; echo $carrera->id; echo "'>";
            echo $carrera->carrera; echo "</option>";
            }

        ?>
    </select>
    </div>

    <div class="form-group col-md-2">
        <label for="select_anios">Año</label>
          <select class="form-select col-4" id="select_anios">
              <option value="0">Selecciona un año</option>
          </select>
      </div>
</div><!-- Fin Div Container  -->




<div class="container col d-flex justify-content-center">
  <div id="tabla_materias" class="col-6"></div>
</div>


<div id="ocultar">
    <input type="text" name="label" id="label" placeholder="Materia" value="0" hidden/>
    <input type="text" name="materia" id="materia" placeholder="Materia" value="0" hidden/>
    
</div>

<div id="btnEstablecer">
    <div class="container col d-flex justify-content-center">
        <button class="btn btn-primary" id="setMateria" style="margin-right: 20px;">Establecer Materia</button>
        <button class="btn btn-warning" id="setCorrelativa">Establecer Correlativa</button>
    </div>
</div>


<div class="container col d-flex justify-content-center">
    <form id="enviar" method="POST" action="../xmlhttp/xmlhttp_correlativas.php"> 
        <span class="h2">Materia</span>  
        <input type="text" name="sendNombreMateria" id="sendNombreMateria" style="width: 25rem;text-align:center;" readonly disabled/>
        <input type="text" name="sendMateria" id="sendMateria" style="width: 30px;text-align:center; margin-right:100px;" readonly>    

        <span class="h2">Correlativa</span>
        <input type="text" name="sendNombreCorrelativa" id="sendNombreCorrelativa" style="width: 25rem;text-align:center;" readonly disabled/>
        <input type="text" name="sendCorrelativa" id="sendCorrelativa" style="width: 30px;text-align:center;" readonly/>
    </form>
</div>

<div style="height: 5vh;"></div><!-- Espacio Vertical -->

<div class="container col d-flex justify-content-center">
    <button class="btn btn-danger" id="enviarDatos">ENVIAR DATOS A LA BDD</button>
</div>

<hr/>

<div style="height: 17vh;"></div><!-- Espacio Vertical -->






<!-- FOOTER -->
<?php require_once $abs_us_root . $us_url_root . 'users/includes/html_footer.php'; ?>

<script src="../js/correlativas.js"></script>