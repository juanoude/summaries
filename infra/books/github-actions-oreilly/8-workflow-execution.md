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
      - '!rel/**-beta'
```
*Obs:* **`**` means filenames and directories recursively anything Essentially, it matches on anything in a tree structure under the specified path”**
> *The order of the patterns matter*, the more inclusive pattern needs to be on top
> If the "exclusion" comes first, it get's overriten by the next broader pattern


*Obs 2:* **In some cases(e.g push trigger) you need to ensure that the workflow exists on the branch**

```yml
on:
  push:
    paths:
      -'**.go'
```

```yml
on:
  push:
    paths-ignore:
      - 'data/**'
```

paths and paths-ignore cannot be used together, if you need both, you gotta stick with:

```yml
on:
  push:
    paths:
      - 'modules/**'
      - '!module/data**
```

## Workflow without changes
examples:
- `workflow_dispatch`
- `workflow_call`
- `repository_dispatch`
- `workflow_run`

```yml
on:
  workflow_call:
    inputs:
      title:
        type: string
        #...
  workflow_dispatch:
    inputs:
      title:
        type: string
        #...
jobs:
  create_issue_on_failure:
    runs-on: ubuntu-latest

    permissions:
      issues: write
    steps:
      - name: Create issue using rest API
      run: |
        curl --request POST \
        --url https://api.github.com/repos/${{ github.repository }}/issues \
        --header 'authorization: Bearer ${{ secrets.GITHUB_TOKEN }}' \
        --header 'content-type: application/json' \
        --data '{
          "title": "Failure: ${{ inputs.title }}",
          "body": "Details: ${{ inpputs.body }}"
        }' \
        --fail
```

```yml
  #...
  create-issue-on-failure:
    needs: [test-run, count-args]
    if: always() && failure()
    uses: ./.github/workflows/create-failure-issue.yml
    with:
      title: "Automated workflow failure issue for commit ${{ github.sha }}"
      body: "This issue was automatically created by the github actions workflow **${{ github.workflow }}**
  #...
```


the `repository_dispatch` is intended for invoking multiple workflows within a repository. The latter is generally in response to some custom or external (to GitHub) event.

`workflow_run` is a side effect when another workflow executes
```yml
on:
  workflow_run:
    workflows: ["Pipeline"]
    types: [completed]
    branches:
      - 'rel/**'
      - '!rel/**-preprod'
```


## Concurrency
parallelism limitation is done by `concurrency group`

```yml
concurrency: release-build
```
it can be any string

```yml
concurrency: {{ $github.ref }}
```

```yml
jobs:
  build:
    runs-on: ubuntu-latest
      concurrency:
        group: ${{ github.ref }}
        cancel-in-progress: true
```

```yml
concurrency:
  group: ${{ github.workflow }}-${{ github.ref }}
  cancel-in-progress: true
```

## Matrix
a way to apply desirable concurrency with different parameters
```yml
on:
  push:

jobs:
  create-new-issue:
    strategy:
      matrix:
        prod: [prod1, prod2]
        level: [dev, stage, prod]
    uses: .../create-issue@v1
    secrets: inherit
    with:
      title: "${{ matrix.prod }} issue"
      body: "Update for ${{ matrix.level }}"

  report-issue-number:
    runs-on: ubuntu-latest
    needs: create-new-issue
    steps:
      - run: echo ${{ needs.create-new-issue.outputs.issue-num }}
```


