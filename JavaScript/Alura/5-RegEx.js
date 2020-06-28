//-----------------------------------------------------------------------------
//Lesson 1


//metachars are the characters with a especial meaning on regular expressions,
//they are not interpreted literally.

. // Means any char;

* // Means zero, one or more occurrences, also called quantifier;
{n} //define a specific quantity for the char;
Ex: a{3}, \d* // letter a 3 times, a digit zero or more times;

\ //for interpret the metachars literally;
Ex: \. , \* ;

\d // means a number;

//Exercises:
\d{3}\.\d{3}\.\d{3}\-\d{2}; // Brazillian CPF '036.939.311-27'
\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2} // Brazililan CNPJ '15.123.321/8883-22'
\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3} // IP Address '192.2.58.207'
\d{5}-\d{3} // CEP '41620-275'
\(\d{2}\) \d{4}-\d{4} // Phone '(21) 3216-2345'


//-----------------------------------------------------------------------------
//Lesson 2


[] //Enables us to create a class.
Ex: [0123456789], // This equals to \d
[.-] // The dot inside keys are interpreted literally

[0-9] = [0123456789] //Shortcut
[A-Z] // A to Z Caps
[a-z] // a to z no Caps
[A-Za-z] // Both

\w //Means a world char. Same as [a-zA-Z0-9_]

? //Its a quantifier with means 0 or 1 times
Ex: [.-]? //Optional dot or hypen

+ //Its a quantifier that means 1 or more times
Ex: \d+

\t //tab
\r //carriage return
\n //newline
\f //form feed

\s //get all the whitespaces, means a shortcut to [\t\r\n\f]

{n,} //Define a specific minimum quantity
{n,m}//Define a specific minimum (n) and maximum quantity (m)
Ex: \s{1,} [1-3]{1,4}

//Exercises:
//</?code> get '<code>' and '</code>'
[1-36-9] //same as [1236789]
[0-3]?\d\s+de\s+[A-Z][a-zç]{1,8}\s+de\s+[12]\d{3} //Date '1 de Março de 1990'
[0-2]?\dh[0-5]\dmin[0-5]\ds //Another date '19h32min16s'
[A-Z]{3}-\d{4} //Car plate 'KMG-8089'
[A-Z]*ROT[A-Z]+ //Any word containig 'ROT'

// Little tip:
//for legibility is nice to break a big Regex into undertandable variables.
//instead of [0123]?\d\s+de\s+[A-Z][a-zç]{1,8}\s+de\s+[12]\d{3}:
var DIA  = "[0123]?\d";
var _DE_ = "\s+de\s+";
var MES  = "[A-Za-z][a-zç]{1,8}";
var ANO  = "[12]\d{3}";

var stringRegex = DIA + _DE_ +  MES + _DE_ + ANO;
var objetoRegex  = new RegExp(stringRegex, 'g');


//-----------------------------------------------------------------------------
//Lesson 3

\b //Word boundary, select the content strictly. Do not accept \w's on the edges.
Ex: \bde\b //Will match the strict 'de' but not in 'Denise', 'node', etc.

\B //Non-word boundary, its the inverse of \b
Ex: \Bpor\B //Will match any 'por' in the middle of words.

^ //Set a anchor for the beggining pattern of the target
$ //Set a anchor for the end pattern of the target.
Ex: ^file.+\.html$ // A html file url. Begins with file and ends with html.

//Exercises:
^Caused by:.+ //Getting errors that always start with 'Caused by:'
^Data:[\s]?\d{2}/\d{2}/\d{4}$ //Getting dates with the structure 'Data: dd/mm/yyyy' or 'Data:dd/mm/yyyy'


//------------------------------------------------------------------------------
//Lesson 4

//Imagine that you want to search a pattern, but wants only a piece of that pattern
//as the result, this is possible with the grouping tool:
() //Groups a piece of the Regex
Ex: (a)a{3} // Pick the first 'a' of 'aaaa'

//You can define the optional quantifier to entire groups
Ex: a(a{2}\s)?a{2} // Pick 'aaa' or 'aaa aa'

