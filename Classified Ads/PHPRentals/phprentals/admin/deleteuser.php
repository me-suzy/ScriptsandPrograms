<?
include("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php"); 
?>
<html>
<head>
	<title>Delete User</title>
</head>
<body>
<h3>Delete User</h3>
<form method=post action="deleteuconfirm.php">
<table border=0 cellpadding=0 cellspacing=5>

    <tr>
        <td align=left>
            <p>Username</p>
        </td>
        <td>
            <input name="user" type=text maxlength=100 size=25> &nbsp;<input type=submit value="Submit">
                    </td>
    </tr>
</table>
</form>
</body>
</html>