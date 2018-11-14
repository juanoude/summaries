package br.com.alura.javaIIIeIV;

public class ControleBonificacao {
	private double soma;
	
	public void registra(Funcionario f) {
		this.soma += f.getBonificacao();
	}
	/*
	 *  ao criar um método com o funcionário de parâmetro, o método utilizado respeitará a herança, ou seja,
	 *  ao colocar um gerente de parâmetro, o getBonificacao será do próprio gerente e não da superclasse.
	 */
}


