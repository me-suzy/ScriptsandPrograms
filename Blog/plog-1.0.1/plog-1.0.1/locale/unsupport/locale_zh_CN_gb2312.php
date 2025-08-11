<?php
// set this to the encoding that should be used to display the pages correctly,translated by JianxinLiu,Tianjin University
$messages['encoding'] = 'gb2312';
$messages['locale_description'] = 'Simplified Chinese translation (GB2312)';
// locale format, see Locale::formatDate for more information
$messages['date_format'] = '%d/%m/%Y %H:%M';

// days of the week
$messages['days'] = Array( 'ÐÇÆÚÈÕ', 'ÐÇÆÚÒ»', 'ÐÇÆÚ¶þ', 'ÐÇÆÚÈý', 'ÐÇÆÚËÄ', 'ÐÇÆÚÎå', 'ÐÇÆÚÁù' );
// -- compatibility, do not touch -- //
$messages['Monday'] = $messages['days'][1];
$messages['Tuesday'] = $messages['days'][2];
$messages['Wednesday'] = $messages['days'][3];
$messages['Thursday'] = $messages['days'][4];
$messages['Friday'] = $messages['days'][5];
$messages['Saturday'] = $messages['days'][6];
$messages['Sunday'] = $messages['days'][0];

// abbreviations
$messages['daysshort'] = Array( 'ÈÕ', 'Ò»', '¶þ', 'Èý', 'ËÄ', 'Îå', 'Áù' );
// -- compatibility, do not touch -- //
$messages['Mo'] = $messages['daysshort'][1];
$messages['Tu'] = $messages['daysshort'][2];
$messages['We'] = $messages['daysshort'][3];
$messages['Th'] = $messages['daysshort'][4];
$messages['Fr'] = $messages['daysshort'][5];
$messages['Sa'] = $messages['daysshort'][6];
$messages['Su'] = $messages['daysshort'][0];

// months of the year
$messages['months'] = Array( 'Ò»ÔÂ', '¶þÔÂ', 'ÈýÔÂ', 'ËÄÔÂ', 'ÎåÔÂ', 'ÁùÔÂ', 'ÆßÔÂ', '°ËÔÂ', '¾ÅÔÂ', 'Ê®ÔÂ', 'Ê®Ò»ÔÂ', 'Ê®¶þÔÂ');
// -- compatibility, do not touch -- //
$messages['January'] = $messages['months'][0];
$messages['February'] = $messages['months'][1];
$messages['March'] = $messages['months'][2];
$messages['April'] = $messages['months'][3];
$messages['May'] = $messages['months'][4];
$messages['June'] = $messages['months'][5];
$messages['July'] = $messages['months'][6];
$messages['August'] = $messages['months'][7];
$messages['September'] = $messages['months'][8];
$messages['October'] = $messages['months'][9];
$messages['November'] = $messages['months'][10];
$messages['December'] = $messages['months'][11];
$messages['message'] = 'ÏµÍ³ÐÅÏ¢';
$messages['error'] = '´íÎóÐÅÏ¢';
$messages['date'] = 'ÈÕÆÚ';

// miscellaneous texts
$messages['of'] = 'of';
$messages['recently'] = '×îÐÂ·¢±í';
$messages['comments'] = '×îÐÂ»Ø¸´';
$messages['comment on this'] = 'ÆÀÂÛ';
$messages['my_links'] = 'ÎÒµÄÁ´½Ó';
$messages['archives'] = 'ÎÄÕÂ¹éµµ';
$messages['search'] = 'ËÑË÷';
$messages['calendar'] = '²©¿ÍÈÕÀú';
$messages['search_s'] = 'ËÑË÷';
$messages['search_this_blog'] = 'Õ¾ÄÚËÑË÷';
$messages['about_myself'] = '×ÔÎÒ½éÉÜ';
$messages['permalink_title'] = '¹éµµÎÄÕÂµÄ×ÔÎÒ¾²Ì¬Á´½ÓµØÖ·';
$messages['permalink'] = '¾²Ì¬Á´½ÓÍøÖ·';
$messages['posted_by'] = '×÷Õß';
$messages['reply'] = '»Ø¸´';

// add comment form
$messages['add_comment'] = '·¢±íÆÀÂÛ';
$messages['comment_topic'] = '±êÌâ';
$messages['comment_text'] = 'ÔÚ´ËÌí¼ÓÆÀÂÛ';
$messages['comment_username'] = '³Æºô';
$messages['comment_email'] = 'ÓÊÏäµØÖ·£¨¿ÉÑ¡£©';
$messages['comment_url'] = '¸öÈËÖ÷Ò³£¨¿ÉÑ¡£©';
$messages['comment_send'] = '·¢±í';
$messages['comment_added'] = 'ÄúµÄÆÀÂÛÒÑ¾­·¢±í';
$messages['comment_add_error'] = '·¢±íÆÀÂÛÊ±³ö´í';
$messages['article_does_not_exist'] = '¸ÃÎÄÕÂ²»´æÔÚ';
$messages['no_posts_found'] = 'ÕÒ²»µ½ÎÄÕÂ';
$messages['user_has_no_posts_yet'] = '¸Ã×÷ÕßÉÐÎ´·¢±íÈÎºÎÎÄÕÂ';
$messages['back'] = '·µ»ØÉÏÒ»Ò³';
$messages['post'] = '·¢±í';
$messages['trackbacks_for_article'] = 'ÒýÓÃ±¾ÎÄµÄÎÄÕÂ£º';
$messages['trackback_excerpt'] = 'ÕªÒª';
$messages['trackback_weblog'] = '²©¿Í';
$messages['search_results'] = 'ËÑË÷½á¹û';
$messages['search_matching_results'] = 'ÒÔÏÂÎÄÕÂ·ûºÏËÑË÷ÐèÇó: ';
$messages['search_no_matching_posts'] = 'Ã»ÓÐÎÄÕÂ·ûºÏËÑË÷ÒªÇó';
$messages['read_more'] = '²é¿´È«ÎÄ';
$messages['syndicate'] = 'ÐÂÎÅ¾ÛºÏ';
$messages['main'] = 'Ê×Ò³';
$messages['about'] = '¹ØÓÚ';
$messages['download'] = 'ÏÂÔØ';

////// error messages /////
$messages['error_fetching_article'] = 'ÕÒ²»µ½ÄúËùÖ¸¶¨µÄÎÄÕÂ';
$messages['error_fetching_articles'] = 'ÕÒ²»µ½ÄúËùÖ¸¶¨µÄÎÄÕÂ';
$messages['error_trackback_no_trackback'] = 'ÉÐÎ´ÓÐÈËÏò±¾ÎÄ·¢ËÍÒýÓÃÍ¨¸æ';
$messages['error_incorrect_article_id'] = 'ÎÄÕÂ±êÊ¶ºÅ´íÎó';
$messages['error_incorrect_blog_id'] = '²©¿Í±êÊ¶ºÅ´íÎó';
$messages['error_comment_without_text'] = 'ÇëÄúÌîÐ´ÆÀÂÛÕýÎÄ';
$messages['error_comment_without_name'] = 'ÇëÄúÌîÐ´³Æºô';
$messages['error_adding_comment'] = 'Ìí¼ÓÆÀÂÛÊ±³ö´í';
$messages['error_incorrect_parameter'] = '²ÎÊý²»ÕýÈ·';
$messages['error_parameter_missing'] = '²ÎÊý²»È«';
$messages['error_comments_not_enabled'] = '¸Ã²©¿Í¹Ø±ÕÁËÆÀÂÛ¹¦ÄÜ';
$messages['error_incorrect_search_terms'] = '¸ÃËÑË÷Ìõ¼þÎÞÐ§';
$messages['error_no_search_results'] = 'ËÑË÷Ìõ¼þ²»Æ¥Åä';
$messages['error_no_albums_defined'] = '¸Ã²©¿ÍÖÐÎÞ¿ÉÓÃÎÄ¼þ¼Ð';

/////////////////                                          //////////////////
///////////////// STRINGS FOR THE ADMINISTRATION INTERFACE //////////////////
/////////////////                                          //////////////////

// login page
$messages['login'] = 'µÇÂ½';
$messages['welcome_message'] = '»¶Ó­½øÈëPlog';
$messages['error_incorrect_username_or_password'] = '¶Ô²»Æð£¬ÄúµÄÓÃ»§Ãû»òÕßÃÜÂë²»ÕýÈ·¡£';
$messages['error_dont_belong_to_any_blog'] = '¶Ô²»Æð£¬ÄúÉÐÎ´¼ÓÈëÈÎºÎ²©¿Í¡£';
$messages['logout_message'] = 'ÄúÒÑ¾­³É¹¦ÍË³ö¡£';
$messages['logout_message_2'] = 'µã»÷ <a href="%1$s">ÕâÀï</a> ½øÈë %2$s</a>.';
$messages['error_access_forbidden'] = '·ÃÎÊÊÜÏÞ¡£ÄúÐèÒªÊ×ÏÈµÃµ½ÈÏÖ¤»òÍ¨¹ý¡£';
$messages['username'] = 'ÓÃ»§Ãû';
$messages['password'] = 'ÃÜÂë';

// dashboard
$messages['dashboard'] = '¿ØÖÆÃæ°å';
$messages['recent_articles'] = '×îÐÂÎÄÕÂ';
$messages['recent_comments'] = '×îÐÂÆÀÂÛ';
$messages['recent_trackbacks'] = '×îÐÂÒýÓÃ';
$messages['blog_statistics'] = '²©¿ÍÍ³¼Æ';
$messages['total_posts'] = '×ÜÎÄÕÂÊý';
$messages['total_comments'] = '×ÜÆÀÂÛÊý';
$messages['total_trackbacks'] = '×ÜÒýÓÃÊý';
$messages['total_viewed'] = '×Üä¯ÀÀÊý';
$messages['in'] = 'Ä¿±êÎÄÕÂ';

// menu options
$messages['newPost'] = '·¢±íÎÄÕÂ';
$messages['Manage'] = '¹ÜÀíÃæ°å';
$messages['managePosts'] = 'ÎÄÕÂ¹ÜÀí';
$messages['editPosts'] = 'ÎÄÕÂÁÐ±í';
$messages['editArticleCategories'] = '±à¼­ÎÄÕÂ·ÖÀà';
$messages['newArticleCategory'] = 'ÐÂ½¨ÎÄÕÂ·ÖÀà';
$messages['manageLinks'] = 'Á´½Ó¹ÜÀí';
$messages['editLinks'] = 'Á´½ÓÁÐ±í';
$messages['newLink'] = 'ÐÂ½¨Á´½Ó';
$messages['editLink'] = '±à¼­Á´½Ó';
$messages['editLinkCategories'] = 'Á´½Ó·ÖÀà';
$messages['newLinkCategory'] = 'ÐÂ½¨Á´½Ó·ÖÀà';
$messages['editLinkCategory'] = '±à¼­Á´½Ó·ÖÀà';
$messages['manageCustomFields'] = '¹ÜÀí×Ô¶¨ÒåÇø¿é';
$messages['blogCustomFields'] = '×Ô¶¨ÒåÇø¿é';
$messages['newCustomField'] = 'ÐÂ½¨×Ô¶¨ÒåÇø¿é';
$messages['resourceCenter'] = '×ÊÔ´ÖÐÐÄ';
$messages['resources'] = '×ÊÔ´ÁÐ±í';
$messages['newResourceAlbum'] = 'ÐÂ½¨×ÊÔ´ÎÄ¼þ¼Ð';
$messages['newResource'] = 'ÐÂ½¨×ÊÔ´';
$messages['controlCenter'] = '¿ØÖÆÖÐÐÄ';
$messages['manageSettings'] = 'ÉèÖÃ';
$messages['blogSettings'] = '²©¿ÍÉèÖÃ';
$messages['userSettings'] = 'ÓÃ»§ÉèÖÃ';
$messages['pluginCenter'] = '²å¼þÖÐÐÄ';
$messages['Stats'] = 'Í³¼Æ×ÊÁÏ';
$messages['manageBlogUsers'] = 'ÓÃ»§¹ÜÀí';
$messages['newBlogUser'] = 'Ìí¼ÓÐÂÓÃ»§';
$messages['showBlogUsers'] = 'ÓÃ»§ÁÐ±í';
$messages['manageBlogTemplates'] = 'Ä£°å¹ÜÀí';
$messages['newBlogTemplate'] = 'ÐÂ½¨Ä£°å';
$messages['blogTemplates'] = 'Ä£°åÁÐ±í';
$messages['adminSettings'] = '¹ÜÀíÉèÖÃ';
$messages['Users'] = 'ÓÃ»§¹ÜÀí';
$messages['createUser'] = '´´½¨ÓÃ»§';
$messages['editSiteUsers'] = 'ÓÃ»§ÁÐ±í';
$messages['Blogs'] = '²©¿Í¹ÜÀí';
$messages['createBlog'] = '´´½¨²©¿Í';
$messages['editSiteBlogs'] = '²©¿ÍÁÐ±í';
$messages['Locales'] = 'ÓïÑÔ°ü¹ÜÀí';
$messages['newLocale'] = 'Ìí¼ÓÓïÑÔ°ü';
$messages['siteLocales'] = 'ÓïÑÔ°üÁÐ±í';
$messages['Templates'] = 'Ä£°å¹ÜÀí';
$messages['newTemplate'] = '´´½¨Ä£°å';
$messages['siteTemplates'] = 'Ä£°åÁÐ±í';
$messages['GlobalSettings'] = 'È«¾ÖÉèÖÃ';
$messages['editSiteSettings'] = '³£¹æÉèÖÃ';
$messages['summarySettings'] = '»ã×ÜÉèÖÃ';
$messages['templateSettings'] = 'Ä£°åÉèÖÃ';
$messages['urlSettings'] = 'URLÉèÖÃ';
$messages['emailSettings'] = 'ÓÊ¼þÉèÖÃ';
$messages['uploadSettings'] = 'ÉÏ´«ÉèÖÃ';
$messages['helpersSettings'] = '°ïÖúÉèÖÃ';
$messages['interfacesSettings'] = '½Ó¿ÚÉèÖÃ';
$messages['securitySettings'] = '°²È«ÉèÖÃ';
$messages['bayesianSettings'] = '¹ýÂËÉèÖÃ';
$messages['resourcesSettings'] = '×ÊÔ´ÖÐÐÄÉèÖÃ';
$messages['searchSettings'] = 'ËÑË÷ÉèÖÃ';
$messages['cleanUpSection'] = 'ÇåÀíÀ¬»ø';
$messages['cleanUp'] = 'ÇåÀíÀ¬»ø';
$messages['editResourceAlbum'] = '±à¼­×ÊÔ´¼Ð';
$messages['resourceInfo'] = '±à¼­×ÊÔ´';
$messages['editBlog'] = '±à¼­²©¿Í';
$messages['Logout'] = '×¢Ïú';

