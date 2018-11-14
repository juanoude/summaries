package br.com.alura.javaVII;

import java.io.IOException;
import java.io.PrintStream;
import java.io.PrintWriter;

public class TesteEscrita3 {
	public static void main(String[] args) throws IOException {

        //PrintStream ps = new PrintStream("lorem3.txt");
        PrintWriter pw = new PrintWriter("lorem3.txt");

        pw.println("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod");
        pw.println("tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam");

        pw.close();
    }
}
