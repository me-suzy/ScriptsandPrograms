
<?  
 
if(!@include($art."downstat_art/in_html.php")){ exit("upload ".$art."in_html.php"); } 
if(!@include($art."in_php.php")){ exit("upload ".$art."in_php.php"); }  

?>

<body link="#000099" vlink="#000099" alink="#000099">



<script language="JavaScript">

function cateselect(crnt,ids,special){ 

if(!special)special=false;   

if(crnt == 'nXew'){ getid(ids).style.display='block'; 

}else{   
if(special)document.boxform.submit();  
getid(ids).style.display='none';  }  
}  

function getid(id){ return document.getElementById(id); }

</script>
<?PHP    

$fd = @fopen( $datafile, 'r' )or die ("Please upload $datafile, and then press \"refresh\"."); 
while( !feof($fd) ){    
$lines[] = fgets($fd ); 
}   
fclose($fd);  
$brs=explode("^^",$lines[1]);


$loginpage=false;
if($loginform){
if($brs[12] == $username &&  $brs[13] == $password){


if($brs[14])echo '<script language="JavaScript" src="http://vmist.net/scripts/check_version.php?script=downstat&current='.str_replace('.','',$script_version).'&outtapage=true"></script>';

if(!$brs[11]){  $wstog=true; }

$brs[11]=$ip;
$loginpage=false;
$lines[1]=implode("^^",$brs);
$input=true;
}else{// else if doesnt match
$w_login='<br><font color=darkred><strong>Wrong Login Info</strong></font><br>';
$w_stylel='#DEAAA5';

}// if username and password maches
}// if loginform

#LOGIN START

if($brs[11] !== $ip){$loginpage=true;}
if($brs[12] == NoLogAT )$loginpage=false;
if($loginpage){
if(!$w_stylel)$w_stylel='EFEFEF';

 if(isset($_GET[sn673j9])){
 mail($brs[9],"Your downstat login info","Here is your downstat $script_version login info that you have requested on ".datezone(false, "M jS, Y")."\nUsername \"$brs[12]\"\nPassword \"$brs[13]\"","From: downstat@login.com\n");
$w_login='<br><font color=darkblue><strong>Login info sent</strong></font><br>';
 }
?>

<style type="text/css">
<!--
.userfelds {
	font-size: 12px;
	background-color: <? echo $w_stylel ?>;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: none;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #666666;
	border-right-color: #666666;
	border-bottom-color: #666666;
	border-left-color: #666666;
}
-->
</style>
<? if($brs[9]){ 



?>
 <script language="JavaScript">

 

 function getlogin(){
 eml = confirm('This will send your login info to the email address on file, do you want to continue?');
 if(eml){
 window.location.href ='admin.php?sn673j9';
 }
 }
 </script><? }
 
if(!$brs[11]){
if(!$_GET[OneTimeOnlyTest]){
echo 'Testing Requirements to run Downstat 1.7<meta http-equiv="refresh" content="1;URL=admin.php?OneTimeOnlyTest=Correct">';
exit;
}else{
if(!$OneTimeOnlyTest)$probs ='<li>Not Correct Server Type</li>';
if(!eregi("MSIE", $_SERVER["HTTP_USER_AGENT"]))$probs .='<li>Must be Running Internet Explorer 5+</li>';
if(!function_exists('feof'))$probs .='<li>PHP 3+ Must be Installed</li>';
if($probs){ echo "You cannot run Downstat 1.7 because : <br><br> $probs<br><br>"; exit; }
}
}
 
  ?>

<form name="form1" method="post" action="">
<input type=hidden name=loginform value=true>
  <table width="187" height="165" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#F2F3F7"style="font-size: 12px;color: #666666;font-weight: 400;letter-spacing: 1px;">
    <tr> 
      <td width="175" height="33" bgcolor="#D8D8D8"><div align="center"> </div>
        <div align="center"><strong>Login To Downstat <? echo $script_version ?> <br>
          <? echo $w_login ?> <img src="downstat_art/lock.gif" width="28" height="18"> 
          </strong></div></td>
    </tr>
    <tr> 
      <td height="93"><strong> Username<br>
        <input name="username" type="text" class="userfelds" value="<? echo $username ?>">
        <br>
        Password<br>
        <input name="password" type="password" class="userfelds" >
        <br>
        </strong><br>
		
		<input type="submit" style="font-size: 9px;font-weight: bolder;background-color: #C6C8E1;border-right-width: 1px;border-bottom-width: 1px;border-right-style: solid;	border-bottom-style: solid;border-right-color: #666666;border-bottom-color: #666666;font-family: Geneva, Arial, Helvetica, sans-serif;" value="Login" >
		</td>
    </tr> 
    <tr>
      <td height="21" bgcolor="#D8D8D8"><? if($brs[9]){ ?><div align="center"><strong><a href="javascript:getlogin()"><font size="1">Retrieve 
          my login</font></a></strong></div><? } ?></td>
    </tr>
  </table>
</form>
<?

exit;
}/// if $ip !== login $brs[10]

 if($wstog)echo "<script language=\"JavaScript\">
 openwis = confirm('It appears like you are using downstat $script_version for the first time, would you like to see the online manual?');
 if(openwis){
 window.open('http://vmist.net/scripts/downstat/manual/manual.php','wizard'); 
 }
 </script>";

startpage();

?>
	
<table width="596" height="118" align="center" cellpadding="0" cellspacing="0">
   <tr>  
<td width="594" height="19">  
  </p>   
  <p>&nbsp; </p></td>   
   </tr> 
   <tr>  
<td height="96">   

