@extends('layouts.app')

@section('content')
<div class="container">

@if(Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible">
        {{Session::get('mensaje')}}
    </div>
@endif

<a href="{{ url('empleado/create') }}" class="btn btn-success">Registrar nuevo</a>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Foto</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr class="">
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellido }}</td>
                <td>{{ $empleado->correo }}</td>
                <td>
                    <img
                    class="img-thumbnail img-fluid"
                    src="{{ asset('storage').'/'.$empleado->foto }}" width="100" height="100"></td>
                <td>

                <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                    EDITAR
                </a>

                <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" class="d-inline">
                    @csrf
                    {{ method_field('DELETE')}}
                    <input 
                    class="btn btn-danger"
                    type="submit" value="BORRAR" onclick="return confirm('Estas seguro que quieres borrar?')">
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

@endsection
