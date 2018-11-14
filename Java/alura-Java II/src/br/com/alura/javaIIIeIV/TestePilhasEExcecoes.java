package br.com.alura.javaIIIeIV;

public class TestePilhasEExcecoes {
	
	//Uma pilha de execução é onde se guarda as linhas que ainda deverão ser executadas posteriormente. 
    public static void main(String[] args) {
    	
    	
        System.out.println("Ini do main");
        
       try {
    	   metodo1();
       }catch (ArithmeticException | NullPointerException ex){
    	   String msg = ex.getMessage();
    	   System.out.println("exception " + msg);
    	   ex.printStackTrace();
       }// Quando uma exceção ocorre, o compilador vai removendo método por método até encontrar a linha de código de tratamento
        // Caso ela não exista a execução simplesmente não prossegue. Se existe tratamento, continua a execução a partir dele.
        
        System.out.println("Fim do main");
    }

    private static void metodo1() {
        System.out.println("Ini do metodo1");
        metodo2();
        System.out.println("Fim do metodo1");
    }

    private static void metodo2() {
        System.out.println("Ini do metodo2");
        for(int i = 1; i <= 5; i++) {
            System.out.println(i);
            int a = i / 0;
            Funcionario c = null;
            c.getNome();
        }
        
        System.out.println("Fim do metodo2");        
    }
}
