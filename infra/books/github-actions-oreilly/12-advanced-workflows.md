## Starter workflows
You can create template-like workflows to easily bootstrap new creations. Check chapter for details

## Reusable workflows
the `work_flow_call` trigger makes it invokable from another action
```yml
name: Repo stuff
on:
    workflow_call:

jobs:
    #...
```

```yml
name: Get info
on:
    push:
jobs:
    info:
        uses: rndrepos/common/.github/workflows/repo-stuff.yml@main
```

### Inputs and secrets
You need to define secrets on a workflow_call
```yml
on:
    workflow_call:
        secrets:
            token:
                required: true
        inputs:
            #...

jobs:
    create_issue:
        runs-on: ubuntu-latest
        
        permissions:
            issues: write
        steps:
            - name: Create issue using REST API
              run: |
                curl --request POST \
                --url https://api.github.com/repos/${{ github.repository }}/issues \
                --header 'authorization: Bearer ${{ secrets.token }} \
                --header 'content-type: application/json' \
                --data '{
                    "title": "${{ inputs.title }}",
                    "body": "${{ inputs.title }}"
                }' \
                --fail
```

When calling you would need to specify

```yml
on:
    push:

jobs:
    msg:
        runs-on: ubuntu-latest
        steps:
            - run: echo "Simple demo for reusable workflow"
        
        issue:
            uses: ./.github/workflows/create-repo-issue.yml@main"
            secrets:
                token: ${{ secrets.PAI }}
```

```yml
on:
    push:

jobs:
    issue:
        uses: ./.github/workflows/create-repo-issue.yml@main"
        secrets: inherit
        with:
            #...
```

Notice that one of the constraints of reusable workflows is that you can either call a reusable workflow or have a series of steps.

### Outputs 
We can change the workflow to send an output
```yml
on:
    workflow_call:
    inputs:
        title:
            description: 'Issue title'
            required: true
            type: string
        body:
            description: 'Issue body'
            required: true
            type: string
    outputs:
        issue-num:
            description: "The issue number"
            value:  ${{ jobs.create-issue.outputs.inum }}

jobs:
    create-issue:
        runs-on: ubuntu-latest
        # Map job outputs to step outputs
        outputs:
            inum: ${{ steps.new-issue.outputs.inum }}
        permissions:
            issues: true
        steps:
            - name: Create issue using REST API
              id: new-issue
              run: |
                response=$(curl --request POST \
                --url https://api.github.com/repos/${{ github.repository }}/issues \
                --header 'authorization: Bearer ${{ secrets.token }} \
                --header 'content-type: application/json' \
                --data '{
                    "title": "${{ inputs.title }}",
                    "body": "${{ inputs.title }}"
                }' \
                --fail | jq '.number')
                echo "inum=$response" >> $GITHUB_OUTPUT
```

```yml
name: Create demo issue 3
on:
    push:

jobs:
    create-new-issue:
        uses: ./.github/workflows/create-issue.yml@v1
        secrets: inherit
        with:
            title: "Test issue"
            body: "Test body"
    
    report-issue-number:
        runs-on: ubuntu-latest
        needs: create-new-issue
        steps:
            - run: echo ${{ needs.create-new-issue.outputs.issue-num }}
```

### Limitations
- A call from a reusable workflow to another reusable workflow can only happen within a depth of four calls.
- A caller workflow can call a maximum of 20 reusable workflows. Nested workflows count to this limit aswell.
- Environment variables set in a env context in the caller workflow are not propagated to the caller workflow.
- You can't reference a reusable workflow that's in a separate private repository.

### Composite Actions Comparison
| Reusable | Composite |
-----
| 4 nested calls at max | up to 10 nested calls |
| Able to pass secrets directly | Must pass secrets as an input |
| Can use if conditionals | Cannot use if conditionals |
| Loose yml files | Require their own independent repo |
| Can have multiple jobs | Can only have steps that equate to one job |
| Able to specify a runner | Inherits runner from caller |

### Required workflows
Admins can enforce workflows that must run.
General > Add required workflow
> Needs to have a `pull_request` or `pull_request_target` trigger and cannot have a code-scanning action.
You can impose required workflows at the organization level
