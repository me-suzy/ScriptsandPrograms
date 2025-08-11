 <?
   
if(!@include($art."downstat_art/in_html.php")){ exit("upload ".$art."in_html.php"); } 
if(!@include($art."in_php.php")){ exit("upload ".$art."in_php.php"); }

 
 ?>
 
 
 
<style type="text/css">
<!--
.text {
	font-size: 12px;
}
.intext {
	background-color: #F8F9FA;
	font-size: 10px;
	border-top-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #666666;
	border-right-color: #666666;
	border-bottom-color: #666666;
	border-left-color: #666666;
}

.intextun {
	background-color: #D0ACAC;
	font-size: 10px;
	color: #BA8585;
	border: 0px none #C08F8F;
}
.unnamed1 {
}

-->
</style>
<title>Down Stat Administrative Control</title>
<body link="44517B" vlink="44517B" alink="44517B"><?

$start_d =  mktime(0,0,0,$from_month,$from_day,$year);
$end_d =  mktime(0,0,0,$to_month,$to_day,$year);


function DisplayStatPage($datalist){
global $cate,$ut,$end_d,$start_d,$thenum,$view,$domain,$mode,$file,$strdte,$action,$assend,$view,$whereto,$from_day,$from_month,$to_month,$to_day,$year,$fdata,$yearput,$brs,$lookuphost,$br,$databox,$timeinput,$sort;

if(empty($datalist)){echo "<br><br><center><div class=text><strong>No Results For Your Query, <a href=\"javascript:history.back()\">Go Back</a></strong></div></center>"; exit; }


?>
<p align="center"> 
<form  method="post" >
  <table width=856 height="43" border=0 align=center cellpadding=0 cellspacing=1 bordercolor=#003300 bgcolor=#D1D1D1>
    <tr bgcolor="#E8EBEE"> 
      <td  height="8" colspan="3" class=text><strong>Jump To ::: </strong> <a href="global.php?mode=filehistory"> All File History </a>
          <br>
       </td>
	   
      <? 
	  
	  
	  if($action == lookinto or $year) echo "<td  height=8 class=text> <a href=\"global.php?mode=$mode&lookuphost=$lookuphost&cate=$cate\"><strong>Reset</strong></a></td>";  ?>
      
    </tr>
    <tr bgcolor="#E8EBEE" class=text > 
      <td width="44"  height="21" bgcolor="B37979"><font color="#000000"><strong>View 
        : </strong></font></td>
      <td width="183" bgcolor="#<? if($view == numrange){ echo 'A0A0A0'; }else{ echo 'C08F8F'; } 
	  ?>" id=c1 ><input type="radio" name="view" value="numrange" onclick="setColor('c1', 'c2')" <? if($view == numrange)echo checked; if($action == lookinto)echo 'disabled'; ?>>
        The 
        <select name="whereto" size="1" class="intext" id="whereto" >
          <option <?  if($whereto==First)echo selected ?>>First</option>
          <option <?  if($whereto==Last)echo selected ?>>Last</option>
        </select> <input name="thenum" type="text" class="intext" id="thenum" value="<? echo $thenum ?>" size="4" >
        Entries </td>
      <td width="566"  bgcolor="#<?  if($view == daterange ){  $rbutsel =checked; echo 'A0A0A0'; }else{ echo 'C08F8F'; } ?>" id=c2><input type="radio" name="view" value="daterange"  onclick="setColor('c2', 'c1')" <? echo $rbutsel; if($action == lookinto)echo 'disabled'; ?>>
        Entries After 
        <select name="from_month" class="intext">
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
        <select name="from_day" class="intext">
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
        <select name="to_month" class="intext">
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
        <select name="to_day" class="intext">
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
        <select name="year" size="1" class="intext" >
          <? echo $yearput  ?> </select></td>
      <td width="58" bgcolor="B37979"><div align="center"> 
          <input name=mode type=hidden value=<? echo $mode ?>>
          <? if($action !== lookinto ){ ?>
          <input name="Submit" type="submit" class="intext" value="Query" style="background-color: #C0C0C0;">
          <? } ?>
        </div></td>
    </tr>
  </table>
  <table width=856 height="37" border=0 align=center cellpadding=0 cellspacing=1 bordercolor=#003300 bgcolor=#D1D1D1 class="text">
    <tr bgcolor="#B0C4D9"> 
      <td width=31 height="17"></td>
      <td width=159><center>
          <font size="2"><a href="<? echo tur('sort') ?>&sort=date&mode=<? echo $mode."&cate=$cate&"; ?>">Date</a></font> 
        </center></td>
      <td><center>
          <a href="<? echo tur('sort') ?>&sort=file&mode=<? echo $mode."&cate=$cate&"; ?>">File 
          </a> 
        </center></td>
      <td width=283><center>
          <font size="2"> 
          <? if($mode==host){   if($sort == 'date' && !$assend){ echo "Downloaded Time Table";  }else{  echo "<a href=\"global.php?mode=$mode&lookuphost=$lookuphost&sort=date&cate=$cate\">Downloaded Time Table</a>";     }  }else{ ?>
          <a href="<? echo tur('sort') ?>&sort=host&mode=<? echo $mode."&cate=$cate"; ?>">Host</a> 
          <? } ?>
          </font> 
        </center></td>
      <td width=175> <div align="center"><font size="2"> 
          <?
		  
		  if($mode== domain){
		  		  echo "Page";
		  
		  }else{
		  
		  ?>
          <a href="<? echo tur('sort') ?>&sort=ref&mode=<? echo $mode ?>">Linked 
          From The Server</a> </font>
          <? } ?>
        </div></td>
    </tr>
	
<?
$i=0;
$lendnum= count($datalist);



if($brs[3]){ 

$whereto =$brs[4];
$thenum=$brs[5];
$view =numrange;
}


if($thenum >$lendnum){$thenum=$lendnum-1; }
if($view == numrange){
if($whereto == First){  $lendnum=$thenum; }
if($whereto == Last){
$i=$lendnum-$thenum-2; 


$num=$i;
 }
 }


for($im=$i;$im<$lendnum;$im++){

	$fdata=$datalist[$im];
	
	if($fdata['file']){
		
$pts=parse_url($fdata['ref']);	
 if($mode== domain){ 
 $w_ref="<a href=\"".$fdata['ref']."\">".str_short($fdata['ref'],30,true)."</a>";
  }else{ 
	if($fdata['ref'] == ""){ $w_ref='Straight Link'; }else{ 
	$w_ref='<a href="global.php?mode=domain&domain='.$pts[host].'">'.$pts[host].'</a>';
	}// if ref
	}// if not domain mode
	
	$toghost=no;
	if(($host= @gethostbyaddr($fdata['host']))==false or $brs[2]==IP) $host= $fdata['host']; 
	$dtea=explode(" ",date("M jS g iA Y",$fdata['date']));
	$tcolor[$sort]='bgcolor="#E3E6EA"';
	
	
	?>
	
    <tr bgcolor=#F2F2F2> 
      <td width="31" height="17"><center>
          <strong><? echo 1+$num++ ?></strong></center></td>
      <td width="159" <? echo $tcolor['date'] ?>><div align="center"><a href="<? echo "global.php?domain=$domain&lookuphost=$lookuphost&mode=$mode&action=lookinto&cate=$cate&date=".$dtea[0].$dtea[4]."&selectsnt=MY&strdte=M Y"  ?>"><? echo $dtea[0] ?></a> 
          <a href="<? echo "global.php?mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[0].$dtea[1].$dtea[4]."&selectsnt=MjSY&strdte=M Y, jS&cate=$cate&"  ?>"><? echo $dtea[1] ?></a> 
          <a href="<? echo "global.php?mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[0].$dtea[1].$dtea[2].$dtea[4]."&selectsnt=MjSgY&strdte=Y, jS g:00&cate=$cate&"  ?>"><? echo $dtea[2] ?></a>:<? echo $dtea[3] ?>
		  <a href="<? echo "global.php?mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[4]."&selectsnt=Y&strdte=Y&cate=$cate&"  ?>"><? echo $dtea[4] ?></a></div></td>
      <td width="202" <? echo $tcolor['file'] ?>> <div align="center"><? if($fdata['Trash'] == Trash){  echo "<font color=#666666>".$fdata['file']." <em>(In Trash)</em></font>"; }else{   ?><a href="chart.php?file=<? echo $fdata['pointer'] ?>&mode=filehistory"><? echo $fdata['file'];  ?></a> <? } // if !Trash ?></div></td>
      <td width="283" <? echo $tcolor['ref'] ?>><div align="center">
          <?   if($mode==host ){  
	  if( $sort == 'date' && !$assend ){
	  $dtt=$fdata['date'];


	if($ut[$dtt] !== 0)echo showastime($lastdate,$fdata['date'])." From Last Load";
	  $lastdate=$dtt;
	  }
	    }else{ ?>
          <a href="global.php?mode=host&lookuphost=<? echo $fdata['host'] ?>" >
          <?  echo $host; ?>
          </a>
          <? } ?>
        </div></td>
      <td width="175" <? echo $tcolor['browser'] ?>> <div align="center"><? echo $w_ref ?></div></td>
    </tr>
	  	<?  
		 
		
		}/// if is here 
		$i++;
		
}/// end of loop

	?>
  </table> </form>
      <?
	  
	 
  }//end of function

