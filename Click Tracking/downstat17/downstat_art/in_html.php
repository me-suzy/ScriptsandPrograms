<?
$script_version ='1.7';
$art = 'downstat_art/'; 
$datafile= $art."database.php";

$input=false;
$page=substr($_SERVER[SCRIPT_NAME], strrpos($_SERVER[SCRIPT_NAME], '/') + 1);
$pages = array("About"=>"admin.php?goto=about","Update Downstat"=>"http://www.vmist.net/scripts/check_version.php?script=downstat&current=17","Logout"=>"admin.php?goto=logout","Admin"=>"admin.php","Search"=>"stats.php?mode=search","Settings"=>"admin.php?goto=settings","Stats"=>"stats.php" );


function main_menu(){
global $pages;
$mm.='<style type="text/css">
.menu {
	font-family: "Courier New", Courier, mono;
	font-size: 12px;
	font-weight: 500;
}
</style>'; 

$mm .='<div class=menu ><center>';
foreach($pages as $text => $href){

if($href)$mm.='<a href="'.$href.'">'; 
$mm.= $text;
if($href)$mm.='</a>';  
$mm.= ' : : ';
}// end of loop
$mm.='</center></div>';
echo $mm;
}//end function


function tur($exclude){
global $_GET,$adpath,$page,$mode;
$str="$page?";
global $editfile,$deletefile;

if($editfile == $deletefile)$deletefile=false;
foreach($_GET as $key => $val ){ 

if(setupcate !== $key && $exclude !== $key && allfilesin !== $key &&  clearhist !== $key &&  restore !== $key && del !== $val && delhist !== $key && del !== $key && deletefile !== $key && $do !== $key && $mode !== $val){ $str .="&$key=$val"; } } return $str;
}//}


function startpage(){
global $brs;
?>
<style type="text/css"> 
<!--
.boxblewchadow {   
	font-size: 12px;  
	background-color: #9FACBB;  
	border-top: 2px none #858585;    
	border-right: 2px solid #858585; 
	border-bottom: 2px solid #858585;
	border-left: 2px none #858585;   
} 
.art {   
	background-image: url(downstat_art/titlebar.jpg);    
	background-repeat: no-repeat;    
}   
.rtext { 
	font-family: Georgia, "Times New Roman", Times, serif;    
	font-size: 11px;  
	color: #FFFFFF;   
	font-weight: 400; 
	font-variant: normal;  
}   
.title { 
	font-size: 11px;  
	color: #000000;   
	font-weight: 600; 
	font-family: Verdana, Arial, Helvetica, sans-serif;  
	letter-spacing: 1px;   
}   
.border1 {    
	background-color: #F0F0F0;  
	border: 1px solid #666666;  
}   
.border2 {    
	background-color: #E3E3DF;  
	border: 1px solid #999999;  
}   
.subtons {    
	font-size: 12px;  
	background-color: #C2CCCF;  
	color: #000000;   
}   
.inputbox {   
	font-size: 11px;  
}   
.border3 {    
    font-size: 12px;    
	background-color: #98A5C2;  
	border: 1px solid #666666;  
}   
.border4blue {
    font-size: 12px;    
	background-color: #F0F0F0;  
	border: 1px solid #A4A4A4;  
}   
.border4 {    
	background-color: #E6E6E6;  
	border: 1px solid #333333;  
}   
--> 
</style>
<style type="text/css">
<!--
.lightpagearea {
	background-color: #F8F8F8;
	padding-top: 5px;
	padding-bottom: 5px;
	border-top: 1px #D8DEE0;
	border-right: 1px outset #D8DEE0;
	border-bottom: 1px outset #D8DEE0;
	border-left: 1px #D8DEE0;
}
-->
</style>
<body link="#000099" vlink="#000099" alink="#000099">

<table  align="center" cellpadding="0" cellspacing="0" background="downstat_art/titlebar.jpg" class="art">
  <tr>   
    <td width="297" height="19" class="rtext">&nbsp<? echo datezone(false,"M jS, Y") ?> </td>   
    <td width="355" class="title">Downstat 1.7</td>   
    <td width="210" class="rtext"><font color="#333333"><? if($brs[11])  echo 'Login from : <strong>'.$brs[11]; else echo "Welcome";  ?></strong></font></td> 
  </tr>  
  <tr>   
    <td  colspan="3" class="border1">


<?
main_menu();
}//end of start page
function endpage(){
?>
	</td>
  </tr>  
</table> <? } ?>