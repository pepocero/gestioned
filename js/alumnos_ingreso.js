//Generate icon
var deleteIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-trash' style='color:red;'></i>";
};

//Generate icon
var editIcon = function(cell, formatterParams){ //plain text value
    return "<i class='fa-solid fa-pen' style='color:blue;'></i>";
};

function quitarAcentos(texto) {
    return texto.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  }

//TABLA CAMPOS ALUMNOS
var table_campos = new Tabulator("#tab_campos_alumnos", {
    //ajaxURL: "../ajax/legajo.php?id="+id+"&control=tablaPrincipal",
    ajaxURL: "../ajax/campos_extras.php",
    ajaxConfig:"POST", //ajax HTTP request type
    ajaxParams: {control:"alumnos"},
    layout:"fitColumns",
    pagination:"local",
    paginationSize:6,
    paginationSizeSelector:[12, 24, 36, true],
    selectable:true, //make rows selectable
    selectableRangeMode:"click",
    columns:[
        {title:"Campos", field:"campo", formatter:"html", width:400, editor:"input", editable:false, cellDblClick:function(e, cell){ cell.edit(true);}},
        {formatter: deleteIcon, width:60, hozAlign:"center", 
                    cellClick:function(e, cell){
                        let idCampo = cell.getRow().getData().id;
                        let campo = cell.getRow().getData().campo;
    //sweetAjaxDelete(title, text, icon, urlAjax, ajaxParams)
                        sweetAjaxDelete("¿Estás seguro?", "Se eliminará el campo: "+campo, "warning", "../ajax/crud.php", {idCampo:idCampo, control:"delete_campo_alumnos",campo:campo})                        
            } // fin cellClick
        },

      /*  {formatter: editIcon, width:60, hozAlign:"center", 
                    cellClick:function(e, cell){
                        let idCampo = cell.getRow().getData().id;
                        let param = cell.getRow().getData().campo;
                        sweetAjaxInput("Ingrese el nuevo nombre del campo", "../ajax/crud.php", "edit_campo_alumnos", idCampo, param);
                          
            } // fin cellClick
        },*/
                
    ],
    
});

//Aca va el codigo para cuando se editan las celdas de la tabla
table_campos.on("cellEdited", function(cell){
    //cell - cell component
    //var col = cell.getColumn().getField();
    var cellValue = cell.getValue();
    var id = cell.getData().id;
    let title = "¿Estás seguro?";
    let text = "Se modificará el campo: "+cellValue;
    let icon = "warning";
    let urlAjax = "../ajax/crud.php";
    let ajaxParams = {idCarrera:id, control:"edit_campo_alumnos", texto:cellValue};
    //funcion ajax para enviar los datos al crud
    sweetAjaxSend(title, text, icon, urlAjax, ajaxParams);
 
});

//ALTERNATIVA PARA AGREGAR CARRERA
//ajaxParams:{key1:"value1", key2:"value2"}
$("#btn_add_campo").click(function(){
    var title = "Ingrese el nombre del nuevo campo";
    var urlAjax = "../ajax/crud.php";
    var control = "add_campo_alumnos";
    sweetAjaxInput(title, urlAjax, control,0);
});

//DE CHATGPT PARA GENERAR EL FORMULARIO DE INGRESO DE ALUMNOS DE FORMA DINAMICA CON LOS DATOS DE ajax/alumnos_ingreso.php
fetch("../ajax/ingreso.php?control=alumnos")
  .then(response => response.json())

  .then(data => {
    // Crear un div que encapsule todo el formulario
    const sortableDiv = document.createElement("div");
    sortableDiv.setAttribute("class", "sortable");
    // Crear el formulario
    const form = document.createElement("form");
    form.setAttribute("id", "formulario");
    //form.setAttribute("class", "col-8");//Se lo saque porque con este col-8 quedaba mal
    // Recorrer el objeto JSON y agregar los campos de entrada al formulario
    for (const value of data) {
      const label = document.createElement("label");
      label.innerHTML = value["campo"];
      label.setAttribute("for", value["campo"]);
      const input = document.createElement("input");
      input.setAttribute("type", "text");
      input.setAttribute("class", "form-control");
      input.setAttribute("name", value["campo"]);
      input.setAttribute("id", value["campo"]);
      input.setAttribute("required", "true");
      input.setAttribute("maxlength", "50");
      //input.setAttribute("placeholder", `Ingrese el ${value["campo"].replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;')}`);
      input.setAttribute("class", "form-control");
      const div = document.createElement("div");
      div.setAttribute("class", "mb-3 m-2");
      div.appendChild(label);
      div.appendChild(input);
      form.appendChild(div);
    }
    // Agregar el botón "enviar"
    const submitButton = document.createElement("button");
    submitButton.setAttribute("type", "submit");
    submitButton.setAttribute("class", "btn btn-primary mt-3");
    submitButton.innerHTML = "Enviar";
    form.appendChild(submitButton);
    document.body.appendChild(form);

    // Agregar un evento submit al formulario
    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Prevenir el comportamiento por defecto del formulario

      const formData = new FormData(form); // Obtener los datos del formulario. Los pone en pares clave/valor 
      
      // Construir un objeto JavaScript con los pares clave-valor de formData
        const formDataObj = {};
        formData.forEach(function(value, key) {
            formDataObj[key] = value;
        });
        
        // Convertir el objeto JavaScript en una cadena JSON
        const formDataJson = JSON.stringify(formDataObj);
        //console.log(formDataJson);            

             // Enviar los datos a un archivo PHP usando ajax
             $.ajax({
                url:'../ajax/add_alumno.php',
                method:'POST',
                data: formDataJson,
                success:function(data){                    
                    Swal.fire(
                        'Exito!',
                        'Se ha realizado correctamente',
                        'success'
                      )
                .then(function(){
                               location.reload();
                               }
                );
                }       
                });//fin ajax    



    });
  });







