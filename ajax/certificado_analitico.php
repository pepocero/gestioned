<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
//require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}

$userId = $user->data()->id;



$id = $_POST["idAlumno"];
$carrera = $_POST["id_carrera"];

// echo "ID: ".$id;
// echo "<br>CARRERA: ".$carrera;


$datos = $db->query("SELECT *
FROM aa_alumnos
WHERE aa_alumnos.id = ? AND aa_alumnos.iduser = ?", [$id,$userId])->results();

if(!empty($datos)){
    foreach ($datos as $key) {
      $nombreApellido = "$key->Nombre" . ", ". $key->Apellido;
      $dni = $key->Dni;
      $Direccion = $key->Direccion;
      /*
      $c_nacimiento = $key->c_nacimiento;
      $c_residencia = $key->c_residencia;
      $fechanac = $key->fecha_nac;
      $anio = date("Y", strtotime($fechanac));
      $dia = date("d", strtotime($fechanac));
      $mes = date("m", strtotime($fechanac));
      switch($mes){
        case 1: $mes="Enero"; break;
        case 2: $mes="Febrero"; break;
        case 3: $mes="Marzo"; break;
        case 4: $mes="Abril"; break;
        case 5: $mes="Mayo"; break;
        case 6: $mes="Junio"; break;
        case 7: $mes="Julio"; break;
        case 8: $mes="Agosto"; break;
        case 9: $mes="Septiembre"; break;
        case 10: $mes="Octubre"; break;
        case 11: $mes="Noviembre"; break;
        case 12: $mes="Diciembre"; break;
     }
    */
    }
}
 $datos_extras = $db->query("SELECT * 
                              FROM aa_campos_alumnos
                              WHERE aa_campos_alumnos.idAlumno = ? AND aa_campos_alumnos.iduser = ?", [$id,$userId])->results();

//echo json_encode($datos_extras);

// $query = $db->query("SELECT aa_acreditacion.fecha, aa_materias.materia, aa_acreditacion.final 
// FROM aa_acreditacion, aa_materias, aa_carreras 
// WHERE aa_acreditacion.alumno = ? AND aa_acreditacion.materia = aa_materias.id AND aa_carreras.id = ? ", [$id, $carrera])->results();


$nombreCarrera = $db->query("SELECT carrera FROM aa_carreras WHERE id = ? AND iduser = ?", [$carrera, $userId])->results();
$carname = $db->results()[0]->carrera;

/*foreach ($nombreCarrera as $data) {
  $carname = $data->carrera;
}*/


$cantidadAnios = $db->query("SELECT DISTINCT aa_materias.anio 
FROM aa_materias 
WHERE aa_materias.carrera = ?", [$carrera])->results();




?>

<link href="../css/custom.css" rel="stylesheet">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

<style>
  @media print {
    /* Aquí irían tus reglas CSS específicas para imprimir */
    body { 
      font-size: 10pt;
      font-family: Arial, Helvetica, sans-serif;
    }
} 

</style>


<div class="container">


  <div class="row row-cols-3"> <!-- FILA -->
    <div class="col-2"><img src="../images/logo_black.png" class="float-start" style="height: 130px"></div>

    <div class="col-7 position-relative">
      
        <!-- <span class="position-absolute top-50 start-50 translate-middle" style="font-size: 10px;"> 
          PROVINCIA DE BUENOS AIRES<br>
          DIRECCIÓN GENERAL DE CULTURA Y EDUCACIÓN<br>
          DIRECCION DE EDUCACION ARTISTICA 
        </span> -->
      
    </div>

    <div class="col-3 position-relative">
      <img src="../images/logo_pcia.jpg" class="float-end position-absolute top-50 start-50 translate-middle" style="width: 150px">
    </div>
  </div> <!-- FIN FILA -->

<!-- <div class="col"><p class="text-center" style="font-size: 10px;">ESCUELA DE TEATRO DE BAHÍA BLANCA</p></div> -->
<hr/>

<!-- <div style="height: 7rem;"></div> -->

<div class="col"> <p class="text-center fw-bold" style="font-size: 30px;">CERTIFICADO ANALITICO</p> </div>

<div class="col">
  
  <p class="">
          <br>
          <br>

          La Dirección de la Escuela de Teatro C.U.E N 0614558-00 certifica que <strong><?php echo $nombreApellido; ?> con </strong> DNI: <?php echo $dni; ?> y domicilio en <?php echo $Direccion; ?>, y 
        <?php
          foreach($datos_extras as $data){
              echo "<strong>".$data->campo . "</strong>: " . $data->dato . " , ";
          }
        ?>
          aprobó las materias de la carrera <b><i><?php echo $carname; ?></i> </b> que, con sus respectivas notas, abajo se expresan:
  </p> 

</div>


<div class="col">
  
  <table class="table">
  <?php 
        foreach ($cantidadAnios as $value) { 
              $anios = $value->anio;
              //aca cuento la cantidad de materias de la carrera en ese año
              $cantMaterias = $db->query("SELECT * 
                                          FROM aa_materias
                                          WHERE aa_materias.carrera = ?  AND aa_materias.anio = ?", [$carrera, $anios])->results();
              $cantmat = $db->count();

              // Ahora teniendo la cantidad de materias que tiene cada año, tendria que ver cuales estan aprobadas (matap)
              $matap = $db->query("SELECT aa_acreditacion.final 
              FROM aa_acreditacion, aa_materias, aa_carreras
              WHERE alumno = ? AND final >= 4 AND aa_acreditacion.materia = aa_materias.id AND aa_materias.carrera = aa_carreras.id AND aa_carreras.id = ? AND aa_materias.anio = ?", [$id,$carrera,$anios])->results();

              $cantmatap = $db->count();
              
          ?>
          
           <tr>
             <td colspan="6" class="text-center border"> <center><b>AÑO: <?php echo $anios; ?></b></center></td>
           </tr>


          <tr>
            
            <td><b>Condición</b></td>
            <td><b>Libro</b></td>  
            <td><b>Folio</b></td>
            <td><b>Fecha</b></td>
            <td><b>Materia</b></td>
            <td><b>Calificación</b></td>  
                     
          </tr>

           
          <?php  



            $todas_las_materias = $db->query("SELECT aa_materias.id, aa_materias.materia
                                              FROM aa_materias
                                              WHERE aa_materias.carrera = ? AND aa_materias.anio = ?  
                                              ORDER BY aa_materias.materia ASC", [$carrera, $anios])->results();




            $notas = $db->query("SELECT aa_acreditacion.fecha, aa_materias.id AS idmateria, aa_materias.materia, aa_acreditacion.final, aa_acreditacion.libro, aa_acreditacion.folio, aa_condiciones.condicion
            FROM aa_acreditacion, aa_materias, aa_carreras, aa_cuatrimestres, aa_condiciones
            WHERE aa_acreditacion.alumno = ? AND aa_cuatrimestres.alumno = ? AND aa_carreras.id = ? AND aa_materias.anio = $anios AND aa_acreditacion.materia = aa_materias.id AND aa_materias.carrera = aa_carreras.id AND aa_cuatrimestres.condicion = aa_condiciones.id AND aa_cuatrimestres.materia = aa_materias.id 
            ORDER BY aa_materias.materia ASC", [$id, $id, $carrera])->results();



/*Esto muestra los elementos de cada array que coinciden:*/
$result1= array_intersect_key($notas,$todas_las_materias);

//Esto muestra los elementos que difieren en los dos arrays:
$result2=array_diff_key($todas_las_materias,$notas);



foreach($result1 as $record){
  $fecha = date("d-m-Y", strtotime($record->fecha));
  if($fecha == "01-01-1970"){
    $fecha = "---";
  }else{
    $fecha = $fecha;
  }
    echo "<tr>";
      echo "<td>$record->condicion </td>";
      echo "<td>$record->libro  </td>";
      echo "<td> $record->folio </td>";
      echo "<td> $fecha </td>";
      echo "<td> $record->materia </td>";
      echo "<td> $record->final </td>";
    echo "<tr>";
}

foreach($result2 as $record2){
  echo "<tr>";
    echo "<td> --- </td>";
    echo "<td> --- </td>";
    echo "<td> --- </td>";
    echo "<td> --- </td>";
    echo "<td> $record2->materia </td>";
    echo "<td> --- </td>";
  echo "<tr>";
}
  
 
  ?>  



           

           <tr>
           <td colspan="6" class="text-center"><?php 
                        if($cantmat == $cantmatap){
                          echo "Año ".$anios." completo";
                        }else{
                          echo "Año ".$anios." incompleto";
                        }
              ?> </td>
            </tr> 


          <?php } ?> <!-- Fin Froeach cantidad de anios -->


</table>

<br>




<!-- ESTO CALCULA EL PORCENTAJE DE LA CARRERA APROBADA ------------------------------------------------------------------->
<?php
$matCarreras = $db->query("SELECT materia FROM aa_materias WHERE carrera = ?", [$carrera])->results();
$cantMatCar = $db->count();

$matAprobCarrera = $db->query("SELECT aa_acreditacion.final 
FROM aa_acreditacion, aa_materias, aa_carreras
WHERE alumno = ? AND final >= 4 AND aa_acreditacion.materia = aa_materias.id AND aa_materias.carrera = aa_carreras.id AND aa_carreras.id = ?", [$id,$carrera])->results();

$cantMatAprob = $db->count();

$porcentCarrera = round(($cantMatAprob * 100) / $cantMatCar);

//Aca hago esto para calcular el promedio de la carrera
$notasMaterias = $db->query("SELECT COALESCE(aa_acreditacion.final, 0) AS final 
FROM aa_materias 
LEFT JOIN aa_acreditacion ON aa_materias.id = aa_acreditacion.materia AND aa_acreditacion.alumno = ?  
WHERE aa_materias.carrera = ?", [$id,$carrera])->results();

$cantidadMaterias = $db->count();

$promedio = 0;
foreach($notasMaterias as $rec){
  
  $promedio = $promedio + $rec->final;
}
$promedio = $promedio / $cantidadMaterias;
$promedio = number_format($promedio, 2, '.', '');

?>

<div class="container col d-flex justify-content-center">
  <p class="text-center">Porcentaje de la carrera aprobada: <?php echo "$porcentCarrera %"; ?></p>  
</div>

<div class="container col d-flex justify-content-center">
  <p class="text-center">Promedio: <?php echo "$promedio"; ?></p>
</div>
<!-- ----------------------------------------------------------------------------------------------------------------- -->


<br><br><br> <br> 


<div class="container col d-flex justify-content-center">

<p class="text-center">En fe de lo cual, se extiende el presente certificado, correspondiende a <?php echo "$nombreApellido"; ?>, sin raspaduras ni enmiendas, en la ciudad de Bahía Blanca 
        a los&nbsp; <?php echo date("d");?> días del mes de 
          <?php setlocale(LC_TIME, "spanish");
          echo strftime("%B");?> de <?php echo strftime("%Y");?> para ser presentado ante quien corresponda.
</p>

</div>


<!-- LINEA DE SELLO Y FIRMA -->
<!-- <div class="row row-cols-3" style="height: 30rem;">
  <div class="col text-center">
    <img src="../images/Sello.jpg" class="float-center" style="width: 150px">
    <p>Sello del Establecimiento</p>
  </div>

  <div class="col-4"></div>

  <div class="col text-center">
    <img src="../images/FirmaCangelosi.jpg" class="float-center" style="width: 150px">
        
        <p>Firma y sello aclaratorio del Director/Secretario</p>  
            
  </div>



</div> -->

<!--  <a href="../php/certificados_analitico.php" class="btn btn-info fixed-bottom d-print-none col-md-1">Volver</a> -->

<div class="fixed-bottom col d-flex justify-content-center">
  <!-- <a href="../php/certificados_analitico.php" class="col btn btn-info d-print-none fw-bold">Volver a "Certificados Analiticos"</a>   -->
  <?php echo "<a href='../php/alumno_ficha.php?idAlumno=$id' class='col btn btn-warning d-print-none fw-bold'>Volver a la Ficha de ".strtoupper($nombreApellido)." </a>"; ?>
  <a href="../php/inicio.php" class="col btn btn-primary d-print-none fw-bold">INICIO</a> 
</div>



<br><br><br> <br> 


<div class="container d-print-none col d-flex justify-content-center">  
  <button class="btn btn-primary col-md-4" onclick="window.print()">Imprimir</button>
</div>

<div class="d-print-none" style="height: 35rem;"></div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>





