<?php

  //criando login
  create table usuarios (id integer auto_increment primary key, email varchar(255), senha varchar(255));

  //Senhas devem ser resumidas em hash, nesse caso, md5
  insert into usuarios (email,senha) values ('guilherme.silveira@alura.com.br', 'e10adc3949ba59abbe56e057f20f883e');


  function buscaUsuario($conexao, $email, $senha) {
    $senhaMd5 = md5($senha);
    $query = "select * from usuarios where email='{$email}' and senha='{$senhaMd5}'";
    $resultado = mysqli_query($conexao, $query);
    $usuario = mysqli_fetch_assoc($resultado);
    return $usuario;
  }

  //será uma boa prática? (o post direto como parametro sem intermediar com uma váriavel)
  $usuario = buscaUsuario($conexao, $_POST["email"], $_POST["senha"]);
  var_dump($usuario);//mostrando o array. Com o usuário inválido será null

  if($usuario == null) {
      header("Location: index.php?login=0");
  } else { //um array é false se possui valor 0 ou null
      header("Location: index.php?login=1");
  }
  die();

//  <?php
      //isset vê se o parâmetro existe no array.
      if(isset($_GET["login"]) && $_GET["login"]==true) {
  ?>
        <p class="alert-success">Logado com sucesso!</p>
  <?php
      }
  ?>
  <?php
      if(isset($_GET["login"]) && $_GET["login"]==false) {
  ?>
        <p class="alert-danger">Usuário ou senha inválida!</p>
  <?php
      }
  ?>

<?php
  //cookies
  setcookie("usuario_logado", $usuario["email"]);
  //na aba network podemos ver os cookies enviados.

 ?>

  <?php // mostrando o formulário apenas quando deslogado
    if(isset($_COOKIE["usuario_logado"])) {
   ?>
      <p class="text-success">Você está logado como <?= $_COOKIE["usuario_logado"] ?></p>
  <?php
   } else {
   ?>
      CODIGO DO FORMULARIO AQUI
   <?php
   }
   ?>

<?php/* por padrão o cookie persiste até o navegador fechar, para colocar
um cookie de 1 minuto: */
    setcookie("usuario_logado", $usuario["email"], time() + 60);
 ?>


<?php
  //negando acesso:
  if(!isset($_COOKIE["usuario_logado"])) {
    Header("Location: index.php?falhaDeSeguranca=true");
    die();
  }//lembre-se de inserir na lógica também

 //no login:
 if(isset($_GET["falhaDeSeguranca"])) {
 ?>
   <p class="alert-danger">Você não tem acesso a esta funcionalidade!</p>
 <?php
 }
 ?>



<?php //isolando lógicas:


  function usuarioEstaLogado() {
      return isset($_COOKIE["usuario_logado"]);
  }


  // function verificaUsuario() {
  //   if(!isset($_COOKIE["usuario_logado"])) {
  //      header("Location: index.php?falhaDeSeguranca=true");
  //      die();
  //   }
  // }
  function verificaUsuario() {
    if(!usuarioEstaLogado()) {
       header("Location: index.php?falhaDeSeguranca=true");
       die();
    }
  }


  function usuarioLogado() {
      return $_COOKIE["usuario_logado"];
  }

  //logaUsuario($usuario["email"]);
  function logaUsuario($email) {
    setcookie("usuario_logado", $email);
  }

 ?>


