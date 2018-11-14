package br.com.alura.javaVII;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.Reader;
import java.io.Writer;

public class TesteCopia {

	public static void main(String[] args) throws IOException {
		
		//Socket s = new Socket;

		InputStream fis = System.in; //new FileInputStream("lorem.txt");	// s.getInputStream();
		Reader isr = new InputStreamReader(fis);		
		BufferedReader br = new BufferedReader(isr);
				
		OutputStream fos = System.out; //new FileOutputStream("lorem2.txt"); // s.getOutputStream();
		Writer osw = new OutputStreamWriter(fos);
		BufferedWriter bw = new BufferedWriter(osw);
		
		String linha = br.readLine();
					
	//Nota-se que independente do tipo de entrada e saída o mesmo código roda limpo
		while (linha != null && !linha.isEmpty()) {
			bw.write(linha);
			bw.newLine();
			//bw.flush();
			linha = br.readLine();
		}
					
		br.close();
		bw.close();
	}

}
