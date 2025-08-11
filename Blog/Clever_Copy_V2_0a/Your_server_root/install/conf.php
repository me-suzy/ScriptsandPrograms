<link rel="stylesheet" href="../personalities/cc.css" type="text/css"></head>
<?php;
$status = '0';
include "languages/default.php";
include "antihack.php";
echo "<center><table border='0' cellspacing='0' width='70%' style='border-collapse: collapse; border: 1px solid #008080'>";
echo "<tr bgcolor='#F4F2F2'><td colspan='2'><left>";
echo "<b><br>$install_wizard</b><br><br></font></b></center></td></tr>";
echo "<td width='6%' bgcolor='#008080'><img src = 'wizard.jpg'><br><br><img src = 'status3.jpg'><br><br><br><font color = '#FFFFFF'>$error_status<br><br>";
$user=antihax($_POST["user"]);
$sitepath=$_POST["siteaddy"];
$host = antihax($_POST["host"]);
$dbase = antihax($_POST["dbase"]);
$pass=antihax($_POST["pass"]);
$pass2=antihax($_POST["pass2"]);
$status = '0';
if ($pass !== $pass2)
{
   echo "<font color = '#000000'>$pass_no_match<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $check_your_dpasswords;
   echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   $status = '1';
   exit;
}
if (($pass == "") || ($pass2 == ""))
{
   echo "<font color = '#000000'>$post_data_missing<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $missing_pass_data;
   echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   $status = '1';
   exit;
}
if ($user == "")
{
   echo "<font color = '#000000'>$post_data_missing<br>";
   echo "<br><img src = 'notok.gif'> $status_notok";
   echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
   echo $missing_duser_data;
   echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
   $status = '1';
   exit;
}
if ($host == "")
{
    echo "<font color = '#000000'>$post_data_missing<br>";
    echo "<br><img src = 'notok.gif'> $status_notok";
    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
    echo $missing_host_data;
    echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    $status = '1';
    exit;
}
if ($dbase == "")
{
    echo "<font color = '#000000'>$post_data_missing<br>";
    echo "<br><img src = 'notok.gif'> $status_notok";
    echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
    echo $missing_dbase_data;
    echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
    $status = '1';
    exit;
}
if ($status == "0")
{
$file = @fopen( "../admin/connect.inc", "w" );
   if(!$file)
   {
      echo "<br><img src = 'notok.gif'> $status_notok<br>";
      echo "<br>File - admin/connect.inc<br> $cant_write";
      echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
      echo "$nopermissions_dbase_data<br><br>";
   }else{
      @fputs($file,
      "<?php\n\n" .
      "//ENTER THE SETTINGS FOR THE CONNECTION TO YOUR DATABASE BELOW\n" .
      "$" .
      "Host = \"$host\"; // The hostname for your server. localhost works for most database servers or you may have to contact your hosts if you don't know\n" .
      "$" .
      "Dbase = \"$dbase\"; // The name of your database on your database server\n" .
      "$" .
      "User = \"$user\";  // The username required to connect to your database\n" .
      "$" .
      "Pass = \"$pass\"; // The password required to connect to your database\n" .
      "// DO NOT EDIT PAST THIS LINE\n" .
      "$".
      "db = mysql_connect($" .
      "Host, " .
      "$" .
      "User, $" .
      "Pass) or die(\"<b><br><br>Clever Copy fatal error! <br>Unable to connect to the database<br>One or more of databse name, username, password or host are incorrect in the admin/connect.inc file<b>\");\n" .
      "if(!$" .
      "db)die(\"<b><br><br>Clever Copy fatal error! <br>No connection to database could be established  - There is a big problem. Site owner - contact your hosts!</b>\");\n" .
      "if(!mysql_select_db($" .
      "Dbase,$" .
      "db))die(\"<b><br><br>Clever Copy fatal error! <br>Cannot find your database on the database server - There is a big problem. Site owner - contact your hosts!</b>\");\n" .
      "?>" );
      @fclose($file);
      chmod("../admin/connect.inc", 0644);
      $file = @fopen( "../news/newsreader.php", "w" );
   if(!$file)
   {
      echo "<br><img src = 'notok.gif'> $status_notok<br>";
      echo "<br>File - news/newsreader.php<br> $cant_write";
      echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
      echo "$nopermissions_dbase_data<br><br>";
   }else{
      @fputs($file,
      "<?php\n" .
      "// Newsfeed reader - copyright (c) 2005 by Clever Copy - http://www.clevercopy.net \n" .
      "ini_set('max_execution_time', '0');\n" .
      "flush ();\n" .
      "$" .
      "getit = parse_url(\"$sitepath/news/syndicate.php\");\n" .
      "$" .
      "getit = " .
      "$" .
      "getit[host];\n" .
      "@" .
      "$" .
      "socket_handle = fsockopen(\"" .
      "$" .
      "getit\", 80, " .
      "$" .
      "error_nr, " .
      "$" .
      "error_txt,30);\n" .
      "@" .
      "$" .
      "readthis= fread(fopen(\"$sitepath/news/syndicate.php\", \"r\"), 100000);\n" .
      "if (" .
      "$" .
      "readthis){\n" .
      "$" .
      "begin= strpos(" .
      "$" .
      "readthis, \" \");\n" .
      "$" .
      "end= strpos(" .
      "$" .
      "readthis, \"-end-\");\n" .
      "$" .
      "value= " .
      "$" .
      "end-" .
      "$" .
      "begin; \n" .
      "$" .
      "content=substr(" .
      "$" .
      "readthis," .
      "$" .
      "begin," .
      "$" .
      "value);\n" .
      "echo \"<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>" .
      "$" .
      "content</marquee>\";\n" .
      "}else{\n" .
      "echo \"<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>There is a problem. I am unable to get the currently syndicated news feed</marquee>\";\n" .
      "}\n" .
      "?>" );
      @fclose($file);
      chmod("../news/newsreader.php", 0644);
      }
      $file = @fopen( "../news/syndicateinfo.html", "w" );
   if(!$file)
   {
      echo "<br><img src = 'notok.gif'> $status_notok<br>";
      echo "<br>File - news/newsreader.php<br> $cant_write";
      echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
      echo "$nopermissions_dbase_data<br><br>";
   }else{
      @fputs($file,
      "&lt;?php\n" .
      "// Newsfeed reader - copyright (c) 2005 by Clever Copy - http://www.clevercopy.net \n" .
      "ini_set('max_execution_time', '0');\n" .
      "flush ();\n" .
      "$" .
      "getit = parse_url(\"$sitepath/news/syndicate.php\");\n" .
      "$" .
      "getit = " .
      "$" .
      "getit[host];\n" .
      "@" .
      "$" .
      "socket_handle = fsockopen(\"" .
      "$" .
      "getit\", 80, " .
      "$" .
      "error_nr, " .
      "$" .
      "error_txt,30);\n" .
      "@" .
      "$" .
      "readthis= fread(fopen(\"$sitepath/news/syndicate.php\", \"r\"), 100000);\n" .
      "if (" .
      "$" .
      "readthis){\n" .
      "$" .
      "begin= strpos(" .
      "$" .
      "readthis, \" \");\n" .
      "$" .
      "end= strpos(" .
      "$" .
      "readthis, \"-end-\");\n" .
      "$" .
      "value= " .
      "$" .
      "end-" .
      "$" .
      "begin; \n" .
      "$" .
      "content=substr(" .
      "$" .
      "readthis," .
      "$" .
      "begin," .
      "$" .
      "value);\n" .
      "echo \"<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>" .
      "$" .
      "content</marquee>\";\n" .
      "}else{\n" .
      "echo \"<marquee direction= up onmouseover=this.stop() onmouseout=this.start()  scrollamount= 3 scrolldelay= '100'>There is a problem. I am unable to get the currently syndicated news feed</marquee>\";\n" .
      "}\n" .
      "?>" );
      @fclose($file);
      chmod("../news/syndicateinfo.html", 0644);
      }
      $file = @fopen( "../admin/updater.txt", "w" );
      if(!$file)
      {
          echo "<br><img src = 'notok.gif'> $status_notok<br>";
          echo "<br>File - admin/updater.txt<br> $cant_write";
          echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
          echo "$nopermissions_dbase_data<br><br>";
      }else{
          @fputs($file,
          "//This is the updater file\n");
          @fclose($file);
          chmod("../admin/updater.txt", 0777);
      }
      $file = @fopen( "../stats/script.js", "w" );
      if(!$file)
      {
          echo "<br><img src = 'notok.gif'> $status_notok<br>";
          echo "<br>File - stats/script.js<br> $cant_write";
          echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
          echo "$nopermissions_dbase_data<br><br>";
      }else{
          @fputs($file,
          "dr=this.document.referrer;\n" .
          "s=screen;\n" .
          "sw=s.width;\n" .
          "sh=s.height;\n" .
          "sd=s.colorDepth;\n" .
          "document.write(" .
          "\"<script type=" .
          '\"'.
          "text/javascript".
          '\"'.
          " src=" .
          '\"'.
          "$sitepath/stats/script.php?referrer=\"+escape(dr)+\"&javascript=true&screenheight=\"+sh+\"&screenwidth=\"+sw+\"&pixeldepth=\"+sd+" .
          '"' .
          '\"'.
          "></script>" .
          '"'.
          ");");
          @fclose($file);
          chmod("../stats/script.js", 0644);
      }
      $file = @fopen( "../admin/capturedata.txt", "w" );
      if(!$file)
      {
          echo "<br><img src = 'notok.gif'> $status_notok<br>";
          echo "<br>File - admin/capturedata.txt<br> $cant_write";
          echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
          echo "$nopermissions_dbase_data<br><br>";
      }else{
          @fputs($file,
          "//This is the data capture file. Simply delete the first entires if the file becomes too large\n");
          @fclose($file);
          chmod("../admin/capturedata.txt", 0777);
      }
      echo "$saved_sets<br>";
      echo "<br><img src = 'ok.gif'> $status_ok";
      echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
      echo "$settings_saved<br><br>";
      echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'><input type='submit' name='submit' value='$back' class = 'buttons'></form>";
      echo "<td valign = 'bottom'><br><form action='tables.php' method='post'><input type='hidden' name='sitepath'  value ='$sitepath'><input type='submit' name='submit' value='$next' class = 'buttons'></form>";
   }
}
if (!is_file("../admin/connect.inc"))
{
      echo "<br><img src = 'notok.gif'> $status_notok<br>";
      echo "<br>$cant_write";
      echo "<td width='94%' bgcolor='#008080' valign = 'top'><font color = '#FFFFFF'>";
      echo "$nowrite_dbase_data<br><br>";
      include "languages/connect.html";
      echo "<br><br>";
      echo "<tr><td valign = 'bottom'><br><form action='check.php' method='post'>";
      echo "<input type='submit' name='submit' value='$back' class = 'buttons'></form>";
      echo "<td valign = 'bottom'><br><form action='tables.php' method='post'>";
      echo "<input type='hidden' name='siteaddy'  value ='$sitepath'>";
      echo "<input type='submit' name='submit' value='$next' class = 'buttons'></form>";
}
?>