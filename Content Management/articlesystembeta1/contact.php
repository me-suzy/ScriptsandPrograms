<?php
/**
 * The contact form has been removed for security reasons
 * It will return once I find a more secure way.
 * 
 * Removed in version: Beta 1
 * Removal Date: 26 October
 * 
 */

/*
if (isset($_POST['submit']))
{

	$title = $_POST['title'];
	$msg = $_POST['msg'];
	$email = $_POST['email'];

	$to      = $setting['owneremail'];

	$subject = htmlspecialchars($title);
	$subject = stripslashes($subject);
	$message = htmlspecialchars($msg);
	$message = stripslashes($message);

	if (!ereg("^[^@ ]+@[^@ ]+\.[^@ ]+$", $email))
	{
		die ("<p class='error'>The e-mail was not valid</p>");

	}

	mail($to, $subject, $message, "From $email");


}
?>
<p>The mailserver must be configured for this to work</p>
	<form action="index.php?func=contact" method="post">
<table cellspacing="3" cellpadding="4">
<tr><td><strong>Title</strong></td><td>
<input type="text" name="title" /></td></tr>
<tr><td><strong>Your Email</strong></td><td>
<input type="text" name="email" /></td></tr>
<tr><td><strong>Message</strong></td><td>
<textarea name="msg" rows="8" cols="30"></textarea></td></tr>
<tr><td colspan="2">
<input type='submit' name='submit' value='Send Message' />
</td></tr>
</table>
</form>
*/