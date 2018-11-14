package br.com.alura.javaVI;

import java.util.ArrayList;
import java.util.Comparator;
import java.util.List;

import br.com.alura.javaIIIeIV.Funcionario;
import br.com.alura.javaIIIeIV.Gerente;

public class ClassesAnonimas {

	public static void main(String[] args) {
		
		Funcionario f1 = new Gerente();
		f1.setNome("Jimizim");

		Funcionario f2 = new Gerente();
		f2.setNome("Anildo");

		Funcionario f3 = new Gerente();
		f3.setNome("Jovilson");

		Funcionario f4 = new Gerente();
		f4.setNome("Raikagão");

		List<Funcionario> lista2 = new ArrayList<>();
		lista2.add(f1);
		lista2.add(f2);
		lista2.add(f3);
		lista2.add(f4);
		
		for(Funcionario funcionario: lista2) {
			System.out.println(funcionario.getNome());
		}
		
		System.out.println("----------------------------");
		
		
		//Funcion Object - É o objeto que só encapsula uma função/método/procedimento
		//Classes Anonimas auxiliam na implementação desses objetos
		
		//Classe anônima:
		lista2.sort(new Comparator<Funcionario>() {
			@Override
			public int compare(Funcionario f1, Funcionario f2) {
				String nome1 = f1.getNome();
				String nome2 = f2.getNome();
				
				return nome1.compareTo(nome2);
			}
		}); //Cria-se direto o Comparator
		
		
		
		for(Funcionario funcionario: lista2) {
			System.out.println(funcionario.getNome());
		}
		
	}
	
}
