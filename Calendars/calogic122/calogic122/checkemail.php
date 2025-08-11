<?php require_once("./include/config.php"); ?>
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<title>User Email Check</title>
</head>
<body <?php print $GLOBALS["sysbodystyle"]; ?>>
<center>
<?php
if(!isset($useremail)) {
    print "<h3>No E-Mail Address was given.</h3>";
} else {
#    print "$useremail<br>";
    $useremail = mqfix($useremail);
    #mqfix($useremail);
    if (!emailok($useremail)) {
        print "<h4>$useremail<br>is not a valid E-Mail Address.</h4>";
    } else {
        $sqlstr = "select email from ".$GLOBALS["tabpre"]."_user_reg where email = '".$useremail."'";
        $query1 = mysql_query($sqlstr) or die("Cannot query User Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        $qu_num = @mysql_num_rows($query1);
        if($qu_num < 1) {
            print "<h3>The E-Mail Address \"$useremail\" is not in use.</h3>";
        } else {
            print "<h3>The E-Mail Address \"$useremail\" has already been taken.</h3>";
        }
        mysql_free_result($query1);
    }
}
print "<br><br>";
include($GLOBALS["CLPath"]."/include/footer.php");
?>
