//A declaração literal de um objeto JavaScript é feita através de {}.
//Podemos adicionar uma ou mais propriedades (separadas por vírgula) na declaração do objeto usando a sintaxe chave : valor.

	var pessoa = {
		nome: 'Flávio Almeida',
		empresa: 'Alura'
	};


//Assim se declara uma função como expressão:
//A variável exibeAlerta recebe como valor uma função anônima.

	var exibeAlerta = function() {
		alert('Sucesso!');
	};


//Podemos adicionar propriedades dinamicamente em um objeto, inclusive funções, como no exemplo:

	var pessoa = {};
	pessoa.fala = function() {
		alert('Olá');
	};


/*O código a seguir funciona, Por mais que estejamos invocando uma função antes de ser declarada,
  devido ao processo de 'function hoisting' todas as declarações de funções são movidas para o topo */

	a();

	function a() {
		b();
	};

	function b() {
		alert('Função b foi chamada');
	};


//Podemos criar funções declarando-as (function declaration) ou através de expressões (function expressions).
//Declaração de função:
	function minhaFuncao() {};

//Expressões de funções:
	var minhaFuncao = function() {};
//ou
	var minhaFuncao = function minhaFuncao() {};


//Um exemplo
//Declaração de função:
	function calculaImposto(valor, acao) {
		return acao(valor);
	};

//Utilização da função:
	var imposto1 = calculaImposto(200, function(valor) {
		return valor * 0.5;
	});
	alert(imposto1);

	var imposto2 = calculaImposto(200, function(valor) {
		return valor * 0.1;
	});
	alert(imposto2);



//Importando a biblioteca core do angular:
<script src="js/lib/angular.min.js"></script>

//Criando o módulo principal> public/js/main.js
angular.module('alurapic', []);

//Associando-os
<html lang="pt-br" ng-app="alurapic">
//O "atributo" ng-app é na verdade uma diretiva do Angular.

//No lugar do termo página, usaremos view. Universo do Angular (framework MVC)!


//Abrindo lacunas(Angular Expressions) na view:
<img class="..." src="{{foto.url}}" alt="{{foto.titulo}}">

//Controller que disponibiliza os dados pra view, ou seja, preenche as AEs
//É uma boa prática declarar cada controller em arquivos separados, mesmo que eles façam parte do módulo alurapic.

//public/js/controllers/fotos-controller.js
angular.module('alurapic').controller('FotosController', function() {
  // definição do controller aqui
});


//associamos o controller:
<body ng-controller="FotosController">


//o seguinte código não funciona pois toda função no JavaScript tem variável local:
var foto = { //colocá-la no escopo global está fora de cogitação (má prática);
		titulo : 'Leão',
		url : 'http://www.fundosanimais.com/Minis/leoes.jpg'
};

//No angular existe uma ponte de ligação entre a view e o controller, o $scope:
angular.module('alurapic').controller('FotosController', function($scope) {

    $scope.foto = {
        titulo : 'Leão',
        url : 'http://www.fundosanimais.com/Minis/leoes.jpg'
    };

});
//A associação de um dado do controller para a view é chamado Data Binding


//Para repetir uma estrutura de acordo com os dados disponíveis:
<div class="panel panel-default" ng-repeat="foto in fotos">//fotos é a coleção e foto é o this pra AE
		<div class="panel-heading">
				<h3 class="panel-title text-center">{{foto.titulo}}</h3>
		</div>
		<div class="panel-body">
				<img class="img-responsive center-block" src="{{foto.url}}">
		</div>
</div>


//Usando o método get através do promise para a repetição:
// public/js/controllers/fotos-controller.js
angular.module('alurapic').controller('FotosController', function($scope, $http) {

    $scope.fotos = [];

    var promise = $http.get('/v1/fotos');
    promise.then(function(retorno) {
        $scope.fotos = retorno.data;
    });
		.catch(function(erro) {
        console.log(erro)
    });
});

//Método get resumido (utiliza o promise implicitamente) para a repetição:
angular.module('alurapic').controller('FotosController', function($scope, $http) {

    $scope.fotos = [];

    $http.get('/v1/fotos')
    .then(function(retorno) {
        $scope.fotos = retorno.data;
    })
    .catch(function(erro) {
        console.log(erro);
    });
});


