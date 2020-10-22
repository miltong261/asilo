<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
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
                    <router-link tag="li" to="/usuarios" exact-active-class="active">
                        <a>Usuarios</a>
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
                    <span>Bodega</span>
                    <router-link tag="li" to="/tipo_producto" exact-active-class="active">
                        <a>Categorías</a>
                    </router-link>
                    <router-link tag="li" to="/unidad_medida" exact-active-class="active">
                        <a>Unidad de medida</a>
                    </router-link>

                    <span>Localidad</span>
                    <router-link tag="li" to="/departamentos" exact-active-class="active">
                        <a>Departamentos</a>
                    </router-link>
                    <router-link tag="li" to="/municipios" exact-active-class="active">
                        <a>Municipios</a>
                    </router-link>
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
                    <router-link tag="li" to="/areas" exact-active-class="active">
                        <a>Áreas</a>
                    </router-link>
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

            {{-- Enfermeria --}}
            <li class="menu">
                <a href="#enfermeria" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="fas fa-hospital-alt"></i>
                        <span>Enfermería</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="enfermeria" data-parent="#accordionExample">
                    <router-link tag="li" to="/signos" exact-active-class="active">
                        <a>Signos vitales</a>
                    </router-link>
                    <router-link tag="li" to="/notas" exact-active-class="active">
                        <a>Notas</a>
                    </router-link>
                    <router-link tag="li" to="/kardex" exact-active-class="active">
                        <a>Kardex</a>
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
                    <router-link tag="li" to="/ajuste_producto/medicamento" exact-active-class="active">
                        <a>Ajuste medicamento</a>
                    </router-link>
                    <router-link tag="li" to="/ajuste_producto/producto" exact-active-class="active">
                        <a>Ajuste artículo</a>
                    </router-link>
                    <router-link tag="li" to="/medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/productos" exact-active-class="active">
                        <a>Artículos</a>
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
                    <router-link tag="li" to="/dashboard/dashboard_medicamentos" exact-active-class="active">
                        <a>Medicamentos</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard/dashboard_compras" exact-active-class="active">
                        <a>Compras</a>
                    </router-link>
                    <router-link tag="li" to="/dashboard" exact-active-class="active">
                        <a>Movimientos</a>
                    </router-link>
                </ul>
            </li>

        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
