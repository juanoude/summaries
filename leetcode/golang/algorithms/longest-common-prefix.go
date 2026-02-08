package algorithms

func LongestCommonPrefix(strs []string) string {
	var commonPrefix string
	for index, singleWord := range strs {
		if index == 0 {
			commonPrefix = singleWord
			continue
		} else if len(commonPrefix) == 0 {
			break
		}

		prefixSize := len(commonPrefix)
		for i := (prefixSize - 1); i >= 0; i-- {
			isPrefixBigger := prefixSize > len(singleWord)
			if isPrefixBigger {
				prefixSize -= 1
				commonPrefix = commonPrefix[:prefixSize]
				continue
			}

			doesMatch := singleWord[:prefixSize] == commonPrefix
			if doesMatch {
				continue
			}

			prefixSize -= 1
			commonPrefix = commonPrefix[:prefixSize]
		}
	}

	return commonPrefix
}

// Write a function to find the longest common prefix string amongst an array of strings.
// If there is no common prefix, return an empty string "".

// Example 1:
// Input: strs = ["flower","flow","flight"]
// Output: "fl"

// Example 2:
// Input: strs = ["dog","racecar","car"]
// Output: ""
// Explanation: There is no common prefix among the input strings.

// Constraints:
//     1 <= strs.length <= 200
//     0 <= strs[i].length <= 200
//     strs[i] consists of only lowercase English letters.
