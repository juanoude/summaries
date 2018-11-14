package br.com.alura.javaVII;

import java.io.UnsupportedEncodingException;
import java.nio.charset.Charset;
import java.nio.charset.StandardCharsets;

public class TesteEncoding {
	public static void main(String[] args) throws UnsupportedEncodingException {
		
		String c = "C";
		
		System.out.println(c.codePointAt(0)); // código unicode do caracter
		
		Charset charset = Charset.defaultCharset();
		System.out.println(charset.displayName());
		
		byte[] bytes = c.getBytes("UTF-8");
		System.out.println(bytes.length + ", windows-1252");
		String cNova = new String(bytes, "windows-1252");//Aparentemente compatíveis
		System.out.println(cNova);
		
		bytes = c.getBytes("UTF-16");
		System.out.println(bytes.length + ", UTF-16");
		cNova = new String(bytes, "windows-1252");//incompatíveis
		System.out.println(cNova);
		
		c = "Ç";
		bytes = c.getBytes(StandardCharsets.US_ASCII);
		System.out.println(bytes.length + ", US_ASCII");
		cNova = new String(bytes, "windows-1252");
		System.out.println(cNova);
		
		

//É possível alterar o encoding do arquivo para o abrir - Rclick -> Properties -> Text File Encoding.
    
		//Scanner scanner = new Scanner(new File("contas.csv"), "UTF-8");
    
		//Reader isr = new InputStreamReader(fis, "UTF-8");
    
		//PrintWriter pw = new PrintWriter("lorem2.txt", "UTF-8");
    
		
	}
}
