<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;

if (Input::exists()) {   
    $control = Input::get('control');

    // OBTENER TODOS LOS AÑOS DE UNA CARRERA
    if ($control == "get_anios") {
        $idCarrera = Input::get('idCarrera');
        $query = $db->query("SELECT DISTINCT anio FROM aa_materias WHERE carrera = ? AND iduser = ?", [$idCarrera,$userId])->results();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    // OBTENER LAS MATERIAS DE UNA CARRERA Y UN AÑO DETERMINADO
    if ($control == "get_materias") {
        $idCarrera = Input::get('idCarrera');
        $anio = Input::get('anio');
        $query = $db->query("SELECT id, materia FROM aa_materias WHERE carrera = ? AND anio = ? AND iduser = ? ORDER BY id ASC", [$idCarrera,$anio,$userId])->results();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    // OBTENER LAS CONDICIONES DE LAS MATERIAS
    if ($control == "get_condiciones") {
        
        $query = $db->query("SELECT * FROM aa_condiciones WHERE iduser = ?",[$userId])->results();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    

    // OBTENER LOS CUATRIMESTRES DE UN ALUMNO DETERMINADO
    if ($control == "get_cuatrimestres") {
        $idAlumno = Input::get('idAlumno');
        $query = $db->query("SELECT aa_cuatrimestres.id, 
        COALESCE(aa_profesores.Apellido, '') as profes, 
        COALESCE(aa_cuatrimestres.fecha, '1970-01-01') AS fecha, 
        aa_condiciones.condicion, 
        aa_materias.materia, 
        aa_cuatrimestres.division, 
        aa_carreras.carrera, 
        CONCAT(COALESCE(aa_profesores.Apellido, ''), ', ', COALESCE(aa_profesores.Nombre, '')) AS profesor, 
        COALESCE(aa_cuatrimestres.fechacuat1, '1970-01-01') AS fechacuat1, 
        aa_cuatrimestres.cuat1, 
        COALESCE(aa_cuatrimestres.fechacuat2, '1970-01-01') AS fechacuat2, 
        aa_cuatrimestres.cuat2, 
        COALESCE(aa_cuatrimestres.fecharecup, '1970-01-01') AS fecharecup, 
        aa_cuatrimestres.recup, 
        aa_cuatrimestres.sinfinal
 FROM aa_cuatrimestres
 LEFT JOIN aa_condiciones ON aa_cuatrimestres.condicion = aa_condiciones.id
 LEFT JOIN aa_materias ON aa_cuatrimestres.materia = aa_materias.id
 LEFT JOIN aa_carreras ON aa_cuatrimestres.carrera = aa_carreras.id
 LEFT JOIN aa_profesores ON aa_cuatrimestres.docente = aa_profesores.id
 WHERE aa_cuatrimestres.alumno = ?
   AND aa_cuatrimestres.iduser = ?", [$idAlumno,$userId])->results();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    // OBTENER LA TABLA ACREDITACION DE UN ALUMNO DETERMINADO
    if ($control == "get_acreditacion") {
        $idAlumno = Input::get('idAlumno');
        
        $query = $db->query("SELECT aa_acreditacion.id, aa_acreditacion.fecha, aa_materias.materia, aa_acreditacion.escrito, aa_acreditacion.oral, aa_acreditacion.final, aa_acreditacion.libro, aa_acreditacion.folio, aa_acreditacion.institucion
        FROM aa_acreditacion, aa_materias
        WHERE aa_acreditacion.alumno = ? AND aa_acreditacion.iduser = ? AND aa_acreditacion.materia = aa_materias.id ", [$idAlumno,$userId])->results();
        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }


    // OBTENER EL PROFESOR PARA LA FICHA DE PROFESOR
    if ($control == "get_profe") {
        $idProfe = Input::get('idProfe');

        $datos_profesor = $db->query("SELECT * FROM aa_profesores WHERE id = ?",[$userId])->results();
        $datos_extras = $db->query("SELECT * FROM aa_campos_profesores WHERE idProfesor = ? AND iduser = ?", [$idProfe,$userId])->results();

        //Unir los dos arrays
        $all_data = array_merge($datos_profesor, $datos_extras);

        //header('Content-Type: application/json');
        echo json_encode($all_data, JSON_UNESCAPED_UNICODE);
    }


    // OBTENER LAS CARRERAS A LAS QUE ESTA INSCRIPTO UN ALUMNO DETERMINADO
    if ($control == "tabla_incripcion") {
        $id_alumno = Input::get('id_alumno');

        $query = $db->query("SELECT aa_carreras.id ,aa_carreras.carrera
        FROM aa_carreras, aa_inscripcion_carrera
        WHERE aa_inscripcion_carrera.idalumno = ? AND aa_inscripcion_carrera.iduser = ? AND aa_inscripcion_carrera.idcarrera = aa_carreras.id",[$id_alumno,$userId])->results();

        header('Content-Type: application/json');
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

    // OBTENER LAS CARRERAS A LA QUE ESTA APUNTADO UN ALUMNO DETERMINADO
    if ($control == "carreras_apuntado") {
        $id_alumno = Input::get('id_alumno');
        $query = $db->query("SELECT aa_carreras.id, aa_carreras.carrera
        FROM aa_inscripcion_carrera, aa_carreras
        WHERE aa_inscripcion_carrera.iduser = ? AND aa_inscripcion_carrera.idalumno = ? AND aa_inscripcion_carrera.idcarrera = aa_carreras.id",[$userId,$id_alumno])->results();
        //header('Content-Type: application/json');      
        echo json_encode($query, JSON_UNESCAPED_UNICODE);
    }

}

?>