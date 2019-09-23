<?php //Aula 01
  //Após instalar e criar a conta no github deve-se criar a chave para a máquina
  ssh-keygen -t rsa -C "seuemail@provedor.com" //Após isso crie uma senha
  //Logue no github e insira uma nova chave ssh com o conteúdo do arquivo '.pub'

  //Para copiar um projeto para sua máquina utilize:
  git clone https://github.com/usuario/repositorio.git

  //normalmente o versionamento é representado pelas tags.São livres para serem usados como preferirem
  git tag //Lista todas as tags

  //Voltar o repositório para alguma versão:
  git checkout v0.1

  git diff v0.1 v0.2// mostra as mudanças entre as duas versões

  git blame index.html // mostra quem realizou as mudanças linha a linha

 ?>

<?php //Aula 02

  //Criando um novo diretorio
  mkdir curso-git //criou
  cd curso-git //entrou
  git init //transformou em um projeto git

  git ls-files //Mostra os arquivos que pertencem ao repositorio atualmente ('tracked'/'commited')

  git status // mostra a lista de arquivos do diretório e seus status

  git add arquivo.php //Passa o status do arquivo para 'tracked'

  //Para fazer o primeiro commit, precisa-se configurar o usuário que executou as modificações
  git config user.name "Juan Ananda Araújo Rolón"
  git config user.email "juanoude@gmail.com"
  //dessa forma altera-se para o repositorio atual
  //Para mudar para todo o sistema utiliza-se:
  git config --global user.name "Juan Ananda Araújo Rolón"
  git config --global user.email "juanoude@gmail.com"

  git -commit -m "Comentário sobre o commit"

  //Adicionando vários arquivos:
  git add arquivo1 arquivo2
  git add CaminhoDeUmDiretorio
  git add . // O '.' representa o diretorio atual. Adiciona tudo.

/* Durante o ciclo básico que demonstramos anteriormente, nós interagimos com 3 estágios diferentes do repositório.
O primeiro deles enquanto nós criamos o repositório, mas não indicamos nenhum arquivo para ser rastreado.

 * Nesse estágio, estamos interagindo com um estado do projeto que chamamos de "Working Directory", ou seja, é o nosso
sistema de arquivos atual. Nele estão as alterações que estamos realizando no momento.

 * O Working Directory pode estar "limpo", quando não há diferença entre os arquivos armazenados no repositório e
 como estão atualmente. Quando há diferença (por exemplo, alteramos determinado arquivo, mesmo que uma alteração mínima),
 o Working Directory fica marcado como "sujo".

 * Em nosso caso o arquivo não existia para se ter uma comparação, pois tínhamos um repositório novo. Após modificarmos
 nossos arquivos a ponto de definirmos que um "passo" foi concluído, criamos uma visão desse passo, um ponto de controle
 preliminar com o comando "git add".

 * Esse comando cria um novo estágio do repositório, o que chamamos de "Index" ou "Staging Area". Esse estágio é transitório
 e pode ser alterado ainda antes de se tornar um passo do projeto: podemos adicionar novos arquivos, removê-los ou mesmo
 alterá-los.

 * Quando satisfeitos com o conteúdo do "Index", utilizamos o comando "git commit" para persistí-lo, gravar esse passo com
 todos os arquivos novos e alterações efetuadas. O comando "commit" criou um terceiro estágio do repositório que conhecemos
 como "HEAD". O HEAD é o último estado que o Git usa como referência, é a visão do último passo do projeto que foi concluído
 e entregue.
 */

 git add -i // É o modo interativo da adição do git. Onde se exibe um menu de ações referentes a staging area.

 git commit --help //Ajuda
 git commit -a //Commita tudo sem passar pelo Index/Staging Area. Gera um commit que inclui todas as modificações

 ?>

