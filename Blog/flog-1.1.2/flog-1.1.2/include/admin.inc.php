<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	class FLog_AdminPages{
		function config_general_process(){
			if(isset($_POST['submitconfig'], $_POST['blog_name'], $_POST['blog_tagline'], $_POST['blog_footer'], $_POST['blog_language'], $_POST['meta_description'], $_POST['meta_author'], $_POST['meta_keywords'], $_POST['time_offset'], $_POST['time_dateformat'], $_POST['time_timeformat'])){
				$config = new FLog_Config;
				if($config->Load('flog', true)){
					$config->SetValue('blog.name', $_POST['blog_name']);
					$config->SetValue('blog.tagline', $_POST['blog_tagline']);
					$config->SetValue('blog.footer', $_POST['blog_footer']);
					$config->SetValue('blog.language', $_POST['blog_language']);
					$config->SetValue('meta.author', $_POST['meta_author']);
					$config->SetValue('meta.description', $_POST['meta_description']);
					$config->SetValue('meta.keywords', $_POST['meta_keywords']);
					$config->SetValue('time.offset', (float)$_POST['time_offset']);
					$config->SetValue('time.dateformat', $_POST['time_dateformat']);
					$config->SetValue('time.timeformat', $_POST['time_timeformat']);
					if($config->Save()){
						FLog::CallAction('config.changed');
						FLog::Redirect('?+msg=message.success','p');
					}
					$config->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
		}
		
		function config_general_display(){
			global $FLog_config, $FLog_lang_list, $FLog_language;
			$time = time();
			echo '<h1>', __('admin.config.general'), '</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.config.general.error.database'),'</p>'; break;
				case 'message.success': echo '<p class="message">',__('admin.config.general.message.success'),'</p>'; break;
			}
			echo '<form method="post" action="" accept-charset="utf-8">';
			echo '<fieldset><legend>',__('admin.config.general.blog'),'</legend>';
			echo '<p><label>',__('admin.config.general.blog.name'),'<br /><input name="blog_name" type="text" size="40" value="',htmlspecialchars(isset($_POST['blog_name'])?$_POST['blog_name']:$FLog_config->GetValue('blog.name')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.blog.tagline'),'<br /><input name="blog_tagline" type="text" size="40" value="',htmlspecialchars(isset($_POST['blog_tagline'])?$_POST['blog_tagline']:$FLog_config->GetValue('blog.tagline')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.blog.footer'),'<br /><input name="blog_footer" type="text" size="40" value="',htmlspecialchars(isset($_POST['blog_footer'])?$_POST['blog_footer']:$FLog_config->GetValue('blog.footer')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.blog.language'),'<br /><select name="blog_language">';
			foreach($FLog_lang_list as $key=>$value){
				echo '<option value="',$key,'"',$FLog_language===$key?' selected="selected"':'','>',$value,'</option>';
			}
			echo '</select></label></p>';	
			echo '</fieldset>';
			echo '<fieldset><legend>',__('admin.config.general.meta'),'</legend>';
			echo '<p><label>',__('admin.config.general.meta.description'),'<br /><input name="meta_description" type="text" size="40" value="',htmlspecialchars(isset($_POST['meta_description'])?$_POST['meta_description']:$FLog_config->GetValue('meta.description')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.meta.author'),'<br /><input name="meta_author" type="text" size="40" value="',htmlspecialchars(isset($_POST['meta_author'])?$_POST['meta_author']:$FLog_config->GetValue('meta.author')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.meta.keywords'),'<br /><input name="meta_keywords" type="text" size="40" value="',htmlspecialchars(isset($_POST['meta_keywords'])?$_POST['meta_keywords']:$FLog_config->GetValue('meta.keywords')),'" /></label></p>';
			echo '</fieldset>';
			echo '<fieldset><legend>',__('admin.config.general.time'),'</legend>';
			echo '<p>',__('admin.config.general.time.now', FLog::FormatDate($time), FLog::FormatTime($time)),'</p>';
			echo '<p><label>',__('admin.config.general.time.offset'),'<br /><input name="time_offset" type="text" size="40" value="',(float)(isset($_POST['time_offset'])?$_POST['time_offset']:$FLog_config->GetValue('time.offset')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.time.dateformat'),'<br /><input name="time_dateformat" type="text" size="40" value="',htmlspecialchars(isset($_POST['time_dateformat'])?$_POST['dateformat']:$FLog_config->GetValue('time.dateformat')),'" /></label></p>';
			echo '<p><label>',__('admin.config.general.time.timeformat'),'<br /><input name="time_timeformat" type="text" size="40" value="',htmlspecialchars(isset($_POST['time_timeformat'])?$_POST['timeformat']:$FLog_config->GetValue('time.timeformat')),'" /></label></p>';
			echo '</fieldset>';
			echo '<p><input name="submitconfig" type="submit" value="',__('admin.config.general.submit'),'" /></p>';			
			echo '</form>';
		}

		function config_display_process(){
			if(isset($_POST['submitconfig'], $_POST['display_postsort'], $_POST['display_commentsort'], $_POST['display_linksort'], $_POST['display_linktype'], $_POST['display_numposts'], $_POST['display_feedposts'], $_POST['display_numlinks'], $_POST['display_feedlinks'])){
				$config = new FLog_Config;
				if($config->Load('flog', true)){
					$config->SetValue('display.postsort', $_POST['display_postsort']);
					$config->SetValue('display.commentsort', $_POST['display_commentsort']);
					$config->SetValue('display.linksort', $_POST['display_linksort']);
					$config->SetValue('display.linktype', $_POST['display_linktype']);
					$config->SetValue('display.numposts', max(1,(int)$_POST['display_numposts']));
					$config->SetValue('display.feedposts', max(1,(int)$_POST['display_feedposts']));
					$config->SetValue('display.numlinks', max(0,(int)$_POST['display_numlinks']));
					$config->SetValue('display.feedlinks', max(1,(int)$_POST['display_feedlinks']));
					if($config->Save()){
						FLog::CallAction('config.changed');
						FLog::Redirect('?+msg=message.success','p');
					}
					$config->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
		}
		
		function config_display_display(){
			global $FLog_config;
			$time = time();
			echo '<h1>', __('admin.config.display'), '</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.config.display.error.database'),'</p>'; break;
				case 'message.success': echo '<p class="message">',__('admin.config.display.message.success'),'</p>'; break;
			}
			echo '<form method="post" action="" accept-charset="utf-8">';
			echo '<fieldset><legend>',__('admin.config.display.display'),'</legend>';

			echo '<p><label>',__('admin.config.display.display.postsort'),'<br /><select name="display_postsort">';
			$s = isset($_POST['display_postsort'])?$_POST['display_postsort']:$FLog_config->GetValue('display.postsort');
			echo '<option value="asc"',$s==='asc'?' selected="selected"':'','>',__('admin.config.display.display.postsort.asc'),'</option>';
			echo '<option value="desc"',$s!=='asc'?' selected="selected"':'','>',__('admin.config.display.display.postsort.desc'),'</option>';
			echo '</select></label></p>';
			
			echo '<p><label>',__('admin.config.display.display.commentsort'),'<br /><select name="display_commentsort">';
			$s = isset($_POST['display_commentsort'])?$_POST['display_commentsort']:$FLog_config->GetValue('display.commentsort');
			echo '<option value="asc"',$s!=='desc'?' selected="selected"':'','>',__('admin.config.display.display.commentsort.asc'),'</option>';
			echo '<option value="desc"',$s==='desc'?' selected="selected"':'','>',__('admin.config.display.display.commentsort.desc'),'</option>';
			echo '</select></label></p>';

			echo '<p><label>',__('admin.config.display.display.linksort'),'<br /><select name="display_linksort">';
			$s = isset($_POST['display_linksort'])?$_POST['display_linksort']:$FLog_config->GetValue('display.linksort');
			echo '<option value="asc"',$s!=='desc'?' selected="selected"':'','>',__('admin.config.display.display.linksort.asc'),'</option>';
			echo '<option value="desc"',$s==='desc'?' selected="selected"':'','>',__('admin.config.display.display.linksort.desc'),'</option>';
			echo '</select></label></p>';
			
			echo '<p><label>',__('admin.config.display.display.linktype'),'<br /><select name="display_linktype">';
			$s = isset($_POST['display_linktype'])?$_POST['display_linktype']:$FLog_config->GetValue('display.linktype');
			echo '<option value="all"',$s==='all'?' selected="selected"':'','>',__('admin.config.display.display.linktype.all'),'</option>';
			echo '<option value="cats"',$s==='cats'?' selected="selected"':'','>',__('admin.config.display.display.linktype.cats'),'</option>';
			echo '<option value="archive"',$s==='archive'?' selected="selected"':'','>',__('admin.config.display.display.linktype.archive'),'</option>';
			echo '</select></label></p>';

			echo '<p><label>',__('admin.config.display.display.numposts'),'<br /><input name="display_numposts" type="text" size="40" value="',max(1,(int)(isset($_POST['display_numposts'])?$_POST['display_numposts']:$FLog_config->GetValue('display.numposts'))),'" /></label></p>';
			echo '<p><label>',__('admin.config.display.display.feedposts'),'<br /><input name="display_feedposts" type="text" size="40" value="',max(1,(int)(isset($_POST['display_feedposts'])?$_POST['display_feedposts']:$FLog_config->GetValue('display.feedposts'))),'" /></label></p>';
			echo '<p><label>',__('admin.config.display.display.numlinks'),'<br /><input name="display_numlinks" type="text" size="40" value="',max(0,(int)(isset($_POST['display_numlinks'])?$_POST['display_numlinks']:$FLog_config->GetValue('display.numlinks'))),'" /></label></p>';
			echo '<p><label>',__('admin.config.display.display.feedlinks'),'<br /><input name="display_feedlinks" type="text" size="40" value="',max(1,(int)(isset($_POST['display_feedlinks'])?$_POST['display_feedlinks']:$FLog_config->GetValue('display.feedlinks'))),'" /></label></p>';
			echo '</fieldset>';
			echo '<p><input name="submitconfig" type="submit" value="',__('admin.config.display.submit'),'" /></p>';			
			echo '</form>';
		}

		function config_discussion_process(){
			if(isset($_POST['submitconfig'], $_POST['comments_markup'], $_POST['comments_staletimeout'], $_POST['comments_oldtimeout'], $_POST['comments_maxsize'])){
				$config = new FLog_Config;
				if($config->Load('flog', true)){
					$config->SetValue('comments.markup', $_POST['comments_markup']);
					$config->SetValue('comments.staletimeout', (int)$_POST['comments_staletimeout']);
					$config->SetValue('comments.oldtimeout', (int)$_POST['comments_oldtimeout']);
					$config->SetValue('comments.anonymous', isset($_POST['comments_anonymous'])?1:0);
					$config->SetValue('comments.blockip', isset($_POST['comments_blockip'])?1:0);
					$config->SetValue('comments.blockreferrer', isset($_POST['comments_blockreferrer'])?1:0);
					$config->SetValue('comments.modall', isset($_POST['comments_modall'])?1:0);
					$config->SetValue('comments.modrepeat', isset($_POST['comments_modrepeat'])?1:0);
					$config->SetValue('comments.emailmod', isset($_POST['comments_emailmod'])?1:0);
					$config->SetValue('comments.emailall', isset($_POST['comments_emailall'])?1:0);
					$config->SetValue('comments.maxsize', (int)$_POST['comments_maxsize']);
					if($config->Save()){
						FLog::CallAction('config.changed');
						FLog::Redirect('?+msg=message.success','p');
					}
					$config->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
		}
		
		function config_discussion_display(){
			global $FLog_config, $FLog_markup;
			$time = time();
			echo '<h1>', __('admin.config.discussion'), '</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.config.discussion.error.database'),'</p>'; break;
				case 'message.success': echo '<p class="message">',__('admin.config.discussion.message.success'),'</p>'; break;
			}
			echo '<form method="post" action="" accept-charset="utf-8">';
			echo '<fieldset><legend>',__('admin.config.discussion.comments'),'</legend>';
			if(isset($_POST['comments_markup'])) $markup = $_POST['comments_markup'];
			else $markup = $FLog_config->GetValue('comments.markup');
			echo '<p><label>',__('admin.config.discussion.comments.markup'),'<br /><select name="comments_markup"><option value="?"',$markup==='?'?' selected="selected"':'','>',__('admin.config.discussion.comments.markup.choice'),'</option>';
			if($markup === '?') $sel = true;
			else $sel = false;
			$markupstring = '';
			foreach(array_keys($FLog_markup) as $key){
				if($markup===$key && $markup!=='?') $sel = true;
				$markupstring .= '<option value="'.htmlspecialchars($key).'"'.(($markup===$key && $markup!=='?')?' selected="selected"':'').'>'.$FLog_markup[$key]['name'].'</option>';
			}
			echo '<option value=""',(!$sel?' selected="selected"':''),'>',__('admin.config.discussion.comments.markup.none'),'</option>',$markupstring,'</select></label></p>';
			echo '<p><label>',__('admin.config.discussion.comments.staletimeout'),'<br /><input name="comments_staletimeout" type="text" value="',(int)(isset($_POST['comments_staletimeout'])?$_POST['comments_staletimeout']:$FLog_config->GetValue('comments.staletimeout')),'" /></label></p>';
			echo '<p><label>',__('admin.config.discussion.comments.oldtimeout'),'<br /><input name="comments_oldtimeout" type="text" value="',(int)(isset($_POST['comments_oldtimeout'])?$_POST['comments_oldtimeout']:$FLog_config->GetValue('comments.oldtimeout')),'" /></label></p>';
			echo '<p><label><input name="comments_anonymous" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_anonymous'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.anonymous')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.anonymous'),'</label></p>';
			echo '<p><label><input name="comments_blockip" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_blockip'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.blockip')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.blockip'),'</label></p>';
			echo '<p><label><input name="comments_blockreferrer" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_blockreferrer'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.blockreferrer')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.blockreferrer'),'</label></p>';
			echo '<p><label><input name="comments_modall" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_modall'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.modall')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.modall'),'</label></p>';
			echo '<p><label><input name="comments_modrepeat" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_modrepeat'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.modrepeat')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.modrepeat'),'</label></p>';
			echo '<p><label><input name="comments_emailmod" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_emailmod'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.emailmod')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.emailmod'),'</label></p>';
			echo '<p><label><input name="comments_emailall" type="checkbox" ',isset($_POST['submitconfig'])?(isset($_POST['comments_emailall'])?' checked="checked"':''):((int)$FLog_config->GetValue('comments.emailall')==1?' checked="checked"':''),'/> ',__('admin.config.discussion.comments.emailall'),'</label></p>';
			echo '<p><label>',__('admin.config.discussion.comments.maxsize'),'<br /><input name="comments_maxsize" type="text" value="',(int)(isset($_POST['comments_maxsize'])?$_POST['comments_maxsize']:$FLog_config->GetValue('comments.maxsize')),'" /></label></p>';
			echo '</fieldset>';
			echo '<p><input name="submitconfig" type="submit" value="',__('admin.config.discussion.submit'),'" /></p>';			
			echo '</form>';
		}

		function config_permissions_process(){
			if(isset($_POST['submitconfig'],$_POST['permissions_plugins'],$_POST['permissions_themes'],$_POST['permissions_write_posts'],$_POST['permissions_write_pages'],$_POST['permissions_manage_posts'],$_POST['permissions_manage_pages'],$_POST['permissions_manage_comments'],$_POST['permissions_manage_categories'],$_POST['permissions_manage_users'],$_POST['permissions_manage_links'],$_POST['permissions_config_general'],$_POST['permissions_config_discussion'],$_POST['permissions_config_permissions'])){
				$config = new FLog_Config;
				if($config->Load('flog', true)){
					$config->SetValue('permissions.plugins', (int)$_POST['permissions_plugins']);
					$config->SetValue('permissions.themes', (int)$_POST['permissions_themes']);
					$config->SetValue('permissions.write.posts', (int)$_POST['permissions_write_posts']);
					$config->SetValue('permissions.write.pages', (int)$_POST['permissions_write_pages']);
					$config->SetValue('permissions.manage.posts', (int)$_POST['permissions_manage_posts']);
					$config->SetValue('permissions.manage.pages', (int)$_POST['permissions_manage_pages']);
					$config->SetValue('permissions.manage.comments', (int)$_POST['permissions_manage_comments']);
					$config->SetValue('permissions.manage.categories', (int)$_POST['permissions_manage_categories']);
					$config->SetValue('permissions.manage.users', (int)$_POST['permissions_manage_users']);
					$config->SetValue('permissions.manage.links', (int)$_POST['permissions_manage_links']);
					$config->SetValue('permissions.manage.files', isset($_POST['permissions_manage_files'])?(int)$_POST['permissions_manage_files']:1);
					$config->SetValue('permissions.config.general', (int)$_POST['permissions_config_general']);
					$config->SetValue('permissions.config.display', (int)$_POST['permissions_config_display']);
					$config->SetValue('permissions.config.discussion', (int)$_POST['permissions_config_discussion']);
					$config->SetValue('permissions.config.permissions', (int)$_POST['permissions_config_permissions']);
					if($config->Save()){
						FLog::CallAction('config.changed');
						FLog::Redirect('?+msg=message.success','p');
					}
					$config->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
		}
		
		function config_permissions_display(){
			global $FLog_config, $FLog_adminpages;
			echo '<h1>', __('admin.config.permissions'), '</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.config.permissions.error.database'),'</p>'; break;
				case 'message.success': echo '<p class="message">',__('admin.config.permissions.message.success'),'</p>'; break;
			}
			echo '<form method="post" action="" accept-charset="utf-8">';
			echo '<fieldset><legend>',__('admin.config.permissions.global'),'</legend>';
			echo '<p><label>',__('admin.config.permissions.global.plugins'),'<br /><input name="permissions_plugins" type="text" size="40" value="',(int)(isset($_POST['permissions_plugins'])?$_POST['permissions_plugins']:$FLog_config->GetValue('permissions.plugins')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.global.themes'),'<br /><input name="permissions_themes" type="text" size="40" value="',(int)(isset($_POST['permissions_themes'])?$_POST['permissions_themes']:$FLog_config->GetValue('permissions.themes')),'" /></label></p>';
			echo '</fieldset>';
			echo '<fieldset><legend>',__('admin.config.permissions.write'),'</legend>';
			echo '<p><label>',__('admin.config.permissions.write.posts'),'<br /><input name="permissions_write_posts" type="text" size="40" value="',(int)(isset($_POST['permissions_write_posts'])?$_POST['permissions_write_posts']:$FLog_config->GetValue('permissions.write.posts')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.write.pages'),'<br /><input name="permissions_write_pages" type="text" size="40" value="',(int)(isset($_POST['permissions_write_pages'])?$_POST['permissions_write_pages']:$FLog_config->GetValue('permissions.write.pages')),'" /></label></p>';
			echo '</fieldset>';
			echo '<fieldset><legend>',__('admin.config.permissions.manage'),'</legend>';
			echo '<p><label>',__('admin.config.permissions.manage.posts'),'<br /><input name="permissions_manage_posts" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_posts'])?$_POST['permissions_manage_posts']:$FLog_config->GetValue('permissions.manage.posts')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.manage.pages'),'<br /><input name="permissions_manage_pages" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_pages'])?$_POST['permissions_manage_pages']:$FLog_config->GetValue('permissions.manage.pages')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.manage.comments'),'<br /><input name="permissions_manage_comments" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_comments'])?$_POST['permissions_manage_comments']:$FLog_config->GetValue('permissions.manage.comments')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.manage.categories'),'<br /><input name="permissions_manage_categories" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_categories'])?$_POST['permissions_manage_categories']:$FLog_config->GetValue('permissions.manage.categories')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.manage.users'),'<br /><input name="permissions_manage_users" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_users'])?$_POST['permissions_manage_users']:$FLog_config->GetValue('permissions.manage.users')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.manage.links'),'<br /><input name="permissions_manage_links" type="text" size="40" value="',(int)(isset($_POST['permissions_manage_links'])?$_POST['permissions_manage_links']:$FLog_config->GetValue('permissions.manage.links')),'" /></label></p>';
			if(isset($FLog_adminpages['manage']['files'])){
				echo '<p><label>',__('admin.config.permissions.manage.files'),'<br /><input name="permissions_manage_files" type="text" size="40" value="',(int)(isset($_POST['permisisons_manage_files'])?$_POST['permissions_manage_files']:$FLog_config->GetValue('permissions.manage.files')),'" /></label></p>';
			}
			echo '</fieldset>';
			echo '<fieldset><legend>',__('admin.config.permissions.config'),'</legend>';
			echo '<p><label>',__('admin.config.permissions.config.general'),'<br /><input name="permissions_config_general" type="text" size="40" value="',(int)(isset($_POST['permissions_config_general'])?$_POST['permissions_config_general']:$FLog_config->GetValue('permissions.config.general')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.config.display'),'<br /><input name="permissions_config_display" type="text" size="40" value="',(int)(isset($_POST['permissions_config_display'])?$_POST['permissions_config_display']:$FLog_config->GetValue('permissions.config.display')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.config.discussion'),'<br /><input name="permissions_config_discussion" type="text" size="40" value="',(int)(isset($_POST['permissions_config_discussion'])?$_POST['permissions_config_discussion']:$FLog_config->GetValue('permissions.config.discussion')),'" /></label></p>';
			echo '<p><label>',__('admin.config.permissions.config.permissions'),'<br /><input name="permissions_config_permissions" type="text" size="40" value="',(int)(isset($_POST['permissions_config_permissions'])?$_POST['permissions_config_permissions']:$FLog_config->GetValue('permissions.config.permissions')),'" /></label></p>';
			echo '</fieldset>';
			echo '<p><input name="submitconfig" type="submit" value="',__('admin.config.permissions.submit'),'" /></p>';			
			echo '</form>';
		}

		function manage_cats_process(){
			if(isset($_POST['confirmedit'], $_POST['cid'], $_POST['name'], $_POST['description'])){
				$cid = (int)$_POST['cid'];
				$cats = new FLog_Database;
				if($cats->Load('cats', true)){
					if(isset($cats->records[$cid]) && $cats->records[$cid]->Load('cats', $cid)){
						$cats->records[$cid]->SetValue('name', $_POST['name']);
						$cats->records[$cid]->SetValue('description', $_POST['description']);
						if($cats->Save()){
							FLog::CallAction('category.edited', &$cats->records[$cid]);
							FLog::Redirect('?+msg=message.editsuccess','p');
						}
					}
					$cats->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['confirmdelete'], $_POST['cid'])){
				$cid = (int)$_POST['cid'];
				$cats = new FLog_Database;
				if($cats->Load('cats', true)){
					if(isset($cats->records[(int)$_POST['cid']])){
						$cat = $cats->records[$cid];
						$cats->DeleteRecord((int)$_POST['cid']);
						if($cats->Save()){
							FLog::CallAction('category.deleted', &$cat);
							FLog::Redirect('?+msg=message.deletesuccess','p');
						}
					}
					$cats->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['newcat'], $_POST['name'], $_POST['description'])){
				$cats = new FLog_Database;
				if($cats->Load('cats', true)){
					$cat = new FLog_DatabaseRecord;
					$cat->SetValue('name', $_POST['name']);
					$cat->SetValue('description', $_POST['description']);
					$cat->SetValue('posts', 0);
					$cats->InsertRecord($cat);
					if($cats->Save()){
						FLog::CallAction('category.added', &$cat);
						FLog::Redirect('?+msg=message.newsuccess','p');
					}
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['recalc'])){
				$cats = new FLog_Database;
				$posts = new FLog_Database;
				$links = new FLog_Database;
				if($cats->Load('cats', true) && $posts->Load('posts', true) && $links->Load('links', true)){
					foreach(array_keys($cats->records) as $key){
						$cats->records[$key]->Load('cats', $key);
						$cats->records[$key]->SetValue('posts', 0);
						$cats->records[$key]->SetValue('links', 0);
					}
					foreach(array_keys($posts->records) as $key){
						$cat_array = explode(',', $posts->records[$key]->GetValue('cats'));
						foreach($cat_array as $cat){
							if($cat==='') break;
							$cat = (int)$cat;
							if(isset($cats->records[$cat])) $cats->records[$cat]->SetValue('posts', 1+(int)$cats->records[$cat]->GetValue('posts'));
						}
					}
					foreach(array_keys($links->records) as $key){
						$cat_array = explode(',', $links->records[$key]->GetValue('cats'));
						foreach($cat_array as $cat){
							if($cat==='') break;
							$cat = (int)$cat;
							if(isset($cats->records[$cat])) $cats->records[$cat]->SetValue('links', 1+(int)$cats->records[$cat]->GetValue('links'));
						}
					}
					if($cats->Save()){
						$posts->Unlock();
						$links->Unlock();
						FLog::Redirect('','p');
					}
				}
				$_GET['msg'] = 'error.database';
				$cats->Unlock();
				$posts->Unlock();
				$links->Unlock();
			}
			elseif(isset($_POST['canceledit'])) FLog::Redirect('?+msg=message.editcancel','p');
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel','p');
		}
		
		function manage_cats_display(){
			$cats = new FLog_Database; $cats->Load('cats'); $cats->LoadAll();
			$cats->Sort('name', SORT_ASC, 'strnatcasecmp');
			$editmode = $deletemode = false; $cid = -1;
			if(isset($_POST['cid'])){
				$cid = (int)$_POST['cid'];
				if(isset($_POST['editcat'], $cats->records[$cid])) $editmode = true;
				elseif(isset($_POST['deletecat'], $cats->records[$cid])) $deletemode = true;
			}
			echo '<h1>',__('admin.manage.cats'),'</h1>';
			
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.manage.cats.error.database'),'</p>'; break;
				case 'message.editsuccess': echo '<p class="message">',__('admin.manage.cats.message.editsuccess'),'</p>'; break;
				case 'message.editcancel': echo '<p class="message">',__('admin.manage.cats.message.editcancel'),'</p>'; break;
				case 'message.deletesuccess': echo '<p class="message">',__('admin.manage.cats.message.deletesuccess'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.cats.message.deletecancel'),'</p>'; break;
				case 'message.newsuccess': echo '<p class="message">',__('admin.manage.cats.message.newsuccess'),'</p>'; break;
			}
			
			if($deletemode){
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><input name="cid" type="hidden" value="',$cid,'" />';
				echo '<p>',__('admin.manage.cats.delete.message', $cats->records[$cid]->GetEntities('name')),'</p>';
				echo '<p><input name="confirmdelete" type="submit" value="',__('admin.manage.cats.delete.confirm'),'" /> <input name="canceldelete" type="submit" value="',__('admin.manage.cats.delete.cancel'),'" /></p>';
				echo '</form>';
			}
			else{
				if($editmode) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
				echo '<table class="admintable">';
				echo '<colgroup><col class="oddcol" style="width:5%" /><col class="evencol" style="width:25%" /><col class="oddcol" style="width:40%" /><col class="evencol" style="width:5%;" /><col class="oddcol" style="width:5%" /><col class="evencol" style="width:20%" /></colgroup>';
				echo '<thead><tr><td>',__('admin.manage.cats.id'),'</td><td>',__('admin.manage.cats.name'),'</td><td>',__('admin.manage.cats.description'),'</td><td>',__('admin.manage.cats.links'),'</td><td>',__('admin.manage.cats.posts'),'</td><td>',__('admin.manage.cats.action'),'</td></tr></thead><tbody>';
				$i=0;
				foreach(array_keys($cats->records) as $key){
					if($editmode && $cid==$key) echo ((++$i) % 2 == 1)?'<tr class="oddrow current">':'<tr class="evenrow current">';
					else echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
					echo '<td>',$key,'</td>';
					if($editmode && $key === $cid){
						echo '<td><input name="name" type="text" size="16" value="',isset($_POST['confirmedit'], $_POST['name'])?htmlspecialchars($_POST['name']):$cats->records[$key]->GetSafe('name'),'" /></td>';
						echo '<td><input name="description" type="text" size="28" value="',isset($_POST['confirmedit'], $_POST['description'])?htmlspecialchars($_POST['description']):$cats->records[$key]->GetSafe('description'),'" /></td>';
						echo '<td>',(int)$cats->records[$key]->GetValue('links'),'</td>';
						echo '<td>',(int)$cats->records[$key]->GetValue('posts'),'</td>';
						echo '<td><input name="cid" type="hidden" value="',$key,'" /><input name="confirmedit" type="submit" value="',__('admin.manage.cats.edit.confirm'),'" /> <input name="canceledit" type="submit" value="',__('admin.manage.cats.edit.cancel'),'" /></td>';
					}
					else{
						echo '<td><a href="index.php?cat=',$key,'">',$cats->records[$key]->GetEntities('name'),'</a></td>';
						echo '<td>',$cats->records[$key]->GetEntities('description'),'</td>';
						echo '<td>',(int)$cats->records[$key]->GetValue('links'),'</td>';
						echo '<td>',(int)$cats->records[$key]->GetValue('posts'),'</td>';
						echo '<td>';
						if(!$editmode){
							echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><input name="cid" type="hidden" value="',$key,'" />';
							echo '<input name="editcat" type="submit" value="',__('admin.manage.cats.edit'),'" /> <input name="deletecat" type="submit" value="',__('admin.manage.cats.delete'),'" />';
							echo '</form>';
						}
						echo '</td>';
					}
					echo '</tr>';
				}
				echo '</tbody></table>';
				if($editmode) echo '</form>';
				else{
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
					echo '<fieldset><legend>',__('admin.manage.cats.new'),'</legend>';
					echo '<p><label>',__('admin.manage.cats.new.name'),'<br /><input name="name" type="text" size="40" value="',isset($_POST['newcat'], $_POST['name'])?htmlspecialchars($_POST['name']):'','" /></label></p>';
					echo '<p><label>',__('admin.manage.cats.new.description'),'<br /><input name="description" type="text" size="40" value="',isset($_POST['newcat'], $_POST['description'])?htmlspecialchars($_POST['description']):'','" /></label></p>';
					echo '<p><input name="newcat" type="submit" value="',__('admin.manage.cats.new.submit'),'" /></p>';
					echo '</fieldset></form>';
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><p><input type="submit" name="recalc" value="',__('admin.manage.cats.recalc'),'" /></p></form>';
				}
			}
		}

		function manage_links_process(){
			global $FLog_user;
			if(isset($_POST['each'], $_POST['seteach'])){
				if(($each = (int)$_POST['each'])>=1){
					$users = new FLog_Database;
					if($users->Load('users', true)){
						if(isset($users->records[$FLog_user->rid])){
							if($users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
								$users->records[$FLog_user->rid]->SetValue('admin.manage.links.each', $each);
								$users->Save();
							}
						}
						$users->Unlock();
					}
				}
				FLog::Redirect('','p','sort','cat','user','page');
			}
			elseif(isset($_POST['newlink'], $_POST['title'], $_POST['url'])){
				$links = new FLog_Database();
				$cats = new FLog_Database();
				if($links->Load('links', true) && $cats->Load('cats', true)){
					$cats->LoadAll();
					$link = new FLog_DatabaseRecord;
					$link->SetValue('title', $_POST['title']);
					$link->SetValue('url', $_POST['url']);
					$catarray = array();
					if(isset($_POST['cats'])){
						foreach($_POST['cats'] as $cat){
							$cat = (int)$cat;
							if(isset($cats->records[$cat])){
								$cats->records[$cat]->SetValue('links', 1+(int)$cats->records[$cat]->GetValue('links'));
								$catarray[] = $cat;
							}
						}
					}
					$link->SetValue('cats', implode(',',$catarray));
					$link->SetValue('time', FLog::ServerTime());
					$link->SetValue('author', $FLog_user->rid);
					$link->SetValue('sticky', isset($_POST['sticky'])?1:0);
					$links->InsertRecord($link);
					if($links->Save()){
						$cats->Save();
						FLog::CallAction('link.added', &$link);
						FLog::Redirect('?+msg=message.createsuccess', 'p', 'sort', 'cat', 'user', 'page');
					}
				}
				$links->Unlock();
				$cats->Unlock();
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['lid'], $_POST['confirmedit'], $_POST['title'], $_POST['url'])){
				$links = new FLog_Database();
				$cats = new FLog_Database();
				$users = new FLog_Database();
				if($links->Load('links',true) && $cats->Load('cats', true) && $users->Load('users', true)){
					$cats->LoadAll();
					if(isset($links->records[$lid = (int)$_POST['lid']]) && $links->records[$lid]->Load('links', $lid)){
						$uid = (int)$links->records[$lid]->GetValue('author');
						if($uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users',$uid) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
							$link = $links->records[$lid];
							foreach(explode(',', $link->GetValue('cats')) as $cat){
								if($cat === '') continue;
								if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('links', max((int)$cats->records[$cat]->GetValue('links')-1,0));
							}
							$catarray = array();
							if(isset($_POST['cats'])){
								foreach($_POST['cats'] as $cat){
									if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('links', (int)$cats->records[$cat]->GetValue('links')+1);
									$catarray[] = $cat;
								}
							}
							$links->records[$lid]->SetValue('title', $_POST['title']);
							$links->records[$lid]->SetValue('url', $_POST['url']);
							if(isset($_POST['now'])) $links->records[$lid]->SetValue('time', FLog::ServerTime());
							$links->records[$lid]->SetValue('cats', implode(',', $catarray));
							$links->records[$lid]->SetValue('sticky', isset($_POST['sticky'])?1:0);
							if($links->Save()){
								$cats->Save();
								$users->Unlock();
								FLog::CallAction('link.edited', &$link);
								FLog::Redirect('?+msg=message.editsuccess','p','sort','cat','user','page');
							}
						}
					}
				}
				$links->Unlock(); $cats->Unlock(); $users->Unlock();
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['lid'], $_POST['confirmdelete'])){
				$links = new FLog_Database();
				$cats = new FLog_Database();
				$users = new FLog_Database();
				if($links->Load('links',true) && $cats->Load('cats', true) && $users->Load('users', true)){
					$cats->LoadAll();
					if(isset($links->records[$lid = (int)$_POST['lid']])){
						$uid = (int)$links->records[$lid]->GetValue('author');
						if($uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users',$uid) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
							$link = $links->records[$lid];
							$links->DeleteRecord($lid);
							if($links->Save()){
								foreach(explode(',', $link->GetValue('cats')) as $cat){
									if($cat === '') continue;
									if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('links', max((int)$cats->records[$cat]->GetValue('links')-1,0));
								}
								$cats->Save();
								$users->Unlock();
								FLog::CallAction('link.deleted', &$link);
								FLog::Redirect('?+msg=message.deletesuccess','p','sort','cat','user','page');
							}
						}
					}
				}
				$links->Unlock(); $cats->Unlock(); $users->Unlock();
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['canceledit'])) FLog::Redirect('?+msg=message.editcancel', 'p', 'sort', 'cat', 'user', 'page');
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel', 'p', 'sort', 'cat', 'user', 'page');
		}
		
		function manage_links_display(){
			global $FLog_user;
			echo '<h1>',__('admin.manage.links'),'</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.manage.links.error.database'),'</p>'; break;
				case 'message.createsuccess': echo '<p class="message">',__('admin.manage.links.message.createsuccess'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.links.message.deletecancel'),'</p>'; break;
				case 'message.deletesuccess': echo '<p class="message">',__('admin.manage.links.message.deletesuccess'),'</p>'; break;
				case 'message.editcancel': echo '<p class="message">',__('admin.manage.links.message.editcancel'),'</p>'; break;
				case 'message.editsuccess': echo '<p class="message">',__('admin.manage.links.message.editsuccess'),'</p>'; break;
			}
			$links = new FLog_Database;
			$links->Load('links');
			$users = new FLog_Database;
			if($users->Load('users')) $users->LoadAll();
			if(isset($_POST['lid'], $_POST['deletelink'])){
				$lid = (int)$_POST['lid'];
				if(isset($links->records[$lid])){
					$uid = (int)$links->records[$lid]->GetValue('author');
					if($uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users',$uid) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8"><input type="hidden" name="lid" value="',$lid,'" />';
						echo '<p>',__('admin.manage.links.delete.message', $links->records[$lid]->GetEntities('title')),'</p>';
						echo '<p><input name="confirmdelete" type="submit" value="',__('admin.manage.links.delete.confirm'),'" /> <input name="canceldelete" type="submit" value="',__('admin.manage.links.delete.cancel'),'" /></p>';
						echo '</form>';
						return;
					}
				}
			}
			if(isset($_POST['lid'], $_POST['editlink']) && isset($links->records[(int)$_POST['lid']])){
				$edit = (int)$_POST['lid'];
			}
			else $edit = false;
			switch((string)@$_GET['sort']){
				case 'ida': $links->Sort(false, SORT_ASC); $sort = 'ida'; break;
				case 'id': case 'idd': $links->Sort(false, SORT_DESC); $sort = 'idd'; break;
				case 'title': case 'titlea': $links->Sort('title', SORT_ASC, 'strnatcasecmp'); $sort = 'titlea'; break;
				case 'titled': $links->Sort('title', SORT_DESC, 'strnatcasecmp'); $sort = 'titled'; break;
				case 'timea': $links->Sort('time', SORT_ASC, 'strnatcmp'); $sort = 'timea'; break;
				case 'time': case 'timed': $links->Sort('time', SORT_DESC, 'strnatcmp'); $sort = 'timed'; break;
				case 'url': case 'urla': $links->Sort('url', SORT_ASC, 'strnatcasecmp'); $sort = 'urla'; break;
				case 'urld': $links->Sort('url', SORT_DESC, 'strnatcasecmp'); $sort = 'urld'; break;
				case 'statusa': $links->SortRecords(SORT_ASC, array('FLog', 'LinkSort')); $sort = 'statusa'; break;
				case 'status': case 'statusd': default: $links->SortRecords(SORT_DESC, array('FLog', 'LinkSort')); $sort = 'statusd'; break;
			}
			$cats = new FLog_Database;
			if($cats->Load('cats')) $cats->LoadAll();
			$cats->Sort('name', SORT_ASC, 'strnatcasecmp');
			if($edit!==false) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8">';
			echo '<table class="admintable">';
			echo '<colgroup>';
			echo '<col class="oddcol" style="width:5%;" />'; // id
			echo '<col class="evencol" style="width:15%;" />'; // title
			echo '<col class="oddcol" style="width:15%;" />'; // url
			echo '<col class="evencol" style="width:15%;" />'; // date
			echo '<col class="oddcol" style="width:10%;" />'; // author
			echo '<col class="evencol" style="width:10%;" />'; // cats
			echo '<col class="oddcol" style="width:10%;" />'; // status
			echo '<col class="evencol" style="width:20%;" />'; // action
			echo '</colgroup>';
			echo '<thead>';
			echo '<tr>';
			echo '<td><a href="admin.php?sort=',$sort==='idd'?'ida':'idd',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.links.id'),'</a>',$sort==='ida'?'&#160;&#8595;':($sort==='idd'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='titlea'?'titled':'titlea',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.links.title'),'</a>',$sort==='titlea'?'&#160;&#8595;':($sort==='titled'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='urla'?'urld':'urla',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.links.url'),'</a>',$sort==='urla'?'&#160;&#8595;':($sort==='urld'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='timed'?'timea':'timed',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.links.time'),'</a>',$sort==='timea'?'&#160;&#8595;':($sort==='timed'?'&#160;&#8593;':''),'</td>';
			echo '<td>',__('admin.manage.links.author'),'</td>';
			echo '<td>',__('admin.manage.links.cats'),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='statusd'?'statusa':'statusd',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.links.status'),'</a>',$sort==='statusa'?'&#160;&#8595;':($sort==='statusd'?'&#160;&#8593;':''),'</td>';
			echo '<td>',__('admin.manage.links.action'),'</td>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$page = isset($_GET['page'])?max(1,(int)$_GET['page']):1;
			$each = $FLog_user->HasValue('admin.manage.links.each')?max(1,(int)$FLog_user->GetValue('admin.manage.links.each')):10;
			$skip = ($page - 1)*$each;
			$max = $each;
			$numlinks = 0;
			$limituser = isset($_GET['user'])?(int)$_GET['user']:false;
			$limitcat = isset($_GET['cat'])?(int)$_GET['cat']:false;
			$i=0;
			foreach(array_keys($links->records) as $key){
				if($limituser!==false && $limituser!=(int)$links->records[$key]->GetValue('author')) continue;
				if($limitcat!==false && !in_array((string)$limitcat, explode(',', $links->records[$key]->GetValue('cats')))) continue;
				++$numlinks;
				if($skip > 0){
					--$skip;
					continue;
				}
				if($max <= 0) continue;
				else --$max;
				$links->records[$key]->Load('links', $key);

				if($edit === $key){
					echo ((++$i) % 2 == 1)?'<tr class="oddrow current">':'<tr class="evenrow current">';
					echo '<td>', $key, '</td>';
					echo '<td><input type="text" size="12" name="title" value="',$links->records[$key]->GetSafe('title'),'" /></td>';
					echo '<td><input type="text" size="16" name="url" value="',$links->records[$key]->GetSafe('url'),'" /></td>';
					echo '<td><input type="checkbox" name="now"',isset($_POST['now'])?' checked="checked"':'',' /> ',__('admin.manage.links.edit.now'),'</td>';
					echo '<td>';
					if(isset($users->records[$uid = (int)$links->records[$key]->GetValue('author')])){
						echo '<a href="admin.php?user=',$uid,FLog::AppendQuerySafe('','p','sort','cat'),'">',$users->records[$uid]->GetEntities('name'),'</a>';
					}
					echo '</td>';
					if(trim($c = $links->records[$key]->GetValue('cats'))!=='') $catarray = FLog::IntExplode(',',$c);
					else $catarray = array();
					
					echo '<td><select name="cats[]" multiple="multiple" size="',min(count($cats->records),3),'">';
					foreach(array_keys($cats->records) as $key2){
						echo '<option value="',$key2,'"',in_array($key2,$catarray)?' selected="selected"':'','>',$cats->records[$key2]->GetEntities('name'),'</option>';
					}
					echo '</select></td>';
					echo '<td><input type="checkbox" name="sticky"',(int)$links->records[$key]->GetValue('sticky')===1?' checked="checked"':'',' /> ',__('admin.manage.links.edit.sticky'),'</td>';
					echo '<td>';
					echo '<input name="lid" type="hidden" value="',$key,'" />';
					echo '<input name="confirmedit" type="submit" value="',__('admin.manage.links.edit.confirm'),'" /> ';
					echo '<input name="canceledit" type="submit" value="',__('admin.manage.links.edit.cancel'),'" />';
					echo '</td></tr>';
				}
				else{
					echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
					echo '<td>', $key, '</td>';
					echo '<td>',$links->records[$key]->GetEntities('title'),'</td>';
					echo '<td><a href="',$links->records[$key]->GetSafe('url'),'">',$links->records[$key]->GetSafe('url'),'</a></td>';
					echo '<td>', __('admin.manage.links.time.display', FLog::FormatLocalDate((int)$links->records[$key]->GetValue('time')), FLog::FormatLocalTime((int)$links->records[$key]->GetValue('time'))), '</td>';
					echo '<td>';
					if(isset($users->records[$uid = (int)$links->records[$key]->GetValue('author')])){
						echo '<a href="admin.php?user=',$uid,FLog::AppendQuerySafe('','p','sort','cat'),'">',$users->records[$uid]->GetEntities('name'),'</a>';
					}
					echo '</td>';
					$catarray = array();
					foreach(explode(',', $links->records[$key]->GetValue('cats')) as $cat){
						if($cat === '') continue;
						if(isset($cats->records[(int)$cat])) $catarray[] = '<a href="admin.php?cat='.(int)$cat.FLog::AppendQuerySafe('','p','sort','user').'">'.$cats->records[(int)$cat]->GetEntities('name').'</a>';
					}
					echo '<td>', implode(', ', $catarray), '</td>';
					echo '<td>';
					if((int)$links->records[$key]->GetValue('sticky')==1) _e('admin.manage.links.status.sticky');
					echo '</td>';
					echo '<td>';
					if($edit===false && ($uid === $FLog_user->rid || (isset($users->records[$uid]) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank')))){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8">';
						echo '<input name="lid" type="hidden" value="',$key,'" />';
						echo '<input name="editlink" type="submit" value="',__('admin.manage.links.edit'),'" /> ';
						echo '<input name="deletelink" type="submit" value="',__('admin.manage.links.delete'),'" />';
						echo '</form>';
					}
					echo '</td></tr>';
				}
			}
			echo '</tbody></table>';
			if($edit!==false) echo '</form>';
			else{
				$numpages = ceil($numlinks / $each);
				echo '<p>';
				if($page < 1 || $page > $numpages){
					for($i=1; $i<=$numpages; ++$i){
						if($i > 3 && $i < $numpages - 2){
							echo '&hellip; ';
							$i = $numpages - 2;
						}
						echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort','cat','user'),'">',$i,'</a> ';
					}
				}
				else{
					for($i=1; $i<=$numpages; ++$i){
						if($i > 3 && $i < $page - 2){
							echo '&hellip; ';
							$i = $page - 2;
						}
						elseif($i > $page + 2 && $i < $numpages - 2){
							echo '&hellip; ';
							$i = $numpages - 2;
						}
						
						if($i == $page){
							echo '<strong>[',$i,']</strong> ';
						}
						else{
							echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort','cat','user'),'">',$i,'</a> ';
						}
					}
				}
				echo '</p>';
	
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user'),'" accept-charset="utf-8"><p><label>',__('admin.manage.links.each'),'<br /><input type="text" name="each" value="',$each,'" /></label> <input type="submit" name="seteach" value="',__('admin.manage.links.each.submit'),'" /></p></form>';
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user'),'" accept-charset="utf-8"><fieldset><legend>',__('admin.manage.links.new'),'</legend>';
				echo '<p><label>',__('admin.manage.links.new.title'),'<br /><input type="text" name="title" size="40" value="',isset($_POST['newlink'], $_POST['title'])?htmlspecialchars($_POST['title']):'','" /></label></p>';
				echo '<p><label>',__('admin.manage.links.new.url'),'<br /><input type="text" name="url" size="40" value="',isset($_POST['newlink'], $_POST['url'])?htmlspecialchars($_POST['url']):'','" /></label></p>';
				echo '<p><label>',__('admin.manage.links.new.cats'),'<br /><select name="cats[]" multiple="multiple" size="',min(count($cats->records),5),'">';
				foreach(array_keys($cats->records) as $key){
					echo '<option value="',$key,'"',isset($_POST['newlink'], $_POST['cats'])&&in_array((string)$key,$_POST['cats'])?' selected="selected"':'','>',$cats->records[$key]->GetEntities('name'),'</option>';
				}
				echo '</select></label></p>';
				echo '<p><label><input type="checkbox" name="sticky"',isset($_POST['newlink'], $_POST['sticky'])?' checked="checked"':'',' /> ',__('admin.manage.links.new.sticky'),'</label></p>';
				echo '<p><input type="submit" name="newlink" value="',__('admin.manage.links.new.submit'),'" /></p>';
				echo '</fieldset></form>';
			}
		}

		function manage_comments_statuscallback(&$a, &$b){
			$s = ((int)$a->GetValue('moderated')==1?1:0)-((int)$b->GetValue('moderated')==1?1:0);
			if($s==0) return (int)$a->GetValue('time') - (int)$b->GetValue('time');
			return $s;
		}
		function manage_comments_process(){
			global $FLog_user;
			// support moderation via e-mail
			if(isset($_GET['approve'])){
				$_POST['approvecomment'] = 'approvecomment';
				$_POST['cid'] = (int)$_GET['approve'];
			}
			elseif(isset($_GET['delete'])){
				$_POST['confirmdelete'] = 'confirmdelete';
				$_POST['cid'] = (int)$_GET['delete'];
			}
			elseif(isset($_GET['edit'])){
				$_POST['editcomment'] = 'editcomment';
				$_POST['cid'] = (int)$_GET['edit'];
			}
			if(isset($_POST['cid'], $_POST['approvecomment'])){
				$posts = new FLog_Database;
				$users = new FLog_Database;
				$comments = new FLog_Database;
				if($posts->Load('posts', true) && $users->Load('users', true) && $comments->Load('comments', true)){
					if(isset($comments->records[$cid = (int)$_POST['cid']]) && $comments->records[$cid]->Load('comments', $cid)){
						if(isset($posts->records[$pid = (int)$comments->records[$cid]->GetValue('post')]) && $posts->records[$pid]->Load('posts', $pid)){
							if(isset($users->records[$uid = (int)$posts->records[$pid]->GetValue('author')])){
								if((int)$FLog_user->GetValue('rank')===1 || $uid === $FLog_user->rid || (isset($users->records[$uid]) && (int)$users->records[$uid]->GetValue('rank')>(int)$FLog_user->GetValue('rank'))){
									$comments->records[$cid]->SetValue('moderated', 0);
									$posts->records[$pid]->SetValue('comments', 1+(int)$posts->records[$pid]->GetValue('comments'));
									$users->Unlock();
									if($comments->Save()){
										$posts->Save();
										FLog::CallAction('comment.approved', &$comments->records[$cid]);
										FLog::Redirect('?+msg=message.approve','p','sort','page');
									}
								}
							}
						}
					}
				}
				$comments->Unlock();
				$users->Unlock();
				$posts->Unlock();
				FLog::Redirect('?+msg=error.database','p','sort','page');
			}
			elseif(isset($_POST['cid'], $_POST['confirmdelete'])){
				$posts = new FLog_Database;
				$users = new FLog_Database;
				$comments = new FLog_Database;
				if($posts->Load('posts', true) && $users->Load('users', true) && $comments->Load('comments', true)){
					if(isset($comments->records[$cid = (int)$_POST['cid']]) && $comments->records[$cid]->Load('comments', $cid)){
						if(isset($posts->records[$pid = (int)$comments->records[$cid]->GetValue('post')])){
							if($posts->records[$pid]->Load('posts', $pid)){
								if((int)$FLog_user->GetValue('rank')===1 || $uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users', $uid) && (int)$users->records[$uid]->GetValue('rank')>(int)$FLog_user->GetValue('rank'))){
									$comment = $comments->records[$cid];
									$comments->DeleteRecord($cid);
									if((int)$comment->GetValue('moderated')!==1){
										$posts->records[$pid]->SetValue('comments', max(0,(int)$posts->records[$pid]->GetValue('comments') - 1));
									}
									$users->Unlock();
									if($comments->Save()){
										$posts->Save();
										FLog::CallAction('comment.deleted', &$comment);
										FLog::Redirect('?+msg=message.deletesuccess','p','sort','page');
									}
								}
							}
						}
						elseif((int)$FLog_user->GetValue('rank')==1){
							$comments->DeleteRecord($cid);
							$users->Unlock();
							$posts->Unlock();
							if($comments->Save()) FLog::Redirect('?+msg=message.deletesuccess','p','sort','page');
						}
					}
				}
				$comments->Unlock();
				$users->Unlock();
				$posts->Unlock();
				FLog::Redirect('?+msg=error.database','p','sort','page');
			}
			elseif(isset($_POST['cid'], $_POST['name'], $_POST['email'], $_POST['url'], $_POST['markup'], $_POST['text'], $_POST['confirmedit'])){
				$posts = new FLog_Database;
				$users = new FLog_Database;
				$comments = new FLog_Database;
				if($posts->Load('posts', true) && $users->Load('users', true) && $comments->Load('comments', true)){
					if(isset($comments->records[$cid = (int)$_POST['cid']]) && $comments->records[$cid]->Load('comments', $cid)){
						if(isset($posts->records[$pid = (int)$comments->records[$cid]->GetValue('post')])){
							if(isset($users->records[$uid = (int)$posts->records[$pid]->GetValue('author')])){
								if((int)$FLog_user->GetValue('rank')===1 || $uid === $FLog_user->rid || (isset($users->records[$uid]) && (int)$users->records[$uid]->GetValue('rank')>(int)$FLog_user->GetValue('rank'))){
									$comments->records[$cid]->SetValue('name', $_POST['name']);
									$comments->records[$cid]->SetValue('email', $_POST['email']);
									$comments->records[$cid]->SetValue('url', $_POST['url']);
									$comments->records[$cid]->SetValue('markup', $_POST['markup']);
									$comments->records[$cid]->SetValue('text', $_POST['text']);
									$users->Unlock();
									$posts->Unlock();
									if($comments->Save()){
										FLog::CallAction('comment.edited', &$comments->records[$cid]);
										FLog::Redirect('?+msg=message.editsuccess','p','sort','page');
									}
								}
							}
						}
					}
				}
				$comments->Unlock();
				$users->Unlock();
				$posts->Unlock();
				FLog::Redirect('?+msg=error.database','p','sort','page');
			}
			elseif(isset($_POST['each'], $_POST['seteach'])){
				if(($each = (int)$_POST['each'])>=1){
					$users = new FLog_Database;
					if($users->Load('users', true)){
						if(isset($users->records[$FLog_user->rid]) && $users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
							$users->records[$FLog_user->rid]->SetValue('admin.manage.comments.each', $each);
							$users->Save();
						}
						$users->Unlock();
					}
				}
				FLog::Redirect('','p','sort');
			}
			elseif(isset($_POST['showtext'], $_POST['settext'])){
				$users = new FLog_Database;
				if($users->Load('users', true)){
					if(isset($users->records[$FLog_user->rid]) && $users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
						$users->records[$FLog_user->rid]->SetValue('admin.manage.comments.showtext', $_POST['showtext']);
						$users->Save();
					}
					$users->Unlock();
				}
				FLog::Redirect('','p','sort','page');
			}
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel','p','sort','page');
			elseif(isset($_POST['canceledit'])) FLog::Redirect('?+msg=message.editcancel','p','sort','page');
		}
		
		function manage_comments_display(){
			global $FLog_user, $FLog_markup;
		
			echo '<h1>',__('admin.manage.comments'),'</h1>';

			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.manage.comments.error.database'),'</p>'; break;
				case 'message.approve': echo '<p class="message">',__('admin.manage.comments.message.approve'),'</p>'; break;
				case 'message.editcancel': echo '<p class="message">',__('admin.manage.comments.message.editcancel'),'</p>'; break;
				case 'message.editsuccess': echo '<p class="message">',__('admin.manage.comments.message.editsuccess'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.comments.message.deletecancel'),'</p>'; break;
				case 'message.deletesuccess': echo '<p class="message">',__('admin.manage.comments.message.deletesuccess'),'</p>'; break;
			}
			
			$comments = new FLog_Database; $comments->Load('comments');
			$posts = new FLog_Database; $posts->Load('posts');
			$users = new FLog_Database; $users->Load('users');
			
			switch((string)@$_GET['sort']){
				case 'ida': $comments->Sort(false, SORT_ASC); $sort = 'ida'; break;
				case 'id': case 'idd': $comments->Sort(false, SORT_DESC); $sort = 'idd'; break;
				case 'name': case 'namea': $comments->Sort('name', SORT_ASC, 'strnatcasecmp'); $sort = 'namea'; break;
				case 'named': $comments->Sort('name', SORT_DESC, 'strnatcasecmp'); $sort = 'named'; break;
				case 'email': case 'emaila': $comments->Sort('email', SORT_ASC, 'strnatcasecmp'); $sort = 'emaila'; break;
				case 'emaild': $comments->Sort('email', SORT_DESC, 'strnatcasecmp'); $sort = 'emaild'; break;
				case 'timea': $comments->Sort('time', SORT_ASC, 'strnatcmp'); $sort = 'timea'; break;
				case 'time': case 'timed': $comments->Sort('time', SORT_DESC, 'strnatcmp'); $sort = 'timed'; break;
				case 'statusa': $comments->SortRecords(SORT_ASC, array('FLog_AdminPages', 'manage_comments_statuscallback')); $sort = 'statusa'; break;
				case 'status': case 'statusd': default: $comments->SortRecords(SORT_DESC, array('FLog_AdminPages', 'manage_comments_statuscallback')); $sort = 'statusd'; break;
			}

			if(isset($_POST['cid'],  $_POST['deletecomment']) && isset($comments->records[$cid = (int)$_POST['cid']])){
				echo '<p>',__('admin.manage.comments.delete.message'),'</p>';
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','page'),'" accept-charset="utf-8"><p>';
				echo '<input type="hidden" name="cid" value="',$cid,'" />';
				echo '<input type="submit" name="confirmdelete" value="',__('admin.manage.comments.delete.confirm'),'" />';
				echo ' <input type="submit" name="canceldelete" value="',__('admin.manage.comments.delete.cancel'),'" />';
				echo '</p></form>';
			}
			elseif(isset($_POST['cid'], $_POST['editcomment']) && isset($comments->records[$cid = (int)$_POST['cid']]) && $comments->records[$cid]->Load('comments',$cid)){
				if(isset($_POST['text'], $_POST['markup'], $_POST['previewedit'])){
					echo '<fieldset><legend>',__('admin.manage.comments.edit.previewbox'),'</legend>',FLog::CallFilter('comment_preview',FLog::CallMarkup($_POST['markup'], $_POST['text'])),'</fieldset>';
				}
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','page'),'" accept-charset="utf-8">';
				
				echo '<p><label>',__('admin.manage.comments.edit.name'),'<br /><input type="text" size="40" name="name" value="',isset($_POST['name'])?htmlspecialchars($_POST['name']):$comments->records[$cid]->GetSafe('name'),'" /></label></p>';
				echo '<p><label>',__('admin.manage.comments.edit.email'),'<br /><input type="text" size="40" name="email" value="',isset($_POST['email'])?htmlspecialchars($_POST['email']):$comments->records[$cid]->GetSafe('email'),'" /></label></p>';
				echo '<p><label>',__('admin.manage.comments.edit.url'),'<br /><input type="text" size="40" name="url" value="',isset($_POST['url'])?htmlspecialchars($_POST['url']):$comments->records[$cid]->GetSafe('url'),'" /></label></p>';
				echo '<p><label>',__('admin.manage.comments.edit.markup'),'<br /><select name="markup"><option value="">',__('admin.manage.comments.edit.markup.none'),'</option>';
				$markup = isset($_POST['markup'])?$_POST['markup']:$comments->records[$cid]->GetValue('markup');
				foreach(array_keys($FLog_markup) as $key){
					echo '<option value="',htmlspecialchars($key),'"',$markup===$key?' selected="selected"':'','>',$FLog_markup[$key]['name'],'</option>';
				}
				echo '</select></label></p>';
				echo '<p><label>',__('admin.manage.comments.edit.text'),'<br /><textarea rows="5" cols="40" name="text">',isset($_POST['text'])?htmlspecialchars($_POST['text']):$comments->records[$cid]->GetSafe('text'),'</textarea></label></p>';
				echo '<p>';
				echo '<input type="hidden" name="cid" value="',$cid,'" />';
				echo '<input type="hidden" name="editcomment" value="editcomment" />';
				echo '<input type="submit" name="canceledit" value="',__('admin.manage.comments.edit.cancel'),'" /> ';
				echo '<input type="submit" name="previewedit" value="',__('admin.manage.comments.edit.preview'),'" /> ';
				echo '<input type="submit" name="confirmedit" value="',__('admin.manage.comments.edit.submit'),'" />';
				echo '</p>';
				echo '</form>';
			}
			else{
	
	
	
				echo '<table class="admintable">';
				echo '<colgroup>';
				echo '<col class="oddcol" style="width:5%;" />'; // id
				echo '<col class="evencol" style="width:15%;" />'; // post
				echo '<col class="oddcol" style="width:15%;" />'; // name
				echo '<col class="evencol" style="width:15%;" />'; // email
				echo '<col class="oddcol" style="width:15%;" />'; // time
				echo '<col class="evencol" style="width:10%;" />'; // status
				echo '<col class="oddcol" style="width:25%;" />'; // action
				echo '</colgroup>';
				echo '<thead><tr>';
				echo '<td><a href="admin.php?sort=',$sort==='idd'?'ida':'idd',FLog::AppendQuerySafe('','p','page'),'">',__('admin.manage.comments.id'),'</a>',$sort==='ida'?'&#160;&#8595;':($sort==='idd'?'&#160;&#8593;':''),'</td>';
				echo '<td>',__('admin.manage.comments.post'),'</td>';
				echo '<td><a href="admin.php?sort=',$sort==='namea'?'named':'namea',FLog::AppendQuerySafe('','p','page'),'">',__('admin.manage.comments.name'),'</a>',$sort==='namea'?'&#160;&#8595;':($sort==='named'?'&#160;&#8593;':''),'</td>';
				echo '<td><a href="admin.php?sort=',$sort==='emaila'?'emaild':'emaila',FLog::AppendQuerySafe('','p','page'),'">',__('admin.manage.comments.email'),'</a>',$sort==='emaila'?'&#160;&#8595;':($sort==='emaild'?'&#160;&#8593;':''),'</td>';
				echo '<td><a href="admin.php?sort=',$sort==='timed'?'timea':'timed',FLog::AppendQuerySafe('','p','page'),'">',__('admin.manage.comments.time'),'</a>',$sort==='timea'?'&#160;&#8595;':($sort==='timed'?'&#160;&#8593;':''),'</td>';
				echo '<td><a href="admin.php?sort=',$sort==='statusd'?'statusa':'statusd',FLog::AppendQuerySafe('','p','page'),'">',__('admin.manage.comments.status'),'</a>',$sort==='statusa'?'&#160;&#8595;':($sort==='statusd'?'&#160;&#8593;':''),'</td>';
				echo '<td>',__('admin.manage.comments.action'),'</td>';
				echo '</tr></thead>';
				
				echo '<tbody>';
	
				$page = isset($_GET['page'])?max(1,(int)$_GET['page']):1;
				$each = $FLog_user->HasValue('admin.manage.comments.each')?max(1,(int)$FLog_user->GetValue('admin.manage.comments.each')):10;
				$skip = ($page - 1)*$each;
				$max = $each;
				$numcomments = 0;
				$i=0;
				
				$showmod = ($FLog_user->GetValue('admin.manage.comments.showtext')!=='none');
				$showall = ($FLog_user->GetValue('admin.manage.comments.showtext')==='all');
				
				
				foreach(array_keys($comments->records) as $key){
	
					++$numcomments;
					if($skip > 0){
						--$skip;
						continue;
					}
					if($max <= 0) continue;
					else --$max;
	
					$comments->records[$key]->Load('comments', $key);
					if(isset($posts->records[$pid = (int)$comments->records[$key]->GetValue('post')])){
						$uid = (int)$posts->records[$pid]->GetValue('author');
					}
					else $uid = -1;
					
					if($showall || ((int)$comments->records[$key]->GetValue('moderated')===1 && $showmod)){
						$showtext = true;
						echo ((++$i) % 2 == 1)?'<tr class="oddrowtop">':'<tr class="evenrowtop">';
					}
					else{
						$showtext = false;
						echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
					}
					
					echo '<td>', $key, '</td>';
					if(isset($posts->records[$pid])) echo '<td><a href="index.php?post=',$pid,'">', $posts->records[$pid]->GetEntities('title'), '</a></td>';
					else echo '<td>[ <a href="index.php?post=',$pid,'">',$pid, '</a> ]</td>';
					echo '<td>', $comments->records[$key]->GetEntities('name'), '</td>';
					echo '<td><a href="mailto:', $comments->records[$key]->GetSafe('email'), '">', $comments->records[$key]->GetSafe('email'), '</a></td>';
					echo '<td>', __('admin.manage.comments.time.display', FLog::FormatLocalDate((int)$comments->records[$key]->GetValue('time')), FLog::FormatLocalTime((int)$comments->records[$key]->GetValue('time'))), '</td>';
					echo '<td>';
					if((int)$comments->records[$key]->GetValue('moderated')===1) echo __('admin.manage.comments.status.moderated');
					echo '</td>';
					echo '<td>';
					if((int)$FLog_user->GetValue('rank')===1 || $uid === $FLog_user->rid || (isset($users->records[$uid]) && (int)$users->records[$uid]->GetValue('rank')>(int)$FLog_user->GetValue('rank'))){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','page'),'" accept-charset="utf-8">';
						echo '<input type="hidden" name="cid" value="',$key,'" />';
						if(isset($posts->records[$pid])) echo '<input type="submit" name="editcomment" value="',__('admin.manage.comments.edit'),'" /> ';
						echo '<input type="submit" name="deletecomment" value="',__('admin.manage.comments.delete'),'" />';
						if((int)$comments->records[$key]->GetValue('moderated')==1) echo ' <input type="submit" name="approvecomment" value="',__('admin.manage.comments.approve'),'" />';
						echo '</form>';
					}
					echo '</td>';
					echo '</tr>';
	
					if($showtext){
						echo (($i%2)==1)?'<tr class="oddrowbottom">':'<tr class="evenrowbottom">';
						echo '<td></td><td class="nocol" colspan="6">';
						echo FLog::CallFilter('comment',FLog::CallMarkup($comments->records[$key]->GetValue('markup'),$comments->records[$key]->GetValue('text')));
						echo '</td></tr>';
					}
				}
				
				
				echo '</tbody>';
				
				echo '</table>';
	
				$numpages = ceil($numcomments / $each);
				echo '<p>';
				if($page < 1 || $page > $numpages){
					for($i=1; $i<=$numpages; ++$i){
						if($i > 3 && $i < $numpages - 2){
							echo '&hellip; ';
							$i = $numpages - 2;
						}
						echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort'),'">',$i,'</a> ';
					}
				}
				else{
					for($i=1; $i<=$numpages; ++$i){
						if($i > 3 && $i < $page - 2){
							echo '&hellip; ';
							$i = $page - 2;
						}
						elseif($i > $page + 2 && $i < $numpages - 2){
							echo '&hellip; ';
							$i = $numpages - 2;
						}
						
						if($i == $page){
							echo '<strong>[',$i,']</strong> ';
						}
						else{
							echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort'),'">',$i,'</a> ';
						}
					}
				}
				echo '</p>';
	
	
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort'),'" accept-charset="utf-8"><p><label>',__('admin.manage.comments.each'),'<br /><input type="text" name="each" value="',$each,'" /></label> <input type="submit" name="seteach" value="',__('admin.manage.comments.each.submit'),'" /></p></form>';
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','page'),'" accept-charset="utf-8"><p><label>',__('admin.manage.comments.showtext'),'<br /><select name="showtext">';
				echo '<option value="mod"', $FLog_user->GetValue('admin.manage.comments.showtext')==='mod'?' selected="selected"':'','>',__('admin.manage.comments.showtext.mod'),'</option>';
				echo '<option value="all"', $FLog_user->GetValue('admin.manage.comments.showtext')==='all'?' selected="selected"':'','>',__('admin.manage.comments.showtext.all'),'</option>';
				echo '<option value="none"', $FLog_user->GetValue('admin.manage.comments.showtext')==='none'?' selected="selected"':'','>',__('admin.manage.comments.showtext.none'),'</option>';
				echo '</select> <input name="settext" type="submit" value="',__('admin.manage.comments.showtext.submit'),'" /></label></p></form>';
			}
		}
		function manage_pages_process(){
			if(isset($_POST['up'], $_POST['id'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					for($i=1; $i<$size; ++$i){
						if($index[$i]['id'] === $_POST['id']){
							$t = $index[$i];
							$index[$i] = $index[$i-1];
							$index[$i-1] = $t;
							if($pages->Save()){
								FLog::CallAction('menu.reordered');
								FLog::Redirect('', 'p');
							}
							break;
						}
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['down'], $_POST['id'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					for($i=0; $i<$size-1; ++$i){
						if($index[$i]['id'] === $_POST['id']){
							$t = $index[$i];
							$index[$i] = $index[$i+1];
							$index[$i+1] = $t;
							FLog::EncodePageIndex($pages, $index);
							if($pages->Save()){
								FLog::CallAction('menu.reordered');
								FLog::Redirect('', 'p');
							}
							break;
						}
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['edit'], $_POST['id'])){
				$s = substr($_POST['id'], 0, 1);
				if($s!=='S' && $s!=='L') FLog::Redirect('?p=write.pages&edit='.(int)$_POST['id']);
			}
			elseif(isset($_POST['delete'], $_POST['id'])){
				$s = substr($_POST['id'], 0, 1);
				if($s==='S' || $s === 'L'){
					$pages = new FLog_Database;
					if($pages->Load('pages', true)){
						$size = count($index = FLog::DecodePageIndex($pages));
						for($i=0; $i<$size; ++$i){
							if($index[$i]['id']===$_POST['id']){
								$entry = $index[$i];
								array_splice($index, $i, 1);
								FLog::EncodePageIndex($pages, $index);
								if($pages->Save()){
									switch($entry['type']){
										case 'S': FLog::CallAction('menu.separatordeleted', &$entry); break;
										case 'L': FLog::CallAction('menu.linkdeleted', &$entry); break;
									}
									FLog::Redirect('?+msg=message.deletesuccess', 'p');
								}
								break;
							}
						}
						$pages->Unlock();
					}
					$_GET['msg'] = 'error.database';
				}
			}
			elseif(isset($_POST['show'], $_POST['id'], $_POST['where'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					if(isset($pages->records[$pid = (int)$_POST['id']])){
						$newentry = array('id'=>(string)$pid, 'type'=>'P', 'title'=>$pages->records[$pid]->GetValue('title'));
						$size = count($index = FLog::DecodePageIndex($pages));
						if(count($l = explode('|', $_POST['where']))<2){
							array_unshift($index, $newentry);
						}
						else{
							for($i=0; $i<$size; ++$i){
								if($index[$i]['id']===$l[1]){
									array_splice($index, $i+1, 0, array($newentry));
									break;
								}
							}
							if($i>=$size){
								array_splice($index, min($size-1, max(0, (int)$l[0])), 0, array($newentry));
							}
						}
						FLog::EncodePageIndex($pages, $index);
						if($pages->Save()){
							FLog::CallAction('menu.reordered');
							FLog::Redirect('?+msg=message.show', 'p');
						}
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['hide'], $_POST['id'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					for($i=0; $i<$size; ++$i){
						if($index[$i]['id']===$_POST['id']){
							array_splice($index, $i, 1);
							FLog::EncodePageIndex($pages, $index);
							if($pages->Save()){
								FLog::CallAction('menu.reordered');
								FLog::Redirect('?+msg=message.hide', 'p');
							}
							break;
						}
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['newentry'], $_POST['title'], $_POST['url'], $_POST['where'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					$max = (int)$pages->records[$iid = $pages->FindRecord('id', '')]->GetValue('max');
					if(($_POST['url'] = trim($_POST['url']))===''){
						$newentry = array('id'=>'S'.$max, 'type'=>'S', 'title'=>$_POST['title']);
					}
					else{
						$newentry = array('id'=>'L'.$max, 'type'=>'L', 'title'=>$_POST['title'], 'url'=>$_POST['url']);
					}

					if(count($l = explode('|', $_POST['where']))<2){
						array_unshift($index, $newentry);
					}
					else{
						for($i=0; $i<$size; ++$i){
							if($index[$i]['id']===$l[1]){
								array_splice($index, $i+1, 0, array($newentry));
								break;
							}
						}
						if($i>=$size){
							array_splice($index, min($size-1, max(0, (int)$l[0])), 0, array($newentry));
						}
					}
					$iid = FLog::EncodePageIndex($pages, $index);
					$pages->records[$iid]->SetValue('max', 1+(int)$pages->records[$iid]->GetValue('max'));
					if($pages->Save()){
						switch($newentry['type']){
							case 'S': FLog::CallAction('menu.separatoradded', &$newentry); break;
							case 'L': FLog::CallAction('menu.linkadded', &$newentry); break;
						}
						FLog::Redirect('?+msg=message.newentry', 'p');
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['confirmdelete'], $_POST['id'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					for($i=0; $i<$size; ++$i){
						if($index[$i]['id']===$_POST['id']){
							array_splice($index, $i, 1);
							FLog::EncodePageIndex($pages, $index);
							break;
						}
					}
					$page = NULL;
					if(isset($pages->records[$pid = (int)$_POST['id']])){
						$page = $pages->records[$pid];
						$pages->DeleteRecord($pid);
					}
					if($pages->Save()){
						FLog::CallAction('page.deleted', &$page);
						FLog::Redirect('?+msg=message.deletesuccess', 'p');
					}
					$pages->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['confirmedit'], $_POST['id'], $_POST['title'])){
				$pages = new FLog_Database;
				if($pages->Load('pages', true)){
					$size = count($index = FLog::DecodePageIndex($pages));
					for($i=0; $i<$size; ++$i){
						if($index[$i]['id']===$_POST['id']){
							$index[$i]['title'] = $_POST['title'];
							if($index[$i]['type']==='L') $index[$i]['url'] = (string)@$_POST['url'];
							FLog::EncodePageIndex($pages, $index);
							if($pages->Save()){
								switch($index[$i]['type']){
									case 'S': FLog::CallAction('menu.separatoredited', &$index[$i]); break;
									case 'L': FLog::CallAction('menu.linkedited', &$index[$i]); break;
								}
								FLog::Redirect('?+msg=message.editsuccess', 'p');
							}
							break;
						}
					}
					$pages->Unlock();
				}
			}
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel', 'p');
			elseif(isset($_POST['canceledit'])) FLog::Redirect('?+msg=message.editcancel', 'p');
		}
		
		function manage_pages_display(){
			echo '<h1>',__('admin.manage.pages'),'</h1>';
			
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.manage.pages.error.database'),'</p>'; break;
				case 'message.editsuccess': echo '<p class="message">',__('admin.manage.pages.message.editsuccess'),'</p>'; break;
				case 'message.editcancel': echo '<p class="message">',__('admin.manage.pages.message.editcancel'),'</p>'; break;
				case 'message.deletesuccess': echo '<p class="message">',__('admin.manage.pages.message.deletesuccess'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.pages.message.deletecancel'),'</p>'; break;
				case 'message.show': echo '<p class="message">',__('admin.manage.pages.message.show'),'</p>'; break;
				case 'message.hide': echo '<p class="message">',__('admin.manage.pages.message.hide'),'</p>'; break;
				case 'message.newentry': echo '<p class="message">',__('admin.manage.pages.message.newentry'),'</p>'; break;
			}
			
			$pages = new FLog_Database;
			$pages->Load('pages');
			
			$size = count($index = FLog::DecodePageIndex($pages));
			$pages->Sort('id', SORT_ASC, 'strnatcasecmp');
			
			$delete = false;
			if(isset($_POST['delete'], $_POST['id'])){
				$s = substr($_POST['id'], 0, 1);
				if($s!=='S' && $s!=='L'){
					if(isset($pages->records[(int)$_POST['id']])) $delete = (int)$_POST['id'];
				}
			}
			
			if($delete!==false){
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
				echo '<input type="hidden" name="id" value="',$delete,'" />';
				echo '<p>',__('admin.manage.pages.delete.message', $pages->records[$delete]->GetEntities('title')),'</p>';
				echo '<p><input type="submit" name="confirmdelete" value="',__('admin.manage.pages.delete.confirm'),'" /> ';
				echo '<input type="submit" name="canceldelete" value="',__('admin.manage.pages.delete.cancel'),'" /></p>';
				echo '</form>';
			}
			else{
				$edit = false;
				if(isset($_POST['edit'], $_POST['id'])){
					$s = substr($_POST['id'], 0, 1);
					if($s==='S' || $s==='L') $edit = $_POST['id'];
				}
				
				if($edit!==false) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
				echo '<table class="admintable">';
				echo '<colgroup>';
				echo '<col class="oddcol" style="width:20%;" />'; // id
				echo '<col class="oddcol" style="width:20%;" />'; // title
				echo '<col class="oddcol" style="width:20%;" />'; // url
				echo '<col class="oddcol" style="width:40%;" />'; // action
				echo '</colgroup>';
				echo '<thead><tr>';
				echo '<td>',__('admin.manage.pages.id'),'</td>';
				echo '<td>',__('admin.manage.pages.title'),'</td>';
				echo '<td>',__('admin.manage.pages.url'),'</td>';
				echo '<td>',__('admin.manage.pages.action'),'</td>';
				echo '</tr></thead>';
				echo '<tbody>';
				
				$usedpages = array();
				$where = '<option value="0">'.__('admin.manage.pages.where.top').'</option>';
				$hasblank = true;
				
				for($i=0; $i<$size; ++$i){
					$where .= '<option value="'.($i+1).'|'.htmlspecialchars($index[$i]['id']).'">';
					
					if($i%2==0) echo '<tr class="oddrow">';
					else echo '<tr class="evenrow">';
					
					$p = false;
					if($edit===$index[$i]['id']){
						switch($index[$i]['type']){
							case 'S':
								echo '<td></td><td><input type="text" size="16" name="title" value="',htmlspecialchars($index[$i]['title']),'" /></td><td></td>';
								$where .= __('admin.manage.pages.where.separator', FLog::SafeEntities($index[$i]['title']));
								break;
							case 'L':
								echo '<td></td><td><input type="text" size="16" name="title" value="',htmlspecialchars($index[$i]['title']),'" /></td><td><input type="text" size="16" name="url" value="',htmlspecialchars($index[$i]['url']),'" /></td>';
								$where .= __('admin.manage.pages.where.link', FLog::SafeEntities($index[$i]['title']));
								break;
						}
					}
					else{
						switch($index[$i]['type']){
							case 'S':
								$title = FLog::SafeEntities($index[$i]['title']);
								echo '<td></td><td>',$title,'</td><td></td>';
								$where .= __('admin.manage.pages.where.separator', $title);
								break;
							case 'L':
								$title = FLog::SafeEntities($index[$i]['title']);
								$url = htmlspecialchars($index[$i]['url']);
								echo '<td></td><td>',$title,'</td><td><a href="',$url,'">',$url,'</a></td>';
								$where .= __('admin.manage.pages.where.link', $title);
								break;
							default:
								$title = FLog::SafeEntities($index[$i]['title']);
								echo '<td>',htmlspecialchars($index[$i]['pid']),'</td><td><a href="index.php?page=',urlencode($index[$i]['pid']),'">',$title,'</a></td><td></td>';
								$where .= __('admin.manage.pages.where.page', $title);
								$usedpages[] = (int)$index[$i]['id'];
								$p = true;
								break;
						}
					}
	
					echo '<td>';
					if($edit===false){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('p'),'" accept-charset="utf-8">';
						echo '<input type="hidden" name="id" value="',htmlspecialchars($index[$i]['id']),'" />';
						echo '<input type="submit" name="edit" value="',__('admin.manage.pages.edit'),'" /> ';
						echo '<input type="submit" name="delete" value="',__('admin.manage.pages.delete'),'" /> ';
						echo '<input type="submit" name="up" value="',__('admin.manage.pages.up'),'"',$i<=0?' disabled="disabled"':'',' /> ';
						echo '<input type="submit" name="down" value="',__('admin.manage.pages.down'),'"',$i>=$size-1?' disabled="disabled"':'',' />';
						if($p) echo ' <input type="submit" name="hide" value="',__('admin.manage.pages.hide'),'" />';
						echo '</form>';
					}
					elseif($edit===$index[$i]['id']){
						echo '<input type="hidden" name="id" value="',htmlspecialchars($index[$i]['id']),'" />';
						echo '<input type="submit" name="confirmedit" value="',__('admin.manage.pages.edit.confirm'),'" /> ';
						echo '<input type="submit" name="canceledit" value="',__('admin.manage.pages.edit.cancel'),'" />';
					}
					echo '</td>';
					echo '</tr>';
					$hasblank = false;
					$where .= '</option>';
				}
				if($edit!==false) echo '</tbody></table></form>';
				else{
					$i = 0;
					foreach(array_keys($pages->records) as $key){
						if(in_array($key,$usedpages) || $pages->records[$key]->GetValue('id')==='') continue;
						if(!$hasblank){
							echo '<tr class="blankrow"><td colspan="4"></td></tr>';
							$hasblank = true;
						}
						if((++$i)%2==0) echo '<tr class="evenrow">';
						else echo '<tr class="oddrow">';
						echo '<td>',$pages->records[$key]->GetSafe('id'),'</td>';
						echo '<td><a href="index.php?page=',urlencode($pages->records[$key]->GetValue('id')),'">',$pages->records[$key]->GetEntities('title'),'</a></td>';
						echo '<td></td>';
						echo '<td><form method="post" action="admin.php',FLog::LimitQuerySafe('p'),'" accept-charset="utf-8">';
						echo '<input type="hidden" name="id" value="',$key,'" />';
						echo '<input type="submit" name="edit" value="',__('admin.manage.pages.edit'),'" /> ';
						echo '<input type="submit" name="delete" value="',__('admin.manage.pages.delete'),'" /> ';
						echo '<select name="where">',$where,'</select>';
						echo '<input type="submit" name="show" value="',__('admin.manage.pages.show'),'" />';
						echo '</form></td>';
						echo '</tr>';
					}
					echo '</tbody></table>';
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('p'),'" accept-charset="utf-8">';
					echo '<fieldset><legend>',__('admin.manage.pages.new'),'</legend>';
					echo '<p><label>',__('admin.manage.pages.new.title'),'<br /><input type="text" size="40" name="title" value="',isset($_POST['title'], $_POST['newentry'])?htmlspecialchars($_POST['title']):'','" /></label></p>';
					echo '<p><label>',__('admin.manage.pages.new.url'),'<br /><input type="text" size="40" name="url" value="',isset($_POST['url'], $_POST['newentry'])?htmlspecialchars($_POST['url']):'','" /></label></p>';
					echo '<p><label>',__('admin.manage.pages.new.where'),'<br /><select name="where">',$where,'</select></label></p>';
					echo '<p><input type="submit" name="newentry" value="',__('admin.manage.pages.new.submit'),'" /></p>';
					echo '</fieldset>';
					echo '</form>';
				}
			}
		}
		function manage_posts_statuscallback(&$a, &$b){
			$s = (((((int)$a->GetValue('draft')===1?2:0)+((int)$a->GetValue('delay')===1?1:0))-(((int)$b->GetValue('draft')===1?2:0)+((int)$b->GetValue('delay')===1?1:0))));
			if($s == 0) return (int)$a->GetValue('time')-(int)$b->GetValue('time');
			return $s;

		}
		function manage_posts_process(){
			global $FLog_user;
			if(isset($_POST['each'], $_POST['seteach'])){
				if(($each = (int)$_POST['each'])>=1){
					$users = new FLog_Database;
					if($users->Load('users', true)){
						if(isset($users->records[$FLog_user->rid])){
							if($users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
								$users->records[$FLog_user->rid]->SetValue('admin.manage.posts.each', $each);
								$users->Save();
							}
						}
						$users->Unlock();
					}
				}
				FLog::Redirect('','p','sort','cat','user','page');
			}
			elseif(isset($_POST['pid'], $_POST['editpost'])){
				FLog::Redirect('admin.php?p=write.posts&edit='.(int)$_POST['pid']);
			}
			elseif(isset($_POST['pid'], $_POST['confirmdelete'])){
				$posts = new FLog_Database();
				$cats = new FLog_Database();
				$users = new FLog_Database();
				$comments = new FLog_Database();
				if($posts->Load('posts',true) && $cats->Load('cats', true) && $users->Load('users', true) && $comments->Load('comments', true)){
					$cats->LoadAll();
					if(isset($posts->records[$pid = (int)$_POST['pid']])){
						$uid = (int)$posts->records[$pid]->GetValue('author');
						if($uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users',$uid) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
							$post = $posts->records[$pid];
							$posts->DeleteRecord($pid);
							if($posts->Save()){
								foreach(explode(',', $post->GetValue('cats')) as $cat){
									if($cat === '') continue;
									if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('posts', max((int)$cats->records[$cat]->GetValue('posts')-1,0));
								}
								foreach(array_keys($comments->records) as $cid){
									if((int)$comments->records[$cid]->GetValue('post') === $pid) $comments->DeleteRecord($cid);
								}
								$comments->Save();
								$cats->Save();
								$users->Unlock();
								FLog::CallAction('post.deleted', &$post);
								FLog::Redirect('?+msg=message.deletesuccess','p','sort','cat','user','page');
							}
						}
					}
				}
				$comments->Unlock(); $posts->Unlock(); $cats->Unlock(); $users->Unlock();
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['recalc'])){
				$posts = new FLog_Database;
				$comments = new FLog_Database;
				if($posts->Load('posts', true) && $comments->Load('comments', true)){
					foreach(array_keys($posts->records) as $key){
						$posts->records[$key]->Load('posts', $key);
						$posts->records[$key]->SetValue('comments', 0);
					}
					foreach(array_keys($comments->records) as $key){
						if((int)$comments->records[$key]->GetValue('moderated')==1) continue;
						$post = (int)$comments->records[$key]->GetValue('post');
						if(isset($posts->records[$post])) $posts->records[$post]->SetValue('comments', 1+(int)$posts->records[$post]->GetValue('comments'));
					}
					if($posts->Save()){
						$comments->Unlock();
						FLog::Redirect('','p','sort','cat','user','page');
					}
				}
				$_GET['msg'] = 'error.database';
				$posts->Unlock();
				$comments->Unlock();
			}
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel','p','sort','cat','user','page');
		}
		function manage_posts_display(){
			global $FLog_user;
			echo '<h1>',__('admin.manage.posts'),'</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.manage.posts.error.database'),'</p>'; break;
				case 'message.deletecancel': echo '<p class="message">',__('admin.manage.posts.message.deletecancel'),'</p>'; break;
				case 'message.deletesuccess': echo '<p class="message">',__('admin.manage.posts.message.deletesuccess'),'</p>'; break;
			}
			$posts = new FLog_Database;
			$posts->Load('posts');
			$users = new FLog_Database;
			if($users->Load('users')) $users->LoadAll();
			if(isset($_POST['pid'], $_POST['deletepost'])){
				$pid = (int)$_POST['pid'];
				if(isset($posts->records[$pid])){
					$uid = (int)$posts->records[$pid]->GetValue('author');
					if($uid === $FLog_user->rid || (isset($users->records[$uid]) && $users->records[$uid]->Load('users',$uid) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8"><input type="hidden" name="pid" value="',$pid,'" />';
						echo '<p>',__('admin.manage.posts.delete.message', $posts->records[$pid]->GetEntities('title')),'</p>';
						echo '<p><input name="confirmdelete" type="submit" value="',__('admin.manage.posts.delete.confirm'),'" /> <input name="canceldelete" type="submit" value="',__('admin.manage.posts.delete.cancel'),'" /></p>';
						echo '</form>';
						return;
					}
				}
			}
			switch((string)@$_GET['sort']){
				case 'ida': $posts->Sort(false, SORT_ASC); $sort = 'ida'; break;
				case 'id': case 'idd': $posts->Sort(false, SORT_DESC); $sort = 'idd'; break;
				case 'title': case 'titlea': $posts->Sort('title', SORT_ASC, 'strnatcasecmp'); $sort = 'titlea'; break;
				case 'titled': $posts->Sort('title', SORT_DESC, 'strnatcasecmp'); $sort = 'titled'; break;
				case 'comments': case 'commentsa': $posts->Sort('comments', SORT_ASC, 'strnatcmp'); $sort = 'commentsa'; break;
				case 'commentsd': $posts->Sort('comments', SORT_DESC, 'strnatcmp'); $sort = 'commentsd'; break;
				case 'timea': $posts->Sort('time', SORT_ASC, 'strnatcmp'); $sort = 'timea'; break;
				case 'time': case 'timed': $posts->Sort('time', SORT_DESC, 'strnatcmp'); $sort = 'timed'; break;
				case 'statusa': $posts->SortRecords(SORT_ASC, array('FLog_AdminPages', 'manage_posts_statuscallback')); $sort = 'statusa'; break;
				case 'status': case 'statusd': default: $posts->SortRecords(SORT_DESC, array('FLog_AdminPages', 'manage_posts_statuscallback')); $sort = 'statusd'; break;
			}
			$cats = new FLog_Database;
			if($cats->Load('cats')) $cats->LoadAll();
			echo '<table class="admintable">';
			echo '<colgroup>';
			echo '<col class="oddcol" style="width:5%;" />'; // id
			echo '<col class="evencol" style="width:15%;" />'; // title
			echo '<col class="oddcol" style="width:15%;" />'; // date
			echo '<col class="evencol" style="width:10%;" />'; // author
			echo '<col class="oddcol" style="width:15%;" />'; // cats
			echo '<col class="evencol" style="width:5%;" />'; // comments
			echo '<col class="oddcol" style="width:15%;" />'; // status
			echo '<col class="evencol" style="width:20%;" />'; // action
			echo '</colgroup>';
			echo '<thead>';
			echo '<tr>';
			echo '<td><a href="admin.php?sort=',$sort==='idd'?'ida':'idd',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.posts.id'),'</a>',$sort==='ida'?'&#160;&#8595;':($sort==='idd'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='titlea'?'titled':'titlea',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.posts.title'),'</a>',$sort==='titlea'?'&#160;&#8595;':($sort==='titled'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='timed'?'timea':'timed',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.posts.time'),'</a>',$sort==='timea'?'&#160;&#8595;':($sort==='timed'?'&#160;&#8593;':''),'</td>';
			echo '<td>',__('admin.manage.posts.author'),'</td>';
			echo '<td>',__('admin.manage.posts.cats'),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='commentsa'?'commentsd':'commentsa',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.posts.comments'),'</a>',$sort==='commentsa'?'&#160;&#8595;':($sort==='commentsd'?'&#160;&#8593;':''),'</td>';
			echo '<td><a href="admin.php?sort=',$sort==='statusd'?'statusa':'statusd',FLog::AppendQuerySafe('','p','cat','user','page'),'">',__('admin.manage.posts.status'),'</a>',$sort==='statusa'?'&#160;&#8595;':($sort==='statusd'?'&#160;&#8593;':''),'</td>';
			echo '<td>',__('admin.manage.posts.action'),'</td>';
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
			$page = isset($_GET['page'])?max(1,(int)$_GET['page']):1;
			$each = $FLog_user->HasValue('admin.manage.posts.each')?max(1,(int)$FLog_user->GetValue('admin.manage.posts.each')):10;
			$skip = ($page - 1)*$each;
			$max = $each;
			$numposts = 0;
			$limituser = isset($_GET['user'])?(int)$_GET['user']:false;
			$limitcat = isset($_GET['cat'])?(int)$_GET['cat']:false;
			$i=0;
			foreach(array_keys($posts->records) as $key){
				if($limituser!==false && $limituser!=(int)$posts->records[$key]->GetValue('author')) continue;
				if($limitcat!==false && !in_array((string)$limitcat, explode(',', $posts->records[$key]->GetValue('cats')))) continue;
				++$numposts;
				if($skip > 0){
					--$skip;
					continue;
				}
				if($max <= 0) continue;
				else --$max;

				echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
				echo '<td>', $key, '</td>';
				echo '<td><a href="index.php?post=',$key,'">', $posts->records[$key]->GetEntities('title'), '</a></td>';
				echo '<td>', __('admin.manage.posts.time.display', FLog::FormatLocalDate((int)$posts->records[$key]->GetValue('time')), FLog::FormatLocalTime((int)$posts->records[$key]->GetValue('time'))), '</td>';
				echo '<td>';
				if(isset($users->records[$uid = (int)$posts->records[$key]->GetValue('author')])){
					echo '<a href="admin.php?user=',$uid,FLog::AppendQuerySafe('','p','sort','cat'),'">',$users->records[$uid]->GetEntities('name'),'</a>';
				}
				echo '</td>';
				$catarray = array();
				foreach(explode(',', $posts->records[$key]->GetValue('cats')) as $cat){
					if($cat === '') continue;
					if(isset($cats->records[(int)$cat])) $catarray[] = '<a href="admin.php?cat='.(int)$cat.FLog::AppendQuerySafe('','p','sort','user').'">'.$cats->records[(int)$cat]->GetEntities('name').'</a>';
				}
				echo '<td>', implode(', ', $catarray), '</td>';
				echo '<td>', (int)$posts->records[$key]->GetValue('comments'), '</td>';
				echo '<td>';
				if((int)$posts->records[$key]->GetValue('draft')==1){
					if((int)$posts->records[$key]->GetValue('delay')==1) _e('admin.manage.posts.status.both');
					else _e('admin.manage.posts.status.draft');
				}
				elseif((int)$posts->records[$key]->GetValue('delay')==1) _e('admin.manage.posts.status.delay');
				echo '</td>';
				echo '<td>';
				if($uid === $FLog_user->rid || (isset($users->records[$uid]) && (int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank'))){
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8">';
					echo '<input name="pid" type="hidden" value="',$key,'" />';
					echo '<input name="editpost" type="submit" value="',__('admin.manage.posts.edit'),'" /> ';
					echo '<input name="deletepost" type="submit" value="',__('admin.manage.posts.delete'),'" />';
					echo '</form>';
				}
				echo '</td>';
				echo '</tr>';
			}
			echo '</tbody>';
			echo '</table>';
			$numpages = ceil($numposts / $each);
			echo '<p>';
			if($page < 1 || $page > $numpages){
				for($i=1; $i<=$numpages; ++$i){
					if($i > 3 && $i < $numpages - 2){
						echo '&hellip; ';
						$i = $numpages - 2;
					}
					echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort','cat','user'),'">',$i,'</a> ';
				}
			}
			else{
				for($i=1; $i<=$numpages; ++$i){
					if($i > 3 && $i < $page - 2){
						echo '&hellip; ';
						$i = $page - 2;
					}
					elseif($i > $page + 2 && $i < $numpages - 2){
						echo '&hellip; ';
						$i = $numpages - 2;
					}
					
					if($i == $page){
						echo '<strong>[',$i,']</strong> ';
					}
					else{
						echo '<a href="admin.php?page=',$i,FLog::AppendQuerySafe('','p','sort','cat','user'),'">',$i,'</a> ';
					}
				}
			}
			echo '</p>';
			echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user'),'" accept-charset="utf-8"><p><label>',__('admin.manage.posts.each'),'<br /><input type="text" name="each" value="',$each,'" /></label> <input type="submit" name="seteach" value="',__('admin.manage.posts.each.submit'),'" /></p></form>';
			echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p','sort','cat','user','page'),'" accept-charset="utf-8"><p><input type="submit" name="recalc" value="',__('admin.manage.posts.recalc'),'" /></p></form>';
		}
		function manage_users_process(){
			global $FLog_user;
			if(isset($_POST['confirmedit'], $_POST['uid'], $_POST['name'], $_POST['url'], $_POST['email'])){
				$uid = (int)$_POST['uid']; $users = new FLog_Database; $ok = true;
				if($users->Load('users')){
					if(isset($users->records[$uid])){
						if($users->records[$uid]->Load('users', $uid)){
							if((int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank') || $uid === $FLog_user->rid){
								if(isset($_POST['rank'])){
									if($uid === $FLog_user->rid){
										$ok = false; $_GET['msg'] = 'error.setownrank';
									}
									elseif((int)$_POST['rank'] <= (int)$FLog_user->GetValue('rank')){
										$ok = false; $_GET['msg'] = 'error.setrank';
									}
									else{
										$users->records[$uid]->SetValue('rank', (int)$_POST['rank']);
									}
								}
								if($ok){
									$users->records[$uid]->SetValue('name', $_POST['name']);
									$users->records[$uid]->SetValue('url', $_POST['url']);
									$users->records[$uid]->SetValue('email', $_POST['email']);
									if($users->Save()){
										FLog::CallAction('user.edited', &$users->Records[$uid]);
										FLog::Redirect('?+msg=message.editsuccess','p');
									}
								}
							}
						}
					}
					$users->Unlock();
				}
				if($ok) $_GET['msg'] = 'error.database';
				$_POST['edituser'] = 'edituser';
			}
			elseif(isset($_POST['confirmdelete'], $_POST['uid'])){
				$uid = (int)$_POST['uid']; $users = new FLog_Database; $ok = true;
				if($users->Load('users')){
					if(isset($users->records[$uid])){
						if($users->records[$uid]->Load('users', $uid)){
							if((int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank')){
								$user = $users->records[$uid];
								$users->DeleteRecord($uid);
								if($users->Save()){
									FLog::CallAction('user.deleted', &$user);
									FLog::Redirect('?+msg=message.deletesuccess','p');
								}
							}
						}
					}
					$users->Unlock();
				}
				$_GET['msg'] = 'error.database';
				$_POST['deleteuser'] = 'deleteuser';
			}
			elseif(isset($_POST['newuser'], $_POST['username'], $_POST['password'], $_POST['password2'], $_POST['rank'])){
				if(!FLog::ValidUsername($_POST['username'])) $_GET['msg'] = 'error.invalidusername';
				elseif($_POST['password'] !== $_POST['password2']) $_GET['msg'] = 'error.newpasswordmatch';
				elseif((int)$_POST['rank'] <= (int)$FLog_user->GetValue('rank')) $_GET['msg'] = 'error.newrank';
				else{
					$users = new FLog_Database;
					if($users->Load('users', true)){
						if($users->FindRecord('username', $_POST['username']) >= 0) $_GET['msg'] = 'error.usernametaken';
						else{
							$user = new FLog_DatabaseRecord;
							$user->SetValue('username', $_POST['username']);
							$user->SetValue('password', md5($_POST['password']));
							$user->SetValue('rank', (int)$_POST['rank']);
							$users->InsertRecord($user);
							if($users->Save()){
								FLog::CallAction('user.added', &$user);
								FLog::Redirect('?+msg=message.newsuccess','p');
							}
							$_GET['msg'] = 'error.database';
						}
						$users->Unlock();
					}
					else $_GET['msg'] = 'error.database';
				}
			}
			elseif(isset($_POST['changepassword'], $_POST['oldpassword'], $_POST['newpassword'], $_POST['newpassword2'])){
				if(md5($_POST['oldpassword'])!==$FLog_user->GetValue('password')) $_GET['msg'] = 'error.wrongpassword';
				elseif($_POST['newpassword'] !== $_POST['newpassword2']) $_GET['msg'] = 'error.changepasswordmatch';
				else{
					$users = new FLog_Database;
					if($users->Load('users', true)){
						if(isset($users->records[$FLog_user->rid]) && $users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
							$users->records[$FLog_user->rid]->SetValue('password', md5($_POST['newpassword']));
							if($users->Save()){
								FLog::CallAction('user.passwordchanged', &$users->records[$FLog_user->rid]);
								FLog::Redirect('?+msg=message.passwordsuccess','p');
							}
						}
						$users->Unlock();
					}
					$_GET['msg'] = 'error.changefail';
				}
			}
			elseif(isset($_POST['canceledit'])) FLog::Redirect('?+msg=message.editcancel','p');
			elseif(isset($_POST['canceldelete'])) FLog::Redirect('?+msg=message.deletecancel','p');
		}
		function manage_users_display(){
			global $FLog_user, $FLog_config;
			
			$maxrank = (int)$FLog_config->GetValue('permissions.manage.users');
			$hasrank = ($maxrank >= $FLog_user->GetValue('rank') || $maxrank <= 0);
			
			$users = new FLog_Database; $users->Load('users'); $users->LoadAll();
			$editmode = $deletemode = false; $uid = -1;
			
			if(isset($_POST['uid'])){
				$uid = (int)$_POST['uid'];
				if(isset($_POST['edituser'], $users->records[$uid]) && (((int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank') && $hasrank) || $uid === $FLog_user->rid)) $editmode = true;
				elseif($hasrank && isset($_POST['deleteuser'], $users->records[$uid]) && ((int)$users->records[$uid]->GetValue('rank') > (int)$FLog_user->GetValue('rank') && $uid != $FLog_user->rid)) $deletemode = true;
			}
			
			echo '<h1>', __('admin.manage.users'), '</h1>';
			
			switch((string)@$_GET['msg']){
				case 'error.database':             echo '<p class="error">',__('admin.manage.users.error.database'           ),'</p>'; break;
				case 'error.setrank':              echo '<p class="error">',__('admin.manage.users.error.setrank'            ),'</p>'; break;
				case 'error.newrank':              echo '<p class="error">',__('admin.manage.users.error.newrank'            ),'</p>'; break;
				case 'error.usernametaken':        echo '<p class="error">',__('admin.manage.users.error.usernametaken'      ),'</p>'; break;
				case 'error.invalidusername':      echo '<p class="error">',__('admin.manage.users.error.invalidusername'    ),'</p>'; break;
				case 'error.newpasswordmatch':     echo '<p class="error">',__('admin.manage.users.error.newpasswordmatch'   ),'</p>'; break;
				case 'error.wrongpassword':        echo '<p class="error">',__('admin.manage.users.error.wrongpassword'      ),'</p>'; break;
				case 'error.changepasswordmatch':  echo '<p class="error">',__('admin.manage.users.error.changepasswordmatch'),'</p>'; break;
				
				case 'message.editsuccess':     echo '<p class="message">',__('admin.manage.users.message.editsuccess'    ),'</p>'; break;
				case 'message.editcancel':      echo '<p class="message">',__('admin.manage.users.message.editcancel'     ),'</p>'; break;
				case 'message.deletesuccess':   echo '<p class="message">',__('admin.manage.users.message.deletesuccess'  ),'</p>'; break;
				case 'message.deletecancel':    echo '<p class="message">',__('admin.manage.users.message.deletecancel'   ),'</p>'; break;
				case 'message.newsuccess':      echo '<p class="message">',__('admin.manage.users.message.newsuccess'     ),'</p>'; break;
				case 'message.passwordsuccess': echo '<p class="message">',__('admin.manage.users.message.passwordsuccess'),'</p>'; break;
			}
			
			if($deletemode){
				echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><input name="uid" type="hidden" value="',$uid,'" />';
				echo '<p>',__('admin.manage.users.delete.message', $users->records[$uid]->GetEntities('username')),'</p>';
				echo '<p><input name="confirmdelete" type="submit" value="',__('admin.manage.users.delete.confirm'),'" /> <input name="canceldelete" type="submit" value="',__('admin.manage.users.delete.cancel'),'" /></p>';
				echo '</form>';
			}
			else{
				if($editmode) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
				echo '<table class="admintable">';
				echo '<colgroup><col class="oddcol" style="width:5%;" /><col class="evencol" style="width:15%;" /><col class="oddcol" style="width:15%;" /><col class="evencol" style="width:20%;" /><col class="oddcol" style="width:20%;" /><col class="evencol" style="width:5%;" /><col class="oddcol" style="width:20%;" /></colgroup>';
				echo '<thead><tr><td>',__('admin.manage.users.id'),'</td><td>',__('admin.manage.users.username'),'</td><td>',__('admin.manage.users.name'),'</td><td>',__('admin.manage.users.url'),'</td><td>',__('admin.manage.users.email'),'</td><td>',__('admin.manage.users.rank'),'</td><td>',__('admin.manage.users.action'),'</td></tr></thead><tbody>';
				$i = 0;
				foreach(array_keys($users->records) as $key){
					if($editmode && $uid==$key) echo ((++$i) % 2 == 1)?'<tr class="oddrow current">':'<tr class="evenrow current">';
					else echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
					echo '<td>',$key,'</td><td>',$users->records[$key]->GetSafe('username'),'</td>';
					if($editmode && $uid === $key){
						echo '<td><input type="text" name="name" size="12" value="',isset($_POST['confirmedit'], $_POST['name'])?htmlspecialchars($_POST['name']):$users->records[$key]->GetSafe('name'),'" /></td>';
						echo '<td><input type="text" name="url" size="16" value="',isset($_POST['confirmedit'], $_POST['url'])?htmlspecialchars($_POST['url']):$users->records[$key]->GetSafe('url'),'" /></td>';
						echo '<td><input type="text" name="email" size="16" value="',isset($_POST['confirmedit'], $_POST['email'])?htmlspecialchars($_POST['email']):$users->records[$key]->GetSafe('email'),'" /></td>';
						if($uid != $FLog_user->rid) echo '<td><input type="text" name="rank" size="4" value="',(int)(isset($_POST['confirmedit'], $_POST['rank'])?$_POST['rank']:$users->records[$key]->GetValue('rank')),'" /></td>';
						else echo '<td>',(int)$users->records[$key]->GetValue('rank'),'</td>';
						echo '<td><input type="hidden" name="uid" value="',$key,'" /><input type="submit" name="confirmedit" value="',__('admin.manage.users.edit.confirm'),'" /> <input type="submit" name="canceledit" value="',__('admin.manage.users.edit.cancel'),'" /></td>';
					}
					else{
						echo '<td>',$users->records[$key]->GetEntities('name'),'</td>';
						echo '<td><a href="',$users->records[$key]->GetEntities('url'),'">',$users->records[$key]->GetSafe('url'),'</a></td>';
						echo '<td><a href="mailto:',$users->records[$key]->GetEntities('email'),'">',$users->records[$key]->GetSafe('email'),'</a></td>';
						echo '<td>',(int)$users->records[$key]->GetValue('rank'),'</td>';
						echo '<td>';
						if(!$editmode && (((int)$users->records[$key]->GetValue('rank') > (int)$FLog_user->GetValue('rank') && $hasrank) || $key === $FLog_user->rid)){
							echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><input type="hidden" name="uid" value="',$key,'" /><input type="submit" name="edituser" value="',__('admin.manage.users.edit'),'" />';
							if($key != $FLog_user->rid) echo ' <input type="submit" name="deleteuser" value="',__('admin.manage.users.delete'),'" />';
							echo '</form>';
						}
						echo '</td>';
					}
					echo '</tr>';
				}
				echo '</tbody></table>';
				if($editmode) echo '</form>';
				else{
					if($hasrank){
						echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><fieldset><legend>',__('admin.manage.users.new'),'</legend>';
						echo '<p><label>',__('admin.manage.users.new.username'),'<br /><input name="username" type="text" value="',isset($_POST['newuser'],$_POST['username'])?htmlspecialchars($_POST['username']):'','" /></label></p>';
						echo '<p><label>',__('admin.manage.users.new.password'),'<br /><input name="password" type="password" /></label><br /><input name="password2" type="password" /></p>';
						echo '<p><label>',__('admin.manage.users.new.rank'),'<br /><input name="rank" type="text" value="',isset($_POST['newuser'],$_POST['rank'])?(int)$_POST['rank']:(1+(int)$FLog_user->GetValue('rank')),'" /></label></p>';
						echo '<p><input name="newuser" type="submit" value="',__('admin.manage.users.new.submit'),'" /></p>';
						echo '</fieldset></form>';
					}
					echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8"><fieldset><legend>',__('admin.manage.users.password'),'</legend>';
					echo '<p><label>',__('admin.manage.users.password.oldpassword'),'<br /><input name="oldpassword" type="password" /></label></p>';
					echo '<p><label>',__('admin.manage.users.password.newpassword'),'<br /><input name="newpassword" type="password" /></label><br /><input name="newpassword2" type="password" /></p>';
					echo '<p><input name="changepassword" type="submit" value="',__('admin.manage.users.password.submit'),'" /></p>';
					echo '</fieldset></form>';
				}
			}
		}
		function write_pages_makepage(){
			global $FLog_user, $FLog_config;
			$page = new FLog_DatabaseRecord;
			$page->SetValue('title', trim((string)@$_POST['title']));
			$page->SetValue('markup', trim((string)@$_POST['markup']));
			$page->SetValue('id', trim((string)@$_POST['id']));
			$page->SetValue('text', (string)@$_POST['text']);
			return $page;
		}
		
		function write_pages_updatemenu(&$pages, $pid, $where){
			$size = count($index = FLog::DecodePageIndex($pages));
			$old = -1;
			$l = explode('|', $where, 2);
			$newentry = array('id'=>(string)$pid, 'type'=>'P', 'title'=>'', 'pid'=>'');
			if(isset($pages->records[$pid])){
				$newentry['title'] = $pages->records[$pid]->GetValue('title');
				$newentry['pid'] = $pages->records[$pid]->GetValue('id');
			}
			if(count($l)<2 || (int)$l[1] != $pid){
				for($i=0; $i<$size; ++$i){
					if($index[$i]['type']==='P' && (int)$index[$i]['id']===$pid){
						array_splice($index, $i, 1);
						$old = $i;
						break;
					}
				}
			}
			if($where==='0') array_unshift($index, $newentry);
			elseif(isset($l[1])){
				for($i=0; $i<$size; ++$i){
					if($index[$i]['id']===$l[1]){
						if((int)$l[1]===$pid) array_splice($index, $i, 1, array($newentry));
						else array_splice($index, $i+1, 0, array($newentry));
						break;
					}
				}
				if($i>=$size){
					$x = (int)$l[0];
					if($x>$old) --$x;
					array_splice($index, min($size, max(0, $x)), 0, array($newentry));
				}
			}
			FLog::EncodePageIndex($pages, $index);
		}

		function write_pages_process(){
			global $FLog_user;
			if(isset($_POST['title'], $_POST['markup'], $_POST['id'], $_POST['where'], $_POST['text'], $_POST['submit'])){
				if($_POST['id']==''){
					$_GET['msg'] = 'error.noid';
					return;
				}
				$pages = new FLog_Database();
				$users = new FLog_Database();
				if($pages->Load('pages', true) && $users->Load('users', true)){
					if(isset($users->records[$FLog_user->rid]) && $users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
						$users->records[$FLog_user->rid]->SetValue('admin.write.pages.markup', $_POST['markup']);
						$users->Save();
					}
					$users->Unlock();
					if(isset($_GET['edit'])){
						if(isset($pages->records[$edit = (int)$_GET['edit']])){
							$p = $pages->FindRecord('id', $_POST['id']);
							if($p >= 0 && $p !== $edit){
								$pages->Unlock();
								$_GET['msg'] = 'error.id';
								return;
							}
							if($pages->records[$edit]->Load('pages', $edit)){
								$page = FLog_AdminPages::write_pages_makepage();
								$page->rid = $pages->records[$edit]->rid;
								$pages->records[$edit] = $page;
								FLog_AdminPages::write_pages_updatemenu($pages, $edit, $_POST['where']);
								if($pages->Save()){
									FLog::CallAction('page.edited', &$page);
									FLog::Redirect('?+msg=message.success&edit='.$edit,'p');
								}
							}
						}
						else{
							$pages->Unlock();
							$_GET['msg'] = 'error.notfound';
							return;
						}
					}
					else{
						if($pages->FindRecord('id', $_POST['id']) >= 0){
							$pages->Unlock();
							$_GET['msg'] = 'error.id';
							return;
						}
						$page = FLog_AdminPages::write_pages_makepage();
						$pages->InsertRecord($page);
						FLog_AdminPages::write_pages_updatemenu($pages, $page->rid, $_POST['where']);
						if($pages->Save()){
							FLog::CallAction('page.added', &$page);
							FLog::Redirect('?+msg=message.success&page='.$page->rid,'p');
						}
					}
				}
				$users->Unlock();
				$pages->Unlock();
			}
		}
		
		function write_pages_display(){
			global $FLog_markup, $FLog_config, $FLog_user;

			$pages = new FLog_Database();
			$pages->Load('pages');
			
			$index = FLog::DecodePageIndex($pages);
			
			$edit = false;
			if(isset($_GET['edit'])){
				if(isset($pages->records[(int)$_GET['edit']])){
					$edit = (int)$_GET['edit'];
					$pages->records[$edit]->Load('pages', $edit);
					$page = $pages->records[$edit];
				}
				else{
					$_GET['msg'] = 'error.notfound';
				}
			}
			if($edit === false || isset($_POST['title'], $_POST['id'], $_POST['markup'], $_POST['text'])) $page = FLog_AdminPages::write_pages_makepage();

			if($edit!==false) echo '<h1>',__('admin.write.pages.edit'),'</h1>';
			else echo '<h1>',__('admin.write.pages'),'</h1>';

			if(@$_GET['msg']==='message.success'){
				if($edit!==false){
					echo '<p class="message">',__('admin.write.pages.message.editsuccess'),'</p>';
					$p = $edit;
				}
				else{
					echo '<p class="message">',__('admin.write.pages.message.success'),'</p>';
					$p = (int)$_GET['page'];
				}
				echo '<ul>';
				echo '<li>',__('admin.write.pages.message.success.view', isset($pages->records[$p])?('index.php?page='.rawurlencode($pages->records[$p]->GetValue('id'))):('index.php?pageid='.$p)),'</li>';
				echo '<li>',__('admin.write.pages.message.success.edit', 'admin.php?edit='.rawurlencode($p).FLog::AppendQuerySafe('','p')),'</li>';
				echo '<li>',__('admin.write.pages.message.success.more', 'admin.php'.FLog::LimitQuerySafe('','p')),'</li>';
				echo '<li>',__('admin.write.pages.message.success.manage', 'admin.php?p=manage.pages'),'</li>';
				echo '</ul>';
				return;
			}
			else switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.write.pages.error.database'),'</p>'; break;
				case 'error.id': echo '<p class="error">',__('admin.write.pages.error.id'),'</p>'; break;
				case 'error.notfound': echo '<p class="error">',__('admin.write.pages.error.notfound'),'</p>'; break;
			}

			if(isset($_POST['preview'])){
				echo '<fieldset><legend>',__('admin.write.pages.previewbox'),'</legend>';
				echo FLog::CallFilter('page_preview', FLog::CallMarkup($page->GetValue('markup'), $page->GetValue('text')));
				echo '</fieldset>';
			}

			if($edit===false) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
			else echo '<form method="post" action="admin.php?edit=',rawurlencode($edit),FLog::AppendQuerySafe('','p'),'" accept-charset="utf-8">';
			echo '<table class="layouttable">';
			echo '<colgroup><col style="width:50%" /><col style="width:50%" /></colgroup>';
			echo '<tbody>';
			echo '<tr>';
			echo '<td><label>',__('admin.write.pages.title'),'<br /><input name="title" type="text" size="32" value="',$page->GetSafe('title'),'" /></label></td>';
			echo '<td><label>',__('admin.write.pages.markup'),'<br /><select name="markup"><option value="">',__('admin.write.pages.markup.none'),'</option>';
			foreach(array_keys($FLog_markup) as $key){
				echo '<option value="',htmlspecialchars($key),'"',$page->GetValue('markup')===$key?' selected="selected"':'','>',$FLog_markup[$key]['name'],'</option>';
			}
			echo '</select></label></td>';
			echo '</tr><tr>';
			echo '<td><label>',__('admin.write.pages.id'),'<br /><input name="id" type="text" size="32" value="',$page->GetSafe('id'),'" /></label></td>';
			echo '<td><label>',__('admin.write.pages.where'),'<br /><select name="where">';
			echo '<option value="-">',__('admin.write.pages.where.none'),'</option>';
			echo '<option value="0"',(string)@$_POST['where']==='0'?' selected="selected"':'','>',__('admin.write.pages.where.top'),'</option>';
			foreach($index as $i=>$line){
				$v = ($i+1).'|'.htmlspecialchars($line['id']);
				$s = false;
				if(isset($_POST['where'])){
					if($_POST['where']===$v) $s = true;
				}
				elseif($line['type']==='P' && (int)$line['id'] === $page->rid) $s = true;
				echo '<option value="',$v,'"',$s?' selected="selected"':'','>';

				switch($line['type']){
					case 'S': echo __('admin.write.pages.where.separator', FLog::SafeEntities($line['title'])); break;
					case 'L': echo __('admin.write.pages.where.link', FLog::SafeEntities($line['title'])); break;
					default: echo __('admin.write.pages.where.page', FLog::SafeEntities($line['title'])); break;
				}
				
				echo '</option>';
			}
			echo '</select></label></td>';
			echo '</tr>';
			echo '<tr><td colspan="2"><label>',__('admin.write.pages.text'),'<br /><textarea name="text" rows="15" cols="48">',$page->GetSafe('text'),'</textarea></label></td></tr>';
			echo '<tr><td colspan="2"><input name="preview" type="submit" value="',__('admin.write.pages.preview'),'" /> <input name="submit" type="submit" value="',__('admin.write.pages.submit'),'" /></td></tr>';
			echo '</tbody>';
			echo '</table>';
			echo '</form>';
		}
		function write_posts_makepost(&$cats){
			global $FLog_user, $FLog_config;
			$post = new FLog_DatabaseRecord;
			if(isset($_POST['title'], $_POST['markup'], $_POST['year'], $_POST['month'], $_POST['day'], $_POST['hour'], $_POST['minute'], $_POST['text'])){
				$post->SetValue('title', trim($_POST['title']));
				$post->SetValue('markup', trim($_POST['markup']));
				$post->SetValue('text', $_POST['text']);
				if(isset($_POST['now'])) $post->SetValue('time', FLog::ServerTime());
				else $post->SetValue('time', FLog::ServerTime(gmmktime((int)$_POST['hour'], (int)$_POST['minute'], 0, (int)$_POST['month'], (int)$_POST['day'], (int)$_POST['year'])));
				$post->SetValue('allowcomments', isset($_POST['comments'])?1:0);
				$post->SetValue('comments', 0);
				$post->SetValue('draft', isset($_POST['draft'])?1:0);
				$post->SetValue('delay', isset($_POST['delay'])?1:0);
				$post->SetValue('author', $FLog_user->rid);
				$catarray = array();
				foreach(array_keys($cats->records) as $key){
					if(isset($_POST['cat_'.$key])){
						$catarray[] = $key;
					}
				}
				$post->SetValue('cats', implode(',', $catarray));
			}
			else{
				$post->SetValue('title', '');
				$post->SetValue('markup', $FLog_user->GetValue('admin.write.posts.markup'));
				$post->SetValue('text', '');
				$post->SetValue('time', FLog::ServerTime());
				$post->SetValue('allowcomments', $FLog_user->GetValue('admin.write.posts.allowcomments'));
				$post->SetValue('comments', 0);
				$post->SetValue('draft', 0);
				$post->SetValue('delay', 0);
				$post->SetValue('author', $FLog_user->rid);
				$post->SetValue('cats', '');
			}
			return $post;
		}
		
		function write_posts_process(){
			global $FLog_user;
			if(isset($_POST['title'], $_POST['markup'], $_POST['year'], $_POST['month'], $_POST['day'], $_POST['hour'], $_POST['minute'], $_POST['text'], $_POST['submit'])){
				$cats = new FLog_Database();
				$posts = new FLog_Database();
				$users = new FLog_Database();
				if($posts->Load('posts', true)){
					if($cats->Load('cats', true)){
						$cats->LoadAll();
						if($users->Load('users', true)){
							if(isset($users->records[$FLog_user->rid]) && $users->records[$FLog_user->rid]->Load('users', $FLog_user->rid)){
								$users->records[$FLog_user->rid]->SetValue('admin.write.posts.markup', $_POST['markup']);
								$users->records[$FLog_user->rid]->SetValue('admin.write.posts.allowcomments', isset($_POST['comments'])?1:0);
								$post = FLog_AdminPages::write_posts_makepost($cats);
								if(isset($_GET['edit'])){
									if(isset($posts->records[$edit = (int)$_GET['edit']])){
										if($posts->records[$edit]->Load('posts', $edit)){
											$post->SetValue('comments', $posts->records[$edit]->GetValue('comments'));
											if(($uid = (int)$posts->records[$edit]->GetValue('author')) != $FLog_user->rid){
												if(!(isset($users->records[$uid]) && $users->records[$uid]->Load('users', $uid) && (int)$users->records[$uid]->GetValue('rank')>(int)$FLog_user->GetValue('rank'))){
													$users->Unlock();
													$cats->Unlock();
													$posts->Unlock();
													$_GET['msg'] = 'error.permissions';
													return;
												}
											}
											$post->SetValue('author', $uid);
											$post->rid = $edit;
											$oldpost = $posts->records[$edit];
											$posts->records[$edit] = $post;
											if($posts->Save()){
												foreach(explode(',', $oldpost->GetValue('cats')) as $cat){
													if($cat === '') continue;
													if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('posts', max((int)$cats->records[$cat]->GetValue('posts')-1,0));
												}
												foreach(explode(',', $post->GetValue('cats')) as $cat){
													if($cat === '') continue;
													if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('posts', 1+(int)$cats->records[$cat]->GetValue('posts'));
												}
												$cats->Save();
												$users->Save();
												FLog::CallAction('post.edited', &$post);
												FLog::Redirect('?+msg=message.success&edit='.$edit,'p');
											}
										}
									}
								}
								else{
									$posts->InsertRecord($post);
									foreach(explode(',', $post->GetValue('cats')) as $cat){
										if($cat === '') continue;
										if(isset($cats->records[$cat = (int)$cat])) $cats->records[$cat]->SetValue('posts', 1+(int)$cats->records[$cat]->GetValue('posts'));
									}
									if($posts->Save()){
										$cats->Save();
										$users->Save();
										FLog::CallAction('post.added', &$post);
										FLog::Redirect('?+msg=message.success&post='.$post->rid,'p');
									}
								}
							}
							$users->Unlock();
						}
						$cats->Unlock();
					}
					$posts->Unlock();
				}
				$_GET['msg'] = 'error.database';
			}
		}
		
		function write_posts_display(){
			global $FLog_markup, $FLog_config, $FLog_user;
			$cats = new FLog_Database();
			if($cats->Load('cats')) $cats->LoadAll();
			$cats->Sort('name', SORT_ASC, 'strnatcasecmp');
			$numcats = count($cats->records);
			$edit = false;
			if(isset($_GET['edit'])){
				$posts = new FLog_Database();
				if($posts->Load('posts') && isset($posts->records[(int)$_GET['edit']])){
					$edit = (int)$_GET['edit'];
					$posts->records[$edit]->Load('posts', $edit);
					$post = $posts->records[$edit];
					if(($uid = (int)$post->GetValue('author')) != $FLog_user->rid){
						$users = new FLog_Database;
						if($users->Load($users)){
							if(isset($users->records[$uid]) && $users->records[$uid]->Load('users', $uid) && (int)$users->records[$uid]->GetValue('rank')<=(int)$FLog_user->GetValue('rank')){
								FLog::Redirect('?+msg=error.permissions','p');
							}
						}
					}
				}
				else{
					$_GET['msg'] = 'error.notfound';
				}
			}
			if($edit === false || isset($_POST['title'], $_POST['markup'], $_POST['year'], $_POST['month'], $_POST['day'], $_POST['hour'], $_POST['minute'], $_POST['text'])) $post = FLog_AdminPages::write_posts_makepost($cats);
			
			$time = FLog::LocalTime((int)$post->GetValue('time'));
			if(isset($_POST['year'], $_POST['month'], $_POST['day'], $_POST['hour'], $_POST['minute']) && !isset($_POST['now'])){
				if(checkdate((int)$_POST['month'], (int)$_POST['day'], (int)$_POST['year'])){
					$time = FLog::LocalTime(gmmktime((int)$_POST['hour'], (int)$_POST['minute'], 0, (int)$_POST['month'], (int)$_POST['day'], (int)$_POST['year'], 0));
				}
			}
			
			if($edit!==false) echo '<h1>',__('admin.write.posts.edit'),'</h1>';
			else echo '<h1>',__('admin.write.posts'),'</h1>';
			
			if(@$_GET['msg']==='message.success'){
				if($edit!==false){
					echo '<p class="message">',__('admin.write.posts.message.editsuccess'),'</p>';
					$p = $edit;
				}
				else{
					echo '<p class="message">',__('admin.write.posts.message.success'),'</p>';
					$p = (int)$_GET['post'];
				}
				echo '<ul>';
				echo '<li>',__('admin.write.posts.message.success.view', 'index.php?post='.$p),'</li>';
				echo '<li>',__('admin.write.posts.message.success.edit', 'admin.php?edit='.$p.FLog::AppendQuerySafe('','p')),'</li>';
				echo '<li>',__('admin.write.posts.message.success.more', 'admin.php'.FLog::LimitQuerySafe('','p')),'</li>';
				echo '<li>',__('admin.write.posts.message.success.manage', 'admin.php?p=manage.posts'),'</li>';
				echo '</ul>';
				return;
			}
			else switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">',__('admin.write.posts.error.database'),'</p>'; break;
				case 'error.permissions': echo '<p class="error">',__('admin.write.posts.error.permissions'),'</p>'; break;
				case 'error.notfound': echo '<p class="error">',__('admin.write.posts.error.notfound'),'</p>';
			}

			if(isset($_POST['preview'])){
				echo '<fieldset><legend>',__('admin.write.posts.previewbox'),'</legend>';
				echo FLog::CallFilter('post_preview', FLog::CallMarkup($post->GetValue('markup'), $post->GetValue('text')));
				echo '</fieldset>';
			}
			if($edit===false) echo '<form method="post" action="admin.php',FLog::LimitQuerySafe('','p'),'" accept-charset="utf-8">';
			else echo '<form method="post" action="admin.php?edit=',$edit,FLog::AppendQuerySafe('','p'),'" accept-charset="utf-8">';
			echo '<table class="layouttable">';
			echo '<colgroup><col style="width:30%" /><col style="width:30%" /><col style="width:40%" /></colgroup>';
			echo '<tbody>';
			echo '<tr>';
			echo '<td><label>',__('admin.write.posts.title'),'<br /><input name="title" type="text" size="32" value="',$post->GetSafe('title'),'" /></label></td>';
			echo '<td><label>',__('admin.write.posts.markup'),'<br /><select name="markup"><option value="">',__('admin.write.posts.markup.none'),'</option>';
			foreach(array_keys($FLog_markup) as $key){
				echo '<option value="',htmlspecialchars($key),'"',$post->GetValue('markup')===$key?' selected="selected"':'','>',$FLog_markup[$key]['name'],'</option>';
			}
			echo '</select></label></td>';
			echo '<td rowspan="4"><fieldset><legend>',__('admin.write.posts.cats'),'</legend>';
			$catarray = explode(',', $post->GetValue('cats'));
			foreach($catarray as $key=>$value){
				if($value==='') $catarray[$key] = -1;
				else $catarray[$key] = (int)$value;
			}
			foreach(array_keys($cats->records) as $key){
				echo '<label><input type="checkbox" name="cat_',$key,'" ',in_array($key, $catarray)?' checked="checked"':'','/>',$cats->records[$key]->GetEntities('name'),'</label><br />';
			}
			echo '</fieldset></td></tr><tr>';
			echo '<td><label>',__('admin.write.posts.time'),'<br />';
			echo '<input name="year" type="text" size="4" value="',gmdate('Y',$time),'" /></label>-';
			echo '<input name="month" type="text" size="2" value="',gmdate('m',$time),'" />-';
			echo '<input name="day" type="text" size="2" value="',gmdate('d',$time),'" />, ';
			echo '<input name="hour" type="text" size="2" value="',gmdate('H',$time),'" />:';
			echo '<input name="minute" type="text" size="2" value="',gmdate('i',$time),'" /><br />';
			echo '<input name="now" type="checkbox"',(isset($_POST['now']) || !(isset($_POST['preview']) || isset($_POST['submit']) || $edit))?' checked="checked"':'',' /> ',__('admin.write.posts.time.now'),'</td>';
			echo '<td><label><input name="comments" type="checkbox"',(int)$post->GetValue('allowcomments')?' checked="checked"':'',' /> ',__('admin.write.posts.comments'),'</label><br />';
			echo '<label><input name="draft" type="checkbox"',(int)$post->GetValue('draft')?' checked="checked"':'',' /> ',__('admin.write.posts.draft'),'</label><br />';
			echo '<label><input name="delay" type="checkbox"',(int)$post->GetValue('delay')?' checked="checked"':'',' /> ',__('admin.write.posts.delay'),'</label></td>';
			echo '</tr>';
			echo '<tr><td colspan="2"><label>',__('admin.write.posts.text'),'<br /><textarea name="text" rows="15" cols="48">',$post->GetSafe('text'),'</textarea></label></td></tr>';
			echo '<tr><td colspan="2" style="vertical-align:bottom;"><input name="preview" type="submit" value="',__('admin.write.posts.preview'),'" /> <input name="submit" type="submit" value="',__('admin.write.posts.submit'),'" /></td></tr>';
			echo '</tbody>';
			echo '</table>';
			echo '</form>';
		}

		function stats_process(){}
		function stats_overall_display(){
			$stats = new FLog_Database(); if($stats->Load('stats')) $stats->LoadAll();
			$posts_db = new FLog_Database(); $posts_db->Load('posts');
			$pages_db = new FLog_Database(); $pages_db->Load('pages');

			if(($id = $stats->FindRecord('id', 'browsers'))>=0){ $browsers = $stats->records[$id]->fields; unset($browsers['id']); natsort($browsers); }else $browsers = array();
			if(($id = $stats->FindRecord('id', 'os'))>=0){ $systems = $stats->records[$id]->fields; unset($systems['id']); natsort($systems); } else $systems = array();
			$pages = array(); $posts = array();
			if(($id = $stats->FindRecord('id', 'pages'))>=0){
				foreach($stats->records[$id]->fields as $key=>$value){
					if($key==='id') continue;
					$t = substr($key,0,4);
					$i = (int)substr($key,4);
					if($t === 'post') $posts[$i] = $value;
					elseif($t === 'page') $pages[$i] = $value;
				}
				natsort($posts); $posts = array_reverse($posts, true);
				natsort($pages); $pages = array_reverse($pages, true);
			}
			$browsers = array_reverse($browsers, true);
			$systems = array_reverse($systems, true);
			echo '<h1>',__('admin.stats.overall'),'</h1>';
			$time = time();
			$total = $year = $month = $day = $hour = array(0,0);
			$y = gmdate('Y',$time);
			$m = gmdate('m',$time);
			$d = gmdate('d',$time);
			$h = gmdate('H',$time);
			if(($id = $stats->FindRecord('id', 'years'))>=0){
				$total = array((int)$stats->records[$id]->GetValue('total'), (int)$stats->records[$id]->GetValue('total_u'));
				$year = array((int)$stats->records[$id]->GetValue($y), (int)$stats->records[$id]->GetValue($y.'_u'));
			}
			if(($id = $stats->FindRecord('id', 'months'))>=0){
				if(gmdate('Y',(int)$stats->records[$id]->GetValue($m.'_t'))===$y){
					$month = array((int)$stats->records[$id]->GetValue($m), (int)$stats->records[$id]->GetValue($m.'_u'));
				}
			}
			if(($id = $stats->FindRecord('id', 'days'))>=0){
				if(gmdate('Ym',(int)$stats->records[$id]->GetValue($d.'_t'))===gmdate('Ym',$time)){
					$day = array((int)$stats->records[$id]->GetValue($d), (int)$stats->records[$id]->GetValue($d.'_u'));
				}
			}
			if(($id = $stats->FindRecord('id', 'hours'))>=0){
				if(gmdate('Ymd',(int)$stats->records[$id]->GetValue($h.'_t'))===gmdate('Ymd',$time)){
					$hour = array((int)$stats->records[$id]->GetValue($h), (int)$stats->records[$id]->GetValue($h.'_u'));
				}
			}
			echo '<table class="admintable">';
			echo '<colgroup>';
			echo '<col class="oddcol" style="width:20%;" />';
			echo '<col class="oddcol" style="width:5%;" />';
			echo '<col class="evencol" style="width:20%;" />';
			echo '<col class="evencol" style="width:5%;" />';
			echo '<col class="oddcol" style="width:20%;" />';
			echo '<col class="oddcol" style="width:5%;" />';
			echo '<col class="evencol" style="width:20%;" />';
			echo '<col class="evencol" style="width:5%;" />';
			echo '</colgroup>';
			echo '<thead><tr>';
			echo '<td colspan="2">',__('admin.stats.overall.browsers'),'</td>';
			echo '<td colspan="2">',__('admin.stats.overall.systems'),'</td>';
			echo '<td colspan="2">',__('admin.stats.overall.posts'),'</td>';
			echo '<td colspan="2">',__('admin.stats.overall.pages'),'</td>';
			echo '</tr></thead>';
			reset($browsers);
			reset($systems);
			reset($posts);
			reset($pages);
			for($i=0; $i<25; ++$i){
				if(current($browsers)===false && current($systems)===false && current($posts)===false && current($pages)===false) break;
				if($i%2==0) echo '<tr class="oddrow">';
				else echo '<tr class="evenrow">';
				echo '<td>',htmlspecialchars((string)key($browsers)),'</td><td>',htmlspecialchars((string)current($browsers)),'</td>';
				echo '<td>',htmlspecialchars((string)key($systems)),'</td><td>',htmlspecialchars((string)current($systems)),'</td>';
				$p = true;
				if(current($posts)!==false){
					while(!isset($posts_db->records[$pid = key($posts)]) && current($posts)!==false) next($posts);
					if(isset($posts_db->records[$pid = key($posts)])){
						echo '<td><a href="index.php?post=',$pid,'">',$posts_db->records[$pid]->GetEntities('title'),'</a></td><td>',htmlspecialchars((string)current($posts)),'</td>';
						$p = false;
					}
				}
				if($p) echo '<td></td><td></td>';
				$p = true;
				if(current($pages)!==false){
					while(!isset($pages_db->records[$pid = key($pages)]) && current($pages)!==false) next($pages);
					if(isset($pages_db->records[$pid = key($pages)])){
						echo '<td><a href="index.php?page=',urlencode($pages_db->records[$pid]->GetValue('id')),'">',$pages_db->records[$pid]->GetEntities('title'),'</a></td><td>',htmlspecialchars((string)current($pages)),'</td>';
						$p = false;
					}
				}
				if($p) echo '<td></td><td></td>';					
				echo '</tr>';
				next($browsers);
				next($systems);
				next($posts);
				next($pages);
			}
			echo '</table>';
			echo '<p>',__('admin.stats.overall.total', $total[0], $total[1]),'</p>';
			echo '<p>',__('admin.stats.overall.year', $year[0], $year[1]),'</p>';
			echo '<p>',__('admin.stats.overall.month', $month[0], $month[1]),'</p>';
			echo '<p>',__('admin.stats.overall.day', $day[0], $day[1]),'</p>';
			echo '<p>',__('admin.stats.overall.hour', $hour[0], $hour[1]),'</p>';
		}
		function stats_graphs_display(){
			$stats = new FLog_Database;
			if($stats->Load('stats')) $stats->LoadAll();
			$time = time();
			$yearmax = $monthmax = $daymax = $hourmax = 1;
			$years = $months = $days = $hours = array();
			if(($id = $stats->FindRecord('id', 'hours'))>=0){
				$h = (int)gmdate('H',$time);
				for($i=$h+1; $i<24; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(gmdate('Ymd',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Ymd',strtotime('-1 day', $time))){
						$hours[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$hourmax = max($hours[$t][0], $hourmax);
					} else $hours[$t] = array(0,0);
				}
				for($i=0; $i<=$h; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(gmdate('Ymd',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Ymd', $time)){
						$hours[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$hourmax = max($hours[$t][0], $hourmax);
					} else $hours[$t] = array(0,0);
				}
			}
		
			if(($id = $stats->FindRecord('id', 'days'))>=0){
				$d = (int)gmdate('d',$time);
				$t = strtotime('-1 month', $time);
				$x = 31; while(!checkdate((int)gmdate('m',$t),$x,(int)gmdate('Y',$t))) --$x;
				for($i=$d+1; $i<=$x; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(gmdate('Ym',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Ym',strtotime('-1 month', $time))){
						$days[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$daymax = max($days[$t][0], $daymax);
					} else $days[$t] = array(0,0);
				}
				for($i=1; $i<=$d; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(isset($days[$t])) unset($days[$t]);
					if(gmdate('Ym',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Ym', $time)){
						$days[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$daymax = max($days[$t][0], $daymax);
					} else $days[$t] = array(0,0);
				}
			}
			while(count($days)>30){
				reset($days);
				unset($days[key($days)]);
			}
			
			if(($id = $stats->FindRecord('id', 'months'))>=0){
				$m = (int)gmdate('m',$time);
				for($i=$m+1; $i<=12; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(gmdate('Y',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Y',strtotime('-1 year', $time))){
						$months[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$monthmax = max($months[$t][0], $monthmax);
					} else $months[$t] = array(0,0);
				}
				for($i=1; $i<=$m; ++$i){
					$t = ($i<10?'0':'').(string)$i;
					if(gmdate('Y',(int)$stats->records[$id]->GetValue($t.'_t'))===gmdate('Y', $time)){
						$months[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
						$monthmax = max($months[$t][0], $monthmax);
					} else $months[$t] = array(0,0);
				}
			}
		
			if(($id = $stats->FindRecord('id', 'years'))>=0){
				$y = (int)gmdate('Y',$time);
				for($i=$y-4; $i<=$y; ++$i){
					$t = (string)$i;
					$years[$t] = array((int)$stats->records[$id]->GetValue($t), (int)$stats->records[$id]->GetValue($t.'_u'));
					$yearmax = max($years[$t][0], $yearmax);
				}
			}
		
			echo '<h1>',__('admin.stats.graphs'),'</h1>';
			echo '<table class="layouttable">';

			echo '<tr><td colspan="2">',__('admin.stats.graphs.hours');
			echo '<table class="graphtable">';
			echo '<tr>';
			foreach($hours as $value){
				$h2 = (10 * $value[0]) / $hourmax - ($h3 = (10 * $value[1]) / $hourmax);
				$h1 = 13.5-($h2+$h3);
				echo '<td class="bar" style="width:4.167%"><table class="graphbar">';
				echo '<tr><td class="top" style="height:',$h1,'em;">',$value[0],'<br />',$value[1],'</td></tr>';
				echo '<tr><td class="middle" style="height:',$h2,'em;"></td></tr>';
				if($value[1] > 0) echo '<tr><td class="bottom" style="height:',$h3,'em;"></td></tr>';
				echo '</table></td>';
			}
			echo '</tr>';
			echo '<tr class="caption">';
			foreach(array_keys($hours) as $key){
				echo '<td>',$key,'</td>';
			}
			echo '</tr>';
			echo '</table>';
			echo '</td></tr>';
			
			echo '<tr><td colspan="2">',__('admin.stats.graphs.days');
			echo '<table class="graphtable">';
			echo '<tr>';
			foreach($days as $value){
				$h2 = (10 * $value[0]) / $daymax - ($h3 = (10 * $value[1]) / $daymax);
				$h1 = 13.5-($h2+$h3);
				echo '<td class="bar" style="width:3.333%;"><table class="graphbar">';
				echo '<tr><td class="top" style="height:',$h1,'em;">',$value[0],'<br />',$value[1],'</td></tr>';
				echo '<tr><td class="middle" style="height:',$h2,'em;"></td></tr>';
				if($value[1] > 0) echo '<tr><td class="bottom" style="height:',$h3,'em;"></td></tr>';
				echo '</table></td>';
			}
			echo '</tr>';
			echo '<tr class="caption">';
			foreach(array_keys($days) as $key){
				echo '<td>',$key,'</td>';
			}
			echo '</tr>';
			echo '</table>';
			echo '</td></tr>';
			
			echo '<tr><td style="width:67%;">',__('admin.stats.graphs.months');
			echo '<table class="graphtable">';
			echo '<tr>';
			foreach($months as $value){
				$h2 = (10 * $value[0]) / $monthmax - ($h3 = (10 * $value[1]) / $monthmax);
				$h1 = 13.5-($h2+$h3);
				echo '<td class="bar" style="width:8.333%;"><table class="graphbar">';
				echo '<tr><td class="top" style="height:',$h1,'em;">',$value[0],'<br />',$value[1],'</td></tr>';
				echo '<tr><td class="middle" style="height:',$h2,'em;"></td></tr>';
				if($value[1] > 0) echo '<tr><td class="bottom" style="height:',$h3,'em;"></td></tr>';
				echo '</table></td>';
			}
			echo '</tr>';
			echo '<tr class="caption">';
			foreach(array_keys($months) as $key){
				echo '<td>',__('admin.stats.graphs.months.'.$key),'</td>';
			}
			echo '</tr>';
			echo '</table>';
			echo '</td>';
			
			echo '<td style="width:33%;">',__('admin.stats.graphs.years');
			echo '<table class="graphtable">';
			echo '<tr>';
			foreach($years as $value){
				$h2 = (10 * $value[0]) / $yearmax - ($h3 = (10 * $value[1]) / $yearmax);
				$h1 = 13.5-($h2+$h3);
				echo '<td class="bar" style="width:20%;"><table class="graphbar">';
				echo '<tr><td class="top" style="height:',$h1,'em;">',$value[0],'<br />',$value[1],'</td></tr>';
				echo '<tr><td class="middle" style="height:',$h2,'em;"></td></tr>';
				if($value[1] > 0) echo '<tr><td class="bottom" style="height:',$h3,'em;"></td></tr>';
				echo '</table></td>';
			}
			echo '</tr>';
			echo '<tr class="caption">';
			foreach(array_keys($years) as $key){
				echo '<td>',$key,'</td>';
			}
			echo '</tr>';
			echo '</table>';
			echo '</td></tr>';
			
			
			echo '</table>';
		}
		
		function stats_recent_callback(&$a, &$b){
			return (int)@$b[1] - (int)@$a[1];
		}
		function stats_recent_display(){
			$stats = new FLog_Database();
			if($stats->Load('stats')) $stats->LoadAll();
			if(($id = $stats->FindRecord('id', 'users'))>=0){
				$users = $stats->records[$id]->fields;
				unset($users['id']);

				foreach($users as $key=>$value){
					$users[$key] = FLog::Unescape(explode("\t", $value));
				}
				uasort($users, array('FLog_AdminPages', 'stats_recent_callback'));
			}
			echo '<table class="admintable">';
			echo '<colgroup>';
			echo '<col class="oddcol" style="width:25%;" />';
			echo '<col class="evencol" style="width:20%;" />';
			echo '<col class="oddcol" style="width:25%;" />';
			echo '<col class="evencol" style="width:25%;" />';
			echo '<col class="oddcol" style="width:5%;" />';
			echo '</colgroup>';
			echo '<thead><tr>';
			echo '<td>',__('admin.stats.recent.time'),'</td>';
			echo '<td>',__('admin.stats.recent.ip'),'</td>';
			echo '<td>',__('admin.stats.recent.browser'),'</td>';
			echo '<td>',__('admin.stats.recent.system'),'</td>';
			echo '<td>',__('admin.stats.recent.hits'),'</td>';
			echo '</tr></thead>';
			echo '<tbody>';
			$i=0;
			foreach($users as $user){
				if((++$i)%2==0) echo '<tr class="evenrow">';
				else echo '<tr class="oddrow">';
				// MD5 -> IP TIME OS BROWSER HITS
				echo '<td>',__('admin.stats.recent.time.display',FLog::FormatLocalDate((int)$user[1]),FLog::FormatLocalTime((int)$user[1])),'</td>';
				echo '<td>',htmlspecialchars($user[0]),'</td>';
				echo '<td>',htmlspecialchars($user[3]),'</td>';
				echo '<td>',htmlspecialchars($user[2]),'</td>';
				echo '<td>',(int)$user[4],'</td>';
				echo '</tr>';
			}
			echo '</tbody></table>';
		}
	}
	
	FLog::RegisterAdminPage('write.posts', __('admin.write.posts'), array('FLog_AdminPages', 'write_posts_process'), array('FLog_AdminPages', 'write_posts_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.write.posts'));
	FLog::RegisterAdminPage('write.pages', __('admin.write.pages'), array('FLog_AdminPages', 'write_pages_process'), array('FLog_AdminPages', 'write_pages_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.write.pages'));
	FLog::RegisterAdminPage('manage.posts', __('admin.manage.posts'), array('FLog_AdminPages', 'manage_posts_process'), array('FLog_AdminPages', 'manage_posts_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.posts'));
	FLog::RegisterAdminPage('manage.pages', __('admin.manage.pages'), array('FLog_AdminPages', 'manage_pages_process'), array('FLog_AdminPages', 'manage_pages_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.pages'));
	FLog::RegisterAdminPage('manage.comments', __('admin.manage.comments'), array('FLog_AdminPages', 'manage_comments_process'), array('FLog_AdminPages', 'manage_comments_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.comments'));
	FLog::RegisterAdminPage('manage.links', __('admin.manage.links'), array('FLog_AdminPages', 'manage_links_process'), array('FLog_AdminPages', 'manage_links_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.links'));
	FLog::RegisterAdminPage('manage.cats', __('admin.manage.cats'), array('FLog_AdminPages', 'manage_cats_process'), array('FLog_AdminPages', 'manage_cats_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.manage.categories'));
	FLog::RegisterAdminPage('manage.users', __('admin.manage.users'), array('FLog_AdminPages', 'manage_users_process'), array('FLog_AdminPages', 'manage_users_display'));
	FLog::RegisterAdminPage('config.general', __('admin.config.general'), array('FLog_AdminPages', 'config_general_process'), array('FLog_AdminPages', 'config_general_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.config.general'));
	FLog::RegisterAdminPage('config.display', __('admin.config.display'), array('FLog_AdminPages', 'config_display_process'), array('FLog_AdminPages', 'config_display_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.config.display'));
	FLog::RegisterAdminPage('config.discussion', __('admin.config.discussion'), array('FLog_AdminPages', 'config_discussion_process'), array('FLog_AdminPages', 'config_discussion_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.config.discussion'));
	FLog::RegisterAdminPage('config.permissions', __('admin.config.permissions'), array('FLog_AdminPages', 'config_permissions_process'), array('FLog_AdminPages', 'config_permissions_display'), (int)$GLOBALS['FLog_config']->GetValue('permissions.config.permissions'));
	FLog::RegisterAdminPage('stats.overall', __('admin.stats.overall'), array('FLog_AdminPages', 'stats_process'), array('FLog_AdminPages', 'stats_overall_display'));
	FLog::RegisterAdminPage('stats.graphs', __('admin.stats.graphs'), array('FLog_AdminPages', 'stats_process'), array('FLog_AdminPages', 'stats_graphs_display'));
	FLog::RegisterAdminPage('stats.recent', __('admin.stats.recent'), array('FLog_AdminPages', 'stats_process'), array('FLog_AdminPages', 'stats_recent_display'));
?>