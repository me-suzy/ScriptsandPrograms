<?php
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

        See README for more information
*/

        error_reporting(E_ALL);

        require('config.php'); // Needed for DB connection.

        $pageSubmit = false;

        if (isset($_POST['submit']))
        {

                $messageEd = '<p align="center">';

                $db_create = mysql_query("CREATE DATABASE `$sql_database`;");
                if (!$db_create)
                {
                        $messageEd .= 'The database counldn\'t be created: ' . mysql_error();
                }
                else
                {

                        mysql_select_db($sql_database);

                        $messageEd .= 'Database created <br />';

                        $tbl_create = mysql_query("
                        CREATE TABLE `" . $sql_table . "` (
                          `id` int(11) NOT NULL auto_increment,
                          `nickname` varchar(255) NOT NULL default '',
                          `realname` varchar(255) NOT NULL default '',
                          `username` varchar(255) NOT NULL default '',
                          `hostname` varchar(255) NOT NULL default '',
                          `channels` varchar(255) NOT NULL default '',
                          `server` varchar(255) NOT NULL default '',
                          `idletime` varchar(255) NOT NULL default '',
                          `signon` varchar(255) NOT NULL default '',
                          `timestamp` varchar(15) NOT NULL default '',
                          PRIMARY KEY  (`id`)
                        ) TYPE=MyISAM AUTO_INCREMENT=1 ;");

                        if (!$tbl_create)
                        {
                                $messageEd .= 'The table counldn\'t be created: ' . mysql_error();
                        }
                        else
                        {
                                $messageEd .= 'Table created<br />';
                        }
                }
                
                $pageSubmit = true;
                $messageEd .= '</p>';

        }






?>

<!doctype html public "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>

<title> WhoisIRC mySQL Install </title>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="author" content="Ap0s7le" />


</head>
        
<body>
<?php
        if (isset($messageEd) && $messageEd != "")
        {

                echo $messageEd;

        }
        else
        {
?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <table align="center">
                        <tr>
                                <td>mySQL server:</td>
                                <td><? echo (isset($sql_server)) ? "<strong>$sql_server</strong>" : "<strong>Not Set!</strong>"; ?></td>
                        </tr>

                        <tr>
                                <td>mySQL username:</td>
                                <td><? echo (isset($sql_user)) ? "<strong>$sql_user</strong>" : "<strong>Not Set!</strong>"; ?></td>
                        </tr>

                        <tr>
                                <td>mySQL password:</td>
                                <td><? echo (isset($sql_user)) ? "DONE!" : "<strong>Not Set!</strong>"; ?> (Not displayed for security reasons.)</td>
                        </tr>

                        <tr>
                                <td>WhoisIRC database:</td>
                                <td><? echo (isset($sql_database)) ? "<strong>$sql_database</strong>" : "<strong>Not Set!</strong>"; ?></td>
                        </tr>

                        <tr>
                                <td>WhoisIRC table:</td>
                                <td><? echo (isset($sql_table)) ? "<strong>$sql_table</strong>" : "<strong>Not Set!</strong>"; ?></td>
                        </tr>

                        <tr>
                                <td align="center" colspan="2"><input type="submit" name="submit" value="     Create Database / Table     " /></td>
                        </tr>
                
                
                </table>
        </form>

<?php
        }
?>
</body>
        
</html>
