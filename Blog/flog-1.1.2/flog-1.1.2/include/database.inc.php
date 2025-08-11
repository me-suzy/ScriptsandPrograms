<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	$FLog_Database_sortkey = false;
	$FLog_Database_sortorder = SORT_ASC;
	$FLog_Database_sortcallback = 'strnatcasecmp';

	class FLog_DatabaseRecord{
		var $loaded = false;
		var $current = true;
		var $rid = -1;
		var $fields = array();
		
		function __constructor($rid = -1){
			$this->Flog_DatabaseRecord($rid);
		}
		
		function FLog_DatabaseRecord($rid = -1){
			$this->rid = (int)$rid;
			if($rid < 0){
				$this->loaded = true;
				$this->current = false;
			}
			else{
				$this->loaded = false;
				$this->current = true;
			}
		}
		
		function RecordName($dbid, $rid){
			global $FLog_dir_data;
			return $FLog_dir_data.preg_replace('/[^a-zA-Z0-9_\-]/', '', $dbid).'.'.(int)$rid.'.dat';
		}
		
		function Compare(&$a, &$b){
			global $FLog_Database_sortkey, $FLog_Database_sortcallback, $FLog_Database_sortorder;
			if($FLog_Database_sortkey === false){
				if($FLog_Database_sortorder == SORT_ASC) return $a->rid - $b->rid;
				return $b->rid - $a->rid;
			}
			else{
				if($FLog_Database_sortorder == SORT_ASC) return call_user_func($FLog_Database_sortcallback, $a->GetValue($FLog_Database_sortkey), $b->GetValue($FLog_Database_sortkey));
				return call_user_func($FLog_Database_sortcallback, $b->GetValue($FLog_Database_sortkey), $a->GetValue($FLog_Database_sortkey));
			}
		}
		
		function CompareRecord(&$a, &$b){
			global $FLog_Database_sortkey, $FLog_Database_sortcallback, $FLog_Database_sortorder;
			if($FLog_Database_sortorder == SORT_ASC) return call_user_func_array($FLog_Database_sortcallback, array(&$a, &$b));
			return call_user_func_array($FLog_Database_sortcallback, array(&$b, &$a));
		}
		
		function SetValue($key, $value){
			$this->current = false;
			$this->fields[(string)$key] = (string)$value;
		}
		
		function GetValue($key){
			if(isset($this->fields[(string)$key])) return $this->fields[(string)$key];
			return '';
		}
		
		function GetSafe($key){
			if(isset($this->fields[(string)$key])) return htmlspecialchars($this->fields[(string)$key]);
			return '';
		}
		
		function GetEntities($key){
			if(isset($this->fields[(string)$key])) return FLog::SafeEntities($this->fields[(string)$key]);
			return '';
		}
		
		function HasValue($key){
			return isset($this->fields[(string)$key]);
		}
		
		function RemoveValue($key){
			$this->current = false;
			if(isset($this->fields[(string)$key])) unset($this->fields[(string)$key]);
		}
		
		function Load($dbid, $rid){
			$result = false;
			if(($recordfile = FLog::ReadFile($this->RecordName($dbid, $rid), true))!==false){
				$this->fields = array();
				$this->loaded = true;
				$this->current = true;
				$this->rid = (int)$rid;
				$size = count($recordfile);
				for($i=0; $i<$size; ++$i){
					$line = FLog::Unescape(explode("\t", $recordfile[$i], 2));
					if(isset($line[1])){
						$this->fields[$line[0]] = $line[1];
					}
				}
				$result = true;
			}
			return $result;
		}
		
		function LoadC($dbid, $rid){
			if($this->loaded) return true;
			return $this->Load($dbid, $rid);
		}
		
		function Save($dbid){
			if(!$this->loaded) return true;
			$result = false;
			$recordname = $this->RecordName($dbid, $this->rid);
			$recordfile = '';
			foreach(array_keys($this->fields) as $key){
				$recordfile .= FLog::Escape($key) . "\t" . FLog::Escape($this->fields[$key]) . "\n";
			}
			if(FLog::LockFile($recordname)){
				$result = FLog::WriteFile($recordname, $recordfile);
				FLog::UnlockFile($recordname);
			}
			if($result){
				$this->current = true;
				$this->loaded = true;
			}
			return $result;
		}
	}
	
	class FLog_Database{
		var $dbid = '';
		var $current = true;
		var $max = -1;
		var $fields = array();
		var $records = array();
		var $delete = array();
		var $locked = false;
		
		function IndexName($dbid){
			global $FLog_dir_data;
			return $FLog_dir_data.preg_replace('/[^a-zA-Z0-9_\-]/', '', $dbid).'.index';
		}
		
		function Load($dbid, $lock = false){
			$this->dbid = $dbid;
			$this->current = true;
			$this->fields = array();
			$this->records = array();
			$this->delete = array();
			$indexname = $this->IndexName($dbid);
			if(!$lock || FLog::LockFile($indexname)){
				$this->locked = $lock;
				if(file_exists($indexname)){
					if(($indexfile = FLog::ReadFile($indexname, true)) !== false){
						$size = count($indexfile);
						if($size >= 2){
							$this->max = (int)$indexfile[0];
							$this->fields = FLog::Unescape(explode("\t", $indexfile[1]));
							for($i=2; $i<$size; ++$i){
								$line = explode("\t", $indexfile[$i], 2);
								if(isset($line[1])){
									$record = new FLog_DatabaseRecord((int)$line[0]);
									$fields = FLog::Unescape(explode("\t", $line[1]));
									$rsize = min(count($fields), count($this->fields));
									for($j = 0; $j < $rsize; ++$j){
										$record->SetValue($this->fields[$j], $fields[$j]);
									}
									$record->loaded = false;
									$record->current = true;
									$this->records[(int)$line[0]] = $record;
								}
							}
						}
						return true;
					}
				}
				else return true;
			}
			if($this->locked){
				FLog::UnlockFile($indexname);
				$this->locked = false;
			}
			return false;
		}
		
		function Save(){
			$result = false;
			$indexname = $this->IndexName($this->dbid);
			$indexfile = $this->max . "\n";
			$indexfile .= implode("\t", FLog::Unescape($this->fields)) . "\n";
			if($this->locked || FLog::LockFile($indexname)){
				foreach(array_keys($this->records) as $key){
					if(!$this->records[$key]->current) $this->records[$key]->Save($this->dbid);
					$indexfile .= $key . "\t";
					foreach($this->fields as $field){
						if(!($this->records[$key]->loaded) && !($this->records[$key]->HasValue($field))){
							$this->records[$key]->Load($this->dbid, $this->records[$key]->rid);
						}
						$indexfile .= $this->records[$key]->GetValue($field) . "\t";
					}
					$indexfile .= "\n";
				}
				if($result = FLog::WriteFile($indexname, $indexfile)){
					foreach($this->delete as $rid){
						FLog::DeleteFile(FLog_DatabaseRecord::RecordName($this->dbid, (int)$rid));
					}
					$this->delete = array();
					$this->current = true;
				}
				FLog::UnlockFile($indexname);
				$this->locked = false;
			}
			return $result;
		}
		
		function Unlock(){
			if($this->locked){
				FLog::UnlockFile($this->IndexName($this->dbid));
				$this->locked = false;
			}
		}
		
		function InsertRecord(&$record){
			$record->rid = ++$this->max;
			$record->current = false;
			$record->loaded = true;
			$this->current = false;
			$this->records[$record->rid] = $record;
		}
		
		function LoadAll(){
			foreach(array_keys($this->records) as $key){
				$this->records[$key]->Load($this->dbid, $key);
			}
		}
		
		function Sort($key = false, $order = SORT_ASC, $callback = 'strnatcasecmp'){
			global $FLog_Database_sortkey, $FLog_Database_sortorder, $FLog_Database_sortcallback;
			$FLog_Database_sortkey = $key;
			$FLog_Database_sortorder = $order;
			$FLog_Database_sortcallback = $callback;
			return uasort($this->records, array('FLog_DatabaseRecord','Compare'));
		}
		
		function SortRecords($order = SORT_ASC, $callback = false){
			global $FLog_Database_sortkey, $FLog_Database_sortorder, $FLog_Database_sortcallback;
			$FLog_Database_sortkey = false;
			$FLog_Database_sortorder = $order;
			$FLog_Database_sortcallback = $callback;
			if($callback!==false) return uasort($this->records, array('FLog_DatabaseRecord','CompareRecord'));
			return true;
		}
		
		function DeleteRecord($rid){
			if(isset($this->records[(int)$rid])){
				$this->current = false;
				$this->delete[] = (int)$rid;
				unset($this->records[(int)$rid]);
			}
		}
		
		function FindRecord($key, $value){
			foreach(array_keys($this->records) as $rid){
				if($this->records[$rid]->GetValue($key) === (string)$value) return $rid;
			}
			return -1;
		}
		
		// accessors?
	}

?>