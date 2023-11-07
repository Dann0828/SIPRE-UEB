<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo de Memoria Ram') }}
            {{ Form::text('tipoRam', $tipoRam->tipoRam, ['class' => 'form-control' . ($errors->has('tipoRam') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de Memoria Ram']) }}
            {!! $errors->first('tipoRam', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
