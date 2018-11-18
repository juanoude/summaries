package TesteJSE;

public class ProfessorAssociado extends Professor{

	public ProfessorAssociado(String nome, int horasAula) {
		super(nome, horasAula);
		setValorHoraAula(80.00);
		//valorHoraAula = 80.00; solução alternativa (má prática);
	}
	

}
