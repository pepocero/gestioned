//AL CARGAR LA PAGINA
$(document).ready(function() {
  $('#select_anios').prop('disabled', true);
  $('#selectCarrera').prop('disabled', true);
  $('#tabla_materias').hide();
});

// AL SELECCIONAR UNA FECHA  ------------------------------------------------------------------------
$("#fechaInscripcion").on("change", function(e) {
  e.preventDefault();
  $('#sendFecha').val(this.value);  
  $('#selectCarrera').prop('disabled', false);
});

  // SELECT CARRERA  ---------------------------------------------------------------------------------------------------------------

$("#selectCarrera").change(function(){
  var idCarrera = this.value;
  //alert(idCarrera);
  $("#sendCarrera").val(idCarrera);
  $('#select_anios').prop('disabled', false);

  $('#select_anios').empty(); // Eliminar todas las opciones existentes
  let selectAnios = $('#select_anios');

  if (idCarrera !== '') {
      selectAnios.prop('disabled', true); // Deshabilitar select hasta que se carguen las materias
      selectAnios.html('<option value="">Cargando...</option>');

      //RELLENO EL SELECT DE AÑOS CON UNA LLAMADA AJAX
      $.ajax({
      url:'../ajax/ajax.php',
      method:'POST',
      data: {control:"get_anios", idCarrera:idCarrera},
      success:function(data){    
        console.log(data);                
        var select = $('#select_anios');
        if(data == ''){
          selectAnios.html('<option value="">No hay materias cargadas</option>');
        }else{
        selectAnios.html('<option value="">Selecciona un año</option>');
        $.each(data, function(key, value) {
            select.append('<option value="' + value.anio + '">' + value.anio + '</option>');
        });
        select.selectedIndex = 0;
        selectAnios.prop('disabled', false); // Habilitar select una vez cargadas
      }
    },
      error: function(xhr, status, error) {
          console.error(error);
      }   
    
    });//fin ajax  
  }
});

//ACCION AL SELECCIONAR EL AÑO
$("#select_anios").change(function(){
  var anio = this.value;
  var idCarrera = $("#selectCarrera").val();
  
  $.ajax({
    url:'../ajax/ajax.php',
    method:'POST',
    data: {control:"get_materias", idCarrera:idCarrera,anio:anio},
    success:function(data){    
      console.log(data); 
      $('#tabla_materias').show();
      table.setData(data);               
      
    },
    error: function(xhr, status, error) {
          console.error(error);
    }   
  });//fin ajax 
});

 

//ACCION DEL BOTON btn_clear
  $("#btn_clear").click(function(){
    $('#selectCarrera').prop('disabled', true);
    $('#select_anios').prop('disabled', true);
    
    $('#selectCarrera').prop('selectedIndex',0);
    $('#select_anios').prop('selectedIndex',0);
    $('#sendFecha').val('');
    $('#sendCarrera').val('');
    $('#sendMateria').val('');
    $('#fechaInscripcion').val('');
    $('#tabla_materias').hide();
  });
  
  
//Build Tabulator
var table = new Tabulator("#tabla_materias", {
  layout:"fitColumns",
  minWidth:550,
  placeholder:"No Data Set",
  columns:[
    {formatter:"rowSelection", titleFormatter:"rowSelection", width:50,hozAlign:"center", headerSort:false, cellClick:function(e, cell){
      cell.getRow().toggleSelect();
    }},
    {title:"Materia", field:"materia", formatter:"html"},    
  ],
});

//ACCION BOTON btn_apuntar_alumno
$("#btn_apuntar_alumno").click(function(){
  var selectedData = JSON.stringify(table.getSelectedData());
  
  if(selectedData == '[]'){
    sweetAlert("Atención", "No se ha seleccionado ninguna materia", "error");
    //alert("No se ha seleccionado ninguna materia");
  }else{
    $('#sendMateria').val(selectedData);
    $('#form_inscripcion').submit();
  }
});


