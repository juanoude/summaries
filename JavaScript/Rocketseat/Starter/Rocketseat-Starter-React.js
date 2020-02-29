//Instalaremos globalemente um módulo do react com transpilador:
npm install --global create-react-app //ou
npm install -g create react-app

// agora criaremos o projeto com:
create-react-web nomedoprojeto

// para testarmos, basta dar o comando e abrir no navegador:
npm start
//O react usa o conceito de componentização. Um componente é uma junção de
//lógica, estrutura e estilização (JS, HTML e CSS). É encapsular essas três
//esferas em apenas um trecho de código.

//agora deletaremos a maioria dos arquivos na pasta src, deixando apenas os 3 js
//Para criar um componente basta extender a classe component do React:
import React, {Component} from "react";

class App extends Component {
  render() {
    return (
      <div className="App"> //className = class do html. Apenas muda pois class é uma palavra reservada no js
        <h1> Hello Rocketseat! </h1>
      </div>
    );
  }
}

export default App;

//O index.js é o primeiro arquivo aberto pela aplicação. está assim:
import React from "react"; //Todas as páginas que utilizam html/jsx precisam "<App/>"
import ReactDOM from "react-dom";//O reactDOM é necessario para a função render
import App from './App';
import registerServiceWorker from "./registerServiceWorker";

ReactDOM.render(<App/>, document.getElementById("root") );//É utilizada uma vez em toda a aplicação
//Pega o componente App e joga dentro do elemento com id="root";
registerServiceWorker();

//Criremos o componente do header, pode ser arquivo components/Header.js ou components/Header/index.js
//Tradicionalmente fariamos:
import React, {Component} from 'react';

class Header extends Component {
  render() {
    return (
      <h1> Hello World </h1>
    );
  }
}

//Com stateless components, conseguimos o mesmo resultado, enxuto com apenas funções:
import React from 'react';
const Header = () => ( //O parentesis no lugar das chaves significam que tudo é um grande return
  <header id="main-header"> JSHunt </header>
);

//Importamos no App.js e inserimos o Header:
import Header from './components/Header'

const App = () => (
  <div className="App">
    <Header/>
  </div>
);

//Agora criaremos o styles.css na pasta do Header, ficando um estilo por componente:
header#main-header {
  width: 100%;
  height: 60px;
  background: #DA552F;
  font-size: 18px;
  font-weight: bold;
  color: FFF;
  display: flex;
  justify-content: center;
  align-items: center;
}

//no index do header importaremos:
import "./styles.css";

//para resetar alguns padrões, faremos um styles.css no src:
* {
  margin: 0;
  padding: 0;
  outline: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  background: #fafafa;
  color: #333;
}


//Agora para fazermos requisições a uma api externa, utilizaremos o axios
//Criaremos o arquivo /src/services/api.js:
import axios from 'axios';

const api = axios.create({
  baseURL: 'https://rocketseat-node.herokuapp.com/api'
});

export default api;

//importamos no App.js
import api from './services/api';


//como separaremos em paginas criaremos a pasta pages/main/index.js:
import React, {Component} from "react";
import api from '../../services/api';
import './style.css';

export default class Main extends Component {
  //Utilizamos o conceito de estado para armazenar variáveis, as quais estão
  //monitoradas pelo JS e mudam responsivamente com cada alteração.
  state {
    products: []
  };

  componentDidMount() { //momento de montagem da página
    this.loadProducts();
  }

//Com exceção das variáveis herdadas, precisamos utilizar arrow function,
//pois na estrutura tradicional de funções não conseguiriamos acessar o escopo 'this'
//Ele não sobrescreve o 'this':
  loadProducts = async () => {
    const response = await api.get('/products');
    this.setState({products: response.data.docs});
  }

  render() {
    const { products } = this.state;
    return (
      <div className='product-list'>
        {products.map(product => (
          <article key={product.id}>
            <strong>{product.title}</strong>
            <p>{product.description}</p>
            <a href='#'> Acessar </a>
          </article>
        ))}
        <h1> contagem de produtos: {this.state.products.lenght} </h1>
      </div>
    );
  }
}

