## Security by Configuration
- Whether or not actions and workflows are allowed to run at all
- If allowed, what the criteria are for which they can be run

If you go to *Actions > General* you will find a place to: 
- *Actions Permissions* -> allow/limit/disable actions and workflows:
    - Here you can start blocking actions from questionable authors, for example (reusable actions only from github or verified authors).
    - Or wildcarts to repos names where the actions belongs to.
- *Outside Collaborators*:
    - extra approval rules for PR workflows.
- *Workflow permissions*:
    - default permissions granted to `GITHUB_TOKEN`
There ar 

### The CODEOWNERS file
*admins* can set up a CODEOWNERS file. The purpose is to define individuals or teams that are responsible for a code. Example:
```
# Example CODEOWNERS file
# Each line os a file pattern - owner pair
# More specific lines need to be further down otherwise overwritten

* @global-default-owner # default

*.go @github-userid

# tester email is used to identify Github User
# corresponding user owns any files in /tests/results tree
/test/results/ tester@mycompany.com
```

> [Code owners doc](https://docs.github.com/en/repositories/managing-your-repositorys-settings-and-features/customizing-your-repository/about-code-owners)
This relates with workflows in the sense that you can specify owners for workflows files and folders. So any change
needs their approval.


### Protection Rules
**TAGS** -> on *Settings > Code and automation > Tags* you can also protect patterns of tags. 
Preventing people from deleting or creatingn tags.

**BRANCHES** -> Some examples:
- Require status checks before merging
- Require conversation resolution before merging
- Require signed commits
- Require linear history
- Require merge queue
- Require deployments to succeed before merging
- Do not allow bypassing the above settings
- Restrict who can push to matching branches
- Allow force pushes
- Allow deletions”

**REPOSITORY** -> *Settings > Code and automation > Rules > Rulesets* consists on:
- ruleset name
- which branches or tags (fnmatch syntax)
- users that can bypass
- protection rules that the ruleset enforce. Examples:
    - Restrict creations
	- Restrict updates
	- Restrict deletes
    - Require linear history
	- Require deployments to succeed before merging
	- Require signed commits
	- Require a pull request before merging
	- Require status checks to pass before merging
	- Block force pushes

## Security by Design

### Secrets
Secrets are encrypted from the time you create them and only decrypted when you use them in a workflow.
They are like encrypted environment variables. They have a few rules:
- They can only contain alphanumeric characters or underscores and no spaces.
- The GITHUB_ prefix is reserved and cannot be used when you create secrets.
- They must not start with numbers.
- They are not case-sensitive.

If you have secrets with the same name, the order of precedence is:
- Deployment environment;
- Repository;
- Organization;

### Securing Secrets
Limiting priviliges to secrets is a good practice. If someone has write access, they also have read access to your secrets.

Ensure to register all secrets that can be logged. So github can redact them and mask their output.

Of course, you should not print out secrets yourself as part of your workflow. But you also need to audit your source 
periodically to make sure secrets are being managed appropriately and not being shared with other systems. And it's 
a good idea to review logs to make sure secrets are being redacted as expected.

Another best practice  is to establish a cycle to audit and rotate secrets.

For environment secrets you can require review access for them.

> Self hosted runners have a lot more to concern in terms of security. Since clean up is not being done by github.

> Audit logs are available for the admins and owners. Showing the history of activities by members.

### Tokens
Used when you need a security setting with more context and defined scope.

Tokens advantages:
- easily stored and referenced programatically;
- can have limited lifetime;
- can be created for targeted resources;
- can have custom permissions and scopes;
- can easily be created and revoked;

### Personal Access Token
(PAT) -> *Settings > Developer Settings*. To access them on GHA you need to store them as a secret.

### The Github Token
It's the default token, just like a PAT, but for the github action, and it's automatically stored as a secret.
This token permission can be specified for your repository or within the workflow.
> The token for a job expires when the job is completed, or after 24h. Whichever comes first.
To access it you just:
```yml
- name: Push Changes
  uses: ad-m/github-push-action@master
  with:
    github_token: ${{ secrets.GITHUB_TOKEN }}
    branch: ${{ github.ref }}
```

```yml
- name: Create Release
  id: create_release
  uses: actions/create-release@latest
  env:
    GITHUB_TOKEN: ${{ github.token }}
```

The github token permissions from default to specific overwrite order:
1. Permissions as set by default for enterprise, organization, or repository
2. Configuration globally in a workflow
3. Configuration in a job
4. Adjusted to read-only if:
    - Workflow triggered by a pull request from a forked repository
	- Setting is not selected

to modify perms you can use:
```yml
permissions:
  actions: read|write|none
  checks: read|write|none
  contents: read|write|none
  deployments: read|write|none
  id-token: read|write|none
  issues: read|write|none
  discussions: read|write|none
  packages: read|write|none
  pages: read|write|none
  pull-requests: read|write|none
  repository-projects: read|write|none
  security-events: read|write|none
  statuses: read|write|none
# If you specify a scope, the ones not included will be set to `none` (minimum amount of privileges)
```
You can use on the top-level (workflow globally) or inside an specific job

```yml
permissions: read-all|write-all # all scopes
```

```yml
permissions: {} # none-all
```

### Untrusted Input / Script Injection

```yml
jobs:
    process:
        runs-on: ubuntu-latest
        steps:
            - run: echo ${{ github.event.head_commit_message }}
            # Congratulations! You just got hacked.
            # `echo my content > demo.txt; ls -la; printenv;`
```

Shell script injection is possible because:
- The run command executes within a temporary shell script on the runner;
- Before this temporary shell script run, the expressions on ${{ }} are evaluated
- Then, it substitutes the evaluated values.

Good practices:
- replacing inline scripts with action calls
- capture values in an intermediate variable

```yml
steps:
    - env:
        DATA_VALUE: ${{ github.event.head_commit.message }}
    run: echo $DATA_VALUE # get owned hacker!
```

### Securing your dependencies

Actions are foreign codes running inside your walls. Keep in mind to:
- use the principle of the least privilege. Run with the least privileges necessary
    - this applies also to secrets you create. Not only the github_token
- verify actions you use
    - at minimum, you should check the verified creator badge;
    - review their code;
    - check for official actions;
    - check stars numbers;
- use the best reference
    - branch: `creator/action-name@main` -> you will get the leading edge, prone to bugs a security issues
    - tag: `creator/action-name@v#` -> more common way of using it. This will only move on minor versions
    - hash: `creator/action-name@319sdfj32f7823f92j03fgs8akk` -> safest way
    - forking the action -> secure, but it takes management to pick up updates, fixes and security improvements.

## Security by Monitoring
### Scaning
github has automated scanning funcionality called Dependabot. 
But you can also pick code security scans easily on the action store

### PR's can open vulnerabilities
- a good start is to set a CODEOWNERS file
- preventing write permissions to the target report
    - if you end up needing it, github has the `pull_request_target` trigger
    - this runs in the context of the target repo, as oposed to the context of the merge commit
- preventing secrets access from a external fork

> Several examples of security flaws are present in the book. Check the chapter for details
