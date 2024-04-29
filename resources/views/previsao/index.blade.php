@extends('layouts.app')
@section('links')
    <link rel="stylesheet" href="{{ asset('css/previsao/index.css') }}">
@endsection
@section('conteudo')
    <main>



        <section class="bg-{{ $current['weather_code'] }} pt-2 h-100vh ">
            <div class="container">


                <div class="row">

                    <div class="col-lg-8 offset-lg-2 mt-2 p-0">
                        <div
                            class="d-flex previsao-atual mh-22vh align-items-start rounded pt-2  p-2 pb-2 justify-content-center">
                            <div class="p-2 w-100">


                                <form action="{{ route('previsao.atual') }}" id="pesquisaPrevisao" method="get">

                                    <div class="row">
                                        <div class="col-md-5 " id="div-cep">
                                            <label for="cep"><b>Cep</b></label>
                                            <input type="text" name="cep"
                                                value="{{ request()->get('cep') ?? '' }}"id="cep"
                                                class="form-control glass">
                                        </div>
                                        <div class="col-md-5 ">
                                            <label for="cidade"><b>Cidade</b></label>
                                            <input type="text" name="cidade"
                                                value="{{ request()->get('cidade') ?? '' }}" id="cidade"
                                                class="form-control glass">
                                        </div>
                                        <div class="col-md-2  d-flex flex-column ">
                                            <label for="">&nbsp;</label>
                                            <button class="btn btn-success "><i class="fa fa-magnifying-glass"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-lg-8 offset-lg-2  p-0 rounded">

                        <div
                            class="container-previsao   rounded bg-card-principal p-3  d-flex flex-column justify-content-center align-items-center">
                            <div class="w-100 justify-content-between  align-items-center d-flex gap-1 mb-2">
                                <b><i class="fa fa-clock text-primary"></i>
                                    {{ date('d/m/Y H:i', strtotime($location['localtime'])) }}</b>
                                <div class="d-flex flex-row gap-1">
                                    <a role="button" href="" class="btn btn-success"><i
                                            class="fa fa-right-left"></i>
                                        Comparar</a>
                                    <div>
                                        <form action="{{ route('previsao.nova') }}" method="post">
                                            <input type="hidden" name="umidade" value="{{$current['humidity']}}">
                                            <input type="hidden" name="visibilidade" value="{{$current['visibility']}}">
                                            <input type="hidden" name="indice_uv" value="{{ $current['uv_index'] }}">
                                            <input type="hidden" name="cidade" value="{{ $location['name'] }}">
                                            <input type="hidden" name="temperatura" value="{{ $current['temperature'] }}">
                                            <input type="hidden" name="icone"
                                                value="{{ $current['weather_icons'][0] }}">
                                            <input type="hidden" name="descricao"
                                                value="{{ $current['weather_descriptions'][0] }}">
                                            <input type="hidden" name="dia_noite" value="{{ $current['is_day'] }}">
                                            <input type="hidden" name="vento" value="{{ $current['wind_speed'] }}">
                                            <input type="hidden" name="codigo_previsao"
                                                value="{{ $current['weather_code'] }}">
                                            <input type="hidden" name="data_local" value="{{ $location['localtime'] }}">
                                            @csrf
                                            <button type="submit"class="btn btn-success"><i class="fa fa-floppy-disk"></i>
                                                Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="previsao-atual p-2">
                                <h4 class="mt-3">
                                    Previsão do tempo em <b class="text-primary"><i class="fa fa-location-dot"></i>
                                        {{ $location['name'] }}</b></h4>
                            </div>


                            <div class="previsao-atual mt-2 p-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        @foreach ($current['weather_icons'] as $icon)
                                            <img src="{{ $icon }}" class="weather-icon" alt="">
                                        @endforeach
                                        <div class="flex-row d-flex gap-2">
                                            <b class="fs-5">{{ $current['temperature'] }} °C</b>
                                            @if ($current['temperature'] < 20)
                                                @php $temperatureClass= 'bg-primary' @endphp
                                            @elseif ($current['temperature'] >= 20 && $current['temperature'] <= 29)
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
                                        @foreach ($current['weather_descriptions'] as $index => $description)
                                            @if ($index == 0)
                                                <span class="text-bold">{{ ucfirst($description) }}</span>
                                            @elseif ($index == count($current['weather_descriptions'] - 1))
                                                <span class="text-bold">, {{ ucfirst($description) }}.</span>
                                            @else
                                                <span class="text-bold">, {{ ucfirst($description) }}</span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>



                            </div>
                            <div class="row mt-2 w-100 p-0">
                                <div class="col-md-4 p-1">
                                    <div class="previsao-atual h-10vh d-flex flex-column text-center">
                                        <b class="text-warning">Índice UV</b>
                                        <h4>
                                            {{ $current['uv_index'] }}
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div class="previsao-atual h-10vh d-flex flex-column text-center">
                                        <b class="text-primary"><i class="fa fa-wind"></i> Vento</b>
                                        <h5>
                                            {{ $current['wind_speed'] }} Km/h
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-4 p-1">
                                    <div
                                        class="previsao-atual h-10vh d-flex justify-content-center flex-column text-center">
                                        @if ($current['is_day'] == 'yes')
                                            <i class="fa fs-4 fa-sun text-warning"></i>
                                        @else
                                            <i class="fa fs-4 fa-moon text-warning"></i>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 p-1">
                                    <div class="previsao-atual h-10vh d-flex flex-column text-center">
                                        <b class="text-primary"> <i class="fa fa-eye"></i> Visibilidade</b>
                                        <h5>
                                            {{ $current['visibility'] }} Km
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-md-6 p-1">
                                    <div class="previsao-atual h-10vh d-flex flex-column text-center">
                                        <b class="text-primary"><i class="fa fa-droplet">
                                            </i> Umidade</b>
                                        <h5>
                                            {{ $current['humidity'] }} %
                                        </h5>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- <div class="col-md-6">
                        <div class="container-previsao h-60vh d-flex flex-column justify-content-center align-items-center">
                            <div class="col-12 d-flex flex-column align-items-center">
                                <h5>Compare as previsões do tempo</h5>
                                <form action="{{ route('previsao.atual') }}" id="pesquisaPrevisao" method="get">

                                    <div
                                        class="d-flex justify-content-start align-items-center flex-wrap flex-row  w-100 gap-2">
                                        <div class="d-flex flex-column ">
                                            <label for="cep"><b>Cep</b></label>
                                            <input type="text" class="form-control w-100" name="cep" id="cep">
                                        </div>

                                        <div class="d-flex flex-row gap-2">
                                            <div>
                                                <label for="cep"><b>Cidade</b></label>
                                                <input type="text" class="form-control" name="cidade" id="cidade">
                                            </div>
                                            <div class="d-flex flex-row align-items-center">
                                                <button type="submit" class="btn br-2  btn-success">
                                                    <i class="fa fa-magnifying-glass"></i>
                                                </button>
                                            </div>
                                        </div>



                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    <script src="{{ asset('js/previsao/index.js') }}"></script>
@endsection
