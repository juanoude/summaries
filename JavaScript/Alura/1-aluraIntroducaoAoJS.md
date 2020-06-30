
# JavaScript - Introduction

## Variables
* `idade = 30;` Global Variable - Bad Practice
* `const idade = 30;` Scope Variable - Good Practice

* Giving preference to declare with `const` is a good practice. Because:
  * `const constant = "Is not possible to modify its value, in objects, doesn't change its structure;`
  * ```let nonConstant = "But with let, ";
    nonConstant = nonConstant + "is possible to modify the variable value";```

* `let` can be declared and attributed in different lines, `const` has to be on the same:
  * ```let declared;
  declared = "attributed";```
  * `const declared = 'attributed';`

*  The variable names should be the most explicit/explanatory possible, even if become extensive - Good practice


## Type Conversion
console.log("ano" + 2020); //ano2020
console.log("2" + "2"); // 22
console.log(parseInt("2") + parseInt("2")); // 4 (parseFloat também existe)
console.log("10" / "2") // 5
console.log("7" / "2") // 3.5
console.log("Ricardo" / 2); // NaN (Not a Number)
//Cuidado com a vírgula
console.log(6.5); //6.5
console.log(6,5); //6 5




//Arrays
const cidades = new Array(
  'São Paulo',
  'Curitiba',
  'Brasília'
);

cidades.push('Florianópolis'); //deixa a estrutura constante, mas pode-se adicionar...
cidades.splice(1, 1); //..., deletar e diversos outros métodos para arrays


//Condicionais:
if (condicao > 18) {
  console.log('true');
} else {
  console.log('false');
}

if (condicao > 18) {
  console.log('true');
} else if (outraCondicao) {
  console.log('false - true');
} else {
  console.log('false - false');
}

if(salario < 2600.0)
  console.log("A sua aliquota é de 15%"); //Está dentro
  console.log("Você pode deduzir até R$ 350"); //Está fora

// || == ou
// && == e

//Iteradores
const destino = 'Brasília';
let existsDest = false;
let contador = 0;
while (contador < 3) {
  if (cidades[contador] == destino) {
    console.log('existe no array');
    existsDest = true;
    break;
  }
  contador += 1;
}
console.log('destino existe:', existsDest);

//no for:
for (i = 0; i < 3; i++) {
  if (cidades[i] === destino) {
    console.log('existe no array');
    existsDest = true;
    break;
  }
}
console.log('destino existe:', existsDest);

//Debugger - Continue vai para no próximo breakpoint e step over executa a próxima linha.
//É possível criar várias configurações de debug com o launch.json
