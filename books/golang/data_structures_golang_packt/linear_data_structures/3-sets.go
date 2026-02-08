package linear_data_structures

type Set struct {
	integerMap map[int]bool
}

func (set *Set) New() {
	set.integerMap = make(map[int]bool)
}

func (set *Set) ContainsElement(element int) bool {
	var exists bool
	_, exists = set.integerMap[element]
	return exists
}

func (set *Set) AddElement(element int) {
	if !set.ContainsElement(element) {
		set.integerMap[element] = true
	}
}

func (set *Set) DeleteElement(element int) {
	delete(set.integerMap, element)
}

func (set *Set) Intersect(otherSet *Set) *Set {
	var intersectSet = &Set{}
	intersectSet.New()
	for k, _ := range set.integerMap {
		if otherSet.ContainsElement(k) {
			intersectSet.AddElement(k)
		}
	}

	return intersectSet
}

func (set *Set) Union(otherSet *Set) *Set {
	var unionSet = &Set{}
	unionSet.New()
	for k, _ := range set.integerMap {
		unionSet.AddElement(k)
	}

	for k, _ := range otherSet.integerMap {
		unionSet.AddElement(k)
	}

	return unionSet
}
