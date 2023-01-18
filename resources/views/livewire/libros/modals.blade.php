<div>
    <!-- Añadir Libro Modal -->
    <div wire:ignore.self class="modal fade modal-lg" id="añadirLibroModal" data-bs-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-center ">
                    <h5 class="modal-title text-white" id="createDataModalLabel">Añadir Nuevo Libro</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body row ">
                    <form class="d-flex  row  ">
                        <div class="form-group col-6 mb-3">
                            <label for="Nombre">Nombre Del Libro</label>
                            <input wire:model="Nombre" type="text" class="form-select @error('Nombre') is-invalid @enderror" id="Nombre"
                                placeholder="Nombre">
                                @error('Nombre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Autor">Autor Del Libro</label>
                            <input wire:model="Autor" type="text" class="form-select @error('Autor') is-invalid @enderror" id="Autor"
                                placeholder="Autor">
                                @error('Autor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Editorial">Editorial</label>
                            <input wire:model="Editorial" type="text" class="form-control" id="Editorial"
                                placeholder="Editorial">
                            @error('Editorial')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Edicion">Edicion</label>
                            <input wire:model="Edicion" type="text" class="form-control" id="Edicion"
                                placeholder="Edicion">
                            @error('Edicion')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="Estado">Estado</label>
                            <select wire:model="Estado" class="form-select" required>
                                <option  >Selecione el estado del libro</option>
                                <option  value="Disponible">Disponible</option>
                                <option value="Prestado">Prestado</option>
                                <option value="Inactivo">Inactivo</option>

                            </select>
                            @error('Estado')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="categoria_id">Seleccione el Genero Literario </label>
                            <select wire:model="categoria_id" name="categoria_id" class="form-select" required>

                                @foreach ($categorias as $row)
                                    <option selected value="{{ $row->id }}">{{ $row->nombre }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3 " wire:ignore>
                            <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" wire:model="Descripcion" cols="1" rows="2"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer mt-5 d-flex justify-content-center">
                    <button type="button" class="btn btn-danger close-btn text-white col-4"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click.prevent="store()"
                        class="btn btn-warning text-white col-4">Guardar</button>
                </div>
            </div>
        </div>
    </div>






    <!-- Actualizar Datos Modal -->


    <div wire:ignore.self class="modal fade modal-lg" id="actualizarLibroModal" data-bs-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createDataModalLabel">Actualizar Datos Del Libro</h5>
                    <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body row ">
                    <form class="d-flex  row  ">
                        <div class="form-group col-6 mb-3">
                            <label for="Nombre">Nombre Del Libro</label>
                            <input wire:model="Nombre" type="text" class="form-control" id="Nombre"
                                placeholder="Nombre">
                            @error('Nombre')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Autor">Autor Del Libro</label>
                            <input wire:model="Autor" type="text" class="form-control" id="Autor"
                                placeholder="Autor">
                            @error('Autor')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Editorial">Editorial</label>
                            <input wire:model="Editorial" type="text" class="form-control" id="Editorial"
                                placeholder="Editorial">
                            @error('Editorial')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="Edicion">Edicion</label>
                            <input wire:model="Edicion" type="text" class="form-control" id="Edicion"
                                placeholder="Edicion">
                            @error('Edicion')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-6 mb-3">
                            <label for="Estado">Selecione el estado del libro</label>
                            <select wire:model="Estado" class="form-select" required>

                                <option selected value="Disponible">Disponible</option>
                                <option value="Prestado">Prestado</option>
                                <option value="Inactivo">Inactivo</option>

                            </select>
                            @error('Estado')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-6 mb-3">
                            <label for="categoria_id">Seleccione el Genero Literario </label>
                            <select wire:model="categoria_id" name="categoria_id" class="form-select" required>

                                @foreach ($categorias as $row)
                                    <option selected value="{{ $row->id }}">{{ $row->nombre }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3 ">
                            <label for="exampleFormControlTextarea1" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" wire:model="Descripcion" cols="1"
                                rows="2"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer mt-5 d-flex justify-content-center">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-danger col-4 text-white"
                        data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click.prevent="update()"
                        class="btn btn-warning col-4 text-white">Actualizar</button>
                </div>

            </div>
        </div>
    </div>






</div>
