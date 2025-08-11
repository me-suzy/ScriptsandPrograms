<?php
class SearchBox
{
	var $categoryControl;
	var $text;
	var $extra;
	
	function SearchBox( $categoryControl, $text, $extra='' )
	{
		$this->categoryControl = $categoryControl;
		$this->text = $text;
		$this->extra = $extra;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
	?>
<script language="JavaScript">
<!--
function SelectBox_onSubmit()
{
	var selected = document.SearchBox.category.selectedIndex;
	var category = document.SearchBox.category[selected].value;
	var text = document.SearchBox.text.value;
	window.location = '<?= $PHP_SELF ?>?category='+category+'&text='+text+'&extra=<?= $extra ?>';
}
// -->
</script>
<form name="SearchBox" onSubmit="SelectBox_onSubmit();return false;">
<table width="100%" border="0">
  <tr> 
    <td><? $this->categoryControl->printControl() ?></td>
  </tr>
  <tr> 
    <td>
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="100%"><input type="text" name="text" size="8" style="width: 90 px" value="<?= $this->text ?>"></td>
		<td><input type="submit" value="Search" style="width: 50 px"></td>
	</tr>
	</table>	
	</td>
  </tr>
</table>
</form>
	<?
	}
}
?>