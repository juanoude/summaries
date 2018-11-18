package TesteJSE;

import javax.swing.JOptionPane;

public class Principal {

	public static void main(String[] args) {
		
		Professor professor1 = new Professor("João da Silva", 10);
		JOptionPane.showMessageDialog(null, professor1.getSalario());
		
		Professor professor2 = new ProfessorAssistente("Joãozinho Silveira", 10);
		JOptionPane.showMessageDialog(null, professor2.getSalario());
		
		Professor professor3 = new ProfessorAssociado("Joãozão Silvino", 10);
		JOptionPane.showMessageDialog(null, professor3.getSalario());

	}

}
