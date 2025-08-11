<?php

	// RCBlog - files.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	
	$fileroot = "files";
	$subdir = "/";
	if(isset($_GET['subdir']) && strlen($_GET['subdir'])>0) $subdir = rawurldecode($_GET['subdir']);

	if($subdir!='/' && strlen($subdir)>0) $path = $fileroot . $subdir . '/';
	else $path = $fileroot . '/';
	
	if(isset($_GET['action'])){
		if($_GET['action']=='rename' && isset($_GET['file']) && isset($_GET['subdir'])){
			$filename = rawurldecode($_GET['file']);
			if(isset($_POST['submitrename'])){
				if(@rename($path.$filename, $path.$_POST['filename'])){
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=renameok");
				}
				else{
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=renamefail");
				}
			}
			else{
				rcb_printheader();
				rcb_printbodystart();
				rcb_printcontentstart();
				echo "<div class=\"post\">\n";
				echo "<div class=\"title\">File Manager: rename $filename</div>\n";
				echo "<div class=\"text\">";
				
				rcb_printformstart('renameform', 'post', "files.php?action=rename&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($filename));
				rcb_printforminput('File Name', 'filename', 'input', 20, $filename);
				rcb_printformbutton('Submit', 'submitrename', 'submit');
				rcb_printformend();
				
				echo "</div>\n</div>\n";
				rcb_printcontentend();
				rcb_printnav($loggedin);
				rcb_printbodyend();
			}
			exit;
		}
		
		if($_GET['action']=='delete' && isset($_GET['file']) && isset($_GET['subdir'])){
			$filename = rawurldecode($_GET['file']);
			if(isset($_POST['submityes'])){
				if(@unlink($path.$filename)){
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=deleteok");
				}
				else{
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=deletefail");
				}
			}
			elseif(isset($_POST['submitno'])){
				rcb_redirect("files.php?subdir=".rawurlencode($subdir));
			}
			else{
				rcb_printheader();
				rcb_printbodystart();
				rcb_printcontentstart();
				echo "<div class=\"post\">\n";
				echo "<div class=\"title\">File Manager: delete $filename</div>\n";
				echo "<div class=\"text\">";
				
				rcb_printformstart('renameform', 'post', "files.php?action=delete&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($filename));
				echo "Are you sure you want to delete $filename?<br />\n";
				rcb_printformbutton('No', 'submitno', 'submit');
				rcb_printformbutton('Yes', 'submityes', 'submit');
				rcb_printformend();
				
				echo "</div>\n</div>\n";
				rcb_printcontentend();
				rcb_printnav($loggedin);
				rcb_printbodyend();
			}
			exit;
		}
		
		if($_GET['action']=='rmdir' && isset($_GET['file']) && isset($_GET['subdir'])){
			$filename = rawurldecode($_GET['file']);
			if(isset($_POST['submityes'])){
				if(@rmdir($path.$filename)){
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=rmdirok");
				}
				else{
					rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=rmdirfail");
				}
			}
			elseif(isset($_POST['submitno'])){
				rcb_redirect("files.php?subdir=".rawurlencode($subdir));
			}
			else{
				rcb_printheader();
				rcb_printbodystart();
				rcb_printcontentstart();
				echo "<div class=\"post\">\n";
				echo "<div class=\"title\">File Manager: delete $filename</div>\n";
				echo "<div class=\"text\">";
				
				rcb_printformstart('renameform', 'post', "files.php?action=rmdir&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($filename));
				echo "Are you sure you want to delete $filename?<br />\n";
				rcb_printformbutton('No', 'submitno', 'submit');
				rcb_printformbutton('Yes', 'submityes', 'submit');
				rcb_printformend();
				
				echo "</div>\n</div>\n";
				rcb_printcontentend();
				rcb_printnav($loggedin);
				rcb_printbodyend();
			}
			exit;
		}
		
		if($_GET['action']=='newdir' && isset($_POST['dirname'])){
			if(@mkdir($path.$_POST['dirname'])){
				rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=newdirok");
			}
			rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=newdirfail");
		}
	
		if($_GET['action']=='upload' && isset($_POST['submitfile'])){
			$error = $_FILES['localfile']['error'];
			if($error=='2' || $error=='1'){
				rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=uploadsize");
			}
			if(move_uploaded_file($_FILES['localfile']['tmp_name'], $path.basename($_FILES['localfile']['name']))){
				rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=uploadok");
			}
			rcb_redirect("files.php?subdir=".rawurlencode($subdir)."&msg=uploadfail&err=$error");
		}
	}
	
	if(isset($_GET['msg'])) $msg = $_GET['msg'];
	else $msg = '';
	
	
	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">File Manager: $path</div>\n";
	echo "<div class=\"text\">\n";
	
	if($msg!=''){
		if($msg=='renameok') echo "File renamed.<hr />\n";
		elseif($msg=='renamefail') echo "Error: could not rename.<hr />\n";
		elseif($msg=='deleteok') echo "File deleted.<hr />\n";
		elseif($msg=='deletefail') echo "Error: could not delete.<hr />\n";
		elseif($msg=='rmdirok') echo "Directory deleted.<hr />\n";
		elseif($msg=='rmdirfail') echo "Error: could not delete.<hr />\n";
		elseif($msg=='newdirok') echo "Directory created.<hr />\n";
		elseif($msg=='newdirfail') echo "Error: could not create directory.<hr />\n";
		elseif($msg=='uploadsize') echo "Error: file exceeds maximum file size.<hr />\n";
		elseif($msg=='uploadok') echo "File uploaded.<hr />\n";
		elseif($msg=='uploadfail') echo "Error: could not upload file.<hr />\n";
	}

	$dirs = array();
	$files = array();
	if(($dir = @opendir($path))!==false){
		while($filename = readdir($dir)){
			$full = $path . $filename;
			if(is_file($full)) $files[] = $filename;
			elseif(is_dir($full)){
				if($filename == '.' || ($filename == '..' && ($subdir=='/' || strlen($subdir)<1))) continue;
				$dirs[] = $filename ;
			}
		}
		echo "<table class=\"filetable\">\n";
		if(count($dirs)>0){
			natsort($dirs);
			foreach($dirs as $dir){
				echo "<tr>";
				if($dir != '..'){
					echo "<td class=\"filename\"><a href=\"files.php?subdir=";
					if($subdir!='/' && strlen($subdir)>0) echo rawurlencode("$subdir/$dir");
					else echo rawurlencode("/$dir");
					echo "\">$dir/</a></td>";
				}
				elseif(($x = strrpos($subdir, '/'))!==false){
					echo "<td class=\"filename\"><a href=\"files.php?subdir=";
					echo rawurlencode(substr($subdir, 0, $x));
					echo "\">$dir/</a></td>";
				}
				else echo "<td class=\"filename\">$dir/</td>";
				echo "<td class=\"filesize\">" . rcb_countfiles($path . $dir) . " files</td>";
				
				echo "<td class=\"fileaction\">";
				echo "<a href=\"files.php?action=rename&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($dir)."\">rename</a> | ";
				echo "<a href=\"files.php?action=rmdir&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($dir)."\">delete</a>";
				echo "</td>";
				
				echo "</tr>";
			}
		}
		$totalsize = 0;
		if(count($files)>0){
			natsort($files);
			foreach($files as $file){
				echo "<tr>";
				echo "<td class=\"filename\"><a href=\"$path".rawurlencode($file)."\">$file</a></td>";
				echo "<td class=\"filesize\">" . rcb_filesize($path . $file) . "</td>";
				$totalsize += filesize($path.$file);
				
				echo "<td class=\"fileaction\">";
				echo "<a href=\"files.php?action=rename&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($file)."\">rename</a> | ";
				echo "<a href=\"files.php?action=delete&amp;subdir=".rawurlencode($subdir)."&amp;file=".rawurlencode($file)."\">delete</a>";
				echo "</td>";
				echo "</tr>\n";
			}
		}
		echo "</table>\n";
		echo "<div style=\"text-align:right\">";
		if(count($dirs)==1) echo "1 directory, ";
		else echo count($dirs)." directories, ";
		if(count($files)==1) echo "1 file, ";
		else echo count($files)." files, ";
		echo rcb_formatsize($totalsize)."</div>\n";
		echo "<hr />\n";
		rcb_printformstart('uploadform', 'post', 'files.php?action=upload&amp;subdir='.rawurlencode($subdir), 'multipart/form-data');
		rcb_printforminput('Upload File', 'localfile', 'file');
		rcb_printformbutton('Submit', 'submitfile', 'submit');
		rcb_printformend();
		echo "<hr />\n";
		rcb_printformstart('newdirform', 'post', 'files.php?action=newdir&amp;subdir='.rawurlencode($subdir));
		rcb_printforminput('New Directory', 'dirname', 'input');
		rcb_printformbutton('Submit', 'submitdir', 'submit');
		rcb_printformend();
	}
	else echo "Error: could not open directory.\n";

	echo "</div>\n";
	echo "</div>\n";

	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();
	
?>
