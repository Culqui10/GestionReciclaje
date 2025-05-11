
<div class="form-row">
    <div class="form-group col-6">
        {!! Form::label('usertype_id', 'Tipo de persona') !!}
        {!! Form::select('usertype_id', $usertypes, null, [
            'class' => 'form-control', 
            'id'=> 'usertype_id',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('user_id', 'Persona') !!}
        {!! Form::select('user_id', $useres, null, [
            'class' => 'form-control', 
            'id'=> 'user_id',
            'required',
        ]) !!}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-6">
        {!! Form::label('vehicle_id', 'Vehiculo') !!}
        {!! Form::select('vehicle_id', $vehicles, null, [
            'class' => 'form-control', 
            'required',
        ]) !!}
    </div>
    <div class="form-group col-6">
        {!! Form::label('status', 'Seleccione el estado') !!}
        <div class="form-check">
            {!! Form::checkbox('status', 1, null, [
                'class' => 'form-check-input',
                'id' => 'status'
            ]) !!}
            {!! Form::label('status', 'Activo', [
                'class' => 'form-check-label'
            ]) !!}
        </div>
    </div>
</div>

<div class="form-group col-6">
    {!! Form::label('fecha', 'Fecha de asignación') !!}
    {!! Form::date('fecha', null, 
        ['class' => 'form-control',
        'placeholder' => 'Seleccione una fecha']
    ) !!}
</div>

    <script>
  var id=$('#usertype_id').val();
               
               $.ajax({
                   url:"{{ route('admin.typebyuser', '_id') }}".replace("_id", id),
                   type: "GET",
                   datatype: "JSON",
                   contenttype: "application/json",
                   success: function(response){
                       $.each(response, function(key, value){
                           $('#user_id').empty();
                           $('#user_id').append(
                               '<option value=' + value.id + '>' + value.name+
                               '</option>');
                       });
                   }
                   
               })

        $('#usertype_id').change(function(){
            var id=$('#usertype_id').val();
            $.ajax({
                url:"{{ route('admin.typebyuser', '_id') }}".replace("_id", id),
                type: "GET",
                datatype: "JSON",
                contenttype: "application/json",
                success: function(response){
                    $.each(response, function(key, value){
                        $('#user_id').empty();
                        $('#user_id').append(
                            '<option value=' + value.id + '>' + value.name+
                            '</option>');
                    });
                }
                
            })
            
        })
    </script>

