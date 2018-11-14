package br.com.alura.javaIeII;

public class TesteConta {
	public static void main(String[] args) {
		Conta c = new ContaCorrente();
		
		c.deposita(190);
		try {
			c.saca(599);
		}catch(RuntimeException e){
			System.out.println("Saldo Insuficiente");
		}
		
        try {
            c.deposita(-100);
        } catch (IllegalArgumentException e) {
            System.out.println("Você tentou depositar um valor inválido");
        }
        
		System.out.println(c.getSaldo());
	}
}