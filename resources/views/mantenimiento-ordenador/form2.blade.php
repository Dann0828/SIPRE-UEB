<body class="antialiased" style="background-color: #81bb26;">
    <div class="box box-info padding-1">
        <div class="box-body">

            <div class="form-group">
                {{ Form::label('Salon') }}
                <select name="salon_id" class="form-control">
                    <option value="" disabled selected>Selecciona una opción</option>
                    @foreach($salon as $sal)
                        <?php
                        $nombreSalon = $sal->salon->edificio->descripcion . $sal->salon->descripcion . ' - ' . $sal->salon->tipoaula->descripcion;
                        ?>
                        <option value="{{ $sal->salon->id }}">
                            {{ $nombreSalon }}
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
        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
        </div>
    </div>
    </body>
