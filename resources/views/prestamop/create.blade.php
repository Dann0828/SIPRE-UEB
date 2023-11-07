@extends('adminlte::page')

@section('template_title')
    {{ __('Registrar Préstamo') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Registrar Préstamo') }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary" style="background-color: #81bb26;" href="{{ route('prestamop.index') }}">{{ __('Atrás') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!-- Formulario de búsqueda para Administrativo -->
                                <form method="GET" role="form" action="{{ route('prestamop.buscarAdministrativoEnAPI') }}">
                                    @csrf
                                    <div class="mb-3 input-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar Administrativo">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <!-- Formulario de búsqueda para Estudiante -->
                                <form method="GET" role="form" action="{{ route('prestamop.buscarEstudianteEnAPI') }}">
                                    @csrf
                                    <div class="mb-3 input-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar Estudiante">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <!-- Formulario de búsqueda para Docente -->
                                <form method="GET" role="form" action="{{ route('prestamop.buscarDocenteEnAPI') }}">
                                    @csrf
                                    <div class="mb-3 input-group">
                                        <input type="text" name="busqueda" class="form-control" placeholder="Buscar Docente">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" style="background-color: #81bb26;" type="submit">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="apiResponse">
                            <!-- Contenido de respuesta API -->
                        </div>
                        
                        @if(session('tipo_formulario'))
                            <div class="col-md-12" id="post-search-form">
                                <!-- Formulario basado en el valor de session('tipo_formulario') -->
                                @if(session('tipo_formulario') === 'forma')
                                    <form method="POST" action="{{ route('prestamop.store') }}" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @include('prestamop.forma')
                                    </form>
                                @elseif(session('tipo_formulario') === 'form')
                                    <form method="POST" action="{{ route('prestamop.store') }}" role="form" enctype="multipart/form-data">
                                        @csrf
                                        @include('prestamop.form')
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('form[id^="searchForm"]').submit(function (event) {
        event.preventDefault();

        var documento = $(this).find('input[name="busqueda"]').val();
        var formAction = $(this).attr('action');
        var formActionCreate = '{{ route('prestamop.create') }}';

        // Hacer la solicitud a la ruta correspondiente según la búsqueda
        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                documento: documento
            },
            success: function (response) {
                $('#apiResponse').html(response);
                // Mostrar el formulario después de la búsqueda
                $('#post-search-form').show();
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
</script>
@endpush