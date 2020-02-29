//Aula 01 - Conceitos

//Após instalar o node e o yarn, iremos no diretório do nosso projeto e daremos um:
yarn init //Daremos enter em todas as perguntas e estará criado o package.json
//Nesse arquivo que ficam nossas dependencias, dessa forma adicionaremos o babel:
yarn add @babel/cli//dá a interface de linha de comando do babel;
yarn add @babel/preset-env //conversor voltado para navegadores.
yarn add @babel/core

//nesse momento haverão dois arquivos novos o yarn.lock que se trata de um arquivo
//de cache do yarn e o node_modules que é onde está todas as nossas dependencias do
//projeto

//Ao utilizar o git é bom ignorar a node_modules (.gitignore == node_modules/)

//criaremos um arquivo main.js e no package.json faremos um novo script:
"scripts":{
  "dev": "babel ./main.js -o ./bundle.js" //com '-w' fica em hot reload.
}
//ao executar yarn dev, ele converte o arquivo como descrito




//Classes:
class TodoList {
  constructor() {
    this.todos = [];//iniciando variável
  }

  addTodo(todo) {
    this.todos.push(todo);
    console.log(this.todos);
  }
}

//com o botao:
<button id="novo_todo"> Adicionar </button>

const MinhaLista = new TodoList();
var botao = querySelector("#novo_todo").onclick = function() {
  MinhaLista.addTodo('To Do!');
}


//Herança:
class List {
  constructor() {
    this.data = [];
  }

  add(data) {
    this.data.push(data);
  }
}

class TodoList extends List {
  //herdará tudo

  constructor(usuario) {
    super();//pega o pai

    this.usuario = usuario;//adiciona uma funcionalidade
  }
}


//Métodos estáticos:
class Matematica {
  static soma(a, b) {
    return a + b;
  }
}

Matematica.soma(1,2);


//Constantes:
const a = 1;
a = 3; //Erro

const usuario = { nome: 'Juan' };
usuario.nome = 'Lelek'; //Executa

//Escopo:
// let permite que você declare variáveis limitando seu escopo no bloco, instrução,
//  ou em uma expressão na qual ela é usada. Isso é inverso da keyword var, que
//  define uma variável globalmente ou no escopo inteiro de uma função,
//  independentemente do escopo de bloco.

// Nota do tradutor: o trecho acima: "independentemente do escopo de bloco",
// na verdade, significa dizer que variáveis declaradas dentro de blocos internos
// da função, por exemplo, são vinculadas no escopo da função, não no bloco no qual
//  elas são declaradas. Se isso parece confuso - e realmente é -, apenas entenda
//  que, ao contrário do que se poderia supor, em Javascript blocos não possuem
//  escopo como em outras linguagens, somente funções têm! Isso quer dizer que
//  mesmo uma váriavel definida com a keyword var dentro de um bloco de instrução
//  if, será visível no resto inteiro da função.

function escopo(x) {
  let y = 2;
  if (x > 5) {
    console.log(x, y);
  }
}

escopo(10); //10 2 - imprime o x e y sem problemas

console.log(y);// Erro



//Operações em Arrays
const array = [1, 3, 4, 5, 7, 8, 9];

//Map
const newArray = array.map(function(item) {
  return item * 2;
}); //Percorre o array gerando um novo de acordo com a regra do return.
const newArray = array.map(function(item, index) {
  return item + index;
}); //É possível utilizar o index como segundo parametro

//Reduce
const sum = array.reduce(function(total, next) {
  return total + next;
}); // Reduz o array a um único valor.

//Filter
const sum = array.filter(function() {
  return item % 2 === 0;
});//Filtra um array com apenas os resultados pares.

//Find
const find = array.find(function() {
  return item === 4;
}); //Procura o elemento de acordo com a condição e
//o exibe se true, caso false retorn 'undefined'.



 //Arrow Functions:
const newArray = array.map(function (item) {
  return item * 2;
});

const newArray = array.map((item) => {
  return item * 2;
});//menos verbosidade

