<?php
class CategoryControl
{
	var $name;
	var $list;
	var $value;
	var $showAll;
	
	function CategoryControl( $list, $name='', $value=-1, $showAll=true )
	{
		$this->list = $list;
		$this->name = $name;
		if ( !isset( $value ) )
			$value = -1;
		$this->value = $value;
		$this->showAll = $showAll;
	}
	
	function getString( $value=-1 )
	{
		if ( $value==-1 )
			$value = $this->value;
		if ( $value==0 )
			return 'Unfiled';
		foreach( $this->list as $item ) 
			if ( $item['id']==$value )
				return $item['title'];
		return '???';
	}
	
	function printControl()
	{
	?>
	<select name="<?= $this->name ?>" style="width: 100%">
	<?
	if ( $this->showAll )
	{
	?>
		<option value="-1"<? if ($this->value==-1) echo ' selected'?>>All</option>
		<option value="0"<? if ($this->value==0) echo ' selected'?>>Unfiled</option>
	<?
	}
	if ( count($this->list) )
		foreach( $this->list as $item )
		{
		?>
		<option value="<?= $item['id'] ?>"<? if ($this->value==$item['id']) echo ' selected'?>><?= $item['title'] ?></option>
		<?
		}
	?>
	</select>
	<?
	}
}
?>