# 1 Basic Types

Python is a **dynamically typed** language; the data type of the variables is not required to be explicitly defined. The Python interpreter implicitly binds the value of the variable with its type at runtime. In Python, data types of the variable type can be checked using the function `type()`

```python
p = "Hello Brazil"
q = 10
r = 10.2
print(type(p)) # <class 'str'>
print(type(q)) # <class 'int'>
print(type(r)) # <class 'float'>
print(type(12+31j)) # <class 'complex'>
```

```python
var = 13.2
print(var) # 13.2
print(type(var)) # <class 'float'>

var = "Now the type is string"
print(type(var)) # <class 'str'>
```

## Basic data types

### Numeric
- **Integer (int):** In Python, the interpreter takes a sequence of decimal digits as a decimal value, such as the integers `45`, `1000`, or `-25`.
- **Float:** Python considers a value having a floating-point value as a float type; it is specified with a decimal point. It is used to store floating-point numbers such as `2.5` and `100.98`. *It is accurate up to 15 decimal points.*
- **Complex:** A complex number is represented using two floating-point values. It contains an ordered pair, such as `a + ib`. Here, a and `b` denote real numbers and `i` denotes the imaginary component. The complex numbers take the form of `3.0 + 1.3i`, `4.0i`, and so on.

### Boolean
This provides a value of either `True` or `False`. 

In Python, the *numeric values can be used as bool* values using the built-in bool() function. Any number (*integer, float, complex*) having a value of **zero is regarded as False**, and a **non-zero value is regarded as True**.

```python
bool(False)
print(bool(False)) # False

va1 = 0
print(bool(va1)) # False

va2 = 11
print(bool(va2)) # True

va3 = -2.3
print(bool(va3)) # True
```

### Sequences

Sequence data types are used to store multiple values in a single variable in an organized and efficient way. There are four basic sequence types: **string, range, lists, and tuples**.

#### Strings
```python
str1 = 'Hello how are you'
str2 = "Hello how are you"
str3 = """multiline 
		String"""

print(str1) # Hello how are you
print(str2) # Hello how are you
print(str3)	
# multiline
# String
```

```python
# Concat
f = 'data'
s = 'structure'

print(f + s) # datastructure
print('Data ' + 'Structure') # Data Structure
```
```python
# multiply
st = 'data.'
print(st * 3) # data.data.data.
print(3 * st) # data.data.data.
```

#### Range
The range data type represents an **immutable sequence of numbers.** It is mainly used in for and while loops. 
>`range(start, stop, step)`
```python
print(list(range(10))) # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
print(range(10)) # range(0, 10)
print(list(range(10))) # [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
print(range(1,10,2)) # range(1, 10, 2)
print(list(range(1,10,2))) # [1, 3, 5, 7, 9]
print(list(range(20,10,-2))) # [20, 18, 16, 14, 12]
```

#### Lists
Python lists are used to store multiple items in a single variable. *Duplicate values are allowed in a list, and elements can be of different types*: for example, you can have both numeric and string data in a Python list.

The items stored in the list are enclosed within square brackets, `[]`, and separated with a comma, as shown below:
```python
a = ['food', 'bus', 'apple', 'queen']
print(a) # ['food', 'bus', 'apple', 'queen']
mylist = [10, "Brazil", "world", 8]
# acessing element
print(mylist[1]) # Brazil
```

```python
# Order matters
equal = [10, 12, 31, 14] == [14, 10, 31,
12]
print(equal) # False
```
```python
# Manipulating elements
b = ['data', 'and', 'book', 'structure', 'hello', 'st']
b += [32]
print(b) # ['data', 'and', 'book', 'structure', 'hello', 'st', 32]
b[2:3] = []
print(b) # ['data', 'and', 'structure', 'hello', 'st', 32]
del b[0]
print(b) # ['and', 'structure', 'hello', 'st', 32]
```
```python
# List elements can be of the same type or varying data types.
a = [2.2, 'python', 31, 14,
'data', False, 33.59]
```

```python
# Indexes
a = ['data', 'structures',
'using', 'python', 'happy',
'learning']
print(a[0])# data
print(a[2]) # using
print(a[-1]) # learning
print(a[-5]) # structures
print(a[1:5]) # ['structures', 'using', 'python', 'happy']
print(a[-3:-1]) # ['python', 'happy']
```
```python
# Mutating
a = ['data', 'and', 'book',
'structure', 'hello', 'st']
a[1] = 1 
a[-1] = 120
print(a)
# ['data', 1, 'book',
# 'structure', 'hello', 120]

a = ['data', 'and', 'book',
'structure', 'hello', 'st']
print(a[2:5])
# ['book', 'structure',
# 'hello']

a[2:5] = [1, 2, 3, 4, 5]
print(a)
# ['data', 'and', 1, 2, 3, 4,
# 5, 'st']
```

```python
# Other operators
a = ['data', 'structures',
'using', 'python', 'happy',
'learning']

print('data' in a) # 
print(a)
print(a + ['New', 'elements'])
print(a)
print(a *2)
print(len(a))
print(min(a))
```
<!--stackedit_data:
eyJoaXN0b3J5IjpbLTg1MjA4NzU0NF19
-->