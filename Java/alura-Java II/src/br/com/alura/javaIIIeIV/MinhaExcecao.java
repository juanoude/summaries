package br.com.alura.javaIIIeIV;

public class MinhaExcecao extends Exception { //checked, ou seja, é checada pelo compilador. Já RuntimeException é unchecked.

	public MinhaExcecao(String msg) {
	    super(msg);
	}
	
}
