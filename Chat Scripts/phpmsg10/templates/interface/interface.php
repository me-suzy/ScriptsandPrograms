<?php

/*

  Example using PHP Messenger for creating user interfaces
  with ICQ, AIM or MSN messengers. 

  Now this example works with UIN 309386939.
  You can talk to him right now
  
  
  Copyright(c) 2004 http://www.php-messenger.com

*/

 
	$strmenu="";
	$array_itmes=Array (
		"1"=>Array("name"=>"Menu item 1","text"=>"Item 1 Selected!"),
		"2"=>Array("name"=>"Menu item 2","text"=>"Item 2 Selected!"),
		"3"=>Array("name"=>"Menu item 3","text"=>"Item 3 Selected!"),
		"4"=>Array("name"=>"Menu item 4","text"=>"Item 4 Selected!"));

	foreach ($array_itmes as $key=>$val)
	{
		$strmenu.="$key. {$val['name']}\r\n";
	}


	function Do_Message(&$pm,$m)
	{
		global $array_itmes,$strmenu;
		if (array_key_exists($m["message_text"],$array_itmes))
		{
		 	$pm->Send_Message($m['UIN'],"$strmenu\r\n".$array_itmes[$m["message_text"]]["text"]);
		}else
		{
		 	$pm->Send_Message($m['UIN'],"Unqnown command \"{$m["message_text"]}\"!\r\n$strmenu");
		}
	}


	function PM_Interface($UIN,$pass,$type,$admin_UIN)
	{
		if ($type=="ICQ")
		{
			$pm=new PM_ICQ();
		}elseif ($type=="AIM")
		{
			$pm=new PM_AIM();
		}elseif ($type=="MSN")
		{
			$pm=new PM_MSN();
		}else
		{
			exit;
		}
		if ($pm->login($UIN,$pass))
		{
			
			while (TRUE)
			{
				$m=$pm->Read_Message(-1);
				if ($m && (($type=="ICQ" && $m['online']) || $type!="ICQ"))
				{ 
					if (preg_match("/exit/i",$m['message_text']) && $admin_UIN==$m['UIN'])
					{
						$pm->Off_Line();
						exit;
					}
					Do_Message(&$pm,$m);
					if ($m=$pm->Read_Message(0))
					{
						Do_Message(&$pm,$m);
					}else
					{
						$pm->connection->Delete_Packets();
					}
				}
				
			}
		}
	}

	
?>	