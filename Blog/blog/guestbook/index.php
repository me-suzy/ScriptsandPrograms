<?
session_start();
?>
<SCRIPT LANGUAGE="Javascript">
		//<!--
		// pop a windoid (Pictures)
		function popWin(url, w, h) 
		{
		 var madURL = url;
		 var x, y, winStr;
		 x=0; y=0;
		 self.name="opener";
		 winStr = "height="+h+",width="+w+",screenX="+x+",left="+x+",screenY="+y+",top="+y+",channelmode=0,dependent=0,directories=0,fullscreen=0,location=0,menubar=0,resizable=1,scrollbars=0,status=0,toolbar=0";
		 lilBaby = window.open(madURL, "_blank", winStr);
		}
		//--> </script>

<?
include "../admin/connect.php";
print "<link rel='stylesheet' href='../admin/style.css' type='text/css'>";
$numentries=15;
$getvars="SELECT * from bl_vars";
$getvars2=mysql_query($getvars) or die("Could not get vars");
$getvars3=mysql_fetch_array($getvars2);
if($getvars3[useguestbook]==0)
{
  print "Administrator has chosen not to use guestbook.";
}
else
{
  print "<center>";
  print "<table width=95% border='0'>";
  print "<tr class='headline'><td colspan='3'><center><b>$getvars3[title]</b></center></td></tr>";
  print "<tr class='mainrow'><td width=50% valign='top'>";
  if(!isset($_GET['start']))
  {
    $start=0;
  }
  else
  {
    $start=$_GET['start'];
  }
  $order="SELECT * from bl_gbook";
  $order2=mysql_query($order) or die(mysql_error());
  $d=0;
  $f=0;
  $g=1+$d/$numentries;
  $num=mysql_num_rows($order2);
  print "Page:</font> ";
  $prev=$start-$numentries;
  $next=$start+$numentries;
  if($start>=$numentries)
  {
    print "<A href='index.php?start=$prev'><<</a>&nbsp;";
  }
  while($order3=mysql_fetch_array($order2))
  {
     if($f>=$start-3*$numentries&&$f<=$start+7*$numentries)
     {
        if($f%$numentries==0)
        {
           print "<A href='index.php?start=$d'>$g</a> ";
        }
     }
     $d=$d+1;
     $g=1+$d/$numentries;
     $f++;
  }
  if($start<=$num-$numentries)
  {
    print "<A href='index.php?start=$next'>>></a>&nbsp;";
  }
  print "</td>";
  print "<td width=30%><center><A href='../index.php'>Back to main</a></center></td>";
  print "<td valign='top' width='20%'>";
  print "<center><A href='addentry.php'>[Sign Guestbook]</center></a>";
  print "</td></tr></table>";
  print "</td>";
  $gbvar="Select * FROM bl_gbook order by ID DESC LIMIT " . $start . ", $numentries"; //retrieve entries from sql
  $row=mysql_query($gbvar);
  print "<center>";
  print "<table border='0' width=95%>";
  print "<tr class='headline'><td height='7' colspan='2'></td></tr>";
  while($gbvalues=mysql_fetch_array($row))
  {
    print "<tr class='mainrow'><td width=25% valign='top'>";
    $gbvalues[comment]=htmlspecialchars($gbvalues[comment]);
    $gbvalues[name]=htmlspecialchars($gbvalues[name]);
    $gbvalues[country]=htmlspecialchars($gbvalues[country]);
    $gbvalues[comment]=BBCode($gbvalues[comment]);
    $gbvalues[comment]=smile($gbvalues[comment]);
    print "$gbvalues[realtime]<br>";
    print "$gbvalues[name]<br>";
    if(isset($_SESSION['blogadmin']))
    {
      print "IP: $gbvalues[IP]<br>";
    }
    print "$gbvalues[country]<br><br>";
    if(strlen($gbvalues[homepage])>1)
    {
      print "<A href='$gbvalues[homepage]'><img src='../images/homepage.gif' border='0'></a> ";
    }
    if(strlen($gbvalues[mail])>1)
    {
      print "<A href='mailto:$gbvalues[mail]'><img src='../images/email.gif' border='0'></a><br>";
    }
    if(strlen($gbvalues[aim])>1)
    {
      print "<A href=\"javascript:popWin('aim.php?ID=$gbvalues[ID]',400, 5)\"><img src='../images/aim.gif' alt='$gbvalues[aim]' border='0'></a> ";
    }
    if(strlen($gbvalues[icq])>1)
    {
     print "<A href=\"javascript:popWin('icq.php?ID=$gbvalues[ID]',400, 5)\"><img src='../images/icq.gif' alt='$gbvalues[icq]' border='0'></a> ";
    }
    if(strlen($gbvalues[msn])>1)
    {
      print "<A href=\"javascript:popWin('msn.php?ID=$gbvalues[ID]',400, 5)\"><img src='../images/msn.gif' alt='$gbvalues[msn]' border='0'></a> ";
    }
    if(strlen($gbvalues[yim])>1)
    {
      print "<A href=\"javascript:popWin('yim.php?ID=$gbvalues[ID]',400, 5)\"><img src='../images/yim.gif' alt='$gbvalues[yim]' border='0'></a> ";
    }
    if(isset($_SESSION['username']))
    {
      print"<br>IP: $gbvalues[IP]";
    }
    print "</td>";
    print "<td valign='top' width=75%>";
    $gbvalues[comment] = wordwrap( $gbvalues[comment], 19, "\n", 1);
    print "$gbvalues[comment]";
    if(isset($_SESSION['blogadmin']))
    {
      print "<br><br><A href='edit.php?ID=$gbvalues[ID]'>Edit</a>&nbsp;&nbsp;<A href='delete.php?ID=$gbvalues[ID]'>Delete</a>";
    }
    print "</td></tr>";
   
  }
  print "</center>";
}
print "</table>";
print "<br><center><font size='2'>Powered by © <A href='http://www.chipmunk-scripts.com'>Chipmunk Blogger</a></font></center>";

