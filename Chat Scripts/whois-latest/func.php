<?php
// ---------------- NOTHING IN THIS FILE NEEDS TO BE MODIFIED -----------------
/*
        Whois Script v. 1.2.2
        Author: [ed]
        Site: http://www.acemiles.com
        Support: See site

        Feel free to redistribute,
        modify, etc.. But you MUST
        leave this header in the files.

        Based on code by:
        Cobi (WinBots.org)
        Jon Haworth (Laughing-Buddha.net)
        Ap0s7le (ap0s7le.com)


        NOTE: There is a huge potential
        for someone to be able to
        attack/annoy you on your network
        with this script. You will
        definitely want to look into
        setting up some method to limit
        the number of connections for this
        bot. If you IRCd supports it,
        setup flood limits on the hostmask
        of the bot. This version DOES
        include database caching. You
        should definitely use it.

        There is NO NEED TO MODIFY
        anything in this file.

       
*/

$echo = 1;
function irc_main($fp)
{
$nickname = str_replace(" ", "", $_POST['nickname']);
   fwrite($fp, "WHOIS " . $nickname . " " . $nickname . "\n") or die ("error");
   return "";
}
?>
<? require("irc.php"); ?>
