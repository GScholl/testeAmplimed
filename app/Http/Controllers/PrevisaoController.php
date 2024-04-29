<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Pesquisa;
use App\Models\Previsao;

use Illuminate\Support\Facades\Validator;

class PrevisaoController extends Controller
{


    private $acessToken = 'b3188e324b830cf1240371528ff82881';
    private $apiUrl = 'http://api.weatherstack.com/';

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
    

        return view('previsao.index', $previsao);
    }

    public function getPrevisaoAtual($local)
    {

        $response = Http::get("{$this->apiUrl}current?access_key={$this->acessToken}&query=$local&units=m");

        if ($response->successful()) {
            return $response->json();
        } else {

            return ['error' => true, 'statusCode' => $response->status(), 'body' => $response->body()];
        }
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
        $previsao->dia_noite = $request->dia_noite == "yes" ;
        
        
        if($previsao->save()){

            return redirect()->back()->with('success', 'Previsão salva com sucesso!');
        }else{

            return redirect()->back()->with('error', 'Houve um erro ao salvar a previsão!');
        }
      
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

    public function getDados()
    {

        return [
            "request" => [
                "type" => "City",
                "query" => "Chapecó, Brasil",
                "language" => "en",
                "unit" => "m",
            ],
            "location" => [
                "name" => "Chapecó",
                "country" => "Brasil",
                "region" => "Santa Catarina",
                "lat" => "-27.083",
                "lon" => "-52.983",
                "timezone_id" => "America/Sao_Paulo",
                "localtime" => "2024-04-28 13:31",
                "localtime_epoch" => 1714311060,
                "utc_offset" => "-3.0",
            ],
            "current" => [
                "observation_time" => "04:31 PM",
                "temperature" => 25,
                "weather_code" => 296,
                "weather_icons" => [0 => "https://cdn.worldweatheronline.com/images/wsymbols01_png_64/wsymbol_0016_thundery_showers.png"],
                "weather_descriptions" => [0 => "thunderstorm"],
                "wind_speed" => 15,
                "wind_degree" => 340,
                "wind_dir" => "NNW",
                "pressure" => 1013,
                "precip" => 1,
                "humidity" => 100,
                "cloudcover" => 75,
                "feelslike" => 28,
                "uv_index" => 6,
                "visibility" => 5,
                "is_day" => "yes",
            ],
        ];
    }
}
