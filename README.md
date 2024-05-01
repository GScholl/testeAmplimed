
# Dev Weather - Amplimed
integração da API do WeatherStack para previsão do tempo utilizando Laravel, jQuery e Bootstrap.
<p align="start">
    <img src="https://github.com/github/explore/raw/main/topics/laravel/laravel.png" alt="Laravel" height="50" />
    <img src="https://github.com/github/explore/raw/main/topics/jquery/jquery.png" alt="jQuery" height="50" />
    <img src="https://github.com/github/explore/raw/main/topics/bootstrap/bootstrap.png" alt="Bootstrap" height="50" />
</p>

## Fluxograma
[Fluxograma do elevador ](https://github.com/GScholl/testeAmplimed/blob/main/public/fluxograma/fluxograma%20elevador.pdf "Fluxograma do elevador")
<br>
[Resposta da pergunta adicional ](https://github.com/GScholl/testeAmplimed/blob/main/public/fluxograma/perguntaAdicional "Pergunta adicional")
## Funcionalidades

- Pesquisar Via CEP (integrado com API do ViaCep) ou cidade a previsão atual
- Consultar informações de previsão atual
- Ver o histórico de pesquisas
- Excluir uma pesquisa
- É possível salvar previsões do tempo
- Listagem de previsões salvas
- Visualizar a previsão salva
- Comparar duas previsões de locais diferentes
## Arquitetura
 - Arquitetura MVC fornecida pelo próprio laravel
 - Template inheritance do Blade
 - CSS e JS global para estilos globais e funções a serem reutilizadas dentro do projeto
 - CSS e JS separados para cada view dentro do projeto, mantendo assim a organização do projeto e facilitando a manutenção
 - Migration para criação de tabelas
 - Utilização do Eloquent de ORM para consultas no banco

## Instalação

- Clone o projeto em seu computador de forma local
- É necessário possuir um servidor MySQL para rodar o projeto
- Dentro da pasta raiz do projeto de o comando: ```php artisan migrate ``` para rodar as migrations do projeto
- Rodar o comando ```php artisan serve```
- Atualizar a variavel ``` $acessToken ``` dentro do arquivo ```PrevisaoController.php```  e utilizar a sua chave de acesso da Api do weatherStack

## Uso
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif3.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif1.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif2.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif7.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif4.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif5.gif)
![Exemplo do sistema](https://raw.githubusercontent.com/GScholl/testeAmplimed/main/public/img/gifs/gif6.gif)


## Contribuição

- [@GScholl](https://www.github.com/GScholl)

