<body class="antialiased" style="background-color: #81bb26;">
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <!-- Elementos de la sección "Ram" -->
                <div class="form-group">
                    {{ Form::label('Espacio de memoria Ram') }}
                    {{ Form::text('espacioRam', $ordenador->espacioRam, ['class' => 'form-control' . ($errors->has('espacioRam') ? ' is-invalid' : ''), 'placeholder' => 'Espacio Ram']) }}
                    {!! $errors->first('espacioRam', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Slots Ram') }}
                    <select name="id_slotsRam" class="form-control">
                        <option value="" disabled selected>Selecciona una opción</option>
                        @foreach($slots as $slot)
                            <option value="{{ $slot['id'] }}"{{ $slot['id'] == $ordenador->id_slotsRam ? ' selected' : '' }}>
                                {{ $slot['slotsRam'] }} - {{ $slot['descripcion'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('Modelo Ram') }}
                    {{ Form::select('id_modeloRam',$modeloRam, $ordenador->id_modeloRam, ['class' => 'form-control' . ($errors->has('id_modeloRam') ? ' is-invalid' : ''), 'placeholder' => 'Modelo Ram']) }}
                    {!! $errors->first('id_modeloRam', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt-2">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Aceptar') }}</button>
    </div>
</div>
</body>
