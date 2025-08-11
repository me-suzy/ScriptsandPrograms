<?php

// Japanese locale for pLog1.x
// localized by Mayu Hagiuda
// ¤³¤Î¸À¸ì¥Õ¥¡¥¤¥ë¤ÇÄûÀµ¡¦Í×Ë¾²Õ½êÅù¤¬¤¢¤ê¤Þ¤·¤¿¤é°Ê²¼¤ÎURL¤ÎpLog¸ø¼°¥Õ¥©¡¼¥é¥à¤Ø
//http://forums.plogworld.net/viewforum.php?f=14

// set this to the encoding that should be used to display the pages correctly
$messages['encoding'] = 'EUC-JP';
$messages['locale_description'] = 'Japanese locale  for pLog 1.x (EUC-JP)';
// locale format, see Locale::formatDate for more information
$messages['date_format'] = '%d/%m/%Y %H:%M';

// days of the week
$messages['days'] = Array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );
// -- compatibility, do not touch -- //
$messages['Monday'] = $messages['days'][1];
$messages['Tuesday'] = $messages['days'][2];
$messages['Wednesday'] = $messages['days'][3];
$messages['Thursday'] = $messages['days'][4];
$messages['Friday'] = $messages['days'][5];
$messages['Saturday'] = $messages['days'][6];
$messages['Sunday'] = $messages['days'][0];

// abbreviations
$messages['daysshort'] = Array( 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa' );
// -- compatibility, do not touch -- //
$messages['Mo'] = $messages['daysshort'][1];
$messages['Tu'] = $messages['daysshort'][2];
$messages['We'] = $messages['daysshort'][3];
$messages['Th'] = $messages['daysshort'][4];
$messages['Fr'] = $messages['daysshort'][5];
$messages['Sa'] = $messages['daysshort'][6];
$messages['Su'] = $messages['daysshort'][0];

// months of the year
$messages['months'] = Array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' );
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
$messages['message'] = '¥á¥Ã¥»¡¼¥¸';
$messages['error'] = '¥¨¥é¡¼';
$messages['date'] = 'Date';

// miscellaneous texts
$messages['of'] = 'of';
$messages['recently'] = 'ºÇ¿·µ­»ö';
$messages['comments'] = '¥³¥á¥ó¥È';
$messages['comment on this'] = '¥³¥á¥ó¥È';
$messages['my_links'] = '¥ê¥ó¥¯';
$messages['archives'] = '¥¢¡¼¥«¥¤¥ô';
$messages['search'] = '¸¡º÷';
$messages['calendar'] = '¥«¥ì¥ó¥À¡¼';
$messages['search_s'] = '¸¡º÷';
$messages['search_this_blog'] = '¤³¤ÎBlog¤ò¸¡º÷:';
$messages['about_myself'] = '¼«¸Ê¾Ò²ð';
$messages['permalink_title'] = '¥¢¡¼¥«¥¤¥ô¤Ø¤ÎPermanent¥ê¥ó¥¯';
$messages['permalink'] = 'Permalink';
$messages['posted_by'] = 'Åê¹Æ¼Ô';
$messages['reply'] = 'ÊÖ¿®';

// add comment form
$messages['add_comment'] = '¥³¥á¥ó¥ÈÄÉ²Ã';
$messages['comment_topic'] = 'ÂêÌ¾';
$messages['comment_text'] = 'ÆâÍÆ';
$messages['comment_username'] = '¤¢¤Ê¤¿¤ÎÌ¾Á°';
$messages['comment_email'] = 'E-Mail (¥ª¥×¥·¥ç¥ó)';
$messages['comment_url'] = 'URL (¥ª¥×¥·¥ç¥ó)';
$messages['comment_send'] = 'Á÷¿®';
$messages['comment_added'] = '¥³¥á¥ó¥È¤ò¼õÉÕ¤±¤Þ¤·¤¿';
$messages['comment_add_error'] = '¥¨¥é¡¼:¥³¥á¥ó¥È¤òÄÉ²Ã¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿';
$messages['article_does_not_exist'] = '¤½¤Îµ­»ö¤Ï¤¢¤ê¤Þ¤»¤ó';
$messages['no_posts_found'] = 'ÅÐ¹»µ­»ö¤Ï¤¢¤ê¤Þ¤»¤ó';
$messages['user_has_no_posts_yet'] = 'Åê¹Æ¤Ï¤Þ¤À¤¢¤ê¤Þ¤»¤ó';
$messages['back'] = 'Ìá¤ë';
$messages['post'] = 'Åê¹Æ';
$messages['trackbacks_for_article'] = 'µ­»ö¤ÎTrackback: ';
$messages['trackback_excerpt'] = 'Excerpt';
$messages['trackback_weblog'] = 'Weblog';
$messages['search_results'] = '¸¡º÷·ë²Ì';
$messages['search_matching_results'] = '¸¡º÷¾ò·ï¤È°ìÃ×¤¹¤ëµ­»ö: ';
$messages['search_no_matching_posts'] = '°ìÃ×¤¹¤ëµ­»ö¤Ï¤¢¤ê¤Þ¤»¤ó';
$messages['read_more'] = '(Â³¤­...)';
$messages['syndicate'] = 'Syndicate';
$messages['main'] = '¥á¥¤¥ó';
$messages['about'] = 'About';
$messages['download'] = '¥À¥¦¥ó¥í¡¼¥É';

////// error messages /////
$messages['error_fetching_article'] = '¤´»ØÄê¤Îµ­»ö¤Ï¸«¤Ä¤«¤ê¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_fetching_articles'] = 'µ­»ö¤ò¼èÆÀ¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_trackback_no_trackback'] = '¤³¤Îµ­»ö¤ËTrackback¤Ï¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_incorrect_article_id'] = 'µ­»ö¤ò¸«¤Ä¤±¤ë¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_incorrect_blog_id'] = 'Blog¤ò¸«¤Ä¤±¤ë¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_comment_without_text'] = '¥Æ¥­¥¹¥È¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_comment_without_name'] = 'Ì¾Á°¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_adding_comment'] = '¥¨¥é¡¼:¥³¥á¥ó¥È¤òÄÉ²Ã¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_incorrect_parameter'] = '¥Ñ¥é¥á¡¼¥¿¡¼¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_parameter_missing'] = 'Í×µá¤µ¤ì¤¿Ãæ¤ËÌµ¸ú¤Ê¥Ñ¥é¥á¡¼¥¿¡¼¤¬Â¸ºß¤·¤Þ¤¹¡£';
$messages['error_comments_not_enabled'] = '¤³¤Î¥µ¥¤¥È¤Ç¤Ï¥³¥á¥ó¥È¤¬Ìµ¸ú¤È¤Ê¤Ã¤Æ¤¤¤Þ¤¹¡£';
$messages['error_incorrect_search_terms'] = '¸¡º÷¾ò·ï¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_no_search_results'] = '¸¡º÷¾ò·ï¤Ë°ìÃ×¤¹¤ë¤â¤Î¤Ï¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_no_albums_defined'] = '¤³¤ÎBlog¤ËÀßÄê¤µ¤ì¤Æ¤¤¤ë¥¢¥ë¥Ð¥à¤Ï¤¢¤ê¤Þ¤»¤ó¡£';

/////////////////                                          //////////////////
///////////////// STRINGS FOR THE ADMINISTRATION INTERFACE //////////////////
/////////////////                                          //////////////////

// login page
$messages['login'] = '¥í¥°¥¤¥ó';
$messages['welcome_message'] = 'pLog¤Ø¤è¤¦¤³¤½';
$messages['error_incorrect_username_or_password'] = '¥æ¡¼¥¶¡¼Ì¾¤È¥Ñ¥¹¥ï¡¼¥É¤¬°ìÃ×¤·¤Þ¤»¤ó¡£';
$messages['error_dont_belong_to_any_blog'] = '¤¢¤Ê¤¿¤ÎBlog¤Ï¤Þ¤À¤¢¤ê¤Þ¤»¤ó¡£';
$messages['logout_message'] = '¥í¥°¥¢¥¦¥È¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['logout_message_2'] = '<a href="%1$s">¤³¤³¤ò¥¯¥ê¥Ã¥¯</a>¤¹¤ë¤È¥í¥°¥¤¥ó²èÌÌ¤ËÌá¤ê¤Þ¤¹¡£';
$messages['error_access_forbidden'] = '¥¢¥¯¥»¥¹¤¬µö²Ä¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£Àè¤Ë¥í¥°¥¤¥ó¤·¤Æ²¼¤µ¤¤¡£';
$messages['username'] = '¥æ¡¼¥¶¡¼Ì¾';
$messages['password'] = '¥Ñ¥¹¥ï¡¼¥É';

// dashboard
$messages['dashboard'] = '¥À¥Ã¥·¥å¥Ü¡¼¥É';
$messages['recent_articles'] = 'ºÇ¿·µ­»ö';
$messages['recent_comments'] = 'ºÇ¿·¥³¥á¥ó¥È';
$messages['recent_trackbacks'] = 'ºÇ¿·Trackback';
$messages['blog_statistics'] = 'BlogÅý·×¥Ç¡¼¥¿';
$messages['total_posts'] = 'µ­»ö';
$messages['total_comments'] = '¥³¥á¥ó¥È';
$messages['total_trackbacks'] = 'Trackback';
$messages['total_viewed'] = 'µ­»ö±ÜÍ÷';
$messages['in'] = 'In';

