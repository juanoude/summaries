package br.com.alura.javaIeIInovoCurso;

public class TesteCharString {

	public static void main(String[] args) {
		
        char letra = 'a';//exige aspas simples;
        System.out.println(letra);
        
        
        char valor = 66;
        System.out.println(valor);
        
        valor = valor + 1;
        System.out.println(valor);
        //ele enxerga 1 como int, pede casting, portanto:
        valor = (char) (valor + 1);
        System.out.println(valor);
        
        String palavra = "alura cursos online de tecnologia";//aspas duplas.
        System.out.println(palavra);
        
        palavra = palavra + 2020;//Isto nos retornará alura cursos online de tecnologia2020;
        System.out.println(palavra);//String não se comporta como int ou char
        
        
	}
}

