<?php
class EntriesHandler extends TableHandler
{
	var $table = ENTRIES_TABLE;
	var $fields = array
	(
		'category',
		'date',
		'title',
		'text'
	);
	
	var $conn;
	
	function EntriesHandler( $conn )
	{
		$this->conn = $conn;
	}
	
	function search( $text, $category=-1, $page=0 )
	{
		$categorySQL = '';
		if ( is_int($category) && $category!=-1 )
			$categorySQL = 'and category=\''.$category.'\'';
 		$sql = 'select * from '.$this->table.' where (title like \'%'.$this->conn->escape($text).'%\' or text like \'%'.$this->conn->escape($text).'%\') '.$categorySQL.' order by date desc, id desc';
		return $this->conn->getResult( $sql );
	}
	
	function getListByMonth( $year, $month, $page=0 )
	{
		$minDate = date('Y-m-d',mktime(0,0,0,$month,1,$year));
		$maxDate = date('Y-m-d',mktime(0,0,0,$month+1,0,$year));
		return $this->conn->getResult('select * from '.$this->table.' where date>=\''.$minDate.'\' and date<=\''.$maxDate.'\' order by date desc, id desc');
	}

	function getDayListByMonth( $year, $month, $page=0 )
	{
		$minDate = date('Y-m-d',mktime(0,0,0,$month,1,$year));
		$maxDate = date('Y-m-d',mktime(0,0,0,$month+1,0,$year));
		return $this->conn->getResult('select date from '.$this->table.' where date>=\''.$minDate.'\' and date<=\''.$maxDate.'\'');
	}
	
	function getListByDate( $date, $page=0 )
	{
		if ( !ereg('^[0-9]+-[0-9]+-[0-9]+$',$date) )
			$date = date('Y-m-d');
		return $this->conn->getResult('select * from '.$this->table.' where date=\''.$date.'\' order by id desc');
	}

	function getList( $page=0 )
	{
		return $this->conn->getResult('select * from '.$this->table.' order by date desc, id desc');
	}
	
	function getMinDate()
	{
		return $this->conn->getSingleField('select min(date) from '.$this->table);
	}
	
	function getMaxDate()
	{
		return $this->conn->getSingleField('select max(date) from '.$this->table);
	}
	
	function transferCategoryToUnfiled( $category )
	{
		$this->conn->exec('update '.$this->table.' set category=\'0\' where category=\''.((int)($category)).'\'');
	}
}
?>