//Criaremos seu style.css na pasta main:
.products-list {
  max-width: 700px;
  margin: 20px auto 0;
  padding: 0 20px;
}
.products-list article {
  background: #fff;
  border: 1px solid #DDD;
  border-radius: 5px;
  padding: 20px;
  margin-bottom: 20px;
}
.products-list article p {
  font-size: 16px;
  color: #999;
  margin-top: 5px;
  line-height: 24px;
}
.products-list article a {
  heigth:52px;
  border-radius: 5px;
  border: 2px solid #DA552F;
  background: none;
  margin-top: 10px;
  color: #DA552F;
  font-weight: bold;
  font-size: 16px;
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: all 0.2s;
}
.products-list article a:hover {
  background: #DA552F;
  color: #fff;
}

//importamos no App.js:
import Main from './pages/main';

const App = () => (
  <div className="App">
    <Header/>
    <Main /> //E inserimos no return
  </div>
);


//Para a paginação, criaremos um novo div:
const {products, productInfo, page} = this.state;

<div className='actions'>
  <button disabled={page===1} onClick={this.prevPage}>Anterior</button>
  <button disabled={page===productInfo.pages} onClick={this.nextPage}>Próxima</button>
</div>

//Estilização:
.product-list .actions {
  display:flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.product-list .actions button {
  padding: 10px;
  border-radius: 5px;
  border: 0px;
  background: #DA552F;
  color: #FFF;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

.product-list .actions button:hover {
  opacity: 0.7;
}

.product-list .actions button[disabled] {
  opacity: 0.5;
  cursor:default;
}
.product-list .actions button[disabled]:hover {
  opacity: 0.5;
}

//No loadProducts precisamos enviar e retornar as informações de paginação:
loadProducts = async (page = 1) => {
  const response = await api.get(`/products?page=${page}`);

  const {docs, ...productInfo} = response.data;

  this.setState({products: docs, productInfo, page);
}


//No state criamos a variavel:
state {
  products: [],
  productInfo: {},
  page: 1
};

//Criando as funções respectivas:
prevPage = () => {
  const {page, productInfo} = this.state;
  if (page === 1) return;
  const pageNumber = page - 1;
  this.loadProducts(pageNumber);
}
nextPage = () => {
  const {page, productInfo} = this.state;
  if (page === productInfo.pages) return;
  const pageNumber = page + 1;
  this.loadProducts(pageNumber);
}



//Agora faremos uma rota para exibir os detalhes dos produtos:
yarn add react-router-dom

//Criaremos o /pages/product/index.js
import React , {Component} from 'react';
import api from '../../services/api';

export default class Product extends Component {
  state = {
    product: {}
  };
  async componentDidMount() {
    const paramId = this.props.match.params;
    const response = await api.get(`/products/${paramId}`);

    this.setState({product: response.data});
  }
  render () {
    return (
      const {product} = this.state;

      <div className='product-info'>
        <h1> {product.title} </h1>
        <p> {product.description} </p>
        <p> URL: <a href={product.url}> {product.url}  </a></p>
      </div>
    );
  }
}

//criaremos um aquivo 'router.js':
import React from 'react';
import {BrowserRouter, Switch, Route} from 'react-router-dom';
import Main from './pages/main'
import Product from './pages/product'

const Routes = () => (
  <BrowserRouter>
    <Switch> //faz com que apenas uma rota seja exibida ao mesmo tempo
      <Route exact path = "/" component = {Main} />
      <Route path = "/products/:id" component = {Product} />
    </Switch>
  </BrowserRouter>
);

export default Routes;


//No App.js o corpo ficará com a tag routes:
import Routes from './routes';
//...
const App = () => (
  <div className="App">
    <Header/>
    <Routes /> //<<<<<<
  </div>
);

//Na página main os links ficarão assim:
import {Link} from 'react-router-dom';
//...
<Link to={`/products/${product._id}`}> Acessar </Link>


//Estilização:
.product-info {
  max-width: 700px;
  margin: 20px auto 0px;
  padding:20px;
  background: #FFF;
  border-radius: 5px;
  border: 1px solid #DDD;
}
.product-info h1 {
  font-size: 32px;
}
.product-info p {
  color: #666;
  line-height: 24px;
  margin-top: 5px;
}
.product-info p a {
  color: #069;
}
