package linear_data_structures_test

import (
	ds "data_structures/linear_data_structures"
	"testing"
)

func TestSet(t *testing.T) {
	set := ds.Set{}
	set.New()
	set.AddElement(1)
	set.AddElement(2)
	set.AddElement(3)

	if !set.ContainsElement(1) {
		t.Errorf("Expected set to contain element 1")
	}

	if !set.ContainsElement(2) {
		t.Errorf("Expected set to contain element 2")
	}

	if !set.ContainsElement(3) {
		t.Errorf("Expected set to contain element 3")
	}

	set.DeleteElement(2)
	if set.ContainsElement(2) {
		t.Errorf("Expected set to not contain element 2")
	}
}

func TestIntersect(t *testing.T) {
	set := ds.Set{}
	set.New()
	set.AddElement(1)
	set.AddElement(2)

	otherSet := ds.Set{}
	otherSet.New()
	otherSet.AddElement(2)
	otherSet.AddElement(3)

	intersect := set.Intersect(&otherSet)
	if intersect.ContainsElement(1) {
		t.Error("Intersection should not contain 1")
	}
	if !intersect.ContainsElement(2) {
		t.Error("Intersection should contain 2")
	}
	if intersect.ContainsElement(3) {
		t.Error("Intersection should not contain 3")
	}

	union := set.Union(&otherSet)
	if !union.ContainsElement(1) {
		t.Error("Intersection should not contain 1")
	}
	if !union.ContainsElement(2) {
		t.Error("Intersection should contain 2")
	}
	if !union.ContainsElement(3) {
		t.Error("Intersection should contain 3")
	}
}
