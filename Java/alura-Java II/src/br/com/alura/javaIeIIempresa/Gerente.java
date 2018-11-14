package br.com.alura.javaIeIIempresa;

class Gerente extends Funcionario implements Autenticavel{

	int senha;
	
	public double getBonificacao() {
		return this.salario * 1.4 + 1000;
	}
	
	public boolean login(int senha) {
		if (this.senha != senha) {
			return false;
		}
		
		return true;
	}
}
