# Triggering

```yml
on:
  issues:
    types:
      - opened
```

> [Complete list doc](https://docs.github.com/en/actions/writing-workflows/choosing-when-your-workflow-runs/events-that-trigger-workflows)

```yml
on:
  issues:
    types: [openen, edited, closed]
```

## Filters
The strings can use glob syntax `* ** ? ! +` etc.
```yml
on:
  push:
    branches:
      - main
      - 'rel/v*'
    tags:
      - v1.*
      - beta
```

you can also add ignores and exclusions:
```yml
on:
  push:
    branches-ignore:
      - 'prod/*'
    tags-ignore:
      - 'rc*'
```

```yml
on:
  push:
    branches:
      - 'rel/**'
      - '!rel/**.beta'
```
*Obs:* **`**` means filenames and directories recursively anything Essentially, it matches on anything in a tree structure under the specified path”**

