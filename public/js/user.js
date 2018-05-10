$(document).ready(function(){
    $('.controladorUsuarios').jPages({
        containerID: 'usuarios',
    });

    $(document).on('click','#degradar',function(){
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se degradara a este usuario y ya no podra acceder a la plataforma",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $('#'+id).submit();
            }
          });
    });

    $(document).on('click','#eliminar',function(){
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se eliminara la opcion de utilizar este tipo en la plataforma",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
                $('#'+id).submit();
            }
          });
    });
})