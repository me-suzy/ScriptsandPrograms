<?php
// MySQL Database connection class

class bdDb
{
	var $conn;
	var $quotes_gpc;	// Is magic_quotes_gpc set?
 
	function bdDb( $server, $user, $pass, $db )
	{
		$this->conn = @mysql_connect( $server, $user, $pass );
		@mysql_select_db( $db, $this->conn );
		$this->quotes_gpc = @get_magic_quotes_gpc()===0?false:true;
	}

	function exec( $sql )
	{
		$res = @mysql_query( $sql, $this->conn );
		@mysql_free_result( $res );
	}

	function getResult( $sql )
	{
		$res = @mysql_query( $sql, $this->conn );
		while( $row=@mysql_fetch_assoc($res) )
			$result[] = $row;
		@mysql_free_result( $res );
		return $result;
	}

	function getSingleRow( $sql )
	{
		$res = @mysql_query( $sql, $this->conn );
		$row = @mysql_fetch_assoc($res);
		@mysql_free_result( $res );
		return $row;
	}

	function getSingleField( $sql )
	{
		$res = @mysql_query( $sql, $this->conn );
		$row = @mysql_fetch_row($res);
		@mysql_free_result( $res );
		return $row[0];
	}

	function escape( $str )
	{
		if ( $this->quotes_gpc===true )
			$str = stripslashes( $str );
		return @mysql_escape_string( $str );
	}

	function destroy()
	{
		@mysql_close( $this->conn );
	}
 
	function insertId()
	{
		return @mysql_insert_id( $this->conn );
	}
}
?>