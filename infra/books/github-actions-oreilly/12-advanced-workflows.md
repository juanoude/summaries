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

