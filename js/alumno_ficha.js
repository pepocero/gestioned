
// Inicializa TinyMCE para el textarea con id "Datos_Adicionales" con el valor de la consulta MySQL
/*
tinymce.init({
  selector: '#Datos_Adicionales',  
  toolbar: 'undo redo | bold italic underline strikethrough |',  // Define la barra de herramientas sin las opciones que deseas quitar
  menubar: false,  // Opcional: oculta la barra de menú de TinyMCE
  height: 200,  // Altura del editor en pixeles
  width: 600,  // Ancho del editor en pixeles
  lineheight_formats: '1', // Establece los valores deseados
  spellchecker: false, // Desactiva la corrección ortográfica
  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),  
});
*/
let control = "";

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

let cellValue = "";

  //when the value has been set, trigger the cell to update
  function successFunc(){
      success(editor.value);
      var col = cell.getColumn().getField();
      cellValue = cell.getValue();
      var id = cell.getData().id;    
      cell.getElement().style.color ='#ffffff';
      cell.getElement().style.backgroundColor ='#EE1010';   
      ajaxParams = {id:id, col:col, cellValue:cellValue, control:control};    
      sweetAjaxSend("Atención", "Modificar la celda seleccionada?", "warning", "../ajax/crud.php", ajaxParams, true);

  }

  editor.addEventListener("change", successFunc);
  //editor.addEventListener("blur", successFunc);
  editor.addEventListener("blur", function(){
        if(cellValue != ''){
          successFunc();
      }else{
          cancel();
      }
  });

  //return the editor element
  return editor;
};



//FUNCION PARA EL EDITOR DE FECHAS
var dateEditor = function(cell, onRendered, success, cancel){        
  //create and style input
  var cellValue = cell.getValue();    
  input = document.createElement("input");

  input.setAttribute("type", "date");

  input.style.padding = "4px";
  input.style.width = "100%";
  input.style.boxSizing = "border-box";

  input.value = cellValue;

  onRendered(function(){
      input.focus();
      input.style.height = "100%";
      
  });

  function onChange(){
      if(input.value != cellValue){
          value = input.value;
          success(value); 
          var col = cell.getColumn().getField();
          cellValue = cell.getValue();
          var id = cell.getData().id;    
          cell.getElement().style.color ='#ffffff';
          cell.getElement().style.backgroundColor ='#EE1010';   
          ajaxParams = {id:id, col:col, cellValue:cellValue, control:control};
          urlAjax = "../ajax/crud.php"; 
          sweetAjaxConfirm("Atencion", "Desea cambiar la fecha?", "warning", urlAjax, ajaxParams, false);

      }else{
          cancel();
      }
  }    
  //input.addEventListener("blur", cancel);
  input.addEventListener("blur", onChange);
  //input.addEventListener("change", onChange);//Lo agregue para ver si funciona la alerta de edicion:FUNCIONA!El problema es que si pones la fecha con el teclado, detecta que hay un cambio y ya te ejecuta el onChange
      //submit new value on enter
  
      // Quita la llamada a onChange() en el evento "keydown"
input.addEventListener("keydown", function(e){
  if(e.key == 'Enter'){
    e.preventDefault(); // Evita que el evento "Enter" se propague
    // Agrega SweetAlert2 para mostrar el cuadro de diálogo de confirmación
    swal.fire({
      title: 'Atencion',
      text: 'Desea cambiar la fecha?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        onChange(); // Ejecuta onChange() si el usuario acepta
      } else {
        cancel(); // Ejecuta cancel() si el usuario cancela
      }
    });
  }
  if(e.key == 'Escape'){
    cancel();
  }
});

      return input;
};


