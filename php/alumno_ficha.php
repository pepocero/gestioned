<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (!empty($_GET)) {//Esto es para que funcione el redirect del crud que envia por GET el id
  $idAlumno = Input::get('idAlumno');
}else if (Input::exists()) { //Esto es para que funcione el redirect de la tabla de buscar alumno que envia por POST el id
  $idAlumno = Input::get('idAlumno');
}else{
  //redirect
  header("Location: ../php/buscar_alumno.php");
}


$datos_alumno = $db->query("SELECT * FROM aa_alumnos WHERE id = ? AND iduser = ?",[$idAlumno,$userId])->results();
$imagen = $datos_alumno[0]->imagen;


//Valor de los daots adicionales:
$datos_adicionales =  $datos_alumno[0]->Datos_Adicionales;


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
<link rel="stylesheet" type="text/css" href="../css/profile.css">

<!-- Agrego el Cropper -->
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>		
<script src="https://unpkg.com/cropperjs"></script>


<!-- MODAL PARA CAMBIAR FOTO DE PERFIL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Recortar imagen antes de subirla</h5>
			        		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>	
<!-- FIN MODAL PARA CAMBIAR FOTO DE PERFIL -->




<div class="container col d-flex justify-content-center">
  <p class="titulo"> FICHA DE ALUMNO</p>
</div>

<!-- NUEVO CARD PROFILE ----------------------------------------------------------------------------------------------------->
<div class="container col d-flex flex-column justify-content-center">
    <ul class="ul-cards">
    <li style="--accent-color: #68AFFF">
          <div class="icon">
            <!-- FOTO DE PERFIL -->    
            <div class="image_area">              
                    <form method="post">
                      <label for="upload_image">                      
                        <img src="<?php echo $imagen; ?>" id="uploaded_image" onerror="this.src='../images/user.png'">                       
                        <input type="file" name="image" class="image" id="upload_image" style="display:none" accept="image/png, image/gif, image/jpeg"/>	
                      </label>                      
                    </form>
            </div>			    
            <!-- FIN FOTO DE PERFIL -->   
          </div>

          <div class="title"><?php echo $datos_alumno[0]->Nombre." ".$datos_alumno[0]->Apellido; ?> </div>
          
          <form action="../ajax/crud.php" method="post" id="form_editar">
            <input type="hidden" name="idAlumno" id="idAlumno" value="<?php echo $idAlumno; ?>"/>
            <input type="hidden" name="control" id="control" value="edit_alumno"/>
            
          <div class="content">
            <!-- ROWS --> 
              <div class="container text-center">
                  <div class="row row-cols-4">
                  <div class="col">
                      <label for="Nombre" class="fw-bold">Nombre:</label>
                      <input type="text" id="Nombre" name="Nombre" class="form-control" value="<?php echo $datos_alumno[0]->Nombre; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Apellido" class="fw-bold">Apellido:</label>
                      <input type="text" id="Apellido" name="Apellido" class="form-control" value="<?php echo $datos_alumno[0]->Apellido; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Dni" class="fw-bold">DNI:</label>
                      <input type="text" id="Dni" name="Dni" class="form-control" value="<?php echo $datos_alumno[0]->Dni; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Fecha_Nac" class="fw-bold">Fecha de Nacimiento:</label>
                      <input type="date" id="Fecha_Nac" name="Fecha_Nac" class="form-control" value="<?php echo $datos_alumno[0]->Fecha_Nacimiento; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Ciudad_Origen" class="fw-bold">Ciudad de Nacimiento:</label>
                      <input type="text" id="Ciudad_Origen" name="Ciudad_Origen" class="form-control" value="<?php echo $datos_alumno[0]->Ciudad_Origen; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Ciudad_Residencia" class="fw-bold">Ciudad de Residencia:</label>
                      <input type="text" id="Ciudad_Residencia" name="Ciudad_Residencia" class="form-control" value="<?php echo $datos_alumno[0]->Ciudad_Residencia; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Direccion" class="fw-bold">Dirección de Residencia:</label>
                      <input type="text" id="Direccion" name="Direccion" class="form-control" value="<?php echo $datos_alumno[0]->Direccion; ?>" required>
                    </div>
                    <div class="col">
                      <label for="CP" class="fw-bold">Código Postal:</label>
                      <input type="text" id="CP" name="CP" class="form-control" value="<?php echo $datos_alumno[0]->CP; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Telefono" class="fw-bold">Teléfono:</label>
                      <input type="text" id="Telefono" name="Telefono" class="form-control" value="<?php echo $datos_alumno[0]->Telefono; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Telefono_Contacto" class="fw-bold">Teléfono de Contacto:</label>
                      <input type="text" id="Telefono_Contacto" name="Telefono_Contacto" class="form-control" value="<?php echo $datos_alumno[0]->Telefono_Contacto; ?>" required>
                    </div>
                    <div class="col">
                      <label for="Vinculo" class="fw-bold">Vínculo del Contacto:</label>
                      <input type="text" id="Vinculo" name="Vinculo" class="form-control" value="<?php echo $datos_alumno[0]->Vinculo; ?>" required>
                    </div>
                    <div class="col">
                      <label for="email" class="fw-bold">Email:</label>
                      <input type="text" id="email" name="email" class="form-control" value="<?php echo $datos_alumno[0]->Email; ?>" required>
                    </div>
                  </div>
              </div><!-- FIN ROWS -->                  
          </div>
          <div class="container justify-content-center p-2">
            <button class="btn btn-light col-4" id="btnMostrarDatos" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAdicionales" aria-expanded="false" aria-controls="collapseExample"> Mostrar Datos Adicionales </button>
          </div>
  
          <div class="container mx-auto collapse" id="collapseAdicionales">            
            <div class="input-group mb-3 col">
              <span class="input-group-text">Datos Adicionales</span>
              <textarea class="form-control" placeholder="Datos Adicionales" id="Datos_Adicionales" name="Datos_Adicionales"><?php echo $datos_alumno[0]->Datos_Adicionales; ?></textarea>
            </div>            
          </div>

          <div class="container justify-content-center p-2">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
            <label class="form-check-label" for="flexCheckDefault"> Activar para Editar </label>
          </div>
          
          <div class="container d-flex flex-column justify-content-center p-3" style="width: 30%;">          
            <button type="submit" class="btn buton_edit">Confirmar Edición</button>
          </div>

          </form>  
        </li>
    </ul>
</div>
    <!-- FIN CARD PROFILE -->

    <div style="height: 5vw;"></div> 

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


<script type="text/javascript" src="../js/alumno_ficha.js"></script>
<script type="text/javascript" src="../js/photo.js"></script>

