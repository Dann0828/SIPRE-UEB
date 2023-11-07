<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('observaciones') }}
            {{ Form::text('observaciones', $prestamo->observaciones, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'placeholder' => 'Observaciones']) }}
            {!! $errors->first('observaciones', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="mt-2 box-footer">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Devolver') }}</button>
    </div>
</div>
