@extends('adminlte::page')

@section('title', 'Ocupantes')


@section('content')
<div class="p-2">

    <?php if ($errors->any()) : ?>
    <?php foreach ($errors->all() as $e) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endforeach;
    endif;
    ?>
</div>
    <div class="card">
        <div class="card-header">
            {{-- <button class="btn btn-success float-right" id="btnNuevo"><i class="fas fa-plus-circle"></i> Registrar</button> --}}
            <h4>Historial de ocupantes de vehiculos</h4>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>OCUPANTE</th>
                        <th>TIPO DE  OCUPANTE</th>
                        <th>ESTADO</th>
                        <th>VEHICULO</th>
                        <th>FECHA ASIGNADA</th>
                        {{-- <th width=20></th>
                        <th width=20></th> --}}
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach ($vehicleoccupants as $occupant)
                    <tr>
                        <td>{{ $occupant->id}}</td>
                        <td>{{ $occupant->uname}}</td>
                        <td>{{ $occupant->utname}}</td>
                        <td>{{ $occupant->status}}</td>
                        <td>{{ $occupant->vname}}</td>
                        <td>{{ $occupant->assignment_date}}</td>
                        {{-- <td><!--<a href="{{route('admin.vehicleoccupants.edit',$occupant->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i></a>-->
                            <button class="btnEditar btn btn-primary btn-sm" id={{ $occupant->id }}><i 
                                    class="fa fa-edit"></i></button> 
                        </td>
                        <td>
                            <form action="{{route('admin.vehicleoccupants.destroy', $occupant->id)}}" method="POST" class="fmrEliminar">
                                @method('delete') 
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i></a>
                                </button>
                                </form>
                        </td>            --}}
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Formulario de ocupantes de vehículo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              
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
                    url: "{{ route('admin.vehicleoccupants.create') }}",
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
                url: "{{route('admin.vehicleoccupants.edit','_id')}}".replace('_id', id),
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

