

// SCRIPTS PARA CAMBIAR LA FOTO DE PERFIL --------------------------------------------------------------------------------------



$(document).ready(function(){

    var $modal = $('#modal');
    
    var image = document.getElementById('sample_image');
    
    var cropper;
    let control;
    let id;
    
    $('#upload_image').change(function(event){
      var files = event.target.files;
      //aca se obtiene el valor del input control para saber si es alumno o profesor
      control = $('#control').val();

      if(control == 'edit_alumno'){
        id = idAlumno;
      }else if(control == 'edit_profesor'){
        id = idProfe;
      }
      
    
      var done = function(url){
        image.src = url;
        $modal.modal('show');
      };
    
      if(files && files.length > 0)
      {
        reader = new FileReader();
        reader.onload = function(event)
        {
          done(reader.result);
        };
        reader.readAsDataURL(files[0]);
      }
    });
    
    $modal.on('shown.bs.modal', function() {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview:'.preview'
      });
    }).on('hidden.bs.modal', function(){
      cropper.destroy();
         cropper = null;
    });
    
    //AQUI SE ESTABLECE EL TAMAÑO DE LA IMAGEN RECORTADA
    $('#crop').click(function(){
      canvas = cropper.getCroppedCanvas({
        width:200,
        height:200
      });
    
      canvas.toBlob(function(blob){
        url = URL.createObjectURL(blob);
        var reader = new FileReader();
        reader.readAsDataURL(blob);
        reader.onloadend = function(){
          var base64data = reader.result;
          $.ajax({
            url:'../ajax/cambiar_foto.php',
            method:'POST',
            data:{image:base64data,id:id,control:control},
            success:function(data)
            {
              $modal.modal('hide');
              $('#uploaded_image').attr('src', data);
              //alert(id);
            }
          });
        };
      });
    });
    
    });
