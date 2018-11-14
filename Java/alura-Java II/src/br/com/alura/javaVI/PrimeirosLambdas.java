package br.com.alura.javaVI;

import java.util.ArrayList;
import java.util.Collections;
import java.util.Comparator;
import java.util.List;

import br.com.alura.javaIIIeIV.Funcionario;

public class PrimeirosLambdas {
	public static void main(String[] args) {
		
		System.out.println("----------------------------");
		
		List<String> nomes = new ArrayList<>();
		nomes.add("Super Mario");
		nomes.add("Yoshi"); 
		nomes.add("Donkey Kong"); 
		
		nomes.sort( (s1,s2) -> s1.length() - s2.length() );

//		Collections.sort(nomes, new Comparator<String>() {
//
//		    @Override
//		    public int compare(String s1, String s2) {
//		        return s1.length() - s2.length();
//		    }
//		});
		
		nomes.forEach( (nome) -> System.out.println(nome) );
		
		
		Comparator<Funcionario> comp = (f1, f2) -> {
			String nome1 = f1.getNome();
			String nome2 = f2.getNome();
			
			return nome1.compareTo(nome2);
		};
		
//		Comparator<Funcionario> comp = new Comparator<Funcionario> {
//
//		    @Override
//		    public int compare(Funcionario c1, Funcionario c2) {
//		        String nomeC1 = c1.getTitular().getNome();
//		        String nomeC2 = c2.getTitular().getNome();
//		        return nomeC1.compareTo(nomeC2);
//		    }
//		};
		
		
	}
}
