<?php //Aula 01

  /*instalar composer
  instalar laravel -> composer global require laravel/installer (e configurar o path)
  criar projeto -> laravel new (nome_aqui) / composer create-project laravel/laravel (nome_aqui)
  localhost -> php artisan serve */

  //app/Http/routes.php
  Route::get('/', function(){
    return '<h1>Primeira Lógica com laravel</h1>';
  });

  Route::get('/outra', function(){
    return '<h1>Outra Lógica com Laravel</h1>';
  });//Quando houver duas rotas iguais a segunda sobrescreve a primeira

  //alterando o nome padrão (app) -> php artisan app:name (nome_aqui)

?>

<?php //Aula 2
  //app/Http/Controllers/ProdutoController.php
  namespace nomedoprojeto\Http\Controllers;
  use Illuminate\Support\Facades\DB;

  class ProdutoController extends Controller {
    public function lista(){

      $html = '<h1>Produtos lista: </h1>';
      $html .= '<ul>';

      $produtos = DB::select('select * from produtos');
      foreach ($produtos as $p) {
        $html .= '<li> Nome: ' . $p->nome . ' Descrição ' . $p->descricao . ' </li>';
      }

      $html .= '</ul>';

      return $html;
    }
  }

  //app/Http/routes.php
  Route::get('/produtos', 'ProdutoController@lista');

  //config/database.php
  'mysql' => [
    'driver'    => 'mysql',
    'host'      => env('DB_HOST', 'localhost'),
    'database'  => env('DB_DATABASE', 'estoque_laravel'),
    'username'  => env('DB_USERNAME', 'root'),
    'password'  => env('DB_PASSWORD', ''),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    'strict'    => false,
  ],

?>


<?php //Aula 03

//resouces/views/listagem.php ?>
<html>
  <body>
    <h1>Listagem de produtos</h1>
    <table class="table">
      <?php foreach ($produtos as $p): ?>
        <tr>
          <td><?= $p->nome ?></td>
          <td><?= $p->valor ?></td>
          <td><?= $p->descricao ?></td>
          <td><?= $p->quantidade ?></td>
        </tr>
      <?php endforeach ?>
    </table>
  </body>
</html>

<?php
  namespace estoque\Http\Controllers;
  use Illuminate\Support\Facades\DB;

  class ProdutoController extends Controller {

    public function lista(){
      $produtos = DB::select('select * from produtos');

      return view('listagem')->with('produtos', $produtos);
      //view('listagem')->withProdutos($produtos); faz a mesma coisa(passa a chave na chamada);
      //também é possivel passar um array:
      //$data = ['id' => $id];
      //view('listagem', $data);

    }//Antigamente era View::make('listagem')->with('produtos', $produtos);
  }

  //Pode-se verificar a existência de uma view com o método exists:
  if view()->exists('listagem'){
    return view('listagem');
  }

  //Pode-se usar o método file para se utilizar um caminho/diretório diferente:
  view()->file('/caminho/para/sua/view');

  //Toda vez que um erro ocorre um log é criado com mais detalhes
  //storage/logs/
  //porém por questões de facilidade, cria-se um arquivo .env na pasta do projeto e coloca:
  // APP_DEBUG = true

  //O laravel possui um css próprio com estilos prontos que inclusive contém o bootstrap
  <link href="/css/app.css" rel="stylesheet">

?>


<?php //Aula 04
  //link para o single: ?>
  <!-- <a href="/produtos/mostra?id=<?=$p->id?>"> - Via GET -->
  <a href="/produtos/mostra/<?= $p->id ?>"> <!-- Via Query Param -->
    <span class="glyphicon glyphicon-search"></span> <!--Repare que se usa bootstrap 3-->
  </a>
