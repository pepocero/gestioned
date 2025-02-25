<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {   

    //---------------------------------------------------------------------------------
    //INGRESAR UN NUEVO ALUMNO
    
    $nombre = Input::get('Nombre');
    $apellido = Input::get('Apellido');
    $dni = Input::get('DNI');
    $fecha_nac = Input::get('Fecha_Nac');
    $ciudad_origen = Input::get('Ciudad_Origen');
    $ciudad_residencia = Input::get('Ciudad_Residencia');
    $direccion = Input::get('Direccion');
    $cp = Input::get('CP');
    $telefono = Input::get('Telefono');
    $telefono_contacto = Input::get('Telefono_Contacto');
    $vinculo = Input::get('Vinculo');
    $email = Input::get('email');        
    $datos_adicionales = Input::get('Datos_Adicionales');
    

    $db->insert("aa_alumnos", [
        "iduser" => $userId,
        "Nombre" => $nombre,
        "Apellido" => $apellido,
        "Dni" => $dni,
        "Fecha_Nacimiento" => $fecha_nac,
        "Ciudad_Origen" => $ciudad_origen,
        "Ciudad_Residencia" => $ciudad_residencia,
        "Direccion" => $direccion,
        "CP" => $cp,
        "Telefono" => $telefono,
        "Telefono_Contacto" => $telefono_contacto,
        "Vinculo" => $vinculo,
        "Email" => $email,          
        "Datos_Adicionales" => $datos_adicionales
        
    ]);
        
    }

?>

<script>
    Swal.fire({
        title: "Atención",
        text: "Alumno dado de alta correctamente",
        icon:"success"})
    .then(function(){
                //redirigir a ../php/alumnos_ingreso.php
                window.location.href = "../php/alumnos_ingreso.php";
            }
    );
</script>