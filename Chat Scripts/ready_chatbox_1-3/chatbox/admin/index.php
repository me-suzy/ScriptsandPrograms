<?php include('inc_sessioncheck.php');
include('inc_template.php'); 
template_header();
?>



<b>Welcome to the Ready chatbox Administration panel.</b><br />

To include your chatbox on your PHP page, you should use the following code:<br />

<?php
$path_here=getcwd();
$path_there = str_replace( "demo/admin", "chatbox.php", "$path_here");
print "<textarea name=\"textarea\" cols=\"80\" rows=\"3\" style=\"font-family: Courier New, Courier, mono;font-size: 10px;color: #333333;\">";
print "<?php \n";
print "inclue('$path_there') \n";
print "?> \n";
print "</textarea>";
?>

<?php
template_footer();
?>
