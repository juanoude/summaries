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


//Aula 03

<li><span id ="tempo-digitacao">10</span> segundos</li>

var tempoRestante = $("#tempo-digitacao").text();
campo.one('focus', function(){
  var id = setInterval(function(){
    tempoRestante--;
    $("#tempo-digitacao").text(tempoRestante);
    if(tempoRestante < 1){
      campo.attr("disabled", true);
      clearInterval(id);
    }
  }, 1000);
});


//Aula 04

<button id="botao-reiniciar">Reiniciar Jogo</button>

//Guardando o tempo inicial no começo do código para o botão resetar:
var tempoInicial = $('#tempo-digitacao').text();


$('#botao-reiniciar').click(reiniciaJogo); //shorthand para .on('click', ...)

function reiniciaJogo() {
  campo.attr("disabled", false);
  campo.val("");
  $("#contador-palavras").text("0");
  $("#contador-caracteres").text("0");
  $("#tmepo-digitacao").text(tempoInicial);
  inicializaCronometro();
});


//Organizando o código em funcões:
function atualizaTamanhoFrase() {
  var frase = $(".frase").text();
  var numPalavras  = frase.split(" ").length;
  var tamanhoFrase = $("#tamanho-frase");
  tamanhoFrase.text(numPalavras);
}

function inicializaContadores() {
  campo.on("input",function(){
    var conteudo = campo.val();
    var conteudoSemEspaco = conteudo.replace("/\s+/g",'');

    var qtdPalavras = conteudo.split(/\S+/).length - 1;
    $("#contador-palavras").text(qtdPalavras);

    var qtdCaracteres = conteudoSemEspaco.length;
    $("#contador-caracteres").text(qtdCaracteres);
  });
}

function inicializaCronometro() {
  var tempoRestante = $("#tempo-digitacao").text();
  campo.one("focus", function() {
    var cronometroID = setInterval(function() {
      tempoRestante--;
      $("#tempo-digitacao").text(tempoRestante);
      if (tempoRestante < 1) {
        campo.attr("disabled", true);
        clearInterval(cronometroID);
      }
    }, 1000);
  });
}


//Chamando todas as funções:
$(document).ready(function(){ //espera o carregamento total para rodar o seu código
  atualizaTamanhoFrase();
  inicializaContadores();
  inicializaCronometro();
  $("#botao-reiniciar").click(reiniciaJogo);
});

//ShortHand para o ready:
$(function(){
    atualizaTamanhoFrase();
    inicializaContadores();
    inicializaCronometro();
    $("#botao-reiniciar").click(reiniciaJogo);
});


//deve-se desabilitar o botão enquanto o cronometro roda, para evitar bugs:
//...
campo.one("focus", function() {

  //...

  $("#botao-reiniciar").attr("disabled",true);

  //...

  if(tempoRestante < 1) {
    $("#botao-reiniciar").attr("disabled",false);
  }
}



// Aula 05

//modificando um css via JS (má prática):
campo.css("background-color", "lightgray");
//apenas um paramentro busca o valor do campo e é possível capturar mais de um:
var valores = $("div").css(["background-color","width"]);//array como primeiro parametro

//modificando classes via JS (boa prática):
campo.addClass("campo-desativado");
campo.removeClass("campo-desativado");
campo.toggleClass("campo-desativado");


if (tempoRestante < 1) {
  //...
  campo.addClass("campo-desativado");
}


function reiniciaJogo(){
  //...
  campo.removeClass("campo-desativado");
}


//comparando o texto digitado com o estipulado:

function inicializaMarcadores(){
  var frase = $(".frase").text();

  campo.on("input", function(){
    var digitado = campo.val();
    var trecho = frase.substr(0, digitado.length);

    if(trecho == digitado){
      campo.addClass("borda-verde");
      campo.removeClass("borda-vermelha");
    }else{
      campo.addClass("borda-vermelha");
      campo.removeClass("borda-verde");
    }

  });
}

$(function(){
  //...
  inicializaMarcadores();
  //...
});

function reiniciaJogo(){
  //...
  campo.removeClass("borda-vermelha"); //novo
  campo.removeClass("borda-verde"); //novo
}

//caso o navegador possua compatibilidade com EcmaScript 6, existe uma forma mais facil de comparar:
var digitouCorreto = frase.startsWith(digitado);
if(digitouCorreto){ // ou if (frase.startsWith(digitado)){
  //borda verde
}else{
  //borda vermelha
}




//Aula 06

//dada a estrutura:
<section class="placar">
    <h3 class="center">Placar</h3>
    <table class="centered bordered">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>No. de palavras</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Douglas</td>
                <td>10</td>
            </tr>
        </tbody>
    </table>
</section>


//inserindo placar com uma string:
function inserePlacar(){
  var corpoTabela = $(".placar").find("tbody");
  var usuario = "Juan";
  var numPalavras = $("contador-palavras").text();
  var botaoRemover = "<a href='#'><i class='small material-icons'>delete</i></a>" ;

  var linha = "<tr>"+
                "<td>" + usuario + "</td>" +
                "<td>" + numPalavras +"</td>" +
                "<td>" + botaoRemover + "</td>" +
              "</tr>";
  corpoTabela.append(linha);
}

//Para colocar no começo usa-se:
corpoTabela.prepend(linha);

//Colocando o botão remover:
$(".botao-remover").click(function(event){
  event.preventDefault();
  $(this).parent().parent().remove();
});

//como não é possível atrelar eventos a strings, devemos substituí-las por um elemento:
function novaLinha(usuario, palavras){
  var linha = $("<tr>");
  var colunaUsuario = $("<td>").text(usuario);
  var colunaPalavras = $("<td>").text(palavras);
  var colunaRemover = $("<td>");
  var link = $("<a>").attr("href", "#");
  var icone = $("<i>").addClass("small").addClass("material-icons").text("delete");

  linha.append(colunaUsuario);
  linha.append(colunaPalavras);
  linha.append(colunaRemover);

  colunaRemover.append(link);
  link.append(icone);

  return linha;
}

//colocando a lógica de remover em uma função:
function removeLinha(event){
  event.preventDefault();
  $(this).parent().parent().remove();
}

//A função ficaria agora:
function inserePlacar(){
  var corpoTabela = $(".placar").find("tbody");
  var usuario = "Douglas"
  var numPalavras = $("#contador-palavras").text();
  var botaoRemover = "<a href='#'><i class='small material-icons'>delete</i></a>" ;

  var linha = novaLinha(usuario,numPalavras);
  linha.find(".botao-remover").click(removeLinha);

  corpoTabela.append(linha);
}

function inicializaCronometro() {
  //...
  if (tempoRestante < 1) {
    //...
    inserePlacar();
  }
  //...
}

/* a página de código está ficando extensa, deve-se agrupar funcões em arquivos
categorizando-as e deixando a execução num "main.js"*/
