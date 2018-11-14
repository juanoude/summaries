package br.com.alura.javaV;

public class TesteString {

	public static void main(String[] args) {

		
		String nome = "Alura"; //Object literal
		
		//String outro = new String("Alura"); // Má prática
		
        nome.replace("A", "a");
        //Cada instancia da classe String é imutável.
        nome.toLowerCase();
        
        String outra = nome.replace("A", "a");
        //Para modificá-la deve-se criar outra instancia.
        String outra2 = nome.toLowerCase();

        System.out.println(nome);
        System.out.println(outra);
        System.out.println(outra2);
        
        char c = nome.charAt(2);
        System.out.println(c);
        
        int pos = nome.indexOf("ur");
        System.out.println(pos);
        
        String sub = nome.substring(1);
        System.out.println(sub);
        
        System.out.println(nome.length());
        
        for(int i = 0; i < nome.length(); i++) {
            System.out.println(nome.charAt(i));
        }
        
        String vazio = "";
        System.out.println(vazio.isEmpty());
        
        String aparar ="    Al      ura    ";
        String aparado = aparar.trim(); 

        System.out.println(aparar);
        System.out.println(aparado);
        
        System.out.println(aparar.contains("Alu"));
        System.out.println(aparar.contains("ura"));
        
        
		// A classe String implementa a interface CharSequence
        //até poderìamos declarar a variável com o tipo da interface, mas isso é raro de se ver:
        CharSequence seq = "é uma sequencia de caracteres";
        
        /*
         * a classe String é especial pois gera objetos imutáveis. Isso é considerado 
         * benéfico pensando no design mas é ruim pensando no desempenho(e por isso 
         * devemos usar aspas duplas na criação, pois a JVM quer contornar os problemas 
         * no desempenho com otimizações).
         */
        
        
        //Imagina ter que concatenar um texto enorme, concatenando muitas Strings:
        String texto = "Socorram";
        texto = texto.concat("-");
        texto = texto.concat("me");
        texto = texto.concat(", ");
        texto = texto.concat("subi ");
        texto = texto.concat("no ");
        texto = texto.concat("ônibus ");
        texto = texto.concat("em ");
        texto = texto.concat("Marrocos");
        System.out.println(texto);
        /*
         * Nesse pequeno exemplo já criamos vários objetos, só porque estamos 
         * concatenando algumas Strings. Isso é nada bom pensando no desempenho 
         * e para resolver isso existe a classe StringBuilder que ajuda na 
         * concatenação de Strings de forma mais eficiente.
         */
        
        //Mesmo código usando o string builder:
        StringBuilder builder = new StringBuilder("Socorram");
        builder.append("-");
        builder.append("me");
        builder.append(", ");
        builder.append("subi ");
        builder.append("no ");
        builder.append("ônibus ");
        builder.append("em ");
        builder.append("Marrocos");
        String textoFinal = builder.toString();
        System.out.println(textoFinal);
        
        
        
        //StringBuilder também implementa a interface CharSequence:
        CharSequence cs = new StringBuilder("também é uma sequencia de caracteres");
        
        //Isso faz que alguns métodos da classe String saibam trabalhar com o StringBuilder, por exemplo:
        String name = "ALURA";
        CharSequence cs2 = new StringBuilder("al");

        name = name.replace("AL", cs2);

        System.out.println(name);
        
        
        
	}

}
