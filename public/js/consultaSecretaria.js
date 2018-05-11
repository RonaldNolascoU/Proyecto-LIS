$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function mascota(id) {
    $.ajax({
        type: 'POST',
        url: '/conseguirMascota',
        data: { id: id },
        success: function (mascota) {
            document.getElementById('mascota' + id).innerHTML = mascota.NombreMascota;
        },
        error: function () {
            document.getElementById('mascota' + id).innerHTML = 'Error';
        }
    });
}

function veterinario(id) {
    $.ajax({
        type: 'POST',
        url: '/conseguirVeterinario',
        data: { id: id },
        success: function (user) {
            var clase = document.getElementsByClassName('veterinario' + id);
            for (var i = 0; i < clase.length; i++) {
                clase[i].innerHTML = user.name
            }
        },
        error: function () {
            document.getElementsByClassName('#veterinario' + id).innerHTML = 'Error';
        }
    });
}

function llenar() {
    $('.info').remove();
    document.getElementById("entrantes").innerHTML = "<thead><tr><th>Mascota</th><th>Veterinario</th><th>Cambiar veterinario</th><th>Detalles</th><th>Eliminar</th><th>Pasar</th></tr></thead><tbody id='EntrantesBody'>";
    $.ajax({
        type: 'POST',
        url: '/listaEntrantes',
        success: function (consultas) {
            if (consultas.length) {
                consultas.forEach(function (valor, indice) {
                    $('#entrantes').append('<tr class="info"><td id="mascota' + valor.mascota_id + '"></td><td class="veterinario' + valor.user_id + '"></td><td><a href="#modal7" valid="' + valor.id + '" id="edit" title="Cambiar veterinario" class="modal-trigger btn-floating blue"><i class="material-icons">cached</i></a></td><td><a title="Detalles consulta" valid="' + valor.id + '" id="show" href="#modal6" class="modal-trigger btn-floating"><i class="material-icons">dehaze</i></a></td><td><a class="modal-trigger btn-floating red" valid="' + valor.id + '" id="delete"><i class="material-icons">delete</i></a><form id="' + valor.id + '" action="Consulta/' + valor.id + '" method="POST" style="display: none;"><input type="hiden" name = " _token" value = "' + $('meta[name="csrf-token"]').attr('content') + '" ><input name="_method" type="hidden" value="DELETE"></form></td><td><a title="Pasar consulta" valid="' + valor.id + '" id="next" class="btn-floating brown"><i class="material-icons">navigate_next</i></a><form id="pasar' + valor.id + '" action="/pasar" method="POST" style="display: none;"><input type="hiden" name = " _token" value = "' + $('meta[name="csrf-token"]').attr('content') + '" ><input name="id" type="hidden" value="' + valor.id + '"></form></td></tr>')
                    mascota(valor.mascota_id);
                    veterinario(valor.user_id)
                });
                document.getElementById("entrantes").innerHTML += "</tbody>";
                paginarEntrantes()
            } else {
                $('#entrantes').append("<tr class='info'><td colspan='6' class='center-aling'>No hay registros</td></tr>");
                document.getElementById("entrantes").innerHTML += "</tbody>";
                paginarEntrantes()
            }
        },
        error: function () {
            $('#entrantes').append("<tr class='info'><td colspan='6' class='center-aling'>No hay registros</td></tr>");
            document.getElementById("entrantes").innerHTML += "</tbody>";
            paginarEntrantes();
        }
    });
}

function paginarEntrantes() {
    $('.controladorEntrantes').jPages({
        containerID: 'EntrantesBody',
        perPage: 5
    });
}

function libres() {
    $('#listaLibres').empty();
    $('#listaLibres').append('<li class="collection-header teal-text"><h4 class="center-align">Veterinarios desocupados</h4></li>');
    $.ajax({
        type: 'POST',
        url: '/veterinariosDesocupados',
        success: function (vet) {
            vet.forEach(function (valor, indice) {
                $('#listaLibres').append('<li class="collection-item">' + valor.name + '</li>');
            });
        },
        error: function () {
            $('#listaLibres').append('<li class="collection-item">Todos los veterniarios atienden a un paciente en este momento</li>');
        }
    });
}

