//ocultar un div al cargar la pagina
$( document ).ready(function() {
  $('#tabla').hide();
});

//TABLA CARRERAS
var tabla_carreras = new Tabulator("#tabla_carreras", {
  //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
  ajaxURL: "../ajax/get_carreras.php",
  //ajaxConfig:"POST", //ajax HTTP request type
  //ajaxParams: {id:id, control:"t_equi"},
  selectable:true, //make rows selectable
  selectableRows:true,
  selectableRangeMode:"click",  
  minHeight:250, //do not let table get smaller than 250 px heigh
  layout:"fitColumns",
  pagination:"local",
  paginationSize:10,
  paginationSizeSelector:[12, 24, 36, true],
  columns:[
      {title:"Carrera", field:"carrera", formatter:"html", width:400, headerFilter:"input"},
      
              
  ],
});


//TABLA TABULATOR BUSCAR ALUMNO-------------------------------------------------------
var tabla_alumnos = new Tabulator("#tabla_alumnos", {
  ajaxURL:"../ajax/ver_alumnos.php", //ajax URL
  minHeight:250, //do not let table get smaller than 250 px heigh
  layout:"fitColumns",
  selectable:true, //make rows selectable
  selectableRows:true,
  selectableRangeMode:"click",  
  pagination:"local",
  paginationSize:10,
  paginationSizeSelector:[15, 20, 30, 50, true],
  placeholder:"No hay datos para mostrar",   
  columns:[
    {title:"Apellido", field:"Apellido", headerFilter:"input"},
    {title:"Nombre", field:"Nombre", headerFilter:"input"},
    {title:"Dni", field:"Dni", headerFilter:"input"},
  ]
  
  });

  let id_carrera = 0;
  let id_alumno = 0;

  tabla_carreras.on("rowClick", function(e, row){
    //e - the click event object
    //row - row component
    id_carrera = row.getData().id;
    //alert(id_carrera);
});

tabla_alumnos.on("rowClick", function(e, row){
  //e - the click event object
  //row - row component
  id_alumno = row.getData().id;
  //alert(id_alumno);
  $.ajax({
    url:'../ajax/ajax.php',
    method:'POST',
    data: {control:"tabla_incripcion", id_alumno:id_alumno},
    success:function(data){
      $('#tabla').show();
      table.setData(data);      
    },
    error: function(xhr, status, error) {
          console.error(error);
    }   
  });//fin ajax
});


//listener del boton btn_apuntar_alumno
const btn_apuntar_alumno = document.getElementById('btn_apuntar_alumno');
btn_apuntar_alumno.addEventListener('click', function() {
  // Compruebo que se haya seleccionado un alumno
  if (id_alumno == 0 || id_carrera == 0){
    sweetAlert("Atención", "Debe seleccionar un alumno y una carrera", "warning")
  }else{
    //sweetAjaxSend(title, text, icon, urlAjax, ajaxParams);
    let ajaxParams = {control:"inscripcion_carreras", id_carrera:id_carrera, id_alumno:id_alumno};
    let sendCode = "if(data == 1){"+"sweetAlert('Atención', 'El alumno ya se encuentra inscripto a la carrera', 'error');}else{sweetAlertReload('Exito!', 'Alumno Apuntado correctamente', 'success')}";
    

    sweetAjaxConfirm("Atencion", "¿Estás seguro de apuntar al alumno a esta carrera?", "warning", "../ajax/crud.php", ajaxParams,sendCode)
    /*
    $.ajax({
      url:"../ajax/crud.php",
      method:'POST',
      data:{control:"inscripcion_carreras", id_carrera:id_carrera, id_alumno:id_alumno},          
      success:function(data){            
        //alert(data);
        if(data == 1){
          sweetAlert("Atención", "El alumno ya se encuentra inscripto a la carrera", "error");
      }else{
          sweetAlert("Correcto", "El alumno se ha inscripto correctamente a la carrera", "success");

        }
      }
    });//fin ajax  
    */
    
  }
});


//deselect row on "deselect" button click
document.getElementById("deselect-row").addEventListener("click", function(){
  tabla_alumnos.deselectRow();
  tabla_carreras.deselectRow();
  table.setData([]);
  $('#tabla').hide();
  
});

  
//TABLA CARRERAS A LA QUE ESTA INSCRIPTO EL ALUMNO  
var table = new Tabulator("#tabla_incripcion", {
  layout:"fitDataFill",
  //pagination:"local",
  //paginationSize:10,
  //paginationSizeSelector:[12, 24, 36, true],
  selectable:true, //make rows selectable
  selectableRows:true,
  selectableRangeMode:"click",  
  placeholder:"No hay datos para mostrar",
  columns:[
      {title:"Carrera", field:"carrera", formatter:"html", width:400, headerFilter:"input"},
      
              
  ],
});
