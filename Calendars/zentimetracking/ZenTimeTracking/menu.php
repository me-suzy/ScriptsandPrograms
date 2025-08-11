<?
print('<html><head><title>- - - Zen Time Tracking - - -</title>');
echo('<link rel="stylesheet" type="text/css" href="incl/style.css">');
echo('<body bgcolor="#BABABA" topmargin=0 leftmargin=0>');
print('<table border="0" cellspacing="0" width="100%" bgcolor="#9999CC">');
print('<tr><td align="center"  height="8%" valign="middle"><font face="Arial" color="#FFFFFF"><h3>Zen Time Tracking</h3></font></td></tr>');
print('</table>');
echo('<table bgcolor="#9999CC" width=100% cellspacing=1 >');
echo('<tr>');
echo('</tr>');
session_start();
if(session_is_registered("whossession"))
{
    
    if ($_SESSION['who']=="manager")
    {
    
        echo('<tr>');
        echo('<td align=left><a href="main.php">Home</a></td>');
        echo('<td align=left><font color=white>|</font></td>');
        echo('<td align=left><a href="select.php">Register Manager/User</a></td>');
        echo('<td align=left><font color=white>|</font></td>');
        echo('<td align=left><a href="creategroup.php">Create Group</a></td>');
        echo('<td align=left><font color=white>|</font></td>');
        echo('<td align=left><a href="assigngroup.php">Assign Group</a></td>');
        echo('<td align=left><font color=white>|</font></td>');
        echo('<td align=left><a href="report.php">Report</a></td>');
        echo('<td align=left><font color=white>|</font></td>');
        echo('<td align=left><a href="logout.php">Log Off</a></td>');
        echo('</tr>');
        
    }

    elseif ($_SESSION['who']=="user")
    {
        
                
        echo('<tr>');
        echo('<td width=10% align=center><a href="user.php">Home</a></td>');
        echo('<td align=center><font color=white>|</font></td>');
        echo('<td width=10% align=center><a href="createcat.php">Create&nbsp;Category</td>');
        echo('<td align=center><font color=white>|</font></td>');
        echo('<td width=10% align=center><a href="assigntask.php">Report&nbsp;Task</a></td>');
        echo('<td width=10% align=center><font color=white>|</font></td>');
        echo('<td width=10% align=center><a href="logout.php">Log Off</a></td>');
         echo('<td width=10% align=center><font color=white>|</font></td>');
         echo('<td width=20% align=left>&nbsp;</td>');
        echo('</tr>');
    }   

}

else
{
    echo('<tr>');
    echo('<td width=5% align=left><a href="index.php">Home</a></td>');
    echo('<td width=5% align=left><font color=white>|</font></td>');
    echo('<td width=5% align=left><a href="userlogin.php">User</td>');
    echo('<td width=5% align=left><font color=white>|</font></td>');
    echo('<td width=5% align=left><a href="managerlogin.php">Manager</a></td>');
    echo('<td width=5% align=left><font color=white>|</font></td>');
    echo('<td width=5% align=left><a href="register.php">Register&nbsp;User</a></td>');
    echo('<td width=10% align=left><font color=white>|</font></td>');
    echo('<td width=60% align=left>&nbsp;</td>');
    echo('</tr>');
}
echo('</table>');
?>