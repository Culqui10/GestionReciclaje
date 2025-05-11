{{-- {!! Form::model($colors, ['route'=>['admin.colors.update', $colors],'method' => 'put', 'files'=>true]) !!}
@include('admin.colors.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"> Actualizar</i></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
{!! Form::close() !!} --}}
@livewire('admin.colors.edit', ['colors' => $colors])
{{-- @livewire('admin.colors.edit', ['id' => $id]) --}}