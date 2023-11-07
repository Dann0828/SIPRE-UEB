@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ $slotsRam->name ?? "{{ __('Show') Slots Ram" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Slots Ram</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('slotsRam.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Slotsram:</strong>
                            {{ $slotsRam->slotsRam }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $slotsRam->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
