<?php
// ---------------- CONFIG -----------------
// Enter a connection address here for your server
        $irc_server             =       "irc.yournetwork.here";

// Enter a port number for your server
        $port                   =       "6667";

// Enter the base nickname that you want your WHOIS bot to use
        $nickbase               =       "WhoisIRC";

// Enter the ident for your WHOIS bot
        $ident                  =       "WhoisIRC";

// Enter the fullname for your WHOIS bot
        $fullname               =       "WhoisIRC";

//Number of seconds to force user to wait in between multiple WHOIS queries
        $timedelay              =       "30";

// Set timeout for cached entries, in seconds. (How long do you want MySQL caching to hold data?)
        $expire                 =       600;

// MySQL Database information

        $enable_mysql_caching   =       false;                  // Set to 'true' if you want it, 'false' if you don't (NO QUOTES)
        $sql_server             =       'mysql.yourhost.here';  // Your mySQL server name
        $sql_user               =       'username';             // Your username for DB access
        $sql_password           =       'password';             // Your password for DB access
        $sql_database           =       'whoisirc';             // This can normally be left alone
        $sql_table              =       'whoisirc';             // Normally left alone too! :)



//NO NEED TO MODIFY BELOW THIS LINE


        $sql_connection = mysql_connect($sql_server, $sql_user, $sql_password);
        if (!$sql_connection)
        {
                die("There was an error, please contact the administrator. <br />" . mysql_error());
        }
        else
        {
                mysql_select_db($sql_database);
        }

?>
