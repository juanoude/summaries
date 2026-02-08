package algorithms

func InvertTree(root *TreeNode) *TreeNode {
	if root == nil {
		return root
	}

	if root.Left == nil && root.Right == nil {
		return root
	}

	invertChilds(root)
	return root
}

func invertChilds(root *TreeNode) {
	if root == nil {
		return
	}

	root.Left, root.Right = root.Right, root.Left
	invertChilds(root.Left)
	invertChilds(root.Right)
}

// Given the root of a binary tree, invert the tree (left <-> right), and return its root.

// Example 1:
// Input: root = [4,2,7,1,3,6,9]
// Output: [4,7,2,9,6,3,1]

// Example 2:
// Input: root = [2,1,3]
// Output: [2,3,1]

// Example 3:
// Input: root = []
// Output: []

// Constraints:
// * The number of nodes in the tree is in the range [0, 100].
// * -100 <= Node.val <= 100
