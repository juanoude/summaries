//Para instalar o ambiente necessário para o react native, é um pouco chato e
//de muitos passos. No site oficial possui todo o processo.
//Iniciando o projeto:
react-native init nomeDoProjeto

//Na pasta do projeto:
react-native run-android
//E o aplicativo rodará no dispositivo virtual

//Agora o terminal iniciará o bundler, depois desses passos, os comandos anteriores
//não serão necessários, posteriormente, apenas o bundler será startado para testar
//a aplicação no emulador. O bundler starta com:
react-native start

//Essa é uma estrutura básica apenas para observarmos a arquitetura do código no RN
//No nosso App.js deletaremos alguns pontos e deixaremos apenas:
import React, {Component} from 'react';
import {Platform, StyleSheet, Text, View} from 'react-native';

export default class App extends Component {
  render() {
    return (
      <View style={styles.container}>
        <Text style={styles.welcome}> Welcome to this Bang! </Text>
        <View style={styles.box}/>
      </View>
    );
  }
}

//Todos componentes no RN são display flex, naturalmente.
const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: "center",
    alignItems: "center",
    backgroundColor: "#F5FCFF"
  },
  welcome: {
    fontSize: 20,
    textAlign: "center",
    margin: 10
  },
  box: {
    width: 60,
    height: 60,
    backgroundColor: "#F00"
  }
});

//Agora para fazer a parte de navegação, instalaremos:
yarn add react-navigation

//Criaremos uma pasta src e nela o route.js index.js e pages/main.js
//main.js:
import React, {Component} from 'react';
import {View, Text} from 'react-native';

export default class Main extends Component {
  static navigationOptions = {
    title: "JSHunt"
  }

  render() {
    return (
      <View>
        <Text> Página Main </Text>
      </View>
    );
  }
}

//routes.js:
import {createStackNavigator} from 'react-navigation';
import Main from './pages/main'

export default createStackNavigator({
  Main
});

//index.js:
import React from 'react';
import Routes from './routes';

const App = () => <Routes/>;
//Lembrando que isso equivale a:
// class App extends Component {
//   render() {
//     return (
//       <Routes />
//     );
//   }
// }

export default App;
//Todo componente deve se exportar por padrão;

//Agora no index do diretório raiz, substituiremos a referencia no App.js e o deletaremos
//...
import App from './src';
//...


//Para estilizar o header da aplicação. Faremos:
//route.js:
export default createStackNavigator ({
  Main
}, {
  navigationOptions: {
    headerStyle: {
      backgroundColor: "#DA552F"
    },
    headerTintColor: "#FFF"
  }
});

//src/config/StatusBarConfig.js:
import {StatusBar} from 'react-native';

StatusBar.setBackgroundColor('#DA552F');//para o android
StatusBar.setBarStyle('light-content');

//Agora no src/index.js:
import './config/StatusBarConfig';//Pronto, funcionando perfeitamente.


//Para pegarmos os dados da api, criaremos o src/services/api.js:
import axios from 'axios';

const api = axios.create({
  baseURL: 'https://rocketseat-node.herokuapp.com/api'
});

export default api;

//No pages/main.js faremos a requisição e receberemos os dados:
import React, {Component} from 'react';
import api from '../services/api';
import {Text, View, FlatList, TouchableOpacity, StyleSheet} from 'react-native';

state = {
  product: []
};
componentDidMount() {
  this.loadProducts();
}

loadProducts = async () => {
  const response = await api.get('/products');
  const {docs} = response.data;
  this.setState({products: docs});
}

renderItem = (item) => (
  <View style = {styles.productContainer}>
    <Text style = {styles.productTitle}> {item.title} </Text>
    <Text style = {styles.productDescription}> {item.description} </Text>
    <TouchableOpacity style = {styles.productButton} onPress = { () => {} }>
      <Text style = {styles.productButtonText}> Acessar </Text>
    </TouchableOpacity>
  </View>
);

render() {
  return (
    <View style = {styles.container}>
      <FlatList
        style = {styles.list}
        data = {this.state.products}
        keyExtractor = {item => item._id}
        renderItem = {this.renderItem}
      />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: "#fafafa"
  },
  list: {
    padding: 20
  },
  productContainer: {
    backgroundColor: "#FFF",
    borderWidth: 1,
    borderColor: '#DDD',
    borderRadius: 5,
    padding: 20,
    marginBottom: 20
  },
  productTitle: {
    fontSize: 18,
    fontWeight: "bold",
    color: "#333"
  },
  productDescription:{
    fontSize: 16,
    color: "#999",
    marginTop: 5,
    lineHeight: 24
  },
  productButton: {
    height: 42,
    borderRadius: 5,
    borderColor: "#DA552F",
    backgroundColor: 'transparent',
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 10
  },
  productButtonText: {
    fontSize: 16,
    color: '#DA552F',
    fontWeight: 'bold'
  }
});

//Agora criaremos a função de paginação:
//main.js:
//...
state ={
  //...
  productInfo: {},
  page: 1
}
//...
loadProducts = async (page = 1) => {
  const reponse = await api.get(`/products?page=${page}`)
  const {docs, ...productInfo} = response.data;
  this.setState({products: [...this.state.products, ...docs], productInfo, page});
}

//Adicionaremos os atributos no FlatList:
onEndReached={this.loadMore}
onEndReachedThreshold = {0.1} //10% do fim ele chama

//criando a função chamada:
loadMore = () => {
  const {page, productInfo} = this.state;

  if(page === productInfo.pages) return;

  const pageNumber = page + 1;

  this.loadProducts(pageNumber);
};



//Agora faremos a funcionalidade de acessar o links externos dos butões por webview:
//Criaremos o pages/product.js:
import React from 'react';

const Product = ({navigation}) => (
  <WebView source = {{uri: navigation.state.params.product.url}} />
);

Product.navigationOptions = ({navigation}) => ({
  title: navigation.state.params.product.title
});

export default Product;

//No routes.js:
import Product from './pages/product';
//...
Main,
Product
//...


//Na propriedade do botao com o link:
<TouchableOpacity
//...
onPress={ () => {
  this.props.navigation.navigate('Product', {product: item});

}}/>
