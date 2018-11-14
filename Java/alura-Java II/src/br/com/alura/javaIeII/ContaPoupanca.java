package br.com.alura.javaIeII;

public class ContaPoupanca extends Conta {

	public void deposita(double valor) {
		this.saldo += valor - 0.1;
	}

	public void atualiza(double taxa) {
		this.saldo += saldo * (taxa * 3);
	}
}