// menu options
$messages['newPost'] = 'µ­»öÄÉ²Ã';
$messages['Manage'] = 'µ­»ö´ÉÍý';
$messages['managePosts'] = 'µ­»ö¡õ¥«¥Æ¥´¥ê´ÉÍý';
$messages['editPosts'] = 'µ­»ö¥ê¥¹¥È';
$messages['editArticleCategories'] = '¥«¥Æ¥´¥ê¥ê¥¹¥È';
$messages['newArticleCategory'] = '¥«¥Æ¥´¥êÄÉ²Ã';
$messages['manageLinks'] = '¥ê¥ó¥¯´ÉÍý';
$messages['editLinks'] = '¥ê¥ó¥¯';
$messages['newLink'] = '¥ê¥ó¥¯ÄÉ²Ã';
$messages['editLink'] = '¥ê¥ó¥¯ÊÔ½¸';
$messages['editLinkCategories'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê';
$messages['newLinkCategory'] = '¥ê¥ó¥¯¥«¥Æ¥´¥êÄÉ²Ã';
$messages['editLinkCategory'] = '¥ê¥ó¥¯¥«¥Æ¥´¥êÊÔ½¸';
$messages['manageCustomFields'] = '¥«¥¹¥¿¥à¹àÌÜ´ÉÍý';
$messages['blogCustomFields'] = '¥«¥¹¥¿¥à¹àÌÜ';
$messages['newCustomField'] = '¥«¥¹¥¿¥à¹àÌÜÄÉ²Ã';
$messages['resourceCenter'] = '¥ê¥½¡¼¥¹¥»¥ó¥¿¡¼';
$messages['resources'] = '¥ê¥½¡¼¥¹°ìÍ÷';
$messages['newResourceAlbum'] = '¥¢¥ë¥Ð¥àÄÉ²Ã';
$messages['newResource'] = '¥ê¥½¡¼¥¹ÄÉ²Ã';
$messages['controlCenter'] = '¥³¥ó¥È¥í¡¼¥ë¥»¥ó¥¿¡¼';
$messages['manageSettings'] = '°ìÈÌÀßÄê';
$messages['blogSettings'] = 'BlogÀßÄê';
$messages['userSettings'] = '¥æ¡¼¥¶¡¼ÀßÄê';
$messages['pluginCenter'] = '¥×¥é¥°¥¤¥ó¥»¥ó¥¿¡¼';
$messages['Stats'] = 'Åý·×';
$messages['manageBlogUsers'] = 'Blog¥æ¡¼¥¶¡¼´ÉÍý';
$messages['newBlogUser'] = 'Blog¥æ¡¼¥¶¡¼ÄÉ²Ã';
$messages['showBlogUsers'] = 'Blog¥æ¡¼¥¶¡¼¥ê¥¹¥È';
$messages['manageBlogTemplates'] = 'Blog ¥Æ¥ó¥×¥ì¡¼¥È';
$messages['newBlogTemplate'] = 'Blog¥Æ¥ó¥×¥ì¡¼¥ÈÄÉ²Ã';
$messages['blogTemplates'] = 'Blog¥Æ¥ó¥×¥ì¡¼¥È';
$messages['adminSettings'] = '¥µ¥¤¥È´ÉÍý';
$messages['Users'] = '¥æ¡¼¥¶¡¼´ÉÍý';
$messages['createUser'] = '¥æ¡¼¥¶¡¼ÄÉ²Ã';
$messages['editSiteUsers'] = '¥æ¡¼¥¶¡¼¥ê¥¹¥È';
$messages['Blogs'] = 'Blog´ÉÍý';
$messages['createBlog'] = 'BlogÄÉ²Ã';
$messages['editSiteBlogs'] = 'Blog¥ê¥¹¥È';
$messages['Locales'] = '¸À¸ì´ÉÍý';
$messages['newLocale'] = '¸À¸ìÄÉ²Ã';
$messages['siteLocales'] = '¸À¸ì¥ê¥¹¥È';
$messages['Templates'] = '¥Æ¥ó¥×¥ì¡¼¥È´ÉÍý';
$messages['newTemplate'] = '¥Æ¥ó¥×¥ì¡¼¥ÈÄÉ²Ã';
$messages['siteTemplates'] = '¥Æ¥ó¥×¥ì¡¼¥È¥ê¥¹¥È';
$messages['GlobalSettings'] = '¥·¥¹¥Æ¥à´ÉÍý';
$messages['editSiteSettings'] = '¥µ¥¤¥ÈÀßÄê';
$messages['summarySettings'] = '¥µ¥Þ¥ê¡¼';
$messages['templateSettings'] = '¥Æ¥ó¥×¥ì¡¼¥È';
$messages['urlSettings'] = 'URL';
$messages['emailSettings'] = 'E-Mail';
$messages['uploadSettings'] = '¥¢¥Ã¥×¥í¡¼¥É';
$messages['helpersSettings'] = 'Êä½õ¥Ä¡¼¥ë';
$messages['interfacesSettings'] = '¥¤¥ó¥¿¡¼¥Õ¥§¥¤¥¹';
$messages['securitySettings'] = '¥»¥­¥å¥ê¥Æ¥£';
$messages['bayesianSettings'] = 'Bayesian¥Õ¥£¥ë¥¿';
$messages['resourcesSettings'] = '¥ê¥½¡¼¥¹';
$messages['searchSettings'] = '¸¡º÷';
$messages['cleanUpSection'] = '¥¯¥ê¡¼¥ó¥¢¥Ã¥×';
$messages['cleanUp'] = '¥¯¥ê¡¼¥ó¥¢¥Ã¥×';
$messages['editResourceAlbum'] = '¥¢¥ë¥Ð¥àÊÔ½¸';
$messages['resourceInfo'] = '¥ê¥½¡¼¥¹ÊÔ½¸';
$messages['editBlog'] = 'BlogÊÔ½¸';
$messages['Logout'] = '¥í¥°¥¢¥¦¥È';

// new post
$messages['topic'] = '¥È¥Ô¥Ã¥¯';
$messages['topic_help'] = 'µ­»ö¤ÎÂêÌ¾';
$messages['text'] = 'µ­»öÆâÍÆ';
$messages['text_help'] = 'µ­»ö¤ÎÆâÍÆ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£¤³¤ÎÆâÍÆ¤Ï¾ï¤Ë¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£';
$messages['extended_text'] = 'ÄÉ²ÃÆâÍÆ';
$messages['extended_text_help'] = '(¥ª¥×¥·¥ç¥ó)µ­»ö¤ÎÄÉ²ÃÆâÍÆ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£¤³¤ÎÆâÍÆ¤Ïµ­»ö¥Ú¡¼¥¸¤ä¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨¤µ¤»¤ë¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£¾ÜºÙ¤ÏBlogÀßÄê¤ò¤´Í÷²¼¤µ¤¤¡£';
$messages['post_slug'] = 'Slug';
$messages['post_slug_help'] = 'Permanent Link¤òÈ¯¹Ô¤¹¤ëºÝ¤Ë»ÈÍÑ';
$messages['date'] = 'ÆüÉÕ';
$messages['post_date_help'] = '¤³¤Îµ­»ö¤Î¸ø³«Æü';
$messages['status'] = '¥¹¥Æ¡¼¥¿¥¹';
$messages['post_status_help'] = '¥¹¥Æ¡¼¥¿¥¹¤òÁªÂò¤·¤Æ²¼¤µ¤¤';
$messages['post_status_published'] = '¸ø³«';
$messages['post_status_draft'] = '¥É¥é¥Õ¥È';
$messages['post_status_deleted'] = 'ºï½üºÑ¤ß';
$messages['categories'] = '¥«¥Æ¥´¥ê';
$messages['post_categories_help'] = 'ºÇÄã1·ï°Ê¾å¤Î¥«¥Æ¥´¥ê¤òÁªÂò¤·¤Æ²¼¤µ¤¤';
$messages['post_comments_enabled_help'] = '¥³¥á¥ó¥È¤òµö²Ä¤¹¤ë';
$messages['send_notification_help'] = '¿·Ãå¥³¥á¥ó¥È¤òÄÌÃÎ¤¹¤ë';
$messages['send_trackback_pings_help'] = 'TrackbackÁ÷¿®';
$messages['send_xmlrpc_pings_help'] = 'XMLRPC Ping Á÷¿®';
$messages['save_draft_and_continue'] = '¥É¥é¥Õ¥ÈÊÝÂ¸';
$messages['preview'] = '¥×¥ì¥Ó¥å¡¼';
$messages['add_post'] = 'ÄÉ²Ã';
$messages['error_saving_draft'] = '¥É¥é¥Õ¥ÈÊÝÂ¸Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['draft_saved_ok'] = '¥É¥é¥Õ¥È¤ÎÊÝÂ¸¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_sending_request'] = '¥ê¥¯¥¨¥¹¥ÈÁ÷¿®Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_no_category_selected'] = 'ºÇÄã1·ï°Ê¾å¤Î¥«¥Æ¥´¥ê¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_missing_post_topic'] = 'µ­»ö¤ÎÂêÌ¾¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_missing_post_text'] = 'µ­»ö¤ÎÆâÍÆ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_adding_post'] = 'µ­»ö¤ÎÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['post_added_not_published'] = 'µ­»ö¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¤¬Èó¸ø³«¤Î¾õÂÖ¤Ç¤¹¡£';
$messages['post_added_ok'] = 'µ­»ö¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['send_notifications_ok'] = '¿·Ãå¥³¥á¥ó¥È/Trackback¤¬¤¢¤ëÅÙ¤ËÄÌÃÎ¤¬Á÷¿®¤µ¤ì¤Þ¤¹¡£';

// send trackbacks
$messages['error_sending_trackbacks'] = '°Ê²¼¤ÎTrackbackÁ÷¿®Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿';
$messages['send_trackbacks_help'] = 'Trackback Ping¤òÁ÷¿®¤¹¤ëURL¤òÁª»ØÄê¤·¤Æ²¼¤µ¤¤¡£¤Þ¤¿¡¢¤½¤Î¥µ¥¤¥È¤¬Trackback¤ò¥µ¥Ý¡¼¥È¤·¤Æ¤¤¤ë¤«¤´³ÎÇ§¤¯¤À¤µ¤¤¡£';
$messages['send_trackbacks'] = 'TrackbackÁ÷¿®';
$messages['ping_selected'] = 'Ping ÁªÂò';
$messages['trackbacks_sent_ok'] = '»ØÄê¤ÎURL¤ØTrackback¤ÎÁ÷¿®¤¬´°Î»¤·¤Þ¤·¤¿';

// posts page
$messages['show_by'] = '¸¡º÷¾ò·ï';
$messages['category'] = '¥«¥Æ¥´¥ê';
$messages['author'] = 'Åê¹Æ¼Ô';
$messages['post_status_all'] = 'Á´¤Æ';
$messages['author_all'] = 'Á´¤Æ';
$messages['search_terms'] = '¸¡º÷¥­¡¼¥ï¡¼¥É';
$messages['show'] = '¸¡º÷';
$messages['delete'] = 'ºï½ü';
$messages['actions'] = 'Áàºî';
$messages['all'] = 'Á´¤Æ';
$messages['category_all'] = 'Á´¤Æ';
$messages['error_incorrect_article_id'] = 'µ­»ö¤Ï¸«¤Ä¤«¤ê¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_deleting_article'] = 'µ­»ö "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['article_deleted_ok'] = 'µ­»ö "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['articles_deleted_ok'] = 'µ­»ö %s ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_article2'] = '"%s"·ï¤Îµ­»ö¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// edit post page
$messages['update'] = '¹¹¿·';
$messages['editPost'] = 'µ­»ö¤ÎÊÔ½¸';
$messages['error_fetching_post'] = 'µ­»ö¤Î¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['post_updated_ok'] = 'µ­»ö "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_updating_post'] = 'µ­»ö¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['notification_added'] = '¿·¤·¤¤¥³¥á¥ó¥È/Trackback¤¬¤¢¤Ã¤¿ºÝ¤Ë¤ÏÄÌÃÎ¤¬Á÷¿®¤µ¤ì¤Þ¤¹¡£';
$messages['notification_removed'] = '¿·¤·¤¤¥³¥á¥ó¥È/Trackback¤¬¤¢¤Ã¤Æ¤âÄÌÃÎ¤òÁ÷¿®¤·¤Þ¤»¤ó¡£';

// post comments
$messages['url'] = 'URL';
$messages['comment_status_all'] = 'Á´¤Æ';
$messages['comment_status_spam'] = '¥¹¥Ñ¥à';
$messages['comment_status_nonspam'] = 'Èó¥¹¥Ñ¥à';
$messages['error_fetching_comments'] = '¥³¥á¥ó¥È¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_comments'] = '¥³¥á¥ó¥È¤¬ºï½ü¤µ¤ì¤Æ¤¤¤Ê¤¤¤Þ¤¿¤Ï¥³¥á¥ó¥Èºï½üÃæ¤Ë¥¨¥é¡¼È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['comment_deleted_ok'] = '¥³¥á¥ó¥È "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['comments_deleted_ok'] = '%s ·ï¤Î¥³¥á¥ó¥È¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_comment'] = '¥³¥á¥ó¥È "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_comment2'] = 'ID %s ¤Î¥³¥á¥ó¥Èºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['editComments'] = '¥³¥á¥ó¥È';
$messages['mark_as_spam'] = '¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯';
$messages['mark_as_no_spam'] = 'Èó¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯';
$messages['error_incorrect_comment_id'] = '¥³¥á¥ó¥ÈID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_marking_comment_as_spam'] = '»ØÄê¤Î¥³¥á¥ó¥È¤ò¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['comment_marked_as_spam_ok'] = '»ØÄê¤Î¥³¥á¥ó¥È¤ò¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯¤·¤Þ¤·¤¿¡£';
$messages['error_marking_comment_as_nonspam'] = '»ØÄê¤Î¥³¥á¥ó¥È¤òÈó¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['comment_marked_as_nonspam_ok'] = '»ØÄê¤Î¥³¥á¥ó¥È¤òÈó¥¹¥Ñ¥à¤Ë¥Þ¡¼¥¯¤·¤Þ¤·¤¿¡£';

// post trackbacks
$messages['blog'] = 'Blog';
$messages['excerpt'] = 'Excerpt';
$messages['error_fetching_trackbacks'] = 'Trackback¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_trackbacks'] = 'Trackback¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Ê¤¤¤«Trackbackºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_trackback'] = 'Trackback "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_trackback2'] = 'ID "%s" ¤ÎTrackbackºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['trackback_deleted_ok'] = 'Trackback "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['trackbacks_deleted_ok'] = '%s ·ï¤ÎTrackback¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['editTrackbacks'] = 'Trackback';

// post statistics
$messages['referrer'] = '¥ê¥Õ¥¡¥é¡¼';
$messages['hits'] = '¥Ò¥Ã¥È';
$messages['error_no_items_selected'] = 'ºï½ü¤¹¤ë¥¢¥¤¥Æ¥à¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$messages['error_deleting_referrer'] = '¥ê¥Õ¥¡¥é¡¼ "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_referrer2'] = 'ID"%s"¤Î¥ê¥Õ¥¡¥é¡¼ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['referrer_deleted_ok'] = '¥ê¥Õ¥¡¥é¡¼ "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['referrers_deleted_ok'] = '%s ·ï¤Î¥ê¥Õ¥¡¥é¡¼ ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// categories
$messages['posts'] = 'µ­»ö';
$messages['show_in_main_page'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨';
$messages['error_incorrect_category_id'] = '¥«¥Æ¥´¥ê¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_category_has_articles'] = '¥«¥Æ¥´¥ê "%s" ¤Ë¤Ï¸½ºßµ­»ö¤¬¤¢¤ë¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£¥«¥Æ¥´¥êÆâ¤Îµ­»ö¤ò°ÜÆ°/ºï½ü¤·¤Æ¤«¤éºï½ü¤ò¹Ô¤Ã¤Æ²¼¤µ¤¤¡£';
$messages['category_deleted_ok'] = '¥«¥Æ¥´¥ê "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['categories_deleted_ok'] = '%s ·ï¤Î¥«¥Æ¥´¥ê¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_category'] = '¥«¥Æ¥´¥ê "%s" ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_category2'] = '¥«¥Æ¥´¥ê "%s" ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['yes'] = '¤Ï¤¤';
$messages['no'] = '¤¤¤¤¤¨';

// new category
$messages['name'] = 'Ì¾Á°';
$messages['category_name_help'] = '¥«¥Æ¥´¥ê¤ÎÌ¾Á°';
$messages['description'] = '¾ÜºÙ';
$messages['category_description_help'] = '¥«¥Æ¥´¥ê¤Î¾ÜºÙÀâÌÀ';
$messages['show_in_main_page_help'] = '¤³¤Î¥«¥Æ¥´¥ê°Ê²¼¤Îµ­»ö¤ò¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë(¥Á¥§¥Ã¥¯¤ò³°¤¹¤È¤³¤Î¥«¥Æ¥´¥ê¤¬¥Ö¥é¥¦¥º¤µ¤ì¤¿»þ¤Î¤ßµ­»ö¤òÉ½¼¨)';
$messages['error_empty_name'] = '¥«¥Æ¥´¥êÌ¾¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_empty_description'] = '¥«¥Æ¥´¥ê¾ÜºÙ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_adding_article_category'] = '¥«¥Æ¥´¥êÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£¥Ç¡¼¥¿¤ò³ÎÇ§¤·ºÆÅÙÄÉ²Ã¤ò¹Ô¤Ã¤Æ²¼¤µ¤¤¡£';
$messages['category_added_ok'] = '¥«¥Æ¥´¥ê "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿';
$messages['add'] = 'ÄÉ²Ã';
$messages['reset'] = '¥ê¥»¥Ã¥È';

