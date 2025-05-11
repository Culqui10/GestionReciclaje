
<div class="form-row">

    <div class="form-group col-4">
        {!! Form::label('day', 'Dia:') !!}
        <select name="day" id="day" class="form-control">
            <option value="Lunes">Lunes</option>
            <option value="Martes">Martes</option>
            <option value="Miercoles">Miercoles</option>
            <option value="Jueves">Jueves</option>
            <option value="Viernes">Viernes</option>
            <option value="Sabado">Sabado</option>
        </select>
    </div>

    <div class="form-group col-4">
        {!! Form::label('vehicle_id', 'Vehiculo') !!}
        {!! Form::select('vehicle_id', $vehicles, null, ['class' => 'form-control', 'id' => 'vehicle_id', 'required']) !!}
    </div>

    <div class="form-group col-4">
        {!! Form::label('typemantenimiento_id', 'Tipo de mantenimiento') !!}
        {!! Form::select('typemantenimiento_id', $types, null, [
            'class' => 'form-control',
            'id' => 'activitie_id',
            'required',
        ]) !!}
    </div>
</div>

<div class="form-row">

    <div class="form-group col-6">
        {!! Form::label('starttime', 'Hora inicio') !!}
        {!! Form::time('starttime', null, [
            'class' => 'form-control',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('lasttime', 'Hora fin') !!}
        {!! Form::time('lasttime', null, [
            'class' => 'form-control',
            'required',
        ]) !!}
    </div>

</div>
