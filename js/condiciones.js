//PREVIENE LA SELECCION DE TEXTO AL HACER DOBLE CLIC
document.addEventListener('mousedown', function (event) {
    if (event.detail > 1) {
      event.preventDefault();
      // of course, you still do not know what you prevent here...
      // You could also check event.ctrlKey/event.shiftKey/event.altKey
      // to not prevent something useful.
    }
  }, false);


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
        var id = cell.getData().id;    
        cell.getElement().style.color ='#ffffff';
        cell.getElement().style.backgroundColor ='#EE1010';   
        ajaxParams = {id:id, col:col, cellValue:cellValue, control:control};    
        sweetAjaxSend("Atención", "Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, true);
  
    }
  
    editor.addEventListener("change", successFunc);
    editor.addEventListener("blur", cancel);
  
    //return the editor element
    return editor;
  };


let control = "";

//Tabla condiciones
var table = new Tabulator("#tabla_condiciones", {
    ajaxURL:"../ajax/ajax.php", //ajax URL
    ajaxConfig:"POST", //ajax HTTP request type
    ajaxParams:{control:"get_condiciones"}, //ajax parameters
    columns:[
        
        {title:"Condicion", field:"condicion", width:300, editor:"input", editable:false, 
                cellDblClick:function(e, cell){
                    cell.edit(true);
                    control = "update_condiciones_name";
                }
        },
        /*
        {title:"Condicion", field:"condicion", width:300},*/
        {title:"Nota", field:"nota", width:100, editor:newEditor, editable:false, 
                cellDblClick:function(e, cell){
                    cell.edit(true);
                    control = "update_condiciones";
                }
        },
    ],

});


//btn_nueva_condicion
$("#btn_nueva_condicion").click(function(){
    //sweetAjaxInput(title, urlAjax, control, idCarrera);
    sweetAjaxInput('Introduce el nombre de la condicion', '../ajax/crud.php', 'new_condicion', 4)
});


table.on("cellEdited", function(cell){
    //cell - cell component
        var col = cell.getColumn().getField();
        var cellValue = cell.getValue();
        var id = cell.getData().id; 
        ajaxParams = {id:id, col:col, cellValue:cellValue, control:control};
        if(id == 1){
            sweetAlert("Atención", "A la condición 'Regular' no se le puede cambiar el nombre", "warning");
            //oldvalue
            cell.restoreOldValue();
        }else{
            sweetAjaxSend("Atención", "Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, true);
        }
});