// update category
$messages['error_updating_article_category'] = '¥«¥Æ¥´¥ê¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_fetching_category'] = '¥«¥Æ¥´¥ê¤Î¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['article_category_updated_ok'] = '¥«¥Æ¥´¥ê "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// links
$messages['feed'] = 'Feed';
$messages['error_no_links_selected'] = '¥ê¥ó¥¯¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Ê¤¤¤«¥ê¥ó¥¯ID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_incorrect_link_id'] = '¥ê¥ó¥¯ID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_removing_link'] = '¥ê¥ó¥¯ "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_removing_link2'] = 'ID "%s" ¤Î¥ê¥ó¥¯ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['link_deleted_ok'] = '¥ê¥ó¥¯ "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['links_deleted_ok'] = '%s ·ï¤Î¥ê¥ó¥¯ºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// new link
$messages['link_name_help'] = '¤³¤Î¥ê¥ó¥¯¤ÎÌ¾Á°';
$messages['link_url_help'] = '¤³¤Î¥ê¥ó¥¯¤ÎURL';
$messages['link_description_help'] = '¤³¤Î¥ê¥ó¥¯¤Î¾ÜºÙ';
$messages['link_feed_help'] = '¤³¤Î¥ê¥ó¥¯¤ÎRSS¤äAtom Feed¤âÆþÎÏ²ÄÇ½¤Ç¤¹¡£';
$messages['link_category_help'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_adding_link'] = '¥ê¥ó¥¯¤ÎÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['error_invalid_url'] = 'URL¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['link_added_ok'] = 'Link "%s" was ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// update link
$messages['error_updating_link'] = '¥ê¥ó¥¯¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['error_fetching_link'] = '¥ê¥ó¥¯¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['link_updated_ok'] = '¥ê¥ó¥¯ "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// link categories
$messages['links'] = '¥ê¥ó¥¯';
$messages['error_invalid_link_category_id'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Ê¤¤¤«¥ê¥ó¥¯ID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_links_in_link_category'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê "%s" ¤Ë¤Ï¥ê¥ó¥¯¤¬¤¢¤ë¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£Àè¤ËÃæ¤Î¥ê¥ó¥¯¤ò°ÜÆ°¤µ¤»¤Æ¤«¤éºï½ü¤ò¹Ô¤Ã¤Æ²¼¤µ¤¤¡£';
$messages['error_removing_link_category'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['link_category_deleted_ok'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['link_categories_deleted_ok'] = '%s ·ï¤Î¥ê¥ó¥¯¥«¥Æ¥´¥ê¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_removing_link_category2'] = 'ID "%s" ¤Î¥ê¥ó¥¯¥«¥Æ¥´¥êºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// new link category
$messages['link_category_name_help'] = '¤³¤Î¥ê¥ó¥¯¥«¥Æ¥´¥ê¤ÎÌ¾Á°';
$messages['error_adding_link_category'] = '¥ê¥ó¥¯¥«¥Æ¥´¥êÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['link_category_added_ok'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// edit link category
$messages['error_updating_link_category'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['link_category_updated_ok'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_fetching_link_category'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// custom fields
$messages['type'] = '¥¿¥¤¥×';
$messages['hidden'] = 'ÈóÉ½¼¨';
$messages['fields_deleted_ok'] = '%s ·ï¤Î¥«¥¹¥¿¥à¹àÌÜ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['field_deleted_ok'] = '¥«¥¹¥¿¥à¹àÌÜ "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_field'] = '¥«¥¹¥¿¥à¹àÌÜ "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_field2'] = 'ID "%s" ¤Î¥«¥¹¥¿¥à¹àÌÜºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_incorrect_field_id'] = '¥«¥¹¥¿¥à¹àÌÜID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';

// new custom field
$messages['field_name_help'] = 'µ­»öÆâ¤Ç¤Î¤³¤Î¹àÌÜ¤Î¼±ÊÌÌ¾';
$messages['field_description_help'] = '¤³¤Î¹àÌÜ¾ÜºÙ';
$messages['field_type_help'] = '¹àÌÜ¥¿¥¤¥×¤òÁªÂò';
$messages['field_hidden_help'] = '¤³¤ì¤Ë¥Á¥§¥Ã¥¯¤¹¤ë¤Èµ­»ö¤ÎÄÉ²Ã/ÊÔ½¸»þ¤Ë¹àÌÜ¤ÏÈóÉ½¼¨¤È¤Ê¤ê¤Þ¤¹¡£¤³¤Îµ¡Ç½¤Ï¼ç¤Ë¥×¥é¥°¥¤¥ó¤Ë»ÈÍÑ¤µ¤ì¤Þ¤¹¡£';
$messages['error_adding_custom_field'] = '¥«¥¹¥¿¥à¹àÌÜÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['custom_field_added_ok'] = '¥«¥¹¥¿¥à¹àÌÜ "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['text_field'] = 'Text field';
$messages['text_area'] = 'Text box';
$messages['checkbox'] = 'Checkbox';
$messages['date_field'] = 'Date chooser';

// edit custom field
$messages['error_fetching_custom_field'] = '¥«¥¹¥¿¥à¹àÌÜ¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_updating_custom_field'] = '¥«¥¹¥¿¥à¹àÌÜ¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['custom_field_updated_ok'] = '¥«¥¹¥¿¥à¹àÌÜ "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// resources
$messages['root_album'] = '¥ë¡¼¥È(¥È¥Ã¥×)¥¢¥ë¥Ð¥à';
$messages['num_resources'] = '¥ê¥½¡¼¥¹¿ô';
$messages['total_size'] = '¥µ¥¤¥º¹ç·×';
$messages['album'] = '¥¢¥ë¥Ð¥à';
$messages['error_incorrect_album_id'] = '¥¢¥ë¥Ð¥àID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_base_storage_folder_missing_or_unreadable'] = '¥·¥¹¥Æ¥à¤Ï¥ê¥½¡¼¥¹¤Î¥¤¥ó¥¹¥È¡¼¥ëÀè¥Õ¥©¥ë¥À¤òºîÀ®¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Ç¤·¤¿¡£¤³¤ÎÌäÂê¤Ï¥»¡¼¥Õ¥â¡¼¥É¤ÇPHP¤Î¥¤¥ó¥¹¥È¡¼¥ë¤¬¹Ô¤ï¤ì¤¿¤ê¥Ñ¡¼¥ß¥Ã¥·¥ç¥ó¤¬Àµ¤·¤¯¤Ê¤¤¾ì¹ç¤ËÈ¯À¸¤·¤Þ¤¹¡£¤³¤ì¤ò²ò·è¤¹¤ë¤Ë¤Ï¥Þ¥Ë¥å¥¢¥ë¤Ç°Ê²¼¤Î¥Õ¥©¥ë¥À¤òÄ¾ÀÜºîÀ®¤·¤Æ¤¯¤À¤µ¤¤: <br/><br/>%s<br/><br/>¤³¤Î¥Õ¥©¥ë¥À¤¬´û¤ËÂ¸ºß¤¹¤ë¾ì¹ç¤Ï¡¢¥¦¥§¥Ö¥µ¡¼¥Ð¡¼¼Â¹Ô¼Ô¤Î¥æ¡¼¥¶¡¼¤¬ÆÉ¤à/½ñ¤¯¤ò¼Â¹Ô¤Ç¤­¤ë¤«¥Ñ¡¼¥ß¥Ã¥·¥ç¥ó¤ò³ÎÇ§¤·¤Æ²¼¤µ¤¤¡£';
$messages['items_deleted_ok'] = '%s items ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_album_has_children'] = '¥¢¥ë¥Ð¥à "%s" Æâ¤Ë¥¢¥ë¥Ð¥à¤¬Â¸ºß¤·¤Þ¤¹¡£Ãæ¤Î¥¢¥ë¥Ð¥à¤ò°ÜÆ°¤µ¤»¤Æ¤«¤éºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['item_deleted_ok'] = 'Item "%s"¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_album'] = '¥¢¥ë¥Ð¥à "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_album2'] = 'ID "%s" ¤Î¥¢¥ë¥Ð¥à¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_resource'] = '¥ê¥½¡¼¥¹ "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_resource2'] = 'ID "%s" ¤Î¥ê¥½¡¼¥¹ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_no_resources_selected'] = 'ºï½ü¤¹¤ë¥ê¥½¡¼¥¹¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$messages['resource_deleted_ok'] = '¥ê¥½¡¼¥¹ "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['album_deleted_ok'] = '¥¢¥ë¥Ð¥à "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['add_resource'] = '¥ê¥½¡¼¥¹ÄÉ²Ã';
$messages['add_resource_preview'] = '¥×¥ì¥Ó¥å¡¼ÄÉ²Ã';
$messages['add_resource_medium'] = '¥ß¥Ç¥£¥¢¥à¥×¥ì¥Ó¥å¡¼ÄÉ²Ã';
$messages['add_album'] = '¥¢¥ë¥Ð¥àÄÉ²Ã';

// new album
$messages['album_name_help'] = 'ÄÉ²Ã¤¹¤ë¥¢¥ë¥Ð¥à¤ÎÌ¾Á°';
$messages['parent'] = '¿Æ¥¢¥ë¥Ð¥à';
$messages['no_parent'] = '¿Æ¥¢¥ë¥Ð¥àÌµ¤·';
$messages['parent_album_help'] = '¥¢¥ë¥Ð¥àÆâ¤Ë¥¢¥ë¥Ð¥à¤òÄÉ²Ã¤·¡¢¥Õ¥¡¥¤¥ë¤ÎÀ°Íý¤ò¹Ô¤¦¤³¤È¤¬²ÄÇ½¤Ç¤¹';
$messages['album_description_help'] = '¤³¤Î¥¢¥ë¥Ð¥à¤Î¾ÜºÙ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤';
$messages['error_adding_album'] = '¥¢¥ë¥Ð¥àÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£¥Ç¡¼¥¿¤ò³ÎÇ§¤·ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['album_added_ok'] = '¥¢¥ë¥Ð¥à "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// edit album
$messages['error_incorrect_album_id'] = '¥¢¥ë¥Ð¥àID¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_fetching_album'] = '¥¢¥ë¥Ð¥à¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_updating_album'] = '¥¢¥ë¥Ð¥à¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['album_updated_ok'] = '¥¢¥ë¥Ð¥à "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['show_album_help'] = '¤³¤Î¥Á¥§¥Ã¥¯¤ò³°¤¹¤ÈBlog¤Ë¤¢¤ë¥¢¥ë¥Ð¥à¤È¤·¤ÆÉ½¼¨¤µ¤ì¤Þ¤»¤ó¡£';

