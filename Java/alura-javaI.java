System.out.println("Minha primeira aplicação Java!");
//Para funcionar precisa estar em um método e esse em uma classe:
class MeuPrograma {
    public static void main(String[] args) {
        System.out.println("Minha primeira aplicação Java!");
    }
}


java -version //mostra a versão no cmd

javac MeuPrograma.java /* isso faz com que o bytecode seja gerado, ou seja,
um arquivo .class que roda em qualquer sistema.*/

java MeuPrograma /* executa o programa, ou seja, chama a máquina virtual Para
interpretar o bytecode.*/

javap -c MeuPrograma.class /* Mostra o conteúdo do bytecode que é semelhante
a um código assembly, por exemplo: */

MeuPrograma();
  Code:
   0:   aload_0
   1:   invokespecial   #1; //Method java/lang/Object."<init>":()V
   4:   return

public static void main(java.lang.String[]);
    Code:
    0:    getstatic    #2; //Field java/lang/System.out:Ljava/io/PrintStream;
    3:   ldc     #3; //String Minha primeira aplicação Java!!
    5:   invokevirtual   #4; //Method java/io/PrintStream.println:
                                (Ljava/lang/String;)V
    8:   return

}



class Variaveis {
    public static void main(String[] args){
      int inteiro = 10;
      long inteiroLongo = 999999999L;

      //convertendo:
      long x = 10000;
      int i = x; // não compila, pois pode estar perdendo informação
      long x = 10000;
      int i = (int) x;//compila. (casting)


      float realCurto = 0.1f;
      double real = 3.14623672468287646276472;

      //convertendo:
      double d = 5;
      int i = d; //não compila

      double d3 = 3.14;
      int i = (int) d3;/*compila. Foi moldado (casted) como um número inteiro.
      Esse processo recebe o nome de casting.*/

      int i = 5;
      double d2 = i;//compila, pois todo int está incluso em double

      double d = 5;
      float f = 3;
      float x = f + (float) d;//compila por casting

      boolean vOuF= true;
      int idade = 17;
      boolean menorDeidade = idade < 17;

      char letra ='A';//Guarda apenas um caractere e deve ser entre ''

    }
}


class Ifs {
  public static void main(String[] args){
    int idade =15;
    boolean amigoDoDono=true;
    if (idade > 18 || amigoDoDono == true){
      System.out.println("pode entrar");
    }else{
      System.out.println("não pode entrar")
    }
  }
}


class Repeticoes{
  public static void main(String[] args){
      int idade = 15;
      while(idade<18){
        System.out.println(i);
        i++;
      }

      for(i=0; i<10; i++){
        System.out.println(i);
      }


      //controlando loops:
      for (int i = x; i < y; i++) {
          if (i % 19 == 0) {
              System.out.println("Achei um número divisível por 19 entre x e y");
              break;
          }//interrompe a execução do loop sem que o resto seja executado
      }
      for (int i = 0; i < 100; i++) {
          if (i > 50 && i < 60) {
              continue;
          }//pula para a próximo laço
          System.out.println(i);
      }
  }
}// Quando declaradas dentro de chaves, variareis limitam seu escopo como local
//tanto em ifs quanto loops.


//Orientação a objeto - Criando e usando
class Cliente {
  String nome;
}

class Conta {
  Cliente titular;/*Pode-se atribuir o default como:
  Cliente titular = new Cliente();
  Assim, quando chamarem new Conta, havera um new Cliente para ele. */
  double saldo;

  void deposito(double valor){
    this.saldo += valor;
  }

  boolean saque(double valor){
    if(this.saldo >= valor){
        this.saldo -= valor;
        return true;
    }else{
        return false;
    }
  }

  void transferencia(Conta destino, double valor){
    boolean retirou = this.saca(valor);
        if (retirou == false) {
            // não deu pra sacar!
            return false;
        }
        else {
            destino.deposita(valor);
            return true;
        }
  }

}

class Usando{
  public static void main(String[] args){
    Conta ponteiro = new Conta();
    Cliente joana = new Cliente();
//Todo objeto java é acessado por uma variável de referência
//Aponta para o endereço de determinado objeto na memória
    ponteiro.titular = joana;
    ponteiro.saldo = 1500.00;

    ponteiro.deposito(150);
    ponteiro.saque(100);
    System.out.println(ponteiro.saldo);

    Conta meuFuturo = new Conta();
    Cliente juan = new Cliente();
    meuFuturo.titular = juan;

    meuFuturo.titular.nome = "Juan Ananda Araújo Rolón"
    meuFuturo.saldo = 30000; //mensalmente


    meuFuturo.saque(3000);
    meuFuturo.deposito(29000);
    meuFuturo.transferencia(ponteiro, 10000);

    System.out.println(meuFuturo.saldo);
  }
}


class Data{
  int dia;
  int mes;
  int ano;

