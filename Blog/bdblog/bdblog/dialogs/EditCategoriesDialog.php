<?php
class EditCategoriesDialog
{
	var $list;
	var $referer;
	
	function EditCategoriesDialog( $list, $referer )
	{
		$this->list = $list;
		$this->referer = $referer;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
	?>
<script language="JavaScript">
<!--
function onOk()
{
	opener.location = '<?= $this->referer ?>';
	window.close();
}

function onNew()
{
	var title = prompt('New category title','');
	if ( title!=null )
		window.location = '<?= $PHP_SELF ?>?referer=<?= $this->referer ?>&_d=EditCategories&_a=CategoryAdd&title='+title;
	opener.location = '<?= $this->referer ?>';
}

function onRename()
{
	var selected = document.form.select.selectedIndex;
	var title = document.form.select[selected].text;
	var id = document.form.select[selected].value;
	var title = prompt('Category title',title);
	if ( title!=null )
		window.location = '<?= $PHP_SELF ?>?referer=<?= $this->referer ?>&_d=EditCategories&_a=CategoryRename&id='+id+'&title='+title;
	opener.location = '<?= $this->referer ?>';
}

function onDelete()
{
	var selected = document.form.select.selectedIndex;
	var title = document.form.select[selected].text;
	var id = document.form.select[selected].value;
	if (confirm('Are you sure you want to delete\n\''+title+'\' category?\n\nAll the entries in this category\nwill be moved to \'Unfiled\''))
		window.location = '<?= $PHP_SELF ?>?referer=<?= $this->referer ?>&_d=EditCategories&_a=CategoryDelete&id='+id;
	opener.location = '<?= $this->referer ?>';
}
// -->
</script>

<body>
<form name="form" method="post" action="">
  <table width="100" border="0">
    <tr align="center"> 
      <td colspan="4">
	    <select name="select" size="10" style="width: 100%">
		<?php
		if ( count($this->list) )
			foreach( $this->list as $item )
			{
			?>
			<option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
			<?php
			}
		?>
        </select>
	  </td>
    </tr>
    <tr align="center"> 
      <td><input type="button" value="Ok" onClick="onOk();return false;"></td>
      <td><input type="button" value="New" onClick="onNew();return false;"></td>
      <td><input type="button" value="Rename" onClick="onRename();return false;"></td>
      <td><input type="button" value="Delete" onClick="onDelete();return false;"></td>
    </tr>
  </table>
</form>
	<?
	}
}
?>