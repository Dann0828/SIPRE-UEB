<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('descripción') }}
            {{ Form::text('descripcion', $salon->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('edificio') }}
            {{ Form::select('edificio_id', $edificio, $salon->edificio_id, ['class' => 'form-control' . ($errors->has('edificio_id') ? ' is-invalid' : ''), 'placeholder' => 'Edificio']) }}
            {!! $errors->first('edificio_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo de aula') }}
            {{ Form::select('tipoaula_id', $tipoaula, $salon->tipoaula_id, ['class' => 'form-control' . ($errors->has('tipoaula_id') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de Aula']) }}
            {!! $errors->first('tipoaula_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
