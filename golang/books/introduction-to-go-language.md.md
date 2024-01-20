# Concurrency

Go has a wide support to concurrency using goroutines and channels

## Goroutines
Goroutine is a function capable of executing concurrently with other functions by just using the reserved word `go`
```go
package main

import (
	"fmt"
	"math/rand"
	"time"
)

func f(n int) {
	for i:=0; i<20; i++ {
		fmt.Println(n, ":", i)
		randomDuration := time.Duration(rand.Intn(250))
		time.Sleep(time.Millisecond * randomDuration)
	}
}

func main() {
	for i:=0;i<10;i++ {
		go f(i)
	}

	var input string
	fmt.Scanln(&input)
}
```

The code won't wait for the function finish, it just triggers it and jump to the next line right away. It would work like a TypeScript promise without an `await`, that's why we placed a Scan input so the code doesn't exit early. 
You can also tell that they execute in parallel by the terminal outputs.

## Channels

Channels offer a way for goroutines to communicate with one another and sync both executions:
```go
package main

import (
	"fmt"
	"time"
)

func  pinger(c chan  string) {
	for i :=  0; ; i++ {
		c <-  "ping"
	}
}

func  printer(c chan  string) {
	for {
		msg :=  <-c
		fmt.Println(msg)
		time.Sleep(time.Second *  1) // This examplifies the blocking nature of channels
	}
}

func main() {
	var c chan string =  make(chan  string)
	go  pinger(c)
	go  printer(c)

	var input string
	fmt.Scanln(&input)
}
``` 
* A channel type is represented by the word `chan` followed by the type of the transferred info.
* The operator that sends and receives the info is `<-`.
* Using a channel this way syncs both functions.
	* When the pinger function tries to send a message. It waits until the printer function is ready.
	* This is known as **block**

### Channel Direction

<!--stackedit_data:
eyJoaXN0b3J5IjpbLTIwNzIwNjkwNzZdfQ==
-->