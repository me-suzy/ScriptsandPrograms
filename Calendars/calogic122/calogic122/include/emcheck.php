<?php
#print $GLOBALS["htmldoctype"];
?>
<html>
<head>
<meta HTTP-EQUIV="Expires" CONTENT="0">
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Email Syntax check</title>
<script id="clientEventHandlersJS" language="javascript">
<!--

function okay_onclick() {

    window.returnValue = emok.value;
    window.close();

}

//-->
</script>
</head>
<?php
print "<body ".stripslashes($_GET["sysbodystyle"])." >";
print "<center>";
print "<br>";
print "Email: ".$_GET["email"]."<br>";

    if (eregi("^([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[@]([0-9,a-z]+)([.,_,-]([0-9,a-z]+))*[.]([0-9,a-z]){2,4}$",$_GET["email"])) {
        print "Sytax is valid";
        print "<input type=\"hidden\" value = \"1\" id=\"emok\" name=\"emok\">";
    } else {
        print "Sytax is not valid";
        print "<input type=\"hidden\" value = \"0\" id=\"emok\" name=\"emok\">";
    }

#print "url: ".urldecode($_GET["sysbodystyle"])."<br>";
#print "norm: ".($_GET["sysbodystyle"])."<br>";
#print "strip: ".stripslashes($_GET["sysbodystyle"])."<br>";

?>
<br><br>
<input language="javascript" onclick="okay_onclick()" type="button" value = "Okay" id="okay" name="okay">
</center>
</body>
</html>
