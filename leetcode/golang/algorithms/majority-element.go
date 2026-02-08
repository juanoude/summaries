package algorithms

func MajorityElement(nums []int) int {
	var numCounts map[int]int = map[int]int{}
	for _, num := range nums {
		// you don't need to safelly init the map key like other languages
		// a new key is automatically 0 in this case
		numCounts[num]++
		if numCounts[num] > len(nums)/2 {
			return num
		}
	}

	return -1
}

func MajorityElementV2(nums []int) int {
	var vote = 1
	var winningNum = nums[0]

	for i := 1; i < len(nums); i++ {
		if nums[i] == winningNum {
			vote++
		} else {
			vote--
		}

		if vote == 0 {
			winningNum = nums[i]
			vote++
		}
	}

	return winningNum
}

// Given an array nums of size n, return the majority element.
// The majority element is the element that appears more than ⌊n / 2⌋ times.
// You may assume that the majority element always exists in the array.

// Example 1:
// Input: nums = [3,2,3]
// Output: 3

// Example 2:
// Input: nums = [2,2,1,1,1,2,2]
// Output: 2

// Constraints:
// n == nums.length
// 1 <= n <= 5 * 104
// -109 <= nums[i] <= 109

// Follow-up: Could you solve the problem in linear time and in O(1) space?
