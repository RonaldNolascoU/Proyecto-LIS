function correo(e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: '/clienteMascota',
        data: { correo: $('#Cliente').val() },
        success: function (mascotas) {
            $('#Mascota').empty();
            mascotas.forEach(function (valor, indice) {
                $('#Mascota').append(new Option(valor.NombreMascota, valor.id, true, true));
            });
        },
        error: function () {
            $('#Mascota').empty();
            $('#Mascota').append('<option value="" disabled selected>Choose your option</option>');
        }
    });
}
$(document).ready(function () {
    $('#Cliente').focus(function (e) {
        correo(e)
    });
    $('#Cliente').keyup(function (e) {
        correo(e)
    });
    $('#Cliente').blur(function (e) {
        correo(e)
    });
});