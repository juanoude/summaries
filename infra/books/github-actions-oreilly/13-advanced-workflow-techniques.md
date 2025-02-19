## Driving github

Ways to do it:
- Github CLI
- Scripts
- Github API's

### Github CLI
Github hosted runners already have the CLI installed `gh`
The only prerequisite is to set an *environment variable* named `GITHUB_TOKEN`

```yml
name:  create issue via gh

on:
    workflow_call:
        inputs:
            #...
        outputs:
            issue-number:
                description: "The issue number"
                value: ${{ jobs.create-issue.outputs.inum }}

jobs:
    create-issue:
        runs-on:
            outputs:
                inum: ${{ steps.new-issue.outputs.inum }}
            
            permissions:
                issues: write

            steps:
                - name:
                  id: new-issue
                  run: |
                    reponse=`gh issue create \
                    --title "${{ inputs.title }}" \
                    --body "${{ inputs.body }}" \
                    --repo ${{ github.event.repository.url }}` \
                    echo "inum=$response | rev | cut -d'/' -f 1" >> $GITHUB_OUTPUT
                  env:
                    GITHUB_TOKEN: ${{ secrets.GITHUB_TOKEN }}
```
