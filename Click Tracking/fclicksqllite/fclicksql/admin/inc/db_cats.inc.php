<?php
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");

function add_cat() {
  global $DB, $PREFIX, $IN;

  $sth = $DB->query("SELECT * FROM ".$PREFIX."category WHERE Cat = '".$IN['add_id']."'");
  if(!$sth) die('Database Error (add_cat check): '.$DB->error());
  if($sth->rows()) {
    $IN['error_m'] = "Category ID ".$IN['add_id']." alredy exists";
   }
  else {
    $cat['Cat'] = $IN['add_id'];
    $cat['Name'] = htmlspecialchars(stripslashes($IN['add_name']));

    $IN['add_id'] = "";
    $IN['add_name'] = "";

    if(!$DB->insert($PREFIX."category", $cat))
      die('Database Error (add_cat): '.$DB->error());
   }
 }

function ch_id() {
  global $DB, $PREFIX, $IN;

  $sth = $DB->query("SELECT * FROM ".$PREFIX."category WHERE Cat = '".$IN['newi']."'");
  if(!$sth) die('Database Error (ch_id Check): '.$DB->error());
  if($sth->rows()) {
    $IN['error_m'] = "Category ID ".$IN['newi']." alredy exists";
   }
  else {
    if(!$DB->update($PREFIX."category", array('Cat' => $IN['newi']), array('CID' => $IN[id])))
      die('Database Error (ch_id): '.$DB->error());
   }
 }

function ch_name() {
  global $DB, $PREFIX, $IN;

  if(!$DB->update($PREFIX."category", array('Name' => htmlspecialchars(stripslashes($IN['newi']))), array('CID' => $IN[id])))
    die('Database Error (ch_name): '.$DB->error());
 }

function delete() {
  global $DB, $PREFIX, $IN;

  if(!$DB->query_cl("DELETE FROM ".$PREFIX."category WHERE CID = '".$IN[id]."'"))
    die('Database Error (delete): '.$DB->error());

  if(!$DB->query_cl("DELETE FROM ".$PREFIX."stats WHERE CID = '".$IN[id]."'"))
    die('Database Error (delete2): '.$DB->error());

  if(!$DB->query_cl("DELETE FROM ".$PREFIX."links WHERE CID = '".$IN[id]."'"))
    die('Database Error (delete3): '.$DB->error());
 }

if(isset($IN[op])) {
  $IN[op]();
 }

// Common Count

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links WHERE CID = 1");
if(!$sth) die('Database Error (Common Count): '.$DB->error());
$row = $sth->fetchrow_array();
$common_cnt = $row[1]+0;
$common_lnk = $row[0];

if(!isset($IN['add_id'])) $IN['add_id'] = "";
if(isset($IN['add_name'])) $IN['add_name'] = htmlspecialchars(stripslashes($IN['add_name']));
else $IN['add_name'] = "";

// Prepare for page numbering
$sp     = $IN['sp'] ? $IN['sp'] : 1;
$mh     = $IN['mh'] ? $IN['mh'] : 20;
$offset = ($sp-1) * $mh;

$sth = $DB->query("SELECT Count(*) FROM ".$PREFIX."category");
if(!$sth) die('Database Error (total cats): '.$DB->error());
$total = $sth->fetchrow_one();

$sth = $DB->query("SELECT Count(*), SUM(Count) FROM ".$PREFIX."links");
if(!$sth) die('Database Error (total links): '.$DB->error());
$row = $sth->fetchrow_array();
$total_links = $row[0];
$totalcl = $row[1]+0;

$page_num = _page_toolbar($sp, $total, $mh, "admin.php?page=db_cats");

// Get Count and Num of links
$sth = $DB->query("SELECT CID, Count(*), SUM(Count) FROM ".$PREFIX."links GROUP BY CID ORDER BY CID");
if(!$sth) die('Database Error (get num of links): '.$DB->error());
while($row = $sth->fetchrow_array()) {
  $cats[$row[0]][0] = $row[1];
  $cats[$row[0]][1] = $row[2];
 }
//$cats = $sth->fetchall_array();

