<?
/**
 Handler
*/

class TableHandler
{
	var $conn;
	var $table;
	var $fields = array();
	var $searchFields = array();
	
	function TableHandler( $conn )
	{
		$this->conn = $conn;
	}
	
	function insert( $env )
	{
		$temp = array();
		foreach( $this->fields as $field )
			$temp[] = "'".$this->conn->escape($env[$field])."'";
		$sql = "insert into ".$this->table." (".join(",",$this->fields).") values (".join(",",$temp).")";
		$this->conn->exec( $sql );
	}
	
	function update( $id, $env )
	{
		$temp = array();
		foreach( $this->fields as $field )
			$temp[] = $field."='".$this->conn->escape($env[$field])."'";
		$sql = "update ".$this->table." set ".join(",",$temp)." where id='$id'";
		$this->conn->exec( $sql );
	}
	
	function delete( $id )
	{
		$id = $this->conn->escape( $id );
		$sql = "delete from ".$this->table." where id='$id'";
		$this->conn->exec( $sql );
	}
	
	function getList()
	{
		$sql = "select * from ".$this->table;
		return $this->conn->getResult( $sql );
	}
	
	function getInfo( $id )
	{
		$id = $this->conn->escape( $id );
		$sql = "select * from ".$this->table." where id='$id'";
		return $this->conn->getSingleRow( $sql );
	}
	
	function search( $text )
	{
		$words = explode(" ",$text);
		if ( !count($words) )
			return $this->getList();
		
		$queries = array();
		foreach( $this->searchFields as $field )
		{
			$temp = array();
			foreach( $words as $word )
				$temp[] = $field." like '%".$this->conn->escape($word)."%'";
			$queries[] = "(".join(" and ",$temp).")";
		}
		$sql = "select * from ".$this->table." where (".join(" or ",$queries).")";
		return $this->conn->getResult( $sql );
	}
}
?>