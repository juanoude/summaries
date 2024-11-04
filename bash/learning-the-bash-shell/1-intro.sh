# sorts and puts results on in the file phonelist.sorted
sort -n phonelist > phonelist.sorted

# display which shell you use
echo $SHELL

# display command locations
whereis bash
whence bash
which bash
grep bash /etc/passwd | awk -F: '{print $7}' | sort -u 

# install bash as your login shell
chsh /usr/local/bin/bash

## String wildcards
# ? - single character
# * - multiple characters
ls *.py
# [set] - any character in set
ls [a-z0-9\.-]*
# [!set] - any character not in set
ls -l # -l long permission details
ls -a # -a all, hidden files

## Brace Expansion
echo b{ed,olt,ar}s # bed bolts bars
echo b{ar{d,n,k},ed}s # bards barns barks beds
ls *.{py,sh}
echo {1..9}
echo {a..z}

## Standard I/O
# Popular UNIX Data Filtering utilities
cat # Copy input to output
grep # Search for string in the input
sort # Sort line in the input
cut # Extract columns from the input
sed # Perform editing operations on the input
tr # Translate characters in the input to other characters

# Examples:
cat < file.txt # prints file contents on screen
sort < file.txt # will sort the lines on the file
date > now # saves the current date to a file called now
cat < file1 > file2 # copies the contents of file1 to file2

## Pipelines - command chaining
ls -l | more # a screen at a time
sort < file.txt | more
# users formatting cam:LM1c7GhNesD4GhF3iEHrH4FeCKB/:501:100:Cameron Newham:/home/cam:/bin/bash
# so you can list the systems users with:
cut -d: -f1 < /etc/passwd | sort
