<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {   

    //---------------------------------------------------------------------------------
        //INGRESAR ALUMNOS
    $datos = json_decode(file_get_contents("php://input"), true); //Recibe el Json del formulario de alumnos_ingreso.php
    $control = $datos['control'];//Obtiene el dato de control
    
   

        $camposFijos = array();
        $camposFijos['iduser'] = $userId;
        //agregar datos fijos al array
        foreach ($datos as $key => $value) {
            if($key == "Nombre"){
                $camposFijos[$key] = $value;
            }elseif($key == "Apellido"){
                $camposFijos[$key] = $value;
            }elseif($key == "Direccion"){
                $camposFijos[$key] = $value;
            }elseif($key == "Dni"){
                $camposFijos[$key] = $value;
            } 
        }
        $db->insert('aa_alumnos',$camposFijos);

        // Obtener el ID del último registro insertado
        $ultimo_id = $db->lastId(); 
        $tabla ="alumnos";     
        foreach ($datos as $key => $value) {
            if($key != "Nombre" && $key != "Apellido" && $key != "Direccion" && $key != "Dni"){                
                $db->insert("aa_campos_alumnos", ["iduser"=>$userId, "idAlumno"=>$ultimo_id, "campo"=>$key, "dato"=>$value]);                
            } 
        }

        echo"Alumno ingresado correctamente";

        
    }

?>