// Aula 01

//Após iniciar um projeto sem activity, criaremos uma manualmente:
package br.com.alura.agenda;

import android.app.Activity;

public class MainActivity extends Activity {

}

// Após isso, criaremos dentro do AndroidManifest.xml
<activity android:name=".MainActivity">
  <intent-filter>
    <action android:name="android.intent.action.MAIN"/>
    <category android:name="android.intent.category.LAUNCHER"/>
  </intent-filter>
</activity>

//Pronto, agora ela é o "método main"

//No Android, não existe um método main, a execução é baseada no ciclo de vida
//Cada etapa do ciclo do app tem seu método respectivo que será executado ao ocorrer o evento.

...
import android.os.Bundle;
import android.support.annotation.Nullable;

public class MainActivity extends Activity {
  @Override
  protected void onCreate(@Nullable Bundle savedInstanceState) {
    //Se tiver a dependencia do AndroidX será @androidx.annotation.Nullable no lugar de @Nullable
    super.onCreate(savedInstanceState);//Obrigatório
    Toast.makeText(context:this, text:"Juan Ananda", Toast.LENGTH_LONG).show(); //Exibe um pequeno texto temporário
  }
}


//--------------------------------------------------------------------
//Aula 02

//Colocando um texto pela activity (má prática):
...
import android.widget.TextView;
...
protected void onCreate(@Nullable Bundle savedInstanceState) {
  super.onCreate(savedInstanceState);

  TextView aluno = new TextView(context:this);
  aluno.setText("Juan Ananda");
  setContentView(aluno);
}

//Dentro do diretório res (resources) encontram-se todos os arquivos estáticos (recursos)
//Criaremos o diretório lauyout dentro dele e o arquivo activity_main
//No arquivo de layout pegaremos a TextView na pallette e arrastaremos
//Repare que o comando aluno.setText("Juan Ananda") é apenas um simples atributo aqui

//Para colocá-lo na activity utiliza-se:
protected void onCreate(@Nullable Bundle savedInstanceState) {
  super.onCreate(savedInstanceState);
  //A classe R mapeia todos os recursos (res) do nosso projeto, facilita a vinculação:
  setContentView(R.layout.activity_main);
}

//Como queremos implementar uma lista, a solução mais intuitiva seria colocar vários TextViews
//Após colocá-los no layout a activity ficaria assim:
protected void onCreate(@Nullable Bundle savedInstanceState) {
  super.onCreate(savedInstanceState);

  setContentView(R.layout.activity_main);
  List<String> alunos = new ArrayList<>(
    Arrays.asList("Khabib","Cormier","Jones")
  );

  TextView primeiroAluno = findViewById(R.id.textView);
  TextView segundoAluno = findViewById(R.id.textView4);
  TextView terceiroAluno = findViewById(R.id.textView5);

  primeiroAluno.setText(alunos.get(0));
  segundoAluno.setText(alunos.get(1));
  terceiroAluno.setText(alunos.get(2));
}

//Porém, isso é uma má prática, existe a ListView que é adequada para tais implementações:
/*Componentes como a ListView já esperam um resultado dinâmico, todas elas não fazem
uma inferência direta, antes precisam de um adapter;*/
/*A list adapter é uma implementação enorme, no nosso caso, existe uma simplificada que é
a ArrayAdapter: */

protected void onCreate(@Nullable Bundle savedInstanceState) {
  super.onCreate(savedInstanceState);
  setContentView(R.layout.activity_main);
  List<String> alunos = new ArrayList<>(
    Arrays.asList("Khabib","Cormier","Jones")
  );

  ListView listaDeAlunos = findViewById(R.id.actitity_main_lista_de_alunos);
  listaDeAlunos.setAdapter(new ArrayAdapter<String>(
    context:this, //Activity de contexto
    android.R.layout.simple_list_item_1, //Resource de layout padrão dos itens da lista
    alunos)); //conteúdo
}

//AdapterViews são views que se compõe de outras views dinamicamente.


//------------------------------------------------------------------------------
// Aula 03

//No lugar de criar um botão comum e customizá-lo, existe uma implementação já pronta
//que entrega exatamente o que procuramos. É o Floating action button. Basta baixá-lo.
//Após baixar. No build.graddle estará assim:
dependencies {
  ...
  implementation 'com.android.support:design:28.0.0'
}

//Porém ao colocar ele não se sobrepõe a lista, porque seu viewGroup é o linear layout
// o qual posiciona os elementos de acordo com linhas ou colunas.

//ViewGroups são Views quem contêm outras views, nesse caso, colocaremos a relative layout
//Todo layout é representado por meio de código xml, com namespaces e atributos respectivos.

//Para detalhes sobre design, a recomendação é a leitura e consulta do 'material design'