// new resource
$messages['file'] = '¥Õ¥¡¥¤¥ë';
$messages['resource_file_help'] = '¸½ºß¤ÎBlog¤Ë¥Õ¥¡¥¤¥ë¤¬ÄÉ²Ã¤µ¤ì¤Þ¤¹¡£Ê£¿ô¤Î¥Õ¥¡¥¤¥ë¤ò°ìÅÙ¤Ë¥¢¥Ã¥×¥í¡¼¥É¤¹¤ë¾ì¹ç¤Ï"¹àÌÜÄÉ²Ã"¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£';
$messages['add_field'] = '¹àÌÜÄÉ²Ã';
$messages['resource_description_help'] = '¤³¤Î¥Õ¥¡¥¤¥ë¤Î¾ÜºÙ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['resource_album_help'] = '¤³¤Î¥Õ¥¡¥¤¥ë¤òÄÉ²Ã¤¹¤ë¥¢¥ë¥Ð¥à¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_no_resource_uploaded'] = '¥¢¥Ã¥×¥í¡¼¥É¤¹¤ë¥Õ¥¡¥¤¥ë¤¬ÁªÂò¤µ¤ì¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['resource_added_ok'] = '¥ê¥½¡¼¥¹ "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_resource_forbidden_extension'] = '¶Ø»ß¥¿¥¤¥×¤Î¤¿¤á¥Õ¥¡¥¤¥ë¤ÏÄÉ²Ã¤µ¤ì¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_resource_too_big'] = '¥Õ¥¡¥¤¥ë¤¬Âç¤­¤¹¤®¤ë¤¿¤áÄÉ²Ã¤µ¤ì¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_uploads_disabled'] = '¥¢¥Ã¥×¥í¡¼¥Éµ¡Ç½¤ÏÄä»ßÃæ¤Î¤¿¤á¥Õ¥¡¥¤¥ë¤ÏÄÉ²Ã¤µ¤ì¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_quota_exceeded'] = '¥ê¥½¡¼¥¹ÍÆÎÌÀ©¸Â¤òÄ¶¤¨¤Æ¤¤¤ë¤¿¤á¥Õ¥¡¥¤¥ë¤ÏÄÉ²Ã¤µ¤ì¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_adding_resource'] = '¥ê¥½¡¼¥¹¥Õ¥¡¥¤¥ëÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// edit resource
$messages['editResource'] = '¥ê¥½¡¼¥¹ÊÔ½¸';
$messages['resource_information_help'] = '°Ê²¼¤Ï¤³¤Î¥ê¥½¡¼¥¹¥Õ¥¡¥¤¥ë¤Î¾ðÊó¤Ç¤¹';
$messages['information'] = '¾ðÊó';
$messages['size'] = '¥µ¥¤¥º';
$messages['format'] = '·Á¼°';
$messages['dimensions'] = '²£ x ½Ä';
$messages['bits_per_sample'] = '¥Ó¥Ã¥È/¥Ô¥¯¥»¥ë';
$messages['sample_rate'] = '¥µ¥ó¥×¥ë¥ì¡¼¥È';
$messages['number_of_channels'] = '¥Á¥ã¥ó¥Í¥ë¿ô';
$messages['legnth'] = 'Ä¹¤µ';
$messages['thumbnail_format'] = '¥µ¥à¥Í¥¤¥ë·Á¼°';
$messages['regenerate_preview'] = '¥×¥ì¥Ó¥å¡¼¤ÎºÆÀ¸À®';
$messages['error_fetching_resource'] = '¥ê¥½¡¼¥¹¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_updating_resource'] = '¥ê¥½¡¼¥¹¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['resource_updated_ok'] = '¥ê¥½¡¼¥¹ "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// blog settings
$messages['blog_link'] = 'Blog¤ÎURL';
$messages['blog_link_help'] = '¤³¤ÎBlog¤ÎPermanent¥ê¥ó¥¯';
$messages['blog_name_help'] = '¤³¤ÎBlog¤ÎÌ¾Á°';
$messages['blog_description_help'] = '¤³¤ÎBlog¤Ë¤Ä¤¤¤Æ¤ÎÀâÌÀ';
$messages['language'] = '¸À¸ì';
$messages['blog_language_help'] = '¤³¤ÎBlog¤Î¸ø³«¥Ú¡¼¥¸¤È´ÉÍý²èÌÌ¤Ç»ÈÍÑ¤¹¤ë¸À¸ì';
$messages['max_main_page_items'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤Îµ­»ö¿ô';
$messages['max_main_page_items_help'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤Ë¾ï¤ËÉ½¼¨¤µ¤»¤ëµ­»ö¿ô';
$messages['max_recent_items'] = 'ºÇ¿·µ­»ö¿ô';
$messages['max_recent_items_help'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ÇºÇ¿·¤È¤·¤ÆÉ½¼¨¤µ¤»¤ëºÇ¹âµ­»ö¿ô';
$messages['template'] = '¥Æ¥ó¥×¥ì¡¼¥È';
$messages['choose'] = '°ìÍ÷';
$messages['blog_template_help'] = '¤¢¤Ê¤¿¤ÎBlog¤Î¥Æ¥ó¥×¥ì¡¼¥È¥Ç¥¶¥¤¥ó¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£¤³¤Î¥ê¥¹¥È¤Ë¤Ï¥°¥í¡¼¥Ð¥ë¥Æ¥ó¥×¥ì¡¼¥È¤È¤³¤ÎBlogÍÑ¤Ë¥¤¥ó¥¹¥È¡¼¥ë¤µ¤ì¤Æ¤¤¤ë¥Æ¥ó¥×¥ì¡¼¥È¤¬´Þ¤Þ¤ì¤Æ¤¤¤Þ¤¹¡£';
$messages['use_read_more'] = 'µ­»öÆâ¤Ç"Â³¤­..."¥ê¥ó¥¯¤ò»ÈÍÑ';
$messages['use_read_more_help'] = '¤³¤ì¤òÍ­¸ú¤Ë¤¹¤ë¤È"µ­»öÆâÍÆ"¤Î¤ß¤¬É½¼¨¤µ¤ì¡¢¤½¤Î²¼¤Ë"ÄÉ²ÃÆâÍÆ"¤Ø¤Î"Â³¤­..."¥ê¥ó¥¯¤¬ÄÉ²Ã¤µ¤ì¤Þ¤¹¡£';
$messages['enable_wysiwyg'] = '¥Ó¥¸¥å¥¢¥ë¥¨¥Ç¥£¥¿¡¼»ÈÍÑ';
$messages['enable_wysiwyg_help'] = 'Internet Explorer 5.5°Ê¾å/Mozilla 1.3°Ê¾å¤Î¥Ö¥é¥¦¥¶¤Ç»ÈÍÑ²ÄÇ½¤ÊHTML¥Þ¡¼¥¯¥¢¥Ã¥×¤Î¥Ó¥¸¥å¥¢¥ë¥¨¥Ç¥£¥¿¡¼¤Ç¤¹¡£';
$messages['enable_comments'] = '¥³¥á¥ó¥È¤òµö²Ä';
$messages['enable_comments_help'] = 'Á´¤Æ¤Îµ­»ö¤ËÂÐ¤¹¤ë¥³¥á¥ó¥È¤ò¥Ç¥Õ¥©¥ë¥È¤Çµö²Ä¤·¤Þ¤¹¡£ÆÃÄê¤Îµ­»ö¤ËÂÐ¤¹¤ë¥³¥á¥ó¥È¤Îµö²Ä/¶Ø»ß¤Ïµ­»ö¤ÎºîÀ®/ÊÔ½¸»þ¤ËÀßÄê²ÄÇ½¤Ç¤¹¡£';
$messages['show_future_posts'] = 'Futureµ­»ö¤ò¥«¥ì¥ó¥À¡¼Æâ¤ËÉ½¼¨';
$messages['show_future_posts_help'] = 'ÆüÉÕ¤¬¸½ºß¤è¤ê¤âÀè(Ì¤Íè)¤Ë¤Ê¤Ã¤Æ¤¤¤ëµ­»ö¤ò¥«¥ì¥ó¥À¡¼Æâ¤ËÉ½¼¨¤·¥æ¡¼¥¶¡¼¤Ë¸ø³«¤·¤Þ¤¹¡£';
$messages['comments_order'] = '¥³¥á¥ó¥È¤Î½ç½ø';
$messages['comments_order_help'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥³¥á¥ó¥È¤Î½ç½øÀßÄê¤Ç¤¹¡£';
$messages['oldest_first'] = '¸Å¤¤¤â¤Î¤«¤é';
$messages['newest_first'] = '¿·¤·¤¤¤â¤Î¤«¤é';
$messages['categories_order'] = '¥«¥Æ¥´¥ê¤Î½ç½ø';
$messages['categories_order_help'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥«¥Æ¥´¥ê¤Î½ç½øÀßÄê¤Ç¤¹¡£';
$messages['most_recent_updated_first'] = 'ºÇ¶á¹¹¿·¤µ¤ì¤¿¤â¤Î¤«¤é';
$messages['alphabetical_order'] = '¥¢¥ë¥Õ¥¡¥Ù¥Ã¥È½ç';
$messages['reverse_alphabetical_order'] = '¥¢¥ë¥Õ¥¡¥Ù¥Ã¥ÈµÕ½ç';
$messages['most_articles_first'] = 'µ­»ö¤Î·ï¿ô½ç(Â¿¢ª¾¯)';
$messages['link_categories_order'] = '¥ê¥ó¥¯¥«¥Æ¥´¥ê½ç';
$messages['link_categories_order_help'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥ê¥ó¥¯¥«¥Æ¥´¥ê¤Î½ç½øÀßÄê¤Ç¤¹¡£';
$messages['most_links_first'] = '¥ê¥ó¥¯¤Î·ï¿ô½ç(Â¿¢ª¾¯)';
$messages['most_links_last'] = '¥ê¥ó¥¯¤Î·ï¿ô½ç(¾¯¢ªÂ¿)';
$messages['time_offset'] = '¥¿¥¤¥à¥ª¥Õ¥»¥Ã¥È';
$messages['time_offset_help'] = 'Blog¤ÎÆüÉÕ¤È»þ´Ö¤Ë»þº¹¤òÀßÄê¤Ç¤­¤Þ¤¹¡£';
$messages['close'] = '¥¦¥£¥ó¥É¥¦¤òÊÄ¤¸¤ë';
$messages['select'] = 'ÁªÂò';
$messages['error_updating_settings'] = 'BlogÀßÄê¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['error_invalid_number'] = '¿ô»ú¤ÎÆþÎÏ¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_incorrect_time_offset'] = '»þº¹¤ÎÀßÄê¤¬Ìµ¸ú¤Ç¤¹¡£';
$messages['blog_settings_updated_ok'] = 'BlogÀßÄê¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['hours'] = '»þ´Ö';

// user settings
$messages['username_help'] = '¸ø³«¥æ¡¼¥¶¡¼Ì¾¤Ç¤¹¡£(ÊÑ¹¹ÉÔ²Ä)';
$messages['full_name'] = 'Ì¾Á°';
$messages['full_name_help'] = '¤¢¤Ê¤¿¤ÎÌ¾Á°¤Ç¤¹¡£';
$messages['password_help'] = '¥Ñ¥¹¥ï¡¼¥É¤òÊÑ¹¹¤¹¤ë¾ì¹ç¤Ï¿·¤·¤¤¥Ñ¥¹¥ï¡¼¥É¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£ÊÑ¹¹¤·¤Ê¤¤¾ì¹ç¤Ï²¿¤âÆþÎÏ¤·¤Ê¤¤¤Ç²¼¤µ¤¤¡£';
$messages['confirm_password'] = '¥Ñ¥¹¥ï¡¼¥É³ÎÇ§';
$messages['email'] = 'E-Mail';
$messages['email_help'] = 'ÆþÎÏ¤µ¤ì¤¿E-Mail¤ËÄÌÃÎ¤¬Á÷¿®¤µ¤ì¤Þ¤¹¡£';
$messages['bio'] = '¼«¸Ê¾Ò²ð';
$messages['bio_help'] = '¤¢¤Ê¤¿¤Î¼«¸Ê¾Ò²ðÊ¸¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['picture'] = '¼Ì¿¿';
$messages['user_picture_help'] = '¥¢¥Ã¥×¥í¡¼¥ÉºÑ¤ß¤Î²èÁü¤è¤ê¤¢¤Ê¤¿¤Î¸Ä¿Í¼Ì¿¿¤È¤·¤ÆÀßÄê¤¹¤ë²èÁü¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_invalid_password'] = '¥Ñ¥¹¥ï¡¼¥É¤¬Àµ¤·¤¯¤Ê¤¤¤«Ã»¤¹¤®¤Þ¤¹¡£';
$messages['error_passwords_dont_match'] = '¥Ñ¥¹¥ï¡¼¥É¤¬°ìÃ×¤·¤Þ¤»¤ó¡£';
$messages['error_incorrect_email_address'] = 'E-Mail¥¢¥É¥ì¥¹¤ÎÆþÎÏ¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_updating_user_settings'] = '¥æ¡¼¥¶¡¼ÀßÄê¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['user_settings_updated_ok'] = '¥æ¡¼¥¶¡¼ÀßÄê¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['resource'] = '¥ê¥½¡¼¥¹';

// plugin centre
$messages['identifier'] = '¼±ÊÌ (ID)';
$messages['error_plugins_disabled'] = '¸½ºß¥×¥é¥°¥¤¥ó¤Î»ÈÍÑ¤ÏÄä»ßÃæ¤Ç¤¹¡£';

// blog users
$messages['revoke_permissions'] = 'Blog¥æ¡¼¥¶¡¼ºï½ü';
$messages['error_no_users_selected'] = 'Blog¥æ¡¼¥¶¡¼¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$messages['user_removed_from_blog_ok'] = 'Blog¥æ¡¼¥¶¡¼ "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['users_removed_from_blog_ok'] = '%s Blog¥æ¡¼¥¶¡¼¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£¡£';
$messages['error_removing_user_from_blog'] = 'Blog¥æ¡¼¥¶¡¼ "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_removing_user_from_blog2'] = 'ID "%s" ¤ÎBlog¥æ¡¼¥¶¡¼ºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// new blog user
$messages['new_blog_username_help'] = '¤³¤ÎBlog¤Ø¤Î¥¢¥¯¥»¥¹¸¢¸º¤òÍ¿¤¨¤ë¥æ¡¼¥¶¡¼Ì¾¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£(ÄÉ²Ã¤µ¤ì¤¿¥æ¡¼¥¶¡¼¤Ï"µ­»ö´ÉÍý"¤È"¥ê¥½¡¼¥¹"¤Ë¤Î¤ß¥¢¥¯¥»¥¹²ÄÇ½)';
$messages['send_notification'] = 'ÄÌÃÎ¤ÎÁ÷¿®';
$messages['send_user_notification_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤ËÄÌÃÎ¤òÁ÷¿®';
$messages['notification_text'] = 'ÄÌÃÎÆâÍÆ';
$messages['notification_text_help'] = 'ÄÌÃÎ¥á¥Ã¥»¡¼¥¸¤Ë¤³¤ÎÆâÍÆ¤¬É½¼¨¤µ¤ì¤Þ¤¹¡£';
$messages['error_adding_user'] = '¥æ¡¼¥¶¡¼¤Ø¥¢¥¯¥»¥¹¸¢¸Â³äÅöÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['error_empty_text'] = 'ÄÌÃÎÆâÍÆ¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_adding_user'] = 'Blog¥æ¡¼¥¶¡¼ÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['error_invalid_user'] = '¥æ¡¼¥¶¡¼ "%s" ¤ÏÂ¸ºß¤·¤Ê¤¤¤«Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['user_added_to_blog_ok'] = '¤³¤ÎBlog¤Ø¤Î¥æ¡¼¥¶¡¼ "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// blog templates
$messages['error_no_templates_selected'] = '¥Æ¥ó¥×¥ì¡¼¥È¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_template_is_current'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤Ï¸½ºß»ÈÍÑÃæ¤Î¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£';
$messages['error_removing_template'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['template_removed_ok'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['templates_removed_ok'] = '%s ·ï¤Î¥Æ¥ó¥×¥ì¡¼¥È¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// new blog template
$messages['template_installed_ok'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_installing_template'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤Î¥¤¥ó¥¹¥È¡¼¥ëÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_missing_base_files'] = 'Â­¤ê¤Ê¤¤¥Æ¥ó¥×¥ì¡¼¥È¥Õ¥¡¥¤¥ë¤¬¤¤¤¯¤Ä¤«¤¢¤ë¤è¤¦¤Ç¤¹¡£';
$messages['error_add_template_disabled'] = '¤³¤Îµ¡Ç½¤Ï¸½ºßÄä»ßÃæ¤Î¤¿¤á¥Æ¥ó¥×¥ì¡¼¥È¤ÎÄÉ²Ã¤Ï¤Ç¤­¤Þ¤»¤ó¡£';
$messages['error_must_upload_file'] = '¥¢¥Ã¥×¥í¡¼¥É¤µ¤ì¤¿¥Æ¥ó¥×¥ì¡¼¥È¥Ñ¥Ã¥±¡¼¥¸¤Ï¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_uploads_disabled'] = '¥¢¥Ã¥×¥í¡¼¥Éµ¡Ç½¤Ï¸½ºßÄä»ßÃæ¤Ç¤¹¡£';
$messages['error_no_new_templates_found'] = '¿·¤·¤¤¥Æ¥ó¥×¥ì¡¼¥È¤Ï¸«¤Ä¤«¤ê¤Þ¤»¤ó¤Ç¤·¤¿¡£';
$messages['error_template_not_inside_folder'] = '¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥ÈÆâ¤Ç»ÈÍÑ¤µ¤ì¤ë¥Õ¥¡¥¤¥ë¤Ï¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤ÈÆ±¤¸Ì¾Á°¤Î¥Õ¥©¥ë¥ÀÆâ¤ËÃÖ¤¤¤Æ²¼¤µ¤¤¡£';
$messages['error_missing_base_files'] = '´ðËÜ¥Æ¥ó¥×¥ì¡¼¥È¥Õ¥¡¥¤¥ë¤¬·ç¤±¤Æ¤¤¤ë¤è¤¦¤Ç¤¹¡£';
$messages['error_unpacking'] = '¥Õ¥¡¥¤¥ë¤ÎÅ¸³«Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_forbidden_extensions'] = '¥Æ¥ó¥×¥ì¡¼¥È¥Õ¥¡¥¤¥ë¤Ë¶Ø»ß¤µ¤ì¤Æ¤¤¤ë³ÈÄ¥»Ò¤¬´Þ¤Þ¤ì¤Æ¤¤¤Þ¤¹¡£';
$messages['error_creating_working_folder'] = '¥Õ¥¡¥¤¥ë¤òÅ¸³«¤¿¤á¤Î¥Æ¥ó¥Ý¥é¥ê¡¼¥Õ¥©¥ë¥ÀºîÀ®Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_checking_template'] = '¥Æ¥ó¥×¥ì¡¼¥È³ÎÇ§Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿: %s';
$messages['template_package'] = '¥Æ¥ó¥×¥ì¡¼¥È¥Ñ¥Ã¥±¡¼¥¸';
$messages['blog_template_package_help']  = '¤³¤³¤Ç¤Ï¤¢¤Ê¤¿¤ÎBlogÀìÍÑ¤Î¿·µ¬¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤ò¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Þ¤¹¡£¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤ò¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Ê¤¤¾ì¹ç¤Ï¡¢¥Þ¥Ë¥å¥¢¥ë¤Ç<b>%s</b>¤Ë¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÄ¾ÀÜ¥¢¥Ã¥×¥í¡¼¥É¤·¡¢"<b>¥Æ¥ó¥×¥ì¡¼¥È¤ò¥¹¥­¥ã¥ó</b>"¥Ü¥¿¥ó¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£¥·¥¹¥Æ¥à¤¬¼«Æ°Åª¤Ë¿·µ¬¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÃµÃÎ¤·¤Þ¤¹¡£';
$messages['scan_templates'] = '¥Æ¥ó¥×¥ì¡¼¥È¤ò¥¹¥­¥ã¥ó';

// site users
$messages['user_status_active'] = 'Í­¸ú';
$messages['user_status_disabled'] = 'Ää»ß';
$messages['user_status_all'] = 'Á´¤Æ';
$messages['user_status_unconfirmed'] = 'Ì¤¾µÇ§';
$messages['error_invalid_user2'] = 'ID "%s" ¤Î¥æ¡¼¥¶¡¼¤ÏÂ¸ºß¤·¤Þ¤»¤ó¡£';
$messages['error_deleting_user'] = '¥æ¡¼¥¶¡¼ "%s" Ää»ßÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['user_deleted_ok'] = '¥æ¡¼¥¶¡¼ "%s" ¤ÎÄä»ß¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['users_deleted_ok'] = '%s ¥æ¡¼¥¶¡¼¤ÎÄä»ß¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// create user
$messages['user_added_ok'] = '¥æ¡¼¥¶¡¼ "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿';
$messages['error_incorrect_username'] = '¤½¤Î¥æ¡¼¥¶¡¼Ì¾¤ÏÀµ¤·¤¯¤Ê¤¤¤«´û¤Ë»ÈÍÑÃæ¤Ç¤¹¡£';
$messages['user_status_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤Î¸½ºß¤Î¥¹¥Æ¡¼¥¿¥¹';
$messages['user_blog_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤Ë³ä¤êÅö¤Æ¤ëBlog';
$messages['none'] = 'Ìµ¤·';

// edit user
$messages['error_invalid_user'] = '¥æ¡¼¥¶¡¼ID¤¬Â¸ºß¤·¤Ê¤¤¤«Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_updating_user'] = '¥æ¡¼¥¶¡¼ÀßÄê¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['blogs'] = 'Blog';
$messages['user_blogs_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤¬¥ª¡¼¥Ê¡¼¤Þ¤¿¤Ï¥¢¥¯¥»¥¹¸¢¸Â¤¬¤¢¤ëBlog';
$messages['site_admin'] = '´ÉÍý¼Ô';
$messages['site_admin_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤Ë´ÉÍý¼Ô¸¢¸Â¤òÍ¿¤¨¡¢"¥µ¥¤¥È´ÉÍý"²èÌÌ¤Ç¤ÎÁàºî¤òµö²Ä';
$messages['user_updated_ok'] = '¥æ¡¼¥¶¡¼ "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// site blogs
$messages['blog_status_all'] = 'Á´¤Æ';
$messages['blog_status_active'] = 'Í­¸ú';
$messages['blog_status_disabled'] = 'Ää»ß';
$messages['blog_status_unconfirmed'] = 'Ì¤¾µÇ§';
$messages['owner'] = '¥ª¡¼¥Ê¡¼';
$messages['quota'] = 'ÍÆÎÌ';
$messages['bytes'] = '¥Ð¥¤¥È';
$messages['error_no_blogs_selected'] = 'Ää»ß¤¹¤ëBlog¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$messages['error_blog_is_default_blog'] = 'Blog "%s" ¤Ï¥Ç¥Õ¥©¥ë¥ÈBlog¤ËÀßÄê¤µ¤ì¤Æ¤¤¤ë¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£';
$messages['blog_deleted_ok'] = 'Blog "%s" ¤ÎÄä»ß¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['blogs_deleted_ok'] = '%s ·ï¤ÎBlog¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_blog'] = 'Blog "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_blog2'] = 'ID "%s" ¤ÎBlogºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';

// create blog
$messages['error_adding_blog'] = 'BlogÄÉ²ÃÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['blog_added_ok'] = 'Blog "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// edit blog
$messages['blog_status_help'] = 'Blog¥¹¥Æ¡¼¥¿¥¹';
$messages['blog_owner_help'] = '¤³¤ÎBlogÀßÄê¤ÎÁ´¥³¥ó¥È¥í¡¼¥ë¤ò¹Ô¤¦¥ª¡¼¥Ê¡¼';
$messages['users'] = '¥æ¡¼¥¶¡¼';
$messages['blog_quota_help'] = '¥ê¥½¡¼¥¹¤ÎÀ©¸ÂÍÆÎÌ¤ò¥Ð¥¤¥È¤Ç»ØÄê¤·¤Æ¤¯¤À¤µ¤¤¡£"0"¤Þ¤¿¤Ï¶õÇò¤Ë¤¹¤ë¤È¥°¥í¡¼¥Ð¥ëÍÆÎÌ¤È¤Ê¤ê¤Þ¤¹¡£';
$messages['blog_users_help'] = '¤³¤ÎBlog¤Ø¤Î¥¢¥¯¥»¥¹¸¢¸Â¤ò³äÅö¤Æ¤ë¥æ¡¼¥¶¡¼¤òº¸¤Î¥ê¥¹¥È¤«¤éÁªÂò¤·¤Æ±¦¤Î¥ê¥¹¥È¤Ø°ÜÆ°¤µ¤»¤ÆÀßÄê¤·¤Æ²¼¤µ¤¤¡£';
$messages['edit_blog_settings_updated_ok'] = 'Blog "%s" ¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_updating_blog_settings'] = 'Blog "%s" ¤Î¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_incorrect_blog_owner'] = 'Blog¥ª¡¼¥Ê¡¼¤È¤·¤ÆÁªÂò¤µ¤ì¤¿¥æ¡¼¥¶¡¼¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['error_fetching_blog'] = 'Blog¤Î¼èÆÀÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_updating_blog_settings2'] = 'Blog¹¹¿·Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['add_or_remove'] = '¥æ¡¼¥¶¡¼ÄÉ²Ã¡¦ºï½ü';

// site locales
$messages['locale'] = '¸À¸ì';
$messages['locale_encoding'] = '¥¨¥ó¥³¡¼¥É';
$messages['locale_deleted_ok'] = '¸À¸ì¥Õ¥¡¥¤¥ë "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_no_locales_selected'] = 'ºï½ü¤¹¤ë¸À¸ì¥Õ¥¡¥¤¥ë¤¬ÁªÂò¤µ¤ì¤Æ¤¤¤Þ¤»¤ó¡£';
$messages['error_deleting_only_locale'] = '¤³¤Î¸À¸ì¥Õ¥¡¥¤¥ë¤òºï½ü¤¹¤ë¤È¡¢¥·¥¹¥Æ¥à¤Ë¸À¸ì¥Õ¥¡¥¤¥ë¤¬°ì¤Ä¤âÌµ¤¤¾õÂÖ¤Ë¤Ê¤Ã¤Æ¤·¤Þ¤¦¤¿¤á¡¢ºï½ü¤Ç¤­¤Þ¤»¤ó¡£';
$messages['locales_deleted_ok']= '¸À¸ì¥Õ¥¡¥¤¥ë %s ¤Îºï½ü¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_deleting_locale'] = '¸À¸ì¥Õ¥¡¥¤¥ë "%s" ¤Îºï½üÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_locale_is_default'] = '¸À¸ì¥Õ¥¡¥¤¥ë "%s" ¤Ï¿·µ¬BlogÍÑ¤Î¥Ç¥Õ¥©¥ë¥È¸À¸ì¤Î¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£';

// add locale
$messages['error_invalid_locale_file'] = '¸À¸ì¥Õ¥¡¥¤¥ë¤¬Ìµ¸ú¤Ç¤¹¡£';
$messages['error_no_new_locales_found'] = '¿·µ¬¸À¸ì¥Õ¥¡¥¤¥ë¤Ï¸«¤Ä¤«¤ê¤Þ¤»¤ó¡£';
$messages['locale_added_ok'] = '¸À¸ì¥Õ¥¡¥¤¥ë "%s" ¤ÎÄÉ²Ã¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_saving_locale'] = '¿·µ¬¸À¸ì¥Õ¥¡¥¤¥ë¤ÎÊÝÂ¸Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['scan_locales'] = '¸À¸ì¥Õ¥¡¥¤¥ë¤ò¥¹¥­¥ã¥ó';
$messages['add_locale_help'] = '¤³¤³¤Ç¤Ï¿·µ¬¸À¸ì¥Õ¥¡¥¤¥ë¤ò¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Þ¤¹¡£¸À¸ì¥Õ¥¡¥¤¥ë¤¬¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Ê¤¤¾ì¹ç¤Ï¡¢¥Þ¥Ë¥å¥¢¥ë¤Ç<b>./locales/</b>¤ÎÃæ¤Ë¸À¸ì¥Õ¥¡¥¤¥ë¤òÄ¾ÀÜ¥¢¥Ã¥×¥í¡¼¥É¤·¡¢"<b>¸À¸ì¥Õ¥¡¥¤¥ë¤ò¥¹¥­¥ã¥ó</b>"¥Ü¥¿¥ó¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£¥·¥¹¥Æ¥à¤¬¼«Æ°Åª¤Ë¿·µ¬¸À¸ì¥Õ¥¡¥¤¥ë¤òÃµÃÎ¤·¤Þ¤¹¡£';

