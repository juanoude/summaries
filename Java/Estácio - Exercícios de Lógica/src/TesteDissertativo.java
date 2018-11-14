
import java.util.Random;

public class TesteDissertativo {
	public static void main(String[] args) {
		int i, j, soma_ano, semana_maior, mes_maior, maior_producao;
		int matriz[][] = new int[4][12];
		int soma_mes[] = {0,0,0,0,0,0,0,0,0,0,0,0};
		String mes[] = {"Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"};
		String semana[] = {"Primeira","Segunda","Terceira","Quarta"};
		
		Random gerador = new Random();
		
		for(i=0; i < 4; i++) {
			for(j=0; j < 12; j++) {
				matriz[i][j] = gerador.nextInt(90);
			}
		}
		
		for(i=0; i < 4; i++) {
			for(j=0; j < 12; j++) {
				System.out.print(matriz[i][j] + " ");
			}
			System.out.println("-");
		}
		
		for(i=0; i < 4; i++) {
			for(j=0; j < 12; j++) {
				soma_mes[j] += matriz[i][j];
			}
		}
		
		for(i=0; i < 12; i++) {
			System.out.println("produção do mes de "+mes[i]+": " + soma_mes[i]);
		}
		
		soma_ano = 0;
		for(i=0; i < 4; i++) {
			for(j=0; j < 12; j++) {
				soma_ano += matriz[i][j];
			}
		}
		System.out.println("produção do ano: " + soma_ano);
		
		maior_producao = 0;
		mes_maior = 0;
		semana_maior = 0;
		for(i=0; i < 4; i++) {
			for(j=0; j < 12; j++) {
				if(matriz[i][j] > maior_producao) {
					maior_producao = matriz[i][j];
					mes_maior = j;
					semana_maior = i;
				}
			}
		}
		
		System.out.println("A maior produção semanal foi de " + maior_producao+" unidades no mês de "+mes[mes_maior]+" durante a "+semana[semana_maior]+" semana");
	}
}
