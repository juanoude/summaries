<?php //Aula 01
  //linkando o nome dos produtos
  //view/produtos/index
  foreach($produtos as $produto) : ?>
    <tr>
      <td><?= anchor("produtos/mostra?id={$produto['id']}", $produto["nome"])?></td>
      <td><?= numeroEmReais($produto["preco"])?></td>
    </tr>
  <?php endforeach

  //controller/produtos
  public function mostra(){
    $id = $this->input->get('id');
    $this->load->model("produtos_model");
    $produto = $this->produtos_model->busca($id);
    $this->load->helper("typography"); //Os enters no texto do DB são '\n'
    $dados = [
      "produto" => $produto
    ];

    $this->load->view("produtos/mostra", $dados)
  }

  //model/produtos_model
  public function busca($id){
    return $this->db->get_where("produtos", array("id"=>$id)->row_array());
  }

  //view/produtos/mostra
  //... ?>
  <body>
    <?= $produto["nome"] ?><br>
    <?= $produto["preco"] ?><br>
    <?= auto_typography($produto["descricao"]) ?><br>
  </body>


<?php //Aula 02
  //config/autoload
  $autoload['helper'] = array('url', 'form','text');

  //view/produtos/index
  anchor("produtos/{$produto['id']}", $produto["nome"])
  character_limiter($produto["descrição"], 15);

  //controller/produtos
  public function mostra($id){
    //Faz ele pegar o parâmetro pela url
  }

  //config/routes
  $route['produtos/(:num)'] = 'produtos/mostra/$1';

  //view/produtos/mostra
  auto_typography(html_escape($produto['descrição']));
  //deve-se escapar injection de html e javascript
?>



<?php //Aula 03
  //controller/produtos/index
  //produtos/novo
  $this->load->library("form_validation");
  $this->form_validation->set_rules("nome","nome","required|min_length[5]");//campo,label,regra
  $this->form_validation->set_rules("preco","preco","required");
  $this->form_validation->set_rules("descricao","descricao","required|min_length[20]");

  $sucesso = $this->form_validation->run();
  if(sucesso){
    //adiciona o novo produto
  }else{
    $this->load->view("produtos/formulario");
  }

  //view/produtos/formulario
  //echo validation_errors("<p class='alert alert-danger'>", "</p>");//mostra todos os erros

  echo form_label("Nome", "nome");
  echo form_input(array(
    //...
    "value" => set_value("nome","")
    /*sempre ocorra a falha na validação na tela as informações que já
    preenchemos não se perca.*/
  ));

  echo form_error("nome"); //mostra o erro específico no local do campo
  //para colocar classes neles:
  //controller/novo
  $this->form_validation->set_error_delimiters("<p class='alert alert-danger', </p>");
?>


<?php //Aula 4
  //controller/produtos/index
  //produtos/mostra
  $this->form_validation->set_rules("nome", "required|min_length[5]|callback_nao_tenha_a_palavra_melhor");

  public function nao_tenha_a_palavra_melhor($nome){
    $posicao = strpos($nome, "melhor");
    if($posicao != FALSE){
      return true;
    }else{
      $this->form_validation->set_message("nao_tenha_a_palavra_melhor", "O campo '%s' não pode conter a palavra 'melhor'");
      return false;
    }
  }

  //https://github.com/CIBr/CodeIgniter-Portuguese-BR
  //application/languages/ - desconpacte aqui a tradução;
  //config/config
  $config['language']    = 'portuguese_br';

?>


<?php //Aula 5
  //migrations/migration_vendas.php
  class Migration_Vendas extends CI_Migration {
    public function up(){
      $this->dbforge->add_field(array(
        'id' => array(
          'type' => 'INT',
          'auto_increment' => true
        ),
        'produto_id' => array (
          'type' => 'INT'
        ),
        'comprador_id' => array(
          'type' => 'INT'
        ),
        'data_de_entrega' => array(
          'type' => 'DATE'
        )
      ));
      $this->dbforge->add_key('id', true);
      $this->dbforge->create_table('vendas');
    }

    public function down() {
      $this->dbforge->drop_table('vendas');
    }

  }

  //config/migrations
  $config['migration_enabled'] = TRUE;
  $config['migration_version'] = 1;

  //controller/utils
  php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Utils extends CI_Controller {
    public function migrate() {
      $this->load->library("migration");
      $sucess = $this->migration->current();

      if($success) {
        echo 'migrado';
      }else {
        show_error($this->migration->error_string());
      }
    }
  }
?>


<?php //Aula 06
  //view/produtos/mostra
  //formulário de compra
  echo form_open("vendas/nova");
  echo form_label("Data de entrega" , "data_de_entrega");

  echo form_hidden("produto_id", $produto["id"]);

  echo form_input(array(
    "name" => "data_de_entrega",
    "class" => "form-control",
    "id" => "data_de_entrega",
    "maxlength" => "255",
    "value" => ""
  ));

  echo form_button(array(
    "class" => "btn btn-primary",
    "content" => "Comprar",
    "type" => "submit"
  ));

  //controller/vendas
  //vendas/nova
  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Vendas extends CI_Controller {
    public function nova() {
      $this->load->model(array("vendas_model"));
      $this->load->helper(array("date"));

      $usuario = $this->session->userdata("usuario_logado");

      $venda = array(
        "produto_id" => $this->input->post("produto_id"),
        "comprador_id" => $usuario["id"],
        "data_de_entrega" => dataPtBrParaMysql($this->input->post("data_de_entrega"))
      );

      $this->vendas_model->salva($venda);
      $this->session->set_flashdata("success", "Pedido de compra efetuado com sucesso");
      redirect("/");
    }
  }

  class Vendas_model extends CI_Model {
    public function salva($venda) {
      $this->db->insert("vendas", $venda);
    }
  }

  //helpers/date_helpers
  function dataPtBrParaMysql($dataPtBr) {
    $partes = explode("/", $dataPtBr);
    return "{$partes[2]}-{$partes[1]}-{$partes[0]}";
  }