// site templates
$messages['error_template_is_default'] = '¥Æ¥ó¥×¥ì¡¼¥È "%s" ¤Ï¿·µ¬BlogÍÑ¤Î¥Ç¥Õ¥©¥ë¥È¸À¸ì¤Î¤¿¤áºï½ü¤Ç¤­¤Þ¤»¤ó¡£';

// add template
$messages['global_template_package_help'] = '¤³¤³¤Ç¤ÏÁ´BlogÍÑ¤Î¿·µ¬¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤ò¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Þ¤¹¡£¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤ò¥¢¥Ã¥×¥í¡¼¥É¤Ç¤­¤Ê¤¤¾ì¹ç¤Ï¡¢¥Þ¥Ë¥å¥¢¥ë¤Ç<b>%s</b>¤ÎÃæ¤Ë¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÄ¾ÀÜ¥¢¥Ã¥×¥í¡¼¥É¤·¡¢"<b>¥Æ¥ó¥×¥ì¡¼¥È¤ò¥¹¥­¥ã¥ó</b>"¥Ü¥¿¥ó¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£¥·¥¹¥Æ¥à¤¬¼«Æ°Åª¤Ë¿·µ¬¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÃµÃÎ¤·¤Þ¤¹¡£';

// global settings
$messages['site_config_saved_ok'] = '¥µ¥¤¥ÈÀßÄê¤ÎÊÝÂ¸¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['error_saving_site_config'] = '¥µ¥¤¥ÈÀßÄê¤ÎÊÝÂ¸Ãæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
/// general settings
$messages['help_comments_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¿·µ¬Blog¤Î¥³¥á¥ó¥Èµ¡Ç½¤¬¥Ç¥Õ¥©¥ë¥È¤ÇÍ­¸ú¤Ë¤Ê¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_beautify_comments_text'] = 'Í­¸ú¤Ë¤¹¤ë¤ÈÅê¹Æ¤µ¤ì¤¿¥³¥á¥ó¥È¤Ï¼«Æ°Åª¤Ë²þ¹Ô¤µ¤ìURL¤Ë¤Ï¥ê¥ó¥¯¤¬Ä¥¤é¤ì¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_temp_folder'] = '¥³¥ó¥Ñ¥¤¥ëºÑ¤ß¥Æ¥ó¥×¥ì¡¼¥ÈÅù¤Î°ì»þÅª¤Ê¥Ç¡¼¥¿¤ò½ñ¤­¹þ¤à¤¿¤á¤Î¥Õ¥©¥ë¥À¤Ç¤¹¡£¥»¥­¥å¥ê¥Æ¥£¡¼¶¯²½¤Î¤¿¤á¤Ë¥¦¥§¥Ö¥µ¡¼¥Ð¡¼¥Ä¥ê¡¼¤Î³°¤Ë¤¢¤ë¥Õ¥©¥ë¥À¤ò»ØÄê¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ./tmp]';
$messages['help_base_url'] = '¤³¤ÎBlog¤¬¥¤¥ó¥¹¥È¡¼¥ë¤µ¤ì¤ë¥Ù¡¼¥¹URL¤Ë¤Ê¤ê¤Þ¤¹¡£';
$messages['help_subdomains_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¥µ¥Ö¥É¥á¥¤¥ó¤¬»ÈÍÑ¤µ¤ì¤Þ¤¹¡£¾ÜºÙ¤Ï¥µ¥Ö¥É¥á¥¤¥ó¤Ë´Ø¤¹¤ë¥É¥­¥å¥á¥ó¥È¤ò¤´Í÷²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_subdomains_base_url'] = '¥µ¥Ö¥É¥á¥¤¥ó¤òÍ­¸ú¤Ë¤·¤¿¾ì¹ç¡¢base_url¤ÎÂå¤ï¤ê¤Ë¤³¤³¤Ç»ØÄê¤·¤¿¥Ù¡¼¥¹URL¤¬»ÈÍÑ¤µ¤ì¤Þ¤¹¡£BlogÌ¾¤Î¼èÆÀ¤Ï {blogname} ¡¢Blog¥ª¡¼¥Ê¡¼¤Î¥æ¡¼¥¶¡¼Ì¾¤Î¼èÆÀ¤Ï {username} ¤ò»ÈÍÑ¤·¤ÆBlog¤Ø¤Î¥ê¥ó¥¯¤ò¼èÆÀ¤·¤Æ²¼¤µ¤¤¡£ (Îã : http://{blogname}.yourdomain.com})';
$messages['help_include_blog_id_in_url'] = '¥µ¥Ö¥É¥á¥¤¥ó¤È"ÄÌ¾ï¤Î"URL¤¬Í­¸ú¤Ê¾ì¹ç¤ËÆâÉô¼èÆÀURL¤Ë"blogId"¥Ñ¥é¥á¡¼¥¿¡¼¤ò¼èÆÀ¤·¤Ê¤¤¤è¤¦¤ËÀßÄê¤Ç¤­¤Þ¤¹¡£¤³¤Îµ¡Ç½¤ò»ÈÍÑ¤¹¤ëÊý¤Î¤ßÊÑ¹¹¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_script_name'] = 'index.php¤òÂ¾¤ÎÌ¾¾Î¤ËÊÑ¹¹¤¹¤ë¾ì¹ç¤Î¤ßÊÑ¹¹¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = index.php]';
$messages['help_show_posts_max'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨¤µ¤»¤ëµ­»ö¿ô¡£¿·µ¬Blog¤Î¤ßÍ­¸ú¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 15]';
$messages['help_recent_posts_max'] = '¥á¥¤¥ó¥Ú¡¼¥¸¤ËÉ½¼¨¤µ¤»¤ëºÇ¿·µ­»ö¿ô¡£¿·µ¬Blog¤Î¤ßÍ­¸ú¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 10]';
$messages['help_save_drafts_via_xmlhttprequest_enabled'] = 'Javascript¤ÈXmlHttpRequest¤Î¥É¥é¥Õ¥ÈÊÝÂ¸¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_locale_folder'] = '¸À¸ì¥Õ¥¡¥¤¥ë¤¬ÊÝ´É¤µ¤ì¤ë¥Õ¥©¥ë¥À¤Î¾ì½ê¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ./locale]';
$messages['help_default_locale'] = '¿·µ¬Blog¤Î¥Ç¥Õ¥©¥ë¥È¸À¸ì¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = en_UK]';
$messages['help_default_blog_id'] = '¥Ç¥Õ¥©¥ë¥È¤ÇÉ½¼¨¤µ¤ì¤ëBlog¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 1]';
$messages['help_default_time_offset'] = '¿·µ¬Blog¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥¿¥¤¥à¥»¥Ã¥È¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 0]';
$messages['help_html_allowed_tags_in_comments'] = '¥³¥á¥ó¥ÈÆâ¤Ç»ÈÍÑ¤Ç¤­¤ëHTML¥¿¥°¡£(È¾³Ñ¥¹¥Ú¡¼¥¹¤Ç¶èÀÚ¤Ã¤Æ²¼¤µ¤¤¡£) [¥Ç¥Õ¥©¥ë¥È = &lt;a&gt;&lt;i&gt;&lt;br&gt;&lt;br/&gt;&lt;b&gt;]';
$messages['help_referer_tracker_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¥Ç¡¼¥¿¥Ù¡¼¥¹¤Ë¥ê¥Õ¥¡¥é¡¼¤òÊÝÂ¸¤·¤Þ¤¹¡£¥Ñ¥Õ¥©¡¼¥Þ¥ó¥¹¤ò½Å»ë¤¹¤ë¾ì¹ç¤ÏÌµ¸ú¤Ë¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_show_more_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¿·µ¬Blog¤Ç"Â³¤­..."¥ê¥ó¥¯¤ò»ÈÍÑ¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_update_article_reads'] = 'Í­¸ú¤Ë¤¹¤ë¤È´ûÆÉºÑ¤ß¤Îµ­»ö¤Î»þ¹ï¥«¥¦¥ó¥¿¡¼¤ò¹¹¿·¤·¤Þ¤¹¡£¥Ñ¥Õ¥©¡¼¥Þ¥ó¥¹¤ò½Å»ë¤¹¤ë¾ì¹ç¤ÏÌµ¸ú¤Ë¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_update_cached_article_reads'] = 'Í­¸ú¤Ë¤¹¤ë¤È¡¢¥­¥ã¥Ã¥·¥å¤¬¥ª¥ó¤Ë¤Ê¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ç¤â´ûÆÉºÑ¤ß¤Îµ­»ö¤Î»þ¹ï¥«¥¦¥ó¥¿¡¼¤ò¹¹¿·¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_xmlrpc_ping_enabled'] = 'XMLRPC PingÁ÷¿®¤ò¥µ¥Ý¡¼¥È¤·¤Æ¤¤¤ë¥µ¥¤¥È¤ËÂÐ¤·¤Æ¤³¤ì¤òÍ­¸ú¤Ë¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_send_xmlrpc_pings_enabled_by_default'] = 'µ­»ö¤¬ÄÉ²Ã¤µ¤ì¤¿»þ¤äµ­»ö¤¬¹¹¿·¤µ¤ì¤¿»þ¤Ë¤³¤Îµ¡Ç½¤ò¥Ç¥Õ¥©¥ë¥È¤ÇÍ­¸ú¤Ë¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_xmlrpc_ping_hosts'] = 'XMLRPC Ping»ØÄê¤ò¥µ¥Ý¡¼¥È¤·¤Æ¤¤¤ë¥µ¥¤¥È¤ÎXMLRPC¥¤¥ó¥¿¡¼¥Õ¥§¥¤¥¹¤Ø¤ÎURL¡£¹Ô¤´¤È¤Ë1·ï¤ÎURL¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = http://rpc.weblogs.com/RPC2]';
$messages['help_trackback_server_enabled'] = '¥¤¥ó¥«¥ß¥ó¥°¤ÎTrackback¤ò¼õ¤±Æþ¤ì¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_htmlarea_enabled'] = '¿·µ¬Blog¤ÇWYSIWYG¥¨¥Ç¥£¥¿¡¼¤òÍ­¸ú¤Ë¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = Yes';
$messages['help_plugin_manager_enabled'] = '¥×¥é¥°¥¤¥ó¤òÍ­¸ú¤Ë¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_minimum_password_length'] = '¥Ñ¥¹¥ï¡¼¥É¤ÎºÇÄãÊ¸»ú¿ô¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 4]';
$messages['help_xhtml_converter_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¥·¥¹¥Æ¥à¤¬Á´¤Æ¤ÎHTML¥³¡¼¥É¤òÅ¬ÀÚ¤ÊXHTML¥³¡¼¥É¤Ø¥³¥ó¥Ð¡¼¥È¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_xhtml_converter_aggressive_mode_enabled'] = 'Í­¸ú¤Ë¤¹¤ë¤È¥·¥¹¥Æ¥à¤¬Á´¤Æ¤ÎHTML¤ò¤è¤ê½ÅÅÀÅª¤ËXHTML¥³¡¼¥É¤Ø¥³¥ó¥Ð¡¼¥È¤·¤Þ¤¹¤¬¡¢¥¨¥é¡¼¤¬½Ð¤ä¤¹¤¯¤Ê¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_session_save_path'] = 'PHP¥Õ¥¡¥ó¥¯¥·¥ç¥ó session_save_path()¤«¤é¤Î¥»¥Ã¥·¥ç¥ó¥Ç¡¼¥¿¤òÊÝ´É¤¹¤ë¥Õ¥©¥ë¥À¤Î¾ì½ê¤òÊÑ¹¹¤Ç¤­¤Þ¤¹¡£»ØÄê¤Î¥Õ¥©¥ë¥À¤¬¥¦¥§¥Ö¥µ¡¼¥Ð¡¼¤Ë¤è¤ë½ñ¤­¹þ¤ß²ÄÇ½¤Ç¤¢¤ë¤«³ÎÇ§¤·¤Æ¤¯¤À¤µ¤¤¡£PHP\'s¥Ç¥Õ¥©¥ë¥È¥»¥Ã¥·¥ç¥ó¥Õ¥©¥ë¥À¤ò»ÈÍÑ¤¹¤ë¾ì¹ç¤Ï¶õÇò¤Ë¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = (¶õÇò)]';
// summary settings
$messages['help_summary_page_show_max'] = '¥µ¥Þ¥ê¡¼¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥¢¥¤¥Æ¥à(¿·Ãå¤Îµ­»ö¡¢ºÇ¿·¹¹¿·¤ÎBlogÅù)¤Î¿ô¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 10]';
$messages['help_summary_blogs_per_page'] = '"Blog¥ê¥¹¥È"¤ÇÉ½¼¨¤¹¤ë¥Ú¡¼¥¸Ëè¤ÎBlog¤Î¿ô¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 25]';
$messages['help_forbidden_usernames'] = '¥æ¡¼¥¶¡¼ÅÐÏ¿¤òµö²Ä¤·¤Ê¤¤¥æ¡¼¥¶¡¼Ì¾¤òÈ¾³Ñ¥¹¥Ú¡¼¥¹¤Ç¶èÀÚ¤Ã¤ÆÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = admin www blog ftp]';
$messages['help_force_one_blog_per_email_account'] = '1·ï¤ÎE-Mail¤Ë¤Ä¤­1·ï¤ÎBlog¤Î¤ß¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_summary_show_agreement'] = 'ÅÐÏ¿»þ¤Ë¥á¥ó¥Ð¡¼µ¬Ìó¤òÉ½¼¨¤·¡¢µ¬Ìó¤Ø¤ÎÆ±°Õ¤òÅÐÏ¿¾ò·ï¤È¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_need_email_confirm_registration'] = 'ÅÐÏ¿¸å¤Ë¥æ¡¼¥¶¡¼°¸¤Ë¥ê¥ó¥¯¥³¡¼¥É¤ò¥á¡¼¥ëÁ÷¿®¤·¡¢¥æ¡¼¥¶¡¼¤¬¥ê¥ó¥¯¥³¡¼¥É¤ò¥¯¥ê¥Ã¥¯¤·¤ÆÅÐÏ¿¼êÂ³¤­¤ò´°Î»¤È¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_summary_disable_registration'] = '¿·µ¬Blog¤Î¥æ¡¼¥¶¡¼ÅÐÏ¿¤òÄä»ß¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
// templates
$messages['help_template_folder'] = '¥Æ¥ó¥×¥ì¡¼¥È¤¬ÊÝ´É¤µ¤ì¤ë¥Õ¥©¥ë¥À¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ./templates]';
$messages['help_default_template'] = '¿·µ¬BlogÍÑ¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥Æ¥ó¥×¥ì¡¼¥È¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = standard]';
$messages['help_users_can_add_templates'] = '¥æ¡¼¥¶¡¼¤Ë¤è¤ë¥«¥¹¥¿¥à¥Æ¥ó¥×¥ì¡¼¥È¤Î¥¢¥Ã¥×¥í¡¼¥É¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_template_compile_check'] = 'Í­¸ú¤Ë¤¹¤ë¤ÈSmarty¤¬¾ï¤Ë¥Æ¥ó¥×¥ì¡¼¥È¤ò¥Á¥§¥Ã¥¯¤·¡¢ÊÑ¹¹¤¬¤¢¤ë¤È¿·¤·¤¤¤â¤Î¤Ë¹¹¿·¤·¤Þ¤¹¡£¥Ñ¥Õ¥©¡¼¥Þ¥ó¥¹¤ò½Å»ë¤¹¤ë¾ì¹ç¤Ï¤³¤ì¤òÌµ¸ú¤Ë¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_template_cache_enabled'] = '¤³¤ì¤òÍ­¸ú¤Ë¤¹¤ë¤È¥­¥ã¥Ã¥·¥å¥Ð¡¼¥¸¥ç¥ó¤Î¥Ú¡¼¥¸¤¬¤Ç¤­¤ë¤À¤±¤¬»ÈÍÑ¤µ¤ì¤Þ¤¹¡£¥Ç¡¼¥¿¥Ù¡¼¥¹¤ä¥Æ¥ó¥×¥ì¡¼¥È¤ÏºÆ¥³¥ó¥Ñ¥¤¥ë¤µ¤ì¤º¡¢¥Ç¡¼¥¿¤ò¼èÆÀ¤¹¤ëÉ¬Í×¤¬¤Ê¤¯¤Ê¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_template_cache_lifetime'] = '¥­¥ã¥Ã¥·¥å¤ÎÀ©¸Â»þ´Ö¤òÉÃ¤ÇÀßÄê¤Ç¤­¤Þ¤¹¡£-1¤òÆþÎÏ¤¹¤ë¤ÈÀ©¸Â»þ´Ö¤ÏÀßÄê¤µ¤ì¤Þ¤»¤ó¡£0¤òÆþÎÏ¤¹¤ë¤È¥­¥ã¥Ã¥·¥å¤ÏÌµ¸ú¤Ë¤Ê¤ê¤Þ¤¹¤¬¡¢¥­¥ã¥Ã¥·¥å¤òÌµ¸ú¤Ë¤¹¤ë¾ì¹ç¤Ïtemplate_cache_enabled ¤Ç"¤¤¤¤¤¨"¤ËÀßÄê¤¹¤ë¤è¤¦¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = -1]';
$messages['help_template_http_cache_enabled'] = 'HTTP»ÃÄê¥ê¥¯¥¨¥¹¥È¤ò¥µ¥Ý¡¼¥È¤·¤Þ¤¹¡£¤³¤ì¤òÍ­¸ú¤Ë¤¹¤ë¤È¥¢¥«¥¦¥ó¥È¤Ë"If-Modified-Since" HTTP¥Ø¥Ã¥À¡¼¤òÆþ¤ì¡¢É¬Í×»þ¤Ë¤Ï¥³¥ó¥Æ¥ó¥Ä¤Î¤ß¤òÁ÷¿®¤·¤Þ¤¹¡£¥Ð¥ó¥É¥ï¥¤¥º¤òÊÝ»ý¤¹¤ë¾ì¹ç¤Ï¤³¤ì¤òÍ­¸ú¤Ë¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_allow_php_code_in_templates'] = '¤³¤ì¤òÍ­¸ú¤Ë¤¹¤ë¤È{php}...{/php} ¥Ö¥í¥Ã¥¯Æâ¤ÎSmarty¥Æ¥ó¥×¥ì¡¼¥È¤Ë¥Í¥¤¥Æ¥£¥ÖPHP¥³¡¼¥É¤òËä¤á¹þ¤ß¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
// urls
$messages['help_request_format_mode'] = 'URL·Á¼°¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£¥«¥¹¥¿¥àURL¤ò»ÈÍÑ¤¹¤ë¾ì¹ç¤Ï°Ê²¼¤ÎÀßÄê¤ò³ÎÇ§¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = Plain]';
$messages['plain'] = 'Plain';
$messages['search_engine_friendly'] = 'Search engine friendly';
$messages['custom_url_format'] = '¥«¥¹¥¿¥àURL';
$messages['help_permalink_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤ÎPermalink·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/{catname}/{year}/{month}/{day}/{postname}$]';
$messages['help_category_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥«¥Æ¥´¥ê¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/{catname}$]';
$messages['help_blog_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤ÎBlog¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}$]';
$messages['help_archive_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥¢¡¼¥«¥¤¥Ö¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/archives/{year}/?{month}/?{day}]';
$messages['help_user_posts_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤ÎÆÃÄê¤Î¥æ¡¼¥¶¡¼¤è¤êÅê¹Æ¤µ¤ì¤¿µ­»ö¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/user/{username}$]';
$messages['help_post_trackbacks_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤ÎTrackback¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/post/trackbacks/{postname}$]';
$messages['help_template_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥«¥¹¥¿¥àÅý·×¥Æ¥ó¥×¥ì¡¼¥È¥Ú¡¼¥¸¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/page/{templatename}$]';
$messages['help_album_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥ê¥½¡¼¥¹¥¢¥ë¥Ð¥à¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/album/{albumname}$]';
$messages['help_resource_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥Õ¥¡¥¤¥ëÉÕ¤­¤Î¥ê¥½¡¼¥¹¥Ú¡¼¥¸¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/resource/{albumname}/{resourcename}$]';
$messages['help_resource_preview_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥ê¥½¡¼¥¹¥×¥ì¥Ó¥å¡¼¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/resource/{albumname}/preview/{resourcename}$]';
$messages['help_resource_medium_size_preview_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥ß¥Ç¥£¥¢¥à¥µ¥¤¥º¥ê¥½¡¼¥¹¥×¥ì¥Ó¥å¡¼¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/resource/{albumname}/preview-med/{resourcename}$]';
$messages['help_resource_download_link_format'] = '¥«¥¹¥¿¥àURL»ÈÍÑ»þ¤Î¥Õ¥¡¥¤¥ë¤Ø¤Î¥ê¥ó¥¯¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = /blog/{blogname}/resource/{albumname}/download/{resourcename}$]';
// email
$messages['help_check_email_address_validity'] = 'E-Mail¥¢¥É¥ì¥¹³ÎÇ§»þ¤ËMX¥ì¥³¡¼¥É¤¬¥É¥á¥¤¥ó¤ËÂ¸ºß¤¹¤ë¤«¡¢¤Þ¤¿¥á¡¼¥ë¥Ü¥Ã¥¯¥¹¤¬Í­¸ú¤«´ðËÜÅª¤Ê¥Á¥§¥Ã¥¯¤ò¹Ô¤¤¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_email_service_enabled'] = 'E-Mail¤ÎÁ÷¿®¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_post_notification_source_address'] = '¥·¥¹¥Æ¥à¤è¤êÁ÷¿®¤µ¤ì¤ë"From:"¤Î¹àÌÜ¤ËÆþ¤ëE-Mail¥¢¥É¥ì¥¹¤ÎÀßÄê¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = noreply@your.host.com]';
$messages['help_email_service_type'] = 'E-Mail¤òÁ÷¿®¤¹¤ë¤¿¤á¤Î¥·¥¹¥Æ¥àÀßÄê¤Ç¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = PHP]';
$messages['help_smtp_host'] = 'E-MailÁ÷¿®¥·¥¹¥Æ¥à¤È¤·¤ÆSMTP¤òÁªÂò¤¹¤ë¾ì¹ç¤Ï¡¢»ÈÍÑ¤¹¤ëSMTP¥µ¡¼¥Ð¡¼¤ò¤³¤ì¤ËÀßÄê¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = (¶õÇò)]';
$messages['help_smtp_port'] = 'SMTP¥µ¡¼¥Ð¡¼¤¬25°Ê¾å¤Î¥Ý¡¼¥È¤ò¼Â¹Ô¤·¤Æ¤¤¤ë¾ì¹ç¤Ï¤³¤³¤ÇÀßÄê¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = (¶õÇò)]';
$messages['help_smtp_use_authentication'] = 'SMTP¥µ¡¼¥Ð¡¼¤Ë¾µÇ§¤òÉ¬Í×¤È¤¹¤ë¡£  [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_smtp_username'] = 'SMTP¥µ¡¼¥Ð¡¼¤Ë¾µÇ§¤òÉ¬Í×¤È¤·¤¿¾ì¹ç¤Î¥æ¡¼¥¶¡¼Ì¾¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = (¶õÇò)]';
$messages['help_smtp_password'] = 'SMTP¥µ¡¼¥Ð¡¼¤Ë¾µÇ§¤òÉ¬Í×¤È¤·¤¿¾ì¹ç¤Î¥Ñ¥¹¥ï¡¼¥É¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£ [¥Ç¥Õ¥©¥ë¥È = (¶õÇò)]';
// helpers
$messages['help_path_to_tar'] = '.tar.gz ¤ä tar.bz2·Á¼°¤Î¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÅ¸³«¤¹¤ë¤¿¤á¤Î"tar"¥Ä¡¼¥ë¤Ø¤Î¥Ñ¥¹ [¥Ç¥Õ¥©¥ë¥È = /bin/tar]';
$messages['help_path_to_gzip'] = '.tar.gz·Á¼°¤Î¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÅ¸³«¤¹¤ë¤¿¤á¤Î"gzip"¥Ä¡¼¥ë¤Ø¤Î¥Ñ¥¹ [¥Ç¥Õ¥©¥ë¥È = /bin/gzip]';
$messages['help_path_to_bz2'] = '.tar.bz2·Á¼°¤Î¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÅ¸³«¤¹¤ë¤¿¤á¤Î"bzip2"¥Ä¡¼¥ë¤Ø¤Î¥Ñ¥¹ [¥Ç¥Õ¥©¥ë¥È = /usr/bin/bzip2]';
$messages['help_path_to_unzip'] = '.zip·Á¼°¤Î¥Æ¥ó¥×¥ì¡¼¥È¥»¥Ã¥È¤òÅ¸³«¤¹¤ë¤¿¤á¤Î"unzip"¥Ä¡¼¥ë¤Ø¤Î¥Ñ¥¹ [¥Ç¥Õ¥©¥ë¥È = /usr/bin/unzip]';
$messages['help_unzip_use_native_version'] = '¥Ð¥ó¥É¥ë¤µ¤ì¤Æ¤¤¤ëPHP¥Í¥¤¥Æ¥£¥ÖÈÇ¤ò.zip¥Õ¥¡¥¤¥ëÅ¸³«»þ¤Ë»ÈÍÑ¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
// uploads
$messages['help_uploads_enabled'] = '¥æ¡¼¥¶¡¼¤Î¥Õ¥¡¥¤¥ë¤Î¥¢¥Ã¥×¥í¡¼¥É¤òµö²Ä¤¹¤ë¡£(¥ê¥½¡¼¥¹¡¢¥«¥¹¥¿¥à¥Æ¥ó¥×¥ì¡¼¥È¥Õ¥¡¥¤¥ë¡¢¸À¸ì¥Õ¥¡¥¤¥ë) [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_maximum_file_upload_size'] = 'ºÇÂç¥Õ¥¡¥¤¥ë¥µ¥¤¥º¿ô¤ò¥Ð¥¤¥È¤ÇÀßÄê¤·¤Æ²¼¤µ¤¤¡£¤³¤ÎÃÍ¤ÏPHP\'s¤ÎÀ©¸ÂÃÍ¤òÄ¶¤¨¤ë¤³¤È¤Ï¤¢¤ê¤Þ¤»¤ó¡£  [¥Ç¥Õ¥©¥ë¥È = 2000000]';
$messages['help_upload_forbidden_files'] = '¥¢¥Ã¥×¥í¡¼¥É¤ò¶Ø»ß¤¹¤ë¥Õ¥¡¥¤¥ë¥¿¥¤¥×¤òÈ¾³Ñ¥¹¥Ú¡¼¥¹¤Ç¶èÀÚ¤Ã¤ÆÀßÄê¤·¤Æ²¼¤µ¤¤¡£\'*\' ¤ä \'?\'¤Î»ÈÍÑ¤Ïµö²Ä¤µ¤ì¤Æ¤¤¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = *.php *.php3 *.php4 *.phtml]';
// interfaces
$messages['help_xmlrpc_api_enabled'] = 'XMLRPC¤«¤é¤ÎBlog¤Ø¤Î¥¢¥¯¥»¥¹¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_rdf_enabled'] = 'Atom¤äRSS¤«¤é¤Î¥³¥ó¥Æ¥ó¥Ä¥·¥ó¥Ç¥£¥±¡¼¥·¥ç¥ó¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_default_rss_profile'] = '¥³¥ó¥Æ¥ó¥Ä¥·¥ó¥Ç¥£¥±¡¼¥·¥ç¥óÍÑ¤ÎRSS¤äAtom¤Î¥Ç¥Õ¥©¥ë¥È¥Ð¡¼¥¸¥ç¥ó¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = RSS 1.0]';
// security
$messages['help_security_pipeline_enabled'] = '¥»¥­¥å¥ê¥Æ¥£¡¼¥Ñ¥¤¥×¥é¥¤¥ó¤ÈÁ´¤Æ¤Î´ØÏ¢¥Õ¥£¥ë¥¿¤òÍ­¸ú¤Ë¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_ip_address_filter_enabled'] = 'IP¥¢¥É¥ì¥¹¥Õ¥£¥ë¥¿¤òÍ­¸ú¤Ë¤¹¤ë¡£¤³¤Îµ¡Ç½¤ò»ÈÍÑ¤¹¤ë¤Ë¤Ï¥»¥­¥å¥ê¥Æ¥£¡¼¥Ñ¥¤¥×¥é¥¤¥ó¤¬Í­¸ú¤Ë¤Ê¤Ã¤Æ¤¤¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_content_filter_enabled'] = 'Regular Expression-Based¥³¥ó¥Æ¥ó¥Ä¥Õ¥£¥ë¥¿¤òÍ­¸ú¤Ë¤¹¤ë¡£¤³¤Îµ¡Ç½¤ò»ÈÍÑ¤¹¤ë¤Ë¤Ï¥»¥­¥å¥ê¥Æ¥£¡¼¥Ñ¥¤¥×¥é¥¤¥ó¤¬Í­¸ú¤Ë¤Ê¤Ã¤Æ¤¤¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_maximum_comment_size'] = '¥³¥á¥ó¥È¤ÎºÇ¹â¥µ¥¤¥º¤ò¥Ð¥¤¥È¤ÇÀßÄê¤·¤Æ²¼¤µ¤¤¡£0¤òÆþÎÏ¤¹¤ë¤È¤³¤Îµ¡Ç½¤ÏÄä»ß¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 0]';
// bayesian filter
$messages['help_bayesian_filter_enabled'] = '¼«Æ°¥¹¥Ñ¥à¥Õ¥£¥ë¥¿ÍÑ¤ËBayesian¥Õ¥£¥ë¥¿¤òÍ­¸ú¤Ë¤¹¤ë¡£  [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_bayesian_filter_spam_probability_treshold'] = '¥³¥á¥ó¥È¤ò¥¹¥Ñ¥à¤ÈÇ§Äê¤¹¤ë¤Þ¤Ç¤ÎºÇ¹âÉßµïÃÍ¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = 0.9]';
$messages['help_bayesian_filter_nonspam_probability_treshold'] = '¥³¥á¥ó¥È¤òÈó¥¹¥Ñ¥à¤ÈÇ§Äê¤·¤¿¸å¤ÎºÇÄãÉßµïÃÍ¤òÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 0.2]';
$messages['help_bayesian_filter_min_length_token'] = 'Byesian¥Õ¥£¥ë¥¿¤Ë"Í­¸ú"¤ÈÇ§Äê¤µ¤ì¤ë¤¿¤á¤Î¥È¡¼¥¯¥ó¤ÎºÇÄãÃÍ  [¥Ç¥Õ¥©¥ë¥È = 3]';
$messages['help_bayesian_filter_max_length_token'] = 'Byesian¥Õ¥£¥ë¥¿¤Ë"Í­¸ú"¤ÈÇ§Äê¤µ¤ì¤ë¤¿¤á¤Î¥È¡¼¥¯¥ó¤ÎºÇ¹âÃÍ  [¥Ç¥Õ¥©¥ë¥È = 100]';
$messages['help_bayesian_filter_number_significant_tokens'] = 'Í­¸ú¤Ê¥È¡¼¥¯¥ó¿ô  [¥Ç¥Õ¥©¥ë¥È = 15]';
$messages['help_bayesian_filter_spam_comments_action'] = '¥¹¥Ñ¥à¤ÈÇ§Äê¤µ¤ì¤¿¥³¥á¥ó¥È¤ÎÊÝÂ¸/ÇË´þ¤òÀßÄê¤·¤Þ¤¹¡£¥Õ¥£¥ë¥¿¤¬³Ø½¬ºÑ¤ß¤Î¾ì¹ç¤Î¤ß"ÇË´þ"¤òÁªÂò¤¹¤ë¤è¤¦¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£  [¥Ç¥Õ¥©¥ë¥È = ÊÝÂ¸]';
$messages['keep_spam_comments'] = '"¥¹¥Ñ¥à"¥Þ¡¼¥¯¤·¤Æ¥Ç¡¼¥¿¥Ù¡¼¥¹¤ËÊÝÂ¸';
$messages['throw_away_spam_comments'] = 'ÇË´þ¤¹¤ë (ÊÝÂ¸¤·¤Ê¤¤)';
// resources
$messages['help_resources_enabled'] = '¥ê¥½¡¼¥¹¤òµö²Ä¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_resources_folder'] = '¥ê¥½¡¼¥¹¥Õ¥¡¥¤¥ë¤¬ÊÝ´É¤µ¤ì¤ë¾ì½ê¤òÀßÄê¤·¤Þ¤¹¡£¥»¥­¥å¥ê¥Æ¥£¡¼¤ò¶¯²½¤¹¤ë¤¿¤á¤Ë¥¦¥§¥Ö¥µ¡¼¥Ð¡¼¥Ä¥ê¡¼°Ê³°¤ËÀßÄê¤·¤Æ²¼¤µ¤¤¡£ security  [¥Ç¥Õ¥©¥ë¥È = ./gallery]';
$messages['help_thumbnail_method'] = '¥µ¥à¥Í¥¤¥ë¤Î¼èÆÀ·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£PHP»ÈÍÑ¤Î¾ì¹ç¤ÏGD¥µ¥Ý¡¼¥È¤¬É¬Í×¤È¤Ê¤ê¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = PHP]';
$messages['help_path_to_convert'] = 'ImageMagick¤Ë¤è¤ë"¥³¥ó¥Ð¡¼¥È"¥Ä¡¼¥ë¤Ø¤Î¥Ñ¥¹¤òÀßÄê¤·¤Þ¤¹¡£¥µ¥à¥Í¥¤¥ë¼èÆÀ·Á¼°¤Ë"ImageMagick"¤òÁªÂò¤·¤¿¾ì¹ç¤ÏÆþÎÏÉ¬¿Ü¤È¤Ê¤ê¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = /usr/bin/convert]';
$messages['help_thumbnail_format'] = '¥µ¥à¥Í¥¤¥ë¤ÎÊÝÂ¸·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = ¥ª¥ê¥¸¥Ê¥ë¤Î²èÁü¤ÈÆ±¤¸]';
$messages['help_thumbnail_height'] = '¾®¥µ¥à¥Í¥¤¥ë¤Î¥Ç¥Õ¥©¥ë¥È¤Î½ÄÉý¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = 120]';
$messages['help_thumbnail_width'] = '¾®¥µ¥à¥Í¥¤¥ë¤Î¥Ç¥Õ¥©¥ë¥È¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = 120]';
$messages['help_medium_size_thumbnail_height'] = 'Ãæ¥µ¥à¥Í¥¤¥ë¤Î¥Ç¥Õ¥©¥ë¥È¤Î½ÄÉý¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = 480]';
$messages['help_medium_size_thumbnail_width'] = 'Ãæ¥µ¥à¥Í¥¤¥ë¤Î¥Ç¥Õ¥©¥ë¥È¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = 640]';
$messages['help_thumbnails_keep_aspect_ratio'] = '¥µ¥à¥Í¥¤¥ë¼èÆÀ»þ¤Ë¼ÂºÝ¤Î¥µ¥¤¥º¤Î³ä¹ç¤òÅ¬ÍÑ¤¹¤ë¡£¾å¤Ç»ØÄê¤·¤¿¥µ¥à¥Í¥¤¥ë¥µ¥¤¥º¤è¤êÂç¤­¤¯¤Ê¤ë²ÄÇ½À­¤¬¤¢¤ê¤Þ¤¹¤¬¡¢É½¼¨¤Î¼Á¤ÏÎÉ¤¯¤Ê¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_thumbnail_generator_force_use_gd1'] = '¥·¥¹¥Æ¥à¤ËGD1-onlyµ¡Ç½¤Î»ÈÍÑ¤ò¶¯À©¤¹¤ë¡£ [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_thumbnail_generator_user_smoothing_algorithm'] = '¥¹¥à¡¼¥¹¥µ¥à¥Í¥¤¥ëÍÑ¤Ë¥¢¥ë¥´¥ê¥º¥à¤ò»ÈÍÑ¤¹¤ë¡£¥µ¥à¥Í¥¤¥ë¼èÆÀ·Á¼°¤òGD¤ËÁªÂò¤·¤Æ¤¤¤ë¾ì¹ç¤Ë¤Î¤ßÅ¬ÍÑ¤µ¤ì¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = PHP Imagecopyresampled]';
$messages['help_resources_quota'] = 'BlogÍÑ¤Î¥°¥í¡¼¥Ð¥ë¥ê¥½¡¼¥¹ÍÆÎÌ¤ò¥Ð¥¤¥È¤ÇÀßÄê¤·¤Þ¤¹¡£ (Îã: 5242880 ¥Ð¥¤¥È = 5MB) 0¤òÆþÎÏ¤¹¤ë¤ÈÌµÀ©¸Â¤È¤Ê¤ê¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 0]';
$messages['help_resource_server_http_cache_enabled'] = '"If-Modified-Since"¥Ø¥Ã¥À¡¼¤ÈHTTP»ÃÄê¥ê¥¯¥¨¥¹¥È¤Î¥µ¥Ý¡¼¥È¤òÍ­¸ú¤Ë¤¹¤ë¡£Áý¥Ð¥ó¥É¥ï¥¤¥ºÊÝ»ý¤¬Í­¸ú¤Ë¤Ê¤ê¤Þ¤¹¡£  [¥Ç¥Õ¥©¥ë¥È = ¤¤¤¤¤¨]';
$messages['help_resource_server_http_cache_lifetime'] = '¥¯¥é¥¤¥¢¥ó¥È¤Ë¥ê¥½¡¼¥¹¤Î¥­¥ã¥Ã¥·¥å¥Ð¡¼¥¸¥ç¥ó¤ò»ÈÍÑ¤µ¤»¤ë»þ´Ö¤ò¥Þ¥¤¥¯¥í¥»¥«¥ó¥É(100ËüÊ¬¤Î1)¤ÇÀßÄê¤·¤Þ¤¹¡£ [¥Ç¥Õ¥©¥ë¥È = 9999999]';
$messages['same_as_image'] = '¥ª¥ê¥¸¥Ê¥ë¤Î²èÁü¤ÈÆ±¤¸';
// search
$messages['help_search_engine_enabled'] = '¸¡º÷¥¨¥ó¥¸¥ó¤òÍ­¸ú¤Ë¤¹¤ë  [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_search_in_custom_fields'] = '¥«¥¹¥¿¥à¹àÌÜÆâ¤ò¸¡º÷¤¹¤ë  [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';
$messages['help_search_in_comments'] = '¥³¥á¥ó¥ÈÆâ¤ò¸¡º÷¤¹¤ë  [¥Ç¥Õ¥©¥ë¥È = ¤Ï¤¤]';

