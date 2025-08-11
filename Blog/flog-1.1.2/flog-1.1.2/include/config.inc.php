<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	class FLog_Config{
		var $values  = array();
		var $current = true;
		var $locked  = false;
		var $cid     = '';
		
		function ConfigName($cid){
			global $FLog_dir_data;
			return $FLog_dir_data.preg_replace('/[^a-zA-Z0-9_\-]/', '', $cid).'.dat';
		}
		
		function Load($cid, $lock = false){
			$this->cid = $cid;
			$this->current = true;
			$this->values = array();
			$configname = $this->ConfigName($cid);
			if(!$lock || FLog::LockFile($configname)){
				$this->locked = $lock;
				if(file_exists($configname)){
					if(($configfile = FLog::ReadFile($configname, true)) !== false){
						$size = count($configfile);
						for($i=0; $i<$size; ++$i){
							$line = FLog::Unescape(explode("\t", $configfile[$i], 2));
							if(isset($line[1])){
								$this->values[$line[0]] = $line[1];
							}
						}
						return true;
					}
				}
				else return true;
			}
			if($this->locked){
				FLog::UnlockFile($configname);
				$this->locked = false;
			}
			return false;
		}
		
		function Save(){
			$result = false;
			$configname = $this->ConfigName($this->cid);
			$configfile = '';
			foreach(array_keys($this->values) as $key){
				$configfile .= FLog::Escape($key) . "\t" . FLog::Escape($this->values[$key]) . "\n";
			}
			if($this->locked || FLog::LockFile($configname)){
				$result = FLog::WriteFile($configname, $configfile);
				FLog::UnlockFile($configname);
				$this->locked = false;
			}
			if($result) $current = true;
			return $result;
		}
		
		function Unlock(){
			if($this->locked) FLog::UnlockFile($this->ConfigName($this->cid));
		}
		
		function SetValue($key, $value){
			$this->current = false;
			$this->values[(string)$key] = (string)$value;
		}
		
		function GetValue($key){
			if(isset($this->values[(string)$key])) return $this->values[(string)$key];
			return '';
		}
		
		function GetSafe($key){
			if(isset($this->values[(string)$key])) return htmlspecialchars($this->values[(string)$key]);
			return '';
		}
			
		function GetEntities($key){
			if(isset($this->values[(string)$key])) return FLog::SafeEntities($this->values[(string)$key]);
			return '';
		}
		
		function HasValue($key){
			return isset($this->values[(string)$key]);
		}
		
		function RemoveValue($key){
			$this->current = false;
			if(isset($this->values[(string)$key])) unset($this->values[(string)$key]);
		}
		
	}
	
?>