?>

<? //BBCODE function
	//Local copy

	function BBCode($Text)
	    {
        	// Replace any html brackets with HTML Entities to prevent executing HTML or script
            // Don't use strip_tags here because it breaks [url] search by replacing & with amp
     

            // Convert new line chars to html <br /> tags
            $Text = nl2br($Text);

            // Set up the parameters for a URL search string
            $URLSearchString = " a-zA-Z0-9\:\/\-\?\&\.\=\_\~\#\'";
            // Set up the parameters for a MAIL search string
            $MAILSearchString = $URLSearchString . " a-zA-Z0-9\.@";

            // Perform URL Search
            $Text = preg_replace("/\[url\]([$URLSearchString]*)\[\/url\]/", '<a href="$1" target="_blank">$1</a>', $Text);
            $Text = preg_replace("(\[url\=([$URLSearchString]*)\]([$URLSearchString]*)\[/url\])", '<a href="$1" target="_blank">$2</a>', $Text);
            $Text = preg_replace("/\[URL\]([$URLSearchString]*)\[\/URL\]/", '<a href="$1" target="_blank">$1</a>', $Text);
            $Text = preg_replace("(\[URL\=([$URLSearchString]*)\]([$URLSearchString]*)\[/URL\])", '<a href="$1" target="_blank">$2</a>', $Text);
            // Perform MAIL Search
            $Text = preg_replace("(\[mail\]([$MAILSearchString]*)\[/mail\])", '<a href="mailto:$1">$1</a>', $Text);
            $Text = preg_replace("/\[mail\=([$MAILSearchString]*)\](.+?)\[\/mail\]/", '<a href="mailto:$1">$2</a>', $Text);

            // Check for bold text
            $Text = preg_replace("(\[b\](.+?)\[\/b])is",'<span class="bold">$1</span>',$Text);

            // Check for Italics text
            $Text = preg_replace("(\[i\](.+?)\[\/i\])is",'<span class="italics">$1</span>',$Text);

            // Check for Underline text
            $Text = preg_replace("(\[u\](.+?)\[\/u\])is",'<span class="underline">$1</span>',$Text);

            // Check for strike-through text
            $Text = preg_replace("(\[s\](.+?)\[\/s\])is",'<span class="strikethrough">$1</span>',$Text);

            // Check for over-line text
            $Text = preg_replace("(\[o\](.+?)\[\/o\])is",'<span class="overline">$1</span>',$Text);

            // Check for colored text
            $Text = preg_replace("(\[color=(.+?)\](.+?)\[\/color\])is","<span style=\"color: $1\">$2</span>",$Text);

            // Check for sized text
            $Text = preg_replace("(\[size=(.+?)\](.+?)\[\/size\])is","<span style=\"font-size: $1px\">$2</span>",$Text);

            // Check for list text
            $Text = preg_replace("/\[list\](.+?)\[\/list\]/is", '<ul class="listbullet">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=1\](.+?)\[\/list\]/is", '<ul class="listdecimal">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=i\](.+?)\[\/list\]/s", '<ul class="listlowerroman">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=I\](.+?)\[\/list\]/s", '<ul class="listupperroman">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=a\](.+?)\[\/list\]/s", '<ul class="listloweralpha">$1</ul>' ,$Text);
            $Text = preg_replace("/\[list=A\](.+?)\[\/list\]/s", '<ul class="listupperalpha">$1</ul>' ,$Text);
            $Text = str_replace("[*]", "<li>", $Text);


            // Check for font change text
            $Text = preg_replace("(\[font=(.+?)\](.+?)\[\/font\])","<span style=\"font-family: $1;\">$2</span>",$Text);

    

            // Images
            // [img]pathtoimage[/img]
            $Text = preg_replace("/\[IMG\](.+?)\[\/IMG\]/", '<img src="$1">', $Text);
            $Text = preg_replace("/\[img\](.+?)\[\/img\]/", '<img src="$1">', $Text);
            // [img=widthxheight]image source[/img]
            $Text = preg_replace("/\[img\=([0-9]*)x([0-9]*)\](.+?)\[\/img\]/", '<img src="$3" height="$2" width="$1">', $Text);

	        return $Text;
		}
