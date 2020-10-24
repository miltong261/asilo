<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
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
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
