@extends('adminlte::page')

@section('template_title')
    {{ __('Crear') }} Tipo Cambio
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Tipo Cambio</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipocambio.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipocambio.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipocambio.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
