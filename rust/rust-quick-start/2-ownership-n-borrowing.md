# Ownership and Borrowing

This set Rust apart from other languages. The closest equivalent is the **Resource Aquisition Is Instantiation** design pattern common in C++.

## Scope and ownership

- Every single data value has a single owning scope.
  - Scope is just where a block expression stores it's values;
  - Even temporary values has one;
- When rust is done with a scope, all the data values that scope owns are discarded and the memory is freed.
  - This is called `lifetime`



## The stack

- Like most languages Rust uses a stack to manage memory;
  - Remember, a stack is a `LIFO` with `push()` and `pop()`;
- When a rust block expression starts, it makes note of how the stack is and, when the block ends, it reset things to the same height it was.
- When a value is removed, rust also do cleanups, including a custom cleanup function for the value if one is defined;
- This simple procedure handle all memory management with no garbage collection;



## Transferring ownership

```rust
let main_1 = Point2D {x: 10.0, y: 10.0};
receive_ownership(main_1);
receive_ownership(main_1); // This cause compile error;
```

If we try to use the value stored in `main_1` after it has been moved to a different scope, the compiler will error. Any value has been moved, it's no longer there!

Ownership can also be transfered in the other direction:

```rust
pub fn receive_ownership(point: Point2D) -> Point2D {
    println!("Point2D{x: {}, y: {}} is now owned by a new scope", point.x, point.y);
    return point;
}
```

This function return the ownership back to it's parent



Ownership can also be transferred "sideways":

```rust
let mut main_4 = main_2;
```



Rust compiler is very careful about ownership. The following code doesn't compile:

```rust
pub fn uncertain_ownership(switch: bool) {
    let point = Point2D {x: 3.0, y: 3.0};
    
    if switch {
        receive_ownership(point);
    }
    
    println!("point is Point2D{{x: {}, y: {}}}", point.x, point.y);
}
```

It errors because is only valid when the switch parameter is false



## Copying

The compiler only transfer ownership when the `Copy` trait isn't implemented.

```rust
pub fn copied_ownership(switch: bool) {
	let local = 4.0;
    
    if switch {
        receive_ownership(Point2D {x: local, y: 4.0});
    }
    
    println!("x is {}", local);
}
```

This code actually compiles, because floating points have the `Copy` Trait implemented by default. So the variable `local` wasn't moved it was actually copied.



## Lending

In summary:

- When we move a value, the receiving scope becomes the value's new owner;
- When we copy, the receiving scope owns the duplicate it received, while the sending scope still retains the original;
- When we `lend`, the original still retains ownership, but the receiving scope is still allowed to access data;

As a consequence the Rust compiler required that any borrowed information must be returned before the owner's scope ends.

When a borrow happens, the value isn't copied nor moved. The borrowed receives the memory address, and access it from another scope.

A currently borrowed data value **can't be changed by the owner**, even if the data is mutable. A data value can only be changed in one place at a time at most. When a value can be changed, it's never in use elsewhere.

### Lending immutably

This is the default behavior when lending, meaning that the borrowed data is read only. 

This can be done to more than once at the same time. This is considered safe, since no possible race conditions happen.

```rust
borrow_ownership(&main_3)
```



### Lending mutably

Sometimes, we want to lend a data value and allow the receiver to modify it. This means that when the borrow has ended the data value on the owning scope has changed. This is the `mutably` lending.

We can't lend mutably if the variable isn't `mutable`.

```rust
let mut main_4 = main_2;
borrow_ownership_mutably(&mut main_4);
```

The rule is, if there is a mutable borrow, that value can't be borrowed anywhere else. Even if it's a immutable borrow. It's impossible!

### Accessing borrowed data

To receive borrowed data, we need to properly specify the type as a borrow with `&` or `&mut` 

> Even though the term `borrow` is common in Rust, the technical term is `reference`.

So revisiting our functions:

```rust
pub fn borrow_ownership(point: &Point2D) {
    println!("Point2D{{x: {}, y: {}}} is now borrowed by a new scope", point.x, point.y);
}

pub fn borrow_ownership_mutably(point: &mut Point2D) {
    println!("Point2D{{x: {}, y: {}}} is now borrowed again, buut this time....");
    point.x = 13.5;
    println!("The borrowed value changed to Point2D{{x: {, y: {}}}}", point.x, point.y);
}
```

Notice that the code looks the same even though we are handling pointers instead of values now. That's because the compiler is normally smart enough to take the extra step of unpack the address before using/modifying the value.

> This process is called **dereferencing**. Funny enough nobody says **deborrowing**.

There are moments that the compiler isn't smart enough. In this case you can use a `*` to manually dereference a borrowed value.

> This usually come up when assigning a whole new value to a borrowed variable.

```rust
pub fn set_to_six(value: &mut u32) {
    value = 6;
}
```

This errors with `expected &mut u32, found integral variable`. So we should do:

```rust
pub fn set_to_six(value: &mut u32) {
    *value = 6;
}
```















