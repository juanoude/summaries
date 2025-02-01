# Intro

A binary tree is a tree that every node contains two children at max

```python
class Binary_Node:
    def __init__(A, x):
        A.item  = x
        A.left  = None
        A.right = None
        A.parent = None
```

While we have O(n) is many data structures, binary trees would potentially have O(log n).
We need to be careful about the height of the tree, that maintenance is what optimizes it compared to lists.

# Traversal Order
It's the logical order of the nodes. It's defined by:
```python
def subtree_iter(A):
    if A.left: yield from A.left.subtree_iter()
    yield A
    if A.right yield from A.right.subtree_iter()
```

# Tree Navigation
To find the first and last nodes:
```python
def subtree_first(A):
    if A.left:  return A.left.subtree_first()
    else:       return A

def subtree_last(A):
    if A.right: return A.right.subtree_last()
    else:       return B
```

To find a node's predecessor and successor:
```python
def sucessor(A):
    if A.right: return A.right.subtree_first()
    while A.parent and (A is A.parent.right):
        A = A.parent
    return A.parent

def predecessor(A):
    if A.left: return A.left.subtree_last()
    while A.parent and (A is A.parent.left):
        A = A.parent
    return A.parent
```

# Dynamic Operations
To add and remove items:
```python
def subtree_insert_before(A, B): # O(h)
    if A.left:
        A = A.left.subtree_last()
        A.right, B.parent = B, A
    else:
        A.left, B.parent = B, A
    # A.maintain()

def subtree_insert_after(A, B): # O(h)
    if A.right:
        A = A.right.subtree_first()
        A.left, B.parent = B, A
    else:
        A.right, B.parent = B, A
    # A.maintain()
```
To delete an item:
```python
def subtree_delete(A):
    if A.left or A.right:
        if A.left:  B = A.predecessor()
        else:       B = A.successor()
        A.item, B.item = B.item, A.item # switch places until reaches a leaf
        return B.subtree_delete()
    if A.parent:
        if A.parent.left is A:  A.parent.left = None
        else:                   A.parent.right = None
```
If the deleted has children, it will switch places with other nodes until he is a leaf. The result will be the same order as before but missing the deleted node. This is also `O(h)` h being the height of the tree.

# Top level data structure
```python
class Bynary_Tree:
    def __init__(T, Node_Type = Binary_Node):
        T.root = None
        T.size = 0
        T.Node_Type = Node_Type
    
    def __len__(T): return T.size
    def __iter__(T):
        if T.root:
            for A in T.root.subtree_iter():
                yield A.item
```

**Exercise:** Given an array of items A = (a0, . . . , an−1), describe a O(n)-time algorithm to con-
struct a binary tree T containing the items in A such that (1) the item stored in the ith node of T ’s
traversal order is item ai, and (2) T has height O(log n).
```python
def build(X): # array
    A = [x for x in X]
    def build_subtree(A, i, j):
        c = (i + j) // 2 # middle node
        root = self.Node_Type(A[c])
        if i < c:
            root.left = build_subtree(A, i, c-1) # left subtree
            root.left.parent = root
        if c < j:
            root.right = build_subtree(A, c+1, j) # right subtree
            root.right.parent = root
        return root

    self.root = build_subtree(A, 0, len(A)-1)
```

# Set

⚠️ 🚧 Under construction 🚧 ⚠️

# Balanced Binary Trees

⚠️ 🚧 Under construction 🚧 ⚠️

# Rotations

⚠️ 🚧 Under construction 🚧 ⚠️

# Maintaining Height-Balance

⚠️ 🚧 Under construction 🚧 ⚠️

# Binary Node Implementation with AVL Balancing

⚠️ 🚧 Under construction 🚧 ⚠️

# Sequence

⚠️ 🚧 Under construction 🚧 ⚠️
