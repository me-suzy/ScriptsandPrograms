<?php
class UpdateEntryDialog
{
	var $categoryControl;
	var $info;
		
	function UpdateEntryDialog( $categoryControl, $info )
	{
		$this->categoryControl = $categoryControl;
		$this->info = $info;
		$this->referer = $referer;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
		$dateControl = new DateControl( 'day', 'month', 'year', $this->info['date'] );
	?>
<form name="NewEntry" action="<?= $PHP_SELF ?>" method="post">
<input type="hidden" name="_a" value="UpdateEntry">
<input type="hidden" name="id" value="<?= $this->info['id'] ?>">
  <table>
    <tr> 
      <td valign="top" nowrap class="ContentHeader">Category</td>
      <td><? $this->categoryControl->printControl() ?></td>
    </tr>
    <tr> 
      <td valign="top" nowrap class="ContentHeader">Date</td>
      <td><? $dateControl->printControl() ?></td>
    </tr>
    <tr> 
      <td valign="top" nowrap class="ContentHeader">Title</td>
      <td><input type="text" name="title" size="60" value="<?= $this->info['title'] ?>" style="width: 100%"></td>
    </tr>
    <tr> 
      <td valign="top" nowrap class="ContentHeader">Text</td>
      <td><textarea name="text" cols="60" rows="10" id="text"><?= $this->info['text'] ?></textarea></td>
    </tr>
    <tr> 
      <td valign="top"></td>
      <td> 
        <input type="submit" value="Update">
        <input name="Button" type="button" value="Cancel" onClick="window.close()"> </td>
    </tr>
  </table>
</form>
<script language="javascript1.2">
editor_generate('text');
</script>
	<?php
	}
}
?>