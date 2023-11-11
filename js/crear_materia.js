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

//EDITOR PARA LAS NOTAS
var newEditor = function(cell, onRendered, success, cancel, editorParams){
    //cell - the cell component for the editable cell
    //onRendered - function to call when the editor has been rendered
    //success - function to call to pass thesuccessfully updated value to Tabulator
    //cancel - function to call to abort the edit and return to a normal cell
    //editorParams - params object passed into the editorParams column definition property
  
    //create and style editor
    var editor = document.createElement("input");
  
    editor.setAttribute("type", "text");
  
    //create and style input
    editor.style.padding = "3px";
    editor.style.width = "100%";
    editor.style.boxSizing = "border-box";
  
    //Set value of editor to the current value of the cell
    editor.value = cell.getValue();
  
    //set focus on the select box when the editor is selected (timeout allows for editor to be added to DOM)
    onRendered(function(){
        editor.focus();
        editor.style.css = "100%";
    });
  
    //when the value has been set, trigger the cell to update
    function successFunc(){
        success(editor.value);
        var col = cell.getColumn().getField();
        var cellValue = cell.getValue();
        var id = cell.getRow().getData().id;    
        cell.getElement().style.color ='#ffffff';
        cell.getElement().style.backgroundColor ='#EE1010';   
        ajaxParams = {id:id, col:col, cellValue:cellValue, control:control};    
        sweetAjaxSend("Atención", "Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, false);
  
    }
  
    editor.addEventListener("change", successFunc);
    editor.addEventListener("blur", successFunc);
  
    //return the editor element
    return editor;
  };



//TABLA CARRERAS
var table_carreras = new Tabulator("#tab_carreras", {
    //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
    ajaxURL: "../ajax/get_carreras.php",
    //ajaxConfig:"POST", //ajax HTTP request type
    //ajaxParams: {id:id, control:"t_equi"},
    layout:"fitColumns",
    pagination:"local",
    paginationSize:6,
    paginationSizeSelector:[12, 24, 36, true],
    selectable:true, //make rows selectable
    selectableRangeMode:"click",
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
    placeholder:"No hay Datos",
    pagination:"local",
    paginationSize:8,
    paginationSizeSelector:[8, 10, 20, true],
      columns:[
        {title:"Materia", field:"materia", formatter:"html", width:400, headerFilter:true, editor:newEditor, editable:false, 
            cellDblClick:function(e, cell){
            cell.edit(true);
            control = "update_materia_name";
            }
        },
        {title:"Año", field:"anio", headerFilter:true, widthGrow:1, editor:newEditor, editable:false, 
            cellDblClick:function(e, cell){
            cell.edit(true);
            control = "update_materia_anio";
            }
        },
        {title:"Carrera", field:"carrera", formatter:"html", headerFilter:true, widthGrow:3},
     ],


});


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