// cleanup
$messages['purge'] = '¥¯¥ê¡¼¥ó¥¢¥Ã¥×';
$messages['cleanup_spam'] = '¥¹¥Ñ¥à¥Ç¡¼¥¿¤Î¥¯¥ê¡¼¥ó¥¢¥Ã¥×';
$messages['cleanup_spam_help'] = '¤³¤ì¤ò¼Â¹Ô¤¹¤ë¤È¡¢¥æ¡¼¥¶¡¼¤¬¥¹¥Ñ¥à¤ÈÈ½ÃÇ(¥Þ¡¼¥¯)¤·¤¿Á´¤Æ¤ÎÉÔÍ×¤Ê¥³¥á¥ó¥È¤¬ºï½ü¤µ¤ì¤Þ¤¹¡£¤³¤ì¤ò¼Â¹Ô¤¹¤ë¤È¸µ¤ËÌá¤¹¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Î¤Ç¤´Ãí°Õ²¼¤µ¤¤¡£';
$messages['spam_comments_purged_ok'] = '¥¹¥Ñ¥à¥Ç¡¼¥¿¤Î¥¯¥ê¡¼¥ó¥¢¥Ã¥×¤¬´°Î»¤·¤Þ¤·¤¿¡£';
$messages['cleanup_posts'] = 'Åê¹Æ¥Ç¡¼¥¿¤Î¥¯¥ê¡¼¥ó¥¢¥Ã¥×';
$messages['cleanup_posts_help'] = '¤³¤ì¤ò¼Â¹Ô¤¹¤ë¤È¡¢¥æ¡¼¥¶¡¼¤¬ºï½ü(¥Þ¡¼¥¯)¤·¤¿Á´¤Æ¤ÎÉÔÍ×¤ÊÅê¹Æ¥Ç¡¼¥¿¤¬ºï½ü¤µ¤ì¤Þ¤¹¡£¤³¤ì¤ò¼Â¹Ô¤¹¤ë¤È¸µ¤ËÌá¤¹¤³¤È¤¬¤Ç¤­¤Þ¤»¤ó¤Î¤Ç¤´Ãí°Õ²¼¤µ¤¤¡£';
$messages['posts_purged_ok'] = 'Åê¹Æ¥Ç¡¼¥¿¤Î¥¯¥ê¡¼¥ó¥¢¥Ã¥×¤¬´°Î»¤·¤Þ¤·¤¿¡£';

