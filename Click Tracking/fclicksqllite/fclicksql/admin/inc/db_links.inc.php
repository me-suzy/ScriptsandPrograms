<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

function add_link() {
  global $DB, $PREFIX, $IN, $CFG;

  $sth = $DB->query("SELECT * FROM ".$PREFIX."links WHERE Link = '".$IN['add_id']."'");
  if(!$sth) die('Database Error (add_link Check): '.$DB->error());
  if($sth->rows()) {
    $IN['error_m'] = "Link ID ".$IN['add_id']." alredy exists";
   }
  else {
    $link['Link'] = prstr($IN['add_id']);
    $link['CID'] = $IN['add_cat'];
    $link['Name'] = prstr($IN['add_name']);
    $link['URL'] = $IN['add_url'];
    $link['Started'] = $CFG['CTIME'];
    $link['Count'] = 0;

    $IN['add_id'] = "";
    $IN['add_name'] = "";
    $IN['add_url'] = "http://";
    
    if(!$DB->insert($PREFIX."links", $link))
      die('Database Error (add_link): '.$DB->error());
   }
  $IN['cat_id'] = $IN['add_cat'];
 }

function ch_id() {
  global $DB, $PREFIX, $IN;

  $sth = $DB->query("SELECT LID FROM ".$PREFIX."links WHERE Link = '".$IN['newi']."'");
  if(!$sth) die('Database Error (ch_id Check): '.$DB->error());
  if($sth->rows()) {
    $IN['error_m'] = "Link ID ".$IN['newi']." alredy exists";
   }
  else {
    if(!$DB->update($PREFIX."links", array('Link' => $IN['newi']), array('LID' => $IN['id'])))
      die('Database Error (ch_id): '.$DB->error());
   }
 }

function ch_count() {
  global $DB, $PREFIX, $IN;

  $IN['newi'] = intval($IN['newi']);
  if(!$DB->update($PREFIX."links", array('Count' => $IN['newi']), array('LID' => $IN['id'])))
    die('Database Error (ch_count): '.$DB->error());
 }

function ch_name() {
  global $DB, $PREFIX, $IN;

  if(!$DB->update($PREFIX."links", array('Name' => prstr($IN['newi'])), array('LID' => $IN['id'])))
    die('Database Error (ch_name): '.$DB->error());
 }

function ch_url() {
  global $DB, $PREFIX, $IN;

  if(!$DB->update($PREFIX."links", array('URL' => $IN['newi']), array('LID' => $IN['id'])))
    die('Database Error (ch_url): '.$DB->error());
 }

function ch_cat() {
  global $DB, $PREFIX, $IN;

  $sth = $DB->query("SELECT CID FROM ".$PREFIX."links WHERE LID = '".$IN['id']."'");
  if(!$sth) die('Database Error (ch_cat check): '.$DB->error());
  $row = $sth->fetchrow_one();

  if($row[0] == $IN['newi']) return;

  if(!$DB->update($PREFIX."links", array('CID' => $IN['newi']), array('LID' => $IN['id'])))
    die('Database Error (ch_cat1): '.$DB->error());

  if(!$DB->update($PREFIX."stats", array('CID' => $IN['newi']), array('LID' => $IN['id'])))
    die('Database Error (ch_cat2): '.$DB->error());
 }

function delete() {
  global $DB, $PREFIX, $IN;

  if(!$DB->query_cl("DELETE FROM ".$PREFIX."links WHERE LID = ".$IN['id']))
    die('Database Error (delete1): '.$DB->error());

  if(!$DB->query_cl("DELETE FROM ".$PREFIX."stats WHERE LID = ".$IN['id']))
    die('Database Error (delete2): '.$DB->error());
 }

if(isset($IN[op])) {
  $IN[op]();
 }

// List of categories

if(!isset($IN['add_id'])) $IN['add_id'] = "";
if(!isset($IN['add_name'])) $IN['add_name'] = "";
if(!isset($IN['add_url'])) $IN['add_url'] = "http://";

$cat_id = $IN['cat_id'] ? $IN['cat_id'] : 1;

$selected = ($cat_id==1) ? ' selected' : '';
$category = "<option value=\"1\"".$selected.">Common\n";
$category2 = " doc.write('<option value=\"1\"".$selected.">Common\\n";

$sth = $DB->query("SELECT CID, Name FROM ".$PREFIX."category ORDER BY Name");
if(!$sth) die('Database Error (Category): '.$DB->error());
while ($row = $sth->fetchrow_array()) {
  if($row[0] != 1) {
    $selected = ($cat_id == $row[0]) ? ' selected' : '';
    $category .= "<option value=".$row[0].$selected.">".$row[1]."\n";
    $category2 .= "<option value=".$row[0].$selected.">".$row[1]."\\\n";
   }
 }

