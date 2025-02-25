<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;


if(isset($_POST['image'])){

	$data = $_POST['image'];	
    $id = $_POST['id'];
	$control = $_POST['control'];

	$image_array_1 = explode(";", $data);	

	$image_array_2 = explode(",", $image_array_1[1]);

	$data = base64_decode($image_array_2[1]);

	$image_name = '../images/profiles/' . time() . '.png';

   

	file_put_contents($image_name, $data);
 
  //Dependiendo del valor de control se actualiza la tabla de alumnos o de profesores
  if ($control == 'edit_alumno'){
  	$db->query("UPDATE aa_alumnos SET imagen = '$image_name' WHERE id = $id AND iduser = $userId");

  }elseif ($control == 'edit_profesor'){
  	$db->query("UPDATE aa_profesores SET imagen = '$image_name' WHERE id = $id AND iduser = $userId");
  }

  //Esto imprime la ruta de la imagen, que es lo que aparece en data del javascript
	echo $image_name;
}

?>
