//yarn init -y
//os campos do package.json que são úteis para publicação

//yarn add express

//index.js:
const express = require('express');

console.log(express);
//Mostra o objeto com todas as funcionalidades do express

const server = express();

server.get('/teste', (req, res)) ==> {
  //podemos usar
  //metodo json para retornar json:
//  return res.json({message: 'Hello World'});
  //metodo send para texto:
  return res.send('Hello World');

  console.log('teste');
});

server.listen(3000);

//Temos três tipos de infomações nas requisições:
//Query params = /route?key=value
const { key } = req.query;// const key = req.query.key;
return res.json({ message: `Hello ${key}`});

//Route params = /route/value
server.get('/teste/:key', (req,res) => {
  const { key } = req.params;// const key = req.params.key;
  return res.json({message: `Hello ${key}`});
})

//Request body = { key: value, key2: value2, key3: value3 }



//No Insomnia podemos testar todos tipos de requisição facilmente
//(new request) - nome - metodo e coloca a url a ser testada

//CRUD - Create - Read - Update - Delete:
const users = ['Juan', 'Angelica', 'Mimi', 'Sr. Juan'];

server.get('/users', () => {
  return res.json(users);
});

server.get('/users/:index', (req,res) => {
  const { index } = req.params;
  return res.json(users[index]);
})//Agora testamos no insomnia os diferentes parâmetros

server.post('/users', (req,res) => {
  //Basta enviar um json com o nome a ser inserido e:
  const {name} = req.body;// const name = req.body.name;
  users.push(name);
  return res.json(users);
});//Para não ocorrer erro ao enviar json no corpo da requisição, precisamos:
server.use(express.json());//Agora sim podemos testar o post pelo insomnia

server.put('/users/:index', (req, res) => {
  const {index} = req.params;
  const {name} = req.body;

  users[index] = name;
  return res.json(users);
});

server.delete('/users:index', (req, res) => {
  const {index} = req.params;

  users.splice(index, 1); //corta 1 posição a partir do index

  return res.send(); //Envia apenas o status 200 de sucesso
});

//yarn add nodemon -D
//yarn nodemon index.js

//ou (package.json):
{
  //...
  "scripts": {
    "dev": "nodemon index.js"
  }
  //...
} // >>>  yarn dev


//Middleware
//O express utiliza a noção de middleware, podemos utilizar apenas um intermediário que pega-
//ria todas as requisições e dissecariamos uma lógica necessária antes das rotas específicas

//se utilizamos o .use() ele capta todas as requisições possíveis, faremos um log com ele:
server.use((req, res, next) => {
  console.log(`Método: ${req.method}; URL:${req.url};`);
  //Quando ele encontra uma rota compatível com a requisição,
  //por padrão, ele não continua a busca para encontrar outras que também atendem
  //Para isso:
  return next();//continua a execução até o próximo bloco de código compatível
});

//Não necessariamente teríamos que parar o código com o return, podemos empilhar:
//cronometraremos o tempo da res-req:
server.use((req, res, next) => {
  console.time('Request');
  next();//Empilha - executa outra rota e em seguida continua o resto da função.
  console.timeEnd('Request');
});

//Faremos outros middlewares:
function checkNameExists(req, res, next) {
  if (!req.body.name) {
    return res.status(400).json({error: 'User name is required'});
  }
  return next();
}

function checkIndexInArray(req, res, next) {
  if(!users[req.params.index]) {
    return status(400).json({error: 'Index doesn\'nt exist'});
  }
  return next();
}

//agora basta colocá-los como parametros nas rotas em que forem pertinentes:
//Podem-se colocar quantos forem necessários. Ex:
server.put('/users/:id', checkIndexInArray, checkNameExists, (req, res) => {
  //...
});

//Outra possibilidade interessante é a capacidade de se alterar a requisição:
function checkIndexInArray(req, res, next) {
  const user = users[req.params.index];
  if(!user) {
    return status(400).json({error: 'Index doesn\'nt exist'});
  }

  req.user = user; //Cria uma nova atribuição na requisição

  return next();
}
//Na rota ficaria apenas:
server.get('/users/:index', checkIndexInArray, (req, res) => {
  return res.json(req.user);
});

//Para debugar basta usar a aba do VSCode, clicar na engrenagem e ele criará o
//arquivo launch.json, deixaremos como ele está e teremos nossa configuração de debug.
//desligaremos o nodemon
//criaremos os breakpoints para o debug, daremos play, enviaremos a req via insomnia,
//analisamos/stepover repetidamente até finalizarmos ou dermos continue.
//No watch, podemos adicionar variaveis que desejamos monitorar com mais facilidade
