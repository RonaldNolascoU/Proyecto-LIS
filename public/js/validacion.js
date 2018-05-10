function validarCadena(cadena, nombre) {
    cadena = cadena.trim();
    if (cadena == "" || cadena.length == 0) {
        $("."+nombre).text('No puede estar vacio');
        $("#"+nombre).removeClass("valid");
        $("#"+nombre).addClass("invalid");
        return false;
    } else {
        var patron = new RegExp('[^a-zA-Z]+');
        if (patron.test(cadena)) {
            $("."+nombre).text('Solo debe contener letras');
            $("#"+nombre).removeClass("valid");
            $("#"+nombre).addClass("invalid");
            return false;
        } else {
            $("."+nombre).text('');
            $("#"+nombre).removeClass("invalid");
            $("#"+nombre).addClass("valid");
            return true;
        }
    }
}

function validarTelefono(cadena, nombre){
    var patron = new RegExp("^[267][0-9]{3}-[0-9]{4}$");
    if(patron.test(cadena)){
        $("."+nombre).text('');
        $("#"+nombre).removeClass("invalid");
        $("#"+nombre).addClass("valid");
        return true;
    }else{
        $("."+nombre).text('Debe ingresar un numero valido');
        $("#"+nombre).removeClass("valid");
        $("#"+nombre).addClass("invalid");
        return false;
    }
}

function validarDUI(cadena, nombre){
    var patron = new RegExp("^[0-9]{8}-[0-9]$");
    if(patron.test(cadena)){
        $("."+nombre).text('');
        $("#"+nombre).removeClass("invalid");
        $("#"+nombre).addClass("valid");
        return true;
    }else{
        $("."+nombre).text('Debe ingresar un DUI valido');
        $("#"+nombre).removeClass("valid");
        $("#"+nombre).addClass("invalid");
        return false;
    }
}

function validarCorreo(cadena, nombre){
    var patron = new RegExp("[a-zA-Z._0-9]+@[a-zA-Z0-9]+[.][a-zA-Z]+");
    if(patron.test(cadena)){
        $("."+nombre).text('');
        $("#"+nombre).removeClass("invalid");
        $("#"+nombre).addClass("valid");
        return true;
    }else{
        $("."+nombre).text('Debe ingresar un correo valido');
        $("#"+nombre).removeClass("valid");
        $("#"+nombre).addClass("invalid");
        return false;
    }
}

function validarConfirmacion(){
    if($('#Clave').val() == $('#Confirmar').val()){
        $(".Clave").text('');
        $("#Confirmar").removeClass("invalid");
        $("#Confirmar").addClass("valid");
        return true;
    }else{
        $(".Clave").text('La clave y la confirmacion no concuerdan');
        $("#Confirmar").removeClass("valid");
        $("#Confirmar").addClass("invalid");
        return false;
    }
}

function validarNombre(cadena,nombre){
    cadena = cadena.trim();
    if(cadena != ""){
        var patron = new RegExp('[0-9+=?/,<>{}]+');
        if(patron.test(cadena)){
            $("."+nombre).text('Solo deben ser letras');
            $("#"+nombre).removeClass("valid");
            $("#"+nombre).addClass("invalid");
            return false;
        }else{
            $("."+nombre).text('');
            $("#"+nombre).removeClass("invalid");
            $("#"+nombre).addClass("valid");
            return true;
        }
    }else{
        $("."+nombre).text('No puede estar vacio');
        $("#"+nombre).removeClass("valid");
        $("#"+nombre).addClass("invalid");
        return false;
    }
}