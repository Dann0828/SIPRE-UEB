<body class="antialiased" style="background-color: #81bb26;">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <!-- Contenido de la primera columna -->
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="form-group">
                                {{ Form::label('Marca') }}
                                {{ Form::text('marca', $ordenador->marca, ['class' => 'form-control' . ($errors->has('marca') ? ' is-invalid' : ''), 'placeholder' => 'Marca']) }}
                                {!! $errors->first('marca', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Modelo') }}
                                {{ Form::text('modelo', $ordenador->modelo, ['class' => 'form-control' . ($errors->has('modelo') ? ' is-invalid' : ''), 'placeholder' => 'Modelo']) }}
                                {!! $errors->first('modelo', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Tipo Computador') }}
                                {{ Form::select('id_tipoComputador',$tipoComputador, $ordenador->id_tipoComputador, ['class' => 'form-control' . ($errors->has('id_tipoComputador') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Uno']) }}
                                {!! $errors->first('id_tipoComputador', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Tipo Adquisición') }}
                                {{ Form::select('id_tipoAdquisicion',$tipoAdquisicion, $ordenador->id_tipoAdquisicion, ['class' => 'form-control' . ($errors->has('id_tipoAdquisicion') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Uno']) }}
                                {!! $errors->first('id_tipoAdquisicion', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Serie Computador') }}
                                {{ Form::text('serie', $ordenador->serie, ['class' => 'form-control' . ($errors->has('serie') ? ' is-invalid' : ''), 'placeholder' => 'Serie Computador']) }}
                                {!! $errors->first('serie', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Usuario de Dominio') }}
                                {{ Form::text('usuarioDominio', $ordenador->usuarioDominio, ['class' => 'form-control' . ($errors->has('usuarioDominio') ? ' is-invalid' : ''), 'placeholder' => 'Usuario de Dominio']) }}
                                {!! $errors->first('usuarioDominio', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Placa de Inventario') }}
                                {{ Form::text('placa_inventario', $ordenador->placa_inventario, ['class' => 'form-control' . ($errors->has('placa_inventario') ? ' is-invalid' : ''), 'placeholder' => 'Placa de Inventario']) }}
                                {!! $errors->first('placa_inventario', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Observaciones') }}
                                {{ Form::text('observaciones', $ordenador->observaciones, ['class' => 'form-control' . ($errors->has('observaciones') ? ' is-invalid' : ''), 'placeholder' => 'Observaciones']) }}
                                {!! $errors->first('observaciones', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Software Licenciado') }}
                                {{ Form::text('softwareLicenciado', $ordenador->softwareLicenciado, ['class' => 'form-control' . ($errors->has('softwareLicenciado') ? ' is-invalid' : ''), 'placeholder' => 'softwareLicenciado']) }}
                                {!! $errors->first('softwareLicenciado', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Software Libre') }}
                                {{ Form::text('softwareLibre', $ordenador->softwareLibre, ['class' => 'form-control' . ($errors->has('softwareLibre') ? ' is-invalid' : ''), 'placeholder' => 'Software Libre']) }}
                                {!! $errors->first('softwareLibre', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Usuario') }}
                                {{ Form::text('usuario', $ordenador->usuario, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
                                {!! $errors->first('usuario', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Cargo') }}
                                {{ Form::text('cargo', $ordenador->cargo, ['class' => 'form-control' . ($errors->has('cargo') ? ' is-invalid' : ''), 'placeholder' => 'Cargo']) }}
                                {!! $errors->first('cargo', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Extensión') }}
                                {{ Form::text('extension', $ordenador->extension, ['class' => 'form-control' . ($errors->has('extension') ? ' is-invalid' : ''), 'placeholder' => 'Extensión']) }}
                                {!! $errors->first('extension', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Correo Insititucional') }}
                                {{ Form::text('correoInstitucional', $ordenador->correoInstitucional, ['class' => 'form-control' . ($errors->has('correoInstitucional') ? ' is-invalid' : ''), 'placeholder' => 'Correo Institucional']) }}
                                {!! $errors->first('correoInstitucional', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
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
                            <div class="form-group">
                                {{ Form::label('Espacio de Disco Duro') }}
                                {{ Form::text('espacio_disco_duro',$ordenador->espacio_disco_duro, ['class' => 'form-control' . ($errors->has('espacio_disco_duro') ? ' is-invalid' : ''), 'placeholder' => 'Espacio Disco Duro']) }}
                                {!! $errors->first('espacio_disco_duro', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Descripción de Disco Duro') }}
                                {{ Form::text('descripciondiscoduro',$ordenador->descripciondiscoduro, ['class' => 'form-control' . ($errors->has('descripciondiscoduro') ? ' is-invalid' : ''), 'placeholder' => 'Descripción de Disco Duro']) }}
                                {!! $errors->first('descripciondiscoduro', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Tipo Disco Duro') }}
                                {{ Form::select('id_tipo_dicoDuro',$tipoDiscoDuro, $ordenador->id_tipo_dicoDuro, ['class' => 'form-control' . ($errors->has('id_tipo_dicoDuro') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Disco Duro']) }}
                                {!! $errors->first('id_tipo_dicoDuro', '<div class="invalid-feedback">:message</div>') !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Contenido de la segunda columna -->
                <div class="box box-info padding-1">
                    <div class="box-body">
                        <div class="form-group">
                             <div class="form-group">
                                {{ Form::label('Valor') }}
                                {{ Form::number('valor', $ordenador->valor, ['class' => 'form-control' . ($errors->has('valor') ? ' is-invalid' : ''), 'placeholder' => 'Valor']) }}
                                {!! $errors->first('valor', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Fecha de Compra') }}
                                {{ Form::date('fecha_compra', $ordenador->fecha_compra, ['class' => 'form-control' . ($errors->has('fecha_compra') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Compra']) }}
                                {!! $errors->first('fecha_compra', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Fecha de vencimiento Garantía') }}
                                {{ Form::date('fecha_vencimiento_garantia', $ordenador->fecha_vencimiento_garantia, ['class' => 'form-control' . ($errors->has('fecha_vencimiento_garantia') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Vencimiento Garantia']) }}
                                {!! $errors->first('fecha_vencimiento_garantia', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Adicionales') }}
                                {{ Form::text('perifericos_adicionales', $ordenador->perifericos_adicionales, ['class' => 'form-control' . ($errors->has('perifericos_adicionales') ? ' is-invalid' : ''), 'placeholder' => 'Adicionales']) }}
                                {!! $errors->first('perifericos_adicionales', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Estado de Computador') }}
                                {{ Form::select('id_estado',$estadoComputador, $ordenador->id_estado, ['class' => 'form-control' . ($errors->has('id_estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
                                {!! $errors->first('id_estado', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Localidad') }}
                                <select name="id_localidad" class="form-control">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach($localidad as $loc)
                                        <option value="{{ $loc['id'] }}"{{ $loc['id'] == $ordenador->id_localidad ? ' selected' : '' }}>
                                            {{ $loc['nombreEdificio'] }} - {{ $loc['tipoArea'] }} - {{ $loc['nombreDependencia'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('Sistema Operativo') }}
                                <select name="id_sistemaOperativo" class="form-control">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach($sistemaOperativo as $sis)
                                        <option value="{{ $sis['id'] }}"{{ $sis['id'] == $ordenador->id_sistemaoperativo ? ' selected' : '' }}>
                                            {{ $sis['sistema_operativo'] }} - {{ $sis['version'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                {{ Form::label('Tipo de Asignación') }}
                                {{ Form::select('id_tipoAsignacion',$tipoAsignacion, $ordenador->id_tipoAsignacion, ['class' => 'form-control' . ($errors->has('id_tipoAsignacion') ? ' is-invalid' : ''), 'placeholder' => 'Tipo Asignación']) }}
                                {!! $errors->first('id_tipoAsignacion', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Fecha de Asignación') }}
                                {{ Form::date('fecha_asignacion', $ordenador->fecha_asignacion, ['class' => 'form-control' . ($errors->has('fecha_asignacion') ? ' is-invalid' : ''), 'placeholder' => 'Fecha Asignación']) }}
                                {!! $errors->first('fecha_asignacion', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Rol') }}
                                {{ Form::select('id_usuarios',$rolComputador, $ordenador->id_usuarios, ['class' => 'form-control' . ($errors->has('id_usuarios') ? ' is-invalid' : ''), 'placeholder' => 'Rol']) }}
                                {!! $errors->first('id_usuarios', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Nombre de Red') }}
                                {{ Form::text('nombreRed', $ordenador->nombreRed, ['class' => 'form-control' . ($errors->has('nombreRed') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de Red']) }}
                                {!! $errors->first('nombreRed', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Dirección Mac LAN') }}
                                {{ Form::text('direccionMacL', $ordenador->direccionMacL, ['class' => 'form-control' . ($errors->has('direccionMacL') ? ' is-invalid' : ''), 'placeholder' => 'Dirección Mac LAN']) }}
                                {!! $errors->first('direccionMacL', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Dirección Mac WIFI') }}
                                {{ Form::text('direccionMacW', $ordenador->direccionMacW, ['class' => 'form-control' . ($errors->has('direccionMacW') ? ' is-invalid' : ''), 'placeholder' => 'Dirección Mac WIFI']) }}
                                {!! $errors->first('direccionMacW', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Marca de Pantalla') }}
                                {{ Form::text('marca_pantalla', $ordenador->marca_pantalla, ['class' => 'form-control' . ($errors->has('marca_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Marca Pantalla']) }}
                                {!! $errors->first('marca_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Modelo de Pantalla') }}
                                {{ Form::text('modelo_pantalla', $ordenador->modelo_pantalla, ['class' => 'form-control' . ($errors->has('modelo_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Modelo Pantalla']) }}
                                {!! $errors->first('modelo_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Serial de Pantalla') }}
                                {{ Form::text('serial_pantlla', $ordenador->serial_pantlla, ['class' => 'form-control' . ($errors->has('serial_pantlla') ? ' is-invalid' : ''), 'placeholder' => 'Serial Pantalla']) }}
                                {!! $errors->first('serial_pantlla', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Pulgadas') }}
                                {{ Form::number('pulgadas', $ordenador->pulgadas, ['class' => 'form-control' . ($errors->has('pulgadas') ? ' is-invalid' : ''), 'placeholder' => 'Pulgadas']) }}
                                {!! $errors->first('pulgadas', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Tipo de Pantalla') }}
                                {{ Form::select('id_tipo_pantalla',$tipoPantalla, $ordenador->id_tipo_pantalla, ['class' => 'form-control' . ($errors->has('id_tipo_pantalla') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione Uno']) }}
                                {!! $errors->first('id_tipo_pantalla', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Procesador') }}
                                <select name="id_procesador" class="form-control">
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    @foreach($procesador as $proc)
                                        <option value="{{ $proc['id'] }}"{{ $proc['id'] == $ordenador->id_procesador ? ' selected' : '' }}>
                                            {{ $proc['referencia'] }} - {{ $proc['frecuencia'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer mt-2">
            <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Registrar Ordenador') }}</button>
        </div>
    </div>
</body>
