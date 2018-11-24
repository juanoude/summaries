<?php //Aula 01
  namespace estoque;

  use Illuminate\Database\Eloquent\Model;
  //Para criar o model com o artisan -> php artisan make:model Produto

  class Produto extends Model {
    protected $table = 'produtos'; //nome da tabela
    public $timestamps = false; //created_at e updated_at
  }

  //nos controllers:
  use estoque\Produto;

  //listando
  $produtos = Produto::all();

  //buscando
  $produto = Produto::find($id);

  //inserindo
  $produto = new Produto();
  $produto->nome = Request::input('nome');
  $produto->valor = Request::input('valor');
  $produto->descricao = Request::input('descricao');
  $produto->quantidade = Request::input('quantidade');

  $produto->save();

  //outra forma de inserir:
  $params = Request::all();
  $produto = new Produto($params);//Isso é um MassAssignmentException (criar um modelo a partir de arrays)
  $produto->save();
  //MAE's são considerados exceções por questões de segurança, portanto precisamos definir permissões:
  protected $fillable = array('nome', 'descricao', 'valor', 'quantidade');
  //o oposto do fillable, proibições, é:
  protected $guarded = ['id'];

  //inserir com factory method:
  $params = Request::all();
  Produto::create($params);
  //em uma linha:
  Produto::create(Request::all());

  //remover
  public function remove($id){
    $produto = Produto::find($id);
    $produto->delete();
    return redirect()
        ->action('ProdutoController@lista');
  }

  //link de remoção:
  <a href="{{action('ProdutoController@remove', $p->id)}}">
    <span class="glyphicon glyphicon-trash"></span>
  </a>
  //rota de remoção:
  Route::get('/produtos/remove/{id}', 'ProdutoController@remove');
?>

<?php //Aula 02
  //php artisan make:migration adiciona_tamanho_no_produto - Criando a migration
  //database/migrations
  use Illuminate\Database\Schema\Blueprint;
  use Illuminate\Database\Migrations\Migration;

  class AdicionaTamanhoNoProdutos extends Migration {

    public function up()
    {
      Schema::table('produtos', function($table){
        $table->string('tamanho', 100);//varchar(100)
      });
    }

    public function down()
    {
      Schema::table('produtos', function($table){
        $table->dropColumn('tamanho');
      });
    }
  }

  //php artisan migrate -> sobe
  //php artisan migrate:rollback -> desce

  //mudanças devido a migration:
  //form
  <div class="form-group">
    <label>Tamanho</label>
    <input name="tamanho" class="form-control" />
  </div>
  //listagem
  <td> {{ $p->tamanho }}</td>
  //model
  protected $fillable = array('nome',
    'descricao', 'quantidade', 'valor', 'tamanho');

?>

<?php //Aula 03
  //action do form:
  $validator = Validator::make(
    ['nome' => Request::input('nome')],
    ['nome' => 'required|min:5']
  );

  if(validator_fails()){
    return redirect()->action('ProdutoController@novo');
  }

  //para pegar as mensagens de erro:
  $messages = $validator->messages();

  //Form completo, ficaria muito grande de acordo com as boas práticas:
  $validator = Validator::make(
   [
    'nome' => Request::input('nome'),
    'descricao' => Request::input('descricao'),
    'valor' => Request::input('valor'),
    'quantidade' => Request::input('quantidade')
   ],
   [
    'nome' => 'required|min:5'
    'descricao' => 'required|max:255',
    'valor' => 'required|numeric',
    'quantidade' => 'required|numeric'
   ]
  );

  //utilizando form requests para enxugar o código:
  //php artisan make:request ProdutoRequest
  //app/Http/Requests
  namespace estoque\Http\Requests;

  use estoque\Http\Requests\Request;

  class ProdutosRequest extends Request {

    public function authorize()
    {
      return true;
    }

    public function rules()
    {
      return [
        'nome' => 'required|max:100|min:3',
        'descricao' => 'required|max:255',
        'valor' => 'required|numeric',

      ];
    }

    public function messages(){
      return [
        'required' => 'O campo :attribute é obrigatório'
      ];
    }
  }

  //O controller ficará assim:
  public function adiciona(ProdutosRequest $request){

    Produto::create($request->all());

    return redirect()
        ->action('ProdutoController@lista')
        ->withInput(Request::only('nome'));
  }

  //import
  use estoque\Http\Requests\ProdutosRequest;

  //exibindo os erros na view:
  @if (count($errors) > 0)
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  //para popular os valores já digitados após erro de validation:
  <input name="nome" value="{{ old('nome') }}" />


