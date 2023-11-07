<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo Computador') }}
            {{ Form::text('tipo_computador', $tipoComputador->tipo_computador, ['class' => 'form-control' . ($errors->has('tipo_computador') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Computador']) }}
            {!! $errors->first('tipo_computador', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
