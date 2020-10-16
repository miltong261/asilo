<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
                    <router-link tag="li" to="/dashboard_articulos" exact-active-class="active">
                        <a>Artículos</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard_medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard_compras" exact-active-class="active">
                        <a>Compras</a>
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
                    <router-link tag="li" to="/categorias" exact-active-class="active">
                        <a>Categorías</a>
                    </router-link>
                    <router-link tag="li" to="/unidad_medida" exact-active-class="active">
                        <a>Unidad de medida</a>
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
                    <router-link tag="li" to="/tipo_movimiento" exact-active-class="active">
                        <a>Tipo movimiento</a>
                    </router-link>
                    <router-link tag="li" to="/movimientos" exact-active-class="active">
                        <a>Movimientos de caja</a>
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
                    <router-link tag="li" to="/ajuste_medicamento" exact-active-class="active">
                        <a>Ajuste medicamento</a>
                    </router-link>
                    <router-link tag="li" to="/ajuste_articulo" exact-active-class="active">
                        <a>Ajuste artículo</a>
                    </router-link>
                    <router-link tag="li" to="/medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/articulos" exact-active-class="active">
                        <a>Artículos</a>
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