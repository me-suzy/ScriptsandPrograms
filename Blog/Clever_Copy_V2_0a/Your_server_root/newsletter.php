<center><form name="txtlist" action="newsletter/index.php" method="get">
<input type="text" name="email" value="<?php echo $your_newsletter_email_address_label; ?>" size="20" maxlength="100" onFocus="if (this.value=='<?php echo $your_newsletter_email_address_label; ?>') this.value=''" onBlur="if (this.value=='') this.value='<?php echo $your_newsletter_email_address_label; ?>'">
<input type="submit" name="sub" value="go"class = "buttons"><br>
<input class = "radio" type="radio" name="set" id="set_subscribe" value="subscribe" checked><label for="set_subscribe"><?php echo $subscribe_to_newsletter_label; ?></label>&nbsp;&nbsp;<input class = "radio" type="radio" name="set" value="unsubscribe" id="set_unsubscribe"><label for="set_unsubscribe"><?php echo $unsubscribe_to_newsletter_label; ?></label>
</form></center>

