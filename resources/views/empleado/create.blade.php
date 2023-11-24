
<form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">

    @csrf
    @include('empleado.form',['titulo'=>'REGISTRAR EMPLEADO', 'modo'=>'GUARDAR'])

</form>