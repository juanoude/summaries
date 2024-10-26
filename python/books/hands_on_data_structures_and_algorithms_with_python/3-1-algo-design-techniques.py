
# The first step is always formulate the problem clearly
# The design decision comes from the structure of the problem.

# Recursion
## Calls itself until a condition is met:
### Base Cases - it tells the recursion when to terminate
### Recursive Cases - each recursive call progress toward the base criteria
def factorial(n):
    # test for a base case
    if n == 0:
        return 1
    else:
        # make calc and recursive call
        return n*factorial(n-1) 

# Divide and Conquer
## break problem into smaller sub-problems
## combines all to obtain a final solution
## ------
## Examples:
### Binary Search
#### Compares the middle of a sorted list, discarting the other half each iteration
#### Recursively repeats until the element is found
def binary_search(arr, start, end, key):
    while start <= end:
        mid = int(start + (end - start)/2)
        if arr[mid] == key:
            return mid
        elif arr[mid] < key:
            start = mid + 1
        else:
            end = mid -1
    return -1

### Merge Sort
#### Divides the list iteratively into equal parts
#### Iterates until each sublist contains one element
#### Then combines them into a sorted list
def merge_sort(unsorted_list):
    print('merge called', unsorted_list)
    if len(unsorted_list) == 1:
        return unsorted_list
    mid_point = int(len(unsorted_list)/2)
    first_half = unsorted_list[:mid_point]
    second_half = unsorted_list[mid_point:]
    print('divided in half')
    half_a = merge_sort(first_half)
    half_b = merge_sort(second_half)
    print('merging halfs')
    return merge(half_a, half_b)

def merge(first_sublist, second_sublist):
    print('merging lists')
    print(first_sublist)
    print(second_sublist)
    i = j = 0
    merged_list = []
    while i < len(first_sublist) and j < len(second_sublist):
        if first_sublist[i] < second_sublist[j]:
            merged_list.append(first_sublist[i])
            i += 1
        else:
            merged_list.append(second_sublist[j])
            j += 1
    
    while i < len(first_sublist):
        merged_list.append(first_sublist[i])
        i += 1
    while j < len(second_sublist):
        merged_list.append(second_sublist[j])
        j += 1
    print('merged')
    print(merged_list)
    return merged_list

def fib(n):
    if n <= 1:
        return 1
    return fib(n-1) + fib(n-2)

def memo_fib(n) -> int:
    if n == 0:
        return 0
    if n == 1:
        return 1
    if lookup[n] is not None:
        return lookup[n]
    
    lookup[n] = memo_fib(n-1) + memo_fib(n-2)
    return lookup[n]
lookup = [None]*(1000) # Creates a 1000 lenght array with None values


### Quick Sort
# low -> start index
# high -> end index
def quick_sort(unsorted_list, low, high):
    if low < high:
        # pi is partitioning index
        # array[pi] is now at right place
        pi = partition(unsorted_list, low, high)
        # sort elements before partition
        quick_sort(unsorted_list, low, pi-1)
        # sort elements after partition
        quick_sort(unsorted_list, pi+1, high)

# this will pick the rightmost element, find its perfect place and put all lesser elements at his left
# in other words, it pre organizes the left and right lists, while placing the pivot linearly.
def partition(list, low, high):
    # choose the rightmost element as pivot
    pivot = list[high]

    # pointer to indicate the pivot perfect position
    i = low - 1

    # traverse through all elements
    # compare each element with pivot
    for j in range(low, high):
        if list[j] <= pivot:
            # If element smaller than pivot is found
            # swap it with the greater element pointed by i
            i = i + 1

            # Swapping element at i with element at j
            (list[i], list[j]) = (list[j], list[i])

    # Swap the pivot element with the greater element specified by i
    (list[i + 1], list[high]) = (list[high], list[i + 1])
    return i + 1


### Algorithm for fast multiplication
### Strassen's matrix multiplication
### Closest pair of points


# Dynamic programming
## Similar to divide and conquer but do not recompute solutions
## It uses remembering techniques, that means it is ideal if a
## algorithm have a lot of overlapping sub-problems
### Top-down memoization -> store results and return them when subproblem is encountered again
###

# Greedy Algorithms
## 
##

if __name__ == "__main__":
    print(factorial(4))
    print('-------')
    arr = [4, 6, 9, 13, 14, 18, 21, 24, 38]
    x = 13
    result = binary_search(arr, 0, len(arr)-1, x)
    print(result)
    print('-------')

    arr = [17, 1, 5, 12, 2, 5, 66, 36, 43, 21, 7, 8]
    print(merge_sort(arr))
    print('----------------')

    for i in range(35):
        print(fib(i))

    num = 100
    for i in range(num):
        if i > num * 0.95:
            print(memo_fib(i))
    print('----------------')
    unsorted_list = [10, 7, 8, 9, 1, 5]
    quick_sort(unsorted_list, 0, len(unsorted_list)-1)
    print(unsorted_list)
    