//Tabla Cuatrimestres
var table_cuat = new Tabulator("#tabla_cuatrimestres", {
  ajaxURL:"../ajax/ajax.php", //ajax URL
  ajaxConfig:"POST", //ajax HTTP request type
  ajaxParams:{control:"get_cuatrimestres",idAlumno:idAlumno}, //ajax parameters
  layout:"fitColumns",
  selectable:true, //make rows selectable
    selectableRangeMode:"click",
    
  columns:[
      {title:"Fecha", field:"fecha", formatter:"datetime", formatterParams:{
        inputFormat:"yyyy-MM-dd",
        outputFormat:"dd/MM/yyyy",
        //invalidPlaceholder:"(no establecida)",
        }
      },

      { title: "Condicion", field: "condicion", headerHozAlign: "center", editor:"list", editorParams:{
        values: condiciones,
        emptyValue:null, //Si el valor esta vacio asignarle el valor nulo
        },
        formatter:function(cell, formatterParams, onRendered) {
            if (cell.getValue() > 0) {
                return condiciones.find(obj => obj.value == cell.getValue()).label
            } else {
                return cell.getValue()
            }
          },
          tooltip:function(e, cell, onRendered){
            //e - mouseover event
            //cell - cell component
            //onRendered - onRendered callback registration function
            
            var el = document.createElement("div");
            el.style.backgroundColor = "#898EF5";
            el.style.color = "#fff";
            //el.innerText = cell.getColumn().getField() + " - " + cell.getValue(); //return cells "field - value";
            el.innerText = cell.getValue();//return field value;
            
            return el; 
            },
      },

      {title:"Materia", field:"materia", formatter:"html", tooltip:function(e, cell, onRendered){
        //e - mouseover event
        //cell - cell component
        //onRendered - onRendered callback registration function
        
        var el = document.createElement("div");
        el.style.backgroundColor = "#898EF5";
        el.style.color = "#fff";
        //el.innerText = cell.getColumn().getField() + " - " + cell.getValue(); //return cells "field - value";
        el.innerText = cell.getValue();//return field value;
        
        return el; 
        },
      },
      {title:"División", field:"division"},
      {title:"Carrera", field:"carrera", formatter:"html", tooltip:function(e, cell, onRendered){
        //e - mouseover event
        //cell - cell component
        //onRendered - onRendered callback registration function
        
        var el = document.createElement("div");
        el.style.backgroundColor = "#898EF5";
        el.style.color = "#fff";
        //el.innerText = cell.getColumn().getField() + " - " + cell.getValue(); //return cells "field - value";
        el.innerText = cell.getValue();//return field value;
        
        return el; 
        },
      },

      {title:"Profesor", field:"profesor", editor:"list", editorParams:{
        values: profes,
        emptyValue:null, //Si el valor esta vacio asignarle el valor nulo
        },
        formatter:function(cell, formatterParams, onRendered) {
            if (cell.getValue() > 0) {
                return profes.find(obj => obj.value == cell.getValue()).label
            } else {
                return cell.getValue()
            }
            
          },
          tooltip:function(e, cell, onRendered){
            //e - mouseover event
            //cell - cell component
            //onRendered - onRendered callback registration function
            
            var el = document.createElement("div");
            el.style.backgroundColor = "#898EF5";
            el.style.color = "#fff";
            //el.innerText = cell.getColumn().getField() + " - " + cell.getValue(); //return cells "field - value";
            el.innerText = cell.getValue();//return field value;
            
            return el; 
            },
      },

      
      {title:"Fecha Cuat1", field:"fechacuat1", editor:dateEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}, formatter:"datetime", formatterParams:{
        inputFormat:"yyyy-MM-dd",
        outputFormat:"dd/MM/yyyy",
        //invalidPlaceholder:"(no establecida)",
        },
        formatter:function(cell, formatterParams, onRendered) {
          if (cell.getValue() == '1970-01-01') {
              return ''
          } else {
              return luxon.DateTime.fromFormat(cell.getValue(), "yyyy-MM-dd").toFormat("dd/MM/yyyy");
          }
        },
      },
      {title:"Cuat 1", field:"cuat1", editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Fecha Cuat 2", field:"fechacuat2", editor:dateEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);},formatter:"datetime", formatterParams:{
        inputFormat:"yyyy-MM-dd",
        outputFormat:"dd/MM/yyyy",
        //invalidPlaceholder:"(no establecida)",
        },
        formatter:function(cell, formatterParams, onRendered) {
          if (cell.getValue() == '1970-01-01') {
              return ''
          } else {
            return luxon.DateTime.fromFormat(cell.getValue(), "yyyy-MM-dd").toFormat("dd/MM/yyyy");
          }
        },
      },
      {title:"Cuat 2", field:"cuat2", editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Fecha Recup", field:"fecharecup", editor:dateEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}, formatter:"datetime", formatterParams:{
        inputFormat:"yyyy-MM-dd",
        outputFormat:"dd/MM/yyyy",
        //invalidPlaceholder:"(no establecida)",
        },
        formatter:function(cell, formatterParams, onRendered) {
          if (cell.getValue() == '1970-01-01') {
              return ''
          } else {
            return luxon.DateTime.fromFormat(cell.getValue(), "yyyy-MM-dd").toFormat("dd/MM/yyyy");
          }
        },
      },
      {title:"Recup", field:"recup", editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Sin Final", field:"sinfinal", editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},

      

                 
  ],

});



table_cuat.on("cellEdited", function(cell){
  //cell - cell component
  control = "update_cuatrimestres";
  var id = cell.getRow().getData().id;
  var col = cell.getColumn().getField();
  var cellValue = cell.getValue();

  if (col == "profesor") {   

    if(cellValue != null){
      var ajaxParams = {id:id, idProfe:cellValue, control:"update_profesor_cuatri"};
      ajaxSend("../ajax/crud.php", ajaxParams, false);
    }else{
      cell.restoreOldValue();
    }

  }

  if (col == "condicion") {
    console.log("Elemento seleccionado:"+ cellValue);
    var ajaxParams = {id:id, idCondicion:cellValue, control:"update_condicion_cuatri"};

    sweetAjaxSend("Atención", "Cambiar Condicion?", "warning", "../ajax/crud.php", ajaxParams, true);
    
  }
});

