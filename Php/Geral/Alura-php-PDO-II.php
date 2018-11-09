<?php
  //PDO dos produtos:
  class Produto {
    public $id;
    public $nome;
    public $preco;
    public $quantidade;
    public $categoria_id;

    public static function listar(){ //c.nome e p.nome aparecerão como [nome]! alias neles!
      $query = "SELECT p.id, p.nome, preco, quantidade, categoria_id, c.nome as categoria_nome FROM produtos p
                  INNER JOIN categorias c ON p.categoria_id = c.id ORDER BY p.nome";
      $conexao = Conexao::pegaConexao();
      $resultado = $conexao->query($query);
      $lista = $resultado->fetchAll();
      return $lista;
    }
  }

  //ao executar:
  try {
    $lista = Produto::listar();
  }catch (Exception $e) {
    Erro::trataErro($e);
  }

  foreach ($lista as $linha): ?>
    <tr>
        <td><?php echo $linha['id'] ?></td>
        <td><?php echo $linha['nome'] ?></td>
        <td>R$ <?php echo $linha['preco'] ?></td>
        <td><?php echo $linha['quantidade'] ?></td>
        <td><?php echo $linha['categoria_nome'] ?></td>
        <td><a href="/produtos-editar.php?id=<?php echo $linha['id'] ?>" class="btn btn-info">Editar</a></td>
        <td><a href="/produtos-excluir-post.php?id=<?php echo $linha['id'] ?>" class="btn btn-danger">Excluir</a></td>
    </tr>
  <?php endforeach
?>

<div class="col-md-12">
    <?php if (count($lista) > 0): ?>
    <!-- <table class="table">
        <thead>
        <tr> -->
            <!-- código omitido -->
        <!-- </tr>
        </thead>
    </table> -->
    <?php else: ?>
        <p>Nenhum produto cadastrado</p>
    <?php endif ?>
</div>


<?php
  // Criando um formulário produto:
  //Listando Categorias
  try {
    $lista = Categoria::listar();//trocou para static
  }catch(Exception $e) {
    Erro::trataErro($e);
  }
?>
  <select class="form-control" name="categoria_id">
    <?php foreach ($listaCategoria as $linha): ?>
      <option value="<?php echo $linha['id'] ?>"><?php echo $linha['nome'] ?></option>
    <?php endforeach ?>
  </select>

  <?php if (count($listaCategoria) > 0): ?>
    <form action="produtos-criar-post.php" method="post">
      <!-- código omitido -->
    </form>
  <?php else: ?>
    <p>Nenhuma categoria cadastrada no sistema. Por favor, crie uma categoria antes de cadastrar um produto.</p>
  <?php endif ?>


<?php
  //Inserir Produtos:
  public function inserir(){
    $query = "INSERT INTO produtos (nome, preco, quantidade, categoria_id)
              VALUES ('" . $this->nome . "', " . $this->preco . ", " . $this->quantidade . ", " . $this->categoria_id . ")";
    $conexao = Conexao::pegarConexao();
    $conexao->exec($query);
  }

  //no arquivo do action:
  try {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];

    $produto = new Produto();

    $produto->nome = $nome;
    $produto->quantidade = $quantidade;
    $produto->preco = $preco;
    $produto->categoria_id = $categoria_id;
    $produto->inserir();

    header('Location: produtos.php');

  }catch (Exception $e) {
    Erro::trataErro($e);
  }
?>

<!-- PDO::prepare()  igual ao método PDO::query() retorna um objeto do tipo
PDOStatement, mas com a diferença que a query não é executada automaticamente. -->
$stmt = $conexao->prepare($query);
$stmt->execute();

<!-- PDOStatement::fetch Retorna a próxima linha de um resultset. Podemos usar o
método fetch, combinado por exemplo com um while() para buscar cada linha do
resultado. Ele sempre começa na primeira linha do resultado de sua query e a
cada vez que o método é chamado, ele vai para a próxima linha. Quando chega
na ultima linha, o método retorna um valor false. -->
$stmt = $conexao->prepare($query);
$stmt->execute();
$row = $stmt->fetch();

while ($row) {
    echo 'Produto:' . $row['nome'] . '<br>';
    $row = $stmt->fetch();
}

