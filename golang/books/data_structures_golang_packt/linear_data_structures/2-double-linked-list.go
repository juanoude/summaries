package linear_data_structures

import (
	"errors"
	"strconv"
)

type DLNode struct {
	Value    int
	prevNode *DLNode
	nextNode *DLNode
}

type DoubleLinkedList struct {
	headNode *DLNode
	tailNode *DLNode
	length   int
}

func (dlinkedList *DoubleLinkedList) AddToHead(value int) {
	var newNode = DLNode{Value: value}
	if dlinkedList.headNode != nil {
		newNode.nextNode = dlinkedList.headNode
		dlinkedList.headNode.prevNode = &newNode

	}

	if dlinkedList.length == 0 {
		dlinkedList.tailNode = &newNode
	}

	dlinkedList.headNode = &newNode
	dlinkedList.length++
}

func (dlinkedList *DoubleLinkedList) AddToEnd(value int) {
	var newNode = DLNode{Value: value}
	if dlinkedList.tailNode != nil {
		newNode.prevNode = dlinkedList.tailNode
		dlinkedList.tailNode.nextNode = &newNode
	}

	if dlinkedList.length == 0 {
		dlinkedList.headNode = &newNode
	}

	dlinkedList.tailNode = &newNode
	dlinkedList.length++
}

func (dlinkedList *DoubleLinkedList) NodeBetweenValues(firstValue int, secondValue int) *DLNode {
	for node := dlinkedList.headNode; node != nil; node = node.nextNode {
		if node.Value == firstValue && node.nextNode != nil && node.nextNode.Value == secondValue {
			return node
		}
	}

	return nil
}

func (dlinkedList *DoubleLinkedList) NodeWithValue(value int) *DLNode {
	var coveredNodes = 0
	var headPointer = dlinkedList.headNode
	var tailPointer = dlinkedList.tailNode
	for coveredNodes < dlinkedList.length {
		if headPointer.Value == value {
			return headPointer
		}

		headPointer = headPointer.nextNode
		coveredNodes++

		if tailPointer.Value == value {
			return tailPointer
		}
		tailPointer = tailPointer.prevNode
		coveredNodes++
	}

	return nil
}

func (dlinkedList *DoubleLinkedList) IterateList(callback func(node *DLNode)) {
	var node *DLNode
	for node = dlinkedList.headNode; node != nil; node = node.nextNode {
		callback(node)
	}
}

func (dlinkedList *DoubleLinkedList) AddAfter(refValue int, newValue int) error {
	var refNode = dlinkedList.NodeWithValue(refValue)
	if refNode == nil {
		return errors.New("Node with value " + strconv.Itoa(refValue) + " not found")
	}

	var newNode = DLNode{Value: newValue}
	refNode.nextNode.prevNode = &newNode
	refNode.prevNode.nextNode = &newNode
	return nil
}
