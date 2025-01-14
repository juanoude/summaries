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