/// summary ///
// front page
$messages['summary'] = '¥µ¥Þ¥ê¡¼';
$messages['register'] = 'ÅÐÏ¿';
$messages['summary_welcome'] = 'Welcome!';
$messages['summary_most_active_blogs'] = 'ºÇ¿·¹¹¿·¤ÎBlog';
$messages['summary_most_commented_articles'] = '¥³¥á¥ó¥È¤ÎÂ¿¤¤µ­»ö';
$messages['summary_most_read_articles'] = '±ÜÍ÷¿ô¤ÎÂ¿¤¤µ­»ö';
$messages['password_forgotten'] = '¥Ñ¥¹¥ï¡¼¥ÉÊ¶¼º';
$messages['summary_newest_blogs'] = '¿·Ãå¤ÎBlog';
$messages['summary_latest_posts'] = '¿·Ãå¤Îµ­»ö';
$messages['summary_search_blogs'] = 'Blog¸¡º÷';

// blog list
$messages['updated'] = 'ºÇ½ª¹¹¿·Æü:';
$messages['total_reads'] = '±ÜÍ÷¿ô:';

// blog profile
$messages['blog'] = 'Blog';
$messages['latest_posts'] = 'ºÇ¿·¤Îµ­»ö';

// registration
$messages['register_step0_title'] = '¥á¥ó¥Ð¡¼µ¬Ìó';
$messages['agreement'] = 'µ¬ÌóÆâÍÆ'; 
$messages['decline'] = 'Æ±°Õ¤·¤Ê¤¤';
$messages['accept'] = 'Æ±°Õ¤¹¤ë';
$messages['read_service_agreement'] = '°Ê²¼¤Î¥á¥ó¥Ð¡¼µ¬Ìó¤ò¤è¤¯¤ªÆÉ¤ß¤Ë¤Ê¤ê¡¢Æ±°Õ¤Î¾å¤ÇÅÐÏ¿¤µ¤ì¤ë¾ì¹ç¤Ï"Æ±°Õ¤¹¤ë"¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£';
$messages['register_step1_title'] = '¥æ¡¼¥¶¡¼ºîÀ® [1/4]';
$messages['register_step1_help'] = 'Blog¤òºîÀ®¤¹¤ëÁ°¤Ë¿·µ¬¥æ¡¼¥¶¡¼¤òºîÀ®¤¹¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£¤³¤Î¿·µ¬¥æ¡¼¥¶¡¼¤ÏBlog¤Î¥ª¡¼¥Ê¡¼¤È¤Ê¤ê¡¢Á´¤Æ¤Îµ¡Ç½¤Ë¥¢¥¯¥»¥¹¤Ç¤­¤ë¤è¤¦¤Ë¤Ê¤ê¤Þ¤¹¡£';
$messages['register_next'] = '¼¡¤Ø';
$messages['register_back'] = 'Á°¤Ø';
$messages['register_step2_title'] = 'BlogºîÀ® [2/4]';
$messages['register_blog_name_help'] = '¤¢¤Ê¤¿¤ÎBlog¤ÎÌ¾Á°';
$messages['register_step3_title'] = '¥Æ¥ó¥×¥ì¡¼¥ÈÁªÂò [3/4]';
$messages['step1'] = '¥¹¥Æ¥Ã¥×1';
$messages['step2'] = '¥¹¥Æ¥Ã¥×2';
$messages['step3'] = '¥¹¥Æ¥Ã¥×3';
$messages['register_step3_help'] = '¥Æ¥ó¥×¥ì¡¼¥È¤òÁªÂò¤·¤Æ²¼¤µ¤¤¡£¥Æ¥ó¥×¥ì¡¼¥È¤Ï¸å¤ÇÊÑ¹¹²ÄÇ½¤Ç¤¹¡£';
$messages['error_must_choose_template'] = '¥Æ¥ó¥×¥ì¡¼¥È¤ò1¤ÄÁªÂò¤·¤Æ²¼¤µ¤¤¡£';
$messages['select_template'] = '¥Æ¥ó¥×¥ì¡¼¥ÈÁªÂò';
$messages['register_step5_title'] = 'ÅÐÏ¿´°Î» [4/4]';
$messages['finish'] = '´°Î»';
$messages['register_need_confirmation'] = 'ÅÐÏ¿¼êÂ³¤­¤ò´°Î»¤¹¤ë¤¿¤á¤Î¾µÇ§¥á¡¼¥ë¤¬¤¢¤Ê¤¿¤ÎE-Mail¥¢¥É¥ì¥¹¤ØÁ÷¿®¤µ¤ì¤Þ¤·¤¿¡£¾µÇ§¥á¡¼¥ë¤Ë·ÇºÜ¤µ¤ì¤Æ¤¤¤ë¾µÇ§¥³¡¼¥É¤ò¥¯¥ê¥Ã¥¯¤·¡¢ÅÐÏ¿¼êÂ³¤­¤ò´°Î»¤µ¤»¤Æ²¼¤µ¤¤¡£';
$messages['register_step5_help'] = '¿·µ¬¥æ¡¼¥¶¡¼¤ÈBlog¤¬ºîÀ®¤¬´°Î»¤·¤Þ¤·¤¿!';
$messages['register_blog_link'] = '¤¢¤Ê¤¿¤Î¿·µ¬Blog¤Ï¤³¤Á¤é¤è¤ê¥¢¥¯¥»¥¹²ÄÇ½¤Ç¤¹: <a href="%2$s">%1$s</a>';
$messages['register_blog_admin_link'] = '¤¢¤Ê¤¿¤Î¿·µ¬Blog¤Ëµ­»ö¤òÅê¹Æ¤µ¤ì¤ë¾ì¹ç¤Ï<a href="admin.php">´ÉÍý²èÌÌ</a>¤è¤ê¹Ô¤Ã¤Æ²¼¤µ¤¤¡£';
$messages['register_error'] = '¼Â¹ÔÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£';
$messages['error_registration_disabled'] = '¿½¤·Ìõ¤¢¤ê¤Þ¤»¤ó¤¬¡¢¿·µ¬ÅÐÏ¿¤Ï¸½ºß¼õ¤±ÉÕ¤±¤Æ¤ª¤ê¤Þ¤»¤ó¡£';
// registration article topic and text
$messages['register_default_article_topic'] = 'ÅÐÏ¿¤¬´°Î»¤·¤Þ¤·¤¿';
$messages['register_default_article_text'] = '¤³¤Î¥á¥Ã¥»¡¼¥¸¤¬É½¼¨¤µ¤ì¤Æ¤¤¤ë¾ì¹ç¤Ï¡¢ÅÐÏ¿¤¬´°Î»¤·¤¢¤Ê¤¿ÀìÍÑ¤ÎBlog¤¬ÄÉ²Ã¤µ¤ì¤¿¤³¤È¤ò°ÕÌ£¤·¤Þ¤¹¡£(´ÉÍý²èÌÌ¤è¤ê¤³¤Î¥á¥Ã¥»¡¼¥¸¤Ïºï½ü²ÄÇ½¤Ç¤¹)';
$messages['register_default_category'] = 'General';
// confirmation email
$messages['register_confirmation_email_text'] = 'ÅÐÏ¿¼êÂ³¤­¤ò´°Î»¤¹¤ë¤Ë¤Ï°Ê²¼¤Î¾µÇ§¥³¡¼¥É¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤:

