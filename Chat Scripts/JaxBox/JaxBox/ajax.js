<!--
function createRequestObject() {
	var ro;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer") {
		ro = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
        	ro = new XMLHttpRequest();
	}
	return ro;
}

var http = createRequestObject();

function sndReqArg(action,arg) {
	http.open('get', 'shout.php?action='+action+'&arg='+arg);
	http.onreadystatechange = handleResponse;
	http.send(null);
}

function handleResponse() {
	if(http.readyState == 4) {
		var response = http.responseText;
		var update = new Array();

		if(response.indexOf('|' != -1)) {
			update = response.split('|');
			document.getElementById(update[0]).innerHTML = update[1];
		}
	}
}

var timer = setInterval('sndReqArg("shout", "")', 5000);
//-->