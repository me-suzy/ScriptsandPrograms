<?php
	/**
	* Abstraction layer to hide Flat file / MySQL implementation
	*
	* This class is intended to choose the right implementation based on the configuration
	* retrieved from ConfigManager class
	*
	* @package Smiletag
	* @author Yuniar Setiawan <yuniarsetiawan@smiletag.com>
	* @since 2.0
	*/
	class St_PersistenceManager{
		
		/**
		* @access private
		* The message filename for storing data
		*/
		var $messageFile;
		
		/**
		* @access private
		* The ban list filename for storing banned ip address/nickname
		*/
		var $banFile;
		
				
		/**
		* @access private
		* The storage type for saving data,it could be 'mysql' or 'file'
		*/
		var $storageType;
		
		/**
		* @access private
		* The data access object to save/retrieve data, depends on the storage type
		*/
		var $dao;
		
		/**
		* @access private
		* The maximum number of allowed message stored in the file
		*/
		var $maxMessageRotation;
		
		
		/**
		* Sets the message file
		* 
		* @param string $messageFile Message filename
		*/
		function setMessageFile($messageFile){
			$this->messageFile = $messageFile;
		}
		
		/**
		* Sets the ban file
		* 
		* @param string $messageFile Message filename
		*/
		function setBanFile($banFile){
			$this->banFile = $banFile;
		}
				
		/**
		* Sets the storage type
		*
		* @access public
		* @param string $type the storage type, it could be 'mysql' or 'file'
		*/
		function setStorageType($type){
			$this->storageType = $type;
			
			if(strtolower($type) == 'file'){
				$this->dao =& new St_FileDao();
			}elseif(strtolower($type) == 'mysql'){
				$this->dao =& new St_MysqlDao();
			}
		}
		
		/**
		* Save the message through data access object
		*
		* @access public
		* @return boolean true on success
		*/
		function save($newMessage){
			if(strtolower($this->storageType) == 'file'){
				$this->dao->setMessageFile($this->messageFile);
				$this->dao->setMaxMessageRotation($this->maxMessageRotation);
			}elseif(strtolower($this->storageType) == 'mysql'){
				//set user ,password,host
				//......
			}
			
			$this->dao->insert($newMessage);
		}
		
		/**
		* Ban an ip address
		*
		* @access public
		* @return boolean true on success
		*/
		function banIpAddress($ipAddress){
			if(strtolower($this->storageType) == 'file'){
				$this->dao->setBanFile($this->banFile);			
			}elseif(strtolower($this->storageType) == 'mysql'){
				//set user ,password,host
				//......
			}
			
			$this->dao->banIpAddress($ipAddress);
		}
		
		/**
		* Gets the messages from data access object as the specified result size
		*
		* @access public
		* @param integer $size The size of messages to be retrieved
		* @return array
		*/
		function getMessageArray($size){
			if(strtolower($this->storageType) == 'file'){
				$this->dao->setMessageFile($this->messageFile);
			
			}elseif(strtolower($this->storageType) == 'mysql'){
				//set user ,password,host
				//......
			}
			
			return $this->dao->getMessage($size);
		}
		
		/**
		* Gets the timestamp for the latest message
		*
		* @access public
		* @return string
		*/
		function getLatestTimestamp(){
			if(strtolower($this->storageType) == 'file'){
				$this->dao->setMessageFile($this->messageFile);
			
			}elseif(strtolower($this->storageType) == 'mysql'){
				//set user ,password,host
				//......
			}
			return $this->dao->getLatestTimestamp();
		}
		
		/**
		* Sets the maximum message file allowed in a file before gets rotated
		*
		* @access public
		* @param integer $size The size of messages 
		* @return array
		*/
		function setMaxMessageRotation($size){
			$this->maxMessageRotation = $size;
		}
	}
	
?>