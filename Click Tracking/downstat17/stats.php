<?  
   
if(!@include($art."downstat_art/in_html.php")){ exit("upload ".$art."in_html.php"); } 
if(!@include($art."in_php.php")){ exit("upload ".$art."in_php.php"); }  

 if(!$viewyear)$viewyear= date(Y);


$fd = fopen( $datafile, 'r' )or die ("Please upload $datafile, and then press \"refresh\".");
$i=0;
$number=0;
if($limit){
$start_d =  mktime(0,0,0,$from_month,$from_day,$year);
$end_d =  mktime(0,0,0,$to_month,$to_day,$year);
}

while( !feof($fd) ){
$line=fgets($fd);

$br = explode("^^",$line);
if($i==1){  $brs=$br;  list($timeinput,$sntxin,$iphost,$alwaysdisplay,$whereto,$thenum)=$br;  }


$linepointer[$br[0]]=$i;

if(count($br)>2 && $i > 1){

$hdata = explode("()",$br[6]);
foreach($hdata as $userdata){
$spu = explode("|",$userdata);
if(count($spu) > 1){
$cc++;

$spu[3]=datezone($spu[3],"THROUGH");

$year=date("Y",$spu[3]);
$month=date("F",$spu[3]);
$day=date("jS",$spu[3]);
$week=date("W",$spu[3]);

if($mode==lookupdate){

if(date($keycode, $spu[3]) == $keyword){

$u=parse_url($spu[0]);
if($spu[0])$rr=$u[host];

if($rr)$dates[ref][$rr]++;
$downloads[]=$spu[3].'&^&'.$spu[1].'&^&'.$br[0];
$days[$day]++;
$allfiles[$br[0]]++;
$browsers[$spu[2]]++;

$users[$spu[1]]++;


}// if unix date keycode range

}elseif($mode == search ){


$tempyear=date("Y",$spu[3]);
	if(!$tempyr[$tempyear]){
	$yeadate=$tempyear;
	if($tempyear == $year or(!$year && date(Y) == $tempyear))$sy='selected';
	$yearput .="<option $sy>$tempyear</option>\n";
	$tempyr[$tempyear]=true;
	}

if((($what == usIP && $userpart==$spu[1] && $ov=$spu[1] ) or ($what == usREF && strstr($spu[0], $userpart) && $ov=$spu[0] ) or ($what == usBWSER && strtoupper($userpart)== strtoupper($spu[2])  && $bv=true && $ov=$spu[2])) ){


if(($spu[3]> $start_d && $spu[3]< $end_d ) or !$limit){


if(($lookintrash) or ($br[2] !== Trash)){

$number++;
$pointers[$br[0]]=$i;
$query[$ov]=$spu;

if($spu[3]>$vdate && $userpart == $spu[1]){
$lastfile=$br[0];
$vdate=$spu[3];
}

if($spu[3]>$busvar && $bv){
$busvar=$spu[3];
}

$userpass=true;
}// limit
}// if trash
}// if ()
}else{// if mode

$file[$year][$month][$br[0]]++;
$weeks[$year][$month][$week]++;
$days[$year][$month][$day]++;
$date[$year][$month]++;
$undate[$year][$month][$spu[1]]++;

}//if mode
}//if br
}//end of foreach loop

if($mode == search && $what){

if( !$userpass &&    (   

($what ==partfile &&  @strstr(strtolower($br[$filewhat]), @strtolower($partfield))  ) or
($what ==thathave && ( ( $band && $br[3] && $br[3]!==off ) or ( $email && $br[4] && $br[4]!==off )  or ( $password && $br[5] && $br[5]!==off ))  )
or
($what ==filesdont && ( ( $band && !$br[3] or $br[3]==off ) or ( $email && !$br[4] && $br[4]!==off )  or ( $password && $br[5] && $br[5]!==off ))  )
or $userpass)
 ){


if(($lookintrash) or ($br[2] !== Trash)){

$pointers[$br[0]]=$i;
$query[$br[0]]=$br;
}// if trash
}// if ()
}// if mode == search
}// if data spu
$i++;
}// end floop
fclose($fd);

