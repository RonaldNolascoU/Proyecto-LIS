<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>PDF - Factura de consulta</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
<body>
    <header>
        <h1 class="white-text center-align">StarPets</h1>
    </header>
    <section>
        <p>Felicidades {{$info->name}}, por unirte a la veterinaria; tu nivel de acceso es: {{$info->roles->first()->Name}} y 
        para acceder se le ha generado la clave: {{$info->password}}</p>
    </section>
</body>
</html>
