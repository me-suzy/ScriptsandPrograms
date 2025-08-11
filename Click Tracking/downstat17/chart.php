
<title>Down Stat  Administrative Control</title><body link="44517B" vlink="44517B" alink="44517B"><center><?


if(!@include($art."downstat_art/in_html.php")){ exit("upload ".$art."in_html.php"); }
if(!@include($art."in_php.php")){ exit("upload ".$art."in_php.php"); }


$this_page='http://'.str_replace('chart.php', '', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);

$fd = fopen( $datafile, 'r' )or die ("Please upload $datafile, and then press \"refresh\".");
while( !feof($fd) ){
$lines[]=fgets($fd);
}
fclose($fd);

$brs=explode("^^",$lines[1]);
if($brs[11] !== $ip && $brs[12] !== NoLogAT  ){  exit($errorpage[nologin]); }  
if(!$cate)$lines[$file] or die ("No file data for line : $file");
$br=explode("^^",$lines[$file]);
 
startpage();
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


-->
</style>

<?



echo '<br>';


$timeinput =$brs[0];

if($brs[3] && !$view){  
$thenum=$brs[5];
$whereto=$brs[4];

$view = numrange;
}

               //Start Display function

function DisplayStatPage($datalist){
global $thenum,$view,$domain,$mode,$file,$strdte,$action,$assend,$view,$whereto,$from_day,$from_month,$to_month,$to_day,$year,$fdata,$yearput,$brs,$lookuphost,$br,$databox,$timeinput,$sort,$ud;

if(empty($datalist)){echo "<br><br><center><div class=text><strong>No Results For Your Query, <a href=\"javascript:history.back()\">Go Back</a></strong></div></center>"; exit; }

?>

 
<p align="center"> 

<form  method="post" >
  <table width=856 height="43" border=0 align=center cellpadding=0 cellspacing=1 bordercolor=#003300 bgcolor=#D1D1D1>
    <tr bgcolor="#E8EBEE"> 
      <td  height="8" colspan="3" class=text><center>
          <?  if($assend){  echo '<a href="'.tur('assend').'&mode='.$mode.'">Sort Ascending'; }else{ echo '<a href="'.tur('assend').'&assend=true&mode='.$mode.'">Sort Descending'; } ?>
          <br>
        </center></td>
      <? if($action == lookinto or $year) echo "<td  height=8 class=text> <a href=\"chart.php?file=$file&mode=$mode&lookuphost=$lookuphost\"><strong>Reset</strong></a></td>";  ?>
    </tr>
    <tr bgcolor="#E8EBEE" class=text > 
      <td width="44"  height="21" bgcolor="B37979"><font color="#000000"><strong>View 
        : </strong></font></td>
      <td width="183" bgcolor="#<? if($view == numrange ){ echo 'A0A0A0'; }else{ echo 'C08F8F'; } ?>" id=c1 ><input type="radio" name="view" value="numrange" onclick="setColor('c1', 'c2')" <? if($view == numrange )echo checked; if($action == lookinto)echo 'disabled'; ?>>
        The 
        <select name="whereto" size="1" class="intext" id="whereto" >
          <option <?  if($whereto==First )echo selected ?>>First</option>
          <option <?  if($whereto==Last )echo selected ?>>Last</option>
        </select> <input name="thenum" type="text" class="intext" id="thenum" value="<? echo $thenum ?>" size="4" >
        Entries </td>
      <td width="566"  bgcolor="#<? if($view == daterange ){  $rbutsel =checked; echo 'A0A0A0'; }else{ echo 'C08F8F'; } ?>" id=c2><input type="radio" name="view" value="daterange"  onclick="setColor('c2', 'c1')" <? echo $rbutsel; if($action == lookinto)echo 'disabled'; ?>>
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
          <font size="2"><a href="<? echo tur('sort') ?>&sort=date&mode=<? echo $mode ?>">Date</a></font> 
        </center></td>
      <td><center>
          <font size="2"><? if($mode==host){   if($sort == 'date' && !$assend){ echo "Downloaded Time Table";  }else{  echo "<a href=\"chart.php?file=$file&mode=$mode&lookuphost=$lookuphost&sort=date\">Downloaded Time Table</a>";     }  }else{ ?><a href="<? echo tur('sort') ?>&sort=host&mode=<? echo $mode ?>">Host</a><? } ?></font></center></td>
      <td width=279><center>
          <font size="2">
		  <?
		  
		  if($mode== domain){
		  
		  echo "Page";
		  
		  }else{
		  
		  ?>
		  <a href="<? echo tur('sort') ?>&sort=ref&mode=<? echo $mode ?>">Linked 
          From The Server</a> </font><? } ?> </center></td>
      <td width=86> <div align="center"><a href="<? echo tur('sort') ?>&sort=browser&mode=<? echo $mode ?>">Browser</a></div></td>
    </tr>
	
<?
if($assend)$num = count($datalist);
 	foreach($datalist  as  $fdata){
		
 if($mode== domain){ 
 
 $w_ref="<a href=\"".$fdata['ref']."\">".str_short($fdata['ref'])."</a>";
  }else{ 

	if($fdata['ref'] == ""){ $w_ref='Straight Link'; }else{ 
	$pts=parse_url($fdata['ref']);
	$w_ref='<a href="chart.php?mode=domain&domain='.$pts[host].'&file='.$file.'">'.$pts[host].'';
	}
	}// if not domain mode
	
	$toghost=no;
	if(($host= @gethostbyaddr($fdata['host']))==false or $brs[2]==IP){ $host= $fdata['host']; }
 
	
	$dtea=explode(" ",date("M jS g iA Y",$fdata['date']));

	//$dtea=explode(" ",datezone($fdata['date'],"M jS g iA Y"));   
	
	$tcolor[$sort]='bgcolor="#E3E6EA"';
	?>
	
    <tr bgcolor=#F2F2F2> 
      <td width="31" height="17"><center>
          <strong><?  echo $fdata[pointer]; //if($assend)echo $num--;  else echo 1+$num++ ?></strong></center></td>
      <td width="159" <? echo $tcolor['date'] ?>><div align="center"><a href="<? echo "chart.php?file=$file&domain=$domain&lookuphost=$lookuphost&mode=$mode&action=lookinto&date=".$dtea[0].$dtea[4]."&selectsnt=MY&strdte=M Y"  ?>"><? echo $dtea[0] ?></a> 
          <a href="<? echo "chart.php?file=$file&mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[0].$dtea[1].$dtea[4]."&selectsnt=MjSY&strdte=M Y, jS"  ?>"><? echo $dtea[1] ?></a> 
          <a href="<? echo "chart.php?file=$file&mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[0].$dtea[1].$dtea[2].$dtea[4]."&selectsnt=MjSgY&strdte=Y, jS g:00"  ?>"><? echo $dtea[2] ?></a>:<? echo $dtea[3] ?>
		  <a href="<? echo "chart.php?file=$file&mode=$mode&action=lookinto&lookuphost=$lookuphost&domain=$domain&date=".$dtea[4]."&selectsnt=Y&strdte=Y"  ?>"><? echo $dtea[4] ?></a></div></td>
      <td width="295" <? echo $tcolor['host'] ?>> <div align="center"><?   if($mode==host ){  
	  if( $sort == 'date' && !$assend ){
	  
	  
	 if($ud[$fdata['date']] !== 1)echo showastime($lastdate,$fdata['date'])." From Last Load";
	 
	  }
	    }else{ ?><a href="chart.php?mode=host&lookuphost=<? echo $fdata['host'] ?>&file=<? echo $file ?>" ><?  echo $host; ?></a><? } ?></div></td>
      <td width="279" <? echo $tcolor['ref'] ?>><div align="center"><? echo $w_ref ?>
        </div></td>
      <td width="86" <? echo $tcolor['browser'] ?>> <div align="center"><? echo $fdata['browser'] ?></div></td>
    </tr>
	  	<?  
}/// end of loop
	?>
  </table> </form>
  <?
  
  }//end of function

