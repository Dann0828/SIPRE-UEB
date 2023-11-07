<div class="box box-info padding-1">
    <div class="box-body">

        <!-- Cédula -->
        <div class="form-group">
            {{ Form::label('cédula') }}
            {{ Form::text('id', $user->id, ['class' => 'form-control' . ($errors->has('id') ? ' is-invalid' : ''), 'placeholder' => 'Cédula']) }}
            {!! $errors->first('id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Nombre -->
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Correo -->
        <div class="form-group">
            {{ Form::label('correo') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Correo']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            {{ Form::label('contraseña') }}
            {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Contraseña']) }}
            {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group">
            {{ Form::label('confirmar_contraseña') }}
            {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Confirmar Contraseña']) }}
            {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
        <!-- Tipo de Usuario -->
        <div class="form-group">
            {{ Form::label('Tipo de Usuario') }}
            {{ Form::select('tipodeUsuario', ['Administrador' => 'Administrador', 'Técnico' => 'Técnico'], null, ['class' => 'form-control' . ($errors->has('tipodeUsuario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo de usuario']) }}
            {!! $errors->first('tipodeUsuario', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary" style="background-color: #81bb26;">{{ __('Crear') }}</button>
    </div>
</div>