function pago() {
    $('#pago').empty();
    $('.infoPago').remove();
    var contenido = '<thead><tr><th>Dueño</th><th>Mascota</th><th>Veterinario</th><th>Detalles</th><th>Pagar</th></tr></thead><tbody id="PagoBody">';
    $.ajax({
        type: 'POST',
        url: '/listaPago',
        success: function (consultas) {
            if (consultas.length) {
                consultas.forEach(function (valor, indice) {
                    contenido += '<tr class="infoPago"><td>' + valor.PrimerNombre + ' ' + valor.PrimerApellido + '</td><td>' + valor.NombreMascota + '</td><td class="veterinario' + valor.user_id + '"></td><td><a title="Detalles consulta" valid="' + valor.id + '" id="show" href="#modal6" class="modal-trigger btn-floating"><i class="material-icons">dehaze</i></a></td><td><a title="Pagar consulta" valid="' + valor.id + '" id="pagar" href="#modal9" class="modal-trigger btn-floating brown"><i class="material-icons">monetization_on</i></a></td></tr>'
                    veterinario(valor.user_id);
                });
                contenido += '</tbody>';
                $('#pago').append(contenido);
                paginarPago()
            } else {
                document.getElementById("pago").innerHTML = contenido;
                $('#pago').append("<tr class='info'><td colspan='6' class='center-align'>No hay registros</td></tr>");
                document.getElementById("pago").innerHTML += "</tbody>";
                paginarPago()
            }

        },
        error: function () {
            $('#pago').append("<tr class='info'><td colspan='6' class='center-align'>No hay registros</td></tr>");
            document.getElementById("entrantes").innerHTML += "</tbody>";
            paginarPago();
        }
    });
}

function paginarPago() {
    $('.controladorPago').jPages({
        containerID: 'PagoBody',
        perPage: 1
    });
}

function conseguirCosto(id) {
    $.ajax({
        type: 'POST',
        url: '/costo',
        data: { id: id },
        success: function (costo) {
            $('#Costo').empty();
            $('#Costo').append('<b>Total a cancelar:</b> $' + costo);
            $('#consulta_costo').val(costo);
        },
        error: function () {

        }
    });
}

$(document).ready(function () {
    libres();
    llenar();
    pago();
    window.setInterval(llenar, 50000);
    window.setInterval(pago, 50000);
    window.setInterval(libres, 10000);

    $(document).on('click', '#show', function (e) {
        var id = this.getAttribute('valid')
        $.get("Consulta/" + id, function (c) {
            document.getElementById("DetalleNombre").innerHTML = "<b>Nombre de la mascota: </b>" + c.mascota[0].NombreMascota;
            document.getElementById("DetalleFecha").innerHTML = "<b>Fecha y hora: </b>" + c.consulta[0].FechaConsulta + ", " + c.consulta[0].HoraLlegada;
            document.getElementById("DetallePeso").innerHTML = "<b>Peso de la mascota: </b>" + c.consulta[0].Peso;
            document.getElementById("DetalleAltura").innerHTML = "<b>Altura de la mascota: </b>" + c.consulta[0].Altura;
            document.getElementById("DetalleVeterinario").innerHTML = "<b>Nombre del veterinario: </b>" + c.veterinario[0].name;
        });
    });

    $(document).on('click', '#edit', function (e) {
        var id = this.getAttribute('valid')
        $.get("Consulta/" + id + "/edit", function (c) {
            console.log(c)
            document.getElementById("EditNombre").innerHTML = "<b>Nombre de la mascota: </b>" + c.mascota[0].NombreMascota;
            document.getElementById("EditFecha").innerHTML = "<b>Fecha y hora: </b>" + c.consulta[0].FechaConsulta + ", " + c.consulta[0].HoraLlegada;
            document.getElementById("EditPeso").innerHTML = "<b>Peso de la mascota: </b>" + c.consulta[0].Peso;
            document.getElementById("EditAltura").innerHTML = "<b>Altura de la mascota: </b>" + c.consulta[0].Altura;
            $('#Veterianrio').find('option[value="' + c.veterinario[0].id + '"]').prop('selected', true);
            $('#Veterianrio').formSelect();
        });
    });

    $(document).on('click', '#delete', function (e) {
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se borrara esta consulta",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $('#' + id).submit();
                }
            });
    })

    $(document).on('click', '#next', function () {
        var id = this.getAttribute('valid')
        $('#pasar' + id).submit();
    })

    $(document).on('click', '#pagar', function () {
        var id = this.getAttribute('valid');
        $.get("Consulta/" + id, function (c) {
            document.getElementById("PagoNombre").innerHTML = "<b>Nombre de la mascota: </b>" + c.mascota[0].NombreMascota;
            document.getElementById("PagoFecha").innerHTML = "<b>Fecha y hora: </b>" + c.consulta[0].FechaConsulta + ", " + c.consulta[0].HoraLlegada;
            document.getElementById("PagoVeterinario").innerHTML = "<b>Nombre del veterinario: </b>" + c.veterinario[0].name;
            $('#pago_id').val(id);
            conseguirCosto(id);
        });
    })

    $(document).on('click', '#btnPagar', function () {
        var id = $('#pago_id').val();
        console.log(id)
        $.ajax({
            type: 'POST',
            url: '/pagar',
            data: { id: id },
            success: function (respuesta) {
                window.location.assign('/pdf/' + id);
                $('#modal9').modal('close');
                llenar();
                pago();
            },
            error: function () {

            }
        })
    });

    $(document).on('click', '#recargar', function () {
        llenar();
        pago();
    })
});