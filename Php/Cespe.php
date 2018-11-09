<?php

/* array_push() trata array como uma pilha, e adiciona as variáveis passadas como argumentos
no final de array. O tamanho do array aumenta de acordo com o número de variáveis adicionadas. */

/* array_pop() extrai e retorna o último elemento de array, diminuindo array em um elemento. */

$processos = array("Processo 1", "Processo 2", "Processo 3", "Processo 4");
  array_push($processos, "Processo 5");//adiciona processo 5 ao final
  array_pop($processos);//Remove processo 5 ao final

  $cesta = array("laranja", "banana", "melancia", "morango");
  $fruta = array_pop($cesta);
  print_r($cesta);// laranja, banana e melancia
  print_r($fruta);// Morango
  ?>


  <?php
  // Integers
  echo 1 <=> 1; // 0
  echo 1 <=> 2; // -1
  echo 2 <=> 1; // 1

  // Floats
  echo 1.5 <=> 1.5; // 0
  echo 1.5 <=> 2.5; // -1
  echo 2.5 <=> 1.5; // 1

  // Strings
  echo "a" <=> "a"; // 0
  echo "a" <=> "b"; // -1
  echo "b" <=> "a"; // 1

  echo "a" <=> "aa"; // -1
  echo "zz" <=> "aa"; // 1

  // Arrays
  echo [] <=> []; // 0
  echo [1, 2, 3] <=> [1, 2, 3]; // 0
  echo [1, 2, 3] <=> []; // 1
  echo [1, 2, 3] <=> [1, 2, 1]; // 1
  echo [1, 2, 3] <=> [1, 2, 4]; // -1

  // Objects
  $a = (object) ["a" => "b"];
  $b = (object) ["a" => "b"];
  echo $a <=> $b; // 0

  $a = (object) ["a" => "b"];
  $b = (object) ["a" => "c"];
  echo $a <=> $b; // -1

  $a = (object) ["a" => "c"];
  $b = (object) ["a" => "b"];
  echo $a <=> $b; // 1

  // only values are compared
  $a = (object) ["a" => "b"];
  $b = (object) ["b" => "b"];
  echo $a <=> $b; // 1

  Se comparar um número com uma string ou com strings numéricas, cada string é
  convertido para um número e então a comparação é realizada numericamente.
  Essas regras também se aplicam a instrução switch.

  ?>


<?php
resource fopen ( string $filename , string $mode [, bool $use_include_path [, resource $context ]] )
/* fopen() conecta um recurso nomeado, especificado por filename, a um stream.

Se o PHP decidirá que filename se refere a um arquivo local, uma URL ou um protocolo
então ele tentará abrir um stream para aquele arquivo. O recurso precisa ser acessível,
caso contrário gerará um erro. */

//exemplos
$handle = fopen("/home/rasmus/file.gif", "wb");
$handle = fopen("http://www.example.com/", "r");
$handle = fopen("ftp://user:password@example.com/somefile.txt", "w");

?>


  <?php
  void exit ([ string $status ] )
  void exit ( int $status )
  /* A função exit A função exit() termina a execução do script. Ela mostra
   * o parâmetro status justamente antes de sair. Se status é um integer, este
   * valor será usado como estado se saída. Estados de saída deve, estar no
   * intervalo de 0 a 254, o estado de saída 255 é reservado pelo php e não deve
   * ser usado. O estado 0 é usado para terminar o programa de maneira bem
   * sucedida.
   */

  //ex 1:
  $filename = '/caminho/para/arquivo';
  $file = fopen ($filename, 'r')
      or exit("Não pude abrir o arquivo ($filename)");

  //ex 2:
      //sai normalmente
      exit;
      exit();
      exit(0);

      //sai com um código de erro
      exit(1);
      exit(0376); //octal

Nota: A função die() é um apelido para a função exit().

  ?>


  <?php
    bool file_exists ( string $filename )
    /** Verifica se um arquivo ou diretório existe.
     *  Retorna TRUE se o arquivo ou diretório especificado por
     *  filename existe; FALSE caso contrário.
     */
     $filename = '/caminho/para/arquivo.txt';

