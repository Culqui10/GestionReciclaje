
<div class="form-row">
    <div class="form-group col-6">
        {!! Form::label('name', 'Nombre') !!}
        {!! Form::text('name', null, 
        ['class'=>'form-control', 
        'placeholder'=>'Ingrese el nombre',
        'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('lastname', 'Apellido') !!}
        {!! Form::text('lastname', null, 
        ['class'=>'form-control', 
        'placeholder'=>'Ingrese el apellido',
        'required',
        ]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        {!! Form::label('dni', 'Documento de Identidad') !!}
        {!! Form::text('dni', null, 
        ['class'=>'form-control', 
        'placeholder'=>'Ingrese el dni',
        'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('name', 'Tipo de persona') !!}
        {!! Form::select('usertype_id', $usertype, null ,
        ['class'=>'form-control', 
        'required',
        ]) !!}
    </div>

    
</div>

<div class="form-row">
    <div class="form-group col-6">
        {!! Form::label('email', 'Correo electrónico') !!}
        {!! Form::text('email', null, 
        ['class'=>'form-control', 
        'placeholder'=>'Ingrese el correo electrónico',
        'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('password', 'Contraseña') !!}
        <div class="input-group">
            {!! Form::password('password', [
                'class' => 'form-control', 
                'placeholder' => 'Ingrese la contraseña', 
                'required',
                'id' => 'password'
            ]) !!}
            <div class="input-group-append">
                <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility()">
                    <i id="togglePasswordIcon" class="fa fa-eye"></i>
                </button>
            </div>
        </div>
    </div>
 
</div>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var togglePasswordIcon = document.getElementById("togglePasswordIcon");
        if (passwordField.type === "password") {
            passwordField.type = "text";
            togglePasswordIcon.classList.remove("fa-eye");
            togglePasswordIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            togglePasswordIcon.classList.remove("fa-eye-slash");
            togglePasswordIcon.classList.add("fa-eye");
        }
    }
</script>



