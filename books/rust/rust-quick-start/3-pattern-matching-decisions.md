# Making Decisions by Pattern Matching

Rust is a very type conscious language, so it's very important to  make decisions based on that.

## Variable assignment with pattern matching

```rust
pub struct DemoStruct {
    pub id: u64,
    pub name: String,
    pub probability: f64,
}

//...
let source1 = DemoStruct {id: 31, name: String::from("Example Thing"), probability: 0.42};
let DemoStruct {id: x, name: y, probability: z} = source1;
```

> This will end up being `x`,`y`, and `z` new variables with `source.id`, `source.name`, and `source.probability`.

If you try to:

```rust
DemoStruct{ id: 31, name: y, probability: z } = source1;
```

> This errors. Because it doesn't match all the possibilities for the source value. This is called `covering`

For patterns that is uncertain to match the input, we can use `if let` expressions instead.





