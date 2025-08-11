<? include("top.php"); ?>
<? include("topinstallmenu1.php"); ?>
<script language="javascript">

function numbers(){

    if ((window.event.keyCode>47)&&(window.event.keyCode<58))
    {}
    else{
    window.event.keyCode=0;
    }
}

</script>
<form name = "f0" action="installroutine.php" method="post">
<h2>&nbsp;Database Setup</font></h2>
<table border="0" cellpadding="3">
<tr>
    <td width="10">
        &nbsp;
    </td>
    <td>
<table class="global" align="left" width="400" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td bgcolor="#C6D7EC"><strong>Database Server :</strong></td>
     <td><input name="dbservername" type="text"></td>
  </tr>
  <tr>
    <td bgcolor="#C6D7EC">Database User Name :</td>
    <td><input name="dbusername" type="text"></td>
  </tr>
  <tr>
     <td bgcolor="#C6D7EC">Database Password :</td>
     <td><input name="dbpassword" type="text"></td>
   </tr>
   <tr>
     <td bgcolor="#C6D7EC"><strong>Database Name :</strong></td>
      <td><input name="dbname" type="text"></td>
   </tr>
   <tr>
     <td bgcolor="#C6D7EC">Optional Name :</td>
      <td><input name="dbopname" type="textbox"></td>
   </tr>
   <tr>
     <td bgcolor="#C6D7EC">Soft Update :</td>
      <td><input name="softup" type="checkbox" value="Y"></td>
    </tr>
   <tr>
      <td bgcolor="#C6D7EC">Force Create :</td>
      <td><input name="force" type="checkbox" value="Y"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
     <td>&nbsp;</td>
    </tr>
    <tr>
    &nbsp;&nbsp;<td align="Right"><input class="buttonclass" name="" type="submit" value="Submit"></td>
  </tr>
</table>
<iframe src="listdb.php" width="220" height="150" frameborder="no" ></iframe>
   </td>
</tr>
</table>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
OPTIONAL NAME : In order to allow the same application to be installed multiple times on one database name.<br>
&nbsp;&nbsp;&nbsp;&nbsp;
Optional Name it is special character if it is NOT EMPTY then appened it with the two DIGIT NUMBER<br>
&nbsp;&nbsp;&nbsp;&nbsp;
entered, to the TABLE NAME.
<br><br>

&nbsp;&nbsp;&nbsp;&nbsp;
If you enable SOFT UPDATE , only the database references  will be updated.
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;
If you enable FORCE CREATE , all the existing tables (required ones) inside the database will be removed <br>
&nbsp;&nbsp;&nbsp;&nbsp;
and Re-Created.( This will not work when SOFT UPDATE is enabled )</center></td></tr></table>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;
<font color="red">In all cases, EXISTING DATABASE WILL NOT BE REMOVED !</font>
<br>
</form>
</body>
</html>
<? include("base.php"); ?>