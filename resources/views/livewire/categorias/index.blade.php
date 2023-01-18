@extends('layouts.app')
@section('title', __('Gestion De Categorias'))
@section('content')




    @include('partials.sidebar')

    

    <section class="home-section " >
        @include('partials.nav')

        

       
           
                
                    

                        
                        @livewire('categorias')
                       
                       
                
                
           
         

           

<div class="mt-5 ">
    @include('partials.footer')
    </div>

                     

    </section>
   







@endsection




















@vite(['resources/js/app.js','resources/js/jquery3.6.3.js'])

<script>
    window.addEventListener('cerrar', event => {
        $('#crearNuevaCategoriaModal').modal('hide')
        $('#actualizarCategoriaModal').modal('hide')
        if ($('.modal-backdrop').is(':visible')) {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        };




    });
</script>

<script>
    window.addEventListener('swal',function(e) {
        Swal.fire({
            title:  e.detail.title,
            icon: e.detail.icon,
            iconColor: e.detail.iconColor,
            timer: 3000,
            toast: true,
            position: 'top-right',
            toast:  true,
            showConfirmButton:  false,
        });
    });
</script>