<?php
  //routes.php
  Route::get('/produtos/mostra/{id}', 'ProdutoController@mostra');
  //Tirou-se o valor default porque a sintaxe acima obriga o paramentro
  //Para deixar opcional deve-se: {id?}


  //Para evitar o conflito de rotas, deve-se limitar o param com uma expressão regular
  Route::get(
  '/produtos/mostra/{id}',
  'ProdutoController@mostra'
  )
  ->where('id', '[0-9]+');


  //ProdutoController
  use Request;
  //...
  public function mostra(){
    // $id = Request::input('id', '0');//Recupera o GET e põe um valor default;
    $id = Request::route('id'); //pegando o query param
    $produto = DB::select('SELECT * FROM produtos WHERE id=?', [$id]);
    if(empty($produto)){
      return "Esse produto não existe";
    }
    return view('detalhes')->with('p', $produto);
  }

  //Pode-se pegar o query param pelo parametro do método(não precisa nem importar o Request):
  //public function mostra($id){ ...


  //Outros recursos do Request:

  if(Request::has('id')){
    //executa caso exista o parâmetro;
  }

  $input = Request::all();//Pega todos os parâmetros;

  $input = Request::only('id','nome');//Pega apenas o id e nome;

  $input = Request::except('id');//Pega todos exceto o id;

  $url = Request::url();//Retorna o url da request:
  //http://localhost:8000/produtos/mostra

  $uri = Request::path();//Retorna o path:
  //produtos/mostra

?>
  <h1>Detalhes do produto: <?= $p->nome ?> </h1>

 <ul>
   <li> <b>Valor:</b> R$ <?= $p->valor ?> </li>
   <li> <b>Descrição:</b> <?= $p->descricao ?> </li>
   <li> <b>Quantidade em estoque:</b> <?= $p->quantidade ?> </li>
 </ul>



<?php //Aula 05
  //Para utilizar o Blade (template engine do laravel), deve-se nomear os arquivos com .blade.php ?>

  <!-- Template: -->
  <html>
    <head>
        <link href="/css/app.css" rel="stylesheet">
        <title>Controle de estoque</title>
    </head>
    <body>
      <div class="container">

        @yield('conteudo') <!--  -->

      </div>
    </body>
  </html>

  <!-- Página -->
  @extends('principal')

  @section('conteudo')
  <h1>Detalhes do produto: {{$p->nome}} </h1>

  <ul>
    <li>
      <b>Valor:</b> R$ {{$p->valor}}
    </li>
    <li>
      <b>Descrição:</b> {{$p->descricao or 'Nenhuma descrição informada'}}
    </li>
    <li>
      <b>Quantidade em estoque:</b> {{$p->quantidade}}
    </li>
  </ul>
  @stop

  <!-- Listagem -->
  @if(empty($produtos))

    <div class="alert alert-danger">
      Você não tem nenhum produto cadastrado.
    </div>

  @else

    <h1>Listagem de produtos</h1>
    <table>

      @foreach ($produtos as $p)
        <tr class="{{$p->quantidade <=2 ? 'danger' : ''}}">
          <td>{{ $p->nome }} </td>
          <td>{{ $p->valor }} </td>
          <td>{{ $p->descricao }} </td>
          <td>{{ $p->quantidade }} </td>
          <td>
            <a href="/produtos/mostra/{{$p->id}}>">
              <span class="glyphicon glyphicon-search"></span>
            </a>
          </td>
        </tr>
      @endforeach

    </table>

    <h4>
      <span class="label label-danger pull-right">
        Um ou menos itens no estoque
      </span>
    </h4>

  @endif

<?php
  //outras formas de loop:
  @for ($i = 0; $i < 10; $i++)
      O indice atual é {{ $i }}
  @endfor

  @while (true)
    Entrando em looping infinito!
  @endwhile

  @forelse($produtos as $p)//É um foreach com exceção
    <li>{{ $p->nome }}</li>
  @empty
      <p>Não tem nenhum produto!</p>//Caso a lista esteja vazia
  @endforelse

  //outras formas de condicionar:
  @unless (1 == 2)
    Esse texto sempre será exibido!
  @endunless

  {{ condicao ? 'valor_se_true' : 'valor_se_false'}} //null coalescing

  //Organizando:
  //produto/listagem.blade.php
  //produto/detalhes.blade.php
  //layout/principal.blade.php

  //no controller:
  return view('produto.listagem');//return view('produto/listagem') também serve;
  //na view:
  @extends('layout.principal')

  
?>
