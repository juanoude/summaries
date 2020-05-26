// Propriedades de estância devem ser definidas dentro dos métodos da classe(Boa prática):
class Conta {
  constructor(saldoInicial, agencia, cliente) {
    this.agencia = agencia;
    this._saldoInicial = saldoInicial;
    this.cliente = cliente;

    console.log(this.constructor); // [Function: Conta]
    if(this.constructor == Conta) { // Esse if não executa na criação de classes filhas.
      throw new Error('Essa classe não deve ser instanciada!');
    }// Assim se torna uma classe abstrata
  }

  sacar(valor) {
    taxa = 1;
    this._sacar(valor, taxa);
  }

  _sacar(valor, taxa) {
    //...
  }

  depositar(valor) {
    throw new Error('Esse método deve ser implementado!');
  }// Assim se torna um método abstrato
}

// Herança
class ContaCorrente extends Conta {
  static numeroDeContas = 0
  constructor(cliente, agencia) {
    super(0, cliente, agencia); // Sempre deve chamar o método super() no construtor.
    ContaCorrente.numeroDeContas += 1;
  }

// Sobrescreve...
  sacar(valor) {
    taxa = 1.1;
    super._sacar(valor, taxa); // O super() executaria o 'sacar()'
  }
}

class SistemaAutenticacao {
  static login(funcionario, senha) {
    return funcionario.senha == senha; // A princípio esse método procura definir para
  }// apenas os Funcionários e seus filhos, porém, como não há tipagem, qualquer objeto
}// com a propriedade senha funcionaria. Até um que não a possui, pela flexibilidade estru-
// tural do JS, ele cria a propriedade em tempo de execução como false, sequer um erro ocorre.
