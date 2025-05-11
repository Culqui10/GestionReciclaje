<div>
    {!! Form::model($vehicle, ['route' => ['admin.vehicles.update', $vehicle], 'method' => 'put']) !!}

    <div class="form-row">
        <div class="form-group col-4">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese el nombre del vehiculo',
                'required',
            ]) !!}
        </div>
        <div class="form-group col-4">
            {!! Form::label('code', 'Codigo') !!}
            {!! Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el codigo', 'required']) !!}
        </div>
        <div class="form-group col-4">
            {!! Form::label('plate', 'Placa') !!}
            {!! Form::text('plate', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la placa', 'required']) !!}
        </div>
        <div class="form-group col-4">
            {!! Form::label('capacity', 'Capacidad de personas') !!}
            {!! Form::text('capacity', null, [
                'class' => 'form-control',
                'placeholder' => 'Ingrese la capacidad de conductores',
                'required',
            ]) !!}
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-4">
            {!! Form::label('year', 'Año') !!}
            {!! Form::text('year', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el año', 'required']) !!}
        </div>
        <div class="form-group col-4" wire:ignore>
            {!! Form::label('name', 'Marca') !!}
            {!! Form::select('brand_id', $brands, null, ['class' => 'form-control', 'id' => 'brand_id', 'required']) !!}
        </div>
        <div class="form-group col-4" wire:ignore>
            {!! Form::label('model_id', 'Modelo') !!}
            {!! Form::select('model_id', $models, null, ['class' => 'form-control', 'id' => 'model_id', 'required']) !!}
        </div>

    </div>

    <div class="form-row">
        <div class="form-group col-4">
            {!! Form::label('type_id', 'Tipo') !!}
            {!! Form::select('type_id', $types, null, [
                'class' => 'form-control',
                'required',
            ]) !!}
        </div>
        <div class="form-group col-4">
            {!! Form::label('status', 'Seleccione el estado') !!}
            <div class="form-check">
                {!! Form::checkbox('status', 1, null, [
                    'class' => 'form-check-input',
                    'id' => 'status',
                ]) !!}
                {!! Form::label('status', 'Activo', [
                    'class' => 'form-check-label',
                ]) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group col-6">
            {!! Form::label('color_id', 'Color') !!}
            <div class="form-group">
                @foreach ($colors as $color)
                    <span wire:model.live="selectedColorId"
                        wire:click="selectColor({{ $color->id }})"
                        style="display: inline-block; width: 40px; height: 40px; background-color: {{ $color->color_code }}; border-radius: 50%; {{ $selectedColorId == $color->id ? 'border: 2px solid black;' : '' }} cursor: pointer; margin-right: 5px;"></span>
                @endforeach
                {!! Form::hidden('color_id', $selectedColorId) !!}
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Descripción') !!}
        {!! Form::textarea('description', null, [
            'class' => 'form-control',
            'style' => 'height:100px',
            'placeholder' => 'Ingrese la descripción del vehiculo',
        ]) !!}
    </div>


    <div class="form-group">
        <label for="formFile" class="form-label">Seleccione una imagen</label>
        {!! Form::label('', '') !!}
        <input type="file" name="image" class="form-control" accept="image/*">
    </div>


    <script>
        $('#brand_id').change(function() {
            var id = $(this).val();
            $.ajax({
                url: "{{ route('admin.modelsbybrand', '_id') }}".replace("_id", id),
                type: "GET",
                datatype: "JSON",
                contenttype: "application/json",
                success: function(response) {
                    $.each(response, function(key, value) {
                        $('#model_id').empty();
                        $('#model_id').append(
                            '<option value=' + value.id + '>' + value.name +
                            '</option>');
                    });
                }

            })

        })
    </script>


    <button type="submit" class="btn btn-success"><i class="fas fa-save"> Actualizar</i></button>
    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i>
        Cancelar</button>
    {!! Form::close() !!}
</div>
