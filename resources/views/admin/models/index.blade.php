@extends('adminlte::page')

@section('title', 'Modelos')


@section('content')
<div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <!--<a href="{{route('admin.models.create')}}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> Registrar</a>-->
            <button class="btn btn-success float-right" id="btnNuevo"><i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de modelos</h4>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>MODELO</th>
                        <th>MARCA</th>
                        <th>CÓDIGO</th>
                        <th>DESCRIPCIÓN</th>
                        <th width=20></th>
                        <th width=20></th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id}}</td>
                        <td>{{ $model->name}}</td>
                        <td>{{ $model->brandname}}</td>
                        <td>{{ $model->code}}</td>
                        <td>{{ $model->description}}</td>
                        <td><!--<a href="{{route('admin.models.edit',$model->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>-->
                            <button class="btnEditar btn btn-primary" id={{ $model->id }}><i 
                                    class="fa fa-edit"></i></button> 
                        </td>
                        <td><form action="{{route('admin.models.destroy', $model->id)}}" method="POST" class="fmrEliminar">
                            @method('delete') 
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a></td></form>
                            
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Formulario de modelo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
          </div>
        </div>
      </div>
@stop
     
@section('js')
    <script>
            $('#datatable').DataTable({"language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"}});
            
            $('#btnNuevo').click(function(){
                $.ajax({
                    url: "{{ route('admin.models.create') }}",
                    type: "GET",
                    success: function(response){
                        $('#formModal .modal-body').html(response);
                        $('#formModal').modal('show');
                    }
                })
            
            })
            $(".btnEditar").click(function() {
                var id = $(this).attr('id');
            $.ajax({
                url: "{{route('admin.models.edit','_id')}}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#formModal .modal-body').html(response);
                        $('#formModal').modal('show');
                }
            });
        });

        $(".fmrEliminar").submit(function(e) {
                e.preventDefault();
                    Swal.fire({
                    title: "Seguro de eliminar?",
                    text: "Esta accion es irreversible!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminar!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                        /*Swal.fire({
                        title: "Marca eliminada!",
                        text: "Porceso exitoso.",
                        icon: "Satisfactorio"
                        });*/
                    }
                    });
        });

    </script>
    
    @if(session('success')!==null)
    <script>
        Swal.fire({
            title: "Proceso Exitoso",
            text: "{{ session('success') }}",
            icon: "success"
        });
    </script>
    @endif

@stop