<!-- PDOStatement::fetchObject() funciona de forma muito parecida com o método
fetch(), mas com a diferença simples de que, o retorno não vai ser um array
onde, cada indice representa uma coluna na entidade e sim, um objeto, onde,
cada atributo representa a entidade. -->
$stmt = $conexao->prepare($query);
$stmt->execute();
$row = $stmt->fetchObject();

while ($row) {
    echo 'Produto:' . $row->nome . '<br>';
    $row = $stmt->fetchObject();
}

<!-- PDOStatement::rowCount Sempre que usamos uma instrução SQL do tipo INSERT,
UPDATE ou DELETE, não teremos um resultset, Mas, temos um retorno do Banco
de Dados com a quantidades de linhas que foram afetadas pelo nosso script.
E esse método justamente retorna isso para nós. -->
$stmt = $conexao->prepare($query);
$stmt->bindValue(':preco', $novo_preco);
$stmt->execute();
echo $stmt->rowCount() . ' Linhas atualizadas!';




<?php
  //Utilizando o bindValue
  public function inserir(){
    $query = "INSERT INTO produtos (nome, preco, quantidade, categoria_id)
                VALUES (:nome, :preco, :quantidade, :categoria_id)";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':nome', $this->nome);
    $stmt->bindValue(':preco', $this->preco);
    $stmt->bindValue(':quantidade', $this->quantidade);
    $stmt->bindValue(':categoria_id', $this->categoria_id);
    $stmt->execute();
  } // Essa prática impede injection, deixa mais legível e o banco mais eficiente.

  public function carregar(){
    $query = "SELECT id, nome FROM categorias WHERE id = :id";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id', $this->id);//GET também desse ser tratado;
    $stmt->execute();
    $linha = $stmt->fetch();
    $this->nome = $linha['nome'];
  }

  require_once 'global.php';

$numero_de_roupas = 10;
$categoria_id = 7;
$tipo_roupa = ['Blusa', 'Camisa', 'Camiseta', 'Bermuda', 'Calça', 'Jaqueta'];
$sexo_roupa = ['Mascilona', 'Feminina'];
$cor_roupa  = ['Preta', 'Vermelha', 'Azul', 'Amarela', 'Verde', 'Branca', 'Marrom', 'Rosa'];


//Criando um robô que cria roupas:
for ($x = 1; $x <= $numero_de_roupas; $x++) {

    $tipo_index = rand(0, 5);//randomiza um numero
    $sexo_index = rand(0, 1);
    $cor_index  = rand(0, 7);
    $preco      = rand(1, 100);
    $quantidade = rand(1, 50);
    $roupa = $tipo_roupa[$tipo_index] . ' ' . $sexo_roupa[$sexo_index] . ' ' . $cor_roupa[$cor_index];

    $query = "INSERT INTO produtos (nome, preco, quantidade, categoria_id)
    VALUES (:nome, :preco, :quantidade, :categoria_id)";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':nome', $roupa);
    $stmt->bindValue(':preco', $preco);
    $stmt->bindValue(':quantidade', $quantidade);
    $stmt->bindValue(':categoria_id', $categoria_id);
    $stmt->execute();

    echo $roupa . ' Cadastrada com sucesso!<br>';
}

?>



<?php
  //Editar preenchido:
  public function carregar(){
    $query = "SELECT nome, preco, quantidade, categoria_id
              FROM produtos
              WHERE id = :id";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id', $this->id);
    $stmt->execute();
    $linha = $stmt->fetch();
    $this->nome = $linha['nome'];
    $this->preco = $linha['preco'];
    $this->quantidade = $linha['quantidade'];
    $this->categoria_id = $linha['categoria_id'];
  }

  public function __construct($id = false){
    if ($id) {
      $this->id = $id;
      $this->carregar();
    }
  }

  try {
     $id = $_GET['id'];
     $produto = new Produto($id);
     $listaCategoria = Categoria::listar();
   }catch (Exception $e) {
     Erro::trataErro($e);
   }
    //preenche tudo... ($produto->atributo) ?>

    <select class="form-control">
      <?php $selected = '' ?>
      <?php foreach ($listaCategoria as $linha): ?>
        <?php if($linha['id'] == $produto->id){$selected = 'selected'} ?>
        <option value="<?php echo $linha['id'] ?>" <?php echo $selected ?> >
          <?php echo $linha['nome'] ?>
        </option>
        <?php $selected = '' ?>
      <?php endforeach ?>
    </select>



