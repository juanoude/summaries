package main

import (
	"fmt"
	"leetcode_golang/algorithms"
)

func main() {
	arg := []int{1, 2, 0, 1, 0, -1, -3, 3}
	result := algorithms.IncreasingTripletV2(arg)
	fmt.Println(result)
}
