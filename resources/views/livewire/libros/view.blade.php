<div class="container-fluid">
    @include('livewire.libros.modals')
    <div class="justify-content-center">


































        <div class="col-md-11 m-3">



            <!---Tabs-->
            <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                        type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Gestion De
                        Libros</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="librosPrestados" data-bs-toggle="tab" data-bs-target="#librosPrestados"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Ver Libros
                        Prestados</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Restaurar
                        Libros Eliminados</button>
                </li>

                <button class=" btn btn-warning text-white
      " id="contact-tab" data-bs-toggle="modal"
                    data-bs-target="#añadirLibroModal" type="button" role="tab" aria-controls="contact-tab-pane"
                    aria-selected="false"> Añadir Nuevo Libro <i
                        class=" text-white small bi-plus-circle-fill"></i></button>


            </ul>
            <div class="tab-content" id="myTabContent">

                <!---Tabla Gestion de libros---->
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">

                    <div class="card mt-3 ">

                        <div class="card-header d-flex justify-content-between bg-white">
                            <h4 class="text-center ">Tabla de gestion de Libros </h4>

                        </div>

                        <div class="d-flex  justify-content-between">

                            <div class="col-6">
                                <input wire:model='keyWord' type="text" class="form-control  m-3" name="search"
                                    id="search" placeholder="Buscar Libros">
                            </div>



                        </div>
                        <div class="card-body  ">

                            <div class="table-responsive">
                                <table class="table libros table-bordered table-sm">
                                    <thead class="thead">
                                        <tr>
                                            <td>#</td>
                                            <th>Nombre</th>
                                            <th>Autor</th>
                                            <th>Editorial</th>
                                            <th>Edicion</th>

                                            <th>Estado</th>
                                            <th>Categoria </th>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($libros as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->Nombre }}</td>
                                                <td>{{ $row->Autor }}</td>
                                                <td>{{ $row->Editorial }}</td>
                                                <td>{{ $row->Edicion }}</td>

                                                @if ($row->Estado == 'Disponible')
                                                    <td class=" text-white">
                                                        <button class="btn btn-warning text-white">
                                                            {{ $row->Estado }}
                                                        </button>


                                                    </td>
                                                @else
                                                    <td class=" text-white">
                                                        <button class="btn btn-danger text-white">
                                                            {{ $row->Estado }}
                                                        </button>


                                                    </td>
                                                @endif


                                                <td>{{ $row->categoria->nombre }}</td>
                                                <td class="d-flex">


                                                    <a data-bs-toggle="modal" data-bs-target="#actualizarLibroModal"
                                                        class=" bi bi-pencil-square text-white btn btn-info "
                                                        wire:click="edit({{ $row->id }})">Editar </a>
                                                    <a class="btn btn-danger bi bi-trash3-fill  text-white "
                                                        onclick="confirm('Confirm Delete Libro id {{ $row->id }}? \nDeleted Libros cannot be recovered!')||event.stopImmediatePropagation()"
                                                        wire:click="destroy({{ $row->id }})"> Inactivar</a>
                                                    <a data-bs-toggle="modal" data-bs-target="#verlibro"
                                                        class=" bi bi bi-eye-fill text-white btn btn-warning "
                                                        wire:click="edit({{ $row->id }})">ver </a>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center bg-emerald-300" colspan="100%">No hay registros para mostrar
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-end">{{ $libros->links() }}</div>
                            </div>
                        </div>





                    </div>


                </div>

                <!---Tabla de libros Eliminados Fin---->
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="1">
                    <div class="card mt-3 ">

                        <div class="card-header d-flex justify-content-between bg-white">
                            <h4 class="text-center ">Restaurar Libros Eliminados </h4>

                        </div>

                        <div class="d-flex  justify-content-between">

                            <div class="col-6">
                                <input wire:model='keyWord' type="text" class="form-control  m-3" name="search"
                                    id="search" placeholder="Buscar Libros">
                            </div>



                        </div>
                        <div class="card-body  ">

                            <div class="table-responsive">
                                <table class="table libros table-bordered table-sm">
                                    <thead class="thead">
                                        <tr>
                                            <td>#</td>
                                            <th>Nombre</th>
                                            <th>Autor</th>
                                            <th>Editorial</th>
                                            <th>Edicion</th>

                                            <th>Estado</th>
                                            <th>Categoria </th>
                                            <td>Acciones</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($consulta as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $row->Nombre }}</td>
                                                <td>{{ $row->Autor }}</td>
                                                <td>{{ $row->Editorial }}</td>
                                                <td>{{ $row->Edicion }}</td>

                                                @if ($row->Estado == 'Disponible')
                                                    <td class=" text-white">
                                                        <button class="btn btn-warning text-white">
                                                            {{ $row->Estado }}
                                                        </button>


                                                    </td>
                                                @else
                                                    <td class=" text-white">
                                                        <button class="btn btn-danger text-white">
                                                            {{ $row->Estado }}
                                                        </button>


                                                    </td>
                                                @endif


                                                <td>{{ $row->categoria->nombre }}</td>
                                                <td class="d-flex">


                                                    <a data-bs-toggle="modal"
                                                        class=" bi bi-pencil-square text-white btn btn-info btn-sm"
                                                        wire:click="restaurarLibro({{ $row->id }})">Resaturar
                                                    </a>

                                                    <a data-bs-toggle="modal" data-bs-target="#verlibro"
                                                        class=" bi bi bi-eye-fill text-white btn-sm  btn btn-danger "
                                                        wire:click="eliminarLibroTotalMente({{ $row->id }})">Eliminar
                                                    </a>

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center bg-emerald-300" colspan="100%">No data Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="float-end">{{ $consulta->links() }}</div>
                            </div>
                        </div>





                    </div>
                </div>












                <!-- Modal -->
                <div wire:ignore.self class="modal " id="verlibro" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="card">
                                    <div class="card-header">
                                        Detalles Del Libro
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Nombre Del Libro:{{ $Nombre }}</h5>
                                        <h5>Autor:{{ $Autor }}</h5>
                                        <h5>Autor:{{ $Editorial }}</h5>
                                        <h5>Autor:{{ $Edicion }}</h5>
                                        <h5>Autor:{{ $Descripcion }}</h5>
                                        <h5>Estado:{{ $Estado }}</h5>

                                    </div>
                                </div>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
