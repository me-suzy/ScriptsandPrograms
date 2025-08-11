<?php
class CategoriesHandler extends TableHandler
{
	var $table = CATEGORIES_TABLE;
	var $fields = array
	(
		'title'
	);
	
	var $conn;
	
	function CategoriesHandler( $conn )
	{
		$this->conn = $conn;
	}
	
	function getFullList()
	{
		
		$list = $this->conn->getResult('select * from '.$this->table.' order by title');
		if ( !is_array($list) )
			$list = array();
		array_unshift( $list, array( 'id' => 0, 'title'=>'Unfiled' ) );
		return $list;
	}
	
	function getList()
	{
		return $this->conn->getResult('select * from '.$this->table.' order by title');
	}
}
?>