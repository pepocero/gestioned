<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {   
    
    $control = Input::get('control');

    //BORRAR CARRERA
    if($control == "delete_carrera"){
        $id_carrera = Input::get('idCarrera');
        $db->deleteById("aa_carreras", $id_carrera);
    }
    //---------------------------------------------------------------------------------
    //ACTUALIZAR CARRERA
    if($control == "update_carrera"){
        $id_carrera = Input::get('idCarrera');
        $texto = Input::get('texto');
        $fields=array(
            'carrera'=>$texto);
        $db->update('aa_carreras',$id_carrera,$fields);
    }
    //Redirect::to(currentPage());


    //---------------------------------------------------------------------------------
    //CREAR UNA NUEVA CARRERA
    if($control == "insert_carrera"){
        $carrera = Input::get('texto');
        $db->insert("aa_carreras", ["iduser"=>$userId, "carrera"=>$carrera]);
        //Aca hago una consulta para saber si tiene creada alguna condicion. Si no tiene ninguna, entonces creo una por defecto.De esta forma me aseguro de que el usuario tenga al menos una condicion creada.
        $query = $db->query("SELECT * FROM aa_condiciones WHERE iduser = ?",[$userId])->results();
        if(empty($query)){
            $db->insert("aa_condiciones", ["iduser"=>$userId, "condicion"=>"Regular", "nota"=>4]); 
        }
    }

    //---------------------------------------------------------------------------------
    //CREAR MATERIA
    if($control == "insert_materia"){
        $id_carrera = Input::get('idCarrera');
        $materia = Input::get('materia');
        $anio = Input::get('anio');
        $db->insert("aa_materias", ["iduser"=>$userId, "materia"=>$materia, "anio"=>$anio, "carrera"=>$id_carrera]);      
    }

    //---------------------------------------------------------------------------------
        //EDITAR NOMBRE DE MATERIA
        if($control == "update_materia_name"){
            $id = Input::get('id');
            $cellValue = Input::get('cellValue');
            $cellValue = urldecode($cellValue); // Decodificar caracteres especiales
            
            $db->update("aa_materias", $id, ["materia"=>$cellValue]);       
            
        }

    //---------------------------------------------------------------------------------
        //EDITAR AÑO DE MATERIA
        if($control == "update_materia_anio"){
            $id = Input::get('id');
            $cellValue = Input::get('cellValue');
            
            $db->update("aa_materias", $id, ["anio"=>$cellValue]);       
            
        }
    //---------------------------------------------------------------------------------
    //BORRAR MATERIA
    if($control == "delete_materia"){
        $id_materia = Input::get('idMateria');
        $db->deleteById("aa_materias", $id_materia);
    }

    //---------------------------------------------------------------------------------
    //CREAR CAMPO ALUMNOS
    if($control == "add_campo_alumnos"){
        $tabla = "alumnos";
        $campo = Input::get('texto');
        
        $db->insert("aa_campos_extras", ["iduser"=>$userId, "tabla"=>$tabla, "campo"=>$campo]);
            //echo $campo->campo;
        
        }
    //---------------------------------------------------------------------------------
        //ELIMINAR CAMPO ALUMNOS VERRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
    if($control == "delete_campo_alumnos"){
        $idCampo = Input::get('idCampo');
        //$campo = Input::get('campo');
        
        $db->deleteById("aa_campos_extras", $idCampo);
        }

    //---------------------------------------------------------------------------------
        //EDITAR CAMPO ALUMNOS
    if($control == "edit_campo_alumnos"){
        $idCampo = Input::get('idCarrera');
        $campo = Input::get('texto');
        $param = Input::get('param');
        
        $db->update("aa_campos_extras", $idCampo, ["campo"=>$campo]);       
        
    }


    //---------------------------------------------------------------------------------
        //INSCRIBIR ALUMNO A CARRERA
        if($control == "inscripcion_carreras"){
            $id_alumno = Input::get('id_alumno');
            $id_carrera = Input::get('id_carrera');

            $verificacion = $db->query("SELECT * FROM aa_inscripcion_carrera WHERE iduser = ? AND idalumno = ? AND idcarrera = ?", [$userId, $id_alumno, $id_carrera])->results();
            $verificacion = count($verificacion);

            if($verificacion == 0){
                $db->insert("aa_inscripcion_carrera", ["iduser"=>$userId, "idalumno"=>$id_alumno, "idcarrera"=>$id_carrera]);
                echo "0";
            }else{
                echo "1";
            }        
        }
        

         //---------------------------------------------------------------------------------
    //CREAR CAMPO ALUMNOS
    if($control == "add_campo_profesores"){
        $tabla = "profesores";
        $campo = Input::get('texto');
        
        $db->insert("aa_campos_extras", ["iduser"=>$userId, "tabla"=>$tabla, "campo"=>$campo]);
            //echo $campo->campo;
        
        }


        // ESTABLECER CORRELATIVAS
    if ($control == "send_correlativa") {
        $materia = Input::get('materia');
        $correlativa = Input::get('correlativa');
        $fields=array(
            'iduser' => $userId,
            'materia'=>$materia, 
            'correlativa'=>$correlativa
            );
        $db->insert('aa_correlativas',$fields);

        echo "Correlativa establecida con éxito";
    }

    //---------------------------------------------------------------------------------
    
    // ELIMINAR CORRELATIVAS
    if ($control == "delete_correlativa") {
        $id_correlativa = Input::get('id_correlativa');
        //$db->deleteById("aa_correlativas", $id_correlativa);
        $db->query("DELETE FROM aa_correlativas WHERE id = ?", [$id_correlativa]);
        //echo "Correlativa eliminada con éxito"; 
        echo "Id correlativa: ".$id_correlativa . "<br>" . "Control: " . $control; 
    }

    //---------------------------------------------------------------------------------
        //EDITAR NOTAS CONDICIONES
        if($control == "update_condiciones"){
            $id = Input::get('id');
            $cellValue = Input::get('cellValue');
            
            $db->update("aa_condiciones", $id, ["nota"=>$cellValue]);       
            
        }

        //---------------------------------------------------------------------------------
        //EDITAR NOMBRE DE CONDICIONES
        if($control == "update_condiciones_name"){
            $id = Input::get('id');
            $cellValue = Input::get('cellValue');
            
            $db->update("aa_condiciones", $id, ["condicion"=>$cellValue]);       
            
        }

        //AGREGAR NUEVA CONDICION
        if($control == "new_condicion"){
            $nota = Input::get('idCarrera');
            $texto = Input::get('texto');
            
            $db->insert("aa_condiciones", ["iduser"=>$userId, "condicion"=>$texto, "nota"=>$nota]);     
            
        }

        //---------------------------------------------------------------------------------
        //EDITAR TABLA DE CUATRIMESTRES
        if($control == "update_cuatrimestres"){
            $id = Input::get('id');
            $col = Input::get('col');
            $cellValue = Input::get('cellValue');
            
            if ($col == "cuat1") {
                $db->query("UPDATE aa_cuatrimestres SET cuat1='$cellValue' WHERE id = $id");
            }elseif ($col == "cuat2") {
                $db->query("UPDATE aa_cuatrimestres SET cuat2='$cellValue' WHERE id = $id");
            }elseif ($col == "recup") {
                $db->query("UPDATE aa_cuatrimestres SET recup='$cellValue' WHERE id = $id");
            }elseif ($col == "sinfinal") {
                $db->query("UPDATE aa_cuatrimestres SET sinfinal='$cellValue' WHERE id = $id");
            }elseif ($col == "fechacuat1"){
                $db->query("UPDATE aa_cuatrimestres SET fechacuat1='$cellValue' WHERE id = $id");
            }elseif ($col == "fechacuat2"){
                $db->query("UPDATE aa_cuatrimestres SET fechacuat2='$cellValue' WHERE id = $id");
            }elseif ($col == "fecharecup"){
                $db->query("UPDATE aa_cuatrimestres SET fecharecup='$cellValue' WHERE id = $id");
            }
            
        }


        //---------------------------------------------------------------------------------
        //ACTUALIZAR EL PROFESOR EN LA TABLA CUATRIMESTRES
        if($control == "update_profesor_cuatri"){
            $idProfe = Input::get('idProfe');
            $id = Input::get('id');
            
            if($idProfe != ""){
                $db->query("UPDATE aa_cuatrimestres SET docente='$idProfe' WHERE id = $id");
            }     
            
        }

         //---------------------------------------------------------------------------------
        //ACTUALIZAR CONDICION EN LA TABLA CUATRIMESTRES
        if($control == "update_condicion_cuatri"){
            $idCondicion = Input::get('idCondicion');
            $id = Input::get('id');
            
            if($idCondicion != ""){
                $db->query("UPDATE aa_cuatrimestres SET condicion='$idCondicion' WHERE id = $id");
            }     
            
        }


        //---------------------------------------------------------------------------------
        //EDITAR TABLA DE ACREDITACION
        if($control == "update_acreditacion"){
            $id = Input::get('id');
            $col = Input::get('col');
            $cellValue = Input::get('cellValue');
            
            if ($col == "fecha") {
                $db->query("UPDATE aa_acreditacion SET fecha='$cellValue' WHERE id = $id");
            }elseif ($col == "escrito") {
                $db->query("UPDATE aa_acreditacion SET escrito='$cellValue' WHERE id = $id");
            }elseif ($col == "oral") {
                $db->query("UPDATE aa_acreditacion SET oral='$cellValue' WHERE id = $id");
            }elseif ($col == "final") {
                $db->query("UPDATE aa_acreditacion SET final='$cellValue' WHERE id = $id");
            }elseif ($col == "libro"){
                $db->query("UPDATE aa_acreditacion SET libro='$cellValue' WHERE id = $id");
            }elseif ($col == "folio"){
                $db->query("UPDATE aa_acreditacion SET folio='$cellValue' WHERE id = $id");
            }elseif ($col == "institucion"){
                $db->query("UPDATE aa_acreditacion SET institucion='$cellValue' WHERE id = $id");
            }
            
        }


        //EDITAR ALUMNO -------------------------------------------------------------------------
        if($control == "edit_alumno"){

            $idAlumno = Input::get('idAlumno');
            $Nombre = Input::get('Nombre');
            $Apellido = Input::get('Apellido');
            $Dni = Input::get('Dni');
            $Fecha_Nac = Input::get('Fecha_Nac');
            $Ciudad_Origen = Input::get('Ciudad_Origen');
            $Ciudad_Residencia = Input::get('Ciudad_Residencia');
            $Direccion = Input::get('Direccion');
            $CP = Input::get('CP');
            $Telefono = Input::get('Telefono');
            $Telefono_Contacto = Input::get('Telefono_Contacto');
            $Vinculo = Input::get('Vinculo');
            $Email = Input::get('email');
            $Datos_Adicionales = Input::get('Datos_Adicionales');

        $db->query("UPDATE aa_alumnos SET 
        Nombre = '$Nombre',
        Apellido = '$Apellido',
        Dni = '$Dni',
        Fecha_Nacimiento = '$Fecha_Nac',
        Ciudad_Origen = '$Ciudad_Origen',
        Ciudad_Residencia = '$Ciudad_Residencia',
        Direccion = '$Direccion',
        CP = '$CP',
        Telefono = '$Telefono',
        Telefono_Contacto = '$Telefono_Contacto',
        Vinculo = '$Vinculo',
        Email = '$Email', 
        Datos_Adicionales = '$Datos_Adicionales' 
        WHERE id = $idAlumno AND iduser = $userId");
        
        Redirect::to("../php/alumno_ficha.php?idAlumno=".$idAlumno);
        }


        //edit_profesor
        if($control == "edit_profesor"){

            $idProfe = Input::get('idProfe');
            $Dni = Input::get('Dni');
            $Fecha_Nac = Input::get('Fecha_Nac');
            $Ciudad_Origen = Input::get('Ciudad_Origen');
            $Ciudad_Residencia = Input::get('Ciudad_Residencia');
            $Direccion = Input::get('Direccion');
            $CP = Input::get('CP');
            $Telefono = Input::get('Telefono');
            $Telefono_Contacto = Input::get('Telefono_Contacto');
            $Vinculo = Input::get('Vinculo');
            $Email = Input::get('email');
            $Datos_Adicionales = Input::get('Datos_Adicionales');

        $db->query("UPDATE aa_profesores SET Dni = '$Dni',
        Fecha_Nacimiento = '$Fecha_Nac',
        Ciudad_Origen = '$Ciudad_Origen',
        Ciudad_Residencia = '$Ciudad_Residencia',
        Direccion = '$Direccion',
        CP = '$CP',
        Telefono = '$Telefono',
        Telefono_Contacto = '$Telefono_Contacto',
        Vinculo = '$Vinculo',
        Email = '$Email', 
        Datos_Adicionales = '$Datos_Adicionales' 
        WHERE id = $idProfe AND iduser = $userId");
        
        Redirect::to("../php/profesor_ficha.php?idProfe=".$idProfe);
        }


}//Fin Input Exists
?>