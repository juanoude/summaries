package algorithms

var parenthesesMap = map[string]string{
	"(": ")",
	"{": "}",
	"[": "]",
}

func IsValidParentheses(s string) bool {
	var stack []string

	for _, char := range s {
		_, isOpening := parenthesesMap[string(char)]
		if isOpening {
			stack = append(stack, string(char))
		} else {
			if len(stack) == 0 {
				return false
			}
			lastOpenedChar := stack[len(stack)-1]
			nextClosingTag := parenthesesMap[lastOpenedChar]
			if string(char) != nextClosingTag {
				return false
			}
			if !isOpening {
				stack = stack[:len(stack)-1]
			}
		}
	}

	return len(stack) == 0
}

// Given a string s containing just the characters '(', ')', '{', '}', '[' and ']',
// determine if the input string is valid.

// An input string is valid if:
//     Open brackets must be closed by the same type of brackets.
//     Open brackets must be closed in the correct order.
//     Every close bracket has a corresponding open bracket of the same type.

// Example 1:
// Input: s = "()"
// Output: true

// Example 2:
// Input: s = "()[]{}"
// Output: true

// Example 3:
// Input: s = "(]"
// Output: false

// Constraints:
//     1 <= s.length <= 104
//     s consists of parentheses only '()[]{}'.