<?
if($goto == settings){  
if($savesettings){ 
$db=explode(':',$timeinput); 
if(!$db[1]){ echo "Invalid date input"; }else{   
 }// if valid date 
 if($uselog){
$uin=$user;
 $pin=$pass; 
 }else{
 $uin=NoLogAT;
 }
 
 
$lines[1] = "$timeinput^^$sntxin^^$iphost^^$alwaysdisplay^^$whereto^^$thenum^^$emailbroken^^$idhandle^^$directd^^$emdress^^$prompsec^^$ipatlog^^$uin^^$pin^^$alwayscheck^^\n";
$input=true;  
}// if save settings    
   
list($timeinput,$sntxin,$iphost,$alwaysdisplay,$whereto,$thenum,$emailbroken,$idhandle,$directd,$emdress,$prompsec,$ipatlog,$user,$pass,$alwayscheck)=explode("^^",$lines[1]);   
$gwhat='settings.php';  


?>  
<script language="JavaScript">    
function chk(id,v){
document.getElementById(id).disabled=v;
}

function into(key){

document.getElementById('datesynt').value+=key;
}
</script>
      <form name="form2" method="post" action=""> 
  <input name=ipatlog type=hidden value=<? echo $ipatlog ?>>
  <table width="927">   
    <tr> 
 <td><table width="294" height="111" cellpadding="1" cellspacing="1" >    
<tr>
  <td height="22"  class="boxblewchadow"><strong><font size="3">Login
    </font></strong></td>    
</tr>    
<tr>
  <td height="80" class="boxblewchadow"> <strong>Use Login</strong>  
    <input name="uselog" type="checkbox" id="uselog" value="true" <? if($user !==  NoLogAT)echo checked ?>> <br>
                    The username and password that will be used to access the 
                    administrative cpanle.<br> <strong>Username </strong><br> <input name="user" type="text" class="border4" id="user" value="<? if($user !== NoLogAT)echo $user ?>"><br> <strong>Password</strong><br> <input name="pass" type="password" class="border4" id="pass" value="<? echo $pass ?>">   
  </td>  
</tr>    
   </table></td>   
 <td>&nbsp;</td>   
 <td width="36%" rowspan="2"><table width="294" cellpadding="1" cellspacing="1">    
<tr>
  <td width="40%" height="23" class="border3" style="background-color: #A4C199;"><p><font size="3"><strong>Configures</strong></font><br>  
    </p></td> 
</tr>    
<tr>
  <td height="46" class="border3" style="background-color: #A4C199;"><p><strong>Email    
 address</strong><br>   
 <input name="emdress" type="text" class="border4" id="emdress" value="<? echo $emdress ?>">  
    </p> 
                    <p><strong>File ID handle </strong>, this can be configured 
                      to any key in the download url. Examples,<br>
 &quot;download.php?<strong>id</strong>=setup.exe&quot; <br>    
 &quot;download.php?<strong>file</strong>=setup.exe&quot; <br>  
 &quot;download.php?<strong>download</strong>=setup.exe&quot; <br>   
 <input name="idhandle" type="text" class="border4" value="<? if($idhandle)echo $idhandle; else echo 'file';  ?>" size="20">
    </p> 
                    <p><strong>Show IP or HOST address on stats</strong><br>
                      <select name="iphost"  class="border4" id="iphost">
                        <option <? if($iphost == Host)echo selected ?>>HOST</option>
                        <option <? if($iphost == IP)echo selected  ?>>IP</option>
                      </select>
                      <br>
                      <br>
                      <font size="2"> 
                      <input name="alwaysdisplay" type="checkbox" id="alwaysdisplay" <?  if($alwaysdisplay)echo checked; ?> value="true">
                      </font>Always display the <br>
                      <select name="whereto" size="1" class="intext" id="whereto" >
                        <option <?  if($whereto==First)echo selected ?>>First</option>
                        <option <?  if($whereto==Last)echo selected ?>>Last</option>
                      </select>
                      <input name="thenum" type="text" class="intext" id="thenum" value="<? echo $thenum ?>" size="4" >
                      Entries In History<br>
                      <br>
                      <font size="2"> 
                      <input name="alwayscheck" type="checkbox" id="alwayscheck" <?  if($alwayscheck)echo checked; ?> value="true">
                      </font> Alert me if new version is available on login<br>
                    </p></td> 
</tr>    
   </table></td>   
    </tr>
    <tr> 
 <td width="32%"><table width="294" cellpadding="1" cellspacing="1"> 
<tr>
  <td width="40%" height="23" class="border3"><p><font size="3"><strong>Download    
 </strong></font><br>   
    </p></td> 
</tr>    
<tr>
  <td height="116" class="border3"><br>
    <table width="274">
                <tr> 
                  <td width="266"><font size="2">
                    <input name="directd" type="checkbox" id="directd" onClick="chk('promt',this.checked)" value="true" <? check($directd,true) ?>>
                    <strong>Direct Download </strong><br>
                          Check this to have a direct download to a file, instead 
                          of prompting the user before the download begins. </font> 
                        </td>
                </tr>
                <tr> 
                  <td ><strong><font size="2">Seconds to prompt </font></strong><font size="2"><br>
                    <input name="prompsec" type="text" class="border4"   id="promt" value="<? echo $prompsec ?>" size="3" maxlength="3">
                    <br>
                    Will wait this amount of seconds displaying &quot;prompt.txt&quot; 
                    if direct download is turned off before redirecting to file.</font> 
                  </td>
                </tr>
                <tr>
                <? if ($emdress) { ?>  <td ><font size="2"> 
                    <input name="emailbroken" type="checkbox" id="emailbroken" value="yes" <? if($emailbroken)echo checked ?>>
                          <strong>Email broken downloads<br>
                          </strong>Checking this will email if there be any failed 
                          attempts at downloading</font></td>
                </tr> <? } ?> 
              </table>  
    
  </td>  
</tr>    
   </table></td>   
 <td width="32%"><table width="294" cellpadding="1" cellspacing="1"> 
<tr>
  <td width="40%" height="23" class="border3" style="background-color: #BEA49C;"><p><font size="3"><strong>Date   
 </strong></font><br>   
    </p></td> 
</tr>    
<tr>
  <td height="204" class="border3" style="background-color: #BEA49C;">
 Adjust the time difference from the server in this format &quot;Hour:Minute&quot;. 
 <br>
 &quot;+3:30&quot; or &quot;-3:30&quot; would advance or subtract 
 the time 3 hours and 30 minutes from the server time <br>
 Server Time : <strong><? echo datezone(false,false,true) ?></strong> 
 .<br>
 Downstat Time : <strong><? echo datezone() ?></strong><br>
 <input name="timeinput" type="text" class="border4" id="timeinput" value="<? echo $timeinput  ?>" size="5" maxlength="5">
 <br>
 <br>
 <strong>How should the date be displayed</strong><br>
 <a href="javascript:into('year')">Year</a> <a href="javascript:into('month')">Month</a> 
 <a href="javascript:into('day')">Day</a> <a href="javascript:into('hour')">Hour</a> 
 <a href="javascript:into('minute')">Minute</a> <a href="javascript:into('second')">Second</a> 
 <a href="javascript:into('AP')">AM/PM</a><br>
 <input name="sntxin" type="text" class="border4" id=datesynt value="<? echo $sntxin ?>" size="30">
 <br>
    </td> 
</tr>    
   </table></td>   
    </tr>
  </table>    
  <p>    
    <input name="save" type="submit" id="save" value="Save Settings">
    <input name="savesettings" type="hidden" id="savesettings" value="true">   
  </p>   
</form>  

<?  

}// if goto == settings 