?>

<? //function for smiley icons
 function smile($post)
 {
      $smilies=array( 
    
    
    ':)' => "<img src='../images/smile.gif' />",
    ':(' => "<img src='../images/sad.gif'   />",
    ':p' => "<img src='../images/tongue.gif' />",
    ';)' => "<img src='../images/wink.gif'  />",
    ';smirk' => "<img src='../images/smirk.gif' />",
    ':blush' =>"<img src='../images/blush.gif' />",
    ':angry' =>"<img src='../images/angry.gif' />",
    ':shocked'=>     "<img src='../images/shocked.gif' />",
    ':ninja'=>"<img src='../images/ninja.gif' />",
    ':cool'=>"<img src='../images/cool.gif' />",
    '(!)'=>"<img src='../images/exclamation.gif' />",
    '(?)'=>"<img src='../images/question.gif' />",
    '(heart)'=>"<img src='../images/heart.gif' />",
    ':{blink}'=>"<img src='../images/winking.gif'>",
    '{clover}'=>"<img src='../images/clover.gif'>",
    ':[glasses]'=>"<img src='../images/glasses.gif'>",
    ':[barf]'=>"<img src='../images/barf.gif'>",
    ':[reallymad]'=>"<img src='../images/mad.gif'>",
    ':[evil]'=>"<img src='../images/melkor.gif'>"
   
      
    );

   $post=str_replace(array_keys($smilies), array_values($smilies), $post);
    return $post;
 }

?>


