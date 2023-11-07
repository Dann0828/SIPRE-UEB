<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group" style="display: inline-block; width: 50%;">
            {{ Form::label('Slots Ram') }}
            {{ Form::text('slotsRam', $slotsRam->slotsRam, ['class' => 'form-control' . ($errors->has('slotsRam') ? ' is-invalid' : ''), 'placeholder' => 'Slots']) }}
            {!! $errors->first('slotsRam', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group" style="display: inline-block; width: 48%;">
            {{ Form::label('Cantidad de módulos') }}
            {{ Form::text('descripcion', $slotsRam->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Módulos']) }}
            {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Aceptar') }}</button>
    </div>
</div>
</body>
