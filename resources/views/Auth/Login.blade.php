<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <!-- AdminLTE v4 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/css/adminlte.min.css">
</head>
<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header text-center">
                <a href="#" class="h1 mb-0"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">Ingresa tus credenciales para iniciar sesión</p>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="post">
                    @csrf
                    
                    <!-- Campo Usuario -->
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" class="form-control @error('usuario') is-invalid @enderror" value="{{ old('usuario') }}" placeholder="Nombre de usuario" required autofocus autocomplete="username">
                        <div class="input-group-text">
                            <span class="bi bi-person-fill"></span>
                        </div>
                    </div>

                    <!-- Campo Password -->
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required autocomplete="current-password">
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                    </div>

                    <!-- Opciones: Recordarme & Botón -->
                    <div class="row align-items-center mb-3">
                        <div class="col-7">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember">
                                    Recordarme
                                </label>
                            </div>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary w-100">Acceder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- AdminLTE v4 App JS -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta2/dist/js/adminlte.min.js"></script>
</body>
</html>