const newArray = array.map( item => {
  return item * 2;
});//quando recebe apenas um parametro pode-se remover o parentesis

const newArray = array.map( item => item * 2);
// Quando é apenas uma linha, dispensa return e chaves


//Também podem transformar constantes em funções (não recomendado)
const teste = () => {
  return 'teste';
}
console.log(teste()); //retorna teste normalmente.

//Ao retornar um objeto, utiliza-se parentesis, pois a chave do objeto se confunde com a da função.
const teste = () => { nome : 'Juan' } //undefined

const teste = () => ({ nome : 'Juan'}) //sucesso

const teste = () => {
  return {nome : 'Juan'}; //com return funciona perfeitamente
}


//Valor padrão:
function soma(a, b) {
  return a + b;
}
console.log(soma(1)); //NaN
console.log(soma());//NaN

function soma(a = 3, b = 6) {
  return a + b;
}
//ou
const soma = (a = 3, b = 6) => a + b;

console.log(soma(1));//7
console.log(soma());//9



//Desestruturação de objetos:
const usuario = {
  nome : 'Juan',
  idade : 28,
  endereco : {
    cidade : 'Toronto',
    pais : 'Canadá'
  },
};

//Usualmente seria:
const nome = usuario.nome;
const idade = usuario.idade;
const cidade = usuario.endereco.cidade;

//ES6:
const { nome, idade, endereco : { cidade } } = usuario;

console.log(nome);//Juan
console.log(idade);//28
console.log(cidade);//Toronto

//Em funções:
function mostraNome( { nome, idade } ) {
  console.log(nome, idade);
}

mostraNome(usuario);



//Operadores rest / spread
//Como o core do babel ainda não engloba os operadores, faremos:
//yarn add @babel/plugin-proposal-object-rest-spread
// no .babelrc ficará:
{
  "presets": ["@babel/preset-env"],
  "plugins": ["@babel/plugin-proposal-object-rest-spread"]
}


const usuario = {
  nome: 'Juan',
  idade: 28,
  empresa: 'Lumni'
};

//Pegando o resto do objeto(REST):
const { nome , ...resto } = usuario;
console.log(nome);//Juan
console.log(resto);//{idade: 28, empresa: 'Lumni'}

//funciona em arrays também:
array = [1, 2, 3, 4];
const [a, b, ...c] = array;
console.log(a);//1
console.log(b);//2
console.log(c);//[3,4]

//E, funções:
function soma(...params) {
  return params.reduce((total, next) => total + next);
};//soma todos os parametros passados
console.log(soma(2, 3, 4, 5, 6));//20
//Para resto:
function teste(a, b, ...params) {
  return params;
};
console.log(soma(1, 5, 6, 8));//[6, 8]

//SPREAD
const array1 = [1, 2, 3];
const array2 = [4, 5, 6];
const array3 = [...array1, ...array2];

console.log(array3);//[1, 2, 3, 4, 5, 6]

//com spread é possível copiar o objeto alterando coisas pontuais:
const usuario1 = {
  nome: 'Juanoude',
  idade: 28,
  objetivo: 'Hack Like a Boss'
};

const usuario2 = {...usuario1, nome: 'Juan'};
//Levando em consideração que no objeto os propriedades têm que ter chaves distintas
//Qualquer repetição substitui

console.log(usuario2); // {nome: 'Juan', idade:28, objetivo: 'Hack Like a Boss'}


//Templante literals:
console.log('Meu nome é ' + nome + 'e tenho ' + idade + ' anos.');
//fica:
console.log(`Meu nome é  nome ${nome} e tenho ${idade} anos.`);// crase



//Object Short Syntax:
const nome = 'Juan';
const idade = 28;
const meta = 'Prosperidade';

const usuario = {
  nome: nome,
  idade: idade,
  meta: meta
};//Quando as chaves são iguais aos valores basta:
const usuario = {
  nome,
  idade,
  meta
};



