var bandera = false;

$(document).ready(function () {
    $(document).on('focus keyup blur', '#Caracteristica', function () {
        var cadena = $('#Caracteristica').val();
        var nombre = this.getAttribute('id');
        bandera = validar(cadena, nombre);
    })

    $(document).on('click', '#btnAgregar', function () {
        if (bandera) {
            $('#frmCaracteristica').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })
})