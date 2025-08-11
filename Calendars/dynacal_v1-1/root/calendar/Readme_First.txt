DYnaCal V1.1.0 Copyright (c) 2004 Liquid Frog - www.liquidfrog.com

To get the calendar script working - 



CREATING THE DIRECTORIES:

Create a directory on your server to take the script.
You can call it whatever you like. Now set permissions 
(chmod) to 777 (drwxrwxrwx - Read-all, Write-all, Execute-all).
Inside the directory you have just created, create another empty 
directory and call it "items".
Please note - the sub directory items MUST exist on your server
or the script will not function. Once you have created the directory
items, chmod it to 777 (drwxrwxrwx - Read-all, Write-all, Execute-all). 



UPLOADING THE SCRIPT:

Upload all the files to the directory you created on your webserver.
Chmod the file clck.php to 777
Do not upload this Readme_First.txt file - it is not needed.



RUNNING THE SCRIPT:

Open your browser and browse to http://www.yoursite.com/your_calendar_directory/admin.php
Enter the temporary username and password: Admin username = demo, Admin password = demo
Click on Go! 
The admin panel will be shown.
Now click on "Help".
The help file will provide you with further instructions.


UPGRADING:

To upgrade from V1.0 to this version, copy the files config.php, calendar.php and clck.php to your server
overwriting the files already there. Edit config.php to suit. Make sure that clck.php is Chmodded to 777.

PROBLEMS?:

Type this into your browser http://www.yoursite.com/your_calendar_directory/help.html

End file.
(C) 2004 Liquid Frog
