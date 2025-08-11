<?php

	// RCBlog - static.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);

	if(isset($_GET['action'])){
		if($_GET['action']=='up'){
			if($file=rcb_readfile('data/nav.txt')){
				$lines = preg_split("/(\r\n|\r|\n)/", $file);
				$i=$_GET['index'];
				if($i>1 && $i<=count($lines)){
					$temp = $lines[$i-1];
					$lines[$i-1] = $lines[$i-2];
					$lines[$i-2] = $temp;
					rcb_writefile('data/nav.txt', implode("\n", $lines));
				}
			}
			rcb_redirect("static.php");
		}
		elseif($_GET['action']=='down'){
			if($file=rcb_readfile('data/nav.txt')){
				$lines = preg_split("/(\r\n|\r|\n)/", $file);
				$i=$_GET['index'];
				if($i>=1 && $i<count($lines)){
					$temp = $lines[$i-1];
					$lines[$i-1] = $lines[$i];
					$lines[$i] = $temp;
					rcb_writefile('data/nav.txt', implode("\n", $lines));
				}
			}
			rcb_redirect("static.php");
		}
		elseif($_GET['action']=='edit'){
			if($file=rcb_readfile('data/nav.txt')){
				$lines = preg_split("/(\r\n|\r|\n)/", $file);
				$i=$_GET['index'];
				if($i>=1 && $i<=count($lines)){
					$parts=explode("\t", rcb_striphtml($lines[$i-1]), 2);
					if(count($parts)>1){
						if($parts[1]{0}=='l'){
						
							if(isset($_POST['changelink'])){
								$lines[$i-1] = trim($_POST['linkname'])."\tl".trim($_POST['linkurl']);
								rcb_writefile('data/nav.txt', implode("\n", $lines));
								rcb_redirect("static.php");
							}

							rcb_printheader();
							rcb_printbodystart('editdiv.divname');
							rcb_printcontentstart();
							echo "<div class=\"post\">\n";
							echo "<div class=\"title\">Edit Link</div>\n";
							echo "<div class=\"text\">\n";
							rcb_printformstart('editdiv', 'post', "static.php?action=edit&amp;index=$i");
							rcb_printforminput('Name', 'linkname', 'text', 20, $parts[0]);
							rcb_printforminput('URL', 'linkurl', 'text', 20, substr($parts[1],1));
							rcb_printformbutton('Edit', 'changelink', 'submit');
							rcb_printformend();
							echo "</div>\n</div>\n";
							rcb_printcontentend();
							rcb_printnav($loggedin);
							rcb_printbodyend();
							exit;

						}
						rcb_redirect("edit.php?post=$parts[1]");
					}
					elseif(isset($_POST['changediv'])){
						if(strlen(trim($_POST['divname']))>0){
							$lines[$i-1]=trim($_POST['divname']);
							rcb_writefile('data/nav.txt', implode("\n", $lines));
						}
						rcb_redirect("static.php");
					}
					rcb_printheader();
					rcb_printbodystart('editdiv.divname');
					rcb_printcontentstart();
					echo "<div class=\"post\">\n";
					echo "<div class=\"title\">Edit Divider</div>\n";
					echo "<div class=\"text\">\n";
					rcb_printformstart('editdiv', 'post', "static.php?action=edit&amp;index=$i");
					rcb_printforminput('', 'divname', 'text', 20, $parts[0]);
					rcb_printformbutton('Edit', 'changediv', 'submit');
					rcb_printformend();
					echo "</div>\n</div>\n";
					rcb_printcontentend();
					rcb_printnav($loggedin);
					rcb_printbodyend();
					exit;
				}
			}
			rcb_redirect("static.php");
		}
		elseif($_GET['action']=='delete'){
			if($file=rcb_readfile('data/nav.txt')){
				$lines = preg_split("/(\r\n|\r|\n)/", $file);
				$i=$_GET['index'];
				if($i>=1 && $i<=count($lines)){
					$parts=explode("\t", $lines[$i-1], 2);
					if(count($parts)>1){
						if($parts[1]{0}!='l') rcb_redirect("delete.php?post=$parts[1]");
					}
					array_splice($lines, $i-1, 1);
					rcb_writefile('data/nav.txt', implode("\n", $lines));
				}
			}
			rcb_redirect("static.php");
		}
		elseif($_GET['action']=='newdiv' && isset($_POST['newdiv'])){
			if(strlen(trim($_POST['divname']))>0) rcb_appendfile('data/nav.txt', trim($_POST['divname'])."\n");
			rcb_redirect("static.php");
		}
		elseif($_GET['action']=='newlink' && isset($_POST['linkname']) && isset($_POST['linkurl'])){
			if(strlen(trim($_POST['linkname']))>0 && strlen(trim($_POST['linkurl']))>0){
				rcb_appendfile('data/nav.txt', trim($_POST['linkname'])."\tl".trim($_POST['linkurl'])."\n");
			}
			rcb_redirect("static.php");
		}
	}
	
	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Manage Static Posts</div>\n";
	echo "<div class=\"text\">\n";
	if($file=rcb_readfile('data/nav.txt')){
		$lines = preg_split("/(\r\n|\r|\n)/", $file);
		if($lines[count($lines)-1]=='') $count=count($lines)-1;
		else $count=count($lines);
		for($i=1; $i<=$count; $i++){
			if(strlen($lines[$i-1])>0){
				$parts = explode("\t", rcb_striphtml(trim($lines[$i-1])), 2);
				if(count($parts)==1) echo "$i - $parts[0]<br/>";
				else if($parts[1]{0} == 'l'){
					echo "$i - $parts[0] (<a href=\"".substr($parts[1],1)."\" rel=\"external\">".substr($parts[1],1)."</a>)<br />";
				}
				else echo "$i - $parts[0] (<a href=\"index.php?post=$parts[1]\">$parts[1]</a>)<br/>";
				echo "&nbsp; &nbsp; &nbsp; ";
				if($i<2) echo "up | ";
				else echo "<a href=\"static.php?action=up&amp;index=$i\">up</a> | ";
				if($i>=$count) echo "down | ";
				else echo "<a href=\"static.php?action=down&amp;index=$i\">down</a> | ";
				echo "<a href=\"static.php?action=edit&amp;index=$i\">edit</a> | ";
				echo "<a href=\"static.php?action=delete&amp;index=$i\">delete</a>";
				echo ($i<$count?"<br/><br/>\n":"<br/>\n");
			}
		}
	}
	echo "</div>\n</div>\n";

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Add Divider</div>\n";
	echo "<div class=\"text\">\n";
	rcb_printformstart('adddiv', 'post', 'static.php?action=newdiv');
	rcb_printforminput('', 'divname', 'text');
	rcb_printformbutton('Add', 'newdiv', 'submit');
	rcb_printformend();
	echo "</div>\n</div>\n";

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Add Link</div>\n";
	echo "<div class=\"text\">\n";
	rcb_printformstart('adddiv', 'post', 'static.php?action=newlink');
	rcb_printforminput('Name', 'linkname', 'text');
	rcb_printforminput('URL', 'linkurl', 'text');
	rcb_printformbutton('Add', 'newlink', 'submit');
	rcb_printformend();
	echo "</div>\n</div>\n";

	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();


?>