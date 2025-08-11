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
require('config.php');

if (isset($_SESSION['time']))
{
        $setfoward = $_SESSION['time'] + $timedelay;
        $currenttime = date('mdYhis');

        if ($currenttime < $setfoward)
        {
                $_SESSION['time'] = date('mdYhis');
                exit("You must wait " . $timedelay . " seconds in between queries");
        }
}
else
{
        $_SESSION['time'] = date('mdYhis');
}

if ($HTTP_POST_VARS['nickname'] == NULL)
{
        exit("You must enter a nickname");
}

$_SESSION['time'] = date('mdYhis');

        srand(time());
        $random = (rand()%250);
        $nick = $nickbase . $random;

// Do sql

        if ($enable_mysql_caching == true)
        {
        // Delete entries
        @mysql_query("DELETE FROM $sql_table WHERE timestamp < " . time() . "");
        
        // Maybe it's doing a select? I thought so too ;)
        $sql = "SELECT * FROM $sql_table WHERE nickname = '" . addslashes(htmlspecialchars($HTTP_POST_VARS['nickname'])) . "' LIMIT 1";

        $results = mysql_query($sql);

        if (0 < mysql_num_rows($results))
        {
                $row = mysql_fetch_array($results);
                extract($row, EXTR_PREFIX_SAME, "at_");
        }
        } // Caching on/off if

        if ($enable_mysql_caching == false || !isset($row))
        {

        $fp = @fsockopen($irc_server, $port, $errno, $errstr, 45);

        if (!$fp)
        {
                if ($errno = "110")
                {
                        echo "<font color=\"#FF0000\">Could not connect to server. Try again in a few minutes.</font>";
                        exit();
                }
                else
                {
                        echo "$errstr ($errno)<br />\n";
                }
        }
        else
        {
                fwrite($fp, "USER ".$ident." \"nullnet.net\" \"192.168.0.102\" :".$fullname."\n");
                fwrite($fp, "NICK ".$nick."\n");
                $olddata = "";
                $data = "";
                while (!feof($fp))
                {
                        $data = fgets($fp, 1024);
                        $data_a = explode(" ", $data);
                        
                        if ($data != $olddata)
                        {
                                if ($data_a[0] == "PING")
                                {
                                        fwrite($fp, "PONG " . $data_a[1] . "\n");
                                }
                        
                                if ($echo == 1)
                                {
                                        if (!empty($data_a[1]))
                                        {
                                                if ( ( $data_a[1] == "376" ) || ( $data_a[1] == "422" ) )
                                                {
                                                        echo irc_main($fp);
                                                }
                                                elseif ($data_a[1] == "312")
                                                {
                                                        $data312 = $data_a;
                                                }
                                                elseif ($data_a[1] == "311" )
                                                {
                                                        $data311 = $data_a;
                                                }
                                                elseif ($data_a[1] == "317")
                                                {
                                                        $data317 = $data_a;
                                                }
                                                elseif ($data_a[1] == "319")
                                                {
                                                        $data319 = $data_a;
                                                }
                                                elseif ($data_a[1] == "313")
                                                {
                                                        $data313 = $data_a;
                                                
                                                        if (!empty($data313))
                                                        {
                                                                $ircop = $data313[5] . " " . $data313[6] . " " . $data313[7];
                                                        }
                                                }
                                                elseif ($data_a[1] == "307")
                                                {
                                                        $nickreg = "1";
                                                }
                                                elseif ($data_a[1] == "318")
                                                {
                                                        fwrite($fp, "QUIT :Whois Completed\n");
                                                }
                                                elseif ($data_a[1] == "431")
                                                {
                                                        fwrite($fp, "QUIT :Whois Completed\n");
                                                        exit("Nickname not online");
                                                        $_SESSION['time'] = date(His);
                                                }
                                                elseif ($data_a[1] == "402")
                                                {
                                                        fwrite($fp, "QUIT :Whois Completed\n");
                                                        exit("Nickname not online");
                                                        $_SESSION['time'] = date(His);
                                                }
                                        }
                                }
                        $olddata = $data;
                }
        }

        fclose($fp);

}

if (!empty($data311))
{
        $nickname = $data311[3];
        $username = $data311[4];
        $hostname = $data311[5];
        $realname = str_replace(":", "", implode(" ", array_slice($data311, 7)));

        if (!empty($data319))
        {
                $channels = substr(str_replace(":", "", implode(", ", array_slice($data319, 4))), 0, -4);
        }
        else
        {
                $channels = "None";
        }

        $server = $data312[4];
        $servername = str_replace(":", "", $data312[5]);

        if(!empty($data317))
        {
                $length = $data317[4];
                $hms = "";
                $hrs = floor($length / 3600);
                if ($hrs != 0) { $hms .= $hrs . ' hours, '; }
                $min = $length - $hrs * 3600;
                $min = floor($min / 60);
                if ($min != 0) { $hms .= $min . ' minutes, '; }
                $sec = $length - $hrs * 3600 - $min * 60;
                if ($sec != 0) { $hms .= $sec . ' seconds.'; }
                $idletime = $hms;
                $signon = date('m/d/Y g:i:s A T', $data317[5]);
                $signonrfc = date('r', $data317[5]);
        }

        // Insert sql

        if ($enable_mysql_caching == true)
        {
                $idletime = (isset($idletime)) ? $idletime : "";
                $signon = (isset($signon)) ? $signon : "";
                $NewTime = time() + $expire;
                
                mysql_query("INSERT INTO $sql_table 
                (id, nickname, realname, username, hostname, channels, server, idletime, signon, timestamp) 
                        VALUES(
                        NULL, 
                        '" . addslashes(htmlspecialchars($nickname)) . "', 
                        '" . addslashes(htmlspecialchars($realname)) . "', 
                        '" . addslashes(htmlspecialchars($username)) . "', 
                        '" . addslashes(htmlspecialchars($hostname)) . "', 
                        '" . addslashes(htmlspecialchars($channels)) . "', 
                        '" . addslashes(htmlspecialchars($server)) . "', 
                        '" . addslashes(htmlspecialchars($idletime)) . "', 
                        '" . addslashes(htmlspecialchars($signon)) . "', 
                        $NewTime)") or die (mysql_error());
        }

}
else
{
        echo "Nickname not online";
}
}


?>