$category2 .= "');\n";

// Total links

if((string)$cat_id == 'All') $query = "";
else $query = " WHERE CID = ".$cat_id;

// Prepare for page numbering
$sp     = $IN['sp'] ? $IN['sp'] : 1;
$mh     = $IN['mh'] ? $IN['mh'] : 20;
$offset = ($sp-1) * $mh;

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links ".$query);
if(!$sth) die('Database Error (Count): '.$DB->error());
$row = $sth->fetchrow_array();
$total = $row[0];
$totalcl = $row[1]+0;

$page_num = _page_toolbar($sp, $total, $mh, "admin.php?page=db_links&cat_id=".$cat_id);

// Query from table
$sth = $DB->query("SELECT * FROM ".$PREFIX."links ".$query." ORDER BY Name LIMIT ".$offset.",".$mh);
if(!$sth) die('Database Error (Links): '.$DB->error());

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
function check_char(strg) {
 var found = 0;
 for(char_pos=0; char_pos<strg.length; char_pos++) {
   if(strg.charAt(char_pos) == '"' || strg.charAt(char_pos) == "'") {
     found = 1;
     break;
    }
  }
 return (found == 1) ? false : true;
}
function set_value(entry, old_value) {
 var new_value = window.prompt("Change value for entry '"+entry+"' to:",old_value)
 var found = 0;
 if(new_value != "" && new_value != null) {
   for(char_pos=0; char_pos<new_value.length; char_pos++) {
     if(!(new_value.charAt(char_pos) >= '0' && new_value.charAt(char_pos) <= '9')) {
       found = 1;
      }
    }
   if (found == 1) {
     alert ("You entered an invalid value for "+entry+"!");
    }
   else if (new_value == old_value) {
     alert ("No changes were made!");
    }
   else {
     window.location.href = "admin.php?page=db_links&cat_id=<?=$cat_id?>&op=ch_count&id="+entry+"&newi="+new_value
    }
  }
}
function ChangeEntry(entry, old_name, feature) {
 var new_name = window.prompt("Enter "+feature+" for "+entry+":",old_name)
 var found = 1;
 if(new_name != "" && new_name != null) {
   if(check_char(new_name)) {
     found = 0;
    }
   if (found == 1) {
     alert ("Error! "+feature+" for "+entry+" contains unacceptable characters!");
    }
   else if(new_name == old_name) {
     alert ("No changes were made!");
    }
   else if(feature == "ID") {
     window.location.href = "admin.php?page=db_links&cat_id=<?=$cat_id?>&op=ch_id&id="+entry+"&newi="+new_name
    }
   else if(feature == "Name") {
     window.location.href = "admin.php?page=db_links&cat_id=<?=$cat_id?>&op=ch_name&id="+entry+"&newi="+escape(new_name)
    }
   else if(feature == "URL") {
     window.location.href = "admin.php?page=db_links&cat_id=<?=$cat_id?>&op=ch_url&id="+entry+"&newi="+escape(new_name)
    }
  }
}
function del_entry(entry) {
 if (window.confirm("Do you really want to delete this entry: "+entry)) {
    window.location.href = "admin.php?page=db_links&cat_id=<?=$cat_id?>&op=delete&id="+entry
 }
}
function clear_entry(entry) {
 if (window.confirm("Do you really want to delete statistic for this entry: "+entry)) {
    window.location.href = "admin.php?act=clear&fid="+entry
 }
}
function check_form() {
 var found = 1;
 name_field=document.form.add_name.value;
 id_field=document.form.add_id.value;
 if (name_field == "" || id_field == "") {
    alert("Please fill out all blanks");
    return false;
 }
 if (check_char(name_field) && check_char(id_field)) {
    found = 0;
 }
 if (found == 1) {
    alert("Error! Unacceptable characters found!");
    return false;
 }
}
function ch_group(entry) {
 chWin = open("", "ChangeWin",
         "width=250,height=140,status=0,toolbar=0,menubar=0");
 doc = chWin.document;
 doc.open();
 doc.write("<html>\n<head>\n <title>Choose category</title>\n");
 doc.write(' <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1">\n');
 doc.write(' <link href="style.css" type="text/css" rel="stylesheet">\n');
 doc.write('</head>\n');

 doc.write("<body bgcolor=\"#e9e9e9\">\n<table border=0 class=text width=\"100%\" align=center>\n");
 doc.write("<form name=form>\n<tr><td align=center>Choose new category for "+entry+"</td></tr>\n");
 doc.write('<tr><td align=center>\n<select name=new2 style="width: 150pt;">\n');
<?=$category2?>
 doc.write('</select>\n</td></tr>\n');
 doc.write('<tr><td align=center>\n<input type="submit" value="Move" class=button style="width: 150pt;"\n');
 doc.write(' onclick="self.opener.location.href=\'admin.php?page=db_links&cat_id=<?=$cat_id?>&op=ch_cat&id='+entry+'&newi=\'+ document.form.new2.options[document.form.new2.selectedIndex].value;self.close();"');
 doc.write(">\n</td></tr>\n");
 doc.write("</form>\n");
 doc.write("</table>\n</body></html>");
 doc.close();
}
// -->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
<FORM ACTION="admin.php" METHOD=post>
   <table width="100%" border=0>
   <tr><td align=left>
    <div class=text style="margin-bottom:2pt;">Category:
    <select name="cat_id" onChange="location.href='admin.php?page=db_links&cat_id='+this.options[this.selectedIndex].value;">
