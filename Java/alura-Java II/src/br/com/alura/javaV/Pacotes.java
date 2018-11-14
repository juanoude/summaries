package br.com.alura.javaV;
	/**
	 * O comentário de dois asteriscos é o comentario voltado a outra equipe de desenvolvimento,
	 * ao utilizá-lo em cima de qualquer elemento public...
	 * Há a aba javadoc para visualizar-los de forma mais estruturada e
	 * em "Project -> Generate Javadoc" cria-se uma página html documental do projeto.
	 * @author juano_000
	 *
	 */

public class Pacotes {
	
	/*
	 * FQN = Full Qualifyed Name = nome-do-pacote.nome-da-classe
	 * Pacotes organizam o código através dos nomes únicos de seus domínios respectivos
	 * Pode-se importar todos arquivos através do "*", porém importar cada classe resulta em um código mais legivél, explicito e
	 * esclarecedor (convenção/boa prática) <<Ctrl + Shift + O>>.
	 * O modificador de acesso default também é denominado package private.
	 */
	
	/**
	 * Descrição documental aqui...
	 * @param msg
	 */
	public void testeDocs(String msg){
		System.out.println("Testando o javadoc : " + msg);
	}
}
