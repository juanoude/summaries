# The web language

* JavaScript doesn't handle loose texts:
```
<script>
  Olá mundo! //not gonna render
</script>
```
* Importing external JavaScript:
```
<script src="contador.js"></script>
```
* pop-up alert:
```
<script>
  alert("Olá mundo");
</script>
```

* Send message in browser log: `console.log("Oi Mundo");`
* Print the DOM of the page on log: `console.log(document);`
* Search the element in the DOM and selects it: `document.querySelector("h1");` , also works into classes `.name` and id's `#name`.

* Changing the h1 text:
```
var titulo = document.querySelector("h1");
    titulo.textContent = "Banana";
```

* Given the following structure:
```
<tr class="paciente" id="primeiro-paciente">
    <td class="info-nome">Paulo</td>
    <td class="info-peso">100</td>
    <td class="info-altura">2.00</td>
    <td class="info-gordura">10</td>
    <td class="info-imc">0</td>
</tr>
```
* To calculate the imc, is possible to do the following:
```
var paciente = document.querySelector("#primeiro-paciente");
var tdPeso = paciente.querySelector(".info-peso");
var peso = tdPeso.textContent;
var tdAltura = paciente.querySelector(".info-altura");
var altura = tdAltura.textContent;
var imc = peso / (altura * altura);
```

* To result in a array to a query selector, should use `document.querySelectorAll(".paciente");`

* Iteration example for 'imc' calculus in each table line:
```
var pacientes = document.querySelectorAll(".paciente");

for (var i = 0; i < pacientes.length; i++) {

    var paciente = pacientes[i];

    var tdPeso = paciente.querySelector(".info-peso");
    var peso = tdPeso.textContent;

    var tdAltura = paciente.querySelector(".info-altura");
    var altura = tdAltura.textContent;

    var tdImc = paciente.querySelector(".info-imc");

    var pesoEhValido = true;
    var alturaEhValida = true;

    if (peso <= 0 || peso >= 1000) {
        console.log("Peso inválido!");
        pesoEhValido = false;
        tdImc.textContent = "Peso inválido";
    }

    if (altura <= 0 || altura >= 3.00) {
        console.log("Altura inválida!");
        alturaEhValida = false;
        tdImc.textContent = "Altura inválida";
    }

  if (alturaEhValida && pesoEhValido) {
        var imc = peso / (altura * altura);
        tdImc.textContent = imc;
    }
}
```

* To format a number to two float digits: `tdImc.textContent = imc.toFixed(2);`

* To alter the css of a element: `paciente.style.backgroundColor = "lightcoral";`
	* As a best practice, you should: `paciente.classList.add("paciente-invalido");`
	* World separation between css and js.

* Events listening example: `titulo.addEventListener("click", mostraMensagem);` 
	* Notice the non-utilization of parenthesis on the function.
	* If you do use the parenthesis, the function gonna execute in reading time.
```
function mostraMensagem(){
    console.log("Olá eu fui clicado!");
}
```
* As a anonymous function:
```
titulo.addEventListener("click", function (){
    console.log("Olha só posso chamar uma função anônima.")
};
```

* To copy a content of a input and put in a element:
```
<input class="frase">
<button class="botao">Copiar</button>
<span class="copia"></span>
<script>
    var inputFrase = document.querySelector('.frase');
    var botao = document.querySelector('.botao');
    var copia = document.querySelector('.copia');

    function botaoHandler() {

      copia.textContent = inputFrase.value;
      inputFrase.value = '';
    }

    botao.addEventListener('click', botaoHandler);
 </script>


/*Buttons inside a form have the need to prevent the default behavior of recharging the page*/
botaoAdicionar.addEventListener("click", function(event) {
    event.preventDefault();
    console.log("Oi eu sou o botao e fui clicado");
});
```

