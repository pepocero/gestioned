<?php
require_once($abs_us_root.$us_url_root.'users/includes/template/header1_must_include.php');
require_once($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/assets/fonts/glyphicons.php');
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/fonts/glyphicons.css">
<!-- CSS BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- CSS SWEETALERT2 -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">

<link href="<?=$us_url_root?>users/css/datatables.css" rel="stylesheet">
<link href="<?=$us_url_root?>users/css/menu.css" rel="stylesheet">
<script src="<?= $us_url_root?>users/js/menu.js"></script>
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/fontawesome.min.css">
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/brands.min.css">
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/solid.min.css">
<link rel="stylesheet" href="<?=$us_url_root?>users/fonts/css/v4-shims.min.css">
<!-- CSS TABULATOR -->
<link href="https://unpkg.com/tabulator-tables/dist/css/tabulator.min.css" rel="stylesheet">
<!-- Animate -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<!-- CUSTOM CSS -->
<link href="<?= $us_url_root?>css/custom.css" rel="stylesheet">

<!-- LETRAS DE GOOGLE FONTS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">


<!-- L U X O N -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/luxon/3.3.0/luxon.min.js" integrity="sha512-KKbQg5o92MwtJKR9sfm/HkREzfyzNMiKPIQ7i7SZOxwEdiNCm4Svayn2DBq7MKEdrqPJUOSIpy1v6PpFlCQ0YA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<?php
require_once $abs_us_root . $us_url_root . "users/js/jquery.php";
?>
<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- BOOTSTRAP -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- TABULATOR -->
<script type="text/javascript" src="https://unpkg.com/tabulator-tables/dist/js/tabulator.min.js"></script>
<!-- SWEETALERT -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.all.min.js"></script>
<?php
if(file_exists($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'/assets/css/style.css')){?>
  <link href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>/assets/css/style.css" rel="stylesheet">
<?php }
if(file_exists($abs_us_root.$us_url_root.'usersc/templates/'.$settings->template.'.css')){?>
  <link href="<?=$us_url_root?>usersc/templates/<?=$settings->template?>.css" rel="stylesheet">
<?php } ?>

</head>
<body class="d-flex flex-column min-vh-100">
<?php require_once($abs_us_root.$us_url_root.'users/includes/template/header3_must_include.php'); ?>

<!-- CUSTOM SWEETALERT -->
<script src="<?=$us_url_root?>js/sweetalert.js"></script>

<!-- FUNCION PARA LAS TILDES EN JAVASCRIPT -->
<script src="<?=$us_url_root?>js/tildes.js"></script>

<!-- ESTO ES PARA DECODIFICAR LOS ACENTOS ES UN PLUGIN -->
<script src="https://unpkg.com/he/he.js"></script>


<!-- ESTE CODIGO ES PARA DARLE FORMATO AL EDITOR DE TEXTO QUILLJS -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
