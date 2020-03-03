// Aula 01 - Fundamentos Web e a API de Servlets

//Com o JDK, Eclipse (Java EE) e Tomcat instalados, podemos iniciar as atividades:
//Primeiramente, criaremos um 'New > Dynamic Web Project' com o nome de 'gerenciador'  colocaremos
//a opção de gerar o XML de configuração.

//Em seguida vinculamos o projeto no Tomcat. Criamos um arquivo na pasta Webcontent (bemvindo.html):
<html>
  <body>
    Bem-Vindo ao curso de Servlets da Alura.
  </body>
</html>

//Acessamos com o localhost:8080/gerenciador/bemvindo.html e a página aparece
//Dessa forma, podemos criar nosso primeiro Servlet:
import javax.servlet.http.HttpServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet(urlPatterns="/oi")
public class OiMundoServlet extends HttpServlet {
  @Override
  protected void service(HttpServletRequest req, HttpServletResponse resp) throws ... {
    PrintWriter out = resp.getWriter();
    out.println("<html>");
    out.println("<body>");
    out.println("oi mundo, parabens vc escreveu o primeiro servlet.");
    out.println("</body>");

    System.out.println("o servlet OiMundoServlet foi chamado");
  }
}

//É importante reiniciar o servidor para testar plenamente as alterações, apesar do reload automático

//-------------------------------------------------------------------------------------------------------
//Aula 02 - Trabalhando com POST e GET

//Agora criaremos um servlet para o cadastro de empresas:
//Criaremos o seguinte Servlet:'

import java.io.IOException;

@WebServlet("/novaEmpresa")
public class NovaEmpresaServlet extends HttpServlet {

    private static final long serialVersionUID = 1L; //Apenas indica a versão da classe
    //Para parar o warning que o eclipse exibe

    protected void service(HttpServletRequest request, HttpServletResponse response) throws ... {
        System.out.println("Cadastrando nova empresa");

        //Para pegar o parâmetro da url:
        String nomeEmpresa = request.getParameter("nome");

        PrintWriter out = response.getWriter();
        out.println("<html> <body> Empresa " + nomeEmpresa + " cadastrada com sucesso! </body> </html>");

    }
} //Ao enviar o parametro pelo localhost:8080/gerenciador/novaEmpresa?nome=Alura ele exibe a variável.

//Nós usaremos o método post, portanto criaremos a seguinte página:
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Insert title here</title>
</head>
<body>

    <form action="/gerenciador/novaEmpresa" method="post">

        Nome: <input type="text" name="nome" />

        <input type="submit" />
    </form>

</body>
</html>
//Repare que o getParameter continua funcionando perfeitamente.

//Como não faz sentido aceitar parâmetros enviados via get. Substituiremos o metodo service
//pelo método doPost, dessa forma, só serão respondidas as requisições desse tipo.

//--------------------------------------------------------------------------------------------------------
//Aula 03 - Definindo nosso modelo

//criaremos um modelo para as empresas (classe que as representarão):
package exemplo;

public class Empresa {
  private int id;
  private String nome;

  public void setId (int id) {
    this.id = id;
  }
  public int getId() {
    return id;
  }
  public void setNome(String nome) {
    this.nome = nome;
  }
  public String getNome() {
    return nome;
  }
}

//Como não usaremos um banco de dados criaremos uma classe banco, para representá-lo:
import java.util.List;

public class Banco {

  private static List<Empresa> lista = new ArrayList<>();


  static {
        Empresa empresa = new Empresa();
        empresa.setNome("Alura");
        Empresa empresa2 = new Empresa();
        empresa2.setNome("Caelum");
        lista.add(empresa);
        lista.add(empresa2);
    }//Para quando executarmos a lista pela primeira vez haver alguns elementos

  public void adiciona(Empresa empresa){
    lista.add(empresa);
  }
  public void getEmpresas(){
    return Banco.lista;
  }
}

//Já no servlet ficará assim:
@WebServlet("/novaEmpresa")
public class NovaEmpresaServlet extends HttpServlet {

    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        System.out.println("Cadastrando nova empresa");

        String nomeEmpresa = request.getParameter("nome");
        Empresa empresa = new Empresa();
        empresa.setNome(nomeEmpresa);

