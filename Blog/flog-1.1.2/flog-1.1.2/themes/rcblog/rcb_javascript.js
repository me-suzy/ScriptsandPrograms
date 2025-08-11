// RCBlog - scripts/rcb_javascript.php
// ------------------------------------------------
// Created by Noah Medling <noah.medling@gmail.com>

function rcb_addstyle(textarea, blogcode){
	input = prompt("Enter the text to be formatted\n["+blogcode+"]xxx[/"+blogcode+"]", '');
	if(input!='' && input!=null){
		textarea.value += "["+blogcode+"]"+input+"[/"+blogcode+"]";
	}
	textarea.focus();
}

function rcb_addurl(textarea){
	input = prompt("Enter the URL\n[url]xxx[/url]", 'http://');
	if(input!='' && input!=null){
		textarea.value += "[url]"+input+"[/url]";
	}
	textarea.focus();
}

function rcb_addlink(textarea){
	input1 = prompt("Enter the URL\n[url=xxx]...[/url]", 'http://');
	if(input1!='' && input1!=null){
		input2 = prompt("Enter the name\n[url=...]xxx[/url]", '');
		if(input2!='' && input2!=null){
			textarea.value += "[url="+input1+"]"+input2+"[/url]";
		}
	}
	textarea.focus();
}

function rcb_addemail(textarea){
	input = prompt("Enter the e-mail address\n[email]xxx[/email]", '');
	if(input!='' && input!=null){
		textarea.value += "[email]"+input+"[/email]";
	}
	textarea.focus();
}

function rcb_addimage(textarea){
	input = prompt("Enter the URL\n[img]xxx[/img]", 'http://');
	if(input!='' && input!=null){
		textarea.value += "[img]"+input+"[/img]";
	}
	textarea.focus();
}

function rcb_linkout(){ 
	if(!document.getElementsByTagName) return;
	var anchors = document.getElementsByTagName("a");
	for(var i=0; i<anchors.length; i++){
		var anchor = anchors[i];
		if(anchor.getAttribute("href") && anchor.getAttribute("rel") == "external"){
			anchor.target = "_blank"; 
		} 
	}
} 
// window.onload = rcb_linkout;
