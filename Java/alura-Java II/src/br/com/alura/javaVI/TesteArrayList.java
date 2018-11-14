package br.com.alura.javaVI;

import br.com.alura.javaIeII.*;
import java.util.ArrayList;//Deve-se importar do java util

public class TesteArrayList {
	public static void main(String[] args) {
	
		//O array list é uma classe para utilizar arrays numa linguagem mais familiar(Adapter Oficial do Java);
		ArrayList<Conta> lista = new ArrayList<Conta>();
		/*
		 *  O Generics "<>" especifica o tipo das referencias no array. Benefícios:
		 *  Código mais legível, já que fica explícito o tipo dos elementos.
		 *  Evitar casts excessivos.
		 *  Antecipar problemas de casts no momento de compilação.
		 */
		
        Conta cc = new ContaCorrente();
        lista.add(cc);

        Conta cc2 = new ContaCorrente();
        lista.add(cc2);
        
        System.out.println("Tamanho: " + lista.size());
        
        //Conta ref = (Conta) lista.get(0); 
        //transformar o tipo mais genérico em específico, ou seja, necessita de type cast
        Conta ref = lista.get(0);//Porém com o generics "<>" o cast é dispensável
        System.out.println(ref);
		
        lista.remove(0);

        System.out.println("Tamanho: " + lista.size());
		
        Conta cc3 = new ContaCorrente();
        lista.add(cc3);

        Conta cc4 = new ContaCorrente();
        lista.add(cc4);
        
        
        for(int i = 0; i < lista.size(); i++) {
            Conta oRef = lista.get(i);
            System.out.println(oRef);
        }
        
        System.out.println("----------");

        for(Conta i : lista) {
            System.out.println(i);
        }
        
	}
}
