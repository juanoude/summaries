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