<?php
  /*cookies no usuario são manipuláveis/manufaturáveis, portanto, deve-se criar
  uma sessão e deixar o usuário apenas com um id aleatório e grande como uma "chave"
  de acesso ao verdadeiro cookie no servidor.*/
  session_start();//cria ou usa uma sessão já criada...
  function logaUsuario($email) {
      $_SESSION["usuario_logado"] = $email;
  }

  function verificaUsuario() {
    if(!usuarioEstaLogado()) {
       header("Location: index.php?falhaDeSeguranca=true");
       die();
    }
  }

  function usuarioEstaLogado() {
      return isset($_SESSION["usuario_logado"]);
  }

  function usuarioLogado($email) {
      return $_SESSION["usuario_logado"];
  }

  //Criando logout
    if(usuarioEstaLogado()) {?>
      <p class="text-success">Você está logado como <?= usuarioLogado() ?>.
      <a href="logout.php">Deslogar</a></p>
  <?php } else {?>

<?php include("logica-usuario.php");
    logout();
    header("Location: index.php?logout=true");
    die();

    function logout() {
        session_destroy();
    }
?>

<?php
  //migrando os alertas de get para session
  function verificaUsuario() {
    if(!usuarioEstaLogado()) {
        $_SESSION["danger"] = "Você não tem acesso a esta funcionalidade.";
       header("Location: index.php");
       die();
    }
  }
  //Logo depois de exibir, deve-se limpar a mensagem.
  if(isset($_SESSION["danger"])) {
?>
    <p class="alert-danger"><?= $_SESSION["danger"]?></p>
<?php
        unset($_SESSION["danger"]);
     }
 ?>

<?php
    if($usuario == null) {
      $_SESSION["danger"] = "Usuário ou senha inválido.";
      header("Location: index.php");
    } else {
      $_SESSION["success"] = "Usuário logado com sucesso.";
      logaUsuario($usuario["email"]);
      header("Location: index.php");
    }
  ?>

<?php
    if(isset($_SESSION["success"])) {
    ?>
      <p class="alert-success"><?= $_SESSION["success"]?></p>
    <?php
        unset($_SESSION["success"]);
     }
 ?>

<?php
    logout();
    $_SESSION["success"] = "Deslogado com sucesso.";
    header("Location: index.php");
    die();

    //deve-se reiniciar uma sessão nova, após o log out
    function logout() {
        session_destroy();
        session_start();
    }

  //no remover produto também é necessário.
  $id = $_POST['id'];
   removeProduto($conexao, $id);
   $_SESSION["success"] = "Produto removido com sucesso.";
   header("Location: produto-lista.php");
   die();
   //colocar na lista também e pronto.
   if(isset($_SESSION["success"])) {
    ?>
        <p class="alert-success"><?= $_SESSION["success"]?></p>
    <?php
            unset($_SESSION["success"]);
         }
  ?>


<?php
  //enxugando o escopo de flash
  function mostraAlerta($tipo){
    if(isset($_SESSION[$tipo])){ ?>
      <p class="alert-<?= $tipo?>"> <?= $_SESSION[$tipo] ?> </p> <?php
      unset($_SESSION[$tipo]);
    }
  }

  //chamando
  mostraAlerta("success");
  mostraAlerta("danger");

  /*colocamos um session_start(); no começo da sessão para assegurar que uma
  sessão sempre estará em vigor, porém ao passar pelo segundo comando ele exibe
  um warning, como não é um erro podemos desativá-lo para o usuário final */
  error_reporting(E_ALL ^ E_NOTICE);
  //exibindo todos exceto os e_notices.
 ?>


<?php
  //Como os dois formularios são similares, faremos 1 só, includando o miolo
?>  <tr>
        <td>Nome</td>
        <td> <input class="form-control" type="text" name="nome" value="<?=$produto['nome']?>"></td>
    </tr>
    <tr>
        <td>Preço</td>
        <td><input  class="form-control" type="number" name="preco"
            value="<?=$produto['preco']?>"></td>
    </tr>
    <tr>
        <td>Descrição</td>
        <td><textarea class="form-control" name="descricao"><?=$produto['descricao']?></textarea></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="checkbox" name="usado" <?=$usado?> value="true"> Usado
    </tr>
    <tr>
        <td>Categoria</td>
        <td>
            <select name="categoria_id" class="form-control">
            <?php foreach($categorias as $categoria) :
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
  // para deixar o adicionar em branco:
  $produto = array("nome" => "", "descricao" => "", "preco" => "", "categoria_id" => "1");
  $usado = "";
 ?>

<?php
  //Os dados que serão queryados devem ser limpos, antes da query(SQL Injection)
  $email = mysqli_real_escape_string($conexao, $email);

 ?>

<?php
  /*O include coloca o arquivo e caso não existe emite um warning e continua a execução;
    O require nesse caso dá um erro fatal;
    E o require_once garante que o arquivo será chamado uma única vez.
    Colocaremos o conecta em todos bancos e substituir todos includes por require once*/
    require_once("conecta.php");
 ?>



<?php
  //Criando o form de contato para esse envia.php:
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $mensagem = $_POST['mensagem'];

  //com a ajuda da biblioteca PHPMailer:
  // require_once("class.pop3.php");
  // require_once("class.smtp.php");
  // require_once("class.phpmailer.php");
  require_once("PHPMailerAutoload.php"); //ele chama os outros 3 dinamicamente

  //Criando o novo email a ser enviado:
  $mail = new PHPMailer();

  //Definindo o emissor:
  $mail->setFrom("alura.php.e.mysql@gmail.com", "Alura Curso PHP e MySQL");

  //Receptor:
  $mail->addAddress("alura.php.e.mysql@gmail.com");

  //título da mensagem:
  $mail->Subject = "Email de contato da loja";

  //Corpo como HTML:
  $mail->msgHTML("<html>de: {$nome}<br/>email: {$email}<br/>mensagem: {$mensagem}</html>");

  //Corpo como txt (alternativo):
  $mail->AltBody = "de: {$nome}\nemail:{$email}\nmensagem: {$mensagem}";

  //Envia:
  $mail->send();
  //Com tratamento de erro:
  if($mail->send()) {
      $_SESSION["success"] = "Mensagem enviada com sucesso";
      header("Location: index.php");
  } else {
      $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
      header("Location: contato.php");
  }
  die();

  //Iniciando sessão para evitar problemas:
  session_start();
 ?>