?>

<?php //Aula 07
  class Migration_Adiciona_vendido_ao_produto extends CI_Migration {

    public function up() {
      $this->dbforge->add_column('produtos', array(
        'vendido' => array(
          'type' => 'boolean',
          'default' => '0'
        )
      ));
    }

    public function down() {
      $this->dbforge->drop_column('produtos', 'vendido');
    }

  }

  //config/migrations
  $config['migration_version'] = 2;
  /*Após mudar o numero de versão deve-se acessar o Utils para ele executar a
  a função up/down para efetivar a transição.*/

  //model/vendas_model
  public function salva($venda) {
    $this->db->insert("vendas", $venda);
    $this->db->update("produtos",
      array("vendido" => 1),
      array("id" => $venda["produto_id"])
    );
  }

  //model/produtos_model
  //listar
  $this->db->where("vendido", false);
?>

<?php //Aula 08
  //controller/vendas/index
  public function index() {
    $usuario = $this->session->userdata("usuario_logado");
    $this->load->model("produtos_model");
    $produtosVendidos = $this->produtos_model->buscaVendidos($usuario);

    $dados = array("produtosVendidos" => $produtosVendidos);
    $this->load->view("vendas/index", $dados);
  }

  //model/produtos_model
  public function buscaVendidos($usuario) {
    $id = $usuario['id'];
    $this->db->select("produtos.*, vendas.data_de_entrega");
    $this->db->from("produtos");
    $this->db->join("vendas", "produtos.id = vendas.produtos_id");
    $this->db->where("vendido", true);
    $this->db->where("usuario_id", $id);
      return $this->db->get()->result_array();
  }

  //index/vendas
  foreach($produtosVendidos as $produto) : ?>
    <tr>
      <td><?= $produto["nome"]?></td>
      <td><?= dataMysqlParaPtBr($produto["data_de_entrega"])?></td>
    </tr>
  <?php endforeach ?>
<?php

  //helper/date_helper
  function dataMySqlParaPtBr($dataMySql){
    $data = New DateTime($dataMySql);
    return $data->format("d/m/Y");
  }

  ///config/autoload
  $autoload['helper'] = array('url', 'form', 'text', 'date');

?>


<?php //Aula 09

  //helpers/auth_helper
  function autoriza(){
    $ci = get_instance();
    $usuarioLogado = $ci->session->userdata("usuario_logado");
    if(!$usuarioLogado) {
      $ci->session->set_flashdata("danger", "Você precisa estar logado");
      redirect("/");
    }
    return $usuarioLogado;
  }

  //como será usado em vários lugares;
  $autoload['helper'] = array('url', 'form', 'text', 'date', 'auth');

  //nas funçoes:
  public function novo() {
    $usuarioLogado = autoriza();
    // resto do código
  }

  public function nova() {
    $usuario = autoriza();
    // resto do código
  }

  public function index() {
    $usuario = autoriza();
    // resto do código
  }
?>


<?php //Aula 10
  //controllers/index
  //produtos/novo
  $this->load->library("email");
  $this->load->model(array("vendas_model", "produtos_model", "usuarios_model"));

  $config["protocol"] = "smtp";
  $config["smtp_host"] = "ssl://smtp.gmail.com";
  $config["smtp_user"] = "codeigniteralura@gmail.com";
  $config["smtp_pass"] = "123456";
  $config["charset"] = "utf-8";
  $config["mailtype"] = "html";
  $config["newline"] = "\r\n";
  $config["smtp_port"] = '465';
  $this->email->initialize($config);

  $produto = $this->produtos_model->busca($venda["produto_id"]);
  $vendedor = $this->usuarios_model->busca($produto["usuario_id"]);

  $this->email->from("codeigniteralura@gmail.com", "Mercado");
  $this->email->to("{$vendedor['email']}");
  $this->email->subject("Seu produto {$produto['nome']} foi vendido!");

  $dados = array("produto" => $produto);
  $conteudo = $this->load->view("vendas/email.php", $dados, TRUE);

  $this->email->message($conteudo);
  $this->email->send();

  //Busca por id:
  public function busca($id) {
    $this->db->where("id", $id);
    return $this->db->get("usuarios")->row_array();
  }

  //views/vendas/email ?>
  <html>
    <h1>Venda no mercado</h1>
    Seu produto <b><?= $produto['nome'] ?></b> foi vendido!
  </html>


<?php //Aula 11
  //Evitando tal prática:
  $this->load->view("cabecalho.php");
  $this->load->view("produtos/index.php", $dados);
  $this->load->view("rodape.php");

  //core/MY_Loader.php
  class MY_Loader extends CI_Loader {
    public function template($nome, $dados = array()) {
      $this->view("cabecalho.php");
      $this->view($nome, $dados);
      $this->view("rodape.php");
    }
  }

  //agora se chamará assim:
  $this->load->template('minha_pagina', $dados);
?>