        Banco banco = new Banco();
        banco.adiciona(empresa);


        PrintWriter out = response.getWriter();
        out.println("<html><body>Empresa " + nomeEmpresa + " cadastrada com sucesso!</body></html>");
    }
}

//Agora criaremos um servlet para retornar a lista de empresas:
@WebServlet("/listaEmpresa")
public class ListaEmpresasServlet extends HttpServlet {
  private static final long serialVersionUID = 1L;

  public void doGet(HttpServletRequest request , HttpServletResponse response)
    throws ServletException, IOException {

    Banco banco = new Banco();
    List<Empresa> lista = banco.getEmpresas();
    PrintWriter out = response.getWriter();

    out.println("<html><body>");
    out.println("<ul>");

    for (Empresa empresa : lista){
      out.println("<li>" + empresa.getNome() + "</li>");
    }

    out.println("</ul>");
    out.println("</body></html>");
  }
}


//--------------------------------------------------------------------------------------
//Aula 04 - JSP

//Nas jsp's é possível colocar tanto código java quanto conteúdos normais de uma página.
//Removeremos o html dos servlets e colocaremos em um arquivo jsp, dentro de WebContent:

<%
  String nomeEmpresa = "Alura";
  System.out.println(nomeEmpresa);
%>

<html>
<body>
  Empresa <%=nomeEmpresa%> cadastrada com sucesso!
</body>//Na jsp, o out é disponível automaticamente para escrita de strings.
</html>//Ex: pode-se usar diretamente out.println(nomeEmpresa);

//Precisamos encaminhar a view jsp pelo servlet:
public class NovaEmpresaServlet extends HttpServlet {
  //...
  RequestDispatcher rd = request.getRequestDispatcher("/novaEmpresaCriada.jsp");
  request.setAttribute("empresa", empresa.getNome());
  rd.forward(request, response);


//No Scriplet(jsp) agora ficará assim:
 String nomeEmpresa = (String) request.getAttribute("empresa");

 //Também faremos o mesmo procedimento para o servlet da listagem de empresas:
 //O jsp respectivo:

 <%@ page import="java.util.List, br.com.alura.gerenciador.servlet.Empresa" %>
 //Todo scriplet com @ em seguida é uma declaração da página.

 <html>
 <body>
    <ul>
      <% List<Empresa> lista = (List<Empresa>)request.getAttribute("empresas");
        for (Empresa empresa : lista) { %>
        <li> <%=empresa.getNome()%> </li>
      <% } %>
    </ul>
 </body>
 </html>

 //O servlet:
 Banco banco = new Banco();
 List<Empresa> lista = banco.getEmpresas();

