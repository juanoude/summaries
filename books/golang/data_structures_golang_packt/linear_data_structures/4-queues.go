package linear_data_structures

type Queue []*Order

type Order struct {
	Priority int
	Value    int
}

func CreateQueue() *Queue {
	queue := make(Queue, 0)
	return &queue
}

func CreateOrder(priority, value int) Order {
	var order Order
	order.Priority = priority
	order.Value = value
	return order
}

func (q *Queue) Add(order *Order) {
	if len(*q) == 0 {
		*q = append(*q, order)
		return
	}

	for i, v := range *q {
		if v.Priority < order.Priority {
			*q = append((*q)[:i], append(Queue{order}, (*q)[i:]...)...)
			return
		}
	}

	*q = append(*q, order)
}
