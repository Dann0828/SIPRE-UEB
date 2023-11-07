<body class="antialiased" style="background-color: #81bb26;">
    <div class="box box-info padding-1">
        <div class="box-body">

            <div class="form-group">
                {{ Form::label('Ordenadores') }}
                <select name="ordenador_id" class="form-control">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach($ordenador as $ord)
                        <option value="{{ $ord['id'] }}"{{ $ord['id'] == $mantenimientoOrdenador->ordenador_id ? ' selected' : '' }}>
                            {{ $ord['id'] }} - {{ $ord['placa_inventario'] }} - {{ $ord['marca'] }} - - {{ $ord['modelo'] }} - {{ $ord['serie'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('encargado') }}
                <select name="users_id" class="form-control">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach($user as $us)
                        <option value="{{ $us['id'] }}"{{ $us['id'] == $mantenimientoOrdenador->users_id ? ' selected' : '' }}>
                            {{ $us['id'] }} - {{ $us['name'] }} - {{ $us['email'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{ Form::label('descripción') }}
                {{ Form::text('descripcion', $mantenimientoOrdenador->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('tipo de manteniemto') }}
                {{ Form::select('id_tipo_mantenimiento',$tipomantenimiento, $mantenimientoOrdenador->id_tipo_mantenimiento, ['class' => 'form-control' . ($errors->has('id_tipo_mantenimiento') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Mantenimiento']) }}
                {!! $errors->first('id_tipo_mantenimiento', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('cambio') }}
                {{ Form::select('id_tipocambio',$tipocambio, $mantenimientoOrdenador->id_tipocambio, ['class' => 'form-control' . ($errors->has('id_tipocambio') ? ' is-invalid' : ''), 'placeholder' => 'Tipo cambio']) }}
                {!! $errors->first('id_tipocambio', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
        </div>
    </div>
    </body>
