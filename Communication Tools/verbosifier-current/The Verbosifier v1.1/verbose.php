<?
# Verbosifier v1.1: http://www.desiquintans.com/verbosifier
# The Verbosifier is free under version 2 or later of the GPL.
# This program is distributed with cursory support, but without
# warranty or guarantee of any sort.

require ('admin/control.php');

// This puts remembered user details into the form if they're available.
if(isset($_COOKIE['shouter_name'])) $name =& $_COOKIE['shouter_name'];
    // This is the default value of the Name field. You can change this or make it a blank string ('').
    else $name = 'Name';
if(isset($_COOKIE['shouter_url'])) $url =& $_COOKIE['shouter_url'];
    // This is the default value of the Name field. You can change this or make it a blank string ('').
    else $url = 'http://';

$form = '
    <form action="'.$_SERVER['PHP_SELF'].'" method="POST">
    <input type="text" size="30" name="name" value="'.$name.'" /><br />
    <input type="text" size="30" name="url" value="'.$url.'" /><br />
    <textarea cols="26" rows="4" name="shout">Comment</textarea>
    <br /><br />
    <input type="submit" name="submitshout" value="Say this" />
    </form>
    ';

// If a new shout is submitted:
if($_POST['submitshout']) {
    // This regex looks for URL-like strings and converts them to links.
    $shout = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\">\\0</a>", $_POST['shout']);
    ## This block of regex uses the blacklist to detect spam shouts. If you have an installation of Writer's Block
    ## (www.desiquintans.com/writersblock) you can point file_get_contents to the address of WB's spamguard.txt instead.
    $blacklist = preg_replace('/(##).+(##)/', '', file_get_contents('admin/spamguard.txt'));
    $blacklist = trim($blacklist);
    $BlockedUrls = preg_replace('/\s+/', '|', $blacklist);
    $bad_url = eregi($BlockedUrls, $_POST['url']);
    $bad_body = eregi("<a(.+)($BlockedUrls)(.+)>", $shout);
    if($bad_url or $bad_body) {
        // If a spam string occured, do not allow the shout to be inserted.
        die('No spam, thanks.');
    }

    // Make input ready for insertion by trimming whitespace and stripping HTML/PHP:
    $name_in = strip_tags(trim($_POST['name']));
    $url_in = strip_tags(trim($_POST['url']));
    $shout_in = strip_tags(trim($shout), '<a>');
    
    // If the name input is empty, rename the string.
    if(empty($name_in)) $name_in = ANONYMOUS;
    // If the URL input has seven characters or fewer, make it empty.
    if(strlen($url_in) <= 7) $url_in = '';
    // If the shout input is empty, do not allow the shout to be inserted.
    if(empty($shout_in) or (($name_in == 'Name' or $shout_in == 'Comment') and empty($url_in))) die('Cannot post an empty shout.');
    
    // If script is still running, add linebreaks to Shout text.
    $shout_in = nl2br($shout_in);
    
    // Put shouter's name and URL into a cookie.
    setcookie('shouter_name', $name_in, time()+60*60*24*60, '', '', 0);
    setcookie('shouter_url', $url_in, time()+60*60*24*60, '', '', 0);
    
    // Add new shout to the table:
    mysql_query("INSERT INTO ".VERBOSE_TBL." (VerID, Name, Url, Shout, Timestamp) VALUES (NULL, '$name_in', '$url_in',
        '$shout_in', '".time()."')") or die('Error during shout insertion: '.mysql_error());
    
    // Check if the user wants to truncate the table as new posts are made:
    if(SHOUTS_RETAINED == 'no') {
    // If so, retrieve the number of rows from the table:
        $gettotalrows = mysql_query("SELECT * FROM ".VERBOSE_TBL);
        if(mysql_num_rows($gettotalrows) > SHOUT_QTY) {
            // If there are more rows than the number of shouts displayed, retrieve the VerID of the oldest shout...
            $getoldest = mysql_query("SELECT MIN(VerID) FROM ".VERBOSE_TBL)
                or die('Error choosing the oldest shout to delete: '.mysql_error());
            $oldest = mysql_fetch_array($getoldest);
            // ...and delete it.
            mysql_query("DELETE FROM ".VERBOSE_TBL." WHERE VerID='".$oldest['MIN(VerID)']."'")
                or die('Error during shout deletion: '.mysql_error());
        }
        // If the total rows is less than or equal to the number displayed, do nothing.
    }
    // If the user wants to keep all shouts, do nothing.
}

// Retrieve as many of the newest shouts as needed for display:
$getdisplay = mysql_query("SELECT Name, Url, Shout, Timestamp FROM ".VERBOSE_TBL." ORDER BY Timestamp DESC LIMIT ".SHOUT_QTY)
    or die('Error selecting shouts to display: '.mysql_error());
$shouts = NULL;
// Put the entries into an array and display them all:
while($display = mysql_fetch_array($getdisplay)) {
    $datetime = date(SHOUT_DATE, $display['Timestamp']);
    if(!empty($display['Url'])) $displayname = '<a href="'.$display['Url'].'">'.$display['Name'].'</a>';
        else $displayname =& $display['Name'];

    $shout_template = array('{NAME}' => $displayname, '{DATE}' => $datetime, '{SHOUT}' => $display['Shout']);
    if ($shout_tpl = implode('', file('verb_template/shout.htm'))) {
        foreach($shout_template as $key => $value) {
            $shout_tpl = str_replace($key, $value, $shout_tpl);
        }
    $shouts .= $shout_tpl;
    }
}

// Now use the main.htm template to display everything.
$use_template = array('{SHOUT}' => $shouts, '{FORM}' => $form);
if ($mainfile = implode('', file('verb_template/main.htm'))) {
    foreach($use_template as $key => $value) {
        $mainfile=@str_replace($key,$value,$mainfile);
    }
echo $mainfile;
}
?>