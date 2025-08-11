     ###############################################
     ##             Shout version 3.0             ##
     ##                                           ##
     ##                By HockeyGod               ##
     ##                                           ## 
     ##                Copyright 2002             ##
     ##            http://www.cheesehole.net      ##
     ###############################################
Find more scripts by HockeyGod @ http://www.hockeygod.tk

/* ADDED FEATURES:
 -- Now allows for the user to leave their name  (can be disabled)
 -- Sample HTML page for how to display the shout script.
 -- 100% works with tables
 -- User defined number of comments to show.

*/

INSTRUCTIONS:

1.  Make a file called shout.txt and upload it to your server.
	CHMOD this file to 777


2.  Open shout.php with a text editor and change the max length
    to however many characters you want to limit it to.

3.  Use either PHP or SSL to include shout.txt into your page where you want the text to show up.

4. Use the following html to submit text to the shout script.
   Be sure to change the maxlength to a number less than or equal to   the max that you set in the script.


<form method="POST" action="shout.php">
<input size="15" maxlength="10" type="text" name="name">
<input size="15" maxlength="25" type="text" name="c">
<input type="submit" value="Shout">
</form>

Once installed you can use test.php as an example of how this works.


HOW TO DISABLE THE NAME OPTION:

I included the name option in this version because some people wanted it, others, 
however did NOT want it.  If you are like me and don't want the name included, the solution is simple.
Just don't add it to your submit form. 
If the script doesn't recieve a name variable, it simply puts >> in front of each message like the old version did.

DISCLAIMER:

Cheesehole.net offers no warranty or help whatsoever.  Sorry that's what you get with free stuff.

Please don't email me asking for help on installing or customizing thi script, as I don't have time for that.

IF you have any suggestions for this script (or others), however, please feel free to visit my site and email me from there.  I do listen to and reply to suggestions.  --HG

You may distribute this script freely as long as the disclaimer  and code remain un-modified and this text file accompanies it.

All materials copyright 2002  http://www.cheesehole.net