%s

¤´ÅÐÏ¿¤¢¤ê¤¬¤È¤¦¤´¤¶¤¤¤Þ¤·¤¿¡£';
$messages['error_invalid_activation_code'] = '¿½¤·Ìõ¤¢¤ê¤Þ¤»¤ó¤¬¡¢¾µÇ§¥³¡¼¥É¤¬´Ö°ã¤Ã¤Æ¤¤¤ë¤è¤¦¤Ç¤¹¡£';
$messages['blog_activated_ok'] = 'ÅÐÏ¿¼êÂ³¤­¤¬´°Î»¤·¤Þ¤·¤¿¡£';
// forgot your password?
$messages['reset_password'] = '¥Ñ¥¹¥ï¡¼¥É¥ê¥»¥Ã¥È';
$messages['reset_password_username_help'] = '¥Ñ¥¹¥ï¡¼¥É¤ò¥ê¥»¥Ã¥È¤¹¤ë¥æ¡¼¥¶¡¼Ì¾¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['reset_password_email_help'] = '¤³¤Î¥æ¡¼¥¶¡¼¤ÎÅÐÏ¿E-Mail¥¢¥É¥ì¥¹¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['reset_password_help'] = '¤³¤³¤Ç¤ÏÊ¶¼º¤·¤Æ¤·¤Þ¤Ã¤¿¥Ñ¥¹¥ï¡¼¥É¤ò¥ê¥»¥Ã¥È¤·¡¢ºÆÈ¯¹Ô¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£¥æ¡¼¥¶¡¼Ì¾¤ÈE-Mail¥¢¥É¥ì¥¹¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_resetting_password'] = '¥Ñ¥¹¥ï¡¼¥É¥ê¥»¥Ã¥ÈÃæ¤Ë¥¨¥é¡¼¤¬È¯À¸¤·¤Þ¤·¤¿¡£ºÆÅÙ¤ª»î¤·²¼¤µ¤¤¡£';
$messages['reset_password_error_incorrect_email_address'] = 'ÆþÎÏ¤µ¤ì¤¿E-Mail¥¢¥É¥ì¥¹¤È¥æ¡¼¥¶¡¼Ì¾¤¬¥Þ¥Ã¥Á¤·¤Þ¤»¤ó¡£';
$messages['password_reset_message_sent_ok'] = '¥Ñ¥¹¥ï¡¼¥É¤ò¥ê¥»¥Ã¥È¤¹¤ë¥ê¥ó¥¯¥³¡¼¥É¤¬µ­ºÜ¤µ¤ì¤¿¥á¡¼¥ë¤ò¤¢¤Ê¤¿¤ÎE-Mail¥¢¥É¥ì¥¹°¸¤ËÁ÷¿®¤·¤Þ¤·¤¿¡£¥á¡¼¥ë¤Ëµ­ºÜ¤µ¤ì¤Æ¤¤¤ë¥ê¥ó¥¯¥³¡¼¥É¤ò¥¯¥ê¥Ã¥¯¤·¤Æ²¼¤µ¤¤¡£';
$messages['error_incorrect_request'] = 'URLÆâ¤Î¥Ñ¥é¥á¡¼¥¿¡¼¤¬Àµ¤·¤¯¤¢¤ê¤Þ¤»¤ó¡£';
$messages['change_password'] = '¿·µ¬¥Ñ¥¹¥ï¡¼¥ÉÀßÄê';
$messages['change_password_help'] = '¿·µ¬¥Ñ¥¹¥ï¡¼¥É¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['new_password'] = '¿·µ¬¥Ñ¥¹¥ï¡¼¥É';
$messages['new_password_help'] = '¿·µ¬¥Ñ¥¹¥ï¡¼¥É¤òÆþÎÏ¤·¤Æ²¼¤µ¤¤¡£';
$messages['password_updated_ok'] = '¥Ñ¥¹¥ï¡¼¥É¤Î¹¹¿·¤¬´°Î»¤·¤Þ¤·¤¿¡£';

// Suggested by BCSE, some useful messages that not available in official locale
$messages['upgrade_information'] = 'This page looks plain and un-styled because you\'re using a non-standard compliant browser. To see it in its best form, please <a href="http://www.webstandards.org/upgrade/" title="The Web Standards Project\'s Browser Upgrade initiative">upgrade</a> to a browser that supports web standards. It\'s free and painless.';
$messages['jump_to_navigation'] = 'Jump to Navigation.';
$messages['comment_email_never_display'] = 'Line and paragraph breaks automatic, e-mail address never displayed.';
$messages['comment_html_allowed'] = '<acronym title="Hypertext Markup Language">HTML</acronym> allowed: &lt;<acronym title="Hyperlink">a</acronym> href=&quot;&quot; title=&quot;&quot; rel=&quot;&quot;&gt; &lt;<acronym title="Acronym Description">acronym</acronym> title=&quot;&quot;&gt; &lt;<acronym title="Quote">blockquote</acronym> cite=&quot;&quot;&gt; &lt;<acronym title="Strike">del</acronym>&gt; &lt;<acronym title="Italic">em</acronym>&gt; &lt;<acronym title="Underline">ins</acronym>&gt; &lt;<acronym title="Bold">strong</acronym>&gt;';
$messages['trackback_uri'] = 'The <acronym title="Uniform Resource Identifier">URI</acronym> to trackback this entry is: ';
$messages['previous_post'] = 'Á°¤Ø';
$messages['next_post'] = '¼¡¤Ø';
$messages['comment_default_title'] = '(ÌµÂê)';
$messages['guestbook'] = '¥²¥¹¥È¥Ö¥Ã¥¯';
$messages['trackbacks'] = 'Trackback';
$messages['menu'] = '¥á¥Ë¥å¡¼';
$messages['albums'] = '¥¢¥ë¥Ð¥à';
$messages['admin'] = '´ÉÍý¼Ô';
?>