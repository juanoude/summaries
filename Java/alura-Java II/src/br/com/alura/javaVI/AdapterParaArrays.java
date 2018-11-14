package br.com.alura.javaVI;
import br.com.alura.javaIeII.*;

public class AdapterParaArrays {

	public static void main(String[] args) {
		
		ContrutorDeArray construtor = new ContrutorDeArray();
		
		Conta cc1 = new ContaCorrente();
		construtor.adiciona(cc1);
		
		Conta cc2 = new ContaCorrente();
		construtor.adiciona(cc2);

		System.out.println(construtor.getQuantidade());
		System.out.println(construtor.getReferencia(0));
		
		/*
		 * Desvantagens do array:
		 * Não há como saber a quantidade de posições;
		 * Não cresce dinamicamente (tamanho fixo);
		 * Sintaxe fora do padrão OO Java;
		 */
		
	}
}