//Criando uma diretiva para esconder a complexidade da tag:
// public/js/directives/minhas-diretivas.js
angular.module('minhasDiretivas', [])
.directive('meuPainel', function() {

        var ddo = {};

        ddo.restrict = "AE";// Pode ser utilizada como um Atributo e Element(tag)

				ddo.transclude = true;//Para manter o que estiver dentro da tag

        ddo.scope = {
            titulo: '@'//Vai receber o atributo título no template
						//caso o nome chamado no html fosse diferente de titulo, deveria colocar o respectivo nome apos o @
        };

        ddo.template =
                '<div class="panel panel-default">'
            +   '   <div class="panel-heading">'
            +   '        <h3 class="panel-title text-center">{{titulo}}</h3> '
            +   '   </div>'
            +   '   <div class="panel-body" ng-transclude>'
            +   '   </div>'
            +   '</div>'

        return ddo;
    });


//entra como dependencia no main
// public/js/main.js
angular.module('alurapic', ['minhasDiretivas']);

//Uma melhor prática é isolar o html e tirar a contatenação do template:

//public/js/directives/meu-painel.html
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title text-center">{{titulo}}</h3>
	</div>
	<div class="panel-body" ng-transclude>
	</div>
</div>

//No minhasDiretivas ficará:
ddo.templateUrl = 'js/directives/meu-painel.html';

// index.html
<meu-painel ng-repeat="foto in fotos" titulo="{{foto.titulo}}">
		<img class="img-responsive center-block" src="{{foto.url}}" alt="{{foto.titulo}}">
</meu-painel>


//FILTRO DE BUSCA
// public/js/controllers/fotos-controller.js
$scope.filtro = '';

//Precisamos de uma comunicação de duas vias - Two way data Binding
//Angular Expression não serve nesse caso, pois ela só recebe
<input ... ng-model="filtro">

<meu-painel ng-repeat="foto in fotos | filter: filtro">

//inserindo animação de sumiço public/css/efeitos.css
transform: scale(0.1);
//Importar o ng-animate
<script src="js/lib/angular-animate.min.js"></script>

// public/js/main.js - injetando a dependecia
angular.module('alurapic', ['minhasDiretivas', 'ngAnimate']);

//quando usamos a diretiva ng-repeat e um elemento sai da lista ele ganha a
//classe ng-leave, e quando está para sair ng-leave-active.
//public/css/efeitos.css - aumentando a especificidade
.painel-animado.ng-leave-active {
  transform: scale(0.1);// sómente irá acontecer quando tiver as duas classes
}
.painel-animado {
	transition:transform 0.8s;
}

//Para adicionar um delay no filtro, evitar que seja a cada letra
<input ... ng-model-options="{ debounce: 500 }">//ms

/* A diretiva ng-model permite ler e também alterar o model associado (two-way data binding).
É muito comum em telas de cadastro, onde precisamos capturar os dados do usuário para depois
enviá-los numa requisição Ajax, por exemplo. Já a Angular Expression (AE) apenas lê o model (one-way data binding).*/

/*O módulo ngAnimate precisa ser carregado, uma vez que o módulo core angular.min.js
não o carrega automaticamente. Este módulo, apesar do nome sugestivo, não traz qualquer
animação pronta para uso, ele apenas habilita para uma série de diretivas a capacidade
de adicionarem ou removerem classes de acordo com o estado de seus elementos. Fazendo uma
analogia com CSS, é como se fossem pseudo classes.*/


ng-repeat="funcionario in funcionarios | filter: {nome: textoFiltro} "
//quando queremos procurar apenas pelo nome do elemento



//SPAs carregam o head e o body uma vez e buscam os outros conteúdos via Ajax
//para isso deve-se fazer várias páginas parciais à serem buscadas e inseridas

//Importar o ngRoute
<script src="js/lib/angular-route.min.js"></script>
// public/js/main.js - adiciona ao main
angular.module('alurapic', ['minhasDiretivas', 'ngAnimate', 'ngRoute'])
//em seguida:
	.config(function($routeProvider, $locationProvider) {

		$locationProvider.html5Mode(true);

		$routeProvider.when('/fotos', {
        templateUrl: 'partials/principal.html',
        controller: 'FotosController'
		});

		$routeProvider.when('/fotos/new', {
		    templateUrl: 'partials/foto.html'
		});//ainda não criamos o controller

		$routeProvider.otherwise({redirectTo: '/fotos'});

	});

//Na principal abre-se essa tag, onde o conteúdo será buscado
<ng-view></ng-view>
//depois cria-se as parciais
//public/partials/foto.html
//public/partials/principal.html

