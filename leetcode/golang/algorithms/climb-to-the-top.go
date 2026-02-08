package algorithms

var waysMap = make(map[int]int)

// Second attempt - O(2 * N) ??
func ClimbStairs(n int) int {
	if _, isPresent := waysMap[n]; isPresent {
		return waysMap[n]
	}

	if n == 0 || n == 1 {
		return 1
	}

	if n == 2 {
		return 2
	}

	waysMap[n] = ClimbStairs(n-1) + ClimbStairs(n-2)
	return waysMap[n]
}

// First Attempt - O(2^n)
// func ClimbStairs(n int) int {
// 	ammount := stepStairs(n, 0, 0)
// 	return ammount
// }

// func stepStairs(n int, current int, amount int) int {
// 	amountOne, currentOne := stepStair(n, current, 1)
// 	amountTwo, currenTwo := stepStair(n, current, 2)

// 	amount += amountOne
// 	amount += amountTwo

// 	if currentOne >= n && currenTwo >= n {
// 		return amount
// 	}

// 	return stepStairs(n, currentOne, amountOne) + stepStairs(n, currenTwo, amountTwo)
// }

// func stepStair(n int, current int, step int) (int, int) {
// 	current += step
// 	if n == current {
// 		return 1, current
// 	}

// 	return 0, current
// }

// You are climbing a staircase. It takes n steps to reach the top.
// Each time you can either climb 1 or 2 steps. In how many distinct ways can you climb to the top?

// Example 1:
// Input: n = 2
// Output: 2
// Explanation: There are two ways to climb to the top.
// 1. 1 step + 1 step
// 2. 2 steps

// Example 2:
// Input: n = 3
// Output: 3
// Explanation: There are three ways to climb to the top.
// 1. 1 step + 1 step + 1 step
// 2. 1 step + 2 steps
// 3. 2 steps + 1 step

// Constraints:
//     1 <= n <= 45
