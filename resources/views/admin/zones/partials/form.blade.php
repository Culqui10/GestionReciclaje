<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, 
    ['class'=>'form-control', 
    'placeholder'=>'Ingrese el nombre de la zona',
    'required',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('area', 'Area') !!}
    {!! Form::text('area', null, 
    ['class'=>'form-control', 
    'placeholder'=>'Ingrese el área de la zona',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, 
    ['class'=>'form-control', 
    'style' =>'height:100px',
    'placeholder'=>'Ingrese la descripción de la zona',
    ]) !!}
</div>