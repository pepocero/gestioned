
//Sweet Alert simple
function sweetAlert(title, text, icon) {
    Swal.fire({
        icon: icon,
        title: title,
        text: text
        //footer: '<a href="">Why do I have this issue?</a>'
      })
}

//Sweet Alert simple que recarga la página una vez que le das clic al boton ok
function sweetAlertReload(title, text, icon) {
    Swal.fire({
        title: title,
        text: text,
        icon:icon})
    .then(function(){
                location.reload();
            }
    );
}

//Sweet Alert para borrar con ajax
//let ajaxParams = {idCarrera:id, control:"edit_campo_alumnos", texto:cellValue};
function sweetAjaxDelete(title, text, icon, urlAjax, ajaxParams) {

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, puedes borrarlo!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url:urlAjax,
                method:'POST',
                data: ajaxParams,
                success:function(data){
                    Swal.fire(
                        'Borrado!',
                        'Se ha borrado correctamente',
                        'success'
                      )
                .then(function(){
                               location.reload();
                               }
                );
                }       
                });//fin ajax          
        }
      })
}

//SweetAlert para 1 Input con ajax. En el id de carrera se le pasa un numero que es el id de carrera. Si no hay ningun id, ponerle un 0 (cero)
//El TEXTO es lo que se recibe en el PHP, usar Input::get('texto');
async function sweetAjaxInput(title, urlAjax, control, idCarrera) {
    var texto = "";
    const { value: formValues } = await Swal.fire({
        title: title,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        html:
          '<input id="swal-input" class="swal2-input">',
        focusConfirm: false,
        preConfirm: () => {          
          texto = document.getElementById('swal-input').value;        
          const pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 _-]*$/;

          //Compruebo si el texto está vacio
            if (texto == "") {
                sweetAlert("Error", "El campo no puede estar vacio", "error");
            }else{

                // Valida que el texto no contenga caracteres especiales. No funciona mientras se escribe en el input. Funciona al darle a aceptar
                
                if (!pattern.test(texto)) {
                    sweetAlert("Error", "El campo no puede contener caracteres especiales", "error");
                    return false;
                }else{

                    $.ajax({
                        url:urlAjax,
                        method:'POST',
                        //data:{idCarrera:idCarrera, control:control, texto:texto},
                        data:{texto:texto, control:control, idCarrera:idCarrera},
                        success:function(data){
                            Swal.fire(
                                'Genial!',
                                'Proceso realizado correctamente',
                                'success'
                            )
                            .then(function(){
                                        location.reload();
                                        }
                            );
                        }       
                        });
            }
            }
        }
      })   
}

//SweetAlert para 2 Inputs con ajax para insertar materias
async function sweet2Inputs(title, urlAjax, idCarrera, control,placeholder1, placeholder2) {
    var texto = "";
    const { value: formValues } = await Swal.fire({
        title: title,showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        html:
        '<input id="input_materia" class="swal2-input" placeholder="'+placeholder1+'">' +
        '<input id="input_anio" class="swal2-input" placeholder="'+placeholder2+'" type="number">',
        focusConfirm: false,
        preConfirm: () => {          
            materia = document.getElementById('input_materia').value;
            anio = document.getElementById('input_anio').value;
            
          //Compruebo si la materia está vacia
            if (materia == "" || anio == "") {
                sweetAlert("Error", "Ningún campo puede estar vacio", "error");
            }else if (anio <= 0) {
                sweetAlert("Error", "El año no puede ser menor o igual a cero", "error");
            }else{

                $.ajax({
                    url:urlAjax,
                    method:'POST',
                    //data:{idCarrera:idCarrera, control:"update_carrera", carrera:value},
                    data:{idCarrera:idCarrera, control:control, materia:materia, anio:anio},
                    success:function(data){
                        Swal.fire(
                            'Genial!',
                            'Proceso realizado correctamente',
                            'success'
                        )
                        .then(function(){
                                    location.reload();
                                    }
                        );
                    }       
                    });
            }
        }
      })   
}


//Sweet Alert para enviar datos en el ajaxParams con ajax. En reload si le pasas un true, recarga la página. Con false no hace nada
//let ajaxParams = {idCarrera:id, control:"edit_campo_alumnos", texto:cellValue};
function sweetAjaxSend(title, text, icon, urlAjax, ajaxParams, reload) {
    
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Guardar en la base de datos!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url:urlAjax,
                method:'POST',
                data: ajaxParams,
                success:function(data){
                    Swal.fire(
                        'Exito!',
                        'Proceso realizado correctamente',
                        'success'
                      )
                .then(function(){
                                 if (reload) {
                                    location.reload();
                                 }
                               }
                );
                }       
                });//fin ajax          
        }else if (result.dismiss === Swal.DismissReason.cancel) {
            sweetAlert("Cancelado", "No se ha realizado ningún cambio", "error");            
          }
      })
}


//Sweet Alert para enviar datos en el ajaxParams con ajax
//let ajaxParams = {idCarrera:id, control:"edit_campo_alumnos", texto:cellValue};
//Con el sendCode se puede ejecutar código JavaScript después de que se envía el ajax
function sweetAjaxConfirm(title, text, icon, urlAjax, ajaxParams, sendCode) {

    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Guardar en la base de datos!'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url:urlAjax,
                method:'POST',
                data: ajaxParams,
                success:function(data){
                    eval(sendCode); // evalúa la cadena 'sendCode' como si fuera código JavaScript                    
                }       
                });//fin ajax          
        }else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('No se han hecho cambios', '', 'info')
          }
      })
}

//INGRESAR CLAVE PARA PODER HACER ALGO
//El TEXTO es lo que se recibe en el PHP, usar Input::get('texto');
async function sweetAjaxPassword(title, urlAjax, ajaxParams) {
    var texto = "";
    const { value: formValues } = await Swal.fire({
        title: title,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        html:
          '<input id="swal-input" class="swal2-input secure-input">',
        focusConfirm: false,
        preConfirm: () => {          
          texto = document.getElementById('swal-input').value;        
          const pattern = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 _-]*$/;

          //Compruebo si el texto está vacio
            if (texto == "") {
                sweetAlert("Error", "El campo no puede estar vacio", "error");
            }else{

                // Valida que el texto no contenga caracteres especiales. No funciona mientras se escribe en el input. Funciona al darle a aceptar
                
                if (!pattern.test(texto)) {
                    sweetAlert("Error", "El campo no puede contener caracteres especiales", "error");
                    return false;
                }else if (texto === "4724") {

                    $.ajax({
                        url:urlAjax,
                        method:'POST',
                        //data:{idCarrera:idCarrera, control:control, texto:texto},
                        data: ajaxParams,
                        success:function(data){
                            Swal.fire(
                                'Genial!',
                                'Proceso realizado correctamente',
                                'success'
                            )
                            .then(function(){
                                        location.reload();
                                        }
                            );
                        }       
                        });
            }else{
                sweetAlert("Error", "La clave es incorrecta", "error");
            }
            }
        }
      })   
}

//SIMPLE AJAX SEND
//let ajaxParams = {idCarrera:id, control:"edit_campo_alumnos", texto:cellValue};
function ajaxSend(urlAjax, ajaxParams, reload) {
              $.ajax({
                url:urlAjax,
                method:'POST',
                data: ajaxParams,
                success:function(data){
                    Swal.fire(
                        'Exito!',
                        'Proceso realizado correctamente',
                        'success'
                      )
                .then(function(){
                                 if (reload) {
                                    location.reload();
                                 }
                               }
                );
                }       
                });//fin ajax   
}