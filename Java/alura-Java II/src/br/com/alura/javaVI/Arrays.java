package br.com.alura.javaVI;
import br.com.alura.javaIeII.*;

public class Arrays {

	public static void main(String[] args) {
		
		//Como arrays são objetos, devem ser inicializados/instanciados;
		int [] idades = new int [5];// nesse momento aloca 5 espaços com o valor 0
		
		idades[0] = 3;
		idades[1] = 4;
		idades[2] = 5;
		idades[3] = 6;
		idades[4] = 7;
		
		
		for (int i = 0; i < idades.length; i++) {
			idades[i] = i * i + (2 * i);
			System.out.println(idades[i]);
		}
		
		
		ContaCorrente contas[] = new ContaCorrente[5]; // Isso cria uma array, aloca com 5 espaços NULL
		
		ContaCorrente c1 = new ContaCorrente();
		contas[0] = c1; //Deve-se criar uma instância e refenciar tal objeto no array
		
		ContaCorrente c2 = new ContaCorrente();
		contas[1] = c2;
		
		ContaCorrente c3 = new ContaCorrente();
		contas[2] = c3;
		
		System.out.println(c1);
		System.out.println(contas[0]);
		
		ContaCorrente ref = c1;
		System.out.println(ref);
		
		ref = new ContaCorrente();
// Ao alterar uma das variaveis as outras permanecem intactas, pois é uma cópia de uma mera referência;
		System.out.println(c1);// O objeto permanece intocado;
		System.out.println(contas[0]);
		System.out.println(ref);
		
		int[] refs = {1,2,3,4,5};// forma literal de declarar arrays;
		System.out.println(refs[1]);
		
		/*
		 * Um array do tipo conta aceita seus filhos como preenchimento
		 * Porém as referências respeitam a coerencia comum...
		 * 
		 * Ex:
		 * Conta[] contas = new Conta[5];
		 * ContaPoupanca cc2 = new ContaPoupanca(22, 22);
		 * contas[1] = cc2;
		 * 
		 * ContaCorrente ref = contas[1];
		 * Não funcionará pois referencia CC com valor CP
		 * 
		 * Também há como fazer casting de classes
		 * E uma referencia genérica sem o método especifico invalida o método
		 * a não ser que use casting.
		 * 
		 * O Array String [] args serve para passar parâmetros na execução de um main.
		 */
		
	}
	
}