//no index, coloque:
<base href="/">
/*para usar o html5 mode seu servidor precisa estar preparado, caso contrário,
ele usará o esquema de # antes do caminho definido.*/



//ADICIONANDO NOVA FOTO
//public/partials/foto.html
<div class="page-header text-center">
    <h1>{{foto.titulo}}</h1>
</div>

<form name="formulario" class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Título</label>
            <input name="titulo" class="form-control" ng-model="foto.titulo">
        </div>
        <div class="form-group">
            <label>URL</label>
            <input name="url" class="form-control" ng-model="foto.url">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control" ng-model="foto.descricao">
            </textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>
         <a href="/" class="btn btn-primary">Voltar</a>
        <hr>
    </div>
    <div class="col-md-6">
        <minha-foto url="{{foto.url}}" titulo="{{foto.titulo}}">></minha-foto>
    </div>
</form>

//criando o controller da página
// public/js/controllers/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope) {

        $scope.foto = {};

    });
//importando-o
<script src="js/controllers/foto-controller.js"></script>

//colocando o controle da página no main
// public/js/main.js
$routeProvider.when('/fotos/new', {
		templateUrl: 'partials/foto.html',
		controller: 'FotoController'
});


//Validação do formulário e inclusão via Ajax
//public/partials/foto.html
<form novalidate name="formulario" class="row" ng-submit="submeter()">

<input ... name="titulo" required ng-maxlength="20">>

<span ng-show = "formulario.$submitted && formulario.titulo.$error.required"
class="form-control alert-danger">
		Título obrigatório
</span>
<span ng-show="formulario.$submitted && formulario.titulo.$error.maxlength"
class="form-control alert-danger">
  	No máximo 20 caracteres!
</span>

// public/js/controllers/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope, $http) {

        $scope.foto = {};

        $scope.submeter = function() {

            if ($scope.formulario.$valid) {

                $http.post('/v1/fotos', $scope.foto)
                .success(function() {
                    console.log('Foto adicionada com sucesso');
                })
                .error(function(erro) {
                    console.log('Não foi possível cadastra a foto');
                })
            }
        };
    });

//Para deixar o botão disponível somente quando o formulário estiver válido:
<button type="submit" class="btn btn-primary" ng-disabled="formulario.$invalid">


//Para exibir uma mensagem para o usuário:
<p ng-show="mensagem.length" class="alert alert-info">{{mensagem}}</p>
//alterando levemente o código:
// public/js/controllers/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope, $http) {

        $scope.foto = {};
        $scope.mensagem = '';

        $scope.submeter = function() {

            if ($scope.formulario.$valid) {

                $http.post('/v1/fotos', $scope.foto)
                .success(function() {
                    $scope.foto = {};
                    $scope.mensagem = 'Foto cadastrada com sucesso';
                })
                .error(function(erro) {
                    console.log(erro);
                    $scope.mensagem = 'Não foi possível cadastrar a foto';
                })
            }
        };

    });


//Botoes REMOVER e EDITAR
<div class="row">
    <meu-painel class="col-md-2 painel-animado" ng-repeat="foto in fotos | filter: filtro" titulo="{{foto.titulo}}">
        <minha-foto url="{{foto.url}}" titulo="{{foto.titulo}}">
        </minha-foto>

        <a class="btn btn-primary btn-block" href="">Editar</a>
        <button class="btn btn-danger btn-block" ng-click="remover(foto)">Remover</button>

    </meu-painel>
</div>

<p ng-show="mensagem.length" class="alert alert-info">
    {{mensagem}}
</p>

// Adicionando rota
// public/js/controllers/fotos-controller.js
$scope.remover = function(foto) {

		$http.delete('/v1/fotos/' + foto._id)
		.success(function() {
				$scope.mensagem = 'Foto ' + foto.titulo + ' removida com sucesso!';

		})
		.error(function(erro) {
				$scope.mensagem = 'Não foi possível apagar a foto ' + foto.titulo;
		});
};//nessa estrutura a foto é removida mas não a lista não atualiza.


//assim a foto é removida e a lista atualizada:
$scope.remover = function(foto) {

    $http.delete('/v1/fotos/' + foto._id)
    		.success(function() {
            var indiceDaFoto = $scope.fotos.indexOf(foto);
            $scope.fotos.splice(indiceDaFoto, 1);
            $scope.mensagem = 'Foto ' + foto.titulo + ' removida com sucesso!';

        })
        .error(function(erro) {
            console.log(erro);
            $scope.mensagem = 'Não foi possível apagar a foto ' + foto.titulo;
        });
};