if($brs[11] !== $ip && $brs[12] !== NoLogAT  ){  exit($errorpage[nologin]); }  


$cfiles=$file[$viewyear];
$cday=$days[$viewyear];
$cmu=$undate[$viewyear];
$clmth=$date[$viewyear];
$cweeks= $weeks[$viewyear];

?>

<p>  

<style type="text/css">
<!--
.barborder {
	border-top-style: none;
	border-right-style: none;
	border-left-style: solid;
	border-top-color: #333333;
	border-right-color: #333333;
	border-bottom-color: #333333;
	border-left-color: #333333;
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
}

.bmder {
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-right-style: solid;
	border-bottom-style: solid;
	border-top-color: #333333;
	border-right-color: #333333;
	border-bottom-color: #333333;
	border-left-color: #333333;
	font-size: 11px;
}
.barlevel {
	background-color: #8293B3;
	border: 1px solid #666666;
}
.borders {
	border: 1px solid #000000;
}
-->
</style>

<?
startpage();

if($mode == lookupdate){  

?>


<style type="text/css">
<!--
.boxborders {
	border: 2px solid #71789B;
	font-size: 12px;
}


.boxtexted {
	font-size: 11px;
	font-family: Georgia, "Times New Roman", Times, serif;
}
-->
.linenums {
	font-size: 12px;
	color: #999999;
	letter-spacing: 1px;
	font-weight: 500;
}

</style>

<p>&nbsp;</p><table width="712" border="0" align="center" cellpadding="0" cellspacing="0" class="borders">
  <tr> 
    <td width="626" bgcolor="#B0B6CE"><div align="center"><font color="#000000"><font size=2> 
        Rundown of</font> <strong><? echo $mwords ?></strong></font></div></td>
  </tr>
  <tr> 
    <td bgcolor="#DBE3F0" class=menu ><div align="center"><a href="#rs">Referrals</a> 
        - <a href="#ld">Downloads</a> - <a href="#dm">Days</a> - <a href="#fm">Files</a> 
        - <a href="#bws">Browsers</a> - <a href="#usr">Users</a></div></td>
  </tr>
  <tr> 
    <td bgcolor="#F7F7F9"><p><br>
      </p>
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders">
        <tr> 
          <td width="631" bgcolor="#A4A9BF"><div align="center"><font color="#FFFFFF" size="2">Referral 
              Stats<a name="rs"></a></font></div></td>
        </tr>
        <tr> 
          <td bgcolor="#BC7B70"><font color="#FFFFFF" size="2">&nbsp<? 
	
		  $Rtotal=count($dates[ref]);
		  
		   if($Rtotal!==0){ 
		   
		            
		 $refnumber=$dates[ref]; 
		  arsort($refnumber);
		   echo words($Rtotal,'Total site',b);
		   if($Rtotal > 10) echo ", Showing <strong>$Rtotal</strong> out of <strong>$Rtotal</strong> sites,";
		  
		   }else{
		   echo "<center>No Sites</center>";
		   }// if count == 0
		   ?>
           </font></td>
        </tr>
        <tr> 
          <td bgcolor="#FFFFFF" class="boxtexted"> 
            <? 
			if(!empty($refnumber)){ 
			$ri=1;;
			foreach($refnumber as  $Rsite=>$Rhits){
			if($ri ==11)break;
			
            echo '<a class=linenums>'.$ri.'</a> &nbsp '.words($Rhits,Download,b)." from <a href=\"global.php?mode=domain&domain=$Rsite\">$Rsite</a><br>"; 
			$ri++;
			}
			}// if empty
			 ?>
            </td>
        </tr>
      </table> <br> 
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders" >
        <tr bgcolor="#A4A9BF" > 
          <td colspan="3"><div align="center"><font color="#FFFFFF" size="2">Downloads<a name="ld" id="ld"></a></font></div></td>
        </tr>
        <tr> 
          <td height="15" colspan="3" bgcolor="#BC7B70" ><font color="#FFFFFF" size="2">&nbsp <?
		  
		  if(empty($downloads)){echo "<center>No Downloads</center>"; }else{ 
		  $Dtotal=count($downloads);
		  echo "<strong>$Dtotal</strong> Total downloads";
		  if($Dtotal > 20) echo ", Showing the last <strong>20</strong> out of <strong>$Dtotal</strong>";
		   
		   }// if downloads
		  ?></font></td>
        </tr>
        <?
		
		
		@arsort($downloads);

		$idi=1;
		if(!empty($downloads)){
		foreach($downloads as $num => $ipp){
		if($idi ==21)break;
		
		list($dte,$iadd,$file)=explode('&^&',$ipp);
		
		?>
        <tr > 
          <td width="179" bgcolor="#FFFFFF"><a class=linenums><? echo $idi ?></a> &nbsp <strong> <a href="chart.php?file=<? echo $linepointer[$file] ?>&mode=filehistory"><? echo str_short($file,30) ?></a></strong> 
            
            </td>
          <td width="248" bgcolor="#FFFFFF"> 
             <? if(date($keycode,$dte) == Oct.$viewyear)echo datezone($dte,false,true).' - <em>'.showastime($dte).'</em>'; else echo datezone($dte,false,true); ?>
            
          </td>
          <td width="204" bgcolor="#FFFFFF"> 
<?  echo getip($iadd) ?>
             
          </td>
        </tr>
        <?
		$idi++;
		}// end of loop
		}//if !empty downloads
		?>
      </table>
      <br>
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders">
        <tr bgcolor="#A4A9BF"> 
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2">Days 
              in <? echo $mwords ?><a name="dm" id="dm"></a></font></div></td>
        </tr>
        <tr> 
          <td height="15" colspan="2" bgcolor="#BC7B70"><font color="#FFFFFF" size="2">&nbsp 
		  <?
		 
		$hitdays = $days;
		  @asort($hitdays);
         $hitdays=array_flip($hitdays);

		  if(empty($days))echo "<center>No Days</center>"; else echo 'Total days that had downloads <strong>'.count($days).'</strong>, the most downloads that occurred was on the <strong>'.end($hitdays).'</strong>';
		  ?></font>
		  </td>
        </tr>
		
		
		<?
		
		if(!empty($days)){

		array_values($days);

		foreach($days as $dname => $dnum){
		
		if($dname.$keyword == date("jSMY"))$w_pr="Today the <strong>$dname</strong> has "; else $w_pr="The <strong>$dname</strong> had ";
		?>
        <tr> 
          <td width="354" height="10"> 
            <? echo $w_pr."<a href=\"global.php?mode=filehistory&action=lookinto&date=".$keyword.$dname."&selectsnt=MYjS&strdte=M%20Y,%20jS&cate=&\">".words($dnum,download,b)."</a>"; ?><br>
           
            </td>
          <td width="277"><img src="downstat_art/c_blue.gif" width="<? echo  round(($dnum /array_sum($days) ) * 200);  ?>" height="9"></td>
        </tr>
		<?  
		}//end of loop
		}/// if !empty days
		?>

      </table>
      <br>
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders">
        <tr bgcolor="#A4A9BF"> 
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2">Files 
              <a name="fm" id="fm"></a></font></div></td>
        </tr>
        <tr> 
          <td height="15" colspan="2" bgcolor="#BC7B70"><font color="#FFFFFF" size="2">&nbsp 
            <?
		 


		  if(empty($allfiles))echo "<center>No Files</center>"; else echo 'Total files <strong>'.count($allfiles).'</strong>, total downloads <strong>'.array_sum($allfiles).'</strong>';
		  ?>
            </font> </td>
        </tr>
        <?
		
		if(!empty($allfiles)){
		arsort($allfiles);
		$ifi=0;
		foreach($allfiles as $Fname => $Fnum){
		
		?>
        <tr> 
          <td width="355" height="10"><a class=linenums><? echo ++$ifi ?></a> &nbsp <strong><? echo $Fname ?></strong><br> 
          </td>
          <td width="276"><? echo "<a href=\"chart.php?file=$ifi&mode=filehistory\">".words($Fnum,download,b)."</a>"; ?></td>
        </tr>
        <?  
		}//end of loop
		}/// if !empty days
		?>
      </table>
      <br>
	  
	  
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders">
        <tr bgcolor="#A4A9BF"> 
          <td colspan="3"><div align="center"><font color="#FFFFFF" size="2">Browsers 
              in <? echo $mwords ?><a name="bws" id="bws"></a></font></div></td>
        </tr>
        <tr> 
          <td height="15" colspan="3" bgcolor="#BC7B70"><font color="#FFFFFF" size="2">&nbsp 
            <?
		 if(empty($browsers))echo "<center>No Browsers</center>"; else echo 'Total browsers used <strong>'.count($browsers).'</strong>';
		  ?>
            </font> </td>
        </tr>
        <?
		
		if(!empty($browsers)){
		arsort($browsers);
		$ibi=0;

		foreach($browsers as $Bname => $Bnum){
		
		?>
        <tr> 
          <td width="35" height="10"> &nbsp <a class=linenums><? echo ++$ibi ?></a> 
             <br>
            </td>
          <td width="319">
            <div align="center"><strong> 
              <?  echo $Bname ?>
              </strong></div>
          </td>
          <td width="277"><? echo $Bnum ?> <img src="downstat_art/c_blue.gif" width="<? echo  round(($Bnum /array_sum($browsers) ) * 200); ?>" height="9"></td>
        </tr>
        <?  
		}//end of loop
		}/// if !empty days
		

		?>
      </table>
      <br>
      <table width="631" border="0" align="center" cellpadding="0" cellspacing="0" class="boxborders">
        <tr bgcolor="#A4A9BF"> 
          <td colspan="2"><div align="center"><font color="#FFFFFF" size="2">Users 
              in <? echo $mwords ?><a name="usr" id="usr"></a></font></div></td>
        </tr>
        <tr> 
          <td height="15" colspan="2" bgcolor="#BC7B70"><font color="#FFFFFF" size="2">&nbsp 
            <?
		 if(empty($users)) echo "<center>No Users</center>"; else  echo 'Total Users <strong>'.count($users).'</strong>';
		  if(count($users) > 20 ) echo " Showing <strong>20</strong> out of <strong>".count($users)."</strong>";
		  ?>
            </font> </td>
        </tr>
        <?
		
		if(!empty($users)){
		arsort($users);
		$iui=0;

		foreach($users as $Uname => $Unum){
		if($iui == 21)break;
		?>
        <tr> 
          <td width="304" height="10"><a class=linenums><? echo ++$iui ?></a> 
            &nbsp 
           <a href="global.php?mode=host&lookuphost=<? echo $Uname ?>"> <strong><? if($iphost == IP){echo $Uname; }else{ if(!($wip= @gethostbyaddr($Uname)))$wip=$Uname;  echo $wip;  } ?></strong></a>
           
            </td>
          <td width="327"> <?  echo $Unum ?> <img src="downstat_art/c_blue.gif" width="<? echo  round(($Unum /array_sum($users) ) * 200); ?>" height="9"></td>
        </tr>
        <?  
		}//end of loop
		}/// if !empty days
		?>
      </table>
      <p>&nbsp;</p>
      </td>
  </tr>
</table>

<?

}elseif($mode == search){
?>
<style type="text/css">
<!--
.textsearch {
	font-size: 12px;
}
.inputfield {
	font-size: 12px;
	background-color: #E6E6E6;
}
-->
</style>

<form name="form1" method="post" action="">
  <table width="732" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#D8DBDE" class="textsearch" >
    <tr> 
      <td colspan="8" bgcolor="#B0B9C8">Search For </td>
    </tr>
    <tr> 
      <td colspan="4" bgcolor="#C5ABAB"><p>Files<br>
        </p></td>
      <td width="20" bgcolor="#EBEBEB">&nbsp;</td>
      <td width="271" bgcolor="#E2C6A7">Users </td>
      <td width="4" rowspan="5">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="4" bgcolor="#E4E4E4"><input name="what" type="radio" value="partfile" <?  check($what, partfile) ?>>
        Part of the 
        <select name="filewhat" class="inputfield" id="filewhat">
          <option value="0">Adress</option>
          <option value="1" <? if($filewhat == 1)echo selected ?> >ID</option>
        </select>
        is 
        <input name="partfield" type="text" class="inputfield" id="partfield" value="<? echo $partfield ?>" size="20"> 
        <br> </td>
      <td width="20" rowspan="4" bgcolor="#F8F8F8"><br> </td>
      <td rowspan="4" bgcolor="#F0EEE8"><input name="what" type="radio" value="usIP" <?  check($what, usIP) ?>>
        Where IP Addi is<br> <input name="what" type="radio" value="usREF" <?  check($what, usREF) ?>>
        Where part of referral site is<br> <input name="what" type="radio" value="usBWSER" <?  check($what, usBWSER) ?>>
        Where Browser is<br> <input name="userpart" type="text" class="inputfield" id="userpart" value="<? echo $userpart ?>" size="20"></td>
    </tr>
    <tr > 
      <td colspan="4" bgcolor="#F8F8F8">&nbsp;</td>
    </tr>
    <tr > 
      <td colspan="4" bgcolor="#E2E7E4"><input name="what" type="radio" value="thathave" <? check($what, thathave) ?>>
        All files that have 
        <input name="what" type="radio" value="filesdont" <?  check($what, filesdont) ?>>
        All files that dont have </td>
    </tr>
    <tr> 
      <td colspan="4" bgcolor="#DCDADA"><input name="band" type="checkbox" id="band" value="true" <?  check($band,true ) ?>>
        Banwidth Limit | 
        <input name="email" type="checkbox" id="email" value="true" <?  check($email,true ) ?>>
        Email Notifacation | 
        <input name="password" type="checkbox" id="password" value="true" <?  check($password,true ) ?>>
        Password </td>
    </tr>
    <tr> 
      <td colspan="8" bgcolor="#F8F8F8">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="8"><input name="limit" type="checkbox" id="limit" value="true" <?  check($limit,true ) ?>>
        Limit results by ...<br>
        After 
        <select name="from_month" class="inputfield">
          <option <? selected(1,$from_month); ?> value=1>[1] January 
          <option <? selected(2,$from_month); ?> value=2>[2] February 
          <option <? selected(3,$from_month); ?> value=3>[3] March 
          <option <? selected(4,$from_month); ?> value=4>[4] April 
          <option <? selected(5,$from_month); ?> value=5>[5] May 
          <option <? selected(6,$from_month); ?> value=6>[6] June 
          <option <? selected(7,$from_month); ?> value=7>[7] July 
          <option <? selected(8,$from_month); ?> value=8>[8] August 
          <option <? selected(9,$from_month); ?> value=9>[9] September 
          <option <? selected(10,$from_month); ?> value=10>[10] October 
          <option <? selected(11,$from_month); ?> value=11>[11] November 
          <option <? selected(12,$from_month); ?> value=12>[12] December </select> 
        <select name="from_day" class="inputfield">
          <?
		$FD="-1";
		while($FD++ < 30){
		$s='';
		if((date("j") == $FD+1 && !$from_day) or $from_day == $FD)$s=selected; 

		echo "<option value=\"$FD\" $s>".date("jS",($FD*86400)+946702800)."</option>\n";
		}
		?>
        </select>
        and Before 
        <select name="to_month" class="inputfield">
          <option <? selected(1,$to_month) ?> value=1>[1] January 
          <option <? selected(2,$to_month) ?> value=2>[2] February 
          <option <? selected(3,$to_month) ?> value=3>[3] March 
          <option <? selected(4,$to_month) ?> value=4>[4] April 
          <option <? selected(5,$to_month) ?> value=5>[5] May 
          <option <? selected(6,$to_month) ?> value=6>[6] June 
          <option <? selected(7,$to_month) ?> value=7>[7] July 
          <option <? selected(8,$to_month) ?> value=8>[8] August 
          <option <? selected(9,$to_month) ?> value=9>[9] September 
          <option <? selected(10,$to_month) ?> value=10>[10] October 
          <option <? selected(11,$to_month) ?> value=11>[11] November 
          <option <? selected(12,$to_month) ?> value=12>[12] December </select> 
        <select name="to_day" class="inputfield">
          <?
		$FD="-1";
		while($FD++ < 30){
		$s='';
		if((date("j") == $FD && !$to_day) or $to_day == $FD)$s=selected; 

		echo "<option value=\"$FD\" $s>".date("jS",($FD*86400)+946702800)."</option>\n";
		}
		
		
		?>
        </select>
        of Year 
        <select name="year" size="1" class="inputfield" >
          <? echo $yearput  ?> </select></td>
    </tr>
    <tr> 
      <td colspan="8" bgcolor="F0F0F0"><input name="lookintrash" type="checkbox" id="lookintrash" value="true" <?  check($lookintrash,true ) ?>>
        Look in trash bin<br> <input type="submit" name="Submit" value="Submit"> 
      </td>
    </tr>
  </table>
    <?
	if($what){ 
	if(empty($query)){ echo "<p>&nbsp;</p><center><strong>No Search Results</strong></center>";  }else{ 

if($userpass){

if($what ==usIP){
$td[1][title]='User Address';
$td[2][title]='Downloaded';
$td[3][title]='Last Downloaded File & Date';
}

if($what == usREF){
$td[1][title]='Site';
}

if($what == usBWSER){
$td[1][title]='Browser Name';
$td[2][title]='Loads';
$td[3][title]='Last Used';
}

}else{
	$td[1][title]='File Id';
	$td[2][title]='Hits';
	$td[3][title]='Last Downloaded';
	$td[4][title]='Date Added';
	$td[5][title]='&nbsp;';
}// if userpass


?>


  <p>&nbsp;</p><table width="818" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#F5F7FA" class=textsearch>
    <tr> 
      <td colspan="6" bgcolor="#9A9AAD"><div align="center"><strong><font color="#FFFFFF">Search 
          Results</font> </strong></div></td>
    </tr>
    <tr> 
      <? if($td[1]){ ?><td width="170" height="19" bgcolor="#B4BBCF"><? echo $td[1][title] ?></td><? } ?>
      <? if($td[2]){ ?><td width="57" bgcolor="#B4BBCF"><? echo $td[2][title] ?></td><? } ?>
      <? if($td[3]){ ?><td width="166" bgcolor="#B4BBCF"><? echo $td[3][title] ?></td><? } ?>
      <? if($td[4]){ ?><td width="207" bgcolor="#B4BBCF"><? echo $td[4][title] ?></td><? } ?>
      <? if($td[5]){ ?><td width="93" bgcolor="#86A8C4">&nbsp;</td><? } ?>
     <? if($td[5]){ ?> <td width="125" bgcolor="#C6A79B">&nbsp;</td><? } ?>
    </tr>
	<? 
	
	
	foreach($query  as $ddt){
	
	if($userpass){
	
if($what ==usIP){
$td[1][inner]= getip($ddt[1]);
$td[2][inner]= words($number,Time).' &nbsp; &nbsp; &nbsp; &nbsp;';
$td[3][inner]=$lastfile." - <em>".showastime($vdate,true).'</em>';
}
if($what == usREF){
$td[1][inner]="<a href=\"$ddt[0]\">$ddt[0]</a>";
}

if($what == usBWSER){
$td[1][inner]=$ddt[2];
$td[2][inner]=$number;
$td[3][inner]=showastime($busvar);
}



	}else{ // else if !$userpass
	
	$list=fileactions($ddt,$linepointer[$ddt[0]]);
	
	$td[1][inner]="<a href=\"admin.php?editfile=".$linepointer[$ddt[0]]."\">$ddt[0]</a>";
	
	$loads=explode('()',$ddt[6]);

$hhttss= count($loads)-1;
if($hhttss)$hhttss="<a href=\"chart.php?file=".$linepointer[$ddt[0]]."&mode=filehistory\">$hhttss</a>";
	$td[2][inner]=$hhttss;
	
	$td[4][inner]= datezone($ddt[7]);
	
	if($ddt[6]){
	$end=explode('|',end($loads));
	
	$td[3][inner]=showastime($end[3],true);
	}else{ $td[3][inner]='No Downloads'; } // if hits

	
    $td[5][inner]=$list['icons'];
    $td[6][inner]=$list['actions'];

	}// if !$userpass
	
	?>
	
    <tr> 
      <? if($td[1]){ ?><td><? echo $td[1][inner] ?></td><? } ?>
      <? if($td[2]){ ?><td><? echo $td[2][inner] ?></td><? } ?>
      <? if($td[3]){ ?><td><? echo $td[3][inner] ?></td><? } ?>
      <? if($td[4]){ ?><td><? echo $td[4][inner] ?></td><? } ?>
      <? if($td[5]){ ?><td bgcolor="#E2E6E9"><? echo $td[5][inner] ?></td><? } ?>
     <? if($td[5]){ ?><td bgcolor="#F4F3F2"><? echo $td[6][inner] ?></td> <? } ?>
    </tr>
	
  
  <?
  }// foreach loop
  echo '</table>';
  }//if what
  }// if empty
  
  ?>
</form>

  <?

 }else{// if no mode
 


echo '<br><center><div class=menu>';

if(!empty($file)){
 if(count($file) !== 1) echo ' Jump To The Year ';

foreach($file as $y =>$yara ){
$str1=$str2=$h1=$h2=false;

if($viewyear == $y ){

echo " :: <b><font color=#824A4A>$y</font></b> ";

 }else{

echo ':: <a href="stats.php?viewyear='.$y.'">'.$y.'</a> ';
}
}// end of loop
}// if empty files

echo '</center>';

?></div>
  <br>
  <?
if(!$cc){ echo 'No dowloads yet, come back in a little while to see these stats.'; }else{
?>
</p>
<table width="687" border="0" align="center" cellpadding="5" cellspacing="0" >
  <tr> 
    <?

	
	
	for($cm=0;$cm<12;$cm++){
	$titlemonth=date("F",(2629743.83*$cm)+1106745375);
	$KeyDate=date("M",(2629743.83*$cm)+1106745375).$viewyear;
	if($clmth[$titlemonth])$mon_colors= array('#5C6694','#333399','#BACDE0'); else $mon_colors= array('#B8BED3','#B4B7D6','#EAECEC');
	
	
	?>
         
	<td width="143"><table width="129" height="119" border="0" cellpadding="0" cellspacing="2" bgcolor="#FFFFFF" class="bmder">
        <tr> 
          <td height="19" colspan="2" bgcolor="<? echo $mon_colors[0] ?>"><font color="#FFFFFF" size="2"><center><? if($clmth[$titlemonth])echo "<a href=\"stats.php?mode=lookupdate&keycode=MY&keyword=$KeyDate&mwords=$titlemonth $viewyear\"><font color=white>$titlemonth</font></a>"; else echo $titlemonth  ?>
            </center></font></td>
        </tr>
        <tr> 
          <td height="81" colspan="2">
		  <?
		  $per=1;
		  if($clmth[$titlemonth]){

		  $hits=$clmth[$titlemonth];
		  
		  			$per= round(($hits /$cc) * 100);		  
		  
		  ?>
		  <a href="global.php?domain=&lookuphost=&mode=filehistory&action=lookinto&date=<? echo $KeyDate ?>&selectsnt=MY&strdte=M%20Y"><? echo words($hits,'Total download',bold); ?></a> <br>
          <? echo words(count($cmu[$titlemonth]),'Unique download',bold) ?>  <br>
            Ave hits per day <b><?  echo round($hits/count($cday[$titlemonth])); ?></b><br>
            Ave hits per week <b><?  echo round($hits/count($cweeks[$titlemonth])); ?></b> <br>
            <?  echo 'Files downloaded <b>'.count($cfiles[$titlemonth]).'<b>';  ?> <br>
			<?

			}else{
			echo '<center>No Downloads<center>';
			
			}//if month doent have downloads
			
			?>	
			 </td>
        </tr>
        <tr class="barborder"> 
          <td width="<? echo $per ?>%" height="10" bgcolor="<? echo $mon_colors[1] ?>" ></td>
          <td bgcolor="<? echo $mon_colors[2] ?>" class="barborder"></td>
        </tr>
      </table></td>
	<?
	if($cm == 5)echo '</tr><tr>';
	}// end of cm for() lopp
	
	?>
  </tr>
</table>
<?
}// if $cc
}// if mode
endpage();
?></p>