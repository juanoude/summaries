
<html>

<!-- Para  testar basta colocar nome.php?nome=carro&preco=5000 -->
<?php
  $nome = $_GET["nome"];
  $preco = $_GET["preco"];
 ?>
  <p>
    O produto <?= $nome ?> foi comprado com sucesso por <?= $preco ?>
  </p>
 </html>

<!-- Para reaproveitar código: -->

<?php include("cabecalho.php"); ?>

<h1>Conteudo</h1>
 <p>
   Conteudo
 </p>

<?php include("rodape.php"); ?>



<?php //IFS

    $numero = 10;
    if($numero > 5){
        echo "Maior que 5!";
    }
    else{
        echo "Menor que 5";
    }
?>

<?php//FOR E WHILE

    for ($i=0; $i < 5 ; $i++) {
      echo "Laço de número: " . $i;
    }

    $condicao = 5;
    $i = 0;
    while ($i < $condicao) {
        echo "Laço de número: " . $i;
        $i++;
    }

?>

<?php // arrays

    $numeros = array(1,3,9,4,5,8,2,6,7,0);
    for ($i=0; $i < 10; $i++) {
        echo "Chave: " . $i . "Valor: " . $numeros[$i];
    }
// ARRAYS também não possuem tipos portanto podem ser misturadas:
$arrayMaluco = array(0,1,"banana","alura",4,5,"curso php",7,8,9);


?>

<?php

//Primeiro cria-se a tabela no phpmyadmin
create table produtos (id integer auto_increment primary key, nome varchar(255), preco decimal(10,2));

//conexao
$conexao = mysqli_connect('localhost', 'root', '', 'loja');

//query
$query = "insert into produtos (nome, preco) values ('{$nome}', {$preco})";

//execução
mysqli_query($conexao, $query);

//fechamento
mysqli_close($conexao);

?>

//Envolver a execução em um tratamento de erro
    <?php
      if(mysqli_query($conexao, $query)) {
    ?>
      <p class="alert-success">Produto <?= $nome; ?>, <?= $preco; ?> adicionado com sucesso!</p>
    <?php
      } else {
    ?>
      <p class="alert-danger">O produto <?= $nome; ?> não foi adicionado</p>
    <?php
      }
    ?>

<?php
    /* podemos "esquecer" o mysql_close(), Porque o PHP detecta automaticamente
    que a conexão está aberta, e a fecha quando a página acaba.*/

    // O mysqli_* é o novo pacote de acesso ao MySql, onde eles melhoraram toda a parte de acesso ao banco de dados.

    // O mysql_* ainda existe apenas por questões de compatibilidade.
?>

<?php

    //Criando uma função para se usar no if
    function insereProduto($conexao, $nome, $preco) {
        $query = "insert into produtos (nome, preco) values ('{$nome}', {$preco})";
        $resultadoDaInsercao = mysqli_query($conexao, $query);
        return $resultadoDaInsercao;
    }

    if(insereProduto($conexao, $nome, $preco)) {
        // continua aqui
    }
