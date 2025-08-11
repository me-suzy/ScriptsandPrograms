<?php
class NewEntryDialog
{
	var $categoryControl;
	
	function NewEntryDialog( $categoryControl )
	{
		$this->categoryControl = $categoryControl;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
		$dateControl = new DateControl( 'day', 'month', 'year' );
	?>
<form name="NewEntry" action="<?= $PHP_SELF ?>" method="post">
<input type="hidden" name="_a" value="NewEntry">
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
      <td><input type="text" name="title" size="60" style="width: 100%"></td>
    </tr>
    <tr> 
      <td valign="top" nowrap class="ContentHeader">Text</td>
      <td><textarea name="text" cols="60" rows="10" id="text"></textarea></td>
    </tr>
    <tr> 
      <td valign="top"></td>
      <td> 
        <input type="submit" value="Add">
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