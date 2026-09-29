<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AdminLTE 4')</title>

    <!-- AdminLTE 4 + Bootstrap 5 (CSS CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.9.1/dist/css/adminlte.min.css" />
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Navbar Header -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <!-- Izquierda: Botón Menú -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                </ul>

                <!-- Derecha: Perfil de Usuario y Logout -->
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>
                            <span class="d-none d-md-inline">{{ Auth::user()->nombre ?? Auth::user()->usuario }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!-- Cabecera de usuario -->
                            <li class="user-header bg-primary text-white p-3 text-center">
                                <i class="bi bi-person-circle display-6 mb-2"></i>
                                <p class="mb-0 fw-bold">{{ Auth::user()->nombre ?? Auth::user()->usuario }}</p>
                                <small>Rol: {{ Auth::user()->tipo_usuario ?? 'Usuario' }}</small>
                            </li>
                            <!-- Menú inferior -->
                            <li class="user-footer p-2 text-end">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!-- Sidebar Wrapper -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">
                        
                        <!-- Opción Clientes -->
                        <li class="nav-item">
                            <a href="{{ route('clientes.index') }}" class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Clientes</p>
                            </a>
                        </li>

                        <!-- Opción Reservas -->
                        <li class="nav-item">
                            <a href="{{ route('reservas.index') }}" class="nav-link {{ request()->routeIs('reservas.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-journal-bookmark"></i>
                                <p>Reservas</p>
                            </a>
                        </li>

                        <!-- Opción Líneas -->
                        <li class="nav-item">
                            <a href="{{ route('lineas.index') }}" class="nav-link {{ request()->routeIs('lineas.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-telephone"></i>
                                <p>Líneas</p>
                            </a>
                        </li>

                        <!-- Opción Observaciones -->
                        <li class="nav-item">
                            <a href="{{ route('observaciones.index') }}" class="nav-link {{ request()->routeIs('observaciones.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-chat-left-text"></i>
                                <p>Observaciones</p>
                            </a>
                        </li>

                        <!-- Enlace a Planes R -->
                        <li class="nav-item">
                            <a href="{{ route('planes_r.index') }}" class="nav-link {{ request()->routeIs('planes_r.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-router"></i>
                                <p>Planes R</p>
                            </a>
                        </li>

                        <!-- Enlace a Planes W -->
                        <li class="nav-item">
                            <a href="{{ route('planes_w.index') }}" class="nav-link {{ request()->routeIs('planes_w.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-wifi"></i>
                                <p>Planes W</p>
                            </a>
                        </li>

                        <!-- Enlace a Equipos ONT -->
                        <li class="nav-item">
                            <a href="{{ route('onts.index') }}" class="nav-link {{ request()->routeIs('onts.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-modem"></i>
                                <p>Equipos ONT</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('uras.index') }}" class="nav-link {{ request()->routeIs('uras.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-building"></i>
                                <p>URA</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('equipos.index') }}" class="nav-link {{ request()->routeIs('equipos.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-cpu-fill"></i>
                                <p>Equipos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('puertos.index') }}" class="nav-link {{ request()->routeIs('puertos.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-ethernet"></i>
                                <p>Puertos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('servicios.index') }}" class="nav-link {{ request()->routeIs('servicios.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-gear-fill"></i>
                                <p>Servicios</p>
                            </a>
                        </li>

                        <li class="nav-header">CUENTA</li>

                        <!-- Opción Logout Sidebar -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form-sidebar">
                                @csrf
                                <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">
                                    <i class="nav-icon bi bi-box-arrow-right"></i>
                                    <p>Cerrar Sesión</p>
                                </a>
                            </form>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <h3 class="mb-0">@yield('content_header')</h3>
                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

    </div>

    <!-- Scripts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.9.1/dist/js/adminlte.min.js"></script>
</body>
</html>