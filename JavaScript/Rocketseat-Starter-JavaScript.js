//===============================================================================
//Parte 1 - Introdução ao JS

//O javascript deve estar no final da página porque deve-se ter carregado os elementos
//da página antes da execução do código que os manipula;

console.log(); //Imprime no log do chrome

//A tipagem é dinâmica, pode-se atribuir um int a uma variável string, assim como no php;
var nome = "Diego";
var idade = 23;
var peso = 80.5;
var humano = true;

var alunos = ['Diego', 'Gabriel', 'Lucas'];//Array

var aluno = {
  nome: 'Diego',
  idade: 23,
  peso: 80.5,
  humano:true
};//objeto

console.log(alunos[1]);//Gabriel
console.log(aluno.idade);//23

//É possível declarar variáveis em série:
var x = 10, y = 5;
var resultado = x + y;//15

var x = "10", y = 5;
var resultado = x + y;//105 - Cuidado

x += 3; //x = x + 3;
x *= 3; //x = x * 3;

//funções
function soma(parametro1, parametro2){
  var resultado = parametro1 + parametro2;

  return resultado;
}

var resultado = soma(1,2);
console.log(resultado);

//ifs:
function retornaSexo(sexo) {
  if(sexo == 'M') {
    return 'Masculino';
  }else if ('F'){
    return 'Feminino';
  }else {
    return 'Outro';
  }
}

// OBS: O '===' compara não só o valor, mas o tipo da variável também.

//switchcase:
function retornaSexo(sexo) {
  switch (sexo) {
    case 'M':
      return 'Masculino';
    case 'F':
      return 'Feminino';
    default :
      return 'Outro';
  }
}

//Operador Ternário:
return (sexo === 'M') ? 'Masculino' : 'Feminino';
//Equivale a:
if (sexo === 'M') {
  return 'Masculino';
}else {
  return 'Feminino'
}

//for, while:
for(var i = 0; i <= 100; i++) {
  console.log(i);
}

//O while é ideal quando não sabemos quantas vezes será iterado:
var j = 2147595907;
while(j > 50) {
  console.log(j);
  j /= 3;
}

//Intervalos:
function exibeAlgo() {
  console.log('Teste');
}
setInterval(exibeAlgo, 1000);//executa a cada 1s
//Repare que não colocamos o parêntesis pois se trata de uma referencia a função
//se colocarmos ele executará a função dentro dos parentesis e não a referenciará
//ela executaria apenas uma vez

setTimeOut(exibeAlgo, 5000);//Espera 5s e executa apenas uma vez

//--------------------------------------------------------------------------------
//Manipulando a DOM:

//evento:
function mostraAlerta() {
  alert('O Evento foi acionado!');
};

// <div id="app">
//   <button onclick="mostraAlerta()"> Sou um elemento <button>
//   //onmouseover colocaria ao apontar e onkeypress ao apertar alguma tecla
// </div>


// // Pegando elementos pelo código JS:
// // dado o html:
// <input type="text" name="nome" id = "nome" />
// <button class="botao"> Adicionar </button>
// // podemos:
var inputElement = document.getElementById('nome');
var inputElement = document.getElementsByTagName('input')[0];//sempre retorna um vetor
var inputElement = document.getElementsByClassName('nome')[0];//idem

//Uma forma refinada que percorre a DOM:
var inputElement = document.querySelector('div#app input'); //pega o input dentro
//da div com o id='app';
var inputElement = document.querySelector('input[name=nome]');//pega o input com o
//atributo nos colchetes;

//O querySelector retorna sempre um único elemento, o primeiro. para pegar um vetor:
var inputElement = document.querySelectorAll('input');//vetoriza todos inputs da página;


//colocando o onclick via JS:
var inputElement = document.querySelector('input[name=nome]');
var btnElement = document.querySelector('button.botao');//pega o elemento button
//da classe botao
btnElement.onclick = function() {
  var mensagem = inputElement.value;//pega o conteúdo digitado.
  alert(mensagem);
}

