<?php
/*
plugin-name: Manage Files
plugin-url: http://www.fluffington.com/
plugin-version: 1.1.1
plugin-description: Manage Files
author-name: Noah Medling
author-url: http://www.fluffington.com/
*/

/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	class FLog_Plugin_ManageFiles{
		function manage_files_process(){
			global $FLog_dir_files;
			$dir = '';
			$depth = 0;
			foreach(explode('/', (string)@$_GET['dir']) as $d){
				if($d === '') continue;
				if($d !== '.' && $d !== '..'){
					++$depth;
					$dir .= $d.'/';
					$root = false;
				}
				else{
					$dir = '';
					break;
				}
			}
			if(isset($_POST['newdir'], $_POST['dirname'])){
				if(strstr($_POST['dirname'], '/') || strstr($_POST['dirname'], "\\")){
					FLog::Redirect('?+msg=error.dirname','p','dir');
				}
				elseif(FLog::CreateDirectory($dn = $FLog_dir_files.$dir.$_POST['dirname'], 0777)){
					chmod($dn, 0777);
					FLog::Redirect('?+msg=message.newdirsuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.newdirfail','p','dir');
			}
			elseif(isset($_POST['upload'], $_FILES['localfile'])){
				$error = $_FILES['localfile']['error'];
				if($error != UPLOAD_ERR_OK) FLog::Redirect('?+msg=error.badfile','p','dir');
				elseif(move_uploaded_file($_FILES['localfile']['tmp_name'], $fn = $FLog_dir_files.$dir.basename($_FILES['localfile']['name']))){
					chmod($fn, 0666);
					FLog::Redirect('?+msg=message.uploadsuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.uploadfail','p','dir');
			}
			elseif(isset($_POST['confirmrenamefile'], $_POST['filename'], $_POST['newfilename'])){
				$up = $depth;
				foreach(explode('/', $_POST['newfilename']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.badfilename');
				}
				$up = $depth;
				foreach(explode('/', $_POST['filename']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.badfilename');
				}
				if(@rename($FLog_dir_files.$dir.$_POST['filename'], $FLog_dir_files.$dir.$_POST['newfilename'])){
					FLog::Redirect('?+msg=message.renamefilesuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.renamefilefail','p','dir');
			}
			elseif(isset($_POST['confirmrenamedir'], $_POST['dirname'], $_POST['newdirname'])){
				$up = $depth;
				foreach(explode('/', $_POST['newdirname']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.baddirname');
				}
				$up = $depth;
				foreach(explode('/', $_POST['dirname']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.baddirname');
				}
				if(@rename($FLog_dir_files.$dir.$_POST['dirname'], $FLog_dir_files.$dir.$_POST['newdirname'])){
					FLog::Redirect('?+msg=message.renamedirsuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.renamedirfail','p','dir');
			}
			elseif(isset($_POST['confirmdeletefile'], $_POST['filename'])){
				$up = $depth;
				foreach(explode('/', $_POST['filename']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.badfilename');
				}
				if(FLog::DeleteFile($FLog_dir_files.$dir.$_POST['filename'])){
					FLog::Redirect('?+msg=message.deletefilesuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.deletefilefail','p','dir');
			}
			elseif(isset($_POST['confirmdeletedir'], $_POST['dirname'])){
				$up = $depth;
				foreach(explode('/', $_POST['dirname']) as $d){
					if($d === '' || $d === '.') continue;
					elseif($d === '..') --$up;
					else ++$up;
					if($up < 0) FLog::Redirect('?+msg=error.baddirname');
				}
				if(FLog::DeleteDirectory($FLog_dir_files.$dir.$_POST['dirname'])){
					FLog::Redirect('?+msg=message.deletedirsuccess','p','dir');
				}
				FLog::Redirect('?+msg=error.deletedirfail','p','dir');
			}
			elseif(isset($_POST['cancelrenamefile']) || isset($_POST['cancelrenamedir'])) FLog::Redirect('?+msg=message.renamecancel','p','dir');
			elseif(isset($_POST['canceldeletefile']) || isset($_POST['canceldeletedir'])) FLog::Redirect('?+msg=message.deletecancel','p','dir');
		}
		function manage_files_display(){
			global $FLog_dir_files;
			$dir = ''; $parent = '';
			$root = true;
			foreach(explode('/', (string)@$_GET['dir']) as $d){
				if($d === '') continue;
				if($d !== '.' && $d !== '..'){
					$parent = $dir;
					$dir .= $d.'/';
					$root = false;
				}
				else{
					$dir = '';
					break;
				}
			}
			echo '<h1>',__('admin.manage.files'),'</h1>';
			switch((string)@$_GET['msg']){
				case 'message.newdirsuccess': echo '<p class="message">',__('admin.manage.files.message.newdirsuccess'),'</p>'; break;
				case 'message.uploadsuccess': echo '<p class="message">',__('admin.manage.files.message.uploadsuccess'),'</p>'; break;
				case 'message.renamefilesuccess': echo '<p class="message">',__('admin.manage.files.message.renamefilesuccess'),'</p>'; break;
				case 'message.renamedirsuccess': echo '<p class="message">',__('admin.manage.files.message.renamedirsuccess'),'</p>'; break;
				case 'message.renamecancel': echo '<p class="message">',__('admin.manage.files.message.renamecancel'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.files.message.deletecancel'),'</p>'; break;
				case 'message.deletefilesuccess': echo '<p class="message">',__('admin.manage.files.message.deletefilesuccess'),'</p>'; break;
				case 'message.deletedirsuccess': echo '<p class="message">',__('admin.manage.files.message.deletedirsuccess'),'</p>'; break;
				case 'error.dirname': echo '<p class="error">',__('admin.manage.files.error.dirname'),'</p>'; break;
				case 'error.newdirfail': echo '<p class="error">',__('admin.manage.files.error.newdirfail'),'</p>'; break;
				case 'error.badfile': echo '<p class="error">',__('admin.manage.files.error.badfile'),'</p>'; break;
				case 'error.uploadfail': echo '<p class="error">',__('admin.manage.files.error.uploadfail'),'</p>'; break;
				case 'error.badfilename': echo '<p class="error">',__('admin.manage.files.error.badfilename'),'</p>'; break;
				case 'error.renamefilefail': echo '<p class="error">',__('admin.manage.files.error.renamefilefail'),'</p>'; break;
				case 'error.baddirname': echo '<p class="error">',__('admin.manage.files.error.baddirname'),'</p>'; break;
				case 'error.renamedirfail': echo '<p class="error">',__('admin.manage.files.error.renamedirfail'),'</p>'; break;
				case 'error.deletefilefail': echo '<p class="error">',__('admin.manage.files.error.deletefilefail'),'</p>'; break;
				case 'error.deletedirfail': echo '<p class="error">',__('admin.manage.files.error.deletedirfail'),'</p>'; break;
			}
			$files = array();
			$dirs = array();
			if(($d = @opendir($FLog_dir_files.$dir))!==false){
				while($f = readdir($d)){
					if(is_file($FLog_dir_files.$dir.$f)) $files[] = $f;
					elseif(is_dir($FLog_dir_files.$dir.$f) && $f!=='.' && $f!=='..') $dirs[] = $f;
				}
			}
			else{
				echo '<p class="error">',__('admin.manage.files.error.readdir'),'</p>';
			}
			natsort($dirs); natsort($files);
			$dirs = array_values($dirs);
			$files = array_values($files);
			$total = 0;
			
			$renamefile = $renamedir = false;
			if(isset($_POST['renamefile'], $_POST['filename'])) $renamefile = $_POST['filename'];
			elseif(isset($_POST['renamedir'], $_POST['dirname'])) $renamedir = $_POST['dirname'];
			
			if(isset($_POST['deletefile'], $_POST['filename'])){
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
				echo '<input type="hidden" name="filename" value="',htmlspecialchars($_POST['filename']),'" />';
				echo '<p>',__('admin.manage.files.delete.message',htmlspecialchars($_POST['filename'])),'</p>';
				echo '<p><input type="submit" name="confirmdeletefile" value="',__('admin.manage.files.delete.confirm'),'" />';
				echo ' <input type="submit" name="canceldeletefile" value="',__('admin.manage.files.delete.cancel'),'" /></p>';
				echo '</form>';				
			}
			elseif(isset($_POST['deletedir'], $_POST['dirname'])){
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
				echo '<input type="hidden" name="dirname" value="',htmlspecialchars($_POST['dirname']),'" />';
				echo '<p>',__('admin.manage.files.delete.message',htmlspecialchars($_POST['dirname'])),'</p>';
				echo '<p><input type="submit" name="confirmdeletedir" value="',__('admin.manage.files.delete.confirm'),'" />';
				echo ' <input type="submit" name="canceldeletedir" value="',__('admin.manage.files.delete.cancel'),'" /></p>';
				echo '</form>';				
			}
			else{
				echo '<p>',__('admin.manage.files.currentdir', htmlspecialchars('/'.$dir)),'</p>';
				if($renamefile!==false || $renamedir!==false) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
				echo '<table class="admintable">';
				echo '<colgroup>';
				echo '<col class="oddcol" style="width:75%;" />'; // filename
				echo '<col class="evencol" style="width:5%;" />';
				echo '<col class="oddcol" style="width:20%;" />';
				echo '</colgroup>';
				echo '<thead><tr>';
				echo '<td>',__('admin.manage.files.filename'),'</td>';
				echo '<td>',__('admin.manage.files.filesize'),'</td>';
				echo '<td>',__('admin.manage.files.action'),'</td>';
				echo '</tr></thead><tbody>';
				$i=0;
				if(!$root){
					if((++$i)%2==0) echo '<tr class="evenrow">';
					else echo '<tr class="oddrow">';
					echo '<td><a href="admin.php?dir=',htmlspecialchars($parent),FLog::AppendQuerySafe('','p'),'">../</a></td><td>-</td><td></td></tr>';
				}
				foreach($dirs as $d){
					if($renamedir===$d){
						if((++$i)%2==0) echo '<tr class="evenrow current">';
						else echo '<tr class="oddrow current">';
						echo '<td><input type="text" size="40" name="newdirname" value="',htmlspecialchars($d),'" /></td><td>-</td><td>';
						echo '<input type="hidden" name="dirname" value="',htmlspecialchars($d),'" />';
						echo '<input type="submit" name="confirmrenamedir" value="',__('admin.manage.files.rename.confirm'),'" /> ';
						echo '<input type="submit" name="cancelrenamedir" value="',__('admin.manage.files.rename.cancel'),'" />';
						echo '</td></tr>';
					}
					else{
						if((++$i)%2==0) echo '<tr class="evenrow">';
						else echo '<tr class="oddrow">';
						echo '<td><a href="admin.php?dir=',htmlspecialchars($dir.$d),FLog::AppendQuerySafe('','p'),'">',htmlspecialchars($d.'/'),'</a></td><td>-</td><td>';
						if($renamedir===false && $renamefile===false){
							echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
							echo '<input type="hidden" name="dirname" value="',htmlspecialchars($d),'" />';
							echo '<input type="submit" name="renamedir" value="',__('admin.manage.files.rename'),'" /> ';
							echo '<input type="submit" name="deletedir" value="',__('admin.manage.files.delete'),'" />';
							echo '</form>';
						}
						echo '</td></tr>';
					}
				}
				foreach($files as $f){
					if($renamefile===$f){
						if((++$i)%2==0) echo '<tr class="evenrow current">';
						else echo '<tr class="oddrow current">';
						$total += $num = $size = filesize($FLog_dir_files.$dir.$f);
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'K'; }
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'M'; }
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'G'; }
						echo '<td><input type="text" size="40" name="newfilename" value="',htmlspecialchars($f),'" /></td><td>',$num,'</td><td>';
						echo '<input type="hidden" name="filename" value="',htmlspecialchars($f),'" />';
						echo '<input type="submit" name="confirmrenamefile" value="',__('admin.manage.files.rename.confirm'),'" /> ';
						echo '<input type="submit" name="cancelrenamefile" value="',__('admin.manage.files.rename.cancel'),'" />';
						echo '</td></tr>';
					}
					else{
						if((++$i)%2==0) echo '<tr class="evenrow">';
						else echo '<tr class="oddrow">';
						$total += $num = $size = filesize($FLog_dir_files.$dir.$f);
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'K'; }
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'M'; }
						if($size >= 1024){ $num = number_format($size = ($size / 1024),1,'.','').'G'; }
						echo '<td><a href="',htmlspecialchars($FLog_dir_files.$dir.$f),'">',htmlspecialchars($f),'</a></td><td>',$num,'</td><td>';
						if($renamefile===false && $renamedir===false){
							echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
							echo '<input type="hidden" name="filename" value="',htmlspecialchars($f),'" />';
							echo '<input type="submit" name="renamefile" value="',__('admin.manage.files.rename'),'" /> ';
							echo '<input type="submit" name="deletefile" value="',__('admin.manage.files.delete'),'" />';
							echo '</form>';
						}
						echo '</td></tr>';
					}
				}
				echo '</tbody></table>';
				if($renamefile!==false || $renamedir!==false) echo '</form>';
				else{
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8" enctype="multipart/form-data">';
					echo '<fieldset><legend>',__('admin.manage.files.upload'),'</legend>';
					echo '<p><label>',__('admin.manage.files.upload.filename'),'<br /><input type="file" size="30" name="localfile" /></label></p>';
					echo '<p><input type="submit" name="upload" value="',__('admin.manage.files.upload.submit'),'" /></p>';
					echo '</fieldset></form>';
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','dir'),'" accept-charset="utf-8">';
					echo '<fieldset><legend>',__('admin.manage.files.newdir'),'</legend>';
					echo '<p><label>',__('admin.manage.files.newdir.dirname'),'<br /><input type="text" size="40" name="dirname" /></label></p>';
					echo '<p><input type="submit" name="newdir" value="',__('admin.manage.files.newdir.submit'),'" /></p>';
					echo '</fieldset></form>';
				}
			}
		}
	}
	
	FLog::RegisterAdminPage('manage.files', __('admin.manage.files'), array('FLog_Plugin_ManageFiles', 'manage_files_process'), array('FLog_Plugin_ManageFiles', 'manage_files_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.files'));

?>