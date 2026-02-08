package linear_data_structures

type Node struct {
	value    int
	nextNode *Node
}

type LinkedList struct {
	headNode *Node
}

func (linkedList *LinkedList) AddToHead(value int) {
	var node = Node{}
	node.value = value
	if node.nextNode != nil {
		node.nextNode = linkedList.headNode
	}
	linkedList.headNode = &node
}

func (linkedList *LinkedList) IterateList(callback func(node *Node)) {
	var node *Node
	for node = linkedList.headNode; node != nil; node = node.nextNode {
		callback(node)
	}
}

func (linkedList *LinkedList) LastNode() *Node {
	var node *Node
	var lastNode *Node
	for node = linkedList.headNode; node != nil; node = node.nextNode {
		if node.nextNode == nil {
			lastNode = node
		}
	}

	return lastNode
}

func (linkedList *LinkedList) AddToEnd(value int) {
	var lastNode = linkedList.LastNode()
	if lastNode != nil {
		lastNode.nextNode = &Node{value: value}
	}
}

func (linkedList *LinkedList) NodeWith(value int) *Node {
	var node *Node
	for node = linkedList.headNode; node != nil; node = node.nextNode {
		if node.value == value {
			return node
		}
	}

	return nil
}

func (linkedList *LinkedList) AddAfter(value int, afterValue int) {
	var targetNode = linkedList.NodeWith(value)
	if targetNode != nil {
		newNode := &Node{value: afterValue, nextNode: targetNode.nextNode}
		targetNode.nextNode = newNode
	}
}