//Para adicionar uma linha na tabela:
var botaoAdicionar = document.querySelector("#adicionar-paciente");
botaoAdicionar.addEventListener("click", function(event) {
    event.preventDefault();

    var form = document.querySelector("#form-adiciona");

    var nome = form.nome.value;
    var peso = form.peso.value;
    var altura = form.altura.value;
    var gordura = form.gordura.value;

    var pacienteTr = document.createElement("tr");

    var nomeTd = document.createElement("td");
    var pesoTd = document.createElement("td");
    var alturaTd = document.createElement("td");
    var gorduraTd = document.createElement("td");
    var imcTd = document.createElement("td");

    nomeTd.textContent = nome;
    pesoTd.textContent = peso;
    alturaTd.textContent = altura;
    gorduraTd.textContent = gordura;

    pacienteTr.appendChild(nomeTd);
    pacienteTr.appendChild(pesoTd);
    pacienteTr.appendChild(alturaTd);
    pacienteTr.appendChild(gorduraTd);

    var tabela = document.querySelector("#tabela-pacientes");

    tabela.appendChild(pacienteTr);

});


//Eventos dessa forma são considerados uma boa prática
botao.addEventListener('click', botaoHandler);
botao.addEventListener('click', outroHandler);/* Adiciona outro comportamento
ao mesmo evento*/
//Pois:
botao.onclick = botaoHandler;
botao.onclick = outroHandler; // substitui botaoHandler

//Uma boa prática é organizar e dividir muito bem as funcionalidades do seu site,
//pois quanto mais o código cresce, mais difícil de mantê-lo.


//refatorando o código, exportando essas funções:
function calculaImc(peso, altura) {
    var imc = 0;

    imc = peso / (altura * altura);

    return imc.toFixed(2);
}

function obtemPacienteDoFormulario(form) {

    var paciente = {//isso é um objeto em js
        nome: form.nome.value,
        peso: form.peso.value,
        altura: form.altura.value,
        gordura: form.gordura.value,
        imc: calculaImc(form.altura.value, form.peso.value)
    }
}

function montaTr(paciente){
    var pacienteTr = document.createElement("tr");
    pacienteTr.classList.add("paciente");

    pacienteTr.appendChild(montaTd(paciente.nome, "info-nome"));
    pacienteTr.appendChild(montaTd(paciente.peso, "info-peso"));
    pacienteTr.appendChild(montaTd(paciente.altura, "info-altura"));
    pacienteTr.appendChild(montaTd(paciente.gordura, "info-gordura"));
    pacienteTr.appendChild(montaTd(paciente.imc, "info-imc"));
}

function montaTd(dado,classe){
    var td = document.createElement("td");
    td.textContent = dado;
    td.classList.add(classe);

    return td;
}

//Finalmente, o código do Adicionar paciente ficou assim:
var botaoAdicionar = document.querySelector("#adicionar-paciente");
botaoAdicionar.addEventListener("click", function(event){
    event.preventDefault();

    var form = document.querySelector("#form-adiciona");
    var paciente = obtemPacienteDoFormulario(form);

    var pacienteTr = montaTr(paciente);

    var tabela = document.querySelector("#tabela-pacientes");

    tabela.appendChild(pacienteTr);

    form.reset();
});

//EXERCICIO1
<button class="botao">Calcula</button>
<input class="numero">
<input class="tabuada">
<span class="resultado"></span>

<script>

    var botao = document.querySelector('.botao');
    var numero = document.querySelector('.numero');
    var tabuada = document.querySelector('.tabuada');
    var resultado = document.querySelector('.resultado');

    botao.addEventListener('click', function() {

        resultado.textContent = numero.value * tabuada.value;

    });


</script>

//RESOLUÇÃO
function buscaElemento(seletor) {
    return document.querySelector(seletor);
}

function aplicaTabuada(numero, tabuada) {

    return numero * tabuada;
}

var botao = buscaElemento('.botao');
var numero = buscaElemento('.numero');
var tabuada = buscaElemento('.tabuada');
var resultado = buscaElemento('.resultado');

botao.addEventListener('click', function() {

    resultado.textContent = aplicaTabuada(numero.value, tabuada.value);
//Mesmo quando a refatoração do código acaba em mais linhas, fatorar apenas pela
//legibilidade e manutenção é uma ótima ideia.
});


