



<div>

   
    <div class="container-fluid">

        <div class="justify-content-center">




            <div class="col-md-11 m-3">



                <!--------LINICIO LINKS TABS -------->
                <ul class="nav nav-tabs mt-2" id="myTab" role="tablist">


                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                            aria-selected="true">Gestion Prestamos</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Restaurar Categorias</button>
                    </li>



                   


                </ul>


                <!--------FIN LINKS TABS -------->




                <!------------CONTENEDORES  DE LAS TABS  ------------->



                <div class="tab-content" id="pills-tabContent">
                    <!----------- INICIO CONTENEDOR 1  ------------->

                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab" tabindex="0">
                 @include('livewire.prestamos.TablaDePrestamos')    
                    </div>
                    <!----------- FIN CONTENEDOR 1  ------------->

                    <!----------- INICIO CONTENEDOR 2  ------------->
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                        tabindex="0">
                     {{--   @include('livewire.categorias.TablaRestaurarCategorias')--}} 
                    </div>
                    <!----------- FIN CONTENEDOR 2  ------------->


                    <!----------- INICIO CONTENEDOR 3  ------------->
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                        tabindex="0">

                        hola
                    </div>

                    <!----------- FIN  CONTENEDOR 3  ------------->
















                </div>


                @include('livewire.prestamos.modales')

            </div>
        </div>
    </div>
</div>