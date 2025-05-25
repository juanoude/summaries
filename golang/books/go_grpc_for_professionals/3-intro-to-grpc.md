# Introduction to gRPC
Make sure you have protoc installed and two plugins on top of it `protoc-gen-go` and `protoc-gen-go-grpc`. The former generates Protobuf code, and the
latter generates gRPC code.

```bash
go install google.golang.org/protobuf/cmd/protoc-gen-go@latest
go install google.golang.org/grpc/cmd/protoc-gen-go-grpc@latest
```

## A mature technology
gRPC is not just another new cool framework that you can disregard as being a fad It is a framework that has been battle-tested at scale for over a decade by Google.

- It is important to understand what gRPC is good at;
1. The first use case that everyone is talking about is communication for microservices;
  - Especially for polyglot microservices.
2. Another use case is real-time updates.
  - gRPC gives us the possibility of streaming data.
3. Another important use case is inter-process communication (IPC)
  - Communication happening on the same machine between different processes.
  - It can be useful for synchronizing two or more distinct applications, implementing separation of concerns (SOC) with a modular architecture, or increasing security by having application sandboxing.

Protobuf is the default data schema on gRPC.
gRPC is described as “Protobuf over HTTP/2.”
