# Intro
We can’t easily create purely functional programs in Python. Python lacks a number of features that would be required for this. We don’t have unlimited recursion, for example, we don’t have lazy evaluation of all expressions, and we don’t have an optimizing compiler.

There are several key features of functional programming languages that are available in Python:
- functions being first-class objects;
- higher-order functions
- built-in map(), filter(), and functools.reduce()
- sorted(), min(), and max()

In some cases, a functional approach to a problem will also lead to extremely high-performance algorithms.

Python makes it too easy to create large intermediate data structures, tying up memory (and processor time). With functional programming design patterns, we can often replace large lists with generator expressions that are **equally expressive but take up much less memory and run much more quickly**.

# 1 - Understanding Functional Programming

Functional programming defines a computation using expressions and evaluation; often, they are encapsulated in function definitions. It de-emphasizes or avoids the complexity of state change and mutable objects.

Python’s strong imperative traits mean that the state of a computation is defined by the values of the variables in the various namespaces. Some kinds of statements make a **well-defined change to the state by adding, changing, or removing a variable**. We call this **imperative** because specific kinds of statements change the state.

In a functional language, we **replace the state**—the changing values of variables—**with a simpler notion of evaluating functions**. Each function evaluation creates a new object or objects from existing objects. Since a functional program is a *composition of functions*, we can design *lower-level functions* that are easy to understand, and then create compositions of functions that can also be easier to visualize than a complex sequence of statements.

## Comparing and contrasting procedural and functional styles

### Procedural example:
```python
def sum_numeric(limit: int = 10) -> int:
	s = 0
	for n in range(1, limit):
		if n % 3 == 0 or n % 5 == 0:
			s += n
	return s
```

### Functional example:
```python
from collections.abc import Sequence

def sumr(seq: Sequence[int]) -> int:
	if len(seq) == 0:
		return 0
	return seq[0] + sumr(seq[1:])	
```

```python
from collections.abc import Sequence, Callable

def until(
	limit: int,
	filter_func: Callable[[int], bool],
	v: int
) -> list[int]:
	if v == limit:
		return []
	elif filter_func(v):
		return[v] + until(limit, filter_func, v + 1)
	else:
		return until(limit, filter_func, v + 1)
```

```python
def mult_3_5(x: int) -> bool:
	return x % 3 == 0 or x % 5 == 0
```

```python
until(10, mult_3_5, 0):
# [0, 3, 5, 6, 9]

def sum_functional(limit: int = 10) -> int:
	return sumr(until(limit, mult_3_5, 0))
```

### Hybrid example
```python
def sum_hybrid(limit: int = 10):
	return sum(
		n for n in range(1, limit)
		if n % 3 == 0 or n % 5 == 0
	)
```

## Stack of Turtles

When we use Python for functional programming, we embark down a path that will involve a hybrid that’s not strictly functional. Python is not Haskell, OCaml, or Erlang. For that matter, our underlying processor hardware is not functional; it’s not even strictly object-oriented, as CPUs are generally procedural.

> All programming languages rest on abstractions, libraries, frameworks and virtual machines. These abstractions, in turn, may rely on other abstractions, libraries, frameworks and virtual machines. The most apt metaphor is this: the world is carried on the back of a giant turtle. The turtle stands on the back of another giant turtle. And that turtle, in turn, is standing on the back of yet another turtle.
> It’s turtles all the way down.
> -- Unknown

### Newton-Raphson algorithm example:
It approximates to a square root value in each execution
```python
def next_(n: float, x: float) -> float:
	return (x + n / x) / 2
```

```python
n = 2
f = lambda x: next_(n, x)
a0 = 1.0
[round(x,4) for x in (a0, f(a0), f(f(a0)), f(f(f(a0))),)]
# [1.0, 1.5, 1.4167, 1.4142]
```

```python
from collections.abc import Iterator, Callable

def repeat(
	f: Callable[[float], float],
	a: float
) -> Iterator[float]:
	yield a
	yield from repeat(f, f(a))
```

```python
from collections.abc import Iterator

def within(
	e: float,
	iterable: Iterator[float]
) -> float:
	def head_tail(
		e: float,
		a: float,
		iterable: Iterator[float]
	) -> float:
		b = next(iterable)
		if abs(a-b) <= e:
			return b
		return head_tail(e, b, iterable)
	return head_tail(e, next(iterable), iterable)
```

```python

```
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTEwMDA5MDM0NDddfQ==
-->