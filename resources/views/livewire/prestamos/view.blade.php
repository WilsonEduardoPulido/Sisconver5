


@section('title', __('Categorias'))
<div class="container-fluid">
   
    <div class="justify-content-center">
        @if (session()->has('message'))
		
		<div wire:poll.4s class="btn btn-sm btn-success" style="margin-top:0px; margin-bottom:0px;"> {{ session('message') }} </div>
		
		
        @endif
        <div class="col-md-12">

            <div class="card m-5 ">
				
				

                <div class="card-header d-flex justify-content-between bg-white">
                    <h4 class="text-center ">Tabla de gestion de Prestamos</h4>
                    <button class=" btn-warning text-white  btn  " data-bs-toggle="modal"
                        data-bs-target="#crearNuevoPrestamoModal">
                        Realizar Un Prestamo <i class=" text-white small bi-plus-circle-fill"></i>
                    </button>
                </div>

                <div class="d-flex  justify-content-between">

                    <div class="col-6 mt-4">
						<input wire:model='keyWord' type="text" class="form-control" name="search" id="search" placeholder="Search Prestamos">
					</div>



                </div>
                <div class="card-body  ">

                    <div class="table-responsive">
						<table class="table table-bordered table-sm">
							<thead class="thead">
								<tr> 
									<td>#</td> 
									<th>Fecha Prestamo</th>
									<th>Libros Id</th>
									<th>Elementos Id</th>
									<th>Usuario Id</th>
									<th>Curso Id</th>
									<td>ACTIONS</td>
								</tr>
							</thead>
							<tbody>
								@forelse($prestamos as $row)
								<tr>
									<td>{{ $loop->iteration }}</td> 
									<td>{{ $row->Fecha_prestamo }}</td>
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
												<li><a class="dropdown-item" onclick="confirm('Confirm Delete Prestamo id {{$row->id}}? \nDeleted Prestamos cannot be recovered!')||event.stopImmediatePropagation()" wire:click="destroy({{$row->id}})"><i class="fa fa-trash"></i> Delete </a></li>  
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
						<div class="float-end">{{ $prestamos->links() }}</div>
						</div>
					
                </div>



                

            </div>
        </div>
    </div>






























































						
					
				
				
						@include('livewire.prestamos.modals')
				