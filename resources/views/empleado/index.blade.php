@extends('layouts.app')

@section('content')

@if (Session::has('mensaje'))
    {{ Session::get('mensaje')}}
@endif

<div class="container">
<a href="{{ url('empleado/create') }}" class="btn btn-success" > Registrar nuevo empleado </a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>id</th>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Editar contacto</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($empleados as $empleado)


        <tr>
            <td>{{ $empleado->id }}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="90" alt="">
            </td>

            <td>{{ $empleado->Nombre }}</td>
            <td>{{ $empleado->Apellido }}</td>
            <td>{{ $empleado->Direccion }}</td>
            <td>{{ $empleado->Email }}</td>
            <td>{{ $empleado->Telefono }}</td>
            <td>
                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                    Editar
                </a>
                |

                <form action="{{ url('/empleado/'.$empleado->id )}}" class="d-inline" method="post">
                    @csrf
                    {{ method_field('DELETE') }}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar los datos?')" value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
