$(document).ready(function(){
    $('#btnEliminarMascota').bind('click', function(){
        if(confirm('Seguro desea borrar esta mascota')){
            $('#eliminar').submit();
        }
    });
});

function eliminarCaracteristica($id){
    if(confirm('Seguro desea borrar esta caracteristica')){
        var nombre = 'EC-' + $id;
        $('#' + nombre).submit();
    }
}