//Utilizando o webpack
// no package json, colocaremos todas as dependencias como devDependencies, pois todas
// devem ter como escopo apenas o desenvolvimento.
//...
 "devDependencies" : {
   //...
 }
//Primeiro faremos:
//yarn add webpack webpack-cli -D
//O -D coloca no devDependencies

//Agora criaremos o arquivo de configuração do webpack(webpack.config.js):
module.exports = {
  entry: './main.js',
  output: {
    path: __dirname,
    filename: 'bundle.js'
  },
  modules: {
    rules: [
      {
        test: /\.js$/, //pegar qualquer arquivo .js
        exclude: /node_modules/, //Com exceção da pasta node modules
        use: {
          loader: 'babel-loader'
        }
      }
    ]
  }
};

//É necessário instalar o babel loader:
//yarn add @babel/loader -D

//No package json substituiremos o comando dev para executar o webpack
"scripts": {
  "dev": "webpack --mode=development -w" //-w deixa hot reload
}



//Imports e exports:
export function soma(a, b) {
  return a + b;
}
export function sub(a, b) {
  return a - b;
}

import { soma, sub } from './arquivo';//não precisa da extensão
console.log(soma(1, 2));
console.log(sub(1, 2));

//cada arquivo pode ter um export default. Só pode haver um e ele será carregado
//por padrão quando importar o arquivo.

export default function padraoDoArquivo() {
  return 'Eu sou o padrão';
}

import padraozinho from './arquivoComOPadrao'//Pode-se mudar o nome da funcao
//Para renomear no import normal:
import { soma as rebeldiaNominal, sub as subversaoLexical} from './arquivo';

//Quando se tem um default e outras funções em export comum:
import funcaoDefault, {outras, funcoes, comuns} from './arquivo';

//para se importar tudo em uma variável:
import * as tudoJunto from './arquivo';
console.log(tudoJunto.soma(1, 2));
console.log(tudoJunto.sub(2, 2));



//webpack Server
//primeiro organizaremos todos arquivos origem numa pasta src e em seguida todos os
//arquivos destino na pasta public. Segundo, alteramos o webpack.config.js:
entry: './src/main.js',
output:{
  path: __dirname + '/public',
  filename: 'bundle.js'
}

//Agora, rodamos 'yarn add webpack-dev-server -D'
//novamente no webpack.config.js, criaremos a configuração devServer
//...
devServer: {
  contentBase: __dirname + '/public'
}

//depois no package.json:
"scripts": {
  "dev": "webpack-dev-server --mode=development",
  //Como o arquivo bundle só existe virtualmente, para criar de fato os arquivos:
  "build": "webpack --mode=production"
}

//A principal vantagem do dev server é ser hot reload



//Async/Await:
//Como se trata de uma funcionalidade mais recente, teremos que adicionar outro
//plugin do babel:
// yarn add @babel/plugin-tranform-async-to-generator -D
// yarn add @babel/polyfill -D
//No .babelrc:
//...
"plugins": [
  //...
  "@babel/plugin-transform-async-to-generator"
]
//No webpack config:
entry: ['@babel/polyfill', './src/main.js']

//Dada a promise:
const minhaPrimise = () => new Promise((resolve, reject) => {
  setTimeOut(() => {resolve('OK')}, 2000)
});

minhaPromise()
  .then(response => {
    console.log(response);
  })
  .catch(err => {

  });

//Com assync await:
async function executaPromise() {
  const response = await minhaPromise();
  console.log(response);//A linha debaixo só executa após o retorno.
}//O await só pode ser usado dentro de uma função async

//Em arrow function:
const executaPromise = async () => {
  console.log(await minhaPromise());
}

executaPromise();

//AXIOS
//yarn add axios
import axios from 'axios';
//criaremos uma função para gettar
class Api {
  static async getUserInfo(username) {
    try{
      const response = await axios.get(`https://api.github.com/users/${username}`);
      console.log(response);
    }catch(error) {
      console.warn('Erro na API');
    }
  }
}

Api.getUserInfo('juanoude');
