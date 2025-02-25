// OCULTAR BOTONES AL CARGAR LA PAGINA
$( document ).ready(function() {
    $('#boton').hide();    
});

let aux = '';
//Obtener el valor de la variable php userId
let id = "<?php echo $userId; ?>";


document.getElementById("select-stats").innerHTML = 'Seleccione un alumno de la tabla';

 //ESTO PREVIENE LA SELECCION DEL TEXTO AL HACER DOBLE CLIC
 document.addEventListener('mousedown', function (event) {
    if (event.detail > 1) {
      event.preventDefault();
      // of course, you still do not know what you prevent here...
      // You could also check event.ctrlKey/event.shiftKey/event.altKey
      // to not prevent something useful.
    }
  }, false);








//BUSCAR ALUMNO SCRIPTS
document.getElementById("select-stats").innerHTML = 'Seleccione un alumno de la tabla';



//TABLA TABULATOR BUSCAR ALUMNO-------------------------------------------------------
var table = new Tabulator("#example-table", {
ajaxURL:"../ajax/ver_alumnos.php", //ajax URL
ajaxParams:{key1:"value1", key2:"value2"}, //ajax parameters
layout:"fitDataFill",
selectable:true, //make rows selectable
selectableRangeMode:"click",
pagination:"local",
paginationSize:4,
paginationSizeSelector:[15, 20, 30, 50, true],
placeholder:"No hay datos para mostrar", 
autoColumns:true,
autoColumnsDefinitions:function(definitions){
  //definitions - array of column definition objects

  definitions.forEach((column) => {
      column.formatter = "html"; // add html formatter to every column
  });

  // Agregar otras definiciones de columnas aquí...

  // Devolver todas las definiciones de columnas
  return definitions;
},
autoColumnsDefinitions:[
  {title:"id", field:"id", visible:false},//OCULTO LA COLUMNA ID
  {title:"iduser", field:"iduser", visible:false},//OCULTO LA COLUMNA IDUSER
  {title:"imagen", field:"imagen", visible:false},//OCULTO LA COLUMNA IMAGEN
  {title:"Nombre", field:"Nombre", headerFilter:"input", width:200},
  {title:"Apellido", field:"Apellido", headerFilter:"input", width:200},
  {title:"Dni", field:"Dni", headerFilter:"input", width:200},
],
rowFormatter:function(row){
  var element = row.getElement(),
  data = row.getData(),
  width = element.offsetWidth,
  rowTable, cellContents;

  //clear current row data
  while(element.firstChild) element.removeChild(element.firstChild);

  //define a table layout structure and set width of row
  rowTable = document.createElement("table")
  // rowTable.style.width = (width - 1) + "px";

  var rowTabletr = document.createElement("tr");

  //add image on left of row
  cellContents = "<td><img src='" + data.imagen + "' width='70' height='70' class='rounded-circle' style='margin-right:2rem;'></td>";

  //add row data on right hand side
  cellContents += "<td><div><strong>Apellido y Nombre:</strong> " + data.Apellido + ', ' + data.Nombre + "</div><div><strong>DNI:</strong> " + data.Dni + "</div><div><strong>Dirección:</strong> " + data.Direccion + "</div><div><strong>Fecha Nacimiento:</strong> " + "</div></td>"

  rowTabletr.innerHTML = cellContents;

  rowTable.appendChild(rowTabletr);

  //append newly formatted contents to the row
  element.append(rowTable);
},

});






//CLIC SOBRE LA FILA
table.on("rowClick", function(e, row){     
    id = row.getData().id;
    document.getElementById("select-stats").innerHTML = row.getData().Apellido + ', ' + row.getData().Nombre;    

  });


//DOBLE CLIC SOBRE LA FILA
table.on("rowDblClick", function(e, row){
//e - the click event object
//row - row component
id = row.getData().id;
$("#idAlumno").val(id);
$("#formStudent").submit();
});

// FUNCION BOTON -----------------------------------------------------------------
$(document).ready(function(){
  $("#boton").click(function(){

    $("#id").val(aux);
    $("#formStudent").submit();
  });
});
