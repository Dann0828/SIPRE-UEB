<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Tipo Disco Duro') }}
            {{ Form::text('tipoDiscoDuro', $tipoDiscoDuro->tipoDiscoDuro, ['class' => 'form-control' . ($errors->has('tipoDiscoDuro') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Disco Duro']) }}
            {!! $errors->first('tipoDiscoDuro', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
