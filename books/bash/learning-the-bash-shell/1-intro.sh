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


## Background Jobs
uncompress gcc.tar.gz & # you will see a line like [1] 175
# These numbers gives you ways to refer to the background job

diff file1.txt file2.txt # diffs file
diff file1.txt file2.txt & # diffs on background
# if the files are big, it will pollute your terminal and be dificult to stop
diff file1.txt file2.txt > txtdiff & # diffs on background and saves on a log
# every job has a priority, to lower the priority of a job you can use
nice command

## Special Characters
# we already saw < > & | * ? [] {}
# ~ -> home directory
# ` -> command substitution
# # -> comment
# $ -> variable
# () -> subshell
# \ -> escape
# ; -> command separator
# <"> -> weak quoting
# / -> path separator
# ! -> logical not

## Quoting
echo 2 * 3 > 5 is a valid inequality # creates a file named 5
echo '2 * 3 > 5 is a valid inequality' # creates a string
# double quotes still treats some special characters as special (weak quoting)
## Escaping
echo 2 \* 3 \> 5 is a valid inequality 
echo \"2 \* 3 \> 5\" is a valid inequality # printing quotes
echo 'Hatter\'s tea Party' ' # this escape doesn`t work
echo 'Hatter'\''s tea Party' # this escape works
# To break line you just need to quote the return key
echo This is a phrase that contains several lines \
The return key is just another character you should just escape it \
and you should be good to go my fellow students
# Or you can just use a quotation
echo 'Some multiline
string, this works just fine'

## Control Keys
erase   kill    werase   rprnt  flush   lnext   susp    intr   quit   stop    eof
^?      ^U      ^W       ^R     ^O      ^V      ^Z/^Y   ^C     ^\     ^S/^Q   ^D

CTRL-C - intr - Stop current command
CTRL-D - eof  - End of input
CTRL-\ - quit - Stop current command if CTRL-C doesn't work
CTRL-S - stop - Halt output to screen
CTRL-Q - start - Restart output to screen
DEL or CTRL-? - erase - Erase last character
CTRL-U - kill - Erase entire command line
CTRL-Z - susp - Suspend current command

stty -a # shows terminal control keys
help cd # shows info on bash commands


