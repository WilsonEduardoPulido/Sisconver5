<div class="sidebar close d-flex flex-column justify-content-around">
    <div class="logo-details d-flex justify-content-center">

        <span class="logo_name mt-2">Sisconver </span>

    </div>
    <ul class="nav-links">
        <li class="">
            <a href="{{ '/home' }}">
                <i class='bx bxs-dashboard'></i>
                <span class="link_name">Dashboard</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Dashboard</a></li>
            </ul>
        </li>
        <li class="mt-2">
          <div class="iocn-link">
              <a href="{{ '/categorias' }}">
                  <i class='bx bxs-book'></i>
                  <span class="link_name">Categorias</span>
              </a>
              <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
              <li><a class="link_name" href="#">Gestion Categorias</a></li>
              <li><a href="{{ '/categorias/create' }}">Añadir Categoria</a></li>

          </ul>
      </li>
        <li class="mt-2">
            <div class="iocn-link">
                <a href="{{ '/libros' }}">
                    <i class='bx bxs-book'></i>
                    <span class="link_name">Libros</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Gestion Libros</a></li>
                <li><a href="#">Añadir Libro</a></li>

            </ul>
        </li>
        <li class="">
            <div class="iocn-link">
                <a href="{{ '/elementos' }}">
                    <i class='bx bx-book-alt'></i>
                    <span class="link_name">Elementos</span>
                </a>

            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Elementos</a></li>

            </ul>
        </li>
        <li class="mt-2">
            <a href="{{ '/prestamos' }}">
                <i class='bx bx-pie-chart-alt-2'></i>
                <span class="link_name">Prestamos</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="#">Realizar Prestamo</a></li>
            </ul>
        </li>
        <li class="mt-2">
            <div class="iocn-link">
                <a href="{{ '/devoluciones' }}">
                    <i class='bx bx-book-alt'></i>
                    <span class="link_name">Devoluciones</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Devoluciones</a></li>

            </ul>
        </li>




        <li class="mt-2">
            <div class="iocn-link">
                <a href="{{ '/usuarios' }}">
                    <i class='bx bxs-user-circle'></i>
                    <span class="link_name">Usuarios</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">Usuarios</a></li>

            </ul>
        </li>


        <li class="mt-2">
          <a href="#">
              <i class='bx bx-cog bx-spin-hover'></i>
              <span class="link_name">Setting</span>

          </a>
          <ul class="sub-menu blank">
              <li><a class="link_name" href="#">Setting</a></li>
              <ul class="">

                  <li><a href="#">Claro</a></li>
                  <li><a href="#">Oscuro</a></li>
                  <form class="col-8" method="POST" action="{{ route('logout') }} ">
                    @csrf

                    <li>  <a href="route('logout')"
                      onclick="event.preventDefault();
                      this.closest('form').submit();"
                      class=" dropdown-item">
                      {{ __('Log Out') }}
                  </a></li>
                    <li> <a :href="route('profile.edit')" class="dropdown-item">
                      {{ __('Profile') }}
                  </a></li>


                </form>
              </ul>
          </ul>
      </li>
    </ul>
    


</div>

