package linear_data_structures_test

import (
	ds "data_structures/linear_data_structures"
	"fmt"
	"testing"
)

func TestQueue(t *testing.T) {
	q := ds.CreateQueue()
	order1 := ds.CreateOrder(1, 1)
	q.Add(&order1)
	order2 := ds.CreateOrder(2, 1)
	q.Add(&order2)
	order3 := ds.CreateOrder(3, 1)
	q.Add(&order3)
	order4 := ds.CreateOrder(2, 1)
	q.Add(&order4)
	order5 := ds.CreateOrder(1, 1)
	q.Add(&order5)

	for _, order := range *q {
		fmt.Println(order)
	}

	if (*q)[0].Priority != 3 {
		t.Errorf("Expected 3, got %d", (*q)[0].Priority)
	}

}
