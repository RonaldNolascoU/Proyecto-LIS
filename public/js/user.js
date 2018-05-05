$(document).ready(function(){
    $('.controladorUsuarios').jPages({
        containerID: 'usuarios',
    });

    $(document).on('click','#degradar',function(){
        var id = this.getAttribute('valid');
        if(confirm('Seguro desea degradar a este usuario')){
            $('#'+id).submit();
        }
    });
})