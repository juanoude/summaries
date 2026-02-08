package algorithms

import (
	"sort"
)

func ThreeSum(nums []int) [][]int {
	sort.Ints(nums)
	var triplets [][]int
	for first := 0; first < len(nums); first++ {
		firstNum := nums[first]
		if first > 0 && nums[first-1] == firstNum {
			continue
		}

		if firstNum > 0 {
			break
		}

		second, last := first+1, len(nums)-1
		for second < last {
			secondNum, lastNum := nums[second], nums[last]
			sum := firstNum + secondNum + lastNum

			if second > first+1 && secondNum == nums[second-1] {
				second++
				continue
			}

			if sum == 0 {
				triplets = append(triplets, []int{firstNum, secondNum, lastNum})
				second++
				last--
			} else if sum < 0 {
				second++
			} else {
				last--
			}
		}
	}

	return triplets
}

// First attempt O(n!)
// func ThreeSum(nums []int) [][]int {
// 	sort.Ints(nums)

// 	var triplets [][]int
// 	for i := 0; i < len(nums); i++ {
// 		if i > 0 && nums[i] == nums[i-1] {
// 			continue
// 		}

// 		for j := i + 1; j < len(nums); j++ {
// 			if j > i+1 && nums[j] == nums[j-1] {
// 				continue
// 			}

// 			for k := j + 1; k < len(nums); k++ {
// 				if k > j+1 && nums[k] == nums[k-1] {
// 					continue
// 				}

// 				fmt.Println(i, j, k)

// 				isEqualToZero := (nums[i] + nums[j] + nums[k]) == 0
// 				if isEqualToZero {
// 					triplets = append(triplets, []int{nums[i], nums[j], nums[k]})
// 				}
// 			}
// 		}
// 	}

// 	return triplets
// }

//Given an integer array nums, return all the triplets [nums[i],
// nums[j], nums[k]] such that i != j, i != k,
// and j != k, and nums[i] + nums[j] + nums[k] == 0.
//Notice that the solution set must not contain duplicate triplets.

// Example 1:
// Input: nums = [-1,0,1,2,-1,-4]
// Output: [[-1,-1,2],[-1,0,1]]
// Explanation:
// nums[0] + nums[1] + nums[2] = (-1) + 0 + 1 = 0.
// nums[1] + nums[2] + nums[4] = 0 + 1 + (-1) = 0.
// nums[0] + nums[3] + nums[4] = (-1) + 2 + (-1) = 0.
// The distinct triplets are [-1,0,1] and [-1,-1,2].
// Notice that the order of the output and the order of the triplets does not matter.

// Example 2:
// Input: nums = [0,1,1]
// Output: []
// Explanation: The only possible triplet does not sum up to 0.

// Example 3:
// Input: nums = [0,0,0]
// Output: [[0,0,0]]
// Explanation: The only possible triplet sums up to 0.

// Constraints:
//  *   3 <= nums.length <= 3000
//  *   -105 <= nums[i] <= 105
