<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev Weather</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    @yield('links')
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
</head>

<body>
    <header class="p-1  bg-light border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/"
                    class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">

                    <img src="{{ asset('img/logos/navLogo.png') }}" id="nav-logo"alt=" Dev Weather">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center ps-2 pe-2 mb-md-0">
                    <li><a href="#" class="nav-link px-2 link-primary">Previsão Atual</a></li>
                    <li><a href="#" class="nav-link px-2 link-secondary">Histórico de pesquisas</a></li>
                    <li><a href="#" class="nav-link px-2 link-secondary">Previsões Salvas</a></li>
                </ul>



                <div class="dropdown text-end">
                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle"
                        id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div
                            class=" foto-perfil text-center d-flex justify-content-center align-items-center  rounded-circle">
                            <i class="fa fa-user"></i>


                        </div>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    @yield('conteudo')
    <div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast-container">
        @if (session()->has('success'))
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">

                    <strong class="me-auto"><i class="fa fa-check text-success"></i></strong>
                    <small>agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">

                    <strong class="me-auto"><i class="fa fa-xmark text-danger"></i></strong>
                    <small>agora</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        @endif
    </div>
    <footer>
        <script src="{{ asset('jquery/jquery.mask.min.js') }}"></script>
        <script src="{{ asset('jquery/additional-methods.min.js') }}"></script>
        <script src="{{ asset('jquery/jquery.validate.min.js') }}"></script>

        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>
        @yield('scripts')
    </footer>
</body>

</html>
