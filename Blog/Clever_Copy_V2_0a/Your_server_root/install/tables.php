<html><head><title>Clever Copy Install Wizard</title>
<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php
$siteaddy = $_POST['sitepath'];
global  $error_msg;
include "languages/default.php";
if (is_file( "../admin/connect.inc" ))
{
   include "../admin/connect.inc";
}else{
   echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
   echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
   echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
   echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status4.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
   echo "<font color = '#000000'>$file_not_found<br>";
   echo "<br><img src = 'notok.gif'> $status_notok<br>";
   echo "<td bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>$no_confile_label<br><br>";
   echo "<tr><td colspan = '2' valign = 'bottom'><form action='check.php' method='post'><br><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   exit;
}
$file = "clevercopy.tbl";
$status = '0';
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status4.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
if (!is_file("clevercopy.tbl"))
{
  echo "<font color = '#000000'>$file_not_found<br>";
  echo "<br><img src = 'notok.gif'> $status_notok<br>";
  echo "<td bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>$no_file_label<br><br>";
  echo "<tr><td colspan = '2' valign = 'bottom'><form action='check.php' method='post'><br><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
  $status = '1';
}else{
    if (file_exists($file))
    {
        $fp = file($file);
        $i = count($fp);
        for ($i = 0; $i < count($fp); $i++) {
            $query = $fp[$i];
            if (strlen(trim($query)))
            {
              mysql_query($query);
              $sqlerno = '0';
              $sqlerno = mysql_errno();
              $error_msg = mysql_error();
              if ($sqlerno !== 0)
              {
                 if ($sqlerno == '1051')
                 {
                    @mysql_free_result($sqlerno);
                 }else{
                    $status = '1';
                    echo "<br>$error_is <font color = '#000000'>$sql_num_error <b>$sqlerno</b> - $sql_error <b>$error_msg<br><br>$this_means<br><br></font></b>";
                    echo "<br><img src = 'notok.gif'> $status_notok";
                    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$problem_found";
                    echo "<tr><td colspan = '2' valign = 'bottom'><form action='check.php' method='post'><br><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
                    exit;
                 }
              }
            }
        }
        echo "<br><img src = 'ok.gif'> $status_ok";
        echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$install_success";
        echo "<tr><td valign = 'bottom'><form action='check.php' method='post'>";
        echo "<input type='submit' name='submit' value='$back' class = 'buttons'></form>";
        echo "<td valign = 'bottom'><br><form action='setadmin.php' method='post'>";
        echo "<input type='hidden' name='siteaddy'  value ='$siteaddy'>";
        echo "<input type='submit' name='submit' value='$next' class = 'buttons'></form>";
    }else{
        echo "<br><img src = 'notok.gif'> $status_notok";
        echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = 'white'>$corrupted_error";
        echo "<tr><td colspan = '2' valign = 'bottom'><form action='check.php' method='post'><br><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    }
}
?>