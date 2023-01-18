@extends('layouts.app')






@extends('layouts.app')


<div class="container-fluid h-100 inicio  m-auto">
    <div class="row d-flex  justify-content-center align-content-center  ">
        <div class="col-md-4">
            <div class="card col-md-12  mt-4">
               

                <div class="card-body  d-flex aling-items-center flex-column justify-content-center">
                    
                    
                                
                                

                    <div class="card mt-auto">
                        <div class="card-header text-center">{{ __('Confirm Password') }}</div>
                        <div class="col-12 d-flex justify-content-center">
                            <img class="rounded-circle " height="4%" src="{{ asset ('img/escudo-colegio-nombre.png') }} "alt="Escudo  Colegio" >
                        </div>
                        <div class="card-body">
                            {{ __('Please confirm your password before continuing.') }}
        
                            <form method="POST" action="{{ route('password.confirm') }}">
                                @csrf
        
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>
        
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-12  offset-md-4">
                                        <button type="submit" class="btn btn-warning text-white">
                                            {{ __('Confirm Password') }}
                                        </button>
        
                                        
                                    </div>
                                    @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>




















































