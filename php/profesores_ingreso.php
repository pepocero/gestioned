<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {
    $alta = Input::get('alta');
}else{
    $alta = 0;
}


?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">


<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Alfa Slab One', cursive; font-size: 3vw;"> Formulario de ingreso de profesores</p>
</div>


<form class="container col-10 bg-secondary p-4 shadow-lg" id="formulario" action="../ajax/add_profesor.php" method="post">  
  <div class="row">
        <div class="input-group mb-3 col">
            <span class="input-group-text">Nombre</span>
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
            <textarea class="form-control" placeholder="Datos Adicionales" rows="4" id="Datos_Adicionales" name="Datos_Adicionales"></textarea>
        </div>
</div>
<div class="row justify-content-center">
    <div class="input-group mb-3 p-2 justify-content-center">
    <button type="submit" class="btn btn-warning col-6">Guardar</button>
    </div>
</div>
</form>
  

<script>
  let alta = <?php echo $alta; ?>;
</script>


<script src="../js/profesores_ingreso.js"></script>