@extends('template.base')

@section('content')
<article class="resume-wrapper text-center position-relative">
  <div class="resume-wrapper-inner mx-auto text-start bg-white shadow-lg">
    <header class="resume-header pt-4 pt-md-0">
      <div class="row">
        <div class="col-block col-md-auto resume-picture-holder text-center text-md-start">
          <img
  src="{{ $alumno->fotografia ? route('alumnos.foto', $alumno) : asset('assets/img/sin-foto.webp') }}"
  alt="Foto de {{ $alumno->nombre }}"
  style="width:120px; height:120px; object-fit:cover; border-radius:10px;"
  onerror="this.src='{{ asset('assets/img/cadae4ab-2f27-4a33-8077-522fb1fdb34c.png') }}';">


        </div>
        <div class="col">
          <div class="row p-4 justify-content-center justify-content-md-between">
            <div class="primary-info col-auto">
              <h1 class="name mt-0 mb-1 text-black text-uppercase">
                {{ $alumno->nombre }} {{ $alumno->apellidos }}
              </h1>
              <div class="title mb-3">Nota Media: {{ $alumno->nota_media }}</div>
              <ul class="list-unstyled">
                <li class="mb-2"><i class="far fa-envelope fa-fw me-2"></i>{{ $alumno->correo }}</li>
                <li><i class="fas fa-mobile-alt fa-fw me-2"></i>{{ $alumno->telefono }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="resume-body p-5">
      <section class="resume-section summary-section mb-5">
        <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Experiencia</h2>
        <div class="resume-section-content">
          <p class="mb-0">{{ $alumno->experiencia }}</p>
        </div>
      </section>

      <div class="row">
        <div class="col-lg-9">
          <section class="resume-section experience-section mb-5">
            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Formación</h2>
            <div class="resume-section-content">
              <p class="mb-0">{{ $alumno->formacion }}</p>
            </div>
          </section>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-9">
          <section class="resume-section experience-section mb-5">
            <h2 class="resume-section-title text-uppercase font-weight-bold pb-3 mb-3">Habilidades</h2>
            <div class="resume-section-content">
              <p class="mb-0">{{ $alumno->habilidades }}</p>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</article>
@endsection
