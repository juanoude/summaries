package br.com.alura.javaVII;

import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;

public class TesteSerializacao2 {
	public static void main(String[] args) throws IOException, ClassNotFoundException {
		
		/*
		 * A classe seriarizable pode estar apenas na classe mãe;
		 * Ao criar o serial ID se cria um controle de versão da classe/arquivo
		 * para garantir compatibilidade;
		 * Se uma classe compões os atributos de outra ou for chamada, também deve 
		 * implementar serializable ou ser excluida da serialização(será null);
		 */
		
//		Cliente cliente = new Cliente();
//		cliente.setNome("Juan Ananda");
//		cliente.setProfissao("Alta Performance");
//		cliente.setCpf("2321345252");
//		
//		ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("cliente.bin"));
//		oos.writeObject(cliente);
//		oos.close();
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("cliente.bin"));
		Cliente cliente = (Cliente) ois.readObject();
		ois.close();
		System.out.println("nome: " + cliente.getNome() + ", Profissão: " + cliente.getProfissao());
		
		

	}
}
