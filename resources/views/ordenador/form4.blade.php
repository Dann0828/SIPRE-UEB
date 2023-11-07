<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Marca de Pantalla') }}
                    {{ Form::text('marca_pantalla', $ordenador->marca_pantalla, ['class' => 'form-control' . ($errors->has('marca_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Marca Pantalla']) }}
                    {!! $errors->first('marca_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Modelo de Pantalla') }}
                    {{ Form::text('modelo_pantalla', $ordenador->modelo_pantalla, ['class' => 'form-control' . ($errors->has('modelo_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Modelo Pantalla']) }}
                    {!! $errors->first('modelo_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Serial de Pantalla') }}
                    {{ Form::text('serial_pantlla', $ordenador->serial_pantlla, ['class' => 'form-control' . ($errors->has('serial_pantlla') ? ' is-invalid' : ''), 'placeholder' => 'Serial Pantalla']) }}
                    {!! $errors->first('serial_pantlla', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Pulgadas') }}
                    {{ Form::number('pulgadas', $ordenador->pulgadas, ['class' => 'form-control' . ($errors->has('pulgadas') ? ' is-invalid' : ''), 'placeholder' => 'Pulgadas']) }}
                    {!! $errors->first('pulgadas', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Tipo de Pantalla') }}
                    {{ Form::select('id_tipo_pantalla',$tipoPantalla, $ordenador->id_tipo_pantalla, ['class' => 'form-control' . ($errors->has('id_tipo_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Uno']) }}
                    {!! $errors->first('id_tipo_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Aceptar') }}</button>
    </div>
</div>
</body>
