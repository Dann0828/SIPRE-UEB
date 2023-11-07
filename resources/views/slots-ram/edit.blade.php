@role('admin')
@extends('adminlte::page')


@section('template_title')
    {{ __('Editar') }} Slots Ram
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Editar') }} Slots Ram</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('slotsRam.index') }}"> {{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('slotsRam.update', $slotsRam->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('slots-ram.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
@endrole
