{!! Form::model($types, ['route'=>['admin.types.update', $types],'method' => 'put']) !!}
@include('admin.types.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"> Actualizar</i></button>
<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>
{!! Form::close() !!}