// new post
$messages['topic'] = '±êÌâ';
$messages['topic_help'] = 'ÔÚÕâÀïÊäÈëÎÄÕÂ±êÌâ';
$messages['text'] = 'ÎÄÕÂÄÚÈÝ';
$messages['text_help'] = 'ÕªÒªÄÚÈÝ£º£¨¸Ã²¿·ÖÄÚÈÝ½«ÔÚÄúµÄÊ×Ò³ÏÔÊ¾£©';
$messages['extended_text'] = 'À©Õ¹ÄÚÈÝ';
$messages['extended_text_help'] = 'À©Õ¹ÄÚÈÝ£º£¨¸Ã²¿·Ö¿ÉÒÔÍ¨¹ýºóÌ¨ÉèÖÃ¾ö¶¨ÊÇ·ñÏÔÊ¾ÔÚÊ×Ò³ÖÐ»ò½ö½ö³öÏÖÔÚÎÄÕÂÄÚÈÝÖÐ£¬ÔÚ²©¿ÍÉèÖÃÖÐ»áÕÒµ½¸ü¶àÐÅÏ¢¡£';
$messages['post_slug'] = 'ÎÄÕÂ´ú³É';
$messages['post_slug_help'] = 'ÎÄÕÂ´ú³É¿ÉÒÔÎªÎÄÕÂ±êÌâÉú³É¾²Ì¬µØÖ·¡£';
$messages['date'] = 'ÈÕÆÚ';
$messages['post_date_help'] = '·¢±íÎÄÕÂµÄÈÕÆÚ';
$messages['status'] = 'ÎÄÕÂ×´Ì¬';
$messages['post_status_help'] = 'Ñ¡ÔñÎÄÕÂ×´Ì¬';
$messages['post_status_published'] = '¹«¿ª';
$messages['post_status_draft'] = '²Ý¸å';
$messages['post_status_deleted'] = 'ÒÑÉ¾³ý';
$messages['categories'] = 'ÎÄÕÂ·ÖÀà';
$messages['post_categories_help'] = 'Ñ¡ÔñÒ»¸ö»ò¶à¸ö·ÖÀà';
$messages['post_comments_enabled_help'] = 'ÔÊÐí»Ø¸´';
$messages['send_notification_help'] = '·¢ËÍÐÂ»Ø¸´Í¨Öª';
$messages['send_trackback_pings_help'] = '·¢ËÍÒýÓÃÍ¨¸æ';
$messages['send_xmlrpc_pings_help'] = '·¢ËÍXMLRPC pings';
$messages['save_draft_and_continue'] = '±£´æ²Ý¸å';
$messages['preview'] = 'ÎÄÕÂÔ¤ÀÀ';
$messages['add_post'] = '·¢±í¸ÃÎÄÕÂ';
$messages['error_saving_draft'] = '±£´æ²Ý¸å¹ý³ÌÖÐ³ö´í';
$messages['draft_saved_ok'] = '±£´æ²Ý¸å³É¹¦';
$messages['error_sending_request'] = '·¢ËÍÇëÇóÊ±³ö´í';
$messages['error_no_category_selected'] = 'ÇëÄúÖÁÉÙÑ¡ÔñÒ»¸öÎÄÕÂ·ÖÀà';
$messages['error_missing_post_topic'] = 'ÇëÄúÊäÈëÎÄÕÂ±êÌâ';
$messages['error_missing_post_text'] = 'ÇëÄúÊäÈëÎÄÕÂÄÚÈÝ';
$messages['error_adding_post'] = 'Ìí¼ÓÎÄÕÂÊ±·¢Éú´íÎó';
$messages['post_added_not_published'] = 'Ìí¼ÓÎÄÕÂ³É¹¦µ«Î´·¢²¼';
$messages['post_added_ok'] = 'Ìí¼ÓÎÄÕÂ³É¹¦';
$messages['send_notifications_ok'] = 'ÓÐÐÂÆÀÂÛ»òÒýÓÃÊ±½«ÏòÄú·¢ËÍÍ¨¸æ¡£';

// send trackbacks
$messages['error_sending_trackbacks'] = '·¢ËÍÒÔÏÂÒýÓÃÍ¨ÖªÊ±·¢Éú´íÎó';
$messages['send_trackbacks_help'] = 'ÇëÑ¡ÔñÄúËùÒª·¢ËÍÒýÓÃÍ¨¸æµÄÍøÖ·¡£(ÇëÈ·¶¨¸ÃÍøÕ¾Õ¾Ö§³ÖÒýÓÃÍ¨¸æ¹¦ÄÜ)';
$messages['send_trackbacks'] = '·¢ËÍÒýÓÃÍ¨Öª';
$messages['ping_selected'] = 'ÏòÑ¡¶¨µÄÍøÖ··¢ËÍÒýÓÃÍ¨Öª';
$messages['trackbacks_sent_ok'] = 'ÒýÓÃÍ¨ÖªÒÑ³É¹¦·¢ËÍµ½Ñ¡¶¨µÄÍøÖ·';

// posts page
$messages['show_by'] = 'ÏÔÊ¾';
$messages['category'] = 'ÎÄÕÂ·ÖÀà';
$messages['author'] = '×÷Õß';
$messages['post_status_all'] = 'È«²¿×´Ì¬';
$messages['author_all'] = 'È«²¿×÷Õß';
$messages['search_terms'] = 'ËÑË÷Ìõ¼þ';
$messages['show'] = 'ÏÔÊ¾';
$messages['delete'] = 'É¾³ý';
$messages['actions'] = '¼¤»î';
$messages['all'] = 'È«²¿';
$messages['category_all'] = 'È«²¿·ÖÀà';
$messages['error_incorrect_article_id'] = '²»ÕýÈ·µÄÎÄÕÂ±êÊ¶';
$messages['error_deleting_article'] = 'É¾³ýÎÄÕÂ "%s" Ê±·¢Éú´íÎó';
$messages['article_deleted_ok'] = 'ÎÄÕÂ "%s" É¾³ý³É¹¦';
$messages['articles_deleted_ok'] = 'ÎÄÕÂ %s É¾³ý³É¹¦';
$messages['error_deleting_article2'] = 'É¾³ýÎÄÕÂ "%s" Ê±·¢Éú´íÎó';

// edit post page
$messages['update'] = 'ÐÞ¸Ä';
$messages['editPost'] = '±à¼­ÎÄÕÂ';
$messages['error_fetching_post'] = '¶ÁÈ¡ÎÄÕÂÊ±³ö´í';
$messages['post_updated_ok'] = 'ÎÄÕÂ "%s" ¸üÐÂ³É¹¦';
$messages['error_updating_post'] = '¸üÐÂÎÄÕÂÊ±³ö´í';
$messages['notification_added'] = 'ÓÐÐÂÆÀÂÛ»òÒýÓÃÊ±Äú½«ÊÕµ½Í¨¸æ¡£';
$messages['notification_removed'] = 'ÓÐÐÂÆÀÂÛ»òÒýÓÃÊ±²»·¢ËÍÍ¨¸æ¡£';

// post comments
$messages['url'] = 'URL';
$messages['comment_status_all'] = 'È«²¿';
$messages['comment_status_spam'] = 'À¬»øÆÀÂÛ';
$messages['comment_status_nonspam'] = 'ÎÞÀ¬»øÆÀÂÛ';
$messages['error_fetching_comments'] = '¶ÁÈ¡ÎÄÕÂÆÀÂÛÊ±³ö´í';
$messages['error_deleting_comments'] = 'É¾³ýÎÄÕÂÆÀÂÛÊ±³ö´í»òÎÞÎ´Ñ¡ÔñÈÎºÎÆÀÂÛ';
$messages['comment_deleted_ok'] = 'ÆÀÂÛ "%s" É¾³ý³É¹¦';
$messages['comments_deleted_ok'] = 'ÆÀÂÛ %s É¾³ý³É¹¦';
$messages['error_deleting_comment'] = 'É¾³ýÆÀÂÛ "%s" Ê±³ö´í';
$messages['error_deleting_comment2'] = 'É¾³ýÆÀÂÛ %s Ê±³ö´í';
$messages['editComments'] = '±à¼­ÆÀÂÛ';
$messages['mark_as_spam'] = '±ê¼ÇÎªÀ¬»øÆÀÂÛ';
$messages['mark_as_no_spam'] = '±ê¼ÇÎª·ÇÀ¬»øÆÀÂÛ';
$messages['error_incorrect_comment_id'] = 'ÆÀÂÛ±êÊ¶´íÎó';
$messages['error_marking_comment_as_spam'] = '±ê¼ÇÀ¬»øÆÀÂÛÊ±³ö´í';
$messages['comment_marked_as_spam_ok'] = '¸ÃÆÀÂÛÒÑ³É¹¦±ê¼ÇÎªÀ¬»øÆÀÂÛ';
$messages['error_marking_comment_as_nonspam'] = 'È¥³ýÀ¬»øÆÀÂÛ±ê¼ÇÊ±³ö´í';
$messages['comment_marked_as_nonspam_ok'] = '³É¹¦È¥³ýÀ¬»øÆÀÂÛ±ê¼Ç';

// post trackbacks
$messages['blog'] = '²©¿ÍÕ¾µã';
$messages['excerpt'] = 'ÒýÓÃÄÚÈÝ';
$messages['error_fetching_trackbacks'] = '¶ÁÈ¡ÒýÓÃÊ±³ö´í';
$messages['error_deleting_trackbacks'] = 'É¾³ýÒýÓÃÊ±³ö´í»òÎ´Ñ¡ÔñÈÎºÎÒýÓÃ';
$messages['error_deleting_trackback'] = 'É¾³ýÒýÓÃ "%s" Ê±³ö´í';
$messages['error_deleting_trackback2'] = 'É¾³ýÒýÓÃ "%s" Ê±³ö´í';
$messages['trackback_deleted_ok'] = 'ÒýÓÃ "%s" É¾³ý³É¹¦';
$messages['trackbacks_deleted_ok'] = 'ÒýÓÃ %s É¾³ý³É¹¦';
$messages['editTrackbacks'] = 'ÒýÓÃ';

