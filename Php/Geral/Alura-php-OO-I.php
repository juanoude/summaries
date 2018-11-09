<?php
  //Criando classes
  class Produto{
    public $id;
    public $nome;
    public $preco;
    public $descricao;
    public $usado;
    public $categoria_id;
  }/* Não podemos, por exemplo, atribuir a uma variável, uma outra propriedade
   ou mesmo uma chamada de função:

   // inválido, não pode receber uma variável
    public $id = $algum_atributo;

    // ok, isso é válido
    public $nome = 'Iphone 6 dobrável';

    // inválido, não pode receber outra propriedade
    public $preco = $nome;

    // inválido, tem que ser constante
    public $descricao = 'alguma '.'descricao';

    // inválido, não pode receber uma função
    public $categoria_id = retornaCategoriaPadrao();
   */


    //instanciando
   require_once("class/Produto.php")

    $livro = new Produto();// Os parênteses são opcionais.

    $livro->nome = "Livro de PHP";
    $produto->preco = 29.90;
    $produto->descricao = "Livro de tecnologia";
    $produto->usado = "true";
    $produto->categoria_id = 1;


    //Refatorando:
    $produto = new Produto();

    $produto->nome = $_POST['nome'];
    $produto->preco = $_POST['preco'];
    $produto->descricao = $_POST['descricao'];
    $produto->categoria_id = $_POST['categoria_id'];

    if(array_key_exists('usado', $_POST)) {
        $produto->usado = "true";
    } else {
        $produto->usado = "false";
    }

    //refatorando mais...
    if (insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado))
    if (insereProduto($conexao, $produto)) { ?>
    <p class="text-success">0 produto <?=$produto->nome ?>, <?= $produto->preco...

    function insereProduto($conexao, Produto $produto) {

        $query = "insert into produtos (nome, preco, descricao, categoria_id, usado)
            values ('{$produto->nome}', {$produto->preco}, '{$produto->descricao}',
                {$produto->categoria_id}, {$produto->usado})";

        return mysqli_query($conexao, $query);
    }


 ?>




<?php

  //gerando nova classe
  class Categoria {
    //todo lugar que referencia categoria deve ser refatorado
      public $id;
      public $nome;

  }


  //refatorando a função:
  function listaProdutos($conexao) {

    $produtos = array();
    $resultado = mysqli_query($conexao, "select p.*, c.nome as categoria_nome
        from produtos as p join categorias as c on c.id=p.categoria_id");

    while($produto_array = mysqli_fetch_assoc($resultado)) {

            $produto = new Produto();
            $categoria = new Categoria();
            $categoria->nome = $produto_array['categoria_nome'];

        $produto->nome = $produto_array['nome'];
        $produto->preco = $produto_array['preco'];
        $produto->descricao = $produto_array['descricao'];
        $produto->categoria = $categoria;
        $produto->usado = $produto_array['usado'];

        array_push($produtos, $produto);
    }

    return $produtos;
  }

  // refatorando a tabela:
  $produtos = listaProdutos($conexao);
    foreach ($produtos as $produto) :
    ?>
        <tr>
            <td><?= $produto->nome ?></td>
            <td><?= $produto->preco ?></td>
            <td><?= substr($produto->descricao, 0, 40) ?></td>
            <td><?=$produto->categoria->nome?></td>
            <td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto->id?>">a>
            <td>
                <form action="remove-produto.php" method='post"'>
                <input type="hidden" name="id" value="<?=$produto->id?>">
                <button class="btn btn-danger">remover</button>
                </form>
            </td>
        </tr>
    <?php
    endforeach
    ?>
<?php

    $categoria = new Categoria();
  $categoria->id = $_POST['categoria_id'];

  $query = "(...), {$produto->categoria->id}, (...)";

  //na listagem, função:
  function listaCategorias($conexao) {

      $categorias = array();
      $query = "select * from categorias";
      $resultado = mysqli_query($conexao, $query);

      while ($categoria_array = mysqli_fetch_assoc($resultado)) {

          $categoria = new Categoria();
          $categoria->id = $categoria_array['id'];
          $categoria->nome = $categoria_array['nome'];

          array_push($categorias, $categoria);
      }

      return $categorias;
  }
  // no form:
?>
  <select name="categoria_id" class="form-control">
        <?php foreach($categorias as $categoria) :
            $essaEhACategoria = $produto->categoria->id == $categoria->id;
            $selecao = $essaEhACategoria ? "selected='selected'" : "";
            ?>
            <option value="<?=$categoria->id?>" <?=$selecao?>>
                    <?=$categoria->nome?>
            </option>
        <?php endforeach ?>
        </select>

<?php
  //...
  function buscaProduto($conexao, $id) {

      $query = "select * from produtos where id = {$id}";
      $resultado = mysqli_query($conexao, $query);
      $produto_buscado = mysqli_fetch_assoc($resultado);

      $categoria = new Categoria();
      $categoria->id = $produto_buscado['categoria_id'];

      $produto = new Produto();
      $produto->id = $produto_buscado['id'];
      $produto->nome = $produto_buscado['nome'];
      $produto->descricao = $produto_buscado['descricao'];
      $produto->categoria = $categoria;
      $produto->preco = $produto_buscado['preco'];
      $produto->usado = $produto_buscado['usado'];

      return $produto;
  }

  //refatorando altera
  $id = $_GET['id'];
  $produto = buscaProduto($conexao, $id);
  $categorias = listaCategorias($conexao);

  $selecao_usado = $produto->usado ? "checked='checked'" : "";
  $produto->usado = $selecao_usado;

  ?>

  <h1>Alterando produto</h1>
  <form action="altera-produto.php" method="post">
      <input type="hidden" name="id" value="<?=$produto->id?>">
      <table class="table">
          <?php include("produto-formulario-base.php"); ?>
          <tr>
              <td>
                  <button class="btn btn-primary" type="submit">Alterar</button>
              </td>
          </tr>
      </table>
  </form>


<?php
  //métodos
  class Produto {

      public $id;
      public $nome;
      public $preco;
      public $descricao;
      public $categoria;
      public $usado;

      public function precoComDesconto($valor = 0.1) { //estabelece um valor padrão caso o parâmetro não seja passado.
          $this->preco -= $this->preco * $valor;
          return $this->preco;
          //caso não queira modificar o atributo preco, pode-se substituir por:
          return $this->preco - ($this->preco * $valor);
      }
  }
?>

<?php
  //private, isolando o ponto de acesso
  class Produto {

      private $id;
      private $nome;
      private $preco;
      private $descricao;
      private $categoria;
      private $usado;

      public function getPreco(){
        return $this->preco;
      }

      public function setPreco($preco){
        $this->preco = $preco
      }

      public function precoComDesconto($valor = 0.1) { //estabelece um valor padrão caso o parâmetro não seja passado.
        if($preco > 0 && $preco <=0.5){
          $this->preco -= $this->preco * $valor;
          }

        return $this->preco;
      }
  }

  //refatorar todas as chamadas diretas de atributos
  $produto->setId(1);
  echo $produto->getId();
?>


<?php
  //Comparando classes:
  require "class/Produto.php";

  $produto = new Produto();
  $produto->setPreco(59.9);
  $produto->setNome("Livro da Casa do Codigo");

  $outroProduto = new Produto();
  $outroProduto->setPreco(59.9);
  $outroProduto->setNome("Livro da Casa do Codigo");

  if ($produto == $outroProduto) { //serão iguais
      echo "sao iguais";
  } else {
      echo "sao diferentes";
  }

  if ($produto === $outroProduto) { //serão diferentes
      echo "sao iguais";
  } else {
      echo "sao diferentes";
  }

  //Comparação 2:
  require "class/Produto.php";

    $produto = new Produto();
    $produto->setPreco(59.9);
    $produto->setNome("Livro da Casa do Codigo");

    $outroProduto = $produto;
    $outroProduto->setPreco(100.6);
    $outroProduto->setNome("Livro da Casa do Codigo");

    if ($produto === $outroProduto) { //Serão iguais
        echo "sao iguais";//compara apenas a instância("id")
    } else {
        echo "sao diferentes";
    }

?>


<?php
  //Magic methods:
  function __construct($nome, $preco, $descricao, Categoria $categoria, $usado){
    $this->nome = $nome;
    $this->preco = $preco;
    $this->descricao = $descricao;
    $this->categoria = $categoria;
    $this->usado = $usado;
  }

  $nome = $_POST['nome'];
  $preco = $_POST['preco'];
  $descricao = $_POST['descricao'];
  $categoria = new Categoria();
  $categoria->setId($_POST['categoria_id']);


  if(array_key_exists('usado', $_POST)) {
      $usado = "true";
  } else {
      $usado = "false";
  }

  $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);

  //no lista produto:
  $categoria = new Categoria();
  $categoria->setNome($produto array['categoria nome']);

  $nome = $produto_array['nome'];
  $preco = $produto_array['preco'];
  $descricao = $produto_array['descricao'];
  $usado = $produto_array['usado'];

  $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);

  $produto->setId($produto_array['id']);

  array_push($produtos, $produto);

  //imprimindo o objeto:
  function __toString() {
      return $this->nome.": R$ ".$this->preco;
  }

  echo $objeto;


  //ação ao retirar o objeto da memoria (destruição)
  function __destruct() {
      echo "Produto destruído";
  }

  /* No PHP 5 pra baixo se usava o nome da classe para o construtor que nem
  no java, porém agora é o __contruct, por compatibilidade o nome da classe
  também funciona */

?>
