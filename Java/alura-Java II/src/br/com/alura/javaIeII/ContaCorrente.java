package br.com.alura.javaIeII;

public class ContaCorrente extends Conta implements Tributavel{

	public void atualiza(double taxa) {
		this.saldo += saldo * (taxa * 2);
	}
	
    public double calculaTributos() {
        return this.getSaldo() * 0.01;
    }

}