// post statistics
$messages['referrer'] = 'ÄæÏòÁ´½Ó';
$messages['hits'] = 'µã»÷Êý';
$messages['error_no_items_selected'] = 'Î´Ñ¡ÔñÉ¾³ýÈÎºÎÑ¡Ïî';
$messages['error_deleting_referrer'] = 'É¾³ýÄæÏòÁ´½Ó "%s" Ê±³ö´í';
$messages['error_deleting_referrer2'] = 'É¾³ýÄæÏòÁ´½Ó "%s" Ê±³ö´í';
$messages['referrer_deleted_ok'] = 'ÄæÏòÁ´½Ó "%s" É¾³ý³É¹¦';
$messages['referrers_deleted_ok'] = 'ÄæÏòÁ´½Ó "%s" É¾³ý³É¹¦';

// categories
$messages['posts'] = 'ÎÄÕÂÊý';
$messages['show_in_main_page'] = 'ÊÇ·ñÔÚÊ×Ò³ÏÔÊ¾';
$messages['error_incorrect_category_id'] = '·ÖÀà±êÊ¶´íÎó»òÎ´Ñ¡ÔñÏîÄ¿';
$messages['error_category_has_articles'] = '·ÖÀà "%s" ÒÑ±»ÎÄÕÂÊ¹ÓÃ£¬ÇëÏÈ±à¼­ÕâÐ©ÎÄÕÂÔÙÉ¾³ý¸Ã·ÖÀà¡£';
$messages['category_deleted_ok'] = '·ÖÀà "%s" ³É¹¦É¾³ý';
$messages['categories_deleted_ok'] = '·ÖÀà "%s" ³É¹¦É¾³ý';
$messages['error_deleting_category'] = 'É¾³ý·ÖÀà"%s"Ê±³ö´í';
$messages['error_deleting_category2'] = 'É¾³ý·ÖÀà"%s"Ê±³ö´í';
$messages['yes'] = 'ÊÇ';
$messages['no'] = '·ñ';

// new category
$messages['name'] = '·ÖÀàÃû³Æ';
$messages['category_name_help'] = '·ÖÀàÃû³Æ½«ÏÔÊ¾ÔÚÊ×Ò³';
$messages['description'] = 'ÃèÊö';
$messages['category_description_help'] = '¸Ã·ÖÀàµÄÏêÏ¸ÃèÊö';
$messages['show_in_main_page_help'] = '¸Ã·ÖÀàÊÇ·ñÔÚÊ×Ò³ÏÔÊ¾';
$messages['error_empty_name'] = 'Äã±ØÐëÊäÈë·ÖÀàÃû³Æ';
$messages['error_empty_description'] = 'Äã±ØÐëÊäÈë·ÖÀàÃèÊö';
$messages['error_adding_article_category'] = 'Ìí¼ÓÐÂ·ÖÀàÊ±³ö´í£¬Çë¼ì²éÊäÈëÖØÊÔ';
$messages['category_added_ok'] = '·ÖÀà "%s" ³É¹¦Ìí¼Óµ½ÏµÍ³ÖÐ';
$messages['add'] = 'Ìí¼Ó';
$messages['reset'] = 'ÖØÖÃ';

// update category
$messages['error_updating_article_category'] = 'ÐÞ¸Ä·ÖÀàÊ±³ö´í';
$messages['error_fetching_category'] = '¶ÁÈ¡·ÖÀàÊ±³ö´í';
$messages['article_category_updated_ok'] = '·ÖÀà"%s"ÐÞ¸Ä³É¹¦';

// links
$messages['feed'] = 'Feed';
$messages['error_no_links_selected'] = 'Á´½Ó±êÊ¶´íÎó»òÎ´Ñ¡ÔñÏîÄ¿';
$messages['error_incorrect_link_id'] = 'Á´½Ó±êÊ¶´íÎó';
$messages['error_removing_link'] = 'É¾³ýÁ´½Ó"%s"Ê±³ö´í';
$messages['error_removing_link2'] = 'É¾³ýÁ´½Ó"%s"Ê±³ö´í';
$messages['link_deleted_ok'] = 'Á´½Ó "%s" É¾³ý³É¹¦';
$messages['links_deleted_ok'] = 'Á´½Ó %s É¾³ý³É¹¦';

// new link
$messages['link_name_help'] = 'Á´½ÓÃû³Æ';
$messages['link_url_help'] = 'Á´½ÓµØÖ·';
$messages['link_description_help'] = 'Á´½ÓÃèÊö';
$messages['link_feed_help'] = 'Á´½ÓFeedµØÖ·';
$messages['link_category_help'] = 'Ñ¡ÔñÒ»¸öÓÐÐ§µÄÁ´½Ó·ÖÀà';
$messages['error_adding_link'] = 'Ìí¼ÓÁ´½ÓÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['error_invalid_url'] = 'µØÖ·´í';
$messages['link_added_ok'] = 'Á´½Ó "%s" Ìí¼Ó³É¹¦';

// update link
$messages['error_updating_link'] = 'ÐÞ¸ÄÁ´½ÓÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['error_fetching_link'] = '¶ÁÈ¡Á´½ÓÊ±³ö´í';
$messages['link_updated_ok'] = 'Á´½Ó "%s" ÐÞ¸Ä³É¹¦';

// link categories
$messages['links'] = 'ÍøÕ¾Á´½Ó';
$messages['error_invalid_link_category_id'] = '¸ÃÁ´½Ó·ÖÀà±êÊ¶³ö´í»òÎ´Ñ¡ÔñÏîÄ¿';
$messages['error_links_in_link_category'] = 'ÓÐÁ´½ÓÊ¹ÓÃÁ´½Ó·ÖÀà "%s" £¬ÇëÊ×ÏÈÐÞ¸ÄÁ´½ÓÔÙÖØÊÔ';
$messages['error_removing_link_category'] = 'É¾³ýÁ´½Ó·ÖÀà "%s"Ê±³ö´í';
$messages['link_category_deleted_ok'] = 'Á´½Ó "%s" É¾³ý³É¹¦';
$messages['link_categories_deleted_ok'] = 'Á´½Ó "%s" É¾³ý³É¹¦';
$messages['error_removing_link_category2'] = 'É¾³ýÁ´½Ó·ÖÀà "%s"Ê±³ö´í';

// new link category
$messages['link_category_name_help'] = 'ÐÂÁ´½Ó·ÖÀàÃû³Æ';
$messages['error_adding_link_category'] = 'Ìí¼ÓÐÂÁ´½ÓÊ±³ö´í';
$messages['link_category_added_ok'] = 'Á´½Ó·ÖÀà "%s" Ìí¼Ó³É¹¦';

// edit link category
$messages['error_updating_link_category'] = 'ÐÞ¸ÄÁ´½Ó·ÖÀàÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['link_category_updated_ok'] = 'Á´½Ó·ÖÀà "%s" ÐÞ¸Ä³É¹¦';
$messages['error_fetching_link_category'] = '¶ÁÈ¡Á´½Ó·ÖÀàÊ±³ö´í';

// custom fields
$messages['type'] = 'ÀàÐÍ';
$messages['hidden'] = 'ÊÇ·ñÒþ²Ø';
$messages['fields_deleted_ok'] = '×Ô¶¨ÒåÇø¿é %s É¾³ý³É¹¦';
$messages['field_deleted_ok'] = '×Ô¶¨ÒåÇø¿é "%s" É¾³ý³É¹¦';
$messages['error_deleting_field'] = 'É¾³ý×Ô¶¨ÒåÇø¿é "%s" Ê±³ö´í';
$messages['error_deleting_field2'] = 'É¾³ý×Ô¶¨ÒåÇø¿é "%s" Ê±³ö´í';
$messages['error_incorrect_field_id'] = '×Ô¶¨ÒåÇø¿é±êÊ¶ÎÞÐ§';

// new custom field
$messages['field_name_help'] = 'ÔÚÎÄÕÂÖÐ½«×÷Îª¸ÃÇø¿éµÄ±êÊ¶';
$messages['field_description_help'] = '¸ÃÇø¿éµÄ¸ÅÒªÃèÊö½«ÔÚÌí¼Ó»òÐÞ¸ÄÎÄÕÂÊ±ÏÔÊ¾';
$messages['field_type_help'] = 'Ñ¡ÔñÓÐÐ§Çø¿éµÄÀàÐÍ';
$messages['field_hidden_help'] = 'Èç¹ûÒ»¸öÇø¿éÒþ²Ø£¬ÄÇÃ´ËüÔÚÌí¼Ó»ò±à¼­ÎÄÕÂÊ±²»»áÏÔÊ¾³öÀ´¡£Õâ¸ö¹¦ÄÜÖ÷ÒªÓ¦ÓÃÔÚ²å¼þÖÐ¡£';
$messages['error_adding_custom_field'] = 'Ìí¼Ó×Ô¶¨ÒåÇø¿éÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['custom_field_added_ok'] = '×Ô¶¨ÒåÇø¿é "%s" Ìí¼Ó³É¹¦';
$messages['text_field'] = 'ÎÄ±¾ÇøÓò';
$messages['text_area'] = 'ÎÄ±¾¿ò';
$messages['checkbox'] = '¶àÑ¡¿ò';
$messages['date_field'] = 'ÈÕÆÚÑ¡Ôñ';

// edit custom field
$messages['error_fetching_custom_field'] = '¶ÁÈ¡×Ô¶¨ÒåÇø¿éÊ±³ö´í';
$messages['error_updating_custom_field'] = 'ÐÞ¸Ä×Ô¶¨ÒåÇø¿éÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['custom_field_updated_ok'] = '×Ô¶¨ÒåÇø¿é "%s" ÐÞ¸Ä³É¹¦';

// resources
$messages['root_album'] = '¸ùÎÄ¼þ¼Ð';
$messages['num_resources'] = '×ÊÔ´ÊýÁ¿';
$messages['total_size'] = '×ÜÊ¹ÓÃ¿Õ¼ä';
$messages['album'] = 'ÎÄ¼þ¼Ð';
$messages['error_incorrect_album_id'] = '×ÊÔ´±êÊ¶³ö´í';
$messages['error_base_storage_folder_missing_or_unreadable'] = 'plogÖÐ²»ÄÜ´´½¨±ØÒªµÄ´æ·Å×ÊÔ´µÄÎÄ¼þ¼Ð¡£Õâ¿ÉÄÜÓÉ¶àÖÖÔ­ÒòÔì³É£¬±ÈÈçÄãµÄphpÊ¹ÓÃ°²È«Ä£Ê½°²×°ÔËÐÐ»òÕßÄãµÄÓÃ»§Ã»ÓÐ×ã¹»È¨ÏÞ¡£ÄãÈÔÈ»¿ÉÒÔÊÖ¶¯½øÐÐ²Ù×÷£¬´´½¨ÎÄ¼þ¼Ð: <br/><br/>%s<br/><br/>Èç¹ûÕâÐ©ÎÄ¼þ¼ÐÒÑ¾­´æÔÚ£¬ÇëÈ·¶¨ËýÃÇ¿ÉÍ¨¹ýÓÃ»§ÔËÐÐweb·þÎñÆ÷½øÐÐ¶ÁÐ´¡£';
$messages['items_deleted_ok'] = 'ÏîÄ¿%sÉ¾³ý³É¹¦';
$messages['error_album_has_children'] = 'ÎÄ¼þ¼Ð "%s" ÓÐ×ÓÎÄ¼þ¼Ð. ÇëÏÈ±à¼­¸ÃÎÄ¼þ¼ÐÔÙÖØÊÔ¡£';
$messages['item_deleted_ok'] = 'ÏîÄ¿%sÉ¾³ý³É¹¦';
$messages['error_deleting_album'] = 'É¾³ýÎÄ¼þ¼Ð "%s" Ê±³ö´í';
$messages['error_deleting_album2'] = 'É¾³ýÎÄ¼þ¼Ð "%s" Ê±³ö´í';
$messages['error_deleting_resource'] = 'É¾³ýÎÄ¼þ"%s"Ê±³ö´í';
$messages['error_deleting_resource2'] = 'É¾³ýÎÄ¼þ"%s"Ê±³ö´í';
$messages['error_no_resources_selected'] = 'Ã»ÓÐÑ¡ÔñÉ¾³ýµÄÏîÄ¿';
$messages['resource_deleted_ok'] = '×ÊÔ´"%s"±»³É¹¦É¾³ý';
$messages['album_deleted_ok'] = 'ÎÄ¼þ¼Ð"%s"±»³É¹¦É¾³ý';
$messages['add_resource'] = 'Ìí¼Ó×ÊÔ´';
$messages['add_resource_preview'] = 'Ìí¼ÓÔ¤ÀÀ';
$messages['add_resource_medium'] = 'Ìí¼ÓÖÐÐÍÔ¤ÀÀ';
$messages['add_album'] = 'Ìí¼ÓÎÄ¼þ¼Ð';

