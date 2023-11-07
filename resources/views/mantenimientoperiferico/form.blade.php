<body class="antialiased" style="background-color: #81bb26;">
    <div class="box box-info padding-1">
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('Equipo') }}
                <select name="perifericos_id" class="form-control">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach($equipo as $equip)
                        <option value="{{ $equip['id'] }}"{{ $equip['id'] == $mantenimientoperiferico->perifericos_id ? ' selected' : '' }}>
                        @if ($equip['id'] && $equip->tipoaux && $equip->tipoaux->tipo_aux)
                            {{ $equip['id'] }} - {{ $equip->tipoaux->tipo_aux }} - {{ $equip['modelo_pa'] }}
                        @else
                        @endif

                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                {{ Form::label('encargado') }}
                <select name="users_id" class="form-control">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach($user as $us)
                        <option value="{{ $us['id'] }}"{{ $us['id'] == $mantenimientoperiferico->users_id ? ' selected' : '' }}>
                            {{ $us['id'] }} - {{ $us['name'] }} - {{ $us['email'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                {{ Form::label('Descripción') }}
                {{ Form::text('descripcion', $mantenimientoperiferico->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Descripción']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('tipo de manteniemto') }}
                {{ Form::select('id_tipo_mantenimiento',$tipomantenimiento, $mantenimientoperiferico->id_tipo_mantenimiento, ['class' => 'form-control' . ($errors->has('id_tipo_mantenimiento') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Mantenimiento']) }}
                {!! $errors->first('id_tipo_mantenimiento', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
        </div>
    </div>
    </body>
