@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ __('Crear') }} Periféricos y Auxiliares
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} Periféricos y Auxiliares</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('perifericosyauxiliares.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('perifericosyauxiliares.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('perifericosyauxiliare.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
