# Book 1 - Up & Running

## Values and Types

JavaScript has typed values, not typed variables.

### The following built-in Types are available:
* String
* Number
* Boolean
* Null
* Undefined
* Object
* Symbol (new to ES6)

JavaScript has an `typeof` operator that can examine a value and tell what type it is:
```

	var a;
    typeof a;	//undefined
    
    a = "Hello World";
    typeof a;	//string
    
    a = 42;
    typeof a;	//number
    
    a = true;
    typeof a;	//boolean
    
    a = null;
    typeof a;	//"object" -- weird, bug
    
    a = undefined;
    typeof a;	//"undefined"
    
    a = { b: "c" };
    typeof a;	//"object"

```

### Objects

Compound value where you can set properties (named locations) that each hold their own values of any type:
```

var obj = {
	a: "Hello World",
    b: 42,
    c: true
}

obj.a;	//"Hello World"
obj.b;	//42
obj.c;	//true

obj[a]; //"Hello World"
obj[b]; //42
obj[c]; //true

```
![Object representation](./obj.png)


As you can see, properties can be accessed with *dot notation* (`obj.a`) or *bracket notation*(`obj['a']`). The first is easier to read and use, but the second accept variables and special characters:

```

var obj = {
	a: "Hello World",
    b: 42
}

var b = 'a';

obj[b];		//"Hello World"
obj["b"];	//42

```

#### Arrays

An array is an object, with numeric keys in properties. For example:

```

var arr = [
	"hello world",
    42,
    true
];

arr[0];			//"hello world"
arr[2];			//42
arr[2];			//true
arr.length		//3

typeof arr;		//"object"

```
![array example](./array.png)

You theoretically could use an array as a normal object with your own named properties, or you could use an `object` but only give it numeric properties similar to an array. However, this would generally be considered improper usage of types.

####  Functions

Another `object` subtype:

```

function foo() {
	return 42;
}

foo.bar = "hello world";

typeof foo;			//"function"
typeof foo();		//"number"
typeof foo.bar;		//"string"

```

