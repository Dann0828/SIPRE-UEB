<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group" style="display: inline-block; width: 48%;">
            {{ Form::label('Sistema Operativo') }}
            {{ Form::text('sistema_operativo', $sistemaOperativo->sistema_operativo, ['class' => 'form-control' . ($errors->has('sistema_operativo') ? ' is-invalid' : ''), 'placeholder' => 'Sistema Operativo']) }}
            {!! $errors->first('sistema_operativo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="display: inline-block; width: 50%;">
            {{ Form::label('Versión') }}
            {{ Form::text('version', $sistemaOperativo->version, ['class' => 'form-control' . ($errors->has('version') ? ' is-invalid' : ''), 'placeholder' => 'Versión']) }}
            {!! $errors->first('version', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2" >
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>
