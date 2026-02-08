package algorithms

type ListNode struct {
	Val  int
	Next *ListNode
}

func MergeTwoLists(list1 *ListNode, list2 *ListNode) *ListNode {
	var firstNode *ListNode
	var currentNode *ListNode
	var currentList1Node *ListNode = list1
	var currentList2Node *ListNode = list2

	for currentList1Node != nil || currentList2Node != nil {
		var nextNode *ListNode

		if currentList1Node == nil {
			nextNode = currentList2Node
			currentList2Node = currentList2Node.Next
		} else if currentList2Node == nil {
			nextNode = currentList1Node
			currentList1Node = currentList1Node.Next
		} else {
			isList1Next := currentList1Node.Val <= currentList2Node.Val
			if isList1Next {
				nextNode = currentList1Node
				currentList1Node = currentList1Node.Next
			} else {
				nextNode = currentList2Node
				currentList2Node = currentList2Node.Next
			}
		}

		isFirstNodeNull := firstNode == nil
		if isFirstNodeNull {
			firstNode = nextNode
			currentNode = firstNode
		} else {
			currentNode.Next = nextNode
			currentNode = currentNode.Next
		}
	}

	return firstNode
}

// You are given the heads of two sorted linked lists list1 and list2.
// Merge the two lists into one sorted list. The list should be made by
//  splicing together the nodes of the first two lists.
// Return the head of the merged linked list.

// Example 1:
// Input: list1 = [1,2,4], list2 = [1,3,4]
// Output: [1,1,2,3,4,4]

// Example 2:
// Input: list1 = [], list2 = []
// Output: []

// Example 3:
// Input: list1 = [], list2 = [0]
// Output: [0]

// Constraints:
// * The number of nodes in both lists is in the range [0, 50].
// * -100 <= Node.val <= 100
// * Both list1 and list2 are sorted in non-decreasing order.