<?php
$selected = ($cat_id == 'All') ? ' selected' : '';
echo "<option value=\"All\"".$selected.">All\n";
echo $category;
?>
    </select></div>
   </td>
   <td align=right class="text">
Pages: <?=$page_num?>
   </td>
   </tr></table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=5>List of Links</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>ID</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Name</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>URL</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Clicks</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Actions</B></TD>
        </TR>
<?php
while($row = $sth->fetchrow_array()) {
  $lid = $row[0];
  echo "        <TR>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:ChangeEntry('".$row[0]."', '".$row[1]."', 'ID')\" class=\"opt\">".$row[1]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left>&nbsp;<a href=\"javascript:ChangeEntry('".$row[0]."', '".$row[3]."', 'Name')\" class=\"opt\">".$row[3]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=left>&nbsp;<a href=\"javascript:ChangeEntry('".$row[0]."', '".$row[4]."', 'URL')\" class=\"opt\">".$row[4]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:set_value('".$row[0]."', '".$row[6]."')\" class=\"opt\">".$row[6]."</a></TD>\n";
  echo "         <TD bgcolor=\"#e9e9e9\" align=center><a href=\"javascript:del_entry('".$row[0]."');\" class=\"opt\">delete</a>\n";
  echo "          : <a href=\"javascript:ch_group('".$row[0]."');\" class=\"opt\">category</a></TD>\n";
  echo "        </TR>\n";
 }
?>
        <TR><TD bgcolor="#c5dce0" colspan=5 align=center>
          <b>Total links: <font color="#556c70"><?=$total?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=$totalcl?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
</FORM>

<table align=center border=0 class=text cellpadding=1 cellspacing=1>
 <form action="admin.php" method=post name=form>
<?php
 if(isset($IN['error_m'])) {
?>
  <tr>
   <td align="center" colspan=2>
    <font color="#ff0000"><b>Error: <?=$IN['error_m']?></b></font><br><br>
   </td>
  </tr>
<?php } ?>
 <tr>
  <td align=center colspan=2 bgcolor="#a5bcc0">
   <font style="letter-spacing : 3px;">Add Link:</font>
  </td>
 </tr>
 <tr>
  <td align=right bgcolor="#e9e9e9">Category: </td>
  <td bgcolor="#e9e9e9">
    <select name="add_cat" style="width: 150pt;">
<?=$category?>
    </select>
  </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#e9e9e9">ID: </td>
  <td bgcolor="#e9e9e9"><input type="text" name="add_id" value="<?=$IN['add_id']?>" class=field style="width: 150pt;"></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#e9e9e9">Name: </td>
  <td bgcolor="#e9e9e9"><input type="text" name="add_name" value="<?=$IN['add_name']?>" class=field style="width: 150pt;"></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#e9e9e9">URL: </td>
  <td bgcolor="#e9e9e9"><input type="text" name="add_url" value="<?=$IN['add_url']?>" class="field" style="width: 150pt;"></td>
 </tr>
 <tr>
  <td align="right" colspan=2 bgcolor="#e9e9e9">
   <input type="hidden" name="page" value="db_links">
   <input type="hidden" name="cat_id" value="<?=$cat_id?>">
   <input type="hidden" name="op" value="add_link">
   <input type="hidden" name="sp" value="<?=$sp?>">
   <input type="hidden" name="mh" value="<?=$mh?>">
   <input type="submit" value="Add Link" class=button style="width: 150pt;" onclick="return check_form();">
  </td>
 </tr>
 </form>
  <table width=100% align=center border=0 cellpadding=0 cellspacing=1>
  <tr>
    <td><span class="liter2">Copyright &copy;2005 by FtrainSoft, Inc.</span></td>
    <td align=right><span class="liter2"><?=StopTiming();?> sec</span></td>
  </tr>
  </table>
</table>
</body>
</html>