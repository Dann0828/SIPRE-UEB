@extends('adminlte::page')

@section('template_title')
    {{ __('Editar') }} Ordenador
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Ordenador</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ordenador.update', $ordenador->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('ordenador.form5')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
