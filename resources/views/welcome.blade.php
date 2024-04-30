<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dev Weather</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body class="bg-welcome">
    <div class="h-100vh w-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container">


            <div class="row">

                <div class="col-md-8 col-lg-6 offset-lg-3 p-5 offset-md-2">
                    <div class="bg-card-welcome p-4 ">
                        <div class="d-flex flex-column">
                            <img src="{{ asset('img/logos/navLogo.png') }}" class="w-75 mx-auto logo-principal" alt="logo">

                        </div>
                        <p>Bem vindo, escolha as opções abaixo:</p>
                        <div class="d-flex flex-column gap-2 flex-wrap">

                            <a href="{{ route('previsao.atual') }}" role="button" class="btn fw-bold btn-light"><i
                                    class="fa text-warning fa-cloud-sun-rain"></i> <span> Previsão Atual </span></a>
                            <a href="" role="button" class="btn fw-bold btn-light"> <i
                                    class="fa fa-right-left text-primary"></i> Comparar Previsões </a>
                            <a href="{{ route('previsao.listar') }}" role="button" class="btn fw-bold btn-light"> <i
                                    class="fa fa-list text-success"></i>
                                Previsões Salvas</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>







    <footer>
        <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/utils.js') }}"></script>
    </footer>
</body>

</html>
