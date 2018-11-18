package TesteJSE;

public class ProfessorAssistente extends Professor {

	public ProfessorAssistente(String nome, int horasAula) {
		super(nome, horasAula);
		setValorHoraAula(60.00);
		//valorHoraAula = 60.00; solução alternativa (má prática);
	}
}
