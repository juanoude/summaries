package algorithms

func ProductExceptSelfV1(nums []int) []int {
	finalArray := []int{}
	for i := 0; i < len(nums); i++ {
		currentNumber := 1
		for j := 0; j < len(nums); j++ {
			if i == j {
				continue
			}

			currentNumber = currentNumber * nums[j]
		}

		finalArray = append(finalArray, currentNumber)
		currentNumber = 1
	}

	return finalArray
}

func ProductExceptSelf(nums []int) []int {
	productFromLeft := []int{nums[0]}

	for i := 1; i < len(nums); i++ {
		productFromLeft = append(productFromLeft, productFromLeft[i-1]*nums[i])
	}

	productFromRight := append([]int{}, nums...)
	for i := len(nums) - 2; i >= 0; i-- {
		productFromRight[i] = productFromRight[i+1] * nums[i]
	}

	for i := 0; i < len(nums); i++ {
		nums[i] = 1
		if i > 0 {
			nums[i] = productFromLeft[i-1]
		}

		if i < len(nums)-1 {
			nums[i] = nums[i] * productFromRight[i+1]
		}
	}

	return nums
}
