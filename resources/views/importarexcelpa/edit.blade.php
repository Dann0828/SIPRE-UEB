@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Importarexcelpa
@endsection

@section('content')
<body class="antialiased" style="background-color: #81bb26;">
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Importarexcelpa</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('importarexcelpas.update', $importarexcelpa->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('importarexcelpa.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection
