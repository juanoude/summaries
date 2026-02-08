package algorithms

import (
	"math"
)

func BalancedBinaryTree(root *TreeNode) bool {
	if root == nil {
		return true
	}

	return CheckBalance(root)
}

func CheckBalance(root *TreeNode) bool {
	if root == nil {
		return true
	}

	leftTree := GetHeight(root.Left)
	rightTree := GetHeight(root.Right)

	if math.Abs(float64(leftTree)-float64(rightTree)) > 1 {
		return false
	}

	return CheckBalance(root.Left) && CheckBalance(root.Right)
}

func GetHeight(node *TreeNode) int {
	if node == nil {
		return 0
	}

	leftSize := 1 + GetHeight(node.Left)
	rightSize := 1 + GetHeight(node.Right)

	if leftSize > rightSize {
		return leftSize
	}

	return rightSize
}