//Editando a foto
//public/js/main.js
$routeProvider.when('/fotos/edit/:fotoId', {
            templateUrl: 'partials/foto.html',
            controller: 'FotoController'
        });

<button ... href="/fotos/edit/{{foto._id}}">


//Adiciona-se o route routeParams
// public/js/controllers/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope, $http, $routeParams) {

        $scope.foto = {};
        $scope.mensagem = '';

        if($routeParams.fotoId) {
            $http.get('/v1/fotos/' + $routeParams.fotoId)
            .success(function(foto) {
                $scope.foto = foto;
            })
            .error(function(erro) {
                console.log(erro);
                $scope.mensagem = 'Não foi possível obter a foto'
            });
        }

        $scope.submeter = function() {

            if ($scope.formulario.$valid) {

                if($routeParams.fotoId) {

                    $http.put('/v1/fotos/' + $scope.foto._id, $scope.foto)
                    .success(function() {
                        $scope.mensagem = 'Foto ' + $scope.foto.titulo + ' foi alterada';

                    })
                    .error(function(erro) {
                        console.log(erro);
                        $scope.mensagem = 'Não foi possível alterar a foto ' + $scope.foto.titulo;
                    });

                } else {
                    $http.post('/v1/fotos', $scope.foto)
                    .success(function() {
                        $scope.foto = {};
                        $scope.mensagem = 'Foto cadastrada com sucesso';
                    })
                    .error(function(erro) {
                        console.log(erro);
                        $scope.mensagem = 'Não foi possível cadastrar a foto';
                    })
                }
            }
        };

    });


// Inserindo os grupos no cadastro
<div class="form-group">
		<label>Grupo</label>
		<select ng-model="foto.grupo" name="grupo" class="form-control"
		required ng-controller="GruposController"
/*Os controller funcionam hierarquicamente, se não achar a diretiva em GruposController ele procurará
no controller dos elementos de parentesco superior, dessa forma é possível ter um controle geral
e pequenos controlers pra cada elemento*/
		ng-options="grupo._id as (grupo.nome | uppercase) for grupo in grupos">
//As opções serão em função de cada id, mas serão exibidas pelo seu nome em caixa alta
				<option value="">Escolha um grupo</option>
		</select>
		<span ng-show="formulario.$submitted && formulario.grupo.$error.required" class="form-control alert-danger">
				Grupo obrigatório
		</span>
</div>


// public/js/controllers/grupos-controller.js
angular.module('alurapic')
    .controller('GruposController', function($scope, $http) {

    $scope.grupos = [];

        $http.get('/v1/grupos')
        .success(function(grupos) {
            $scope.grupos = grupos;
        })
        .error(function(erro) {
            console.log(erro);
        });
    });

//importa
<script src="js/controllers/grupos-controller.js"></script

//gerando uma nova diretiva:
<button class="btn btn-danger btn-block" ng-click="acao()">{{nome}}</button>

// public/js/directives/minhas-diretivas.js
angular.module('minhasDiretivas', [])
    .directive('meuPainel', function() {
        // código omitido
    })
    .directive('minhaFoto', function() {
        // código omitido
    })
    .directive('meuBotaoPerigo', function() {
        var ddo = {};
        ddo.restrict = "E";
        ddo.scope = {
            nome: '@',
            acao : '&'//quando se quer passar uma string usa-se '@', já uma função '&'
        }
        ddo.template = '<button class="btn btn-danger btn-block" ng-click="acao()">{{nome}}</button>';

        return ddo;
    });

//substituindo no html:
<meu-botao-perigo nome="Remover" acao="remover(foto)"></meu-botao-perigo>


//Interagindo com o servidor em alto nível
//importando o resourse
<script src="js/lib/angular-resource.min.js"></script>

//declarando dependencia
angular.module('alurapic', ['minhasDiretivas', 'ngAnimate', 'ngRoute', 'ngResource'])
    .config(function($routeProvider, $locationProvider) {
          // código omitido
    });

