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
