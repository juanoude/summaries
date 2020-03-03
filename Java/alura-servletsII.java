//Aula 1 - Criando o controlador

//Seguindo uma filosofia de limpar e organizar o código, moveremos as classes
// referentes a persistencia de dados e colocaremos no pacote model
//Control + Shift + O - realiza todos imports necessários na classe

//Em seguida iremos colocar todos os servlets referentes a empresa e torná-los
// apenas um

//Servlet é uma forma de atrelar uma requisição HTTP a um objeto Java;

//Criaremos um novo servlet ao link '/entrada' e um único método service
// e também colocaremos um parametro 'acao' indicando a operação a ser realizada:

public class UnicaEntradaServlet extends HttpServlet {
    private static final long serialVersionUID = 1L;

    protected void service(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {

        String paramAcao = request.getParameter("acao");

        if(paramAcao.equals("ListaEmpresas")) {
            ListaEmpresa acao = new ListaEmpresa();
            acao.executa(request, response);
        } else if(paramAcao.equals("RemoveEmpresa")) {
            RemoveEmpresa acao = new RemoveEmpresa();
            acao.executa(request, response);
        } else if(paramAcao.equals("MostraEmpresa")) {
            MostraEmpresa acao = new MostraEmpresa();
            acao.executa(request, response);
        } else if (paramAcao.equals("AlteraEmpresa")) {
            AlteraEmpresa acao = new AlteraEmpresa();
            acao.executa(request, response);
        } else if (paramAcao.equals("NovaEmpresa")) {
            NovaEmpresa acao = new NovaEmpresa();
            acao.executa(request, response);
        }
    }
}

//Como visto, foi criada uma classe para cada acao respectiva:
public class ListaEmpresas {
    public void executa(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        Banco banco = new Banco();
        List<Empresa> lista = banco.getEmpresas();

        request.setAttribute("empresas", lista);

        RequestDispatcher rd = request.getRequestDispatcher("/listaEmpresas.jsp");
        rd.forward(request, response);
    }
}

public class RemoveEmpresa {
  public void executa(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    Banco banco = new Banco();

    String paramId = request.getAttribute("id");
    Integer id = Integer.valueOf(paramId);

    banco.removeEmpresa(id);
    response.sendRedirect("listaEmpresas");
  }
}

public class MostraEmpresa{
  public void executa(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
    String paramId = request.getParameter("id");
    Integer id = Integer.valueOf(paramId);

    Banco banco = new Banco();

    Empresa empresa = banco.buscaEmpresaPelaId(id);

    request.setAttribute("empresa", empresa);

    RequestDispatcher rd = request.getRequestDispatcher("/formAlteraEmpresa.jsp");
    rd.forward(request, response);
  }
}

public class AlteraEmpresa {
    public void executa(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String nomeEmpresa = request.getParameter("nome");
        String paramDataEmpresa = request.getParameter("data");
        String paramId = request.getParameter("id");
        Integer id = Integer.valueOf(paramId);

        System.out.println("acao altera empresa" + id);

        Date dataAbertura = null;
        try {
            SimpleDateFormat sdf = new SimpleDateFormat("dd/MM/yyyy");
            dataAbertura = sdf.parse(paramDataEmpresa);
        } catch (ParseException e) {
            throw new ServletException(e);
        }

        System.out.println(id);

        Banco banco = new Banco();
        Empresa empresa = banco.buscaEmpresaPelaId(id);
        empresa.setNome(nomeEmpresa);
        empresa.setDataAbertura(dataAbertura);

        response.sendRedirect("entrada?acao=ListaEmpresas");
    }
}

//Basicamente só passamos a lógica dos servlets feitos no primeiro curso para classes
//separadas. Depois reorganizamos todos os links da aplicação para a url /entrada

//----------------------------------------------------------------------------------
//Aula 02 - O padrão MVC

//Vamos agora fazer com que o controller que execute o dispatcher ou redirect;
//Primeiro faremos com que o método executa retorne uma string com o nome do arquivo:

//no método:
return 'foward:lista-empresas.jsp';
//ou
return 'redirect:lista-empresas.jsp';

//no Servlet:
String nome = acao.executa();
//...
String[] typeAndAdress = nome.split(':');
if(typeAndAdress[0] == 'foward') {
  RequestDispatcher rd = request.getRequestDispatcher(typeAndAdress[1]);
  rd.foward(request, response);
}else {
  response.sendRedirect(typeAndAdress[1]);
}

//Replicamos essa lógica a todos os caminhos do controller e pronto...

//Outra questão que devemos tratar é o acesso direto a arquivos jsp, pois
//não faz sentido acessá-los sem passar previamente por sua lógica.
//Para isso, colocaremos na pasta WEB-INF\ que é inacessível via browser.
//Depois adaptamos as rotas devido a nova mudança e pronto.


//Para acabar com a sequencia enorme de ifs e se aproximar um pouco mais
//de uma lógica coerente para um controlador. Faremos o seguinte com o Servlet:

//...
String nomeDaClasse = "br.com.alura.gerenciador.acao." + paramAcao;
Class classe = Class.forName(nomeDaClasse);//carrega a classe com o nome
Object obj = classe.newInstance();//deprecated, mas funciona.
String nome = obj.executa(request, response);//Erro:
// nós temos uma referência do tipo Object, mas quem define quais métodos podemos
// chamar é a referência. Como nossa classe Object não possui o método executa()
// que recebe request,response, o código não compila. Também teremos que tratar
// as exceções. Portanto, em seguida faremos:

String nome;
try {
    Class classe = Class.forName(nomeDaClasse);//carrega a classe com o nome
    Acao acao = (Acao) classe.newInstance();
    nome = acao.executa(request, response);
} catch (ClassNotFoundException | InstantiationException | IllegalAccessException e) {
    throw new ServletException(e);
}

// colocaremos todas as classes numa interface como todas possuem mesma assinatura:
public interface Acao {
    public String executa(HttpServletRequest request, HttpServletResponse response)
      throws ServletException, IOException;
}

//e nas classes:
public class AlteraEmpresa implements Acao {
  //...
}

// Repare que nossas ações definem apenas um método. No mundo de padrões de
// projeto, essas classes que encapsulam a execução de algo são chamadas de comandos.
