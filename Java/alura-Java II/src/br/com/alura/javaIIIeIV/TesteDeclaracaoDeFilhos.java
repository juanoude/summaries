package br.com.alura.javaIIIeIV;

public class TesteDeclaracaoDeFilhos {

	public static void main(String[] args) {
		// Quando se declara assim, não funciona pois nem todo funcionário é um gerente.
		Gerente g1 = new Funcionario();

		// Já o contrário funciona, porém existe uma peculiaridade:
		Funcionario g1 = new Gerente();
		// Se ao declarar tal instancia eu fizer:
		g1.setSenha(2222);
        g1.autentica(2222);
        // Não funcionará porque a referencia é Funcionario, assim, o compilador encara ele como se fosse o próprio...
        
        /*
         *  Isso também é chamado de polimorfismo, pois são duas formas diferentes de se chegar a um mesmo objeto Gerente.
         */
	}

}