//--------------------------------------------------------------------------------------------------------------
//Aula 04

//Na pasta res\drawable criaremos um image asset, que representa uma imagem estática. Será o icone do FAB
//Dessa forma, para incluir, deve-se:
<android.suport.design.widget.FloatActionButton
  ...
  android:src="@drawable/ic_action_novo_aluno"
  ... />

//Para colocar a appbar extenderemos a activity com a AppCompatActivity
public class MainActivity extends AppCompatActivity {
  ...
}
// O AppCompatActivity também auxilia no fato de gerar suporte as novas features as antigas versões do Android.
//Para alterar o titulo da appbar basta acrescentar na activity:
setTitle("Lista de Alunos");

//Criaremos uma nova activity no pacote url.ui.activity de nome FormularioAlunoActivity
/*Iremos na Main activity e arrastaremos até a pasta ui.activity e clicamos em refactory, assim
ele já refatora os pontos que fazem referencia ao caminho antigo.*/

/*Para refatorar o nome, iremos na referência do Manifest e clicaremos Shift+F6, dessa forma
ativasse o rename, no qual se refatora todas as referências do nome respectivo*/
//Faremos a mesma coisa para os arquivos estáticos.

//substituiremos o constraintlayout pelo linearlayout(legado), por questões didáticas.
//Em seguida faremos o layout:
<LinearLayout xmls:android="http://schemas.android.com/apk/re..."
  android:layout_width="match_parent"
  android:layout_height="match_parent"
  android:orientation="vertical">

  <EditText android:id="@+id/activity_formulario_aluno_nome"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:_layout_margin="8dp"
    android:inputType="textCapWords"
    android:hint="Nome"/>

  <EditText android:id="@+id/activity_formulario_aluno_telefone"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:_layout_margin="8dp"
    android:inputType="phone"
    android:hint="Telefone"/>

  <EditText android:id="@+id/activity_formulario_aluno_email"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:_layout_margin="8dp"
    android:inputType="textEmailAddress"
    android:hint="E-mail"/>

  <Button android:id="@+id/activity_formulario_aluno_botao_salvar"
    android:layout_width="match_parent"
    android:layout_height="wrap_content"
    android:_layout_margin="8dp"
    android:text="Salvar"/>

</LinearLayout>

//---------------------------------------------------------------------------
//Aula 05
//Adicionando a lógica do botão

public class FormularioAlunoActivity extends AppCompatActivity {
  @Override
  protected void onCreate(Bundle savedInstanceState){
    super.onCreate(savedInstanceState);
    setContentView(R.layout.activity_formulario_aluno);

    final AlunoDAO dao = new AlunoDAO();//criando um dao

    //Para a classe anonima ver as variáveis, tem que ser final
    final EditText campoNome = findViewById(R.id.activity_formulario_aluno_nome);
    final EditText campoTelefone = findViewById(R.id.activity_formulario_aluno_telefone);
    final EditText campoEmail = findViewById(R.id.activity_formulario_aluno_email);

    Button botaoSalvar = findViewById(R.id.activity_formulario_aluno_botao_salvar); //Pega o botão
    botaoSalvar.setOnClickListener(new View.OnClickListener() { //inclui um listener e cria a Classe anonima
      @Override
      public void onClick(View view) { //Aqui fica a ação que ocorrerá ao clicar
        String nome = campoNome.getText().toString();
        String telefone = campoTelefone.getText().toString();
        String email = campoEmail.getText().toString();

        Aluno alunoCriado = new Aluno(nome, telefone, email);
        dao.salva(alunoCriado);

        startActivity(new Intent(FormularioAlunoActivity.this,
          ListaAlunosActivity.class));
      }
    });
  }
}

//A classe aluno(model) seria:
public class Aluno {
  private final String nome;
  private final String telefone;
  private final String email;

  Aluno(nome, telefone, email){
    this.nome = nome;
    this.telefone = telefone;
    this.email = email;
  }

  @NonNull
  @Override
  public String toString() {
    return nome;
  }
}

//A classe DAO seria:
public class AlunoDAO {

  private final static List<Aluno> alunos = new ArrayList<>();

  public void salva(Aluno aluno){
    alunos.add(aluno);
  }

  public List<Aluno> todos() {
    return new ArrayList<>(alunos);
  }
}

//Na lista de alunos, chamaria o método todos para exibir:
...
listaDeAlunos.setAdapter(new ArrayAdapter<>(
  context:this,
  android.R.layout.simple_list_item_1,
  dao.todos()
))
...


//Adicionando o comportamento do FAB:
...
FloatActionButton botaoNovoAluno = findViewById(R.id.activity_lista_alunos_fab_novo_aluno);
botaoNovoAluno.setOnClickListener(new View.onClickListener(){
  @Override
  public void onClick(View view) {
    startActivity(new Intent(ListaAlunosActivity.this, FormularioAlunoActivity.class));
  }
});


