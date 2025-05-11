<table class="table" id="datatable">
    <thead>
        <tr>
            <th>FECHA</th>
            <th>ESTADO</th>
            <th>VEHICULO</th>
            <th>RUTA</th>
            <th>DESCRIPCIÓN</th>
            <th width=20></th>
            <th width=20></th>
        </tr>

    </thead>
    <tbody>
        @foreach ($listado as $c)
            <tr>
                <td>{{ $c->fecha }}</td>
                <td>{{ $c->estado }}</td>
                <td>{{ $c->vehiculo }}</td>
                <td>{{ $c->ruta }}</td>
                <td>{{ $c->description }}</td>
                <td>
                    <?php if ($c->estado == 'Iniciado') : ?>
                    <button class="btnEditar btn btn-primary btn-sm" id="{{ $c->id }}"><i
                            class="fa fa-edit"></i></button>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($c->estado == 'Iniciado') : ?>
                    <form action="{{ route('admin.programming.destroy', $c->id) }}" method="POST" class="fmrEliminar">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i></a>
                        </button>
                    </form>
                    <?php endif; ?>
                </td>
                </form>

            </tr>
        @endforeach

    </tbody>
</table>
<script>
    $('#datatable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        }
    });

    $(".btnEditar").click(function() {
        var id = $(this).attr('id');
        $.ajax({
            url: "{{ route('admin.programming.edit', '_id') }}".replace('_id', id),
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
