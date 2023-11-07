<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('salon_id') }}
            {{ Form::text('salon_id', $salonOrdenador->salon_id, ['class' => 'form-control' . ($errors->has('salon_id') ? ' is-invalid' : ''), 'placeholder' => 'Salon Id']) }}
            {!! $errors->first('salon_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ordenador_id') }}
            {{ Form::text('ordenador_id', $salonOrdenador->ordenador_id, ['class' => 'form-control' . ($errors->has('ordenador_id') ? ' is-invalid' : ''), 'placeholder' => 'Ordenador Id']) }}
            {!! $errors->first('ordenador_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>