//You can define groups that you don't want to return as part of the result:
(?:denied) //Means that you don't want that group as a result
Ex: a(?:a{2})?a{2} // The return will match the pattern in this case.

//Exercises:
([0123]?\d)\s+(?:de\s+)?([A-Z][a-zç]{1,8})\s+(?:de\s+)?([12]\d{3}) // Get dd Month yyyy from a date
\d{3}[-.]?\d{3}[.-]?\d{3}[.-]?(\d{2}) //Get the last 2 numbers of CPF
[Z]\d+(\w) // Get a word from a specific cipher

//Given the error Caused by: com.mysql.jdbc.exceptions.jdbc4.CommunicationsException: Communications link failure
(Caused[\s\w:.]+):([\w\s]+) //Gives the path and the message in two groups

//Given the emails 'super.mario@caelum.com.br' 'donkey.kong@alura.com.br' 'bowser1@alura.com.br'
([a-z.]{4,14}[a-z\d]?)@(?:alura.com.br|caelum.com.br)// Get the emails names.

//Given the should match emails 'donkey.kong@kart.com.br' 'bowser1@games.info' 'super-mario@nintendo.JP' 'TEAM.donkey-kong@MARIO.kart1.nintendo.com'
//and the should not match emails 'wario@kart@nintendo.com' 'yoshi@nintendo' 'daisy@nintendo.b' '..@email.com'
^([-\w])+(\.[-\w]+)?@(\w+\.)+([a-zA-Z]{2,}) //gives the expected result.
// In the course answer was: ^([\w-]\.?)+@([\w-]+\.)+([A-Za-z]{2,4})+$

//Given the adresses:
// Nico Steppat|14/05/1977|Rua Buarque de Macedo|50|22222-222|Rio de Janeiro
// Romulo Henrique|14/06/1993|Rua do Lins|120|12345-322|Rio de Janeiro Leonardo
// Cordeiro|01/01/1995|Rua de Campo Grande|01|00001-234|Rio de Janeiro
([\w\s]+)\|(?:\d+/){2}\d+\|([\w\s]+)\|(\d+)\|(\d{5}-\d{3})\|(?:\w+\s?)+
//Gets the name, street, number and CEP


//------------------------------------------------------------------------------
//Lesson 5

//The . metachar works in a way that it covers the max length he can
//to revert this behavior and make it stop in the first ocurrence, use '?'
//For example, given the string '<h1 class="text-left">Expressões regulares</h1>'
<h1.+> //Will select '<h1 class="text-left">Expressões regulares</h1>'
<h1.+?> //Will select '<h1 class="text-left">'

//Given the world 'alura'
[a-z]+ //Select one match as 'alura'
[a-z]+? //Select five matches as 'a' 'l' 'u' 'r' 'a'

| //Make a or operator
(string1 | string2) //in group packs the whole word as a option

//You can reference a object in the regex
//For instance in the pattern '<(h1|h2).+?>([\w\sõãí.]+)</(h1|h2)>'
//for the string '<h1 id="regex" class="form">Expressões </h2>'
//the match for h1 in the first object and h2 in the end is valid
<(h1|h2).+?>([\w\sõãí.]+)</\1> // in this one references the first object value

//To make a exclusion class, we use:
[^] // Means everything except the following chars
Ex: [^>] //Gets every char except '>'

\W // Means non-word char, shorcut to [^\w]
\D // Means non-digit, shorcut to [^\d]

//Exercises:
<(p[1-9])> .*? </\1> //Check the tags and its respective closage <p1> to <p9>
<h1[^>]+> //Get the opening h1 tag

//The old cipher logic '[Z]\d+(\w)' equals [^Z\d]:

//Quick example of javascript usage of a regex:
var target = '11a22b33c';
var regex = /(\d\d)(\w)/g; //ou new RegExp('(\\d\\d)(\\w)', 'g');
var resultado = regex.exec(target);

console.log(resultado[0]); //11a
console.log(resultado[1]); //22b
console.log(resultado[2]); //33c

console.log(resultado.index); //Position of the first match
console.log(regex.lastIndex); //Position of the last match