?>

<?php //Aula 04
  //view pronta do laravel:
  <ul class="nav navbar-nav navbar-right">
    @if (Auth::guest()) //chega se está logado
      <li><a href="/auth/login">Login</a></li>
      <li><a href="/auth/register">Register</a></li>
    @else
      <li class="dropdown">
        <a href="#" class="dropdown-toggle"
            data-toggle="dropdown" role="button"
                aria-expanded="false">
            {{ Auth::user()->name }} //mostra o nome do usuário
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="/auth/logout">Logout</a></li>
        </ul>
      </li>
    @endif
  </ul>

  //criando um do zero:
  Route::get('/login', 'LoginController@login');
  //php artisan make:controller LoginController --plain
  namespace estoque\Http\Controllers;

  use estoque\Http\Requests;
  use estoque\Http\Controllers\Controller;

  use Auth;
  use Request;

  class LoginController extends Controller {

    public function login(){
      $credenciais = Request::only('email', 'password');

      if(Auth::attempt($credenciais)){ /*se passar um boolean como segundo parametro,
        o usuário ficará logado por tempo indefinido ou até um logout manual.*/
        return "Usuário ". Auth::user()->name ." logado com sucesso";
      }
      return "As credencias não são válidas";
    }

  }

  //para fazer logout:
  Auth::logout();
  /* verifica apenas se as credenciais são
  válidas, sem necessariamente se logar*/
  Auth::validate($credentials);
  // para logar um usuário de determinado id
  Auth::loginUsingId(7);
  // para ver se o usuário está logado
  Auth::check();
  // ou então, verificar o próprio usuário
  Auth::user();


  //Checando autorização:
  if (Auth::guest())
    {
        return redirect('/auth/login');
    }

  //Porém para evitar repetição de código,implementaremos um middleware:
  //php artisan make:middleware AutorizacaoMiddleware
  namespace estoque\Http\Middleware;
  use Closure;

  class AutorizacaoMiddleware {

      public function handle($request, Closure $next){

        if(!$request->is('auth/login') && \Auth::guest()) {
          return redirect('/auth/login');
        }

        return $next($request);
      }

  }

  //app/Http/Kernel
  namespace estoque\Http;

  class Kernel extends HttpKernel {

    protected $middleware = [
      //...
      'estoque\Http\Middleware\AutorizacaoMiddleware',
    ];

    //aqui é onde se especifica o middleware para se usar nas routes
    protected $routeMiddleware = [
      //...
      'nosso-middleware' => 'estoque\Http
        \Middleware\AutorizacaoMiddleware',
    ];
  }

  //Associando o middleware a uma rota especifica:
  Route::get('/produtos/remove/{id}', [
    'middleware' => 'nosso-middleware',
    'uses' => 'ProdutoController@remove'
  ]);

  //Para não poluir o routes.php, pode-se atribuir o middleware ao controller;
  class ProdutoController extends Controller {

    public function __construct()
    {
        $this->middleware('nosso-middleware');
    }
    //...
  }

  //pode-se passar como segundo parâmetro os métodos específicos:
  $this->middleware('nosso-middleware',
        ['only' => ['adiciona', 'remove']]);

