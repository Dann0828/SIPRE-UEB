<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Usuario') }}
            {{ Form::text('tipo_usuario', $usuario->tipo_usuario, ['class' => 'form-control' . ($errors->has('tipo_usuario') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Usuario']) }}
            {!! $errors->first('tipo_usuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Submit') }}</button>
    </div>
</div>