 request.setAttribute("empresas", lista);
 RequestDispatcher rd = request.getRequestDispatcher("/listaEmpresas.jsp");
 rd.forward(request, response);

//-----------------------------------------------------------------------------------
//Aula 05 - JSTL e Expression Language

//Misturar o scriplet com a jsp é uma má prática, para contorná-la utilizaremos uma expression language:
${3+3} //Elas executam espressões em seu interior, dentre outras coisas. Simples e poderosa.

//Ao refatorar o jsp de nova empresa:
<html>
  <body>
    Empresa ${empresa} cadastrada com sucesso!
  </body>//Ele já busca o atributo com o nome respectivo e imprime em tela.
</html>

//Ao refatorar o jsp da listagem:
<%@ page import="java.util.List, br.com.alura.gerenciador.servlet.Empresa" %>
<%@ taglib uri="http:/java.sun.com/jsp/jstl/core" prefix="c" %>
<html>
  <head>
    <meta charset="ISO-8859-1">
    <title>Java Standard Taglib</title>
  </head>
  <body>
    <ul>
      <c:forEach items="${empresas}" var="empresa">
        <li> ${empresa.nome} </li> //por mais que pareça uma quebra de encapsulamento
      </c:forEach>//Ele utiliza o método get implicitamente. É apenas por elegância visual.
    </ul>
  </body>
</html>


/* Existem outras bibliotecas jsp além da core:
JSTL (Java Standard Tag Library):

core - controle de fluxo
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c"%>

fmt - formatação / i18n (internacionalização)
<%@ taglib uri = "http://java.sun.com/jsp/jstl/fmt" prefix = "fmt"%>

sql - executar SQL - Raramente utilizada

xml - gerar XML - Raramente utilizada */

//Para criarmos um caminho relativo na página:
<c:url value="/novaEmpresa"/> //Ele pegaria o caminho completo

//utilizando a expression language ficaria:
<%@ taglib uri="http:/java.sun.com/jsp/jstl/core" prefix="c" %>
<c:url value="/novaEmpresa" var="linkServletNovaEmpresa"/>
//Cria uma 'variável' que permite utilizar o link em expression language
//...
<form action="${linkServletNovaEmpresa}" method="post">
//...


//Na página jsp da nova empresa, criaremos uma condição para o parâmetro post:
<c:if test="${not empty empresa}">
  Empresa ${empresa} cadastrada com sucesso!
</c:if>

<c:if test="${empty empresa}">
  Nenhuma empresa cadastrada com sucesso!
</c:if>

//Outro exemplo de for pulando de 2 em 2:
<c:forEach var="i" begin="1" end="10" step="2">
  ${i} <br />
</c:forEach>

//Para testarmos o taglib de formatação vamos inserir uma data nas empresas:
//dentro do foreach:
<li>${empresa.nome } ${empresa.dataAbertura }</li>

//Na classe empresa:
import java.util.Date;
//...
private Date dataAbertura = new Date(); //Colocaremos isso apenas para ter data em todos.
//...
public void setDataAbertura(Date dataAbertura) {
        this.dataAbertura = dataAbertura;
public Date getDataAbertura() {
    return dataAbertura;
}

//Como as datas são exibidas num formato estilo "timestamp" para formatá-la:
<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>
//...
//Dentro do for:
<li>${empresa.nome} <fmt:formatDate value="${empresa.dataAbertura}"/> </li>
//Agora a data funciona da seguinte forma: Alura 24 de ago de 2018
//Com o atributo pattern formata-se o padrão:
<li>${empresa.nome} - <fmt:formatDate value="${empresa.dataAbertura}" pattern="dd/MM/yyyy"/> </li>
//agora está 24/08/2018

//Colocaremos no form:
Data Abertura: <input type="text" name="data" />
//No servlet respectivo ao form:
String paramDataEmpresa = request.getParameter("data");
//Porém, o getParameter sempre retorna string
//Como queremos um objeto Date, teremos que parsear com a classe SimpleDateFormat:
SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
Date dataAbertura = sdf.parse(paramDataEmpresa);

//Como o eclipse aponta uma exceção não tratada. Envolveremos tudo em um bloco:
try {
    SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
    Date dataAbertura = sdf.parse(paramDataEmpresa);
} catch (ParseException e) {
        throw new ServletException(e);//Como ao sobrescrever um método, não podemos adicionar exceções novas.
}//Jogaremos a mensagem de erro da exceção original na exceção declarada no método(catch and re-throw).

//Por fim:
Date dataDeAbertura = null;//Como é variável local e precisamos utilizá-la fora do bloco;
//...
empresa.setDataAbertura(dataAbertura);//Atribuindo ao objeto

/*Reparamos que um servlet programado de forma crua, é de baixo nível. Temos que fazer uma
série de tarefinhas técnicas e repetitivas. Existem bibliotecas que auxiliam nesse trabalho
e deixam o código muito mais enxuto. Imagine esse mesmo código com dez parâmetros. */

//------------------------------------------------------------------------------------------------
//Aula 06 - Redirecionando o fluxo

//Em alguns momentos o dispatcher não nos atende, seria o caso de chamarmos a lista de empresas após o cadastro.
//Quando chamamos o outro servlet, ao atualizarmos, ele repete toda a requisição e acaba duplicando a inserção.
//Também como um é post e outro é get deveremos mudar a segunda requisição para service.

//Como alternativa há como devolver uma resposta ao navegador fazendo ele executar uma nova requisição ao servlet
//de listagem. Ao invés de direcionar ao lado do servidor aproveitando apenas a requisição inicial do cliente.
//Isso se dará com o:
response.sendRedirect("listaEmpresas");
//Assim a resposta já conterá uma nova requisição imbutida. Que será oriunda do cliente.
//Porém ainda existe um problema. O nosso request.setAttribute não sobrevive outras requisições. Desaparece.

//-------------------------------------------------------------------------------------------------------
//Aula 07 - Completando o CRUD

//Começaremos pelo remove
//Inicialmente colocaremos o link no laço:
<a href="/gerenciador/removeEmpresa?id=${empresa.id}">remove</a>

//Agora ajustaremos a atribuição do id na classe, criaremos uma "sequence":
//...
private static Integer chaveSequencial = 1;

static {
  Empresa empresa = new Empresa();
  empresa.setId(chaveSequencial++); //Adicionará 1 após usar o valor atual.
  empresa.setNome("Alura");
  Empresa empresa2 = new Empresa();
  empresa2.setId(chaveSequencial++);
  empresa2.setNome("Caelum");
  lista.add(empresa);
  lista.add(empresa2);
}
//...
public void adiciona(Empresa empresa) {
  empresa.setId(Banco.chaveSequencial++);//Quando se adicionar uma nova empresa também
  Banco.lista.add(empresa);
}

//Em seguida, criaremos o RemoveEmpresaServlet:
public class RemoveEmpresaServlet extends HttpServlet {
  private static final long serialVersionUID = 1L;

  protected void doGet (HttpServletRequest request, HttpServletResponse response){
    String paramId = request.getParameter("id"); //Sempre é passado como string
    Integer id = Integer.ValueOf(paramId);//parseando

    Banco banco = new Banco();
    banco.removeEmpresa(id);

    response.sendRedirect("listaEmpresas");
  }

}

//No remove banco:
//Se fazemos uma iteração pelo foreach e modificamos a própria lista iterada
//pode ocorrer erro 500. Portanto, temos como usar o Iterator(java.util) para contornar essa limitação:
  public void removeEmpresa(Integer id) {
    Iterator<Empresa> it = lista.iterator();

    while(it.hasNext()) {
      Empresa emp = it.next();

      if(emp.getId() == id) {
        it.remove();
      }
    }
  }

//Agora faremos o update:
//Primeiro criaremos o mostra empresa
<a href="/gerenciador/mostraEmpresa?id=${empresa.id}">editar</a>

//agora o Servlet respectivo:
@WebServlet("/mostraEmpresa")
public class MostraEmpresaServlet extends HttpServlet {
    private static final serialVersionUID = 1L;

    protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        String paramId = request.getParameter("id");
        Integer id = Integer.valueOf(paramId);

        Banco banco = new Banco();

        Empresa empresa = banco.buscaEmpresaPelaId(id);

        request.setAttribute("empresa", empresa);

        RequestDispatcher rd = request.getRequestDispatcher("/formAlteraEmpresa.jsp");
        rd.forward(request, response);

    }
}

//Agora criaremos a função buscaEmpresaPelaId():
public Empresa buscaEmpresaPelaId(Integer id) {
  for (Empresa empresa : lista) {
    if(empresa.getId() == id){
      return empresa;
    }
  } return null;
}

//E a página jsp:
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c" %>
<%@ taglib uri="http://java.sun.com/jsp/jstl/fmt" prefix="fmt" %>
<c:url value="alteraEmpresa" var="linkServletAlteraEmpresa" />
//...
<form action="${linkServletAlteraEmpresa }" method="post">
    Nome: <input type="text" name="nome" value="${empresa.nome}"/>
    Data Abertura: <input type="text" name="data" value="${empresa.dataAbertura}" pattern="dd/MM/yyyy"/>
    <input type="hidden" name="id" value="${empresa.id}">
    <input type="submit" />

//Agora falta apenas criar o servlet que efetivamente altera:
  @WebServlet("/alteraEmpresa")
  public class AlteraEmpresaServlet extends HttpServlet {

