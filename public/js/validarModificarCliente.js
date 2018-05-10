var PrimerNombre = true;
var PrimerApellido = true;
var telefono = true;

$(document).ready(function () {
    $(document).on('click','#btnModificar',function(){
        if(PrimerNombre && PrimerApellido && telefono){
            $('#frmModificarCliente').submit();
        }else{
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
})