# “Python is a dynamically typed language; the data type of the variables is not required to be explicitly defined”
# “The Python interpreter implicitly binds the value of the variable with its type at runtime.”

# Numeric           types: int, float, complex
# Boolean:          bool
# Sequence types:   str, range, list, tuple
# Mapping types:    dict
# Set types:        set, frozenset

# type() function
if __name__ == "__main__":
    string_var = "Hello here"
    number_var = 10
    float_var = 10.2
    complex_var = 12+31j

    print(type(string_var))
    print(type(number_var))
    print(type(float_var))
    print(type(complex_var))

    # dynamic type
    dynamic_var = 13.2
    print(dynamic_var)
    print(type(dynamic_var))

    dynamic_var = "Now I'm a string"
    print(dynamic_var)
    print(type(dynamic_var))

    print(type(True))
    print(type(False))
    print(type(bool(0)))
    print(type(bool(1)))

    # strings
    str1 = 'String with single quotes'
    str2 = "String with double quotes"
    str3 = """Multiline 
            String"""
    print(str3)
    print("Concat " + "Strings")

    # You can multiply strings
    string = "data."
    print(string * 3)

    # range -> range(start, stop, step)
    print(list(range(10)))
    print(range(10))
    print(list(range(0,10,2)))
    print(list(range(20,10,-2)))

    # lists
    a = ['food', 'bus', 'apple', 'queen']
    print(a)
    mixed_list = [10, "India", 20.52, True]
    print(mixed_list[3])

    list_equality = [10, 12, 14] == [10, 12, 14]
    print(list_equality)
    list_inequality = [10, 12, 14] == [8, 12, 14]
    print(list_inequality)

    mixed_list += [2] # adding
    print(mixed_list)

    print(mixed_list[2:3]) # deleting
    mixed_list[2:3] = []
    del mixed_list[0]
    print(mixed_list)

    print (mixed_list[-1])
    print (mixed_list[-2:-1])
    mixed_list[2:] = [1.1, True, 12, "Hey!"]
    print(mixed_list)

    concat_list = [1, 2, 3] + [1, 2, 3]
    print(concat_list)
    multiply_list = [1, 2, 3] * 4
    print(multiply_list)
    print(1 in multiply_list) # contains

    # Tuples -> read only - immutable
    tuple_name = ("entry", "some", "values")
    print(tuple_name)
    mixed_tuple = (12, "test", 1.2, True)
    print(mixed_tuple)
    concat_tuple = (4, 5) + (6, 7)
    print(concat_tuple)
    print(3 in (1, 2, 3))
    print((1, 2, 3) * 3)
    print(concat_tuple[1])
    print(concat_tuple[-2])
    print(concat_tuple[1:])