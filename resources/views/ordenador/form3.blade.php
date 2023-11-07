<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('Espacio de Disco Duro') }}
                    {{ Form::text('espacio_disco_duro',$ordenador->espacio_disco_duro, ['class' => 'form-control' . ($errors->has('espacio_disco_duro') ? ' is-invalid' : ''), 'placeholder' => 'Espacio Disco Duro']) }}
                    {!! $errors->first('espacio_disco_duro', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Tipo Disco Duro') }}
                    {{ Form::select('id_tipo_dicoDuro',$tipodiscoduro, $ordenador->id_tipo_dicoDuro, ['class' => 'form-control' . ($errors->has('id_tipo_dicoDuro') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Disco Duro']) }}
                    {!! $errors->first('id_tipo_dicoDuro', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Aceptar') }}</button>
    </div>
</div>
</body>
