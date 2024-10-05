
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
    print('=================')

    person = {}
    person['name'] = 'Juan'
    person['age'] = 31
    print(person)
    print('name' in person)
    print('address' not in person)
    print(len(person))
    print('=================')

    person.clear()
    print(person)
    print(person.get('name')) # safely gets key
    print('=================')

    print(my_dict.items()) # list of key-value - [(key, value), ...]
    print(my_dict.keys())
    print(my_dict.values())
    print('=================')

    my_dict.pop('4') # removes entry
    my_dict.popitem() # removes last
    print(my_dict)
    print('=================')

    my_other_dict = { '4': 'programming', '5': 'language'}
    my_dict.update(my_other_dict) # merges - if key exists, replaced, if not, added
    print(my_dict)
    print('=================')

    # Sets - unordered - mutable - unique elements
    my_set = set(['python', 'golang', 'typescript', 'bash'])
    print(my_set)
    print(type(my_set))
    my_other_set = {'python', 'golang', 'typescript', 'java', 'rust'}
    print(my_other_dict)
    print(type(my_other_set))
    print('python' in my_set)
    print(len(my_set))
    print('===================')

    print(my_set.union(my_other_set))
    print(my_set | my_other_set)
    print(my_set.intersection(my_other_set))
    print(my_set & my_other_set)
    print(my_set.difference(my_other_set))
    print(my_set - my_other_set)
    print(my_set.symmetric_difference(my_other_set))
    print(my_set ^ my_other_set)
    my_set.remove('bash')
    print(my_set.issubset(my_other_set))
    print(my_set <= my_other_set)
    print(my_other_set.issuperset(my_set))
    print(my_other_set >= my_set)
    print('===========================')

    # Immutable sets - immutable
    iset = frozenset(['this', 'never', 'changes'])
    print(iset)
    internal_set = set({'this', 'can', 'change'})
    # nested_set = {internal_set} # Errors - unhashable type: 'set'
    nested_frozen_set = {iset} # frozen works...
    print(nested_frozen_set)
    print('=========================')

    ##  Pythons's collections module
    # namedtuple    -> tuple with named fields
    # namedtuple(typename, field_names)

    from collections import namedtuple
    Book = namedtuple('Book', ['name', 'ISBN', 'quantity'])
    Book1 = Book('Hands on Data Structure', '92381285215', 50)
    print('Using index ISBN: ' + Book1.ISBN)
    print('Using key: ' + Book1.name)
    print(Book1)
    print(Book)
    print('==========================')

    # deque         -> doubly-linked list
    from collections import deque
    s = deque() # Creates empty
    s2 = deque([1, 2, 'Name'])
    print(s)
    print(s2)

    s.append('age')
    s.appendleft('name')
    print(s)
    s2.pop()
    s2.popleft()
    print(s2)
    print('===============================')

    # Ordered dictionary    -> preserves the order of the keys
    from collections import OrderedDict
    od = OrderedDict({ 'my': 2, 'name': 5, 'is': 1, 'juan': 9 })
    od['hello'] = 4
    print(od)
    print('=================================')

    # defaultdict   -> dict subclass with default values for missing keys
    from collections import defaultdict
    dd = defaultdict(int)
    words = str.split('this is a test random random test')
    for word in words:
        dd[word] += 1
    print(dd)
    print('==================================')

    # ChainMap      -> dict that merges multiple dictionaries
    from collections import ChainMap
    dict1 = { 'key1': 1, 'key2': 2, 'key3': 3, 'key4': 4 }
    dict2 = { 'key4': 4.2, 'key5': 5, 'key6': 6, 'key7': 7, 'key8': 8 } # the first key occurrence seems to prevail
    chain = ChainMap(dict1, dict2)
    print(chain)
    print(list(chain.keys()))
    print(list(chain.values()))
    print(chain['key4'])
    print(chain.get('key4'))
    print('=====================================')

    # Counter       -> dict that returns the counts
    from collections import Counter
    inventory = Counter('hello')
    print(inventory)
    print(inventory['l'])
    print(inventory['o'])
    print('==================================')

    # UserDict - customizable dict
    from collections import UserDict
    class MyDict(UserDict):
        def push(self, key, value):
            print("I'm not inserting that. You can't make me")
        
    d = MyDict({ 'ab': 1, 'bc': 2, 'cd': 3 })
    d.push('de', 1)
    print('==================================')

    # UserList - customizable list
    from collections import UserList
    class MyList(UserList):
        def push(self, key):
            print("I'm won't insert that. No no!")
    d = MyList([11, 12, 13])
    d.push(2)

    # UserString - customizable string
    from collections import UserString
    class MyString(UserString):
        def append(self, value):
            self.data += value
    s1 = MyString("data")
    print("Original:", s1)
    s1.append('h')
    print('Modified', s1)