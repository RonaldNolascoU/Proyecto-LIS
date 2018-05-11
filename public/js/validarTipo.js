var Nombre = false;

$(document).ready(function () {
    $(document).on('focus keyup blur', '#Nombre', function () {
        var cadena = $('#Nombre').val();
        var nombre = this.getAttribute('id');
        Nombre = validarNombre(cadena, nombre);
    })

    $(document).on('click', '#btnTipo', function () {
        if (Nombre) {
            $('#frmTipo').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })
})