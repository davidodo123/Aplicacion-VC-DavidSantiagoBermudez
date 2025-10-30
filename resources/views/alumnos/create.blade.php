@extends('layouts.app')
@section('title','Nuevo alumno')

@section('content')
<h3>Nuevo alumno</h3>

@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $e)
        <li>{{ $e }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('alumnos.store') }}" enctype="multipart/form-data">
  @include('alumnos._form')
</form>
@endsection
