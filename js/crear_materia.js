//Generate icon
var addIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-circle-plus fa-xl' style='color:green;'></i>";
};

//Generate icon
var viewIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-eye fa-xl' style='color:blue;'></i>";
};

//Generate icon
var deleteIcon = function(cell, formatterParams){ //plain text value
    return '<i class="fa-solid fa-trash" style="color:red;"></i>';
};


let = control = null;

// EDITOR 
var newEditor = function (cell, onRendered, success, cancel, editorParams) {
    // Crear y estilizar el editor
    var editor = document.createElement("input");

    editor.setAttribute("type", "text");

    // Estilo del editor
    editor.style.padding = "3px";
    editor.style.width = "100%";
    editor.style.boxSizing = "border-box";

    // Obtener el valor actual de la celda SIN codificarlo nuevamente
    editor.value = decodeURIComponent(cell.getValue()); // Decodificar si ya está codificado

    // Enfocar el editor cuando se renderiza
    onRendered(function () {
        editor.focus();
        editor.select(); // Selecciona todo el texto para facilitar la edición
    });

    // Función para confirmar el cambio
    function successFunc() {
        var newValue = editor.value;

        // Codificar caracteres especiales antes de enviarlos al servidor
        var encodedValue = encodeURIComponent(newValue);

        // Confirmar el valor editado
        success(newValue); // Actualiza la celda con el valor original (sin codificar)

        // Obtener datos de la celda
        var col = cell.getColumn().getField();
        var id = cell.getRow().getData().id;

        // Cambiar el estilo de la celda para indicar que se ha modificado
        cell.getElement().style.color = '#ffffff';
        cell.getElement().style.backgroundColor = '#EE1010';

        // Enviar los datos al servidor mediante AJAX con SweetAlert
        var ajaxParams = { id: id, col: col, cellValue: encodedValue, control: control };
        sweetAjaxSend("Atención", "¿Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, false);
    }

    // Función para cancelar la edición
    function cancelFunc() {
        cancel(); // Cancelar la edición y restaurar el valor original
    }

    // Evento para confirmar el cambio cuando se presiona Enter
    editor.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            successFunc(); // Confirmar el cambio si se presiona Enter
        }
    });

    // Evento para cancelar la edición cuando se presiona ESC
    editor.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            cancelFunc(); // Cancelar la edición si se presiona ESC
        }
    });

    // Evento para manejar el blur (cuando se hace clic fuera del editor)
    editor.addEventListener("blur", function () {
        // Verificar si el valor ha cambiado antes de confirmar
        if (editor.value !== decodeURIComponent(cell.getValue())) {
            successFunc(); // Confirmar el cambio si el valor ha cambiado
        } else {
            cancelFunc(); // Cancelar la edición si el valor no ha cambiado
        }
    });

    // Retornar el editor
    return editor;
};



//TABLA CARRERAS
var table_carreras = new Tabulator("#tab_carreras", {
    //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
    ajaxURL: "../ajax/get_carreras.php",
    //ajaxConfig:"POST", //ajax HTTP request type
    //ajaxParams: {id:id, control:"t_equi"},
    selectable:true, //make rows selectable
    selectableRows:true,
    selectableRowsRangeMode:"click",    
    selectableRangeMode:"click",
    layout:"fitColumns",
    pagination:"local",
    paginationSize:6,
    paginationSizeSelector:[12, 24, 36, true],
    columns:[
        {title:"Carrera", field:"carrera", formatter:"html", width:400},
        {title:"Ver",formatter: viewIcon, hozAlign:"center", width:100, headerHozAlign :"center",
                    cellClick:function(e, cell){
                        let idCarrera = cell.getRow().getData().id;
                        
                        $.ajax({
                            url:'../ajax/get_materias_carrera.php',
                            method:'POST',
                            //data:{idCarrera:idCarrera, control:"update_carrera", carrera:value},
                            data:{idCarrera:idCarrera},
                            success:function(data){                                
                                //alert(data);
                                //Convertir el data en un json bien formateado en javascript para que lo pueda leer la tabla, ya que el json que viene es del php y tiene las comillas diferentes
                                data = JSON.parse(data);
                                tablaMaterias.setData(data);
                            }       
                            });
            } // fin cellClick
        }, 

        {title:"Agregar", formatter: addIcon, hozAlign:"center", width:100, headerHozAlign :"center",
                    cellClick:function(e, cell){
                        let idCarrera = cell.getRow().getData().id;
                        //let carrera = cell.getRow().getData().carrera;    
                        //sweet2Inputs(title, urlAjax, idCarrera, control)
                        sweet2Inputs("Ingrese el nombre de la materia y el año al que pertenece la materia", "../ajax/crud.php", idCarrera, "insert_materia","Materia","Anio");                                              
            } // fin cellClick
        },

        {title:"Eliminar", formatter: deleteIcon, hozAlign:"center", width:100, headerHozAlign :"center",
                    cellClick:function(e, cell){
                        let idCarrera = cell.getRow().getData().id;
                        //let carrera = cell.getRow().getData().carrera;    
                        sweetAjaxDelete("¿Estás seguro?", "Se eliminará la carrera seleccionada ", "warning", "../ajax/crud.php", {idCarrera:idCarrera, control:"delete_carrera"})                                               
            } // fin cellClick
        },
    ],
});