    private static final long serialVersionUID = 1L;

    protected void doPost(HttpServletRequest request, HttpServletResponse response){
      String nomeEmpresa = request.getParameter("nome");
      String paramDataEmpresa = request.getParameter("data");
      String paramId = request.getParameter("id");
      Integer id = Integer.valueOf(paramId);

      Date dataAbertura = null;
        try {
            SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
            dataAbertura = sdf.parse(paramDataEmpresa);
        } catch (ParseException e) {
            throw new ServletException(e);
        }

      Banco banco = new Banco();
      Empresa empresa = banco.buscaEmpresaPelaId(id);
      empresa.setNome(nomeEmpresa);
      empresa.setDataAbertura(dataAbertura);

      response.sendRedirect("listaEmpresas"); //Redirecionamento
    }
  }

//------------------------------------------------------------------------------------
//Aula 08 - Deploy da aplicação

//Apesar do web.xml estar mais obsoleto nos dias de hoje, é útil que tenhamos noções
//de como ele funciona. Hoje em dia ele não é mais obrigatório, porém ainda possui
//algumas configurações interessantes, como o tempo de uma sessão por exemplo.

//Desse jito que ficaria o mapeamento que fizemos por meio de anotação no web.xml:
<?xml version="1.0" encoding="UTF-8"?>
<web-app xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns="http://xmlns.jcp.org/xml/ns/javaee" xsi:schemaLocation="http://xmlns.jcp.org/xml/ns/javaee http://xmlns.jcp.org/xml/ns/javaee/web-app_4_0.xsd" id="WebApp_ID" version="4.0">
  <display-name>gerenciador</display-name>
  <welcome-file-list>
    <welcome-file>bem-vindo.html</welcome-file>
  </welcome-file-list>

