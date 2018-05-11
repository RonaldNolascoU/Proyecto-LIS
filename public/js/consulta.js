$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function cliente(id) {
    $.ajax({
        type: 'POST',
        url: '/conseguirCliente',
        data: { id: id },
        success: function (cliente) {
            $('#cliente').text(cliente.PrimerNombre + " " + cliente.PrimerApellido)
        },
        error: function () {

        }
    });
}

function llenar() {
    var vet = $('#vet').val();
    $.ajax({
        type: 'POST',
        url: '/conseguirConsulta',
        data: { id: vet },
        success: function (consulta) {
            console.log(consulta)
            if (consulta != "") {
                var actual = new Date();
                var nac = new Date(consulta.FechaNacimiento);
                var dif = actual - nac;
                $('#id').val(consulta.id);
                $('#mascota').attr('src', '../img/Mascotas/' + consulta.imagen);
                $('#nombre').text(consulta.NombreMascota);
                $('#edad').text(Math.round(dif / (1000 * 60 * 60 * 24 * 365)));
                $('#tipo').text(consulta.NombreTipo);
                $('#peso').text(consulta.Peso);
                $('#altura').text(consulta.Altura);
                cliente(consulta.cliente_id);
                $('#fecha').text(actual.toLocaleDateString() + ', ' + consulta.HoraLlegada);
                llenarSintomas();
                llenarDiagnostico();
                llenarServicio();
                $('#info').show();
                $('#error').hide();
            } else {
                $('#id').val("");
                $('#info').hide();
                $('#error').show();
            }
        },
        error: function () {
            $('#id').val("");
            $('#info').hide();
            $('#error').show();
        }
    });
}

function llenarSintomas() {
    var id = $('#id').val();
    $('#listaSintomas').empty();
    $.ajax({
        type: 'POST',
        url: '/llenarSintomas',
        data: { id: id },
        success: function (sintomas) {
            $('#listaSintomas').append('<li class="collection-header teal-text"><h6 class="center-align">Sintomas</h6></li>');
            sintomas.forEach(function (valor, indice) {
                $('#listaSintomas').append('<li class="c-item"><div class="valor-li"><span>' + valor.DescripcionSintoma + '</span></div><div valid="' + valor.id + '" class="btn-li eliminarSintoma"><a class="btn-floating waves-effect waves-light red btn-small"><i class="material-icons tiny">remove</i></a></div></li>');
            });
            $('#Sintoma').val("");
            $('#Sintoma').focus();
        },
        error: function () {
        }
    })
}

function llenarDiagnostico() {
    var id = $('#id').val();
    $('#diagnosticos').empty();
    $.ajax({
        type: 'POST',
        url: '/llenarDiagnosticos',
        data: { id: id },
        success: function (diagnosticos) {
            var tabs = 0;
            diagnosticos.Diagnosticos.forEach(function (valor, indice) {
                var card = '<div class="col xl6"><div class="card"><div class="card-image teal white-text center-align"><i class="material-icons large">local_hospital</i><a valid="' + valor.id + '" class="btn-floating halfway-fab waves-effect waves-light red eliminarDiagnostico"><i class="material-icons">remove</i></a></div><div class="card-content"><p id="diagnostico">' + valor.DescripcionDiagnostico + '</p></div><div class="card-tabs"><ul class="tabs tabs-fixed-width teal-text">';
                diagnosticos.Medicamentos[indice].forEach(function (medicamento, i) {
                    card += '<li class="tab"><a href="#medicamento' + medicamento.id + '">Medicamento</a></li>';
                    tabs++;
                })
                card += '</ul></div><div class="card-content grey lighten-4">';
                diagnosticos.Medicamentos[indice].forEach(function (medicamento, i) {
                    card += '<div id="medicamento' + medicamento.id + '">' + medicamento.NombreMedicamento + ', ' + medicamento.Medida + '<div><a valid="' + medicamento.id + '" class="btn-floating waves-effect waves-light red btn-small eliminarMedicamento secondary-content"><i class="material-icons tiny">close</i></a></div></div>';
                });
                card += '</div><div class="card-action"><a id="mostrarModal" valid="' + valor.id + '" class="modal-trigger" href="#modal8">Ingresar medicamento</a></div></div></div>'
                $('#diagnosticos').append(card);
            });
            if (tabs != 0) {
                $('.tabs').tabs();
            }
        },
        error: function () {
        }
    })
}

function llenarServicio() {
    var id = $('#id').val();
    $('#listaServicios').empty();
    $.ajax({
        type: 'POST',
        url: '/llenarServicios',
        data: { id: id },
        success: function (servicios) {
            $('#listaServicios').append('<li class="collection-header teal-text"><h6 class="center-align">Servicios</h6></li>');
            servicios.forEach(function (valor, indice) {
                $('#listaServicios').append('<li class="c-item"><div class="valor-li"><span>' + valor.DescripcionServicio + ', costo: $' + valor.Precio + '</span></div><div valid="' + valor.id + '" class="btn-li eliminarServicio"><a class="btn-floating waves-effect waves-light red btn-small"><i class="material-icons tiny">remove</i></a></div></li>');
            });
            $('#Servicio').val("");
            $('#Precio').val("");
            $('#Servicio').focus();
        },
        error: function () {
        }
    })
}

function verificar() {
    var id = $('#id').val();
    if (id == "") {
        console.log('si2')
        llenar();
    }
}