if($mode == filehistory  or $mode==host or $mode == domain ){

?>


 <script language="JavaScript">
  
  function setColor(id1, id2)
  {
    document.getElementById(id1).bgColor = '#A0A0A0';	
    document.getElementById(id2).bgColor = '#C08F8F';
  }
</script>
	<?  
	
if($view !== daterange)$pass=true;

	$hdata = explode('()',$br[6]);
	$ensd = explode("|",end($hdata));
	
$last=datezone($ensd[3],THROUGH);
$toalhits=$lendnum= count($hdata);

if($thenum >$lendnum)$thenum=$lendnum-1;
if($view == numrange){
if($whereto == First)$lendnum=$thenum;

if($whereto == Last){
$i=$lendnum-$thenum-1; 
 $num=$i;
  }// if last
}
if(!$sort)$sort='date';

$start_d =  mktime(0,0,0,$from_month,$from_day,$year);
$end_d =  mktime(0,0,0,$to_month,$to_day,$year);

$tempyear=date("Y");
	while($i++ < $lendnum ){
	$spu = explode("|",$hdata[$i]);
		
	if(count($spu) > 2){
	
	if($tempyear !== $yeadate){
	$yeadate=$tempyear;
	$yearput .="<option>$tempyear</option>\n";
	}
	if($mode == domain){
	$ptr=parse_url($spu[0]);
	}// if mode id domain
	if($mode == filehistory or ($mode == host && $lookuphost == $spu[1]) or ($mode == domain && $domain == $ptr[host] )  ){
		
$spu[3]= datezone($spu[3],"THROUGH");  
	
if($view == daterange)$pass=false;
if($view == daterange && $spu[3] > $start_d  && $spu[3] < $end_d){$pass=true; }

if($action == lookinto)$pass=false;
if($action == lookinto && $date == date("$selectsnt",$spu[3])){  $pass= true;  }

if($mode == host){ $databox['thisbrowser']=$spu[2]; $ud[$spu[3]]=++$iiud; }
if(!$bow[$spu[2]]){
 
if($bs >= 1)$seport = ' ,';
$bs++;
$bow[$spu[2]]=true;
$databox['browsers'] .= $seport.$spu[2]; }
 
if($pass){

$datalist[$i]['pointer']=$i;

if($sort == 'date'){

$datalist[$i]['date']=$spu[3];
$datalist[$i]['ref']=$spu[0];
$datalist[$i]['host']=$spu[1];
$datalist[$i]['browser']=$spu[2];


}else{

$datalist[$i]['ref']=$spu[0];
$datalist[$i]['host']=$spu[1];
$datalist[$i]['browser']=$spu[2];
$datalist[$i]['date']=$spu[3];
}
}
}// if modes 
}// if count > 2 
}//end user while loop

function comparar($a, $b) {
global $sort;
       return strnatcasecmp($a["$sort"], $b["$sort"]);
}
@usort($datalist, "comparar");  

$datanon=$datalist;
if($assend) @arsort($datalist);  



$lstd=@end($datalist);
if($action == lookinto or $view && $year){

if($view == daterange){ 
$watlook = "Between <strong>".date("F \\t\h\\e jS",$start_d)."</strong> and <strong>".date("F \\t\h\\e jS",$end_d)."</strong> of $year";
}else{
$watlook = " at <strong><font color=darkblue>".date($strdte,$lstd['date'])."</font></strong>"; 
$w_string ="[<a href=\"global.php?mode=filehistory&action=$action&selectsnt=$selectsnt&date=$date&strdte=$strdte\"> GLOBAL ".strtoupper(date($strdte,$lstd['date']))."</a>]";
}
if($view == numrange)$watlook=" The <strong>$whereto $thenum</strong> Entries";


$w_tot='[TOTAL RESULTS]';
}else{ 

$enddata = end($datanon);
$w_string= "[LAST DOWNLOADED] <strong>".showastime($last)."</strong> [TOTAL HITS] <strong>$toalhits</strong> [BROWSERS] <strong>".$databox['browsers']."</strong>";
}// if !lookinto

$databox['fileid']=$br[0];

echo "</center><strong>You Are Here ::: <a href=\"global.php?mode=filehistory\">All File History</a> \ <a href=\"chart.php?mode=filehistory&file=$file\">File History</a> \ ";

if($mode==host){
echo "<a href=\"chart.php?mode=host&lookuphost=$lookuphost&file=$file\">Host History</a> \ ";
}elseif ($mode == domain){

echo "<a href=\"chart.php?mode=domain&domain=$domain&file=$file\">Domain History</a> \ ";
}/// if modes
if($view == daterange)echo "Lookup Dates \ ";
if($view == numrange)echo "Limited Results \ ";
if($action == lookinto)echo "Viewing By Date \ ";
echo '</strong><center>';
if($mode == filehistory){

?>

<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td bgcolor="#DBDDE3">Downloaded History of <strong><? echo $br[0] ?></strong> <? echo $watlook ?></td>
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
    <td  bgcolor="#DBDDE3">Downloaded History of <strong><a href="<? echo "chart.php?mode=filehistory&file=$file" ?>"><?  echo $br[0] ?></a></strong> by <strong><? echo $whost ?></strong> <? echo $watlook ?></td>
  </tr>
  <tr> 
      <td colspan="2">[IP] <strong><? echo $lookuphost ?></strong> [LAST BROWSER 
        USED] <strong><? echo $databox['thisbrowser'] ?></strong> [<a href="global.php?mode=host&lookuphost=<? echo $lookuphost ?>">GLOBAL HOST LOOKUP</a>] </td>
  </tr>
</table>
<?
DisplayStatPage($datalist);  

}elseif ($mode==domain){
?>
<table width="904" border="0" cellpadding="0" cellspacing="0" class="text">
  <tr> 
    <td  bgcolor="#DBDDE3"> History of <strong><a href="<? echo "chart.php?mode=filehistory&file=$file" ?>"><?  echo $br[0] ?></a></strong> from <strong><? echo $domain ?></strong> <? echo $watlook ?></td>
  </tr>
  <tr> 
      <td colspan="2">[<a href="global.php?mode=domain&domain=<? echo $domain ?>">GLOBAL DOMAIN LOOKUP</a>] 
      </td>
  </tr>
</table>
<?
DisplayStatPage($datalist); 

}// lookuphost

}elseif ($mode == getcode){

$usrs = explode("()",$br[6]);
$end = explode("|",end($usrs));

?>


<!--Begin Show website code -->
<script language="JavaScript">
function process(){
sour = document.getElementById('input').value;
string=document.getElementById('preview').innerText=sour.replace('@H',"<? echo words(count($usrs)-1,Time) ?>").replace('@F',"<? echo $br[1] ?>").replace('@I',"<? echo $br[0] ?>").replace('@L',"<? echo showastime($end[3]) ?>");

document.getElementById('code').innerText=sour;

}//end of process function
</script>
   <form name="form" method="post" action="">
    <strong> 
    <div align="center"><br>
      Website Code</div>
    </strong>
    <div align="center"><br>
      <br>
      <table width="40%" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="49" bgcolor="#F7F7F9"> <center>
              <font size="2"> You can include information about a file in any 
              webpage. Just copy and paste the javascript code into the source 
              of the page.<br>
              </font></center></td>
        </tr>
      </table>
      <br>
      <table width="40%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td bgcolor="#D8D8D8"><div align="center"><font size="2">Preview</font></div></td>
        </tr>
        <tr> 
          <td height="85" bgcolor="#F7F7F9"><center>
              <font size="2"><br>
              <a id="preview"><? echo "$br[0] has been downloaded ".words(count($usrs)-1,Time).""; ?></a></font></center> 
            &nbsp;</td>
        </tr>
        <tr> 
          <td height="9">&nbsp;</td>
        </tr>
        <tr> 
          <td height="15" bgcolor="#D8D8D8"><div align="center"><font size="2">Javascript 
              Generator </font></div></td>
        </tr>
        <tr> 
          <td height="28" bgcolor="#F7F7F9"><p><font color="#8D0E0E" size="2">Use 
              this to genorate the javascript code that you place in the webpage</font> 
            </p>
            <p><font size=2>&quot;@H&quot; is used to show how many times downloaded<br>
              &quot;@F&quot; is used to show the file address.<br>
              &quot;@I&quot; is used to show the file ID</font><br>
              <font size="2">&quot;@L&quot; is used to show the how long since 
              the last download</font><br>
              <br>
              <center>
                <input name="textfield" type="text" size="40" id="input" value="@I has been downloaded @H" style="font-size: 11px;" onkeyup="process()">
              </center>
            </p></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="15" bgcolor="#D8D8D8"><div align="center"><font size="2">Javascript 
              Code</font></div></td>
        </tr>
        <tr> 
          <td height="101" bgcolor="#F7F7F9"><font color="#8D0E0E" size=2>&lt;script 
            language=&quot;JavaScript&quot; src=&quot;<? echo $this_page."include.php?id=$br[0]&string=" ?><a id=code>@I 
            has been downloaded @H</a>&quot;&gt;&lt;/script&gt; </font> </td>
        </tr>
      </table>
      <br>
    </div>
  </form>
  <div align="center"></p> 
    <?
  }elseif ($mode == listcode){
  ?>
  </div>
  <form name="inbox" method="post" >
    <div align="center">
      <table width="409" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td width="409" height="49" bgcolor="#F7F7F9"> <div align="center"><font size="2"><strong>Get 
              Inform Box</strong> for <strong><? echo $cate ?></strong><br>
              You can have a list of all files within a category show up on a 
              webpage, sorted by date added, last downloaded, number of hits, 
              alphabetical file address/file id. Just map out the inform box by 
              the controls below, then copy and paste the javascript code into 
              your webpage.<br>
              </font></div></td>
        </tr>
      </table>
      <br>
      <table width="394" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="394" bgcolor="#D8D8D8"><div align="center"><font size="2">Preview</font></div></td>
        </tr>
        <tr> 
          <td height="72" bgcolor="#F7F7F9"><center>
              <font size="2"><br>
			  
			  
              <? if($sored)echo stripslashes($jcode); else echo '  <script language="JavaScript" id=prev src="'.$this_page.'include.php?m=inbox&c='.$cate.'&sorted=downloaded&arang=asend&ent=10&sc=true&flformat=@I"></script>';  ?>
              </font> 
            </center>
            <font size="2"> <br>
            <a href="javascript:document.inbox.submit()">Update Preview</a></font></td>
        </tr>
        <tr> 
          <td height="9">&nbsp;</td>
        </tr>
        <tr> 
          <td height="15" bgcolor="#D8D8D8"><div align="center"><font size="2">Controls</font></div></td>
        </tr>
        <tr> 
          <? $strr= $this_page."include.php?m=inbox&c=$cate" ?>
          <script language="JavaScript">

function getid(id){
return document.getElementById(id);
}
function process(){

stri= '<? echo $strr ?>'+'&sorted='+getid('sorted').options[getid('sorted').selectedIndex].value+'&arang='+getid('aranged').options[getid('aranged').selectedIndex].value+'&ent='+getid('entries').value+'&flformat='+getid('flformat').value+'&sc='+getid('sc').checked+'&hyper='+getid('hyper').checked;
getid('code').innerText ='<script language="JavaScript" src="'+stri+'"></'+'script>';  

}

</script>
          <td height="14" bgcolor="#F7F7F9" class="text"><font size="2"><br>
            How would you like </font>the list of files to be sorted ? <br> <select name="sored"  id="sorted" onchange="process()">
              <option value="added" <? if($sored==added)echo selected ?>>Date 
              added</option>
              <option value="downloaded" <? if($sored==downloaded)echo selected ?>>Last 
              Downloaded</option>
              <option value="hits" <? if($sored==hits)echo selected ?>>Number 
              of hits</option>
              <option value="adrs" <? if($sored==adrs)echo selected ?>>File Address</option>
              <option value="id" <? if($sored==id)echo selected ?>>File ID</option>
            </select> <br>
            How would you like the list to be arranged?<br> <select name="sm"  id=aranged onchange="process()">
              <option value="asend" <? if($sm==asend)echo selected ?>>Sort Ascending</option>
              <option value="desend" <? if($sm==desend)echo selected ?>>Sort Descending</option>
            </select> <br>
            Display 
            <input name="entries" id="entries" type="text" size="2" maxlength="2" value="<? if($sorted) echo $entries; else echo 10;  ?>" onchange="process()">
            Entries<br> <br> <input name="sc" type="checkbox" id="sc" value="true" <? if($sc or !$sorted)echo checked ?> onclick="process()">
            Show Category 
            <input name="hyper" type="checkbox" id="hyper" value="true" <? if($hyper)echo checked ?> onclick="process()">
            Hyperlink Files <br> </td>
        </tr>
        <tr> 
          <td height="14" bgcolor="#F7F7F9" class="text"><font size=2>&quot;@H&quot; 
            is used to show how many times downloaded<br>
            &quot;@F&quot; is used to show the file address.<br>
            &quot;@I&quot; is used to show the file ID</font><br> &quot;@A&quot; 
            is to show the file date added<br> <font size="2">&quot;@L&quot; is 
            used to show the how long since the last download</font> <br>
            File display format 
            <input name="flformat" type="text" id="textfield2" onKeyUp="process()" value="<? if($flformat)echo $flformat; else echo  '@F' ?>" size="20" maxlength="20"> 
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td height="15" bgcolor="#D8D8D8"><div align="center"><font size="2">Javascript 
              Code</font></div></td>
        </tr>
        <tr> 
          <td height="101" bgcolor="#F7F7F9"><div align="center"><font color="#2D3844"> 
              <textarea name="jcode" cols="50"  onFocus="this.select()" rows="4" wrap="VIRTUAL" class="text" id=code><? 
	  if($sorted){     
			  if($jcode) echo stripslashes($jcode); else echo 'No Data'; 			  
			  }else{
			  echo '<script language="JavaScript" src="'.$this_page.'include.php?m=inbox&c='.$cate.'&sorted=downloaded&arang=asend&ent=10&sc=true&flformat=@I"></script>'; 
 }
			  ?></textarea>
              </font></div></td>
        </tr>
      </table>
    </div>
  </form>
  <?

  }/// if mode is elseif 
  endpage();
  
   ?>
</center>