// new album
$messages['album_name_help'] = '¸ÃÎÄ¼þ¼ÐµÄÃû³Æ';
$messages['parent'] = 'ÉÏ¼¶ÎÄ¼þ¼Ð';
$messages['no_parent'] = 'ÎÞÉÏ¼¶ÎÄ¼þ¼Ð';
$messages['parent_album_help'] = 'Ê¹ÓÃÕâ¸öÑ¡ÏîÊ¹µÃÎÄ¼þ¼ÐÏÂ°üº¬ÎÄ¼þ¼ÐÒÔ±ã¸üºÃµÄ¹ÜÀíÎÄ¼þ';
$messages['album_description_help'] = 'ÎÄ¼þ¼ÐÄÚÈÝµÄÏêÏ¸ÃèÊö';
$messages['error_adding_album'] = 'Ìí¼ÓÐÂÎÄ¼þ¼Ð³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['album_added_ok'] = 'ÎÄ¼þ¼Ð "%s" ³É¹¦Ìí¼Ó';

// edit album
$messages['error_incorrect_album_id'] = 'ÎÄ¼þ¼Ð±íÊ¾´íÎó';
$messages['error_fetching_album'] = '¶ÁÈ¡ÎÄ¼þ¼ÐÊ±³ö´í';
$messages['error_updating_album'] = 'ÐÞ¸ÄÎÄ¼þ¼ÐÊ±³ö´í£¬Çë¼ì²éÊý¾ÝÖØÊÔ';
$messages['album_updated_ok'] = 'ÎÄ¼þ¼Ð "%s" ÐÞ¸Ä³É¹¦';
$messages['show_album_help'] = 'Èç¹û½ûÓÃ£¬ÎÄ¼þ¼Ð½«²»ÏÔÊ¾ÔÚ²©¿ÍµÄ¿ÉÓÃÎÄ¼þ¼ÐÁÐ±íÖÐ';

// new resource
$messages['file'] = 'ÎÄ¼þ';
$messages['resource_file_help'] = 'Ìí¼ÓÎÄ¼þµ½µ±Ç°²©¿ÍÖÐ¡£Ê¹ÓÃ¡°Ìí¼Ó¶à¸öÎÄ¼þ¡±Á´½ÓÍ¬Ê±ÉÏ´«¶à¸öÎÄ¼þ';
$messages['add_field'] = 'Ìí¼Ó¶à¸öÎÄ¼þ';
$messages['resource_description_help'] = '¸ÃÎÄ¼þµÄÏêÏ¸ÃèÊö';
$messages['resource_album_help'] = 'Ñ¡Ôñ¸ÃÎÄ¼þÒªÌí¼Óµ½ÄÄ¸öÎÄ¼þ¼Ð';
$messages['error_no_resource_uploaded'] = 'Î´Ñ¡ÔñÈÎºÎ´ýÉÏ´«ÎÄ¼þ';
$messages['resource_added_ok'] = 'ÎÄ¼þ "%s" Ìí¼Ó³É¹¦';
$messages['error_resource_forbidden_extension'] = '¸ÃÎÄ¼þÀàÐÍ±»½ûÓÃ£¬²»¿ÉÌí¼Ó';
$messages['error_resource_too_big'] = 'ÎÄ¼þÌ«´ó£¬²»¿ÉÌí¼Ó';
$messages['error_uploads_disabled'] = '½ûÖ¹ÉÏ´«ÎÄ¼þ';
$messages['error_quota_exceeded'] = 'ÎÄ¼þÅä¶î³¬ÈÝ£¬²»¿ÉÌí¼ÓÎÄ¼þ';
$messages['error_adding_resource'] = 'Ìí¼Ó×ÊÔ´ÎÄ¼þÊ±³ö´í';

// edit resource
$messages['editResource'] = '±à¼­×ÊÔ´';
$messages['resource_information_help'] = 'ÒÔÏÂÊÇÒ»Ð©¹ØÓÚ×ÊÔ´ÎÄ¼þµÄÐÅÏ¢¡£';
$messages['information'] = 'ÎÄ¼þÐÅÏ¢';
$messages['size'] = 'ÎÄ¼þ´óÐ¡';
$messages['format'] = 'ÎÄ¼þ¸ñÊ½';
$messages['dimensions'] = 'ÂË¾µ';
$messages['bits_per_sample'] = 'ÎÄ¼þÑù±¾Î»Êý';
$messages['sample_rate'] = 'Ñù±¾ÂÊ';
$messages['number_of_channels'] = 'Í¨µÀÊý';
$messages['legnth'] = '³¤¶È';
$messages['thumbnail_format'] = 'ËõÂÔÍ¼¸ñÊ½';
$messages['regenerate_preview'] = 'ÖØÐÂÉú³ÉÔ¤ÀÀ';
$messages['error_fetching_resource'] = '¶ÁÈ¡ÎÄ¼þÊ±³ö´í';
$messages['error_updating_resource'] = 'ÐÞ¸ÄÎÄ¼þÊ±³ö´í';
$messages['resource_updated_ok'] = 'ÎÄ¼þ "%s" ÐÞ¸Ä³É¹¦';

// blog settings
$messages['blog_link'] = '²©¿ÍµØÖ·';
$messages['blog_link_help'] = '¸Ã²©¿ÍÍøÕ¾µÄÓÀ¾ÃµØÖ·';
$messages['blog_name_help'] = '²©¿ÍÃû³Æ';
$messages['blog_description_help'] = '¸Ã²©¿ÍµÄÏêÏ¸ÃèÊö';
$messages['language'] = 'ÓïÑÔ';
$messages['blog_language_help'] = 'Ñ¡Ôñ²©¿ÍÇ°Ì¨ºÍ¹ÜÀíµÄÓïÑÔ';
$messages['max_main_page_items'] = 'Ê×Ò³ÎÄÕÂÊýÁ¿';
$messages['max_main_page_items_help'] = 'ÏÔÊ¾ÔÚ¸Ã²©¿ÍÊ×Ò³µÄ×î´óÎÄÕÂÊýÁ¿';
$messages['max_recent_items'] = '½üÆÚÎÄÕÂÊýÁ¿';
$messages['max_recent_items_help'] = 'ÏÔÊ¾ÔÚÊ×Ò³ÖÐµÄ×îÐÂ·¢±íµÄ×î´óÎÄ¼þÊýÁ¿';
$messages['template'] = 'Ä£°å';
$messages['choose'] = 'Ñ¡Ôñ';
$messages['blog_template_help'] = 'Ñ¡Ôñ¸Ã²©¿ÍÓ¦ÓÃµÄÄ£°å£¬ Õâ¸öÁÐ±í°üÀ¨ÁËËùÓÐµÄÎª¸Ã²©¿Í°²×°µÄÄ£°å';
$messages['use_read_more'] = 'ÔÚÎÄÕÂÖÐÊ¹ÓÃÀ©Õ¹ÄÚÈÝ';
$messages['use_read_more_help'] = 'Èç¹ûÆôÓÃ¸ÃÑ¡Ïî£¬ÔÚÊ×Ò³Ö»ÏÔÊ¾ÎÄÕÂÄÚÈÝ£¬¶ø²»ÏÔÊ¾À©Õ¹ÄÚÈÝ¡£Èç¹ûÐèÒªÏÔÊ¾À©Õ¹ÄÚÈÝµÄ»°£¬Ã¿¸öÎÄÕÂÄ©Î²»á³öÏÖÒ»¸ö¡°²é¿´È«ÎÄ¡±µÄÁ´½Ó';
$messages['enable_wysiwyg'] = 'Ê¹ÓÃËù¼û¼´ËùµÃ±à¼­Æ÷±à¼­ÎÄÕÂ';
$messages['enable_wysiwyg_help'] = 'ÆôÓÃËù¼û¼´ËùµÃ±à¼­Æ÷±à¼­ÎÄÕÂµÄhtml´úÂë.¸Ã±à¼­Æ÷Ö»ÄÜÊ¹ÓÃÔÚIE5.5ÒÔÉÏ»òMozilla 1.3ÒÔÉÏä¯ÀÀÆ÷ÖÐ';
$messages['enable_comments'] = 'Ä¬ÈÏÔÊÐíÆÀÂÛÎÄÕÂ';
$messages['enable_comments_help'] = 'Ä¬ÈÏ¿ª·Å¶ÔËùÓÐÎÄÕÂµÄÆÀÂÛÁôÑÔÈ¨ÏÞ.';
$messages['show_future_posts'] = 'ÏÔÊ¾½«À´µÄÎÄÕÂ';
$messages['show_future_posts_help'] = 'ÒÔ½«À´ÈÕÆÚ·¢±íµÄÎÄÕÂÊÇ·ñ¶ÔÆäËüÓÃ»§¿É¼û';
$messages['comments_order'] = 'ÆÀÂÛÁôÑÔÅÅÐò·½Ê½';
$messages['comments_order_help'] = 'ÔÚÊ×Ò³ÖÐÆÀÂÛµÄÅÅÐò·½Ê½';
$messages['oldest_first'] = '¾ÉµÄÔÚÇ°';
$messages['newest_first'] = 'ÐÂµÄÔÚÇ°';
$messages['categories_order'] = 'ÎÄÕÂ·ÖÀàÅÅÐò·½Ê½';
$messages['categories_order_help'] = 'ÔÚÊ×Ò³ÖÐÎÄÕÂ·ÖÀàµÄÅÅÐò·½Ê½';
$messages['most_recent_updated_first'] = '×î½ü¸üÐÂ×î¶àµÄÔÚÇ°';
$messages['alphabetical_order'] = '°´×ÖÄ¸ÕýÐòÅÅÁÐ';
$messages['reverse_alphabetical_order'] = '°´×ÖÄ¸µ¹ÐòÅÅÁÐ';
$messages['most_articles_first'] = 'ÎÄÕÂ×î¶àµÄÔÚÇ°';
$messages['link_categories_order'] = 'Á´½Ó·ÖÀàÅÅÐò·½Ê½';
$messages['link_categories_order_help'] = 'ÔÚÊ×Ò³ÖÐÁ´½Ó·ÖÀàµÄÅÅÐò·½Ê½';
$messages['most_links_first'] = 'Á´½Ó×î¶àµÄÔÚÇ°';
$messages['most_links_last'] = 'Á´½Ó×î¶àµÄÔÚºó';
$messages['time_offset'] = 'Ê±²î';
$messages['time_offset_help'] = 'ÄúµÄ²©¿Í·þÎñÆ÷ÓëÄúËùÔÚµØµÄÊ±²î ';
$messages['close'] = '¹Ø±Õ';
$messages['select'] = 'Ñ¡Ôñ';
$messages['error_updating_settings'] = '¸üÐÂ²©¿ÍÉèÖÃÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['error_invalid_number'] = 'ÊýÄ¿²»ÕýÈ·';
$messages['error_incorrect_time_offset'] = 'Ê±²îÎÞÐ§';
$messages['blog_settings_updated_ok'] = '²©¿ÍÉèÖÃÐÞ¸Ä³É¹¦';
$messages['hours'] = 'Ð¡Ê±';

// user settings
$messages['username_help'] = 'ÓÃ»§Ãû³Æ£¬²»¿ÉÐÞ¸Ä';
$messages['full_name'] = 'È«Ãû';
$messages['full_name_help'] = 'ÓÃ»§µÄÈ«Ãû';
$messages['password_help'] = 'ÐÞ¸ÄÃÜÂë£¬Áô¿ÕÔòÃÜÂë±£³Ö²»±ä¡£';
$messages['confirm_password'] = 'È·ÈÏÃÜÂë';
$messages['email'] = 'µç×ÓÓÊ¼þ';
$messages['email_help'] = '½ÓÊÕÍ¨ÖªµÄµç×ÓÓÊ¼þµØÖ·';
$messages['bio'] = '×ÔÎÒ½éÉÜ';
$messages['bio_help'] = '×ÔÎÒµÄÏêÏ¸½éÉÜ';
$messages['picture'] = 'ÐÎÏóÍ¼Æ¬';
$messages['user_picture_help'] = '´ÓÉÏ´«µÄÍ¼Æ¬ÖÐÑ¡ÔñÒ»¸ö×÷ÎªÄãµÄ¸öÈËÍ¼Æ¬';
$messages['error_invalid_password'] = 'ÃÜÂë²»ÕýÈ·£¬ÇëÈ·ÈÏÆä³¤¶ÈÊÇ·ñ¹ý¶Ì';
$messages['error_passwords_dont_match'] = '¶Ô²»Æð£¬ÃÜÂë²»Æ¥Åä';
$messages['error_incorrect_email_address'] = 'µç×ÓÓÊ¼þµØÖ·²»ÕýÈ·';
$messages['error_updating_user_settings'] = '¸üÐÂÓÃ»§ÉèÖÃÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['user_settings_updated_ok'] = 'ÓÃ»§ÉèÖÃÐÞ¸Ä³É¹¦';
$messages['resource'] = '×ÊÔ´';

