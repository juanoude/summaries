//Aula 01

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
