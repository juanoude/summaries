package TesteJSE;

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
