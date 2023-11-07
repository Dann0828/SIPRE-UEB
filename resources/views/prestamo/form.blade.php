<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('encargado') }}
            {{ Form::select('users_id', $user, $prestamo->users_id, ['class' => 'form-control' . ($errors->has('users_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Encargado']) }}
            {!! $errors->first('users_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Usuario') }}
            <select name="persona_id" class="form-control">
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($persona as $per)
                    <option value="{{ $per->id }}"{{ $per->id == $prestamo->persona_id ? ' selected' : '' }}>
                        {{ $per['id'] }} - {{ $per['nombre'] }} - {{ $per['correo'] }} - {{ $per['celular'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('Selecciona uno o varios equipos') }}
            <select name="equipo_id[]" class="form-control" multiple>
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}" {{ is_array($prestamo->equipo_id) && in_array($equipo->id, $prestamo->equipo_id) ? ' selected' : '' }}>
                        {{ $equipo->id }} -{{ $equipo->marca }} - {{ $equipo->modelo }} - {{ $equipo->placa_inventario }} - {{ $equipo->serie }}
                    </option>
                @endforeach
            </select>
            <div class="form-group">
                    {{ Form::label('programa') }}
                <div class="form-group">
                    <input type="text" id="programa-search" class="form-control" placeholder="Buscar programa">
                </div>
                <div class="form-group">
                    {{ Form::select('programa_id[]', $programas, $prestamo->programa_id, [
                        'class' => 'form-control' . ($errors->has('programa_id') ? ' is-invalid' : ''),
                        'multiple' => 'multiple',
                        'id' => 'programa-select'
                    ]) }}
                    {!! $errors->first('programa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            {{ Form::label('Aula') }}
            <select name="salon_id" class="form-control">
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($aula as $aul)
                    <option value="{{ $aul->id }}"{{ $aul->id == $prestamo->aula_id ? ' selected' : '' }}>
                       {{ $aul->Edificio->descripcion}} - {{ $aul['descripcion'] }} - {{ $aul->tipoaula->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
    <div class="mt-2 text-right box-footer">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Registrar') }}</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#programa-search').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('#programa-select option').each(function() {
            var optionText = $(this).text().toLowerCase();
            if (optionText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
