

// AL CARGAR LA PAGINA ESTO OCULTA -----------------------------------------------------------------
window.onload = function() {
    //$('#tabla_materias').show();
    $('#btnEstablecer').hide();
 };
 
  //TABLA MATERIAS  ---------------------------------------------------------------------------------------------
  var table = new Tabulator("#tabla_materias", {
    data:[],
    height:"340px",
    layout:"fitDataStretch",
    selectableRangeMode:"click",    
    selectable:true,    
    //autoColumns:true,
    columns:[
       // {title:"id", field:"id"},
        {title:"Materia", field:"materia", width:"200", formatter:"html"},
    ],

});

 
 // SELECT CARRERA  ---------------------------------------------------------------------------------------------------------------

$("#selectCarrera").change(function(){
    var idCarrera = this.value;
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
          //console.log(data);                
          var select = $('#select_anios');
          selectAnios.html('<option value="">Selecciona un año</option>');
          $.each(data, function(key, value) {
              select.append('<option value="' + value.anio + '">' + value.anio + '</option>');
          });
          select.selectedIndex = 0;
          selectAnios.prop('disabled', false); // Habilitar select una vez cargadas
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
        table.setData(data);               
        $('#tabla_materias').show();
        $('#btnEstablecer').show();
      },
      error: function(xhr, status, error) {
            console.error(error);
      }   
    });//fin ajax 
  });
 
 
 

 
 
 table.on("rowClick", function(e, row){      
     //$("#materia").val(idSelected);Esto es con Jquery
     document.getElementById("materia").value = row.getData().id; 
     document.getElementById("label").value = row.getData().materia;
     
 });
 
 //Boton Establecer Materia
 document.getElementById("setMateria").addEventListener("click", function(){
    var label = document.getElementById("label").value;
     document.getElementById("sendMateria").value = document.getElementById("materia").value; 

     //Asignar el valor de label que es el nombre de la materia en formato html


     document.getElementById("sendNombreMateria").value = htmlEntities(label);  
 });
 
 //Boton Establecer Correlativa
 document.getElementById("setCorrelativa").addEventListener("click", function(){
    var label = document.getElementById("label").value;
     document.getElementById("sendCorrelativa").value = document.getElementById("materia").value; 
     document.getElementById("sendNombreCorrelativa").value = htmlEntities(label);
 
 });
 
 
 
 
 //Boton Enviar Formulario
 document.getElementById("enviarDatos").addEventListener("click", function(){
     var send = document.getElementById("sendMateria").value;
     var send2 = document.getElementById("sendCorrelativa").value;
     
     if (send == 0 || send2 == 0){
         //alert("Falta completar la materia o la correlativa");
         sweetAlert("Atención", "Falta completar la materia o la correlativa", "warning")
 }else{     
     //sweetAjaxPassword("Enviar Datos?", "../ajax/crud.php", {control:"send_correlativa", materia:send,correlativa:send2});
     sweetAjaxSend("Atención", "Enviar Datos?", "warning", "../ajax/crud.php", {control:"send_correlativa", materia:send,correlativa:send2}, true)
     
     
     //if (con) {
     //    document.getElementById("enviar").submit();
     //}
         
 }
 
 });
 
 
 //Generate print icon
 var printIcon = function(cell, formatterParams){ //plain text value
     return "<i class='fa fa-trash' style='color:red;'></i>";
 };
 

 //TABLA CORRELATIVAS
 var correlativas = new Tabulator("#tablaCorrelativas", {
     ajaxURL:"../ajax/correlativas.php",
     layout:"fitDataStretch",
     height:"340px",
     pagination:"local",
     paginationSize:10,
     paginationSizeSelector:[10, 20, 30, true],
 
     columns:[
         //{title:"id", field:"mate"},
         {title:"Materia", field:"Materia1", headerFilter:true, headerFilterPlaceholder:"Buscar por materia", formatter:"html"},
         {title:"Año", field:"anio", cssClass:"blue-background"},
         {title:"Carrera", field:"carrera1", formatter:"html", cssClass:"blue-background", headerFilter:true, headerFilterPlaceholder:"Buscar por Carrera"},
         //{title:"id", field:"corre"},
         {title:"Correlativa", field:"correlativa", formatter:"html", headerFilter:true, headerFilterPlaceholder:"Buscar por correlativa"},
         {title:"Año", field:"Año"},
         {title:"Carrera Correlativa", field:"carrera2", formatter:"html", headerFilter:true, headerFilterPlaceholder:"Buscar por Carrera"},
         //{title:"Carrera", field:"carrera", formatter:"html"},
         {formatter:printIcon, width:10, hozAlign:"center", cellClick:function(e, cell){
            var id_correlativa = cell.getData().id;
            //alert(id_correlativa);

            sweetAjaxPassword("Ingrese clave de administrador \n (4724)", "../ajax/crud.php", "delete_correlativa", {id_correlativa:id_correlativa,control:"delete_correlativa"})
             
             
             },
         },
     ],
 });
 
 