//TABLA MATERIAS
var tablaMaterias = new Tabulator("#tab_materias", {
    data:[],
    layout:"fitColumns",
    pagination:"local",
    paginationSize:6,
    paginationSizeSelector:[12, 24, 36, true],
      columns:[
        {title:"Materia", field:"materia", formatter:"html", width:400, headerFilter:true, editor:newEditor, editable:false, 
            cellDblClick:function(e, cell){
            cell.edit(true);
            control = "update_materia_name";
            },
            cellClick:function(e, cell){                
                cell.getRow().toggleSelect();

            },
        },
        {
            title: "Año",
            field: "anio",
            headerFilter: true,
            widthGrow: 1,            
            editable: false, // Desactivar edición por defecto
            cellDblClick: function (e, cell) {
                cell.edit(true); // Activar edición con doble clic
            },
            editor:"number", 
            editorParams:{
                min:1,
                max:10,
                step:1,
                elementAttributes:{
                    maxlength:"2", //set the maximum character length of the input element to 10 characters
                },
                mask:"99",
                 selectContents:true,
                verticalNavigation:"table", //up and down arrow keys navigate away from cell without changing value
            },
            cellEdited: function (cell) {
                // Obtener el valor de la celda
                var cellValue = cell.getValue();
        
                // Validar si el valor NO es un número
                if (!/^\d+$/.test(cellValue)) {
                    // Mostrar una alerta de SweetAlert
                    alert("El valor ingresado no es un número entero válido");
                            cell.restoreOldValue();
                    return;
                       
                }
        
                // Si el valor es válido, continuar con el proceso normal
                var idMateria = cell.getRow().getData().id;
                var col = cell.getColumn().getField();
                var encodedValue = encodeURIComponent(cellValue);
                var ajaxParams = { id: idMateria, col: col, cellValue: encodedValue, control: "update_materia_anio" };
        
                // Confirmar antes de enviar por AJAX
                sweetAjaxSend("Atención", "¿Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, false);
            }
        },            
        
        {title:"Carrera", field:"carrera", formatter:"html", headerFilter:true, widthGrow:3},
        {title:"Eliminar", formatter: deleteIcon, hozAlign:"center", width:100, headerHozAlign :"center",
            cellClick:function(e, cell){
                let idMateria = cell.getRow().getData().id;
                //let carrera = cell.getRow().getData().carrera;    
                sweetAjaxDelete("¿Estás seguro?", "Se eliminará la carrera seleccionada ", "warning", "../ajax/crud.php", {idMateria:idMateria, control:"delete_materia"})                                               
            } 
        },
],


});//Fin definicion tabla materias


table_carreras.on("rowClick", function(e, row){
    //e - the click event object
    //row - row component
    let idCarrera = row.getData().id ;
    $.ajax({
        url:'../ajax/get_materias_carrera.php',
        method:'POST',
        //data:{idCarrera:idCarrera, control:"update_carrera", carrera:value},
        data:{idCarrera:idCarrera},
        success:function(data){                                
            //alert(data);
            //Convertir el data en un json bien formateado en javascript para que lo pueda leer la tabla, ya que el json que viene es del php y tiene las comillas diferentes
            data = JSON.parse(data);
            tablaMaterias.setData(data);
        }       
        });
});

