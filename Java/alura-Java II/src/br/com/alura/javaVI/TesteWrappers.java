package br.com.alura.javaVI;

import java.util.ArrayList;
import java.util.List;

public class TesteWrappers {

	public static void main(String[] args) {
		
		/*
		 * java.lang.Numbers é pai de todos os doubles e inteiros:
		 * double - 8 bytes;
		 * float - 4 bytes;
		 * long - 8 bytes;
		 * int - 4 bytes;
		 * short - 2 bytes;
		 * byte - 1 bytes;
		 * ====================================
		 * char - 2 bytes
		 * ====================================
		 * boolean - 2 bytes
		 * 
		 * Todas são java.lang
		 * ====================================
		 * A existência de primitivos e wrappers é explicada pelo momento da criação do Java, 
		 * à época, a capacidade de processamento das máquinas era limitado, e a memória era 
		 * custosa, portanto, pensando em questões de desempenho, e memória, importante a 
		 * existência dos primitivos. Eles são mais rápidos, e ocupam menos espaço.
		 * Hoje, isso não é mais um problema, sua existência se justifica apenas 
		 * historicamente, como um legado.
		 */
		
		//os TP's também são classes:
		
		Integer iNum = Integer.valueOf(24); //autoboxing
		System.out.println(iNum.intValue()); //unboxing
		
		Boolean iBoo = Boolean.FALSE; //autoboxing
		System.out.println(iBoo.booleanValue()); //unboxing
		
		Double iDou = Double.valueOf(24); //autoboxing
		System.out.println(iDou.doubleValue()); //unboxing
		
		Integer iRef = new Integer(29);// forma obsoleta de autoboxing
		
		Integer iNum2 = 25; // Forma enxuta com unboxing implícito
		
		//------------------------------------------------------
		
		int[] idades = new int[5]; //Array de tipos primitivos.
		
		String[] nomes = new String[5]; // Array de referencias.
		
		
		//Listas por sua vez, aceitam apenas referencias a objetos também.
		int idade = 29;
        List numeros = new ArrayList();
        numeros.add(idade);/* essa linha só compila porque o compilador faz um autoboxing implícito.
        ou seja, faz isso : coloca o tipo primitivo no wrapper
        respectivo, são classes que embrulham tipos primitivos.
        O autoboxing também aceita strings e faz o parsing implicitamente*/
		
        
        //-------------------------------------------------------------------------
        System.out.println(Integer.MAX_VALUE);
        System.out.println(Integer.MIN_VALUE);

        System.out.println(Integer.SIZE);
        System.out.println(Integer.BYTES);
        
	}

}
