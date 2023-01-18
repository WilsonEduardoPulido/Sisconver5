@section('title', __('Devolucions'))
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div style="display: flex; justify-content: space-between; align-items: center;">
						<div class="float-left">
							<h4><i class="fab fa-laravel text-info"></i>
							Devolucion Listing </h4>
						</div>
						@if (session()->has('message'))
						<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
						@endif
						<div>
							<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Devolucions">
						</div>
						<div class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#createDataModal">
						<i class="fa fa-plus"></i>  Add Devolucions
						</div>
					</div>
				</div>
				
				<div class="card-body">
						@include('livewire.devolucions.modals')
				<div class="table-responsive">
					<table class="table table-bordered table-sm">
						<thead class="thead">
							<tr> 
								<td>#</td> 
								<th>Fecha Devolucion</th>
								<th>Prestamos Id</th>
								<th>Libros Id</th>
								<th>Elementos Id</th>
								<th>Usuario Id</th>
								<th>Curso Id</th>
								<td>ACTIONS</td>
							</tr>
						</thead>
						<tbody>
							@forelse($devolucions as $row)
							<tr>
								<td>{{ $loop->iteration }}</td> 
								<td>{{ $row->Fecha_devolucion }}</td>
								<td>{{ $row->prestamos_id }}</td>
								<td>{{ $row->libros_id }}</td>
								<td>{{ $row->elementos_id }}</td>
								<td>{{ $row->usuario_id }}</td>
								<td>{{ $row->curso_id }}</td>
								<td width="90">
									<div class="dropdown">
										<a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
											Actions
										</a>
										<ul class="dropdown-menu">
											<li><a data-bs-toggle="modal" data-bs-target="#updateDataModal" class="dropdown-item" wire:click="edit({{$row->id}})"><i class="fa fa-edit"></i> Edit </a></li>
											<li><a class="dropdown-item" onclick="confirm('Confirm Delete Devolucion id {{$row->id}}? \nDeleted Devolucions cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>  
										</ul>
									</div>								
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="100%">No data Found </td>
							</tr>
							@endforelse
						</tbody>
					</table>						
					<div class="float-end">{{ $devolucions->links() }}</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>