package br.com.alura.javaVI;
import br.com.alura.javaIeII.*;

public class ContrutorDeArray {

	private Conta[] contas;
	private int contador;
	
	public ContrutorDeArray() {
		this.contas = new Conta[10];
		this.contador = 0;
	}
	
	public void adiciona(Conta ref) {
		this.contas[contador] = ref;
		this.contador++;
	}
	
	public int getQuantidade() {
        return this.contador;
    }
	
	public Conta getReferencia(int pos) {
        return this.contas[pos];
    }
	
}
