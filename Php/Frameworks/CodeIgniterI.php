<?php //Aula 1
  //Controller
  class Produtos extends CI_Controller{
    public function index(){
      $produtos = [];
      $oculos = [
        "marca" => "Prada",
        "preco" => 900
      ];

      $camisa = [
        "cor" => "vermelha",
        "preco" => 30
      ];

      array_push($produtos, $oculos, $camisa);
      $dados = array("produtos" => $produtos);

      $this->load->view("produtos/index.php", $dados);
    }
  }

  //View/produtos/index ?>
  <html lang="en">
    <head>
      <link rel="stylesheet" href="css/bootstrap.css">
    </head>
    <body>
      <div class="container">
        <h1> Produtos</h1>
        <table class="table">
          <?php foreach($produtos as $produto) : ?>
            <tr>
              <td><?=$produto["nome"] ?></td>
              <td><?=$produto["preco"] ?></td>
            </tr>
          <?php endforeach ?>
        </table>
      <div>
    </body>
  </html>

<?php
  //config/routes.php
  $route['default_controller'] = "produtos";//landingpage
?>


<?php //Aula 2
  create table usuarios (id integer auto_increment primary key, nome varchar(255), email varchar(255), senha varchar(255));
  create table produtos(id integer auto_increment primary key, nome varchar(255), descricao text, preco decimal(10,2), usuario_id integer);
  insert into usuarios values(1,'Guilherme', 'guilherme.silveira@alura.com.br','e10adc3949ba59abbe56e057f20f883e');
  insert into produtos values(1, 'Bola de Futebol', 'Bola de futebol assinada pelo Zico', 300, 1);
  insert into produtos values(2, 'HD Externo', 'Marca HD-Mega', 400, 1);

  //model/produtos_model
  class Produtos_model extends CI_Model {

  public function buscaTodos() {
      return $this->db->get("produtos")->result_array();
    }
  }

  //controller/produtos.php
  public function index(){
    $this->load->database();
    $this->load->model("produtos_model");
    $produtos = $this->produtos_model->buscaTodos();

    $dados = array("produtos" => $produtos);
    $this->load->view("produtos/index.php", $dados);
  }

  //config/database.php
  $db['default']['database'] = 'mercado';
  $db['default']['username'] = 'root';

?>


<?php //Aula 3

  //criando o primeiro helper
  //application/helpers/currency_helper.php
  function numeroEmReais($numero) {
    return "R$ " . number_format($numero, 2, ",", ".");
  };

  //controller/produtos
  $this->load->helper("url");
  $this->load->helper("currency");


  //deixa a referência uniforme e independente de url
  <link rel="stylesheet" href="<?= base_url("css/bootstrap.css") ?>">   ?>
  <?= numeroEmReais($produto["preco"])?>



<?php //Aula 4

  //controller/produtos
  public function index(){
    //..
    $this->load->helper(array("form"));
    //...
  }


  //view/index
  //...
  <h1>Cadastro</h1>

    echo form_open("usuarios/novo");

    echo form_label("Nome", "nome");
    echo form_input(array(
      "name" => "nome",
      "id" => "nome",
      "class" => "form-control",
      "maxlength" => "255"
    ));

    echo form_label("Senha", "senha");
    echo form_password(array(
        "name" => "senha",
        "id" => "senha",
        "class" => "form-control",
        "maxlength" => "255"
    ));

    echo form_label("Email", "email");
    echo form_input(array(
      "name" => "email",
      "id" => "email",
      "class" => "form-control",
      "maxlength" => "255"
    ));

    echo form_button(array(
      "class" => "btn btn-primary",
      "content" => "Cadastrar",
      "type" => "submit"
    ));

    echo form_close();


  //controller/usuarios
  class Usuarios extends CI_Controller {
    public function novo() {
      $usuario = array(
        "nome" => $this->input->post("nome"),
        "email" => $this->input->post("email"),
        "senha" => md5($this->input->post("senha"))
      );

      $this->load->database();
      $this->load->model("usuarios_model");
      $this->usuarios_model->salva($usuario);
      $this->load->view("usuarios/novo");
    }
  }

  //usuarios_model
  class Usuarios_model extends CI_Model {
    public function salva($usuario) {
      $this->db->insert("usuarios", $usuario);
    }
  }

  //view/usuarios/novo.php
  <html>
      Cadastrado com sucesso!
  </html>
