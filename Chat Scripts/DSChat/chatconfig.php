<?
// Main configurations, MUST EDIT'S.
$name = "DSChat"; // This is the name of your chat room
$pass1 = "banana"; // This is your admin password
$pass2 = "bananas"; // This is the moderator password

// Skinning. Use these fields to change the colors
$col1 = "#DDDDDD"; // The primary color in the skin
$col2 = "#CCCCCC"; // The secondary color in the skin
$col3 = "#000000"; // The primary font color
$bg = "white"; // Background color for the login page

// Refresh and A-D variables, don't edit unless you're sure
$refresh = "1"; // How often, in seconds, you want to refresh
$ad = "14"; // The maximum number of lines before autodump

// DO NOT EDIT UNDER THIS LINE
$hour = date(H);
if ($hour == "23") {
$folder = "users";
if ($handle = opendir($folder)) {
    while (false !== ($file = readdir($handle))) { 
        if (is_file("$folder/$file")) { 
            $size = filesize("$folder/$file");
            unlink("$folder/$file");
        } 
    }
    closedir($handle); 
}
$blf = "cdata.html";
$ctext = "*Chat data and users auto-dumped*<br>\n";
$file = fopen($blf, 'w');
fwrite($file, $ctext);
fclose($file);
}
?>