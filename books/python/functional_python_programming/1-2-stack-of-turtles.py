## Stack of Turtles
# When we use Python for functional programming, we embark down a path that will involve a hybrid that’s not strictly functional. 
# Python is not Haskell, OCaml, or Erlang. For that matter, our underlying processor hardware is not functional; it’s not even strictly 
# object-oriented, as CPUs are generally procedural.

# > All programming languages rest on abstractions, libraries, frameworks and virtual machines. These abstractions, in turn, may rely on 
# other abstractions, libraries, frameworks and virtual machines. The most apt metaphor is this: the world is carried on the back of a 
# giant turtle. The turtle stands on the back of another giant turtle. And that turtle, in turn, is standing on the back of yet another turtle.
# > It’s turtles all the way down.
# > -- Unknown

### Newton-Raphson algorithm example:
# It approximates to a square root value in each execution
def next_(n: float, x: float) -> float:
	return (x + n / x) / 2

from collections.abc import Iterator, Callable

def repeat(
	f: Callable[[float], float],
	a: float
) -> Iterator[float]:
	yield a
	yield from repeat(f, f(a))


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

def sqrt(n: float) -> float:
	return within(
		e=0.0001,
		iterable=repeat(
			lambda x: next_(n, x),
			1.0
		)
	)


if __name__ == "__main__":
	n = 2
	f = lambda x: next_(n, x)
	a0 = 1.0
	print([round(x,4) for x in (a0, f(a0), f(f(a0)), f(f(f(a0))),)])
	print(sqrt(2))