  <servlet>
    <servlet-name>OiMundoServlet</servlet-name>
    <servlet-class>br.com.alura.gerenciador.servlet.OiMundoServlet</servlet-class>
  </servlet>

  <servlet-mapping>
    <servlet-name>OiMundoServlet</servlet-name>
    <url-pattern>/ola</url-pattern>
  </servlet-mapping>
</web-app>

//Tudo o que podemos fazer em anotações, podemos realizar também
//no arquivo web.xml, e às vezes um pouco mais.

//Um Servlet é um objeto que responde a uma requisição http, cujos
//métodos correspondem as requisições possíveis. Repare que em nenhum momento
// o Servlet foi instanciado em um método main(). Na verdade isso é feito pelo
// Servlet container (tomcat), ele que intermedia e gerencia a relação entre
// requisições e criação de objetos, isso o torna um middleware.

//Para testar tal criação, colocaremos um construtor simples:
    public oiMundoServlet() {
        System.out.println("Criando Oi Mundo Servlet");
    }
//Quando iniciamos o tomcat, nada acontece, porém quando entramos na url, ele
// cria o objeto. Ao recarregarmos a página diversas vezes, ele não cria uma nova
// instância, ele reaproveita o objeto na memória. Ou seja, é um Singleton, um
// escopo, que sobrevive no projeto por tempo indeterminado enquanto o Tomcat
// estiver no ar, sem nunca recriá-lo.

// Esse assunto faz parte de um tópico que chamamos de inversão de controle,
// em inglês IOC (-Inversion Of Control). Isso significa que o método main()
// é quem instancia o objeto, mas no caso do nosso projeto em realiza esse
// processo é o Tomcat, nós apenas criamos as classes.

//É possível fazer com que o tomcat instancie mesmo sem a url ser acionada:
@WebServlet(urlPatterns="/oi", loadOnStartup=1);
//...

//Para fazer o deploy da aplicação, começaremos exportando nosso projeto como um
//arquivo '.war', em seguida, extrairemos toda a estrutura do tomcat para o disco
//D: colocaremos o arquivo .war

//O arquivo war não passa de um zip, se o renomearmos veremos todos os arquivos
//do projeto compactados.

//Colocaremos o projeto dentro da pasta 'webapps'. Acessaremos a pasta do projeto
// via terminal e executaremos dentro da pasta bin o arquivo startup.bat

//Nas variáveis de ambiente há como alterar a versão do java que o tomcat vai puxar

//Na pasta conf, no arquivo server.xml há como configurar a porta 80, que é a porta
//padrão.
<Connector port="80" protocol="HTTP/1.1"
        connectionTimeout="20000"
        redirectPort-"8443" />
