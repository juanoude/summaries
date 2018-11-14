package br.com.alura.javaIeII;

public class TestaError {
	public static void main(String[] args) {
		String[] ss = new String[Integer.MAX_VALUE];
	}
}
//Forçando um erro de memoria da JVM
//É um erro e não uma exception