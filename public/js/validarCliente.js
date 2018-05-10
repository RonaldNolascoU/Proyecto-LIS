var PrimerNombre = false;
var PrimerApellido = false;
var DUI = false;
var telefono = false;
var correo = false;
var clave = false;
var img = false;

$(document).ready(function () {
    $(document).on('click', '#btnIngresar', function () {
        var original = $('#Clave').val();
        original = original.trim();
        if (PrimerNombre && PrimerApellido && DUI && telefono && correo && clave && img && original != "") {
            $('#frmCliente').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })

    $(document).on('keyup blur focus', '#PrimerNombre', function () {
        var cadena = $('#PrimerNombre').val();
        var nombre = this.getAttribute('id');
        PrimerNombre = validarCadena(cadena, nombre);
    });

    $(document).on('keyup blur focus', '#PrimerApellido', function () {
        var cadena = $('#PrimerApellido').val();
        var nombre = this.getAttribute('id');
        PrimerApellido = validarCadena(cadena, nombre);
    });

    $(document).on('keyup blur focus', '#Telefono', function () {
        var cadena = $('#Telefono').val();
        var nombre = this.getAttribute('id');
        telefono = validarTelefono(cadena, nombre);
    });

    $(document).on('keyup blur focus', '#DUI', function () {
        var cadena = $('#DUI').val();
        var nombre = this.getAttribute('id');
        DUI = validarDUI(cadena, nombre);
    });

    $(document).on('keyup blur focus', '#Correo', function () {
        var cadena = $('#Correo').val();
        var nombre = this.getAttribute('id');
        correo = validarCorreo(cadena, nombre);
    });

    $(document).on('keyup blur focus', '#Confirmar', function () {
        clave = validarConfirmacion();
    });

    $(document).on('change', '#Imagen', function () {
        var valor = $('#Imagen').val();
        var patron = new RegExp('.[jpg|JPG|png|PNG|jpeg|JPEG]$');
        if (patron.test(valor)) {
            img = true;
        } else {
            $('.Imagen').text('Solo se aceptan imagenes')
            img = false;
        }
    })
});