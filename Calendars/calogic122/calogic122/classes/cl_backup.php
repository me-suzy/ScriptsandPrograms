<?php
/**
 *  IAMBACKUP (iam_backup)
 *
 *  @author     Iván Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *  @version    1.0
 *  @package    iam_backup
 *
 * modifyed for calogic by Philip Boone

 *  A class form performing a database backup and sending it to the browser
 *  or setting it or download.
 *  Browser and OS detection for appropriate handling of download and EOL chars
 *  Requires PHP v 4.0+ and MySQL 3.23+
 *
 *  Copyright (C) Iván Ariel Melgrati <phpclasses@imelgrat.mailshell.com>
 *
 *  This library is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU Lesser General Public
 *  License as published by the Free Software Foundation; either
 *  version 2 of the License, or (at your option) any later version.
 *
 *  This library is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 *  Lesser General Public License for more details.
 */

/**
 * iam_backup class.
 * Module to generate backups of Databases. Main class.
 */
class iam_backup
{
/**
* Host that holds the DB
* @var string $host
*/
    var $host="localhost";

/**
* Database to backup
* @var string $dbname
*/
    var $dbname="mysql";

/**
* User to access the Database to be backed up
* @var string $dbuser
*/
    var $dbuser="root";

/**
* Password to access the Database to be backed up
* @var string $dbpass
*/
    var $dbpass="";

/**
* Newline character (OS dependant)
* @var string $newline
*/
    var $newline;

/**
* Backup only the DB structure and not the data itself
* @var Boolean $struct_only
*/
    var $struct_only;

/**
* Whether to send the output to the browser or download it
* @var string $output
*/
    var $output = true;

    var $compress = true;

    var $filename = "calogicbackup.sql";

    var $tabletype = true;

