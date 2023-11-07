<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Sistema Operativo') }}
                    <select name="id_sistemaOperativo" class="form-control">
                        <option value="" disabled selected>Selecciona una opción</option>
                        @foreach($sistemaOperativo as $sis)
                            <option value="{{ $sis['id'] }}"{{ $sis['id'] == $ordenador->id_sistemaoperativo ? ' selected' : '' }}>
                                {{ $sis['sistema_operativo'] }} - {{ $sis['version'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Aceptar') }}</button>
    </div>
</div>
</body>
