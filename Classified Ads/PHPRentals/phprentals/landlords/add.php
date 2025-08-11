<?php include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$proptype = addslashes(strip_tags($_POST['rtype']));
$bedroom = addslashes(strip_tags($_POST['brooms']));
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
$imgone=$HTTP_POST_FILES['img1']['name'];
$imgtwo=$HTTP_POST_FILES['img2']['name'];

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

$date = date("Ymd");
$day = substr($date,6,2);
$month = substr($date,4,2);
$year = substr($date,0,4);
$tdate="$year-$month-$day";

	$rst=mysql_query("SELECT * FROM users WHERE email='$uid' and passwd='$pwd' ");
	if ($row = mysql_fetch_array($rst))
	{
	$llid=$row["llid"];

// db insert and redirection
    mysql_query ("INSERT INTO listings (llid, rtype, addone, addtwo, city, state, pets, descrip, bed, bath, garage, yard, utilities, rent, deposit, listdate, img1, img2) VALUES ('$llid', '$proptype', '$add', '$addtwo', '$city', '$state', '$pets', '$description', '$bedroom', '$bathroom', '$garage', '$yard', '$utilities', '$rent', '$deposit', '$tdate', '$imgone', '$imgtwo')");

if (is_uploaded_file($HTTP_POST_FILES['img1']['tmp_name'])) {

if ($HTTP_POST_FILES['img1']['size']>$max_size) { echo "The file is too big<br>\n"; exit; }

$res = move_uploaded_file($HTTP_POST_FILES['img1']['tmp_name'], $abpath .
$HTTP_POST_FILES['img1']['name']);

chmod("$abpath".$HTTP_POST_FILES['img1']['name']."", 0777);

if (!$res) { echo "upload failed!<br>\n"; exit; } else { echo "upload successful<br>\n"; }
$img1=$HTTP_POST_FILES['img1']['name'];
}

if (is_uploaded_file($HTTP_POST_FILES['img2']['tmp_name'])) {


if ($HTTP_POST_FILES['img2']['size']>$max_size) { echo "The file is too big<br>\n"; exit; }


$res = move_uploaded_file($HTTP_POST_FILES['img2']['tmp_name'], $abpath .
$HTTP_POST_FILES['img2']['name']);

chmod("$abpath".$HTTP_POST_FILES['img2']['name']."", 0777);

if (!$res) { echo "upload failed!<br>\n"; exit; } else { echo "upload successful<br>\n"; }
$img2=$HTTP_POST_FILES['img2']['name'];
}}
echo "Listing successfully added <a href=\"index.php\">Landlord Index</a>";
	}
?>