<?php
/*
$Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $

NuSOAP - Web Services Toolkit for PHP

Copyright (c) 2002 NuSphere Corporation

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

If you have any questions or comments, please email:

Dietrich Ayala
dietrich@ganx4.com
http://dietrich.ganx4.com/nusoap

NuSphere Corporation
http://www.nusphere.com

*/

/* load classes

// necessary classes
require_once('class.soap_client.php');
require_once('class.soap_val.php');
require_once('class.soap_parser.php');
require_once('class.soap_fault.php');

// transport classes
require_once('class.soap_transport_http.php');

// optional add-on classes
require_once('class.xmlschema.php');
require_once('class.wsdl.php');

// server class
require_once('class.soap_server.php');*/

/**
*
* nusoap_base
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class nusoap_base {

	var $title = 'NuSOAP';
	var $version = '0.6.8';
	var $revision = '$Revision: 1.81 $';
	var $error_str = '';
    var $debug_str = '';
	// toggles automatic encoding of special characters as entities
	// (should always be true, I think)
	var $charencoding = true;

    /**
	*  set schema version
	*
	* @var      XMLSchemaVersion
	* @access   public
	*/
	var $XMLSchemaVersion = 'http://www.w3.org/2001/XMLSchema';
	
    /**
	*  set charset encoding for outgoing messages
	*
	* @var      soap_defencoding
	* @access   public
	*/
	//var $soap_defencoding = 'UTF-8';
    var $soap_defencoding = 'ISO-8859-1';

	/**
	*  load namespace uris into an array of uri => prefix
	*
	* @var      namespaces
	* @access   public
	*/
	var $namespaces = array(
		'SOAP-ENV' => 'http://schemas.xmlsoap.org/soap/envelope/',
		'xsd' => 'http://www.w3.org/2001/XMLSchema',
		'xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
		'SOAP-ENC' => 'http://schemas.xmlsoap.org/soap/encoding/',
		'si' => 'http://soapinterop.org/xsd');
	var $usedNamespaces = array();

	/**
	* load types into typemap array
	* is this legacy yet?
	* no, this is used by the xmlschema class to verify type => namespace mappings.
	* @var      typemap
	* @access   public
	*/
	var $typemap = array(
	'http://www.w3.org/2001/XMLSchema' => array(
		'string'=>'string','boolean'=>'boolean','float'=>'double','double'=>'double','decimal'=>'double',
		'duration'=>'','dateTime'=>'string','time'=>'string','date'=>'string','gYearMonth'=>'',
		'gYear'=>'','gMonthDay'=>'','gDay'=>'','gMonth'=>'','hexBinary'=>'string','base64Binary'=>'string',
		// abstract "any" types
		'anyType'=>'string','anySimpleType'=>'string',
		// derived datatypes
		'normalizedString'=>'string','token'=>'string','language'=>'','NMTOKEN'=>'','NMTOKENS'=>'','Name'=>'','NCName'=>'','ID'=>'',
		'IDREF'=>'','IDREFS'=>'','ENTITY'=>'','ENTITIES'=>'','integer'=>'integer','nonPositiveInteger'=>'integer',
		'negativeInteger'=>'integer','long'=>'integer','int'=>'integer','short'=>'integer','byte'=>'integer','nonNegativeInteger'=>'integer',
		'unsignedLong'=>'','unsignedInt'=>'','unsignedShort'=>'','unsignedByte'=>'','positiveInteger'=>''),
	'http://www.w3.org/1999/XMLSchema' => array(
		'i4'=>'','int'=>'integer','boolean'=>'boolean','string'=>'string','double'=>'double',
		'float'=>'double','dateTime'=>'string',
		'timeInstant'=>'string','base64Binary'=>'string','base64'=>'string','ur-type'=>'array'),
	'http://soapinterop.org/xsd' => array('SOAPStruct'=>'struct'),
	'http://schemas.xmlsoap.org/soap/encoding/' => array('base64'=>'string','array'=>'array','Array'=>'array'),
    'http://xml.apache.org/xml-soap' => array('Map')
	);

	/**
	*  entities to convert
	*
	* @var      xmlEntities
	* @access   public
	*/
	var $xmlEntities = array('quot' => '"','amp' => '&',
		'lt' => '<','gt' => '>','apos' => "'");

	/**
	* adds debug data to the instance debug string with formatting
	*
	* @param    string $string debug data
	* @access   private
	*/
	function debug($string){
		$this->appendDebug($this->getmicrotime().' '.get_class($this).": $string\n");
	}

	/**
	* adds debug data to the instance debug string without formatting
	*
	* @param    string $string debug data
	* @access   private
	*/
	function appendDebug($string){
		// it would be nice to use a memory stream here to use
		// memory more efficiently
		$this->debug_str .= $string;
	}

	/**
	* clears the current debug data for this instance
	*
	* @access   public
	*/
	function clearDebug() {
		// it would be nice to use a memory stream here to use
		// memory more efficiently
		$this->debug_str = '';
	}

	/**
	* gets the current debug data for this instance
	*
	* @return   debug data
	* @access   public
	*/
	function &getDebug() {
		// it would be nice to use a memory stream here to use
		// memory more efficiently
		return $this->debug_str;
	}

	/**
	* gets the current debug data for this instance as an XML comment
	* this may change the contents of the debug data
	*
	* @return   debug data as an XML comment
	* @access   public
	*/
	function &getDebugAsXMLComment() {
		// it would be nice to use a memory stream here to use
		// memory more efficiently
		while (strpos($this->debug_str, '--')) {
			$this->debug_str = str_replace('--', '- -', $this->debug_str);
		}
    	return "<!--\n" . $this->debug_str . "\n-->";
	}

	/**
	* expands entities, e.g. changes '<' to '&lt;'.
	*
	* @param	string	$val	The string in which to expand entities.
	* @access	private
	*/
	function expandEntities($val) {
		if ($this->charencoding) {
	    	$val = str_replace('&', '&amp;', $val);
	    	$val = str_replace("'", '&apos;', $val);
	    	$val = str_replace('"', '&quot;', $val);
	    	$val = str_replace('<', '&lt;', $val);
	    	$val = str_replace('>', '&gt;', $val);
	    }
	    return $val;
	}

	/**
	* returns error string if present
	*
	* @return   mixed error string or false
	* @access   public
	*/
	function getError(){
		if($this->error_str != ''){
			return $this->error_str;
		}
		return false;
	}

	/**
	* sets error string
	*
	* @return   boolean $string error string
	* @access   private
	*/
	function setError($str){
		$this->error_str = $str;
	}

	/**
	* detect if array is a simple array or a struct (associative array)
	*
	* @param	$val	The PHP array
	* @return	string	(arraySimple|arrayStruct)
	* @access	private
	*/
	function isArraySimpleOrStruct($val) {
        $keyList = array_keys($val);
		foreach ($keyList as $keyListValue) {
			if (!is_int($keyListValue)) {
				return 'arrayStruct';
			}
		}
		return 'arraySimple';
	}

	/**
	* serializes PHP values in accordance w/ section 5. Type information is
	* not serialized if $use == 'literal'.
	*
	* @return	string
    * @access	public
	*/
	function serialize_val($val,$name=false,$type=false,$name_ns=false,$type_ns=false,$attributes=false,$use='encoded'){
    	if(is_object($val) && get_class($val) == 'soapval'){
        	return $val->serialize($use);
        }
		$this->debug( "in serialize_val: $val, $name, $type, $name_ns, $type_ns, $attributes, $use");
		// if no name, use item
		$name = (!$name|| is_numeric($name)) ? 'soapVal' : $name;
		// if name has ns, add ns prefix to name
		$xmlns = '';
        if($name_ns){
			$prefix = 'nu'.rand(1000,9999);
			$name = $prefix.':'.$name;
			$xmlns .= " xmlns:$prefix=\"$name_ns\"";
		}
		// if type is prefixed, create type prefix
		if($type_ns != '' && $type_ns == $this->namespaces['xsd']){
			// need to fix this. shouldn't default to xsd if no ns specified
		    // w/o checking against typemap
			$type_prefix = 'xsd';
		} elseif($type_ns){
			$type_prefix = 'ns'.rand(1000,9999);
			$xmlns .= " xmlns:$type_prefix=\"$type_ns\"";
		}
		// serialize attributes if present
		$atts = '';
		if($attributes){
			foreach($attributes as $k => $v){
				$atts .= " $k=\"$v\"";
			}
		}
        // serialize if an xsd built-in primitive type
        if($type != '' && isset($this->typemap[$this->XMLSchemaVersion][$type])){
        	if (is_bool($val)) {
        		if ($type == 'boolean') {
	        		$val = $val ? 'true' : 'false';
	        	} elseif (! $val) {
	        		$val = 0;
	        	}
			} else if (is_string($val)) {
				$val = $this->expandEntities($val);
			}
			if ($use == 'literal') {
	        	return "<$name$xmlns>$val</$name>";
        	} else {
	        	return "<$name$xmlns xsi:type=\"xsd:$type\">$val</$name>";
        	}
        }
		// detect type and serialize
		$xml = '';
		switch(true) {
			case ($type == '' && is_null($val)):
				if ($use == 'literal') {
					// TODO: depends on nillable
					$xml .= "<$name$xmlns/>";
				} else {
					$xml .= "<$name$xmlns xsi:nil=\"true\"/>";
				}
				break;
			case (is_bool($val) || $type == 'boolean'):
        		if ($type == 'boolean') {
	        		$val = $val ? 'true' : 'false';
	        	} elseif (! $val) {
	        		$val = 0;
	        	}
				if ($use == 'literal') {
					$xml .= "<$name$xmlns $atts>$val</$name>";
				} else {
					$xml .= "<$name$xmlns xsi:type=\"xsd:boolean\"$atts>$val</$name>";
				}
				break;
			case (is_int($val) || is_long($val) || $type == 'int'):
				if ($use == 'literal') {
					$xml .= "<$name$xmlns $atts>$val</$name>";
				} else {
					$xml .= "<$name$xmlns xsi:type=\"xsd:int\"$atts>$val</$name>";
				}
				break;
			case (is_float($val)|| is_double($val) || $type == 'float'):
				if ($use == 'literal') {
					$xml .= "<$name$xmlns $atts>$val</$name>";
				} else {
					$xml .= "<$name$xmlns xsi:type=\"xsd:float\"$atts>$val</$name>";
				}
				break;
			case (is_string($val) || $type == 'string'):
				$val = $this->expandEntities($val);
				if ($use == 'literal') {
					$xml .= "<$name$xmlns $atts>$val</$name>";
				} else {
					$xml .= "<$name$xmlns xsi:type=\"xsd:string\"$atts>$val</$name>";
				}
				break;
			case is_object($val):
				$name = get_class($val);
				foreach(get_object_vars($val) as $k => $v){
					$pXml = isset($pXml) ? $pXml.$this->serialize_val($v,$k,false,false,false,false,$use) : $this->serialize_val($v,$k,false,false,false,false,$use);
				}
				$xml .= '<'.$name.'>'.$pXml.'</'.$name.'>';
				break;
			break;
			case (is_array($val) || $type):
				// detect if struct or array
				$valueType = $this->isArraySimpleOrStruct($val);
                if($valueType=='arraySimple' || ereg('^ArrayOf',$type)){
					$i = 0;
					if(is_array($val) && count($val)> 0){
						foreach($val as $v){
	                    	if(is_object($v) && get_class($v) ==  'soapval'){
								$tt_ns = $v->type_ns;
								$tt = $v->type;
							} elseif (is_array($v)) {
								$tt = $this->isArraySimpleOrStruct($v);
							} else {
								$tt = gettype($v);
	                        }
							$array_types[$tt] = 1;
							$xml .= $this->serialize_val($v,'item',false,false,false,false,$use);
							++$i;
						}
						if(count($array_types) > 1){
							$array_typename = 'xsd:ur-type';
						} elseif(isset($tt) && isset($this->typemap[$this->XMLSchemaVersion][$tt])) {
							if ($tt == 'integer') {
								$tt = 'int';
							}
							$array_typename = 'xsd:'.$tt;
						} elseif(isset($tt) && $tt == 'arraySimple'){
							$array_typename = 'SOAP-ENC:Array';
						} elseif(isset($tt) && $tt == 'arrayStruct'){
							$array_typename = 'unnamed_struct_use_soapval';
						} else {
							// if type is prefixed, create type prefix
							if ($tt_ns != '' && $tt_ns == $this->namespaces['xsd']){
								 $array_typename = 'xsd:' . $tt;
							} elseif ($tt_ns) {
								$tt_prefix = 'ns' . rand(1000, 9999);
								$array_typename = "$tt_prefix:$tt";
								$xmlns .= " xmlns:$tt_prefix=\"$tt_ns\"";
							} else {
								$array_typename = $tt;
							}
						}
						$array_type = $i;
						if ($use == 'literal') {
							$type_str = '';
						} else if (isset($type) && isset($type_prefix)) {
							$type_str = " xsi:type=\"$type_prefix:$type\"";
						} else {
							$type_str = " xsi:type=\"SOAP-ENC:Array\" SOAP-ENC:arrayType=\"".$array_typename."[$array_type]\"";
						}
					// empty array
					} else {
						if ($use == 'literal') {
							$type_str = '';
						} else if (isset($type) && isset($type_prefix)) {
							$type_str = " xsi:type=\"$type_prefix:$type\"";
						} else {
							$type_str = " xsi:type=\"SOAP-ENC:Array\"";
						}
					}
					$xml = "<$name$xmlns$type_str$atts>".$xml."</$name>";
				} else {
					// got a struct
					if(isset($type) && isset($type_prefix)){
						$type_str = " xsi:type=\"$type_prefix:$type\"";
					} else {
						$type_str = '';
					}
					if ($use == 'literal') {
						$xml .= "<$name$xmlns $atts>";
					} else {
						$xml .= "<$name$xmlns$type_str$atts>";
					}
					foreach($val as $k => $v){
						// Apache Map
						if ($type == 'Map' && $type_ns == 'http://xml.apache.org/xml-soap') {
							$xml .= '<item>';
							$xml .= $this->serialize_val($k,'key',false,false,false,false,$use);
							$xml .= $this->serialize_val($v,'value',false,false,false,false,$use);
							$xml .= '</item>';
						} else {
							$xml .= $this->serialize_val($v,$k,false,false,false,false,$use);
						}
					}
					$xml .= "</$name>";
				}
				break;
			default:
				$xml .= 'not detected, got '.gettype($val).' for '.$val;
				break;
		}
		return $xml;
	}

    /**
    * serialize message
    *
    * @param string body
    * @param string headers optional
    * @param array namespaces optional
    * @param string style optional (rpc|document)
    * @param string use optional (encoded|literal)
    * @return string message
    * @access public
    */
    function serializeEnvelope($body,$headers=false,$namespaces=array(),$style='rpc',$use='encoded'){
    // TODO: add an option to automatically run utf8_encode on $body and $headers
    // if $this->soap_defencoding is UTF-8.  Not doing this automatically allows
    // one to send arbitrary UTF-8 characters, not just characters that map to ISO-8859-1

	// serialize namespaces
    $ns_string = '';
	foreach(array_merge($this->namespaces,$namespaces) as $k => $v){
		$ns_string .= " xmlns:$k=\"$v\"";
	}
	if($style == 'rpc' && $use == 'encoded') {
		$ns_string = ' SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"' . $ns_string;
	}

	// serialize headers
	if($headers){
		$headers = "<SOAP-ENV:Header>".$headers."</SOAP-ENV:Header>";
	}
	// serialize envelope
	return
	'<?xml version="1.0" encoding="'.$this->soap_defencoding .'"?'.">".
	'<SOAP-ENV:Envelope'.$ns_string.">".
	$headers.
	"<SOAP-ENV:Body>".
		$body.
	"</SOAP-ENV:Body>".
	"</SOAP-ENV:Envelope>";
    }

    function formatDump($str){
		$str = htmlspecialchars($str);
		return nl2br($str);
    }

	/**
	* contracts a qualified name
	*
	* @param    string $string qname
	* @return	string contracted qname
	* @access   private
	*/
	function contractQname($qname){
		// get element namespace
		//$this->xdebug("Contract $qname");
		if (strrpos($qname, ':')) {
			// get unqualified name
			$name = substr($qname, strrpos($qname, ':') + 1);
			// get ns
			$ns = substr($qname, 0, strrpos($qname, ':'));
			$p = $this->getPrefixFromNamespace($ns);
			if ($p) {
				return $p . ':' . $name;
			}
			return $qname;
		} else {
			return $qname;
		}
	}

	/**
	* expands a qualified name
	*
	* @param    string $string qname
	* @return	string expanded qname
	* @access   private
	*/
	function expandQname($qname){
		// get element prefix
		if(strpos($qname,':') && !ereg('^http://',$qname)){
			// get unqualified name
			$name = substr(strstr($qname,':'),1);
			// get ns prefix
			$prefix = substr($qname,0,strpos($qname,':'));
			if(isset($this->namespaces[$prefix])){
				return $this->namespaces[$prefix].':'.$name;
			} else {
				return $qname;
			}
		} else {
			return $qname;
		}
	}

    /**
    * returns the local part of a prefixed string
    * returns the original string, if not prefixed
    *
    * @param string
    * @return string
    * @access public
    */
	function getLocalPart($str){
		if($sstr = strrchr($str,':')){
			// get unqualified name
			return substr( $sstr, 1 );
		} else {
			return $str;
		}
	}

	/**
    * returns the prefix part of a prefixed string
    * returns false, if not prefixed
    *
    * @param string
    * @return mixed
    * @access public
    */
	function getPrefix($str){
		if($pos = strrpos($str,':')){
			// get prefix
			return substr($str,0,$pos);
		}
		return false;
	}

	/**
    * pass it a prefix, it returns a namespace
	* returns false if no namespace registered with the given prefix
    *
    * @param string
    * @return mixed
    * @access public
    */
	function getNamespaceFromPrefix($prefix){
		if (isset($this->namespaces[$prefix])) {
			return $this->namespaces[$prefix];
		}
		//$this->setError("No namespace registered for prefix '$prefix'");
		return false;
	}

	/**
    * returns the prefix for a given namespace (or prefix)
    * or false if no prefixes registered for the given namespace
    *
    * @param string
    * @return mixed
    * @access public
    */
	function getPrefixFromNamespace($ns) {
		foreach ($this->namespaces as $p => $n) {
			if ($ns == $n || $ns == $p) {
			    $this->usedNamespaces[$p] = $n;
				return $p;
			}
		}
		return false;
	}

	/**
    * returns the time in ODBC canonical form with microseconds
    *
    * @return string
    * @access public
    */
	function getmicrotime() {
		if (function_exists('gettimeofday')) {
			$tod = gettimeofday();
			$sec = $tod['sec'];
			$usec = $tod['usec'];
		} else {
			$sec = time();
			$usec = 0;
		}
		return strftime('%Y-%m-%d %H:%M:%S', $sec) . '.' . sprintf('%06d', $usec);
	}

    function varDump($data) {
		ob_start();
		var_dump($data);
		$ret_val = ob_get_contents();
		ob_end_clean();
		return $ret_val;
	}
}

// XML Schema Datatype Helper Functions

//xsd:dateTime helpers

/**
* convert unix timestamp to ISO 8601 compliant date string
*
* @param    string $timestamp Unix time stamp
* @access   public
*/
function timestamp_to_iso8601($timestamp,$utc=true){
	$datestr = date('Y-m-d\TH:i:sO',$timestamp);
	if($utc){
		$eregStr =
		'([0-9]{4})-'.	// centuries & years CCYY-
		'([0-9]{2})-'.	// months MM-
		'([0-9]{2})'.	// days DD
		'T'.			// separator T
		'([0-9]{2}):'.	// hours hh:
		'([0-9]{2}):'.	// minutes mm:
		'([0-9]{2})(\.[0-9]*)?'. // seconds ss.ss...
		'(Z|[+\-][0-9]{2}:?[0-9]{2})?'; // Z to indicate UTC, -/+HH:MM:SS.SS... for local tz's

		if(ereg($eregStr,$datestr,$regs)){
			return sprintf('%04d-%02d-%02dT%02d:%02d:%02dZ',$regs[1],$regs[2],$regs[3],$regs[4],$regs[5],$regs[6]);
		}
		return false;
	} else {
		return $datestr;
	}
}

/**
* convert ISO 8601 compliant date string to unix timestamp
*
* @param    string $datestr ISO 8601 compliant date string
* @access   public
*/
function iso8601_to_timestamp($datestr){
	$eregStr =
	'([0-9]{4})-'.	// centuries & years CCYY-
	'([0-9]{2})-'.	// months MM-
	'([0-9]{2})'.	// days DD
	'T'.			// separator T
	'([0-9]{2}):'.	// hours hh:
	'([0-9]{2}):'.	// minutes mm:
	'([0-9]{2})(\.[0-9]+)?'. // seconds ss.ss...
	'(Z|[+\-][0-9]{2}:?[0-9]{2})?'; // Z to indicate UTC, -/+HH:MM:SS.SS... for local tz's
	if(ereg($eregStr,$datestr,$regs)){
		// not utc
		if($regs[8] != 'Z'){
			$op = substr($regs[8],0,1);
			$h = substr($regs[8],1,2);
			$m = substr($regs[8],strlen($regs[8])-2,2);
			if($op == '-'){
				$regs[4] = $regs[4] + $h;
				$regs[5] = $regs[5] + $m;
			} elseif($op == '+'){
				$regs[4] = $regs[4] - $h;
				$regs[5] = $regs[5] - $m;
			}
		}
		return strtotime("$regs[1]-$regs[2]-$regs[3] $regs[4]:$regs[5]:$regs[6]Z");
	} else {
		return false;
	}
}

function usleepWindows($usec)
{
	$start = gettimeofday();
	
	do
	{
		$stop = gettimeofday();
		$timePassed = 1000000 * ($stop['sec'] - $start['sec'])
		+ $stop['usec'] - $start['usec'];
	}
	while ($timePassed < $usec);
}

?><?php



/**
* soap_fault class, allows for creation of faults
* mainly used for returning faults from deployed functions
* in a server instance.
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access public
*/
class soap_fault extends nusoap_base {

	var $faultcode;
	var $faultactor;
	var $faultstring;
	var $faultdetail;

	/**
	* constructor
    *
    * @param string $faultcode (client | server)
    * @param string $faultactor only used when msg routed between multiple actors
    * @param string $faultstring human readable error message
    * @param string $faultdetail
	*/
	function soap_fault($faultcode,$faultactor='',$faultstring='',$faultdetail=''){
		$this->faultcode = $faultcode;
		$this->faultactor = $faultactor;
		$this->faultstring = $faultstring;
		$this->faultdetail = $faultdetail;
	}

	/**
	* serialize a fault
	*
	* @access   public
	*/
	function serialize(){
		$ns_string = '';
		foreach($this->namespaces as $k => $v){
			$ns_string .= "\n  xmlns:$k=\"$v\"";
		}
		$return_msg =
			'<?xml version="1.0" encoding="'.$this->soap_defencoding.'"?>'.
			'<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"'.$ns_string.">\n".
				'<SOAP-ENV:Body>'.
				'<SOAP-ENV:Fault>'.
					'<faultcode>'.$this->expandEntities($this->faultcode).'</faultcode>'.
					'<faultactor>'.$this->expandEntities($this->faultactor).'</faultactor>'.
					'<faultstring>'.$this->expandEntities($this->faultstring).'</faultstring>'.
					'<detail>'.$this->serialize_val($this->faultdetail).'</detail>'.
				'</SOAP-ENV:Fault>'.
				'</SOAP-ENV:Body>'.
			'</SOAP-ENV:Envelope>';
		return $return_msg;
	}
}



?><?php



/**
* parses an XML Schema, allows access to it's data, other utility methods
* no validation... yet.
* very experimental and limited. As is discussed on XML-DEV, I'm one of the people
* that just doesn't have time to read the spec(s) thoroughly, and just have a couple of trusty
* tutorials I refer to :)
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class XMLSchema extends nusoap_base  {
	
	// files
	var $schema = '';
	var $xml = '';
	// namespaces
	var $enclosingNamespaces;
	// schema info
	var $schemaInfo = array();
	var $schemaTargetNamespace = '';
	// types, elements, attributes defined by the schema
	var $attributes = array();
	var $complexTypes = array();
	var $currentComplexType = false;
	var $elements = array();
	var $currentElement = false;
	var $simpleTypes = array();
	var $currentSimpleType = false;
	// imports
	var $imports = array();
	// parser vars
	var $parser;
	var $position = 0;
	var $depth = 0;
	var $depth_array = array();
	var $message = array();
	var $defaultNamespace = array();
    
	/**
	* constructor
	*
	* @param    string $schema schema document URI
	* @param    string $xml xml document URI
	* @param	string $namespaces namespaces defined in enclosing XML
	* @access   public
	*/
	function XMLSchema($schema='',$xml='',$namespaces=array()){

		$this->debug('xmlschema class instantiated, inside constructor');
		// files
		$this->schema = $schema;
		$this->xml = $xml;

		// namespaces
		$this->enclosingNamespaces = $namespaces;
		$this->namespaces = array_merge($this->namespaces, $namespaces);

		// parse schema file
		if($schema != ''){
			$this->debug('initial schema file: '.$schema);
			$this->parseFile($schema, 'schema');
		}

		// parse xml file
		if($xml != ''){
			$this->debug('initial xml file: '.$xml);
			$this->parseFile($xml, 'xml');
		}

	}

    /**
    * parse an XML file
    *
    * @param string $xml, path/URL to XML file
    * @param string $type, (schema | xml)
	* @return boolean
    * @access public
    */
	function parseFile($xml,$type){
		// parse xml file
		if($xml != ""){
			$xmlStr = @join("",@file($xml));
			if($xmlStr == ""){
				$msg = 'Error reading XML from '.$xml;
				$this->setError($msg);
				$this->debug($msg);
			return false;
			} else {
				$this->debug("parsing $xml");
				$this->parseString($xmlStr,$type);
				$this->debug("done parsing $xml");
			return true;
			}
		}
		return false;
	}

	/**
	* parse an XML string
	*
	* @param    string $xml path or URL
    * @param string $type, (schema|xml)
	* @access   private
	*/
	function parseString($xml,$type){
		// parse xml string
		if($xml != ""){

	    	// Create an XML parser.
	    	$this->parser = xml_parser_create();
	    	// Set the options for parsing the XML data.
	    	xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);

	    	// Set the object for the parser.
	    	xml_set_object($this->parser, $this);

	    	// Set the element handlers for the parser.
			if($type == "schema"){
		    	xml_set_element_handler($this->parser, 'schemaStartElement','schemaEndElement');
		    	xml_set_character_data_handler($this->parser,'schemaCharacterData');
			} elseif($type == "xml"){
				xml_set_element_handler($this->parser, 'xmlStartElement','xmlEndElement');
		    	xml_set_character_data_handler($this->parser,'xmlCharacterData');
			}

		    // Parse the XML file.
		    if(!xml_parse($this->parser,$xml,true)){
			// Display an error message.
				$errstr = sprintf('XML error parsing XML schema on line %d: %s',
				xml_get_current_line_number($this->parser),
				xml_error_string(xml_get_error_code($this->parser))
				);
				$this->debug($errstr);
				$this->debug("XML payload:\n" . $xml);
				$this->setError($errstr);
	    	}
            
			xml_parser_free($this->parser);
		} else{
			$this->debug('no xml passed to parseString()!!');
			$this->setError('no xml passed to parseString()!!');
		}
	}

	/**
	* start-element handler
	*
	* @param    string $parser XML parser object
	* @param    string $name element name
	* @param    string $attrs associative array of attributes
	* @access   private
	*/
	function schemaStartElement($parser, $name, $attrs) {
		
		// position in the total number of elements, starting from 0
		$pos = $this->position++;
		$depth = $this->depth++;
		// set self as current value for this depth
		$this->depth_array[$depth] = $pos;
		$this->message[$pos] = array('cdata' => ''); 
		if ($depth > 0) {
			$this->defaultNamespace[$pos] = $this->defaultNamespace[$this->depth_array[$depth - 1]];
		} else {
			$this->defaultNamespace[$pos] = false;
		}

		// get element prefix
		if($prefix = $this->getPrefix($name)){
			// get unqualified name
			$name = $this->getLocalPart($name);
		} else {
        	$prefix = '';
        }
		
        // loop thru attributes, expanding, and registering namespace declarations
        if(count($attrs) > 0){
        	foreach($attrs as $k => $v){
                // if ns declarations, add to class level array of valid namespaces
				if(ereg("^xmlns",$k)){
                	//$this->xdebug("$k: $v");
                	//$this->xdebug('ns_prefix: '.$this->getPrefix($k));
                	if($ns_prefix = substr(strrchr($k,':'),1)){
                		//$this->xdebug("Add namespace[$ns_prefix] = $v");
						$this->namespaces[$ns_prefix] = $v;
					} else {
						$this->defaultNamespace[$pos] = $v;
						if (! $this->getPrefixFromNamespace($v)) {
							$this->namespaces['ns'.(count($this->namespaces)+1)] = $v;
						}
					}
					if($v == 'http://www.w3.org/2001/XMLSchema' || $v == 'http://www.w3.org/1999/XMLSchema'){
						$this->XMLSchemaVersion = $v;
						$this->namespaces['xsi'] = $v.'-instance';
					}
				}
        	}
        	foreach($attrs as $k => $v){
                // expand each attribute
                $k = strpos($k,':') ? $this->expandQname($k) : $k;
                $v = strpos($v,':') ? $this->expandQname($v) : $v;
        		$eAttrs[$k] = $v;
        	}
        	$attrs = $eAttrs;
        } else {
        	$attrs = array();
        }
		// find status, register data
		switch($name){
			case 'all':
			case 'choice':
			case 'sequence':
				//$this->xdebug("compositor $name for currentComplexType: $this->currentComplexType and currentElement: $this->currentElement");
				$this->complexTypes[$this->currentComplexType]['compositor'] = $name;
				if($name == 'all' || $name == 'sequence'){
					$this->complexTypes[$this->currentComplexType]['phpType'] = 'struct';
				}
			break;
			case 'attribute':
            	//$this->xdebug("parsing attribute $attrs[name] $attrs[ref] of value: ".$attrs['http://schemas.xmlsoap.org/wsdl/:arrayType']);
            	$this->xdebug("parsing attribute:");
            	$this->appendDebug($this->varDump($attrs));
            	if (isset($attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'])) {
					$v = $attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'];
					if (!strpos($v, ':')) {
						// no namespace in arrayType attribute value...
						if ($this->defaultNamespace[$pos]) {
							// ...so use the default
							$attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'] = $this->defaultNamespace[$pos] . ':' . $attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'];
						}
					}
            	}
                if(isset($attrs['name'])){
					$this->attributes[$attrs['name']] = $attrs;
					$aname = $attrs['name'];
				} elseif(isset($attrs['ref']) && $attrs['ref'] == 'http://schemas.xmlsoap.org/soap/encoding/:arrayType'){
					if (isset($attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'])) {
	                	$aname = $attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'];
	                } else {
	                	$aname = '';
	                }
				} elseif(isset($attrs['ref'])){
					$aname = $attrs['ref'];
                    $this->attributes[$attrs['ref']] = $attrs;
				}
                
				if(isset($this->currentComplexType)){
					$this->complexTypes[$this->currentComplexType]['attrs'][$aname] = $attrs;
				} elseif(isset($this->currentElement)){
					$this->elements[$this->currentElement]['attrs'][$aname] = $attrs;
				}
				// arrayType attribute
				if(isset($attrs['http://schemas.xmlsoap.org/wsdl/:arrayType']) || $this->getLocalPart($aname) == 'arrayType'){
					$this->complexTypes[$this->currentComplexType]['phpType'] = 'array';
                	$prefix = $this->getPrefix($aname);
					if(isset($attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'])){
						$v = $attrs['http://schemas.xmlsoap.org/wsdl/:arrayType'];
					} else {
						$v = '';
					}
                    if(strpos($v,'[,]')){
                        $this->complexTypes[$this->currentComplexType]['multidimensional'] = true;
                    }
                    $v = substr($v,0,strpos($v,'[')); // clip the []
                    if(!strpos($v,':') && isset($this->typemap[$this->XMLSchemaVersion][$v])){
                        $v = $this->XMLSchemaVersion.':'.$v;
                    }
                    $this->complexTypes[$this->currentComplexType]['arrayType'] = $v;
				}
			break;
			case 'complexType':
				if(isset($attrs['name'])){
					$this->xdebug('processing named complexType '.$attrs['name']);
					$this->currentElement = false;
					$this->currentComplexType = $attrs['name'];
					$this->complexTypes[$this->currentComplexType] = $attrs;
					$this->complexTypes[$this->currentComplexType]['typeClass'] = 'complexType';
					if(isset($attrs['base']) && ereg(':Array$',$attrs['base'])){
						$this->complexTypes[$this->currentComplexType]['phpType'] = 'array';
					} else {
						$this->complexTypes[$this->currentComplexType]['phpType'] = 'struct';
					}
				}else{
					$this->xdebug('processing unnamed complexType for element '.$this->currentElement);
					$this->currentComplexType = $this->currentElement . '_ContainedType';
					$this->currentElement = false;
					$this->complexTypes[$this->currentComplexType] = $attrs;
					$this->complexTypes[$this->currentComplexType]['typeClass'] = 'complexType';
					if(isset($attrs['base']) && ereg(':Array$',$attrs['base'])){
						$this->complexTypes[$this->currentComplexType]['phpType'] = 'array';
					} else {
						$this->complexTypes[$this->currentComplexType]['phpType'] = 'struct';
					}
				}
			break;
			case 'element':
				// elements defined as part of a complex type should
				// not really be added to $this->elements, but for some
				// reason, they are
				if(isset($attrs['type'])){
					$this->xdebug("processing typed element ".$attrs['name']." of type ".$attrs['type']);
					if (! $this->getPrefix($attrs['type'])) {
						if ($this->defaultNamespace[$pos]) {
							$attrs['type'] = $this->defaultNamespace[$pos] . ':' . $attrs['type'];
							$this->xdebug('used default namespace to make type ' . $attrs['type']);
						}
					}
					$this->currentElement = $attrs['name'];
					$this->elements[ $attrs['name'] ] = $attrs;
					$this->elements[ $attrs['name'] ]['typeClass'] = 'element';
					if (!isset($this->elements[ $attrs['name'] ]['form'])) {
						$this->elements[ $attrs['name'] ]['form'] = $this->schemaInfo['elementFormDefault'];
					}
					$ename = $attrs['name'];
				} elseif(isset($attrs['ref'])){
					$ename = $this->getLocalPart($attrs['ref']);
				} else {
					$this->xdebug("processing untyped element ".$attrs['name']);
					$this->currentElement = $attrs['name'];
					$this->elements[ $attrs['name'] ] = $attrs;
					$this->elements[ $attrs['name'] ]['typeClass'] = 'element';
					$attrs['type'] = $this->schemaTargetNamespace . ':' . $attrs['name'] . '_ContainedType';
					$this->elements[ $attrs['name'] ]['type'] = $attrs['type'];
					if (!isset($this->elements[ $attrs['name'] ]['form'])) {
						$this->elements[ $attrs['name'] ]['form'] = $this->schemaInfo['elementFormDefault'];
					}
					$ename = $attrs['name'];
				}
				if(isset($ename) && $this->currentComplexType){
					$this->complexTypes[$this->currentComplexType]['elements'][$ename] = $attrs;
				}
			break;
			// we ignore enumeration values
			//case 'enumeration':
			//break;
			case 'import':
			    if (isset($attrs['schemaLocation'])) {
					//$this->xdebug('import namespace ' . $attrs['namespace'] . ' from ' . $attrs['schemaLocation']);
                    $this->imports[$attrs['namespace']][] = array('location' => $attrs['schemaLocation'], 'loaded' => false);
				} else {
					//$this->xdebug('import namespace ' . $attrs['namespace']);
                    $this->imports[$attrs['namespace']][] = array('location' => '', 'loaded' => true);
					if (! $this->getPrefixFromNamespace($attrs['namespace'])) {
						$this->namespaces['ns'.(count($this->namespaces)+1)] = $attrs['namespace'];
					}
				}
			break;
			case 'extension':
				if ($this->currentComplexType) {
					$this->complexTypes[$this->currentComplexType]['extensionBase'] = $attrs['base'];
				}
			break;
			case 'restriction':
				//$this->xdebug("in restriction for currentComplexType: $this->currentComplexType and currentElement: $this->currentElement");
				if($this->currentElement){
					$this->elements[$this->currentElement]['type'] = $attrs['base'];
				} elseif($this->currentSimpleType){
					$this->simpleTypes[$this->currentSimpleType]['type'] = $attrs['base'];
				} elseif($this->currentComplexType){
					$this->complexTypes[$this->currentComplexType]['restrictionBase'] = $attrs['base'];
					if(strstr($attrs['base'],':') == ':Array'){
						$this->complexTypes[$this->currentComplexType]['phpType'] = 'array';
					}
				}
			break;
			case 'schema':
				$this->schemaInfo = $attrs;
				$this->schemaInfo['schemaVersion'] = $this->getNamespaceFromPrefix($prefix);
				if (isset($attrs['targetNamespace'])) {
					$this->schemaTargetNamespace = $attrs['targetNamespace'];
				}
				if (!isset($attrs['elementFormDefault'])) {
					$this->schemaInfo['elementFormDefault'] = 'unqualified';
				}
			break;
			case 'simpleType':
				if(isset($attrs['name'])){
					$this->xdebug("processing simpleType for name " . $attrs['name']);
					$this->currentSimpleType = $attrs['name'];
					$this->simpleTypes[ $attrs['name'] ] = $attrs;
					$this->simpleTypes[ $attrs['name'] ]['typeClass'] = 'simpleType';
					$this->simpleTypes[ $attrs['name'] ]['phpType'] = 'scalar';
				} else {
					$this->xdebug('processing unnamed simpleType for element '.$this->currentElement);
					$this->currentSimpleType = $this->currentElement . '_ContainedType';
					$this->currentElement = false;
					$this->simpleTypes[$this->currentSimpleType] = $attrs;
					$this->simpleTypes[$this->currentSimpleType]['phpType'] = 'scalar';
				}
			break;
			default:
				//$this->xdebug("do not have anything to do for element $name");
		}
	}

	/**
	* end-element handler
	*
	* @param    string $parser XML parser object
	* @param    string $name element name
	* @access   private
	*/
	function schemaEndElement($parser, $name) {
		// bring depth down a notch
		$this->depth--;
		// position of current element is equal to the last value left in depth_array for my depth
		if(isset($this->depth_array[$this->depth])){
        	$pos = $this->depth_array[$this->depth];
        }
		// move on...
		if($name == 'complexType'){
			$this->currentComplexType = false;
			$this->currentElement = false;
		}
		if($name == 'element'){
			$this->currentElement = false;
		}
		if($name == 'simpleType'){
			$this->currentSimpleType = false;
		}
	}

	/**
	* element content handler
	*
	* @param    string $parser XML parser object
	* @param    string $data element content
	* @access   private
	*/
	function schemaCharacterData($parser, $data){
		$pos = $this->depth_array[$this->depth - 1];
		$this->message[$pos]['cdata'] .= $data;
	}

	/**
	* serialize the schema
	*
	* @access   public
	*/
	function serializeSchema(){

		$schemaPrefix = $this->getPrefixFromNamespace($this->XMLSchemaVersion);
		$xml = '';
		// imports
		if (sizeof($this->imports) > 0) {
			foreach($this->imports as $ns => $list) {
				foreach ($list as $ii) {
					if ($ii['location'] != '') {
						$xml .= " <$schemaPrefix:import location=\"" . $ii['location'] . '" namespace="' . $ns . "\" />\n";
					} else {
						$xml .= " <$schemaPrefix:import namespace=\"" . $ns . "\" />\n";
					}
				}
			} 
		} 
		// complex types
		foreach($this->complexTypes as $typeName => $attrs){
			$contentStr = '';
			// serialize child elements
			if(isset($attrs['elements']) && (count($attrs['elements']) > 0)){
				foreach($attrs['elements'] as $element => $eParts){
					if(isset($eParts['ref'])){
						$contentStr .= "   <$schemaPrefix:element ref=\"$element\"/>\n";
					} else {
						$contentStr .= "   <$schemaPrefix:element name=\"$element\" type=\"" . $this->contractQName($eParts['type']) . "\"";
						foreach ($eParts as $aName => $aValue) {
							// handle, e.g., abstract, default, form, minOccurs, maxOccurs, nillable
							if ($aName != 'name' && $aName != 'type') {
								$contentStr .= " $aName=\"$aValue\"";
							}
						}
						$contentStr .= "/>\n";
					}
				}
			}
			// attributes
			if(isset($attrs['attrs']) && (count($attrs['attrs']) >= 1)){
				foreach($attrs['attrs'] as $attr => $aParts){
					$contentStr .= "    <$schemaPrefix:attribute ref=\"".$this->contractQName($aParts['ref']).'"';
					if(isset($aParts['http://schemas.xmlsoap.org/wsdl/:arrayType'])){
						$this->usedNamespaces['wsdl'] = $this->namespaces['wsdl'];
						$contentStr .= ' wsdl:arrayType="'.$this->contractQName($aParts['http://schemas.xmlsoap.org/wsdl/:arrayType']).'"';
					}
					$contentStr .= "/>\n";
				}
			}
			// if restriction
			if( isset($attrs['restrictionBase']) && $attrs['restrictionBase'] != ''){
				$contentStr = "   <$schemaPrefix:restriction base=\"".$this->contractQName($attrs['restrictionBase'])."\">\n".$contentStr."   </$schemaPrefix:restriction>\n";
			}
			// compositor obviates complex/simple content
			if(isset($attrs['compositor']) && ($attrs['compositor'] != '')){
				$contentStr = "  <$schemaPrefix:$attrs[compositor]>\n".$contentStr."  </$schemaPrefix:$attrs[compositor]>\n";
			}
			// complex or simple content
			elseif((isset($attrs['elements']) && count($attrs['elements']) > 0) || (isset($attrs['attrs']) && count($attrs['attrs']) > 0)){
				$contentStr = "  <$schemaPrefix:complexContent>\n".$contentStr."  </$schemaPrefix:complexContent>\n";
			}
			// finalize complex type
			if($contentStr != ''){
				$contentStr = " <$schemaPrefix:complexType name=\"$typeName\">\n".$contentStr." </$schemaPrefix:complexType>\n";
			} else {
				$contentStr = " <$schemaPrefix:complexType name=\"$typeName\"/>\n";
			}
			$xml .= $contentStr;
		}
		// simple types
		if(isset($this->simpleTypes) && count($this->simpleTypes) > 0){
			foreach($this->simpleTypes as $typeName => $attr){
				$xml .= " <$schemaPrefix:simpleType name=\"$typeName\">\n  <$schemaPrefix:restriction base=\"".$this->contractQName($eParts['type'])."\"/>\n </$schemaPrefix:simpleType>";
			}
		}
		// elements
		if(isset($this->elements) && count($this->elements) > 0){
			foreach($this->elements as $element => $eParts){
				$xml .= " <$schemaPrefix:element name=\"$element\" type=\"".$this->contractQName($eParts['type'])."\"/>\n";
			}
		}
		// attributes
		if(isset($this->attributes) && count($this->attributes) > 0){
			foreach($this->attributes as $attr => $aParts){
				$xml .= " <$schemaPrefix:attribute name=\"$attr\" type=\"".$this->contractQName($aParts['type'])."\"\n/>";
			}
		}
		// finish 'er up
		$el = "<$schemaPrefix:schema targetNamespace=\"$this->schemaTargetNamespace\"\n";
		foreach (array_diff($this->usedNamespaces, $this->enclosingNamespaces) as $nsp => $ns) {
			$el .= " xmlns:$nsp=\"$ns\"\n";
		}
		$xml = $el . ">\n".$xml."</$schemaPrefix:schema>\n";
		return $xml;
	}

	/**
	* adds debug data to the clas level debug string
	*
	* @param    string $string debug data
	* @access   private
	*/
	function xdebug($string){
		$this->debug('<' . $this->schemaTargetNamespace . '> '.$string);
	}

    /**
    * get the PHP type of a user defined type in the schema
    * PHP type is kind of a misnomer since it actually returns 'struct' for assoc. arrays
    * returns false if no type exists, or not w/ the given namespace
    * else returns a string that is either a native php type, or 'struct'
    *
    * @param string $type, name of defined type
    * @param string $ns, namespace of type
    * @return mixed
    * @access public
    */
	function getPHPType($type,$ns){
		if(isset($this->typemap[$ns][$type])){
			//print "found type '$type' and ns $ns in typemap<br>";
			return $this->typemap[$ns][$type];
		} elseif(isset($this->complexTypes[$type])){
			//print "getting type '$type' and ns $ns from complexTypes array<br>";
			return $this->complexTypes[$type]['phpType'];
		}
		return false;
	}

	/**
    * returns an array of information about a given type
    * returns false if no type exists by the given name
    *
	*	 typeDef = array(
	*	 'elements' => array(), // refs to elements array
	*	'restrictionBase' => '',
	*	'phpType' => '',
	*	'order' => '(sequence|all)',
	*	'attrs' => array() // refs to attributes array
	*	)
    *
    * @param string
    * @return mixed
    * @access public
    */
	function getTypeDef($type){
		//$this->debug("in getTypeDef for type $type");
		if(isset($this->complexTypes[$type])){
			$this->xdebug("in getTypeDef, found complexType $type");
			return $this->complexTypes[$type];
		} elseif(isset($this->simpleTypes[$type])){
			$this->xdebug("in getTypeDef, found simpleType $type");
			if (!isset($this->simpleTypes[$type]['phpType'])) {
				// get info for type to tack onto the simple type
				// TODO: can this ever really apply (i.e. what is a simpleType really?)
				$uqType = substr($this->simpleTypes[$type]['type'], strrpos($this->simpleTypes[$type]['type'], ':') + 1);
				$ns = substr($this->simpleTypes[$type]['type'], 0, strrpos($this->simpleTypes[$type]['type'], ':'));
				$etype = $this->getTypeDef($uqType);
				if ($etype) {
					if (isset($etype['phpType'])) {
						$this->simpleTypes[$type]['phpType'] = $etype['phpType'];
					}
					if (isset($etype['elements'])) {
						$this->simpleTypes[$type]['elements'] = $etype['elements'];
					}
				}
			}
			return $this->simpleTypes[$type];
		} elseif(isset($this->elements[$type])){
			$this->xdebug("in getTypeDef, found element $type");
			if (!isset($this->elements[$type]['phpType'])) {
				// get info for type to tack onto the element
				$uqType = substr($this->elements[$type]['type'], strrpos($this->elements[$type]['type'], ':') + 1);
				$ns = substr($this->elements[$type]['type'], 0, strrpos($this->elements[$type]['type'], ':'));
				$etype = $this->getTypeDef($uqType);
				if ($etype) {
					if (isset($etype['phpType'])) {
						$this->elements[$type]['phpType'] = $etype['phpType'];
					}
					if (isset($etype['elements'])) {
						$this->elements[$type]['elements'] = $etype['elements'];
					}
				} elseif ($ns == 'http://www.w3.org/2001/XMLSchema') {
					$this->elements[$type]['phpType'] = 'scalar';
				}
			}
			return $this->elements[$type];
		} elseif(isset($this->attributes[$type])){
			$this->xdebug("in getTypeDef, found attribute $type");
			return $this->attributes[$type];
		}
		$this->xdebug("in getTypeDef, did not find $type");
		return false;
	}

	/**
    * returns a sample serialization of a given type, or false if no type by the given name
    *
    * @param string $type, name of type
    * @return mixed
    * @access public
    */
    function serializeTypeDef($type){
    	//print "in sTD() for type $type<br>";
	if($typeDef = $this->getTypeDef($type)){
		$str .= '<'.$type;
	    if(is_array($typeDef['attrs'])){
		foreach($attrs as $attName => $data){
		    $str .= " $attName=\"{type = ".$data['type']."}\"";
		}
	    }
	    $str .= " xmlns=\"".$this->schema['targetNamespace']."\"";
	    if(count($typeDef['elements']) > 0){
		$str .= ">";
		foreach($typeDef['elements'] as $element => $eData){
		    $str .= $this->serializeTypeDef($element);
		}
		$str .= "</$type>";
	    } elseif($typeDef['typeClass'] == 'element') {
		$str .= "></$type>";
	    } else {
		$str .= "/>";
	    }
			return $str;
	}
    	return false;
    }

    /**
    * returns HTML form elements that allow a user
    * to enter values for creating an instance of the given type.
    *
    * @param string $name, name for type instance
    * @param string $type, name of type
    * @return string
    * @access public
	*/
	function typeToForm($name,$type){
		// get typedef
		if($typeDef = $this->getTypeDef($type)){
			// if struct
			if($typeDef['phpType'] == 'struct'){
				$buffer .= '<table>';
				foreach($typeDef['elements'] as $child => $childDef){
					$buffer .= "
					<tr><td align='right'>$childDef[name] (type: ".$this->getLocalPart($childDef['type'])."):</td>
					<td><input type='text' name='parameters[".$name."][$childDef[name]]'></td></tr>";
				}
				$buffer .= '</table>';
			// if array
			} elseif($typeDef['phpType'] == 'array'){
				$buffer .= '<table>';
				for($i=0;$i < 3; $i++){
					$buffer .= "
					<tr><td align='right'>array item (type: $typeDef[arrayType]):</td>
					<td><input type='text' name='parameters[".$name."][]'></td></tr>";
				}
				$buffer .= '</table>';
			// if scalar
			} else {
				$buffer .= "<input type='text' name='parameters[$name]'>";
			}
		} else {
			$buffer .= "<input type='text' name='parameters[$name]'>";
		}
		return $buffer;
	}
	
	/**
	* adds a complex type to the schema
	* 
	* example: array
	* 
	* addType(
	* 	'ArrayOfstring',
	* 	'complexType',
	* 	'array',
	* 	'',
	* 	'SOAP-ENC:Array',
	* 	array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'string[]'),
	* 	'xsd:string'
	* );
	* 
	* example: PHP associative array ( SOAP Struct )
	* 
	* addType(
	* 	'SOAPStruct',
	* 	'complexType',
	* 	'struct',
	* 	'all',
	* 	array('myVar'=> array('name'=>'myVar','type'=>'string')
	* );
	* 
	* @param name
	* @param typeClass (complexType|simpleType|attribute)
	* @param phpType: currently supported are array and struct (php assoc array)
	* @param compositor (all|sequence|choice)
	* @param restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
	* @param elements = array ( name = array(name=>'',type=>'') )
	* @param attrs = array(
	* 	array(
	*		'ref' => "http://schemas.xmlsoap.org/soap/encoding/:arrayType",
	*		"http://schemas.xmlsoap.org/wsdl/:arrayType" => "string[]"
	* 	)
	* )
	* @param arrayType: namespace:name (http://www.w3.org/2001/XMLSchema:string)
	*
	*/
	function addComplexType($name,$typeClass='complexType',$phpType='array',$compositor='',$restrictionBase='',$elements=array(),$attrs=array(),$arrayType=''){
		$this->complexTypes[$name] = array(
	    'name'		=> $name,
	    'typeClass'	=> $typeClass,
	    'phpType'	=> $phpType,
		'compositor'=> $compositor,
	    'restrictionBase' => $restrictionBase,
		'elements'	=> $elements,
	    'attrs'		=> $attrs,
	    'arrayType'	=> $arrayType
		);
		
		$this->xdebug("addComplexType $name:");
		$this->appendDebug($this->varDump($this->complexTypes[$name]));
	}
	
	/**
	* adds a simple type to the schema
	*
	* @param name
	* @param restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
	* @param typeClass (simpleType)
	* @param phpType: (scalar)
	* @see xmlschema
	* 
	*/
	function addSimpleType($name, $restrictionBase='', $typeClass='simpleType', $phpType='scalar') {
		$this->simpleTypes[$name] = array(
	    'name'		=> $name,
	    'typeClass'	=> $typeClass,
	    'phpType'	=> $phpType,
	    'type' => $restrictionBase
		);
		
		$this->xdebug("addSimpleType $name:");
		$this->appendDebug($this->varDump($this->simpleTypes[$name]));
	}

	/**
	* adds an element to the schema
	*
	* @param name
	* @param array $attrs attributes that must include name and type
	* @see xmlschema
	*/
	function addElement($attrs) {
		if (! $this->getPrefix($attrs['type'])) {
			$attrs['type'] = $this->schemaTargetNamespace . ':' . $attrs['type'];
		}
		$this->elements[ $attrs['name'] ] = $attrs;
		$this->elements[ $attrs['name'] ]['typeClass'] = 'element';
		
		$this->xdebug("addElement " . $attrs['name']);
		$this->appendDebug($this->varDump($this->elements[ $attrs['name'] ]));
	}
}



?><?php



/**
* for creating serializable abstractions of native PHP types
* NOTE: this is only really used when WSDL is not available.
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class soapval extends nusoap_base {
	/**
	* constructor
	*
	* @param    string $name optional name
	* @param    string $type optional type name
	* @param	mixed $value optional value
	* @param	string $namespace optional namespace of value
	* @param	string $type_namespace optional namespace of type
	* @param	array $attributes associative array of attributes to add to element serialization
	* @access   public
	*/
  	function soapval($name='soapval',$type=false,$value=-1,$element_ns=false,$type_ns=false,$attributes=false) {
		$this->name = $name;
		$this->value = $value;
		$this->type = $type;
		$this->element_ns = $element_ns;
		$this->type_ns = $type_ns;
		$this->attributes = $attributes;
    }

	/**
	* return serialized value
	*
	* @return	string XML data
	* @access   private
	*/
	function serialize($use='encoded') {
		return $this->serialize_val($this->value,$this->name,$this->type,$this->element_ns,$this->type_ns,$this->attributes,$use);
    }

	/**
	* decodes a soapval object into a PHP native type
	*
	* @param	object $soapval optional SOAPx4 soapval object, else uses self
	* @return	mixed
	* @access   public
	*/
	function decode(){
		return $this->value;
	}
}



?><?php



/**
* transport class for sending/receiving data via HTTP and HTTPS
* NOTE: PHP must be compiled with the CURL extension for HTTPS support
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access public
*/
class soap_transport_http extends nusoap_base {

	var $url = '';
	var $uri = '';
	var $digest_uri = '';
	var $scheme = '';
	var $host = '';
	var $port = '';
	var $path = '';
	var $request_method = 'POST';
	var $protocol_version = '1.0';
	var $encoding = '';
	var $outgoing_headers = array();
	var $incoming_headers = array();
	var $incoming_cookies = array();
	var $outgoing_payload = '';
	var $incoming_payload = '';
	var $useSOAPAction = true;
	var $persistentConnection = false;
	var $ch = false;	// cURL handle
	var $username = '';
	var $password = '';
	var $authtype = '';
	var $digestRequest = array();
	var $certRequest = array();	// keys must be cainfofile, sslcertfile, sslkeyfile, passphrase
								// cainfofile: certificate authority file, e.g. '$pathToPemFiles/rootca.pem'
								// sslcertfile: SSL certificate file, e.g. '$pathToPemFiles/mycert.pem'
								// sslkeyfile: SSL key file, e.g. '$pathToPemFiles/mykey.pem'
								// passphrase: SSL key password/passphrase

	/**
	* constructor
	*/
	function soap_transport_http($url){
		$this->setURL($url);
		ereg('\$Revisio' . 'n: ([^ ]+)', $this->revision, $rev);
		$this->outgoing_headers['User-Agent'] = $this->title.'/'.$this->version.' ('.$rev[1].')';
	}

	function setURL($url) {
		$this->url = $url;

		$u = parse_url($url);
		foreach($u as $k => $v){
			$this->debug("$k = $v");
			$this->$k = $v;
		}
		
		// add any GET params to path
		if(isset($u['query']) && $u['query'] != ''){
            $this->path .= '?' . $u['query'];
		}
		
		// set default port
		if(!isset($u['port'])){
			if($u['scheme'] == 'https'){
				$this->port = 443;
			} else {
				$this->port = 80;
			}
		}
		
		$this->uri = $this->path;
		$this->digest_uri = $this->uri;
		
		// build headers
		if (!isset($u['port'])) {
			$this->outgoing_headers['Host'] = $this->host;
		} else {
			$this->outgoing_headers['Host'] = $this->host.':'.$this->port;
		}
		
		if (isset($u['user']) && $u['user'] != '') {
			$this->setCredentials(urldecode($u['user']), isset($u['pass']) ? urldecode($u['pass']) : '');
		}
	}
	
	function connect($connection_timeout=0,$response_timeout=300){
	  	// For PHP 4.3 with OpenSSL, change https scheme to ssl, then treat like
	  	// "regular" socket.
	  	// TODO: disabled for now because OpenSSL must be *compiled* in (not just
	  	//       loaded), and until PHP5 stream_get_wrappers is not available.
//	  	if ($this->scheme == 'https') {
//		  	if (version_compare(phpversion(), '4.3.0') >= 0) {
//		  		if (extension_loaded('openssl')) {
//		  			$this->scheme = 'ssl';
//		  			$this->debug('Using SSL over OpenSSL');
//		  		}
//		  	}
//		}
		$this->debug("connect connection_timeout $connection_timeout, response_timeout $response_timeout, scheme $this->scheme, host $this->host, port $this->port");
	  if ($this->scheme == 'http' || $this->scheme == 'ssl') {
		// use persistent connection
		if($this->persistentConnection && isset($this->fp) && is_resource($this->fp)){
			if (!feof($this->fp)) {
				$this->debug('Re-use persistent connection');
				return true;
			}
			fclose($this->fp);
			$this->debug('Closed persistent connection at EOF');
		}

		// munge host if using OpenSSL
		if ($this->scheme == 'ssl') {
			$host = 'ssl://' . $this->host;
		} else {
			$host = $this->host;
		}
		$this->debug('calling fsockopen with host ' . $host);

		// open socket
		if($connection_timeout > 0){
			$this->fp = @fsockopen( $host, $this->port, $this->errno, $this->error_str, $connection_timeout);
		} else {
			$this->fp = @fsockopen( $host, $this->port, $this->errno, $this->error_str);
		}
		
		// test pointer
		if(!$this->fp) {
			$msg = 'Couldn\'t open socket connection to server ' . $this->url;
			if ($this->errno) {
				$msg .= ', Error ('.$this->errno.'): '.$this->error_str;
			} else {
				$msg .= ' prior to connect().  This is often a problem looking up the host name.';
			}
			$this->debug($msg);
			$this->setError($msg);
			return false;
		}
		
		// set response timeout
		socket_set_timeout( $this->fp, $response_timeout);

		$this->debug('socket connected');
		return true;
	  } else if ($this->scheme == 'https') {
		if (!extension_loaded('curl')) {
			$this->setError('CURL Extension, or OpenSSL extension w/ PHP version >= 4.3 is required for HTTPS');
			return false;
		}
		$this->debug('connect using https');
		// init CURL
		$this->ch = curl_init();
		// set url
		$hostURL = ($this->port != '') ? "https://$this->host:$this->port" : "https://$this->host";
		// add path
		$hostURL .= $this->path;
		curl_setopt($this->ch, CURLOPT_URL, $hostURL);
		// follow location headers (re-directs)
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		// ask for headers in the response output
		curl_setopt($this->ch, CURLOPT_HEADER, 1);
		// ask for the response output as the return value
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		// encode
		// We manage this ourselves through headers and encoding
//		if(function_exists('gzuncompress')){
//			curl_setopt($this->ch, CURLOPT_ENCODING, 'deflate');
//		}
		// persistent connection
		if ($this->persistentConnection) {
			// The way we send data, we cannot use persistent connections, since
			// there will be some "junk" at the end of our request.
			//curl_setopt($this->ch, CURL_HTTP_VERSION_1_1, true);
			$this->persistentConnection = false;
			$this->outgoing_headers['Connection'] = 'close';
		}
		// set timeout (NOTE: cURL does not have separate connection and response timeouts)
		if ($connection_timeout != 0) {
			curl_setopt($this->ch, CURLOPT_TIMEOUT, $connection_timeout);
		}

		// recent versions of cURL turn on peer/host checking by default,
		// while PHP binaries are not compiled with a default location for the
		// CA cert bundle, so disable peer/host checking.
//curl_setopt($this->ch, CURLOPT_CAINFO, 'f:\php-4.3.2-win32\extensions\curl-ca-bundle.crt');		
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);

		// support client certificates (thanks Tobias Boes)
		if ($this->authtype == 'certificate') {
	        curl_setopt($this->ch, CURLOPT_CAINFO, $certRequest['cainfofile']);
	        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 1);
	        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 1);
	        curl_setopt($this->ch, CURLOPT_SSLCERT, $certRequest['sslcertfile']);
	        curl_setopt($this->ch, CURLOPT_SSLKEY, $certRequest['sslkeyfile']);
		    curl_setopt($this->ch, CURLOPT_SSLKEYPASSWD , $certRequest['passphrase']);
		}
		$this->debug('cURL connection set up');
		return true;
	  } else {
		$this->setError('Unknown scheme ' . $this->scheme);
		$this->debug('Unknown scheme ' . $this->scheme);
		return false;
	  }
	}
	
	/**
	* send the SOAP message via HTTP
	*
	* @param    string $data message data
	* @param    integer $timeout set connection timeout in seconds
	* @param	integer $response_timeout set response timeout in seconds
	* @param	array $cookies cookies to send
	* @return	string data
	* @access   public
	*/
	function send($data, $timeout=0, $response_timeout=300, $cookies=NULL) {
		
		$this->debug('entered send() with data of length: '.strlen($data));

		$this->tryagain = true;
		$tries = 0;
		while ($this->tryagain) {
			$this->tryagain = false;
			if ($tries++ < 2) {
				// make connnection
				if (!$this->connect($timeout, $response_timeout)){
					return false;
				}
				
				// send request
				if (!$this->sendRequest($data, $cookies)){
					return false;
				}
				
				// get response
				$respdata = $this->getResponse();
			} else {
				$this->setError('Too many tries to get an OK response');
			}
		}		
		$this->debug('end of send()');
		return $respdata;
	}


	/**
	* send the SOAP message via HTTPS 1.0 using CURL
	*
	* @param    string $msg message data
	* @param    integer $timeout set connection timeout in seconds
	* @param	integer $response_timeout set response timeout in seconds
	* @param	array $cookies cookies to send
	* @return	string data
	* @access   public
	*/
	function sendHTTPS($data, $timeout=0, $response_timeout=300, $cookies) {
		return $this->send($data, $timeout, $response_timeout, $cookies);
	}
	
	/**
	* if authenticating, set user credentials here
	*
	* @param    string $username
	* @param    string $password
	* @param	string $authtype (basic, digest, certificate)
	* @param	array $digestRequest (keys must be nonce, nc, realm, qop)
	* @param	array $certRequest (keys must be cainfofile, sslcertfile, sslkeyfile, passphrase)
	* @access   public
	*/
	function setCredentials($username, $password, $authtype = 'basic', $digestRequest = array(), $certRequest = array()) {
		global $_SERVER;

		$this->debug("Set credentials for authtype $authtype");
		// cf. RFC 2617
		if ($authtype == 'basic') {
			$this->outgoing_headers['Authorization'] = 'Basic '.base64_encode(str_replace(':','',$username).':'.$password);
		} elseif ($authtype == 'digest') {
			if (isset($digestRequest['nonce'])) {
				$digestRequest['nc'] = isset($digestRequest['nc']) ? $digestRequest['nc']++ : 1;
				
				// calculate the Digest hashes (calculate code based on digest implementation found at: http://www.rassoc.com/gregr/weblog/stories/2002/07/09/webServicesSecurityHttpDigestAuthenticationWithoutActiveDirectory.html)
	
				// A1 = unq(username-value) ":" unq(realm-value) ":" passwd
				$A1 = $username. ':' . $digestRequest['realm'] . ':' . $password;
	
				// H(A1) = MD5(A1)
				$HA1 = md5($A1);
	
				// A2 = Method ":" digest-uri-value
				$A2 = 'POST:' . $this->digest_uri;
	
				// H(A2)
				$HA2 =  md5($A2);
	
				// KD(secret, data) = H(concat(secret, ":", data))
				// if qop == auth:
				// request-digest  = <"> < KD ( H(A1),     unq(nonce-value)
				//                              ":" nc-value
				//                              ":" unq(cnonce-value)
				//                              ":" unq(qop-value)
				//                              ":" H(A2)
				//                            ) <">
				// if qop is missing,
				// request-digest  = <"> < KD ( H(A1), unq(nonce-value) ":" H(A2) ) > <">
	
				$unhashedDigest = '';
				$nonce = isset($digestRequest['nonce']) ? $digestRequest['nonce'] : '';
				$cnonce = $nonce;
				if ($digestRequest['qop'] != '') {
					$unhashedDigest = $HA1 . ':' . $nonce . ':' . sprintf("%08d", $digestRequest['nc']) . ':' . $cnonce . ':' . $digestRequest['qop'] . ':' . $HA2;
				} else {
					$unhashedDigest = $HA1 . ':' . $nonce . ':' . $HA2;
				}
	
				$hashedDigest = md5($unhashedDigest);
	
				$this->outgoing_headers['Authorization'] = 'Digest username="' . $username . '", realm="' . $digestRequest['realm'] . '", nonce="' . $nonce . '", uri="' . $this->digest_uri . '", cnonce="' . $cnonce . '", nc=' . sprintf("%08x", $digestRequest['nc']) . ', qop="' . $digestRequest['qop'] . '", response="' . $hashedDigest . '"';
			}
		} elseif ($authtype == 'certificate') {
			$this->certRequest = $certRequest;
		}
		$this->username = $username;
		$this->password = $password;
		$this->authtype = $authtype;
		$this->digestRequest = $digestRequest;
		
		if (isset($this->outgoing_headers['Authorization'])) {
			$this->debug('Authorization header set: ' . substr($this->outgoing_headers['Authorization'], 0, 12) . '...');
		} else {
			$this->debug('Authorization header not set');
		}
	}
	
	/**
	* set the soapaction value
	*
	* @param    string $soapaction
	* @access   public
	*/
	function setSOAPAction($soapaction) {
		$this->outgoing_headers['SOAPAction'] = '"' . $soapaction . '"';
	}
	
	/**
	* use http encoding
	*
	* @param    string $enc encoding style. supported values: gzip, deflate, or both
	* @access   public
	*/
	function setEncoding($enc='gzip, deflate'){
		$this->protocol_version = '1.1';
		$this->outgoing_headers['Accept-Encoding'] = $enc;
		if (!isset($this->outgoing_headers['Connection'])) {
			$this->outgoing_headers['Connection'] = 'close';
			$this->persistentConnection = false;
		}
		set_magic_quotes_runtime(0);
		// deprecated
		$this->encoding = $enc;
	}
	
	/**
	* set proxy info here
	*
	* @param    string $proxyhost
	* @param    string $proxyport
	* @param	string $proxyusername
	* @param	string $proxypassword
	* @access   public
	*/
	function setProxy($proxyhost, $proxyport, $proxyusername = '', $proxypassword = '') {
		$this->uri = $this->url;
		$this->host = $proxyhost;
		$this->port = $proxyport;
		if ($proxyusername != '' && $proxypassword != '') {
			$this->outgoing_headers['Proxy-Authorization'] = ' Basic '.base64_encode($proxyusername.':'.$proxypassword);
		}
	}
	
	/**
	* decode a string that is encoded w/ "chunked' transfer encoding
 	* as defined in RFC2068 19.4.6
	*
	* @param    string $buffer
	* @param    string $lb
	* @returns	string
	* @access   public
	* @deprecated
	*/
	function decodeChunked($buffer, $lb){
		// length := 0
		$length = 0;
		$new = '';
		
		// read chunk-size, chunk-extension (if any) and CRLF
		// get the position of the linebreak
		$chunkend = strpos($buffer, $lb);
		if ($chunkend == FALSE) {
			$this->debug('no linebreak found in decodeChunked');
			return $new;
		}
		$temp = substr($buffer,0,$chunkend);
		$chunk_size = hexdec( trim($temp) );
		$chunkstart = $chunkend + strlen($lb);
		// while (chunk-size > 0) {
		while ($chunk_size > 0) {
			$this->debug("chunkstart: $chunkstart chunk_size: $chunk_size");
			$chunkend = strpos( $buffer, $lb, $chunkstart + $chunk_size);
		  	
			// Just in case we got a broken connection
		  	if ($chunkend == FALSE) {
		  	    $chunk = substr($buffer,$chunkstart);
				// append chunk-data to entity-body
		    	$new .= $chunk;
		  	    $length += strlen($chunk);
		  	    break;
			}
			
		  	// read chunk-data and CRLF
		  	$chunk = substr($buffer,$chunkstart,$chunkend-$chunkstart);
		  	// append chunk-data to entity-body
		  	$new .= $chunk;
		  	// length := length + chunk-size
		  	$length += strlen($chunk);
		  	// read chunk-size and CRLF
		  	$chunkstart = $chunkend + strlen($lb);
			
		  	$chunkend = strpos($buffer, $lb, $chunkstart) + strlen($lb);
			if ($chunkend == FALSE) {
				break; //Just in case we got a broken connection
			}
			$temp = substr($buffer,$chunkstart,$chunkend-$chunkstart);
			$chunk_size = hexdec( trim($temp) );
			$chunkstart = $chunkend;
		}
		return $new;
	}
	
	/*
	 *	Writes payload, including HTTP headers, to $this->outgoing_payload.
	 */
	function buildPayload($data, $cookie_str = '') {
		// add content-length header
		$this->outgoing_headers['Content-Length'] = strlen($data);
		
		// start building outgoing payload:
		$req = "$this->request_method $this->uri HTTP/$this->protocol_version";
		$this->debug("HTTP request: $req");
		$this->outgoing_payload = "$req\r\n";

		// loop thru headers, serializing
		foreach($this->outgoing_headers as $k => $v){
			$hdr = $k.': '.$v;
			$this->debug("HTTP header: $hdr");
			$this->outgoing_payload .= "$hdr\r\n";
		}

		// add any cookies
		if ($cookie_str != '') {
			$hdr = 'Cookie: '.$cookie_str;
			$this->debug("HTTP header: $hdr");
			$this->outgoing_payload .= "$hdr\r\n";
		}

		// header/body separator
		$this->outgoing_payload .= "\r\n";
		
		// add data
		$this->outgoing_payload .= $data;
	}

	function sendRequest($data, $cookies = NULL) {
		// build cookie string
		$cookie_str = $this->getCookiesForRequest($cookies, (($this->scheme == 'ssl') || ($this->scheme == 'https')));

		// build payload
		$this->buildPayload($data, $cookie_str);

	  if ($this->scheme == 'http' || $this->scheme == 'ssl') {
		// send payload
		if(!fputs($this->fp, $this->outgoing_payload, strlen($this->outgoing_payload))) {
			$this->setError('couldn\'t write message data to socket');
			$this->debug('couldn\'t write message data to socket');
			return false;
		}
		$this->debug('wrote data to socket, length = ' . strlen($this->outgoing_payload));
		return true;
	  } else if ($this->scheme == 'https') {
		// set payload
		// TODO: cURL does say this should only be the verb, and in fact it
		// turns out that the URI and HTTP version are appended to this, which
		// some servers refuse to work with
		//curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->outgoing_payload);
		foreach($this->outgoing_headers as $k => $v){
			$curl_headers[] = "$k: $v";
		}
		if ($cookie_str != '') {
			$curl_headers[] = 'Cookie: ' . $cookie_str;
		}
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, $curl_headers);
		if ($this->request_method == "POST") {
	  		curl_setopt($this->ch, CURLOPT_POST, 1);
	  		curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
	  	} else {
	  	}
		$this->debug('set cURL payload');
		return true;
	  }
	}

	function getResponse(){
		$this->incoming_payload = '';
	    
	  if ($this->scheme == 'http' || $this->scheme == 'ssl') {
	    // loop until headers have been retrieved
	    $data = '';
	    while (!isset($lb)){

			// We might EOF during header read.
			if(feof($this->fp)) {
				$this->incoming_payload = $data;
				$this->debug('found no headers before EOF after length ' . strlen($data));
				$this->debug("received before EOF:\n" . $data);
				$this->setError('server failed to send headers');
				return false;
			}

			$tmp = fgets($this->fp, 256);
			$tmplen = strlen($tmp);
			$this->debug("read line of $tmplen bytes: " . trim($tmp));

			if ($tmplen == 0) {
				$this->incoming_payload = $data;
				$this->debug('socket read of headers timed out after length ' . strlen($data));
				$this->debug("read before timeout:\n" . $data);
				$this->setError('socket read of headers timed out');
				return false;
			}

			$data .= $tmp;
			$pos = strpos($data,"\r\n\r\n");
			if($pos > 1){
				$lb = "\r\n";
			} else {
				$pos = strpos($data,"\n\n");
				if($pos > 1){
					$lb = "\n";
				}
			}
			// remove 100 header
			if(isset($lb) && ereg('^HTTP/1.1 100',$data)){
				unset($lb);
				$data = '';
			}//
		}
		// store header data
		$this->incoming_payload .= $data;
		$this->debug('found end of headers after length ' . strlen($data));
		// process headers
		$header_data = trim(substr($data,0,$pos));
		$header_array = explode($lb,$header_data);
		$this->incoming_headers = array();
		$this->incoming_cookies = array();
		foreach($header_array as $header_line){
			$arr = explode(':',$header_line, 2);
			if(count($arr) > 1){
				$header_name = strtolower(trim($arr[0]));
				$this->incoming_headers[$header_name] = trim($arr[1]);
				if ($header_name == 'set-cookie') {
					// TODO: allow multiple cookies from parseCookie
					$cookie = $this->parseCookie(trim($arr[1]));
					if ($cookie) {
						$this->incoming_cookies[] = $cookie;
						$this->debug('found cookie: ' . $cookie['name'] . ' = ' . $cookie['value']);
					} else {
						$this->debug('did not find cookie in ' . trim($arr[1]));
					}
    			}
			} else if (isset($header_name)) {
				// append continuation line to previous header
				$this->incoming_headers[$header_name] .= $lb . ' ' . $header_line;
			}
		}
		
		// loop until msg has been received
		if (isset($this->incoming_headers['transfer-encoding']) && strtolower($this->incoming_headers['transfer-encoding']) == 'chunked') {
			$content_length =  2147483647;	// ignore any content-length header
			$chunked = true;
			$this->debug("want to read chunked content");
		} elseif (isset($this->incoming_headers['content-length'])) {
			$content_length = $this->incoming_headers['content-length'];
			$chunked = false;
			$this->debug("want to read content of length $content_length");
		} else {
			$content_length =  2147483647;
			$chunked = false;
			$this->debug("want to read content to EOF");
		}
		$data = '';
		do {
			if ($chunked) {
				$tmp = fgets($this->fp, 256);
				$tmplen = strlen($tmp);
				$this->debug("read chunk line of $tmplen bytes");
				if ($tmplen == 0) {
					$this->incoming_payload = $data;
					$this->debug('socket read of chunk length timed out after length ' . strlen($data));
					$this->debug("read before timeout:\n" . $data);
					$this->setError('socket read of chunk length timed out');
					return false;
				}
				$content_length = hexdec(trim($tmp));
				$this->debug("chunk length $content_length");
			}
			$strlen = 0;
		    while (($strlen < $content_length) && (!feof($this->fp))) {
		    	$readlen = min(8192, $content_length - $strlen);
				$tmp = fread($this->fp, $readlen);
				$tmplen = strlen($tmp);
				$this->debug("read buffer of $tmplen bytes");
				if (($tmplen == 0) && (!feof($this->fp))) {
					$this->incoming_payload = $data;
					$this->debug('socket read of body timed out after length ' . strlen($data));
					$this->debug("read before timeout:\n" . $data);
					$this->setError('socket read of body timed out');
					return false;
				}
				$strlen += $tmplen;
				$data .= $tmp;
			}
			if ($chunked && ($content_length > 0)) {
				$tmp = fgets($this->fp, 256);
				$tmplen = strlen($tmp);
				$this->debug("read chunk terminator of $tmplen bytes");
				if ($tmplen == 0) {
					$this->incoming_payload = $data;
					$this->debug('socket read of chunk terminator timed out after length ' . strlen($data));
					$this->debug("read before timeout:\n" . $data);
					$this->setError('socket read of chunk terminator timed out');
					return false;
				}
			}
		} while ($chunked && ($content_length > 0) && (!feof($this->fp)));
		if (feof($this->fp)) {
			$this->debug('read to EOF');
		}
		$this->debug('read body of length ' . strlen($data));
		$this->incoming_payload .= $data;
		$this->debug('received a total of '.strlen($this->incoming_payload).' bytes of data from server');
		
		// close filepointer
		if(
			(isset($this->incoming_headers['connection']) && strtolower($this->incoming_headers['connection']) == 'close') || 
			(! $this->persistentConnection) || feof($this->fp)){
			fclose($this->fp);
			$this->fp = false;
			$this->debug('closed socket');
		}
		
		// connection was closed unexpectedly
		if($this->incoming_payload == ''){
			$this->setError('no response from server');
			return false;
		}
		
		// decode transfer-encoding
//		if(isset($this->incoming_headers['transfer-encoding']) && strtolower($this->incoming_headers['transfer-encoding']) == 'chunked'){
//			if(!$data = $this->decodeChunked($data, $lb)){
//				$this->setError('Decoding of chunked data failed');
//				return false;
//			}
			//print "<pre>\nde-chunked:\n---------------\n$data\n\n---------------\n</pre>";
			// set decoded payload
//			$this->incoming_payload = $header_data.$lb.$lb.$data;
//		}
	
	  } else if ($this->scheme == 'https') {
		// send and receive
		$this->debug('send and receive with cURL');
		$this->incoming_payload = curl_exec($this->ch);
		$data = $this->incoming_payload;

        $cErr = curl_error($this->ch);
		if ($cErr != '') {
        	$err = 'cURL ERROR: '.curl_errno($this->ch).': '.$cErr.'<br>';
			foreach(curl_getinfo($this->ch) as $k => $v){
				$err .= "$k: $v<br>";
			}
			$this->debug($err);
			$this->setError($err);
			curl_close($this->ch);
	    	return false;
		} else {
			//echo '<pre>';
			//var_dump(curl_getinfo($this->ch));
			//echo '</pre>';
		}
		// close curl
		$this->debug('No cURL error, closing cURL');
		curl_close($this->ch);
		
		// remove 100 header
		if (ereg('^HTTP/1.1 100',$data)) {
			if ($pos = strpos($data,"\r\n\r\n")) {
				$data = ltrim(substr($data,$pos));
			} elseif($pos = strpos($data,"\n\n") ) {
				$data = ltrim(substr($data,$pos));
			}
		}
		
		// separate content from HTTP headers
		if ($pos = strpos($data,"\r\n\r\n")) {
			$lb = "\r\n";
		} elseif( $pos = strpos($data,"\n\n")) {
			$lb = "\n";
		} else {
			$this->debug('no proper separation of headers and document');
			$this->setError('no proper separation of headers and document');
			return false;
		}
		$header_data = trim(substr($data,0,$pos));
		$header_array = explode($lb,$header_data);
		$data = ltrim(substr($data,$pos));
		$this->debug('found proper separation of headers and document');
		$this->debug('cleaned data, stringlen: '.strlen($data));
		// clean headers
		foreach ($header_array as $header_line) {
			$arr = explode(':',$header_line,2);
			if(count($arr) > 1){
				$header_name = strtolower(trim($arr[0]));
				$this->incoming_headers[$header_name] = trim($arr[1]);
				if ($header_name == 'set-cookie') {
					// TODO: allow multiple cookies from parseCookie
					$cookie = $this->parseCookie(trim($arr[1]));
					if ($cookie) {
						$this->incoming_cookies[] = $cookie;
						$this->debug('found cookie: ' . $cookie['name'] . ' = ' . $cookie['value']);
					} else {
						$this->debug('did not find cookie in ' . trim($arr[1]));
					}
    			}
			} else if (isset($header_name)) {
				// append continuation line to previous header
				$this->incoming_headers[$header_name] .= $lb . ' ' . $header_line;
			}
		}
	  }

		$arr = explode(' ', $header_array[0], 3);
		$http_version = $arr[0];
		$http_status = intval($arr[1]);
		$http_reason = count($arr) > 2 ? $arr[2] : '';

 		// see if we need to resend the request with http digest authentication
 		if (isset($this->incoming_headers['location']) && $http_status == 301) {
 			$this->debug("Got 301 $http_reason with Location: " . $this->incoming_headers['location']);
 			$this->setURL($this->incoming_headers['location']);
			$this->tryagain = true;
			return false;
		}

 		// see if we need to resend the request with http digest authentication
 		if (isset($this->incoming_headers['www-authenticate']) && $http_status == 401) {
 			$this->debug("Got 401 $http_reason with WWW-Authenticate: " . $this->incoming_headers['www-authenticate']);
 			if (substr("Digest ", $this->incoming_headers['www-authenticate'])) {
 				$this->debug('Server wants digest authentication');
 				// remove "Digest " from our elements
 				$digestString = str_replace('Digest ', '', $this->incoming_headers['www-authenticate']);
 				
 				// parse elements into array
 				$digestElements = explode(',', $digestString);
 				foreach ($digestElements as $val) {
 					$tempElement = explode('=', trim($val));
 					$digestRequest[$tempElement[0]] = str_replace("\"", '', $tempElement[1]);
 				}

				// should have (at least) qop, realm, nonce
 				if (isset($digestRequest['nonce'])) {
 					$this->setCredentials($this->username, $this->password, 'digest', $digestRequest);
 					$this->tryagain = true;
 					return false;
 				}
 			}
			$this->debug('HTTP authentication failed');
			$this->setError('HTTP authentication failed');
			return false;
 		}
		
		if (
			($http_status >= 300 && $http_status <= 307) ||
			($http_status >= 400 && $http_status <= 417) ||
			($http_status >= 501 && $http_status <= 505)
		   ) {
			$this->setError("Unsupported HTTP response status $http_status $http_reason (soap_client->response has contents of the response)");
			return false;
		}

		// decode content-encoding
		if(isset($this->incoming_headers['content-encoding']) && $this->incoming_headers['content-encoding'] != ''){
			if(strtolower($this->incoming_headers['content-encoding']) == 'deflate' || strtolower($this->incoming_headers['content-encoding']) == 'gzip'){
    			// if decoding works, use it. else assume data wasn't gzencoded
    			if(function_exists('gzinflate')){
					//$timer->setMarker('starting decoding of gzip/deflated content');
					// IIS 5 requires gzinflate instead of gzuncompress (similar to IE 5 and gzdeflate v. gzcompress)
					// this means there are no Zlib headers, although there should be
					$this->debug('The gzinflate function exists');
					$datalen = strlen($data);
					if ($this->incoming_headers['content-encoding'] == 'deflate') {
						if ($degzdata = @gzinflate($data)) {
	    					$data = $degzdata;
	    					$this->debug('The payload has been inflated to ' . strlen($data) . ' bytes');
	    					if (strlen($data) < $datalen) {
	    						// test for the case that the payload has been compressed twice
		    					$this->debug('The inflated payload is smaller than the gzipped one; try again');
								if ($degzdata = @gzinflate($data)) {
			    					$data = $degzdata;
			    					$this->debug('The payload has been inflated again to ' . strlen($data) . ' bytes');
								}
	    					}
	    				} else {
	    					$this->debug('Error using gzinflate to inflate the payload');
	    					$this->setError('Error using gzinflate to inflate the payload');
	    				}
					} elseif ($this->incoming_headers['content-encoding'] == 'gzip') {
						if ($degzdata = @gzinflate(substr($data, 10))) {	// do our best
							$data = $degzdata;
	    					$this->debug('The payload has been un-gzipped to ' . strlen($data) . ' bytes');
	    					if (strlen($data) < $datalen) {
	    						// test for the case that the payload has been compressed twice
		    					$this->debug('The un-gzipped payload is smaller than the gzipped one; try again');
								if ($degzdata = @gzinflate(substr($data, 10))) {
			    					$data = $degzdata;
			    					$this->debug('The payload has been un-gzipped again to ' . strlen($data) . ' bytes');
								}
	    					}
	    				} else {
	    					$this->debug('Error using gzinflate to un-gzip the payload');
							$this->setError('Error using gzinflate to un-gzip the payload');
	    				}
					}
					//$timer->setMarker('finished decoding of gzip/deflated content');
					//print "<xmp>\nde-inflated:\n---------------\n$data\n-------------\n</xmp>";
					// set decoded payload
					$this->incoming_payload = $header_data.$lb.$lb.$data;
    			} else {
					$this->debug('The server sent compressed data. Your php install must have the Zlib extension compiled in to support this.');
					$this->setError('The server sent compressed data. Your php install must have the Zlib extension compiled in to support this.');
				}
			} else {
				$this->debug('Unsupported Content-Encoding ' . $this->incoming_headers['content-encoding']);
				$this->setError('Unsupported Content-Encoding ' . $this->incoming_headers['content-encoding']);
			}
		} else {
			$this->debug('No Content-Encoding header');
		}
		
		if(strlen($data) == 0){
			$this->debug('no data after headers!');
			$this->setError('no data present after HTTP headers');
			return false;
		}
		
		return $data;
	}

	function setContentType($type, $charset = false) {
		$this->outgoing_headers['Content-Type'] = $type . ($charset ? '; charset=' . $charset : '');
	}

	function usePersistentConnection(){
		if (isset($this->outgoing_headers['Accept-Encoding'])) {
			return false;
		}
		$this->protocol_version = '1.1';
		$this->persistentConnection = true;
		$this->outgoing_headers['Connection'] = 'Keep-Alive';
		return true;
	}

	/**
	 * parse an incoming Cookie into it's parts
	 *
	 * @param	string $cookie_str content of cookie
	 * @return	array with data of that cookie
	 * @access	private
	 *
	 * TODO: allow a Set-Cookie string to be parsed into multiple cookies
	 */
	function parseCookie($cookie_str) {
		$cookie_str = str_replace('; ', ';', $cookie_str) . ';';
		$data = split(';', $cookie_str);
		$value_str = $data[0];

		$cookie_param = 'domain=';
		$start = strpos($cookie_str, $cookie_param);
		if ($start > 0) {
			$domain = substr($cookie_str, $start + strlen($cookie_param));
			$domain = substr($domain, 0, strpos($domain, ';'));
		} else {
			$domain = '';
		}

		$cookie_param = 'expires=';
		$start = strpos($cookie_str, $cookie_param);
		if ($start > 0) {
			$expires = substr($cookie_str, $start + strlen($cookie_param));
			$expires = substr($expires, 0, strpos($expires, ';'));
		} else {
			$expires = '';
		}

		$cookie_param = 'path=';
		$start = strpos($cookie_str, $cookie_param);
		if ( $start > 0 ) {
			$path = substr($cookie_str, $start + strlen($cookie_param));
			$path = substr($path, 0, strpos($path, ';'));
		} else {
			$path = '/';
		}
						
		$cookie_param = ';secure;';
		if (strpos($cookie_str, $cookie_param) !== FALSE) {
			$secure = true;
		} else {
			$secure = false;
		}

		$sep_pos = strpos($value_str, '=');

		if ($sep_pos) {
			$name = substr($value_str, 0, $sep_pos);
			$value = substr($value_str, $sep_pos + 1);
			$cookie= array(	'name' => $name,
			                'value' => $value,
							'domain' => $domain,
							'path' => $path,
							'expires' => $expires,
							'secure' => $secure
							);		
			return $cookie;
		}
		return false;
	}
  
	/**
	 * sort out cookies for the current request
	 *
	 * @param	array $cookies array with all cookies
	 * @param	boolean $secure is the send-content secure or not?
	 * @return	string for Cookie-HTTP-Header
	 * @access	private
	 */
	function getCookiesForRequest($cookies, $secure=false) {
		$cookie_str = '';
		if ((! is_null($cookies)) && (is_array($cookies))) {
			foreach ($cookies as $cookie) {
				if (! is_array($cookie)) {
					continue;
				}
	    		$this->debug("check cookie for validity: ".$cookie['name'].'='.$cookie['value']);
				if ((isset($cookie['expires'])) && (! empty($cookie['expires']))) {
					if (strtotime($cookie['expires']) <= time()) {
						$this->debug('cookie has expired');
						continue;
					}
				}
				if ((isset($cookie['domain'])) && (! empty($cookie['domain']))) {
					$domain = preg_quote($cookie['domain']);
					if (! preg_match("'.*$domain$'i", $this->host)) {
						$this->debug('cookie has different domain');
						continue;
					}
				}
				if ((isset($cookie['path'])) && (! empty($cookie['path']))) {
					$path = preg_quote($cookie['path']);
					if (! preg_match("'^$path.*'i", $this->path)) {
						$this->debug('cookie is for a different path');
						continue;
					}
				}
				if ((! $secure) && (isset($cookie['secure'])) && ($cookie['secure'])) {
					$this->debug('cookie is secure, transport is not');
					continue;
				}
				$cookie_str .= $cookie['name'] . '=' . $cookie['value'] . '; ';
	    		$this->debug('add cookie to Cookie-String: ' . $cookie['name'] . '=' . $cookie['value']);
			}
		}
		return $cookie_str;
  }
}

?><?php



/**
*
* soap_server allows the user to create a SOAP server
* that is capable of receiving messages and returning responses
*
* NOTE: WSDL functionality is experimental
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class soap_server extends nusoap_base {
	var $headers = array();			// HTTP headers of request
	var $request = '';				// HTTP request
	var $requestHeaders = '';		// SOAP headers from request (incomplete namespace resolution; special characters not escaped) (text)
	var $document = '';				// SOAP body request portion (incomplete namespace resolution; special characters not escaped) (text)
	var $requestSOAP = '';			// SOAP payload for request (text)
	var $methodURI = '';			// requested method namespace URI
	var $methodname = '';			// name of method requested
	var $methodparams = array();	// method parameters from request
	var $xml_encoding = '';			// character set encoding of incoming (request) messages
	var $SOAPAction = '';			// SOAP Action from request
    var $decode_utf8 = true;		// toggles whether the parser decodes element content w/ utf8_decode()

	var $outgoing_headers = array();// HTTP headers of response
	var $response = '';				// HTTP response
	var $responseHeaders = '';		// SOAP headers for response (text)
	var $responseSOAP = '';			// SOAP payload for response (text)
	var $methodreturn = false;		// method return to place in response
	var $methodreturnisliteralxml = false;	// whether $methodreturn is a string of literal XML
	var $fault = false;				// SOAP fault for response
	var $result = 'successful';		// text indication of result (for debugging)

	var $operations = array();		// assoc array of operations => opData
	var $wsdl = false;				// wsdl instance
	var $externalWSDLURL = false;	// URL for WSDL
	var $debug_flag = false;		// whether to append debug to response as XML comment


	/**
	* constructor
    * the optional parameter is a path to a WSDL file that you'd like to bind the server instance to.
	*
    * @param mixed $wsdl file path or URL (string), or wsdl instance (object)
	* @access   public
	*/
	function soap_server($wsdl=false){

		// turn on debugging?
		global $debug;
		global $_REQUEST;
		global $_SERVER;
		global $HTTP_SERVER_VARS;

		if (isset($debug)) {
			$this->debug_flag = $debug;
		} else if (isset($_REQUEST['debug'])) {
			$this->debug_flag = $_REQUEST['debug'];
		} else if (isset($_SERVER['QUERY_STRING'])) {
			$qs = explode('&', $_SERVER['QUERY_STRING']);
			foreach ($qs as $v) {
				if (substr($v, 0, 6) == 'debug=') {
					$this->debug_flag = substr($v, 6);
				}
			}
		} else if (isset($HTTP_SERVER_VARS['QUERY_STRING'])) {
			$qs = explode('&', $HTTP_SERVER_VARS['QUERY_STRING']);
			foreach ($qs as $v) {
				if (substr($v, 0, 6) == 'debug=') {
					$this->debug_flag = substr($v, 6);
				}
			}
		}

		// wsdl
		if($wsdl){
			if (is_object($wsdl) && $this->is_a_temp($wsdl, 'wsdl')) {
				$this->wsdl = $wsdl;
				$this->externalWSDLURL = $this->wsdl->wsdl;
				$this->debug('Use existing wsdl instance from ' . $this->externalWSDLURL);
			} else {
				$this->debug('Create wsdl from ' . $wsdl);
				$this->wsdl = new wsdl($wsdl);
				$this->externalWSDLURL = $wsdl;
			}
			$this->appendDebug($this->wsdl->getDebug());
			$this->wsdl->clearDebug();
			if($err = $this->wsdl->getError()){
				die('WSDL ERROR: '.$err);
			}
		}
	}
	
	// workaround for PHP versions older than 4.2.0
	function is_a_temp($object, $class) {
        if (!is_object($object)) {
            return false;
        }

        if (get_class($object) == strtolower($class)) {
            return true;
        } else {
            return is_subclass_of($object, $class);
        }
	}
	
	/**
	* processes request and returns response
	*
	* @param    string $data usually is the value of $HTTP_RAW_POST_DATA
	* @access   public
	*/
	function service($data){
		global $QUERY_STRING;
		global $_SERVER;

		if(isset($_SERVER['QUERY_STRING'])){
			$qs = $_SERVER['QUERY_STRING'];
		} elseif(isset($GLOBALS['QUERY_STRING'])){
			$qs = $GLOBALS['QUERY_STRING'];
		} elseif(isset($QUERY_STRING) && $QUERY_STRING != ''){
			$qs = $QUERY_STRING;
		}

		if(isset($qs) && ereg('wsdl', $qs) ){
			// This is a request for WSDL
			if($this->externalWSDLURL){
              if (strpos($this->externalWSDLURL,"://")!==false) { // assume URL
				header('Location: '.$this->externalWSDLURL);
              } else { // assume file
                header("Content-Type: text/xml\r\n");
                $fp = fopen($this->externalWSDLURL, 'r');
                fpassthru($fp);
              }
			} elseif ($this->wsdl) {
				header("Content-Type: text/xml; charset=ISO-8859-1\r\n");
				print $this->wsdl->serialize($this->debug_flag);
			} else {
				header("Content-Type: text/html; charset=ISO-8859-1\r\n");
				print "This service does not provide WSDL";
			}
		} elseif ($data == '' && $this->wsdl) {
			// print web interface
			print $this->wsdl->webDescription();
		} else {
			// handle the request
			$this->parse_request($data);
			if (! $this->fault) {
				$this->invoke_method();
			}
			if (! $this->fault) {
				$this->serialize_return();
			}
			$this->send_response();
		}
	}

	/**
	* parses HTTP request headers.
	*
	* The following fields are set by this function (when successful)
	*
	* headers
	* request
	* xml_encoding
	* SOAPAction
	*
	* @access   private
	*/
	function parse_http_headers() {
		global $HTTP_SERVER_VARS;
		global $_SERVER;

		$this->request = '';
		if(function_exists('getallheaders')){
			$this->headers = getallheaders();
			foreach($this->headers as $k=>$v){
				$this->request .= "$k: $v\r\n";
				$this->debug("$k: $v");
			}
			// get SOAPAction header
			if(isset($this->headers['SOAPAction'])){
				$this->SOAPAction = str_replace('"','',$this->headers['SOAPAction']);
			}
			// get the character encoding of the incoming request
			if(strpos($this->headers['Content-Type'],'=')){
				$enc = str_replace('"','',substr(strstr($this->headers["Content-Type"],'='),1));
				if(eregi('^(ISO-8859-1|US-ASCII|UTF-8)$',$enc)){
					$this->xml_encoding = strtoupper($enc);
				} else {
					$this->xml_encoding = 'US-ASCII';
				}
			} else {
				// should be US-ASCII for HTTP 1.0 or ISO-8859-1 for HTTP 1.1
				$this->xml_encoding = 'ISO-8859-1';
			}
		} elseif(isset($_SERVER) && is_array($_SERVER)){
			foreach ($_SERVER as $k => $v) {
				if (substr($k, 0, 5) == 'HTTP_') {
					$k = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($k, 5)))));
				} else {
					$k = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', $k))));
				}
				if ($k == 'Soapaction') {
					// get SOAPAction header
					$k = 'SOAPAction';
					$v = str_replace('"', '', $v);
					$v = str_replace('\\', '', $v);
					$this->SOAPAction = $v;
				} else if ($k == 'Content-Type') {
					// get the character encoding of the incoming request
					if (strpos($v, '=')) {
						$enc = substr(strstr($v, '='), 1);
						$enc = str_replace('"', '', $enc);
						$enc = str_replace('\\', '', $enc);
						if (eregi('^(ISO-8859-1|US-ASCII|UTF-8)$', $enc)) {
							$this->xml_encoding = strtoupper($enc);
						} else {
							$this->xml_encoding = 'US-ASCII';
						}
					} else {
						// should be US-ASCII for HTTP 1.0 or ISO-8859-1 for HTTP 1.1
						$this->xml_encoding = 'ISO-8859-1';
					}
				}
				$this->headers[$k] = $v;
				$this->request .= "$k: $v\r\n";
				$this->debug("$k: $v");
			}
		} elseif (is_array($HTTP_SERVER_VARS)) {
			foreach ($HTTP_SERVER_VARS as $k => $v) {
				if (substr($k, 0, 5) == 'HTTP_') {
					$k = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($k, 5)))));
					if ($k == 'Soapaction') {
						// get SOAPAction header
						$k = 'SOAPAction';
						$v = str_replace('"', '', $v);
						$v = str_replace('\\', '', $v);
						$this->SOAPAction = $v;
					} else if ($k == 'Content-Type') {
						// get the character encoding of the incoming request
						if (strpos($v, '=')) {
							$enc = substr(strstr($v, '='), 1);
							$enc = str_replace('"', '', $enc);
							$enc = str_replace('\\', '', $enc);
							if (eregi('^(ISO-8859-1|US-ASCII|UTF-8)$', $enc)) {
								$this->xml_encoding = strtoupper($enc);
							} else {
								$this->xml_encoding = 'US-ASCII';
							}
						} else {
							// should be US-ASCII for HTTP 1.0 or ISO-8859-1 for HTTP 1.1
							$this->xml_encoding = 'ISO-8859-1';
						}
					}
					$this->headers[$k] = $v;
					$this->request .= "$k: $v\r\n";
					$this->debug("$k: $v");
				}
			}
		}
	}

	/**
	* parses a request
	*
	* The following fields are set by this function (when successful)
	*
	* headers
	* request
	* xml_encoding
	* SOAPAction
	* request
	* requestSOAP
	* methodURI
	* methodname
	* methodparams
	* requestHeaders
	* document
	*
	* This sets the fault field on error
	*
	* @param    string $data XML string
	* @access   private
	*/
	function parse_request($data='') {
		$this->debug('entering parse_request()');
		$this->parse_http_headers();
		$this->debug('got character encoding: '.$this->xml_encoding);
		// uncompress if necessary
		if (isset($this->headers['Content-Encoding']) && $this->headers['Content-Encoding'] != '') {
			$this->debug('got content encoding: ' . $this->headers['Content-Encoding']);
			if ($this->headers['Content-Encoding'] == 'deflate' || $this->headers['Content-Encoding'] == 'gzip') {
		    	// if decoding works, use it. else assume data wasn't gzencoded
				if (function_exists('gzuncompress')) {
					if ($this->headers['Content-Encoding'] == 'deflate' && $degzdata = @gzuncompress($data)) {
						$data = $degzdata;
					} elseif ($this->headers['Content-Encoding'] == 'gzip' && $degzdata = gzinflate(substr($data, 10))) {
						$data = $degzdata;
					} else {
						$this->fault('Client', 'Errors occurred when trying to decode the data');
						return;
					}
				} else {
					$this->fault('Client', 'This Server does not support compressed data');
					return;
				}
			}
		}
		$this->request .= "\r\n".$data;
		$this->requestSOAP = $data;
		// parse response, get soap parser obj
		$parser = new soap_parser($data,$this->xml_encoding,'',$this->decode_utf8);
		// parser debug
		$this->debug("parser debug: \n".$parser->getDebug());
		// if fault occurred during message parsing
		if($err = $parser->getError()){
			$this->result = 'fault: error in msg parsing: '.$err;
			$this->fault('Client',"error in msg parsing:\n".$err);
		// else successfully parsed request into soapval object
		} else {
			// get/set methodname
			$this->methodURI = $parser->root_struct_namespace;
			$this->methodname = $parser->root_struct_name;
			$this->debug('methodname: '.$this->methodname.' methodURI: '.$this->methodURI);
			$this->debug('calling parser->get_response()');
			$this->methodparams = $parser->get_response();
			// get SOAP headers
			$this->requestHeaders = $parser->getHeaders();
            // add document for doclit support
            $this->document = $parser->document;
		}
		$this->debug('leaving parse_request');
	}

	/**
	* invokes a PHP function for the requested SOAP method
	*
	* The following fields are set by this function (when successful)
	*
	* methodreturn
	*
	* Note that the PHP function that is called may also set the following
	* fields to affect the response sent to the client
	*
	* responseHeaders
	* outgoing_headers
	*
	* This sets the fault field on error
	*
	* @access   private
	*/
	function invoke_method() {
		$this->debug('entering invoke_method methodname: ' . $this->methodname . ' methodURI: ' . $this->methodURI);
		// if a . is present in $this->methodname, we see if there is a class in scope,
		// which could be referred to. We will also distinguish between two deliminators,
		// to allow methods to be called a the class or an instance
		$class = '';
		$method = '';
		if (strpos($this->methodname, '..') > 0) {
			$delim = '..';
		} else if (strpos($this->methodname, '.') > 0) {
			$delim = '.';
		} else {
			$delim = '';
		}

		if (strlen($delim) > 0 && substr_count($this->methodname, $delim) == 1 &&
			class_exists(substr($this->methodname, 0, strpos($this->methodname, $delim)))) {
			// get the class and method name
			$class = substr($this->methodname, 0, strpos($this->methodname, $delim));
			$method = substr($this->methodname, strpos($this->methodname, $delim) + strlen($delim));
			$this->debug("class: $class method: $method delim: $delim");
		}

		// does method exist?
		if ($class == '' && !function_exists($this->methodname)) {
			$this->debug("function '$this->methodname' not found!");
			$this->result = 'fault: method not found';
			$this->fault('Client',"method '$this->methodname' not defined in service");
			return;
		}
		if ($class != '' && !in_array($method, get_class_methods($class))) {
			$this->debug("method '$this->methodname' not found in class '$class'!");
			$this->result = 'fault: method not found';
			$this->fault('Client',"method '$this->methodname' not defined in service");
			return;
		}

		if($this->wsdl){
			if(!$this->opData = $this->wsdl->getOperationData($this->methodname)){
			//if(
				$this->fault('Client',"Operation '$this->methodname' is not defined in the WSDL for this service");
				return;
			}
			$this->debug('opData:');
			$this->appendDebug($this->varDump($this->opData));
		}
		$this->debug("method '$this->methodname' exists");
		// evaluate message, getting back parameters
		// verify that request parameters match the method's signature
		if(! $this->verify_method($this->methodname,$this->methodparams)){
			// debug
			$this->debug('ERROR: request not verified against method signature');
			$this->result = 'fault: request failed validation against method signature';
			// return fault
			$this->fault('Client',"Operation '$this->methodname' not defined in service.");
			return;
		}

		// if there are parameters to pass
		$this->debug('params:');
		$this->appendDebug($this->varDump($this->methodparams));
		$this->debug("calling '$this->methodname'");
		if (!function_exists('call_user_func_array')) {
			if ($class == '') {
				$this->debug('calling function using eval()');
				$funcCall = "\$this->methodreturn = $this->methodname(";
			} else {
				if ($delim == '..') {
					$this->debug('calling class method using eval()');
					$funcCall = "\$this->methodreturn = ".$class."::".$method."(";
				} else {
					$this->debug('calling instance method using eval()');
					// generate unique instance name
					$instname = "\$inst_".time();
					$funcCall = $instname." = new ".$class."(); ";
					$funcCall .= "\$this->methodreturn = ".$instname."->".$method."(";
				}
			}
			if ($this->methodparams) {
				foreach ($this->methodparams as $param) {
					if (is_array($param)) {
						$this->fault('Client', 'NuSOAP does not handle complexType parameters correctly when using eval; call_user_func_array must be available');
						return;
					}
					$funcCall .= "\"$param\",";
				}
				$funcCall = substr($funcCall, 0, -1);
			}
			$funcCall .= ');';
			$this->debug('function call: '.$funcCall);
			@eval($funcCall);
		} else {
			if ($class == '') {
				$this->debug('calling function using call_user_func_array()');
				$call_arg = "$this->methodname";	// straight assignment changes $this->methodname to lower case after call_user_func_array()
			} elseif ($delim == '..') {
				$this->debug('calling class method using call_user_func_array()');
				$call_arg = array ($class, $method);
			} else {
				$this->debug('calling instance method using call_user_func_array()');
				$instance = new $class ();
				$call_arg = array(&$instance, $method);
			}
			$this->methodreturn = call_user_func_array($call_arg, $this->methodparams);
		}
        $this->debug('methodreturn:');
        $this->appendDebug($this->varDump($this->methodreturn));
		$this->debug("leaving invoke_method: called method $this->methodname, received $this->methodreturn of type ".gettype($this->methodreturn));
	}

	/**
	* serializes the return value from a PHP function into a full SOAP Envelope
	*
	* The following fields are set by this function (when successful)
	*
	* responseSOAP
	*
	* This sets the fault field on error
	*
	* @access   private
	*/
	function serialize_return() {
		$this->debug('Entering serialize_return methodname: ' . $this->methodname . ' methodURI: ' . $this->methodURI);
		// if we got nothing back. this might be ok (echoVoid)
		if(isset($this->methodreturn) && ($this->methodreturn != '' || is_bool($this->methodreturn))) {
			// if fault
			if(get_class($this->methodreturn) == 'soap_fault'){
				$this->debug('got a fault object from method');
				$this->fault = $this->methodreturn;
				return;
			} elseif ($this->methodreturnisliteralxml) {
				$return_val = $this->methodreturn;
			// returned value(s)
			} else {
				$this->debug('got a(n) '.gettype($this->methodreturn).' from method');
				$this->debug('serializing return value');
				if($this->wsdl){
					// weak attempt at supporting multiple output params
					if(sizeof($this->opData['output']['parts']) > 1){
				    	$opParams = $this->methodreturn;
				    } else {
				    	// TODO: is this really necessary?
				    	$opParams = array($this->methodreturn);
				    }
				    $return_val = $this->wsdl->serializeRPCParameters($this->methodname,'output',$opParams);
				    $this->appendDebug($this->wsdl->getDebug());
				    $this->wsdl->clearDebug();
					if($errstr = $this->wsdl->getError()){
						$this->debug('got wsdl error: '.$errstr);
						$this->fault('Server', 'unable to serialize result');
						return;
					}
				} else {
				    $return_val = $this->serialize_val($this->methodreturn, 'return');
				}
			}
			$this->debug('return value:');
			$this->appendDebug($this->varDump($return_val));
		} else {
			$return_val = '';
			$this->debug('got no response from method');
		}
		$this->debug('serializing response');
		if ($this->wsdl) {
			$this->debug('have WSDL for serialization: style is ' . $this->opData['style']);
			if ($this->opData['style'] == 'rpc') {
				$this->debug('style is rpc for serialization: use is ' . $this->opData['output']['use']);
				if ($this->opData['output']['use'] == 'literal') {
					$payload = '<'.$this->methodname.'Response xmlns="'.$this->methodURI.'">'.$return_val.'</'.$this->methodname."Response>";
				} else {
					$payload = '<ns1:'.$this->methodname.'Response xmlns:ns1="'.$this->methodURI.'">'.$return_val.'</ns1:'.$this->methodname."Response>";
				}
			} else {
				$this->debug('style is not rpc for serialization: assume document');
				$payload = $return_val;
			}
		} else {
			$this->debug('do not have WSDL for serialization: assume rpc/encoded');
			$payload = '<ns1:'.$this->methodname.'Response xmlns:ns1="'.$this->methodURI.'">'.$return_val.'</ns1:'.$this->methodname."Response>";
		}
		$this->result = 'successful';
		if($this->wsdl){
			//if($this->debug_flag){
            	$this->appendDebug($this->wsdl->getDebug());
            //	}
			// Added: In case we use a WSDL, return a serialized env. WITH the usedNamespaces.
			$this->responseSOAP = $this->serializeEnvelope($payload,$this->responseHeaders,$this->wsdl->usedNamespaces,$this->opData['style']);
		} else {
			$this->responseSOAP = $this->serializeEnvelope($payload,$this->responseHeaders);
		}
		$this->debug("Leaving serialize_return");
	}

	/**
	* sends an HTTP response
	*
	* The following fields are set by this function (when successful)
	*
	* outgoing_headers
	* response
	*
	* @access   private
	*/
	function send_response() {
		$this->debug('Enter send_response');
		if ($this->fault) {
			$payload = $this->fault->serialize();
			$this->outgoing_headers[] = "HTTP/1.0 500 Internal Server Error";
			$this->outgoing_headers[] = "Status: 500 Internal Server Error";
		} else {
			$payload = $this->responseSOAP;
			// Some combinations of PHP+Web server allow the Status
			// to come through as a header.  Since OK is the default
			// just do nothing.
			// $this->outgoing_headers[] = "HTTP/1.0 200 OK";
			// $this->outgoing_headers[] = "Status: 200 OK";
		}
        // add debug data if in debug mode
		if(isset($this->debug_flag) && $this->debug_flag){
        	$payload .= $this->getDebugAsXMLComment();
        }
		$this->outgoing_headers[] = "Server: $this->title Server v$this->version";
		ereg('\$Revisio' . 'n: ([^ ]+)', $this->revision, $rev);
		$this->outgoing_headers[] = "X-SOAP-Server: $this->title/$this->version (".$rev[1].")";
		// Let the Web server decide about this
		//$this->outgoing_headers[] = "Connection: Close\r\n";
		$this->outgoing_headers[] = "Content-Type: text/xml; charset=$this->soap_defencoding";
		//begin code to compress payload - by John
		// NOTE: there is no way to know whether the Web server will also compress
		// this data.
		if (strlen($payload) > 1024 && isset($this->headers) && isset($this->headers['Accept-Encoding'])) {	
			if (strstr($this->headers['Accept-Encoding'], 'gzip')) {
				if (function_exists('gzencode')) {
					if (isset($this->debug_flag) && $this->debug_flag) {
						$payload .= "<!-- Content being gzipped -->";
					}
					$this->outgoing_headers[] = "Content-Encoding: gzip";
					$payload = gzencode($payload);
				} else {
					if (isset($this->debug_flag) && $this->debug_flag) {
						$payload .= "<!-- Content will not be gzipped: no gzencode -->";
					}
				}
			} elseif (strstr($this->headers['Accept-Encoding'], 'deflate')) {
				// Note: MSIE requires gzdeflate output (no Zlib header and checksum),
				// instead of gzcompress output,
				// which conflicts with HTTP 1.1 spec (http://www.w3.org/Protocols/rfc2616/rfc2616-sec3.html#sec3.5)
				if (function_exists('gzdeflate')) {
					if (isset($this->debug_flag) && $this->debug_flag) {
						$payload .= "<!-- Content being deflated -->";
					}
					$this->outgoing_headers[] = "Content-Encoding: deflate";
					$payload = gzdeflate($payload);
				} else {
					if (isset($this->debug_flag) && $this->debug_flag) {
						$payload .= "<!-- Content will not be deflated: no gzcompress -->";
					}
				}
			}
		}
		//end code
		$this->outgoing_headers[] = "Content-Length: ".strlen($payload);
		reset($this->outgoing_headers);
		foreach($this->outgoing_headers as $hdr){
			header($hdr, false);
		}
		print $payload;
		$this->response = join("\r\n",$this->outgoing_headers)."\r\n\r\n".$payload;
	}

	/**
	* takes the value that was created by parsing the request
	* and compares to the method's signature, if available.
	*
	* @param	mixed
	* @return	boolean
	* @access   private
	*/
	function verify_method($operation,$request){
		if(isset($this->wsdl) && is_object($this->wsdl)){
			if($this->wsdl->getOperationData($operation)){
				return true;
			}
	    } elseif(isset($this->operations[$operation])){
			return true;
		}
		return false;
	}

	/**
	* add a method to the dispatch map
	*
	* @param    string $methodname
	* @param    string $in array of input values
	* @param    string $out array of output values
	* @access   public
	*/
	function add_to_map($methodname,$in,$out){
			$this->operations[$methodname] = array('name' => $methodname,'in' => $in,'out' => $out);
	}

	/**
	* register a service with the server
	*
	* @param    string $methodname
	* @param    string $in assoc array of input values: key = param name, value = param type
	* @param    string $out assoc array of output values: key = param name, value = param type
	* @param	string $namespace
	* @param	string $soapaction
	* @param	string $style optional (rpc|document)
	* @param	string $use optional (encoded|literal)
	* @param	string $documentation optional Description to include in WSDL
	* @access   public
	*/
	function register($name,$in=array(),$out=array(),$namespace=false,$soapaction=false,$style=false,$use=false,$documentation=''){
		if($this->externalWSDLURL){
			die('You cannot bind to an external WSDL file, and register methods outside of it! Please choose either WSDL or no WSDL.');
		}
		if(false == $namespace) {
		}
		if(false == $soapaction) {
			$SERVER_NAME = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $GLOBALS['SERVER_NAME'];
			$SCRIPT_NAME = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $GLOBALS['SCRIPT_NAME'];
			$soapaction = "http://$SERVER_NAME$SCRIPT_NAME/$name";
		}
		if(false == $style) {
			$style = "rpc";
		}
		if(false == $use) {
			$use = "encoded";
		}
		
		$this->operations[$name] = array(
	    'name' => $name,
	    'in' => $in,
	    'out' => $out,
	    'namespace' => $namespace,
	    'soapaction' => $soapaction,
	    'style' => $style);
        if($this->wsdl){
        	$this->wsdl->addOperation($name,$in,$out,$namespace,$soapaction,$style,$use,$documentation);
	    }
		return true;
	}

	/**
	* create a fault. this also acts as a flag to the server that a fault has occured.
	*
	* @param	string faultcode
	* @param	string faultstring
	* @param	string faultactor
	* @param	string faultdetail
	* @access   public
	*/
	function fault($faultcode,$faultstring,$faultactor='',$faultdetail=''){
		$this->fault = new soap_fault($faultcode,$faultactor,$faultstring,$faultdetail);
	}

    /**
    * sets up wsdl object
    * this acts as a flag to enable internal WSDL generation
    *
    * @param string $serviceName, name of the service
    * @param string $namespace optional tns namespace
    * @param string $endpoint optional URL of service endpoint
    * @param string $style optional (rpc|document) WSDL style (also specified by operation)
    * @param string $transport optional SOAP transport
    * @param string $schemaTargetNamespace optional targetNamespace for service schema
    */
    function configureWSDL($serviceName,$namespace = false,$endpoint = false,$style='rpc', $transport = 'http://schemas.xmlsoap.org/soap/http', $schemaTargetNamespace = false)
    {
		$SERVER_NAME = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : $GLOBALS['SERVER_NAME'];
		$SERVER_PORT = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : $GLOBALS['SERVER_PORT'];
		if ($SERVER_PORT == 80) {
			$SERVER_PORT = '';
		} else {
			$SERVER_PORT = ':' . $SERVER_PORT;
		}
		$SCRIPT_NAME = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $GLOBALS['SCRIPT_NAME'];
        if(false == $namespace) {
            $namespace = "http://$SERVER_NAME/soap/$serviceName";
        }
        
        if(false == $endpoint) {
        	if (isset($_SERVER['HTTPS'])) {
        		$HTTPS = $_SERVER['HTTPS'];
        	} elseif (isset($GLOBALS['HTTPS'])) {
        		$HTTPS = $GLOBALS['HTTPS'];
        	} else {
        		$HTTPS = '0';
        	}
        	if ($HTTPS == '1' || $HTTPS == 'on') {
        		$SCHEME = 'https';
        	} else {
        		$SCHEME = 'http';
        	}
            $endpoint = "$SCHEME://$SERVER_NAME$SERVER_PORT$SCRIPT_NAME";
        }
        
        if(false == $schemaTargetNamespace) {
            $schemaTargetNamespace = $namespace;
        }
        
		$this->wsdl = new wsdl;
		$this->wsdl->serviceName = $serviceName;
        $this->wsdl->endpoint = $endpoint;
		$this->wsdl->namespaces['tns'] = $namespace;
		$this->wsdl->namespaces['soap'] = 'http://schemas.xmlsoap.org/wsdl/soap/';
		$this->wsdl->namespaces['wsdl'] = 'http://schemas.xmlsoap.org/wsdl/';
		if ($schemaTargetNamespace != $namespace) {
			$this->wsdl->namespaces['types'] = $schemaTargetNamespace;
		}
        $this->wsdl->schemas[$schemaTargetNamespace][0] = new xmlschema('', '', $this->wsdl->namespaces);
        $this->wsdl->schemas[$schemaTargetNamespace][0]->schemaTargetNamespace = $schemaTargetNamespace;
        $this->wsdl->schemas[$schemaTargetNamespace][0]->imports['http://schemas.xmlsoap.org/soap/encoding/'][0] = array('location' => '', 'loaded' => true);
        $this->wsdl->schemas[$schemaTargetNamespace][0]->imports['http://schemas.xmlsoap.org/wsdl/'][0] = array('location' => '', 'loaded' => true);
        $this->wsdl->bindings[$serviceName.'Binding'] = array(
        	'name'=>$serviceName.'Binding',
            'style'=>$style,
            'transport'=>$transport,
            'portType'=>$serviceName.'PortType');
        $this->wsdl->ports[$serviceName.'Port'] = array(
        	'binding'=>$serviceName.'Binding',
            'location'=>$endpoint,
            'bindingType'=>'http://schemas.xmlsoap.org/wsdl/soap/');
    }
}



?><?php



/**
* parses a WSDL file, allows access to it's data, other utility methods
* 
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access public 
*/
class wsdl extends nusoap_base {
	// URL or filename of the root of this WSDL
    var $wsdl; 
    // define internal arrays of bindings, ports, operations, messages, etc.
    var $schemas = array();
    var $currentSchema;
    var $message = array();
    var $complexTypes = array();
    var $messages = array();
    var $currentMessage;
    var $currentOperation;
    var $portTypes = array();
    var $currentPortType;
    var $bindings = array();
    var $currentBinding;
    var $ports = array();
    var $currentPort;
    var $opData = array();
    var $status = '';
    var $documentation = false;
    var $endpoint = ''; 
    // array of wsdl docs to import
    var $import = array(); 
    // parser vars
    var $parser;
    var $position = 0;
    var $depth = 0;
    var $depth_array = array();
	// for getting wsdl
	var $proxyhost = '';
    var $proxyport = '';
	var $proxyusername = '';
	var $proxypassword = '';
	var $timeout = 0;
	var $response_timeout = 30;

    /**
     * constructor
     * 
     * @param string $wsdl WSDL document URL
	 * @param string $proxyhost
	 * @param string $proxyport
	 * @param string $proxyusername
	 * @param string $proxypassword
	 * @param integer $timeout set the connection timeout
	 * @param integer $response_timeout set the response timeout
     * @access public 
     */
    function wsdl($wsdl = '',$proxyhost=false,$proxyport=false,$proxyusername=false,$proxypassword=false,$timeout=0,$response_timeout=300){
        $this->wsdl = $wsdl;
        $this->proxyhost = $proxyhost;
        $this->proxyport = $proxyport;
		$this->proxyusername = $proxyusername;
		$this->proxypassword = $proxypassword;
		$this->timeout = $timeout;
		$this->response_timeout = $response_timeout;
        
        // parse wsdl file
        if ($wsdl != "") {
            $this->debug('initial wsdl URL: ' . $wsdl);
            $this->parseWSDL($wsdl);
        }
        // imports
        // TODO: handle imports more properly, grabbing them in-line and nesting them
        	$imported_urls = array();
        	$imported = 1;
        	while ($imported > 0) {
        		$imported = 0;
        		// Schema imports
        		foreach ($this->schemas as $ns => $list) {
        			foreach ($list as $xs) {
						$wsdlparts = parse_url($this->wsdl);	// this is bogusly simple!
			            foreach ($xs->imports as $ns2 => $list2) {
			                for ($ii = 0; $ii < count($list2); $ii++) {
			                	if (! $list2[$ii]['loaded']) {
			                		$this->schemas[$ns]->imports[$ns2][$ii]['loaded'] = true;
			                		$url = $list2[$ii]['location'];
									if ($url != '') {
										$urlparts = parse_url($url);
										if (!isset($urlparts['host'])) {
											$url = $wsdlparts['scheme'] . '://' . $wsdlparts['host'] . 
													substr($wsdlparts['path'],0,strrpos($wsdlparts['path'],'/') + 1) .$urlparts['path'];
										}
										if (! in_array($url, $imported_urls)) {
						                	$this->parseWSDL($url);
					                		$imported++;
					                		$imported_urls[] = $url;
					                	}
									} else {
										$this->debug("Unexpected scenario: empty URL for unloaded import");
									}
								}
							}
			            } 
        			}
        		}
        		// WSDL imports
				$wsdlparts = parse_url($this->wsdl);	// this is bogusly simple!
	            foreach ($this->import as $ns => $list) {
	                for ($ii = 0; $ii < count($list); $ii++) {
	                	if (! $list[$ii]['loaded']) {
	                		$this->import[$ns][$ii]['loaded'] = true;
	                		$url = $list[$ii]['location'];
							if ($url != '') {
								$urlparts = parse_url($url);
								if (!isset($urlparts['host'])) {
									$url = $wsdlparts['scheme'] . '://' . $wsdlparts['host'] . 
											substr($wsdlparts['path'],0,strrpos($wsdlparts['path'],'/') + 1) .$urlparts['path'];
								}
								if (! in_array($url, $imported_urls)) {
				                	$this->parseWSDL($url);
			                		$imported++;
			                		$imported_urls[] = $url;
			                	}
							} else {
								$this->debug("Unexpected scenario: empty URL for unloaded import");
							}
						}
					}
	            } 
			}
        // add new data to operation data
        foreach($this->bindings as $binding => $bindingData) {
            if (isset($bindingData['operations']) && is_array($bindingData['operations'])) {
                foreach($bindingData['operations'] as $operation => $data) {
                    $this->debug('post-parse data gathering for ' . $operation);
                    $this->bindings[$binding]['operations'][$operation]['input'] = 
						isset($this->bindings[$binding]['operations'][$operation]['input']) ? 
						array_merge($this->bindings[$binding]['operations'][$operation]['input'], $this->portTypes[ $bindingData['portType'] ][$operation]['input']) :
						$this->portTypes[ $bindingData['portType'] ][$operation]['input'];
                    $this->bindings[$binding]['operations'][$operation]['output'] = 
						isset($this->bindings[$binding]['operations'][$operation]['output']) ?
						array_merge($this->bindings[$binding]['operations'][$operation]['output'], $this->portTypes[ $bindingData['portType'] ][$operation]['output']) :
						$this->portTypes[ $bindingData['portType'] ][$operation]['output'];
                    if(isset($this->messages[ $this->bindings[$binding]['operations'][$operation]['input']['message'] ])){
						$this->bindings[$binding]['operations'][$operation]['input']['parts'] = $this->messages[ $this->bindings[$binding]['operations'][$operation]['input']['message'] ];
					}
					if(isset($this->messages[ $this->bindings[$binding]['operations'][$operation]['output']['message'] ])){
                   		$this->bindings[$binding]['operations'][$operation]['output']['parts'] = $this->messages[ $this->bindings[$binding]['operations'][$operation]['output']['message'] ];
                    }
					if (isset($bindingData['style'])) {
                        $this->bindings[$binding]['operations'][$operation]['style'] = $bindingData['style'];
                    }
                    $this->bindings[$binding]['operations'][$operation]['transport'] = isset($bindingData['transport']) ? $bindingData['transport'] : '';
                    $this->bindings[$binding]['operations'][$operation]['documentation'] = isset($this->portTypes[ $bindingData['portType'] ][$operation]['documentation']) ? $this->portTypes[ $bindingData['portType'] ][$operation]['documentation'] : '';
                    $this->bindings[$binding]['operations'][$operation]['endpoint'] = isset($bindingData['endpoint']) ? $bindingData['endpoint'] : '';
                } 
            } 
        }
    }

    /**
     * parses the wsdl document
     * 
     * @param string $wsdl path or URL
     * @access private 
     */
    function parseWSDL($wsdl = '')
    {
        if ($wsdl == '') {
            $this->debug('no wsdl passed to parseWSDL()!!');
            $this->setError('no wsdl passed to parseWSDL()!!');
            return false;
        }
        
        // parse $wsdl for url format
        $wsdl_props = parse_url($wsdl);

        if (isset($wsdl_props['scheme']) && ($wsdl_props['scheme'] == 'http' || $wsdl_props['scheme'] == 'https')) {
            $this->debug('getting WSDL http(s) URL ' . $wsdl);
        	// get wsdl
	        $tr = new soap_transport_http($wsdl);
			$tr->request_method = 'GET';
			$tr->useSOAPAction = false;
			if($this->proxyhost && $this->proxyport){
				$tr->setProxy($this->proxyhost,$this->proxyport,$this->proxyusername,$this->proxypassword);
			}
			$tr->setEncoding('gzip, deflate');
			$wsdl_string = $tr->send('', $this->timeout, $this->response_timeout);
			//$this->debug("WSDL request\n" . $tr->outgoing_payload);
			//$this->debug("WSDL response\n" . $tr->incoming_payload);
			$this->appendDebug($tr->getDebug());
			// catch errors
			if($err = $tr->getError() ){
				$errstr = 'HTTP ERROR: '.$err;
				$this->debug($errstr);
	            $this->setError($errstr);
				unset($tr);
	            return false;
			}
			unset($tr);
			$this->debug("got WSDL URL");
        } else {
            // $wsdl is not http(s), so treat it as a file URL or plain file path
        	if (isset($wsdl_props['scheme']) && ($wsdl_props['scheme'] == 'file') && isset($wsdl_props['path'])) {
        		$path = isset($wsdl_props['host']) ? ($wsdl_props['host'] . ':' . $wsdl_props['path']) : $wsdl_props['path'];
        	} else {
        		$path = $wsdl;
        	}
            $this->debug('getting WSDL file ' . $path);
            if ($fp = @fopen($path, 'r')) {
                $wsdl_string = '';
                while ($data = fread($fp, 32768)) {
                    $wsdl_string .= $data;
                } 
                fclose($fp);
            } else {
            	$errstr = "Bad path to WSDL file $path";
            	$this->debug($errstr);
                $this->setError($errstr);
                return false;
            } 
        }
        $this->debug('Parse WSDL');
        // end new code added
        // Create an XML parser.
        $this->parser = xml_parser_create(); 
        // Set the options for parsing the XML data.
        // xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0); 
        // Set the object for the parser.
        xml_set_object($this->parser, $this); 
        // Set the element handlers for the parser.
        xml_set_element_handler($this->parser, 'start_element', 'end_element');
        xml_set_character_data_handler($this->parser, 'character_data');
        // Parse the XML file.
        if (!xml_parse($this->parser, $wsdl_string, true)) {
            // Display an error message.
            $errstr = sprintf(
				'XML error parsing WSDL from %s on line %d: %s',
				$wsdl,
                xml_get_current_line_number($this->parser),
                xml_error_string(xml_get_error_code($this->parser))
                );
            $this->debug($errstr);
			$this->debug("XML payload:\n" . $wsdl_string);
            $this->setError($errstr);
            return false;
        } 
		// free the parser
        xml_parser_free($this->parser);
        $this->debug('Parsing WSDL done');
		// catch wsdl parse errors
		if($this->getError()){
			return false;
		}
        return true;
    } 

    /**
     * start-element handler
     * 
     * @param string $parser XML parser object
     * @param string $name element name
     * @param string $attrs associative array of attributes
     * @access private 
     */
    function start_element($parser, $name, $attrs)
    {
        if ($this->status == 'schema') {
            $this->currentSchema->schemaStartElement($parser, $name, $attrs);
            $this->appendDebug($this->currentSchema->getDebug());
            $this->currentSchema->clearDebug();
        } elseif (ereg('schema$', $name)) {
        	$this->debug('Parsing WSDL schema');
            // $this->debug("startElement for $name ($attrs[name]). status = $this->status (".$this->getLocalPart($name).")");
            $this->status = 'schema';
            $this->currentSchema = new xmlschema('', '', $this->namespaces);
            $this->currentSchema->schemaStartElement($parser, $name, $attrs);
            $this->appendDebug($this->currentSchema->getDebug());
            $this->currentSchema->clearDebug();
        } else {
            // position in the total number of elements, starting from 0
            $pos = $this->position++;
            $depth = $this->depth++; 
            // set self as current value for this depth
            $this->depth_array[$depth] = $pos;
            $this->message[$pos] = array('cdata' => ''); 
            // get element prefix
            if (ereg(':', $name)) {
                // get ns prefix
                $prefix = substr($name, 0, strpos($name, ':')); 
                // get ns
                $namespace = isset($this->namespaces[$prefix]) ? $this->namespaces[$prefix] : ''; 
                // get unqualified name
                $name = substr(strstr($name, ':'), 1);
            } 

            if (count($attrs) > 0) {
                foreach($attrs as $k => $v) {
                    // if ns declarations, add to class level array of valid namespaces
                    if (ereg("^xmlns", $k)) {
                        if ($ns_prefix = substr(strrchr($k, ':'), 1)) {
                            $this->namespaces[$ns_prefix] = $v;
                        } else {
                            $this->namespaces['ns' . (count($this->namespaces) + 1)] = $v;
                        } 
                        if ($v == 'http://www.w3.org/2001/XMLSchema' || $v == 'http://www.w3.org/1999/XMLSchema') {
                            $this->XMLSchemaVersion = $v;
                            $this->namespaces['xsi'] = $v . '-instance';
                        } 
                    } //  
                    // expand each attribute
                    $k = strpos($k, ':') ? $this->expandQname($k) : $k;
                    if ($k != 'location' && $k != 'soapAction' && $k != 'namespace') {
                        $v = strpos($v, ':') ? $this->expandQname($v) : $v;
                    } 
                    $eAttrs[$k] = $v;
                } 
                $attrs = $eAttrs;
            } else {
                $attrs = array();
            } 
            // find status, register data
            switch ($this->status) {
                case 'message':
                    if ($name == 'part') {
                    	if (isset($attrs['type'])) {
		                    $this->debug("msg " . $this->currentMessage . ": found part $attrs[name]: " . implode(',', $attrs));
		                    $this->messages[$this->currentMessage][$attrs['name']] = $attrs['type'];
            			} 
			            if (isset($attrs['element'])) {
			                $this->messages[$this->currentMessage][$attrs['name']] = $attrs['element'];
			            } 
        			} 
        			break;
			    case 'portType':
			        switch ($name) {
			            case 'operation':
			                $this->currentPortOperation = $attrs['name'];
			                $this->debug("portType $this->currentPortType operation: $this->currentPortOperation");
			                if (isset($attrs['parameterOrder'])) {
			                	$this->portTypes[$this->currentPortType][$attrs['name']]['parameterOrder'] = $attrs['parameterOrder'];
			        		} 
			        		break;
					    case 'documentation':
					        $this->documentation = true;
					        break; 
					    // merge input/output data
					    default:
					        $m = isset($attrs['message']) ? $this->getLocalPart($attrs['message']) : '';
					        $this->portTypes[$this->currentPortType][$this->currentPortOperation][$name]['message'] = $m;
					        break;
					} 
			    	break;
				case 'binding':
				    switch ($name) {
				        case 'binding': 
				            // get ns prefix
				            if (isset($attrs['style'])) {
				            $this->bindings[$this->currentBinding]['prefix'] = $prefix;
					    	} 
					    	$this->bindings[$this->currentBinding] = array_merge($this->bindings[$this->currentBinding], $attrs);
					    	break;
						case 'header':
						    $this->bindings[$this->currentBinding]['operations'][$this->currentOperation][$this->opStatus]['headers'][] = $attrs;
						    break;
						case 'operation':
						    if (isset($attrs['soapAction'])) {
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation]['soapAction'] = $attrs['soapAction'];
						    } 
						    if (isset($attrs['style'])) {
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation]['style'] = $attrs['style'];
						    } 
						    if (isset($attrs['name'])) {
						        $this->currentOperation = $attrs['name'];
						        $this->debug("current binding operation: $this->currentOperation");
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation]['name'] = $attrs['name'];
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation]['binding'] = $this->currentBinding;
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation]['endpoint'] = isset($this->bindings[$this->currentBinding]['endpoint']) ? $this->bindings[$this->currentBinding]['endpoint'] : '';
						    } 
						    break;
						case 'input':
						    $this->opStatus = 'input';
						    break;
						case 'output':
						    $this->opStatus = 'output';
						    break;
						case 'body':
						    if (isset($this->bindings[$this->currentBinding]['operations'][$this->currentOperation][$this->opStatus])) {
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation][$this->opStatus] = array_merge($this->bindings[$this->currentBinding]['operations'][$this->currentOperation][$this->opStatus], $attrs);
						    } else {
						        $this->bindings[$this->currentBinding]['operations'][$this->currentOperation][$this->opStatus] = $attrs;
						    } 
						    break;
					} 
					break;
				case 'service':
					switch ($name) {
					    case 'port':
					        $this->currentPort = $attrs['name'];
					        $this->debug('current port: ' . $this->currentPort);
					        $this->ports[$this->currentPort]['binding'] = $this->getLocalPart($attrs['binding']);
					
					        break;
					    case 'address':
					        $this->ports[$this->currentPort]['location'] = $attrs['location'];
					        $this->ports[$this->currentPort]['bindingType'] = $namespace;
					        $this->bindings[ $this->ports[$this->currentPort]['binding'] ]['bindingType'] = $namespace;
					        $this->bindings[ $this->ports[$this->currentPort]['binding'] ]['endpoint'] = $attrs['location'];
					        break;
					} 
					break;
			} 
		// set status
		switch ($name) {
			case 'import':
			    if (isset($attrs['location'])) {
                    $this->import[$attrs['namespace']][] = array('location' => $attrs['location'], 'loaded' => false);
                    $this->debug('parsing import ' . $attrs['namespace']. ' - ' . $attrs['location'] . ' (' . count($this->import[$attrs['namespace']]).')');
				} else {
                    $this->import[$attrs['namespace']][] = array('location' => '', 'loaded' => true);
					if (! $this->getPrefixFromNamespace($attrs['namespace'])) {
						$this->namespaces['ns'.(count($this->namespaces)+1)] = $attrs['namespace'];
					}
                    $this->debug('parsing import ' . $attrs['namespace']. ' - [no location] (' . count($this->import[$attrs['namespace']]).')');
				}
				break;
			//wait for schema
			//case 'types':
			//	$this->status = 'schema';
			//	break;
			case 'message':
				$this->status = 'message';
				$this->messages[$attrs['name']] = array();
				$this->currentMessage = $attrs['name'];
				break;
			case 'portType':
				$this->status = 'portType';
				$this->portTypes[$attrs['name']] = array();
				$this->currentPortType = $attrs['name'];
				break;
			case "binding":
				if (isset($attrs['name'])) {
				// get binding name
					if (strpos($attrs['name'], ':')) {
			    		$this->currentBinding = $this->getLocalPart($attrs['name']);
					} else {
			    		$this->currentBinding = $attrs['name'];
					} 
					$this->status = 'binding';
					$this->bindings[$this->currentBinding]['portType'] = $this->getLocalPart($attrs['type']);
					$this->debug("current binding: $this->currentBinding of portType: " . $attrs['type']);
				} 
				break;
			case 'service':
				$this->serviceName = $attrs['name'];
				$this->status = 'service';
				$this->debug('current service: ' . $this->serviceName);
				break;
			case 'definitions':
				foreach ($attrs as $name => $value) {
					$this->wsdl_info[$name] = $value;
				} 
				break;
			} 
		} 
	} 

	/**
	* end-element handler
	* 
	* @param string $parser XML parser object
	* @param string $name element name
	* @access private 
	*/
	function end_element($parser, $name){ 
		// unset schema status
		if (/*ereg('types$', $name) ||*/ ereg('schema$', $name)) {
			$this->status = "";
			$this->schemas[$this->currentSchema->schemaTargetNamespace][] = $this->currentSchema;
        	$this->debug('Parsing WSDL schema done');
		} 
		if ($this->status == 'schema') {
			$this->currentSchema->schemaEndElement($parser, $name);
		} else {
			// bring depth down a notch
			$this->depth--;
		} 
		// end documentation
		if ($this->documentation) {
			//TODO: track the node to which documentation should be assigned; it can be a part, message, etc.
			//$this->portTypes[$this->currentPortType][$this->currentPortOperation]['documentation'] = $this->documentation;
			$this->documentation = false;
		} 
	} 

	/**
	 * element content handler
	 * 
	 * @param string $parser XML parser object
	 * @param string $data element content
	 * @access private 
	 */
	function character_data($parser, $data)
	{
		$pos = isset($this->depth_array[$this->depth]) ? $this->depth_array[$this->depth] : 0;
		if (isset($this->message[$pos]['cdata'])) {
			$this->message[$pos]['cdata'] .= $data;
		} 
		if ($this->documentation) {
			$this->documentation .= $data;
		} 
	} 
	
	function getBindingData($binding)
	{
		if (is_array($this->bindings[$binding])) {
			return $this->bindings[$binding];
		} 
	}
	
	/**
	 * returns an assoc array of operation names => operation data
	 * 
	 * @param string $bindingType eg: soap, smtp, dime (only soap is currently supported)
	 * @return array 
	 * @access public 
	 */
	function getOperations($bindingType = 'soap')
	{
		$ops = array();
		if ($bindingType == 'soap') {
			$bindingType = 'http://schemas.xmlsoap.org/wsdl/soap/';
		}
		// loop thru ports
		foreach($this->ports as $port => $portData) {
			// binding type of port matches parameter
			if ($portData['bindingType'] == $bindingType) {
				//$this->debug("getOperations for port $port");
				//$this->debug("port data: " . $this->varDump($portData));
				//$this->debug("bindings: " . $this->varDump($this->bindings[ $portData['binding'] ]));
				// merge bindings
				if (isset($this->bindings[ $portData['binding'] ]['operations'])) {
					$ops = array_merge ($ops, $this->bindings[ $portData['binding'] ]['operations']);
				}
			}
		} 
		return $ops;
	} 
	
	/**
	 * returns an associative array of data necessary for calling an operation
	 * 
	 * @param string $operation , name of operation
	 * @param string $bindingType , type of binding eg: soap
	 * @return array 
	 * @access public 
	 */
	function getOperationData($operation, $bindingType = 'soap')
	{
		if ($bindingType == 'soap') {
			$bindingType = 'http://schemas.xmlsoap.org/wsdl/soap/';
		}
		// loop thru ports
		foreach($this->ports as $port => $portData) {
			// binding type of port matches parameter
			if ($portData['bindingType'] == $bindingType) {
				// get binding
				//foreach($this->bindings[ $portData['binding'] ]['operations'] as $bOperation => $opData) {
				foreach(array_keys($this->bindings[ $portData['binding'] ]['operations']) as $bOperation) {
					if ($operation == $bOperation) {
						$opData = $this->bindings[ $portData['binding'] ]['operations'][$operation];
					    return $opData;
					} 
				} 
			}
		} 
	}
	
	/**
    * returns an array of information about a given type
    * returns false if no type exists by the given name
    *
	*	 typeDef = array(
	*	 'elements' => array(), // refs to elements array
	*	'restrictionBase' => '',
	*	'phpType' => '',
	*	'order' => '(sequence|all)',
	*	'attrs' => array() // refs to attributes array
	*	)
    *
    * @param $type string
    * @param $ns string
    * @return mixed
    * @access public
    * @see xmlschema
    */
	function getTypeDef($type, $ns) {
		if ((! $ns) && isset($this->namespaces['tns'])) {
			$ns = $this->namespaces['tns'];
			$this->debug("type namespace forced to $ns");
		}
		if (isset($this->schemas[$ns])) {
			$this->debug("have schema for namespace $ns");
			for ($i = 0; $i < count($this->schemas[$ns]); $i++) {
				$xs = &$this->schemas[$ns][$i];
				$t = $xs->getTypeDef($type);
				$this->appendDebug($xs->getDebug());
				$xs->clearDebug();
				if ($t) {
					return $t;
				}
			}
		} else {
			$this->debug("do not have schema for namespace $ns");
		}
		return false;
	}

    /**
    * prints html description of services
    *
    * @access private
    */
    function webDescription(){
		$b = '
		<html><head><title>NuSOAP: '.$this->serviceName.'</title>
		<style type="text/css">
		    body    { font-family: arial; color: #000000; background-color: #ffffff; margin: 0px 0px 0px 0px; }
		    p       { font-family: arial; color: #000000; margin-top: 0px; margin-bottom: 12px; }
		    pre { background-color: silver; padding: 5px; font-family: Courier New; font-size: x-small; color: #000000;}
		    ul      { margin-top: 10px; margin-left: 20px; }
		    li      { list-style-type: none; margin-top: 10px; color: #000000; }
		    .content{
			margin-left: 0px; padding-bottom: 2em; }
		    .nav {
			padding-top: 10px; padding-bottom: 10px; padding-left: 15px; font-size: .70em;
			margin-top: 10px; margin-left: 0px; color: #000000;
			background-color: #ccccff; width: 20%; margin-left: 20px; margin-top: 20px; }
		    .title {
			font-family: arial; font-size: 26px; color: #ffffff;
			background-color: #999999; width: 105%; margin-left: 0px;
			padding-top: 10px; padding-bottom: 10px; padding-left: 15px;}
		    .hidden {
			position: absolute; visibility: hidden; z-index: 200; left: 250px; top: 100px;
			font-family: arial; overflow: hidden; width: 600;
			padding: 20px; font-size: 10px; background-color: #999999;
			layer-background-color:#FFFFFF; }
		    a,a:active  { color: charcoal; font-weight: bold; }
		    a:visited   { color: #666666; font-weight: bold; }
		    a:hover     { color: cc3300; font-weight: bold; }
		</style>
		<script language="JavaScript" type="text/javascript">
		<!--
		// POP-UP CAPTIONS...
		function lib_bwcheck(){ //Browsercheck (needed)
		    this.ver=navigator.appVersion
		    this.agent=navigator.userAgent
		    this.dom=document.getElementById?1:0
		    this.opera5=this.agent.indexOf("Opera 5")>-1
		    this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0;
		    this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
		    this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
		    this.ie=this.ie4||this.ie5||this.ie6
		    this.mac=this.agent.indexOf("Mac")>-1
		    this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0;
		    this.ns4=(document.layers && !this.dom)?1:0;
		    this.bw=(this.ie6 || this.ie5 || this.ie4 || this.ns4 || this.ns6 || this.opera5)
		    return this
		}
		var bw = new lib_bwcheck()
		//Makes crossbrowser object.
		function makeObj(obj){
		    this.evnt=bw.dom? document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?document.layers[obj]:0;
		    if(!this.evnt) return false
		    this.css=bw.dom||bw.ie4?this.evnt.style:bw.ns4?this.evnt:0;
		    this.wref=bw.dom||bw.ie4?this.evnt:bw.ns4?this.css.document:0;
		    this.writeIt=b_writeIt;
		    return this
		}
		// A unit of measure that will be added when setting the position of a layer.
		//var px = bw.ns4||window.opera?"":"px";
		function b_writeIt(text){
		    if (bw.ns4){this.wref.write(text);this.wref.close()}
		    else this.wref.innerHTML = text
		}
		//Shows the messages
		var oDesc;
		function popup(divid){
		    if(oDesc = new makeObj(divid)){
			oDesc.css.visibility = "visible"
		    }
		}
		function popout(){ // Hides message
		    if(oDesc) oDesc.css.visibility = "hidden"
		}
		//-->
		</script>
		</head>
		<body>
		<div class=content>
			<br><br>
			<div class=title>'.$this->serviceName.'</div>
			<div class=nav>
				<p>View the <a href="'.(isset($GLOBALS['PHP_SELF']) ? $GLOBALS['PHP_SELF'] : $_SERVER['PHP_SELF']).'?wsdl">WSDL</a> for the service.
				Click on an operation name to view it&apos;s details.</p>
				<ul>';
				foreach($this->getOperations() as $op => $data){
				    $b .= "<li><a href='#' onclick=\"popup('$op')\">$op</a></li>";
				    // create hidden div
				    $b .= "<div id='$op' class='hidden'>
				    <a href='#' onclick='popout()'><font color='#ffffff'>Close</font></a><br><br>";
				    foreach($data as $donnie => $marie){ // loop through opdata
						if($donnie == 'input' || $donnie == 'output'){ // show input/output data
						    $b .= "<font color='white'>".ucfirst($donnie).':</font><br>';
						    foreach($marie as $captain => $tenille){ // loop through data
								if($captain == 'parts'){ // loop thru parts
								    $b .= "&nbsp;&nbsp;$captain:<br>";
					                //if(is_array($tenille)){
								    	foreach($tenille as $joanie => $chachi){
											$b .= "&nbsp;&nbsp;&nbsp;&nbsp;$joanie: $chachi<br>";
								    	}
					        		//}
								} else {
								    $b .= "&nbsp;&nbsp;$captain: $tenille<br>";
								}
						    }
						} else {
						    $b .= "<font color='white'>".ucfirst($donnie).":</font> $marie<br>";
						}
				    }
					$b .= '</div>';
				}
				$b .= '
				<ul>
			</div>
		</div></body></html>';
		return $b;
    }

	/**
	* serialize the parsed wsdl
	*
	* @param $debug mixed whether to put debug=1 in endpoint URL
	* @return string , serialization of WSDL
	* @access public 
	*/
	function serialize($debug = 0)
	{
		$xml = '<?xml version="1.0" encoding="ISO-8859-1"?><definitions';
		foreach($this->namespaces as $k => $v) {
			$xml .= " xmlns:$k=\"$v\"";
		} 
		// 10.9.02 - add poulter fix for wsdl and tns declarations
		if (isset($this->namespaces['wsdl'])) {
			$xml .= " xmlns=\"" . $this->namespaces['wsdl'] . "\"";
		} 
		if (isset($this->namespaces['tns'])) {
			$xml .= " targetNamespace=\"" . $this->namespaces['tns'] . "\"";
		} 
		$xml .= '>'; 
		// imports
		if (sizeof($this->import) > 0) {
			foreach($this->import as $ns => $list) {
				foreach ($list as $ii) {
					if ($ii['location'] != '') {
						$xml .= '<import location="' . $ii['location'] . '" namespace="' . $ns . '" />';
					} else {
						$xml .= '<import namespace="' . $ns . '" />';
					}
				}
			} 
		} 
		// types
		if (count($this->schemas)>=1) {
			$xml .= '<types>';
			foreach ($this->schemas as $ns => $list) {
				foreach ($list as $xs) {
					$xml .= $xs->serializeSchema();
				}
			}
			$xml .= '</types>';
		} 
		// messages
		if (count($this->messages) >= 1) {
			foreach($this->messages as $msgName => $msgParts) {
				$xml .= '<message name="' . $msgName . '">';
				if(is_array($msgParts)){
					foreach($msgParts as $partName => $partType) {
						// print 'serializing '.$partType.', sv: '.$this->XMLSchemaVersion.'<br>';
						if (strpos($partType, ':')) {
						    $typePrefix = $this->getPrefixFromNamespace($this->getPrefix($partType));
						} elseif (isset($this->typemap[$this->namespaces['xsd']][$partType])) {
						    // print 'checking typemap: '.$this->XMLSchemaVersion.'<br>';
						    $typePrefix = 'xsd';
						} else {
						    foreach($this->typemap as $ns => $types) {
						        if (isset($types[$partType])) {
						            $typePrefix = $this->getPrefixFromNamespace($ns);
						        } 
						    } 
						    if (!isset($typePrefix)) {
						        die("$partType has no namespace!");
						    } 
						} 
						$typeDef = $this->getTypeDef($this->getLocalPart($partType), $typePrefix);
						if ($typeDef['typeClass'] == 'element') {
							$elementortype = 'element';
						} else {
							$elementortype = 'type';
						}
						$xml .= '<part name="' . $partName . '" ' . $elementortype . '="' . $typePrefix . ':' . $this->getLocalPart($partType) . '" />';
					}
				}
				$xml .= '</message>';
			} 
		} 
		// bindings & porttypes
		if (count($this->bindings) >= 1) {
			$binding_xml = '';
			$portType_xml = '';
			foreach($this->bindings as $bindingName => $attrs) {
				$binding_xml .= '<binding name="' . $bindingName . '" type="tns:' . $attrs['portType'] . '">';
				$binding_xml .= '<soap:binding style="' . $attrs['style'] . '" transport="' . $attrs['transport'] . '"/>';
				$portType_xml .= '<portType name="' . $attrs['portType'] . '">';
				foreach($attrs['operations'] as $opName => $opParts) {
					$binding_xml .= '<operation name="' . $opName . '">';
					$binding_xml .= '<soap:operation soapAction="' . $opParts['soapAction'] . '" style="'. $opParts['style'] . '"/>';
					if (isset($opParts['input']['encodingStyle']) && $opParts['input']['encodingStyle'] != '') {
						$enc_style = ' encodingStyle="' . $opParts['input']['encodingStyle'] . '"';
					} else {
						$enc_style = '';
					}
					$binding_xml .= '<input><soap:body use="' . $opParts['input']['use'] . '" namespace="' . $opParts['input']['namespace'] . '"' . $enc_style . '/></input>';
					if (isset($opParts['output']['encodingStyle']) && $opParts['output']['encodingStyle'] != '') {
						$enc_style = ' encodingStyle="' . $opParts['output']['encodingStyle'] . '"';
					} else {
						$enc_style = '';
					}
					$binding_xml .= '<output><soap:body use="' . $opParts['output']['use'] . '" namespace="' . $opParts['output']['namespace'] . '"' . $enc_style . '/></output>';
					$binding_xml .= '</operation>';
					$portType_xml .= '<operation name="' . $opParts['name'] . '"';
					if (isset($opParts['parameterOrder'])) {
					    $portType_xml .= ' parameterOrder="' . $opParts['parameterOrder'] . '"';
					} 
					$portType_xml .= '>';
					if(isset($opParts['documentation']) && $opParts['documentation'] != '') {
						$portType_xml .= '<documentation>' . htmlspecialchars($opParts['documentation']) . '</documentation>';
					}
					$portType_xml .= '<input message="tns:' . $opParts['input']['message'] . '"/>';
					$portType_xml .= '<output message="tns:' . $opParts['output']['message'] . '"/>';
					$portType_xml .= '</operation>';
				} 
				$portType_xml .= '</portType>';
				$binding_xml .= '</binding>';
			} 
			$xml .= $portType_xml . $binding_xml;
		} 
		// services
		$xml .= '<service name="' . $this->serviceName . '">';
		if (count($this->ports) >= 1) {
			foreach($this->ports as $pName => $attrs) {
				$xml .= '<port name="' . $pName . '" binding="tns:' . $attrs['binding'] . '">';
				$xml .= '<soap:address location="' . $attrs['location'] . ($debug ? '?debug=1' : '') . '"/>';
				$xml .= '</port>';
			} 
		} 
		$xml .= '</service>';
		return $xml . '</definitions>';
	} 
	
	/**
	 * serialize a PHP value according to a WSDL message definition
	 * 
	 * TODO
	 * - multi-ref serialization
	 * - validate PHP values against type definitions, return errors if invalid
	 * 
	 * @param string $ type name
	 * @param mixed $ param value
	 * @return mixed new param or false if initial value didn't validate
	 */
	function serializeRPCParameters($operation, $direction, $parameters)
	{
		$this->debug('in serializeRPCParameters with operation '.$operation.', direction '.$direction.' and '.count($parameters).' param(s), and xml schema version ' . $this->XMLSchemaVersion); 
		
		if ($direction != 'input' && $direction != 'output') {
			$this->debug('The value of the \$direction argument needs to be either "input" or "output"');
			$this->setError('The value of the \$direction argument needs to be either "input" or "output"');
			return false;
		} 
		if (!$opData = $this->getOperationData($operation)) {
			$this->debug('Unable to retrieve WSDL data for operation: ' . $operation);
			$this->setError('Unable to retrieve WSDL data for operation: ' . $operation);
			return false;
		}
		$this->debug('opData:');
		$this->appendDebug($this->varDump($opData));

		// Get encoding style for output and set to current
		$encodingStyle = 'http://schemas.xmlsoap.org/soap/encoding/';
		if(($direction == 'input') && isset($opData['output']['encodingStyle']) && ($opData['output']['encodingStyle'] != $encodingStyle)) {
			$encodingStyle = $opData['output']['encodingStyle'];
			$enc_style = $encodingStyle;
		}

		// set input params
		$xml = '';
		if (isset($opData[$direction]['parts']) && sizeof($opData[$direction]['parts']) > 0) {
			
			$use = $opData[$direction]['use'];
			$this->debug('have ' . count($opData[$direction]['parts']) . ' part(s) to serialize');
			if (is_array($parameters)) {
				$parametersArrayType = $this->isArraySimpleOrStruct($parameters);
				$this->debug('have ' . count($parameters) . ' parameter(s) provided as ' . $parametersArrayType . ' to serialize');
				foreach($opData[$direction]['parts'] as $name => $type) {
					$this->debug('serializing part "'.$name.'" of type "'.$type.'"');
					// Track encoding style
					if (isset($opData[$direction]['encodingStyle']) && $encodingStyle != $opData[$direction]['encodingStyle']) {
						$encodingStyle = $opData[$direction]['encodingStyle'];			
						$enc_style = $encodingStyle;
					} else {
						$enc_style = false;
					}
					// NOTE: add error handling here
					// if serializeType returns false, then catch global error and fault
					if ($parametersArrayType == 'arraySimple') {
						$p = array_shift($parameters);
						$this->debug('calling serializeType w/indexed param');
						$xml .= $this->serializeType($name, $type, $p, $use, $enc_style);
					} elseif (isset($parameters[$name])) {
						$this->debug('calling serializeType w/named param');
						$xml .= $this->serializeType($name, $type, $parameters[$name], $use, $enc_style);
					} else {
						// TODO: only send nillable
						$this->debug('calling serializeType w/null param');
						$xml .= $this->serializeType($name, $type, null, $use, $enc_style);
					}
				}
			} else {
				$this->debug('no parameters passed.');
			}
		}
		$this->debug("serializeRPCParameters returning: $xml");
		return $xml;
	} 
	
	/**
	 * serialize a PHP value according to a WSDL message definition
	 * 
	 * TODO
	 * - multi-ref serialization
	 * - validate PHP values against type definitions, return errors if invalid
	 * 
	 * @param string $ type name
	 * @param mixed $ param value
	 * @return mixed new param or false if initial value didn't validate
	 */
	function serializeParameters($operation, $direction, $parameters)
	{
		$this->debug('in serializeParameters with operation '.$operation.', direction '.$direction.' and '.count($parameters).' param(s), and xml schema version ' . $this->XMLSchemaVersion); 
		
		if ($direction != 'input' && $direction != 'output') {
			$this->debug('The value of the \$direction argument needs to be either "input" or "output"');
			$this->setError('The value of the \$direction argument needs to be either "input" or "output"');
			return false;
		} 
		if (!$opData = $this->getOperationData($operation)) {
			$this->debug('Unable to retrieve WSDL data for operation: ' . $operation);
			$this->setError('Unable to retrieve WSDL data for operation: ' . $operation);
			return false;
		}
		$this->debug('opData:');
		$this->appendDebug($this->varDump($opData));
		
		// Get encoding style for output and set to current
		$encodingStyle = 'http://schemas.xmlsoap.org/soap/encoding/';
		if(($direction == 'input') && isset($opData['output']['encodingStyle']) && ($opData['output']['encodingStyle'] != $encodingStyle)) {
			$encodingStyle = $opData['output']['encodingStyle'];
			$enc_style = $encodingStyle;
		}
		
		// set input params
		$xml = '';
		if (isset($opData[$direction]['parts']) && sizeof($opData[$direction]['parts']) > 0) {
			
			$use = $opData[$direction]['use'];
			$this->debug("use=$use");
			$this->debug('got ' . count($opData[$direction]['parts']) . ' part(s)');
			if (is_array($parameters)) {
				$parametersArrayType = $this->isArraySimpleOrStruct($parameters);
				$this->debug('have ' . $parametersArrayType . ' parameters');
				foreach($opData[$direction]['parts'] as $name => $type) {
					$this->debug('serializing part "'.$name.'" of type "'.$type.'"');
					// Track encoding style
					if(isset($opData[$direction]['encodingStyle']) && $encodingStyle != $opData[$direction]['encodingStyle']) {
						$encodingStyle = $opData[$direction]['encodingStyle'];			
						$enc_style = $encodingStyle;
					} else {
						$enc_style = false;
					}
					// NOTE: add error handling here
					// if serializeType returns false, then catch global error and fault
					if ($parametersArrayType == 'arraySimple') {
						$p = array_shift($parameters);
						$this->debug('calling serializeType w/indexed param');
						$xml .= $this->serializeType($name, $type, $p, $use, $enc_style);
					} elseif (isset($parameters[$name])) {
						$this->debug('calling serializeType w/named param');
						$xml .= $this->serializeType($name, $type, $parameters[$name], $use, $enc_style);
					} else {
						// TODO: only send nillable
						$this->debug('calling serializeType w/null param');
						$xml .= $this->serializeType($name, $type, null, $use, $enc_style);
					}
				}
			} else {
				$this->debug('no parameters passed.');
			}
		}
		$this->debug("serializeParameters returning: $xml");
		return $xml;
	} 
	
	/**
	 * serializes a PHP value according a given type definition
	 * 
	 * @param string $name , name of type (part)
	 * @param string $type , type of type, heh (type or element)
	 * @param mixed $value , a native PHP value (parameter value)
	 * @param string $use , use for part (encoded|literal)
	 * @param string $encodingStyle , use to add encoding changes to serialisation
	 * @return string serialization
	 * @access public 
	 */
	function serializeType($name, $type, $value, $use='encoded', $encodingStyle=false)
	{
		$this->debug("in serializeType: $name, $type, $use, $encodingStyle");
		$this->debug("value:");
		$this->appendDebug($this->varDump($value));
		if($use == 'encoded' && $encodingStyle) {
			$encodingStyle = ' SOAP-ENV:encodingStyle="' . $encodingStyle . '"';
		}

		// if a soap_val has been supplied, let its type override the WSDL
    	if (is_object($value) && get_class($value) == 'soapval') {
    		// TODO: get attributes from soapval?
    		if ($value->type_ns) {
    			$type = $value->type_ns . ':' . $value->type;
		    	$forceType = true;
		    	$this->debug("in serializeType: soapval overrides type to $type");
    		} elseif ($value->type) {
	    		$type = $value->type;
		    	$forceType = true;
		    	$this->debug("in serializeType: soapval overrides type to $type");
	    	} else {
	    		$forceType = false;
		    	$this->debug("in serializeType: soapval does not override type");
	    	}
	    	$attrs = $value->attributes;
	    	$value = $value->value;
	    	$this->debug("in serializeType: soapval overrides value to $value");
	    	if ($attrs) {
	    		foreach ($attrs as $n => $v) {
	    			$value['!' . $n] = $v;
	    		}
		    	$this->debug("in serializeType: soapval provides attributes");
		    }
        } else {
        	$forceType = false;
        }

		$xml = '';
		if (strpos($type, ':')) {
			$uqType = substr($type, strrpos($type, ':') + 1);
			$ns = substr($type, 0, strrpos($type, ':'));
			$this->debug("got a prefixed type: $uqType, $ns");
			if ($this->getNamespaceFromPrefix($ns)) {
				$ns = $this->getNamespaceFromPrefix($ns);
				$this->debug("expanded prefixed type: $uqType, $ns");
			}

			if($ns == $this->XMLSchemaVersion || $ns == 'http://schemas.xmlsoap.org/soap/encoding/'){
				$this->debug('type namespace indicates XML Schema or SOAP Encoding type');
				if (is_null($value)) {
					if ($use == 'literal') {
						// TODO: depends on nillable
						$xml = "<$name/>";
					} else {
						$xml = "<$name xsi:nil=\"true\"/>";
					}
					$this->debug("serializeType returning: $xml");
					return $xml;
				}
		    	if ($uqType == 'boolean' && !$value) {
					$value = 'false';
				} elseif ($uqType == 'boolean') {
					$value = 'true';
				} 
				if ($uqType == 'string' && gettype($value) == 'string') {
					$value = $this->expandEntities($value);
				} 
				// it's a scalar
				// TODO: what about null/nil values?
				// check type isn't a custom type extending xmlschema namespace
				if (!$this->getTypeDef($uqType, $ns)) {
					if ($use == 'literal') {
						if ($forceType) {
							$xml = "<$name xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\">$value</$name>";
						} else {
							$xml = "<$name>$value</$name>";
						}
					} else {
						$xml = "<$name xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\"$encodingStyle>$value</$name>";
					}
					$this->debug("serializeType returning: $xml");
					return $xml;
				}
				$this->debug('custom type extends XML Schema or SOAP Encoding namespace (yuck)');
			} else if ($ns == 'http://xml.apache.org/xml-soap') {
				if ($uqType == 'Map') {
					$contents = '';
					foreach($value as $k => $v) {
						$this->debug("serializing map element: key $k, value $v");
						$contents .= '<item>';
						$contents .= $this->serialize_val($k,'key',false,false,false,false,$use);
						$contents .= $this->serialize_val($v,'value',false,false,false,false,$use);
						$contents .= '</item>';
					}
					if ($use == 'literal') {
						if ($forceType) {
							$xml = "<$name xsi:type=\"" . $this->getPrefixFromNamespace('http://xml.apache.org/xml-soap') . ":$uqType\">$contents</$name>";
						} else {
							$xml = "<$name>$contents</$name>";
						}
					} else {
						$xml = "<$name xsi:type=\"" . $this->getPrefixFromNamespace('http://xml.apache.org/xml-soap') . ":$uqType\"$encodingStyle>$contents</$name>";
					}
					$this->debug("serializeType returning: $xml");
					return $xml;
				}
			}
		} else {
			$this->debug("No namespace for type $type");
			$ns = '';
			$uqType = $type;
		}
		if(!$typeDef = $this->getTypeDef($uqType, $ns)){
			$this->setError("$type ($uqType) is not a supported type.");
			$this->debug("$type ($uqType) is not a supported type.");
			return false;
		} else {
			$this->debug("typedef:");
			$this->appendDebug($this->varDump($typeDef));
		}
		$phpType = $typeDef['phpType'];
		$this->debug("serializeType: uqType: $uqType, ns: $ns, phptype: $phpType, arrayType: " . (isset($typeDef['arrayType']) ? $typeDef['arrayType'] : '') ); 
		// if php type == struct, map value to the <all> element names
		if ($phpType == 'struct') {
			if (isset($typeDef['typeClass']) && $typeDef['typeClass'] == 'element') {
				$elementName = $uqType;
				if (isset($typeDef['form']) && ($typeDef['form'] == 'qualified')) {
					$elementNS = " xmlns=\"$ns\"";
				} else {
					$elementNS = '';
				}
			} else {
				$elementName = $name;
				$elementNS = '';
			}
			if (is_null($value)) {
				if ($use == 'literal') {
					// TODO: depends on nillable
					$xml = "<$elementName$elementNS/>";
				} else {
					$xml = "<$elementName$elementNS xsi:nil=\"true\"/>";
				}
				$this->debug("serializeType returning: $xml");
				return $xml;
			}
			$elementAttrs = $this->serializeComplexTypeAttributes($typeDef, $value, $ns, $uqType);
			if ($use == 'literal') {
				if ($forceType) {
					$xml = "<$elementName$elementNS$elementAttrs xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\">";
				} else {
					$xml = "<$elementName$elementNS$elementAttrs>";
				}
			} else {
				$xml = "<$elementName$elementNS$elementAttrs xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\"$encodingStyle>";
			}

			$xml .= $this->serializeComplexTypeElements($typeDef, $value, $ns, $uqType, $use, $encodingStyle);
			$xml .= "</$elementName>";
		} elseif ($phpType == 'array') {
			if (isset($typeDef['form']) && ($typeDef['form'] == 'qualified')) {
				$elementNS = " xmlns=\"$ns\"";
			} else {
				$elementNS = '';
			}
			if (is_null($value)) {
				if ($use == 'literal') {
					// TODO: depends on nillable
					$xml = "<$name$elementNS/>";
				} else {
					$xml = "<$name$elementNS xsi:nil=\"true\"/>";
				}
				$this->debug("serializeType returning: $xml");
				return $xml;
			}
			if (isset($typeDef['multidimensional'])) {
				$nv = array();
				foreach($value as $v) {
					$cols = ',' . sizeof($v);
					$nv = array_merge($nv, $v);
				} 
				$value = $nv;
			} else {
				$cols = '';
			} 
			if (is_array($value) && sizeof($value) >= 1) {
				$rows = sizeof($value);
				$contents = '';
				foreach($value as $k => $v) {
					$this->debug("serializing array element: $k, $v of type: $typeDef[arrayType]");
					//if (strpos($typeDef['arrayType'], ':') ) {
					if (!in_array($typeDef['arrayType'],$this->typemap['http://www.w3.org/2001/XMLSchema'])) {
					    $contents .= $this->serializeType('item', $typeDef['arrayType'], $v, $use);
					} else {
					    $contents .= $this->serialize_val($v, 'item', $typeDef['arrayType'], null, $this->XMLSchemaVersion, false, $use);
					} 
				}
			} else {
				$rows = 0;
				$contents = null;
			}
			// TODO: for now, an empty value will be serialized as a zero element
			// array.  Revisit this when coding the handling of null/nil values.
			if ($use == 'literal') {
				$xml = "<$name$elementNS>"
					.$contents
					."</$name>";
			} else {
				$xml = "<$name$elementNS xsi:type=\"".$this->getPrefixFromNamespace('http://schemas.xmlsoap.org/soap/encoding/').':Array" '.
					$this->getPrefixFromNamespace('http://schemas.xmlsoap.org/soap/encoding/')
					.':arrayType="'
					.$this->getPrefixFromNamespace($this->getPrefix($typeDef['arrayType']))
					.":".$this->getLocalPart($typeDef['arrayType'])."[$rows$cols]\">"
					.$contents
					."</$name>";
			}
		} elseif ($phpType == 'scalar') {
			if (isset($typeDef['form']) && ($typeDef['form'] == 'qualified')) {
				$elementNS = " xmlns=\"$ns\"";
			} else {
				$elementNS = '';
			}
			if ($use == 'literal') {
				if ($forceType) {
					$xml = "<$name$elementNS xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\">$value</$name>";
				} else {
					$xml = "<$name$elementNS>$value</$name>";
				}
			} else {
				$xml = "<$name$elementNS xsi:type=\"" . $this->getPrefixFromNamespace($ns) . ":$uqType\"$encodingStyle>$value</$name>";
			}
		}
		$this->debug("serializeType returning: $xml");
		return $xml;
	}
	
	/**
	 * serializes the attributes for a complexType
	 *
	 * @param array $typeDef
	 * @param mixed $value , a native PHP value (parameter value)
	 * @param string $ns the namespace of the type
	 * @param string $uqType the local part of the type
	 * @return string serialization
	 * @access public 
	 */
	function serializeComplexTypeAttributes($typeDef, $value, $ns, $uqType) {
		$xml = '';
		if (isset($typeDef['attrs']) && is_array($typeDef['attrs'])) {
			$this->debug("serialize attributes for XML Schema type $ns:$uqType");
			if (is_array($value)) {
				$xvalue = $value;
			} elseif (is_object($value)) {
				$xvalue = get_object_vars($value);
			} else {
				$this->debug("value is neither an array nor an object for XML Schema type $ns:$uqType");
				$xvalue = array();
			}
			foreach ($typeDef['attrs'] as $aName => $attrs) {
				if (isset($xvalue['!' . $aName])) {
					$xname = '!' . $aName;
					$this->debug("value provided for attribute $aName with key $xname");
				} elseif (isset($xvalue[$aName])) {
					$xname = $aName;
					$this->debug("value provided for attribute $aName with key $xname");
				} elseif (isset($attrs['default'])) {
					$xname = '!' . $aName;
					$xvalue[$xname] = $attrs['default'];
					$this->debug('use default value of ' . $xvalue[$aName] . ' for attribute ' . $aName);
				} else {
					$xname = '';
					$this->debug("no value provided for attribute $aName");
				}
				if ($xname) {
					$xml .=  " $aName=\"" . $xvalue[$xname] . "\"";
				}
			} 
		} else {
			$this->debug("no attributes to serialize for XML Schema type $ns:$uqType");
		}
		if (isset($typeDef['extensionBase'])) {
			$ns = $this->getPrefix($typeDef['extensionBase']);
			$uqType = $this->getLocalPart($typeDef['extensionBase']);
			if ($this->getNamespaceFromPrefix($ns)) {
				$ns = $this->getNamespaceFromPrefix($ns);
			}
			if ($typeDef = $this->getTypeDef($uqType, $ns)) {
				$this->debug("serialize attributes for extension base $ns:$uqType");
				$xml .= $this->serializeComplexTypeElements($typeDef, $value, $ns, $uqType);
			} else {
				$this->debug("extension base $ns:$uqType is not a supported type");
			}
		}
		return $xml;
	}

	/**
	 * serializes the elements for a complexType
	 *
	 * @param array $typeDef
	 * @param mixed $value , a native PHP value (parameter value)
	 * @param string $ns the namespace of the type
	 * @param string $uqType the local part of the type
	 * @param string $use , use for part (encoded|literal)
	 * @param string $encodingStyle , use to add encoding changes to serialisation
	 * @return string serialization
	 * @access public 
	 */
	function serializeComplexTypeElements($typeDef, $value, $ns, $uqType, $use='encoded', $encodingStyle=false) {
		$xml = '';
		if (isset($typeDef['elements']) && is_array($typeDef['elements'])) {
			$this->debug("serialize elements for XML Schema type $ns:$uqType");
			if (is_array($value)) {
				$xvalue = $value;
			} elseif (is_object($value)) {
				$xvalue = get_object_vars($value);
			} else {
				$this->debug("value is neither an array nor an object for XML Schema type $ns:$uqType");
				$xvalue = array();
			}
			// toggle whether all elements are present - ideally should validate against schema
			if (count($typeDef['elements']) != count($xvalue)){
				$optionals = true;
			}
			foreach ($typeDef['elements'] as $eName => $attrs) {
				if (!isset($xvalue[$eName])) {
					if (isset($attrs['default'])) {
						$xvalue[$eName] = $attrs['default'];
						$this->debug('use default value of ' . $xvalue[$eName] . ' for element ' . $eName);
					}
				}
				// if user took advantage of a minOccurs=0, then only serialize named parameters
				if (isset($optionals) && !isset($xvalue[$eName])){
					// do nothing
					$this->debug("no value provided for complexType element $eName, so serialize nothing");
				} else {
					// get value
					if (isset($xvalue[$eName])) {
					    $v = $xvalue[$eName];
					} else {
					    $v = null;
					}
					// TODO: if maxOccurs > 1 (not just unbounded), then allow serialization of an array
					if (isset($attrs['maxOccurs']) && $attrs['maxOccurs'] == 'unbounded' && isset($v) && is_array($v) && $this->isArraySimpleOrStruct($v) == 'arraySimple') {
						$vv = $v;
						foreach ($vv as $k => $v) {
							if (isset($attrs['type'])) {
								// serialize schema-defined type
							    $xml .= $this->serializeType($eName, $attrs['type'], $v, $use, $encodingStyle);
							} else {
								// serialize generic type
							    $this->debug("calling serialize_val() for $v, $eName, false, false, false, false, $use");
							    $xml .= $this->serialize_val($v, $eName, false, false, false, false, $use);
							}
						}
					} else {
						if (isset($attrs['type'])) {
							// serialize schema-defined type
						    $xml .= $this->serializeType($eName, $attrs['type'], $v, $use, $encodingStyle);
						} else {
							// serialize generic type
						    $this->debug("calling serialize_val() for $v, $eName, false, false, false, false, $use");
						    $xml .= $this->serialize_val($v, $eName, false, false, false, false, $use);
						}
					}
				}
			} 
		} else {
			$this->debug("no elements to serialize for XML Schema type $ns:$uqType");
		}
		if (isset($typeDef['extensionBase'])) {
			$ns = $this->getPrefix($typeDef['extensionBase']);
			$uqType = $this->getLocalPart($typeDef['extensionBase']);
			if ($this->getNamespaceFromPrefix($ns)) {
				$ns = $this->getNamespaceFromPrefix($ns);
			}
			if ($typeDef = $this->getTypeDef($uqType, $ns)) {
				$this->debug("serialize elements for extension base $ns:$uqType");
				$xml .= $this->serializeComplexTypeElements($typeDef, $value, $ns, $uqType, $use, $encodingStyle);
			} else {
				$this->debug("extension base $ns:$uqType is not a supported type");
			}
		}
		return $xml;
	}

	/**
	* adds an XML Schema complex type to the WSDL types
	*
	* @param name
	* @param typeClass (complexType|simpleType|attribute)
	* @param phpType: currently supported are array and struct (php assoc array)
	* @param compositor (all|sequence|choice)
	* @param restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
	* @param elements = array ( name = array(name=>'',type=>'') )
	* @param attrs = array(
	* 	array(
	*		'ref' => "http://schemas.xmlsoap.org/soap/encoding/:arrayType",
	*		"http://schemas.xmlsoap.org/wsdl/:arrayType" => "string[]"
	* 	)
	* )
	* @param arrayType: namespace:name (http://www.w3.org/2001/XMLSchema:string)
	* @see xmlschema
	* 
	*/
	function addComplexType($name,$typeClass='complexType',$phpType='array',$compositor='',$restrictionBase='',$elements=array(),$attrs=array(),$arrayType='') {
		if (count($elements) > 0) {
	    	foreach($elements as $n => $e){
	            // expand each element
	            foreach ($e as $k => $v) {
		            $k = strpos($k,':') ? $this->expandQname($k) : $k;
		            $v = strpos($v,':') ? $this->expandQname($v) : $v;
		            $ee[$k] = $v;
		    	}
	    		$eElements[$n] = $ee;
	    	}
	    	$elements = $eElements;
		}
		
		if (count($attrs) > 0) {
	    	foreach($attrs as $n => $a){
	            // expand each attribute
	            foreach ($a as $k => $v) {
		            $k = strpos($k,':') ? $this->expandQname($k) : $k;
		            $v = strpos($v,':') ? $this->expandQname($v) : $v;
		            $aa[$k] = $v;
		    	}
	    		$eAttrs[$n] = $aa;
	    	}
	    	$attrs = $eAttrs;
		}

		$restrictionBase = strpos($restrictionBase,':') ? $this->expandQname($restrictionBase) : $restrictionBase;
		$arrayType = strpos($arrayType,':') ? $this->expandQname($arrayType) : $arrayType;

		$typens = isset($this->namespaces['types']) ? $this->namespaces['types'] : $this->namespaces['tns'];
		$this->schemas[$typens][0]->addComplexType($name,$typeClass,$phpType,$compositor,$restrictionBase,$elements,$attrs,$arrayType);
	}

	/**
	* adds an XML Schema simple type to the WSDL types
	*
	* @param name
	* @param restrictionBase namespace:name (http://schemas.xmlsoap.org/soap/encoding/:Array)
	* @param typeClass (simpleType)
	* @param phpType: (scalar)
	* @see xmlschema
	* 
	*/
	function addSimpleType($name, $restrictionBase='', $typeClass='simpleType', $phpType='scalar') {
		$restrictionBase = strpos($restrictionBase,':') ? $this->expandQname($restrictionBase) : $restrictionBase;

		$typens = isset($this->namespaces['types']) ? $this->namespaces['types'] : $this->namespaces['tns'];
		$this->schemas[$typens][0]->addSimpleType($name, $restrictionBase, $typeClass, $phpType);
	}

	/**
	* adds an element to the WSDL types
	*
	* @param name
	* @param array $attrs attributes that must include name and type
	* @see xmlschema
	*/
	function addElement($attrs) {
		$typens = isset($this->namespaces['types']) ? $this->namespaces['types'] : $this->namespaces['tns'];
		$this->schemas[$typens][0]->addElement($attrs);
	}

	/**
	* register a service with the server
	* 
	* @param string $methodname 
	* @param string $in assoc array of input values: key = param name, value = param type
	* @param string $out assoc array of output values: key = param name, value = param type
	* @param string $namespace optional The namespace for the operation
	* @param string $soapaction optional The soapaction for the operation
	* @param string $style (rpc|document) optional The style for the operation
	* @param string $use (encoded|literal) optional The use for the parameters (cannot mix right now)
	* @param string $documentation optional The description to include in the WSDL
	* @access public 
	*/
	function addOperation($name, $in = false, $out = false, $namespace = false, $soapaction = false, $style = 'rpc', $use = 'encoded', $documentation = ''){
		if ($style == 'rpc' && $use == 'encoded') {
			$encodingStyle = 'http://schemas.xmlsoap.org/soap/encoding/';
		} else {
			$encodingStyle = '';
		}

		if ($style == 'document') {
			$elements = array();
			foreach ($in as $n => $t) {
				$elements[$n] = array('name' => $n, 'type' => $t);
			}
			$this->addComplexType($name . 'RequestType', 'complexType', 'struct', 'all', '', $elements);
			$this->addElement(array('name' => $name, 'type' => $name . 'RequestType'));
			$in = array('parameters' => 'tns:' . $name);

			$elements = array();
			foreach ($out as $n => $t) {
				$elements[$n] = array('name' => $n, 'type' => $t);
			}
			$this->addComplexType($name . 'ResponseType', 'complexType', 'struct', 'all', '', $elements);
			$this->addElement(array('name' => $name . 'Response', 'type' => $name . 'ResponseType'));
			$out = array('parameters' => 'tns:' . $name . 'Response');
		}

		// get binding
		$this->bindings[ $this->serviceName . 'Binding' ]['operations'][$name] =
		array(
		'name' => $name,
		'binding' => $this->serviceName . 'Binding',
		'endpoint' => $this->endpoint,
		'soapAction' => $soapaction,
		'style' => $style,
		'input' => array(
			'use' => $use,
			'namespace' => $namespace,
			'encodingStyle' => $encodingStyle,
			'message' => $name . 'Request',
			'parts' => $in),
		'output' => array(
			'use' => $use,
			'namespace' => $namespace,
			'encodingStyle' => $encodingStyle,
			'message' => $name . 'Response',
			'parts' => $out),
		'namespace' => $namespace,
		'transport' => 'http://schemas.xmlsoap.org/soap/http',
		'documentation' => $documentation); 
		// add portTypes
		// add messages
		if($in)
		{
			foreach($in as $pName => $pType)
			{
				if(strpos($pType,':')) {
					$pType = $this->getNamespaceFromPrefix($this->getPrefix($pType)).":".$this->getLocalPart($pType);
				}
				$this->messages[$name.'Request'][$pName] = $pType;
			}
		} else {
            $this->messages[$name.'Request']= '0';
        }
		if($out)
		{
			foreach($out as $pName => $pType)
			{
				if(strpos($pType,':')) {
					$pType = $this->getNamespaceFromPrefix($this->getPrefix($pType)).":".$this->getLocalPart($pType);
				}
				$this->messages[$name.'Response'][$pName] = $pType;
			}
		} else {
            $this->messages[$name.'Response']= '0';
        }
		return true;
	} 
}
?><?php



/**
*
* soap_parser class parses SOAP XML messages into native PHP values
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class soap_parser extends nusoap_base {

	var $xml = '';
	var $xml_encoding = '';
	var $method = '';
	var $root_struct = '';
	var $root_struct_name = '';
	var $root_struct_namespace = '';
	var $root_header = '';
    var $document = '';			// incoming SOAP body (text)
	// determines where in the message we are (envelope,header,body,method)
	var $status = '';
	var $position = 0;
	var $depth = 0;
	var $default_namespace = '';
	var $namespaces = array();
	var $message = array();
    var $parent = '';
	var $fault = false;
	var $fault_code = '';
	var $fault_str = '';
	var $fault_detail = '';
	var $depth_array = array();
	var $debug_flag = true;
	var $soapresponse = NULL;
	var $responseHeaders = '';	// incoming SOAP headers (text)
	var $body_position = 0;
	// for multiref parsing:
	// array of id => pos
	var $ids = array();
	// array of id => hrefs => pos
	var $multirefs = array();
	// toggle for auto-decoding element content
	var $decode_utf8 = true;

	/**
	* constructor
	*
	* @param    string $xml SOAP message
	* @param    string $encoding character encoding scheme of message
	* @param    string $method
	* @param    string $decode_utf8 whether to decode UTF-8 to ISO-8859-1
	* @access   public
	*/
	function soap_parser($xml,$encoding='UTF-8',$method='',$decode_utf8=true){
		$this->xml = $xml;
		$this->xml_encoding = $encoding;
		$this->method = $method;
		$this->decode_utf8 = $decode_utf8;

		// Check whether content has been read.
		if(!empty($xml)){
			// Check XML encoding
			$pos_xml = strpos($xml, '<?xml');
			if ($pos_xml !== FALSE) {
				$xml_decl = substr($xml, $pos_xml, strpos($xml, '?>', $pos_xml + 2) - $pos_xml + 1);
				if (preg_match("/encoding=[\"']([^\"']*)[\"']/", $xml_decl, $res)) {
					$xml_encoding = $res[1];
					if (strtoupper($xml_encoding) != $encoding) {
						$err = "Charset from HTTP Content-Type '" . $encoding . "' does not match encoding from XML declaration '" . $xml_encoding . "'";
						$this->debug($err);
						$this->setError($err);
						return;
					} else {
						$this->debug('Charset from HTTP Content-Type matches encoding from XML declaration');
					}
				} else {
					$this->debug('No encoding specified in XML declaration');
				}
			} else {
				$this->debug('No XML declaration');
			}
			$this->debug('Entering soap_parser(), length='.strlen($xml).', encoding='.$encoding);
			// Create an XML parser - why not xml_parser_create_ns?
			$this->parser = xml_parser_create($this->xml_encoding);
			// Set the options for parsing the XML data.
			//xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
			xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0);
			xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, $this->xml_encoding);
			// Set the object for the parser.
			xml_set_object($this->parser, $this);
			// Set the element handlers for the parser.
			xml_set_element_handler($this->parser, 'start_element','end_element');
			xml_set_character_data_handler($this->parser,'character_data');

			// Parse the XML file.
			if(!xml_parse($this->parser,$xml,true)){
			    // Display an error message.
			    $err = sprintf('XML error parsing SOAP payload on line %d: %s',
			    xml_get_current_line_number($this->parser),
			    xml_error_string(xml_get_error_code($this->parser)));
				$this->debug($err);
				$this->debug("XML payload:\n" . $xml);
				$this->setError($err);
			} else {
				$this->debug('parsed successfully, found root struct: '.$this->root_struct.' of name '.$this->root_struct_name);
				// get final value
				$this->soapresponse = $this->message[$this->root_struct]['result'];
				// get header value: no, because this is documented as XML string
//				if($this->root_header != '' && isset($this->message[$this->root_header]['result'])){
//					$this->responseHeaders = $this->message[$this->root_header]['result'];
//				}
				// resolve hrefs/ids
				if(sizeof($this->multirefs) > 0){
					foreach($this->multirefs as $id => $hrefs){
						$this->debug('resolving multirefs for id: '.$id);
						$idVal = $this->buildVal($this->ids[$id]);
						foreach($hrefs as $refPos => $ref){
							$this->debug('resolving href at pos '.$refPos);
							$this->multirefs[$id][$refPos] = $idVal;
						}
					}
				}
			}
			xml_parser_free($this->parser);
		} else {
			$this->debug('xml was empty, didn\'t parse!');
			$this->setError('xml was empty, didn\'t parse!');
		}
	}

	/**
	* start-element handler
	*
	* @param    string $parser XML parser object
	* @param    string $name element name
	* @param    string $attrs associative array of attributes
	* @access   private
	*/
	function start_element($parser, $name, $attrs) {
		// position in a total number of elements, starting from 0
		// update class level pos
		$pos = $this->position++;
		// and set mine
		$this->message[$pos] = array('pos' => $pos,'children'=>'','cdata'=>'');
		// depth = how many levels removed from root?
		// set mine as current global depth and increment global depth value
		$this->message[$pos]['depth'] = $this->depth++;

		// else add self as child to whoever the current parent is
		if($pos != 0){
			$this->message[$this->parent]['children'] .= '|'.$pos;
		}
		// set my parent
		$this->message[$pos]['parent'] = $this->parent;
		// set self as current parent
		$this->parent = $pos;
		// set self as current value for this depth
		$this->depth_array[$this->depth] = $pos;
		// get element prefix
		if(strpos($name,':')){
			// get ns prefix
			$prefix = substr($name,0,strpos($name,':'));
			// get unqualified name
			$name = substr(strstr($name,':'),1);
		}
		// set status
		if($name == 'Envelope'){
			$this->status = 'envelope';
		} elseif($name == 'Header'){
			$this->root_header = $pos;
			$this->status = 'header';
		} elseif($name == 'Body'){
			$this->status = 'body';
			$this->body_position = $pos;
		// set method
		} elseif($this->status == 'body' && $pos == ($this->body_position+1)){
			$this->status = 'method';
			$this->root_struct_name = $name;
			$this->root_struct = $pos;
			$this->message[$pos]['type'] = 'struct';
			$this->debug("found root struct $this->root_struct_name, pos $this->root_struct");
		}
		// set my status
		$this->message[$pos]['status'] = $this->status;
		// set name
		$this->message[$pos]['name'] = htmlspecialchars($name);
		// set attrs
		$this->message[$pos]['attrs'] = $attrs;

		// loop through atts, logging ns and type declarations
        $attstr = '';
		foreach($attrs as $key => $value){
        	$key_prefix = $this->getPrefix($key);
			$key_localpart = $this->getLocalPart($key);
			// if ns declarations, add to class level array of valid namespaces
            if($key_prefix == 'xmlns'){
				if(ereg('^http://www.w3.org/[0-9]{4}/XMLSchema$',$value)){
					$this->XMLSchemaVersion = $value;
					$this->namespaces['xsd'] = $this->XMLSchemaVersion;
					$this->namespaces['xsi'] = $this->XMLSchemaVersion.'-instance';
				}
                $this->namespaces[$key_localpart] = $value;
				// set method namespace
				if($name == $this->root_struct_name){
					$this->methodNamespace = $value;
				}
			// if it's a type declaration, set type
            } elseif($key_localpart == 'type'){
            	$value_prefix = $this->getPrefix($value);
                $value_localpart = $this->getLocalPart($value);
				$this->message[$pos]['type'] = $value_localpart;
				$this->message[$pos]['typePrefix'] = $value_prefix;
                if(isset($this->namespaces[$value_prefix])){
                	$this->message[$pos]['type_namespace'] = $this->namespaces[$value_prefix];
                } else if(isset($attrs['xmlns:'.$value_prefix])) {
					$this->message[$pos]['type_namespace'] = $attrs['xmlns:'.$value_prefix];
                }
				// should do something here with the namespace of specified type?
			} elseif($key_localpart == 'arrayType'){
				$this->message[$pos]['type'] = 'array';
				/* do arrayType ereg here
				[1]    arrayTypeValue    ::=    atype asize
				[2]    atype    ::=    QName rank*
				[3]    rank    ::=    '[' (',')* ']'
				[4]    asize    ::=    '[' length~ ']'
				[5]    length    ::=    nextDimension* Digit+
				[6]    nextDimension    ::=    Digit+ ','
				*/
				$expr = '([A-Za-z0-9_]+):([A-Za-z]+[A-Za-z0-9_]+)\[([0-9]+),?([0-9]*)\]';
				if(ereg($expr,$value,$regs)){
					$this->message[$pos]['typePrefix'] = $regs[1];
					$this->message[$pos]['arrayTypePrefix'] = $regs[1];
	                if (isset($this->namespaces[$regs[1]])) {
	                	$this->message[$pos]['arrayTypeNamespace'] = $this->namespaces[$regs[1]];
	                } else if (isset($attrs['xmlns:'.$regs[1]])) {
						$this->message[$pos]['arrayTypeNamespace'] = $attrs['xmlns:'.$regs[1]];
	                }
					$this->message[$pos]['arrayType'] = $regs[2];
					$this->message[$pos]['arraySize'] = $regs[3];
					$this->message[$pos]['arrayCols'] = $regs[4];
				}
			} elseif ($key != 'href' && $key != 'xmlns') {
				$this->message[$pos]['xattrs']['!' . $key] = $value;
			}

			if ($key == 'xmlns') {
				$this->default_namespace = $value;
			}
			// log id
			if($key == 'id'){
				$this->ids[$value] = $pos;
			}
			// root
			if($key_localpart == 'root' && $value == 1){
				$this->status = 'method';
				$this->root_struct_name = $name;
				$this->root_struct = $pos;
				$this->debug("found root struct $this->root_struct_name, pos $pos");
			}
            // for doclit
            $attstr .= " $key=\"$value\"";
		}
        // get namespace - must be done after namespace atts are processed
		if(isset($prefix)){
			$this->message[$pos]['namespace'] = $this->namespaces[$prefix];
			$this->default_namespace = $this->namespaces[$prefix];
		} else {
			$this->message[$pos]['namespace'] = $this->default_namespace;
		}
        if($this->status == 'header'){
        	if ($this->root_header != $pos) {
	        	$this->responseHeaders .= "<" . (isset($prefix) ? $prefix . ':' : '') . "$name$attstr>";
	        }
        } elseif($this->root_struct_name != ''){
        	$this->document .= "<" . (isset($prefix) ? $prefix . ':' : '') . "$name$attstr>";
        }
	}

	/**
	* end-element handler
	*
	* @param    string $parser XML parser object
	* @param    string $name element name
	* @access   private
	*/
	function end_element($parser, $name) {
		// position of current element is equal to the last value left in depth_array for my depth
		$pos = $this->depth_array[$this->depth--];

        // get element prefix
		if(strpos($name,':')){
			// get ns prefix
			$prefix = substr($name,0,strpos($name,':'));
			// get unqualified name
			$name = substr(strstr($name,':'),1);
		}
		
		// build to native type
		if(isset($this->body_position) && $pos > $this->body_position){
			// deal w/ multirefs
			if(isset($this->message[$pos]['attrs']['href'])){
				// get id
				$id = substr($this->message[$pos]['attrs']['href'],1);
				// add placeholder to href array
				$this->multirefs[$id][$pos] = 'placeholder';
				// add set a reference to it as the result value
				$this->message[$pos]['result'] =& $this->multirefs[$id][$pos];
            // build complex values
			} elseif($this->message[$pos]['children'] != ''){
			
				// if result has already been generated (struct/array
				if(!isset($this->message[$pos]['result'])){
					$this->message[$pos]['result'] = $this->buildVal($pos);
				}
			// build complex values of just attributes
			} elseif (isset($this->message[$pos]['xattrs'])) {
				$this->message[$pos]['result'] = $this->message[$pos]['xattrs'];
			// set value of simple type
			} else {
            	//$this->debug('adding data for scalar value '.$this->message[$pos]['name'].' of value '.$this->message[$pos]['cdata']);
            	if (isset($this->message[$pos]['type'])) {
					$this->message[$pos]['result'] = $this->decodeSimple($this->message[$pos]['cdata'], $this->message[$pos]['type'], isset($this->message[$pos]['type_namespace']) ? $this->message[$pos]['type_namespace'] : '');
				} else {
					$parent = $this->message[$pos]['parent'];
					if (isset($this->message[$parent]['type']) && ($this->message[$parent]['type'] == 'array') && isset($this->message[$parent]['arrayType'])) {
						$this->message[$pos]['result'] = $this->decodeSimple($this->message[$pos]['cdata'], $this->message[$parent]['arrayType'], isset($this->message[$parent]['arrayTypeNamespace']) ? $this->message[$parent]['arrayTypeNamespace'] : '');
					} else {
						$this->message[$pos]['result'] = $this->message[$pos]['cdata'];
					}
				}

				/* add value to parent's result, if parent is struct/array
				$parent = $this->message[$pos]['parent'];
				if($this->message[$parent]['type'] != 'map'){
					if(strtolower($this->message[$parent]['type']) == 'array'){
						$this->message[$parent]['result'][] = $this->message[$pos]['result'];
					} else {
						$this->message[$parent]['result'][$this->message[$pos]['name']] = $this->message[$pos]['result'];
					}
				}
				*/
			}
		}
		
        // for doclit
        if($this->status == 'header'){
        	if ($this->root_header != $pos) {
	        	$this->responseHeaders .= "</" . (isset($prefix) ? $prefix . ':' : '') . "$name>";
	        }
        } elseif($pos >= $this->root_struct){
        	$this->document .= "</" . (isset($prefix) ? $prefix . ':' : '') . "$name>";
        }
		// switch status
		if($pos == $this->root_struct){
			$this->status = 'body';
			$this->root_struct_namespace = $this->message[$pos]['namespace'];
		} elseif($name == 'Body'){
			$this->status = 'envelope';
		 } elseif($name == 'Header'){
			$this->status = 'envelope';
		} elseif($name == 'Envelope'){
			//
		}
		// set parent back to my parent
		$this->parent = $this->message[$pos]['parent'];
	}

	/**
	* element content handler
	*
	* @param    string $parser XML parser object
	* @param    string $data element content
	* @access   private
	*/
	function character_data($parser, $data){
		$pos = $this->depth_array[$this->depth];
		if ($this->xml_encoding=='UTF-8'){
			// TODO: add an option to disable this for folks who want
			// raw UTF-8 that, e.g., might not map to iso-8859-1
			// TODO: this can also be handled with xml_parser_set_option($this->parser, XML_OPTION_TARGET_ENCODING, "ISO-8859-1");
			if($this->decode_utf8){
				$data = utf8_decode($data);
			}
		}
        $this->message[$pos]['cdata'] .= $data;
        // for doclit
        if($this->status == 'header'){
        	$this->responseHeaders .= $data;
        } else {
        	$this->document .= $data;
        }
	}

	/**
	* get the parsed message
	*
	* @return	mixed
	* @access   public
	*/
	function get_response(){
		return $this->soapresponse;
	}

	/**
	* get the parsed headers
	*
	* @return	string XML or empty if no headers
	* @access   public
	*/
	function getHeaders(){
	    return $this->responseHeaders;
	}

	/**
	* decodes entities
	*
	* @param    string $text string to translate
	* @access   private
	*/
	function decode_entities($text){
		foreach($this->entities as $entity => $encoded){
			$text = str_replace($encoded,$entity,$text);
		}
		return $text;
	}

	/**
	* decodes simple types into PHP variables
	*
	* @param    string $value value to decode
	* @param    string $type XML type to decode
	* @param    string $typens XML type namespace to decode
	* @access   private
	*/
	function decodeSimple($value, $type, $typens) {
		// TODO: use the namespace!
		if ((!isset($type)) || $type == 'string' || $type == 'long' || $type == 'unsignedLong') {
			return (string) $value;
		}
		if ($type == 'int' || $type == 'integer' || $type == 'short' || $type == 'byte') {
			return (int) $value;
		}
		if ($type == 'float' || $type == 'double' || $type == 'decimal') {
			return (double) $value;
		}
		if ($type == 'boolean') {
			if (strtolower($value) == 'false' || strtolower($value) == 'f') {
				return false;
			}
			return (boolean) $value;
		}
		if ($type == 'base64' || $type == 'base64Binary') {
			return base64_decode($value);
		}
		// obscure numeric types
		if ($type == 'nonPositiveInteger' || $type == 'negativeInteger'
			|| $type == 'nonNegativeInteger' || $type == 'positiveInteger'
			|| $type == 'unsignedInt'
			|| $type == 'unsignedShort' || $type == 'unsignedByte') {
			return (int) $value;
		}
		// everything else
		return (string) $value;
	}

	/**
	* builds response structures for compound values (arrays/structs)
	*
	* @param    string $pos position in node tree
	* @access   private
	*/
	function buildVal($pos){
		if(!isset($this->message[$pos]['type'])){
			$this->message[$pos]['type'] = '';
		}
		$this->debug('inside buildVal() for '.$this->message[$pos]['name']."(pos $pos) of type ".$this->message[$pos]['type']);
		// if there are children...
		if($this->message[$pos]['children'] != ''){
			$children = explode('|',$this->message[$pos]['children']);
			array_shift($children); // knock off empty
			// md array
			if(isset($this->message[$pos]['arrayCols']) && $this->message[$pos]['arrayCols'] != ''){
            	$r=0; // rowcount
            	$c=0; // colcount
            	foreach($children as $child_pos){
					$this->debug("got an MD array element: $r, $c");
					$params[$r][] = $this->message[$child_pos]['result'];
				    $c++;
				    if($c == $this->message[$pos]['arrayCols']){
				    	$c = 0;
						$r++;
				    }
                }
            // array
			} elseif($this->message[$pos]['type'] == 'array' || $this->message[$pos]['type'] == 'Array'){
                $this->debug('adding array '.$this->message[$pos]['name']);
                foreach($children as $child_pos){
                	$params[] = &$this->message[$child_pos]['result'];
                }
            // apache Map type: java hashtable
            } elseif($this->message[$pos]['type'] == 'Map' && $this->message[$pos]['type_namespace'] == 'http://xml.apache.org/xml-soap'){
                foreach($children as $child_pos){
                	$kv = explode("|",$this->message[$child_pos]['children']);
                   	$params[$this->message[$kv[1]]['result']] = &$this->message[$kv[2]]['result'];
                }
            // generic compound type
            //} elseif($this->message[$pos]['type'] == 'SOAPStruct' || $this->message[$pos]['type'] == 'struct') {
		    } else {
	    		// Apache Vector type: treat as an array
				if ($this->message[$pos]['type'] == 'Vector' && $this->message[$pos]['type_namespace'] == 'http://xml.apache.org/xml-soap') {
					$notstruct = 1;
				} else {
					$notstruct = 0;
	            }
            	//
            	foreach($children as $child_pos){
            		if($notstruct){
            			$params[] = &$this->message[$child_pos]['result'];
            		} else {
            			if (isset($params[$this->message[$child_pos]['name']])) {
            				// de-serialize repeated element name into an array
            				if ((!is_array($params[$this->message[$child_pos]['name']])) || (!isset($params[$this->message[$child_pos]['name']][0]))) {
            					$params[$this->message[$child_pos]['name']] = array($params[$this->message[$child_pos]['name']]);
            				}
            				$params[$this->message[$child_pos]['name']][] = &$this->message[$child_pos]['result'];
            			} else {
					    	$params[$this->message[$child_pos]['name']] = &$this->message[$child_pos]['result'];
					    }
                	}
                }
			}
			if (isset($this->message[$pos]['xattrs'])) {
				foreach ($this->message[$pos]['xattrs'] as $n => $v) {
					$params[$n] = $v;
				}
			}
			return is_array($params) ? $params : array();
		} else {
        	$this->debug('no children');
            if(strpos($this->message[$pos]['cdata'],'&')){
		    	return  strtr($this->message[$pos]['cdata'],array_flip($this->entities));
            } else {
            	return $this->message[$pos]['cdata'];
            }
		}
	}
}



?><?php



/**
*
* soap_client higher level class for easy usage.
*
* usage:
*
* // instantiate client with server info
* $soap_client = new soap_client( string path [ ,boolean wsdl] );
*
* // call method, get results
* echo $soap_client->call( string methodname [ ,array parameters] );
*
* // bye bye client
* unset($soap_client);
*
* @author   Dietrich Ayala <dietrich@ganx4.com>
* @version  $Id: nusoap.php,v 1.81 2004/10/14 17:28:46 snichol Exp $
* @access   public
*/
class soap_client extends nusoap_base  {

	var $username = '';
	var $password = '';
	var $authtype = '';
	var $certRequest = array();
	var $requestHeaders = false;	// SOAP headers in request (text)
	var $responseHeaders = '';		// SOAP headers from response (incomplete namespace resolution) (text)
	var $document = '';				// SOAP body response portion (incomplete namespace resolution) (text)
	var $endpoint;
    var $proxyhost = '';
    var $proxyport = '';
	var $proxyusername = '';
	var $proxypassword = '';
    var $xml_encoding = '';			// character set encoding of incoming (response) messages
	var $http_encoding = false;
	var $timeout = 0;				// HTTP connection timeout
	var $response_timeout = 30;		// HTTP response timeout
	var $endpointType = '';			// soap|wsdl, empty for WSDL initialization error
	var $persistentConnection = false;
	var $defaultRpcParams = false;	// This is no longer used
	var $request = '';				// HTTP request
	var $response = '';				// HTTP response
	var $responseData = '';			// SOAP payload of response
	var $cookies = array();			// Cookies from response or for request
    var $decode_utf8 = true;		// toggles whether the parser decodes element content w/ utf8_decode()
	var $operations = array();		// WSDL operations, empty for WSDL initialization error
	
	/**
	* fault related variables
	*
	* @var      fault
	* @var      faultcode
	* @var      faultstring
	* @var      faultdetail
	* @access   public
	*/
	var $fault, $faultcode, $faultstring, $faultdetail;

	/**
	* constructor
	*
	* @param    mixed $endpoint SOAP server or WSDL URL (string), or wsdl instance (object)
	* @param    bool $wsdl optional, set to true if using WSDL
	* @param	int $portName optional portName in WSDL document
	* @param    string $proxyhost
	* @param    string $proxyport
	* @param	string $proxyusername
	* @param	string $proxypassword
	* @param	integer $timeout set the connection timeout
	* @param	integer $response_timeout set the response timeout
	* @access   public
	*/
	function soap_client($endpoint,$wsdl = false,$proxyhost = false,$proxyport = false,$proxyusername = false, $proxypassword = false, $timeout = 0, $response_timeout = 30){
		$this->endpoint = $endpoint;
		$this->proxyhost = $proxyhost;
		$this->proxyport = $proxyport;
		$this->proxyusername = $proxyusername;
		$this->proxypassword = $proxypassword;
		$this->timeout = $timeout;
		$this->response_timeout = $response_timeout;

		// make values
		if($wsdl){
			if (is_object($endpoint) && $this->is_a_temp($endpoint, 'wsdl')) {
				$this->wsdl = $endpoint;
				$this->endpoint = $this->wsdl->wsdl;
				$this->wsdlFile = $this->endpoint;
				$this->debug('existing wsdl instance created from ' . $this->endpoint);
			} else {
				$this->wsdlFile = $this->endpoint;
				
				// instantiate wsdl object and parse wsdl file
				$this->debug('instantiating wsdl class with doc: '.$endpoint);
				$this->wsdl =& new wsdl($this->wsdlFile,$this->proxyhost,$this->proxyport,$this->proxyusername,$this->proxypassword,$this->timeout,$this->response_timeout);
			}
			$this->appendDebug($this->wsdl->getDebug());
			$this->wsdl->clearDebug();
			// catch errors
			if($errstr = $this->wsdl->getError()){
				$this->debug('got wsdl error: '.$errstr);
				$this->setError('wsdl error: '.$errstr);
			} elseif($this->operations = $this->wsdl->getOperations()){
				$this->debug( 'got '.count($this->operations).' operations from wsdl '.$this->wsdlFile);
				$this->endpointType = 'wsdl';
			} else {
				$this->debug( 'getOperations returned false');
				$this->setError('no operations defined in the WSDL document!');
			}
		} else {
			$this->endpointType = 'soap';
		}
	}

	/**
	* calls method, returns PHP native type
	*
	* @param    string $method SOAP server URL or path
	* @param    array $params An array, associative or simple, of the parameters
	*			              for the method call, or a string that is the XML
	*			              for the call.  For rpc style, this call will
	*			              wrap the XML in a tag named after the method, as
	*			              well as the SOAP Envelope and Body.  For document
	*			              style, this will only wrap with the Envelope and Body.
	*			              IMPORTANT: when using an array with document style,
	*			              in which case there
	*                         is really one parameter, the root of the fragment
	*                         used in the call, which encloses what programmers
	*                         normally think of parameters.  A parameter array
	*                         *must* include the wrapper.
	* @param	string $namespace optional method namespace (WSDL can override)
	* @param	string $soapAction optional SOAPAction value (WSDL can override)
	* @param	boolean $headers optional array of soapval objects for headers
	* @param	boolean $rpcParams optional (no longer used)
	* @param	string	$style optional (rpc|document) the style to use when serializing parameters (WSDL can override)
	* @param	string	$use optional (encoded|literal) the use when serializing parameters (WSDL can override)
	* @return	mixed
	* @access   public
	*/
	function call($operation,$params=array(),$namespace='http://tempuri.org',$soapAction='',$headers=false,$rpcParams=null,$style='rpc',$use='encoded'){
		$this->operation = $operation;
		$this->fault = false;
		$this->setError('');
		$this->request = '';
		$this->response = '';
		$this->responseData = '';
		$this->faultstring = '';
		$this->faultcode = '';
		$this->opData = array();
		
		$this->debug("call: $operation, $params, $namespace, $soapAction, $headers, $style, $use; endpointType: $this->endpointType");
		if ($headers) {
			$this->requestHeaders = $headers;
		}
		// serialize parameters
		if($this->endpointType == 'wsdl' && $opData = $this->getOperationData($operation)){
			// use WSDL for operation
			$this->opData = $opData;
			$this->debug("opData:");
			$this->appendDebug($this->varDump($opData));
			if (isset($opData['soapAction'])) {
				$soapAction = $opData['soapAction'];
			}
			$this->endpoint = $opData['endpoint'];
			$namespace = isset($opData['input']['namespace']) ? $opData['input']['namespace'] :	$namespace;
			$style = $opData['style'];
			$use = $opData['input']['use'];
			// add ns to ns array
			if($namespace != '' && !isset($this->wsdl->namespaces[$namespace])){
				$nsPrefix = 'ns' . rand(1000, 9999);
				$this->wsdl->namespaces[$nsPrefix] = $namespace;
			}
            $nsPrefix = $this->wsdl->getPrefixFromNamespace($namespace);
			// serialize payload
			if (is_string($params)) {
				$this->debug("serializing param string for WSDL operation $operation");
				$payload = $params;
			} elseif (is_array($params)) {
				$this->debug("serializing param array for WSDL operation $operation");
				$payload = $this->wsdl->serializeRPCParameters($operation,'input',$params);
			} else {
				$this->debug('params must be array or string');
				$this->setError('params must be array or string');
				return false;
			}
            $usedNamespaces = $this->wsdl->usedNamespaces;
			// Partial fix for multiple encoding styles in the same function call
			$encodingStyle = 'http://schemas.xmlsoap.org/soap/encoding/';
			if (isset($opData['output']['encodingStyle']) && $encodingStyle != $opData['output']['encodingStyle']) {
				$methodEncodingStyle = ' SOAP-ENV:encodingStyle="' . $opData['output']['encodingStyle'] . '"';
			} else {
				$methodEncodingStyle = '';
			}
			$this->appendDebug($this->wsdl->getDebug());
			$this->wsdl->clearDebug();
			if ($errstr = $this->wsdl->getError()) {
				$this->debug('got wsdl error: '.$errstr);
				$this->setError('wsdl error: '.$errstr);
				return false;
			}
		} elseif($this->endpointType == 'wsdl') {
			// operation not in WSDL
			$this->appendDebug($this->wsdl->getDebug());
			$this->wsdl->clearDebug();
			$this->setError( 'operation '.$operation.' not present.');
			$this->debug("operation '$operation' not present.");
			return false;
		} else {
			// no WSDL
			//$this->namespaces['ns1'] = $namespace;
			$nsPrefix = 'ns' . rand(1000, 9999);
			// serialize 
			$payload = '';
			if (is_string($params)) {
				$this->debug("serializing param string for operation $operation");
				$payload = $params;
			} elseif (is_array($params)) {
				$this->debug("serializing param array for operation $operation");
				foreach($params as $k => $v){
					$payload .= $this->serialize_val($v,$k,false,false,false,false,$use);
				}
			} else {
				$this->debug('params must be array or string');
				$this->setError('params must be array or string');
				return false;
			}
			$usedNamespaces = array();
			$methodEncodingStyle = '';
		}
		// wrap RPC calls with method element
		if ($style == 'rpc') {
			if ($use == 'literal') {
				$this->debug("wrapping RPC request with literal method element");
				if ($namespace) {
					$payload = "<$operation xmlns=\"$namespace\">" . $payload . "</$operation>";
				} else {
					$payload = "<$operation>" . $payload . "</$operation>";
				}
			} else {
				$this->debug("wrapping RPC request with encoded method element");
				if ($namespace) {
					$payload = "<$nsPrefix:$operation$methodEncodingStyle xmlns:$nsPrefix=\"$namespace\">" .
								$payload .
								"</$nsPrefix:$operation>";
				} else {
					$payload = "<$operation$methodEncodingStyle>" .
								$payload .
								"</$operation>";
				}
			}
		}
		// serialize envelope
		$soapmsg = $this->serializeEnvelope($payload,$this->requestHeaders,$usedNamespaces,$style,$use);
		$this->debug("endpoint: $this->endpoint, soapAction: $soapAction, namespace: $namespace, style: $style, use: $use");
		$this->debug('SOAP message length: ' . strlen($soapmsg) . ' contents: ' . substr($soapmsg, 0, 1000));
		// send
		$return = $this->send($this->getHTTPBody($soapmsg),$soapAction,$this->timeout,$this->response_timeout);
		if($errstr = $this->getError()){
			$this->debug('Error: '.$errstr);
			return false;
		} else {
			$this->return = $return;
			$this->debug('sent message successfully and got a(n) '.gettype($return).' back');
			
			// fault?
			if(is_array($return) && isset($return['faultcode'])){
				$this->debug('got fault');
				$this->setError($return['faultcode'].': '.$return['faultstring']);
				$this->fault = true;
				foreach($return as $k => $v){
					$this->$k = $v;
					$this->debug("$k = $v<br>");
				}
				return $return;
			} else {
				// array of return values
				if(is_array($return)){
					// multiple 'out' parameters
					if(sizeof($return) > 1){
						return $return;
					}
					// single 'out' parameter
					return array_shift($return);
				// nothing returned (ie, echoVoid)
				} else {
					return "";
				}
			}
		}
	}

	/**
	* get available data pertaining to an operation
	*
	* @param    string $operation operation name
	* @return	array array of data pertaining to the operation
	* @access   public
	*/
	function getOperationData($operation){
		if(isset($this->operations[$operation])){
			return $this->operations[$operation];
		}
		$this->debug("No data for operation: $operation");
	}

    /**
    * send the SOAP message
    *
    * Note: if the operation has multiple return values
    * the return value of this method will be an array
    * of those values.
    *
	* @param    string $msg a SOAPx4 soapmsg object
	* @param    string $soapaction SOAPAction value
	* @param    integer $timeout set connection timeout in seconds
	* @param	integer $response_timeout set response timeout in seconds
	* @return	mixed native PHP types.
	* @access   private
	*/
	function send($msg, $soapaction = '', $timeout=0, $response_timeout=300) {
		$this->checkCookies();
		// detect transport
		switch(true){
			// http(s)
			case ereg('^http',$this->endpoint):
				$this->debug('transporting via HTTP');
				if($this->persistentConnection == true && is_object($this->persistentConnection)){
					$http =& $this->persistentConnection;
				} else {
					$http = new soap_transport_http($this->endpoint);
					if ($this->persistentConnection) {
						$http->usePersistentConnection();
					}
				}
				$http->setContentType($this->getHTTPContentType(), $this->getHTTPContentTypeCharset());
				$http->setSOAPAction($soapaction);
				if($this->proxyhost && $this->proxyport){
					$http->setProxy($this->proxyhost,$this->proxyport,$this->proxyusername,$this->proxypassword);
				}
                if($this->authtype != '') {
					$http->setCredentials($this->username, $this->password, $this->authtype, array(), $this->certRequest);
				}
				if($this->http_encoding != ''){
					$http->setEncoding($this->http_encoding);
				}
				$this->debug('sending message, length: '.strlen($msg));
				if(ereg('^http:',$this->endpoint)){
				//if(strpos($this->endpoint,'http:')){
					$this->responseData = $http->send($msg,$timeout,$response_timeout,$this->cookies);
				} elseif(ereg('^https',$this->endpoint)){
				//} elseif(strpos($this->endpoint,'https:')){
					//if(phpversion() == '4.3.0-dev'){
						//$response = $http->send($msg,$timeout,$response_timeout);
                   		//$this->request = $http->outgoing_payload;
						//$this->response = $http->incoming_payload;
					//} else
					$this->responseData = $http->sendHTTPS($msg,$timeout,$response_timeout,$this->cookies);
				} else {
					$this->setError('no http/s in endpoint url');
				}
				$this->request = $http->outgoing_payload;
				$this->response = $http->incoming_payload;
				$this->appendDebug($http->getDebug());
				$this->UpdateCookies($http->incoming_cookies);

				// save transport object if using persistent connections
				if ($this->persistentConnection) {
					$http->clearDebug();
					if (!is_object($this->persistentConnection)) {
						$this->persistentConnection = $http;
					}
				}
				
				if($err = $http->getError()){
					$this->setError('HTTP Error: '.$err);
					return false;
				} elseif($this->getError()){
					return false;
				} else {
					$this->debug('got response, length: '. strlen($this->responseData).' type: '.$http->incoming_headers['content-type']);
					return $this->parseResponse($http->incoming_headers, $this->responseData);
				}
			break;
			default:
				$this->setError('no transport found, or selected transport is not yet supported!');
			return false;
			break;
		}
	}

	/**
	* processes SOAP message returned from server
	*
	* @param	array	$headers	The HTTP headers
	* @param	string	$data		unprocessed response data from server
	* @return	mixed	value of the message, decoded into a PHP type
	* @access   protected
	*/
    function parseResponse($headers, $data) {
		$this->debug('Entering parseResponse() for data of length ' . strlen($data) . ' and type ' . $headers['content-type']);
		if (!strstr($headers['content-type'], 'text/xml')) {
			$this->setError('Response not of type text/xml');
			return false;
		}
		if (strpos($headers['content-type'], '=')) {
			$enc = str_replace('"', '', substr(strstr($headers["content-type"], '='), 1));
			$this->debug('Got response encoding: ' . $enc);
			if(eregi('^(ISO-8859-1|US-ASCII|UTF-8)$',$enc)){
				$this->xml_encoding = strtoupper($enc);
			} else {
				$this->xml_encoding = 'US-ASCII';
			}
		} else {
			// should be US-ASCII for HTTP 1.0 or ISO-8859-1 for HTTP 1.1
			$this->xml_encoding = 'ISO-8859-1';
		}
		$this->debug('Use encoding: ' . $this->xml_encoding . ' when creating soap_parser');
		$parser = new soap_parser($data,$this->xml_encoding,$this->operation,$this->decode_utf8);
		// add parser debug data to our debug
		$this->appendDebug($parser->getDebug());
		// if parse errors
		if($errstr = $parser->getError()){
			$this->setError( $errstr);
			// destroy the parser object
			unset($parser);
			return false;
		} else {
			// get SOAP headers
			$this->responseHeaders = $parser->getHeaders();
			// get decoded message
			$return = $parser->get_response();
            // add document for doclit support
            $this->document = $parser->document;
			// destroy the parser object
			unset($parser);
			// return decode message
			return $return;
		}
	 }

	/**
	* set the SOAP headers
	*
	* @param	$headers string XML
	* @access   public
	*/
	function setHeaders($headers){
		$this->requestHeaders = $headers;
	}

	/**
	* get the response headers
	*
	* @return	string
	* @access   public
	*/
	function getHeaders(){
		return $this->responseHeaders;
	}

	/**
	* set proxy info here
	*
	* @param    string $proxyhost
	* @param    string $proxyport
	* @param	string $proxyusername
	* @param	string $proxypassword
	* @access   public
	*/
	function setHTTPProxy($proxyhost, $proxyport, $proxyusername = '', $proxypassword = '') {
		$this->proxyhost = $proxyhost;
		$this->proxyport = $proxyport;
		$this->proxyusername = $proxyusername;
		$this->proxypassword = $proxypassword;
	}

	/**
	* if authenticating, set user credentials here
	*
	* @param    string $username
	* @param    string $password
	* @param	string $authtype (basic|digest|certificate)
	* @param	array $certRequest (keys must be cainfofile, sslcertfile, sslkeyfile, passphrase)
	* @access   public
	*/
	function setCredentials($username, $password, $authtype = 'basic', $certRequest = array()) {
		$this->username = $username;
		$this->password = $password;
		$this->authtype = $authtype;
		$this->certRequest = $certRequest;
	}
	
	/**
	* use HTTP encoding
	*
	* @param    string $enc
	* @access   public
	*/
	function setHTTPEncoding($enc='gzip, deflate'){
		$this->http_encoding = $enc;
	}
	
	/**
	* use HTTP persistent connections if possible
	*
	* @access   public
	*/
	function useHTTPPersistentConnection(){
		$this->persistentConnection = true;
	}
	
	/**
	* gets the default RPC parameter setting.
	* If true, default is that call params are like RPC even for document style.
	* Each call() can override this value.
	*
	* This is no longer used.
	*
	* @access public
	* @deprecated
	*/
	function getDefaultRpcParams() {
		return $this->defaultRpcParams;
	}

	/**
	* sets the default RPC parameter setting.
	* If true, default is that call params are like RPC even for document style
	* Each call() can override this value.
	*
	* This is no longer used.
	*
	* @param    boolean $rpcParams
	* @access public
	* @deprecated
	*/
	function setDefaultRpcParams($rpcParams) {
		$this->defaultRpcParams = $rpcParams;
	}
	
	/**
	* dynamically creates proxy class, allowing user to directly call methods from wsdl
	*
	* @return   object soap_proxy object
	* @access   public
	*/
	function getProxy(){
		if ($this->endpointType != 'wsdl') {
			$this->setError('The getProxy method only works for a WSDL client');
			return null;
		}
		$evalStr = '';
		foreach($this->operations as $operation => $opData){
			if($operation != ''){
				// create param string
				$paramStr = '';
				if(sizeof($opData['input']['parts']) > 0){
					foreach($opData['input']['parts'] as $name => $type){
						$paramStr .= "\$$name,";
					}
					$paramStr = substr($paramStr,0,strlen($paramStr)-1);
				}
				$opData['namespace'] = !isset($opData['namespace']) ? 'http://testuri.com' : $opData['namespace'];
				$evalStr .= "function " . str_replace('.', '__', $operation) . " ($paramStr) {
					// load params into array
					\$params = array($paramStr);
					return \$this->call('$operation',\$params,'".$opData['namespace']."','".(isset($opData['soapAction']) ? $opData['soapAction'] : '')."');
				}";
				unset($paramStr);
			}
		}
		$r = rand();
		$evalStr = 'class soap_proxy_'.$r.' extends soap_client {
				'.$evalStr.'
			}';
		//print "proxy class:<pre>$evalStr</pre>";
		// eval the class
		eval($evalStr);
		// instantiate proxy object
		eval("\$proxy = new soap_proxy_$r('');");
		// transfer current wsdl data to the proxy thereby avoiding parsing the wsdl twice
		$proxy->endpointType = 'wsdl';
		$proxy->wsdlFile = $this->wsdlFile;
		$proxy->wsdl = $this->wsdl;
		$proxy->operations = $this->operations;
		$proxy->defaultRpcParams = $this->defaultRpcParams;
		// transfer other state
		$proxy->username = $this->username;
		$proxy->password = $this->password;
		$proxy->authtype = $this->authtype;
		$proxy->proxyhost = $this->proxyhost;
		$proxy->proxyport = $this->proxyport;
		$proxy->proxyusername = $this->proxyusername;
		$proxy->proxypassword = $this->proxypassword;
		$proxy->timeout = $this->timeout;
		$proxy->response_timeout = $this->response_timeout;
		$proxy->http_encoding = $this->http_encoding;
		$proxy->persistentConnection = $this->persistentConnection;
		$proxy->requestHeaders = $this->requestHeaders;
		$proxy->soap_defencoding = $this->soap_defencoding;
		return $proxy;
	}

	/**
	* gets the HTTP body for the current request.
	*
	* @param string $soapmsg The SOAP payload
	* @return string The HTTP body, which includes the SOAP payload
	* @access protected
	*/
	function getHTTPBody($soapmsg) {
		return $soapmsg;
	}
	
	/**
	* gets the HTTP content type for the current request.
	*
	* Note: getHTTPBody must be called before this.
	*
	* @return string the HTTP content type for the current request.
	* @access protected
	*/
	function getHTTPContentType() {
		return 'text/xml';
	}
	
	/**
	* gets the HTTP content type charset for the current request.
	* returns false for non-text content types.
	*
	* Note: getHTTPBody must be called before this.
	*
	* @return string the HTTP content type charset for the current request.
	* @access protected
	*/
	function getHTTPContentTypeCharset() {
		return $this->soap_defencoding;
	}

	/*
	* whether or not parser should decode utf8 element content
    *
    * @return   always returns true
    * @access   public
    */
    function decodeUTF8($bool){
		$this->decode_utf8 = $bool;
		return true;
    }

	/**
	 * adds a new Cookie into $this->cookies array
	 *
	 * @param	string $name Cookie Name
	 * @param	string $value Cookie Value
	 * @return	if cookie-set was successful returns true, else false
	 * @access	public
	 */
	function setCookie($name, $value) {
		if (strlen($name) == 0) {
			return false;
		}
		$this->cookies[] = array('name' => $name, 'value' => $value);
		return true;
	}

	/**
	 * gets all Cookies
	 *
	 * @return   array with all internal cookies
	 * @access   public
	 */
	function getCookies() {
		return $this->cookies;
	}

	/**
	 * checks all Cookies and delete those which are expired
	 *
	 * @return   always return true
	 * @access   public
	 */
	function checkCookies() {
		if (sizeof($this->cookies) == 0) {
			return true;
		}
		$this->debug('checkCookie: check ' . sizeof($this->cookies) . ' cookies');
		$curr_cookies = $this->cookies;
		$this->cookies = array();
		foreach ($curr_cookies as $cookie) {
			if (! is_array($cookie)) {
				$this->debug('Remove cookie that is not an array');
				continue;
			}
			if ((isset($cookie['expires'])) && (! empty($cookie['expires']))) {
				if (strtotime($cookie['expires']) > time()) {
					$this->cookies[] = $cookie;
				} else {
					$this->debug('Remove expired cookie ' . $cookie['name']);
				}
			} else {
				$this->cookies[] = $cookie;
			}
		}
		$this->debug('checkCookie: '.sizeof($this->cookies).' cookies left in array');
		return true;
	}

	/**
	 * updates the current cookies with a new set
	 *
	 * @param	array $cookies new cookies with which to update current ones
	 * @return	always return true
	 * @access	public
	 */
	function UpdateCookies($cookies) {
		if (sizeof($this->cookies) == 0) {
			// no existing cookies: take whatever is new
			if (sizeof($cookies) > 0) {
				$this->debug('Setting new cookie(s)');
				$this->cookies = $cookies;
			}
			return true;
		}
		if (sizeof($cookies) == 0) {
			// no new cookies: keep what we've got
			return true;
		}
		// merge
		foreach ($cookies as $newCookie) {
			if (!is_array($newCookie)) {
				continue;
			}
			if ((!isset($newCookie['name'])) || (!isset($newCookie['value']))) {
				continue;
			}
			$newName = $newCookie['name'];

			$found = false;
			for ($i = 0; $i < count($this->cookies); $i++) {
				$cookie = $this->cookies[$i];
				if (!is_array($cookie)) {
					continue;
				}
				if (!isset($cookie['name'])) {
					continue;
				}
				if ($newName != $cookie['name']) {
					continue;
				}
				$newDomain = isset($newCookie['domain']) ? $newCookie['domain'] : 'NODOMAIN';
				$domain = isset($cookie['domain']) ? $cookie['domain'] : 'NODOMAIN';
				if ($newDomain != $domain) {
					continue;
				}
				$newPath = isset($newCookie['path']) ? $newCookie['path'] : 'NOPATH';
				$path = isset($cookie['path']) ? $cookie['path'] : 'NOPATH';
				if ($newPath != $path) {
					continue;
				}
				$this->cookies[$i] = $newCookie;
				$found = true;
				$this->debug('Update cookie ' . $newName . '=' . $newCookie['value']);
				break;
			}
			if (! $found) {
				$this->debug('Add cookie ' . $newName . '=' . $newCookie['value']);
				$this->cookies[] = $newCookie;
			}
		}
		return true;
	}
}
?><?php
//
// +--------------------------------------------------------------------+
// | PEAR, the PHP Extension and Application Repository                 |
// +--------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                              |
// +--------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,     |
// | that is bundled with this package in the file LICENSE, and is      |
// | available through the world-wide-web at the following url:         |
// | http://www.php.net/license/3_0.txt.                                |
// | If you did not receive a copy of the PHP license and are unable to |
// | obtain it through the world-wide-web, please send a note to        |
// | license@php.net so we can mail you a copy immediately.             |
// +--------------------------------------------------------------------+
// | Authors: Sterling Hughes <sterling@php.net>                        |
// |          Stig Bakken <ssb@php.net>                                 |
// |          Tomas V.V.Cox <cox@idecnet.com>                           |
// +--------------------------------------------------------------------+
//
// $Id: PEAR.php,v 1.80 2004/04/03 06:28:13 cellog Exp $
//

define('PEAR_ERROR_RETURN',     1);
define('PEAR_ERROR_PRINT',      2);
define('PEAR_ERROR_TRIGGER',    4);
define('PEAR_ERROR_DIE',        8);
define('PEAR_ERROR_CALLBACK',  16);
/**
 * WARNING: obsolete
 * @deprecated
 */
define('PEAR_ERROR_EXCEPTION', 32);
define('PEAR_ZE2', (function_exists('version_compare') &&
                    version_compare(zend_version(), "2-dev", "ge")));

if (substr(PHP_OS, 0, 3) == 'WIN') {
    define('OS_WINDOWS', true);
    define('OS_UNIX',    false);
    define('PEAR_OS',    'Windows');
} else {
    define('OS_WINDOWS', false);
    define('OS_UNIX',    true);
    define('PEAR_OS',    'Unix'); // blatant assumption
}

// instant backwards compatibility
if (!defined('PATH_SEPARATOR')) {
    if (OS_WINDOWS) {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

$GLOBALS['_PEAR_default_error_mode']     = PEAR_ERROR_RETURN;
$GLOBALS['_PEAR_default_error_options']  = E_USER_NOTICE;
$GLOBALS['_PEAR_destructor_object_list'] = array();
$GLOBALS['_PEAR_shutdown_funcs']         = array();
$GLOBALS['_PEAR_error_handler_stack']    = array();

ini_set('track_errors', true);

/**
 * Base class for other PEAR classes.  Provides rudimentary
 * emulation of destructors.
 *
 * If you want a destructor in your class, inherit PEAR and make a
 * destructor method called _yourclassname (same name as the
 * constructor, but with a "_" prefix).  Also, in your constructor you
 * have to call the PEAR constructor: $this->PEAR();.
 * The destructor method will be called without parameters.  Note that
 * at in some SAPI implementations (such as Apache), any output during
 * the request shutdown (in which destructors are called) seems to be
 * discarded.  If you need to get any debug information from your
 * destructor, use error_log(), syslog() or something similar.
 *
 * IMPORTANT! To use the emulated destructors you need to create the
 * objects by reference: $obj =& new PEAR_child;
 *
 * @since PHP 4.0.2
 * @author Stig Bakken <ssb@php.net>
 * @see http://pear.php.net/manual/
 */
class PEAR
{
    // {{{ properties

    /**
     * Whether to enable internal debug messages.
     *
     * @var     bool
     * @access  private
     */
    var $_debug = false;

    /**
     * Default error mode for this object.
     *
     * @var     int
     * @access  private
     */
    var $_default_error_mode = null;

    /**
     * Default error options used for this object when error mode
     * is PEAR_ERROR_TRIGGER.
     *
     * @var     int
     * @access  private
     */
    var $_default_error_options = null;

    /**
     * Default error handler (callback) for this object, if error mode is
     * PEAR_ERROR_CALLBACK.
     *
     * @var     string
     * @access  private
     */
    var $_default_error_handler = '';

    /**
     * Which class to use for error objects.
     *
     * @var     string
     * @access  private
     */
    var $_error_class = 'PEAR_Error';

    /**
     * An array of expected errors.
     *
     * @var     array
     * @access  private
     */
    var $_expected_errors = array();

    // }}}

    // {{{ constructor

    /**
     * Constructor.  Registers this object in
     * $_PEAR_destructor_object_list for destructor emulation if a
     * destructor object exists.
     *
     * @param string $error_class  (optional) which class to use for
     *        error objects, defaults to PEAR_Error.
     * @access public
     * @return void
     */
    function PEAR($error_class = null)
    {
        $classname = get_class($this);
        if ($this->_debug) {
            print "PEAR constructor called, class=$classname\n";
        }
        if ($error_class !== null) {
            $this->_error_class = $error_class;
        }
        while ($classname) {
            $destructor = "_$classname";
            if (method_exists($this, $destructor)) {
                global $_PEAR_destructor_object_list;
                $_PEAR_destructor_object_list[] = &$this;
                break;
            } else {
                $classname = get_parent_class($classname);
            }
        }
    }

    // }}}
    // {{{ destructor

    /**
     * Destructor (the emulated type of...).  Does nothing right now,
     * but is included for forward compatibility, so subclass
     * destructors should always call it.
     *
     * See the note in the class desciption about output from
     * destructors.
     *
     * @access public
     * @return void
     */
    function _PEAR() {
        if ($this->_debug) {
            printf("PEAR destructor called, class=%s\n", get_class($this));
        }
    }

    // }}}
    // {{{ getStaticProperty()

    /**
    * If you have a class that's mostly/entirely static, and you need static
    * properties, you can use this method to simulate them. Eg. in your method(s)
    * do this: $myVar = &PEAR::getStaticProperty('myclass', 'myVar');
    * You MUST use a reference, or they will not persist!
    *
    * @access public
    * @param  string $class  The calling classname, to prevent clashes
    * @param  string $var    The variable to retrieve.
    * @return mixed   A reference to the variable. If not set it will be
    *                 auto initialised to NULL.
    */
    function &getStaticProperty($class, $var)
    {
        static $properties;
        return $properties[$class][$var];
    }

    // }}}
    // {{{ registerShutdownFunc()

    /**
    * Use this function to register a shutdown method for static
    * classes.
    *
    * @access public
    * @param  mixed $func  The function name (or array of class/method) to call
    * @param  mixed $args  The arguments to pass to the function
    * @return void
    */
    function registerShutdownFunc($func, $args = array())
    {
        $GLOBALS['_PEAR_shutdown_funcs'][] = array($func, $args);
    }

    // }}}
    // {{{ isError()
	
	// workaround for PHP versions older than 4.2.0
	function is_a_temp($object, $class) {
        if (!is_object($object)) {
            return false;
        }

        if (get_class($object) == strtolower($class)) {
            return true;
        } else {
            return is_subclass_of($object, $class);
        }
	}
	
    /**
     * Tell whether a value is a PEAR error.
     *
     * @param   mixed $data   the value to test
     * @param   int   $code   if $data is an error object, return true
     *                        only if $code is a string and
     *                        $obj->getMessage() == $code or
     *                        $code is an integer and $obj->getCode() == $code
     * @access  public
     * @return  bool    true if parameter is an error
     */
    function isError($data, $code = null)
    {
        if ($this->is_a_temp($data, 'PEAR_Error')) {
            if (is_null($code)) {
                return true;
            } elseif (is_string($code)) {
                return $data->getMessage() == $code;
            } else {
                return $data->getCode() == $code;
            }
        }
        return false;
    }
	
	
	
    // }}}
    // {{{ setErrorHandling()

    /**
     * Sets how errors generated by this object should be handled.
     * Can be invoked both in objects and statically.  If called
     * statically, setErrorHandling sets the default behaviour for all
     * PEAR objects.  If called in an object, setErrorHandling sets
     * the default behaviour for that object.
     *
     * @param int $mode
     *        One of PEAR_ERROR_RETURN, PEAR_ERROR_PRINT,
     *        PEAR_ERROR_TRIGGER, PEAR_ERROR_DIE,
     *        PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION.
     *
     * @param mixed $options
     *        When $mode is PEAR_ERROR_TRIGGER, this is the error level (one
     *        of E_USER_NOTICE, E_USER_WARNING or E_USER_ERROR).
     *
     *        When $mode is PEAR_ERROR_CALLBACK, this parameter is expected
     *        to be the callback function or method.  A callback
     *        function is a string with the name of the function, a
     *        callback method is an array of two elements: the element
     *        at index 0 is the object, and the element at index 1 is
     *        the name of the method to call in the object.
     *
     *        When $mode is PEAR_ERROR_PRINT or PEAR_ERROR_DIE, this is
     *        a printf format string used when printing the error
     *        message.
     *
     * @access public
     * @return void
     * @see PEAR_ERROR_RETURN
     * @see PEAR_ERROR_PRINT
     * @see PEAR_ERROR_TRIGGER
     * @see PEAR_ERROR_DIE
     * @see PEAR_ERROR_CALLBACK
     * @see PEAR_ERROR_EXCEPTION
     *
     * @since PHP 4.0.5
     */

    function setErrorHandling($mode = null, $options = null)
    {
        if (isset($this) && $this->is_a_temp($this, 'PEAR')) {
            $setmode     = &$this->_default_error_mode;
            $setoptions  = &$this->_default_error_options;
        } else {
            $setmode     = &$GLOBALS['_PEAR_default_error_mode'];
            $setoptions  = &$GLOBALS['_PEAR_default_error_options'];
        }

        switch ($mode) {
            case PEAR_ERROR_EXCEPTION:
            case PEAR_ERROR_RETURN:
            case PEAR_ERROR_PRINT:
            case PEAR_ERROR_TRIGGER:
            case PEAR_ERROR_DIE:
            case null:
                $setmode = $mode;
                $setoptions = $options;
                break;

            case PEAR_ERROR_CALLBACK:
                $setmode = $mode;
                // class/object method callback
                if (is_callable($options)) {
                    $setoptions = $options;
                } else {
                    trigger_error("invalid error callback", E_USER_WARNING);
                }
                break;

            default:
                trigger_error("invalid error mode", E_USER_WARNING);
                break;
        }
    }

    // }}}
    // {{{ expectError()

    /**
     * This method is used to tell which errors you expect to get.
     * Expected errors are always returned with error mode
     * PEAR_ERROR_RETURN.  Expected error codes are stored in a stack,
     * and this method pushes a new element onto it.  The list of
     * expected errors are in effect until they are popped off the
     * stack with the popExpect() method.
     *
     * Note that this method can not be called statically
     *
     * @param mixed $code a single error code or an array of error codes to expect
     *
     * @return int     the new depth of the "expected errors" stack
     * @access public
     */
    function expectError($code = '*')
    {
        if (is_array($code)) {
            array_push($this->_expected_errors, $code);
        } else {
            array_push($this->_expected_errors, array($code));
        }
        return sizeof($this->_expected_errors);
    }

    // }}}
    // {{{ popExpect()

    /**
     * This method pops one element off the expected error codes
     * stack.
     *
     * @return array   the list of error codes that were popped
     */
    function popExpect()
    {
        return array_pop($this->_expected_errors);
    }

    // }}}
    // {{{ _checkDelExpect()

    /**
     * This method checks unsets an error code if available
     *
     * @param mixed error code
     * @return bool true if the error code was unset, false otherwise
     * @access private
     * @since PHP 4.3.0
     */
    function _checkDelExpect($error_code)
    {
        $deleted = false;

        foreach ($this->_expected_errors AS $key => $error_array) {
            if (in_array($error_code, $error_array)) {
                unset($this->_expected_errors[$key][array_search($error_code, $error_array)]);
                $deleted = true;
            }

            // clean up empty arrays
            if (0 == count($this->_expected_errors[$key])) {
                unset($this->_expected_errors[$key]);
            }
        }
        return $deleted;
    }

    // }}}
    // {{{ delExpect()

    /**
     * This method deletes all occurences of the specified element from
     * the expected error codes stack.
     *
     * @param  mixed $error_code error code that should be deleted
     * @return mixed list of error codes that were deleted or error
     * @access public
     * @since PHP 4.3.0
     */
    function delExpect($error_code)
    {
        $deleted = false;

        if ((is_array($error_code) && (0 != count($error_code)))) {
            // $error_code is a non-empty array here;
            // we walk through it trying to unset all
            // values
            foreach($error_code as $key => $error) {
                if ($this->_checkDelExpect($error)) {
                    $deleted =  true;
                } else {
                    $deleted = false;
                }
            }
            return $deleted ? true : PEAR::raiseError("The expected error you submitted does not exist"); // IMPROVE ME
        } elseif (!empty($error_code)) {
            // $error_code comes alone, trying to unset it
            if ($this->_checkDelExpect($error_code)) {
                return true;
            } else {
                return PEAR::raiseError("The expected error you submitted does not exist"); // IMPROVE ME
            }
        } else {
            // $error_code is empty
            return PEAR::raiseError("The expected error you submitted is empty"); // IMPROVE ME
        }
    }

    // }}}
    // {{{ raiseError()

    /**
     * This method is a wrapper that returns an instance of the
     * configured error class with this object's default error
     * handling applied.  If the $mode and $options parameters are not
     * specified, the object's defaults are used.
     *
     * @param mixed $message a text error message or a PEAR error object
     *
     * @param int $code      a numeric error code (it is up to your class
     *                  to define these if you want to use codes)
     *
     * @param int $mode      One of PEAR_ERROR_RETURN, PEAR_ERROR_PRINT,
     *                  PEAR_ERROR_TRIGGER, PEAR_ERROR_DIE,
     *                  PEAR_ERROR_CALLBACK, PEAR_ERROR_EXCEPTION.
     *
     * @param mixed $options If $mode is PEAR_ERROR_TRIGGER, this parameter
     *                  specifies the PHP-internal error level (one of
     *                  E_USER_NOTICE, E_USER_WARNING or E_USER_ERROR).
     *                  If $mode is PEAR_ERROR_CALLBACK, this
     *                  parameter specifies the callback function or
     *                  method.  In other error modes this parameter
     *                  is ignored.
     *
     * @param string $userinfo If you need to pass along for example debug
     *                  information, this parameter is meant for that.
     *
     * @param string $error_class The returned error object will be
     *                  instantiated from this class, if specified.
     *
     * @param bool $skipmsg If true, raiseError will only pass error codes,
     *                  the error message parameter will be dropped.
     *
     * @access public
     * @return object   a PEAR error object
     * @see PEAR::setErrorHandling
     * @since PHP 4.0.5
     */
    function raiseError($message = null,
                         $code = null,
                         $mode = null,
                         $options = null,
                         $userinfo = null,
                         $error_class = null,
                         $skipmsg = false)
    {
        // The error is yet a PEAR error object
        if (is_object($message)) {
            $code        = $message->getCode();
            $userinfo    = $message->getUserInfo();
            $error_class = $message->getType();
            $message->error_message_prefix = '';
            $message     = $message->getMessage();
        }

        if (isset($this) && isset($this->_expected_errors) && sizeof($this->_expected_errors) > 0 && sizeof($exp = end($this->_expected_errors))) {
            if ($exp[0] == "*" ||
                (is_int(reset($exp)) && in_array($code, $exp)) ||
                (is_string(reset($exp)) && in_array($message, $exp))) {
                $mode = PEAR_ERROR_RETURN;
            }
        }
        // No mode given, try global ones
        if ($mode === null) {
            // Class error handler
            if (isset($this) && isset($this->_default_error_mode)) {
                $mode    = $this->_default_error_mode;
                $options = $this->_default_error_options;
            // Global error handler
            } elseif (isset($GLOBALS['_PEAR_default_error_mode'])) {
                $mode    = $GLOBALS['_PEAR_default_error_mode'];
                $options = $GLOBALS['_PEAR_default_error_options'];
            }
        }

        if ($error_class !== null) {
            $ec = $error_class;
        } elseif (isset($this) && isset($this->_error_class)) {
            $ec = $this->_error_class;
        } else {
            $ec = 'PEAR_Error';
        }
        if ($skipmsg) {
            return new $ec($code, $mode, $options, $userinfo);
        } else {
            return new $ec($message, $code, $mode, $options, $userinfo);
        }
    }

    // }}}
    // {{{ throwError()

    /**
     * Simpler form of raiseError with fewer options.  In most cases
     * message, code and userinfo are enough.
     *
     * @param string $message
     *
     */
    function throwError($message = null,
                         $code = null,
                         $userinfo = null)
    {
        if (isset($this) && $this->is_a_temp($this, 'PEAR')) {
            return $this->raiseError($message, $code, null, null, $userinfo);
        } else {
            return PEAR::raiseError($message, $code, null, null, $userinfo);
        }
    }

    // }}}
    // {{{ pushErrorHandling()

    /**
     * Push a new error handler on top of the error handler options stack. With this
     * you can easily override the actual error handler for some code and restore
     * it later with popErrorHandling.
     *
     * @param mixed $mode (same as setErrorHandling)
     * @param mixed $options (same as setErrorHandling)
     *
     * @return bool Always true
     *
     * @see PEAR::setErrorHandling
     */
    function pushErrorHandling($mode, $options = null)
    {
        $stack = &$GLOBALS['_PEAR_error_handler_stack'];
        if (isset($this) && $this->is_a_temp($this, 'PEAR')) {
            $def_mode    = &$this->_default_error_mode;
            $def_options = &$this->_default_error_options;
        } else {
            $def_mode    = &$GLOBALS['_PEAR_default_error_mode'];
            $def_options = &$GLOBALS['_PEAR_default_error_options'];
        }
        $stack[] = array($def_mode, $def_options);

        if (isset($this) && $this->is_a_temp($this, 'PEAR')) {
            $this->setErrorHandling($mode, $options);
        } else {
            PEAR::setErrorHandling($mode, $options);
        }
        $stack[] = array($mode, $options);
        return true;
    }

    // }}}
    // {{{ popErrorHandling()

    /**
    * Pop the last error handler used
    *
    * @return bool Always true
    *
    * @see PEAR::pushErrorHandling
    */
    function popErrorHandling()
    {
        $stack = &$GLOBALS['_PEAR_error_handler_stack'];
        array_pop($stack);
        list($mode, $options) = $stack[sizeof($stack) - 1];
        array_pop($stack);
        if (isset($this) && $this->is_a_temp($this, 'PEAR')) {
            $this->setErrorHandling($mode, $options);
        } else {
            PEAR::setErrorHandling($mode, $options);
        }
        return true;
    }

    // }}}
    // {{{ loadExtension()

    /**
    * OS independant PHP extension load. Remember to take care
    * on the correct extension name for case sensitive OSes.
    *
    * @param string $ext The extension name
    * @return bool Success or not on the dl() call
    */
    function loadExtension($ext)
    {
        if (!extension_loaded($ext)) {
            // if either returns true dl() will produce a FATAL error, stop that
            if ((ini_get('enable_dl') != 1) || (ini_get('safe_mode') == 1)) {
                return false;
            }
            if (OS_WINDOWS) {
                $suffix = '.dll';
            } elseif (PHP_OS == 'HP-UX') {
                $suffix = '.sl';
            } elseif (PHP_OS == 'AIX') {
                $suffix = '.a';
            } elseif (PHP_OS == 'OSX') {
                $suffix = '.bundle';
            } else {
                $suffix = '.so';
            }
            return @dl('php_'.$ext.$suffix) || @dl($ext.$suffix);
        }
        return true;
    }

    // }}}
}

// {{{ _PEAR_call_destructors()

function _PEAR_call_destructors()
{
    global $_PEAR_destructor_object_list;
    if (is_array($_PEAR_destructor_object_list) &&
        sizeof($_PEAR_destructor_object_list))
    {
        reset($_PEAR_destructor_object_list);
        while (list($k, $objref) = each($_PEAR_destructor_object_list)) {
            $classname = get_class($objref);
            while ($classname) {
                $destructor = "_$classname";
                if (method_exists($objref, $destructor)) {
                    $objref->$destructor();
                    break;
                } else {
                    $classname = get_parent_class($classname);
                }
            }
        }
        // Empty the object list to ensure that destructors are
        // not called more than once.
        $_PEAR_destructor_object_list = array();
    }

    // Now call the shutdown functions
    if (is_array($GLOBALS['_PEAR_shutdown_funcs']) AND !empty($GLOBALS['_PEAR_shutdown_funcs'])) {
        foreach ($GLOBALS['_PEAR_shutdown_funcs'] as $value) {
            call_user_func_array($value[0], $value[1]);
        }
    }
}

// }}}

class PEAR_Error
{
    // {{{ properties

    var $error_message_prefix = '';
    var $mode                 = PEAR_ERROR_RETURN;
    var $level                = E_USER_NOTICE;
    var $code                 = -1;
    var $message              = '';
    var $userinfo             = '';
    var $backtrace            = null;

    // }}}
    // {{{ constructor

    /**
     * PEAR_Error constructor
     *
     * @param string $message  message
     *
     * @param int $code     (optional) error code
     *
     * @param int $mode     (optional) error mode, one of: PEAR_ERROR_RETURN,
     * PEAR_ERROR_PRINT, PEAR_ERROR_DIE, PEAR_ERROR_TRIGGER,
     * PEAR_ERROR_CALLBACK or PEAR_ERROR_EXCEPTION
     *
     * @param mixed $options   (optional) error level, _OR_ in the case of
     * PEAR_ERROR_CALLBACK, the callback function or object/method
     * tuple.
     *
     * @param string $userinfo (optional) additional user/debug info
     *
     * @access public
     *
     */
    function PEAR_Error($message = 'unknown error', $code = null,
                        $mode = null, $options = null, $userinfo = null)
    {
        if ($mode === null) {
            $mode = PEAR_ERROR_RETURN;
        }
        $this->message   = $message;
        $this->code      = $code;
        $this->mode      = $mode;
        $this->userinfo  = $userinfo;
        if (function_exists("debug_backtrace")) {
            $this->backtrace = debug_backtrace();
        }
        if ($mode & PEAR_ERROR_CALLBACK) {
            $this->level = E_USER_NOTICE;
            $this->callback = $options;
        } else {
            if ($options === null) {
                $options = E_USER_NOTICE;
            }
            $this->level = $options;
            $this->callback = null;
        }
        if ($this->mode & PEAR_ERROR_PRINT) {
            if (is_null($options) || is_int($options)) {
                $format = "%s";
            } else {
                $format = $options;
            }
            printf($format, $this->getMessage());
        }
        if ($this->mode & PEAR_ERROR_TRIGGER) {
            trigger_error($this->getMessage(), $this->level);
        }
        if ($this->mode & PEAR_ERROR_DIE) {
            $msg = $this->getMessage();
            if (is_null($options) || is_int($options)) {
                $format = "%s";
                if (substr($msg, -1) != "\n") {
                    $msg .= "\n";
                }
            } else {
                $format = $options;
            }
            die(sprintf($format, $msg));
        }
        if ($this->mode & PEAR_ERROR_CALLBACK) {
            if (is_callable($this->callback)) {
                call_user_func($this->callback, $this);
            }
        }
        if ($this->mode & PEAR_ERROR_EXCEPTION) {
            trigger_error("PEAR_ERROR_EXCEPTION is obsolete, use class PEAR_ErrorStack for exceptions", E_USER_WARNING);
            eval('$e = new Exception($this->message, $this->code);$e->PEAR_Error = $this;throw($e);');
        }
    }

    // }}}
    // {{{ getMode()

    /**
     * Get the error mode from an error object.
     *
     * @return int error mode
     * @access public
     */
    function getMode() {
        return $this->mode;
    }

    // }}}
    // {{{ getCallback()

    /**
     * Get the callback function/method from an error object.
     *
     * @return mixed callback function or object/method array
     * @access public
     */
    function getCallback() {
        return $this->callback;
    }

    // }}}
    // {{{ getMessage()


    /**
     * Get the error message from an error object.
     *
     * @return  string  full error message
     * @access public
     */
    function getMessage()
    {
        return ($this->error_message_prefix . $this->message);
    }


    // }}}
    // {{{ getCode()

    /**
     * Get error code from an error object
     *
     * @return int error code
     * @access public
     */
     function getCode()
     {
        return $this->code;
     }

    // }}}
    // {{{ getType()

    /**
     * Get the name of this error/exception.
     *
     * @return string error/exception name (type)
     * @access public
     */
    function getType()
    {
        return get_class($this);
    }

    // }}}
    // {{{ getUserInfo()

    /**
     * Get additional user-supplied information.
     *
     * @return string user-supplied information
     * @access public
     */
    function getUserInfo()
    {
        return $this->userinfo;
    }

    // }}}
    // {{{ getDebugInfo()

    /**
     * Get additional debug information supplied by the application.
     *
     * @return string debug information
     * @access public
     */
    function getDebugInfo()
    {
        return $this->getUserInfo();
    }

    // }}}
    // {{{ getBacktrace()

    /**
     * Get the call backtrace from where the error was generated.
     * Supported with PHP 4.3.0 or newer.
     *
     * @param int $frame (optional) what frame to fetch
     * @return array Backtrace, or NULL if not available.
     * @access public
     */
    function getBacktrace($frame = null)
    {
        if ($frame === null) {
            return $this->backtrace;
        }
        return $this->backtrace[$frame];
    }

    // }}}
    // {{{ addUserInfo()

    function addUserInfo($info)
    {
        if (empty($this->userinfo)) {
            $this->userinfo = $info;
        } else {
            $this->userinfo .= " ** $info";
        }
    }

    // }}}
    // {{{ toString()

    /**
     * Make a string representation of this object.
     *
     * @return string a string with an object summary
     * @access public
     */
    function toString() {
        $modes = array();
        $levels = array(E_USER_NOTICE  => 'notice',
                        E_USER_WARNING => 'warning',
                        E_USER_ERROR   => 'error');
        if ($this->mode & PEAR_ERROR_CALLBACK) {
            if (is_array($this->callback)) {
                $callback = get_class($this->callback[0]) . '::' .
                    $this->callback[1];
            } else {
                $callback = $this->callback;
            }
            return sprintf('[%s: message="%s" code=%d mode=callback '.
                           'callback=%s prefix="%s" info="%s"]',
                           get_class($this), $this->message, $this->code,
                           $callback, $this->error_message_prefix,
                           $this->userinfo);
        }
        if ($this->mode & PEAR_ERROR_PRINT) {
            $modes[] = 'print';
        }
        if ($this->mode & PEAR_ERROR_TRIGGER) {
            $modes[] = 'trigger';
        }
        if ($this->mode & PEAR_ERROR_DIE) {
            $modes[] = 'die';
        }
        if ($this->mode & PEAR_ERROR_RETURN) {
            $modes[] = 'return';
        }
        return sprintf('[%s: message="%s" code=%d mode=%s level=%s '.
                       'prefix="%s" info="%s"]',
                       get_class($this), $this->message, $this->code,
                       implode("|", $modes), $levels[$this->level],
                       $this->error_message_prefix,
                       $this->userinfo);
    }

    // }}}
}

register_shutdown_function("_PEAR_call_destructors");

/*
 * Local Variables:
 * mode: php
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 */
?><?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Author: Stig Bakken <ssb@fast.no>                                    |
// |         Tomas V.V.Cox <cox@idecnet.com>                              |
// |         Stephan Schmidt <schst@php-tools.net>                        |
// +----------------------------------------------------------------------+
//
// $Id: Parser.php,v 1.14 2004/05/25 13:26:42 schst Exp $

/**
 * XML Parser class.
 *
 * This is an XML parser based on PHP's "xml" extension,
 * based on the bundled expat library.
 *
 * @category XML
 * @package XML_Parser
 * @author  Stig Bakken <ssb@fast.no>
 * @author  Tomas V.V.Cox <cox@idecnet.com>
 * @author  Stephan Schmidt <schst@php-tools.net>
 */

/**
 * uses PEAR's error handling
 */
//require_once 'PEAR.php';

/**
 * resource could not be created
 */
define('XML_PARSER_ERROR_NO_RESOURCE', 200);

/**
 * unsupported mode
 */
define('XML_PARSER_ERROR_UNSUPPORTED_MODE', 201);

/**
 * invalid encoding was given
 */
define('XML_PARSER_ERROR_INVALID_ENCODING', 202);

/**
 * specified file could not be read
 */
define('XML_PARSER_ERROR_FILE_NOT_READABLE', 203);

/**
 * invalid input
 */
define('XML_PARSER_ERROR_INVALID_INPUT', 204);

/**
 * remote file cannot be retrieved in safe mode
 */
define('XML_PARSER_ERROR_REMOTE', 205);

/**
 * XML Parser class.
 *
 * This is an XML parser based on PHP's "xml" extension,
 * based on the bundled expat library.
 *
 * Notes:
 * - It requires PHP 4.0.4pl1 or greater
 * - From revision 1.17, the function names used by the 'func' mode
 *   are in the format "xmltag_$elem", for example: use "xmltag_name"
 *   to handle the <name></name> tags of your xml file.
 *
 * @category XML
 * @package XML_Parser
 * @author  Stig Bakken <ssb@fast.no>
 * @author  Tomas V.V.Cox <cox@idecnet.com>
 * @author  Stephan Schmidt <schst@php-tools.net>
 * @todo    create XML_Parser_Namespace to parse documents with namespaces
 * @todo    create XML_Parser_Pull
 * @todo    Tests that need to be made:
 *          - mixing character encodings
 *          - a test using all expat handlers
 *          - options (folding, output charset)
 *          - different parsing modes
 */
class XML_Parser extends PEAR
{
    // {{{ properties

   /**
     * XML parser handle
     *
     * @var  resource
     * @see  xml_parser_create()
     */
    var $parser;

    /**
     * File handle if parsing from a file
     *
     * @var  resource
     */
    var $fp;

    /**
     * Whether to do case folding
     *
     * If set to true, all tag and attribute names will
     * be converted to UPPER CASE.
     *
     * @var  boolean
     */
    var $folding = true;

    /**
     * Mode of operation, one of "event" or "func"
     *
     * @var  string
     */
    var $mode;

    /**
     * Mapping from expat handler function to class method.
     *
     * @var  array
     */
    var $handler = array(
        'character_data_handler'            => 'cdataHandler',
        'default_handler'                   => 'defaultHandler',
        'processing_instruction_handler'    => 'piHandler',
        'unparsed_entity_decl_handler'      => 'unparsedHandler',
        'notation_decl_handler'             => 'notationHandler',
        'external_entity_ref_handler'       => 'entityrefHandler'
    );

    /**
     * source encoding
     *
     * @var string
     */
    var $srcenc;

    /**
     * target encoding
     *
     * @var string
     */
    var $tgtenc;

    /**
     * handler object
     *
     * @var object
     */
    var $_handlerObj;

    // }}}
    // {{{ constructor

    /**
     * Creates an XML parser.
     *
     * This is needed for PHP4 compatibility, it will
     * call the constructor, when a new instance is created.
     *
     * @param string $srcenc source charset encoding, use NULL (default) to use
     *                       whatever the document specifies
     * @param string $mode   how this parser object should work, "event" for
     *                       startelement/endelement-type events, "func"
     *                       to have it call functions named after elements
     * @param string $tgenc  a valid target encoding
     */
    function XML_Parser($srcenc = null, $mode = 'event', $tgtenc = null)
    {
        XML_Parser::__construct($srcenc, $mode, $tgtenc);
    }
    // }}}

    /**
     * PHP5 constructor
     *
     * @param string $srcenc source charset encoding, use NULL (default) to use
     *                       whatever the document specifies
     * @param string $mode   how this parser object should work, "event" for
     *                       startelement/endelement-type events, "func"
     *                       to have it call functions named after elements
     * @param string $tgenc  a valid target encoding
     */
    function __construct($srcenc = null, $mode = 'event', $tgtenc = null)
    {
        $this->PEAR('XML_Parser_Error');

        $this->mode   = $mode;
        $this->srcenc = $srcenc;
        $this->tgtenc = $tgtenc;
    }
    // }}}

    /**
     * Sets the mode of the parser.
     *
     * Possible modes are:
     * - func
     * - event
     *
     * You can set the mode using the second parameter
     * in the constructor.
     *
     * This method is only needed, when switching to a new
     * mode at a later point.
     *
     * @access  public
     * @param   string          mode, either 'func' or 'event'
     * @return  boolean|object  true on success, PEAR_Error otherwise   
     */
    function setMode($mode)
    {
        if ($mode != 'func' && $mode != 'event') {
            $this->raiseError('Unsupported mode given', XML_PARSER_ERROR_UNSUPPORTED_MODE);
        }

        $this->mode = $mode;
        return true;
    }

    /**
     * Sets the object, that will handle the XML events
     *
     * This allows you to create a handler object independent of the
     * parser object that you are using and easily switch the underlying
     * parser.
     *
     * If no object will be set, XML_Parser assumes that you
     * extend this class and handle the events in $this.
     *
     * @access  public
     * @param   object      object to handle the events
     * @return  boolean     will always return true
     * @since   v1.2.0beta3
     */
    function setHandlerObj(&$obj)
    {
        $this->_handlerObj = &$obj;
        return true;
    }

    /**
     * Init the element handlers
     *
     * @access  private
     */
    function _initHandlers()
    {
        if (!is_resource($this->parser)) {
            return false;
        }

        if (!@is_object($this->_handlerObj)) {
            $this->_handlerObj = &$this;
        }
        switch ($this->mode) {

            case 'func':
                xml_set_object($this->parser, $this);
                xml_set_element_handler($this->parser, 'funcStartHandler', 'funcEndHandler');
                break;

            case 'event':
                xml_set_object($this->parser, $this->_handlerObj);
                xml_set_element_handler($this->parser, 'startHandler', 'endHandler');
                break;
            default:
                return $this->raiseError('Unsupported mode given', XML_PARSER_ERROR_UNSUPPORTED_MODE);
                break;
        }


        /**
         * set additional handlers for character data, entities, etc.
         */
        foreach ($this->handler as $xml_func => $method) {
            if (method_exists($this->_handlerObj, $method)) {
                $xml_func = 'xml_set_' . $xml_func;
                $xml_func($this->parser, $method);
            }
		}
    }

    // {{{ _create()

    /**
     * create the XML parser resource
     *
     * Has been moved from the constructor to avoid
     * problems with object references.
     *
     * Furthermore it allows us returning an error
     * if something fails.
     *
     * @access   private
     * @return   boolean|object     true on success, PEAR_Error otherwise
     *
     * @see xml_parser_create
     */
    function _create()
    {
        if ($this->srcenc === null) {
            $xp = @xml_parser_create();
        } else {
            $xp = @xml_parser_create($this->srcenc);
        }
        if (is_resource($xp)) {
            if ($this->tgtenc !== null) {
                if (!@xml_parser_set_option($xp, XML_OPTION_TARGET_ENCODING,
                                            $this->tgtenc)) {
                    return $this->raiseError('invalid target encoding', XML_PARSER_ERROR_INVALID_ENCODING);
                }
            }
            $this->parser = $xp;
            $result = $this->_initHandlers($this->mode);
            if ($this->isError($result)) {
                return $result;
            }
            xml_parser_set_option($xp, XML_OPTION_CASE_FOLDING, $this->folding);

            return true;
        }
        return $this->raiseError('Unable to create XML parser resource.', XML_PARSER_ERROR_NO_RESOURCE);
    }

    // }}}
    // {{{ reset()

    /**
     * Reset the parser.
     *
     * This allows you to use one parser instance
     * to parse multiple XML documents.
     *
     * @access   public
     * @return   boolean|object     true on success, PEAR_Error otherwise
     */
    function reset()
    {
        $result = $this->_create();
        if ($this->isError( $result )) {
            return $result;
        }
    }

    // }}}
    // {{{ setInputFile()

    /**
     * Sets the input xml file to be parsed
     *
     * @param    string      Filename (full path)
     * @return   resource    fopen handle of the given file
     * @throws   XML_Parser_Error
     * @see      setInput(), setInputString(), parse()
     * @access   public
     */
    function setInputFile($file)
    {
        /**
         * check, if file is a remote file
         */
        if (eregi('^(http|ftp)://', substr($file, 0, 10))) {
            if (!ini_get('safe_mode')) {
                ini_set('allow_url_fopen', 1);
            } else {
                return $this->raiseError('Remote files cannot be parsed, as safe mode is enabled.', XML_PARSER_ERROR_REMOTE);
            }
        }
        
        $fp = @fopen($file, 'rb');
        if (is_resource($fp)) {
            $this->fp = $fp;
            return $fp;
        }
        return $this->raiseError('File could not be opened.', XML_PARSER_ERROR_FILE_NOT_READABLE);
    }

    // }}}
    // {{{ setInputString()
    
    /**
     * XML_Parser::setInputString()
     * 
     * Sets the xml input from a string
     * 
     * @param string $data a string containing the XML document
     * @return null
     **/
    function setInputString($data)
    {
        $this->fp = $data;
        return null;
    }
    
    // }}}
    // {{{ setInput()

    /**
     * Sets the file handle to use with parse().
     *
     * You should use setInputFile() or setInputString() if you
     * pass a string 
     *
     * @param    mixed  $fp  Can be either a resource returned from fopen(),
     *                       a URL, a local filename or a string.
     * @access   public
     * @see      parse()
     * @uses     setInputString(), setInputFile()
     */
    function setInput($fp)
    {
        if (is_resource($fp)) {
            $this->fp = $fp;
            return true;
        }
        // see if it's an absolute URL (has a scheme at the beginning)
        elseif (eregi('^[a-z]+://', substr($fp, 0, 10))) {
            return $this->setInputFile($fp);
        }
        // see if it's a local file
        elseif (file_exists($fp)) {
            return $this->setInputFile($fp);
        }
        // it must be a string
        else {
            $this->fp = $fp;
            return true;
        }

        return $this->raiseError('Illegal input format', XML_PARSER_ERROR_INVALID_INPUT);
    }

    // }}}
    // {{{ parse()

    /**
     * Central parsing function.
     *
     * @return   true|object PEAR error     returns true on success, or a PEAR_Error otherwise
     * @access   public
     */
    function parse()
    {
        /**
         * reset the parser
         */
        $result = $this->reset();
        if ($this->isError($result)) {
            return $result;
        }
        // if $this->fp was fopened previously
        if (is_resource($this->fp)) {
        
            while ($data = fread($this->fp, 4096)) {
                if (!$this->_parseString($data, feof($this->fp))) {
                    return $this->raiseError();
                }
            }
        // otherwise, $this->fp must be a string
        } else {
            if (!$this->_parseString($this->fp, true)) {
                return $this->raiseError();
            }
        }
        $this->free();

        return true;
    }

    /**
     * XML_Parser::_parseString()
     * 
     * @param string $data
     * @param boolean $eof
     * @return bool
     * @access private
     * @see parseString()
     **/
    function _parseString($data, $eof = false)
    {
        return xml_parse($this->parser, $data, $eof);
    }
    
    // }}}
    // {{{ parseString()

    /**
     * XML_Parser::parseString()
     * 
     * Parses a string.
     *
     * @param    string  $data XML data
     * @param    boolean $eof  If set and TRUE, data is the last piece of data sent in this parser
     * @throws   XML_Parser_Error
     * @return   Pear Error|true   true on success or a PEAR Error
     * @see      _parseString()
     */
    function parseString($data, $eof = false)
    {
        if (!isset($this->parser) || !is_resource($this->parser)) {
            $this->reset();
        }
        
        if (!$this->_parseString($data, $eof)) {
           return $this->raiseError();
        }

        if ($eof === true) {
            $this->free();
        }
        return true;
    }
    
    /**
     * XML_Parser::free()
     * 
     * Free the internal resources associated with the parser
     * 
     * @return null
     **/
    function free()
    {
        if (isset($this->parser) AND is_resource($this->parser)) {
            xml_parser_free($this->parser);
            unset( $this->parser );
        }
        if (isset($this->fp) && is_resource($this->fp)) {
            fclose($this->fp);
        }
        unset($this->fp);
        return null;
    }
    
    /**
     * XML_Parser::raiseError()
     * 
     * Trows a XML_Parser_Error and free's the internal resources
     * 
     * @param string  $msg   the error message
     * @param integer $ecode the error message code
     * @return XML_Parser_Error 
     **/
    function raiseError($msg = null, $ecode = 0)
    {
        $msg = !is_null($msg) ? $msg : $this->parser;
        $err = &new XML_Parser_Error($msg, $ecode);
        $this->free();
        return parent::raiseError($err);
    }
    
    // }}}
    // {{{ funcStartHandler()

    function funcStartHandler($xp, $elem, $attribs)
    {
        $func = 'xmltag_' . $elem;
        if (method_exists($this->_handlerObj, $func)) {
            call_user_func(array(&$this->_handlerObj, $func), $xp, $elem, $attribs);
        }
    }

    // }}}
    // {{{ funcEndHandler()

    function funcEndHandler($xp, $elem)
    {
        $func = 'xmltag_' . $elem . '_';
        if (method_exists($this, $func)) {
            call_user_func(array(&$this->_handlerObj, $func), $xp, $elem);
        }
    }

    // }}}
    // {{{ startHandler()

    /**
     *
     * @abstract
     */
    function startHandler($xp, $elem, &$attribs)
    {
        return NULL;
    }

    // }}}
    // {{{ endHandler()

    /**
     *
     * @abstract
     */
    function endHandler($xp, $elem)
    {
        return NULL;
    }


    // }}}
}

/**
 * error class, replaces PEAR_Error
 *
 * An instance of this class will be returned
 * if an error occurs inside XML_Parser.
 *
 * There are three advantages over using the standard PEAR_Error:
 * - All messages will be prefixed
 * - check for XML_Parser error, using $this->is_a_temp( $error, 'XML_Parser_Error' )
 * - messages can be generated from the xml_parser resource
 *
 * @package XML_Parser
 * @access  public
 * @see     PEAR_Error
 */
class XML_Parser_Error extends PEAR_Error
{
    // {{{ properties

   /**
    * prefix for all messages
    *
    * @var      string
    */    
    var $error_message_prefix = 'XML_Parser: ';

    // }}}
    // {{{ constructor()
   /**
    * construct a new error instance
    *
    * You may either pass a message or an xml_parser resource as first
    * parameter. If a resource has been passed, the last error that
    * happened will be retrieved and returned.
    *
    * @access   public
    * @param    string|resource     message or parser resource
    * @param    integer             error code
    * @param    integer             error handling
    * @param    integer             error level
    */    
    function XML_Parser_Error($msgorparser = 'unknown error', $code = 0, $mode = PEAR_ERROR_RETURN, $level = E_USER_NOTICE)
    {
        if (is_resource($msgorparser)) {
            $code = xml_get_error_code($msgorparser);
            $msgorparser = sprintf('%s at XML input line %d',
                                   xml_error_string($code),
                                   xml_get_current_line_number($msgorparser));
        }
        $this->PEAR_Error($msgorparser, $code, $mode, $level);
    }
    // }}}
}
?><?php

/**
* Fast, light and safe Cache Class
*
* Cache_Lite is a fast, light and safe cache system. It's optimized
* for file containers. It is fast and safe (because it uses file
* locking and/or anti-corruption tests).
*
* There are some examples in the 'docs/examples' file
* Technical choices are described in the 'docs/technical' file
*
* Memory Caching is from an original idea of
* Mike BENOIT <ipso@snappymail.ca>
*
* Nota : A chinese documentation (thanks to RainX <china_1982@163.com>) is
* available at :
* http://rainx.phpmore.com/manual/cache_lite.html
*
* @package Cache_Lite
* @category Caching
* @version $Id: Lite.php,v 1.30 2005/06/13 20:50:48 fab Exp $
* @author Fabien MARTY <fab@php.net>
*/

define('CACHE_LITE_ERROR_RETURN', 1);
define('CACHE_LITE_ERROR_DIE', 8);

class Cache_Lite
{

    // --- Private properties ---

    /**
    * Directory where to put the cache files
    * (make sure to add a trailing slash)
    *
    * @var string $_cacheDir
    */
    var $_cacheDir = '/tmp/';

    /**
    * Enable / disable caching
    *
    * (can be very usefull for the debug of cached scripts)
    *
    * @var boolean $_caching
    */
    var $_caching = true;

    /**
    * Cache lifetime (in seconds)
    *
    * @var int $_lifeTime
    */
    var $_lifeTime = 3600;

    /**
    * Enable / disable fileLocking
    *
    * (can avoid cache corruption under bad circumstances)
    *
    * @var boolean $_fileLocking
    */
    var $_fileLocking = true;

    /**
    * Timestamp of the last valid cache
    *
    * @var int $_refreshTime
    */
    var $_refreshTime;

    /**
    * File name (with path)
    *
    * @var string $_file
    */
    var $_file;
    
    /**
    * File name (without path)
    *
    * @var string $_fileName
    */
    var $_fileName;

    /**
    * Enable / disable write control (the cache is read just after writing to detect corrupt entries)
    *
    * Enable write control will lightly slow the cache writing but not the cache reading
    * Write control can detect some corrupt cache files but maybe it's not a perfect control
    *
    * @var boolean $_writeControl
    */
    var $_writeControl = true;

    /**
    * Enable / disable read control
    *
    * If enabled, a control key is embeded in cache file and this key is compared with the one
    * calculated after the reading.
    *
    * @var boolean $_writeControl
    */
    var $_readControl = true;

    /**
    * Type of read control (only if read control is enabled)
    *
    * Available values are :
    * 'md5' for a md5 hash control (best but slowest)
    * 'crc32' for a crc32 hash control (lightly less safe but faster, better choice)
    * 'strlen' for a length only test (fastest)
    *
    * @var boolean $_readControlType
    */
    var $_readControlType = 'crc32';

    /**
    * Pear error mode (when raiseError is called)
    *
    * (see PEAR doc)
    *
    * @see setToDebug()
    * @var int $_pearErrorMode
    */
    var $_pearErrorMode = CACHE_LITE_ERROR_RETURN;
    
    /**
    * Current cache id
    *
    * @var string $_id
    */
    var $_id;

    /**
    * Current cache group
    *
    * @var string $_group
    */
    var $_group;

    /**
    * Enable / Disable "Memory Caching"
    *
    * NB : There is no lifetime for memory caching ! 
    *
    * @var boolean $_memoryCaching
    */
    var $_memoryCaching = false;

    /**
    * Enable / Disable "Only Memory Caching"
    * (be carefull, memory caching is "beta quality")
    *
    * @var boolean $_onlyMemoryCaching
    */
    var $_onlyMemoryCaching = false;

    /**
    * Memory caching array
    *
    * @var array $_memoryCachingArray
    */
    var $_memoryCachingArray = array();

    /**
    * Memory caching counter
    *
    * @var int $memoryCachingCounter
    */
    var $_memoryCachingCounter = 0;

    /**
    * Memory caching limit
    *
    * @var int $memoryCachingLimit
    */
    var $_memoryCachingLimit = 1000;
    
    /**
    * File Name protection
    *
    * if set to true, you can use any cache id or group name
    * if set to false, it can be faster but cache ids and group names
    * will be used directly in cache file names so be carefull with
    * special characters...
    *
    * @var boolean $fileNameProtection
    */
    var $_fileNameProtection = true;
    
    /**
    * Enable / disable automatic serialization
    *
    * it can be used to save directly datas which aren't strings
    * (but it's slower)    
    *
    * @var boolean $_serialize
    */
    var $_automaticSerialization = false;
    
    /**
    * Disable / Tune the automatic cleaning process
    *
    * The automatic cleaning process destroy too old (for the given life time)
    * cache files when a new cache file is written.
    * 0               => no automatic cache cleaning
    * 1               => systematic cache cleaning
    * x (integer) > 1 => automatic cleaning randomly 1 times on x cache write
    *
    * @var int $_automaticCleaning
    */
    var $_automaticCleaningFactor = 0;
    
    /**
    * Nested directory level
    *
    * Set the hashed directory structure level. 0 means "no hashed directory 
    * structure", 1 means "one level of directory", 2 means "two levels"... 
    * This option can speed up Cache_Lite only when you have many thousands of 
    * cache file. Only specific benchs can help you to choose the perfect value 
    * for you. Maybe, 1 or 2 is a good start.
    *
    * @var int $_hashedDirectoryLevel
    */
    var $_hashedDirectoryLevel = 0;
    
    /**
    * Umask for hashed directory structure
    *
    * @var int $_hashedDirectoryUmask
    */
    var $_hashedDirectoryUmask = 0700;
    
    // --- Public methods ---

    /**
    * Constructor
    *
    * $options is an assoc. Available options are :
    * $options = array(
    *     'cacheDir' => directory where to put the cache files (string),
    *     'caching' => enable / disable caching (boolean),
    *     'lifeTime' => cache lifetime in seconds (int),
    *     'fileLocking' => enable / disable fileLocking (boolean),
    *     'writeControl' => enable / disable write control (boolean),
    *     'readControl' => enable / disable read control (boolean),
    *     'readControlType' => type of read control 'crc32', 'md5', 'strlen' (string),
    *     'pearErrorMode' => pear error mode (when raiseError is called) (cf PEAR doc) (int),
    *     'memoryCaching' => enable / disable memory caching (boolean),
    *     'onlyMemoryCaching' => enable / disable only memory caching (boolean),
    *     'memoryCachingLimit' => max nbr of records to store into memory caching (int),
    *     'fileNameProtection' => enable / disable automatic file name protection (boolean),
    *     'automaticSerialization' => enable / disable automatic serialization (boolean)
    *     'automaticCleaningFactor' => distable / tune automatic cleaning process (int)
    *     'hashedDirectoryLevel' => level of the hashed directory system (int)
    *     'hashedDirectoryUmask' => umask for hashed directory structure (int)
    * );
    *
    * @param array $options options
    * @access public
    */
    function Cache_Lite($options = array(NULL))
    {
        $availableOptions = array('hashedDirectoryUmask', 'hashedDirectoryLevel', 'automaticCleaningFactor', 'automaticSerialization', 'fileNameProtection', 'memoryCaching', 'onlyMemoryCaching', 'memoryCachingLimit', 'cacheDir', 'caching', 'lifeTime', 'fileLocking', 'writeControl', 'readControl', 'readControlType', 'pearErrorMode');
        foreach($options as $key => $value) {
            if(in_array($key, $availableOptions)) {
                $property = '_'.$key;
                $this->$property = $value;
            }
        }
        $this->_refreshTime = time() - $this->_lifeTime;
    }
    
    /**
    * Test if a cache is available and (if yes) return it
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
    * @return string data of the cache (or false if no cache available)
    * @access public
    */
    function get($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        $this->_id = $id;
        $this->_group = $group;
        $data = false;
        if ($this->_caching) {
            $this->_setFileName($id, $group);
            if ($this->_memoryCaching) {
                if (isset($this->_memoryCachingArray[$this->_file])) {
                    if ($this->_automaticSerialization) {
                        return unserialize($this->_memoryCachingArray[$this->_file]);
                    } else {
                        return $this->_memoryCachingArray[$this->_file];
                    }
                } else {
                    if ($this->_onlyMemoryCaching) {
                        return false;
                    }
                }
            }
            if ($doNotTestCacheValidity) {
                if (file_exists($this->_file)) {
                    $data = $this->_read();
                }
            } else {
                if ((file_exists($this->_file)) && (@filemtime($this->_file) > $this->_refreshTime)) {
                    $data = $this->_read();
                }
            }
            if (($data) and ($this->_memoryCaching)) {
                $this->_memoryCacheAdd($this->_file, $data);
            }
            if (($this->_automaticSerialization) and (is_string($data))) {
                $data = unserialize($data);
            }
            return $data;
        }
        return false;
    }
    
    /**
    * Save some data in a cache file
    *
    * @param string $data data to put in cache (can be another type than strings if automaticSerialization is on)
    * @param string $id cache id
    * @param string $group name of the cache group
    * @return boolean true if no problem
    * @access public
    */
    function save($data, $id = NULL, $group = 'default')
    {
        if ($this->_caching) {
            if ($this->_automaticSerialization) {
                $data = serialize($data);
            }
            if (isset($id)) {
                $this->_setFileName($id, $group);
            }
            if ($this->_memoryCaching) {
                $this->_memoryCacheAdd($this->_file, $data);
                if ($this->_onlyMemoryCaching) {
                    return true;
                }
            }
	    if ($this->_automaticCleaningFactor>0) {
                $rand = rand(1, $this->_automaticCleaningFactor);
	        if ($rand==1) {
	            $this->clean(false, 'old');
		}
            }
            if ($this->_writeControl) {
                if (!$this->_writeAndControl($data)) {
                    @touch($this->_file, time() - 2*abs($this->_lifeTime));
                    return false;
                } else {
                    return true;
                }
            } else {
	        return $this->_write($data);
	    }
        }
        return false;
    }

    /**
    * Remove a cache file
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @return boolean true if no problem
    * @access public
    */
    function remove($id, $group = 'default')
    {
        $this->_setFileName($id, $group);
        if ($this->_memoryCaching) {
            if (isset($this->_memoryCachingArray[$this->_file])) {
                unset($this->_memoryCachingArray[$this->_file]);
                $this->_memoryCachingCounter = $this->_memoryCachingCounter - 1;
            }
            if ($this->_onlyMemoryCaching) {
                return true;
            }
        }
        return $this->_unlink($this->_file);
    }

    /**
    * Clean the cache
    *
    * if no group is specified all cache files will be destroyed
    * else only cache files of the specified group will be destroyed
    *
    * @param string $group name of the cache group
    * @param string $mode flush cache mode : 'old', 'ingroup', 'notingroup', 
    *                                        'callback_myFunction'
    * @return boolean true if no problem
    * @access public
    */
    function clean($group = false, $mode = 'ingroup')
    {
        return $this->_cleanDir($this->_cacheDir, $group, $mode);
    }
       
    /**
    * Set to debug mode
    *
    * When an error is found, the script will stop and the message will be displayed
    * (in debug mode only).
    *
    * @access public
    */
    function setToDebug()
    {
        $this->_pearErrorMode = CACHE_LITE_ERROR_DIE;
    }

    /**
    * Set a new life time
    *
    * @param int $newLifeTime new life time (in seconds)
    * @access public
    */
    function setLifeTime($newLifeTime)
    {
        $this->_lifeTime = $newLifeTime;
        $this->_refreshTime = time() - $newLifeTime;
    }

    /**
    * Save the state of the caching memory array into a cache file cache
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @access public
    */
    function saveMemoryCachingState($id, $group = 'default')
    {
        if ($this->_caching) {
            $array = array(
                'counter' => $this->_memoryCachingCounter,
                'array' => $this->_memoryCachingState
            );
            $data = serialize($array);
            $this->save($data, $id, $group);
        }
    }

    /**
    * Load the state of the caching memory array from a given cache file cache
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
    * @access public
    */
    function getMemoryCachingState($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        if ($this->_caching) {
            if ($data = $this->get($id, $group, $doNotTestCacheValidity)) {
                $array = unserialize($data);
                $this->_memoryCachingCounter = $array['counter'];
                $this->_memoryCachingArray = $array['array'];
            }
        }
    }
    
    /**
    * Return the cache last modification time
    *
    * BE CAREFUL : THIS METHOD IS FOR HACKING ONLY !
    *
    * @return int last modification time
    */
    function lastModified() {
        return @filemtime($this->_file);
    }
    
    /**
    * Trigger a PEAR error
    *
    * To improve performances, the PEAR.php file is included dynamically.
    * The file is so included only when an error is triggered. So, in most
    * cases, the file isn't included and perfs are much better.
    *
    * @param string $msg error message
    * @param int $code error code
    * @access public
    */
    function raiseError($msg, $code)
    {
        //include_once('PEAR.php');
        PEAR::raiseError($msg, $code, $this->_pearErrorMode);
    }
    
    // --- Private methods ---

    /**
    * Remove a file
    * 
    * @param string $file complete file path and name
    * @return boolean true if no problem
    * @access private
    */
    function _unlink($file)
    {
        if (!@unlink($file)) {
            $this->raiseError('Cache_Lite : Unable to remove cache !', -3);
            return false;
        } else {
            return true;
        }
    }

    /**
    * Recursive function for cleaning cache file in the given directory
    *
    * @param string $dir directory complete path (with a trailing slash)
    * @param string $group name of the cache group
    * @param string $mode flush cache mode : 'old', 'ingroup', 'notingroup',
                                             'callback_myFunction'
    * @return boolean true if no problem
    * @access private
    */
    function _cleanDir($dir, $group = false, $mode = 'ingroup')     
    {
        if ($this->_fileNameProtection) {
            $motif = ($group) ? 'cache_'.md5($group).'_' : 'cache_';
        } else {
            $motif = ($group) ? 'cache_'.$group.'_' : 'cache_';
        }
        if ($this->_memoryCaching) {
            while (list($key, $value) = each($this->_memoryCachingArray)) {
                if (strpos($key, $motif, 0)) {
                    unset($this->_memoryCachingArray[$key]);
                    $this->_memoryCachingCounter = $this->_memoryCachingCounter - 1;
                }
            }
            if ($this->_onlyMemoryCaching) {
                return true;
            }
        }
        if (!($dh = @opendir($dir))) {
            $this->raiseError('Cache_Lite : Unable to open cache directory !', -4);
            return false;
        }
        $result = true;
        while ($file = readdir($dh)) {
            if (($file != '.') && ($file != '..')) {
                if (substr($file, 0, 6)=='cache_') {
                    $file2 = $dir . $file;
                    if (is_file($file2)) {
                        switch (substr($mode, 0, 9)) {
                            case 'old':
                                // files older than lifeTime get deleted from cache
                                if ((mktime() - filemtime($file2)) > $this->_lifeTime) {
                                    $result = ($result and ($this->_unlink($file2)));
                                }
                                break;
                            case 'notingrou':
                                if (!strpos($file2, $motif, 0)) {
                                    $result = ($result and ($this->_unlink($file2)));
                                }
                                break;
                            case 'callback_':
                                $func = substr($mode, 9, strlen($mode) - 9);
                                if ($func($file2, $group)) {
                                    $result = ($result and ($this->_unlink($file2)));
                                }
                                break;
                            case 'ingroup':
                            default:
                                if (strpos($file2, $motif, 0)) {
                                    $result = ($result and ($this->_unlink($file2)));
                                }
                                break;
                        }
                    }
                    if ((is_dir($file2)) and ($this->_hashedDirectoryLevel>0)) {
                        $result = ($result and ($this->_cleanDir($file2 . '/', $group, $mode)));
                    }
                }
            }
        }
        return $result;
    }
      
    /**
    * Add some date in the memory caching array
    *
    * @param string $id cache id
    * @param string $data data to cache
    * @access private
    */
    function _memoryCacheAdd($id, $data)
    {
        $this->_memoryCachingArray[$this->_file] = $data;
        if ($this->_memoryCachingCounter >= $this->_memoryCachingLimit) {
            list($key, $value) = each($this->_memoryCachingArray);
            unset($this->_memoryCachingArray[$key]);
        } else {
            $this->_memoryCachingCounter = $this->_memoryCachingCounter + 1;
        }
    }

    /**
    * Make a file name (with path)
    *
    * @param string $id cache id
    * @param string $group name of the group
    * @access private
    */
    function _setFileName($id, $group)
    {
        
        if ($this->_fileNameProtection) {
            $suffix = 'cache_'.md5($group).'_'.md5($id);
        } else {
            $suffix = 'cache_'.$group.'_'.$id;
        }
        $root = $this->_cacheDir;
        if ($this->_hashedDirectoryLevel>0) {
            $hash = md5($suffix);
            for ($i=0 ; $i<$this->_hashedDirectoryLevel ; $i++) {
                $root = $root . 'cache_' . substr($hash, 0, $i + 1) . '/';
            }   
        }
        $this->_fileName = $suffix;
        $this->_file = $root.$suffix;
    }
    
    /**
    * Read the cache file and return the content
    *
    * @return string content of the cache file
    * @access private
    */
    function _read()
    {
        $fp = @fopen($this->_file, "rb");
        if ($this->_fileLocking) @flock($fp, LOCK_SH);
        if ($fp) {
            clearstatcache(); // because the filesize can be cached by PHP itself...
            $length = @filesize($this->_file);
            $mqr = get_magic_quotes_runtime();
            set_magic_quotes_runtime(0);
            if ($this->_readControl) {
                $hashControl = @fread($fp, 32);
                $length = $length - 32;
            } 
            if ($length) {
                $data = @fread($fp, $length);
            } else {
                $data = '';
            }
            set_magic_quotes_runtime($mqr);
            if ($this->_fileLocking) @flock($fp, LOCK_UN);
            @fclose($fp);
            if ($this->_readControl) {
                $hashData = $this->_hash($data, $this->_readControlType);
                if ($hashData != $hashControl) {
                    @touch($this->_file, time() - 2*abs($this->_lifeTime)); 
                    return false;
                }
            }
            return $data;
        }
        $this->raiseError('Cache_Lite : Unable to read cache !', -2);   
        return false;
    }
    
    /**
    * Write the given data in the cache file
    *
    * @param string $data data to put in cache
    * @return boolean true if ok
    * @access private
    */
    function _write($data)
    {
        $try = 1;
        while ($try<=2) {
            $fp = @fopen($this->_file, "wb");
            if ($fp) {
                if ($this->_fileLocking) @flock($fp, LOCK_EX);
                if ($this->_readControl) {
                    @fwrite($fp, $this->_hash($data, $this->_readControlType), 32);
                }
                $len = strlen($data);
                @fwrite($fp, $data, $len);
                if ($this->_fileLocking) @flock($fp, LOCK_UN);
                @fclose($fp);
                return true;
            } else {
                if (($try==1) and ($this->_hashedDirectoryLevel>0)) {
                    $hash = md5($this->_fileName);
                    $root = $this->_cacheDir;
                    for ($i=0 ; $i<$this->_hashedDirectoryLevel ; $i++) {
                        $root = $root . 'cache_' . substr($hash, 0, $i + 1) . '/';
                        @mkdir($root, $this->_hashedDirectoryUmask);
                    }
                    $try = 2;
                } else {
                    $try = 999;
                }
            }
        }
        $this->raiseError('Cache_Lite : Unable to write cache file : '.$this->_file, -1);
        return false;
    }
    
    /**
    * Write the given data in the cache file and control it just after to avoir corrupted cache entries
    *
    * @param string $data data to put in cache
    * @return boolean true if the test is ok
    * @access private
    */
    function _writeAndControl($data)
    {
        $this->_write($data);
        $dataRead = $this->_read($data);
        return ($dataRead==$data);
    }
    
    /**
    * Make a control key with the string containing datas
    *
    * @param string $data data
    * @param string $controlType type of control 'md5', 'crc32' or 'strlen'
    * @return string control key
    * @access private
    */
    function _hash($data, $controlType)
    {
        switch ($controlType) {
        case 'md5':
            return md5($data);
        case 'crc32':
            return sprintf('% 32d', crc32($data));
        case 'strlen':
            return sprintf('% 32d', strlen($data));
        default:
            $this->raiseError('Unknown controlType ! (available values are only \'md5\', \'crc32\', \'strlen\')', -5);
        }
    }
    
} 

?><?php

/**
* This class extends Cache_Lite and can be used to cache the result and output of functions/methods
*
* This class is completly inspired from Sebastian Bergmann's
* PEAR/Cache_Function class. This is only an adaptation to
* Cache_Lite
*
* There are some examples in the 'docs/examples' file
* Technical choices are described in the 'docs/technical' file
*
* @package Cache_Lite
* @version $Id: Function.php,v 1.6 2004/02/03 17:07:13 fab Exp $
* @author Sebastian BERGMANN <sb@sebastian-bergmann.de>
* @author Fabien MARTY <fab@php.net>
*/

class Cache_Lite_Function extends Cache_Lite
{

    // --- Private properties ---
    
    /**
    * Default cache group for function caching
    *
    * @var string $_defaultGroup
    */
    var $_defaultGroup = 'Cache_Lite_Function';
    
    // --- Public methods ----
    
    /**
    * Constructor
    *
    * $options is an assoc. To have a look at availables options,
    * see the constructor of the Cache_Lite class in 'Cache_Lite.php'
    *
    * Comparing to Cache_Lite constructor, there is another option :
    * $options = array(
    *     (...) see Cache_Lite constructor
    *     'defaultGroup' => default cache group for function caching (string)
    * );
    *
    * @param array $options options
    * @access public
    */
    function Cache_Lite_Function($options = array(NULL))
    {
        if (isset($options['defaultGroup'])) {
            $this->_defaultGroup = $options['defaultGroup'];
        }
        $this->Cache_Lite($options);
    }
    
    /**
    * Calls a cacheable function or method (or not if there is already a cache for it)
    *
    * Arguments of this method are read with func_get_args. So it doesn't appear
    * in the function definition. Synopsis : 
    * call('functionName', $arg1, $arg2, ...)
    * (arg1, arg2... are arguments of 'functionName')
    *
    * @return mixed result of the function/method
    * @access public
    */
    function call()
    {
        $arguments = func_get_args();
        $id = serialize($arguments); // Generate a cache id
        if (!$this->_fileNameProtection) {
            $id = md5($id);
            // if fileNameProtection is set to false, then the id has to be hashed
            // because it's a very bad file name in most cases
        }
        $data = $this->get($id, $this->_defaultGroup);
        if ($data !== false) {
            $array = unserialize($data);
            $output = $array['output'];
            $result = $array['result'];
        } else {
            ob_start();
            ob_implicit_flush(false);
            $target = array_shift($arguments);
            if (strstr($target, '::')) { // classname::staticMethod
                list($class, $method) = explode('::', $target);
                $result = call_user_func_array(array($class, $method), $arguments);
            } else if (strstr($target, '->')) { // object->method
                // use a stupid name ($objet_123456789 because) of problems when the object
                // name is the same as this var name
                list($object_123456789, $method) = explode('->', $target);
                global $$object_123456789;
                $result = call_user_func_array(array($$object_123456789, $method), $arguments);
            } else { // function
                $result = call_user_func_array($target, $arguments);
            }
            $output = ob_get_contents();
            ob_end_clean();
            $array['output'] = $output;
            $array['result'] = $result;
            $this->save(serialize($array), $id, $this->_defaultGroup);
        }
        echo($output);
        return $result;
    }
    
}

?><?php

/**
* This class extends Cache_Lite and uses output buffering to get the data to cache.
*
* There are some examples in the 'docs/examples' file
* Technical choices are described in the 'docs/technical' file
*
* @package Cache_Lite
* @version $Id: Output.php,v 1.3 2005/04/17 21:40:18 fab Exp $
* @author Fabien MARTY <fab@php.net>
*/

class Cache_Lite_Output extends Cache_Lite
{

    // --- Public methods ---

    /**
    * Constructor
    *
    * $options is an assoc. To have a look at availables options,
    * see the constructor of the Cache_Lite class in 'Cache_Lite.php'
    *
    * @param array $options options
    * @access public
    */
    function Cache_Lite_Output($options)
    {
        $this->Cache_Lite($options);
    }

    /**
    * Start the cache
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @param boolean $doNotTestCacheValidity if set to true, the cache validity won't be tested
    * @return boolean true if the cache is hit (false else)
    * @access public
    */
    function start($id, $group = 'default', $doNotTestCacheValidity = false)
    {
        $data = $this->get($id, $group, $doNotTestCacheValidity);
        if ($data !== false) {
            echo($data);
            return true;
        } else {
            ob_start();
            ob_implicit_flush(false);
            return false;
        }
    }

    /**
    * Stop the cache
    *
    * @access public
    */
    function end()
    {
        $data = ob_get_contents();
        ob_end_clean();
        $this->save($data, $this->_id, $this->_group);
        echo($data);
    }

}

?><?PHP

/**
* This class extends Cache_Lite and offers a cache system driven by a master file
*
* With this class, cache validity is only dependent of a given file. Cache files
* are valid only if they are older than the master file. It's a perfect way for
* caching templates results (if the template file is newer than the cache, cache
* must be rebuild...) or for config classes...
* There are some examples in the 'docs/examples' file
* Technical choices are described in the 'docs/technical' file
*
* @package Cache_Lite
* @version $Id: File.php,v 1.1 2005/06/18 19:36:13 fab Exp $
* @author Fabien MARTY <fab@php.net>
*/

class Cache_Lite_File extends Cache_Lite
{

    // --- Private properties ---
    
    /**
    * Complete path of the file used for controlling the cache lifetime
    *
    * @var string $_masterFile
    */
    var $_masterFile = '';
    
    /**
    * Masterfile mtime
    *
    * @var int $_masterFile_mtime
    */
    var $_masterFile_mtime = 0;
    
    // --- Public methods ----
    
    /**
    * Constructor
    *
    * $options is an assoc. To have a look at availables options,
    * see the constructor of the Cache_Lite class in 'Cache_Lite.php'
    *
    * Comparing to Cache_Lite constructor, there is another option :
    * $options = array(
    *     (...) see Cache_Lite constructor
    *     'masterFile' => complete path of the file used for controlling the cache lifetime(string)
    * );
    *
    * @param array $options options
    * @access public
    */
    function Cache_Lite_File($options = array(NULL))
    {   
        $options['lifetime'] = 0;
        $this->Cache_Lite($options);
        if (isset($options['masterFile'])) {
            $this->_masterFile = $options['masterFile'];
        } else {
            $this->raiseError('Cache_Lite_File : masterFile option must be set !');
        }
        if (!($this->_masterFile_mtime = @filemtime($this->_masterFile))) {
            $this->raiseError('Cache_Lite_File : Unable to read masterFile : '.$this->_masterFile, -3);
        }
    }
    
    /**
    * Test if a cache is available and (if yes) return it
    *
    * @param string $id cache id
    * @param string $group name of the cache group
    * @return string data of the cache (or false if no cache available)
    * @access public
    */
    function get($id, $group = 'default') {
        if ($data = parent::get($id, $group, true)) {
            if ($filemtime = $this->lastModified()) {
                if ($filemtime > $this->_masterFile_mtime) {
                    return $data;
                }
            }
        }
        return false;
    }

}

?><?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Stephan Schmidt <schst@php-tools.net>                       |
// +----------------------------------------------------------------------+
//
//    $Id: Util.php,v 1.20 2004/06/27 18:15:13 schst Exp $

/**
 * error code for invalid chars in XML name
 */
define("XML_UTIL_ERROR_INVALID_CHARS", 51);

/**
 * error code for invalid chars in XML name
 */
define("XML_UTIL_ERROR_INVALID_START", 52);

/**
 * error code for non-scalar tag content
 */
define("XML_UTIL_ERROR_NON_SCALAR_CONTENT", 60);
    
/**
 * error code for missing tag name
 */
define("XML_UTIL_ERROR_NO_TAG_NAME", 61);
    
/**
 * replace XML entities
 */
define("XML_UTIL_REPLACE_ENTITIES", 1);

/**
 * embedd content in a CData Section
 */
define("XML_UTIL_CDATA_SECTION", 2);

/**
 * do not replace entitites
 */
define("XML_UTIL_ENTITIES_NONE", 0);

/**
 * replace all XML entitites
 * This setting will replace <, >, ", ' and &
 */
define("XML_UTIL_ENTITIES_XML", 1);

/**
 * replace only required XML entitites
 * This setting will replace <, " and &
 */
define("XML_UTIL_ENTITIES_XML_REQUIRED", 2);

/**
 * replace HTML entitites
 * @link    http://www.php.net/htmlentities
 */
define("XML_UTIL_ENTITIES_HTML", 3);

/**
 * utility class for working with XML documents
 *
 * @category XML
 * @package  XML_Util
 * @version  0.6.0
 * @author   Stephan Schmidt <schst@php.net>
 */
class XML_Util {

   /**
    * return API version
    *
    * @access   public
    * @static
    * @return   string  $version API version
    */
    function apiVersion()
    {
        return "0.6";
    }

   /**
    * replace XML entities
    *
    * With the optional second parameter, you may select, which
    * entities should be replaced.
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // replace XML entites:
    * $string = XML_Util::replaceEntities("This string contains < & >.");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  string where XML special chars should be replaced
    * @param    integer setting for entities in attribute values (one of XML_UTIL_ENTITIES_XML, XML_UTIL_ENTITIES_XML_REQUIRED, XML_UTIL_ENTITIES_HTML)
    * @return   string  string with replaced chars
    */
    function replaceEntities($string, $replaceEntities = XML_UTIL_ENTITIES_XML)
    {
        switch ($replaceEntities) {
            case XML_UTIL_ENTITIES_XML:
                return strtr($string,array(
                                          '&'  => '&amp;',
                                          '>'  => '&gt;',
                                          '<'  => '&lt;',
                                          '"'  => '&quot;',
                                          '\'' => '&apos;' ));
                break;
            case XML_UTIL_ENTITIES_XML_REQUIRED:
                return strtr($string,array(
                                          '&'  => '&amp;',
                                          '<'  => '&lt;',
                                          '"'  => '&quot;' ));
                break;
            case XML_UTIL_ENTITIES_HTML:
                return htmlspecialchars($string);
                break;
        }
        return $string;
    }

   /**
    * build an xml declaration
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // get an XML declaration:
    * $xmlDecl = XML_Util::getXMLDeclaration("1.0", "UTF-8", true);
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $version     xml version
    * @param    string  $encoding    character encoding
    * @param    boolean $standAlone  document is standalone (or not)
    * @return   string  $decl xml declaration
    * @uses     XML_Util::attributesToString() to serialize the attributes of the XML declaration
    */
    function getXMLDeclaration($version = "1.0", $encoding = null, $standalone = null)
    {
        $attributes = array(
                            "version" => $version,
                           );
        // add encoding
        if ($encoding !== null) {
            $attributes["encoding"] = $encoding;
        }
        // add standalone, if specified
        if ($standalone !== null) {
            $attributes["standalone"] = $standalone ? "yes" : "no";
        }
        
        return sprintf("<?xml%s?>", XML_Util::attributesToString($attributes, false));
    }

   /**
    * build a document type declaration
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // get a doctype declaration:
    * $xmlDecl = XML_Util::getDocTypeDeclaration("rootTag","myDocType.dtd");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $root         name of the root tag
    * @param    string  $uri          uri of the doctype definition (or array with uri and public id)
    * @param    string  $internalDtd  internal dtd entries   
    * @return   string  $decl         doctype declaration
    * @since    0.2
    */
    function getDocTypeDeclaration($root, $uri = null, $internalDtd = null)
    {
        if (is_array($uri)) {
            $ref = sprintf( ' PUBLIC "%s" "%s"', $uri["id"], $uri["uri"] );
        } elseif (!empty($uri)) {
            $ref = sprintf( ' SYSTEM "%s"', $uri );
        } else {
            $ref = "";
        }

        if (empty($internalDtd)) {
            return sprintf("<!DOCTYPE %s%s>", $root, $ref);
        } else {
            return sprintf("<!DOCTYPE %s%s [\n%s\n]>", $root, $ref, $internalDtd);
        }
    }

   /**
    * create string representation of an attribute list
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // build an attribute string
    * $att = array(
    *              "foo"   =>  "bar",
    *              "argh"  =>  "tomato"
    *            );
    *
    * $attList = XML_Util::attributesToString($att);    
    * </code>
    *
    * @access   public
    * @static
    * @param    array         $attributes        attribute array
    * @param    boolean|array $sort              sort attribute list alphabetically, may also be an assoc array containing the keys 'sort', 'multiline', 'indent', 'linebreak' and 'entities'
    * @param    boolean       $multiline         use linebreaks, if more than one attribute is given
    * @param    string        $indent            string used for indentation of multiline attributes
    * @param    string        $linebreak         string used for linebreaks of multiline attributes
    * @param    integer       $entities          setting for entities in attribute values (one of XML_UTIL_ENTITIES_NONE, XML_UTIL_ENTITIES_XML, XML_UTIL_ENTITIES_XML_REQUIRED, XML_UTIL_ENTITIES_HTML)
    * @return   string                           string representation of the attributes
    * @uses     XML_Util::replaceEntities() to replace XML entities in attribute values
    * @todo     allow sort also to be an options array
    */
    function attributesToString($attributes, $sort = true, $multiline = false, $indent = '    ', $linebreak = "\n", $entities = XML_UTIL_ENTITIES_XML)
    {
        /**
         * second parameter may be an array
         */
        if (is_array($sort)) {
            if (isset($sort['multiline'])) {
                $multiline = $sort['multiline'];
            }
            if (isset($sort['indent'])) {
                $indent = $sort['indent'];
            }
            if (isset($sort['linebreak'])) {
                $multiline = $sort['linebreak'];
            }
            if (isset($sort['entities'])) {
                $entities = $sort['entities'];
            }
            if (isset($sort['sort'])) {
                $sort = $sort['sort'];
            } else {
                $sort = true;
            }
        }
        $string = '';
        if (is_array($attributes) && !empty($attributes)) {
            if ($sort) {
                ksort($attributes);
            }
            if( !$multiline || count($attributes) == 1) {
                foreach ($attributes as $key => $value) {
                    if ($entities != XML_UTIL_ENTITIES_NONE) {
                        $value = XML_Util::replaceEntities($value, $entities);
                    }
                    $string .= ' '.$key.'="'.$value.'"';
                }
            } else {
                $first = true;
                foreach ($attributes as $key => $value) {
                    if ($entities != XML_UTIL_ENTITIES_NONE) {
                        $value = XML_Util::replaceEntities($value, $entities);
                    }
                    if ($first) {
                        $string .= " ".$key.'="'.$value.'"';
                        $first = false;
                    } else {
                        $string .= $linebreak.$indent.$key.'="'.$value.'"';
                    }
                }
            }
        }
        return $string;
    }

   /**
    * create a tag
    *
    * This method will call XML_Util::createTagFromArray(), which
    * is more flexible.
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // create an XML tag:
    * $tag = XML_Util::createTag("myNs:myTag", array("foo" => "bar"), "This is inside the tag", "http://www.w3c.org/myNs#");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $qname             qualified tagname (including namespace)
    * @param    array   $attributes        array containg attributes
    * @param    mixed   $content
    * @param    string  $namespaceUri      URI of the namespace
    * @param    integer $replaceEntities   whether to replace XML special chars in content, embedd it in a CData section or none of both
    * @param    boolean $multiline         whether to create a multiline tag where each attribute gets written to a single line
    * @param    string  $indent            string used to indent attributes (_auto indents attributes so they start at the same column)
    * @param    string  $linebreak         string used for linebreaks
    * @return   string  $string            XML tag
    * @see      XML_Util::createTagFromArray()
    * @uses     XML_Util::createTagFromArray() to create the tag
    */
    function createTag($qname, $attributes = array(), $content = null, $namespaceUri = null, $replaceEntities = XML_UTIL_REPLACE_ENTITIES, $multiline = false, $indent = "_auto", $linebreak = "\n")
    {
        $tag = array(
                     "qname"      => $qname,
                     "attributes" => $attributes
                    );

        // add tag content
        if ($content !== null) {
            $tag["content"] = $content;
        }
        
        // add namespace Uri
        if ($namespaceUri !== null) {
            $tag["namespaceUri"] = $namespaceUri;
        }

        return XML_Util::createTagFromArray($tag, $replaceEntities, $multiline, $indent, $linebreak);
    }

   /**
    * create a tag from an array
    * this method awaits an array in the following format
    * <pre>
    * array(
    *  "qname"        => $qname         // qualified name of the tag
    *  "namespace"    => $namespace     // namespace prefix (optional, if qname is specified or no namespace)
    *  "localpart"    => $localpart,    // local part of the tagname (optional, if qname is specified)
    *  "attributes"   => array(),       // array containing all attributes (optional)
    *  "content"      => $content,      // tag content (optional)
    *  "namespaceUri" => $namespaceUri  // namespaceUri for the given namespace (optional)
    *   )
    * </pre>
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * $tag = array(
    *           "qname"        => "foo:bar",
    *           "namespaceUri" => "http://foo.com",
    *           "attributes"   => array( "key" => "value", "argh" => "fruit&vegetable" ),
    *           "content"      => "I'm inside the tag",
    *            );
    * // creating a tag with qualified name and namespaceUri
    * $string = XML_Util::createTagFromArray($tag);
    * </code>
    *
    * @access   public
    * @static
    * @param    array   $tag               tag definition
    * @param    integer $replaceEntities   whether to replace XML special chars in content, embedd it in a CData section or none of both
    * @param    boolean $multiline         whether to create a multiline tag where each attribute gets written to a single line
    * @param    string  $indent            string used to indent attributes (_auto indents attributes so they start at the same column)
    * @param    string  $linebreak         string used for linebreaks
    * @return   string  $string            XML tag
    * @see      XML_Util::createTag()
    * @uses     XML_Util::attributesToString() to serialize the attributes of the tag
    * @uses     XML_Util::splitQualifiedName() to get local part and namespace of a qualified name
    */
    function createTagFromArray($tag, $replaceEntities = XML_UTIL_REPLACE_ENTITIES, $multiline = false, $indent = "_auto", $linebreak = "\n" )
    {
        if (isset($tag["content"]) && !is_scalar($tag["content"])) {
            return XML_Util::raiseError( "Supplied non-scalar value as tag content", XML_UTIL_ERROR_NON_SCALAR_CONTENT );
        }

        if (!isset($tag['qname']) && !isset($tag['localPart'])) {
            return XML_Util::raiseError( 'You must either supply a qualified name (qname) or local tag name (localPart).', XML_UTIL_ERROR_NO_TAG_NAME );
        }

        // if no attributes hav been set, use empty attributes
        if (!isset($tag["attributes"]) || !is_array($tag["attributes"])) {
            $tag["attributes"] = array();
        }
        
        // qualified name is not given
        if (!isset($tag["qname"])) {
            // check for namespace
            if (isset($tag["namespace"]) && !empty($tag["namespace"])) {
                $tag["qname"] = $tag["namespace"].":".$tag["localPart"];
            } else {
                $tag["qname"] = $tag["localPart"];
            }
        // namespace URI is set, but no namespace
        } elseif (isset($tag["namespaceUri"]) && !isset($tag["namespace"])) {
            $parts = XML_Util::splitQualifiedName($tag["qname"]);
            $tag["localPart"] = $parts["localPart"];
            if (isset($parts["namespace"])) {
                $tag["namespace"] = $parts["namespace"];
            }
        }

        if (isset($tag["namespaceUri"]) && !empty($tag["namespaceUri"])) {
            // is a namespace given
            if (isset($tag["namespace"]) && !empty($tag["namespace"])) {
                $tag["attributes"]["xmlns:".$tag["namespace"]] = $tag["namespaceUri"];
            } else {
                // define this Uri as the default namespace
                $tag["attributes"]["xmlns"] = $tag["namespaceUri"];
            }
        }

        // check for multiline attributes
        if ($multiline === true) {
            if ($indent === "_auto") {
                $indent = str_repeat(" ", (strlen($tag["qname"])+2));
            }
        }
        
        // create attribute list
        $attList    =   XML_Util::attributesToString($tag["attributes"], true, $multiline, $indent, $linebreak );
        if (!isset($tag["content"]) || (string)$tag["content"] == '') {
            $tag    =   sprintf("<%s%s />", $tag["qname"], $attList);
        } else {
            if ($replaceEntities == XML_UTIL_REPLACE_ENTITIES) {
                $tag["content"] = XML_Util::replaceEntities($tag["content"]);
            } elseif ($replaceEntities == XML_UTIL_CDATA_SECTION) {
                $tag["content"] = XML_Util::createCDataSection($tag["content"]);
            }
            $tag    =   sprintf("<%s%s>%s</%s>", $tag["qname"], $attList, $tag["content"], $tag["qname"] );
        }        
        return  $tag;
    }

   /**
    * create a start element
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // create an XML start element:
    * $tag = XML_Util::createStartElement("myNs:myTag", array("foo" => "bar") ,"http://www.w3c.org/myNs#");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $qname             qualified tagname (including namespace)
    * @param    array   $attributes        array containg attributes
    * @param    string  $namespaceUri      URI of the namespace
    * @param    boolean $multiline         whether to create a multiline tag where each attribute gets written to a single line
    * @param    string  $indent            string used to indent attributes (_auto indents attributes so they start at the same column)
    * @param    string  $linebreak         string used for linebreaks
    * @return   string  $string            XML start element
    * @see      XML_Util::createEndElement(), XML_Util::createTag()
    */
    function createStartElement($qname, $attributes = array(), $namespaceUri = null, $multiline = false, $indent = '_auto', $linebreak = "\n")
    {
        // if no attributes hav been set, use empty attributes
        if (!isset($attributes) || !is_array($attributes)) {
            $attributes = array();
        }
        
        if ($namespaceUri != null) {
            $parts = XML_Util::splitQualifiedName($qname);
        }

        // check for multiline attributes
        if ($multiline === true) {
            if ($indent === "_auto") {
                $indent = str_repeat(" ", (strlen($qname)+2));
            }
        }

        if ($namespaceUri != null) {
            // is a namespace given
            if (isset($parts["namespace"]) && !empty($parts["namespace"])) {
                $attributes["xmlns:".$parts["namespace"]] = $namespaceUri;
            } else {
                // define this Uri as the default namespace
                $attributes["xmlns"] = $namespaceUri;
            }
        }

        // create attribute list
        $attList    =   XML_Util::attributesToString($attributes, true, $multiline, $indent, $linebreak);
        $element    =   sprintf("<%s%s>", $qname, $attList);
        return  $element;
    }

   /**
    * create an end element
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // create an XML start element:
    * $tag = XML_Util::createEndElement("myNs:myTag");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $qname             qualified tagname (including namespace)
    * @return   string  $string            XML end element
    * @see      XML_Util::createStartElement(), XML_Util::createTag()
    */
    function createEndElement($qname)
    {
        $element    =   sprintf("</%s>", $qname);
        return  $element;
    }
    
   /**
    * create an XML comment
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // create an XML start element:
    * $tag = XML_Util::createComment("I am a comment");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $content           content of the comment
    * @return   string  $comment           XML comment
    */
    function createComment($content)
    {
        $comment    =   sprintf("<!-- %s -->", $content);
        return  $comment;
    }
    
   /**
    * create a CData section
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // create a CData section
    * $tag = XML_Util::createCDataSection("I am content.");
    * </code>
    *
    * @access   public
    * @static
    * @param    string  $data              data of the CData section
    * @return   string  $string            CData section with content
    */
    function createCDataSection($data)
    {
        return  sprintf("<![CDATA[%s]]>", $data);
    }

   /**
    * split qualified name and return namespace and local part
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // split qualified tag
    * $parts = XML_Util::splitQualifiedName("xslt:stylesheet");
    * </code>
    * the returned array will contain two elements:
    * <pre>
    * array(
    *       "namespace" => "xslt",
    *       "localPart" => "stylesheet"
    *      );
    * </pre>
    *
    * @access public
    * @static
    * @param  string    $qname      qualified tag name
    * @param  string    $defaultNs  default namespace (optional)
    * @return array     $parts      array containing namespace and local part
    */
    function splitQualifiedName($qname, $defaultNs = null)
    {
        if (strstr($qname, ':')) {
            $tmp = explode(":", $qname);
            return array(
                          "namespace" => $tmp[0],
                          "localPart" => $tmp[1]
                        );
        }
        return array(
                      "namespace" => $defaultNs,
                      "localPart" => $qname
                    );
    }

   /**
    * check, whether string is valid XML name
    *
    * <p>XML names are used for tagname, attribute names and various
    * other, lesser known entities.</p>
    * <p>An XML name may only consist of alphanumeric characters,
    * dashes, undescores and periods, and has to start with a letter
    * or an underscore.
    * </p>
    *
    * <code>
    * require_once 'XML/Util.php';
    * 
    * // verify tag name
    * $result = XML_Util::isValidName("invalidTag?");
    * if (XML_Util::isError($result)) {
    *    print "Invalid XML name: " . $result->getMessage();
    * }
    * </code>
    *
    * @access  public
    * @static
    * @param   string  $string string that should be checked
    * @return  mixed   $valid  true, if string is a valid XML name, PEAR error otherwise
    * @todo    support for other charsets
    */
    function isValidName($string)
    {
        // check for invalid chars
        if (!preg_match("/^[[:alnum:]_\-.]$/", $string{0})) {
            return XML_Util::raiseError( "XML names may only start with letter or underscore", XML_UTIL_ERROR_INVALID_START );
        }
        
        // check for invalid chars
        if (!preg_match("/^([a-zA-Z_]([a-zA-Z0-9_\-\.]*)?:)?[a-zA-Z_]([a-zA-Z0-9_\-\.]+)?$/", $string)) {
            return XML_Util::raiseError( "XML names may only contain alphanumeric chars, period, hyphen, colon and underscores", XML_UTIL_ERROR_INVALID_CHARS );
         }
        // XML name is valid
        return true;
    }

   /**
    * replacement for XML_Util::raiseError
    *
    * Avoids the necessity to always require
    * PEAR.php
    *
    * @access   public
    * @param    string      error message
    * @param    integer     error code
    * @return   object PEAR_Error
    */
    function raiseError($msg, $code)
    {
        //require_once 'PEAR.php';
        return PEAR::raiseError($msg, $code);
    }
}
?><?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Stephan Schmidt <schst@php-tools.net>                       |
// +----------------------------------------------------------------------+
//
//    $Id: Serializer.php,v 1.26 2004/11/06 15:49:52 schst Exp $

/**
 * uses PEAR error management
 */
//require_once 'PEAR.php';

/**
 * uses XML_Util to create XML tags
 */
//require_once 'Util.php';

/**
 * error code for no serialization done
 */
define('XML_SERIALIZER_ERROR_NO_SERIALIZATION', 51);

/**
 * XML_Serializer
 * class that serializes various structures into an XML document
 *
 * this class can be used in two modes:
 *
 *  1. create an XML document from an array or object that is processed by other
 *    applications. That means, you can create a RDF document from an array in the
 *    following format:
 *
 *    $data = array(
 *              'channel' => array(
 *                            'title' => 'Example RDF channel',
 *                            'link'  => 'http://www.php-tools.de',
 *                            'image' => array(
 *                                        'title' => 'Example image',
 *                                        'url'   => 'http://www.php-tools.de/image.gif',
 *                                        'link'  => 'http://www.php-tools.de'
 *                                           ),
 *                            array(
 *                                 'title' => 'Example item',
 *                                 'link'  => 'http://example.com'
 *                                 ),
 *                            array(
 *                                 'title' => 'Another Example item',
 *                                 'link'  => 'http://example.org'
 *                                 )
 *                              )
 *             );
 *
 *   to create a RDF document from this array do the following:
 *
 *   require_once 'XML/Serializer.php';
 *
 *   $options = array(
 *                     'indent'         => "\t",        // indent with tabs
 *                     'linebreak'      => "\n",        // use UNIX line breaks
 *                     'rootName'       => 'rdf:RDF',   // root tag
 *                     'defaultTagName' => 'item'       // tag for values with numeric keys
 *   );
 *
 *   $serializer = new XML_Serializer($options);
 *   $rdf        = $serializer->serialize($data);
 *
 * You will get a complete XML document that can be processed like any RDF document.
 *
 *
 * 2. this classes can be used to serialize any data structure in a way that it can
 *    later be unserialized again.
 *    XML_Serializer will store the type of the value and additional meta information
 *    in attributes of the surrounding tag. This meat information can later be used
 *    to restore the original data structure in PHP. If you want XML_Serializer
 *    to add meta information to the tags, add
 *
 *      'typeHints' => true
 *
 *    to the options array in the constructor.
 *
 *    Future versions of this package will include an XML_Unserializer, that does
 *    the unserialization automatically for you.
 *
 * @category XML
 * @package  XML_Serializer
 * @version  0.13.0
 * @author   Stephan Schmidt <schst@php.net>
 * @uses     XML_Util
 */
class XML_Serializer extends PEAR
{
   /**
    * default options for the serialization
    * @access private
    * @var array $_defaultOptions
    */
    var $_defaultOptions = array(
                         'indent'             => '',                    // string used for indentation
                         'linebreak'          => "\n",                  // string used for newlines
                         'typeHints'          => false,                 // automatically add type hin attributes
                         'addDecl'            => false,                 // add an XML declaration
                         'defaultTagName'     => 'XML_Serializer_Tag',  // tag used for indexed arrays or invalid names
                         'classAsTagName'     => false,                 // use classname for objects in indexed arrays
                         'keyAttribute'       => '_originalKey',        // attribute where original key is stored
                         'typeAttribute'      => '_type',               // attribute for type (only if typeHints => true)
                         'classAttribute'     => '_class',              // attribute for class of objects (only if typeHints => true)
                         'scalarAsAttributes' => false,                 // scalar values (strings, ints,..) will be serialized as attribute
                         'prependAttributes'  => '',                    // prepend string for attributes
                         'indentAttributes'   => false,                 // indent the attributes, if set to '_auto', it will indent attributes so they all start at the same column
                         'mode'               => 'default',             // use 'simplexml' to use parent name as tagname if transforming an indexed array
                         'addDoctype'         => false,                 // add a doctype declaration
                         'doctype'            => null,                  // supply a string or an array with id and uri ({@see XML_Util::getDoctypeDeclaration()}
                         'rootName'           => null,                  // name of the root tag
                         'rootAttributes'     => array(),               // attributes of the root tag
                         'attributesArray'    => null,                  // all values in this key will be treated as attributes
                         'contentName'        => null,                  // this value will be used directly as content, instead of creating a new tag, may only be used in conjuction with attributesArray
                         'tagMap'			  => array()
                        );

   /**
    * options for the serialization
    * @access private
    * @var array $options
    */
    var $options = array();

   /**
    * current tag depth
    * @var integer $_tagDepth
    */
    var $_tagDepth = 0;

   /**
    * serilialized representation of the data
    * @var string $_serializedData
    */
    var $_serializedData = null;
    
   /**
    * constructor
    *
    * @access   public
    * @param    mixed   $options    array containing options for the serialization
    */
    function XML_Serializer( $options = null )
    {
        $this->PEAR();
        if (is_array($options)) {
            $this->options = array_merge($this->_defaultOptions, $options);
        } else {
            $this->options = $this->_defaultOptions;
        }
    }

   /**
    * return API version
    *
    * @access   public
    * @static
    * @return   string  $version API version
    */
    function apiVersion()
    {
		return '0.13';
    }

   /**
    * reset all options to default options
    *
    * @access   public
    * @see      setOption(), XML_Unserializer()
    */
    function resetOptions()
    {
        $this->options = $this->_defaultOptions;
    }

   /**
    * set an option
    *
    * You can use this method if you do not want to set all options in the constructor
    *
    * @access   public
    * @see      resetOption(), XML_Serializer()
    */
    function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }
    
   /**
    * sets several options at once
    *
    * You can use this method if you do not want to set all options in the constructor
    *
    * @access   public
    * @see      resetOption(), XML_Unserializer(), setOption()
    */
    function setOptions($options)
    {
        $this->options = array_merge($this->options, $options);
    }

   /**
    * serialize data
    *
    * @access   public
    * @param    mixed    $data data to serialize
    * @return   boolean  true on success, pear error on failure
    */
    function serialize($data, $options = null)
    {
        // if options have been specified, use them instead
        // of the previously defined ones
        if (is_array($options)) {
            $optionsBak = $this->options;
            if (isset($options['overrideOptions']) && $options['overrideOptions'] == true) {
                $this->options = array_merge($this->_defaultOptions, $options);
            } else {
                $this->options = array_merge($this->options, $options);
            }
        }
        else {
            $optionsBak = null;
        }
        
        // maintain BC
        if (isset($this->options['tagName'])) {
            $this->options['rootName'] = $this->options['tagName'];
        }
        
        //  start depth is zero
        $this->_tagDepth = 0;

        $this->_serializedData = '';
        // serialize an array
        if (is_array($data)) {
            if (isset($this->options['rootName'])) {
                $tagName = $this->options['rootName'];
            } else {
                $tagName = 'array';
            }

            $this->_serializedData .= $this->_serializeArray($data, $tagName, $this->options['rootAttributes']);
        }
        // serialize an object
        elseif (is_object($data)) {
            if (isset($this->options['rootName'])) {
                $tagName = $this->options['rootName'];
            } else {
                $tagName = get_class($data);
            }
            $this->_serializedData .= $this->_serializeObject($data, $tagName, $this->options['rootAttributes']);
        }
        
        // add doctype declaration
        if ($this->options['addDoctype'] === true) {
            $this->_serializedData = XML_Util::getDoctypeDeclaration($tagName, $this->options['doctype'])
                                   . $this->options['linebreak']
                                   . $this->_serializedData;
        }

        //  build xml declaration
        if ($this->options['addDecl']) {
            $atts = array();
            if (isset($this->options['encoding']) ) {
                $encoding = $this->options['encoding'];
            } else {
                $encoding = null;
            }
            $this->_serializedData = XML_Util::getXMLDeclaration('1.0', $encoding)
                                   . $this->options['linebreak']
                                   . $this->_serializedData;
        }
        
        
		if ($optionsBak !== null) {
			$this->options = $optionsBak;
		}
		
        return  true;
    }

   /**
    * get the result of the serialization
    *
    * @access public
    * @return string serialized XML
    */
    function getSerializedData()
    {
        if ($this->_serializedData == null ) {
            return  $this->raiseError('No serialized data available. Use XML_Serializer::serialize() first.', XML_SERIALIZER_ERROR_NO_SERIALIZATION);
        }
        return $this->_serializedData;
    }
    
   /**
    * serialize any value
    *
    * This method checks for the type of the value and calls the appropriate method
    *
    * @access private
    * @param  mixed     $value
    * @param  string    $tagName
    * @param  array     $attributes
    * @return string
    */
    function _serializeValue($value, $tagName = null, $attributes = array())
    {
        if (is_array($value)) {
            $xml = $this->_serializeArray($value, $tagName, $attributes);
        } elseif (is_object($value)) {
            $xml = $this->_serializeObject($value, $tagName);
        } else {
            $tag = array(
                          'qname'      => $tagName,
                          'attributes' => $attributes,
                          'content'    => $value
                        );
            $xml = $this->_createXMLTag($tag);
        }
        return $xml;
    }
    
   /**
    * serialize an array
    *
    * @access   private
    * @param    array   $array       array to serialize
    * @param    string  $tagName     name of the root tag
    * @param    array   $attributes  attributes for the root tag
    * @return   string  $string      serialized data
    * @uses     XML_Util::isValidName() to check, whether key has to be substituted
    */
    function _serializeArray(&$array, $tagName = null, $attributes = array())
    {
        $_content = null;
        
        /**
         * check for special attributes
         */
        if ($this->options['attributesArray'] !== null) {
            if (isset($array[$this->options['attributesArray']])) {
                $attributes = $array[$this->options['attributesArray']];
                unset($array[$this->options['attributesArray']]);
            }
            /**
             * check for special content
             */
            if ($this->options['contentName'] !== null) {
                if (isset($array[$this->options['contentName']])) {
                    $_content = $array[$this->options['contentName']];
                    unset($array[$this->options['contentName']]);
                }
            }
        }

        /*
        * if mode is set to simpleXML, check whether
        * the array is associative or indexed
        */
        if (is_array($array) && !empty($array) && $this->options['mode'] == 'simplexml') {
            $indexed = true;
            foreach ($array as $key => $val) {
                if (!is_int($key)) {
                    $indexed = false;
                    break;
                }
            }

            if ($indexed && $this->options['mode'] == 'simplexml') {
                $string = '';
                foreach ($array as $key => $val) {
                    $string .= $this->_serializeValue( $val, $tagName, $attributes);
                    
                    $string .= $this->options['linebreak'];
        			//	do indentation
                    if ($this->options['indent']!==null && $this->_tagDepth>0) {
                        $string .= str_repeat($this->options['indent'], $this->_tagDepth);
                    }
                }
                return rtrim($string);
            }
        }
        
		if ($this->options['scalarAsAttributes'] === true) {
	        foreach ($array as $key => $value) {
				if (is_scalar($value) && (XML_Util::isValidName($key) === true)) {
					unset($array[$key]);
					$attributes[$this->options['prependAttributes'].$key] = $value;
				}
			}
		}

        // check for empty array => create empty tag
        if (empty($array)) {
            $tag = array(
                            'qname'      => $tagName,
                            'content'    => $_content,
                            'attributes' => $attributes
                        );

        } else {
            $this->_tagDepth++;
            $tmp = $this->options['linebreak'];
            foreach ($array as $key => $value) {
    			//	do indentation
                if ($this->options['indent']!==null && $this->_tagDepth>0) {
                    $tmp .= str_repeat($this->options['indent'], $this->_tagDepth);
                }

                if (isset($this->options['tagMap'][$key])) {
                	$key = $this->options['tagMap'][$key];
                }

    			//	copy key
    			$origKey	=	$key;
    			//	key cannot be used as tagname => use default tag
                $valid = XML_Util::isValidName($key);
    	        if (PEAR::isError($valid)) {
    	            if ($this->options['classAsTagName'] && is_object($value)) {
    	                $key = get_class($value);
    	            } else {
            	        $key = $this->options['defaultTagName'];
    	            }
           	 	}
                $atts = array();
                if ($this->options['typeHints'] === true) {
                    $atts[$this->options['typeAttribute']] = gettype($value);
    				if ($key !== $origKey) {
    					$atts[$this->options['keyAttribute']] = (string)$origKey;
    				}
    
                }
    			
                $tmp .= $this->_createXMLTag(array(
                                                    'qname'      => $key,
                                                    'attributes' => $atts,
                                                    'content'    => $value )
                                            );
                $tmp .= $this->options['linebreak'];
            }
            
            $this->_tagDepth--;
            if ($this->options['indent']!==null && $this->_tagDepth>0) {
                $tmp .= str_repeat($this->options['indent'], $this->_tagDepth);
            }
    
    		if (trim($tmp) === '') {
    			$tmp = null;
    		}
    		
            $tag = array(
                            'qname'      => $tagName,
                            'content'    => $tmp,
                            'attributes' => $attributes
                        );
        }
        if ($this->options['typeHints'] === true) {
            if (!isset($tag['attributes'][$this->options['typeAttribute']])) {
                $tag['attributes'][$this->options['typeAttribute']] = 'array';
            }
        }

        $string = $this->_createXMLTag($tag, false);
        return $string;
    }

   /**
    * serialize an object
    *
    * @access   private
    * @param    object  $object object to serialize
    * @return   string  $string serialized data
    */
    function _serializeObject(&$object, $tagName = null, $attributes = array())
    {
        //  check for magic function
        if (method_exists($object, '__sleep')) {
            $object->__sleep();
        }

        $tmp = $this->options['linebreak'];
        $properties = get_object_vars($object);
        if (empty($tagName)) {
            $tagName = get_class($object);
        }
        
        // typehints activated?
        if ($this->options['typeHints'] === true) {
            $attributes[$this->options['typeAttribute']]  = 'object';
            $attributes[$this->options['classAttribute']] =  get_class($object);
        }
        
        $string = $this->_serializeArray($properties, $tagName, $attributes);
        return $string;
    }
  
   /**
    * create a tag from an array
    * this method awaits an array in the following format
    * array(
    *       'qname'        => $tagName,
    *       'attributes'   => array(),
    *       'content'      => $content,      // optional
    *       'namespace'    => $namespace     // optional
    *       'namespaceUri' => $namespaceUri  // optional
    *   )
    *
    * @access   private
    * @param    array   $tag tag definition
    * @param    boolean $replaceEntities whether to replace XML entities in content or not
    * @return   string  $string XML tag
    */
    function _createXMLTag( $tag, $replaceEntities = true )
    {
        if ($this->options['indentAttributes'] !== false) {
            $multiline = true;
            $indent    = str_repeat($this->options['indent'], $this->_tagDepth);

            if ($this->options['indentAttributes'] == '_auto') {
                $indent .= str_repeat(' ', (strlen($tag['qname'])+2));

            } else {
                $indent .= $this->options['indentAttributes'];
            }
        } else {
            $multiline = false;
            $indent    = false;
        }
    
        if (is_array($tag['content'])) {
            if (empty($tag['content'])) {
                $tag['content'] =   '';
            }
        } elseif(is_scalar($tag['content']) && (string)$tag['content'] == '') {
            $tag['content'] =   '';
        }
    
        if (is_scalar($tag['content']) || is_null($tag['content'])) {
            $tag = XML_Util::createTagFromArray($tag, $replaceEntities, $multiline, $indent, $this->options['linebreak']);
        } elseif (is_array($tag['content'])) {
            $tag    =   $this->_serializeArray($tag['content'], $tag['qname'], $tag['attributes']);
        } elseif (is_object($tag['content'])) {
            $tag    =   $this->_serializeObject($tag['content'], $tag['qname'], $tag['attributes']);
        } elseif (is_resource($tag['content'])) {
            settype($tag['content'], 'string');
            $tag    =   XML_Util::createTagFromArray($tag, $replaceEntities);
        }
        return  $tag;
    }
}
?><?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Stephan Schmidt <schst@php-tools.net>                       |
// +----------------------------------------------------------------------+
//
//    $Id: Unserializer.php,v 1.23 2004/11/06 15:49:52 schst Exp $

/**
 * uses PEAR error managemt
 */
//require_once 'PEAR.php';

/**
 * uses XML_Parser to unserialize document
 */
//require_once 'Parser.php';

/**
 * error code for no serialization done
 */
define('XML_UNSERIALIZER_ERROR_NO_UNSERIALIZATION', 151);

/**
 * XML_Unserializer
 *
 * class to unserialize XML documents that have been created with
 * XML_Serializer. To unserialize an XML document you have to add
 * type hints to the XML_Serializer options.
 *
 * If no type hints are available, XML_Unserializer will guess how
 * the tags should be treated, that means complex structures will be
 * arrays and tags with only CData in them will be strings.
 *
 * <code>
 * require_once 'XML/Unserializer.php';
 *
 * //  be careful to always use the ampersand in front of the new operator
 * $unserializer = &new XML_Unserializer();
 *
 * $unserializer->unserialize($xml);
 *
 * $data = $unserializer->getUnserializedData();
 * <code>
 *
 * Possible options for the Unserializer are:
 *
 * 1. complexTypes => array|object
 * This is needed, when unserializing XML files w/o type hints. If set to
 * 'array' (default), all nested tags will be arrays, if set to 'object'
 * all nested tags will be objects, that means you have read access like:
 *
 * <code>
 * require_once 'XML/Unserializer.php';
 * $options = array('complexType' => 'object');
 * $unserializer = &new XML_Unserializer($options);
 *
 * $unserializer->unserialize('http://pear.php.net/rss.php');
 *
 * $rss = $unserializer->getUnserializedData();
 * echo $rss->channel->item[3]->title;
 * </code>
 *
 * 2. keyAttribute
 * This lets you specify an attribute inside your tags, that are used as key
 * for associative arrays or object properties.
 * You will need this if you have XML that looks like this:
 *
 * <users>
 *   <user handle="schst">Stephan Schmidt</user>
 *   <user handle="ssb">Stig S. Bakken</user>
 * </users>
 *
 * Then you can use:
 * <code>
 * require_once 'XML/Unserializer.php';
 * $options = array('keyAttribute' => 'handle');
 * $unserializer = &new XML_Unserializer($options);
 *
 * $unserializer->unserialize($xml, false);
 *
 * $users = $unserializer->getUnserializedData();
 * </code>
 *
 * @category XML
 * @package  XML_Serializer
 * @version  0.13.0
 * @author   Stephan Schmidt <schst@php-tools.net>
 * @uses     XML_Parser
 */
class XML_Unserializer extends XML_Parser {

   /**
    * default options for the serialization
    * @access private
    * @var array $_defaultOptions
    */
    var $_defaultOptions = array(
                         'complexType'       => 'array',                // complex types will be converted to arrays, if no type hint is given
                         'keyAttribute'      => '_originalKey',         // get array key/property name from this attribute
                         'typeAttribute'     => '_type',                // get type from this attribute
                         'classAttribute'    => '_class',               // get class from this attribute (if not given, use tag name)
                         'parseAttributes'   => false,                  // parse the attributes of the tag into an array
                         'attributesArray'   => false,                  // parse them into sperate array (specify name of array here)
                         'prependAttributes' => '',                     // prepend attribute names with this string
                         'contentName'       => '_content',             // put cdata found in a tag that has been converted to a complex type in this key
                         'tagMap'            => array(),                // use this to map tagnames
                         'forceEnum'         => array(),                // these tags will always be an indexed array
                         'encoding'          => null                    // specify the encoding character of the document to parse
                        );

   /**
    * actual options for the serialization
    * @access private
    * @var array $options
    */
    var $options = array();

   /**
    * do not use case folding
    * @var boolean $folding
    */
    var $folding = false;

   /**
    * unserilialized data
    * @var string $_serializedData
    */
    var $_unserializedData = null;

   /**
    * name of the root tag
    * @var string $_root
    */
    var $_root = null;

   /**
    * stack for all data that is found
    * @var array    $_dataStack
    */
    var $_dataStack  =   array();

   /**
    * stack for all values that are generated
    * @var array    $_valStack
    */
    var $_valStack  =   array();

   /**
    * current tag depth
    * @var int    $_depth
    */
    var $_depth = 0;

   /**
    * constructor
    *
    * @access   public
    * @param    mixed   $options    array containing options for the serialization
    */
    function XML_Unserializer($options = null)
    {
        if (is_array($options)) {
            $this->options = array_merge($this->_defaultOptions, $options);
        } else {
            $this->options = $this->_defaultOptions;
        }

        // reset parser and properties
        $this->XML_Parser($this->options['encoding'],'event');
    }

   /**
    * return API version
    *
    * @access   public
    * @static
    * @return   string  $version API version
    */
    function apiVersion()
    {
        return '0.13';
    }

   /**
    * reset all options to default options
    *
    * @access   public
    * @see      setOption(), XML_Unserializer(), setOptions()
    */
    function resetOptions()
    {
        $this->options = $this->_defaultOptions;
    }

   /**
    * set an option
    *
    * You can use this method if you do not want to set all options in the constructor
    *
    * @access   public
    * @see      resetOption(), XML_Unserializer(), setOptions()
    */
    function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }

   /**
    * sets several options at once
    *
    * You can use this method if you do not want to set all options in the constructor
    *
    * @access   public
    * @see      resetOption(), XML_Unserializer(), setOption()
    */
    function setOptions($options)
    {
        $this->options = array_merge($this->options, $options);
    }

   /**
    * unserialize data
    *
    * @access   public
    * @param    mixed    $data   data to unserialize (string, filename or resource)
    * @param    boolean  $isFile string should be treated as a file
    * @param    array    $options
    * @return   boolean  $success
    */
    function unserialize($data, $isFile = false, $options = null)
    {
        $this->_unserializedData = null;
        $this->_root = null;

        // if options have been specified, use them instead
        // of the previously defined ones
        if (is_array($options)) {
            $optionsBak = $this->options;
            if (isset($options['overrideOptions']) && $options['overrideOptions'] == true) {
                $this->options = array_merge($this->_defaultOptions, $options);
            } else {
                $this->options = array_merge($this->options, $options);
            }
        }
        else {
            $optionsBak = null;
        }

        $this->_valStack = array();
        $this->_dataStack = array();
        $this->_depth = 0;

        if (is_string($data)) {
            if ($isFile) {
                $result = $this->setInputFile($data);
                if (PEAR::isError($result)) {
                    return $result;
                }
                $result = $this->parse();
            } else {
                $result = $this->parseString($data,true);
            }
        } else {
           $this->setInput($data);
           $result = $this->parse();
        }

        if ($optionsBak !== null) {
            $this->options = $optionsBak;
        }

        if (PEAR::isError($result)) {
            return $result;
        }

        return  true;
    }

   /**
    * get the result of the serialization
    *
    * @access public
    * @return string  $serializedData
    */
    function getUnserializedData()
    {
        if ($this->_root === null ) {
            return  $this->raiseError('No unserialized data available. Use XML_Unserializer::unserialize() first.', XML_UNSERIALIZER_ERROR_NO_UNSERIALIZATION);
        }
        return $this->_unserializedData;
    }

   /**
    * get the name of the root tag
    *
    * @access public
    * @return string  $rootName
    */
    function getRootName()
    {
        if ($this->_root === null ) {
            return  $this->raiseError('No unserialized data available. Use XML_Unserializer::unserialize() first.', XML_UNSERIALIZER_ERROR_NO_UNSERIALIZATION);
        }
        return $this->_root;
    }

   /**
    * Start element handler for XML parser
    *
    * @access private
    * @param  object $parser  XML parser object
    * @param  string $element XML element
    * @param  array  $attribs attributes of XML tag
    * @return void
    */
    function startHandler($parser, $element, $attribs)
    {
        if (isset($attribs[$this->options['typeAttribute']])) {
            $type = $attribs[$this->options['typeAttribute']];
        } else {
            $type = 'string';
        }

        $this->_depth++;
        $this->_dataStack[$this->_depth] = null;

        $val = array(
                     'name'         => $element,
                     'value'        => null,
                     'type'         => $type,
                     'childrenKeys' => array(),
                     'aggregKeys'   => array()
                    );

        if ($this->options['parseAttributes'] == true && (count($attribs) > 0)) {
            $val['children'] = array();
            $val['type'] = $this->options['complexType'];

            if ($this->options['attributesArray'] != false) {
                $val['children'][$this->options['attributesArray']] = $attribs;
            } else {
                foreach ($attribs as $attrib => $value) {
                    $val['children'][$this->options['prependAttributes'].$attrib] = $value;
                }
            }
        }

        $keyAttr = false;
        
        if (is_string($this->options['keyAttribute'])) {
        	$keyAttr = $this->options['keyAttribute'];
        } elseif (is_array($this->options['keyAttribute'])) {
            if (isset($this->options['keyAttribute'][$element])) {
            	$keyAttr = $this->options['keyAttribute'][$element];
            } elseif (isset($this->options['keyAttribute']['__default'])) {
            	$keyAttr = $this->options['keyAttribute']['__default'];
            }
        }
        
        if ($keyAttr !== false && isset($attribs[$keyAttr])) {
            $val['name'] = $attribs[$keyAttr];
        }

        if (isset($attribs[$this->options['classAttribute']])) {
            $val['class'] = $attribs[$this->options['classAttribute']];
        }

        array_push($this->_valStack, $val);
    }

   /**
    * End element handler for XML parser
    *
    * @access private
    * @param  object XML parser object
    * @param  string
    * @return void
    */
    function endHandler($parser, $element)
    {
        $value = array_pop($this->_valStack);
        $data  = trim($this->_dataStack[$this->_depth]);

        // adjust type of the value
        switch(strtolower($value['type'])) {
            /*
             * unserialize an object
             */
            case 'object':
                if(isset($value['class'])) {
                    $classname  = $value['class'];
                } else {
                    $classname = '';
                }
                if (is_array($this->options['tagMap']) && isset($this->options['tagMap'][$classname])) {
                    $classname = $this->options['tagMap'][$classname];
                }

                // instantiate the class
                if (class_exists($classname)) {
                    $value['value'] = &new $classname;
                } else {
                    $value['value'] = &new stdClass;
                }
                if ($data !== '') {
                    $value['children'][$this->options['contentName']] = $data;
                }

                // set properties
                foreach($value['children'] as $prop => $propVal) {
                    // check whether there is a special method to set this property
                    $setMethod = 'set'.$prop;
                    if (method_exists($value['value'], $setMethod)) {
                        call_user_func(array(&$value['value'], $setMethod), $propVal);
                    } else {
                        $value['value']->$prop = $propVal;
                    }
                }
                //  check for magic function
                if (method_exists($value['value'], '__wakeup')) {
                    $value['value']->__wakeup();
                }
                break;

            /*
             * unserialize an array
             */
            case 'array':
                if ($data !== '') {
                    $value['children'][$this->options['contentName']] = $data;
                }
                if (isset($value['children'])) {
                    $value['value'] = $value['children'];
                } else {
                    $value['value'] = array();
                }
                break;

            /*
             * unserialize a null value
             */
            case 'null':
                $data = null;
                break;

            /*
             * unserialize a resource => this is not possible :-(
             */
            case 'resource':
                $value['value'] = $data;
                break;

            /*
             * unserialize any scalar value
             */
            default:
                settype($data, $value['type']);
                $value['value'] = $data;
                break;
        }
        $parent = array_pop($this->_valStack);
        if ($parent === null) {
            $this->_unserializedData = &$value['value'];
            $this->_root = &$value['name'];
            return true;
        } else {
            // parent has to be an array
            if (!isset($parent['children']) || !is_array($parent['children'])) {
                $parent['children'] = array();
                if (!in_array($parent['type'], array('array', 'object'))) {
                    $parent['type'] = $this->options['complexType'];
                    if ($this->options['complexType'] == 'object') {
                        $parent['class'] = $parent['name'];
                    }
                }
            }

            if (!empty($value['name'])) {
                // there already has been a tag with this name
                if (in_array($value['name'], $parent['childrenKeys']) || in_array($value['name'], $this->options['forceEnum'])) {
                    // no aggregate has been created for this tag
                    if (!in_array($value['name'], $parent['aggregKeys'])) {
                        if (isset($parent['children'][$value['name']])) {
                            $parent['children'][$value['name']] = array($parent['children'][$value['name']]);
                        } else {
                            $parent['children'][$value['name']] = array();
                        }
                        array_push($parent['aggregKeys'], $value['name']);
                    }
                    array_push($parent['children'][$value['name']], $value['value']);
                } else {
                    $parent['children'][$value['name']] = &$value['value'];
                    array_push($parent['childrenKeys'], $value['name']);
                }
            } else {
                array_push($parent['children'],$value['value']);
            }
            array_push($this->_valStack, $parent);
        }

        $this->_depth--;
    }

   /**
    * Handler for character data
    *
    * @access private
    * @param  object XML parser object
    * @param  string CDATA
    * @return void
    */
    function cdataHandler($parser, $cdata)
    {
        $this->_dataStack[$this->_depth] .= $cdata;
    }
}

?>