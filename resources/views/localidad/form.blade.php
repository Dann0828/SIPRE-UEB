<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Nombre de Edificio') }}
                    {{ Form::text('nombreEdificio', $localidad->nombreEdificio, ['class' => 'form-control' . ($errors->has('nombreEdificio') ? ' is-invalid' : ''), 'placeholder' => 'Edificio']) }}
                    {!! $errors->first('nombreEdificio', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Tipo de Área') }}
                    {{ Form::text('tipoArea', $localidad->tipoArea, ['class' => 'form-control' . ($errors->has('tipoArea') ? ' is-invalid' : ''), 'placeholder' => 'Area']) }}
                    {!! $errors->first('tipoArea', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Nombre de Dependencia') }}
                    {{ Form::text('nombreDependencia', $localidad->nombreDependencia, ['class' => 'form-control' . ($errors->has('nombreDependencia') ? ' is-invalid' : ''), 'placeholder' => 'Dependencia']) }}
                    {!! $errors->first('nombreDependencia', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
</body>

