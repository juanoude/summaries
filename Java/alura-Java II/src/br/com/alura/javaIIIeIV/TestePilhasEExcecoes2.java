package br.com.alura.javaIIIeIV;

public class TestePilhasEExcecoes2 {
	
    public static void main(String[] args) {
    	
    	
    //É possível fabricar exceções, criando um objeto e lançando-o.
        System.out.println("Ini do main");
        
       try {
    	   metodo1();
       }catch (ArithmeticException | NullPointerException ex){
    	   String msg = ex.getMessage();
    	   System.out.println("exception " + msg);
    	   ex.printStackTrace();
       }
        
        System.out.println("Fim do main");
    }

    private static void metodo1() {
        System.out.println("Ini do metodo1");
        metodo2();
        System.out.println("Fim do metodo1");
    }

    private static void metodo2() {
        System.out.println("Ini do metodo2");
     
        //throw new ArithmeticException("deu errado"); essa forma é mais enxuta e comum...
        
        ArithmeticException ex = new ArithmeticException("insira sua message aqui");
        throw ex;
        //Assim se forja uma bomba a ser tratada...
        
        //System.out.println("Fim do metodo2");        
    }
}
