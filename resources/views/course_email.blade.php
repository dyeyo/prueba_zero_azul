<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Se agrego el curso de  {{$course['name']}}</h1>
    <h3>Descripción: {{$course['description']}}</h3>
    <span>{{$course['created_at']}}</span>
</body>
</html>