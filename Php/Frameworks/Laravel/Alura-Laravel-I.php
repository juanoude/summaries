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
