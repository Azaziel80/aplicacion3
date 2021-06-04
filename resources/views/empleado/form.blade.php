Formulario que tendrá los datos en común create y edit
<br>
<h1> {{ $modo }} empleados </h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
    <ul>
        @foreach ( $errors->all() as $errors )
        <li> {{ $errors }} </li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-grup">
<label for="Nombre"> Nombre </label>
    <input type="text" name="Nombre" class="form-control" value="{{ isset($empleado->Nombre)?$empleado->Nombre:'' }}" id="Nombre">

</div>

<div class="form-grup">
    <label for="Apellido"> Apéllidos </label>
    <input type="text" name="Apellido" class="form-control" value="{{ isset($empleado->Apellido)?$empleado->Apellido:'' }}" id="Apellido">

</div>

<div class="form-grup">
    <label for="Direccion"> Dirección </label>
    <input type="text" name="Direccion" class="form-control" value="{{ isset($empleado->Direccion)?$empleado->Direccion:'' }}" id="Direccion">

</div>

<div class="form-grup">
    <label for="Email"> Email </label>
    <input type="text" name="Email" class="form-control" value="{{ isset($empleado->Email)?$empleado->Email:'' }}" id="Email">

</div>

<div class="form-grup">
    <label for="Telefono"> Teléfono </label>
    <input type="text" name="Telefono" class="form-control" value="{{ isset($empleado->Telefono)?$empleado->Telefono:'' }}" id="Telefono">

</div>

<div class="form-grup">
    <label for="Foto"> Foto </label>
    @if(isset($empleado->Foto))
    <img class="img-thumbnail img-fluid"  src="{{ asset('storage').'/'.$empleado->Foto }}" width="90" alt="">
    @endif
    <input type="file" name="Foto" class="form-control" value="" id="Foto">

</div>

    <input class="btn btn-success" type="submit" value="{{ $modo }} datos">

    <a class=" btn btn-primary" href="{{ url('empleado/') }}"> Regresar</a>
    <br>
