<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group" style="display: inline-block; width: 50%;">
            {{ Form::label('Referencia') }}
            {{ Form::text('referencia', $procesador->referencia, ['class' => 'form-control' . ($errors->has('referencia') ? ' is-invalid' : ''), 'placeholder' => 'Referencia']) }}
            {!! $errors->first('referencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="display: inline-block; width: 48%;">
            {{ Form::label('Frecuencia GHZ') }}
            {{ Form::text('frecuencia', $procesador->frecuencia, ['class' => 'form-control' . ($errors->has('frecuencia') ? ' is-invalid' : ''), 'placeholder' => 'Frecuencia']) }}
            {!! $errors->first('frecuencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
