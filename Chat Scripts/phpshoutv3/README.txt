phpSHOUT Set-Up

***Please note if you are upgrading from an older version of phpSHOUT to version 2 the database is now seperate by tabs instead of a symbol. If you need help replacing the symbol into tabs then please e-mail me at info@designanet.co.uk***

1. Upload all the files to your web server.

2. Make sure the CHMOD of messages.txt and banned_ips is 777.

3. CHMOD your shoutbox folder to 777

3. On the pages you want the shoutbox to appear enter the following html code.
<IFRAME SRC="inc_form.php" WIDTH=200 HEIGHT=500 frameborder="0" scrolling="yes"></IFRAME>

**Please note you must change the path to where you have put inc_path on your server. Also these tags can be entered inside table tags.**

4. Check config.php to change settings such as number of posts shown, bad language on or off and many others.

5. If you wish to change the style of phpSHOUT you can visit default.css and change the colours there or there are a few colour templates at http://www.designanet.co.uk.

6. Badlanguage.txt already has lots of vulgar language in but if you wish to add more please feel free. Remember to put a comma in between each word.