<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/

class database {
	var $error_report = 1;
	var $link;

	//MYSQL sever connection
	function connect($hostname="localhost", $username="root", $password=""){
		$this->link = @mysql_connect($hostname, $username, $password) or $this->printerror();
		return $this->link;
	}

	//Select Database
	function select($database){
		return @mysql_select_db($database, $this->link) or $this->printerror();
	}
	
	//Queries come this way!
	function query($string, $hide=0){
		global $database;
		$query = mysql_query($string, $this->link);
		if($this->errornumber() && !$hide)
		{
			 $this->error($string);
			 echo "SQL code was:<BR><BR>";
			 echo $string;
			 exit;
		}
		return $query;
	}

	//Time to Fetch the Array!
	function fetch_array($query){
		$result = mysql_fetch_array($query);
		return $result;
	}

	//How many Rows???
	function num_rows($query){
		$output = mysql_num_rows($query);
		return $output;
	}

	//Error number's
	function errornumber(){
		global $database;
		return mysql_errno();
	}

	//Error
	function error(){
		return mysql_error();
	}

	//Database Error Reporting
	function printerror($string=""){
		if($this->error_reporting){
			echo "Database error report: " . mysql_errno();
			echo "<br>" . mysql_error();
			echo "<br>Query: $string";
			exit;
		}
	}

}
?>