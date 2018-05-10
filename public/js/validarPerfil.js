var Clave = false;

function validarConfirmacion() {
    if ($('#Clave').val() == $('#Confirm').val()) {
        $(".Clave").text('');
        $("#Confirm").removeClass("invalid");
        $("#Confirm").addClass("valid");
        return true;
    } else {
        $(".Clave").text('La clave y la confirmacion no concuerdan');
        $("#Confirm").removeClass("valid");
        $("#Confirm").addClass("invalid");
        return false;
    }
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    $('#confirmacion').show();
    $('#cambio').hide();

    $(document).on('click', '#btnVerificar', function () {
        var clave = $('#Original').val();
        $.ajax({
            type: 'POST',
            url: '/verificarClave',
            data: { clave: clave },
            success: function (respuesta) {
                if (respuesta == 'OK') {
                    $('#confirmacion').hide();
                    $('#cambio').show();
                } else {
                    $('#Original').val("");
                    $('#Original').focus();
                    M.toast({ html: "La clave no coincide" });
                }
            },
            error: function () {

            }
        });
    });

    $(document).on('click', '#cambiarImagen', function () {
        if (Clave) {
            $('#cambio').submit();
        } else {
            swal("Error", "Revise lo ingresado", "error");
        }
    })

    $(document).on('click', '#cancelar', function () {
        $('#confirmacion').show();
        $('#cambio').hide();
        $('#Original').val("");
        $('#Clave').val("");
        $('#Confirm').val("");
    });

    $(document).on('keyup blur focus', '#Confirm', function () {
        Clave = validarConfirmacion();
    });
})