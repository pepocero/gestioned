<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;
//echo "<br/>userId: ".$userId."<br/>";

if (Input::exists()) {   

    
$fecha = Input::get('sendFecha');
$id = Input::get('sendIdalumno');
$json = Input::get('sendMateria');
$carrera = Input::get('sendCarrera');
//$IdPre = Input::get('sendIdPre');
$condicionFoba = Input::get('sendCond');;
$profesor = NULL;
$fecha_acreditacion = '1970-01-01';

/*
echo "<br/>Fecha: ".$fecha."<br/>".
"Materia: ".$json."<br/>".
"Carrera: ".$carrera."<br/>".
"IdAlumno: ".$id."<br/>".
"Condicion: ".$condicionFoba."<br/>";
*/

//echo "<br>".$IdPre."<br>"; 

//Si el valor de IdPre es diferente de cero entonces quiere decir que viene con un valor determinado y es el que hay que eliminar
/*if ($IdPre != 0) {
	$db->deleteById("aa_preinscripcion", $IdPre);
}
*/
//$fecha = strtotime($fecha);

//$mat = 1;



$datosAlumno = $db->query("SELECT * FROM aa_alumnos WHERE id = ? AND iduser= ?", [$id,$userId])->results();

foreach ($datosAlumno as $key) {
	$nombreApellido = $key->Nombre.", ".$key->Apellido;
	$dni = $key->Dni;
	
}


echo"<a href='../php/inscripcion_materias.php?idAlumno=$id' class='btn btn-warning'><i class='fas fa-angle-double-left'></i>  Volver a la página de Inscripciones</a>
        <div class='alert alert-primary col-md-6 mx-auto' role='alert'>
            <h3 class='text-center'>$nombreApellido</h3>
        </div>";


// "Fecha: ".$fecha."<br/>".
// "Materia: ".$matName."<br/>".
// "Carrera: ".$carrera."<br/>";


echo "<center><h2>Comprobando correlativas...</h2></center>";

//$cursada = $db->query("SELECT * FROM aa_cuatrimestres WHERE materia = ? AND alumno = ?", [$mat,$id])->results();


//Esto cambia los tipos de comillas para que el Json de Javascript funcione en PHP
$json = str_replace('&quot;', '"', $json);
//Esto convierte el json en un array
$array_materias = json_decode($json);



function alerta ($materia, $alerta){	
    $materia = html_entity_decode($materia);

	if ($alerta == "inscripto") {
		echo "	<center>
					<div class='alert alert-danger col-md-6' role='alert'>
						<h3>Ya está inscripto a la materia: $materia</h3>		
					</div>
				</center>";
	}elseif($alerta == "inscribir") {
		echo "	<center>
					<div class='alert alert-primary col-md-6' role='alert'>
						<h3>Se ha inscripto a la materia: $materia</h3>						
					</div>
				</center>";

	}elseif($alerta == "aprobada") {
		echo "	<center>
					<div class='alert alert-primary col-md-6' role='alert'>
						<h3>Tiene aprobadas todas las correlativas. Se procede a inscribir a la materia $materia</h3>
					</div>
				</center>";
	}elseif($alerta == "desaprobada") {		

				
				echo	"<center>
							<div class='alert alert-danger col-md-6' role='alert'>
								<br/><h3> $materia </h3>
									<h4>No tiene aprobadas todas las correlativas</h4>				
							</div>
						</center>";
	}
}





//ESTE FOREACH RECORRE EL ARRAY DE MATERIAS
foreach ($array_materias as $mat) {
		
			$id_materia = $mat->id;
			$matName = $mat->materia;
			//echo $mat->materia;

			

			//Con esta consulta obtengo las materias a las que esta inscripto. Hago esta consulta asi obtengo los nombres de las materias
			$cursada = $db->query("SELECT aa_cuatrimestres.materia AS id, aa_materias.materia
									FROM aa_cuatrimestres, aa_materias
									WHERE aa_cuatrimestres.materia = ? AND aa_cuatrimestres.alumno = ? AND aa_cuatrimestres.materia = aa_materias.id AND aa_cuatrimestres.iduser = ?", [$id_materia,$id,$userId])->results();
			
			//Si la consulta NO esta vacía, quiere decir que hay materias en las que esta inscripto. Así que recorro cada elemento de la consulta cursada y le imprimo el mensaje de que ya está apuntado
			if (!empty($cursada)) {		
				foreach($cursada as $val) {
					
					alerta ($val->materia,"inscripto");
				}
				
			}elseif($condicionFoba == 8){
				//Aca mira si la condicion es 8 entonces lo apunta directamente
				//ACA SE INSCRIBE
					alerta ($matName,"inscribir");
					
					//ACA SE INSCRIBE A LAS MATERIAS:		
		$db->insert("aa_cuatrimestres", ["iduser"=>$userId, "fecha"=>$fecha, "alumno"=>$id, "materia"=>$id_materia, "carrera"=>$carrera, "docente"=>$profesor]);

					//ACA SE RELLENA LA TABLA ACREDITACION
		$db->insert("aa_acreditacion", ["iduser"=>$userId, "fecha"=>$fecha_acreditacion, "alumno"=>$id, "materia"=>$id_materia]);
				

			}else{
					// Si la consulta está vacia, quiere decir que no existe en la tabla de cuatrimestres, por lo tanto tengo el id de cada materia para ir apuntandolo...
					
	//ACA EMPIEZA LA COMPROBACION DE CORRELATIVAS

	$correlativa = $db->query("SELECT * FROM aa_correlativas WHERE materia = ? AND iduser = ? ", [$id_materia,$userId])->results();
	//Con el count sacamos la cantidad de correlativas
	$cantCorr = count($correlativa);
	//echo "<br/>Cantidad de correlativas: ".$cantCorr."<br/>";

	/* Si la cantidad de correlativas es 0 es porque no tiene correlativas, entonces lo inscribís */
	if ($cantCorr == 0) {

		//ACA LA MATERIA ES LA QUE VIENE DEL FOREACH DEL ARRAY DE MATERIAS ( $id_materia , $matName ), EL PRIMERO. NO ES EL FOREACH DE CURSADA!!!

		//ACA SE INSCRIBE
		alerta ($matName,"inscribir");
		//echo "<br/>ID Materia: ".$id_materia."<br/>";

		//ACA SE INSCRIBE A LAS MATERIAS:
		$db->insert("aa_cuatrimestres", ["iduser"=>$userId, "fecha"=>$fecha, "alumno"=>$id, "materia"=>$id_materia, "carrera"=>$carrera, "docente"=>$profesor]);
		

		//ACA SE RELLENA LA TABLA ACREDITACION
		$db->insert("aa_acreditacion", ["iduser"=>$userId, "fecha"=>$fecha_acreditacion, "alumno"=>$id, "materia"=>$id_materia]);

		


	//Si no es 0 es porque tiene algunas. Ahi hay que ver si las tiene todas aprobadas

	}else{
		$array = array();
		foreach ($correlativa as $value){
			
			$cor = $value->correlativa;		
			
			$cursed = $db->query("SELECT condicion, materia, cuat1,cuat2, recup FROM aa_cuatrimestres WHERE materia = ? AND alumno = ? AND iduser = ? ", [$cor,$id,$userId])->results();
				
			
				foreach ($cursed as $k){

					$condicion = $k->condicion;
					
						/* Aca si tiene correlativas , con la consulta de CADA correlativa vas comparando con el foreach si cada correlativa
						está aprobada. Para eso se mira si el cuat1 y el cuat2 tienen nota mayor de 4, si es asi, es porque tiene la cursada 
						de esa materia aprobada.
						*/
					//CORRECCIÓN: Aca la nota se la ponia en numeros, pero lo correcto es que la nota la saque de la tabla de condiciones: por ejemplo si es regular la condicion es uno y aprueba con 4, pero esa nota esta en la tabla condiciones, no vale con poner el 4 aqui....

					//Por consiguiente hago una consulta para obtener la nota en base a la condicion obtenida en $condicion:
					$nota_condicion = $db->query("SELECT nota FROM aa_condiciones WHERE id = ? AND iduser = ?", [$condicion,$userId])->results();
					$nota_condicion = $db->results()[0]->nota;
					
					//Segun las notas establecidas en la condicion, mira que tengas los cuatrimestres aprobados cuando la condicion es regular
					if ($condicion == 1 ) {	
						if ($k->cuat1 >= $nota_condicion && $k->cuat2 >= $nota_condicion){
							//En un array se guarda la materia correlativa
							array_push($array,$k->materia);
							//tambien se puede hacer asi: $array=array('materia'=>$k->materia, 'cuat1'=>$k->cuat1, 'cuat2'=>$k->cuat2); 
							
						
						}elseif ($k->cuat1 < $nota_condicion && $k->cuat2 < $nota_condicion && $k->recup >= $nota_condicion) {
							array_push($array,$k->materia);

						}elseif ($k->cuat1 < $nota_condicion && $k->cuat2 >= $nota_condicion && $k->recup >= $nota_condicion) {							
							array_push($array,$k->materia);

						}elseif ($k->cuat1 >= $nota_condicion && $k->cuat2 < $nota_condicion && $k->recup >= $nota_condicion) {
							array_push($array,$k->materia);
						}
					}else{
				$final = $db->query("SELECT final FROM aa_acreditacion WHERE materia = ? AND alumno = ? AND iduser = ?", [$cor,$id,$userId])->results();
				$final = $db->results()[0]->final;
				if ($final >= $nota_condicion){
					array_push($array,$k->materia);
				}
				}
					
				}
			
		}
			//Contamos la cantidad de materias en el array. 
			$cantArray = count($array);
			
		/* Aca fuera del foreach comparas la cantidad de correlativas con la cantidad del array. Si hay tres correlativas 
		y el array tiene tres elementos quiere decir que las 3 materias las curso. 
		Y con el if anterior del $k obtenes si estan aprobadas o no.... o sea:*/
			
			if ($cantCorr == $cantArray) {				
				alerta ($matName,"aprobada");

				//ACA SE INSCRIBE A LAS MATERIAS:		
		$db->insert("aa_cuatrimestres", ["iduser"=>$userId, "fecha"=>$fecha, "alumno"=>$id, "materia"=>$id_materia, "carrera"=>$carrera, "docente"=>$profesor]);

		//ACA SE RELLENA LA TABLA ACREDITACION
		$db->insert("aa_acreditacion", ["iduser"=>$userId, "fecha"=>$fecha_acreditacion, "alumno"=>$id, "materia"=>$id_materia]);

			}else{
				alerta ($matName,"desaprobada");
				
			}
	}



}		
			
			
		} //FIN FOREACH ARRAY MATERIAS


}

?>

