<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software; you can redistribute it and/or modify      *
 *  it under the terms of the GNU General Public License as published by      *
 *  the Free Software Foundation; either version 2 of the License, or         *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU General Public License for more details.                              *
 *                                                                            *
 *  You should have received a copy of the GNU General Public License         *
 *  along with this program; if not, write to the Free Software               *
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA *
 ******************************************************************************/

define ( 'SB_CURRENT_RELEASE', '3.3.5');

require_once('./inc/errorhandler.inc.php');

class SB_Database extends SB_ErrorHandler
{
    var $connection = null;
    var $name;
    var $user;
    var $lastsql;
    var $count = 0; // Count of executed statements
    var $sw;

    function SB_Database()
    {
        $this->sw = new SB_StopWatch();
    }

    function currentRelease()
    {
        return SB_CURRENT_RELEASE;
    }

    function & staticInstance($ignoreError=false)
    {
        static $db;

        if (!$db)
        {
            $db = new SB_DatabaseMySQL($ignoreError);
        }

        return $db;
    }

    function dieOnError($result, $ignore = null)
    {
        if (!$result && (!$ignore || !in_array($this->getErrorCode(), $ignore)))
        {
            $err = $this->getErrorCode() . ': ' . $this->getErrorText();

            echo '<b>Invalid query:</b> ' . $err;
            echo '<p>';
            echo '<pre>';
            echo  htmlspecialchars($this->lastsql);
            echo '</pre>';

            $this->log("\nDB:$err\n", $this->lastsql);
            die();
        }
    }

    function select( $columns, $table, $where=null, $order=null)
    {
        $sql  = 'SELECT ' .
            ($columns?(is_array($columns)?implode(',',$columns):$columns):'*') .
            "\nFROM " . $table;
        $sql .= $this->buildWhere($where);

        if ($order)
        {
            $sql .= "\nORDER BY " . $order . "\n";
        }

        $result = $this->raw($sql);
        $this->dieOnError($result);
        return $result;
    }

    function insert( $table, $pairs, $ignore = null)
    {
        $values = array();

        foreach (array_values($pairs) as $value)
        {
            $values[] = $this->quoteValue($value);
        }

        $sql  = 'INSERT INTO ' . $table . ' ';
        $sql .= '(' . implode(', ',array_keys($pairs)) . ")\n";
        $sql .= 'VALUES ('. implode(', ', $values) .  ')';

        $result = $this->raw($sql);
        $this->dieOnError($result, $ignore);
        return $result;
    }

    function delete( $table, $where=null)
    {
        $sql  = 'DELETE FROM ' . $table . "\n";

        if ($where!==null)
        {
            $sql .= $this->buildWhere($where);
        }

        $result = $this->raw($sql);
        $this->dieOnError($result);
        return $result;
    }

    function update( $table, $pairs, $where=null, $ignore=null)
    {
        $sql = 'UPDATE ' . $table. "\nSET ";
        $set = array();

        if (is_array($pairs))
        {
            foreach ($pairs as $column => $value)
            {
                $set[] = $column . '=' . $this->quoteValue($value);
            }
        }
        else
        {
            $set[] = $pairs;
        }

        $sql .= implode(', ', $set);
        $sql .= $this->buildWhere($where);

        $result = $this->raw($sql);
        $this->dieOnError($result, $ignore);
        return $result;
    }

    function buildWhere($where)
    {
        $sql = '';

        if ($where)
        {
            $sql .= "\nWHERE ";

            if (is_array($where))
            {
                foreach ($where as $filter => $value)
                {
                    if (substr($filter,0,1) == '^')
                    {
                        $sql .= ' ' . $value . ' ';
                    }
                    else
                    {
                        $qval = $this->quoteValue($value);
                        $sql .= ' ' . $filter . ($qval==='NULL'?' is ':'=') . $qval;
                    }
                }
            }
            else
            {
                $sql .= ' ' . $where;
            }
        }

        return $sql;
    }

    function quoteValue($value)
    {
        if (is_numeric($value))
        {
            return $value;
        }
        elseif (is_array($value))
        {
            $val  = key($value) . '(';
            $val .= $value[key($value)]
                    ?$this->quoteValue($value[key($value)]):'';
            $val .= ') ';
            return $val;
        }
        elseif ($value === null)
        {
            return 'NULL';
        }
        else
        {
            return "'" . $this->escapeString($value) . "'";
        }
    }

    function fetchRecord($request, $binary = false)
    {
        $record = $this->fetchArray($request);

        if (!$record)
        {
            return false;
        }
        else
        {
            if (!$binary)
            {
                array_walk($record, array( $this, '_unescape'));
            }
            return $record;
        }
    }