// plugin centre
$messages['identifier'] = '±êÊ¶ºÅ';
$messages['error_plugins_disabled'] = '¶Ô²»Æð£¬²å¼þ±»½ûÓÃ¡£';

// blog users
$messages['revoke_permissions'] = 'È¡ÏûÊ¹ÓÃÈ¨ÏÞ';
$messages['error_no_users_selected'] = 'Î»Ñ¡ÔñÈÎºÎÓÃ»§';
$messages['user_removed_from_blog_ok'] = 'ÓÃ»§ "%s" µÄ¸Ã²©¿ÍÈ¨ÏÞÈ¡Ïû³É¹¦';
$messages['users_removed_from_blog_ok'] = 'ÓÃ»§ "%s" µÄ¸Ã²©¿ÍÈ¨ÏÞÈ¡Ïû³É¹¦';
$messages['error_removing_user_from_blog'] = 'È¡ÏûÓÃ»§ "%s" µÄ¸Ã²©¿ÍÈ¨ÏÞÊ±³ö´í';
$messages['error_removing_user_from_blog2'] = 'È¡ÏûÓÃ»§ "%s" µÄ¸Ã²©¿ÍÈ¨ÏÞÊ±³ö´í';

// new blog user
$messages['new_blog_username_help'] = '´ýÔö¼ÓµÄ¶Ô¸Ã²©¿Í¹ÜÀíºÍ×ÊÔ´ÖÐÐÄÈ¨ÏÞµÄÓÃ»§µÄÓÃ»§Ãû';
$messages['send_notification'] = '·¢ËÍÍ¨¸æ';
$messages['send_user_notification_help'] = 'Ïò¸ÃÓÃ»§·¢ËÍÒ»·âÍ¨¸æÓÊ¼þ';
$messages['notification_text'] = 'Í¨¸æÕýÎÄ';
$messages['notification_text_help'] = 'ÏòÓÃ»§·¢ËÍµÄÍ¨¸æµÄÕýÎÄ';
$messages['error_adding_user'] = 'Ìí¼Ó¸ÃÓÃ»§È¨ÏÞÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['error_empty_text'] = 'Äú±ØÐëÊäÈëÍ¨¸æÕýÎÄ';
$messages['error_adding_user'] = 'Ìí¼ÓÓÃ»§Ê±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['error_invalid_user'] = 'ÓÃ»§ "%s" ÎÞÐ§»ò²»´æÔÚ';
$messages['user_added_to_blog_ok'] = 'Ìí¼ÓÓÃ»§ "%s" µÄ¸Ã²©¿ÍÈ¨ÏÞ³É¹¦';

// blog templates
$messages['error_no_templates_selected'] = 'Î´Ñ¡ÔñÈÎºÎÄ£°å';
$messages['error_template_is_current'] = 'Ä£°å "%s" ÕýÔÚÊ¹ÓÃ£¬²»ÄÜÉ¾³ý¡£';
$messages['error_removing_template'] = 'É¾³ýÄ£°å "%s" Ê±³ö´í';
$messages['template_removed_ok'] = 'Ä£°å "%s" É¾³ý³É¹¦';
$messages['templates_removed_ok'] = 'Ä£°å %s É¾³ý³É¹¦';

// new blog template
$messages['template_installed_ok'] = 'Ä£°å "%s" Ìí¼Ó³É¹¦';
$messages['error_installing_template'] = '°²×°Ä£°å "%s" Ê±³ö´í';
$messages['error_missing_base_files'] = 'Ä£°åÎÄ¼þ²¿·Ö¶ªÊ§';
$messages['error_add_template_disabled'] = '¸ÃÕ¾µã´Ë¹¦ÄÜ±»½ûÓÃ£¬²»ÄÜÌí¼ÓÐÂÄ£°å';
$messages['error_must_upload_file'] = 'Î´ÉÏ´«Ä£°åÎÄ¼þ';
$messages['error_uploads_disabled'] = '¸ÃÕ¾µã½ûÖ¹ÉÏ´«';
$messages['error_no_new_templates_found'] = 'Î´ÕÒµ½ÐÂÄ£°å';
$messages['error_template_not_inside_folder'] = 'Ä£°åÎÄ¼þËùÔÚÎÄ¼þ¼ÐµÄÃû³Æ±ØÐëÓëÄ£°åÉèÖÃÖÐµÄÃû³ÆÏàÍ¬¡£';
$messages['error_missing_base_files'] = '²¿·Ö»ù±¾Ä£°åÎÄ¼þ¶ªÊ§';
$messages['error_unpacking'] = '½âÑ¹ËõÎÄ¼þÊ±³ö´í';
$messages['error_forbidden_extensions'] = 'Ä£°åÖÐÓÐÎÄ¼þ±»½ûÖ¹·ÃÎÊ';
$messages['error_creating_working_folder'] = '´´½¨ÁÙÊ±ÎÄ¼þ¼Ð½âÑ¹ËõÎÄ¼þÊ±³ö´í';
$messages['error_checking_template'] = 'Ä£°å·¢Éú´íÎó (code = %s)';
$messages['template_package'] = 'Ä£°å°²×°°ü';
$messages['blog_template_package_help']  = 'Äú¿ÉÒÔÓÃ´Ë±íµ¥£¬ÉÏ´«Ò»¸öÐÂµÄÄ£°å°²×°°ü£¬¸ÃÄ£°åÖ»ÓÐÄúµÄ²©¿Í²ÅÄÜ¹»Ê¹ÓÃ¡£Èç¹ûÄúÎÞ·¨ÓÃä¯ÀÀÆ÷ÉÏ´«£¬ÇëÊÖ¶¯ÉÏ´«Ä£°å²¢½«Ëü·ÅÖÃÓÚÄúµÄ²©¿ÍÄ£°åÎÄ¼þ¼Ð<b>%s</b>ÏÂ,È»ºó°´ÏÂ "<b>É¨ÃèÄ£°å</b>" °´Å¥¡£ pLog »áÉ¨Ãè¸ÃÎÄ¼þ¼Ð²¢×Ô¶¯Ìí¼ÓËùÕÒµ½µÄÐÂÄ£°å¡£';
$messages['scan_templates'] = 'É¨ÃèÄ£°å';

// site users
$messages['user_status_active'] = '¼¤»î';
$messages['user_status_disabled'] = '½ûÓÃ';
$messages['user_status_all'] = 'ÓÃ»§×´Ì¬';
$messages['user_status_unconfirmed'] = 'Î´È·ÈÏ';
$messages['error_invalid_user2'] = '±êÊ¶Îª "%s" µÄÓÃ»§²»´æÔÚ¡£';
$messages['error_deleting_user'] = '½ûÓÃÓÃ»§ "%s" Ê±³ö´í';
$messages['user_deleted_ok'] = 'ÓÃ»§ "%s" ½ûÓÃ³É¹¦';
$messages['users_deleted_ok'] = 'ÓÃ»§ %s ½ûÓÃ³É¹¦';

// create user
$messages['user_added_ok'] = 'ÓÃ»§ "%s" Ìí¼Ó³É¹¦';
$messages['error_incorrect_username'] = '¸ÃÓÃ»§Ãû²»ÕýÈ·»òÒÑ¾­´æÔÚ';
$messages['user_status_help'] = '¸ÃÓÃ»§µ±Ç°×´Ì¬';
$messages['user_blog_help'] = '¸ÃÓÃ»§×î³õ±»·ÖÅäÈ¨ÏÞµÄ²©¿Í';
$messages['none'] = 'ÎÞ';

// edit user
$messages['error_invalid_user'] = 'ÓÃ»§±êÊ¶²»ÕýÈ·»ò¸ÃÓÃ»§²»´æÔÚ';
$messages['error_updating_user'] = '¸üÐÂÓÃ»§ÉèÖÃÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ';
$messages['blogs'] = '²©¿ÍÁÐ±í';
$messages['user_blogs_helps'] = '¸ÃÓÃ»§µ±Ç°ÓµÓÐµÄ»òÓÐÈ¨ÏÞµÄ²©¿Í';
$messages['site_admin'] = '¹ÜÀíÔ±È¨ÏÞ';
$messages['site_admin_help'] = '¸ÃÓÃ»§ÊÇ·ñ¾ßÓÐ¹ÜÀíÔ±È¨ÏÞ';
$messages['user_updated_ok'] = 'ÓÃ»§ "%s" ÐÞ¸Ä³É¹¦';

// site blogs
$messages['blog_status_all'] = '²©¿Í×´Ì¬';
$messages['blog_status_active'] = '¼¤»î';
$messages['blog_status_disabled'] = '½ûÓÃ';
$messages['blog_status_unconfirmed'] = 'Î´È·ÈÏ';
$messages['owner'] = '¹ÜÀíÔ±';
$messages['quota'] = 'Åä¶î';
$messages['bytes'] = '×Ö½ÚÊý';
$messages['error_no_blogs_selected'] = 'Äú±ØÐëÑ¡ÔñÄúÏëÒª½ûÓÃµÄ²©¿ÍÍøÕ¾¡£';
$messages['error_blog_is_default_blog'] = '"%s"ÊÇÏµÍ³Ä¬ÈÏ²©¿Í£¬ÎÞ·¨½ûÓÃ¡£';
$messages['blog_deleted_ok'] = '²©¿Í "%s" ½ûÓÃ³É¹¦';
$messages['blogs_deleted_ok'] = '²©¿Í "%s" ½ûÓÃ³É¹¦';
$messages['error_deleting_blog'] = '½ûÓÃ²©¿Í"%s"Ê±³ö´í';
$messages['error_deleting_blog2'] = '½ûÓÃ²©¿Í"%s"Ê±³ö´í';

// create blog
$messages['error_adding_blog'] = 'Ìí¼Ó²©¿ÍÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['blog_added_ok'] = '²©¿Í "%s" Ìí¼Ó³É¹¦';

// edit blog
$messages['blog_status_help'] = '²©¿Í×´Ì¬';
$messages['blog_owner_help'] = '¸Ã²©¿ÍµÄ¹ÜÀíÔ±';
$messages['users'] = 'ÓÃ»§ÁÐ±í';
$messages['blog_quota_help'] = 'ÉèÖÃ×ÊÔ´ÖÐÐÄµÄÅä¶î£¬ÉèÖÃÎª0ÔòÎÞÏÞÖÆ£¬ÉèÖÃÎª¿ÕÔòÊ¹ÓÃÈ«¾ÖÅä¶î';
$messages['blog_users_help'] = 'ÓµÓÐ¸Ã²©¿ÍÈ¨ÏÞµÄÓÃ»§ÁÐ±í£¬´Ó×ó²àÑ¡ÔñÒ»¸öµ½ÓÒ²à¿É¸øÓè¸ÃÓÃ»§¸Ã²©¿ÍµÄÈ¨ÏÞ';
$messages['edit_blog_settings_updated_ok'] = '²©¿Í "%s" ÐÞ¸Ä³É¹¦';
$messages['error_updating_blog_settings'] = 'ÐÞ¸Ä²©¿Í "%s" Ê±³ö´í';
$messages['error_incorrect_blog_owner'] = 'ÒªÉè¶¨Îª²©¿Í¹ÜÀíÔ±µÄÓÃ»§´íÎó»ò²»´æÔÚ¡£';
$messages['error_fetching_blog'] = '¶ÁÈ¡²©¿ÍÉèÖÃÊ±³ö´í';
$messages['error_updating_blog_settings2'] = '¸üÐÂ²©¿ÍÉèÖÃÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['add_or_remove'] = 'Ìí¼Ó»òÉ¾³ýÓÃ»§';

