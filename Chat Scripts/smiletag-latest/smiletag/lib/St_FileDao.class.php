<?php
	
	/**
	* DAO class for accessing flat file
	*
	* Handle all operation needed to read/write to flat file
	*
	* @package Smiletag
	* @author Yuniar Setiawan <yuniarsetiawan@smiletag.com>
	* @since 2.0
	*/
	
	class St_FileDao {
		
		/**
		* @access private
		* The message filename for storing data
		*/
		var $messageFile;
		
		/**
		* @access private
		* The ban filename for storing ban list
		*/
		var $banFile;
		
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
		* Insert a new message into file
		*
		* @access public
		* @return boolean true on success
		*/
		function insert($newMessage){
			
			//encode all ']' characters, these are reserved chars for CDATA section
			$newMessage['message'] = str_replace(']','&#93',$newMessage['message']);
			
			$xmlParser =& new St_XmlParser();
			$xmlParser->appendMessage($this->messageFile,$this->maxMessageRotation,$newMessage);
						
			return true;
		}
		
		/**
		* Save an ip address entry into ban file
		*
		* @access public
		* @return boolean true on success
		*/
		function banIpAddress($ipAddress){
			
			$xmlParser =& new St_XmlParser();
			$xmlParser->appendIpAddress($this->banFile,$ipAddress);
						
			return true;
		}
		
		/**
		* Get all messages from file, the messages returned as array in descendant order
		*
		* @access public
		* @param integer $size The size of messages to be retrieved
		* @return array
		*/
		function getMessage($size){
			$xmlParser =& new St_XmlParser();
			$messageArray = $xmlParser->parseMessagesToArray($this->messageFile);
			
			if(is_array($messageArray) && ($size != 0)){
				$messageArray = array_slice($messageArray,0,$size);
			}
						
			return $messageArray;
		}
		
		/**
		* Gets the timestamp of the latest message
		*
		* @access public
		* @return string
		*/
		function getLatestTimestamp(){
			$xmlParser =& new St_XmlParser();
						
			return $xmlParser->getFirstChildTimestamp($this->messageFile);
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