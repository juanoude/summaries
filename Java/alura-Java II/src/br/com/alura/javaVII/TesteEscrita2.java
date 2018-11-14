package br.com.alura.javaVII;

import java.io.BufferedWriter;
import java.io.FileWriter;
import java.io.IOException;

public class TesteEscrita2 {
	public static void main(String[] args) throws IOException {

//        FileWriter fw = new FileWriter("lorem3.txt");
//
//        fw.write("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod");
//        fw.write(System.lineSeparator());
//        fw.write("tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam");
//
//        fw.close();
        
		
		//FileWriter fw = new FileWriter("lorem2.txt");
        //BufferedWriter bw = new BufferedWriter(fw);
        BufferedWriter bw = new BufferedWriter(new FileWriter("lorem3.txt"));

        bw.write("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod");
        bw.newLine(); // Agora pode-se usar newline
        bw.write("tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam");

        bw.close();
		 
		
        
    }
}
