@extends('adminlte::page')

@section('template_title')
    {{ __('Actualizar') }} Tipo Mantenimiento
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} Tipo Mantenimiento</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipomantenimiento.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipomantenimiento.update', $tipomantenimiento->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('tipomantenimiento.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
