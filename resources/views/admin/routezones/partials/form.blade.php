<div class="form-row">
    
    {!! Form::hidden('route_id',$route->id, ['class'=>'form-control']) !!}

    <div class="form-group col-6">
        <div class="form-group">
            {!! Form::label('zone', 'Zonas') !!}
            {!! Form::select('zone_id', $zones, null ,
            ['class'=>'form-control', 
            'required',
            ]) !!}
        </div>
    </div>

</div>