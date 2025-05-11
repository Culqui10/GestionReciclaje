{!! Form::model($zone, ['route'=>['admin.zones.update', $zone],'method' => 'put']) !!}
@include('admin.zones.partials.form')
<button type="submit" class="btn btn-success"><i class="fas fa-save"> Actualizar</i></button>
<a type="button" href="{{route('admin.zones.index')}}" class="btn btn-danger"><i class="fas fa-window-close"> Cancelar</i></a>
{!! Form::close() !!}