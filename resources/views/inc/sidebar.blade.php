<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        <span>Apps</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <router-link tag="li" to="/example" exact-active-class="active">
                        <a>Example</a>
                    </router-link>
                </ul>
            </li>

            {{-- Configuración --}}
            <li class="menu">
                <a href="#configuracion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-cogs"></i>
                        <span>Configuración</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="configuracion" data-parent="#accordionExample">
                    <span>INVENTARIO</span>
                    <router-link tag="li" to="/categoria" exact-active-class="active">
                        <a>Categoría</a>
                    </router-link>
                    <router-link tag="li" to="/unidad_medida" exact-active-class="active">
                        <a>Unidad de medida</a>
                    </router-link>

                    <span>LOCALIDAD</span>
                    <router-link tag="li" to="/departamentos" exact-active-class="active">
                        <a>Departamentos</a>
                    </router-link>
                    <router-link tag="li" to="/municipios" exact-active-class="active">
                        <a>Municipios</a>
                    </router-link>
                </ul>
            </li>

            {{-- Financiero --}}
            <li class="menu">
                <a href="#financiero" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-cash-register"></i>
                        <span>Financiero</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="financiero" data-parent="#accordionExample">
                    <router-link tag="li" to="/movimientos" exact-active-class="active">
                        <a>Movimientos</a>
                    </router-link>
                    <router-link tag="li" to="/caja" exact-active-class="active">
                        <a>Caja</a>
                    </router-link>
                </ul>
            </li>

            {{-- Autenticación --}}
            <li class="menu">
                <a href="#autenticacion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-lock"></i>
                        <span>Autenticación</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="autenticacion" data-parent="#accordionExample">

                </ul>
            </li>

            {{-- Personal --}}
            <li class="menu">
                <a href="#personal" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-user-check"></i>
                        <span>Personal</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="personal" data-parent="#accordionExample">
                    <router-link tag="li" to="/puestos" exact-active-class="active">
                        <a>Puestos</a>
                    </router-link>
                    <router-link tag="li" to="/empleados" exact-active-class="active">
                        <a>Empleados</a>
                    </router-link>
                </ul>
            </li>

            {{-- Residentes --}}
            <li class="menu">
                <a href="#residentes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-house-user"></i>
                        <span>Hogar</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="residentes" data-parent="#accordionExample">
                    <router-link tag="li" to="/residentes" exact-active-class="active">
                        <a>Residentes</a>
                    </router-link>
                </ul>
            </li>

            {{-- Inventario --}}
            <li class="menu">
                <a href="#inventario" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-warehouse"></i>
                        <span>Inventario</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="inventario" data-parent="#accordionExample">
                    <router-link tag="li" to="/ajuste_producto" exact-active-class="active">
                        <a>Ajuste de producto</a>
                    </router-link>
                    <router-link tag="li" to="/medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/productos" exact-active-class="active">
                        <a>Productos</a>
                    </router-link>
                </ul>
            </li>

            {{-- Entradas --}}
            <li class="menu">
                <a href="#entradas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-cart-plus"></i>
                        <span>Entradas</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="entradas" data-parent="#accordionExample">
                    <router-link tag="li" to="/compras" exact-active-class="active">
                        <a>Compras</a>
                    </router-link>
                </ul>
            </li>

            {{-- Salidas --}}
            <li class="menu">
                <a href="#salidas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Salidas</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="salidas" data-parent="#accordionExample">
                    <router-link tag="li" to="/salidas" exact-active-class="active">
                        <a>Salidas</a>
                    </router-link>
                </ul>
            </li>
            {{-- Donaciones --}}
            <li class="menu">
                <a href="#donaciones" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-heart"></i>
                        <span>Donaciones</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="donaciones" data-parent="#accordionExample">
                    <router-link tag="li" to="/donantes" exact-active-class="active">
                        <a>Donantes</a>
                    </router-link>
                    <router-link tag="li" to="/donaciones" exact-active-class="active">
                        <a>Donaciones</a>
                    </router-link>
                </ul>
            </li>
            {{-- Reportes --}}

        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
