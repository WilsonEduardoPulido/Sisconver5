@if (session()->has('alertaprestamo'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>
            <p class="small">{{ session('alertaprestamo') }}</p>
        </strong>
    </div>

    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function(alert) {
            new bootstrap.Alert(alert)
        })
    </script>
@endif
@if (session()->has('alertaprestamow'))
    <div wire:poll.4s class="alert alert-info alert-dismissible fade show" role="alert">
      
        <strong>
            <p class="small">{{ session('alertaprestamow') }}</p>
        </strong>
    </div>

    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function(alert) {
            new bootstrap.Alert(alert)
        })
    </script>
@endif

@if (session()->has('exitoprestamo'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <strong>
            <p class="small">{{ session('exitoprestamo') }}</p>
        </strong>
    </div>

    <script>
        var alertList = document.querySelectorAll('.alert');
        alertList.forEach(function(alert) {
            new bootstrap.Alert(alert)
        })
    </script>
@endif

<div class="card p-1">
    <div class="card-header bg-info text-center text-white">
        Realizar Prestamo de un elemento
    </div>
    


        <form class="col-12" wire:submit.prevent="realizarPrestamo" id="#PrestamoElemento">
            <div class="">
                <label class="form-label">Bibliotecario</label>
                <input type="text" class="form-control " id="validationServer01" required wire:model="name">

            </div>


            <div class="">
                <label for="validationServer01" class="form-label">Alumno o Persona
                    Solicitante</label>

                <select class="form-select" name="" id="" wire:model="usuario_id">

                    @foreach ($consultaUsuarios as $usuario)
                        <option selected value="{{ $usuario->id }}"> {{ $usuario->name }}
                        </option>
                    @endforeach


                </select>
            </div>

   

    <div class="">
        <label for="validationServer01" class="form-label">Elemento</label>
        <input type="text" class="form-control " id="validationServer01" required wire:model="nombreElemento">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>

    <div class="">
        <label for="validationServer01" class="form-label">Cabtidad Disponible</label>
        <input type="number" class="form-control " id="validationServer01" value="Mark" required
            wire:model="cantidadElemento">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>


    <div class="">
        <label for="validationServer01" class="form-label">Cabtidad a Prestar</label>
        <input type="number" class="form-control " id="validationServer01" value="Mark" required
            wire:model="CantidadPrestar">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>


    <div class="">
        <label for="validationServer01" class="form-label">Fecha del prestamo</label>
        <input type="date" class="form-control " id="validationServer01" value="Mark" required
            wire:model="Fecha_Prestamo">
        <div class="valid-feedback">
            Looks good!
        </div>
    </div>
    

    <div class="mt-4 col-12 justify-content-around  d-flex">
        <button type="button" title="Cancelar" class="btn btn-danger  btn-sm text-white ">Cancelar</button>
        <button type="submit" title="Prestar" class="btn btn-warning btn-sm text-white  ">Prestar</button>
        
    </div>

  
    </form>
</div>