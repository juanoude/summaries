## Pascal Triangle
It represents the coefficients of (x + 1)<sup>i</sup> with row i. It sums the two superior adjacents numbers from the previous line

```
                    1
                1       1
            1       2       1           # 1 + 1 = 2...
        1       3       3       1
    1       4       6       4       1
1       5       10      10      5       1
```

e.g. row 4 = (x + 1)<sup>4</sup> = x<sup>4</sup> + 4x<sup>3</sup> + 6x<sup>2</sup> + 4x + 1

```java
public static int[][] pascalTriangle(int n) {
    int[][] pt = new int[n][];
    for (int i = 0; i < n; i++) {
        pt[i] = new int[i + 1];
        pt[i][0] = 1;
        for (int j = 1; j < i; j++) {
            pt[i][j] = pt[i-1][j-1] + pt[i-1][j];
        }
        
        pt[i][i] = 1;
    }
}
```