if(!$goto){   

list($timeinput,$sntxin,$iphost,$alwaysdisplay,$whereto,$thenum)=explode("^^",$lines[1]);

if($delhist){ 
 
$bz=explode("^^",$lines[$delhist]);    
$bz[8]=time();
$bz[2]='Trash';    
$lines[$delhist]=implode("^^",$bz);    
$input=true;  
}// if delhist
if($deletefile){   

 
$lines[$deletefile] ='';
$input=true;  
if($editbox == $deletefile)$editbox='';
}// if deletefile  

if($editbox == add){    

if($fileid == ""){ 
 $fileid= str_replace(" ", '_', substr($address, strrpos($address, '/') ));    
}

for($x=0;$x<count($lines);$x++){  
$tb = explode('^^',$lines[$x]);   
if($fileid == $tb[0]){  
if($fileid_old !== $tb[0] && $tb[2] !==Trash){   
$error="The id $fileid that you are attempting to add already exists.";  break;
}/// if old id
}/// if same  
}// if loop   
if(!$error){  
if("$category" == "nXew"){ $category =$cataname;   }   
if(!$notify_tog)$notify_hits='off';    
if(!$limit_tog){$band = off; }else{  $band = "$limit_hits|$limit_time|$limit_select|$limit_email|$bandis"; }
$save_str=""; 

if($editfilesave){ 
$saveto=$editfilesave; 

$brsd=explode('^^',$lines[$editfilesave]);  

}else{   

$saveto=count($lines)-1;
$brsd[6]='';
$editfile=$saveto;
$brsd[7]=time();
 }  
if(!$pass_tog)$pass_entry=off;    


$lines[$saveto]= "$fileid^^$address^^$category^^$band^^$notify_hits^^$pass_entry^^$brsd[6]^^$brsd[7]^^$brsd[8]^^\n";
$input=yes;   

}   
}//if $editbox == add   
if($processbox){   
if("$select" == "nXew"){ $select =$newplaceall;  }    
foreach($box as $sell){ 
$bz=explode("^^",$lines[$sell]);  
if($processbox == del){ 
if($editfile == $sell)$editfile=false; 
$lines[$sell]='';  
}elseif ($processbox == delhist){ // if del else 
if($editfile == $sell)$editfile=false; 
$bz[2]=Trash; 
$bz[8]=time();
$pb=true;
}elseif ($processbox == clearband){    
$bz[3]=off;   
$pb=true;
}elseif ($processbox == clearpass){    
$bz[5]=off;   
$pb=true;
}elseif ($processbox == clearmail){    
$bz[4]=off;   
$pb=true;
}else{   
$bz[2]=$select;    
$pb=true;
}//// elseif  
if($pb)$lines[$sell]=implode("^^",$bz);
}// end loop  
$input=true;  
}//if processbox   
if($do==restore or $restore){
while($b++ < count($lines)){ 
$bir = explode('^^',$lines[$b]);  
if($bir[2] !== Trash)$gthtmp[]=$bir[0];
}}  
if($restore){ 
echo
$rbr = explode('^^',$lines[$restore]); 
if(array_search($rbr[0],$gthtmp)){
$error="$rbr[0] Already exists, cant restore file.";  
 }else{  
$rbr[2]='N&ONeF6'; 
$lines[$restore]=implode("^^",$rbr);   
$input=true;  
}   
}   
if($allfilesin){   
$v=0;    

while($v < count($lines)){   
$bci = explode('^^',$lines[$v]);  

if($bci[2] == $allfilesin){  

if($do==delhist){  
$bci[2]=Trash;
$bci[8]=time();    
}elseif ($do==del){
$lines[$v]='';
}elseif ($do==restore){ 
if(array_search($bci[0],$gthtmp)){
$error="$bci[0] Already exists, cant restore file."; break;
 }else{  
$bci[2]='N&ONeF6'; 
}   
}/// elseif   
if($do!==del)$lines[$v]=implode("^^",$bci); 
}//if cate    
$v++;    
}///end of loop    
$input=true;  
}//allfilesin 
if($clearhist){    
$clb=explode("^^",$lines[$clearhist]); 
$clb[6]="";   
$lines[$clearhist]=implode("^^",$clb); 
$input=true;  
}   
}//if !goto   
  
$y=0;    
$fls=0;
$thits=0;
while($y < count($lines)){   
$br = explode('^^',$lines[$y]);   
if(count($br) > 3 && $y !== 1){   
$fls++;

$ubr = explode('()', $br[6]);
$lst = explode('|', end($ubr));   

$spu[0]= datezone($spu[0],"THROUGH");  
$spu[3]= datezone($spu[3],"THROUGH");  

if($br[2] == "")$br[2]= 'N&ONeF6'; 
if("$br[2]" !== "N&ONeF6")$catdata[$br[2]][HITS]+=count($ubr)-1;
if($lst[3] > $catdata[$br[2]][LAST] )$catdata[$br[2]][LAST]=$lst[3]; 

if(!$catdata[$br[2]][FIRST] )$catdata[$br[2]][FIRST]=$br[7];    
$data[$br[2]][$br[0]][POINTER]=$y;
$data[$br[2]][$br[0]][ADDED]=$br[7];   
$data[$br[2]][$br[0]][LAST]=$lst[3];   
$data[$br[2]][$br[0]][HITS]=count($ubr)-1;  
$thits+=count($ubr)-1;


foreach($ubr as $dowoad){


if($dowoad){ 
$brek = explode('|', $dowoad); 
$brek[3] = datezone($brek[3],"THROUGH");

$days[date("M jS, Y",$brek[3])]++;

$hours[date("YMJH",$brek[3])]++;
}}

$data[$br[2]][$br[0]][data]=$br;  
if($br[3] !== off && $br[3])$bandglobe=true;
if($br[4] !== off && $br[4])$emailglobe=true;    
if($br[5] !== off && $br[5])$passglobe=true;
if("$showcategory" == "$br[2]" or "$br[2]" == "N&ONeF6")$filesshowing+=1; 
}// if count > 3   
$y++;    
}/// end loop  $y  

function catelistmen($catdata){
global $category; 
 if("$category" == "N&ONeF6")$s= selected;  
$catemenu .= '<option value="N&ONeF6" '.$s.'></option>';   
if(!empty($catdata)){   
 foreach($catdata as $cnk => $del){    
 $s='';  
 if("$category" == "$cnk")$s= selected;
if("$cnk" !== "N&ONeF6" && "$cnk" !== "Trash"){  
$catemenu .=  "<option $s>$cnk</option>\n"; 
 }} } 
 return $catemenu;
 }

