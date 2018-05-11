var Nombre = false;
var Correo = false;

$(document).ready(function () {
    $(document).on('focus keyup blur', '#Nombre', function () {
        var cadena = $('#Nombre').val();
        var nombre = this.getAttribute('id');
        Nombre = validarNombre(cadena, nombre);
    })

    $(document).on('focus keyup blur', '#Correo', function () {
        var cadena = $('#Correo').val();
        var nombre = this.getAttribute('id');
        Correo = validarCorreo(cadena, nombre);
    })

    $(document).on('click', '#btnUser', function () {
        if (Nombre && Correo) {
            $('#frmUser').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })
})