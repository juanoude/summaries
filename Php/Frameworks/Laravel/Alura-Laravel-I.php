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