// site locales
$messages['locale'] = 'ÓïÑÔ°ü¹ÜÀí';
$messages['locale_encoding'] = '±àÂë';
$messages['locale_deleted_ok'] = 'ÓïÑÔ°ü "%s" É¾³ý³É¹¦';
$messages['error_no_locales_selected'] = 'Î´Ñ¡ÔñÒªÉ¾³ýµÄÓïÑÔ°ü';
$messages['error_deleting_only_locale'] = 'ÓïÑÔ°üÖ»Ê£ÏÂÒ»¸ö£¬²»ÄÜ±»É¾³ý';
$messages['locales_deleted_ok']= 'ÓïÑÔ°ü%sÉ¾³ý³É¹¦';
$messages['error_deleting_locale'] = 'É¾³ýÓïÑÔ°ü "%s" Ê±³ö´í';
$messages['error_locale_is_default'] = 'ÓïÑÔ°ü "%s" ÊÇÐÂ²©¿ÍµÄÄ¬ÈÏÓïÑÔ°ü£¬²»ÄÜ±»É¾³ý';

// add locale
$messages['error_invalid_locale_file'] = 'ÓïÑÔ°üÎÄ¼þÎÞÐ§';
$messages['error_no_new_locales_found'] = 'Î´ÕÒµ½ÐÂÓïÑÔ°üÎÄ¼þ';
$messages['locale_added_ok'] = 'ÓïÑÔ°ü "%s" Ìí¼Ó³É¹¦';
$messages['error_saving_locale'] = '´æ´¢ÐÂÓïÑÔ°üÊ±·¢Éú´íÎó¡£Çë¼ì²éÊÇ·ñÓÐÓïÑÔ°üÎÄ¼þ¼ÐµÄÐ´ÈëÈ¨ÏÞ¡£';
$messages['scan_locales'] = 'É¨ÃèÓïÑÔ°ü';
$messages['add_locale_help'] = 'Äú¿ÉÒÔÓÃ´Ë±íµ¥ÉÏ´«Ò»¸öÐÂµÄÓïÑÔ°ü¡£Èç¹ûÄúÎÞ·¨ÓÃä¯ÀÀÆ÷ÉÏ´«£¬ÇëÊÖ¶¯ÉÏ´«ÓïÑÔ°ü²¢½«Ëü·ÅÖÃÓÚ <b>./locales/</b>ÏÂ,È»ºó°´ÏÂ "<b>É¨ÃèÓïÑÔ°ü</b>" °´Å¥¡£ pLog »áÉ¨Ãè¸ÃÎÄ¼þ¼Ð²¢×Ô¶¯Ìí¼ÓÐÂÕÒµ½µÄÓïÑÔ°ü¡£ ';

// site templates
$messages['error_template_is_default'] = 'Ä£°å "%s" ÊÇÐÂ²©¿ÍÄ¬ÈÏÄ£°å£¬²»ÄÜ±»É¾³ý¡£';

// add template
$messages['global_template_package_help'] = 'Äú¿ÉÒÔÓÃ´Ë±íµ¥£¬ÉÏ´«Ò»¸öÐÂµÄÄ£°å°²×°°ü£¬¸ÃÄ£°å½«Ìá¹©¸ø²©¿ÍÕ¾µãµÄËùÓÐ²©¿ÍÊ¹ÓÃ¡£Èç¹ûÄúÎÞ·¨ÓÃä¯ÀÀÆ÷ÉÏ´«£¬ÇëÊÖ¶¯ÉÏ´«Ä£°å²¢½«Ëü·ÅÖÃÓÚÄúµÄ²©¿ÍÄ£°åÎÄ¼þ¼Ð<b>%s</b>ÏÂ,È»ºó°´ÏÂ "<b>É¨ÃèÄ£°å</b>" °´Å¥¡£ pLog »áÉ¨Ãè¸ÃÎÄ¼þ¼Ð²¢×Ô¶¯Ìí¼ÓËùÕÒµ½µÄÐÂÄ£°å¡£';

