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

// Inicializa Quill para el textarea con id "Datos_Adicionales" con el valor de la consulta MySQL
const quill = new Quill('#Datos_Adicionales', {
  modules: {
    syntax: true,
  },
  placeholder: 'Agregar datos adicionales que no estén en el formulario',
  theme: 'snow',
});