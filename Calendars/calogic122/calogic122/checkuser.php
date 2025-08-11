<?php require_once("./include/config.php"); ?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<title>User Name Check</title>
</head>
<body <?php print $GLOBALS["sysbodystyle"]; ?>>
<center>
<?php
if(!isset($username)) {
    print "<h3>No User Name was given.</h3>";
} else {
    $username = mqfix($username);
    #mqfix($username);
    if(strtoupper($username)=="GUEST") {
        $badun = true;
    } else {
        $badun = false;
    }

    for($xl=0;$xl<strlen($username);$xl++) {
        if(ereg("^[^a-zA-Z0-9]$",substr($username,$xl,1))) {
            $badun = true;
        }
    }
    if($badun==true) {
        print "<b>User name has invalid characters or is not allowed, only leters and numers are allowed</b><br><br>";
    } else {

        $sqlstr = "select uname from ".$GLOBALS["tabpre"]."_user_reg where uname = '".$username."'";
        $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $qu_num = @mysql_num_rows($query1);
        if($qu_num < 1) {
            print "<h3>The User Name \"$username\" is not in use.</h3>";
        } else {
            print "<h3>The User Name \"$username\" has already been taken.</h3>";
        }
        mysql_free_result($query1);
    }
}
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>
