package br.com.alura.javaIIIeIV;

public class Gerente extends Funcionario{
	
	
	public Gerente() {
		super();
	}
	//declarando contrutores padrões e especificos nos filhos...
	public Gerente(String nome, String cpf, int salario) {
		super(nome, cpf, salario);
	}
	
	@Override
	public double getBonificacao() {
		return super.getSalario();
	}
}
