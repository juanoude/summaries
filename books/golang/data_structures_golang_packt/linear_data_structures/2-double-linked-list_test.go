package linear_data_structures_test

import (
	ds "data_structures/linear_data_structures"
	"testing"
)

func TestDoubleLinkedList(t *testing.T) {
	dlList := ds.DoubleLinkedList{}
	dlList.AddToHead(3)
	dlList.AddToHead(2)
	dlList.AddToHead(1)
	dlList.AddToEnd(4)
	dlList.AddToEnd(5)
	dlList.AddToEnd(6)

	var resultArray []int
	dlList.IterateList(func(node *ds.DLNode) {
		resultArray = append(resultArray, node.Value)
	})

	for i, val := range resultArray {
		if val != i+1 {
			t.Errorf("Expected %d, got %d", i+1, val)
		}
	}
}
