// change the following to the place where you put the linktrack script.
var linktrack="linktrack.php";


// make error proof
function lt_clicker(e) {
  try {
    lt_do_clicker(e);
  } catch (err) {
     //alert("error "+err);
     return true;
  }
  return true;
}
function lt_do_clicker(e) {
// this grabs the link and redirects it to the php site.
  var lt_target = null;
  if (e != null) { 
     lt_target = e.target;
  } else {
     lt_target = window.event.srcElement;
  }
  // move on to our next site

  if (lt_target==null) return true; // can't track a link that doesn't exist

  if (lt_target.nodeName.toUpperCase() != 'A') return true; // don't want to track anything but links.
  if (lt_target.href==null) return true; // if we aren't going anywhere don't track
  var lt_href=lt_target.href;
  var lt_atext="";
  if (lt_target.innerText!=null) {
     lt_atext=lt_target.innerText;
  } else if (lt_target.innerHTML!=null) {
     lt_atext=lt_target.innerHTML;
  } else if (lt_target.text!=null) {
     lt_atext=lt_target.text;
  } else {
    return true; // can't track a link with no description
  }
  if(lt_href==null||lt_atext==null) return true; // once more with feeling.
  if(typeof(lt_href) != 'string') return true;  // not sure what else it could be, except an image.
  // see if the link is off the page
  var lt_host = document.location.hostname.toLowerCase();
  if (lt_host==null||lt_host=="") lt_host="hey hey";
  // if we want to track internal stuff, comment out this next line
  if (lt_href.toLowerCase().indexOf(lt_host)>=0) return true; // don't track in and around site.
  // use the next line to avoid tracking links to some other URL
  if (lt_href.toLowerCase().indexOf("anotherURL")>0) return true;
  lt_href = escape(lt_href);
  lt_atext = escape(lt_atext);
  lt_from=escape(document.location);
  // we have a link. We have to mess with it.
  // it seems the best way to do this is to create a new image, but you can use an iframe
  
  // create the ref to the new image
  try {
     var lt_newurl=linktrack+"?HREF="+lt_href+"&ATEXT="+lt_atext+"&FROM="+lt_from; // sometimes this fails
  } catch (error) {
     var lt_newurl=linktrack+"?HREF="+lt_href+"&ATEXT="+lt_atext;
  }
  //alert (lt_newurl);
  try{ // put it in a try/next to avoid http errors
    var lt_newimg = new Image();
    lt_newimg.src = lt_newurl;
  }catch(err){ 
    return true; 
  }
// the pause that refreshes
  var lt_start = new Date().getTime();
  var lt_stop = lt_start + 500;
  while(lt_start<lt_stop){
    lt_start = new Date().getTime(); // nice tight loop - it might be needed on slow systems
  }
  return true; // let link do his job 
}

// direct code that is executed immediately
   document.onclick=lt_clicker; // this directs links to our code

// end of link tracking

// put this down near the bottom of your page