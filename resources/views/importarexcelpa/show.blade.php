@extends('layouts.app')

@section('template_title')
    {{ $importarexcelpa->name ?? "{{ __('Show') Importarexcelpa" }}
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Importarexcelpa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('importarexcelpas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">


                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