    var $fileformat = true;

/**
* Initialize this class. Constructor
* @access public
* @param Boolean $output
* @param Boolean $struct_only
* @param string $host
* @param string $dbanme
* @param string $dbuser
* @param string $dbpass
*/
    function iam_backup($output, $struct_only, $host, $dbname, $dbuser, $dbpass, $filename, $tabletype, $compress, $fileformat)
    {
        $this->newline = $this->_define_newline();
        $this->host = $host;
        $this->dbname =  $dbname;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->struct_only = $struct_only;
        $this->output = $output;
        $this->compress =  $compress;
        $this->filename = $filename;
        $this->tabletype = $tabletype;
        $this->fileformat = $fileformat;

/*
        Print "Options: <br>
        filename: ".$filename."<br>
        download: ".$output."<br>
        gzip: ".$compress."<br>
        tabletype: ".$tabletype."<br>
        structure: ".$struct_only."<br>";
*/
    }


/**
* Generate the output.
* @access private
*/
    function _backup()
    {

        $now = gmdate('D, d M Y H:i:s') . ' GMT';
        $tprelen = strlen($GLOBALS["tabpre"]."_");
        $xtabpre = $GLOBALS["tabpre"]."_";

        if($this->compress) {

            if ( !$file = gzopen($this->filename,"w") ) {
                print "could not create GZIP backup file.";
                exit();
            }
        } else {

            if ( !$file = fopen($this->filename,"w") ) {
                print "could not create backup file.";
                exit();
            }

        }

        $newfile = "";

        if($this->fileformat == true) {
            $newfile .= "<?php".$this->newline.$this->newline;
        }

        $newfile .= "#------------------------------------------".$this->newline;
        $newfile.= "# CaLogic Database Backup".$this->newline;
        $newfile.= "# Database: $this->dbname".$this->newline;
        $newfile.= "# Date: $now".$this->newline;
        $newfile.= "#------------------------------------------".$this->newline.$this->newline;

        if($this->compress) {
            if ( gzwrite($file,$newfile) == -1 ) {
                print "could not write to GZIP backup file.";
                gzclose($file);
                exit();
            }
        } else {
            if ( fwrite($file,$newfile) == -1 ) {
                print "could not write to backup file.";
                fclose($file);
                exit();
            }
        }

        $result = mysql_pconnect("$this->host","$this->dbuser","$this->dbpass");
        if(!$result)     // If no connection can be obtained, return empty string
        {
        return "Error. Cannot connect to database";
        }

        if(!mysql_select_db("$this->dbname"))  // If db can't be set, return empty string
        {
        return "Error. cannot select database.";

        }

        $result = @mysql_query("show tables from $this->dbname");

        while (list($table) = @mysql_fetch_row($result))
        {
            $incltab = false;

            if($this->tabletype == true) {
                if(substr($table,0,$tprelen) == $xtabpre) {
                    $incltab = true;
                } else {
                    $incltab = false;
                }
            } else {
                $incltab = true;
            }

            if($incltab == true) {

                print "backing up table: ".$table."...<br>";

                flush();
                usleep(25);

                if($this->fileformat == true) {
                    $newfile = $this->_get_def_calogic($table);
                } else {
                    $newfile = $this->_get_def($table);
                }
                $newfile .= "$this->newline";

                if($this->struct_only == false) {// If table data also has to be written, get table contents
                    if($this->fileformat == true) {
                        $newfile .= $this->_get_content_calogic($table);
                    } else {
                        $newfile .= $this->_get_content($table);
                    }
                } else {
                    $newfile .= "$this->newline";
                }

                if($this->compress) {
                    if ( gzwrite($file,$newfile) == -1 ) {
                        print "could not write to GZIP backup file.";
                        gzclose($file);
                        exit();
                    }
                } else {
                    if ( fwrite($file,$newfile) == -1 ) {
                        print "could not write to backup file.";
                        fclose($file);
                        exit();
                    }
                }

                $i++;
            }
        }

        if($this->fileformat == true) {
            if ( gzwrite($file,"?>".$this->newline) == -1 ) {
                print "could not write to GZIP backup file.";
                gzclose($file);
                exit();
            }
        }

        if($this->compress) {
            gzclose($file);
        } else {
            fclose($file);
        }

#        if($this->output) {
#            echo $file;
#        }

    }

/**
* Send the output to the designed output device (browser)
* @access private
* @param file_pointer $fptr
* @param string $output
*/
    function _out($fptr, $output)
    {
        echo $output;
    }
/**
* Generate the selected table's definition
* @access private
* @param String $tablename
*/
    function _get_def($tablename)
    {
        $def = "";
        $def .="#------------------------------------------".$this->newline;
        $def .="# Table definition for $tablename".$this->newline;
        $def .="#------------------------------------------".$this->newline;
        $def .= "DROP TABLE IF EXISTS $tablename;".$this->newline.$this->newline;
        $def .= "CREATE TABLE $tablename (".$this->newline;
        $result = @mysql_query("SHOW FIELDS FROM $tablename") or die("Table $tablename not existing in database");
        while($row = @mysql_fetch_array($result))
        {
          $def .= "    $row[Field] $row[Type]";
          #if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";

#          if (isset($row['Default']) && ($row["Default"] == "''" || $row["Default"] == "' '" || $row["Default"] == " " || $row["Default"] == "")) {
          if (isset($row['Default']) && $row["Default"] != "") {
              $def .= " DEFAULT ' '";
 #         } elseif(isset($row['Default'])) {
 #             $def .= " DEFAULT '$row[Default]'";
          }

          if ($row["Null"] != "YES") $def .= " NOT NULL";
          if ($row[Extra] != "") $def .= " $row[Extra]";
          $def .= ",$this->newline";
        }
        $def = ereg_replace(",$this->newline$","", $def);

        $result = @mysql_query("SHOW KEYS FROM $tablename");
        while($row = @mysql_fetch_array($result))
        {
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
        }

        while(list($x, $columns) = @each($index))
        {
          $def .= ",$this->newline";
          if($x == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($x,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $x (" . implode($columns, ", ") . ")";
        }
        $def .= "$this->newline);";
/*
    $local_query         = 'SHOW TABLE STATUS LIKE \'' . addslashes($tablename, TRUE) . '\'';
    $table_info_result   = mysql_query($local_query) or die('', $local_query, '');
    $showtable           = mysql_fetch_array($table_info_result);
    $tbl_type            = strtoupper($showtable['Type']);
    $tbl_charset         = empty($showtable['Charset']) ? '' : $showtable['Charset'];
    $table_info_num_rows = (isset($showtable['Rows']) ? $showtable['Rows'] : 0);
    $show_comment        = (isset($showtable['Comment']) ? $showtable['Comment'] : '');
    $auto_increment      = (isset($showtable['Auto_increment']) ? $showtable['Auto_increment'] : '');
    $tmp                 = explode(' ', $showtable['Create_options']);
    $tmp_cnt             = count($tmp);
    for ($i = 0; $i < $tmp_cnt; $i++) {
        $tmp1            = explode('=', $tmp[$i]);
        if (isset($tmp1[1])) {
            $$tmp1[0]    = $tmp1[1];
        }
    } // end for
    unset($tmp1);
    unset($tmp);
*/
        return (stripslashes($def));
    }

    function _get_def_calogic($tablename)
    {
        $def = "";
        $def .="#------------------------------------------".$this->newline;
        $def .="# Table definition for $tablename".$this->newline;
        $def .="#------------------------------------------".$this->newline;
        $def .= "\$sqlstr = \"DROP TABLE IF EXISTS $tablename\";".$this->newline;
        $def .= "mysql_query(\$sqlstr) or die(\"Database setup error.<br><br>MySQL said: \".mysql_error().\"<br><br>SQL String: \".\$sqlstr.\"<br><br>File: \".substr(__FILE__,strrpos(__FILE__,\"/\")).\"<br><br>Line: \".__LINE__.\$GLOBALS[\"errep\"]);".$this->newline.$this->newline;

        $def .= "\$sqlstr = \"CREATE TABLE $tablename (".$this->newline;
        $result = @mysql_query("SHOW FIELDS FROM $tablename") or die("Table $tablename not existing in database");
        while($row = @mysql_fetch_array($result))
        {
          $def .= "    $row[Field] $row[Type]";
#          if (isset($row['Default']) && ($row["Default"] == "''" || $row["Default"] == "' '" || $row["Default"] == " " || $row["Default"] == "")) {
          if (isset($row['Default']) && $row["Default"] != "") {
              $def .= " DEFAULT ' '";
 #         } elseif(isset($row['Default'])) {
 #             $def .= " DEFAULT '$row[Default]'";
          }

#          if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";
          if ($row["Null"] != "YES") $def .= " NOT NULL";
          if ($row[Extra] != "") $def .= " $row[Extra]";
          $def .= ",$this->newline";
        }
        $def = ereg_replace(",$this->newline$","", $def);

        $result = @mysql_query("SHOW KEYS FROM $tablename");
        while($row = @mysql_fetch_array($result))
        {
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
        }

        while(list($x, $columns) = @each($index))
        {
          $def .= ",$this->newline";
          if($x == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($x,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $x (" . implode($columns, ", ") . ")";
        }
        $def .= "$this->newline)\";".$this->newline;
        $def .= "mysql_query(\$sqlstr) or die(\"Database setup error.<br><br>MySQL said: \".mysql_error().\"<br><br>SQL String: \".\$sqlstr.\"<br><br>File: \".substr(__FILE__,strrpos(__FILE__,\"/\")).\"<br><br>Line: \".__LINE__.\$GLOBALS[\"errep\"]);".$this->newline.$this->newline;

/*
    $local_query         = 'SHOW TABLE STATUS LIKE \'' . addslashes($tablename, TRUE) . '\'';
    $table_info_result   = mysql_query($local_query) or die('', $local_query, '');
    $showtable           = mysql_fetch_array($table_info_result);
    $tbl_type            = strtoupper($showtable['Type']);
    $tbl_charset         = empty($showtable['Charset']) ? '' : $showtable['Charset'];
    $table_info_num_rows = (isset($showtable['Rows']) ? $showtable['Rows'] : 0);
    $show_comment        = (isset($showtable['Comment']) ? $showtable['Comment'] : '');
    $auto_increment      = (isset($showtable['Auto_increment']) ? $showtable['Auto_increment'] : '');
    $tmp                 = explode(' ', $showtable['Create_options']);
    $tmp_cnt             = count($tmp);
    for ($i = 0; $i < $tmp_cnt; $i++) {
        $tmp1            = explode('=', $tmp[$i]);
        if (isset($tmp1[1])) {
            $$tmp1[0]    = $tmp1[1];
        }
    } // end for
    unset($tmp1);
    unset($tmp);
*/
        return (stripslashes($def));
    }

/**
* Generate the selected table's contents
* @access private
* @param String $tablename
*/
    function _get_content($tablename)
    {
        $content = "";

        $sqlres = "";
        $rowcount = "";
        $row = "";
        $eoq = false;

        $sqlstr = "SELECT * FROM $tablename";
        if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
            enderror("Cannot query $tablename table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }
        if(!$cldb->execute($sqlres,$rowcount)) {
            enderror("Cannot query $tablename table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }


        #$result = @mysql_query("SELECT * FROM $tablename");

        #if(@mysql_num_rows($result)>0)
        #{
            $content .="#------------------------------------------".$this->newline;
            $content .="# Data inserts for $tablename".$this->newline;
            $content .="#------------------------------------------".$this->newline.$this->newline;
        #}

        #while($row = @mysql_fetch_row($result))
        while($cldb->get_row($sqlres,$row,$eoq))
        {
          $insert = "INSERT INTO $tablename VALUES (";

          #for($j=0; $j<@mysql_num_fields($result);$j++)
          for($j=0; $j<@mysql_num_fields($cldb->query[$sqlres]);$j++)
          {
            if(!isset($row[$j])) $insert .= "NULL,";
            else if($row[$j] != "") $insert .= "'".addslashes($row[$j])."',";
            else $insert .= "'',";
          }

          $insert = ereg_replace(",$", "", $insert);
          $insert .= ");$this->newline";
          $content .= $insert;
        }

        if(!$eoq == true) {
            enderror("Possible database error in table $tablename",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }

        $cldb->release($sqlres);
        return $content.$this->newline;

        #return $content.$this->newline;
    }


    function _get_content_calogic($tablename)
    {
        global $cldb;

        $content = "";

        $sqlres = "";
        $rowcount = "";
        $row = "";
        $eoq = false;

        $sqlstr = "SELECT * FROM $tablename";
        if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
            enderror("Cannot query $tablename table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }
        if(!$cldb->execute($sqlres,$rowcount)) {
            enderror("Cannot query $tablename table",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }


        #$result = @mysql_query("SELECT * FROM $tablename");

        #if(@mysql_num_rows($result)>0)
        #{
            $content .="#------------------------------------------".$this->newline;
            $content .="# Data inserts for $tablename".$this->newline;
            $content .="#------------------------------------------".$this->newline.$this->newline;
        #}

        #while($row = @mysql_fetch_row($result)) {
        while($cldb->get_row($sqlres,$row,$eoq)) {

            $insert = "\$sqlstr = \"INSERT INTO $tablename VALUES (";

            #for($j=0; $j<@mysql_num_fields($result);$j++) {
            for($j=0; $j<@mysql_num_fields($cldb->query[$sqlres]);$j++) {
                if(!isset($row[$j])) {
                    $insert .= "NULL,";
                } elseif($row[$j] != "") {
                    $insert .= "'".addslashes($row[$j])."',";
                } else {
                    $insert .= "'',";
                }

            }

            $insert = ereg_replace(",$", "", $insert);
            $insert .= ")\";$this->newline";
            $content .= $insert;
            $content .= "mysql_query(\$sqlstr) or die(\"Database restore error.<br><br>MySQL said: \".mysql_error().\"<br><br>SQL String: \".\$sqlstr.\"<br><br>File: \".substr(__FILE__,strrpos(__FILE__,\"/\")).\"<br><br>Line: \".__LINE__.\$GLOBALS[\"errep\"]);".$this->newline.$this->newline;

        }
        if(!$eoq == true) {
            enderror("Possible database error in table $tablename",substr(__FILE__,strrpos(__FILE__,"/")),__LINE__,$sqlres,true);
        }

        $cldb->release($sqlres);
        return $content;

    }

/**
* Define EOL character according to target OS
* @access private
*/
    function _define_newline()
    {
         $unewline = "\r\n";

         if (strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'win'))
         {
            $unewline = "\r\n";
         }
         else if (strstr(strtolower($_SERVER["HTTP_USER_AGENT"]), 'mac'))
         {
            $unewline = "\r";
         }
         else
         {
            $unewline = "\n";
         }

         return $unewline;
    }

/**
* Define the client's browser type
* @access private
*/
    function _get_browser_type()
    {
        $USER_BROWSER_AGENT="";

        if (ereg('OPERA(/| )([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='OPERA';
        }
        else if (ereg('MSIE ([0-9].[0-9]{1,2})',strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='IE';
        }
        else if (ereg('OMNIWEB/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='OMNIWEB';
        }
        else if (ereg('MOZILLA/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='MOZILLA';
        }
        else if (ereg('KONQUEROR/([0-9].[0-9]{1,2})', strtoupper($_SERVER["HTTP_USER_AGENT"]), $log_version))
        {
            $USER_BROWSER_AGENT='KONQUEROR';
        }
        else
        {
            $USER_BROWSER_AGENT='OTHER';
        }

        return $USER_BROWSER_AGENT;
    }

/**
* Define MIME-TYPE according to target Browser
* @access private
*/
    function _get_mime_type()
    {
        $USER_BROWSER_AGENT= $this->_get_browser_type();

        $mime_type = ($USER_BROWSER_AGENT == 'IE' || $USER_BROWSER_AGENT == 'OPERA')
                       ? 'application/octetstream'
                       : 'application/octet-stream';
        return $mime_type;
    }

/**
* Generate the DB backup and send it to browser or download it as a file
* @access public
*/
    function perform_backup()
    {
        $now = gmdate('D, d M Y H:i:s') . ' GMT';
        $filename = $this->dbname;
        $ext = "sql";
        $USER_BROWSER_AGENT= $this->_get_browser_type();

/*
        if ($this->output == true)
        {
             header('Content-Type: ' . $this->_get_mime_type());
             header('Expires: ' . $now);
             if ($USER_BROWSER_AGENT == 'IE')
             {
                  header('Content-Disposition: inline; filename="' . $filename . '.' . $ext . '"');
                  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                  header('Pragma: public');
             }
             else
             {
                  header('Content-Disposition: attachment; filename="' . $filename . '.' . $ext . '"');
                  header('Pragma: no-cache');
             }

             $this->_backup();
        }
        else
        {
             echo "<html><body ".$GLOBALS["sysbodystyle"]." ><pre>";
             echo htmlspecialchars($this->_backup());
             echo "</PRE></BODY></HTML>";
        }
*/
        $this->_backup();
    }
}

?>