<?php //Aula 3
  //Primeiro se cria o repositorio remoto no github
  git remote add [alias_do_repositorio] [uri_do_repositorio] // linka o repositório remoto com o local
  //exemplo usado no curso:
  git remote add origin https://github.com/[seu_nome_de_usuario]/curso-git.git
  //Ao executarmos o comando, nenhuma saída é mostrada no prompt
  git push origin master // envia os commits para o repositorio remoto na branch declarada
  //Para clonar o repositório e
  git clone [link_do_repositorio] meuprojeto// clona o repositorio com o nome do seu projeto, não o do repositório
  //É aconselhável manter o mesmo nome / o clone já linka o repositório e nomea como origin automaticamente
  git pull origin master //Atualiza o seu repositório de acordo com as mudanças alheias

  git log //visualiza o log de commits;
  //O log de commits pode ser encontrado no https://github.com/[seu_usuario_no_github]/[projeto]/commits/master
  git whatchanged //mostra todos o log de commits com o nome dos arquivos modificados.

 ?>

<?php //Aula 4

  //Branchs são divisões, onde as modificações são isoladas da principal, para no futuro serem fundidas.
  git branch //mostra as branchs existentes e qual você se encontra;
  git branch -r //mostra as branchs remotas
  git branch -a //lista as remotas e locais
  git branch design //cria a branch "design"
  git checkout design //troca de branch para "design"
  //depois de adicionar e commitar, ambos não ocorrerão na branch principal.

  git fetch origin //Busca e traz as atualizações do repositório origem com relação ao principal
  //verifica todas as atualizações que foram realizadas no repositório central

  git push -u origin design // Envia a branch para o repositório remoto que foi criado pela primeira vez localmente
  //Ele cria a branch no remoto e linka com a local em um só comando.
  //setta o mapeamento entre a branch remota e a branch local

  git branch -t design origin/design //Seta a configuração de relacionamento entre branch remota e local
  //Traz a branch remota pela primeira vez e cria a local equivalente. 'Copia'

  git branch -d [nomedabranch] //deleta a branch respectiva
  git push -d origin design //deleta a branch remota

?>

<?php //Aula 05

  /*O git falhará o comando de push se outra pessoa o fez antes de você, para isso você deve unificar as modificações
  de forma a fundir os dois lados.*/
  // Dessa forma faremos o git pull para unir as alterações:
  git pull // apenas isso é suficiente para realizar os merges que não se conflitam.
  //Quando um merge conflita, logo após realizar seu pull ele indicará o arquivo da modificação
  //Basta abrir o arquivo e selecionar a mudança mais pertinente.

 ?>

<?php //Aula 06
  //Há um fluxo no qual se evita os merges - boa prática - pois muitos merges geram confusão e poluem os logs
  //Para isso primeiro se cria uma branch local
  git checkout -b desenvolvimento //Cria e troca para a branch criada
  //Após executar alguns commits na branch de desenvolvimento local, verificamos se a branch master possui alguma atualização:
  git checkout master // Trocando pra master
  git pull // Verificando atualizações
  // Caso haja atualizações nesse momento, temos um problema, pois o repositório base já mudou, se jogarmos na branch principal
  // haverão muitos conflitos e os logs ficarão confusos. Nesse caso, existe o comando rebase:
  git checkout desenvolvimento // Vamos para a branch local a ser restruturada
  git rebase master // renova a base de commits da branch local de acordo com a master e resolve os conflitos commit a commit.
  //Caso haja um conflito, basta resolvê-lo no arquivo manualmente e prosseguir com o proximo commit com o:
  git add <arquivo>
  git rebase --continue //Nesse momento estamos em uma branch "temporária" (no branch). Existem também os comandos:
  // --skip, que descarta o commit atual.
  // --abort, que cancela o rebase e volta a branch ao que era anteriormente.

  //Com o git status pode-se verificar os arquivos que devem ser resolvidos manualmente na branch temporária.

  //Com os commits resolvidos um a um e em relação a base atualizada basta uni-las:
  git checkout master // Indo para a master
  git merge desenvolvimento // mescla a desenvolvimento com a branch atual
  git push // por fim, joga no repositório remoto



?>
