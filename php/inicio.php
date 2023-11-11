<?php
require_once $_SERVER['DOCUMENT_ROOT']."/_root.php";
require_once $_SERVER['DOCUMENT_ROOT'].$root."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}


?>


<link rel="stylesheet" type="text/css" href="../css/inicio.css">
<!-- FONTAWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="container col d-flex justify-content-center">
  <p style="font-family: 'Anton', sans-serif; font-size: 3vw;">  </p>
</div>



<!-- --------------------------------------------------------------------------------------------------------------------------------
                                                ACCESOS DIRECTOS
-------------------------------------------------------------------------------------------------------------------------------- -->

<div class="container col d-flex justify-content-center">
  <p class="titulo"> Título personalizado</p>  
</div>

<div style="height: 1vw;"></div> 

<!-- 
    --accent-color: #68AFFF
    --accent-color: #FFA44B
    --accent-color: #EF6968
    --accent-color: #0ED2D1
    --accent-color: #c66fa7
    --accent-color: #ccb033
    --accent-color: #AF1111

 -->
  <ul class="ul-cards">

    <li style="--accent-color: #68AFFF">
      <div class="icon"><i class="fa-solid fa-graduation-cap"></i></div>
      <div class="title">CREAR CARRERAS</div>
      <div class="content">Para poder crear materias primero se debe crear la carrera que contendrá dicha materia.</div>
      <a href="crear_carrera.php" class="btn fw-bold" style="background-color: #68AFFF; color:#FFF;">ENTRAR</a>
    </li>

    <li style="--accent-color: #FFA44B">
      <div class="icon"><i class="fa-solid fa-book"></i></div>
      <div class="title">CREAR MATERIAS</div>
      <div class="content">Aquí podrás crear las materias correspondientes a cada carrera creada.</div>
      <a href="crear_materia.php" class="btn fw-bold" style="background-color: #FFA44B; color:#000;">ENTRAR</a>
    </li>

    <li style="--accent-color: #EF6968">
      <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
      <div class="title">INGRESO DE ALUMNOS</div>
      <div class="content">Crear campos personalizados e ingreso de alumnos.</div>
      <a href="alumnos_ingreso.php" class="btn fw-bold" style="background-color: #EF6968; color:#000;">ENTRAR</a>
    </li>

    <li style="--accent-color: #0ED2D1">
      <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
      <div class="title">VER FICHA ALUMNO</div>
      <div class="content">Aquí se pueden ver los Alumnos y su ficha de carreras y materias.</div>
      <a href="buscar_alumno.php" class="btn fw-bold" style="background-color: #0ED2D1; color:#000;">ENTRAR</a>
    </li>

    <li style="--accent-color: #c66fa7">
      <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
      <div class="title">INSCRIPCION A CARRERAS</div>
      <div class="content">Aquí se puede inscribir a los Alumnos a las carreras que desee.</div>
      <a href="inscripcion_carreras.php" class="btn fw-bold" style="background-color: #c66fa7; color:#000;">ENTRAR</a>
    </li>

    <li style="--accent-color: #1E2999">
      <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
      <div class="title">CORRELATIVAS</div>
      <div class="content">Aquí se establecen las correlatividades de las materias. </div>
      <a href="correlativas.php" class="btn fw-bold" style="background-color: #1E2999; color:#fff;">ENTRAR</a>
    </li>


    <li style="--accent-color: #1Eff99">
      <div class="icon"><i class="fa-solid fa-user-graduate"></i></div>
      <div class="title">INGRESO PROFESORES</div>
      <div class="content">Crear campos personalizados y resgistro de profesores. </div>
      <a href="profesores_ingreso.php" class="btn fw-bold" style="background-color: #1Eff99; color:#fff;">ENTRAR</a>
    </li>



    
    
  </ul>






<div style="height: 25rem;"></div>

