<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de pacientes - DentalCloud</title>
</head>
<body>

    <h1>Registro de pacientes</h1>

    @if (session('success'))
        <div id="mensaje-exito">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div id="mensaje-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pacientes.store') }}" method="POST">
        @csrf

        <div>
            <label for="nombre">Nombre completo:</label>
            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre') }}"
            >
        </div>

        <div>
            <label for="documento">Documento:</label>
            <input
                type="text"
                id="documento"
                name="documento"
                value="{{ old('documento') }}"
            >
        </div>

        <div>
            <label for="fecha_nacimiento">Fecha de nacimiento:</label>
            <input
                type="date"
                id="fecha_nacimiento"
                name="fecha_nacimiento"
                value="{{ old('fecha_nacimiento') }}"
            >
        </div>

        <button type="submit" id="btn-registrar">
            Registrar paciente
        </button>
    </form>

</body>
</html>