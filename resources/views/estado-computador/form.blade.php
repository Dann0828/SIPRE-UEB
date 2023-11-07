<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Estado Computador') }}
            {{ Form::text('estado_computador', $estadoComputador->estado_computador, ['class' => 'form-control' . ($errors->has('estado_computador') ? ' is-invalid' : ''), 'placeholder' => 'Estado Computador']) }}
            {!! $errors->first('estado_computador', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
