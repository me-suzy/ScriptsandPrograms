<?php
class EntryList
{
	var $list;
	var $categoryControl;
	var $extra;
	
	function EntryList( $list, $categoryControl, $extra )
	{
		$this->list = $list;
		$this->categoryControl = $categoryControl;
		$this->extra = $extra;
	}
	
	function printWidget()
	{
	?>
	<table width="100%">
	<?php
	if ( count( $this->list ) )
		foreach( $this->list as $item )
		{
	?>
	<tr><td class="EntryHeader" colspan="2"><?= $item['title'] ?></td></tr>
	<tr>
		<td class="EntryDate"><?= DateControl::getString($item['date']) ?></td>
		<td class="EntryCategory" align="right"><?= $this->categoryControl->getString($item['category']) ?></td>
	</tr>
	<tr><td class="EntryBody" colspan="2"><?= $item['text'] ?></td></tr>
	<tr><td colspan="2" align="right" class="EntryLinks">
	<a href="" onClick="self.name='main';window.open('dialog.php?_d=UpdateEntry&id=<?= $item['id'] ?>&referer=<?= urlencode('index.php?'.$this->extra) ?>','UpdateEntry','width=600,height=350');return false;">Update</a>
	|
	<a href="" onClick="self.name='main';window.open('dialog.php?_d=DeleteEntry&id=<?= $item['id'] ?>&referer=<?= urlencode('index.php?'.$this->extra) ?>','DeleteEntry','width=300,height=100');return false;">Delete</a>
	</td></tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<?php
		}
	else
	{
	?>
	<p align="center" class="EntryBody">No entries</p>
	<?php
	}
	?>
	</table>
	<?php
	}
}
?>