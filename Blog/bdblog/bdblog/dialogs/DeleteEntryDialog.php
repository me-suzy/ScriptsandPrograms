<?php
class DeleteEntryDialog
{
	var $info;
	var $referer;
		
	function DeleteEntryDialog( $info, $referer )
	{
		$this->info = $info;
		$this->referer = $referer;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
	?>
<form name="NewEntry" action="<?= $PHP_SELF ?>" method="post">
<input type="hidden" name="_a" value="DeleteEntry">
<input type="hidden" name="id" value="<?= $this->info['id'] ?>">
<input type="hidden" name="referer" value="<?= $this->referer ?>">
  <table>
    <tr> 
      <td class="ContentHeader">Title</td>
      <td class="ContentNormal"><?= $this->info['title'] ?></td>
    </tr>
    <tr> 
      <td valign="top"></td>
      <td> 
        <input type="submit" value="Delete">
        <input name="Button" type="button" value="Cancel" onClick="window.close()"> </td>
    </tr>
  </table>
</form>
	<?php
	}
}
?>