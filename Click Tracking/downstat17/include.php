<?   
$datafile= "downstat_art/database.php";      
if(!@include("downstat_art/in_php.php")){ exit("upload ".$art."in_php.php"); }       
$fd = @fopen( $datafile, 'r' );      
$x=0;
$d=0;
while( !feof($fd) ){ 
$fgts = fgets( $fd );
$br=explode('^^',$fgts);     
$lines[]=$fgts;      
if($d == 1)$settings=$br;    
$d++;
if($m == inbox && $br[2] == $c && $br[2] !== Trash){ 
$usrs = explode("()",$br[6]);
$e=end($usrs);       
$esp = explode('|',$e);      
if($sorted == added)$datalist[$x]= $br[7];   
if($sorted == hits)$datalist[$x]= count($usrs);      
if($sorted == adrs)$datalist[$x]= $br[1];    
if($sorted == downloaded)$datalist[$x]= $esp[3];     
if($sorted == id)$datalist[$x]= $br[0];      
$brs[$x]=$br;
$x++;
}//  
if($br[0] == $id ){ $data=$br;  break; } 
}// end of loop while  
     
list($timeinput,$sntxin,$iphost,$alwaysdisplay,$whereto,$thenum)=explode("^^",$lines[1]);    
if($m == inbox  ){   
if($datalist){       
if($arang==asend) arsort($datalist); else asort($datalist);  
$Jstring.= '<table  border="0" cellpadding="0" cellspacing="0">';    
if($sc == 'true')$Jstring.= '<tr><td height="15" style="font-size: 13px;color: #666666;font-weight: bold;letter-spacing: 1px;"><div align="center">['.$c.']</div></td></tr>';
$Jstring.=  '<tr><td height="30" style="font-size: 12px;border: 1px solid #CCCCCC;padding: 3px;">';  
     
$find=array("@H","@F","@I","@L","@A",'@h');       
	$numpoint=1;
foreach($datalist as $inb => $file ){
$usrs = explode("()",$brs[$inb][6]); 
$e=end($usrs);       
$esp = explode('|',$e);      
$W_D='';     
if($esp[3])$W_D=showastime($esp[3]); else  $W_D='No Downloads';      
$values=array('<em>'.words(count($usrs),Hit).'</em>',$brs[$inb][1],$brs[$inb][0],'<em>'.$W_D.'</em>','<em>'.datezone($brs[$inb][7]).'</em>','<em>'.words(count($usrs),Hit).'</em>' );       
if($hyper){  
$h1="<a href=\"download.php?".$settings[7]."=".$brs[$inb][0]."\">";  
$h2='</a>';  
}    
$Jstring.= "<strong><font color=CCCCCC>".($numpoint++)." .</font></strong> $h1".str_replace($find,$values,$flformat)."$h2<br>";      
	if($ent == $ccnc++)break;   
	}// end foreach     
      
	    
$Jstring.=  '</td></tr></table>';    
echo "document.write('$Jstring');";  
}// if data list  
}else{ // if !$m inbox   
    
$usrs = explode("()",$data[6]);
$end = explode("|",end($usrs));      
$find=array("@H","@F","@I","@L","@h");
$values=array(words((count($usrs)-1),Time),$br[1],$br[0],showastime($end[3]),words((count($usrs)-1),Time));       
echo "document.write('".str_replace($find,$values,$string)."');";    
}// if m   
  
   
?>   