//É possível criar elementos html via JS:
var linkElement = document.createElement('a');
//uma das duas:
linkElement.href = 'http://rockeseat.com.br';
linkElement.setAttribute('href', 'http://rockeseat.com.br');

var text = document.createTextNode('Acessar site da rockeseat');//cria um texto.
linkElement.appendChild(text);//coloca dentro da tag

var containerElement = document.querySelector('#app');
containerElement.appendChild(linkElement);//adiciona o elemento no html

var inputElement = document.querySelector('#nome');
containerElement.removeChild(inputElement);//remove um elemento do html

//Também é possível alterar propriedades css com o JS:
var boxElement = document.querySelector('.box');
boxElement.style.width = 100;//px
boxElement.style.height = 100;
boxElement.style.backgroundColor = '#f00';


//----------------------------------------------------------------------------
//criando uma pequena App:
//Primeiro faremos uma lista de elementos com link de excluir
//e um input com um botao que adiciona um item novo a lista.

var listElement = document.querySelector('#divId ul');
var inputElement = document.querySelector('#divId input');
var btnElement = document.querySelector('#divId button');

//Faremos o JS criar os elementos iniciais da lista:
// var todos = [
//   'Fazer Café',
//   'Estudar JavaScript',
//   'Acessar comunidade da RockeSeat'
// ];
//transformando o JSON em array:
var todos = JSON.parse(localStorage.getItem('list_todos')) || [];
//caso não busca um valor aceitável define a segunda opção ^^^^^

function renderTodos() {
  listElement.innerHTML = '';//Limpando para ao adicionar não duplicar elementos

  for (todo of todos) { //foreach
    var todoElement = document.createElement('li');
    var todoText = document.createTextNode(todo);

    var linkElement = document.createElement('a');
    linkElement.setAttribute('href', '#');
    linkText = document.createTextNode(' Excluir')
    linkElement.appendChild(linkText);

    var pos = todos.indexOf(todo);
    linkElement.setAttribute('onclick', 'deleteTodo('+ pos +')');

    todoElement.appendChild(todoText);
    todoElement.appendChild(linkElement);
    listElement.appendChild(todoElement);
  }
}
renderTodos();


//agora faremos a funcionalidade de adicionar a lista:
function addTodo() {
  var todoText = inputElement.value;
  todos.push(todoText);

  inputElement.value = '';

  renderTodos();
  saveToStorage();
}

//agora a funcionalidade de excluir:
function deleteTodo(pos) {
  todos.splice(pos, 1);
  renderTodos()
  saveToStorage();
};

//Salvando a lista em arquivo:
function saveToStorage() {
  //como o localStorage não grava vetores e objetos, faremos uma string em formato JSON:
  localStorage.setItem('list_todos', JSON.Stringify(todos));//Cria uma string organizada como JSON
};

//---------------------------------------------------------------------------------------
//JS Assíncrono

//AJAX:

//Primeiro nos criamos uma instância da classe XMLHttpRequest();
var xhr = new XMLHttpRequest();
//Depois definimos a requisição:
xhr.open('GET', 'https://api.github.com/users/diego3g');
xhr.send(null);//parâmetros da requisição

//depois definimos a resposta assíncrona:
xhr.onreadystatechange = function() { //no evento de mudança de estado
  if(xhr.readystate === 4) { //quando a resposta chegar
    console.log(JSON.parse(xhr.responseText));//parseamos o JSON
  }
};


//PROMISES
//As promises também são assíncronas
var minhaPromise = function() {
  return new Promise(function(resolve, reject) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://api.github.com/users/diego3g');
    xhr.send(null);

    xhr.onreadystatechange = function() {
      if (xhr.readystate === 4) {
        if(status === 200){
          resolve(JSON.parse(xhr.responseText));
        }else {
          reject('Não foi possível conseguir a resposta'  );
        }
      }
    }
  });
}

//Ao executar a função, também temos que estabelecer uma estrutura de execução assíncrona:
minhaPromise()
  .then(function(response){ //o then é ligado ao resolve
    console.log(response);
  })
  .catch(function(error){ //o catch é ligado ao reject
    console.warn(error);
  });
  
