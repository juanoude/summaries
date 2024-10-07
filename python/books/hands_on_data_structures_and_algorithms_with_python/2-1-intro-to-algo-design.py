## Time Complexity
def example(n):
    if n == 0 or n == 3: # c1
        print("data") # c2 -  Constant time
    else: # c3
        for i in range(n): # c4
            print("structure") # c5 x n - this runs n times
# if n != 3 or 0 the time complexity looks like:
# T(n) = c1 + c3 + c4 x n + c5 x n
# else:
# T(n) = c1 + c2

def linear_search(input_list, element): # In most real-world application worst case is what matters
    for index, value in enumerate(input_list): # In the worst case it would loop len(input_list) times
        if value == element: 
            return index
    
    return -1

## Space Complexity
# Estimates memory requirement
def squares(n):
    square_numbers = [] # it allocates a new array
    for number in n:
        square_numbers.append(number * number) # with the same size and n
    return square_numbers
# O(n)

## Asymptotic Notation
# θ -> Theta -> worst-case time complexity with a tight bound
## Some function has lower and upper bounds moving dynamicaly - theta only consider from the moment they are stable

# O -> Big O -> worst-case with an upper bound, which garantees the limit
## O(1) < O(log n) < O(n) < O(n log n) < O(nˆ2) < O(nˆ3) < O(2ˆn)
### T(n) = 2n + 7 -> O(n)
### T(n) = nˆ2 + n -> O(nˆ2)
### T(n) = nˆ3 - 6n -> O(nˆ3)
### T(n) = 20nˆ2 - 2n + 5 -> O(nˆ2)

# Ω -> Omega -> lower bound, it measures the best amount of time to execute
### Defines a minimal amount of time spent for a large input size.
### Results ends up super similar to Big O notation.

# Amortized Analysis - average the time required of all operations
## So, an amortized analysis is the average performance of each operation in the worst case considering the cost 
## of the complete sequence of all the operations.



if __name__ == "__main__":
    nums = [2,3,5,8]
    print(squares(nums))