//Tabla Acreditacion
var table_acred = new Tabulator("#tabla_acreditacion", {
  ajaxURL:"../ajax/ajax.php", //ajax URL
  ajaxConfig:"POST", //ajax HTTP request type
  ajaxParams:{control:"get_acreditacion",idAlumno:idAlumno}, //ajax parameters
  layout:"fitColumns",
  selectable:true, //make rows selectable
  selectableRangeMode:"click",
    
  columns:[
      {title:"Fecha", field:"fecha", editor:dateEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}, width:150, formatter:"datetime", formatterParams:{
        inputFormat:"yyyy-MM-dd",
        outputFormat:"dd/MM/yyyy",
        //invalidPlaceholder:"(no establecida)",
        },
        formatter:function(cell, formatterParams, onRendered) {
          if (cell.getValue() == '1970-01-01') {
            return ''
        } else {
          return luxon.DateTime.fromFormat(cell.getValue(), "yyyy-MM-dd").toFormat("dd/MM/yyyy");
        }
        },
      },
      {title:"Materia", field:"materia", formatter:"html", width:250, tooltip:function(e, cell, onRendered){
        //e - mouseover event
        //cell - cell component
        //onRendered - onRendered callback registration function
        
        var el = document.createElement("div");
        el.style.backgroundColor = "#898EF5";
        el.style.color = "#fff";
        //el.innerText = cell.getColumn().getField() + " - " + cell.getValue(); //return cells "field - value";
        el.innerText = cell.getValue();//return field value;
        
        return el; 
        },
      },
      {title:"Escrito", field:"escrito", width:100, editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Oral", field:"oral", width:100, editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Final", field:"final", width:100, editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Libro", field:"libro", width:100, editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Folio", field:"folio", width:100, editor:newEditor, editable:false, cellDblClick:function(e, cell){cell.edit(true);}},
      {title:"Institución", field:"institucion", width:150, editor:newEditor,editable:false, cellDblClick:function(e, cell){cell.edit(true);}},

    ],

  });
  
  //ACCION AL EDITAR LA CELDA DE ACREEDITACION
  table_acred.on("cellEdited", function(cell){
    //cell - cell component
    control = "update_acreditacion"; 
    
  });


  //CON ESTO SE RELLENA EL SELCT DE CARRERAS
/*  
var select = document.getElementById("select_carreras");

var parametros = {
  control: "carreras_apuntado",
  id_alumno: idAlumno
};

fetch("../ajax/ajax.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(parametros)
})
  .then(response => response.json())
  .then(data => {
    // Aquí se manejan los datos recibidos
    // Iterar sobre los datos y agregar opciones al select
    data.forEach(item => {
      var option = document.createElement("option");
      option.text = item.nombre;
      option.value = item.id;
      select.appendChild(option);
    });
  })
  .catch(error => {
    console.error("Error al obtener los datos:", error);
  });

  */

  //CON ESTO SE RELLENA EL SELECT DE CARRERAS FUNCIONA PERO LOS ACENTOS SALEN MAL
  $.ajax({
    url:"../ajax/ajax.php",
    method:'POST',
    data: {control:"carreras_apuntado",id_alumno:idAlumno},
    success:function(data){      
      var datos = JSON.parse(data);      
      var select = document.getElementById("select_carreras");
      //agregar una clase al select
      select.classList.add("form-select");
      // Agregar la opción inicial desactivada
      var opcionInicial = document.createElement("option");
      opcionInicial.text = "Seleccione una carrera";
      opcionInicial.disabled = true;
      opcionInicial.selected = true;
      select.appendChild(opcionInicial);
      //rellenar el select con los datos
      datos.forEach(item => {
        var option = document.createElement("option");
        option.text = he.decode(item.carrera);
        option.value = item.id;
        select.appendChild(option);
      });
    }       
    });//fin ajax

    let idCarrera = null;
    //agregar un listener al select de carreras
    var select = document.getElementById("select_carreras");
    select.addEventListener("change", function() {
          idCarrera = this.value;
          document.getElementById("id_carrera").value = idCarrera;
          
    });

    //listener del boton de agregar carrera
    var btn_analitico = document.getElementById("submit_analitico");
    btn_analitico.addEventListener("click", function() {
          if(idCarrera == null){
            sweetAlert("Atención", "Seleccione una carrera", "warning");
          }else{
            document.getElementById("form_analitico").submit();
          }
  });

  //BOTON VER DATOS ADICIONALES QUE CAMBIE EL TEXTO DEL BOTON DEPENDIENDO DE SI SE ACTIVA EL COLLAPSE O NO
  document.addEventListener('DOMContentLoaded', function() {
    var botonMostrarDatos = document.getElementById('btnMostrarDatos');
    var datosCollapse = document.getElementById('collapseAdicionales');

    datosCollapse.addEventListener('show.bs.collapse', function () {
        botonMostrarDatos.textContent = 'Ocultar Datos Adicionales';
    });

    datosCollapse.addEventListener('hide.bs.collapse', function () {
        botonMostrarDatos.textContent = 'Mostrar Datos Adicionales';
    });
});


// Initialize Quill editor 

const quill = new Quill('#editor', {
  theme: 'snow'
});
