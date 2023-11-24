@extends('layouts.app')

@section('content')
<div class="container">
  

  <h1>{{ $titulo }}</h1>


  <div class="form-group">

  </div>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" class="form-control"
    value="{{ isset($empleado->nombre) ? $empleado->nombre : ''}}" 
    id="nombre"
    required maxlength="20"
    >
    
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" class="form-control"
     value="{{ isset($empleado->apellido) ? $empleado->apellido : ''}}" id="apellido" required maxlength="20">
    
    <label for="correo">Correo</label>
    <input type="email" name="correo" class="form-control"
     value="{{ isset($empleado->correo) ? $empleado->correo : ''}}" id="correo" required maxlength="50">
     
    <label for="foto">Foto</label>
    
    @if(isset($empleado->foto))
    <img 
    class="img-thumbnail img-fluid"
    src="{{ asset('storage').'/'.$empleado->foto }}" width="100" height="100"></td>
    @endif
    <input type="file" name="foto" id="foto" class="form-control"><br>
    
    <input type="submit" value="{{ $modo }} DATOS" class="btn btn-primary">
    <a href="{{ url('empleado/') }}" class="btn btn-secondary">VOLVER</a>
    
</div>
</div>

@endsection