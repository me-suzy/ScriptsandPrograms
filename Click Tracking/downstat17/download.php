<?PHP

$error[nofound]="The file you are requesting cound not be found";
$error[bandwidth]="The file you are requesting has gone over the bandwidth limit";
$error[password]='This file requires a password before you have access';

# Don't edit anything below this line

$art = 'downstat_art/';
$datafile= $art."database.php";

$webpath=str_replace('download.php', '', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);


$fd = @fopen( $datafile, 'r' )or die ("Problem with $datafile. Cant Open File");
$x=0;
while( !feof($fd) ){
$fgts = fgets( $fd );
$br=explode('^^',$fgts);
$lines[]=$fgts;
if($x==1){
$settings=$br;
if($passwordentry){  $id= $_POST['id'];  }else{ 
if($settings[7]){$id= $_GET[$settings[7]];   }else{ $id= $_GET['file'];  }
}
}

if($br[0] == $id){ $data=$br; $ln=$x;  }
$x++;
}// end of loop while 

function mailto($in,$ps=false){
global $settings,$webpath;
if($ps)$ps="\nYou may change this $ps by going to ".$webpath."admin.php\n";
if($settings[9])mail($settings[9],"Message From Your Downstat Program","This is an auto message from downstat that you have at ".$_SERVER['HTTP_HOST']."\n $in $ps\n\n If you do not want to recieve these emails, look on your downstat program settings for the appropriate option.","From: downstat@".str_replace('www.','',$_SERVER['SERVER_NAME'])."\n");

}// function mailto

if($ln){


$User_Agent = $_SERVER["HTTP_USER_AGENT"];                                          
if ((eregi("Mozilla", $User_Agent)) && (!((eregi("MSIE", $User_Agent)) ||(eregi("Opera", $User_Agent)) ||(eregi("WebTV", $User_Agent)) || (eregi("compatible", $User_Agent))))) {                                           
 $BROWSER="Navigator";
} elseif ((eregi("MSIE", $User_Agent)) &&                                    
(!((eregi("AOL", $User_Agent)) ||                                 
(eregi("WebTV", $User_Agent))))) {                                           
 $BROWSER="Explorer";                                           
} elseif (eregi("AOL", $User_Agent)) {                                           
 $BROWSER="AOL";                                           
} elseif (eregi("Opera", $User_Agent)) {                                           
 $BROWSER="Opera";                                           
} elseif (eregi("WebTV", $User_Agent)) {                                           
 $BROWSER="WebTV";                                           
} elseif (eregi("Lynx", $User_Agent)) {                                           
 $BROWSER="Lynx";
 } elseif (eregi("Active", $User_Agent)) {                                           
 $BROWSER="Active Worlds";                                           
} else {                          
$BROWSER=Unknown;                                           
}

if($data[5] !== off){
if("$passwordentry" !== "$data[5]"){

if($passwordentry)$bd_w = '<font color=red>Incorrect</font>';
echo '<form method="post" action="download.php">
  <div align="center" >
    <table width="400" style="font-size: 12px;">
      <tr>
        <td width="400"><input  type="hidden" value="'.$id.'" name="id"><strong>'.$error[password].' <img src="downstat_art/lock.gif" > <br>
          </strong>
          <input name="passwordentry" type="password" value="'.$passwordentry.'" style="font-size: 11px;background-color: #F8F3F3;border: 1px solid #666666;">
          <input type="submit" class="unnamed1" value="Unlock" style="	font-size: 9px;font-weight: bolder;background-color: #F2EAEA;border-right-width: 1px;border-bottom-width: 1px;border-right-style: solid;	border-bottom-style: solid;border-right-color: #666666;border-bottom-color: #666666;font-family: Geneva, Arial, Helvetica, sans-serif;"><br>'.$bd_w.'
        </td>
      </tr>
    </table>  
  </div>
</form>';
exit;
}// if passwordentry
}

$ahits=explode('()', $data[6]);

$hits=count($ahits);
if($data[4]){ 
 if($hits == $data[4]){ 
mailto("The file \"$id\" has reached $hits hits",notification); 
$data[4]= off;
 }
}/// if email off

if($data[3] && $data[3] !== off){
$dl = explode("|",$data[3]);
$b_lmt = time()-$dl[1]*$dl[2];  
$hi=0;
$within=0;
while($hi++ < count($ahits) ){

$usr = explode("|",$ahits[$hi]);

if($usr[3]>$b_lmt)$within++;

if($within == $dl[0]){  $limit=true;  break;}

}// end loop

if($limit){
$er=bandwidth;
echo $lines[3];


$cbbr=explode("^^",$lines[$ln]);
$cbb=explode("|",$cbbr[3]);

$cbbr[3]=$cbb[0].'|'.$cbb[1].'|'.$cbb[2].'|'.$cbb[3].'|true';

$lines[$ln]=implode("^^",$cbbr); 
$input=true;

if($dl[3]){

if($dl[2] == 60 )$ranged= Minutes;
if($dl[2] == 3600 )$ranged= Hours;
if($dl[2] == 86400 )$ranged= Days;
if($dl[2] == 604800 )$ranged= Weeks;
if($dl[2] == 2629743 )$ranged= Months;
if($dl[2] == 31556926 )$ranged= Years;

mailto("The file \"$id\" has gone over the allotted bandwidth limit, currently you have this file limited by $dl[0] downloads every $dl[1] $ranged",limit);

}

$noin=true;
}//limit bandwidth 

}// if 

$clb=explode("^^",$lines[$ln]);
$clb[6] .='()'.$_SERVER["HTTP_REFERER"].'|'.$_SERVER['REMOTE_ADDR'].'|'.$BROWSER.'|'.time();
$lines[$ln]=implode("^^",$clb); 

if(!$noin){

if($settings[8]){
if(!@header("location: $clb[1]"))$er=nofound;
}else{/// else if not have direct download on
$keywords =array('$file','$urlfile');
$values =array($clb[0],$clb[1]);
echo str_replace($keywords, $values, @join(@file("prompt.txt")));
echo "<meta http-equiv=refresh content=\"$settings[10];URL=$clb[1]\">";

} //if not direct download


$input=true;
} // if noin

}else{ /// else if $ln is not here 
$er=nofound;
if($settings[6]){
if($_SERVER["HTTP_REFERER"])$reff= "\nThis person originated from ".$_SERVER["HTTP_REFERER"]." ";
mailto("Someone tried to download the file id \"$id\" that doesnt exist, please check if it is added and links within webpages.$reff");
}

}// if !$ln
if($er){

$keywords =array('$file','$error');
$values =array($clb[0],$error[$er]);
echo str_replace($keywords, $values, @join(@file("no_prompt.txt")));
  
}

if($input){

$fp = @fopen($datafile,"w+")or die ("Problem with $datafile. Cant Write Data");
for($a=0;$a<count($lines);$a++){
fputs($fp,"$lines[$a]");
}
fclose($fp);
}

?>
