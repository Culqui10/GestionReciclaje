<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, 
    ['class'=>'form-control', 
    'placeholder'=>'Ingrese el nombre del modelo',
    'required',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('name', 'Marca') !!}
    {!! Form::select('brand_id', $brands, null ,
    ['class'=>'form-control', 
    'required',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('code', 'Código') !!}
    {!! Form::text('code', null, 
    ['class'=>'form-control', 
    'placeholder'=>'Ingrese el código del modelo',
    ]) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción') !!}
    {!! Form::textarea('description', null, 
    ['class'=>'form-control', 
    'style'=>'height:100px;', 
    'placeholder'=>'Ingrese la descripción del modelo',
    ]) !!}
</div>