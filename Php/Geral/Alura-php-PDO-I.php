<?php
  class Categoria{

    function listar(){
      $query = "SELECT id, nome FROM categorias";
      $conexao = new PDO('mysql:host=127.0.0.1;dbname=estoque', 'root', 'alura');
      $resultado = $conexao->query($query);
      $lista = $resultado->fetchAll();
      return $lista;
    }
  }

  //utilizando: ?>
  <?php require_once 'classes/Categoria.php' ?>
  <?php
      $categoria = new Categoria();
      $lista = $categoria->listar();
  /*Para o PDO funcionar deve-se abilitar a extensão do banco que será utilizado
  no php.ini, deletando o ';' (descomentando). */
?>
  <?php foreach ($lista as $linha): ?>
      <tr>
          <td><a href="#" class="btn btn-link"><?php echo $linha['id'] ?></a><td>
          <td><a href="#" class="btn btn-link"><?php echo $linha['nome'] ?></a><td>
          <td><a href="#" class="btn btn-info">Editar</a><td>
          <td><a href="#" class="btn btn-danger">Excluir</a><td>
      </tr>
  <?php endforeach ?>


<?php
  //Inserindo no banco:
  //...
  $id
  $nome
  //...
  public function inserir(){
    $query = "INSERT INTO categorias(nome) VALUES ('".$this->nome."')";
    $conexao = new PDO('mysql:host=127.0.0.1;dbname=estoque', 'root', 'alura');
    $conexao->exec($query);
  }

  //insert.php
  require_once 'classes/Categoria.php';

  $categoria = new Categoria();
  $nome = $_POST['nome'];
  $categoria->nome = $nome;
  $categoria->inserir();

  header('Location: categorias.php');

?>

<?php
  //isolando uma conexao num metodo static:
  class Conexao{
    public static function conecta(){
      $conexao = new PDO('mysql:host=127.0.0.1;dbname=estoque', 'root', 'alura');
      return $conexao;
    }
  }

  //adaptando
  $conexao = Conexao::conecta();// os :: são pra funções estáticas.
?>


<?php
  //Atualizar
    public function atualizar(){
      $query = "UPDATE categorias SET nome = '" . this->nome . "' WHERE id = " . $this->id;
      $conexao = Conexao::pegarConexao();
      $conexao->exec($query);
    }

  //Passando o id via get: editar.php?id=<?php echo $linha['id']
  public function carregar(){
      $query = "SELECT id, nome FROM categorias WHERE id = " . $this->id;
      $conexao = Conexao::pegarConexao();
      $resultado = $conexao->query($query);
      $lista = $resultado->fetchAll();
      foreach ($lista as $linha) {
        $this->nome = $linha['nome'];
      }
  }

 require_once 'classes/Categoria.php'
  $categoria = new Categoria();
  $id = $_GET['id'];
  $categoria->id = $id;
  $resultado = $categoria->carregar();

?>
  <!-- depois basta usar a variavel: -->
<input type="text" value="<?php echo $categoria->nome ?>" class="form-control" placeholder="Nome da Categoria">

<?php
  //refatorando:
  public function __construct($id = false){
    if ($id) {
      $this->id = $id;
      $this->carregar();//Me parece má prática chamar no construtor, será?
    }
  }

  $id = $_GET['id'];
  $categoria = new Categoria($id);

  //Após enviar um id via hidden:
  $id = $_POST['id'];
  $nome = $_POST['nome'];

  $categoria = new Categoria($id);
  $categoria->nome = $nome;

  $categoria->atualizar();

  header('Location: categorias.php');
?>

<?php
  //excluir:
  public function excluir(){
    $query = "DELETE FROM categorias WHERE id = " . $this->id;
    $conexao = Conexao::pegarConexao();
    $conexao->exec($query);
  }

  $id = $_GET['id'];
  $categoria = new Categoria($id);

  $categoria->excluir();

  header('Location: categorias.php');
?>

<?php
  //centralizando configurações
  //config.php:
  define('DB_DRIVE', 'mysql');
  define('DB_HOSTNAME', '127.0.0.1');
  define('DB_DATABASE', 'estoque');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'alura');

  //entao
  require_once 'config.php';

  class Conexao{
    public static function pegarConexao(){
      $conexao = new PDO(DB_DRIVE .':host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
      return $conexao;
    }
  }
?>


<?php
  //fazendo autoload
  require_once 'classes/config.php';

  spl_autoload_register('carregarClasse');

  function carregarClasse($nomeClasse){
    if (file_exists('classes/' . $nomeClasse . '.php')) {
      require_once 'classes/' .$nomeClasse . '.php';
    }
  }

  //Assim basta
  //<?php require_once 'global.php' e nada mais.
?>



<?php
  // Tratando Erros:
  define('DEBUG', true);

  // Forçando um Erro:
  throw new Exception('Erro ao Listar Categorias');

  //então:
  try {
    $categoria = new Categoria();
    $lista = $categoria->listar();
  } catch(Exception $e) {
    if(DEBUG){
      echo '<pre>';
      print_r($e);
      echo '</pre>';
    } else {
      echo $e->getMessage();
    }

  }
?>


<?php
  //Isolando a lógica dos erros:
  class Erro{
    public static function trataErro(Exception $e){
      if (DEBUG) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';
      }else {
        echo $e->getMessage();
      }
      exit;
    }
  }


  //Retorando
  try {
    $categoria = new Categoria();
    $lista = $categoria->listar();
  }catch(Exception $e) {
    Erro::trataErro($e);
  }
?>

<?php
  /* Ao ocorrer um erro no PDO, ocorre por padrão um erro fatal, devemos
  colocá-los como exception para adptar-se a nossa aplicação.*/

  public static function pegarConexao(){
    //$conexao = new PDO(DB_DRIVE .':host=' . DB_HOSTNAME . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //return $conexao;
  }
?>
