package algorithms

func NumberOfIslands(grid [][]byte) int {
	var islandsCount int
	for i := 0; i < len(grid); i++ {
		for j := 0; j < len(grid[0]); j++ {
			if grid[i][j] == 1 {
				processIsland(grid, i, j)
				islandsCount++
			}
		}
	}

	return islandsCount
}

func processIsland(grid [][]byte, i, j int) {
	if i < 0 || j < 0 || i >= len(grid) || j >= len(grid[0]) || grid[i][j] == 0 {
		return
	}

	grid[i][j] = 0

	processIsland(grid, i-1, j)
	processIsland(grid, i+1, j)
	processIsland(grid, i, j-1)
	processIsland(grid, i, j+1)
}

// Given an m x n 2D binary grid grid which represents a map of
// '1's (land) and '0's (water), return the number of islands.

// An island is surrounded by water and is formed by connecting adjacent
// lands horizontally or vertically. You may assume all four edges of
// the grid are all surrounded by water.

// Example 1:
// Input: grid = [
//   ["1","1","1","1","0"],
//   ["1","1","0","1","0"],
//   ["1","1","0","0","0"],
//   ["0","0","0","0","0"]
// ]
// Output: 1

// Example 2:
// Input: grid = [
//   ["1","1","0","0","0"],
//   ["1","1","0","0","0"],
//   ["0","0","1","0","0"],
//   ["0","0","0","1","1"]
// ]
// Output: 3

// Constraints:
// * m == grid.length
// * n == grid[i].length
// * 1 <= m, n <= 300
// * grid[i][j] is '0' or '1'.
