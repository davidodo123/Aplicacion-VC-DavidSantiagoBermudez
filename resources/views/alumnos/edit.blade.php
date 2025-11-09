@extends('layouts.app')
@section('title','Editar alumno')

@section('content')
<h3>Editar alumno</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('alumnos.update', $alumno) }}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  @include('alumnos.form')
</form>


@endsection