?>

  <?php

    //Melhorando a mensagem de erro
      } else {
            $msg = mysqli_error($conexao);
        ?>
          <p class="alert-danger">O produto <? = $nome; ?> não foi adicionado: <?= $msg ?></p>
          <?php
                }
            ?>


  <?php

      // Refatorando como boa prática
      //<?php - quando uma página possui apenas código php deixa-se aberto a tag
      $conexao = mysqli_connect("localhost", "root", "", "loja");

      include("conecta.php");


      //listando produtos
      $resultado = mysqli_query($conexao, "select * from produtos");
      while ($produto = mysqli_fetch_assoc($resultado)){
        echo $produto['nome']; . "<br />";
      }


      /*Quando não fechamos o comando do PHP, isso indica para um desenvolvedor
      que essa página não gera mais nenhuma saída para o usuário final.
      Se fechássemos, por exemplo, poderíamos por descuido deixar um "espaço"
      ali, espaço esse que seria enviado ao usuário.*/
   ?>


   <?php
      //isolando o lista produtos
      function listaProdutos($conexao){
        $produtos = []; // array() é a forma antiga
        $resultado = mysqli_query($conexao, "select * from produtos");
        while($produto = mysqli_fetch_assoc($resultado)){
          array_push($produtos, $produto);

        }
        return $produtos;
      }
      // na mesmo include(php) colocaremos o insert
      function insereProduto($conexao, $nome, $preco) {
          $query = "insert into produtos (nome, preco) values ('{$nome}', '{$preco}')";
          $resultadoDaInsercao = mysqli_query($conexao, $query);
          return $resultadoDaInsercao;
      }
    ?>


      <?php //implementando a listagem
        $produtos = listaProdutos($conexao);
      ?>
      <table class="table table-striped table-bordered">

      <?php
        foreach($produtos as $produto) {
      ?>

        <tr>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['preco'] ?></td>
        </tr>

      <?php
      } // pode-se abrir-fechar com ':' - 'endforeach', para mais legibilidade
      ?>
      </table>


    <?php
      //coloque o url assim:
      <a href="remove-produto.php?id=<?=$produto['id']?>" class="text-danger">remover</a>

      //Criando a função
      function removeProduto($conexao, $id){
        $query = mysqli_query("delete from produtos where id = {$id}");
        return myqli_query($conexao, $query);
      }

      //na página php:
      $id = $_GET['id'];
      removeProduto($conexao, $id);

      //colocando uma atualização da tabela como resposta:
      header("Location: produto-lista.php");
      die();// para garantir que o cabecalho enviado será só até aqu

      //
    //<?php
        if(array_key_exists("removido", $_GET) && $_GET['removido']=='true') {
      ?>
          <p class="alert-success">Produto apagado com sucesso.</p>
      <?php
        }
      ?>



      <?php

        //adicionando o campo descricao
        function insereProduto($conexao, $nome, $preco, $descricao) {
            $query = "insert into produtos (nome, preco, descricao) values ('{$nome}', {$preco}, '{$descricao}')";
            $resultadoDaInsercao = mysqli_query($conexao, $query);
        }
        //phpmyadmin
        alter table produtos add column descricao text;
        update produtos set descricao = 'Descricao deste produto';
        //Mostrando apenas alguns caracteres da descricao
        //<td><?= substr($produto['descricao'], 0, 15) ?></td>

      <?php
        //Usar método get para transações com o banco é péssima prática
        //Portando colocaremos em formularios POST
        $substitui_tudo_pelo_post = $_POST['nome'];

        //cria form
        <form action="adiciona-produto.php" method="post">
          <input type="text" class="hidden" name="id" value="<?={$produto['id']}?>" />
          <button class="button btn-danger">Remover</button>
        </form>

        /*A ideia do GET, como o nome já diz, é pegar um conteúdo. Ele não deve
        realizar nenhuma mudança de estado, ou seja, não deve adicionar/deletar
        nada no banco de dados, ou coisa do tipo.
          A ideia do POST, é postar uma informação. Ele sim deve fazer alguma
        mudança de estado, persistindo informações no banco de dados.
          Nunca faça uma adição ou deleção com GETs. Isso pode gerar problemas,
        já que robôs da internet costumam visitar links de forma automática.
        E, visitar um link de deleção, pode gerar problemas.*/
       ?>



      <?php
        //criando nova tabela de categorias
        create table categorias (id integer auto_increment primary key, nome varchar(255));
        insert into categorias (nome) values ("esporte"), ("escolar"), ("mobilidade");


        //criando banco-categorias
        function listaCategorias($conexao) {
            $categorias = array();
            $query = "select * from categorias";
            $resultado = mysqli_query($conexao, $query);
            while($categoria = mysqli_fetch_assoc($resultado)) {
                array_push($categorias, $categoria);
            }
            return $categorias;
        }

        //na listagem:
        $categorias = listaCategorias($conexao);
        ...
