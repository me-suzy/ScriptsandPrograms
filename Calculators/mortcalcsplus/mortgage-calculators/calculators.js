// Mortgage Calculators Plus v1.1
// ------------------------------------------------------------------------
// Copyright (c) 2005, MortgageCalculatorsPlus.com
// ------------------------------------------------------------------------
// This file is part of "Mortgage Calculators Plus" software
// ------------------------------------------------------------------------

function show_tip(tipid){
	destobj=document.getElementById(tipid);
	tipbox=document.getElementById("tiplayer");
	objpos=getAbsolutePosition(destobj);
	tipbox.style.left=destobj.offsetWidth+objpos[0]+10;
	tipbox.style.top=objpos[1]-10;
	tipbox.innerHTML=tips[tipid];
	tipbox.style.visibility="visible";
};
function hide_tip(){
	document.getElementById("tiplayer").style.visibility="hidden";
};
function getAbsolutePosition(oNode){
	var oCurrentNode=oNode;
	var iLeft=0;
	var iTop=0;
	while(oCurrentNode.tagName!="BODY"){
		iTop+=oCurrentNode.offsetTop;
		iLeft+=oCurrentNode.offsetLeft;
		oCurrentNode=oCurrentNode.offsetParent;
	}
	return Array(iLeft, iTop);
};
