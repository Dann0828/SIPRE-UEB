@role('admin')
@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Tipo Mantenimiento
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Tipo Mantenimiento</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('tipo-mantenimientos.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipo-mantenimientos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tipo-mantenimiento.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