//Inserindo $resource para substituir o http
// public/js/controllers/fotos-controller.js
angular.module('alurapic').controller('FotosController', function($scope, $resource) {

		    var recursoFoto = $resource('/v1/fotos/:fotoId');
				...

				recursoFoto.query(function(fotos) {
		        $scope.fotos = fotos;
		    }, function(erro) {
		        console.log(erro);
		    });

				$scope.remover = function(foto) {
			      recursoFoto.delete({fotoId: foto._id}, function() {
			          var indiceDaFoto = $scope.fotos.indexOf(foto);
			          $scope.fotos.splice(indiceDaFoto, 1);
			          $scope.mensagem = 'Foto ' + foto.titulo + ' removida com sucesso!';
			      }, function(erro) {
			          console.log(erro);
			          $scope.mensagem = 'Não foi possível apagar a foto ' + foto.titulo;
			      });
			  };



// substituindo no POST e PUT
// public/js/controllers/foto-controller.js

angular.module('alurapic')
    .controller('FotoController', function($scope, $resource, $routeParams) {

        var recursoFoto = $resource('/v1/fotos/:fotoId', null, {
            'update' : {
                method: 'PUT'
            }
/* a função .save (POST) existe porém a .update (PUT) não, essa sintaxe atribui o recurso
foto com o $resource e ao mesmo tempo cria a função desejada */
        });
					...

        if($routeParams.fotoId) {
            recursoFoto.get({fotoId: $routeParams.fotoId}, function(foto) {
                $scope.foto = foto;
            }, function(erro) {
                console.log(erro);
                $scope.mensagem = 'Não foi possível obter a foto'
            });
        }

        $scope.submeter = function() {

            if ($scope.formulario.$valid) {

                if($routeParams.fotoId) {

                    recursoFoto.update({fotoId: $scope.foto._id},
                        $scope.foto, function() {
                        $scope.mensagem = 'Foto alterada com sucesso';
                    }, function(erro) {
                        console.log(erro);
                        $scope.mensagem = 'Não foi possível alterar';
                    });

                } else {
                    recursoFoto.save($scope.foto, function() {
                        $scope.foto = {};
                        $scope.mensagem = 'Foto cadastrada com sucesso';
                    }, function(erro) {
                        console.log(erro);
                        $scope.mensagem = 'Não foi possível cadastrar a foto';
                    });
                }
            }
        };

    });

/* Porém ainda estamos declarando em diversos lugares diferentes, o ideal
seria declarar em um só lugar e apenas chamá-la nos demais */

//Criando o primeiro serviço
//importando
<script src="js/services/meus-servicos.js"></script>


//declare o serviço como dependencia e remova o resource:
// public/js/main.js
angular.module('alurapic', ['minhasDiretivas', 'ngAnimate', 'ngRoute', 'meusServicos'])
    .config(function($routeProvider, $locationProvider) {

        // código omitido
    });

//remova a declaração do recursoFoto bem como o $resource
// public/js/controllers/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope, recursoFoto, $routeParams){

		});


//Finalmente se cria o serviço declarando o resource
// public/js/servicos/meus-servicos.js
angular.module('meusServicos', ['ngResource'])
    .factory('recursoFoto', function($resource) {

        return $resource('/v1/fotos/:fotoId', null, {
            'update' : {
                method: 'PUT'
            }
        });
    }); // agora o codigo declara o back-end apenas aqui;


//Escondendo a complexidade do controller
//criando novo serviço

angular.module('meusServicos', ['ngResource'])
    .factory('recursoFoto', function($resource) {
        // código omitido
    })
    .factory("cadastroDeFotos", function(recursoFoto, $q) {
        var service = {};
        service.cadastrar = function(foto) {
					return $q(function(resolve, reject) {
							if(foto._id) {
										recursoFoto.update({fotoId: foto._id}, foto, function() {
												resolve({
														mensagem: 'Foto ' + foto.titulo + ' atualizada com sucesso',
														inclusao: false
												});
										}, function(erro) {
												console.log(erro);
												reject({
														mensagem: 'Não foi possível atualizar a foto ' + foto.titulo
												});
										});

								} else {
										recursoFoto.save(foto, function() {
											 resolve({
													 mensagem: 'Foto ' + foto.titulo + ' incluída com sucesso',
													 inclusao: true
										 });
								 }, function(erro) {
											 console.log(erro);
											 reject({
													 mensagem: 'Não foi possível incluir a foto ' + foto.titulo
											 });
									 });
								}
					});
        };
        return service;
    });
/*Uma promise contém o resultado futuro de uma ação.
Quando a ação é bem sucedida, temos acesso ao valor retornado
da ação, através da função then e erros através da função catch.*/

