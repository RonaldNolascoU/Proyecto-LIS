$(document).ready(function(){
    $('#btnEliminarMascota').bind('click', function(){
        swal({
            title: "Esta seguro?",
            text: "Su mascota y todo lo relacionado a ella se eliminara de la plataforma",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $('#eliminar').submit();
            }
          });
    });
});

function eliminarCaracteristica($id){
    swal({
        title: "Esta seguro?",
        text: "Se eliminar la caracteristica",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            var nombre = 'EC-' + $id;
            $('#' + nombre).submit();
        }
      });
    
}