?>


<?php
  //php artisan make:migration Categoria
  class CreateCategoriasTable extends Migration {

    public function up()
    {
      Schema::create('categorias', function(Blueprint $table)
      {
        $table->increments('id');
        $table->increments('nome');
        $table->timestamps();
      });
    }

    public function down()
    {
      Schema::drop('categorias');
    }
  }

  //php artisan migrate


  //php artisan make:model categoria
  class Categoria extends Model {
    //
  }

  //Colocando as categorias no select:
  use estoque\Categoria;
  //...
  public function novo(){
    return view('formulario')->with('categorias', Categoria::all());
  }
  //view:
  <div class="form-group">
    <label>Categoria</label>
    <select name="categoria_id" class="form-control">
      @foreach($categorias as $c)
      <option value="{{$c->id}}">{{$c->nome}}</option>
      @endforeach
    </select>
  </div>

  //No produto model
  public function categoria(){
    return $this->belongsTo('estoque\Categoria');
  }

  //No categoria model
  public function produtos(){
    return $this->hasMany('estoque\Produto');
  }

  //php artisan make:migration adiciona_relacionamento_produto_categoria
  class AdicionaRelacionamentoProdutoCategoria extends Migration {

    public function up(){
      Schema::table('produtos', function(Blueprint $table){
        $table->integer('categoria_id')->default(1);
      });
    }

    public function down(){
      Schema::table('produtos', function(Blueprint $table){
        $table->dropColumn('categoria_id');
      });
    }
  }
  //php artisan migrate

  protected $fillable = array('nome', 'descricao', 'quantidade', 'valor', 'tamanho', 'categoria_id');

  //na listagem:
  <td> {{ $p->categoria->nome }}</td>

?>


<?php //Aula 05
  use Illuminate\Database\Seeder;
  use Illuminate\Database\Eloquent\Model;
  use estoque\Categoria;

  class DatabaseSeeder extends Seeder {
    public function run(){

      Model::unguard();

      $this->call('CategoriaTableSeeder');
    }
  }

  class CategoriaTableSeeder extends Seeder {
    public function run()
    {
      Categoria::create(['nome' => 'ELETRODOMESTICO']);
      Categoria::create(['nome' => 'ELETRONICA']);
      Categoria::create(['nome' => 'BRINQUEDO']);
      Categoria::create(['nome' => 'ESPORTES']);
    }
  }

  //php artisan db:seed
  //php artisan db:seed --class=CategoriatableSeeder (para chamar apenas uma classe específica)
  /* Seeds são muito usadas para popular um db com dados necessários para um ambiente de testes*/
?>

<?php //Aula 06
  //php artisan list
  /*lista todos os comando. O artisan aumenta muito a produtividade do desenvolvimento,
  cria os arquivos com os imports, entre outras funcionalidades. conhecer essa ferramenta
   é essencial para se tornar um bom desenvolvedor laravel*/

  //php artisan down
  /* desabilita o site com uma mensagem de retornaremos em breve */

  //php artisan up
  /* habilita o site novamente */

  //php artisan help (comando_aqui)
  /* exibe ajuda/descrições sobre um comando empecífico sobre seu funcionamento*/

  //php artisan tinker
  /* poderoso comando que permite que você execute classes, querys e muitas
  outras interações com sua aplicação */

  //php artisan optimize
  /* otimiza a performance da aplicação */

  //php artisan serve
  /* sobe o servidor php de desenvolvimento */

  //php artisan app:name
  /* adiciona o namespace da aplicação */

  //php artisan make:...
  /* cria arquivos já com a estrutura básica e no local correto */

  /* também é possível gerenciar o cache da aplicação e o cache de rotas
  através do artisan. */

  //php artisan route:list:
  /*lista todas as rotas registradas. Este comando é especialmente útil!
  Pois não precisa ler o routes completo para interpretar o cenário todo*/
?>
