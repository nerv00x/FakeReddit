@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Fecha</title>
</head>
<body>
    <h1>Fecha actual:</h1>
    <p>Día: {{ $dia }}</p>
    <p>Mes: {{ $mes }}</p>
    <p>Año: {{ $ano }}</p>
</body>
</html>
@endsection
