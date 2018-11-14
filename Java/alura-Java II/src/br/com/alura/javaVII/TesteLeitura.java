package br.com.alura.javaVII;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.io.InputStreamReader;

public class TesteLeitura{
	public static void main(String[] args) throws IOException {
		
		/* O FileInputStream é filho da classe InputStream, 
		 * as quais representam stream de bytes de entrada. */
		FileInputStream fis = new FileInputStream("lorem.txt"); //É checked
		
		/* A Classe InputStream reader é filha de Reader,
		 * que pega a leitura  em bytes e traduz para caracteres. 
		 * porém é capaz de ler apenas um caracter */
		InputStreamReader isr = new InputStreamReader(fis);
		
		/*O BufferedReader é capaz de pegar um isr e traduzi-lo
		 * em linhas de caracteres. Deve ser fechado*/
		BufferedReader br = new BufferedReader(isr);
		
		String linha = br.readLine();
		
		while (linha != null) {
			System.out.println(linha);
			linha = br.readLine();
		}
		
		br.close();
		
	}
}