<?php
  public function atualizar(){
    $query = "UPDATE produtos
              SET nome = :nome, preco = :preco, quantidade = :quantidade, categoria_id = :categoria_id
              WHERE id = :id";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':nome', $this->nome);
    $stmt->bindValue(':preco', $this->preco);
    $stmt->bindValue(':quantidade', $this->quantidade);
    $stmt->bindValue(':categoria_id', $this->categoria_id);
    $stmt->bindValue(':id', $this->id);
    $stmt->execute();
  }

  //o action do post:
  require_once 'global.php';

  try {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoria_id = $_POST['categoria_id'];

    $produto = new Produto($id);
    $produto->nome = $nome;
    $produto->preco = $preco;
    $produto->quantidade = $quantidade;
    $produto->categoria_id = $categoria_id;
    $produto->atualizar();

    header('Location: produtos.php');

  }catch (Exception $e) {
    Erro::trataErro($e);
  }



  //Excluir:
  public function excluir(){
    $query = "DELETE FROM produtos
              WHERE id = :id";
    $conexao = Conexao::pegarConexao();
    $stmt = $conexao->prepare($query);
    $stmt->bindValue('id', $this->id);
    $stmt->execute();
  }

  //No "action":
  require_once 'global.php';

    try {
      $id = $_GET['id'];
      $produto = new Produto($id);
      $produto->excluir();

      header('Location: produtos.php');

    }catch (Exception $e) {
      Erro::trataErro($e);
    }

?>

<?php
  //Robô de edição:
  require_once 'global.php';

  $lista_produtos = Produto::listar();

  $query = "UPDATE produtos
            SET preco = :preco, quantidade = :quantidade
            WHERE id = :id";
  $conexao = Conexao::pegarConexao();

  foreach ($lista_produtos as $produto) {
    $stmt = $conexao->prepare($query);

    $novo_preco = rand(0, 100);
    $nova_quantidade = rand(0, 50);

    $stmt->bindValue(':preco', $novo_preco);
    $stmt->bindValue(':quantidade', $nova_quantidade);
    $stmt->bindValue(':id', $produto['id']);
    $stmt->execute();
    echo $produto['nome'] . ' Preço alterado de: ' . $produto['preco'] . ' para: ' . $novo_preco . ' Quantidade alterado de: ' . $produto['quantidade'] . ' para: ' . $nova_quantidade . '<br>';
  }


  //Robô de exclusão:
  require_once 'global.php';

  $preco_base = 50;
  $quantidade_base = 20;

  $query = "DELETE FROM produtos
            WHERE preco <= :preco
            AND quantidade <= :quantidade";
  $conexao = Conexao::pegarConexao();

  $stmt = $conexao->prepare($query);
  $stmt->bindValue(':preco', $preco_base);
  $stmt->bindValue(':quantidade', $quantidade_base);
  $stmt->execute();

  echo $stmt->rowCount() . ' excluidos com sucesso!';
?>


<?php
  //Criando uma página de detalhes categorias:
  try {
    $id = $_GET['id'];
    $categoria = new Categoria($id);
    $categoria->carregarProdutos();
      $listaProdutos = $categoria->produtos;
  }catch (Exception $e) {
    Erro::trataErro($e);
  }
?>
  <dl>
      <dt>ID</dt>
      <dd><?php echo $categoria->id ?></dd>
      <dt>Nome</dt>
      <dd><?php echo $categoria->nome ?></dd>
      <dt>Produtos</dt>
      <dd>
          <!-- //listando os produtos da categoria: -->
        <?php if (count($listaProdutos) > 0): ?>
          <dd>
            <ul>
              <?php foreach($listaProdutos as $linha): ?>
                <li><a href="/produtos-editar.php?id=<?php echo $linha['id'] ?>"><?php echo $linha['nome'] ?></a></li>
              <?php endforeach ?>
            </ul>
          </dd>
        <?php else: ?>
          <dd>Não existem produtos para esta categoria</dd>
        <?php endif ?>
      </dd>
  </dl>

<?php
  //no Produto:
  public static function listarPorCategoria($categoria_id){

    $query = "SELECT id, nome, preco, quantidade
              FROM produtos
              WHERE categoria_id = :categoria_id";
    $conexao = Conexao::pegarConexao();

    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':categoria_id', $categoria_id);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  //Na Categoria:
  //...
  public $produtos;

  //...
  public function carregarProdutos(){
    $this->produtos = Produto::listarPorCategoria($this->id);
  }

?>