// global settings
$messages['site_config_saved_ok'] = 'Õ¾µãÉèÖÃ±£´æ³É¹¦';
$messages['error_saving_site_config'] = '±£´æÕ¾µãÉèÖÃÊ±³ö´í';
/// general settings
$messages['help_comments_enabled'] = 'Ä¬ÈÏÆôÓÃ»ò½ûÓÃÐÂ²©¿ÍµÄÆÀÂÛ¹¦ÄÜ';
$messages['help_beautify_comments_text'] = 'Æô¶¯¸ÃÏî£¬ÔÊÐíÆÀÂÛÖÐÌí¼ÓÍ¼Æ¬ºÍÁ´½Ó';
$messages['help_temp_folder'] = 'pLogÏµÍ³Ö´ÐÐÄ³Ð©²Ù×÷Ê±ÒªÓÃµ½µÄÁÙÊ±ÎÄ¼þ¼ÐÂ·¾¶¡£';
$messages['help_base_url'] = '²©¿ÍÕ¾µãµÄ»ù±¾Á´½ÓµØÖ·';
$messages['help_subdomains_enabled'] = 'ÆôÓÃ»ò½ûÓÃ¶þ¼¶ÓòÃû.ÓûÁË½â¸ü¶à¹ØÓÚ¶þ¼¶ÓòÃûµÄÐÅÏ¢Çë²éÔÄ°ïÖúÎÄµµ¡£';
$messages['help_subdomains_base_url'] = 'µ±ÆôÓÃ¶þ¼¶ÓòÃûºó£¬¸Ã»ù±¾µØÖ·½«´úÌæÔ­ÓÐµÄµØÖ·£¬Ê¹ÓÃ{blogname}ºÍ{username}±êÇ©À´»ñµÃ²©¿ÍÃûºÍ²©¿Í¹ÜÀíÔ±µÄÓÃ»§Ãû';
$messages['help_include_blog_id_in_url'] = '¸ÃÏîÄ¿Ïàµ±ÖØÒª£¬Ò»°ã»ò¶þ¼¶ÓòÃûÐÎÊ½ÆôÓÃÊ±£¬Ëü½«Ç¿ÖÆ½«ÄÚ²¿Ò»°ãÁ´½Ó²»°üº¬"blogId"²ÎÊý¡£³ý·ÇÄã·Ç³£Çå³þ£¬·ñÔò²»ÒªÐÞ¸Ä¸ÃÏîÉèÖÃ¡£';
$messages['help_script_name'] = 'Èç¹ûÄãÐèÒªÖØÃüÃûindex.phpÇëÐÞ¸Ä¸ÃÏî';
$messages['help_show_posts_max'] = 'Ê×Ò³Ä¬ÈÏ¿ÉÏÔÊ¾µÄ×î´óÎÄÕÂÊýÄ¿';
$messages['help_recent_posts_max'] = 'ÔÚÊ×Ò³¡°×îÐÂ·¢±í¡±ÁÐ±íÖÐÄ¬ÈÏÏÔÊ¾µÄÎÄÕÂÊýÁ¿.';
$messages['help_save_drafts_via_xmlhttprequest_enabled'] = 'ÔÊÐí´¢´æjavascriptºÍxmlhttpÇëÇó²Ý¸å';
$messages['help_locale_folder'] = '´æ´¢ÓïÑÔ°üÎÄ¼þµÄÎÄ¼þ¼Ð';
$messages['help_default_locale'] = 'ÐÂ½¨²©¿ÍµÄÄ¬ÈÏÓïÑÔÉèÖÃ';
$messages['help_default_blog_id'] = 'index.phpÄ¬ÈÏÏÔÊ¾µÄ²©¿ÍblogID';
$messages['help_default_time_offset'] = 'ÐÂ½¨²©¿ÍµÄÄ¬ÈÏÊ±²î';
$messages['help_html_allowed_tags_in_comments'] = 'ÆÀÂÛÖÐÔÊÐíÊ¹ÓÃµÄHTML±êÇ©';
$messages['help_referer_tracker_enabled'] = 'Èç¹ûÍøÕ¾½ÓÊÕµ½µÄREQUESTÇëÇóÖÐº¬ÓÐREFERERÐÅÏ¢£¬ÊÇ·ñ½«»ù±¾µÄREFERERÐÅÏ¢´æÈëÊý¾Ý¿â';
$messages['help_show_more_enabled'] = 'ÊÇ·ñÆôÓÃ¡°²é¿´È«ÎÄ¡±Á´½Ó¹¦ÄÜ';
$messages['help_update_article_reads'] = 'ÄúÊÇ·ñÏëÆôÓÃÕ¾µãÄÚ½¨µÄ¼ÆÊýÆ÷£¬¿ÉÒÔÍ³¼ÆÃ¿ÆªÎÄÕÂµÄµã»÷Êý¡£';
$messages['help_update_cached_article_reads'] = 'ÊÇ·ñµ±ÎÄÕÂ¶ÁÈ¡Ê±£¬¸üÐÂÎÄÕÂ»º´æ';
$messages['help_xmlrpc_ping_enabled'] = 'µ±·¢±íÐÂÎÄÕÂÊ±£¬ÊÇ·ñÒªÏòÒÔÏÂÕ¾µã·¢ËÍXMLRPCÍ¨¸æ¡£';
$messages['help_send_xmlrpc_pings_enabled_by_default'] = 'ÊÇ·ñÎÄÕÂÔÚ·¢±í»òÐÞ¸ÄÊ±Ä¬ÈÏ·¢ËÍÒýÓÃÍ¨¸æ';
$messages['help_xmlrpc_ping_hosts'] = '½ÓÊÜXMLRPCÍ¨¸æµÄÍøÕ¾ÁÐ±í£¬Ã¿¸öÍøÖ·µ¥¶ÀÒ»ÐÐ£¬ÊýÄ¿²»ÏÞ¡£';
$messages['help_trackback_server_enabled'] = 'ÊÇ·ñ½ÓÊÜÆäËüÍøÕ¾·¢³öµÄÒýÓÃÍ¨¸æ£¨TrackBack£©¡£';
$messages['help_htmlarea_enabled'] = 'ÊÇ·ñÆôÓÃËù¼û¼´ËùµÃ£¨WYSIWYG£©ÎÄÕÂ±à¼­Æ÷¡£';
$messages['help_plugin_manager_enabled'] = 'ÊÇ·ñÆôÓÃ²å¼þ¹¦ÄÜ';
$messages['help_minimum_password_length'] = 'ÃÜÂë×îÐ¡³¤¶È';
$messages['help_xhtml_converter_enabled'] = 'ÊÇ·ñ½«HTML´úÂë×ª»»³ÉXHTML´úÂë';
$messages['help_xhtml_converter_aggressive_mode_enabled'] = 'ÊÇ·ñÈÃplogÉú³ÉXHTML´úÂë£¬µ«Õâ½«¸ü¿ÉÄÜ³ö´í';
$messages['help_session_save_path'] = 'Ê¹ÓÃPHPµÄsession_save_path()º¯Êý£¬À´¸ü¸ÄpLog´æ·ÅsessionµÄÎÄ¼þ¼Ð¡£ÇëÈ·ÈÏ¸ÃÎÄ¼þ¼Ð±»HTTP·þÎñ³ÌÐò£¨ÈçAPACHE£©ÓµÓÐÐ´È¨ÏÞ¡£Èç¹ûÄúÒªÊ¹ÓÃPHPÔ¤ÉèµÄsession´æ·ÅÂ·¾¶£¬Éè¶¨Îª¿Õ°×¼´¿É¡£';
// summary settings
$messages['help_summary_page_show_max'] = 'ÔÚ»ã×Ü£¨SUMMARY£©Ò³ÃæÖÐÒªÏÔÊ¾¶àÉÙÏîÄ¿¡£';
$messages['help_summary_blogs_per_page'] = '»ã×ÜµÄ²©¿ÍÁÐ±íÖÐÃ¿Ò³ÏÔÊ¾µÄ²©¿ÍÊý';
$messages['help_forbidden_usernames'] = '½ûÖ¹×¢²áµÄÓÃ»§ÃûÁÐ±í';
$messages['help_force_one_blog_per_email_account'] = 'Ã¿¸öµç×ÓÓÊ¼þµØÖ·Ö»ÏÞÖÆ×¢²áÒ»¸ö²©¿Í';
$messages['help_summary_show_agreement'] = 'ÊÇ·ñÔÚ×¢²áÖÐÏÔÊ¾Ð­¶¨ÎÄ±¾ÈÃÓÃ»§È·ÈÏ';
$messages['help_need_email_confirm_registration'] = 'ÐèÒªÓÃ»§Ê¹ÓÃµç×ÓÓÊ¼þ½øÐÐÈÏÖ¤';
$messages['help_summary_disable_registration'] = 'ÊÇ·ñ¹Ø±ÕÐÂ²©¿Í×¢²á';
// templates
$messages['help_template_folder'] = '´æ´¢Ä£°åµÄÎÄ¼þ¼Ð';
$messages['help_default_template'] = 'ÐÂ½¨²©¿ÍµÄÄ¬ÈÏÄ£°å';
$messages['help_users_can_add_templates'] = 'ÔÊÐíÓÃ»§¼ÓÈë×Ô¼ºµÄÄ£°å';
$messages['help_template_compile_check'] = 'Èç¹û½ûÓÃ¸ÃÏî£¬Ä£°åÎÄ¼þ±ä¸üÊ±Smarty½«¼ì²éËùÓÐµÄÇëÇó£¬¿ÉÒÔÌá¸ß¸ü¶àÐÔÄÜ¡£';
$messages['help_template_cache_enabled'] = 'ÆôÓÃÄ£°å»º´æ';
$messages['help_template_cache_lifetime'] = '»º´æ±£ÁôÊ±¼ä£¬ÉèÖÃÎª-1ÔòÓÀ¾Ã´æÁô£¬ÉèÖÃÎª0Ôò½ûÓÃ»º´æ¡£';
$messages['help_template_http_cache_enabled'] = 'ÆôÓÃHTTPÌõ¼þÇëÇóµÄ»º´æÖ§³Ö¡£Èç¹ûÆôÓÃ¿ÉÒÔ½ÚÊ¡´ø¿í¡£';
$messages['help_allow_php_code_in_templates'] = 'ÔÊÐíÔÚSmartyÄ£°åµÄ{php}...{/php}¿éÖÐÇ¶ÈëPHP´úÂë';
// urls
$messages['help_request_format_mode'] = 'Ñ¡ÔñÓÐÐ§Á´½ÓµÄ¸ñÊ½.Èç¹ûÊ¹ÓÃ×Ô¶¨ÒåÁ´½Ó£¬ÇëÈ·ÈÏÒÔÏÂÉèÖÃ';
$messages['plain'] = '¼òµ¥¸ñÊ½';
$messages['search_engine_friendly'] = 'ÊÊÒËËÑË÷ÒýÇæ';
$messages['custom_url_format'] = '×Ô¶¨ÒåÁ´½Ó';
$messages['help_permalink_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±µÄ¾²Ì¬µØÖ·¸ñÊ½';
$messages['help_category_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±µÄÎÄÕÂ·ÖÀàµÄÁ´½Ó¸ñÊ½';
$messages['help_blog_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±²©¿ÍÁ´½ÓµÄ¸ñÊ½';
$messages['help_archive_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±ÎÄ¼þ¹éµµµÄÁ´½Ó¸ñÊ½';
$messages['help_user_posts_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±²©¿ÍÎÄÕÂµÄÁ´½Ó¸ñÊ½';
$messages['help_post_trackbacks_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±ÒýÓÃÁ´½ÓµÄÁ´½Ó¸ñÊ½';
$messages['help_template_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±×Ô¶¨Òå¾²Ì¬Ä£°åÒ³ÃæµÄÁ´½Ó¸ñÊ½';
$messages['help_album_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±×ÊÔ´ÖÐÐÄµÄÁ´½Ó¸ñÊ½';
$messages['help_resource_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±×ÊÔ´Ò³ÃæµÄÁ´½Ó¸ñÊ½';
$messages['help_resource_preview_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±×ÊÔ´Ô¤ÀÀµÄÁ´½Ó¸ñÊ½';
$messages['help_resource_medium_size_preview_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±ÖÐÐÍ×ÊÔ´Ô¤ÀÀµÄÁ´½Ó¸ñÊ½';
$messages['help_resource_download_link_format'] = 'Ê¹ÓÃ×Ô¶¨ÒåÁ´½ÓÊ±ÎÄ¼þµÄÁ´½Ó¸ñÊ½';
// email
$messages['help_check_email_address_validity'] = 'ÔÚÓÃ»§ÉêÇë×¢²áÐÂ²©¿ÍÕ¾µãÊ±£¬ÊÇ·ñÒªÈÏÖ¤ËûËùÌîÐ´µÄµç×ÓÓÊ¼þµØÖ·';
$messages['help_email_service_enabled'] = 'ÆôÓÃ»ò½ûÓÃ·¢ËÍµç×ÓÓÊ¼þ¹¦ÄÜ';
$messages['help_post_notification_source_address'] = 'ÏµÍ³Í¨ÖªÓÊ¼þÖÐµÄ¼Ä¼þÈËµÄµç×ÓÓÊ¼þµØÖ·¡£';
$messages['help_email_service_type'] = 'Ñ¡Ôñ·¢ËÍµç×ÓÓÊ¼þµÄ·½Ê½';
$messages['help_smtp_host'] = 'Èç¹ûÑ¡ÓÃSMTP·¢ËÍµç×ÓÓÊ¼þ£¬ÇëÊäÈëÄúÒªÓÃÀ´·¢ËÍÓÊ¼þµÄÖ÷»ú¡£';
$messages['help_smtp_port'] = 'ÉèÖÃSMTP·þÎñÆ÷µÄ¶Ë¿Ú';
$messages['help_smtp_use_authentication'] = 'ÆôÓÃ»ò½ûÓÃSMTP·þÎñÆ÷ÈÏÖ¤';
$messages['help_smtp_username'] = 'Èç¹ûSMTP·þÎñÆ÷ÐèÒªÈÏÖ¤£¬ÇëÌîÐ´ÓÃ»§ÕËºÅ¡£';
$messages['help_smtp_password'] = 'Èç¹ûSMTP·þÎñÆ÷ÐèÒªÈÏÖ¤£¬ÇëÌîÐ´ÓÃ»§ÃÜÂë¡£';
// helpers
$messages['help_path_to_tar'] = 'tarÃüÁîËùÔÚÎÄ¼þ¼Ð';
$messages['help_path_to_gzip'] = 'gzipÃüÁîËùÔÚÎÄ¼þ¼Ð';
$messages['help_path_to_bz2'] = 'bzip2ÃüÁîËùÔÚÎÄ¼þ¼Ð';
$messages['help_path_to_unzip'] = 'unzipÃüÁîËùÔÚÎÄ¼þ¼Ð';
$messages['help_unzip_use_native_version'] = 'Ê¹ÓÃ×Ô´øµÄphp°ü½âÑ¹Ëõ.zipÎÄ¼þ¡£';
// uploads
$messages['help_uploads_enabled'] = 'ÆôÓÃ»ò½ûÓÃÉÏ´«ÎÄ¼þ¹¦ÄÜ¡£Õâ¸ö¹¦ÄÜ»áÓ°Ïìµ½ÓÃ»§ÄÜ·ñÉÏ´«ÐÂµÄÄ£°å»òÓïÑÔ°üÒÔ¼°¼°ÄÜ·ñÏòÏÖ´æÄ£°åÖÐÌí¼ÓÎÄ¼þ¡£';
$messages['help_maximum_file_upload_size'] = 'ÔÊÐíÓÃ»§ÉÏ´«ÎÄ¼þµÄ×î´ó×Ö½ÚÊý¡£¸ÃÏîÉèÖÃ²»ÄÜ³¬¹ýphpÖÐµÄÉèÖÃ';
$messages['help_upload_forbidden_files'] = '½ûÖ¹ÓÃ»§ÉÏ´«µÄÎÄ¼þÀàÐÍ¡£Äã¿ÉÒÔÖ¸¶¨ÈÎÒâÊýÁ¿µÄÎÄ¼þÀàÐÍ£¬Á½¸öÀàÐÍÖ®¼äÓÃ¿Õ¸ñ·ÖÀë¡£';
// interfaces
$messages['help_xmlrpc_api_enabled'] = 'ÆôÓÃ XMLRPC ·¢±íÎÄÕÂ';
$messages['help_rdf_enabled'] = 'Æô¶¯Atom»òRSS¾ÛºÏ';
$messages['help_default_rss_profile'] = 'Ä¬ÈÏµÄRSS»òAtom·½Ê½';
// security
$messages['help_security_pipeline_enabled'] = 'ÊÇ·ñÆôÓÃ°²È«ÒÔ¼°ËùÓÐÏà¹Ø²å¼þ¡£×¢Òâ£¬ÕâÒ²»áÓ¡Ïóµ½ÆäËüµÄÐÂ²å¼þ¡£';
$messages['help_ip_address_filter_enabled'] = 'ÊÇ·ñÆôÓÃipµØÖ·¹ýÂË';
$messages['help_content_filter_enabled'] = 'ÆôÓÃ»ò½ûÓÃ¹æÔò¹ýÂË£¬Æô¶¯¸ÃÏîÄ¿Ê±£¬ÐèÒª´ò¿ª°²È«¹¦ÄÜ¡£';
$messages['help_maximum_comment_size'] = 'ÆÀÂÛµÄ×î´ó×Ö½ÚÊý';
// bayesian filter
$messages['help_bayesian_filter_enabled'] = 'ÆôÓÃ»ò½ûÓÃ¹ýÂË';
$messages['help_bayesian_filter_spam_probability_treshold'] = 'ÅÐ¶ÏÎªÀ¬»øÆÀÂÛµÄ×î´ó¼«ÏÞ';
$messages['help_bayesian_filter_nonspam_probability_treshold'] = 'ÅÐ¶ÏÎªÀ¬»øÆÀÂÛµÄ×îÐ¡¼«ÏÞ';
$messages['help_bayesian_filter_min_length_token'] = 'ÖØÒª±ê¼ÇµÄ×îÐ¡³¤¶È';
$messages['help_bayesian_filter_max_length_token'] = 'ÖØÒª±ê¼ÇµÄ×î´ó³¤¶È';
$messages['help_bayesian_filter_number_significant_tokens'] = 'ÖØÒª±ê¼ÇµÄÊýÁ¿';
$messages['help_bayesian_filter_spam_comments_action'] = '¶ÔÓÚ±ê¼ÇÎªÀ¬»øµÄÆÀÂÛÈçºÎ´¦Àí';
$messages['keep_spam_comments'] = '±£ÁôÊý¾Ý¿âÖÐ±ê¼ÇÎªÀ¬»øµÄÆÀÂÛ';
$messages['throw_away_spam_comments'] = 'Ö±½ÓÉ¾³ýÀ¬»øÆÀÂÛ';
// resources
$messages['help_resources_enabled'] = 'ÆôÓÃ»ò½ûÓÃ×ÊÔ´ÖÐÐÄ';
$messages['help_resources_folder'] = '´æ´¢×ÊÔ´ÎÄ¼þµÄÎÄ¼þ¼Ð';
$messages['help_thumbnail_method'] = 'Éú³ÉËõÂÔÍ¼µÄ·½·¨£¬Èç¹ûÊ¹ÓÃPHP£¬Ö§³ÖGD·½Ê½';
$messages['help_path_to_convert'] = 'convertÃüÁîËùÔÚÎÄ¼þ¼Ð';
$messages['help_thumbnail_format'] = 'ËõÂÔÍ¼´æ´¢¸ñÊ½';
$messages['help_thumbnail_height'] = 'Ð¡ÐÍËõÂÔÍ¼Ä¬ÈÏ¸ß¶È';
$messages['help_thumbnail_width'] = 'Ð¡ÐÍËõÂÔÍ¼Ä¬ÈÏ¿í¶È';
$messages['help_medium_size_thumbnail_height'] = 'ÖÐÐÍËõÂÔÍ¼µÄÄ¬ÈÏ¸ß¶È';
$messages['help_medium_size_thumbnail_width'] = 'ÖÐÐÍËõÂÔÍ¼µÄÄ¬ÈÏ¿í¶È';
$messages['help_thumbnails_keep_aspect_ratio'] = 'Éú³ÉËõÂÔÍ¼Ê±±£ÁôÔ­ÓÐµÄ³¤¿í±ÈÀý';
$messages['help_thumbnail_generator_force_use_gd1'] = 'Ç¿ÆÈÊ¹ÓÃ GD1-only ¹¦ÄÜ';
$messages['help_thumbnail_generator_user_smoothing_algorithm'] = 'Æ½»¬ËõÂÔÍ¼.¸Ã¹¦ÄÜÖ»ÄÜÔÚÊ¹ÓÃGD¹¦ÄÜÊ±Ê¹ÓÃ¡£';
$messages['help_resources_quota'] = '²©¿ÍµÄÈ«¾Ö×ÊÔ´Åä¶î';
$messages['help_resource_server_http_cache_enabled'] = 'ÆôÓÃ¶Ô"If-Modified-Since" ±êÌâºÍHTTPÌõ¼þÇëÇóµÄÖ§³Ö.ÆôÓÃÔöÇ¿´ø¿í´æ´¢¡£';
$messages['help_resource_server_http_cache_lifetime'] = '¿Í»§¶ËÊ¹ÓÃ×ÊÔ´»º´æµÄÊ±¼ä';
$messages['same_as_image'] = 'ÓëÔ­Ê¼Í¼ÏñÏàÍ¬';
// search
$messages['help_search_engine_enabled'] = 'Æô¶¯»ò½ûÖ¹ËÑË÷ÒýÇæ';
$messages['help_search_in_custom_fields'] = 'ËÑË÷×Ô¶¨ÒåÇø¿é';
$messages['help_search_in_comments'] = 'ËÑË÷ÆÀÂÛ';

// cleanup
$messages['purge'] = 'Çå³ý';
$messages['cleanup_spam'] = 'Çå³ýÀ¬»ø»Ø¸´';
$messages['cleanup_spam_help'] = 'Çå³ýËùÓÐ±»Ê¹ÓÃÕß±êÊ¾ÎªÀ¬»øµÄ»Ø¸´¡£Ò»µ©É¾³ýÎÞ·¨»Ö¸´¡£';
$messages['spam_comments_purged_ok'] = 'À¬»ø»Ø¸´Çå³ý³É¹¦';
$messages['cleanup_posts'] = 'Çå³ýÎÄÕÂ';
$messages['cleanup_posts_help'] = 'Çå³ýËùÓÐ±»Ê¹ÓÃÕß±êÊ¾ÎªÉ¾³ýµÄÎÄÕÂ¡£ Ò»µ©É¾³ýÎÞ·¨»Ö¸´¡£';
$messages['posts_purged_ok'] = 'ÎÄÕÂÇå³ý³É¹¦';

/// summary ///
// front page
$messages['summary'] = '»ã×Ü';
$messages['register'] = '×¢²á';
$messages['summary_welcome'] = '»¶Ó­';
$messages['summary_most_active_blogs'] = '×î»îÔ¾µÄ²©¿Í';
$messages['summary_most_commented_articles'] = 'ÆÀÂÛ×î¶àµÄÎÄÕÂ';
$messages['summary_most_read_articles'] = 'ÔÄ¶Á×î¶àµÄÎÄÕÂ';
$messages['password_forgotten'] = 'Íü¼ÇÃÜÂë£¿';
$messages['summary_newest_blogs'] = '×îÐÂ¿ªÍ¨µÄ²©¿Í';
$messages['summary_latest_posts'] = '×î½ü·¢±íµÄÎÄÕÂ';
$messages['summary_search_blogs'] = 'ËÑË÷²©¿Í';

// blog list
$messages['updated'] = '¸üÐÂ';
$messages['total_reads'] = 'ä¯ÀÀ×Ü´ÎÊý';

// blog profile
$messages['blog'] = '²©¿Í';
$messages['latest_posts'] = '×î½ü·¢±íµÄÎÄÕÂ';

// registration
$messages['register_step0_title'] = '½ÓÊÜ·þÎñÐ­Òé';
$messages['agreement'] = 'Ðí¿ÉÌõ¿î';
$messages['decline'] = '¾Ü¾ø';
$messages['accept'] = 'Í¬Òâ';
$messages['read_service_agreement'] = 'ÇëÔÄ¶Á·þÎñÐ­Òé£¬Èç¹ûÄúÍ¬ÒâµÄ»°£¬µã»÷Í¬Òâ';
$messages['register_step1_title'] = '´´½¨ÓÃ»§ [1/4]';
$messages['register_step1_help'] = 'Ê×ÏÈÄúÐèÒª´´½¨Ò»¸öÐÂÓÃ»§À´»ñµÃ²©¿Í¡£';
$messages['register_next'] = 'ÏÂÒ»²½';
$messages['register_back'] = 'ÉÏÒ»²½';
$messages['register_step2_title'] = '´´½¨²©¿Í [2/4]';
$messages['register_blog_name_help'] = '²©¿ÍÃû³Æ';
$messages['register_step3_title'] = 'Ñ¡ÔñÄ£°å [3/4]';
$messages['step1'] = 'µÚÒ»²½';
$messages['step2'] = 'µÚ¶þ²½';
$messages['step3'] = 'µÚÈý²½';
$messages['register_step3_help'] = 'ÇëÑ¡ÔñÄúµÄ²©¿ÍµÄÄ¬ÈÏÄ£°å¡£';
$messages['error_must_choose_template'] = 'ÇëÑ¡ÔñÒ»¸öÄ£°å';
$messages['select_template'] = 'Ñ¡ÔñÄ£°å';
$messages['register_step5_title'] = '×£ºØÄú£¡ [4/4]';
$messages['finish'] = 'Íê³É';
$messages['register_need_confirmation'] = 'º¬ÓÐÈ·ÈÏÐÅÏ¢µÄµç×ÓÓÊ¼þÒÑ¾­·¢ËÍ¸øÄú£¬ÇëÄúµã»÷ÆäÖÐµÄÁ´½ÓÒÔ¼¤»îÄúµÄ²©¿Í¡£';
$messages['register_step5_help'] = '×£ºØÄú£¬ÄúµÄÓÃ»§ÒÔ¼°²©¿ÍÒÑ¾­¿ªÍ¨£¡';
$messages['register_blog_link'] = 'Èç¹ûÄúÏë·ÃÎÊÄúµÄ²©¿Í£¬ÏÖÔÚ¾Í½øÈë°É£¡ <a href="%2$s">%1$s</a>';
$messages['register_blog_admin_link'] = 'Èç¹ûÄúÏëÂíÉÏ·¢±íÎÄÕÂ£¬Çëµã»÷ <a href="admin.php">¹ÜÀí½çÃæ</a>½øÈëºóÌ¨½øÐÐ²Ù×÷¡£';
$messages['register_error'] = '½ø³ÌÖÐ³ö´í';
$messages['error_registration_disabled'] = '¶Ô²»Æð£¬±¾Õ¾ÒÑÔÝÍ£ÐÂÓÃ»§×¢²á£¬ÇëÉÔºòÔÙÊÔ»òÁªÏµ¹ÜÀíÔ±';
// registration article topic and text
$messages['register_default_article_topic'] = '×£ºØÄú';
$messages['register_default_article_text'] = 'Èç¹ûÄúÔÄ¶Áµ½ÕâÆªÎÄÕÂ£¬Õâ¾ÍÒâÎ¶×ÅÄú×¢²áµÄ²©¿ÍÒÑ¾­ÉêÇë³É¹¦¡£';
$messages['register_default_category'] = 'Ò»°ã·ÖÀà';
// confirmation email
$messages['register_confirmation_email_text'] = 'Çëµã»÷ÏÂÃæµÄÁ´½ÓÀ´¼¤»îÄúµÄ²©¿Í:

%s

ÏÖÔÚ¾Í½øÈë²©¿ÍÊÀ½ç°É£¡×£ÄúÌìÌì¿ìÀÖ£¡';
$messages['error_invalid_activation_code'] = '¶Ô²»Æð£¬ÈÏÖ¤ÂëÎÞÐ§';
$messages['blog_activated_ok'] = '×£ºØÄú£¬Äú×¢²áµÄÐÂÓÃ»§ºÍ²©¿ÍÒÑ¾­³É¹¦¿ªÍ¨£¡';
// forgot your password?
$messages['reset_password'] = 'ÖØÖÃÃÜÂë';
$messages['reset_password_username_help'] = '´ýÖØÖÃÃÜÂëµÄÓÃ»§Ãû';
$messages['reset_password_email_help'] = 'ÒÑÓÐÈËÊ¹ÓÃ¸Ãµç×ÓÓÊÏä×¢²á';
$messages['reset_password_help'] = 'ÖØÖÃÃÜÂë£¬ÇëÊäÈëÍü¼ÇÃÜÂëµÄÓÃ»§ÃûÒÔ¼°×¢²áÊ±µÄµç×ÓÓÊ¼þµØÖ·';
$messages['error_resetting_password'] = 'ÖØÖÃÃÜÂëÊ±³ö´í£¬Çë¼ì²éÊý¾Ý²¢ÖØÊÔ¡£';
$messages['reset_password_error_incorrect_email_address'] = 'µç×ÓÓÊÏäµØÖ·²»ÕýÈ·»òÆäËûÓÃ»§Ê¹ÓÃ´ËÓÊ¼þ×¢²á';
$messages['password_reset_message_sent_ok'] = 'ÀûÓÃ×¢²áµç×ÓÓÊ¼þÖØÖÃÃÜÂë';
$messages['error_incorrect_request'] = 'Á´½ÓÖÐµÄ²ÎÊý²»ÕýÈ·';
$messages['change_password'] = 'ÉèÖÃÐÂÃÜÂë';
$messages['change_password_help'] = 'ÇëÊäÈë²¢È·ÈÏÐÂÃÜÂë';
$messages['new_password'] = 'ÐÂÃÜÂë';
$messages['new_password_help'] = 'ÊäÈëÐÂÃÜÂë';
$messages['password_updated_ok'] = 'ÄúµÄÃÜÂëÐÞ¸Ä³É¹¦';

// Suggested by BCSE, some useful messages that not available in official locale
$messages['upgrade_information'] = 'ÄúËùÊ¹ÓÃµÄä¯ÀÀÆ÷²»·ûºÏÍøÒ³Éè¼Æ±ê×¼£¬Òò´Ë±¾ÍøÒ³½«ÒÔ´¿ÎÄ×ÖÄ£Ê½ÏÔÊ¾¡£ÈçÓûÒÔ×î¼ÑµÄÅÅ°æ·½Ê½ä¯ÀÀ±¾Õ¾£¬Çë¿¼ÂÇ<a href="http://www.webstandards.org/upgrade/" title="The Web Standards Project\'s Browser Upgrade initiative">Éý¼¶</a>ÄúµÄä¯ÀÀÆ÷¡£';
$messages['jump_to_navigation'] = 'ÒÆ¶¯µ½µ¼º½Ìõ¡£';
$messages['comment_email_never_display'] = 'ÏµÍ³»á×Ô¶¯ÎªÄúÉè¶¨·ÖÐÐ£¬ÇÒ²»»áÏÔÊ¾ÄúÁôÏÂµÄÓÊ¼þµØÖ·¡£';
$messages['comment_html_allowed'] = '¿ÉÊ¹ÓÃµÄ <acronym title="Hypertext Markup Language">HTML</acronym> ±êÇ©ÈçÏÂ£º&lt;<acronym title="ÓÃÍ¾£º³¬¼¶Á´½Ó">a</acronym> href=&quot;&quot; title=&quot;&quot; rel=&quot;&quot;&gt; &lt;<acronym title="ÓÃÍ¾£ºÊ××ÖÏÂ³Á">acronym</acronym> title=&quot;&quot;&gt; &lt;<acronym title="ÓÃÍ¾£ºÒýÓÃÎÄ×Ö">blockquote</acronym> cite=&quot;&quot;&gt; &lt;<acronym title="ÓÃÍ¾£ºÉ¾³ýÏß">del</acronym>&gt; &lt;<acronym title="ÓÃÍ¾£ºÐ±Ìå">em</acronym>&gt; &lt;<acronym title="ÓÃÍ¾£ºµ×Ïß">ins</acronym>&gt; &lt;<acronym title="ÓÃÍ¾£º´ÖÌå">strong</acronym>&gt;';
$messages['trackback_uri'] = 'ÕâÆªÎÄÕÂµÄÒýÓÃÁ´½ÓµØÖ·£º';
$messages['previous_post'] = 'ÉÏÒ»Æª';
$messages['next_post'] = 'ÏÂÒ»Æª';
$messages['comment_default_title'] = '(ÎÞ±êÌâ)';
$messages['guestbook'] = 'ÁôÑÔ°å';
$messages['trackbacks'] = 'ÒýÓÃ';
$messages['menu'] = 'ÐÂÎÅ¾ÛºÏ';
$messages['albums'] = '×ÊÔ´ÖÐÐÄ';
$messages['admin'] = '¹ÜÀí¿ØÖÆÌ¨';
?>