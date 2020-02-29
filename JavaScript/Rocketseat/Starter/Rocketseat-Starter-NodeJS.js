//Após instalar o node, conferiremos se está ok:
node -v
npm -v
//No diretório desejado entraremos com o :
npm init -y //inicia a estrutura, inclusive o package.json

//Instalaremos o express
npm install express

//criando o arquivo server.js:
const express = require("express");//importa o express na constante

const app = express();//chama a função do express

app.get('/', (req, res) => { //na rota /
  res.send('Hello RockeSeat!');
});

app.listen(3001);//escuta a requisição ao server na porta 3001


//Executaremos o servidor com:
node server.js

//Para deixar o node como HOT RELOAD precisaremos do nodemon
npm install -D nodemon

//na aba de scripts(package.json) criaremos o comando para o nodemon:
"scripts": {
  //...
  "dev": "nodemon server.js"
}
//agora pode-se:
npm run dev



//Utilizaremos o docker para conteinerizar nossos software, serão instalações virtuais
//que nem tocarão em nosso sistema.
//Faremos o download e instalaremos o docker, testaremos o comando docker no cmd
 docker pull mongo //baixa o conteiner do mongodb

 docker run --name mongodb -p 27017:27017 -d mongo
 //roda o conteiner de nome mongodb de:para porta1:porta2 com a imagem(preset de container) do mongo

docker ps // mostra o painel de container rodando

//ao entrar na porta respectiva via navegador(localhost:27017) mostrará uma mensagem padrão do mongodb
//caso dê erro 404 ou http tem algo errado;
//Para testar o mongo com uma ferramenta mais poderosa, utilizaremos o robo 3T
//Primeiro instalaremos o robo 3T e criaremos a conexão com localhost:27017

docker ps -a //Mostra também os containers offline
docker start mongodb // starta o container de nome mongodb

//Agora para utilizarmos o banco, instalaremos o mongoose para tratar todo o DB via code
npm install mongoose

//agora, conectaremos com o banco:
//...
const mongoose = require("mongoose");
//...

mongoose.connect("mongodb://locahost:27017/nodeapi", {useNewUrlParser: true});
//Erro de conexão aparecerá no terminal


//Os models seguem o conceito de Schema, que equivale a definição de uma tabela
//Após conectado, faremos nosso primeiro model, criaremos a pasta/arquivo:
//src/models/Product.js
const mongoose = require('mongoose');
const ProductSchema = new mongoose.Schema({
  title: {
    type: String,
    required: true
  },
  description: {
    type: String,
    required:true
  },
  url: {
    type: String,
    required: true
  },
  createdAt:{
    type: Date,
    default: Date.now
  }
});

mongoose.model('Product', ProductSchema);

//Agora no server.js logo após a conexão, faremos:
require('./src/models/Product');
//Porém, ao acumular muitos models fica verboso chamar um por um, portanto:
npm install require-dir //essa ferramenta puxa todos os models de uma vez
//Agora, basta:
const requireDir = require('require-dir');
//...
requireDir('./src/models');

const Product = mongoose.model('Product');

app.get('/', (req, res) => { //na rota /
  Product.create({
    title: 'React Native',
    description:'Build Native apps',
    url: 'http://github.com/facebook/react-native'
  }); //Criando um registro do Schema

  return res.send('Hello RockeSeat!');
});


//Agora separaremos as responsabilidades devidas.
//Primeiramente, isolaremos o roteamento. Cria um arquivo ./src/routes.js:
const express = require('express');
const routes = express.Router();
const ProductController = require('./controllers/ProductController');//?Porque não o ./src?

routes.get('/products', ProductController.index);

module.exports = routes;


//no server.js:
app.use('/api', require('./src/routes'));
//o use é equivalente ao service do java (qualquer req)


//criaremos o arquivo './src/controllers/ProductController.js':
const mongoose = require('mongoose');
const Product = mongoose.model('Product');

module.exports = {
  async index(req, res) {
    const products = await Product.find();
    return res.json(products);
  }
}

//Baixaremos o insomnia para auxiliar no teste de urls, ele formata os
//objetos json e analisa testa também requisições delete, post, etc...
//Basta criar uma nova requição com o link completo. Porém também podemos setar
//a base url para não precisarmos digitá-la sempre:
"base_url": "http://localhost:3001/api"// basta usar a variável agora


//Criaremos agora uma rota de inserção de dados:
module.exports = {
  //index...

  async store(req, res) {
    const product = await Product.create(req.body);
    return res.json(product);
  }
}

//No routes:
routes.post('/products', ProductController.store());

//Para permitir o envio de dados para a aplicação no formato json, deve-se(server.js):
app.use(express.json());
//Agora é possível testar a inserção destes dados pelo insomnia;



//Agora os outros métodos para completar o CRUD:
module.exports = {
  //index...
  async show(req, res) {
    const product = await Product.findById(req.params.id);
    return res.json(product);
  },

  async update(req,res) {
    const product = await Product.findByIdAndUpdate(req.params.id, req.body, {new:true});
    return res.json(product);
  },

  async destroy(req, res) {
    await Product.findByIdAndDelete(req.params.id);
    return res.send(); //Apenas envia uma resposta de sucesso sem conteúdo
  }
  //store...
}

//No routes:
//index...
routes.get('/products/:id', ProductController.show);
routes.put('/products/:id', ProductController.update);
routes.delete('/products/:id', ProductController.delete);
//store...


//Para paginação:
npm install mongoose-paginate

//No models/Product.js:
const mongoosePaginate = require('mongoose-paginate');
//ProductSchema...
ProductSchema.plugin(mongoosePaginate);

//No controller:
async index(req, res) {
  const { page = 1 } = req.query; //url?page=1
  const products = await Product.find({}, { page, limit: 10 });
  return res.json(products);
}

//para conseguirmos acessar externamente nossa api, precisamos do cors.
//Por padrão é vedado
npm install cors

//no server.js
const cors = require('cors');
app.use(cors());
