package br.com.alura.javaIIIeIV;

public class ExemploPraticoCatch {
	public static void main(String[] args) {
		
		//Apenas um exemplo pois não quis criar a respectiva classe
		
		public void saca(double valor) throws SaldoInsuficienteException{

	        if(this.saldo < valor) {
	            throw new SaldoInsuficienteException("Saldo: " + this.saldo + ", Valor: " + valor);
	        } 

	        this.saldo -= valor;       
	        
		}
	
	   public void transfere(double valor, Conta destino) throws SaldoInsuficienteException{
	            this.saca(valor); 
	            /*
	             * Como o método já tem um exception que interrompe a execução em caso de erro
	             * Não é necessário uma estrutura de decisão extra nesse método.
	             */
	            destino.deposita(valor);
	   }

	}
	
}