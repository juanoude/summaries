//metachars are the characters with a especial meaning on regular expressions,
//they are not interpreted literally.

. // Means any char;

* // Means zero, one or more occurrences, also called quantifier;
{} //define a especific quantity for the char;
Ex: a{3}, \d* // letter a 3 times, a digit zero or more times;

\ //for interpret the metachars literally;
Ex: \. , \* ;

\d // means a number;

//Examples:
\d{3}\.\d{3}\.\d{3}\-\d{2}; // Brazillian CPF '036.939.311-27'
\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2} // Brazililan CNPJ '15.123.321/8883-22'
\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3} // IP Address '192.2.58.207'
\d{5}-\d{3} // CEP '41620-275'
\(\d{2}\) \d{4}-\d{4} // Phone '(21) 3216-2345'
