<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" style="font-family: 'Roboto Condensed', sans-serif;" class="d-lg-block sidebar collapse bg-white overflow-auto">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">

{{--                <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i--}}
{{--                        class="fas fa-money-bill fa-fw me-3"></i><span>Sprzedaż</span></a>--}}
{{--                <a href="#" class="list-group-item list-group-item-action py-2 ripple">--}}
{{--                    <i class="fas fa-building fa-fw me-3"></i><span>Partners</span></a>--}}


                <a href="/" class="list-group-item list-group-item-action py-1 ripple
                            {{ (request()->is('/')) ? 'active' : '' }}" aria-current="true"><i
                        class="fas fa-tachometer-alt fa-fw me-3"></i><span class="h5"> Dashboard</span></a>
                <x-sidebar-nav
                    :icon="'fas fa-chart-bar fa-fw me-3'"
                    :category="'Zamówienia'"
                    :pages="[
                    'orders/create'=>'Utwórz zamówienie',
                    'orders'=>'Lista zamówień',
                    'orders/archive' => 'Archiwum'
                    ]"
                ></x-sidebar-nav>
                <x-sidebar-nav
                    :icon="'fa-solid fa-box-open me-3'"
                    :category="'Produkty'"
                    :pages="[
                    'products/create'=>'Dodaj nowy produkt',
                    'products'=>'Lista produktów',
                    'brands' => 'Marki produktów',
                    'product-categories' => 'Kategorie produktowe'
                    ]"
                ></x-sidebar-nav>
                <x-sidebar-nav
                    :icon="'fas fa-globe fa-fw me-3'"
                    :category="'Klienci'"
                    :pages="['clients/create'=>'Dodaj nowego klienta', 'clients'=>'Lista klientów']"
                ></x-sidebar-nav>
                <x-sidebar-nav
                    :icon="'fas fa-users fa-fw me-3'"
                    :category="'Pracownicy'"
                    :pages="['employees'=>'Lista pracowników', 'chat' => 'Komunikator']"
                ></x-sidebar-nav>
                <a href="#" class="list-group-item list-group-item-action py-1 ripple"><i
                        class="fas fa-calendar fa-fw me-3"></i><span class="h5"> Kalendarz</span></a>
                <a href="#" class="list-group-item list-group-item-action py-1 ripple"><i
                        class="fas fa-screwdriver-wrench fa-fw me-3"></i><span class="h5"> Administrator</span></a>
            </div>
        </div>
    </nav>
    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand mx-4" href="/">
                <div style="width: 5rem">
                <img src="{{ asset('/images/logo.png') }}" class="img-fluid">
                </div>
            </a>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Notification dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">Some news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Another news</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </li>
                    </ul>
                </li>
                <!-- Icon dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-language"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                                <i class="fa fa-check text-success ms-2"></i></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-poland flag"></i>Polski</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-china flag"></i>中文</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-japan flag"></i>日本語</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-germany flag"></i>Deutsch</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-france flag"></i>Français</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-spain flag"></i>Español</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-russia flag"></i>Русский</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"><i class="flag-portugal flag"></i>Português</a>
                        </li>
                    </ul>
                </li>

                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow align-items-center" href="#"
                       id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="#">My profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Settings</a>
                        </li>
                        <li>
                            <form method="post" action="/logout">
                                @csrf
                                <button class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
