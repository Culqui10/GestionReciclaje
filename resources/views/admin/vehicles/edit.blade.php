{{-- {!! Form::model($vehicle, ['route'=>['admin.vehicles.update', $vehicle],'method' => 'put']) !!}
@include('admin.vehicles.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"> Actualizar</i></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
{!! Form::close() !!} --}}
@livewire('admin.vehicles.edit', ['vehicle' => $vehicle, 'brands' => $brands, 'models' => $models, 'types' => $types, 'colors' => $colors])