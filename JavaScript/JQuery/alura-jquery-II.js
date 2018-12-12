//Aula 01 - Animações

//dado o novo botão escondido:
<a id="botao-placar" class="btn-floating btn-large waves-effect waves-light green">
    <i class="material-icons">assignment</i>
</a>

.placar{
  display:none;
}

//vamos animá-lo:
$("#botao-placar").click(mostraPlacar);

function mostraPlacar(){
  $(".placar").slideToggle(600);
}

//outras funções:
$(".placar").show();//mostra abruptamente
$(".placar").hide();//esconde abruptamente
$(".placar").toggle();// show/hide

$(".placar").slideDown();//mostra deslizando o elemento
$(".placar").slideUp();//esconde deslizando o elemento
$(".placar").slideToggle();// slideDown/slideUp

//como a função remove() remove os itens abruptamente, usaremos:
function removeLinha() {
  event.preventDefault();
  var linha = $(this).parent().parent();
  linha.fadeOut(1000);// como ela apenas esconde o elemento para ainda removermos do código fonte devemos usar remove em seguida

  setTimeOut(function(){//harmonizando o tempo de execução
    linha.remove();
  }, 1000);
}

//outras funções:
$(".exemplo").fadeIn();//mostra de opacidade crescente
$(".exemplo").fadeOut();//esconde com opacidade decrescente
$(".exemplo").fadeToggle();// fadeIn/fadeOut


//para evitar um encadeamento de animações ao ativar multiplas vezes a animação:
$(".placar").stop().slideToggle(600);// Ao ativar uma nova animação ele descarta a anterior

//para scrollar a tela até o placar:
function scrollPlacar(){
  var posicao = $("placar").offset().top;
  $("body").animate( // aqui pode-se trabalhar qualquer propriedade do css
    {
      scrollTop: posicaoPlacar + "px";
    }, 1000);
}

//outras funcões:
promocoes.is(':visible')// checa uma pseudoclasse - boolean

$("#dropdown").mouseenter(function() { //Ao apontar
  $("#opcoes").stop().slideToggle();
});

$("#dropdown").mouseleave(function() { //Ao desapontar
  $("#opcoes").stop().slideToggle();
});

$('li').dblclick(function() { //shorthand do doubleclick
  $(this).fadeOut(function() { //colocar o remove dentro do fade, harmoniza os dois efeitos corretamente.
    this.remove();
  })
});



//Aula 02 - AJAX

//dado o botão:
<a id="botao-frase" class="btn-floating btn-large waves-effect waves-light blue">
  <i class="material-icons">shuffle</i>
</a>

$("#botao-frase").click(fraseAleatoria);

//subindo um servidor que cospe um json numa determinada rota
/*no caso: http://localhost:3000/frases - que possui 10 frases (id, texto, tempo)*/

function fraseAleatoria(){
  $.get("http://localhost:3000/frases", trocarFraseAleatoria);
}

function trocarFraseAleatoria(data){
  var frase = $(".frase");
  var numeroAleatorio = Math.floor(Math.random() * data.length);
  frase.text(data[numeroAleatorio].texto);
  atualizaTamanhoFrase();
  atualizaTempoInicial(data[numeroAleatorio].tempo)
}

function atualizaTempoInicial(tempo) {
    $("#tempo-digitacao").text(tempo);
}

//consertar o bug (carregando o tempo e frase de comparação no evento e não ao carregar a página)
function inicializaMarcadores() {
  campo.on("input", function() {
    var frase = $(".frase").text();
    var tempoRestante = $("#tempo-digitacao").text();
    // ...
  });
}



//Aula 03

//dado o erro e spinner:
<div class="center">
  <p id="erro">Ocorreu um erro, por favor tente novamente!</p>
</div>
<div class="center">
  <img src="img/spinner.gif" alt="Spinner" id="spinner">
  <p id="erro">Ocorreu um erro, por favor tente novamente</p>
</div>

#erro{
    color: red;
    display: none;
}

#spinner{
    display: none;
}

//exibindo msg de erro e spinner de carregamento:
function fraseAleatoria() {
  $("#spinner").show();

  $.get("http://localhost:3000/frases2222", trocaFraseAleatoria) //URL errada para simular um problema
  .fail(function(){
    $("#erro").show(); //ao falhar mostra a mensagem de erro
    setTimeOut(function(){
      $("#erro").hide();
    },1500);
  })
  .always(function(){
    $("#spinner").hide();
  });
}


//Aula 04
//Dado o botão:
<a id="botao-frase-id" class="btn-floating btn-large waves-effect waves-light cyan">
  <i class="material-icons">repeat_one</i>
</a>

<input type="number" min="0" id="frase-id">

$("#botao-frase-id").click(buscaFrase);

function buscaFrase(){
  $('#spinner').toggle();

  var fraseId = $('#frase-id').val();
  var dados = { id : fraseId }

  $.get('http://localhost:3000/frases', dados, trocaFrase)
  .fail(function(){
    $('#erro').toggle();
    setTimeOut(function(){
      $('#erro').toggle();
    }, 2000)
  })
  .always(function(){
    $('#spinner').toggle();
  });
}

function trocaFrase(data){
  var frase = $('.frase');

  frase.text(data.texto);
  atualizaTamanhoFrase();
  atualizaTempoInicial(data.tempo);
}
