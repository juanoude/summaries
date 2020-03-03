//Iniciaremos uma nova aplicação e desta vez melhor estruturada
//yarn add express
//criaremos a pasta src para todo código da aplicação, colocaremos
//os arquivos route.js, app.js e server.js dentro dela

//src/App.js:
const express = require('express');
const routes = require('./src/routes');

class App {
  constructor() {
    this.server = express();

    this.middlewares();
    this.routes();
  }

  middlewares() {
    this.server.use(express.json());
  }

  routes() {
    this.server.use(routes);
  }
}

module.exports = new App().server;

//src/server.js:
const App = require('./App');

app.listen(3333);

//Essa separação entre app e server ajuda em um cenário de testes
//unitários(boa prática)

//src/routes.js
const {Router} = require('express');

const routes = new Router();

routes.get('/', (req, res) => {
  return res.json({message: 'Hello World'});
});

module.exports = routes;

//Substituiremos os requires por:
import {Router} from 'express';
import App from './App';
import routes from './src/routes';
//E os module.exports por:
export default routes;
export default new App().server;

//porém essa sintaxe ainda não é comportada pelo node
//Para isso utilizaremos o sucrase:
//yarn add sucrase nodemon -D
//rodar o server com node não funcionará, usaremos o:
//yarn sucrase-node src/server.js

//Para funcionar no nodemon e no debug, precisamos de alguma configurações:
//No package.json, adicionaremos o tradicional dev:
{//...
  "scripts" :{
    "dev": "nodemon src/server.js"
  }
}//...

//Para que o nodemon utilize o sucrase, criaremo o nodemon.json:
{
  "execMap": {
    "js": "node -r sucrase-register"
  } //para todo arquivo js, rode o node registrando o sucrase-register primeiramente
}

//Já para o debug, faremos no package.json:
{//...
  "scripts" :{
    //...
    "dev:debug": "nodemon --inspect src/server.js"
  }
}//...
//Rodaremos e depois configuraremos o debug com:
//yarn dev:debug
//launch.json:
{//...
  "request": "attach",
  //...
  //Removemos o program e colocamos:
  "restart": true, //Faz com que ele restarte o debugger no ponto onde estavamos
  //o restart não é tão impactante, é um detalhe para produtividade, sem ele,
  //basta dar play novamente.
  "protocol": "inspector"
}

//Instalar o docker
//docker run --name database -e POSTGRES_PASSWORD=docker -p 5432:5432 -d postgres
//docker ps (lista todos os containers)
//docket ps -a (all containers)
//docker run <nome>
//docker logs <name>

//faremos o download do postbird para interface gráfica do postgres
//localhost 5432
//criaremos o database, e o resto será feito pela própria aplicação.
