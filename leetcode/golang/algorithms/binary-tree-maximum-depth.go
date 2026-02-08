package algorithms

type TreeNode struct {
	Val   int
	Left  *TreeNode
	Right *TreeNode
}

func MaxDepth(root *TreeNode) int {
	if root == nil {
		return 0
	}

	return 1 + max(MaxDepth(root.Left), MaxDepth(root.Right))
}

// First attempt - Space Complexity O(n)
// var levelsMap = make(map[int][]*TreeNode)

// func MaxDepth(root *TreeNode) int {
// 	maxDepth := 0
// 	levelsMap[maxDepth] = []*TreeNode{root}

// 	if root == nil {
// 		return 0
// 	}

// 	hasDeeperLevel := root.Left != nil || root.Right != nil
// 	if !hasDeeperLevel {
// 		return 1
// 	}

// 	for hasDeeperLevel {
// 		maxDepth++
// 		hasDeeperLevel, levelsMap[maxDepth] = exploreNodes(levelsMap[maxDepth-1])
// 	}

// 	return maxDepth
// }

// func exploreNodes(levelNodes []*TreeNode) (bool, []*TreeNode) {
// 	var nextLevelNodes []*TreeNode
// 	var hasNextLevel bool
// 	for _, node := range levelNodes {
// 		if node.Left != nil {
// 			nextLevelNodes = append(nextLevelNodes, node.Left)
// 			hasNextLevel = true
// 		}

// 		if node.Right != nil {
// 			nextLevelNodes = append(nextLevelNodes, node.Right)
// 			hasNextLevel = true
// 		}
// 	}

// 	return hasNextLevel, nextLevelNodes
// }

// Given the root of a binary tree, return its maximum depth.
// A binary tree's maximum depth is the number of nodes along
// the longest path from the root node down to the farthest leaf node.

// Example 1:
// Input: root = [3,9,20,null,null,15,7]
// Output: 3

// Example 2:
// Input: root = [1,null,2]
// Output: 2

// Constraints:
// * The number of nodes in the tree is in the range [0, 104].
// * -100 <= Node.val <= 100
