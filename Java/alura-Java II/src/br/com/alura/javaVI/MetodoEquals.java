package br.com.alura.javaVI;

import java.util.ArrayList;

import br.com.alura.javaIeII.Conta;
import br.com.alura.javaIeII.ContaCorrente;

public class MetodoEquals {
	
	public static void main(String[] args) {
		
		/*
		 * O método equals é um método da classe object que foi projetado para comparar
		 * equivalencia de objetos de acordo com uma regra de négocio;
		 * No código original ele compara apenas as referências,
		 * O .contains() faz um laço dentro de toda a lista utilizando o equals();
		 * 
		 */
		
		ArrayList<Conta> lista = new ArrayList<Conta>();

        Conta cc = new ContaCorrente();
        lista.add(cc);

        Conta cc2 = new ContaCorrente();
        lista.add(cc2);

        boolean existe = lista.contains(cc2);// compara as referencias, ignorando o conteúdo do objeto;

        System.out.println("Já existe? " + existe);

     // o que o contains faz equivale ao seguinte loop:
        for(Conta conta : lista) {
                if (conta == cc2) {
                	System.out.println("Já tenho essa conta");
                }
        }
        
     //porém o método deveria ser de acordo com a regra de negócio:
//        @Override
//        public boolean equals(Object ref) {
//
//            Conta outra = (Conta) ref;
//
//            if(this.agencia != outra.agencia) {
//                return false;
//            }
//
//            if(this.numero != outra.numero) {
//                return false;
//            }
//
//            return true;
//        }
//
//	    for(Conta conta : lista) {
//          if(conta.ehIgual(cc3)) {
//              System.out.println("Já tenho essa conta!");
//          }
//      }
                    
        /*
         * Sobrescrevendo o equals o contains roda de acordo com a RN sem problemas
         * 
         */
		
	}
	
}
