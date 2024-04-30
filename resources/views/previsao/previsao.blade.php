@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{ asset('DataTables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/previsao/index.css') }}">
@endsection
@section('conteudo')
    <main>


        <section class="bg-{{ !empty($previsao->codigo_previsao) ? $previsao->codigo_previsao : 'light' }} pt-2 h-100vh ">

            <div class="container mt-4">


                <div class="row mt-2">
                    <div class="col-lg-8 offset-lg-2  p-0 rounded">

                        <div
                            class="container-previsao   rounded bg-card-principal p-3  d-flex flex-column justify-content-center align-items-center">
                            <div class="w-100">
                                <a href="{{ route('previsao.listar') }}" class="btn btn-success"><i
                                        class="fa fa-chevron-left"></i> Voltar para listagem</a>
                            </div>
                            <div class="previsao-atual mt-2 p-2">
                                <h4 class="mt-3">
                                    Previsão do tempo em <b class="text-primary"><i class="fa fa-location-dot"></i>
                                        {{ $previsao->cidade }}</b></h4>
                            </div>


                            <div class="previsao-atual mt-2 p-2">
                                <div class="d-flex justify-content-between flex-wrap align-items-center">
                                    <div class="d-flex flex-row align-items-center gap-2">

                                        <img src="{{ $previsao->icone }}" class="weather-icon" alt="">

                                        <div class="flex-row d-flex gap-2">
                                            <b class="fs-5">{{ $previsao->temperatura }} °C</b>
                                            @if ($previsao->temperatura < 20)
                                                @php $temperatureClass= 'bg-primary' @endphp
                                            @elseif ($previsao->temperatura >= 20 && $previsao->temperatura <= 29)
                                                @php $temperatureClass= 'bg-warning' @endphp
                                            @else
                                                @php $temperatureClass= 'bg-danger' @endphp
                                            @endif
                                            <span
                                                class="badge  border my-auto {{ $temperatureClass }} border-light rounded-circle p-2 ">
                                                <span class="visually-hidden">cor da temperatura</span></span>
                                        </div>

                                    </div>
                                    <div class="d-flex flex-row gap-2 mt-2">
                                        @if (!is_null($previsao->descricao_traduzida))
                                            <span class="text-bold">{{ ucfirst($previsao->descricao_traduzida) }}</span>
                                        @else
                                            <span class="text-bold">{{ ucfirst($previsao->descricao) }}</span>
                                        @endif

                                    </div>
                                </div>



                            </div>
                            <div class="row mt-2 w-100 p-0">
                                <div class="col-md-4 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex justify-content-center flex-column text-center">
                                        <b class="text-warning">Índice UV</b>
                                        <h4>
                                            {{ $previsao->indice_uv }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex justify-content-center flex-column text-center">
                                        <b class="text-primary"><i class="fa fa-wind"></i> Vento</b>
                                        <h5>
                                            {{ $previsao->vento }} Km/h
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex justify-content-center flex-column text-center">
                                        @if ($previsao->dia_noite)
                                            <i class="fa fs-4 fa-sun text-warning"></i>
                                        @else
                                            <i class="fa fs-4 fa-moon text-warning"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex justify-content-center flex-column text-center">
                                        <b class="text-primary"> <i class="fa fa-eye"></i> Visibilidade</b>
                                        <h5>
                                            {{ $previsao->visibilidade }} Km
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex  justify-content-center flex-column text-center">
                                        <b class="text-primary"><i class="fa fa-droplet">
                                            </i> Umidade</b>
                                        <h5>
                                            {{ $previsao->umidade }} %
                                        </h5>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>


                </div>

            </div>
        </section>

    </main>
@endsection
