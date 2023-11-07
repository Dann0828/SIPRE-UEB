<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('dependencia') }}
            {{ Form::text('dependencia', $dependenciaua->dependencia, ['class' => 'form-control' . ($errors->has('dependencia') ? ' is-invalid' : ''), 'placeholder' => 'Dependencia']) }}
            {!! $errors->first('dependencia', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Área') }}
            {{ Form::select('areaua_id', $area,$dependenciaua->areaua_id, ['class' => 'form-control' . ($errors->has('areaua_id') ? ' is-invalid' : ''), 'placeholder' => 'Área']) }}
            {!! $errors->first('areaua_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>