  void preencheData (int dia, int mes, int ano) {
        this.dia = dia;
        this.mes = mes;
        this.ano = ano;
    }
  void getFormatada(){
    System.out.println("Data formatada: " + this.dia + "/" + this.mes + "/" + this.ano)
  }
}

class Funcionario{
  double salario;
  Data dataEntrada = new Data();

  void recebeAumento(double aumento){
    this.salario += aumento;
  }

  double ganhoAnual(){
    return this.salario * 12;
  }

  void mostra(){
    System.out.println("salário: " + this.salario);
    System.out.println("Ganho Anual: " + this.ganhoAnual());
  }
}

class TesteFuncionario{
  public static void main(String[] args){
    Funcionario juan = new Funcionario();
    juan.salario = 23000;
    juan.recebeAumento(1500);
    juan.dataEntrada.preencheData(16,07,2018);

    System.out.println("salario e ganho anual: "+ juan.salario + juan.ganhoAnual());

  }
}


//Arrays
class Empresa{
  String nome;
  int cnpj;
  Funcionario[] funcionarios;
  int contador = 0;

  void adicionaFuncionario(Funcionario f){
    this.funcionarios[this.contador]= f;
    this.contador++;
  }

  void exibeFuncionarios(){
    for (i=0; i < this.funcionarios.length; i++){
      if(this.funcionarios[i] == null) continue;
      System.out.println (this.funcionarios[i]);
    }
  }

  void exibeSalarios(){
    for (i=0; i < this.funcionarios.length; i++){
      if(this.funcionarios[i] == null) continue;
      Funcionario = this.funcionarios[i];
      System.out.println (funcionario.salario);

    }
  }

  boolean contem(Funcionario f){
    for(i=0;i < this.funcionarios.length; i++){
      if(this.funcionarios[i] == null) continue;

      if (this.funcionarios[i] == f){
        return true;
      }

    }
      return false
  }
}

//enhanced for:
for (int x : ponteiroDoArray) {
    System.out.println(x);
}/*No caso de você não ter necessidade de manter uma variável com o
índice que indica a posição do elemento no vetor*/

class TesteEmpresa{
  public static void main(String[] args){
    Empresa illuminationCorp = new Empresa();
    illuminationCorp.funcionarios = new Funcionario[10];// Array cria os valores Default

    illuminationCorp.adicionaFuncionario(funcionarios);

    illuminationCorp.funcionarios[5] = new Funcionario;//Aqui se cria de fato o objeto na posição do array
    illuminationCorp.funcionarios[5].salario = 15000;

  }
}



//modificadores de acesso:
class Conta {
    int numero;
    Cliente titular;
    private double saldo;
    private double limite;


    void saca(double quantidade) {
      if (quantidade <= this.saldo + this.limite)
        this.saldo = this.saldo - quantidade;
    }else{
      System.out.println("saldo insuficiente");
    }
}

class TestaContaEstouro1 {
    public static void main(String args[]) {
        Conta minhaConta = new Conta();
        minhaConta.saldo = 1000.0;//private não são acessiveis dessa forma
        minhaConta.limite = 1000.0;//private não são acessiveis dessa forma
        minhaConta.saca(50000); // saldo + limite é só 2000!!


    }
}

class Funcionario {
  private String nome;
  private double salario;
  private String cargo;

  public String getNome(){
    return this.nome;
  }

  public void setNome(nome){
    this.nome = nome;
  }

  public void setSalario(salario){
    this.salario = salario;
  }

  public double getSalario(){
    return this.salario;
  }

  public void setCargo(cargo){
    this.cargo = cargo;
  }

  public String getCargo(){
    return this.cargo;
  }

  public void recebeAumento(double aumento){
    this.salario += aumento;
  }

  public double getGanhoAnual(){
    return this.salario * 12;
  }

  public void mostra(){
    System.out.println("salário: " + this.salario);
    System.out.println("Ganho Anual: " + this.getGanhoAnual());
  }
}

class TesteFuncionario{
  public static void main(String[] args){
    Funcionario juan = new Funcionario();
    juan.setNome("Juan Ananda");
    juan.setSalario(23000);
    juan.setCargo("Analista de Sistemas");
  }
}



//Construtores:
class Funcionario {
  private String nome;
  private double salario;
  private String cargo;

  public Funcionario(){}
//pode se ter inúmeros contrutores desde que diferentes entre si
  public Funcionario(String nome, double salario, String cargo){
    this.nome = nome;
    this.salario = salario;
    this.cargo = cargo;
  }
}


class Empresa{
  String nome;
  int cnpj;
  Funcionario[] funcionarios;
  int contador = 0;

  public Empresa(int quantidade){
    this.funcionarios = new Funcionario[quantidade];
  }
}



//Atributos e Métodos estáticos
public class Funcionario {
    public String nome;
    private static int proximoFuncionario = 0;
    private int identificador;

    public Funcionario(String nome) {
        this.nome = nome;
        this.identificador = ++proximoFuncionario;
    }

    public int getIdentificador() {
        return this.identificador;
    }
    // restante da classe
}
