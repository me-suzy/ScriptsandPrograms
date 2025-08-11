<?php
	
	/**
	* Class for parsing Smiletag specific XML file
	*
	* This class is intended to serialize and deserialize array from/to XML file.
	*
	* @package Smiletag
	* @author Yuniar Setiawan <yuniarsetiawan@smiletag.com>
	* @since 2.0
	*/
	
	class St_XmlParser{
		
		/**
		* Parse XML from the specified configuration filename into array
		* The config file (path-config.xml,smiletag-config.xml) has simple xml structure
		* Apply locking to synchronize operation among users 
		*
		* @access public
		* @return array if the file has contents, null if empty
		*/
		function parseMainConfigToArray($fileName) {
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096);
			}
			flock($file,LOCK_UN);
			fclose($file);
			
			$textData = implode($buffer);
			if(!empty($textData)){
				
				$xmlDoc =& new DOMIT_Lite_Document();
				$xmlDoc->parseXML($textData,false);
				$rootElement =& $xmlDoc->documentElement;
				
				if($rootElement->hasChildNodes()){
					$childNodes =& $rootElement->childNodes;
					$childCount =& $rootElement->childCount;
					for($i=0;$i < $childCount;$i++){
						$childArray[trim($childNodes[$i]->nodeName)] = trim($childNodes[$i]->childNodes[0]->nodeValue);
					}
				}
				
				return $childArray;
			}else{
				return null;
			}
				
		}
		
		/**
		* Parse XML from the message.xml into array
		* Apply locking to synchronize operation among users 
		*
		* @access public
		* @return array if the file has contents, null if empty
		*/
		function parseMessagesToArray($fileName) {
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096);
			}
			flock($file,LOCK_UN);
			fclose($file);
			//load data from file
			$textData = implode($buffer);
			
			if(!empty($textData)){
				
				$xmlDoc =& new DOMIT_Lite_Document();
				$xmlDoc->parseXML($textData,false);
				$rootElement =& $xmlDoc->documentElement;
				
				//traverse to nodes and save the values into childArray
				if($rootElement->hasChildNodes()){
					$rowNodes =& $rootElement->childNodes;
					$childCount =& $rootElement->childCount;
					
					for($i=0;$i < $childCount;$i++){
									
						$currentNode      =& $rowNodes[$i];
						$currentNodeCount =& $currentNode->childCount;
									
						for($j=0;$j< $currentNodeCount;$j++){
							$childArray[$i][trim($currentNode->childNodes[$j]->nodeName)] = trim($currentNode->childNodes[$j]->childNodes[0]->nodeValue);	
						}
						
						
					}
				}
				return $childArray;
			}else{
				return null;
			}
				
		}  
		
		/**
		* Parse XML from the smiley-config.xml into array
		* Apply locking to synchronize operation among users 
		* Currently this function has the same functional as parseMessagesToArray
		*
		* @access public
		* @return array if the file has contents, null if empty
		*/
		function parseSmiliesToArray($fileName) {
			return $this->parseMessagesToArray($fileName);				
		}  		
		/**
		* Parse the badword list specified in the $fileName into array
		*
		* @access public
		* @param string $fileName badword configuration file
		* @return array containing pattern and its replacement
		*/
		function parseBadwordToArray($fileName){
			
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096);
			}
			flock($file,LOCK_UN);
			fclose($file);
			//load data from file
			$textData = implode($buffer);
			
			if(!empty($textData)){
				
				$xmlDoc =& new DOMIT_Lite_Document();
				$xmlDoc->parseXML($textData,false);
				
				//gets the replacement words
				$replacement   = $xmlDoc->getElementsByTagName('replacement');
				$replacement   = $replacement->item(0);
				$replacement   = $replacement->getText(); //currently replacement is not an array
				
				//gets the bad words
				$badwordList   = $xmlDoc->getElementsByPath('/badword_config/badwords/word');
				$max 		   = $badwordList->getLength();			
				
					
				if($max != 0){
					for($i=0;$i<$max;$i++){
						$currentNode =& $badwordList->item($i);
						$badwords[]  = trim($currentNode->getText());
					}
				}else{
					$badwords = null;
				}
					
				$badwordArray['replacement'] = $replacement;
				$badwordArray['badwords']	 = $badwords;
				
				return $badwordArray;			
				
			}else{
				return null;
			}
		}
		
		
		/**
		* Append input message to the specified XML file
		* 
		* @param string $fileName Message file name
		* @param integer $maxMessageRotation The maximum allowed number of messages stored in file, if set to 0 then unlimited
		* @param array $newMessage The new messages input
		* @return boolean true on succeeded
		*/
		function appendMessage($fileName,$maxMessageRotation,$newMessage){
			
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096); //load data from file
			}
			flock($file,LOCK_UN);
			fclose($file);
			
			$textData = trim(implode($buffer));
			
			if(empty($textData)){
				$textData = '<?xml version="1.0"?>'."\n".'<smiletag_message>'."\n".'</smiletag_message>';
			};
			
			$xmlDoc =& new DOMIT_Lite_Document();
			$xmlDoc->parseXML($textData,false);
			
			$rootElement =& $xmlDoc->documentElement;
			
			
			//apply message rotation if applied and maximum number reached
			//delete the unwanted childs
			if($maxMessageRotation != 0){
				if(($rootElement->childCount) >= $maxMessageRotation){
					while (($rootElement->childCount) >= $maxMessageRotation) {
						$rootElement->removeChild($rootElement->lastChild);
					}
				}
			}
			
			//create new element, and insert it before the first child				
			$rowElement =& $xmlDoc->createElement('row');
			$nameElement =& $xmlDoc->createElement('name');
			$urlElement =& $xmlDoc->createElement('url');
			$messageElement =& $xmlDoc->createElement('message');
			$datetimeElement =& $xmlDoc->createElement('datetime');
			$ipaddressElement =& $xmlDoc->createElement('ipaddress');
			
			//domit hacks
			//replace all '&amp;' into '&' to support unicode encoding (multilanguage character support)
			$nameElement->appendChild($xmlDoc->createCDATASection(str_replace('&amp;','&',$newMessage['name'])));	
			$urlElement->appendChild($xmlDoc->createCDATASection($newMessage['url']));
			$messageElement->appendChild($xmlDoc->createCDATASection(str_replace('&amp;','&',$newMessage['message'])));
			$datetimeElement->appendChild($xmlDoc->createTextNode($newMessage['datetime']));
			$ipaddressElement->appendChild($xmlDoc->createTextNode($newMessage['ipaddress']));
			
			$rowElement->appendChild($nameElement);
			$rowElement->appendChild($urlElement);
			$rowElement->appendChild($messageElement);
			$rowElement->appendChild($datetimeElement);
			$rowElement->appendChild($ipaddressElement);
				
			$rootElement->insertBefore($rowElement,$rootElement->firstChild);	
						
			
			$buffer = '<?xml version="1.0"?>'."\n".$xmlDoc->toNormalizedString(false);
			
			//save backs to file
			$file = @fopen($fileName,'w') or die("Could not open file $fileName or permission denied");       
			flock($file,LOCK_EX);
			fwrite($file,$buffer);
			flock($file,LOCK_UN);
	        fclose($file);
			
	        return true;
		}
		
		
		/**
		* Append an ip address entry to the ban-list XML file
		* 
		* @param string $fileName Ban list file name
		* @param string $ipAddress The ip address
		* @return boolean true on succeeded
		*/
		function appendIpAddress($fileName,$ipAddress){
			
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096); //load data from file
			}
			flock($file,LOCK_UN);
			fclose($file);
			
			$textData = trim(implode($buffer));
			
			if(empty($textData)){
				$textData = '<?xml version="1.0"?>'."\n".'<ban_list>'."\n".'</ban_list>';
			};
			
			$xmlDoc =& new DOMIT_Lite_Document();
			$xmlDoc->parseXML($textData,false);
			
			$rootElement =& $xmlDoc->documentElement;
			$bannedIpAddressElement =& $rootElement->firstChild;
								
			//create new element, and insert it before the first child				
			$ipAddressElement =& $xmlDoc->createElement('ipaddress');
			$ipAddressElement->appendChild($xmlDoc->createTextNode($ipAddress));
						
			$bannedIpAddressElement->appendChild($ipAddressElement);
						
			$buffer = '<?xml version="1.0"?>'."\n".$xmlDoc->toNormalizedString(false);
						
			//save backs to file
			$file = @fopen($fileName,'w') or die("Could not open file $fileName or permission denied");       
			flock($file,LOCK_EX);
			fwrite($file,$buffer);
			flock($file,LOCK_UN);
	        fclose($file);
			
	        return true;
		}
		
		/**
		* Gets the timestamp of the latest message
		*
		* @access public
		* @return string
		*/
		function getFirstChildTimestamp($fileName){
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096);
			}
			flock($file,LOCK_UN);
			fclose($file);
			//load data from file
			$textData = implode($buffer);
			
			if(!empty($textData)){
				
				$xmlDoc =& new DOMIT_Lite_Document();
				$xmlDoc->parseXML($textData,false);

				$firstChild =& $xmlDoc->getElementsByPath('/smiletag_message/row/datetime',1);			
						
				return $firstChild->childNodes[0]->nodeValue;
			}else{
				return '0';
			}
		}
		
		/**
		* Parse configuration from ban-list.xml into array
		*
		* @access public
		* @return array if the file has contents, null if empty
		*/
		function parseBanListToArray($fileName){
			$file = @fopen($fileName,'r') or die("Could not open file $fileName or permission denied");
			
			flock($file,LOCK_SH);
			while(!feof($file)){
			   $buffer[] = fgets($file,4096);
			}
			flock($file,LOCK_UN);
			fclose($file);
			//load data from file
			$textData = implode($buffer);
			
			if(!empty($textData)){
				
				$xmlDoc =& new DOMIT_Lite_Document();
				$xmlDoc->parseXML($textData,false);
								
				//gets ipaddress list
				$ipAddressList = $xmlDoc->getElementsByTagName('ipaddress');
				$max 		   = $ipAddressList->getLength();
				
				if($max == 0){
					return null;
				}
				
				for($i=0;$i<$max;$i++){
					$currentNode =& $ipAddressList->item($i);
					$banList['ipaddress'][] = trim($currentNode->getText());
				}
				
				//gets nickname list
				$nicknameList  = $xmlDoc->getElementsByTagName('name');
				$max 		   = $nicknameList->getLength();
				
				for($i=0;$i<$max;$i++){
					$currentNode =& $nicknameList->item($i);
					$banList['name'][] = strtolower(trim($currentNode->getText()));
				}
				
				return $banList;
			}else{
				return null;
			}
		}
	}
	
?>