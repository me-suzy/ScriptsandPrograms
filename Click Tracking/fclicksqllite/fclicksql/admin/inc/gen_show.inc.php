<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

// List of categories

$category = "<option value=\"all\" selected>All\n";
$category .= "<option value=\"0\">Common\n";

$sth = $DB->query("SELECT Cat, Name FROM ".$PREFIX."category ORDER BY Name");
if(!$sth) die('Database Error (Category): '.$DB->error());
while ($row = $sth->fetchrow_array()) {
  if($row[0] <> '0') {
    $category .= "<option value=\"".$row[0]."\">".$row[1]."\n";
   }
 }

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Fast Click SQL</title>
  <base target="content">
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <link href="style.css" type="text/css" rel="stylesheet">
  <script language="JavaScript">
    function mMOver(ob) {
      ob.style.background='#c5dce0';
    }
    function mMOut(ob) {
      ob.style.background='#eaeaea';
    }
  </script>
<script language="Javascript">
<!--
function preview() {
 cid = form.cid.options[form.cid.selectedIndex].value;
 lid = form.lid.value;

 if(lid == "" && (form.elements[1]).checked) {
   alert("Please fill out link ID!");
   return false;
  }

 if((form.elements[5]).checked) 
   k = (form.elements[5]).value  
 else 
 if((form.elements[6]).checked) 
   k = (form.elements[6]).value  
 else 
 if((form.elements[7]).checked) 
   k = (form.elements[7]).value  
 else 
 if((form.elements[8]).checked) 
   k = (form.elements[8]).value  
 else 
 if((form.elements[9]).checked) 
   k = (form.elements[9]).value  
 else 
 if((form.elements[10]).checked) 
   k = form.period.value  

 period = k;
 if(isNaN(period) && period != "all") {
   alert("Error! Period must be integer or = \"all\"!");
   return false;
  }

 if((form.elements[3]).checked) 
   str = 'cid='+cid+'&period='+period;
 else str = 'id='+lid+'&period='+period;

 prWin = open("", "PreviewWin","width=450,height=300,status=0,toolbar=0,menubar=0");
 doc = prWin.document;
 doc.open();
 doc.write("<html>\n<head>\n <title>Count Generator</title>\n");
 doc.write(' <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">\n');
 doc.write(' <link href="<?=$CFG['SURL']?>/admin/style.css" type="text/css" rel="stylesheet">\n');
 doc.write('</head>\n<body>\n<table border=0 class=text width=400>\n<tr><td align=left>\n');
 doc.write('Your counter will be show:\n');
 doc.write('<script language="Javascript" src="<?=$CFG[SURL]?>/show.php?js=1&'+str+'"></script>\n');
 doc.write("</td></tr></table>\n</body></html>");
 doc.close();
 return false;
}
function generate() {
 cid = form.cid.options[form.cid.selectedIndex].value;
 lid = form.lid.value;

 if(lid == "" && (form.elements[1]).checked) {
   alert("Please fill out link ID!");
   return false;
  }

 if((form.elements[5]).checked) 
   k = (form.elements[5]).value  
 else 
 if((form.elements[6]).checked) 
   k = (form.elements[6]).value  
 else 
 if((form.elements[7]).checked) 
   k = (form.elements[7]).value  
 else 
 if((form.elements[8]).checked) 
   k = (form.elements[8]).value  
 else 
 if((form.elements[9]).checked) 
   k = (form.elements[9]).value  
 else 
 if((form.elements[10]).checked) 
   k = form.period.value  

 period = k;
 if(isNaN(period) && period != "all") {
   alert("Error! Period must be integer or = \"all\"!");
   return false;
  }

 if((form.elements[3]).checked) 
   str = 'cid='+cid+'&period='+period;
 else str = 'id='+lid+'&period='+period;

 prWin = open("", "PreviewWin2","width=450,height=300,status=0,toolbar=0,menubar=0");
 doc = prWin.document;
 doc.open();
 doc.write("<html>\n<head>\n <title>Count Generator</title>\n");
 doc.write(' <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">\n');
 doc.write(' <link href="style.css" type="text/css" rel="stylesheet">\n');
 doc.write('</head>\n<body>\n<table border=0 align=center class=text width=400>\n<tr><td align=left>\n');
 doc.write('This code you should insert in HTML file in that place where it is necessary to insert a value of counter.<br><br>\n');
 doc.write('JavaScript:<br>\n');
 doc.write('<textarea name="JS" cols="45" rows="4" wrap="ON" readonly>');
 doc.write('&lt;script language="Javascript"\n');
 doc.write('src="<?=$CFG['SURL']?>/show.php?js=1&'+str+'"&gt;\n&lt;/script&gt;');
 doc.write('</textarea>\n<br><br>\n');
 doc.write('SSI:<br>\n');
 doc.write('<textarea name="SSI" cols="45" rows="4" wrap="ON" readonly>');
 doc.write('&lt;!--#include virtual="<?=$CFG['SURL']?>/show.php?'+str+'"--&gt;');
 doc.write('</textarea>\n');
 doc.write("</td></tr></table>\n</body></html>");
 doc.close();
 return false;
}
// -->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
<form method="post" action="admin.php" name="form">
<input type="hidden" name="page" value="top_template">
<?php
if(isset($err_msg)) {?>
  <table width=460 align=center border=0 cellpadding=0 cellspacing=1>
  <tr><td align=center><span class="liter2"><?=$err_msg?></span></td></tr>
  </table>
<?php
}
?>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="460" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=2>Count Generator</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" width="100" rowspan=2><b>Type</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <table border=0 class="text" cellpadding=0>
            <tr><td width="20"><input type="radio" name="type" checked></td>
            <td width="100"><b>For link:</b></td>
            <td><input type="text" class="field" name="lid" style="width:150" onFocus="form.elements[1].checked=true;"></td>
           </tr>
           <tr><td colspan=3>
           <font size="1">Enter link ID for which the counter
           will be shown.</font></td></tr></table>
         </td>
        </TR>
        <TR>
         <td bgcolor="#eaeaea" valign="top">
           <table border=0 class="text" cellpadding=0>
            <tr><td width="20"><input type="radio" name="type"></td>
            <td width="100"><b>For category:</b></td>
            <td>
             <select name="cid" class="field" style="width:150" onFocus="form.elements[3].checked=true;">
             <?=$category?>
             </select>
            </td>
           </tr>
           <tr><td colspan=3>
           <font size="1">Choose a category for which the counter
           will be shown.</font></td></tr></table>
         </td>
        </TR>
        <TR>
         <TD bgcolor="#c5dce0" width="100"><b>Period</b></td>
         <td bgcolor="#eaeaea" valign="top">
           <input type="radio" name="per" value="all" checked>- for all time<br>
           <input type="radio" name="per" value="0">- for today<br>
           <input type="radio" name="per" value="1">- for today and yesterday<br>
           <input type="radio" name="per" value="7">- for last 7 days<br>
           <input type="radio" name="per" value="30">- for last 30 days<br>
           <input type="radio" name="per">- other:
           <input type="text" name="period" size="20" class="field" value="all" onFocus="form.elements[10].checked=true;"><br><br>
                                            
           <font size="1">Period of statistic. For how much days the 
           counter will be shown.</font>
         </td>
        </TR>
        <TR height=40><TD colspan=2 align=center bgcolor="#dadada">
<!--          <input type="submit" value="Preview" class="button" onclick="preview(); return false;">&nbsp;&nbsp;-->
          <input type="submit" value="Generate" class="button" onclick="generate(); return false;"><br>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>

  <table width=460 align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</form>
</body>
</html>