
<nav class="navbar  navbar-expand-md home-content  d-flex  navbar navbar-expand-lg align-items-center  shadow-sm">
  <div class="container">
     
      <div class="   ">
        <i class='bx bx-menu p-2 '></i>
        <img class="rounded-circle bg-white mr-5" src="{{  asset ('img/escudo-colegio-sin-fondo.png ' )}}" alt="Logo colegioS" width="60px" height="60px">
          <span class="text m-5">Colegio La independencia</span>
          

      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
@auth()
          <ul class="navbar-nav mr-auto">
  <!--Nav Bar Hooks - Do not delete!!-->
  
          </ul>
@endauth()

          <!-- Right Side Of Navbar -->
          <ul class="d-flex   justify-content-between align-content-center ">
              <!-- Authentication Links -->
              @guest
                  @if (Route::has('login'))
                       <!-- <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>-->
                  @endif

                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                      </li>
                  @endif

              @else
                  

                   
                       
                          <img src="{{  asset ('img/trabajando.png  ' )}}" alt="Profile" width="40px" height="50px" class="rounded-circle bg-white">
            <span class="text-white ">Bienvenido {{ Auth::user()->name }}</span>
                      

                      <div class="" >
                          <a class="text-white btn   d-flex btn-danger   btn-close-white" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
        
              @endguest
          </ul>
      </div>
  </div>
</nav>