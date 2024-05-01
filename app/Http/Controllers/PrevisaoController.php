<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Pesquisa;
use App\Models\Previsao;
use App\Models\CondicaoClimatica;
use Illuminate\Support\Facades\Validator;

class PrevisaoController extends Controller
{
    private $acessToken = 'af329dc4a11ed8f717e3d164f2daf60b';
    private $apiUrl = 'http://api.weatherstack.com/';

    private $errorCodes = [
        404 => 'Recurso solicitado pelo usuário não existe.',
        101 => 'Chave de acesso fornecida pelo usuário é inválida.',
        102 => 'Conta de usuário está inativa ou bloqueada.',
        103 => 'Função da API solicitada pelo usuário não existe.',
        104 => 'Limite mensal de solicitações da assinatura do usuário foi atingido.',
        105 => 'A assinatura atual do usuário não suporta esta função da API.',
        601 => 'Um valor de consulta inválido (ou ausente) foi especificado.',
        602 => 'A solicitação da API não retornou nenhum resultado.',
        603 => 'Dados históricos não são suportados no plano de assinatura atual.',
        604 => 'Consultas em massa não são suportadas no plano de assinatura atual.',
        608 => 'Foi especificado um valor de dias de previsão inválido.',
        609 => 'Dados de previsão do tempo não são suportados no plano de assinatura atual.',
        615 => 'A solicitação da API falhou.'
    ];
    public function index(Request $request)
    {

        $cidade = $request->input('cidade');
        if ($cidade) {
            $pesquisa = new Pesquisa();
            $pesquisa->query = $cidade;
            $pesquisa->save();

            $previsao = $this->getPrevisaoAtual($cidade);
        } else {
            $previsao =  $this->getPrevisaoAtual($this->getCoordenadasIp());
        }
        if (isset($previsao['current']['weather_code'])) {

            $previsao['current']['descricao_traduzida'] = CondicaoClimatica::where('codigo', '=', $previsao['current']['weather_code'])->first()->descricao ?? null;
        }
        if (isset($previsao['success']) && !$previsao['success']) {
            $previsao['mensagem_traduzida'] = $this->getInfoErrorTraduzido($previsao['error']['code']);
        }

        $previsao['historicos_pesquisas'] = Pesquisa::orderBy('created_at', 'desc')->get();

        return view('previsao.index', $previsao);
    }

    public function compararPrevisoes(Request $request)
    {
        $primeiraCidade = $request->input('cidade1');
        $segundaCidade = $request->input('cidade2');
        $previsoes = [];
        if ($primeiraCidade) {
            $previsoes['primeiraPrevisao'] = $this->getPrevisaoAtual($primeiraCidade);
            if (isset($previsoes['primeiraPrevisao']['current']['weather_code'])) {

                $previsoes['primeiraPrevisao']['current']['descricao_traduzida'] = CondicaoClimatica::where('codigo', '=', $previsoes['primeiraPrevisao']['current']['weather_code'])->first()->descricao ?? null;
            }
            if (isset($previsoes['primeiraPrevisao']['success']) && !$previsoes['primeiraPrevisao']['success']) {
                $previsoes['primeiraPrevisao']['mensagem_traduzida'] = $this->getInfoErrorTraduzido($previsoes['primeiraPrevisao']['error']['code']);
            }
        }
        if ($segundaCidade) {
            $previsoes['segundaPrevisao'] = $this->getPrevisaoAtual($segundaCidade);
            if (isset($previsoes['segundaPrevisao']['current']['weather_code'])) {

                $previsoes['segundaPrevisao']['current']['descricao_traduzida'] = CondicaoClimatica::where('codigo', '=', $previsoes['segundaPrevisao']['current']['weather_code'])->first()->descricao ?? null;
            }
            if (isset($previsoes['primeiraPrevisao']['success']) && !$previsoes['primeiraPrevisao']['success']) {
                $previsoes['segundaPrevisao']['mensagem_traduzida'] = $this->getInfoErrorTraduzido($previsoes['segundaPrevisao']['error']['code']);
            }
        }

        return view('previsao.compare', $previsoes);
    }

    public function getPrevisaoAtual($local)
    {

        $response = Http::get("{$this->apiUrl}current?access_key={$this->acessToken}&query=$local&units=m");


        return $response->json();
    }
    public function nova(Request $request)
    {
        $rules = [
            'cidade' => 'required|string|max:128',
            'temperatura' => 'required|numeric',
            'codigo_previsao' => 'required|integer',
            'descricao' => 'required|string|max:128',
            'icone' => 'required|string|max:512',
            'umidade' => 'required|numeric',
            'indice_uv' => 'required|numeric',
            'visibilidade' => 'required|numeric',
            'data_local' => 'required|date',
            'vento' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao salvar a previsão. Por favor, tente novamente.');
        }


        $previsao = new Previsao();
        $previsao->cidade = $request->cidade;
        $previsao->temperatura = $request->temperatura;
        $previsao->codigo_previsao = $request->codigo_previsao;
        $previsao->descricao = $request->descricao;
        $previsao->icone = $request->icone;
        $previsao->umidade = $request->umidade;
        $previsao->indice_uv = $request->indice_uv;
        $previsao->visibilidade = $request->visibilidade;
        $previsao->data_local = $request->data_local;
        $previsao->vento = $request->vento;
        $previsao->dia_noite = $request->dia_noite == "yes";


        if ($previsao->save()) {

            return redirect()->back()->with('success', 'Previsão salva com sucesso!');
        } else {

            return redirect()->back()->with('error', 'Houve um erro ao salvar a previsão!');
        }
    }
    public function previsoesSalvas()
    {

        $previsoes = Previsao::orderBy('created_at', 'desc')->get();
        return view('previsao.listar', compact('previsoes'));
    }
    public function previsaoSalva($id)
    {
        $previsao = Previsao::find($id);

        if (is_null($previsao)) return redirect()->back()->with('error', 'Previsão não encontrada!');
        $previsao->descricao_traduzida = CondicaoClimatica::where('codigo', '=', $previsao->codigo_previsao)->first()->descricao ?? null;
        return view('previsao.previsao', compact('previsao'));
    }
    public function excluirHistorico($id)
    {
        $pesquisa = Pesquisa::find($id);

        return response()->json($pesquisa->delete());
    }
    public function pesquisarHistoricos(Request $request)
    {
        $query = $request->input('query');
        $historicos = Pesquisa::where('query', 'like', "%{$query}%")->orderBy('created_at', 'desc')->get();
        return response()->json($historicos);
    }
    public function getCoordenadasIp()
    {

        $response = Http::get("http://www.geoplugin.net/json.gp?");
        if ($response->successful()) {
            return $response->json()['geoplugin_city'];
        } else {

            return "Chapecó";
        }
    }

    public function getInfoErrorTraduzido($codigo)
    {
        if ($this->errorCodes[$codigo]) {

            return  $this->errorCodes[$codigo];
        }
        return "Houve um erro desconhecido, por favor tente novamente mais tarde";
    }
}
