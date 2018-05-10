var mascota = false;
var fecha = false;
var img = false;

$(document).ready(function () {
    $(document).on('focus keyup blur change', '#Fecha', function () {
        var actual = new Date();
        var ingresado = new Date($('#Fecha').val())
        var min = new Date('1990-01-01');
        var diferencia = actual - ingresado;
        diferencia = Math.round(diferencia / 1000 / 60 / 60 / 24 / 365);
        if (ingresado > actual || diferencia >= 15) {
            $(".Fecha").text('Debe ingresar una fecha valida');
            $("#Fecha").removeClass("valid");
            $("#Fecha").addClass("invalid");
            fecha = false;
        } else {
            $(".Fecha").text('');
            $("#Fecha").removeClass("invalid");
            $("#Fecha").addClass("valid");
            fecha = true;
        }
    })

    $(document).on('focus keyup blur', '#Nombre', function () {
        var cadena = $('#Nombre').val();
        var nombre = this.getAttribute('id');
        mascota = validarNombre(cadena, nombre);
    })

    $(document).on('click', '#btnMascota', function () {
        if (mascota && fecha && img) {
            $('#frmMascota').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })

    $(document).on('change', '#Imagen', function () {
        var valor = $('#Imagen').val();
        var patron = new RegExp('.[jpg|JPG|png|PNG|jpeg|JPEG]$');
        if (patron.test(valor)) {
            $('.Imagen').text("");
            img = true;
        } else {
            $('.Imagen').text('Solo se aceptan imagenes')
            img = false;
        }
    })
})