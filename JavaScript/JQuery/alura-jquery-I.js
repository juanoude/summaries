var frase = jQuery(".frase").text(); //jQuery == $
var numPalavras = frase.split(" ").length(); // quebra em um array pelos espaços
console.log(numPalavras); //escreve no console

<span id ="tamanho-frase">19</span>//reescrevendo o conteudo
var tamanhoFrase = $("#tamanho-frase");
tamanhoFrase.text(numPalavras);

$("li"); //seleciona todos os li's da página
