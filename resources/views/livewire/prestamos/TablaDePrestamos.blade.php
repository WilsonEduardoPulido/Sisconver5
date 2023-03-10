<div class="card mt-3 ">

    <div class="card-header d-flex justify-content-between bg-white">
        <h4 class="text-center ">Tabla de Elementos</h4>
        
    </div>

    <div class="d-flex  justify-content-between">

        <div class="col-6">
            <input wire:model='buscadorPrestamos' type="text" class="form-control  m-3" name="buscarPrestamo"
                id="buscarPrestamo" placeholder="Buscar Prestamo...">
        </div>



    </div>
    <div class="card-body  ">

        <div class="table-responsive">
            <table class="table libros table-bordered table-sm">
                <thead class="thead">
                    <tr>
                        <td>#</td>
                        <th>Bibliotecario</th>
                        <th>Fecha Del Prestamo</th>
                        <th>Elemento o Libro Prestado</th>

                        <th>Usuario </th>
                        <th>Cantidad  Prestada </th>
                        <th>Estado</th>
                    
                        <td>Acciones</td>

                    </tr>
                </thead>
                <tbody>
                    @forelse($prestamos as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->prestador->name }}</td>

                            <td>{{ $row->created_at }}</td>
                            <td>{{ $row->elemento->nombre }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td colspan="">{{ $row->CantidadPrestada }}</td>
                            @if ($row->Estado_Prestamo == 'Activo')
                                <td class=" text-white">
                                    <button  title="Activo" class="btn btn-warning bi bi bi-check2-square btn-sm text-white">
                                        
                                    </button>


                                </td>
                            @else
                                <td class=" text-white" title="Finalizado">
                                    <button class="btn btn-danger bi bi-x-square btn-sm text-white">
                                        
                                    </button>


                                </td>
                            @endif


                            <td class="d-flex justify-content-around">


                                <button title="Editar" data-bs-toggle="modal"  data-bs-target="#editarPrestamoModal"
                                    class=" bi bi-pencil-square btn-sm text-white btn btn-info "
                                    wire:click="editarPrestamo({{ $row->id }})"> </button>


                                <a title="Inactivar" class="btn btn-danger bi bi-trash3-fill btn-sm  text-white "
                                    onclick="confirm('Confirm Delete Libro id {{ $row->id }}? \nDeleted Libros cannot be recovered!')||event.stopImmediatePropagation()"
                                    wire:click="inactivar({{ $row->id }})"></a>
                                <a title="Ver Detalles" data-bs-toggle="modal" data-bs-target="#verDetallesCategoria"
                                    class=" bi bi bi-eye-fill btn-sm text-white btn btn-warning "
                                    wire:click="verDetallesCategoria({{ $row->id }})"> </a>

                                    <a title="Realizar Prestamo Elemento" data-bs-toggle="modal" data-bs-target="#PrestamoElemento"
                                    class=" bi bi-file-arrow-up btn-sm text-dark btn btn-toolbar "
                                    wire:click="cargarDatosPrestamo({{ $row->id }})"> </a>
                                   

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td class="text-center bg-emerald-300" colspan="100%">No hay registros para mostrar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="float-end">{{ $prestamos->links() }}</div>
        </div>
    </div>





</div>
</div>