//Como sempre criamos uma nova activity, ao clicar voltar ele perde os dados já inseridos na lista.
//Dessa forma, mudaremos a lógica, no botão salvar colocaremos no lugar do intent:
finish();

//No ListaAlunosActivity deixaremos a lógica no onResume:
...
@Override
protected void onResume() {
  super.onResume();

  AlunoDAO dao = new AlunoDAO();

  ListView listaDeAlunos = findViewById(R.id.activity_lista_alunos_lista);
  listaDeAlunos.setAdapter(new ArrayAdapter<>(
    context:this,
    android.R.layout.simple_list_item_1,
    dao.todos()
  ));
}

//Dessa forma, toda vez que for resumida a tela ele puxa a tela atualizada.

//Agora iremos refatorar o FormularioAlunoActivity, primeiro no botao salvar:

  Button botaoSalvar = findViewById(R.id.activity_formulario_aluno_botao_salvar);
  botaoSalvar.onClickListener(view -> {
    Aluno alunoCriado = criaAluno(campoNome, campoTelefone, campoEmail);
    salva (alunoCriado, dao);
  });

  //Ctrl + Alt + N extrai o trecho selecionado e refatora em um método a parte.
  ...

  private criaAluno(EditText campoNome, EditText campoTelefone, EditText campoEmail) {
    String nome = campoNome.getText().toString();
    String telefone = campoTelefone.getText().toString();
    String email = campoEmail.getText().toString();

    return new Aluno(nome, telefone, email);
  }

  ...

  private void salva (Aluno aluno, AlunoDAO dao) {
    dao.salva(alunoCriado);

    finish();
  }

}

//Depois, a manipulação dos campos, de variáveis para atributos:

public class FormularioAlunoActivity extends AppCompatActivity {
  private EditText campoNome;
  private EditText campoTelefone;
  private EditText campoEmail;

  ...

  inicializacaoDosCampos();

  ...

  private void inicializacaoDosCampos() {
    campoNome = findViewById(R.id.activity_formulario_aluno_nome);
    campoTelefone = findViewById(R.id.activity_formulario_aluno_telefone);
    campoEmail = findViewById(R.id.activity_formulario_aluno_email);
  }


//Quando se trocou para atributos, os parâmetros diminuiram:
criaAluno();
...
criaAluno(){
  String nome = campoNome.getText().toString();
  String telefone = campoTelefone.getText().toString();
  String email = campoEmail.getText().toString();

  return new Aluno(nome, telefone, email);
}

//E ao colocar o DAO como atributo, também se retira do parâmetro.
private final AlunoDAO dao = new AlunoDAO();
...
private void salva(Aluno aluno) {
  dao.salva(aluno);
  finish();
}

//Agora fatoraremos também o botao salvar:
configuraBotaoSalvar();
...
private void configuraBotaoSalvar() {
  Button botaoSalvar = findViewById(R.id.activity_formulario_aluno_botao_salvar);
  botaoSalvar.onClickListener(new View.OnClickListener() {
    @Override
    public void onClick(View view) {
      Aluno alunoCriado = criaAluno();
      salva(alunoCriado);
    }
  });
}


//Ao final da refatoração temos um código compreensível e enxuto:
@Override
protected void onCreate(Bundle savedInstanceState) {
  super.onCreate(savedInstanceState);
  setContentView(R.layout.activity_formulario_aluno);
  setTitle("Novo Aluno");
  inicializacaoDosCampos();
  configuraBotaoSalvar();
}

//Colocaremos o setTitle numa constante:
public static final String TITULO_APPBAR = "Novo Aluno";
...
setTitle(TITULO_APPBAR);


//Agora refatoraremos a ListaAlunosAcitivity:
configurarFabNovoAluno();
...
private void configurarFabNovoAluno() {
  FloatActionButton botaoNovoAluno = findViewById(R.id.activity_lista_alunos_fab_novo_aluno);
  botaoNovoAluno.setOnClickListener(new View.onClickListener(){
    @Override
    public void onClick(View view) {
      startActivity(new Intent(ListaAlunosActivity.this, FormularioAlunoActivity.class));
    }
  });
}

private void abreFormularioActivity() {
  startActivity(new Intent(this, FormularioAlunoActivity.class));
} //Como saiu da classe anonima, não é mais necessário a referencia no this.

//também faremos com a lista e dao:

private final AlunoDAO dao = new AlunoDAO();
...
private void configuraLista() {
  ListView listaDeAlunos = findViewById(R.id.activity_lista_alunos_lista);
  listaDeAlunos.setAdapter(new ArrayAdapter<>(
    context:this,
    android.R.layout.simple_list_item_1,
    dao.todos()
  ));
}