//        <?php foreach($categorias as $categoria) : ?>
              <input type="radio" name="categoria_id" value="<?=$categoria['id']?>"><?=$categoria['nome']?></br>
          <?php endforeach ?>

      <?php
          //adicionando
          alter table produtos add column categoria_id integer;
          update produtos set categoria_id = 3;

          //modificando
          $categoria_id = $_POST['categoria_id'];
          //...
          if(insere_produto($conexao,$nome,$preco,$descricao,$categoria_id)) {
              // ...
          }

          //Atualizado função
          function insereProduto($conexao, $nome, $preco, $descricao, $categoria_id) {
              $query = "insert into produtos (nome, preco, descricao, categoria_id) values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id})";
              $resultadoDaInsercao = mysqli_query($conexao, $query);
              return $resultadoDaInsercao;
          }


          //atualizando o lista produtos
          function listaProdutos($conexao) {
              $produtos = array();// join para exibir o nome da categoria e não o numero id
              $resultado = mysqli_query($conexao, "select p.*, c.nome as categoria_nome from produtos as p join categorias as c on p.categoria_id = c.id");

              while($produto = mysqli_fetch_assoc($resultado)) {
                  array_push($produtos, $produto);
              }

              return $produtos;
          }

          //apos o join teremos o categoria_nome para puxar:
          //<td><?= $produto['categoria_nome'] ?></td>

          <?php
            //Trocando para select menu
            <tr>
              <select name="categoria_id">
                //<?php foreach ($categorias as $categoria): ?>
                  <option value="<?={$categoria['id']}?>"> <?={$categoria['nome']} ?> </option>
                <?php endforeach  ?>
              </select>
            </tr>

          <?php
            //checkboxes
            <tr>
                <td></td>
                <td><input type="checkbox" name="usado" value="true"> Usado</td>
            </tr>

            //no banco
            alter table produtos add column usado boolean default false;

            //no insere
            $usado = $_POST['usado'];

            if(insere_produto($conexao,$nome,$preco,$descricao,$categoria_id, $usado)) {
                // ...
            }


            function insereProduto($nome, $preco, $descricao, $categoria_id, $usado) {
                $query = "insert into produtos (nome, preco, descricao, categoria_id, usado)
                    values ('{$nome}', {$preco}, '{$descricao}', {$categoria_id}, {$usado})";
                $resultadoDaInsercao = mysqli_query($conexao, $query);
            }

            //o checkbox quando não marcado da erro, pois por padrão não envia null ao invés de false.
            if(array_key_exists('usado', $_POST)) {
                $usado = true;
            } else {
                $usado = false;
            }

            /*ainda dá erro, pois, em arrays o valor false equivale a null, para
             solucionar o problema devemos colocar aspas, assim o php entende
             que deve trocar(escrever) o valor false*/
             if(array_key_exists('usado', $_POST)) {
                 $usado = "true";
             } else {
                 $usado = "false";
             }

           ?>


          <?php
            //Colocando o botao alterar
            <td><a class="btn btn-primary" href="produto-altera-formulario.php?id=<?=$produto['id']?>">alterar</a>

            //A página de alteração partirá da cópia do inserir produto(formulário e lógica)...
            $id = $_GET['id'];

            $produto = buscaProduto($conexao, $id);

            <tr>
                <td>Nome</td>
                <td> <input class="form-control" type="text" name="nome" value="<?=$produto['nome']?>"></td>
            </tr>
            <tr>
                <td>Preço</td>
                <td><input  class="form-control" type="number" name="preco" value="<?=$produto['preco']?>"></td>
            </tr>
            <tr>
                <td>Descrição</td>
//              <td><textarea class="form-control" name="descricao"><?=$produto['descricao']?></textarea></td>
            </tr>



           <?php
              //função de buscar o elemento a ser alterado:
              function buscaProduto($conexao, $id) {
                  $query = "select * from produtos where id = {$id}";
                  $resultado = mysqli_query($conexao, $query);
                  return mysqli_fetch_assoc($resultado);
              }// faz o fetch apenas na primeira linha, sem laço

            ?>

            <?php //checkbox:
              $usado = $produto['usado'] ? "checked='checked'" : "";
            ?>
              <tr>
                  <td></td>
                  <td><input type="checkbox" name="usado" <?=$usado?> value="true"> Usado
              </tr>

            <?php
              //inserindo id no formulário:
              <input type="hidden" name="id" value="<?=$produto['id']?>" />

              //select menu:?>
              <tr>
                  <td>Categoria</td>
                  <td>
                      <select name="categoria_id" class="form-control">
                      <?php

                          foreach($categorias as $categoria) :
                              $essaEhACategoria = $produto['categoria_id'] == $categoria['id'];
                              $selecao = $essaEhACategoria ? "selected='selected'" : "";

                      ?>
                          <option value="<?=$categoria['id']?>" <?=$selecao?>>
                                  <?=$categoria['nome']?>
                          </option>
                      <?php endforeach ?>
                      </select>
                  </td>
              </tr>



            <?php
              //O altera-produto.php (lógica)
              $id = $_POST['id'];
              // ...
              if(alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado))
                //...

              function alteraProduto($conexao, $id, $nome, $preco, $descricao, $categoria_id, $usado) {
                  $query = "update produtos set nome = '{$nome}', preco = {$preco}, descricao = '{$descricao}',
                      categoria_id= {$categoria_id}, usado = {$usado} where id = '{$id}'";
                  return mysqli_query($conexao, $query);
              }



             ?>
