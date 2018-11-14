package br.com.alura.javaIIIeIV;

public class TesteGenrente {

	public static void main(String [] args) {
		Gerente g1 = new Gerente();
		g1.setNome("João");
		g1.setCpf("045.424.255-24");
		g1.setSalario(6000);
		g1.setSenha(1234);
		
		System.out.println(g1.getNome());
		System.out.println(g1.getCpf());
		System.out.println(g1.getSalario());
		System.out.println(g1.autentica(2345));
	}
}
