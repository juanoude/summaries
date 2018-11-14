package br.com.alura.javaVII;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;

public class TesteSerializacao {
	public static void main(String[] args) throws FileNotFoundException, IOException, ClassNotFoundException {
		
		/*
		 * A transformação do objeto em um fluxo binário é chamada de serialização.
		 * A criação de um objeto a partir de um fluxo binário de dados é chamada de deserialização.
		 */
		
//		String nome = "Juan Ananda";
//		ObjectOutputStream oos = new ObjectOutputStream(new FileOutputStream("TesteSerial1.bin"));
//		oos.writeObject(nome);
//		oos.close();
		
		ObjectInputStream ois = new ObjectInputStream(new FileInputStream("TesteSerial1.bin"));
		String nome = (String) ois.readObject();
		ois.close();
		System.out.println(nome);
		
		
	}
}
