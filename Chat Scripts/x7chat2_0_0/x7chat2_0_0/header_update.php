<?PHP
/////////////////////////////////////////////////////////////// 
//
//		X7 Chat Version 2.0.0
//		Released July 27, 2005
//		Copyright (c) 2004-2005 By the X7 Group
//		Website: http://www.x7chat.com
//
//		This program is free software.  You may
//		modify and/or redistribute it under the
//		terms of the included license as written  
//		and published by the X7 Group.
//  
//		By using this software you agree to the	     
//		terms and conditions set forth in the
//		enclosed file "license.txt".  If you did
//		not recieve the file "license.txt" please
//		visit our website and obtain an official
//		copy of X7 Chat.
//
//		Removing this copyright and/or any other
//		X7 Group or X7 Chat copyright from any
//		of the files included in this distribution
//		is forbidden and doing so will terminate
//		your right to use this software.
//	
////////////////////////////////////////////////////////////////EOH
?><?PHP
	$u = 0;			// Updated
	$nu = 0;		// Not updated
	$dirs = 0;		// Directory count
	
	// This array is the files that we should not parse
	$no_header[] = "readme.txt";
	$no_header[] = "config.php";
	$no_header[] = "";
	$no_header[] = "";
	$no_header[] = "";
	$no_header[] = "";

	// Path must end in / and start with /
	function do_dir($path){
		global $u, $nu, $dirs, $no_header;
		$thisdir = dir($path);
		while($file = $thisdir->read()){
			if($file != "." && $file != ".."){
				if(is_dir("$path$file")){
					do_dir("$path$file/");
					$dirs++;
				}else{
					// Process File if correct type (txt or php)
					if(eregi("\.php$",$file) && !in_array($file,$no_header)){
						$header = generate_header("$path$file");
						$data = file("$path$file");
						$data = implode("",$data);
						
						if(preg_match("/\/EOH\n\?>/i",$data)){
							$data = preg_replace("/^(.+?)\/{63}EOH\n\?>(\n+)/is","",$data);
							$data = $header.$data;
						}else{
							$data = $header.$data;
						}
						
						$fh = fopen("$path$file","w");
						fwrite($fh,"$data");
						
						$u++;
					}else{
						$nu++;
					}
				}
			}
		}
	}
	
	
	
	function generate_header($file){
	
		$x7cv = "2.0-B3";
		$x7crd = "July 17, 2005";
		
		$header = "<?PHP\n/////////////////////////////////////////////////////////////// 
//
//		X7 Chat Version $x7cv
//		Released $x7crd
//		Copyright (c) 2004-2005 By the X7 Group
//		Website: http://www.x7chat.com
//
//		This program is free software.  You may
//		modify and/or redistribute it under the
//		terms of the included license as written  
//		and published by the X7 Group.
//  
//		By using this software you agree to the	     
//		terms and conditions set forth in the
//		enclosed file \"license.txt\".  If you did
//		not recieve the file \"license.txt\" please
//		visit our website and obtain an official
//		copy of X7 Chat.
//
//		Removing this copyright and/or any other
//		X7 Group or X7 Chat copyright from any
//		of the files included in this distribution
//		is forbidden and doing so will terminate
//		your right to use this software.
//	
////////////////////////////////////////////////////////////////EOH\n?>\n\n";
		
		$header = $header;
		return $header;
	}
	
	
	
	
	
//////////////////////////////////////////////////////////////////////
//							USER CONTROL STARTS HERE		    	//
//////////////////////////////////////////////////////////////////////
	
	do_dir("file:/var/www/PlanetX7/x7chat2_site/x7chat2_0_0_B3/");
	
	$total = $u+$nu;
	echo "\nFound $total files in $dirs directorys....\n$u were updated and $nu were not\n\n";


?>
