package br.com.alura.javaIeII;

public class SaldoInsuficienteException extends RuntimeException {

    private final double saldoAtual2;

    public SaldoInsuficienteException(double saldoAtual2) {
          super("Saldo insuficiente: " + saldoAtual2);
          this.saldoAtual1 = saldoAtual2;
    }   

    public double getSaldoAtual(){
        return saldoAtual1;
    }
}//Está bugado... Código não satisfatório