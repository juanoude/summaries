package algorithms

func IsSymmetricIterative(root *TreeNode) bool {
	if root == nil {
		return true
	}

	queue := []*TreeNode{root.Left, root.Right}
	for len(queue) > 0 {
		left := queue[0]
		right := queue[1]
		queue = queue[2:]

		if left == nil && right == nil {
			continue
		}

		if left == nil || right == nil || left.Val != right.Val {
			return false
		}

		queue = append(queue, left.Right, right.Left, left.Left, right.Right)
	}

	return true
}

func IsSymmetricRecursive(root *TreeNode) bool {
	if root == nil {
		return true
	}

	return compareNodes(root.Left, root.Right)
}

func compareNodes(left *TreeNode, right *TreeNode) bool {
	if left == nil && right == nil {
		return true
	}

	if left == nil || right == nil || left.Val != right.Val {
		return false
	}

	return compareNodes(left.Left, right.Right) && compareNodes(left.Right, right.Left)
}

// Given the root of a binary tree, check whether it is a mirror of itself (i.e., symmetric around its center).

// Example 1:
// Input: root = [1,2,2,3,4,4,3]
// Output: true

// Example 2:
// Input: root = [1,2,2,null,3,null,3]
// Output: false

// Constraints:
// * The number of nodes in the tree is in the range [1, 1000].
// * -100 <= Node.val <= 100

// Follow up: Could you solve it both recursively and iteratively?