//EXERCICIO2
<ul>
    <li class="convidado">
        Nome <span class="nome">Douglas</span>,
        idade <span class="idade">23</span>
    </li>
    <li class="convidado">
        Nome <span class="nome">Daniel</span>,
        idade <span class="idade">42</span>
    </li>
    <li class="convidado">
        Nome <span class="nome">Marcos</span>,
        idade <span class="idade">27</span>
    </li>
    <li class="convidado">
        Nome <span class="nome">Flávio</span>,
        idade <span class="idade">18</span>
    </li>

    Total das idades: <span class="total"></span>
</ul>

var itens = document.querySelectorAll('.convidado');

    var totalDasIdades = 0;

    for(var i = 0; i < itens.length; i++) {

        var idade = itens[i].querySelector('.idade').textContent;
        totalDasIdades+=parseInt(idade);
    }

    document.querySelector('.total').textContent = totalDasIdades;



//RESOLUÇÃO
<script>

    /* esta função isola a responsabilidade de converter cada elemento do DOM em um convidado.
Esse convidado é um objeto JavaScript com as propriedade nome e idade.
Se alguém em nosso código quiser ler facilmente a lista de convidados,
basta chamar esse método que retornará uma lista de objetos já mastigada para se trabalhar.
        */
    function criaListaDeConvidados() {

        var itens = document.querySelectorAll('.convidado');

        var convidados = [];

        for(var i = 0; i < itens.length; i++) {

            var convidado = {
                nome:  itens[i].querySelector('.nome').textContent,
                idade: parseInt(itens[i].querySelector('.idade').textContent)
            };

            convidados.push(convidado);
        }

        return convidados;
    }

 /* essa função tem como responsabilidade extrair o total da lista de convidados retornando-o para quem chamá-la.
Isso é interessante, porque quem receber o resultado pode querer exibir na tela com um `alert`,
`console.log` ou até mesmo atualizando essa informação em algum elemento da página.*/

    function calculaTotalDasIdades(convidados) {

        var total = 0;

        for(var i = 0; i < convidados.length; i++) {

            total+=convidados[i].idade;
        }

        return total;

    }

       /* essa função tem como responsabilidade receber um total qualquer e exibí-lo no HTML */
    function exibeTotalDasIdades(total) {
        document.querySelector('.total').textContent = total;
    }

/* usando nossas funções. Veja que uma pessoa fora do universo da programação
está mais inclinada a entender o que essas instruções fazem devido aos nomes autoexplicativos. */

    var convidados = criaListaDeConvidados();
    var totalDasIdades = calculaTotalDasIdades(convidados);
    exibeTotalDasIdades(totalDasIdades);

</script>



//incluindo/ Refatorando a validação
function validaPeso(peso){

    if (peso >= 0 && peso <= 1000) {
        return true;
    } else {
        return false;
    }
}
function validaAltura(altura) {

    if (altura >= 0 && altura <= 3.0) {
        return true;
    } else {
        return false;
    }
}
function validaPaciente(paciente) {
    if (validaPeso(paciente.peso)= true && validaAltura(paciente.altura)=true) {
        return true;
    } else {
        return false;
    }
}


//Na tabela ficará:
var pesoEhValido = validaPeso(peso);
var alturaEhValida = validaAltura(altura);

if (!alturaEhValida) {
    console.log("Altura inválida!");
    alturaEhValida = false;
    tdImc.textContent = "Altura inválida!";
    paciente.classList.add("paciente-invalido");
}
if (!pesoEhValido) {
    console.log("Peso inválido!");
    pesoEhValido = false;
    tdImc.textContent = "Peso inválido!";
    paciente.classList.add("paciente-invalido");
}




//No botão ficará:
function validaPaciente(paciente) {

    var erros = [];

    if (paciente.nome.length == 0){
        erros.push("O nome não pode ser em branco");
    }

    if (paciente.gordura.length == 0){
        erros.push("A gordura não pode ser em branco");
    }

    if (paciente.peso.length == 0){
        erros.push("O peso não pode ser em branco");
    }

    if (paciente.altura.length == 0){
        erros.push("A altura não pode ser em branco");
    }

    if (!validaPeso(paciente.peso)){
        erros.push("Peso é inválido");
    }

    if (!validaAltura(paciente.altura)){
        erros.push("Altura é inválida");
    }

    return erros;
}

