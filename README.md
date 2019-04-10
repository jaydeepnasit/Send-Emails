# Send-Emails
Send Email Using Xampp Local Server in PHP

![send-email](https://user-images.githubusercontent.com/26626045/55874488-5c3fc700-5b47-11e9-8223-8c2138fb29f5.jpg)

## Requirements
* XAMPP >= 7.0
* PHP >= 7.1

## Gmail Important Settings
* Off 2 step verification

![1q](https://user-images.githubusercontent.com/26626045/55874400-1be04900-5b47-11e9-856d-32a9849985a1.jpg)

* Allow less secure apps

![2q](https://user-images.githubusercontent.com/26626045/55874403-1d117600-5b47-11e9-8c5c-51c3655c5527.jpg)


## Configure XAMPP To Send Mail From Localhost

* (1) Open Xampp Folder From Your Device & Go " ~\Xampp\sendmail\sendmail.ini ".

![sendmailini](https://user-images.githubusercontent.com/26626045/55871683-074c8280-5b40-11e9-8a43-ef77c7e96e66.jpg)

* (2) Now Open sendmail.ini file & do Following Changes :-

```
smtp_server=smtp.gmail.com
smtp_port=587
smtp_ssl=auto
auth_username=Your_Email_ID
auth_password=Email_ID_Password
```

![123](https://user-images.githubusercontent.com/26626045/55872790-bb4f0d00-5b42-11e9-8db2-aab625e4cd10.jpg)
![456](https://user-images.githubusercontent.com/26626045/55872791-bb4f0d00-5b42-11e9-8bb8-92faebf1d39c.jpg)


* (3) Now Open " ~\xampp\php\php.ini " file & do Following Changes :-

```
sendmail_path = C:\xampp\sendmail\sendmail.exe
Comment = [mail function]
```

![55555](https://user-images.githubusercontent.com/26626045/55874043-0b7b9e80-5b46-11e9-917c-e9e3ad09b4f8.jpg)

* (4) Last Restart Xampp Server.



