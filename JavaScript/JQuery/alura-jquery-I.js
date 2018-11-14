//Aula 01

var frase = jQuery(".frase").text(); //jQuery == $
var numPalavras = frase.split(" ").length(); // quebra em um array pelos espaços
console.log(numPalavras); //escreve no console

<span id ="tamanho-frase">19</span>//reescrevendo o conteudo
var tamanhoFrase = $("#tamanho-frase");
tamanhoFrase.text(numPalavras);

$("li"); //seleciona todos os li's da página


//Aula 02

<textarea class="campo-digitacao" rows="8" cols ="40"></textarea>
 <li><span id="contador-caracteres">0</span> caracteres</li>
 <li><span id="contador-palavras">0</span> palavras</li>

var campo = $(".campo-digitacao");
campo.on('input', function(){
  var conteudo = campo.val();//val pega o conteudo inserido em inputs
  var conteudoSemEspaco = conteudo.replace("/\s+/g",'');//Desconsiderando espaços como caracteres;
  var qtdCaracteres = conteudoSemEspaco.length;
  var qtdPalavras = conteudo.split(/\S+/).length - 1; //A expressão regular desconsidera varios espaços como uma série de palavras;
  conteudo.replace(/\s+/g,'').length;
  $("contador-caracteres").text(qtdCaracteres);
  $("contador-palavras").text(qtdPalavras);
});
