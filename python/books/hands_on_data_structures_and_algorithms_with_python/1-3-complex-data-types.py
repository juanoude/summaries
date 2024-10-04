
if __name__ == "__main__":
    # dictionaries
    my_dict = {
        '1': 'data',
        '2': 'structure',
        '3': 'python',
        '4': 'programming',
        '5': 'language'
    }

    print(my_dict['1'])
    print(type(my_dict))

    person = {}
    person['name'] = 'Juan'
    person['age'] = 31
    print(person)
    print('name' in person)
    print('address' not in person)
    print(len(person))

    person.clear()
    print(person)
    print(person.get('name')) # safely gets key

    print(my_dict.items()) # list of key-value - [(key, value), ...]
    print(my_dict.keys())
    print(my_dict.values())

    my_dict.pop('4') # removes entry
    my_dict.popitem() # removes last
    print(my_dict)

    my_other_dict = { '4': 'programming', '5': 'language'}
    my_dict.update(my_other_dict) # merges - if key exists, replaced, if not, added
    print(my_dict)

    # Sets
