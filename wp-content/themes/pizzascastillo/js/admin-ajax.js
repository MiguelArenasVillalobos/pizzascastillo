$ = jQuery.noConflict();

$(document).ready(function() {
  // Obtener la URL de admin-ajax.php
  // console.log(url_eliminar.ajaxurl);
  
  $('.borrar_registro').on('click', function(e) {
    e.preventDefault();

    var id = $(this).attr('data-reservaciones');

    swal({
      title: "Estás seguro?",
      text: "Está acción no se puede revertir",
      icon: "warning",
      buttons: ["Cancelar", "Sí, Eliminar"],
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          type: 'post',
          data: {
            'action' : 'pizzascastillo_eliminar',
            'id' : id,
            'tipo' : 'eliminar'
          },
          url: url_eliminar.ajaxurl,
          success: function(data) {
            var resultado = JSON.parse(data);
            if(resultado.respuesta == 1) {
              jQuery("[data-reservaciones='"+ resultado.id +"']").parent().parent().remove();

              swal("La reservación " + resultado.id + " se ha eliminado", {
                title: "Eliminado!",
                icon: "success",
              });
            }
          }
        });
      }
    });



  });
});


