<body class="antialiased" style="background-color: #81bb26;">
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('Marca') }}
                        {{ Form::text('marca_pa', $perifericosyauxiliare->marca_pa, ['class' => 'form-control' . ($errors->has('marca_pa') ? ' is-invalid' : ''), 'placeholder' => 'Marca']) }}
                        {!! $errors->first('marca_pa', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Modelo Periferico/Auxiliar') }}
                        {{ Form::text('modelo_pa', $perifericosyauxiliare->modelo_pa, ['class' => 'form-control' . ($errors->has('modelo_pa') ? ' is-invalid' : ''), 'placeholder' => 'Modelo Periferico/Auxiliar']) }}
                        {!! $errors->first('modelo_pa', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Tipo de Auxiliar') }}
                        {{ Form::select('id_tipoaux',$tipoaux, $perifericosyauxiliare->id_tipoaux, ['class' => 'form-control' . ($errors->has('id_tipoaux') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de Auxiliar']) }}
                        {!! $errors->first('id_tipoaux', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Valor') }}
                        {{ Form::text('valor', $perifericosyauxiliare->valor, ['class' => 'form-control' . ($errors->has('valor') ? ' is-invalid' : ''), 'placeholder' => 'Valor']) }}
                        {!! $errors->first('valor', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info padding-1">
                <div class="box-body">
                    <div class="form-group">
                        {{ Form::label('Estado') }}
                        {{ Form::select('id_estado',$estadoComputador, $perifericosyauxiliare->id_estado, ['class' => 'form-control' . ($errors->has('id_estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
                        {!! $errors->first('id_estado', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Localidad') }}
                        <select name="id_localidad" class="form-control">
                            <option value="" disabled selected>Selecciona una opción</option>
                            @foreach($localidad as $loc)
                                <option value="{{ $loc['id'] }}"{{ $loc['id'] == $perifericosyauxiliare->id_localidad ? ' selected' : '' }}>
                                    {{ $loc['nombreEdificio'] }} - {{ $loc['tipoArea'] }} - {{ $loc['nombreDependencia'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        {{ Form::label('Fecha de Compra') }}
                        {{ Form::date('fecha_compra', $perifericosyauxiliare->fecha_compra, ['class' => 'form-control' . ($errors->has('fecha_compra') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Compra']) }}
                        {!! $errors->first('fecha_compra', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('Fecha de Vencimiento de Garantía') }}
                        {{ Form::date('fecha_ven_garantia', $perifericosyauxiliare->fecha_ven_garantia, ['class' => 'form-control' . ($errors->has('fecha_ven_garantia') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de Vencimiento de Garantía']) }}
                        {!! $errors->first('fecha_ven_garantia', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="box-footer mt-2">
            <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Registar') }}</button>
        </div>
    </div>
</div>
</body>