// exemplo, testando se o arquivo existe:
if (file_exists($filename)) {
    echo "O arquivo $filename existe";
} else {
    echo "O arquivo $filename não existe";
}

  ?>


  <?php
    int count ( mixed $var [, int $mode ] )
    // Conta os elementos de um array, ou propriedades em um objeto.
    $a[0] = 1;
    $a[1] = 3;
    $a[2] = 5;
    $result = count($a);
    // $result == 3

    $b[0] = 7;
    $b[5] = 9;
    $b[10] = 11;
    $result = count($b);
    // $result == 3

    $result = count(null);
    // $result == 0

   ?>


<?php
bool session_start ([ array $options = [] ] )
/*session_start() cria uma sessão ou resume a sessão atual baseado em um id de
sessão passado via GET ou POST, ou passado via cookie.

Para utilizar uma sessão com nome, execute session_name() antes de executar
session_start().*/

//Exemplo #1
// page1.php <?php
session_start();// Sempre abaixo do <?php

echo 'Bem vindo à página #1';

$_SESSION['favcolor'] = 'green';
$_SESSION['animal']   = 'cat';
$_SESSION['time']     = time();

// Funciona se o cookie de seção foi aceito
echo '<br /><a href="page2.php">page 2</a>';

// Ou talves passando o ID da seção se necessário
echo '<br /><a href="page2.php?' . SID . '">page 2</a>';

/* Após acessar page1.php, a segunda página page2.php magicamente terá os dados da
seção. Leia funções para sessão para informações sobre propagação de ids de sessão
já que, por exemplo, explica tudo sobre a constante SID. */

//Exemplo #2 page2.php
// page2.php <?php
session_start();

echo 'Bem vindo à página #2<br />';

echo $_SESSION['favcolor']; // green
echo $_SESSION['animal'];   // cat
echo date('Y m d H:i:s', $_SESSION['time']);

// Você pode querer usar o SID aqui, como fizemos em page1.php
echo '<br /><a href="page1.php">page 1</a>';

//Fornecendo configurações para session_start():
//Exemplo #3 Sobrepondo o tempo de duração de cookie
// Envia o cookie persistente que dura um dia <?php
session_start([
    'cookie_lifetime' => 86400,
]);

//Exemplo #4 Lendo e fechando a sessão

/* Se não houver necessidade de alterar nada na
 sessão, pode-se apenas lê-la e já fechá-la para evitar
 que o arquivo de sessão seja travado e então bloqueie outras páginas */
session_start([
    'cookie_lifetime' => 86400,
    'read_and_close'  => true,
]);

Nota: Para usar sessões baseadas em cookies, session_start() deve ser
chamada antes de enviar qualquer saída (output) para o browser.

   ?>


   <?php
    bool mail ( string $to , string $subject , string $message
    [, string $additional_headers [, string $additional_parameters ]] )
    //Envia um email.
    // Parâmetros:
    $to
    //Receptor, ou receptores do email.

    $subject
    //Assunto do email a ser enviado.

    $message
    //Mensagem a ser enviada.
    //Cada linha deve ser separada com um LF (\n). Linhas não deve ser maiores que 70 caracteres.

    $additional_headers (opcional)
    /*String a ser inserida no final do cabeçalho do email.
    Esta é normalmente usada para adicionar cabeçalhos extras (From, Cc, e Bcc).
    Múltiplos cabeçalhos extra devem ser separados com um CRLF (\r\n). */
    Nota:Quando enviando email, o email precisa conter um cabeçalho From. Este pode ser
    definido com o parâmetro additional_headers, ou um padrão pode ser definido no php.ini.

    $additional_parameters (opcional)
    /*O parâmetro additional_parameters pode ser usado para passar um parâmetro
    adicional para o programa configurado para usa quando enviando email usando
    a configuração sendmail_path. Por exemplo, isto pode ser usado para definir
    o endereço do envelope remetente quando usando sendmail com a opção do sendmail -f.*/

