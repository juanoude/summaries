<?php
  //autoloading de classes:
  function carregaClasse($nomeDaClasse) {
      require_once("class/".$nomeDaClasse.".php");
  }
  spl_autoload_register("carregaClasse");// deve ficar no cabeçalho
  //será executada sempre que tentarmos utilizar uma classe não definida.
?>




<?php
  //Data Acess Object:
  class ProdutoDao {

      private $conexao;

      function __construct($conexao) {
          $this->conexao = $conexao;
      }

      function listaProdutos() {
          //...
          $resultado = mysqli_query($this->conexao, "(...)");
          //...
      }

      function insereProduto(Produto $produto) {

          //...

          return mysqli_query($this->conexao, $query);
      }

      function alteraProduto(Produto $produto) {

          //...

          return mysqli_query($this->conexao, $query);
      }

      function buscaProduto($id) {

          //...
          $resultado = mysqli_query($this->conexao, $query);
          //...
      }

      function removeProduto($id) {

          //...

          return mysqli_query($this->conexao, $query);
      }
  }

  //Colocar o conecta.php com a variável $conexao no cabeçalho
  $produtoDao = new ProdutoDao($conexao)
  $produtos = $produtoDao->listaProdutos();

?>

<?php
  //Herança:
  class Livro extends Produto{
      private $isbn;

      public function getIsbn() {
          return $this->isbn;
      }

      public function setIsbn($isbn) {
          $this->isbn = $isbn;
      }
  }

  //Na lista fica:
  if($tipoProduto == "Livro") {
      $produto = new Livro($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
      $produto->setIsbn($isbn);
  } else {
      $produto = new Produto($nome, $preco, $descricao, $categoria, $usado, $tipoProduto);
  }

  $produto->setId($produto array['id']);
  $produto->setTipoProduto($tipoProduto);


  //mostrando o campo isbn apenas em livros:
  public function tem Isbn()
      return $this instanceof == "Livro";//checa se é um livro;

      if($produto->temIsbn()) {
          echo "ISBN: ".$produto->getIsbn();
      }

      //no formulário
      <input type="text" name="isbn" class="form-control"
      value="<?php if($produto->temIsbn()) { echo $produto-getIsbn(); }?>" >

      foreach($tipos as $tipo) :
          $essaEhOTipo = get_class($produto) == $tipo;

      //no DAO:
      function insereProduto(Produto $produto) {// o altera tbm terá a mesma lógica
          $isbn = "";
          if($produto->temIsbn())
              $isbn = $produto->getIsbn();
          $tipoProduto = get_class($produto);

          $query = "(...) values ( ... , '{$isbn}',
          '{$tipoProduto}')";
          //...

?>



<?php
  //Polimorfismo:
  public function calculaImposto() {
      return $this->preco * 0.195;
  }//na classe mãe

  public function calculaImposto() {
      return $this->getPreco() * 0.065;
  }//na classe filha
?>



<?php
  //classes abstratas:
  abstract class Livro extends Produto {

      private $isbn;

      public function getIsbn() {
          return $this->isbn;
      }

      public function setIsbn($isbn) {
          $this->isbn = $isbn;
      }
      public function calculaImposto()
      {
          return $this->getPreco() * 0.065;
  }/* como todo livro será instanciado em uma das duas classes filhas
  é adequado tornar livro em uma classe abstrata*/

  class Ebook extends Livro {

      public function getWaterMark() {
          return $this->waterMark;
      }

      public function setWaterMark($waterMark) {
          $this->waterMark = $waterMark;
      }

  }

  class LivroFisico extends Livro {

      private $taxaImpressao;

      public function getTaxaImpressao() {
          return $this->taxaImpressao;
      }

      public function setTaxaImpressao($taxaImpressao) {
          $this->taxaImpressao = $taxaImpressao;
      }
  }

  //para a listagem dos tipos é: ?>
  <tr>
      <td>Tipo do produto</td>
      <td>
          <select name="tipoProduto" class="form-control">
              <?php
              $tipos = array("Produto", "Livro Fisico", "Ebook");
              foreach($tipos as $tipo) :
                  $tipoSemEspaco = str_replace(' ', '', $tipo);// tirando o espaço para ficar igual o nome da classe;
                  $esseEhOTipo = get_class($produto) == $tipoSemEspaco;
                  $selecaoTipo = $esseEhOTipo ? "selected='selected'" : "";
              ?>
                  <?php if ($tipo == "Livro Fisico") : //criando um optgroup para os livros ?>
                      <optgroup label="Livros">
                  <?php endif ?>
                          <option value="<?=$tipoSemEspaco?>" <?=$selecaoTipo?>>
                              <?=$tipo?>
                          </option>
                  <?php if ($tipo == "Ebook") : ?>
                      </optgroup>
                  <?php endif ?>
              <?php endforeach ?>
          </select>
      </td>
  </tr>
<?php

  $taxaImpressao = $_POST['taxaImpressao'];
  $waterMark = $_POST['waterMark'];


  if ($tipoProduto == "LivroFisico") {
      $produto = new LivroFisico($nome, $preco, $descricao, $categoria, $usado);
      $produto->setIsbn($isbn);
      $produto->setTaxaImpressao($taxaImpressao);
  } else if ($tipoProduto == "Ebook") {
      $produto = new Ebook($nome, $preco, $descricao, $categoria, $usado);
      $produto->setIsbn($isbn);
      $produto->setWaterMark($waterMark);
  } else {
      $produto = new Produto($nome, $preco, $descricao, $categoria, $usado);
  }


      $isbn = "";
      if($produto->temIsbn()) {
          $isbn = $produto->getIsbn();
      }

      $taxaImpressao = "";
      if($produto->temTaxaImpressao()) {
          $taxaImpressao = $produto->getTaxaImpressao();
      }

      $waterMark = "";
      if($produto->temWaterMark()) {
          $waterMark = $produto->getWaterMark();
      }


      alter table produtos add column TaxaImpressao varchar(255)
      alter table produtos add column waterMark varchar(255)
?>


<?php
  //Factory:
  class ProdutoFactory {

      private $classes = array("Produto", "Ebook", "LivroFisico");

      public function criaPor($tipoProduto, $params) {

          $nome = $params['nome'];
          $preco = $params['preco'];
          $descricao = $params['descricao'];
          $categoria = new Categoria();
          $usado = $params['usado'];

          if (in_array($tipoProduto, $this->classes)) {
              return new $tipoProduto($nome, $preco, $descricao, $categoria, $usado);
          } else {

              return new Produto($nome, $preco, $descricao, $categoria, $usado);
      }
  }

      //exemplo de utilização:
      $ProdutoFactory = new ProdutoFactory();
      $produto = $ProdutoFactory->criaPor($tipoProduto, $_POST);
      $produto->atualizaBaseadoEm($_POST);

      //complemento de campos:
      public function atualizaBaseadoEm($params) {
            if ($this->temIsbn()) {
                $this->setIsbn($params["isbn"]);
            }
            if ($this->temWaterMark()) {
                $this->setWaterMark($params["waterMark"]);
            }
            if ($this->temTaxaImpressao()) {
                $this->setTaxaImpressao($params["taxaImpressao"]);
            }
        }


        while($produto_array = mysqli_fetch_assoc($resultado)) {

            $tipoProduto = $produto_array['tipoProduto'];
            $factory = new ProdutoFactory();
            $produto = $factory->criaPor($tipoProduto, $_POST);
            $produto->atualizaBaseadoEm($_POST);

            $produto->setId($produto_array['id']);
            $produto->getCategoria()->setNome($produto_array['categoria_nome'])

            array_push($produtos, $produto);
          }

          return $produtos;
        }

?>


<?php
  /* quando se tem um método abstrato, automaticamente a classe deve ser abstrata
  também, caso queira uma alternativa: interfaces!*/




?>
