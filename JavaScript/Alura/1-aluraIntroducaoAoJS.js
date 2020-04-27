
idade = 30; //Variável Global - MÁ PRÁTICA
const idade = 30; // Variável de escopo - BOA PRÁTICA!

//Conversão de tipos
console.log("ano" + 2020); //ano2020
console.log("2" + "2"); // 22
console.log(parseInt("2") + parseInt("2")); // 4 (parseFloat também existe)
console.log("10" / "2") // 5
console.log("7" / "2") // 3.5
console.log("Ricardo" / 2); // NaN (Not a Number)
//Cuidado com a vírgula
console.log(6.5); //6.5
console.log(6,5); //6 5

//Manter o máximo de constantes é uma BOA PRÁTICA!
const constante = "Não é possível reatribuir valor, em objetos, não se muda a estrutura";
let naoConstante = "Já com o let, ";
naoConstante = naoConstante + "é possível reatribuir o valor da variável";

//Os Nomes de Variáveis devem ser o mais explicito/explicativo Possível mesmo que
//fique extenso - BOA PRÁTICA
