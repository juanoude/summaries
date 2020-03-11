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

//Agora o que faremos é estabelecer um padrão de código entre todos os programadores
//do projeto. Utilizaremos o padrão da Airbnb.
//yarn add eslint -D
//yarn eslint --init
//instalaremos a extensão do eslint do VSCODE

//Com as configurações atuais, o vscode já irar apontar qualquer sintaxe fora do padrão
//como um erro, em que podemos observar visualmente e arrumarmos manualmente. Porém é
//possível configurar para automatizar a maioria das correções ao salvar:
//Acessamos Open Settings(JSON) no vscode:
"[javascript]": {
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true,
  }
}

"[javascriptreact]": {
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true,
  }
}

//No eslintrc.js:
//...
rules: {
  "class-methods-use-this": "off", //Todos métodos de classe com o this.
  "no-param-reassign": "off", //Não permire alterar parametros.
  "camelcase": "off", //Obriga o camelcase nas variáveis
  "no-unused-vars": ["error", { "argsIgnorePattern": "next"}],//não deixa variáveis inutilizadas.
}

//Agora instalaremos o prettier, que também adaptará nosso código mas de uma forma focada em estética:
//yarn add prettier eslint-config-prettier eslint-plugin-prettier -D
//.eslintrc:
//...
extends:['airbnb-base', 'prettier'],
plugins: ['prettier'],
//...
rules: {
  "prettier/prettier": "error", //prettier retorna um erro do eslint
  //...
}

//criaremos o .prettierrc:
{
  "singleQuote": true,
  "trailingComma": "es5"
}

//para dar uma geral em todos os arquivos js com o eslint:
//yarn eslint --fix src --ext .js

//Instalaremos a extensão editorconfig do vscode e criaremos o .editorconfig:
//alteraremos apenas o:
// trim_trailing_whitespace = true
// insert_final_newline = true



//Agora iremos passar a usar o sequelize para interagir com o postgres e organizaremos
//tudo de acordo com o padrão mvc.
//Criaremos a pasta src/app, onde ficarão a pasta controllers e models
//Criaremos a pasta src/database com a subpasta migrations
//Criaremos a pasta src/config com o arquivo database.js
//yarn add sequelize
//yarn add sequelize-cli -D
//Criaremos o arquivo .sequelizerc:
const { resolve } = require('path');

module.exports = {
  //daremos o caminho do arquivo de configuração
  config: resolve(__dirname, 'src',  'config', 'database.js'),
  //daremos o caminho da pasta de models
  'models-path': resolve(__dirname, 'src',  'app', 'models'),
  //daremos o caminho da pasta de models
  'migrations-path': resolve(__dirname, 'src',  'database', 'migrations'),
  //daremos o caminho da pasta de models
  'seeds-path': resolve(__dirname, 'src',  'database', 'seeds'),
};
//O sequelize não entende import export. Sintaxe antiga obrigatória.
//No src/config/database.js:
module.exports = {
  dialect: 'postgres',
  host: 'localhost',
  username: 'postgres',
  password: 'docker',
  database: 'gobarber',
  define: {
    timestamps: true,
    underscored: true,//nomes das tabelas criadas no padrão underline
    underscoredAll: true //nomes das colunas e relacionamentos criados no padrão underline
  }
};
//yarn add pg pg-hstore


//Para criar nossa primeira migration:
//yarn sequelize migration:create --name=create-users
//dentro do src/database/migrations haverá um arquivo novo equivalente.
//Complementaremos com código:
'use strict';

module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable('users', {
      id: {
        type: Sequelize.INTEGER,
        allowNull: false,
        autoIncrement: true,
        primaryKey: true
      },
      name: {
        type: Sequelize.STRING,
        allowNull: false
      },
      email: {
        type: Sequelize.STRING,
        allowNull: false,
        unique: true
      },
      password_hash: {
        type: Sequelize.STRING,
        allowNull: false
      },
      provider: {
        type: Sequelize.BOOLEAN,
        defaultValue: false,
        allowNull: false
      },
      created_at: {
        type: Sequelize.DATE,
        allowNull: false
      },
      updated_at: {
        type: Sequelize.DATE,
        allowNull: false
      }
    });
  },
  down: (queryInterface) => {
    return queryInterface.dropTable('users');
  }
};

//Para migrar:
//yarn sequelize db:migrate
//Na tabela sequelizemeta, tem o histórico de migrations feitas
//Para desfazer:
//yarn sequelize db:migrate:undo

//Criando o model do usuario:
//model/User.js
import Sequelize, { Model } from 'sequelize';

class User extends Model {
  static init(sequelize) {
    super.init({
      name: Sequelize.STRING,
      email: Sequelize.STRING,
      password_hash: Sequelize.STRING,
      provider: Sequelize.BOOLEAN
    },
    {
      sequelize,
    });
  }
}

export default User;


//Agora criaremos a conexão com o banco e o carregamento de todos os models:
//src/database/index.js
import Sequelize from 'sequelize';
import databaseConfig from '../config/database';
import User from '../models/User';

const models = [User];

class Database {
  constructor() {
    this.init();
  }
  init() {
    this.connection() = new Sequelize(databaseConfig);

    models.map(model => model.init(this.connection));
  }
}

export default new Database();

