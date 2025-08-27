# Basics

```rust
fn main() {
    println!("Hello, world!");
}
```

> Every rust program will have a main function



## Modules

At every `.rs` file we can use the `mod` keyword to start a new module. You can use in two different ways:

### Module as a section of a file

```rust
pub mod module_a {
    pub fn a_thing() {
        println!("This is a thing");
    }
    
    pub fn a_second_thing() {
        a_thing();
        println!("This is another thing");
    }
}
```

> This is a module with two functions inside of it



### Module as a separate file

If you define a `pub mod module_b;` the rust compiler looks for a file called `module_b.rs` or `module_b/mod.rs` and use the whole file as the contents. So the equivalent file would be:

```rust
pub fn a_thing() {
    println!("This is a moduule_b thing");
}

pub fn a_second_thing() {
    a_thing();
    println!("This is another module_b thing");
}
```



### Accessing module contents

- **Full Name:** module name, the `::` symbol and then the item's short name. For example: `std::path::Path`  to get the `Path` item from the `path` module of the std module.
- **Short Name:** uses the `use` keyword to shorten subsequent calls. If you used `std::path` for example. That would allow us to just use `path::Path` in subsequent code.



### Public and private

The `pub` keyword makes the item public, that means available from outside it's current module. If you omit, it's private by default. 



## Expressions

### Literal expressions

- Numbers
- Quoted text
- Byte sequences
- Single Unicode points
- Single bytes
- Boolean values

### Operators

- `+`
- `-`
- `*`
- `/`
- `%`
- `&` and `|` - `and` and `or`
- `^` - Exclusive or
- `!` - not
- `<<` `>>`- bit shifts
- `==` `<` `>` `<=` `>=` - comparison
- `&&` `||` - Lazy or short-circuit operators
  - They stop evaluating the expression if the condition is already met;



### Array and Tuples

- `[1, 2, 3]` - All arrays have the same data types on it's items;
- `[0; 1000]` - An array with one thousand zeros;
- `an_array[0]` - index normally
- `(1, "wow", true)` - Tuple can have different types;
- `(5,)` - declaring a tuple with one element;



### Block Expressions

- `{ 2 + 2; 19 % 3; println!("In a block"); true}` - The last expression produces the final result.

  - It does each step at a time. Good for ordering execution;

- If you put a `;` on the last expression, It has no result `()`

  - `()` an empty tuple is commonly used and a nothing filler.

  


### Branch Expressions

```rust
if 3 > 4 {
    println!("UUh-oh, three is greater than four");
}
else if 3 == 4 {
    println!("Hih-hah, Math is an illusion");
}
else {
    println!("Heh-oh! Three is actually my luck number");
}
```



### Loop Expressions

```rust
while i < 3 {
    i = i + 1;
    println!("While loop {}", i);
}
```

```rust
for num in 3..7 { // the last is not inclusive, the 3..7= notation would include it.
	println!("for loop {}", num);    
}
```

```rust
for word in ["Hello", "world", "of", "loops"].iter() {
    println!("{}", word);
}
```



### Variables, type, and mutability

```rust
let x = 10; // you cannot change, but you can redeclare (shadow)
let mut x = 17; // mutable ones you can change
x = 0
```

Some built-in type examples are:

- `i32` -> 32 bit signed integer;
- `f64` -> 64 bit floating point integer;
- `u16` -> 16 bit unsigned integer;
- `bool`
- `isize` `usize` -> integer that takes up the same number of bits as the memory address on the target architecture;
- `char`
- `str`



 ### Type inference

```rust
let addr = "127.0.0.1:12345".parse()?;
let tcp = TcpListener::bind(&addr)?;
```

Even when not specifying, Rust finds out the type following the variable usage.

Sometimes you will see an error about a variable that you never heard of, that's likely the type that Rust inferred, if that happens try to assign the types that you actually want.



### Data Structures

```rust
pub struct Constrained {
    pub min: i32,
    pub max: i32,
    current: i32, // remember that default is private
}
```

```rust
let change_no: Contrained;
let mut change_yes: Constrained;
change_yes.max = 30;
```



### Types on functions

```rust
pub fn set(&mut self, value: i32) { // param type
    self.current = value;
}

pub fn get(&self) -> i32 {
    if self.current < self.min {
        return self.min;
    }
    else if self.current > self.max {
        return self.max;
    }
    else {
        return self.current;
    }
}
```





### Error Handling

`Result` is a special generic type, example: 

- `Result<i32, &'static str>`
  - What that means is the function will produce a `i32` if it succeds, and a `&'static str` if fails.
  - `&'static str` happens to be the type for a literal text expression.

Using the result signal:

```rust
fn can_fail(x: bool) -> Result<i32, &'static str {
    if x {
        return Ok(5);
    }
    else {
        return Err("x is false");
    };
}
```



### Calling functions that return Result

The simplest way is using the `?` operator. It stores if successful and throws if fails:

```rust
let mut cons: Constrained = new_constrained(0, 10, 5)?;
```

Another way is using the `expect` function. Expects terminates the whole program and prints the error. Functions with expect doesn't have to return a result.

```rust
let mut cons: Constrained = new_constrained(0, 5, 10).expect("Something went very wrong!");
```

We can also check the error, this will be displayed later on this doc.



### Implementing behavior for types

```rust
impl Contrained {
    pub fn set(&mut self, value: i32) {
        self.current = value;
    }
    
    pub fn get(&self) -> i32 {
        if self.current < self.min {
            return self.min;
        }
        else if self.current > self.max {
            return self.max;
        }
        else {
            return self.current;
        }
    }
}
```

This is an implementation block for a datatype. Implements behavior on the type defined.

Notice that the first parameter is special, provided by default. Can be `&self`, `&mut self`, and just `self`.

You can implement behavior on types you didn't create, like `i32` if you create a `trait`.