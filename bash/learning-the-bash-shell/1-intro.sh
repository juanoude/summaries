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


