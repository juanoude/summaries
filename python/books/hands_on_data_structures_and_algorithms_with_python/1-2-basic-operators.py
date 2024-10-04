

if __name__ == "__main__":
    # Membership Operators
    list = ['some', 'list']
    if 'some' in list:
        print('item is on the list')
    else:
        print('item is not on the list')
    
    other_list = [10, 20, 30, 40, 50]
    val = 30
    if val not in other_list:
        print("item is not inside the list")
    else:
        print("item is on the list")

    # Identity operators
    first_list = []
    second_list = []
    print(first_list == second_list)
    print(first_list is second_list)
    thirdlist = second_list
    print(thirdlist is second_list) # True -> points to the same object
    second_list += [2, 3]
    print(thirdlist)
    print(thirdlist is not first_list)

    # Logical Operators
    a = 32
    b = 132
    if a > 0 and b > 0:
        print("Both are greater than zero")
    
    if a > b or a > 0:
        print("One condition landed")

    a = 32
    if not a:
        print("a is falsy!")
    else:
        print("a is truthy!")


    