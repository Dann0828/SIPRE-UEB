<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo Auxiliar') }}
            {{ Form::text('tipo_aux', $tipoaux->tipo_aux, ['class' => 'form-control' . ($errors->has('tipo_aux') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Auxiliar']) }}
            {!! $errors->first('tipo_aux', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
