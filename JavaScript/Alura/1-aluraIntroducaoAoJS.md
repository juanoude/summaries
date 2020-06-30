
# JavaScript - Introduction

## Variables
* `idade = 30;` Global Variable - Bad Practice
* `const idade = 30;` Scope Variable - Good Practice

* Giving preference to declare with `const` is a good practice. Because:
  * `const constant = "Is not possible to modify its value, in objects, doesn't change its structure;`
  * `let nonConstant = "But with let, ";` \
    `nonConstant = nonConstant + "is possible to modify the variable value";`

* `let` can be declared and attributed in different lines, `const` has to be on the same:
  * `let declared;` \
  `declared = "attributed";`
  * `const declared = 'attributed';`

* The variable names should be the most explicit/explanatory possible, even if become extensive - Good practice


## Type Conversion
* `console.log("ano" + 2020);` ano2020
* `console.log("2" + "2");` 22
* `console.log(parseInt("2") + parseInt("2"));` 4 (parseFloat exists too)
* `console.log("10" / "2")`  5
* `console.log("7" / "2")`  3.5
* `console.log("Ricardo" / 2);` // NaN (Not a Number)
* Watch out the comma (Brazillian standard for floats)
  * `console.log(6.5);` 6.5
  * `console.log(6,5);` 6 5


## Arrays
* Unusual way of declaring array:
```
const cities = new Array(
  'São Paulo',
  'Curitiba',
  'Brasília'
);
```
* `cities.push('Florianópolis');` structure is constant, but can add...
* `cities.splice(1, 1);`..., delete and many other array methods


## Conditionals:

```
if (condition > 18) {
  console.log('true');
} else {
  console.log('false');
}
```

```
if (condition > 18) {
  console.log('true');
} else if (otherCondition) {
  console.log('false - true');
} else {
  console.log('false - false');
}
```

```
if(salary < 2600.0)
  console.log("Your aliquot is 15%"); //Inside
  console.log("You can deduct until R$ 350"); //Out
```

* `|| == ou`
* `&& == e`


## Iterators

```
const destination = 'Brasília';
let existsDest = false;
let counter = 0;
while (counter < 3) {
  if (cidades[counter] == destination) {
    console.log('exist in array');
    existsDest = true;
    break;
  }
  counter += 1;
}
console.log('destination exists:', existsDest);
```

* with for:
```
for (i = 0; i < 3; i++) {
  if (cities[i] === destination) {
    console.log('exist in array');
    existsDest = true;
    break;
  }
}
console.log('destination exists:', existsDest);
```

**PS:** In debugger - Continue goes to the next breakpoint and step over execute the next line. \
Is possible to create many debug configurations in `launch.json`