    function fetchRecords($request)
    {
        $records = array();

        while (($record = $this->fetchArray($request)))
        {
            array_walk($record, array( $this, '_unescape'));
            $records[] = $record;
        }

        return $records;
    }

    function _unescape(&$item, $key)
    {
        if (!is_numeric($item))
        {
            $item = stripslashes($item);
        }
    }

    /* Cache functions */

    function getCache( $type, $key )
    {
        $res = $this->select(null, 'sitebar_cache',
            array('type'=>$type,'^1'=>'AND', 'ckey'=>$key));

        $rec = $this->fetchRecord($res, true);

        return $rec;
    }

    function setCache( $type, $key, $value )
    {
        $this->delete('sitebar_cache',
            array('type'=>$type,'^1'=>'AND', 'ckey'=>$key));

        $this->insert('sitebar_cache', array
        (
            'type'=>$type,
            'ckey'=>$key,
            'created'=>array('now' => ''),
            'cvalue'=>$value
        ));
        return true;
    }

    function purgeCache( $type, $key=null, $created=null)
    {
        $where = array('type'=>$type);

        if ($key)
        {
            $where['^1'] = 'AND';
            $where['ckey'] = $key;
        }

        if ($created)
        {
            $where['^2'] = 'AND created < ' . $created;
        }

        $this->delete('sitebar_cache', $where);
        return true;
    }

    /* Abstract functions to be redefined */

    function createDB($db) { die('Abstract class.'); }
    function connect($host, $user, $pass) { die('Abstract class.'); }
    function close() { die('Abstract class.'); }
    function escapeString($str) { die('Abstract class.'); }
    function fetchArray($request) { die('Abstract class.'); }
    function getAffectedRows() { die('Abstract class.'); }
    function getErrorCode() { die('Abstract class.'); }
    function getErrorText() { die('Abstract class.'); }
    function getLastId() { die('Abstract class.'); }
    function hasDB($db) { die('Abstract class.'); }
    function hasTable($table) { die('Abstract class.'); }
    function raw($sql) { die('Abstract class.'); }
}

class SB_DatabaseMySQL extends SB_Database
{
    function SB_DatabaseMySQL($ignoreError=false)
    {
        parent::SB_Database();

        if (!extension_loaded('mysql') || !function_exists('mysql_connect'))
        {
            die('SiteBar: No support for MySQL detected!');
        }

        if (!is_file('./inc/config.inc.php'))
        {
            return;
        }

        include('./inc/config.inc.php');

        $config = $SITEBAR['db'];
        $this->name = $config['name'];
        $this->connection = $this->connect($config['host'], $config['username'], $config['password']);

        if (!$this->connection)
        {
            return;
        }

        if (!$this->hasDB($config['name']))
        {
            if (!$ignoreError)
            {
                die('SiteBar: SB_Database <b>'. $this->name . '</b> does not exist! '.
                    'Delete your <b>inc/config.inc.php</b>!');
            }
            $this->connection = null;
            return;
        }
    }

    function createDB($db)
    {
        return $this->raw('CREATE DATABASE ' . $db);
    }

    function connect($host, $user, $pass)
    {
        $this->sw->cont();
        SB_ErrorHandler::useHandler(false);
        $ret = @mysql_connect($host, $user, $pass);
        SB_ErrorHandler::useHandler(true);
        $this->sw->pause();
        return $ret;
    }

    function close()
    {
        $this->sw->cont();
        mysql_close($this->connection);
        $this->sw->pause();
        $this->connection = null;
    }

    function escapeString($str)
    {
        return mysql_escape_string($str);
    }

    function fetchArray($request)
    {
        $this->sw->cont();
        $data = mysql_fetch_array($request, MYSQL_ASSOC);
        $this->sw->pause();
        return $data;
    }

    function getAffectedRows()
    {
        return mysql_affected_rows($this->connection);
    }

    function getErrorCode()
    {
        return mysql_errno($this->connection);
    }

    function getErrorText()
    {
        if ($this->connection)
        {
            return mysql_error($this->connection);
        }
        else
        {
            return mysql_error();
        }
    }

    function getLastId()
    {
        return mysql_insert_id($this->connection);
    }

    function hasDB($db)
    {
        return mysql_select_db($db, $this->connection) ;
    }

    function hasTable($table)
    {
        $this->useHandler(false);
        $fields = @mysql_list_fields($this->name, $table, $this->connection);
        $this->useHandler(true);
        return $fields;
    }

    function raw($sql)
    {
        $this->count++;
        $this->lastsql = $sql;
        if (SB_LOG_SQL) $this->log("\nS:", str_replace("\n",' ',$sql));
        $this->sw->cont();
        $res = mysql_query($sql, $this->connection);
        $this->sw->pause();
        return $res;
    }
}

?>