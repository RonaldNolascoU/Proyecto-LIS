<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>PDF - Factura de consulta</title>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../../css/pdf.css" media="screen,projection" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="../../js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../js/materialize.min.js"></script>
    </head>
<body>
    <header>
        <h1 class="white-text center-align">StarPets</h1>
    </header>
    <table>
        <thead>
            <tr>
                <td colspan="2"><h2>Comprobante de pago</h2></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">{{$consulta->FechaConsulta}}</td>
            </tr>
            <tr>
                <td colspan="2">Encargado de la mascota: {{$consulta->mascota->cliente->PrimerNombre}} {{$consulta->mascota->cliente->PrimerApellido}}</td>
            </tr>
            <tr>
                <td>Mascota: {{$consulta->mascota->NombreMascota}}</td>
                <td>Tipo de mascota: {{$consulta->mascota->tipo->NombreTipo}}</td>
            </tr>
            <tr>
                <td>Altura: {{$consulta->Altura}}</td>
                <td>Peso: {{$consulta->Peso}}</td>
            </tr>
            <tr>
                <td colspan="2"><h3>Diagnosticos</h3></td>
            </tr>
            @foreach($consulta->diagnosticos as $diagnostico)
                <tr>
                    <td colspan="2"><span>-{{$diagnostico->DescripcionDiagnostico}}</span></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><h3>Medicamentos</h3></td>
            </tr>
            @foreach($consulta->diagnosticos as $diagnostico)
                @foreach($diagnostico->medicamentos as $medicamento)
                    <tr>
                        <td colspan="2">-{{$medicamento->NombreMedicamento}}, de tipo {{$medicamento->tipo->TipoMedicamento}}, suministrar: {{$medicamento->Medida}} </td>
                    </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="2"><h3>Servicios</h3></td>
            </tr>
            @foreach($consulta->servicios as $servicio)
                <tr>
                    <td colspan="2">-{{$servicio->DescripcionServicio}}, costo: ${{$servicio->Precio}}</td>
                </tr>
            @endforeach
            <tr>
                <td class="left" colspan="2"><b>Total: </b> {{$consulta->pago->Monto}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
