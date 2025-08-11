<?php  ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>EzChatbox Admin Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="ez.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript">
<!--
var nodes = new Array();
var text = new Array();
var tumble = new Array();
var maxsize = 0;
var count = 0;

function Is(){ 
  this.ver=navigator.appVersion;
  this.agent=navigator.userAgent;
  this.dom=document.getElementById?1:0;
  this.opera5=this.agent.indexOf("Opera 5")>-1;
  this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0; 
  this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
  this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
  this.ie=this.ie4||this.ie5||this.ie6;
  this.mac=this.agent.indexOf("Mac")>-1;
  this.safari = (this.ver.indexOf("Safari")>-1 && this.dom)?1:0; 
  this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0; 
  this.ns4=(document.layers && !this.dom)?1:0;
  this.bw=(this.ie6||this.ie5||this.ie4||this.ns4||this.ns6||this.opera5);
  return this;
}

var is = new Is();

function spin() {
	var root = document.getElementsByTagName('span').item(0);
	if(is.dom && !(is.mac && (is.ie || is.safari))) godeep(root);
	root.style.visibility = 'visible';
	if(is.dom && !(is.mac && is.ie)) sponge();
	}

function finished() {
	nodes = null;
	text = null;
	tumble = null;
	}

var chartype = Math.floor(Math.random()*2);

function digit() {
	if(chartype == 0)
		return Math.floor(Math.random()*2);
	else if(chartype == 1)
		return '_';
	else
		return ' ';
	}

var reg = new RegExp ("\r|\n", "g");
function haschars(s) {
	s = s.replace(reg,'');
	return s.length;
	}
	
function godeep(o) {
	for (var i = 0; i < o.childNodes.length; i++) {
		if(o.childNodes[i].childNodes) {
			godeep(o.childNodes[i]);
			}
	  if(o.childNodes[i].nodeName == '#text' && haschars(o.childNodes[i].nodeValue)) {
	  	var p = nodes.length;
			nodes[p] = o.childNodes[i];
			text[p] = o.childNodes[i].nodeValue;//new Array();
			tumble[p] = new Array();
			for(var u = 0; u < o.childNodes[i].nodeValue.length; u++) {
				tumble[p][u] = u;
				}
			if(o.childNodes[i].nodeValue.length > maxsize) {
				maxsize = o.childNodes[i].nodeValue.length;
				}
			tumble[p].sort(randomSort);
			o.childNodes[i].nodeValue = '';
			}
		}
	}

function randomSort(w1,w2) {
	return Math.floor(Math.random()*3)-1;
	}

function sponge() {
	for (var i = 0; i < nodes.length; i++) {
		if(count < tumble[i].length) {
    	nodes[i].nodeValue += digit(1);
    	}
    }
 	count++;
 	if(count < maxsize) {
  	setTimeout('sponge()',20);
  	}
 	else {
 		count = 0;
  	setTimeout('unsponge()',350);
  	}
	}

function repchar(str, ch, pos) {
	var out = '';
	for(var i = 0; i < str.length; i++) {
		if(i == pos) out += ch;
		else out += str.charAt(i);
		}
	return out;
	}

function unsponge() {
	for (var i = 0; i < nodes.length; i++) {
		if(count <= tumble[i].length) {
    	nodes[i].nodeValue = repchar(nodes[i].nodeValue, text[i].charAt(tumble[i][count]), tumble[i][count]);
    	}
		}
  count++;
  if(count < 10) setTimeout('unsponge()',30);
	else if(count < maxsize) setTimeout('unsponge()',5);
	else finished();
	}
window.onload = spin;
</script>
</head>

<body>
<?php
$action = $_GET['action'];
if($action == "ban")
{
?>
<center>
<div id="top"><a href="index.php"><img src="Images/logo-big.gif" alt="EZChatbox Logo" name="logo" width="790" height="144" border="0" id="logo" /></a></div>
<div id="main">
  <div id="main-doc" align="left">
	<div align="center" id="right"><a href="http://sourceforge.net"><img src="http://sourceforge.net/sflogo.php?group_id=117233&amp;type=1" alt="SourceForge.net Logo" width="88" height="31" border="0" class="spacing" /></a><br />
	  <a href="http://sourceforge.net/donate/index.php?group_id=117233"><img src="http://images.sourceforge.net/images/project-support.jpg" alt="Support This Project" width="88" height="32" border="0" class="spacing" /></a><br />
      latest news from EzChatBox <a href="http://sourceforge.net/export/rss2_projnews.php?group_id=117233"><img src="http://images.sourceforge.net/images/xml.png" alt="RSS Feed Available" width="36" height="14" border="0" class="spacing" /></a></div>
	<br>
	<?php include("banned.ban"); ?>
  </div>
	<div class="copywrite" align="center"><span>EzChatBox 2004 - CW Enterprises</span></div>
</div>
</center>
<?php
}
elseif ($action == "history")
{
?>
<center>
<div id="top"><a href="index.php"><img src="Images/logo-big.gif" alt="EZChatbox Logo" name="logo" width="790" height="144" border="0" id="logo" /></a></div>
<div id="main">
  <div id="main-doc" align="left">
	<br>
	<?php include("iplist.html"); ?>
  </div>
	<div class="copywrite" align="center"><span>EzChatBox 2004 - CW Enterprises</span></div>
</div>
</center>
<?php
}
else
{
?>
<center>
<div id="top"><a href="index.php"><img src="Images/logo-big.gif" alt="EZChatbox Logo" name="logo" width="790" height="144" border="0" id="logo" /></a></div>
<div id="main">
  <div id="main-doc" align="left">
	<div align="center" id="right"><a href="http://sourceforge.net"><img src="http://sourceforge.net/sflogo.php?group_id=117233&amp;type=1" alt="SourceForge.net Logo" width="88" height="31" border="0" class="spacing" /></a><br />
	  <a href="http://sourceforge.net/donate/index.php?group_id=117233"><img src="http://images.sourceforge.net/images/project-support.jpg" alt="Support This Project" width="88" height="32" border="0" class="spacing" /></a><br />
      latest news from EzChatBox <a href="http://sourceforge.net/export/rss2_projnews.php?group_id=117233"><img src="http://images.sourceforge.net/images/xml.png" alt="RSS Feed Available" width="36" height="14" border="0" class="spacing" /></a></div>
		<br>
		Welcome to the administration panel for <a href="http://ezchatbox.sourceforge.net" target="_blank" class="copy">EzChatBox</a>.
		<br>
		<br>
		Here you can <a href="admin.php?action=ban" class="copy">ban</a> users and keep a track of the <a href="admin.php?action=history" class="copy">history</a> of the Chatbox.
		<br>
		<br>
		Either move your mouse over the links above or click the buttons at the top of the screen.
		<br>
		<br>
		We hope that you have fun using <a href="http://ezchatbox.sourceforge.net" target="_blank" class="copy">EzChatBox</a>, for any support queries please visit our website <a href="http://ezchatbox.sourceforge.net" target="_blank" class="copy">ezchatbox.sourceforge.net</a>
		<br>
		<br>
  </div>
	<div class="copywrite" align="center"><span>EzChatBox 2004 - CW Enterprises</span></div>
</div>
</center>
<?php
}
?>
</body>
</html>