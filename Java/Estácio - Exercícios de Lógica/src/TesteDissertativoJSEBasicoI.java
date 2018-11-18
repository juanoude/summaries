import javax.swing.JOptionPane;

import TesteJSE.Professor;
import TesteJSE.ProfessorAssistente;
import TesteJSE.ProfessorAssociado;

public class TesteDissertativoJSEBasicoI {
	public class Professor {
		private String nome;
		private int horasAula;
		private double valorHoraAula = 55.00;
		/* protected double valorHoraAula = 55.00;
		 * Como no enunciado disse, devidamente encapsulado, então não usei a solução acima de usar 
		 * protected em todas as classes, acredito o objetivo do exercício seja uma solução via métodos.
		 */
		
		public Professor(String nome, int horasAula) {
			this.nome = nome;
			this.horasAula = horasAula;
		}
		
		public void setValorHoraAula(double valorHoraAula) {
			this.valorHoraAula = valorHoraAula;
		}
		
		public String getNome() {
			return this.nome;
		}
		
		public double calcularSalario() {
			return (double)horasAula * valorHoraAula;
		}
		
		public String getSalario() {
			return "O salário do Professor "+ getNome() + ",é: \n R$ " + calcularSalario() + " reais";
		}
	}
	
	public class ProfessorAssistente extends Professor {

		public ProfessorAssistente(String nome, int horasAula) {
			super(nome, horasAula);
			setValorHoraAula(60.00);
			//valorHoraAula = 60.00; solução alternativa (má prática);
		}
	}
	
	public class ProfessorAssociado extends Professor{

		public ProfessorAssociado(String nome, int horasAula) {
			super(nome, horasAula);
			setValorHoraAula(80.00);
			//valorHoraAula = 80.00; solução alternativa (má prática);
		}
	}
	
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

}