$this_page='http://'.str_replace('chart.php', '', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$fd = fopen( $datafile, 'r' )or die ("Please upload $datafile, and then press \"refresh\".");
while( !feof($fd) ){

$lines[]=fgets($fd);
}
fclose($fd);


$brs=explode("^^",$lines[1]);

if($brs[11] !== $ip && $brs[12] !== NoLogAT  ){  exit($errorpage[nologin]); }  

startpage();

$timeinput =$brs[0];
?>
      <script language="JavaScript">

  
  function setColor(id1, id2)
  {
    document.getElementById(id1).bgColor = '#A0A0A0';	
    document.getElementById(id2).bgColor = '#C08F8F';
  }
</script> 
      <?

$br=explode("^^",$lines[$file]);

echo '<p>&nbsp;</p>';
?>
      <?

if(!$sort)$sort='date';

# Start Data 

$il=1;
$ddii=0;
$i=1;

while(count($lines) > $lii++){
$br = explode("^^",$lines[$lii]);
if(count($br)>2 && $lii > 1){
$hdata = explode("()",$br[6]);
foreach($hdata as $userdata){
$spu = explode("|",$userdata);


$spu[3]= datezone($spu[3],"THROUGH");  

if(count($spu) > 2){

$tempyear=date("Y",$spu[3]);
	if(!$tempyr[$tempyear]){
	$yeadate=$tempyear;
	if($tempyear == $year or(!$year && date(Y) == $tempyear))$sy='selected';
	$yearput .="<option $sy>$tempyear</option>\n";
	$tempyr[$tempyear]=true;
	}


	if($mode == domain){
	$ptr=parse_url($spu[0]);
	}// if mode id domain
	
if($mode == filehistory or ($mode == host && $lookuphost == $spu[1]) or ($mode == domain && $domain == $ptr[host] ) or ($mode==categoryhistory && $cate==$br[2])){


if($mode == host && $lookuphost == $spu[1]){
$pass=true;
$databox['thisbrowser']=$spu[2]; 
$ut[$spu[3]]=$ddii;
$ddii++;
}
if($mode==categoryhistory && $cate==$br[2])$pass=true;


if($mode == domain && $domain == $ptr[host])$pass=true;


if($view == daterange ) $pass=false; 
if( $view == numrange) $pass=true; 


if($view == daterange && $spu[3] > $start_d  && $spu[3] < $end_d){$pass=true;  }

if($action == lookinto)$pass=false;
if($action == lookinto && $date == date("$selectsnt",$spu[3])){  $pass= true;  }


if(!$bow[$spu[2]]){

if($bs >= 1)$seport = ' ,';
$bs++;
$bow[$spu[2]]=true;
$databox['browsers'] .= $seport.$spu[2]; }

if($mode == filehistory && !$action && !$year)$pass=true;

if($pass){

$datalist[$il]['pointer']=$i;
$datalist[$il]['Trash']=$br[2];

if($sort == 'date'){

$datalist[$il]['date']=$spu[3];
$datalist[$il]['ref']=$spu[0];
$datalist[$il]['host']=$spu[1];
$datalist[$il]['file']=$br[0];


}else{

$datalist[$il]['ref']=$spu[0];
$datalist[$il]['host']=$spu[1];
$datalist[$il]['file']=$br[0];
$datalist[$il]['date']=$spu[3];
}/// if sort

$il++;

}// if pass
}// if modes and == ! && 
}// if spu > 1
}// end of foreach user loop
}//if br > 2

$i++;
}//end of while loop


#End data


function comparar($a, $b) {
global $sort;
       return strnatcasecmp($a["$sort"], $b["$sort"]);
}
@usort($datalist, "comparar");  
$datanon=$datalist;

$lstd=@end($datalist);
if($action == lookinto or $view && $year){

if($view == daterange){ 
$watlook = "Between <strong>".date("F \\t\h\\e jS",$start_d)."</strong> and <strong>".date("F \\t\h\\e jS",$end_d)."</strong> of $year";
}else{
$watlook = " at <strong><font color=darkblue>".date($strdte,$lstd['date'])."  </font></strong>"; 
$w_string ="[TOTAL RESULTS] <strong>".count($datalist)."</strong>";
}// if daterange

if($view == numrange)$watlook=" The <strong>$whereto $thenum</strong> Entries";
$w_tot='[TOTAL RESULTS]';
}else{ 
$enddata =@end($datanon);
if(!empty($datalist))$w_string= "[LAST DOWNLOAD] <strong>".showastime($enddata['date'])."</strong> [TOTAL HITS] <strong>".count($datalist)."</strong> [BROWSERS] <strong>".$databox['browsers']."</strong>";
}// if !lookinto


echo "</center><strong>You Are Here ::: <a href=\"global.php?mode=filehistory\">All File History</a> \ ";


if($mode==host){
echo "<a href=\"chart.php?mode=host&lookuphost=$lookuphost&file=$file\">Host History</a> \ ";
}elseif ($mode == domain){

echo "<a href=\"chart.php?mode=domain&domain=$domain&file=$file\">Domain History</a> \ ";
}elseif ($mode == categoryhistory){

echo "<a href=\"global.php?mode=categoryhistory&cate=$cate\">Catagory</a> \ ";

}/// if modes

if($view == daterange)echo "Lookup Dates \ ";
if($view == numrange)echo "Limited Results \ ";
if($action == lookinto)echo "Viewing By Date \ ";

echo '</strong><center>';

if($mode == filehistory){

?>


<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td bgcolor="#DBDDE3"><strong>Viewing ::: </strong> All History <strong><? echo $br[0] ?></strong> <? echo $watlook ?></td>
  </tr>
  <tr> 
    <td colspan="2"><? echo $w_string ?>
    </td>
  </tr>
</table>

<?

DisplayStatPage($datalist); 
}elseif ($mode==host){
 
if(($whost= @gethostbyaddr($lookuphost))==false or $brs[2]==IP){ $whost= $lookuphost; }
?>  <br>
</p>
<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td  bgcolor="#DBDDE3"><strong>Viewing ::: </strong> Downloaded History <strong><a href="<? echo "global.php?mode=filehistory" ?>"><?  echo $br[0] ?></a></strong> by <strong><? echo $whost ?></strong> <? echo $watlook ?></td>
  </tr>
  <tr> 
    <td colspan="2">[IP] <strong><? echo $lookuphost ?></strong> [LAST BROWSER 
      USED] <strong><? echo $databox['thisbrowser'] ?></strong> 
    </td>
  </tr>
</table>
<?
DisplayStatPage($datalist);  

}elseif ($mode==domain){
?>
<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td  bgcolor="#DBDDE3"><strong>Viewing ::: </strong>  History of <strong><a href="<? echo "global.php?mode=filehistory" ?>"><?  echo $br[0] ?></a></strong> from <strong><? echo $domain ?></strong> <? echo $watlook ?></td>
  </tr>
  <tr> 
    <td colspan="2">
    </td>
  </tr>
</table>
<?
DisplayStatPage($datalist); 


}elseif ($mode == categoryhistory){

?>
<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td  bgcolor="#DBDDE3"> History of all files in <strong><? echo $cate  ?></a> <? echo $watlook ?></td>
  </tr>
  <tr> 
      <td colspan="2">
      </td>
  </tr>
</table>

<?
DisplayStatPage($datalist);
}// lookuphost

endpage();

?>