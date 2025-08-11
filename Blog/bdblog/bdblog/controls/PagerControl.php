<?php
class PagerControl
{
	var $baseURL;
	var $name;
	var $total;
	var $page;
	
	function PagerControl( $baseURL, $name, $total, $page=0 )
	{
		$this->baseURL = $baseURL;
		$this->name = $name;
		$this->total = $total;
		$this->page = $page;
	}
	
	function printInfo()
	{
		$top = ($this->page+1)*PER_PAGE;
		if ( $top>$this->total )
			$top = $this->total;
		echo '<div class="PagerControl" align="center">'.($this->page*PER_PAGE+1).'-'.$top.'/'.$this->total.'</div>';
	}
	
	function printControl()
	{
		?>
		<div class="PagerControl" align="center">
		<?
		$totalPages = (int)($this->total/PER_PAGE);
		if ( ($this->total%PER_PAGE)>0 )
			$totalPages++;
			
		if ( $this->page>0 )
		{
		?>
		<a href="<?= $this->baseURL ?>&<?= $this->name ?>=<?= 0 ?>">&lt;&lt;</a>&nbsp;
		<a href="<?= $this->baseURL ?>&<?= $this->name ?>=<?= $this->page-1 ?>">&lt;</a>&nbsp;
		<?
		}
		
		$min = $this->page-10;
		if ( $min<0 )
			$min = 0;
		$max = $min+20;
		if ( $max>$totalPages )
		{
			$max = $totalPages;
			if ( $max>20 )
				$min=$max-20;
		}

		for( $i=$min; $i<$max; $i++ )
		{
			if ( $i==$this->page )
			{
			?>
			<?= $i+1 ?>&nbsp;
			<?
			}
			else
			{
			?>
			<a href="<?= $this->baseURL ?>&<?= $this->name ?>=<?= $i ?>"><?= $i+1 ?></a>&nbsp;
			<?
			}
		}

		if ( $this->page<$totalPages-1 )
		{
		?>
		<a href="<?= $this->baseURL ?>&<?= $this->name ?>=<?= $this->page+1 ?>">&gt;</a>&nbsp;
		<a href="<?= $this->baseURL ?>&<?= $this->name ?>=<?= $totalPages-1 ?>">&gt;&gt;</a>&nbsp;
		<?
		}
		?>
		</div>
		<?
	}
}
?>