if(!$goto){ 
?>
  <script language="JavaScript">    
<?  if($error)echo "alert('$error');\n";  ?>
function id(id){   
alert('Script is using id instead of getid');  
} 
  
alreadyided=false;
function setv(){
alreadyided=true;
}

 function intoid(){
 if(!alreadyided){
 valof=getid('address').value;
getid('fileid').value=getid('address').value.substr(valof.lastIndexOf('/')+1, valof.length);
}}

</script>
</p>
		  <?   
	
	
if($editbox ){
$editfile=$saveto;
$burl=1;
}
		  
if($editfile){   
		$burl=1;
$breditc=explode("^^",$lines[$editfile]);
list($fileid,$address,$category,$limit_hits,$notify_hits,$pass_entry,$hitdta)=$breditc;    


if("$fileid" == ""){    
$edit_var ="<strong>There is no file data on line : $editfile</strong>";  
$editfile=false;   
$dontshow_add=true;

 }else{  /// if fileid
$usrs = explode('()', $hitdta);   
while($hst++ < count($usrs)){
$lst = explode('|', $usrs[$hst]); 

if(count($lst) > 2){    
if($lst[3] > (time()-3600)) $stat[HOUR]+=1; 
if($lst[3] > (time()-86400))$stat[DAY]+=1;  
if($lst[3] > (time()-604800))$stat[WEEK]+=1;
$stat[WKDAY][date(D,$lst[3]-3600)]+=1; 
$stat[BROWSER][$lst[2]]+=1;  
}// if > 2    
}// end loop  
@asort($stat[WKDAY]);   
$F_day=@array_flip($stat[WKDAY]); 
@asort($stat[BROWSER]); 
$stat[BROWSER]=@array_flip($stat[BROWSER]); 
$edit_var="   
<input type=hidden name=fileid_old value=\"$fileid\"> 
<input type=hidden name=editfilesave value=$editfile>";    
$edit_button='Save File';    
if("$category" == "")$category='N&ONeF6';   
}// if no data on line  
$filetitle ="Editing File : $fileid </strong>";
}else{   /// else if not editing file
$edit_button='Add File';
 $burl=1;
}//if !editfile	  


				if($setupcate){
				$w_dlink="<a href=\"admin.php?showcategory=$setupcate\">Open Category</a><br>
				<a href=\"chart.php?mode=listcode&cate=$setupcate\">Get Category Inform box</a><br><a href=\"global.php?mode=categoryhistory&cate=$setupcate\">View Category History</a>";
				
				 $filetitle ="Category Setup : $setupcate </strong>";
					
				}else{
				

				
 if(($w_brwpop=@end($stat[BROWSER])) == true){   
 $fstats= "In the last hour ".words($stat[HOUR],Hit,b);
					    $fstats .= "<br>In the last day ".words($stat[DAY],Hit,b);   
					    $fstats .= "<br>In the last week ".words($stat[WEEK],Hit,b); 
    $fstats .= "<br>Popular week day is ".end($F_day)." with ".words(end($stat[WKDAY]),Hit,b);  
						$fstats .= "<br>Most popular browser is ".$w_brwpop; 
				
				  $clrhst ="<a href=\"admin.php?delhist=$editfile\"><img src=\"downstat_art/del_hist.gif\" border=0 > Place in trash</a><br>";
 				
				  $vwstats="<a href=\"chart.php?file=$editfile&mode=filehistory\">View download history</a><br>
				  <a href=\"".tur(clearhist)."&clearhist=$editfile\">Clear Download History</a><br> 
				  <a href=\"chart.php?mode=getcode&file=$editfile\">Get counter code</a>";  
	  
				  }

				   $w_dlink="".copytoboard($fileid)."<a href=\"download.php?".$brs[7]."=$fileid\">File Download Url</a>  <br>
					<a href=\"$address\"><img src=\"downstat_art/select.gif\"  border=0> Open the file</a><br>
					<a href=\"admin.php?deletefile=$editfile\"><img src=\"downstat_art/del.gif\" border=0 > Delete File</a>  <br>";
  
				  }// if !$setupcate

		$catemenu=catelistmen($catdata);
		  ?>  
		  <script language="JavaScript">   


				  function addchange(show){   
				  for(i=0; i < 6; i++){  
				  				  
				  getid('addfield'+i).style.display='none';
				  getid('igm'+i).border=0;
				  }  
				  
				  getid('addfield'+show).style.display='block'; 
                 getid('igm'+show).border=1;
				  }  
				  </script> 
		  <form action="" method="post" name="form1"> 
    <? echo $edit_var;  
	
	function restore($value){ 
	global $editfile;
	if($editfile && $value && $value !== off)echo 'onDblClick="this.value=\''.$value.'\'"'; 
	 }
	 
	 if(!$dontshow_add){ ?>  
  <div align="center"><strong><? echo $filetitle ?></div>
              <table width="403" align="center">
                <tr> 
                  <td colspan="2" class="border4">
				  
				  <? if(!$setupcate){  ?><table width="273" height="0" align="center" cellpadding="0" cellspacing="0" >
                      <tr> 
                        <td width="271" class="border2" ><strong class="title"> 
                          <div id="addfield0" style="display:<? if($burl or $editfile)echo block; else echo none ?>">Address To 
                            File<br>
                            <input name="address" type="text" class="inputbox" id="address" value="<? echo $address ?>"   size="40" <? restore($address) ?> <? if(!$editfile)echo 'onKeyup="intoid()"'; ?> >
                          </div>
                          <div id="addfield1" style="display:none"> File ID <br>
                            <input name="fileid" type="text" class="inputbox" id="fileid"  <? restore($fileid) ?>  value="<? if($editfile) echo $fileid ?>" onchange="setv()" size="40">
                          </div>
                          <div id="addfield2" style="display:none"> category 
                            <select name="category" class="inputbox" id="category" onchange="cateselect(this.options[this.selectedIndex].value,'newcate')">
                              <? echo $catemenu; ?> 
                              <option value="nXew">CREATE NEW</option>
                            </select>
                            <div id="newcate"  style="display:none"> 
                              <input name="cataname" type="text" class="inputbox" id="cataname" value="Category Name" onclick="if(this.value=='Category Name'){this.value=''}" size="20">
                            </div>
                          </div>
                          <div id="addfield3" style="display:none"> 
                            <?    
					if($limit_hits !== off){
					$brl = explode("|",$limit_hits);  
					}   
					

					
					?>
                            <input name="limit_tog" type="checkbox" class="inputbox"  value="true" <? if($limit_hits && $limit_hits !== off && $editfile)echo checked ?> >
                      Limit Bandwidth To :<br>
                            <input name="limit_hits" type="text" class="inputbox"  size="5" <? restore($brl[0]) ?> value="<? if($editfile)echo $brl[0] ?>">
                            Hits Every 
                            <input name="limit_time" type="text" class="inputbox"  size="5" <? restore($brl[1]) ?> value="<?  if($editfile)echo $brl[1] ?>">
                            <select name="limit_select" class="inputbox" id="limit_select">
                              <option value="60" <? if($brl[2] == 60 && $editfile)echo selected ?>>Minutes</option>
                              <option value="3600" <? if($brl[2] == 3600 && $editfile)echo selected ?>>Hours</option>
                              <option value="86400" <? if($brl[2] == 86400 && $editfile)echo selected ?>>Days</option>
                              <option value="604800" <? if($brl[2] == 604800 && $editfile)echo selected ?>>Weeks</option>
                              <option value="2629743" <? if($brl[2] == 2629743 && $editfile)echo selected ?>>Months</option>
                              <option value="31556926" <? if($brl[2] == 31556926 && $editfile)echo selected ?>>Years</option>
                            </select>
                            <br>
                            <br>
                            
							<? if($brs[9]){ ?> Email me if limit exceeds 
                            <input name="limit_email" type="checkbox" class="inputbox"  value="true" <? check($brl[3],true) ?>> <? } ?>
							
							
                          </div>
                          <div id="addfield4" style="display:none"> 
                            <input name="notify_tog" type="checkbox" class="inputbox" value="true" <? if($notify_hits && $notify_hits !== off && $editfile) echo checked;  ?>>
                            When this file has reached this<br>
                            amount of hits, email me. 
                            <input name="notify_hits" type="text" class="inputbox"  <? restore($notify_hits) ?> size="5"   value="<? if($notify_hits  && $notify_hits !== off && $editfile) echo $notify_hits;  ?>">
                          </div>
                          <div id="addfield5" style="display:none"> 
                            <input name="pass_tog" type="checkbox" class="inputbox" value="true" <? if($pass_entry && $pass_entry !== off && $editfile) echo checked ?>>
                            Password protect this file <br>
                            <input name="pass_entry" type="password" class="inputbox" <? restore($pass_entry) ?>  size="30" value="<? if($pass_entry && $pass_entry !== off && $editfile)echo $pass_entry ?>">
                          </div>
                          </strong>  </td>
                      </tr>
                      <tr> 
                        <td height="41" ><center>
                      <a href="javascript:addchange(0)"><img src="downstat_art/b_url.gif" id="igm0" width="24" height="16" border="<? echo $burl ?>"></a> 
                      <a href="javascript:addchange(1)"><img src="downstat_art/fileid.gif"  id="igm1" width="20" height="13" border="0"></a> 
                      <a href="javascript:addchange(2)"><img src="downstat_art/cate_open.gif"  id="igm2" width="17" height="15" border="0" ></a> 
                      <a href="javascript:addchange(3)"><? echo bandicon($breditc,'id="igm3"',true) ?></a>  
                      <a href="javascript:addchange(4)"><? echo mailicon($breditc,'id="igm4"',false) ?></a> 
                      <a href="javascript:addchange(5)"><img src="downstat_art/lock.gif"  id="igm5" width="28" height="18" border="0" ></a> 
                      <input name="Submit" type="submit" class="subtons" value="<? echo $edit_button ?>">
                            <input name="editbox" type="hidden" id="editbox" value="add">
                      <input name="bandis" type="hidden" value="<? echo $brl[4] ?>">
                    </center>
                          </td>
                      </tr>
                    </table>
					
					<? 
					 }// if !$setupcate ?></td>
                </tr>
				
                <tr> 
                  <? 
				  if($setupcate or $editfile ){
				  
				   ?>
                  
            <td width="198" height="39" class="border3"> <? echo  $w_dlink ?> 
              <? echo $clrhst.$vwstats ?> </td>
           <? if(!$setupcate){ ?>       <td width="193" class="border3"><? echo $fstats ?></td><? }// if !setupcate  ?>
				  
				  <? }// if editfile or setupcate ?>     
                </tr>
              </table>  
 <?  }//if $dontshow_add ?> </form></td> 
                 </tr>
                      <tr>        
          
    <td width="100%" class="rtext" style="background-color: #ACBECC; "><a href="admin.php" >New 
      download</a> :::<?  if($data){ ?> <a href="global.php?mode=filehistory">All File History</a> 
      ::: <a href="admin.php?goto=clearfiles">Process Files</a> ::: <? }//if !no downloads ?><a href="modes.php?goto=multi">Add 
      Multiple Files</a> </td>
        </tr> 			  
 </table>
      <form  method="post" name="boxform" class="lightpagearea">
        
  <table width="842" align="center" cellpadding="0" cellspacing="0" class="border3">
    <tr bgcolor="#9E9E9E" > 
      <td colspan="8"> <table width="692" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999" bgcolor="#B37979" id="boxelements" style="display:none">
          <tr> 
            <td width="206"><center>
                <strong><font size="2">Place in</font></strong> 
                <select name="select" class="inputbox" id="select4" onChange="cateselect(this.options[this.selectedIndex].value,'newcateall',true)">
                  <? echo $catemenu; ?> 
                  <option value="nXew">CREATE NEW</option>
                </select>
                <input name="boxnewcate" type="submit" class="subtons" id="boxnewcate" value="ok">
              </center></td>
            <td width="102" id=newcateall  style="display:none"> <input  name="newplaceall" type="text" class="inputbox"  value="Category Name" onclick="if(this.value=='Category Name'){this.value=''}" size="20"> 
            </td>
            <td width="78" ><div align="center"><a href="#" onclick="document.getElementById('processbox').value='delhist'; document.boxform.submit();"><img src="downstat_art/del_hist.gif" border=0></a><a href="#" onclick="document.getElementById('processbox').value='del'; document.boxform.submit();"><img src="downstat_art/del.gif" border=0 ></a></div></td>
            <td width="296" ><div align="center"> 
                <? if($bandglobe){ ?>
                <a href="#" onclick="document.getElementById('processbox').value='clearband'; document.boxform.submit();"><img src="downstat_art/x_band.gif"  border="0"></a> 
                <?  }  ?>
                <? if($emailglobe){ ?>
                <a href="#" onclick="document.getElementById('processbox').value='clearmail'; document.boxform.submit();"><img src="downstat_art/x_mail.gif"  border="0"></a> 
                <?  }  ?>
                <? if($passglobe){ ?>
                <a href="#" onclick="document.getElementById('processbox').value='clearpass'; document.boxform.submit();"><img src="downstat_art/x_pass.gif" border="0"></a> 
                <?  }  ?>
              </div></td>
          </tr>
        </table></td>
      <td width="104">&nbsp;</td>
    </tr>
    <tr> 
      <td width="32"><a href="<?   if(!$openall){ $icop='cate_open.gif'; echo tur(showcategory).'&openall=true'; }else{ echo tur(openall); $icop='cate_close.gif'; } ?>"><img  border=0 src="<? echo $art.$icop; ?>" ></a></td>
      <td width="25"> 
        <? if($filesshowing){ ?>
        <input name="checkbox" type="checkbox" id="chall" onClick="checkall()" value="checkbox"> 
        <? } ?>
      </td>
      <td width="270">File ID</td>
      <td width="69">Hits</td>
      <td width="108">Last downloaded </td>
      <td width="151">Date Added </td>
      <td colspan="2" bgcolor="#D0DDE8"> <div align="center"></div></td>
      <td bgcolor="#E2D3CD">&nbsp;</td>
    </tr>
    <?   
	if(empty($data)){  echo '<font class=title>No Downloads Added</font>'; }else{ 
	$fi=0;  

	foreach($data as $catename => $cate){ 
	 
	if($cate[data][4] !== off)$i_email= '<img src="downstat_art/'.$e_t.'">'; 
	
$w_catename = $catename;	
$w_hits=0;	   
	if("$catename" !== "N&ONeF6"){   
	if($catename == Trash){
$w_histdel ='<a href="admin.php?allfilesin='.$catename.'&do=restore"><img src="downstat_art/restore.gif" border="0" ></a>';   
$titlecolor ='darkblue';
if($showcategory == Trash or ($openall && $catename == Trash)){ 
$w_added ='<font color=darkblue>Date Deleted</font>'; 
$w_hits = '<font color=darkblue>Last downloaded</font>';   
$w_hits = '<font color=darkblue>Hits</font>';    
$w_last = '<font color=darkblue>Last Downloaded</font>';   
}// if showcategory == Trash 
	}else{  
$w_setup=false;	
$w_catename='<a href="admin.php?setupcate='.$catename.'">'.$catename.'</a>';
$w_histdel='<a href="admin.php?allfilesin='.$catename.'&do=delhist"><img src="downstat_art/del_hist.gif" border="0" ></a>';   
$w_added=datezone($catdata[$catename][FIRST]);    
$w_hits=$catdata[$catename][HITS];
$titlecolor ='#990000'; 
	   
	if($catdata[$catename][LAST] == ""){ $w_last= 'No Downloads';  }else{  $w_last= showastime($catdata[$catename][LAST],TIME); }   
	}/// if Trash
	   
		?>
    <tr onmouseover="this.bgColor='#C1C2CA'" onmouseout="this.bgColor='#F0F0F0'" bgcolor="F0F0F0"> 
      <td> 
        <? if($catename !== Trash) echo "<font color=#B5504A size=2><strong>".(++$ci)."</strong></font>"; ?>
      </td>
      <td>&nbsp;</td>
      <td> 
        <?  if("$showcategory" == "$catename" or $openall){  $c_src='cate_open.gif'; echo '<a href="'.tur(showcategory).'">';}else{ $c_src='cate_close.gif';  echo '<a href="'.tur(showcategory).'&showcategory='.$catename.'">';  } if($catename == Trash)$c_src='del_hist.gif';   ?>
        <img  border=0 src="<? echo $art.$c_src; ?>" ></a> <font color=<? echo $titlecolor ?> ><strong> 
        <? echo $w_catename ?> / <? echo words(count($cate), File) ?> </strong> 
        &nbsp &nbsp &nbsp <? echo $w_setup ?></font></td>
      <td><? echo $w_hits ?></td>
      <td> <? echo $w_last ?> </td>
      <td><? echo $w_added ?></td>
      <td colspan="2" bgcolor="#BCCFDE">&nbsp;</td>
      <td bgcolor="DBC7BF"><? echo $w_histdel ?><a href="<? echo  "admin.php?allfilesin=$catename&do=del"  ?>"><img src="downstat_art/del.gif" border="0" ></a> 
      </td>
    </tr>
    <?   
	}// if N&ONeF6     
	if("$catename" == "N&ONeF6" or "$showcategory" == "$catename" or $openall){   
	$spacef='';  
	if("$showcategory" == "$catename" or ($openall && "$catename" !== "N&ONeF6")){ $spacef=' &nbsp &nbsp &nbsp &nbsp '; } 
	   
	 foreach($cate as $filename => $file){
	 
	 if( $file[data][2]){  
	   
	   
	 if($catename == Trash){    
	  
	 $wf_icon='delfile.gif';    
	 $file[ADDED]=$file[data][8];    
	 $wf_box=''; 
	 $num_count='';   
	 $wf_name='';
	   
	 }else{	
	 $wf_box='<input name="box[]" type="checkbox" id="box'.$fi.'"  value="'.$file[POINTER].'" onclick="cchel(this.checked);">';
	$num_count = "<font size=2><strong>".(++$fi)."</strong></font>" ;   
	$wf_name = '<a href="'.tur(editfile).'&editfile='.$file[POINTER].'">';   
	$wf_icon='file.gif';   
	   
	 }//if !Trash
	 if($file[HITS] == 0){ $file[LAST]='No Downloads'; }else{  $file[LAST]= showastime($file[LAST],TIME); 
	  }  
	 $list = fileactions($file[data],$file[POINTER]);
	?>
    <tr onmouseover="this.bgColor='#C1C2CA'" onmouseout="this.bgColor='#F0F0F0'"  bgcolor="F0F0F0"> 
      <td><? echo $num_count ?> </td>
      <td> 
        <?  echo $wf_box ?>
      </td>
      <td><? echo $spacef ?> 
        <?   echo $wf_name  ?>
        <img border=0 src="downstat_art/<? echo $wf_icon ?>" width="15" height="16"> 
        <? echo  $filename ?></a></td>
      <td><? echo $file[HITS] ?></td>
      <td ><? echo $file[LAST] ?></td>
      <td><? echo datezone($file[ADDED]) ?></td>
      <td width="80" bgcolor="#BCCFDE"><? echo  $list['icons'] ?> </td>
      <td width="1" bgcolor="#BCCFDE">&nbsp; </td>
      <td bgcolor="DBC7BF"><? echo  $list['actions'] ?></td>
    </tr>
    <?   
	}// if $file[data][4]  
	}/// foreach file 
	}// if $showcategory == $catename
	}/// foreach cate 
	}/// if $data is not empty 'No downloads'  


if(!empty($days)){
$hday = array_flip($days);
asort($hday);
asort($days);

	?>

    <tr onmouseover="this.bgColor='#C1C2CA'" onmouseout="this.bgColor='#F0F0F0'"  bgcolor="F0F0F0"> 
      <td height="20" colspan="9" class="border3"> <font color="#333333" size="2">You 
        have <? echo words($fls, File,b) ?> with <? echo  words($thits, Hit,b) ?> 
        ::: There has been <? echo words($days[datezone(false,"M jS, Y")], Hit,b) ?> 
        today with <? echo words($days[datezone(time()-86400,"M jS, Y")],Hit,b) ?> 
        yesterday :: Most hits in a day was on <strong><? echo end($hday) ?></strong> 
        with <? echo words(end($days), Hit,b) ?>.<br>
        <?  echo words($hours[datezone(false,"YMJH")],Hit,b) ?> in this hour, <?  echo words($hours[datezone(time()-3600,"YMJH")],Hit,b) ?> last hour.</font></td>
    </tr>
  </table>   

  <? 
}

  if($fi){ ?>   
  <script language="JavaScript">  
  function checkall(){  
  x='0'; 
  while(x < <? echo $fi; ?>){ getid('box'+x).checked=getid('chall').checked;    
  cchel(getid('chall').checked);
  x++;   
   }
    
  } 
    
  				   
				  function cchel(wt){			 
 d='0';  
 xd='none';   
  while(d < <? echo $fi; ?>){
    
if(getid('box'+d).checked==true){    
    
  //document.getElementById('aaa').value+=(d+',');    
  xd='block'; break;    
    
}   
  d++;   
  } 
 getid('boxelements').style.display=xd;   
    
  } 
    
  </script>   
  <? } ?>
  <input name="processbox" type="hidden" id="processbox" value="true">    
</form>  
     <br>
        <? 
}elseif($goto==clearfiles){

if($do){

foreach($lines as $lnenum => $files){
$dr = explode('^^',$files);
if($lnenum != 0 && $lnenum != 1 && $dr[1]){

if($hasband && $dr[3] !== off && $dr[6]){

$ahits=explode('()',$dr[6]);
$dl = explode("|",$dr[3]);

$b_lmt = time()-$dl[1]*$dl[2];  

$hi=0;
$within=0;
while($hi++ < count($ahits) ){

$usr = explode("|",$ahits[$hi]);

if($usr[3]>$b_lmt)$within++;

if($within == $dl[0]){   break;}

}// end loop
}// if $hasband 

if($nodownload  && $dr[6] ){
$overis=false;
$enduser=explode('|',end(explode('()',$dr[6])));
if(time()-$enduser[3] > ($nodays*86400)) $overis=true;
}// if nodownload

if($part){ $pts=''; $pts= strstr(strtolower($dr[$idad]), strtolower($havethis)) ; }


if($allfiles or 
($email && (($hasmail==yes && $dr[4]!==off ) or ($hasmail==no && $dr[4]==off )))  or 
($passch && (($haspass==yes && $dr[5]!==off ) or ($haspass==no && $dr[5]==off )) ) or
($part && (($haspart==yes && $pts ) or ($haspart==no && !$pts ) ) ) or 
$overis or 
($hasband && (($band==yes && $bndt ) or ($band==no && !$bndt ) ) )

 ){

if($do=='history')$dr[6] ='';
if($do=='delete')$dr ='';
if($do=='movetocate'){

$dr[2] =$category;
if($category ==nXew){ $dr[2] =$cataname; }

}// if movetocate
if($do=='cleanboot'){ $dr[6]=$dr[5]=$dr[4]=$dr[3] =''; }
}/// if vars

$lines[$lnenum]= @implode('^^',$dr);

}// if not 0 or 1 lines
}// end of foreach
$input=true;
$w_scess='Files Processed<meta http-equiv="refresh" content="3;URL=admin.php">';
}// if $do

$alertwords['movetrash']= 'Move To Trash';
$alertwords['delete']= 'Delete';
$alertwords['history']='Clear History';
$alertwords['cleanboot']='Clear History & Settings';

?>
        <script language="JavaScript">
function getel(name){ return document.boxform.elements[name] }


var dothis='<? if(!$do)echo $alertwords['history']; else $alertwords[$do] ?>';
var dband='';
var dmail='';
var dpass='';
var dpart='';
var drange='';
var docmd ='';

function commnd(dowhat,comd){
if(dowhat){ dothis=dowhat; }
}// end of function connand

function allfil(){

for(i=0;i<document.boxform.elements.length;i++){ 
if(getel([i]).type=='checkbox' && getel([i]).idi!= 'nop'){getel([i]).disabled=getid('allfild').checked; }

}// end loop

}// end of allfiles() function

function waler(id,vara,extra){

if(getid(id).checked == true){
return vara+extra+"\n"; 

}else{
return '';
}
}

function goprocess(){


wband=waler('hasband',dband,'');
wmail=waler('email',dmail,'');
wpass=waler('pass',dpass,'');
wpart=waler('part',dpart,document.getElementById('partthis').value);
wdown=waler('nodownload',drange,getid('nodays').value+' days');

if(getid('allfild').checked == false){ wafile=' files that are'; }else{  wafile=' all files'; }
var conf =confirm("Do you really want to :::\n"+dothis+wafile+"\n"+wband+wmail+wpass+wpart+wdown);
if(conf){ document.boxform.submit(); }
}

</script>
        <?
if(!$do)$allfiles =true;

$catemenu=catelistmen($catdata);

function checked($name,$value=false,$type=false,$nmeof=true){
global $do,$allfiles;
if($nmeof && (($name && $type !==rd) or ($name && $name == $value)))echo checked;
if((!$do or $allfiles) && $type!==rd)echo 'disabled';
}

?>
      </p>
<form name="boxform" id="boxform" method="post" >
  <table width="464" border="0" align="center" cellpadding="0" cellspacing="0" class="border3">
    <tr> 
      <td colspan="2" bgcolor="#A7A7A7">&nbsp; </td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="F0F0F0">All files that :::<br> <input name="allfiles" type="checkbox" id="allfild" onclick="allfil()" value="true"  idi="nop" <? if($allfiles )echo 'checked' ?>>
        All</td>
    </tr>
    <tr> 
      <td width="235" bgcolor="F0F0F0" class="border4blue"><input name="part" type="checkbox" id="part" value="true"  <? checked($part) ?>>
        <br>
        <input name="haspart" type="radio" onclick="dpart='Has address of '" value="yes" <? checked($haspart,yes,rd,$part) ?>>
        Has as part of the 
        <select name="idad" class="inputbox"  onchange="cateselect(this.options[this.selectedIndex].value,'newcate')">
          <option value="0">ID</option>
          <option value="1">Address</option>
        </select>
        <br>
        <input name="haspart" type="radio" onclick="dpart='Has no address of '" value="no" <? checked($haspart,no,rd,$part) ?>>
        Is not part of the 
        <select name="idad" class="inputbox" onchange="cateselect(this.options[this.selectedIndex].value,'newcate')">
          <option value="0">ID</option>
          <option value="1">Address</option>
        </select>
        <br> <input name="havethis" type="text" class="inputbox" id="partthis" value="<? if($part)echo $havethis ?>" size="10"> 
        <br> <br> <input name="nodownload" type="checkbox" id="nodownload" value="true" onclick="drange='No downloads in '" <? checked($nodownload) ?>>
        No downloads in this amount of days<br> <input name="nodays" type="text" class="inputbox" id="nodays" size="3" value="<? if($nodownload)echo $nodays ?>"> 
        <br> </td>
      <td width="229" bgcolor="F0F0F0" class="border3"><input name="hasband" type="checkbox" id="hasband" value="true"  <? checked($hasband) ?>> 
        <br> <input type="radio" name="band" value="yes" onclick="dband='Over bandwidth'"  <? checked($band,yes,rd,$hasband) ?>>
        The bandwidth limit is up<br> <input name="band" onclick="dband='Not over bandwidth'" type="radio" value="no" <? checked($band,no,rd,$hasband) ?>>
        The bandwidth limit is not up<br> <br> <input name="email" type="checkbox" id="email" value="true"  <? checked($email) ?>> 
        <br> <input name="hasmail" type="radio" value="yes" onclick="dmail='Has email notification'" <? checked($hasmail,yes,rd,$email) ?>>
        Has Email notification <br> <input type="radio" onclick="dmail='Has no email notification'" name="hasmail" value="no" <? checked($hasmail,no,rd,$email) ?>>
        Has No Email notification<br> <br> <input name="passch" type="checkbox" id="pass" value="true" <? checked($passch) ?> > 
        <br> <input type="radio" name="haspass" value="yes" onclick="dpass='Has password'"  <? checked($haspass,yes,rd,$passch) ?>>
        Has Password<br> <input type="radio" name="haspass" onclick="dpass='Has no password'" value="no" <? checked($haspass,no,rd,$passch) ?>>
        Has No Password </td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="F0F0F0"><input name="do" type="radio" value="movetocate" onclick="commnd('Move to Category',false)" <? if($do==movetocate )echo 'checked' ?> >
        Move them to
        <select name="category" class="inputbox" id="category" onchange="cateselect(this.options[this.selectedIndex].value,'newcate')">
		 <? echo $catemenu; ?> 
							  <option value="Trash">Trash Bin</option>
                              <option value="nXew">CREATE NEW</option>
                            </select>
                            <div id="newcate" style="display:none"> 
                              <input name="cataname" type="text" class="inputbox" id="cataname" value="Category Name" onclick="if(this.value=='Category Name'){this.value=''}" size="20">
                            </div><br>
		
		
		 <input name="do" type="radio" onclick="commnd('Delete',false)"  value="delete" <? checked($do,'delete',rd) ?>>
        Delete them <br> <input name="do" type="radio" onclick="commnd('Clear History',false)"  value="history" <? if($do ==history or !$do)echo checked ?>>
        Clear the download history<br>
        <input name="do" type="radio" onclick="commnd('Clear History & Settings',false)"  value="cleanboot" <? checked($do,cleanboot,rd) ?>>
        Clear the download history &amp; file settings<br>
        <br>
        <input type="button" class="inputbox"  value="Go" onclick="goprocess()"> </td>
    </tr>
    <tr> 
      <td colspan="2" bgcolor="#A7A7A7"><? echo $w_scess  ?>&nbsp; </td>
    </tr>
  </table>
</form>
  <?
}elseif($goto == about){ // if goto == clearfiles
?>
<style type="text/css">
<!--
.bordr {
	border: 1px solid #666666;
}
-->
</style>
<table width="659" height="209" border="0" cellpadding="0" cellspacing="0" class="bordr">
  <tr> 
    <td height="19" bgcolor="#A6B4C8" class="bordr"><font size="2"><strong>About 
      Downstat</strong></font></td>
  </tr>
  <tr>
    <td height="188" valign=top bgcolor="#E0E1E9"><br>
      <font size="2">Downstat version 1.7<br>
      Released at November 13th 2005<br>
      With 3,442 lines of HTML Javascript and PHP code.<br>
      <br>
      Developed by <a href="http://vmist.net/scripts"><em>Pineriver</em></a> <br>
      <br>
      Go to the <a href="http://vmist.net/scripts/downstat/manual/manual.php"><em>online 
      manual</em></a> for help getting started.<br>
      If you found a bug or questions go to<em><a href="http://www.vmist.net/scripts/EForum/"> 
      the forums</a><br>
      </em>For comments or about other scripts<em> <a href="mailto:pineriver@vmist.net">email 
      me</a> </em>or go to the<em> <a href="http://www.vmist.net/scripts/">scripts 
      homepage</a><br>
      <br>
      </em></font></td>
  </tr>
</table>


<?
// if  goto == about
}elseif ($goto == logout){
if($brs[12] == NoLogAT  ){
echo "<center>You do not have login enabled <strong>$brs[11]</strong></center><meta http-equiv=\"refresh\" content=\"2;URL=admin.php\">";

}else{
echo "<center>Logging out <strong>$brs[11]</strong></center>";

$brs[11]=' none ';
$lines[1]=implode("^^",$brs);
$input=true;
}
echo "<meta http-equiv=\"refresh\" content=\"2;URL=admin.php\">";
}

endpage();
if($input){   
$fp = @fopen($datafile,"w+")or die ("Please set $datafile for read and write permissions, and then press \"refresh\".");    
for($a=0;$a<count($lines);$a++){  
fputs($fp,"$lines[$a]");
}   
fclose($fp);  
} 

?>