//ex 1
// The message
$message = "Line 1\nLine 2\nLine 3";
// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);
// Send
mail('caffinated@example.com', 'My Subject', $message);

//ex2
$to      = 'nobody@example.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
           'Reply-To: webmaster@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

   ?>


   <?php
      SUPERGLOBAIS

      $_REQUEST
      /*Um array associativo que por padrão contém informações de:
       $_GET, $_POST e $_COOKIE. */

      $GLOBALS
      //Referencia todas variáveis disponíveis no escopo global

      $_SERVER
      //Informações do servidor e ambiente de execução

      $_GET
      /*Um array associativo de variáveis passadas para o script atual
      via o método HTTP GET.*/

      $_POST
      /*Um array associativo de variáveis passados para o script atual
      via método HTTP POST*/

      $_FILES
      /*Um array associativo de uploads enviados através do script atual*/

      $_SESSION
      /*Um array associativo contendo variáveis de sessão disponíveis para
      o atual script.*/

      $_ENV
      /*Um array associativo de variáveis passadas para o script atual via
      o método do ambiente.*/

      $_COOKIE
      /* Um array associativo de variáveis passadas para o atual script
      via HTTP Cookies. */

   ?>


   <?php
    VARIÁVEIS
   /*Nomes de variável seguem as mesmas regras como outros rótulos no PHP.
   Um nome de variável válido inicia-se com uma letra ou sublinhado, seguido
   de qualquer número de letras*/

   $var = 'Bob';
   $Var = 'Joe';
   echo "$var, $Var";      // exibe "Bob, Joe"

   $4site = 'not yet';     // inválido; começa com um número
   $_4site = 'not yet';    // válido; começa com um sublinhado
   $täyte = 'mansikka';    // válido; 'ä' é um caracter ASCII (extendido) 228
   ?>


<?php

   /*Existem três tipos de operadores em PHP: os unários, que operam em apenas
   uma sentença; os binários, que retornam o valor de acordo com a operação
   realizada em duas sentenças; e os ternários, que entre dois valores
   selecionam um, a depender de um terceiro.*/
   Exemplos:
   Unário:  contador++ ; !x
   Binário:  a+b ;  x / y
   Ternário:  verdade ? x : y   que "significa"   if(verdade){ x }else{ y }
?>


<?php
        <OPERADORES ARITMÉTICOS>

Exemplo  //- Nome           (Resultado)
+$a	     //- Identidade	    (Conversão de $a para int ou float conforme apropriado.)
-$a	     //- Negação	      (Oposto de $a.)
$a + $b	 //- Adição	        (Soma de $a e $b.)
$a - $b	 //- Subtração	    (Diferença entre $a e $b.)
$a * $b	 //- Multiplicação	(Produto de $a e $b.)
$a / $b	 //- Divisão	      (Quociente de $a e $b.)
$a % $b	 //- Módulo	        (Resto de $a dividido por $b.)
$a ** $b //- Exponencial	  (Resultado de $a elevado a $b.)


        <OPERADORES DE BIT A BIT> //Bitwise

$a & $b	  //E(AND)	Os bits que estão ativos tanto em $a quanto em $b são ativados.
$a | $b	  //OU(OR inclusivo)	Os bits que estão ativos em $a ou em $b são ativados.
$a ^ $b	  //XOR(OR exclusivo)	Os bits que estão ativos em $a ou em $b, mas não em ambos, são ativados.
~ $a	    //NÃO(NOT)	Os bits que estão ativos em $a não são ativados, e vice-versa.
$a << $b  //Deslocamento à esquerda	Desloca os bits de $a $b passos para a esquerda (cada passo significa "multiplica por dois")
$a >> $b  //Deslocamento à direita	Desloca os bits de $a $b passos para a direita (cada passo significa "divide por dois")


        <OPERADORES DE ATRIBUIÇÃO>