?>

<?php //Aula 06
  //config/autoload
  $autoload['libraries'] = array('database'); //$this->load->database();

  //é possível chamar vários helpers numa única expressão
  $this->load->helper(array("url","currency","form"));

  //mostrando o profiling da aplicação:
  public function index()
    {
        $this->output->enable_profiler(TRUE);
        //resto do código
    }

?>


<?php //Aula 07
  //Criando um login
  <if(!$this->session->userdata("usuario_logado")) :
    <h1>Login</h1>
    echo form_open("login/autenticar");

    echo form_label("Email", "email");
    echo form_input(array(
        "name" => "email",
        "id" => "email",
        "class" => "form-control",
        "maxlength" => "255"
    ));

    echo form_label("Senha", "senha");
    echo form_password(array(
    "name" => "senha",
        "id" => "senha",
        "class" => "form-control",
        "maxlength" => "255"
    ));

    echo form_button(array(
        "class" => "btn btn-primary",
        "content" => "Login",
        "type" => "submit"
    ));
    echo form_close();
  endif;
  //controller/login
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Login extends CI_Controller {
    public function autenticar() {
      $this->load->model("usuarios_model");
      $email = $this->input->post("email");
      $senha = md5($this->input->post("senha"));

      $usuario = $this->usuarios_model->buscaPorEmailESenha($email, $senha);

      if($usuario) {
        $this->session->set_userdata("usuario_logado" , $usuario);
        $dados = array("mensagem" => "Logado com sucesso");
      }else {
        $dados = array("mensagem" => "Usuário ou senha inválida.");
      }

        $this->load->view('login/autenticar', $dados);
    }
  }

  //config para session:
  $autoload['libraries'] = array('database', 'session');//autoload
  $config['encryption_key'] = '9843hufrh7n7983f443';//config

  //model/Usuarios_model
  public function buscaPorEmailESenha($email, $senha) {
    $this->db->where("email", $email);
    $this->db->where("senha", $senha);
    $usuario = $this->db->get("usuarios")->row_array();//pega a primeira linha
    return $usuario;
  }

  //view/login ?>
  <html>
    <body>
      <?=$mensagem?>
    </body>
  </html>


<?php //Aula 08
  //view
  anchor('login/logout','Logout', array("class" => "btn btn-primary")); //<a href="login/logout" class="btn btn-primary">Logout</a>

  //config/autoload
  $autoload['helper'] = array('url');

  //control/login
  public function logout(){
    $this->session->unset_userdata("usuario_logado");
    $this->session->set_flashdata("success" ,"Deslogado com sucesso");
    redirect("/");//redireciona para a raiz
  }

  //controller/login
  if($usuario) {
    $this->session->set_userdata("usuario_logado" , $usuario);
    $this->session->set_flashdata("success" ,"Logado com sucesso");
  }else { //dura uma requisição
    $this->session->set_flashdata("danger" ,"Usuário ou senha inválida");
  }
  redirect("/");

  //view ?>
  <p class="alert-success"><?= $this->session->flashdata("success") ?></p>
  <p class="alert-danger"><?= $this->session->flashdata("danger") ?></p>


<?php   //Aula 9
  //view/index
  anchor('produtos/formulario','Novo produto', array("class" => "btn btn-primary"))

  //control/produtos
  public function formulario() {
      $this->load->view("produtos/formulario");
  }

  public function novo(){
    $this->load->model("produtos_model");
    $usuarioLogado = $this->session->userdata("usuario_logado");
    $produto = array(
      "id" => $usuarioLogado["id"],
      "nome" => $this->input->post("nome"),
      "descricao" => $this->input->post("descricao"),
      "preco" => $this->input->post("preco")
    );
    $this->produtos_model->salva($produto);
    $this->session->set_flashdata("success", "Produto salvo com sucesso");
    redirect("/");
  }

  //view/formulário
  echo form_open("produtos/novo");
  //...
  echo form_close();

  //config/autoload
  $autoload['helper'] = array('url', 'form');

  //model/produtos_model
  public function salva($produto) {
    $this->db->insert("produtos", $produto);
  }



?>
