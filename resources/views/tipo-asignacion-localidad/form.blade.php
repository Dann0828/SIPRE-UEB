<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo de Asignación') }}
            {{ Form::text('tipoAsignacion', $tipoAsignacionLocalidad->tipoAsignacion, ['class' => 'form-control' . ($errors->has('tipoAsignacion') ? ' is-invalid' : ''), 'placeholder' => 'Asignación']) }}
            {!! $errors->first('tipoAsignacion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
