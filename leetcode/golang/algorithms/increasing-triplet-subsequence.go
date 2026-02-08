package algorithms

import (
	"fmt"
)

func IncreasingTripletV1(nums []int) bool {
	if len(nums) < 3 {
		return false
	}

	for i := 0; i < len(nums)-2; i++ {
		for j := i + 1; j < len(nums)-1; j++ {
			if nums[i] >= nums[j] {
				continue
			}

			for k := j + 1; k < len(nums); k++ {
				if nums[j] >= nums[k] {
					continue
				}

				if nums[i] < nums[j] && nums[j] < nums[k] {
					fmt.Println(nums[i], nums[j], nums[k])
					return true
				}
			}
		}
	}

	return false
}

// You got to see every index as a upper limit. When we confirm the j (second degree limit)
// we can just wait for a bigger number than j.
func IncreasingTripletV2(nums []int) bool {
	if len(nums) < 3 {
		return false
	}

	i, j, k := -1, -1, -1
	tempMinimal := -1
	for currentIndex, v := range nums {
		if tempMinimal == -1 || v <= nums[tempMinimal] {
			tempMinimal = currentIndex
			continue
		}

		if j == -1 || v <= nums[j] {
			i = tempMinimal
			j = currentIndex
			continue
		}

		k = currentIndex
		if nums[i] < nums[j] && nums[j] < nums[k] {
			return true
		}
	}

	return false
}