$sth = $DB->query("SELECT * FROM ".$PREFIX."category ORDER BY Cat LIMIT ".$offset.",".$mh);
if(!$sth) die('Database Error (Cats): '.$DB->error());

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
     window.location.href = "admin.php?page=db_cats&op=ch_id&id="+entry+"&newi="+new_name
    }
   else if(feature == "Name") {
     window.location.href = "admin.php?page=db_cats&op=ch_name&id="+entry+"&newi="+new_name
    }
  }
}
function del_entry(entry) {
 if (window.confirm("Do you really want to delete this entry: "+entry+"\nand all links that it contains???")) {
    window.location.href = "admin.php?page=db_cats&op=delete&id="+entry
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
// -->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" style="margin-top: 5px;">
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
   <TABLE bgcolor="#000000" cellpadding=0 cellspacing=1 border=0 width="100%" align="center">
    <TR>
     <TD>
       <TABLE bgcolor="#FFFFFF" cellpadding=2 cellspacing=1 border=0 width="100%" class=text>
        <TR><TD bgcolor="#a5bcc0" align=center colspan=5>List of Categories</TD></TR>
        <TR>
         <TD bgcolor="#c5dce0" align=center><B>ID</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Name</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Links</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Clicks</B></TD>
         <TD bgcolor="#c5dce0" align=center><B>Actions</B></TD>
        </TR>
<? if($sp == 1) { ?>
        <TR>
         <TD bgcolor="#e9e9e9" align=center>0</TD>
         <TD bgcolor="#e9e9e9" align=center>Common</TD>
         <TD bgcolor="#e9e9e9" align=center><?=$common_lnk?></TD>
         <TD bgcolor="#e9e9e9" align=center><?=$common_cnt?></TD>
         <TD bgcolor="#e9e9e9" align=center>-</TD>
        </TR>
<?php
  } 
while($row = $sth->fetchrow_array()) {
  if($row[0] <> '1') {
    echo "        <TR>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center><a class=\"opt\" href=\"javascript:ChangeEntry('".$row[0]."', '".$row[1]."', 'ID')\" style=\"color:#000000;font-size:11px;\">".$row[1]."</a></TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center><a class=\"opt\" href=\"javascript:ChangeEntry('".$row[0]."', '".$row[2]."', 'Name')\" style=\"color:#000000;font-size:11px;\">".$row[2]."</a></TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".(int)$cats[$row[0]][0]."</TD>\n";
    echo "         <TD bgcolor=\"#e9e9e9\" align=center>".(int)$cats[$row[0]][1]."</TD>\n"; 
    echo "         <TD bgcolor=\"#e9e9e9\" align=center><a class=\"opt\" href=\"javascript:del_entry('".$row[0]."');\" style=\"color:#000000;font-size:11px;\">delete</a></TD>\n";
    echo "        </TR>\n";
   }
 }
?>
        <TR><TD bgcolor="#c5dce0" colspan=5 align=center>
          <b>Total categories: <font color="#556c70"><?=$total?></font></b> |
          <b>Total links: <font color="#556c70"><?=$total_links?></font></b> |
          <b>Total clicks: <font color="#556c70"><?=$totalcl?></font></b>
        </TD></TR>
       </TABLE>
     </TD>
    </TR>
   </TABLE>
   <table width="100%" border=0>
   <tr><td align=right class="text">Pages: <?=$page_num?></td></tr>
   </table>
<table align="center" border=0 class=text cellpadding=1 cellspacing=1>
 <form action="admin.php" method=post name=form>
<?php
 if(isset($IN['error_m'])) {
?>
  <tr>
   <td align=center colspan=2>
    <font color="#ff0000"><b><?=Error?>: <?=$IN['error_m']?></b></font><br><br>
   </td>
  </tr>
<?php } ?>
 <tr>
  <td align="center" colspan=2 bgcolor="#a5bcc0">
   <font style="letter-spacing : 3px;">Add Category:</font>
  </td>
 </tr>
 <tr>
  <td align="right" bgcolor="#e9e9e9">ID: </td>
  <td bgcolor="#e9e9e9"><input type=text name="add_id" value="<?=$IN['add_id']?>" class=field style="width: 150pt;"></td>
 </tr>
 <tr>
  <td align="right" bgcolor="#e9e9e9">Name: </td>
  <td bgcolor="#e9e9e9"><input type="text" name="add_name" value="<?=$IN['add_name']?>" class=field style="width: 150pt;"></td>
 </tr>
 <tr>
  <td align="right" colspan=2 bgcolor="#e9e9e9">
   <input type="hidden" name="page" value="db_cats">
   <input type="hidden" name="op" value="add_cat">
   <input type="hidden" name="sp" value="<?=$sp?>">
   <input type="hidden" name="mh" value="<?=$mh?>">
   <input type="submit" value="Add Category" class=button style="width: 150pt;" onclick="return check_form();">
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
