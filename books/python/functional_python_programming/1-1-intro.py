## Intro
# We can’t easily create purely functional programs in Python. Python lacks a number of features that would be required for this. 
# We don’t have unlimited recursion, for example, we don’t have lazy evaluation of all expressions, and we don’t have an optimizing compiler.

# There are several key features of functional programming languages that are available in Python:
# - functions being first-class objects;
# - higher-order functions
# - built-in map(), filter(), and functools.reduce()
# - sorted(), min(), and max()

# In some cases, a functional approach to a problem will also lead to extremely high-performance algorithms.
# Python makes it too easy to create large intermediate data structures, tying up memory (and processor time). 
# With functional programming design patterns, we can often replace large lists with generator expressions that are 
# **equally expressive but take up much less memory and run much more quickly**.

### 1 - Understanding Functional Programming

# Functional programming defines a computation using expressions and evaluation; often, they are encapsulated in function definitions. 
# It de-emphasizes or avoids the complexity of state change and mutable objects.

# Python’s strong imperative traits mean that the state of a computation is defined by the values of the variables in the various namespaces. 
# Some kinds of statements make a **well-defined change to the state by adding, changing, or removing a variable**. We call this 
# **imperative** because specific kinds of statements change the state.

# In a functional language, we **replace the state**—the changing values of variables—**with a simpler notion of evaluating functions**. 
# Each function evaluation creates a new object or objects from existing objects. Since a functional program is a *composition of functions*, 
# we can design *lower-level functions* that are easy to understand, and then create compositions of functions that can also be easier to 
# visualize than a complex sequence of statements.

## Comparing and contrasting procedural and functional styles
# Procedural:
def sum_numeric(limit: int = 10) -> int:
	s = 0
	for n in range(1, limit):
		if n % 3 == 0 or n % 5 == 0:
			s += n
	return s

### Functional:
from collections.abc import Sequence
from collections.abc import Sequence, Callable

def sumr(seq: Sequence[int]) -> int:
	if len(seq) == 0:
		return 0
	return seq[0] + sumr(seq[1:])

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


def mult_3_5(x: int) -> bool:
	return x % 3 == 0 or x % 5 == 0

def sum_functional(limit: int = 10) -> int:
	return sumr(until(limit, mult_3_5, 0))

### Hybrid example
def sum_hybrid(limit: int = 10):
	return sum(
		n for n in range(1, limit)
		if n % 3 == 0 or n % 5 == 0
	)

if __name__ == "__main__":
	print(f'sum hibrid: {sum_numeric(20)}')
	print(f'sum_functional: {sum_functional(20)}')
	print(f'sum hibrid: {sum_hybrid(20)}')
    