//Alterando agora o controller
// public/js/controller/foto-controller.js
angular.module('alurapic')
    .controller('FotoController', function($scope, recursoFoto, $routeParams, cadastroDeFotos) {
        //código omitido
        $scope.submeter = function() {

            if ($scope.formulario.$valid) {
                cadastroDeFotos.cadastrar($scope.foto)
                .then(function(dados) {
                    $scope.mensagem = dados.mensagem;
                    if (dados.inclusao) $scope.foto = {};
                })//ele quer que limpe o form em caso de inclusão
                .catch(function(erro) {
                    $scope.mensagem = erro.mensagem;
                });
            }
        };
    });



//Exercicio promisse:
//Observe o código como exemplo de promisse
function exibe(texto) {
    return $q(function(resolve, reject) {

        // simulando ação assíncrona com setTimeout

        setTimeout(function() {
            if(texto == 'Alura') {
                resolve('resolvida');
            } else {
                reject('rejeitada')
            }
        }, 5000);
    });
}

// executando nossa promise

exibe('Alura').then(function(resultado) {
    console.log(resultado);
}).catch(function(erro) {
    console.log(erro);
});
console.log('FIM');
/*Uma promisse é executada de maneira assíncrona, o que vale dizer
que ela não bloqueia a continuidade da execução até que sua resposta
seja gerada. Logo, nossa função solicita que a promessa seja
"cumprida" e segue para a impressão de FIM. Quando a promessa de
fato retornar uma resposta, aí sim o programa imprime,
nesse caso, resolvida.*/


//Manipulação do DOM
//O angular permite a manipulação do DOM nas diretivas
angular.module('minhasDiretivas', [])
       // código omitido
    .directive('meuFocus', function() {
        var ddo = {};
        ddo.restrict = "A";
//Pois eu quero alterar o valor tanto na diretiva quando no controller
        ddo.scope = {
					focado: '='
				};

				ddo.link = function(scope, element){
//Angular usa o JQlite, possui menos funções que o jQuery, mas é possível importá-lo.
						scope.$watch('focado', fuction(){
					//é executado toda vez que o valor mudar
								if(scope.focado){
										element[0].focus();
										scope.focado = false;
								}
						})
				}

        return ddo;
    });

<a href="/" meu-focus focado="focado" class="btn btn-primary">Voltar</a>

// public/js/controllers/foto-controller.js
// código anterior omitido
$scope.submeter = function() {

    if ($scope.formulario.$valid) {
        cadastroDeFotos.cadastrar(...)
        .then(...
            // novidade aqui!
            $scope.focado = true;
        })
        .catch(...

// Como o watcher consome muito, a preferência é sempre alternativa

$scope.submeter = function() {

    if ($scope.formulario.$valid) {
        cadastroDeFotos.cadastrar(...)
        .then(...
            // novidade aqui!
            $scope.$broadcast('fotoCadastrada');
        })// esse comando cria e dispara um evento. TOP!
        .catch(...

<a href="/" meu-focus class="btn btn-primary">Voltar</a>
// remove o focado
// public/js/directives/minhas-diretivas.js
    .directive('meuFocus', function() {
        var ddo = {};
        ddo.restrict = "A";
       // não tem mais scope
        ddo.link = function(scope, element) {
/*Diferente dos parâmetros injetados em um controller, no qual a
ordem não importa, a função link possui parâmetros posicionais.
Se invertemos a ordem dos parâmetros teremos sérios problemas
em nossa diretiva.*/
             scope.$on('fotoCadastrada', function() {
                 element[0].focus();
             });
        };
/*Como melhoria final, o broadcast pode ser inserido como serviço, caso outros
códigos queiram capturar o evento e manipular o DOM*/

angular.module('meusServicos', ['ngResource'])
    .factory('recursoFoto', function($resource) {

        return $resource(
					...
        });
    })
    .factory("cadastroDeFotos", function(recursoFoto, $q, $rootScope) {

        // novidade
        var evento = 'fotoCadastrada';
							...
        service.cadastrar = ...
        if(foto._id) {
            recursoFoto.update(...
                // novidade
                $rootScope.$broadcast(evento);
                resolve({ ... }, function(erro) {
                ...
        } else {recursoFoto.save(...

                // novidade
                $rootScope.$broadcast(evento);

              	resolve({
                    ...
                });
            }, function(erro) {
                ...
        return service;
    });


//Exercicio: exemplo de uma diretiva que busca dados 
