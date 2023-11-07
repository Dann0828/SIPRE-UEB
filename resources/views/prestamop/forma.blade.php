<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('encargado') }}
            {{ Form::select('users_id',$user, $prestamop->users_id, ['class' => 'form-control' . ($errors->has('users_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el Encargado']) }}
            {!! $errors->first('users_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Persona') }}
            <select name="persona_id" class="form-control">
                <option value="" disabled selected>Selecciona una opción</option>
                @foreach($persona as $per)
                    <option value="{{ $per->id }}"{{ $per->id == $prestamop->persona_id ? ' selected' : '' }}>
                        {{ $per['id'] }} - {{ $per['nombre'] }} - {{ $per['correo'] }} - {{ $per['celular'] }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ Form::label('Selecciona uno o varios equipos') }}
            <select name="equipo_id[]" class="form-control" multiple>
                @foreach($perifericosyauxiliares as $equipo)
                <option value="{{ $equipo->id }}" {{ is_array($prestamop->equipo_id) && in_array($equipo->id, $prestamop->equipo_id) ? ' selected' : '' }}>
                    {{ $equipo->id }} -{{ $equipo->marca_pa }} - {{ $equipo->modelo_pa }} - {{ $tipoaux->implode(', ') }}
                </option>
            @endforeach
            </select>
        </div>
        </div>
            <div class="form-group">
                    {{ Form::label('dependencia') }}
                <div class="form-group">
                    <input type="text" id="dependencia-search" class="form-control" placeholder="Buscar dependencia">
                </div>
                <div class="form-group">
                    {{ Form::select('dependencia_id[]', $dependencias, $prestamop->dependencia_id, [
                        'class' => 'form-control' . ($errors->has('dependencia_id') ? ' is-invalid' : ''),
                        'multiple' => 'multiple',
                        'id' => 'dependencia-select'
                    ]) }}
                    {!! $errors->first('dependencia_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
    </div>
    <div class="mt-2 box-footer">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Registrar') }}</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#dependencia-search').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        $('#dependencia-select option').each(function() {
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
