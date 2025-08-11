<!--
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.0 Beta		   				     //          
//		Released February 2, 2004		     				 //
//		Copyright (c) 2004 By the X7 Group	    			 //
//		Website: http://www.x7chat.com		     			 //
//							   							     //
//		This program is free software.  You may	     		 //
//		modify and/or redistribute it under the	    		 //
//		terms of the included license as written    		 //
//		and published by the X7 Group.		    			 //
//							   							     //
//		By using this software you agree to the	    		 //
//		terms and conditions set forth in the	    		 //
//		enclosed file "license.txt".  If you did     		 //
//		not recieve the file "license.txt" please    	     //
//		visist our website and obtain an official    		 // 
//		copy of X7 Chat.		           				     //
//							    							 //
//		Removing this copyright and/or any other    		 //
//		X7 Group or X7 chat copyright from any	    		 //
//		of the files included in this distribution  		 //
//		is forbidden and doing so will terminate    		 //
//		your right to use this software.	     			 //
//							     							 //
///////////////////////////////////////////////////////////////
-->
<script language="javascript" type="text/javascript">

function txtnormal(){
document.cbform.italic.checked = false
document.cbform.bold.checked = false
}
function txtitalic(){
document.cbform.normal.checked = false
}
function txtbold(){
document.cbform.normal.checked = false
}
function txtlined(){
}
function txtglow(){
}
function smclick(smileyCode){
currentvalue=window.parent.frames['left_bot'].document.cbform.msg.value
newvalue=currentvalue + smileyCode
window.parent.frames['left_bot'].document.cbform.msg.value=newvalue
}
function smclick2(smileyCode){
document.cbform.msg.style.color=smileyCode
document.cbform.txtcolor.value=smileyCode
document.cbform.tlcd.style.background="#"+smileyCode
}

function ttup(evt,id){
hi = parseInt(evt.pageY)+8
bye = parseInt(evt.pageX)+9

document.getElementById(id).style.visibility='visible'
document.getElementById(id).style.top=hi
document.getElementById(id).style.left=bye
}
function ttdown(evt,id){
document.getElementById(id).style.visibility='hidden'
}

function popUserMenu(evt,id){
popUpAddr = document.getElementById(id).style
if(document.all){
	popUpAddr.pixelTop = parseInt(evt.y)+2
	popUpAddr.pixelLeft = parseInt(evt.x)+5
}else{
	popUpAddr.top = parseInt(evt.pageY)+2
	popUpAddr.left = parseInt(evt.pageX)+5

}
popUpAddr.visibility='visible'
}

function sinkUserMenu(evt,id){
document.getElementById(id).style.visibility='hidden'
}

</script> 
<style type="text/css">
.tt{
background: <?=$CS[1]?>;
color: <?=$CS['FONTLT']?>;
border: 1px solid <?=$CS[3]?>;
visibility: hidden;
position: absolute;
top: 60;
left: 34;
}
</style>
<?
print("
<span class=\"tt\" id=\"tt1\">$txt[198]</span>
<span class=\"tt\" id=\"tt2\">$txt[199]</span>
<span class=\"tt\" id=\"tt3\">$txt[200]</span>
<span class=\"tt\" id=\"tt5\">$txt[201]</span>
<span class=\"tt\" id=\"tt4\">$txt[202]</span>
<span class=\"tt\" id=\"tt7\">$txt[203]</span>
<span class=\"tt\" id=\"tt6\">$txt[204]</span>
<span class=\"tt\" id=\"tt8\">$txt[205]</span>
<span class=\"tt\" id=\"tt9\">$txt[206]</span>
<span class=\"tt\" id=\"tt10\">$txt[207]</span>
<span class=\"tt\" id=\"tt11\">$txt[208]</span>
<span class=\"tt\" id=\"tt12\">$txt[209]</span>
<span class=\"tt\" id=\"tt14\">$txt[210]</span>
<span class=\"tt\" id=\"tt13\">$txt[211]</span>
");
?>
