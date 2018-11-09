//Revisãozinha
//Percorrendo um array:
class Teste {
    public static void main (String[] args) {
        for(String argumento: args) {
            System.out.println(argumento);
        }
    }
}

class Teste {
    public static void main (String[] args) {
        for(int i = 0; i < args.length; i++) {
            System.out.println(args[i]);
        }
    }
}


//Herança:
class Funcionario {
  private String nome;
  private String cpf;
  private double salario;

  public double getBonus(){
    return this.salario * 0.10;
  }

  public void setSalario(double valor){
    this.salario = valor;
  }
  public double getSalario(){
    return this.salario;
  }
}

class Gerente extends Funcionario{

  public double getBonus(){
    return this.salario * 0.35;//Sobrescreve o método pai
    //return super.getBonificacao() + 1000;// a chave super chama o método pai
  }
}

class TesteGerente{
  public static void main(String[] args){
    Gerente juan = new Gerente;
    juan.setSalario(23000);//métodos do funcionário foram herdados
    System.out.println(gerente.getBonus());//corretamente sobrescrito
  }
}

class Conta{
  protected double saldo;//deixa as classes filhas acessarem

  public double getSaldo(){
    return this.saldo;
  }

  public void deposita(double valor){
    this.saldo += valor;
  }

  public void saca(double valor){
    this.saldo -= valor
  }

  public void atualiza(double taxa){
    this.saldo += taxa * this.saldo;
  }
}

class ContaPoupanca extends Conta{
  public void atualiza(double taxa){
    this.saldo += saldo * (3 * taxa);
  }
}/*para acessar o atributo saldo herdado da classe Conta, você vai
precisar trocar o modificador de visibilidade de saldo para protected.*/

class ContaCorrente extends Conta{
  public void atualiza(double taxa){
    this.saldo += saldo * (2 * taxa);
  }
}

class AtualizadorDeContas {
    private double saldoTotal = 0;
    private double selic;

    public AtualizadorDeContas(double selic) {
        this.selic = selic;
    }

    public void roda(Conta c) {
        System.out.println("===============================");
        System.out.println("Saldo anterior: " + c.getSaldo());
        c.atualiza(this.selic);
        System.out.println("Saldo atualizado: " + c.getSaldo());
        this.saldoTotal += c.getSaldo();
    }

    public double getSaldoTotal() {
        return this.saldoTotal;
    }
}

public class TestaAtualizadorDeContas {

    public static void main(String[] args) {
        Conta c = new Conta();
        Conta cc = new ContaCorrente();
        Conta cp = new ContaPoupanca();

        c.deposita(1000);
        cc.deposita(1000);
        cp.deposita(1000);

        AtualizadorDeContas adc = new AtualizadorDeContas(0.01);

        adc.roda(c);
        adc.roda(cc);
        adc.roda(cp);

        System.out.println("Saldo Total: " + adc.getSaldoTotal());
    }
}
