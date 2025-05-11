{!! Form::open(['route'=>'admin.vehicleoccupants.store','files'=>true]) !!}
            @include('admin.occupants.partials.form')
            
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> Cancelar</button>

{!! Form::close() !!}
