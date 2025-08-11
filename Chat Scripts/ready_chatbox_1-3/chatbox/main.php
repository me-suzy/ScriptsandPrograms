<?php
include ('settings.php');

function output_message ( $name, $timestamp, $message, $link ) {

print "  <tr>\n";
print '<td class="name">';
if ( !empty($link) ){
	$output_name='<a class="link_name" target="_blank" href="'.$link.'">'.$name.'</a>';
}else{
	$output_name='<span class="name_unlink">'.$name.'</span>';
}
print "$output_name";
print "</td></tr>\n\n";
print "<tr>";
print '<td class="message">';
print "$message";
print "</td></tr>\n\n";
}



print '<table width="'.$TableWidth.'"  border="0" cellspacing="0" cellpadding="0">';

$query .= "SELECT * FROM chatbox";
//$query .= " WHERE timestamp < '$TimeLimit'";
$query .= " limit $CountLimit";
$res=mysql_query($query);
if(mysql_num_rows($res)){
	while($obj=mysql_fetch_object($res)){
		$id=$obj->id;
		$name=$obj->name;
		$timestamp=$obj->timestamp;
		$message=$obj->message;
		$link=$obj->link;
		$ip=$obj->ip;
		$date=date("F d, Y", $timestamp);
		output_message( $name, $timestamp, $message, $link );
}
}else{
$error="yes"; $log="No comments posted yet.<BR>\n";
}

print "</table> \n";

