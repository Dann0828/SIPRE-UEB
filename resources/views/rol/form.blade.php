@role('admin')
<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('descripción') }}
            {{ Form::text('descripcion', $rol->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" style="background-color: #81bb26;" class="btn btn-primary">{{ __('Crear') }}</button>
    </div>
</div>
</body>
@endrole
