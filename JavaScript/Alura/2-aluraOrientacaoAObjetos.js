//Classes
class NameOfTheClass {
  attribute1;
  attribute2; //O valor inicial nesses casos é 'undefined';
  attribute3;
}

const classExample = new NameOfTheClass();
classExample.attribute1 = "Joao Caldo";
classExample.attribute2 = 12463849224;
console.log(classExample);
// NameOfTheClass { attribute1: "Joao Caldo", attribute2: 12463849224, attribute3: undefined};

//Classes offers the minimum structure to the class, that means that you can freely
//"Make" new runtime atributes:
classExample.attribute4 = "Testing a Made up Attribute";
console.log(classExample);
// NameOfTheClass { ..., attribute4: "Testing a Made up Attribute"};

class Cliente {
  nome;
  cpf;
}

class ContaCorrente {
  #saldo; //The # make as private(not truly implemented yet - proposal status); But if you refer without #
//it will create another variable called 'saldo'. Watch out!
  #agencia; //Private atributes don't apear in console.log();
//the informal convention is the _varName to indicate a 'fake' private status.
  cliente;

  sacar(valor) {
    if((this.#saldo - valor) >= 0) {
      this.#saldo -= valor;
      return valor;
    }
  }

  depositar(valor) {
    if(valor <= 0) return;

    this.#saldo += valor;
    return valor;

  }

  transferir(valor, conta) {
    const valorSacado = this.sacar(valor);
    const conta.depositar(valorSacado);
  }
}

// A primitive type variable passed on a parameter, is just a copy of the variable,
//changing it wont alter the original variable. But objects, in this case, what is
//being passed is a instance, wich will result in changes in the original variable.


//Constructor on JavaScript:
export class Cliente {
  _nome;
  _cpf;

  constructor(nome, cpf) {
    this._nome = nome;
    this._cpf = cpf;
  }
}

const cliente = new Cliente("João", 03849424416)

//Get, Set and Static atribs
import {Cliente} from './Cliente';

export class ContaCorrente {
  static numeroDeContas = 0;
  agencia;
  _cliente;

  constructor() {
    ContaCorrente.numeroDeContas++; //it belongs to the class
  }

//Setter on JavaScript
  set cliente(novoValor) {
    if(cliente instanceof Cliente){
      this._cliente = novoValor;
    }
  }

//Getter on JavaScript
  get cliente() {
    return this._cliente;
  }

}

//When you use the properties normally, they wil use get and set methods
conta.cliente = 0; //undefined
conta.cliente = new Cliente(); // Cliente {...}
console.log(conta.cliente);
console.log(ContaCorrente.numeroDeContas);

//State refer to the class variables. Managing it is a great part of your app archtecture
