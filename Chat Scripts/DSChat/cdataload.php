<?
include("chatconfig.php");
?>
<meta http-equiv="Refresh" content="<? echo $refresh; ?>">
<?
if (!file_exists("users/" . $_COOKIE['cookie_dschat'] . "")){
if ($hour == "23") {
echo "The server is currently resetting it's self. You've been automatically kicked.";
exit;
} else {
$no23 = "1";
}
if ($hour == "11") {
echo "The server is currently resetting it's self. You've been automatically kicked.";
exit;
} else {
echo "You've been kicked from the chat! Please rejoin. (Click Logout and log back in.)<br><br><font size=1>(Note: A probable reason for this is that the server has just reset it's self recently and you need to rejoin.)</font>";
exit;
}
}
?>

<body  bgcolor="<? echo $col1 ?>">
<IFRAME SRC="cdata.html" TITLE="dataload" frameborder=0 scrolling="auto" width="420" height="320">
<!-- Alternate content for non-supporting browsers -->
<h3>WARNING: <BR>
YOUR BROWSER DOES NOT SUPPORT IFRAMES,
<BR>
AND THEREFOR WILL NOT ALLOW DSCHAT TO FUNCTION CORRECTLY.<br><br>
TURN FRAMES ON TO VIEW DSCHAT CORRECTLY.
</IFRAME>
</body>

