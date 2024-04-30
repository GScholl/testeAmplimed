@extends('layouts.app')
@section('links')
@endsection
@section('conteudo')
    <main>
        <section>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <h4>Previsões Salvas</h4>

                        <table class="table" id="previsoes">
                            <thead>
                                <tr>
                                    <th>Cidade</th>
                                    <th>Temperatura</th>
                                    <th>Data</th>
                                    <th>Opções</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($previsoes as $previsao)
                                    <tr>
                                        <td>{{$previsao->cidade }}</td>
                                        <td>{{$previsao->temperatura}} °C</td>
                                        <td>{{date('d/m/Y H:i',strtotime($previsao->data_local))}}</td>
                                        <td><a href="{{ route('previsao.salva', ['id' => $previsao->id]) }}" role="button" class="btn btn-primary" title="Visualizar previsão"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                @if (count($previsoes) == 0)
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('scripts')
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('DataTables/DataTables-1.13.8/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/previsao/listar.js')}}"></script>
@endsection
