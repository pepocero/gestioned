//Generate icon
var editIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-pen' style='color:blue;'></i>";
};

//TABLA CAMPOS ALUMNOS
var table_campos = new Tabulator("#tab_campos_alumnos", {
    //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
    ajaxURL: "../ajax/alumnos_ingreso.php",
    ajaxConfig:"POST", //ajax HTTP request type
    ajaxParams: {control:"alumnos"},
    autoColumns:true,
    layout:"fitColumns",
    selectable:true, //make rows selectable
    selectableRangeMode:"click",
    autoColumnsDefinitions:function(definitions){
        //definitions - array of column definition objects

        definitions.forEach((column) => {
            column.formatter = "html"; // add html formatter to every column
        });

        // Agregar definición de columna para celdas editables
  definitions.push({
    title: "Dato a Ingresar",
    field: "campo",
    editor: "input",
    formatter: function(cell, formatterParams, onRendered) {
      // Obtener valor de celda
      var value = cell.getValue();

      // Crear elemento de entrada y establecer valor
      var input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("value", value);

      // Agregar evento de cambio para actualizar valor de celda
      input.addEventListener("change", function(e) {
        cell.setValue(e.target.value);
       
            alert(value);
        
      });
       

      // Devolver elemento de entrada como resultado del formateador
      return input;
    }
  });

  // Agregar otras definiciones de columnas aquí...

  // Devolver todas las definiciones de columnas
  return definitions;
    },
    
    
    
    
});