$a += $b     //$a = $a + $b    Addition
$a -= $b     //$a = $a - $b    Subtraction
$a *= $b     //$a = $a * $b    Multiplication
$a /= $b     //$a = $a / $b    Division
$a %= $b     //$a = $a % $b    Modulus

$a .= $b     //$a = $a . $b       Concatenate

$a &= $b     //$a = $a & $b       Bitwise And
$a |= $b     //$a = $a | $b       Bitwise Or
$a ^= $b     //$a = $a ^ $b       Bitwise Xor
$a <<= $b    //$a = $a << $b      Left shift
$a >>= $b    //$a = $a >> $b      Right shift

//Exemplos
$a = 3;
$a += 5; // define $a para 8, como se disséssemos: $a = $a + 5;
$b = "Bom ";
$b .= "Dia!"; // define $b para "Bom Dia!", como em $b = $b . "Dia!";

$c = 3;
$d = &$c; // $d é uma referência de $c
print "$c\n"; // imprime 3
print "$d\n"; // imprime 3

        <OPERADORES DE COMPARAÇÃO>

$a == $b	//Igual	- Verdadeiro (TRUE) se $a é igual a $b.
$a === $b	//Idêntico	- Verdadeiro (TRUE) se $a é igual a $b, e eles são do mesmo tipo.
$a != $b	//Diferente	- Verdadeiro se $a não é igual a $b.
$a <> $b	//Diferente	- Verdadeiro se $a não é igual a $b.
$a !== $b	//Não idêntico -	Verdadeiro de $a não é igual a $b, ou eles não são do mesmo tipo (introduzido no PHP4).
$a < $b	//Menor que -	Verdadeiro se $a é estritamente menor que $b.
$a > $b	//Maior que	- Verdadeiro se $a é estritamente maior que $b.
$a <= $b	//Menor ou igual	- Verdadeiro se $a é menor ou igual a $b.
$a >= $b	//Maior ou igual	- Verdadeiro se $a é maior ou igual a $b.
$a <=> $b	//Spaceship (nave espacial)	- Um integer menor que, igual a ou maior que zero quando $a é, respectivamente, menor que, igual a ou maior que $b. Disponível a partir do PHP 7.


        <OPERADORES DE INCREMENTO/DECREMENTO>

++$a	//Pré-incremento - Incrementa $a em um, e então retorna $a.
$a++	//Pós-incremento - Retorna $a, e então incrementa $a em um.
--$a	//Pré-decremento - Decrementa $a em um, e então retorna $a.
$a--	//Pós-decremento - Retorna $a, e então decrementa $a em um.


        <OPERADORES LÓGICOS>

$a and $b	 //E	- Verdadeiro (TRUE) se tanto $a quanto $b são verdadeiros.
$a or $b	 //OU	- Verdadeiro se $a ou $b são verdadeiros.
$a xor $b	 //XOR	- Verdadeiro se $a ou $b são verdadeiros, mas não ambos.
! $a	     //NÃO	- Verdadeiro se $a não é verdadeiro.
$a && $b	 //E	- Verdadeiro se tanto $a quanto $b são verdadeiros.
$a || $b	 //OU	- Verdadeiro se $a ou $b são verdadeiros.


        <OPERADORES DE ARRAY>

$a + $b	  //União	- União de $a e $b. Para chaves que existam nos dois arrays os elementos do array à esquerda serão mantidos, os valores de mesma chave no array da direita são ignorados.
$a == $b	//Igualdade	- TRUE se $a e $b tem os mesmos pares de chave/valor.
$a === $b	//Identidade	- TRUE se $a e $b tem os mesmos pares de chave/valor na mesma ordem e do mesmo tipo.
$a != $b	//Desigualdade	- TRUE se $a não é igual a $b.
$a <> $b	//Desigualdade	- TRUE se $a não é igual a $b.
$a !== $b	//Não identidade	- TRUE se $a não é identico a $b.



?>
