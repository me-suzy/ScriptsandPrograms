<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------

class DB_sth {
  var $_queryID = -1; // This variable keeps the result link identifier.

  var $_numOfRows = -1;   // number of rows, or -1 
  var $_numOfFields = -1; // number of fields in recordset 
  var $_inited = false;   // Init() should only be called once
  var $_currentRow = -1;  // This variable keeps the current row in the Recordset.

  var $bind = false;      // used by Fields() to hold array - should be private?
  var $fields = false;    // holds the current row data

  var $EOF = false;       // Indicates that the current record position is after the last record in a Recordset object.

  function DB_sth($queryID) {
    $this->_queryID = $queryID;

    if ($this->_inited) return;
    $this->_inited = true;
                
    if ($this->_queryID) {
      $this->_numOfRows = @mysql_num_rows($this->_queryID);
      $this->_numOfFields = @mysql_num_fields($this->_queryID);
     } 
    else {
      $this->_numOfRows = 0;
      $this->_numOfFields = 0;
     }

    if ($this->_numOfRows != 0 && $this->_numOfFields && $this->_currentRow == -1) {
      $this->_currentRow = 0;
      $this->EOF = ($this->_fetch() === false);
     }
    else  
      $this->EOF = true;
   }

  function Close() {
    @mysql_free_result($this->_queryID);
    $this->_queryID = false;
   }

  function _fetch() {
    $this->fields = @mysql_fetch_array($this->_queryID);
    return (is_array($this->fields));
   }

  function _seek($row) {
    return @mysql_data_seek($this->_queryID, $row);
   }

  function MoveNext() {
    if (!$this->EOF) {              
      $this->_currentRow++;
      // using & below slows things down by 20%!
      $this->fields = @mysql_fetch_array($this->_queryID);
                        
      if (is_array($this->fields)) return true;
      $this->EOF = true;
     }
    return false;
   }       

   /* Use associative array to get fields array */
   function Fields($colname) {       
     return @$this->fields[$colname];
    }

   function &GetRowAssoc($upper=true) {
     if (!$this->bind) {
       $this->bind = array();
       for ($i=0; $i < $this->_numOfFields; $i++) {
         $o = $this->FetchField($i);
         $this->bind[($upper) ? strtoupper($o->name) : $o->name] = $i;
        }
      }

     $record = array();
     foreach($this->bind as $k => $v) {
       $record[$k] = $this->fields[$v];
      }
     return $record;
    }

   function &FetchField($fieldOffset = -1) {       
     if ($fieldOffset != -1) {
       $o = @mysql_fetch_field($this->_queryID, $fieldOffset);
       $f = @mysql_field_flags($this->_queryID,$fieldOffset);
       $o->max_length = @mysql_field_len($this->_queryID,$fieldOffset); // suggested by: Jim Nicholson (jnich@att.com)
       $o->binary = (strpos($f,'binary')!== false);
      }
     else if ($fieldOffset == -1) {  /*      The $fieldOffset argument is not provided thus its -1   */
       $o = @mysql_fetch_field($this->_queryID);
       $o->max_length = @mysql_field_len($this->_queryID); // suggested by: Jim Nicholson (jnich@att.com)
      }
     return $o;
    }

  function fetchrow_one() {
    $row = $this->fetchrow_array();
    return $row[0];
   }

  function fetchrow_array() {
    if($this->EOF) {
      $this->Close();
      return false;
     }

    $row = $this->fields;
    $this->MoveNext();

    // Remove any keys which are associative.
    $keys = array_keys($row);
    foreach ($keys as $key) {
      if (!is_int($key)) {
        unset($row[$key]);
       }
     }
    return $row;
   }

  function fetchrow_hash() {
    if ($this->EOF) {
      $this->Close();
      return false;
     }
    // false makes ADOdb not uppercase the column names.
    $row = $this->GetRowAssoc(false);
    $this->MoveNext();
    return $row;
   }

  function fetchall_array() {
    $array = array();
    while ($row = $this->fetchrow_array()) {
      $array[] = $row;
     }
    return $array;
   }

  function fetchall_hash() {
    $hash = array();
    while ($row = $this->fetchrow_hash()) {
      $hash[] = $row;
     }
    return $hash;
   }

  function rows() {
    return $this->_numOfRows;
   }
 }

class DB {
  var $DB;
  var $DB_CFG;
  var $error_msg;
  var $error_no;

  function DB($DB_CFG) {
    global $ERR;
    $this->DB_CFG = $DB_CFG;
    $this->DB = @mysql_connect($this->DB_CFG['host'],
                               $this->DB_CFG['dblogin'],
                               $this->DB_CFG['dbpassw']);
    if(!$this->DB) {
      err('sql.php|DB|connection to \''.$this->DB_CFG['host'].'\' server was failed');
      return;
     }
    @mysql_select_db($this->DB_CFG['dbase'], $this->DB) or
      err('sql.php|DB|the request \'use '.$DB_CFG['dbase'].'\' has failed - '.mysql_error());
   }

  function query($query) {
    // Clear errors.
    $this->error_msg = '';
    $this->error_no = '';

    $result = mysql_query($query, $this->DB);

    if(!$result) {
      $this->error_msg = mysql_error($this->DB);
      $this->error_no = mysql_errno($this->DB);
      return false;
     }
    return new DB_sth($result);
   }

  function query_cl($query) {
    // Clear errors.
    $this->error_msg = '';
    $this->error_no = '';

    $result = mysql_query($query, $this->DB);

    if (!$result) {
      $this->error_msg = mysql_error($this->DB);
      $this->error_no = mysql_errno($this->DB);
      return false;
     }
    return $result;
   }

  function insert($table, $record) {
    // Clear errors.
    $this->error_msg = '';
    $this->error_no = '';
    $errors = array();

    $cols = array();
    $vals = array();

    while(list($k, $v) = each($record)) {
      $cols[] = $k;
      if(is_array($v)) $vals[] = $v[0];
      else $vals[] = "'".addslashes($v)."'";
     }

    $cols = join(',', $cols);
    $vals = join(',', $vals);
    $result = mysql_query("INSERT $table ($cols) VALUES ($vals)", $this->DB);
    return $result;
   }

  function update($table, $set, $where) {
    // Clear errors.
    $this->error_msg = '';
    $this->error_no = '';
    $errors = array();

    $set_vals = array();
    $where_vals = array();

    while(list($k, $v) = each($set)) {
      if(is_array($v)) $set_vals[] = $k." = ".$v[0];
      else $set_vals[] = $k." = '".addslashes($v)."'";
     }

    while(list($k, $v) = each($where)) {
      if(is_array($v)) $where_vals[] = $k." = ".$v[0];
      else $where_vals[] = $k." = '".addslashes($v)."'";
     }

    $set_vals = join(', ', $set_vals);
    $where_vals = join(' AND', $where_vals);
    return mysql_query("UPDATE $table SET $set_vals WHERE $where_vals", $this->DB);
   }

  function error() {
    return $this->error_msg;
   }

  function error_no() {
    return $this->error_no;
   }
 }

?>