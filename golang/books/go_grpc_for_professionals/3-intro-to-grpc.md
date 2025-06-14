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

To get a feeling of how things look in go, let's look at a simple service in `proto/account.proto`:
```protobuf
syntax = "proto3"
option go_package = "github.com/PacktPublishing/gRPC-Go-for-Professionals";

message Account {
  uint64 id = 1;
  string username = 2;
}

message LogoutRequest {
  Account account = 1;
}

message LogoutResponse {}

service AccountService {
  rpc Logout (LogoutRequest) returns (LogoutResponse);
}
```

```bash
protoc --go_out=. \
    --go_opt=module=github.com/PacktPublishing/gRPC-Go-for-Professionals \
    --go-grpc_out=. \
    --go-grpc_opt=module=github.com/PacktPublishing/gRPC-Go-for-Professionals \
    proto/account.proto
```

This generates on the **SERVER SIDE**, the account service class for example:
```go
var AccountService_ServiceDesc = grpc.ServiceDesc{
	ServiceName: "AccountService",
	HandlerType: (*AccountServiceServer)(nil),
	Methods: []grpc.MethodDesc{
		{
			MethodName: "Logout",
			Handler: _AccountService_Logout_Handler,
		},
	},
	Streams: []grpc.StreamDesc{},
	Metadata: "account.proto",
}
```

You should also find the Handler file:
```go
func _AccountService_Logout_Handler(srv interface{}, ctx context.Context,
		dec func(interface{}) error, interceptor
		grpc.UnaryServerInterceptor) (interface{}, error) {

	in := new(LogoutRequest)
	if err := dec(in); err != nil {
		return nil, err
	}
	if interceptor == nil {
		return srv.(AccountServiceServer).Logout(ctx, in)
	}
	//...
}
```

Finally the accout service type:
```go
type AccountServiceServer interface {
	Logout(context.Context, *LogoutRequest) (*LogoutResponse, error)
	mustEmbedUnimplementedAccountServiceServer()
}
```

And its implementation:
```go
type UnimplementedAccountServiceServer struct {}

func (UnimplementedAccountServiceServer)
Logout(context.Context, *LogoutRequest) (*LogoutResponse, error) {
	return nil, status.Errorf(codes.Unimplemented, "method Logout not implemented")
}
```

As you can see this is some boilerplate code that needs you to complement. Probably we will have to do:
```go
type struct Server {
	UnimplementedAccountServiceServer
}
```

This is called type embedding, and this is the way Go goes about adding properties and methods from another type. You might have heard the advice to prefer composition over inheritance, and that is just that. We add the methods’ definitions from UnimplementedAccountServiceServer to Server. This will let us have the default implementations that return method Logout not implemented generated for us. This means that if a server without a full implementation receives a call on one of its unimplemented API endpoints, it will return an error but not crash because of the non-existent endpoint.

Now on the **CLIENT SIDE** you can see:
```go
type AccountServiceClient interface {
	Logout(ctx context.Context, in *LogoutRequest, opts ...grpc.CallOption) (*LogoutResponse, error)
}
```

```go
type accountServiceClient struct { // I- differentiating interface from implementation by first letter casing.
	cc grpc.ClientConnInterface
}
func NewAccountServiceClient(cc grpc.ClientConnInterface) AccountServiceClient {
	return &accountServiceClient{cc}
}
func (c *accountServiceClient) Logout(ctx context.Context, in *LogoutRequest, opts ...grpc.CallOption) (*LogoutResponse, error) {
	out := new(LogoutResponse)
	err := c.cc.Invoke(ctx, "/AccountService/Logout", in, out, opts...)
	if err != nil {
		return nil, err
	}

	return out, nil
}
```
