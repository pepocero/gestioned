//Funcion para poner bien los acentos
function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
  }


  function generarTarjeta(datos) {
    var tarjeta = $('<div class="card rounded-5 col-md-4 mx-auto tarjeta shadow-lg p-3 mb-5 bg-body rounded"></div>');
  
    // Agregar imagen de perfil
    var imagenPerfil = $('<img class="card-img-top rounded-circle imagen_alumno mx-auto mt-3" src="../images/user.png' + '" alt="Imagen de perfil">');
    tarjeta.append(imagenPerfil);
  
    // Iterar sobre los datos y crear un elemento para cada campo
    $.each(datos, function(index, item) {
      var campo = decodeHtml(item.campo);
      var valor = decodeHtml(item.dato);
      var fila = $('<div class="row fila"></div>');
      var etiqueta = $('<div class="col fw-bold"></div>').text(campo + ": ");
      var valorCampo = $('<div class="col fst-italic"></div>').text(valor);
  
      fila.append(etiqueta).append(valorCampo);
      tarjeta.append(fila);
    });
  
    return tarjeta;
  }
  



// Obtener el JSON con AJAX y generar la tarjeta
$.ajax({
    url: '../ajax/ajax.php',
    type: 'POST',
    data: {idProfe:idProfe,control:'get_profe'},
    dataType: 'json',
    success: function(data) {
      //console.log(data);
        // Decodificar el JSON recibido
        data = JSON.parse(decodeURIComponent(JSON.stringify(data)));
        var tarjeta = generarTarjeta(data);
        $('#contenedor-tarjeta').append(tarjeta);
    },
    error: function(xhr, status, error) {
      console.log("Error al obtener el JSON: " + error);
    }
  });

