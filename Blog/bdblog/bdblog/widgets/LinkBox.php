
<?php
class LinkBox
{
	var $extra;
	
	function LinkBox( $extra )
	{
		$this->extra = $extra;
	}
	
	function printWidget()
	{
	?>
<table width="100%" border="0">
  <tr> 
    <td class="LinkBox"><a href="" onClick="self.name='main';window.open('dialog.php?_d=NewEntry&referer=<?= urlencode('index.php?'.$this->extra) ?>','NewEntry','width=600,height=350');return false;">New entry</a></td>
  </tr>
  <tr> 
    <td class="LinkBox"><a href="" onClick="self.name='main';window.open('dialog.php?_d=EditCategories&referer=<?= urlencode('index.php?'.$this->extra) ?>','CategoriesEditor','width=230,height=230');return false;">Category editor</a></td>
  </tr>
</table>
	<?php
	}
}
?>