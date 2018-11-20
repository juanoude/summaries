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
