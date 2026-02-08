## Observability
def -> to be able to quickly and easily identify and find the information you need about the current state of a proccess or system.

### Status badge
You can create status badges based on the last workflow run.
- On the main actions screen, select the options, you can create on the options.

### Past States
- Until 30 days you can re-run failed workflows
- If you click on the options of the workflow run, you can select the `View workflow file` option and see the workflow at the time the job ran

### Debugging
You can activate debug logging on an specific workflow.
There is two types of debug logging:
1. step debug logging
2. runner diagnostic logging
    - shows whats happening in the runner system

To create the secrets or variable to enable debug information, you would enter `ACTIONS_STEP_DEBUG` or `ACTIONS_​RUN⁠NER​_​DEBUG` as the name and true as the value.

You can add your message logs:
```bash
echo "::debug::This is a debug message"

# alternatively you also can:
echo "::warning::This is a warning message"
echo "::notice::This is a notice message"
echo "::error::This is a error message"
```
You can also add additional parameters:
```bash
#file col endCol line endLine
echo "::error file=pipe.yaml,line=5,col=4,endColumn=8::Operation not allowed"
```

You can also group logs:
```yml
steps:
    - name: Group lines in log
    run: |
        echo "::group::Extended info
        echo "Info line 1"
        echo "Info line 2"
        echo "Info line 3"
        echo "::endgroup::"
```

You can also mask sensitive values:
```yml
jobs:
    log_formatting:
        runs-on: ubuntu-latest
        env:
            USER_ID: "User 1234"
        steps:
            - run: echo "::add-mask::$USER_ID"
            - run: echo "USER_ID is $USER_ID"
```

### Creating custom summary
```yml
jobs:
    build:
        runs-on: ubuntu-latest
        steps:
            - run: |
                echo "Do build phase 1"
                echo "Build phase 1 done :star:" >> $GITHUB_STEP_SUMMARY
                
            - run: |
                echo "Do build phase 2"
                echo "Build phase 2 done with parameter ${{ github.event.inputs.param1 }} :exclamation:" >> $GITHUB_STEP_SUMMARY
    test:
        runs-on: ubuntu-latest
        steps:
            - run: echo "Do testing..."
            - name: Add testing summary
              run: |
                echo "Testing summary follows:" >> $GITHUB_STEP_SUMMARY
                echo " | Test | Result | " >> $GITHUB_STEP_SUMMARY
                echo " | ---: | ------:| " >> $GITHUB_STEP_SUMMARY
                echo " | 1 | :white_check_mark: | " >> $GITHUB_STEP_SUMMARY
                echo " | 2 | :no_entry_sign | " >> $GITHUB_STEP_SUMMARY
```

for the complete list of emojis available check [this link](https://gist.github.com/rxaviers/7360908)
