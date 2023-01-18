



@extends('layouts.app')
@section('title', __('Gestion De Prestamos'))
@section('content')




@include('partials.sidebar')



<section class="home-section h-50 ">
    @include('partials.nav')

    
   
    <div class="col-11 m-auto">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @livewire('prestamos')
                   
                </div>     
            </div>   
        </div>


        
    
</div>
  
  
  
@include('partials.footer')
  
</section>