package algorithms

import (
	"strings"
)

func ReverseWordsV1(s string) string {
	words := strings.Split(s, " ")
	reversedArray := []string{}
	for i := len(words) - 1; i >= 0; i-- {
		trimmedElem := strings.Trim(words[i], " ")
		if trimmedElem == "" {
			continue
		}

		reversedArray = append(reversedArray, words[i])
	}

	finalString := ""
	for i, v := range reversedArray {
		finalString = finalString + v
		if i != len(reversedArray)-1 {
			finalString = finalString + " "
		}
	}

	return finalString
}

func ReverseWords(s string) string {
	wordEnd := -1
	reversedString := ""
	for i := len(s) - 1; i >= 0; i-- {
		char := string(s[i])
		if wordEnd == -1 && char != " " {
			wordEnd = i
		}

		if char == " " && wordEnd != -1 {
			AddWord(&reversedString, s[i+1:wordEnd+1])
			wordEnd = -1
			continue
		}

		if i == 0 && wordEnd != -1 {
			AddWord(&reversedString, s[i:wordEnd+1])
		}
	}

	return reversedString
}

func AddWord(phrase *string, wordToAdd string) string {
	if len(*phrase) > 0 {
		*phrase = *phrase + " "
	}

	*phrase = *phrase + wordToAdd
	return *phrase
}
