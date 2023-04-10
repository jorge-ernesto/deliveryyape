<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Chongoyape - Gestión Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        /*
        Notas
        Se agrego el estilo "display: inline-block" para que el form y todos sus elementos se organicen horizontalmente de forma correcta.
        Esto obligará a los botones a colocarse uno al lado del otro en la misma línea, en lugar de apilarse verticalmente.
        */
        td form {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h4>Gestión de Clientes</h4>

        <div class="row">
            <div class="col-xl-12">

                <form action="{{ route('cliente.index') }}" method="GET" class="row g-3">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="texto" value={{ $texto }}>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Buscar</button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('cliente.create') }}" class="btn btn-success mb-3">Crear</a>
                    </div>
                </form>

            </div>
            <div class="col-xl-12">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>ID</th>
                                <th>Apellidos</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($clientes) <= 0)
                                <tr>
                                    <td colspan="8">No hay resultados</td>
                                </tr>
                            @else
                                @foreach ($clientes as $key => $cliente)
                                <tr>
                                    <td>
                                        {{-- Editar --}}
                                        <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-warning btn-sm">Editar</a>

                                        {{-- Eliminar validando con JavaScript --}}
                                        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-danger btn-sm">Eliminar</button> --}}
                                            {{-- <button type="submit" onclick="return confirm('¿Está seguro de que desea eliminar el registro?')" class="btn btn-danger btn-sm">Eliminar</button> --}}
                                            <button type="submit" onclick="return eliminarCliente()" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>

                                        {{-- Eliminar validando con Modales de Bootstrap --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $cliente->id }}">
                                            Eliminar
                                        </button>
                                        @include('cliente.modal_delete')
                                    </td>
                                    <td>{{ $cliente->id }}</td>
                                    <td>{{ $cliente->apellidos }}</td>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->documento }}</td>
                                    <td>{{ $cliente->telefono }}</td>
                                    <td>{{ $cliente->direccion }}</td>
                                    <td>{{ $cliente->email }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        {{--
                        Notas
                        La diferencia entre {{ $clientes->links() }} y {{ $clientes->appends(['texto' => $texto])->links() }} es que el método "appends"
                        permite agregar parámetros adicionales a la URL de paginación, lo que evita la pérdida de información en el proceso de paginación.
                        De esta manera, se asegura que la variable "texto" permanezca en la URL en las diferentes páginas, permitiendo que el usuario pueda
                        seguir viendo los resultados filtrados según su búsqueda original.
                        --}}
                        Showing {{ $clientes->firstItem() }} to {{ $clientes->lastItem() }} of {{ $clientes->total() }} entries
                        @if (!empty($texto))
                            {{ $clientes->appends(['texto' => $texto])->links() }}
                        @else
                            {{ $clientes->links() }}
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        const eliminarCliente = () => {
            const result = confirm('¿Está seguro de que desea eliminar el registro?')
            return result
        }
    </script>
</body>
</html>