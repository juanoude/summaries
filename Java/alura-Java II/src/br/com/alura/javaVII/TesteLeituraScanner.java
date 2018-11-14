package br.com.alura.javaVII;

import java.io.File;
import java.io.FileNotFoundException;
import java.util.Locale;
import java.util.Scanner;

public class TesteLeituraScanner {
	public static void main(String[] args) throws FileNotFoundException {
		
		Scanner scanner = new Scanner(new File("contas.csv"));
		
		while(scanner.hasNextLine()) {
			String linha = scanner.nextLine();
			//System.out.println(linha);
			
			Scanner linhaScanner = new Scanner(linha);
			linhaScanner.useLocale(Locale.US);// para reconhecer os doubles com "."
			linhaScanner.useDelimiter(",");
			
			String tipoconta = linhaScanner.next();
			int agencia = linhaScanner.nextInt();
			int conta = linhaScanner.nextInt();
			String titular = linhaScanner.next();
			double saldo = linhaScanner.nextDouble();
			
			//mesmo sem locale meu decimal fica separado por vírgulas.
			String valorFormatado = String.format(new Locale("pt", "BR"), "%s - %04d-%08d, %15s: %8.2f", tipoconta, agencia, conta,  titular,  saldo);
			System.out.println(valorFormatado);
		}
		
		scanner.close();
	}
}
