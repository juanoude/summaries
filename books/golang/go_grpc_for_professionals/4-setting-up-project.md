## Create a project structure

> client
>
> > go.mod
>
> go.work
>
> proto
>
> > dummy
> >
> > > v1
> > >
> > > > dummy.proto
> >
> > go.mod
>
> server
>
> go.mod



```bash
go mod init github.com/github.com/PacktPublishing/
gRPC-Go-for-Professionals/
$FOLDER_NAME
```

> Initiates submodule on `client` `proto` and `server`

```bash
find . -maxdepth 1 -type d -not -path . -execdir sh -c "pushd {}; go mod init 'github.com/PacktPublishing/gRPC-Go-for-Professionals/{}'; popd" ";"
```

> fancier command for the same task

```go
go work init client server proto
```

> At root, create the workspace file:

```go
go 1.20

use (
	./client
    ./proto
    ./server
)
```

> go.work



```protobuf
syntax = "proto3";

option go_package = "github.com/PacktPublishing/gRPC-Go-for-Professionals/proto/dummy/v1;"

message DummyMessage {}
service DummyService {}
```

> dummy.proto



## Generating go code

### Using Protoc

- Documentation [#](https://docs.buf.build/installation.)
- help command - `protoc --help`

```bash
protoc --go_out=. \
--go_opt=module=github.com/PacktPublishing/gRPC-Go-for-Professionals \
--go-grpc_out=. \
--go-grpc_opt=module=github.com/PacktPublishing/gRPC-Go-for-Professionals \
proto/dummy/v1/dummy.proto
```

> At root



### Using Buf

- Documentation [#](https://buf.build/docs/cli/quickstart/)

```bash
buf mod init
```

> At root



```yaml
version: v1
plugins:
	- plugin: go
	  out: proto
	  opt: paths=source_relative
	- plugin: go-grpc
	  out: proto
	  opt: paths=source_relative
```

> buf.gen.yaml

```bash
protoc --go_out=. \
--go_opt=paths=source_relative \
--go-grpc_out=. \
--go-grpc_opt=paths=source_relative \
proto/dummy/v1/dummy.proto
```

> This is what buf is running. But we only need to:

```bash
buf generate proto
```





### Using Bazel

- Documentation [#](https://bazel.build/reference/be/protocol-buffer)
- Book project updates [#](https://github.com/PacktPublishing/gRPC-Go-for-Professionals/tree/main/chapter4)

It's trickier to configure, but sometimes it's worth the effort. It will cover both protobuf generation and application building in a single command. With multi-language capabilities.

```python
workspace(name = "github_com_packtpublishing_grpc_go_for_professionals")

load("//:versions.bzl",
    "GO_VERSION",
    "RULES_GO_VERSION",
    "RULES_GO_SHA256",
    "GAZELLE_VERSION",
    "GAZELLE_SHA256",
    "PROTO_VERSION"
)

load("@bazel_tools//tools/build_defs/repo:http.bzl",
    "http_archive")
load("@bazel_tools//tools/build_defs/repo:git.bzl", "git_repository")

http_archive(
	name = "bazel_gazelle",
	sha256 = GAZELLE_SHA256,
	urls = [
		"https://mirror.bazel.build/github.com/bazelbuild/bazel-gazelle/releases/download/%s/bazel-gazelle-
%s.tar.gz" % (GAZELLE_VERSION, GAZELLE_VERSION),
		"https://github.com/bazelbuild/bazel-gazelle/releases/download/%s/bazel-gazelle-%s.tar.gz" % (GAZELLE_VERSION, GAZELLE_VERSION),
	],
)

http_archive(
	name = "io_bazel_rules_go",
	sha256 = RULES_GO_SHA256,
	urls = [
		"https://mirror.bazel.build/github.com/bazelbuild/rules_go/releases/download/%s/rules_go-%s.zip" % (RULES_GO_VERSION, RULES_GO_VERSION),
		"https://github.com/bazelbuild/rules_go/releases/download/%s/rules_go-%s.zip" % (RULES_GO_VERSION, RULES_GO_VERSION),
	],
)

load("@io_bazel_rules_go//go:deps.bzl", "go_register_toolchains", "go_rules_dependencies")
load("@bazel_gazelle//:deps.bzl", "gazelle_dependencies")
go_rules_dependencies()
go_register_toolchains(version = GO_VERSION)
gazelle_dependencies(go_repository_default_config = "//:WORKSPACE.bazel")

git_repository(
	name = "com_google_protobuf",
	tag = PROTO_VERSION,
	remote = "https://github.com/protocolbuffers/protobuf"
)
load("@com_google_protobuf//:protobuf_deps.bzl", "protobuf_deps")
protobuf_deps()
```

> WORKSPACE.bazel