//Na rota colocaremos uma lógica para testar a inserção:
//...
import User from './app/model/User';
//...
routes.get('/', async (req, res) => {
  const user = await User.create({
    nome: 'Juanoude das garça',
    email: 'dasgarça@hotmail.com',
    password_hash: 'quedasgarçaéessa',
  });

  return res.json(user);
});
//No log aparecem as querys executadas pela aplicação.


//Agora criaremos o controller e extrairemos a lógica do routes:
//src/app/controller/UserController.js:
import User from '../models/User';

class UserController {

  async store(req, res) {
    const userExists = await User.findOne({ where: { email: req.body.email } });

    if(userExists) {
      return res.status(400).json({ error: 'Email already exists.'});
    }

    const user = await User.create(req.body);

    return res.json(user);

    //para retornarmos apenas alguns campos fariamos:
    // const { id, email, name, provider } = await User.create(req.body);
    // return res.json({
    //   id,
    //   name,
    //   email,
    //   provider
    // });
  }
}

export default new UserController();

//agora nosso routes ficará assim:
import { Router } = from 'express';
import UserController from './app/controllers/UserController';

const routes = new Router();

routes.post('/users', UserController.store);

export default routes;

//Agora para testar no insomnia, criaremos um novo workspace e estabeleceremos
//uma nova variavel no manage enviroments:
{
  "base_url": "http://localhost:3333"
}
//faremos a requisição post e verificamos a inserção

//Agora faremos a lógica do hash de senha:
//yarn add bcryptjs
//No model faremos:
import bcrypt from 'bcryptjs';
import Sequelize, { Model } from 'sequelize';

class User extends Model {
  static init(sequelize) {
    super.init({
      name: Sequelize.STRING,
      email: Sequelize.STRING,
      password: Sequelize.VIRTUAL,
      password_hash: Sequelize.STRING,
      provider: Sequelize.BOOLEAN
    },
    {
      sequelize,
    });

    this.addHook('beforeSave', async (user) => {
      if(user.password) {
        user.password_hash = await bcrypt.hash(user.password, 8);
      }
    });

    return this; //Parece opcional;
  }
}

export default User;



//Agora utilizaremos o Json Web Token para autenticar nossas sessões:
//Criaremos em um novo controller, pois estamos criando uma sessão e não um
//usuário, um controller não pode ter dois métodos store()
//yarn add jsonwebtoken
//src/app/controllers/SessionController.js:
import jwt from 'jsonwebtoken';

import authConfig from '../../config/auth';
import User from '../models/User';

class SessionController {
  async store(req, res) {
    const { email, password } = req.body;
    const user = await User.findOne({ where: { email } });

    if(!user){
      return res.status(401).json({ error: 'User not found'});
    }

    if(!(user.checkPassword(user.password))){
      return res.status(401).json({ error: 'Password does not match'});
    }

    const { id, name } = user;

    return res.json({
      user: {
        id,
        name,
        email
      },//O segundo atributo que devolveremos é o token
      //Para assinar temos que colocar o payload { id },
      //para termos acesso a essa informação futuramente pelo próprio token:
      token: jwt.sign({ id }, authConfig.secret, { //Depois uma senha interna da api
        ExpiresIn: authConfig.expiresIn //por último colocamos o tempo de vida dele.
      }),
    });
  }
}

//No model do usuário criaremos uma função para checar a senha:
checkPassword(password) {
  return bcrypt.compare(password, this.password_hash);
}

//No routes, colocaremos a nova rota:
import SessionController from './app/controllers/SessionController';
routes.post('/sessions', SessionController.store);

//A senha interna será guardada no src/config/auth.js:
export default {
  secret: 'códigoSecretoEmMd5',
  expiresIn: '7d'
};

//Uma vez criado o token, se atrela o atributo Authorization: Bearer (token) no header das requisições
//Para impedir que usuários não logados executem certos procedimentos, faremos um middleware:
//src/app/middleares/auth.js:
import jwt from 'jsonwebtoken';
import authConfig from '../../config/auth';
import {promisify} from 'util';

export default async(req, res, next) => {
  const authHeader = req.header.authorization;

  if(!authHeader) {
    res.status(401).json({ error: 'Token not provided' });
  }

  const [, token] = authHeader.split(' '); //Divide pelo espaço e pega apenas o segundo elemento

  try {
    //a função promisify retorna uma função de callback em forma de promise
    const decoded = await promisify(jwt.verify)(token, authConfig.secret);
    req.userId = decoded.id;

    return next();

  }catch(error) {
    return res.status(401).json({ error: 'Invalid Token' });
  }

  return next();
}

//No routes:
import authMiddleware from './app/middleares/auth';
//Rotas que não exigem autorização
routes.use(authMiddleware);
//Rotas que exigem a autenticação
//...


//Agora no controller do usuário faremos o update:
async update(req, res) {
  const {email, oldPassword} = req.body;
  const user = await User.findByPk(req.userId);

  if(email && email != user.email) {
    const userExists = await User.findOne({ where: { email }});
    if(userExists) {
      res.status(400).json({ error: 'Email already exists' });
    }
  }
    if(oldPassword && !(await user.checkPassword(oldPassword))) {
      res.status(400).json({ error: 'Password does not match' });
    }

    const {id, name, provider} = await user.update(req.body);

  return res.json({
    id,
    name,
    email,
    provider
  });
}

//No routes:
routes.put('/users', UserController.update);