$(document).ready(function () {
    llenar();
    window.setInterval(verificar, 1000);
    $(document).on('click', '#recargar', function () {
        verificar();
    });

    $(document).on('click', '#finalizar', function () {
        var id = $('#id').val();
        swal({
            title: "Esta seguro?",
            text: "Se finalizara la consulta",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '/finalizar',
                        data: { id: id },
                        success: function (respuesta) {
                            $('#id').val("");
                        },
                        error: function () {
                        }
                    })
                }
            });
    });

    $(document).on('click', '#ingresarSintoma', function () {
        var id = $('#id').val();
        var sintoma = $('#Sintoma').val();
        sintoma = sintoma.trim();
        if (sintoma != "") {
            $('#listaSintomas').empty();
            $.ajax({
                type: 'POST',
                url: '../../Sintoma',
                data: { id: id, sintoma: sintoma },
                success: function (respuesta) {
                    if (respuesta == 'OK') {
                        llenarSintomas();
                    } else {
                        swal("Error", "Revise lo ingresado en el campo de sintomas", "error");
                    }
                },
                error: function () {

                }
            })
        } else {
            M.toast({ html: "El campo de sintomas debe estar lleno" })
            $('#Sintoma').val("");
            $('#Sintoma').focus();
        }
    });

    $(document).on('click', '.eliminarSintoma', function () {
        var consulta_id = $('#id').val();
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se eliminara el sintoma",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Sintoma/' + id,
                        data: { _method: 'DELETE', consulta_id: consulta_id },
                        success: function (sintomas) {
                            llenarSintomas();
                        },
                        error: function () {

                        }
                    })
                }
            });
    })

    $(document).on('click', '#ingresarDiagnostico', function () {
        var id = $('#id').val();
        var diagnostico = $('#Diagnostico').val();
        diagnostico = diagnostico.trim();
        if (diagnostico != "") {
            $.ajax({
                type: 'POST',
                url: '../../Diagnostico',
                data: { id: id, diagnostico: diagnostico },
                success: function (respuesta) {
                    if (respuesta == 'OK') {
                        llenarDiagnostico();
                    } else {
                        swal("Error", "Revise lo ingresado en el campo de diagnosticos", "error");
                    }
                },
                error: function () {

                }
            })
        } else {
            M.toast({ html: "El campo de diagnosticos debe estar lleno" });
        }
        $('#Diagnostico').val("");
        $('#Diagnostico').focus();
    })

    $(document).on('click', '.eliminarDiagnostico', function () {
        var consulta_id = $('#id').val();
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se eliminara el diagnostico",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Diagnostico/' + id,
                        data: { _method: 'DELETE', consulta_id: consulta_id },
                        success: function (sintomas) {
                            llenarDiagnostico();
                        },
                        error: function () {

                        }
                    })
                }
            });
    })

    $(document).on('click', '#mostrarModal', function () {
        var id = this.getAttribute('valid');
        $('#diagnostico_id').val(id);
    });

    $(document).on('click', '#ingresarMedicamento', function () {
        var id = $('#diagnostico_id').val();
        var tipo = $('#Tipo').val();
        var nombre = $('#NombreMedicamento').val();
        var medida = $('#Medida').val();
        nombre = nombre.trim();
        medida = medida.trim();
        if (nombre == "" && medida == "") {
            M.toast({ html: "Todos los campos deben estar llenos" })
            $('#NombreMedicamento').val("");
            $('#Medida').val("");
            $('#NombreMedicamento').focus();
        } else {
            $.ajax({
                type: 'POST',
                url: '../../Medicamento',
                data: { id: id, tipo: tipo, nombre: nombre, medida: medida },
                success: function (respuesta) {
                    if (respuesta == 'OK') {
                        $('#Tipo').val("");
                        $('#NombreMedicamento').val("");
                        $('#Medida').val("");
                        $('#modal8').modal('close');
                        llenarDiagnostico();
                    } else {
                        swal("Error", "Revise lo ingresado en los campos", "error");
                    }
                },
                error: function () {

                }
            })
        }
    });

    $(document).on('click', '.eliminarMedicamento', function () {
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se eliminara el medicamento",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Medicamento/' + id,
                        data: { _method: 'DELETE' },
                        success: function (respuesta) {
                            llenarDiagnostico();
                        },
                        error: function () {

                        }
                    })
                }
            });
    })

    $(document).on('click', '#ingresarServicio', function () {
        var id = $('#id').val();
        var servicio = $('#Servicio').val();
        var precio = $('#Precio').val();
        servicio = servicio.trim();
        precio = precio.trim();
        if (servicio != "" && precio != "" && $.isNumeric(precio)) {
            $.ajax({
                type: 'POST',
                url: '../../Servicio',
                data: { id: id, servicio: servicio, precio: precio },
                success: function (respuesta) {
                    if (respuesta == 'OK') {
                        llenarServicio();
                    } else {
                        swal("Error", "Revise lo ingresado en el campo de servicios y precio", "error");
                    }
                },
                error: function () {

                }
            })
        } else {
            M.toast({ html: "Verifique lo ingresado" })
            $('#Servicio').focus();
        }
    })

    $(document).on('click', '.eliminarServicio', function () {
        var id = this.getAttribute('valid');
        swal({
            title: "Esta seguro?",
            text: "Se eliminara el servicio",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Servicio/' + id,
                        data: { _method: 'DELETE' },
                        success: function (respuesta) {
                            llenarServicio();
                        },
                        error: function () {

                        }
                    })
                }
            });

    })

    $(document).on('click', '#cancelar', function () {
        $('#Tipo').val("");
        $('#NombreMedicamento').val("");
        $('#Medida').val("");
    })
});