<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, 
    ['class'=>'form-control', 
    'placeholder'=>'Ingrese el nombre de la marca',
    'required',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, 
    ['class'=>'form-control', 
    'style' =>'height:100px',
    'placeholder'=>'Ingrese la descripción de la marca',
    ]) !!}
</div>
<!--
<div class="form-group">
    {!! Form::label('logo', 'Logo') !!}
    {!! Form::text('logo', null, 
    ['class'=>'form-control', 
    'placeholder'=>'URL del Logo',
    ]) !!}
</div>
-->
<div class="form-group">
    <input type="file" name="logo" class="form-control" accept="image/*">
</div>