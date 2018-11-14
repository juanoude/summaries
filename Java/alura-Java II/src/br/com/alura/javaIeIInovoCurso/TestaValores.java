package br.com.alura.javaIeIInovoCurso;

public class TestaValores {
	public static void main(String[] args) {
		int primeiro = 5;
		int segundo = 7;
		segundo = primeiro;
		primeiro = 10;
/* Quando se faz uma atribuição numa variável de tipo 
 * primitivo, apenas se tranfere o valor respectivo, 
 * não declara uma dependencia contínua.*/

		System.out.println(segundo);
	}
}

