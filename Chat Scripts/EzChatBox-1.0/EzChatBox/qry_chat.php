<form name="inpform" action="<?php echo $EZChat_location; ?>/qry_message.php" method="post">

<table width="98%">

  <tr>
    <td class="style4">Name :</td>
    <td><input name="name" type="text" value="<?php echo $_COOKIE['name_chat'] ?>" size="10" />
    </td>
  </tr>

  <tr>
    <td colspan="2" valign="top" class="style4">Message :</td>
    </tr>
  <tr>
    <td colspan="2" valign="top"><textarea name="message" cols="20" rows="4"></textarea></td>
  </tr>
  <tr align="center">
  	<td colspan="2" valign="top"><a onClick="openwindow('<?php echo $EZChat_location; ?>/dsp_smiley.php','smilies','scrollbars=yes,width=150,height=300')" href="javascript:void(0);"><font class="ez_name">Smilies</font></a></td>
  </tr>
  <tr align="center" valign="top">
    <td colspan="2"><input name="loc" type="hidden" value="<?php echo $EZChat_location; ?>">
    <input type="submit" value="Send" />
    </td>
    </tr>

</table>
</form> 