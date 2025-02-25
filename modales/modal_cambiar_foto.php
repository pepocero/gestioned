<?php
require_once $_SERVER['DOCUMENT_ROOT']."/folder.php";
require_once $_SERVER['DOCUMENT_ROOT'].$folder."/users/init.php";
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
if (!securePage($_SERVER['PHP_SELF'])){die();}
?>
<!-- Agrego el Cropper -->
<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />
<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>		
<script src="https://unpkg.com/cropperjs"></script>


<!-- MODAL PARA CAMBIAR FOTO DE PERFIL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Recortar imagen antes de subirla</h5>
			        		<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>	
<!-- FIN MODAL PARA CAMBIAR FOTO DE PERFIL -->

<script type="text/javascript" src="../js/photo.js"></script>