function exibeMensagensDeErro(erros){
    var ul = document.querySelector("#mensagens-erro");
        ul.innerHTML = "";
    erros.forEach(function(erro){
        var li = document.createElement("li");
        li.textContent = erro;
        ul.appendChild(li);
    });
}

var erros = validaPacientes(paciente);

console.log(erros);
if(erros.length > 0){
    exibeMensagensDeErro(erros);
    return;
}

//junto ao form reset:
var mensagensErro = document.querySelector("#mensagens-erro");
mensagensErro.innerHTML = "";

//exemplo de foreach:
var nomes = ["Douglas", "Flávio", "Nico", "Rômulo", "Leonardo"];
nomes.forEach(function(nome) {
    console.log(nome + " é instrutor da Alura");
})

//O innerHTML pega todo o conteúdo interno de uma tag, inclusive outras tags;
ObjetoDeUmElementoHTML.innerHTML = "Novo conteúdo"

//O push coloca um novo elemento ao final do array:
array.push("item novo");



//Removendo pacientes
var pacientes = document.querySelectorAll(".paciente");
//paciente é uma tr, portanto o this será a tr respectiva ao clique
pacientes.forEach(function(paciente) {
    paciente.addEventListener("dblclick", function() {
        this.remove();
    });
});
//Porém para funcionar em linhas adicionadas:
var tabela = document.querySelector("table");

tabela.addEventListener("dblclick",function(event){//todo evento sobe aos parentes superiores
  event.target.parentNode.classList.add("fadeOut");//efeito via css

  setTimeout(function() {
      event.target.parentNode.remove();//Target é o alvo do eventos
  }, 500);//ParentNode é o pai
});



//Criando um campo de busca
var campoFiltro = document.querySelector("#filtrar-tabela");

campoFiltro.addEventListener("input", function(){
    console.log(this.value);
    var pacientes = document.querySelectorAll(".paciente");

    if (this.value.length > 0) {
        for (var i = 0; i < pacientes.length; i++) {
            var paciente = pacientes[i];
            var tdNome = paciente.querySelector(".info-nome");
            var nome = tdNome.textContent;
            var expressao = new RegExp(this.value, "i");
//O primeiro parâmetro é o padrão (o texto da expressão regular, o que deve ser buscado)
//e o segundo parâmetro são uma ou mais flags (representando como queremos que a expressão regular busque).

            if (!expressao.test(nome)) {
                paciente.classList.add("invisivel");
            } else {
                paciente.classList.remove("invisivel");
            }
        }
    } else {
        for (var i = 0; i < pacientes.length; i++) {
            var paciente = pacientes[i];
            paciente.classList.remove("invisivel");
        }
    }
});


//Metodo de busca sem expressão regular:
var comparavel = nome.substr(0, this.value.length);
var comparavelMinusculo = comparavel.toLowerCase();
var valorDigitadoMinusculo = this.value.toLowerCase();

if (!(valorDigitadoMinusculo == comparavelMinusculo)) {
    paciente.classList.add("invisivel");
} else{
    paciente.classList.remove("invisivel");
}


//AJAX
var botaoAdicionar = document.querySelector("#buscar-pacientes");

botaoAdicionar.addEventListener("click", function(){
    console.log("Buscando pacientes...");

    var xhr = new XMLHttpRequest();

    xhr.open("GET", "https://api-pacientes.herokuapp.com/pacientes");

    xhr.addEventListener("load", function() {
        var erroAjax = document.querySelector("#erro-ajax");
        if (xhr.status == 200) {
            erroAjax.classList.add("invisivel");
            var resposta = xhr.responseText;
            var pacientes = JSON.parse(resposta);

            pacientes.forEach(function(paciente) {
                adicionaPacienteNaTabela(paciente);
            });
            } else {
                erroAjax.classList.remove("invisivel");
            }
        });

    xhr.send();
});
