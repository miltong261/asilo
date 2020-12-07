<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            {{-- Perfil del usuario --}}
            <li class="menu">
                <a href="#principal" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-home"></i>
                        <span>Principal</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="principal" data-parent="#accordionExample">
                    <router-link tag="li" to="usuarios/perfil" exact-active-class="active">
                        <a>Perfil</a>
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
                    <router-link tag="li" to="/tipo_producto" exact-active-class="active">
                        <a>Categorías</a>
                    </router-link>
                    <router-link tag="li" to="/unidad_medida" exact-active-class="active">
                        <a>Unidad de medida</a>
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
                    <router-link tag="li" to="/medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/ajuste_producto/medicamento" exact-active-class="active">
                        <a>Ajuste medicamento</a>
                    </router-link>
                    <router-link tag="li" to="/productos" exact-active-class="active">
                        <a>Artículos</a>
                    </router-link>
                    <router-link tag="li" to="/ajuste_producto/producto" exact-active-class="active">
                        <a>Ajuste artículo</a>
                    </router-link>
                </ul>
            </li>

            {{-- Salidas --}}
            <li class="menu">
                <a href="#salidas" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Requisiciones</span>
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

            {{-- Estadísticas --}}
            <li class="menu">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Estadísticas</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
                    <router-link tag="li" to="/dashboard/dashboard_articulos" exact-active-class="active">
                        <a>Artículos</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard/ajuste_articulo" exact-active-class="active">
                        <a>Ajuste artículo</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard/dashboard_medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard/ajuste_medicamento" exact-active-class="active">
                        <a>Ajuste medicamento</a>
                    </router-link>
                </ul>
            </li>

        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
