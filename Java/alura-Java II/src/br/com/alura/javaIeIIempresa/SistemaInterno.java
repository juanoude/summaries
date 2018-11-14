package br.com.alura.javaIeIIempresa;

class SistemaInterno {
	
	public boolean login(Autenticavel a) {
		int senha = 1234;
		if(a.login(senha)) {
			System.out.println("Login efetuado");
			return true;
		}else {
			System.out.println("Dados Incorretos");
			return false;
		}
		
	}
}
