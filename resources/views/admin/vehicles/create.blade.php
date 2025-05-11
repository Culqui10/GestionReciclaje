{{-- {!! Form::open(['route'=>'admin.vehicles.store','files'=>true]) !!}
            @include('admin.vehicles.partials.form')
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
            </a>

{!! Form::close() !!} --}}
@livewire('admin.vehicles.create', [
    'brands' => $brands,
    'models' => $models,
    'types' => $types,
    'colors' => $colors,
])
