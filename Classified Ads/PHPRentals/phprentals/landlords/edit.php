<?php include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$proptype = addslashes(strip_tags($_POST['rtype']));
$bedroom = addslashes(strip_tags($_POST['bed']));
$bathroom = addslashes(strip_tags($_POST['bath']));
$utilities = addslashes(strip_tags($_POST['utilities']));
$rent = addslashes(strip_tags($_POST['rent']));
$deposit = addslashes(strip_tags($_POST['deposit']));
$pets = addslashes(strip_tags($_POST['pets']));
$add = addslashes(strip_tags($_POST['add']));
$addtwo = addslashes(strip_tags($_POST['addtwo']));
$city = addslashes(strip_tags($_POST['city']));
$state = addslashes(strip_tags($_POST['state']));
$phone = addslashes(strip_tags($_POST['phone']));
$description = addslashes(strip_tags($_POST['descrip']));
$yard = addslashes(strip_tags($_POST['yard']));
$garage = addslashes(strip_tags($_POST['garage']));
$img1 = addslashes(strip_tags($_POST['img1']));
$img2 = addslashes(strip_tags($_POST['img2']));
$rid = addslashes(strip_tags($_POST['rid']));

if (!$rent || !$deposit || !$add || !$city || !$phone || !$description) {
    echo "Error!! You have not entered the following field(s).Hit back and try again<br>\n";

    $fields_to_validate = array('rent', 'deposit', 'add', 'city', 'phone', 'description');
    // validate above fields.
    $field_display_value = array('Rent', 'Deposit', 'Address', 'City', 'Telephone', 'Description');
    // if the field is not set then show the above display value.
    echo "<ul>\n";
	
    for($a = 0;$a < count($fields_to_validate);$a++) {
        // loop through fields and check whether that has been set or not.
        if (!${$fields_to_validate[$a]}) {

            echo "<li><font color=\"#FF0000\">$field_display_value[$a]</font>\n";
        } 
    } 
    echo "</ul>\n";
} else {


$_SESSION['uid'] = $uid; 
$_SESSION['pwd'] = $pwd;

//Also need to get into the listings table for the images

	$rst=mysql_query("SELECT * FROM users WHERE email='$uid' and passwd='$pwd'");
	if ($row = mysql_fetch_array($rst))
	{
	$llid=$row["llid"];

	$imgq=mysql_query("SELECT * FROM listings WHERE llid='$llid'");
	if ($row2=mysql_fetch_array($imgq))
		{
$delimg1=$row2["img1"];
$delimg2=$row2["img2"];
$listdate=$row2["listdate"];
$llid = $row2["llid"];

//if nothing uploaded we need to keep the current database images in place.

if (!$img1)
{
$img1 = $row2["img1"];
} 
if (!$img2)
{
$img2 = $row2["img2"];
}

// db insert
    $sql="UPDATE listings SET rtype='$proptype', addone='$add', addtwo='$addtwo', city='$city', state='$state', pets='$pets', descrip='$description', bed='$bedroom', bath='$bathroom', garage='$garage', yard='$yard', utilities='$utilities', rent='$rent', deposit='$deposit', img1='$img1', img2='$img2' WHERE llid = '$llid' AND rid='$rid'";

//echo "$sql";

$result5 = mysql_query($sql);

//image upload - if there is an uploaded file, the old file is deleted, then moves onto the upload

if (is_uploaded_file($HTTP_POST_FILES['img1']['tmp_name'])) {

	if (file_exists("$abpath/$delimg1"))
	{
unlink ("$abpath/$delimg1");
	}

if ($HTTP_POST_FILES['img1']['size']>$max_size) { echo "The file is too big<br>\n"; exit; }

$res = move_uploaded_file($HTTP_POST_FILES['img1']['tmp_name'], $path .
$HTTP_POST_FILES['img1']['name']);

chmod("$abpath/".$HTTP_POST_FILES['img1']['name']."", 0777);

if (!$res) { echo "upload failed!<br>\n"; exit; } else { echo "upload successful<br>\n"; }
$img1=$HTTP_POST_FILES['img1']['name'];
}

if (is_uploaded_file($HTTP_POST_FILES['img2']['tmp_name'])) {

if (file_exists("$abpath/$delimg2"))
	{
unlink ("$abpath/$delimg2");
	}

if ($HTTP_POST_FILES['img2']['size']>$max_size) { echo "The file is too big<br>\n"; exit; }


$res = move_uploaded_file($HTTP_POST_FILES['img2']['tmp_name'], $path .
$HTTP_POST_FILES['img2']['name']);

chmod("$abpath/".$HTTP_POST_FILES['img2']['name']."", 0777);

if (!$res) { echo "upload failed!<br>\n"; exit; } else { echo "upload successful<br>\n"; }
$img2=$HTTP_POST_FILES['img2']['name'];
}
	}
	if (!$llid) {
	echo "Database Error, if this persists please contact the site owner.";
	}
echo "Listing successfully edited. <a href=\"index.php\">Landlord index</a>";
}}
?>