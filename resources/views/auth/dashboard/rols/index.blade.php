@extends('layouts.admin.app')
@section('content')
<h3>Roles</h3>
	<button data-toggle="modal" data-target="#add_new_rol_modal" class="btn btn-success pull-right">
		<i class="fas fa-plus"></i> Nuevo Registro
		</button>
				
			<table class="table table-stripped table-bordered table-responsive">
					<tr>
						<th class="text-center">No.</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Acciones</th>
					</tr>
				@foreach($roles as $rol)
					<tr>
						<td class="text-center">{{$rol->id}}</td>
						<td>{{$rol->name}}</td>
						<td width="172px"><a class="btn btn-sm btn-warning"href="">
							<i class="fas fa-edit"></i> Editar</a> 
							<a class="btn btn-sm btn-danger" href="">
							<i class="fas fa-trash"></i> Eliminar</a>
						</td>
					</tr>
				@endforeach
			</table>
				<div class="text-right">
					{{$roles->render()}}
				</div>

				
	<!-- /Content Section -->
<!-- Bootstrap Modals -->
	<!-- Modal - Agregar nuevo registro -->
		
	<div class="modal fade" id="add_new_rol_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Agregar registro</h4>
	            </div>
	            <div class="modal-body">
	 				<form id="frm_new_post" action="{{route('rols.store')}}" method="POST" id="frm-insert">

	                <div class="form-group">
	                    <label for="name">Rol</label>
	                    <input name="name" type="text" id="rolname" placeholder="Titulo" class="form-control"/>
	                </div>
					<div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<input type="submit" class="btn btn-primary" value="Guardar" /> 
					</div>
					</form>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- // Modal nuevo registro -->

	<!-- Modal - Actualizar registro -->
	<!-- <div class="modal fade" id="update_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="myModalLabel">Editar registro</h4>
	            </div>
	            <div class="modal-body">
	 
	                <div class="form-group">
	                    <label for="update_nombre">Nombre</label>
	                    <input type="text" id="update_nombre" placeholder="Nombre" class="form-control"/>
	                </div>
	 
	                <div class="form-group">
	                    <label for="update_apellidos">Apellidos</label>
	                    <input type="text" id="update_apellidos" placeholder="Apellidos" class="form-control"/>
	                </div>

	                <div class="form-group">
	                    <label for="update_direccion">Dirección</label>
	                    <input type="text" id="update_direccion" placeholder="Dirección" class="form-control"/>
	                </div>
	 
	                <div class="form-group">
	                    <label for="update_email">Correo electronico</label>
	                    <input type="text" id="update_email" placeholder="Correo electronico" class="form-control"/>
	                </div>
	 
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	                <button type="button" class="btn btn-primary" onclick="updateRecord()" >Actualizar</button>
	                <input type="hidden" id="hidden_usuario_id">
	            </div>
	        </div>
	    </div>
	</div> -->
	<!-- // Modal actualizar registro -->
@endsection

@section('script')
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#frm_new_post').on('submit', function(e){
			e.preventDefault();
			var data	 = $(this).serialize();
			var url		 = $(this).attr('action');
			var post	 = $(this).attr('method');
				
			console.log(data.length)
			
			$.ajax({

				type 	: post,
				url 	: url,
				data 	: data,
				dataType: 'json',
				success:function(data)
				{
					console.log(data)
						$('#add_new_rol_modal').modal('hide');

				}
			})
		});
	</script>
@endsection