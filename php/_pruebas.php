<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = 1;
$profesores = $db->query("SELECT id, Apellido, Nombre FROM aa_profesores WHERE iduser = ?", [$userId])->results();
$array = array();
foreach ($profesores as $value) {
    $array[] = array(
        'value' => $value->id,
        'label' => $value->Apellido . ", " . $value->Nombre,
    );
}

$profesores = json_encode($array, JSON_UNESCAPED_UNICODE);
echo $profesores;
echo "<br>";

//$db->insert("aa_campos_extras", ["iduser"=>$userId, "campo"=>"Prueba", "tabla"=>"prueba", "tipo"=>"text"]);
$nuevoCampo = "Prueba";
//ESTO AGREGA UN NUEVO CAMPO A LA ESTRUCTURA DE LA TABLA
//$db->query("ALTER TABLE aa_campos_extras ADD $nuevoCampo VARCHAR(255)")->results();
//CON ESTO SE ELIMINA EL CAMPO DE LA ESTRUCTURA DE LA TABLA
//$db->query("ALTER TABLE aa_campos_extras DROP $nuevoCampo")->results();



?>


 <form class="container col-10 bg-primary p-4 shadow-lg" id="formulario" action="../ajax/add_alumno.php" method="post">  
  <div class="row">
        <div class="input-group mb-3 col">
            <span class="input-group-text col-3">Nombre</span>
            <input type="text" class="form-control col-md-1" placeholder="Nombre" id="Nombre" name="Nombre" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">Apellido</span>
            <input type="text" class="form-control" placeholder="Apellido" id="Apellido" name="Apellido" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">DNI</span>
            <input type="number" class="form-control" placeholder="DNI" id="DNI" name="DNI" required>
        </div>
  </div>
  <div class="row">
        <div class="input-group mb-3 col">
            <span class="input-group-text">Fecha de Nacimiento</span>
            <input type="date" class="form-control" placeholder="Fecha de Nacimiento" id="Fecha_Nac" name="Fecha_Nac" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">Ciudad de Origen</span>
            <input type="text" class="form-control" placeholder="Ciudad Origen" id="Ciudad_Origen" name="Ciudad_Origen" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">Ciudad de Residencia</span>
            <input type="text" class="form-control" placeholder="Ciudad de Residencia" id="Ciudad_Residencia" name="Ciudad_Residencia" required>
        </div>
  </div>
  <div class="row">
        <div class="input-group mb-3 col">
            <span class="input-group-text">Dirección</span>
            <input type="text" class="form-control" placeholder="Direccion" id="Direccion" name="Direccion" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">C.P</span>
            <input type="text" class="form-control" placeholder="CP" id="CP" name="CP" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">Teléfono</span>
            <input type="number" class="form-control" placeholder="Telefono" id="Telefono" name="Telefono" required>
        </div>
    </div>
<div class="row">
        <div class="input-group mb-3 col">
            <span class="input-group-text">Teléfono Contacto</span>
            <input type="number" class="form-control" placeholder="Telefono Contacto" id="Telefono_Contacto" name="Telefono_Contacto" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">Vínculo</span>
            <input type="text" class="form-control" placeholder="Vinculo" id="Vinculo" name="Vinculo" required>
        </div>

        <div class="input-group mb-3 col">
            <span class="input-group-text">E-mail</span>
            <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" required>
        </div>
</div>
<div class="container col-5">
        <div class="input-group mb-3">
            <span class="input-group-text">Datos Adicionales</span>
            <textarea class="form-control" placeholder="Datos Adicionales" rows="5" id="Datos_Adicionales" name="Datos_Adicionales"></textarea>
        </div>
</div>
<div class="row justify-content-center">
    <div class="input-group mb-3 p-2 justify-content-center">
    <button type="submit" class="btn btn-warning col-6">Guardar</button>
    </div>
</div>

  </form>