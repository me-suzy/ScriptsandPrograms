<?php
// set this to the encoding that should be used to display the pages correctly
$messages['encoding'] = 'big5';
$messages['locale_description'] = 'Traditional Chinese translation (BIG5)';
// locale format, see Locale::formatDate for more information
$messages['date_format'] = '%d/%m/%Y %H:%M';

// days of the week
$messages['days'] = Array( '¬P´Á¤é', '¬P´Á¤@', '¬P´Á¤G', '¬P´Á¤T', '¬P´Á¥|', '¬P´Á¤­', '¬P´Á¤»' );
// -- compatibility, do not touch -- //
$messages['Monday'] = $messages['days'][1];
$messages['Tuesday'] = $messages['days'][2];
$messages['Wednesday'] = $messages['days'][3];
$messages['Thursday'] = $messages['days'][4];
$messages['Friday'] = $messages['days'][5];
$messages['Saturday'] = $messages['days'][6];
$messages['Sunday'] = $messages['days'][0];

// abbreviations
$messages['daysshort'] = Array( '¤é', '¤@', '¤G', '¤T', '¥|', '¤­', '¤»' );
// -- compatibility, do not touch -- //
$messages['Mo'] = $messages['daysshort'][1];
$messages['Tu'] = $messages['daysshort'][2];
$messages['We'] = $messages['daysshort'][3];
$messages['Th'] = $messages['daysshort'][4];
$messages['Fr'] = $messages['daysshort'][5];
$messages['Sa'] = $messages['daysshort'][6];
$messages['Su'] = $messages['daysshort'][0];

// months of the year
$messages['months'] = Array( '¤¸¤ë', '¤G¤ë', '¤T¤ë', '¥|¤ë', '¤­¤ë', '¤»¤ë', '¤C¤ë', '¤K¤ë', '¤E¤ë', '¤Q¤ë', '¤Q¤@¤ë', '¤Q¤G¤ë');
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
$messages['message'] = '°T®§';
$messages['error'] = '¿ù»~';
$messages['date'] = '¤é´Á';

// miscellaneous texts
$messages['of'] = 'of';
$messages['recently'] = 'ªñ´Á¤å³¹';
$messages['comments'] = '°jÅT';
$messages['comment on this'] = '°jÅT';
$messages['my_links'] = '§Úªº³sµ²';
$messages['archives'] = '¤å³¹·J¾ã';
$messages['search'] = '¯¸¤º·j´M';
$messages['calendar'] = '¤é¾ä';
$messages['search_s'] = '·j´M';
$messages['search_this_blog'] = '·j´Mºô»x¤º®e:';
$messages['about_myself'] = '¦Û§Ú¤¶²Ð';
$messages['permalink_title'] = '¤å³¹·J¾ãÀRºA³sµ²ºô§}';
$messages['permalink'] = 'ÀRºA³sµ²ºô§}';
$messages['posted_by'] = '§@ªÌ';
$messages['reply'] = '¦^ÂÐ';

// add comment form
$messages['add_comment'] = 'µoªí°jÅT';
$messages['comment_topic'] = '¼ÐÃD';
$messages['comment_text'] = '¤º®e';
$messages['comment_username'] = '¼ÊºÙ';
$messages['comment_email'] = '¹q¤l¶l¥ó';
$messages['comment_url'] = '­Ó¤Hºô­¶';
$messages['comment_send'] = 'µoªí';
$messages['comment_added'] = '±zªº°jÅT¤w¸g¶¶§Qµoªí¡I';
$messages['comment_add_error'] = 'µoªí°jÅT®Éµo¥Í¿ù»~';
$messages['article_does_not_exist'] = '¥»¤å³¹¤£¦s¦b';
$messages['no_posts_found'] = '§ä¤£¨ì¤å³¹';
$messages['user_has_no_posts_yet'] = '¸Ó¨Ï¥ÎªÌÁÙ¨S¦³µoªí¹L¥ô¦ó¤å³¹';
$messages['back'] = '¦^¨ì¤W¤@­¶';
$messages['post'] = '¤å³¹';
$messages['trackbacks_for_article'] = '¤Þ¥Î¥»¤åªº¤å³¹¼ÐÃD¡G';
$messages['trackback_excerpt'] = 'ºK­n';
$messages['trackback_weblog'] = 'ºô»x';
$messages['search_results'] = '·j´Mµ²ªG';
$messages['search_matching_results'] = '¥H¤U¤å³¹²Å¦X±zªº·j´MÃöÁä¦r: ';
$messages['search_no_matching_posts'] = '§ä¤£¨ì²Å¦Xªº¤å³¹';
$messages['read_more'] = '(¾\Åª¥þ¤å)';
$messages['syndicate'] = '·s»D¥æ´«';
$messages['main'] = '¥D­¶­±';
$messages['about'] = 'Ãö©ó';
$messages['download'] = '¤U¸ü';

////// error messages /////
$messages['error_fetching_article'] = '§ä¤£¨ì±z©Ò«ü©wªº¤å³¹¡C';
$messages['error_fetching_articles'] = '§ä¤£¨ì±z©Ò«ü©wªº¤å³¹¡C';
$messages['error_trackback_no_trackback'] = '©|¥¼¦³¤H¦V¥»¤åµo°e¤Þ¥Î³q§i';
$messages['error_incorrect_article_id'] = '¤å³¹ID¤£¥¿½T¡C';
$messages['error_incorrect_blog_id'] = 'ºô»x¯¸¥xID¤£¥¿½T¡C';
$messages['error_comment_without_text'] = 'µL°jÅT¯d¨¥¤º®e¡C';
$messages['error_comment_without_name'] = '±z¥²¶·­n¶ñ¼g©m¦W©Î¼ÊºÙ¡C';
$messages['error_adding_comment'] = '¦b±N¯d¨¥·s¼W¦Ü¸ê®Æ®w®Éµo¥Í°ÝÃD¡C';
$messages['error_incorrect_parameter'] = '°Ñ¼Æ¤£¥¿½T¡C';
$messages['error_parameter_missing'] = '±z¤Ö¶Ç»¼¤F¤@¶µ°Ñ¼Æ¡C';
$messages['error_comments_not_enabled'] = '³o­Óºô»x¯¸¥xÃö³¬¤F°jÅT¥\¯à';
$messages['error_incorrect_search_terms'] = '·j´MÃöÁä¦r¤£¥¿½T';
$messages['error_no_search_results'] = '§ä¤£¨ì»PÃöÁä¦r¬Û²Åªº¶µ¥Ø¡C';
$messages['error_no_albums_defined'] = '³o­Óºô»x¯¸¥x¨S¦³¥ô¦ó¸ê¸ê®Æ§¨¡C';

/////////////////                                          //////////////////
///////////////// STRINGS FOR THE ADMINISTRATION INTERFACE //////////////////
/////////////////                                          //////////////////

// login page
$messages['login'] = 'µn¤J';
$messages['welcome_message'] = 'Åwªï¨Ó¨ì pLog';
$messages['error_incorrect_username_or_password'] = '«Ü©êºp¡A±z¿é¤Jªº±b¸¹©Î±K½X¿ù»~¡C';
$messages['error_dont_belong_to_any_blog'] = '«Ü©êºp¡A±z¨S¦³¨Ï¥Î¨t²Î¤¤¥ô¦ó¤@­Óºô»x¯¸¥xªºÅv­­¡C';
$messages['logout_message'] = '±z¤w¸g¶¶§Qµn¥X¨t²Î¡C';
$messages['logout_message_2'] = '½Ð«ö <a href="%1$s">³o¸Ì</a> ³sµ²¨ì %2$s</a>.';
$messages['error_access_forbidden'] = '±z¥Ø«e¨S¦³Åv­­¶i¤JºÞ²z¤¶­±¡C½Ð¨ì³o¸Ìµn¤J¡C';
$messages['username'] = '¨Ï¥ÎªÌ¦WºÙ';
$messages['password'] = '¨Ï¥ÎªÌ±K½X';

// dashboard
$messages['dashboard'] = 'ºÞ²z­±ª©';
$messages['recent_articles'] = '³Ìªñµoªí¤å³¹';
$messages['recent_comments'] = '³Ìªñµoªí°jÅT';
$messages['recent_trackbacks'] = '³Ìªñ¤Þ¥Î¦Cªí';
$messages['blog_statistics'] = 'ºô»x²Î­p';
$messages['total_posts'] = '¤å³¹Á`¼Æ';
$messages['total_comments'] = '°jÅTÁ`¼Æ';
$messages['total_trackbacks'] = '¤Þ¥ÎÁ`¼Æ';
$messages['total_viewed'] = '¤å³¹¾\ÅªÁ`¼Æ';
$messages['in'] = '©ó';

// menu options
$messages['newPost'] = 'µoªí·s¤å³¹';
$messages['Manage'] = '¤º®eºÞ²z';
$messages['managePosts'] = '¤å³¹ºÞ²z';
$messages['editPosts'] = '¤å³¹¦Cªí';
$messages['editArticleCategories'] = '½s¿è¤å³¹¤ÀÃþ';
$messages['newArticleCategory'] = '·s¼W¤å³¹¤ÀÃþ';
$messages['manageLinks'] = 'ºô¯¸³sµ²ºÞ²z';
$messages['editLinks'] = 'ºô¯¸³sµ²¦Cªí';
$messages['newLink'] = '·s¼Wºô¯¸³sµ²';
$messages['editLink'] = '½s¿èºô¯¸³sµ²';
$messages['editLinkCategories'] = '½s¿èºô¯¸³sµ²¤ÀÃþ';
$messages['newLinkCategory'] = '·s¼W³sµ²¤ÀÃþ';
$messages['editLinkCategory'] = '½s¿èºô¯¸³sµ²¤ÀÃþ';
$messages['manageCustomFields'] = 'ºÞ²z¦Û­qÄæ¦ì';
$messages['blogCustomFields'] = '¦Û­qÄæ¦ì¦Cªí';
$messages['newCustomField'] = '·s¼W¦Û­qÄæ¦ì';
$messages['resourceCenter'] = 'ÀÉ®×¤¤¤ß';
$messages['resources'] = 'ÀÉ®×¦Cªí';
$messages['newResourceAlbum'] = '·s¼W¸ê®Æ§¨';
$messages['newResource'] = '·s¼WÀÉ®×';
$messages['controlCenter'] = '­Ó¤Hºô»x³]©w';
$messages['manageSettings'] = '°ò¥»³]©w';
$messages['blogSettings'] = 'ºô»x³]©w';
$messages['userSettings'] = '¨Ï¥ÎªÌ³]©w';
$messages['pluginCenter'] = '¥~±¾¤¤¤ß';
$messages['Stats'] = '²Î­p¸ê®Æ';
$messages['manageBlogUsers'] = 'ºÞ²zºô»x¨Ï¥ÎªÌ';
$messages['newBlogUser'] = '·s¼Wºô»x¨Ï¥ÎªÌ';
$messages['showBlogUsers'] = 'ºô»x¨Ï¥ÎªÌ¦Cªí';
$messages['manageBlogTemplates'] = 'ºÞ²zºô»x¼Òª©';
$messages['newBlogTemplate'] = '·s¼Wºô»x¼Òª©';
$messages['blogTemplates'] = 'ºô»x¼Òª©¦Cªí';
$messages['adminSettings'] = '¥þ³¡¯¸¥xºÞ±±';
$messages['Users'] = '¨Ï¥ÎªÌ';
$messages['createUser'] = '·s¼W¨Ï¥ÎªÌ';
$messages['editSiteUsers'] = 'ºÞ²z¨Ï¥ÎªÌ';
$messages['Blogs'] = 'ºÞ²zºô»x';
$messages['createBlog'] = '«Ø¥ßºô»x';
$messages['editSiteBlogs'] = 'ºô»x¯¸¥xºÞ²z';
$messages['Locales'] = '»y¨tºÞ²z';
$messages['newLocale'] = '·s¼W»y¨t';
$messages['siteLocales'] = '»y¨tÀÉ®×¦Cªí';
$messages['Templates'] = '¼Òª©ºÞ²z';
$messages['newTemplate'] = '·s¼W¼Òª©';
$messages['siteTemplates'] = '¼Òª©ºÞ²z';
$messages['GlobalSettings'] = '¥þ°ì³]©w';
$messages['editSiteSettings'] = '¥þ°ì³]©w';
$messages['summarySettings'] = ' ºK­n³]©w';
$messages['templateSettings'] = '¼Òª©³]©w';
$messages['urlSettings'] = 'ºô§}³]©w';
$messages['emailSettings'] = '¹q¤l¶l¥ó³]©w';
$messages['uploadSettings'] = '¤W¶Ç³]©w';
$messages['helpersSettings'] = '»¡©ú¤u¨ã³]©w';
$messages['interfacesSettings'] = '¥~³¡¤¶­±³]©w';
$messages['securitySettings'] = '¨t²Î¦w¥þ³]©w';
$messages['bayesianSettings'] = '¨©¤ó¹LÂo³]©w';
$messages['resourcesSettings'] = 'ÀÉ®×¤¤¤ß³]©w';
$messages['searchSettings'] = '·j´M³]©w';
$messages['cleanUpSection'] = '²M²z©U§£±M°Ï';
$messages['cleanUp'] = '²M²z©U§£';
$messages['editResourceAlbum'] = '½s¿èÀÉ®×¸ê®Æ§¨';
$messages['resourceInfo'] = 'ÀÉ®×¸ê°T';
$messages['editBlog'] = 'ºô»xºÞ²z';
$messages['Logout'] = 'µn¥X';

// new post
$messages['topic'] = '¼ÐÃD';
$messages['topic_help'] = '¤å³¹¼ÐÃD';
$messages['text'] = '¤º¤å';
$messages['text_help'] = '³o³¡¥÷ªº¤º®e·|¦bºô»x­º­¶¥X²{¡C';
$messages['extended_text'] = '©µ¦ù¤º¤å';
$messages['extended_text_help'] = '±z¦b¦¹¿é¤Jªº¤å¦r¥u·|¦b³æ½g·J¾ãª¬ºA¤UÅã¥Ü¡A°£«D±z¦b¡u³]©w¡v­¶­±¤¤­×§ï¤F³]©w¡C';
$messages['post_slug'] = 'µu¼ÐÃD ';
$messages['post_slug_help'] = 'µu¼ÐÃD±N·|¥Î¨Ó«Ø¥ßÂ²¼äªºÀRºA³sµ²ºô§}';
$messages['date'] = '¤é´Á';
$messages['post_date_help'] = '¤å³¹µoªí¤é´Á';
$messages['status'] = 'ª¬ºA';
$messages['post_status_help'] = '¿ï¨ú¤@­Óª¬ºA';
$messages['post_status_published'] = '©w½Z';
$messages['post_status_draft'] = '¯ó½Z';
$messages['post_status_deleted'] = '¤w§R°£';
$messages['categories'] = '¤å³¹¤ÀÃþ';
$messages['post_categories_help'] = '¿ï¨ú¤@­Ó©Î¤@­Ó¥H¤Wªº¤ÀÃþ';
$messages['post_comments_enabled_help'] = '±Ò¥Î°jÅT¯d¨¥¥\¯à';
$messages['send_notification_help'] = '¦pªG¦³¤H¹ï¥»¤åµoªí°jÅT¡A«K¦V§Úµo°e¹q¤l¶l¥ó³qª¾';
$messages['send_trackback_pings_help'] = 'µo°e¤Þ¥Î³q§i';
$messages['send_xmlrpc_pings_help'] = '°e¥X XMLRPC ³q§i';
$messages['save_draft_and_continue'] = 'Àx¦s¯ó½Z';
$messages['preview'] = '¹wÄý';
$messages['add_post'] = 'µoªí!';
$messages['error_saving_draft'] = 'Àx¦s¯ó½Zµo¥Í¿ù»~¡I';
$messages['draft_saved_ok'] = '¯ó½Z¤w¶¶§QÀx¦s';
$messages['error_sending_request'] = '¶Ç°e­n¨D®Éµo¥Í¿ù»~';
$messages['error_no_category_selected'] = '§A¨S¦³¿ï¾Ü¥ô¦ó¤ÀÃþ';
$messages['error_missing_post_topic'] = '½Ð¿é¤J¤å³¹¼ÐÃD¡I';
$messages['error_missing_post_text'] = '½Ð¿é¤J¤å³¹¤º¤å¡I';
$messages['error_adding_post'] = 'µoªí¤å³¹µo¥Í¿ù»~¡I';
$messages['post_added_not_published'] = '¤å³¹¤w¶¶§Q·s¼W¡A¦ý©|¥¼¥¿¦¡µoªí¡C';
$messages['post_added_ok'] = '¤å³¹¤w¶¶§Q·s¼W';
$messages['send_notifications_ok'] = '·í¦³·sªº°jÅT©Î¬O¤Þ¥Î®É¡A«K¦V§Úµo°e¹q¤l¶l¥ó³qª¾';

// send trackbacks
$messages['error_sending_trackbacks'] = 'µo°e¤U¦C¤Þ¥Î³qª¾®É²£¥Í¿ù»~¡C';
$messages['send_trackbacks_help'] = '½Ð¤Ä¿ï±z©Ò­nµo°e¤Þ¥Î³q§iªººô§}¡C(½Ð½T©w¸Óºô¯¸¤ä´©¤Þ¥Î³q§iªº¥\¯à)';
$messages['send_trackbacks'] = 'µo°e¤Þ¥Î³qª¾';
$messages['ping_selected'] = '¦V¤Ä¿ïªººô§}µo°e¤Þ¥Î³qª¾';
$messages['trackbacks_sent_ok'] = '¤Þ¥Î³qª¾¤w¸g¦¨¥\µo°e¨ì¤Ä¿ïªººô§}¡C';

// posts page
$messages['show_by'] = '§ó·s¦Cªí';
$messages['category'] = '¤ÀÃþ';
$messages['author'] = '§@ªÌ';
$messages['post_status_all'] = '¥þ³¡';
$messages['author_all'] = '¥þ³¡§@ªÌ';
$messages['search_terms'] = '·j´MÃöÁä¦r';
$messages['show'] = '§ó·s';
$messages['delete'] = '§R°£';
$messages['actions'] = '°Ê§@';
$messages['all'] = '¥þ³¡';
$messages['category_all'] = '¥þ³¡¤ÀÃþ';
$messages['error_incorrect_article_id'] = '¤å³¹ID¤£¥¿½T¡C';
$messages['error_deleting_article'] = '¦b§R°£¤å³¹"%s"®É¡Aµo¥Í¿ù»~¡C';
$messages['article_deleted_ok'] = '¤å³¹¡u%s¡v ¤w¶¶§Q§R°£¡C';
$messages['articles_deleted_ok'] = '¤å³¹¡u%s¡v ¤w¶¶§Q§R°£¡C';
$messages['error_deleting_article2'] = '§R°£¤å³¹®Éµo¥Í¿ù»~ (id = %s) ';

// edit post page
$messages['update'] = '§ó·s';
$messages['editPost'] = '½s¿è¤å³¹';
$messages['error_fetching_post'] = 'Åª¨ú¤å³¹¸ê®Æ®Éµo¥Í¿ù»~';
$messages['post_updated_ok'] = '¤å³¹[%s]¤w¦¨¥\§ó·s¡C';
$messages['error_updating_post'] = '§ó·s¤å³¹®Éµo¥Í¿ù»~';
$messages['notification_added'] = '·í¦³·sªº°jÅT©Î¬O¤Þ¥Î®É¡A«K¦V§Úµo°e¹q¤l¶l¥ó³qª¾';
$messages['notification_removed'] = '·í¦³·sªº°jÅT©Î¬O¤Þ¥Î®É¡A¤£­n¦V§Úµo°e¹q¤l¶l¥ó³qª¾';

// post comments
$messages['url'] = 'ºô§}';
$messages['comment_status_all'] = '¥þ³¡°jÅT';
$messages['comment_status_spam'] = '©U§£°jÅT';
$messages['comment_status_nonspam'] = '¥¿±`°jÅT';
$messages['error_fetching_comments'] = 'Åª¨ú¤å³¹°jÅT¸ê®Æ®É¡Aµo¥Í¿ù»~¡C';
$messages['error_deleting_comments'] = '¦b§R°£°jÅT®Éµo¥Í¿ù»~©Î±z¨S¦³¤Ä¿ï¥ô¦ó­n§R°£ªº°jÅT¡C';
$messages['comment_deleted_ok'] = '¡u%s¡v³o½g¤å³¹ªº°jÅT¤w¶¶§Q§R°£¡C';
$messages['comments_deleted_ok'] = '¡u%s¡v³o½g¤å³¹ªº°jÅT¤w¶¶§Q§R°£¡C';
$messages['error_deleting_comment'] = '¦b§R°£°jÅT¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_deleting_comment2'] = '§R°£°jÅT®Éµo¥Í¿ù»~ (id = %s)';
$messages['editComments'] = '½s¿è°jÅT';
$messages['mark_as_spam'] = '¼Ð¥Ü¬°©U§£°jÅT';
$messages['mark_as_no_spam'] = '¼Ð¥Ü¬°¥¿±`°jÅT';
$messages['error_incorrect_comment_id'] = '¯d¨¥°jÅTID¤£¥¿½T¡C';
$messages['error_marking_comment_as_spam'] = '¦b±N¥»½g°jÅT¯d¨¥¼Ð¥Ü¬°©U§£¯d¨¥®Éµo¥Í¿ù»~¡C';
$messages['comment_marked_as_spam_ok'] = '±z¤w¸g¶¶§Q±N¥»½g°jÅT¯d¨¥¼Ð¥Ü¬°©U§£¯d¨¥¡C';
$messages['error_marking_comment_as_nonspam'] = '¦b±N¥»½g°jÅT¯d¨¥¼Ð¥Ü¬°¥¿±`¯d¨¥®Éµo¥Í¿ù»~¡C';
$messages['comment_marked_as_nonspam_ok'] = '±z¤w¸g¶¶§Q±N¥»½g°jÅT¯d¨¥¼Ð¥Ü¬°¥¿±`¯d¨¥¡C';

// post trackbacks
$messages['blog'] = 'ºô»x';
$messages['excerpt'] = 'ºK­n';
$messages['error_fetching_trackbacks'] = 'Åª¨ú¤Þ¥Î¸ê®Æ®É¡Aµo¥Í¿ù»~¡C';
$messages['error_deleting_trackbacks'] = '¦b§R°£¤Þ¥Î®Éµo¥Í¿ù»~©Î¬O§A¨S¦³¤Ä¿ï¥ô¦ó­n§R°£ªº¤Þ¥Î¡C';
$messages['error_deleting_trackback'] = '¦b§R°£¤Þ¥Î¡u%s¡v®Éµo¥Í¿ù»~';
$messages['error_deleting_trackback2'] = '§R°£¤Þ¥Î®Éµo¥Í¿ù»~ (id = %s)';
$messages['trackback_deleted_ok'] = '¡u%s¡v³o½g¤Þ¥Î¤w¶¶§Q§R°£¡C';
$messages['trackbacks_deleted_ok'] = '¡u%s¡v³o½g¤Þ¥Î¤w¶¶§Q§R°£¡C';
$messages['editTrackbacks'] = '½s¿è¤Þ¥Î';

// post statistics
$messages['referrer'] = '°f¦V³sµ²';
$messages['hits'] = 'ÂIÀ»¼Æ';
$messages['error_no_items_selected'] = '§A¨S¦³¤Ä¿ï¥ô¦ó­n§R°£ªº¶µ¥Ø';
$messages['error_deleting_referrer'] = '¦b§R°£°f¦V³sµ²¡u%s¡v®Éµo¥Í¿ù»~';
$messages['error_deleting_referrer2'] = '§R°£°f¦V³sµ²®Éµo¥Í¿ù»~ (id = %s)';
$messages['referrer_deleted_ok'] = '¡u%s¡v³o½g°f¦V³sµ²¤w¶¶§Q§R°£¡C';
$messages['referrers_deleted_ok'] = '¡u%s¡v³o½g°f¦V³sµ²¤w¶¶§Q§R°£¡C';

// categories
$messages['posts'] = '¤å³¹¦Cªí';
$messages['show_in_main_page'] = '¦b­º­¶Åã¥Ü';
$messages['error_incorrect_category_id'] = '¤å³¹¤ÀÃþID¿ù»~©Î¨S¦³¿ï¨ú¥ô¦ó¶µ¥Ø';
$messages['error_category_has_articles'] = 'µLªk§R°£¡u%s¡v³o­Ó¤ÀÃþ¡A¦]¬°¸Ó¤ÀÃþ¤UÁÙ¦³¤å³¹¡C½Ð¥ý­×§ï¤å³¹¤ÀÃþ«á¡A¦A­«¸Õ¤@¦¸¡C';
$messages['category_deleted_ok'] = '¡u%s¡v³o­Ó¤ÀÃþ¤w¶¶§Q§R°£¡C';
$messages['categories_deleted_ok'] = '¡u%s¡v³o­Ó¤ÀÃþ¤w¶¶§Q§R°£¡C';
$messages['error_deleting_category'] = '¦b§R°£¤ÀÃþ¡u%s¡v®Éµo¥Í¿ù»~';
$messages['error_deleting_category2'] = '§R°£¤ÀÃþ®Éµo¥Í¿ù»~ (id = %s)';
$messages['yes'] = '¬O';
$messages['no'] = '§_';

// new category
$messages['name'] = '¦WºÙ';
$messages['category_name_help'] = '½Ð¿é¤J¤ÀÃþ¦WºÙ';
$messages['description'] = '¤ÀÃþ´y­z';
$messages['category_description_help'] = '½Ð¿é¤J¸Ô²Óªº¤ÀÃþ´y­z';
$messages['show_in_main_page_help'] = '¿ï¨ú³o­Ó¿ï¶µ¡A«h¦b³o­Ó¤ÀÃþ¤Uªº¤å³¹·|¦b­º­¶Åã¥Ü¡C§_«h¥u¦³·íÂsÄý³o­Ó¤ÀÃþ®É¤~·|¬Ý¨ì¤å³¹¡C';
$messages['error_empty_name'] = '§A¥²¶·¿é¤J¤ÀÃþ¦WºÙ';
$messages['error_empty_description'] = '§A¥²¶·¿é¤J¤ÀÃþ´y­z';
$messages['error_adding_article_category'] = '¦b·s¼W¤ÀÃþ®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ¡A¦A­«¸Õ¤@¦¸¡C';
$messages['category_added_ok'] = '¤ÀÃþ¦WºÙ ¡u%s¡v¤w¸g¶¶§Q·s¼W';
$messages['add'] = '·s¼W';
$messages['reset'] = '­«·s³]¸m';

// update category
$messages['error_updating_article_category'] = '§ó·s¤å³¹¤ÀÃþ®Éµo¥Í¿ù»~¡C';
$messages['error_fetching_category'] = 'Åª¨ú¤ÀÃþ¸ê®Æ®Éµo¥Í¿ù»~¡C';
$messages['article_category_updated_ok'] = '¤ÀÃþ ¡u%s¡v ¤w¶¶§Q§ó·s¡C';

// links
$messages['feed'] = 'Feed';
$messages['error_no_links_selected'] = 'ºô¯¸³sµ²ID¿ù»~©Î±z¨S¦³¿ï¾Ü¥ô¦óºô¯¸³sµ²¡AµLªk§R°£¡C';
$messages['error_incorrect_link_id'] = 'ºô¯¸³sµ²ID¤£¥¿½T';
$messages['error_removing_link'] = '¦b§R°£ºô¯¸³sµ²¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_removing_link2'] = '¦b§R°£ºô¯¸³sµ²®Éµo¥Í¿ù»~¡Aid = %d';
$messages['link_deleted_ok'] = 'ºô¯¸³sµ²¡u%s¡v¤w¶¶§Q§R°£¡C';
$messages['links_deleted_ok'] = 'ºô¯¸³sµ²¡u%s¡v¤w¶¶§Q§R°£¡C';

// new link
$messages['link_name_help'] = '½Ð¿é¤J³sµ²¦WºÙ¡C';
$messages['link_url_help'] = '³sµ²ºô§}';
$messages['link_description_help'] = 'Â²µu´y­z';
$messages['link_feed_help'] = '§A¤]¥i¥H´£¨Ñ¥ô¦óªº RSS ©Î Atom feeds ªº³sµ²¡C';
$messages['link_category_help'] = '¿ï¨ú¤@­Óºô¯¸³sµ²¤ÀÃþ';
$messages['error_adding_link'] = '·s¼Wºô¯¸³sµ²®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ¡A¦A­«¸Õ¤@¦¸¡C';
$messages['error_invalid_url'] = 'ºô§}¤£¥¿½T';
$messages['link_added_ok'] = 'ºô¯¸³sµ²¡u%s¡v¤w¶¶§Q·s¼W';

// update link
$messages['error_updating_link'] = '§ó·sºô¯¸³sµ²®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ¡A¦A­«¸Õ¤@¦¸¡C';
$messages['error_fetching_link'] = 'Åª¨úºô¯¸³sµ²¸ê®Æ®Éµo¥Í¿ù»~¡C';
$messages['link_updated_ok'] = 'ºô¯¸³sµ²¡u%s¡v¤w¶¶§Q§ó·s';

// link categories
$messages['links'] = 'ºô¯¸³sµ²';
$messages['error_invalid_link_category_id'] = 'ºô¯¸³sµ²¤ÀÃþID¤£¥¿½T©Î¨S¦³¿ï¾Ü³sµ²¤ÀÃþ¡AµLªk§R°£¡C';
$messages['error_links_in_link_category'] = 'µLªk§R°£¡u%s¡v³o­Óºô¯¸³sµ²¤ÀÃþ¡A¦]¬°¸Ó¤ÀÃþ¤UÁÙ¦³³sµ²¡C½Ð¥ý­×§ïºô¯¸³sµ²«á¡A¦A­«¸Õ¤@¦¸¡C';
$messages['error_removing_link_category'] = '¦b§R°£ºô¯¸³sµ²¤ÀÃþ¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['link_category_deleted_ok'] = 'ºô¯¸³sµ²¤ÀÃþ¡u%s¡v¤w¶¶§Q§R°£¡C';
$messages['link_categories_deleted_ok'] = 'ºô¯¸³sµ²¤ÀÃþ¡u%s¡v¤w¶¶§Q§R°£¡C';
$messages['error_removing_link_category2'] = '§R°£ºô¯¸³sµ²¤ÀÃþ®Éµo¥Í¿ù»~ (id = %s)';

// new link category
$messages['link_category_name_help'] = 'ºô¯¸³sµ²¤ÀÃþ¦WºÙ';
$messages['error_adding_link_category'] = '·s¼Wºô¯¸³sµ²¤ÀÃþ®Éµo¥Í¿ù»~¡C';
$messages['link_category_added_ok'] = 'ºô¯¸³sµ²¤ÀÃþ¡u%s¡v¤w¶¶§Q·s¼W';

// edit link category
$messages['error_updating_link_category'] = '§ó·sºô¯¸³sµ²¤ÀÃþ®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¡A¦A¸Õ¤@¦¸¡C';
$messages['link_category_updated_ok'] = 'ºô¯¸³sµ²¤ÀÃþ¡u%s¡v¤w¶¶§Q§ó·s';
$messages['error_fetching_link_category'] = 'Åª¨úºô¯¸³sµ²¤ÀÃþ¸ê®Æ®Éµo¥Í¿ù»~¡C';

// custom fields
$messages['type'] = 'Ãþ«¬';
$messages['hidden'] = 'ÁôÂÃ';
$messages['fields_deleted_ok'] = '¡u%s¡v ¦Û­qÄæ¦ì¤w¶¶§Q§R°£';
$messages['field_deleted_ok'] = '¡u%s¡v ¦Û­qÄæ¦ì¤w¶¶§Q§R°£';
$messages['error_deleting_field'] = '¦b§R°£¦Û­qÄæ¦ì¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_deleting_field2'] = '§R°£¦Û­qÄæ¦ì®Éµo¥Í¿ù»~ (id = %s)';
$messages['error_incorrect_field_id'] = '¦Û­qÄæ¦ìID¤£¥¿½T';

// new custom field
$messages['field_name_help'] = '¦bµoªí¤å³¹®É¡A¥Î¨ÓÅã¥Ü¦Û­qÄæ¦ìªº¦WºÙ';
$messages['field_description_help'] = '¦Û­qÄæ¦ìªºÂ²µu´y­z';
$messages['field_type_help'] = '¿ï¾Ü¤@­Ó¦X¾AªºÄæ¦ìÃþ«¬';
$messages['field_hidden_help'] = '¦pªG¤Ä¿ïÁôÂÃ¡A¨º»ò¦b·s¼W©Î­×§ï¤å³¹®É«K¤£·|¥X²{¸Ó¦Û­qÄæ¦ì¡C³o­Ó¥\¯à¥D­n´£¨Ñµ¹¥~±¾µ{¦¡±M¥Î¡C';
$messages['error_adding_custom_field'] = '·s¼W¦Û­qÄæ¦ì®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¡A¦A¸Õ¤@¦¸¡C';
$messages['custom_field_added_ok'] = '¦Û­qÄæ¦ì¡u%s¡v¤w¶¶§Q§ó·s';
$messages['text_field'] = '¤å¦rÄæ¦ì(Text field)';
$messages['text_area'] = '¤å¦r°Ï¶ô(Text box)';
$messages['checkbox'] = '®Ö¨ú¤è¶ô(Checkbox)';
$messages['date_field'] = '¤é´Á¿ï¾Ü(Date chooser)';

// edit custom field
$messages['error_fetching_custom_field'] = 'Åª¨ú¦Û­qÄæ¦ì¸ê®Æ®Éµo¥Í¿ù»~¡C';
$messages['error_updating_custom_field'] = '§ó·s¦Û­qÄæ¦ì®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¡A¦A¸Õ¤@¦¸¡C';
$messages['custom_field_updated_ok'] = '¦Û­qÄæ¦ì¡u%s¡v¤w¶¶§Q§ó·s';

// resources
$messages['root_album'] = '¥D¸ê®Æ§¨';
$messages['num_resources'] = 'ÀÉ®×¼Æ';
$messages['total_size'] = 'ÀÉ®×¤j¤p';
$messages['album'] = '¸ê®Æ§¨';
$messages['error_incorrect_album_id'] = '¸ê®Æ§¨ID¤£¥¿½T';
$messages['error_base_storage_folder_missing_or_unreadable'] = 'pLogµLªk«Ø¥ßÀÉ®×¦sÀÉ©Ò¥²»Ýªº¸ê®Æ§¨¡C ­ì¦]¥i¯à¬O¦]¬°PHP¥H¦w¥þ¼Ò¦¡¦b°õ¦æ©Î¬O§A¨S¦³¨¬°÷ªºÅv­­¤W¶ÇÀÉ®×¡C §A¥i¥H¸ÕµÛ¤â°Ê«Ø¥ß¤U¦C¸ê®Æ§¨: <br/><br/>%s<br/><br/>¦pªG³o¨Ç¸ê®Æ§¨¤w¸g¦s¦b¡A½Ð½T©w§A¥i¥H¨Ï¥ÎÂsÄý¾¹¨Ó¶i¦æÅª¼g¡C';
$messages['items_deleted_ok'] = '¡u%s¡v¤w¶¶§Q§R°£';
$messages['error_album_has_children'] = '¡u%s¡v¸ê®Æ§¨¸Ì­±ÁÙ¦³ÀÉ®×©Î¤l¸ê®Æ§¨¡C½Ð±NÀÉ®×©Î¸ê®Æ§¨²¾°£«á¦b­«¸Õ¤@¦¸¡C';
$messages['item_deleted_ok'] = '¡u%s¡v¤w¶¶§Q§R°£';
$messages['error_deleting_album'] = '¦b§R°£¸ê®Æ§¨¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_deleting_album2'] = '§R°£¸ê®Æ§¨®Éµo¥Í¿ù»~ (id = %s)';
$messages['error_deleting_resource'] = '¦b§R°£ÀÉ®×¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_deleting_resource2'] = '§R°£ÀÉ®×®Éµo¥Í¿ù»~ (id = %s)';
$messages['error_no_resources_selected'] = '¨S¦³¿ï¾Ü­n§R°£ªº¶µ¥Ø¡C';
$messages['resource_deleted_ok'] = 'ÀÉ®×¡G¡u%s¡v ¤w¶¶§Q§R°£';
$messages['album_deleted_ok'] = '¸ê®Æ§¨¡G¡u%s¡v ¤w¶¶§Q§R°£';
$messages['add_resource'] = '·s¼WÀÉ®× (­ì¹Ï)';
$messages['add_resource_preview'] = '·s¼WÀÉ®×¹wÄý (¤p¹Ï)';
$messages['add_resource_medium'] = '·s¼WÀÉ®×¹wÄý (¤¤¹Ï)';
$messages['add_album'] = '·s¼W¸ê®Æ§¨';

// new album
$messages['album_name_help'] = '¸ê®Æ§¨Â²µu¦WºÙ';
$messages['parent'] = '¤W¼h¥Ø¿ý';
$messages['no_parent'] = '³»ºÝ¥Ø¿ý';
$messages['parent_album_help'] = '¨Ï¥Î³o­Ó¿ï¶µ¨Ó¦w±Æ¤l¸ê®Æ§¨¡A¦P®ÉÅý§AªºÀÉ®×©ñ¸m§ó¦³²ÕÂ´¡C';
$messages['album_description_help'] = '¹ï¸ê®Æ§¨¤º®e°µ¸Ô²Óªº´y­z»¡©ú¡C';
$messages['error_adding_album'] = '·s¼W¸ê®Æ§¨®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¡A¦A¸Õ¤@¦¸¡C';
$messages['album_added_ok'] = '¸ê®Æ§¨¡G¡u%s¡v ¤w¶¶§Q·s¼W¡C';

// edit album
$messages['error_incorrect_album_id'] = '¸ê®Æ§¨ID¤£¥¿½T¡C';
$messages['error_fetching_album'] = 'Åª¨ú¸ê®Æ§¨¸ê®Æ®Éµo¥Í¿ù»~¡C';
$messages['error_updating_album'] = '§ó·s¸ê®Æ§¨®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¡A¦A¸Õ¤@¦¸¡C';
$messages['album_updated_ok'] = '¸ê®Æ§¨¡u%s¡v¤w¶¶§Q§ó·s';
$messages['show_album_help'] = '¨ú®ø¤Ä¿ï¡A³o­Ó¸ê®Æ§¨±N¤£·|¥X²{¦bºô»x¸ê®Æ§¨¦Cªí¤¤¡C';

// new resource
$messages['file'] = 'ÀÉ®×';
$messages['resource_file_help'] = '¤U­±ªºÀÉ®×±N·|·s¼W¨ìºô»xªºÀÉ®×¤¤¤ß¡C¦pªG§A­n¦P®É¤W¶Ç¦h­ÓÀÉ®×¡A½Ð¨Ï¥Î¤U¤è¡u·s¼W¤W¶ÇÄæ¦ì¡vªº³sµ²¨Ó·s¼WÄæ¦ì¡C';
$messages['add_field'] = '·s¼W¤W¶ÇÄæ¦ì';
$messages['resource_description_help'] = 'Ãö©ó³o­ÓÀÉ®×¤º®eªº¸Ô²Ó´y­z¡C';
$messages['resource_album_help'] = '¿ï¾Ü§A·Q±NÀÉ®×¤W¶Ç¨ì¨º­Ó¸ê®Æ§¨¡C';
$messages['error_no_resource_uploaded'] = '§A¨Ã¥¼¿ï¾Ü¥ô¦ó­n¤W¶ÇªºÀÉ®×¡C';
$messages['resource_added_ok'] = 'ÀÉ®×¡G¡u%s¡v¤w¶¶§Q·s¼W¡C';
$messages['error_resource_forbidden_extension'] = 'µLªk·s¼WÀÉ®×¡A¦]¬°¥Î¤F¨t²Î¤£¤¹³\ªº°ÆÀÉ¦W¡C';
$messages['error_resource_too_big'] = 'µLªk·s¼WÀÉ®×¡A¦]¬°ÀÉ®×¤Ó¤j¤F¡C';
$messages['error_uploads_disabled'] = 'µLªk·s¼WÀÉ®×¡A¦]¬°¦øªA¾¹ºÞ²z­ûÃö³¬¤F³o¶µ¥\¯à¡C';
$messages['error_quota_exceeded'] = 'µLªk·s¼WÀÉ®×¡A¦]¬°¤w¸g¶W¹L®e³\ªºÀÉ®×®e¶q­­«×¡C';
$messages['error_adding_resource'] = '¦b·s¼WÀÉ®×®Éµo¥Í¿ù»~¡C';

// edit resource
$messages['editResource'] = '½s¿èÀÉ®×';
$messages['resource_information_help'] = '¤U­±¬O¤@¨Ç»P³o­ÓÀÉ®×¦³Ãöªº¸ê°T';
$messages['information'] = 'ÀÉ®×¸ê°T';
$messages['size'] = 'ÀÉ®×¤j¤p';
$messages['format'] = 'ÀÉ®×®æ¦¡';
$messages['dimensions'] = 'ºû«×';
$messages['bits_per_sample'] = '¼Ë¥»¦ì¤¸²v';
$messages['sample_rate'] = '¨ú¼Ë¤ñ¨Ò';
$messages['number_of_channels'] = 'ÀW¹D¼Æ¥Ø';
$messages['legnth'] = 'ªø«×';
$messages['thumbnail_format'] = 'ÁY¹Ï®æ¦¡';
$messages['regenerate_preview'] = '­«·s²£¥Í¹wÄýÁY¹Ï';
$messages['error_fetching_resource'] = 'Åª¨úÀÉ®×¸ê°T®Éµo¥Í¿ù»~¡C';
$messages['error_updating_resource'] = '§ó·sÀÉ®×®Éµo¥Í¿ù»~¡C';
$messages['resource_updated_ok'] = 'ÀÉ®×¡G¡u%s¡v¤w¶¶§Q§ó·s¡C';

// blog settings
$messages['blog_link'] = 'ºô»x¯¸¥xºô§}';
$messages['blog_link_help'] = '¤£¯à­×§ï';
$messages['blog_name_help'] = '¯¸¥x¦WºÙ';
$messages['blog_description_help'] = '¯¸¥x¬ÛÃö»¡©ú';
$messages['language'] = '»y¨t';
$messages['blog_language_help'] = '¨t²Î¤å¦r¥H¤Î¤é´Á©Ò¨Ï¥Îªº»y¨¥';
$messages['max_main_page_items'] = '­º­¶¤å³¹¼Æ¥Ø';
$messages['max_main_page_items_help'] = '±z­n¦b­º­¶Åã¥Ü´X½g¤å³¹¡H';
$messages['max_recent_items'] = 'ªñ´Á¤å³¹¼Æ¥Ø';
$messages['max_recent_items_help'] = '±z­n¦b¡uªñ´Á¤å³¹¦Cªí¡vÅã¥Ü´X½g¤å³¹¡H';
$messages['template'] = '¼Òª©';
$messages['choose'] = '¹wÄý¿ï¨ú...';
$messages['blog_template_help'] = '½Ð¿ï¾Ü±zªººô»x¯¸¥x©Ò­n¨Ï¥Îªº¥~Æ[¼Ë¦¡¼Òª©';
$messages['use_read_more'] = '¦b¤å³¹¨Ï¥Î¡u¾\Åª¥þ¤å...¡v³sµ²';
$messages['use_read_more_help'] = '¦pªG³]©w¬°¡u¬O¡v¡A¨º»ò±z¦b­º­¶ªº¤å³¹´N·|¦Û°Ê²£¥Í¡u¾\Åª¥þ¤å¡v³sµ²¡A³o­Ó³sµ²·|³s¨ì³æ½g¤å³¹ªºÀRºA©T©wºô§}¡A¦AÅã¥Ü¥þ¤åªº¡u©µ¦ù¤º¤å³¡¤À¡v¡C';
$messages['enable_wysiwyg'] = '±Ò¥Î©Ò¨£§Y©Ò±o¡]WYSIWYG¡^¤å³¹½s¿è¡C';
$messages['enable_wysiwyg_help'] = '¦pªG±z·Q­n¥ß¨è¬Ý¨ì±zªº½s¿èµ²ªG¡A½Ð³]©w¬°¡u¬O¡v¡C³o­Ó¥\¯à¥u¦³¦b¨Ï¥ÎªÌ¨Ï¥ÎInternet Explorer 5.5©ÎMozilla 1.3b¥H¤Wªºª©¥»¤~¦³®ÄªG¡C';
$messages['enable_comments'] = '¶}©ñ©Ò¦³¤å³¹ªº°jÅT¯d¨¥Åv­­';
$messages['enable_comments_help'] = '¦pªG³]©w¬°¡u¬O¡v¡A¨º»ò±z«K¥i¥HÅý¨ä¥L¨Ï¥ÎªÌ°w¹ï±zªº¤å³¹µoªí°jÅT¯d¨¥¡C³o­Ó³]©w·|®M¥Î¨ì±zªº¥þ³¡¤å³¹¤W¡C';
$messages['show_future_posts'] = '¦b¤é¾äÅã¥Ü¥¼¨Ó¤å³¹¡C';
$messages['show_future_posts_help'] = '¦pªG³]©w¬°¡u¬O¡v¡A¨º»òµoªí¤é´Á³]©w¦b¥¼¨Óªº¤å³¹±N·|¥X²{¦b¤é¾ä¤W¡C';
$messages['comments_order'] = '°jÅT¯d¨¥±Æ§Ç¤è¦¡';
$messages['comments_order_help'] = '¦pªG±z³]©w¦¨¡uÂÂªº¦b«e¡v¡A¨º»ò¯d¨¥´N·|±qÂÂ¨ì·s±Æ§Ç¡A¦pªG³]©w¦¨¡u·sªº¦b«e¡v¡A«h¤Ï¤§¡A¯d¨¥±q·s¨ìÂÂ±Æ§Ç¥X²{¡C';
$messages['oldest_first'] = 'ÂÂªº¦b«e';
$messages['newest_first'] = '·sªº¦b«e';
$messages['categories_order'] = '¤ÀÃþ±Æ¦C¶¶§Ç';
$messages['categories_order_help'] = '­º­¶¤ÀÃþ±Æ¦C¤è¦¡¡C';
$messages['most_recent_updated_first'] = '³Ìªñ§ó·s¦b«e';
$messages['alphabetical_order'] = '¨Ì­^¤å¦r¥À¶¶§Ç±Æ¦C';
$messages['reverse_alphabetical_order'] = '¨Ì­^¤å¦r¥À¶¶§Ç¤Ï¦V±Æ¦C';
$messages['most_articles_first'] = '³Ì¦h¤å³¹¦b«e';
$messages['link_categories_order'] = 'ºô¯¸³sµ²¤ÀÃþ±Æ¦C¶¶§Ç';
$messages['link_categories_order_help'] = '­º­¶ºô¯¸³sµ²¤ÀÃþ±Æ¦C¤è¦¡¡C';
$messages['most_links_first'] = '³Ì¦h³sµ²¦b«e';
$messages['most_links_last'] = '³Ì¦h³sµ²¦b«á';
$messages['time_offset'] = 'ºô»x¦øªA¾¹»P±z©Ò¦b¦aªº®É¶¡®t';
$messages['time_offset_help'] = '±z¥i¥H¥Î³o­Ó³]©w¡A½Õ¾ã±z©Òµoªíªº¤å³¹ªº®É¶¡¡C³o­Ó¥\¯à¦b¦øªA¾¹¥D¾÷»P±z¤À§O¦b¤£¦P®É°Ï®É¬Û·í¦³¥Î¡C¦pªG±z±N®É¶¡®t³]©w¬°¡u+3 ¤p®É¡v¡A¨º»ò¨t²Î´N·|±N¤å³¹ªºµoªí®É¶¡½Õ¾ã¦¨±z©Ò³]©wªº®É¶¡¡C';
$messages['close'] = 'Ãö³¬';
$messages['select'] = '¿ï¾Ü';
$messages['error_updating_settings'] = '§ó·sºô»x³]©w®Éµo¥Í¿ù»~¡A½ÐÀË¬d¿é¤J¸ê®Æ«á¦b­«¸Õ¤@¦¸¡C';
$messages['error_invalid_number'] = '¼Æ¥Ø®æ¦¡¤£¥¿½T¡C';
$messages['error_incorrect_time_offset'] = 'ºô»x¦øªA¾¹»P±z©Ò¦b¦aªº®É¶¡®t¤£¥¿½T';
$messages['blog_settings_updated_ok'] = 'ºô»x³]©w§ó·s¤w¶¶§Q§¹¦¨¡C';
$messages['hours'] = '¤p®É';

// user settings
$messages['username_help'] = '¤½¶}ªº¨Ï¥ÎªÌ¦WºÙ¡AµLªk§ó§ï¡C';
$messages['full_name'] = '¥þ¦W';
$messages['full_name_help'] = '§¹¾ãªº¨Ï¥ÎªÌ¦WºÙ';
$messages['password_help'] = '¦pªG§A·Q§ó§ï±K½X½Ð¿é¤J·s±K½X¤Î½T»{±K½X¡F¦pªG±z¤£·Q­×§ï±K½X¡A¯d¥Õ«K¥i¡C';
$messages['confirm_password'] = '½T»{±K½X';
$messages['email'] = '¹q¤l¶l¥ó';
$messages['email_help'] = '¦pªG±z·Q­n¨Ï¥Î¹q¤l¶l¥ó³qª¾«H¥\¯à¡A½Ð¶ñ¼g¥¿½Tªº«H½c¡C';
$messages['bio'] = '¦Û§Ú¤¶²Ð';
$messages['bio_help'] = '±z¥i¥H¦b¦¹¶ñ¼g¤@¨Ç±zªº¦Û§Ú¤¶²Ð¡A©Î¬O¤£¶ñ¤]¥i¥H¡C';
$messages['picture'] = '­Ó¤H¹Ï¹³';
$messages['user_picture_help'] = '½Ð±q¤W¶Ç¨ìºô»x¤¤ªº¹Ï¤ù¿ï¨ú¤@±i°µ¬°§Aªº­Ó¤H¤jÀY¶K¡C';
$messages['error_invalid_password'] = '±K½X¤Óµu©Î±K½X¿ù»~¡C';
$messages['error_passwords_dont_match'] = '«Ü©êºp¡A±z¿é¤Jªº¨â¦¸±K½X¤£¬Û²Å¡C';
$messages['error_incorrect_email_address'] = '¹q¤l¶l¥ó«H½c®æ¦¡¿ù»~¡C';
$messages['error_updating_user_settings'] = '§ó·s­Ó¤H¸ê®Æ®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ«á¦b­«¸Õ¤@¦¸¡C';
$messages['user_settings_updated_ok'] = '¨Ï¥ÎªÌ³]©w¤w¶¶§Q§ó·s¡C';
$messages['resource'] = 'ÀÉ®×';

// plugin centre
$messages['identifier'] = '¥N¸¹';
$messages['error_plugins_disabled'] = '«Ü©êºp¡A¥~±¾¥Ø«e°±¥Î¤¤¡C';

// blog users
$messages['revoke_permissions'] = '¨ú®ø¨Ï¥ÎÅv­­¡C';
$messages['error_no_users_selected'] = '§A¨S¦³¿ï¨ú¥ô¦ó¨Ï¥ÎªÌ¡C';
$messages['user_removed_from_blog_ok'] = '¨Ï¥ÎªÌ¡u%s¡v¤w¸g¶¶§Q±q¥»¯¸§@ªÌ¦æ¦C¤¤§R°£¡C';
$messages['users_removed_from_blog_ok'] = '¨Ï¥ÎªÌ¡u%s¡v¤w¸g¶¶§Q±q¥»¯¸§@ªÌ¦æ¦C¤¤§R°£¡C';
$messages['error_removing_user_from_blog'] = '¦b±N¨Ï¥ÎªÌ¡u%s¡v±q¥»ºô»x¯¸¥x§@ªÌ¦æ¦C¤¤²¾°£®Éµo¥Í¿ù»~¡C';
$messages['error_removing_user_from_blog2'] = '¦b±N¨Ï¥ÎªÌ±q¥»ºô»x¯¸¥x§@ªÌ¦æ¦C¤¤²¾°£®Éµo¥Í¿ù»~¡C(id:%s)';

// new blog user
$messages['new_blog_username_help'] = '±z¥i¥H¥Î¥H¤Uªí³æ¡A±N¨ä¥L¨Ï¥ÎªÌ¥[¤J±zªººô»x§@ªÌ¦æ¦C¤¤¡C·s¼W¥[ªº¨Ï¥ÎªÌ¥u¯à¦s¨úºÞ²z¤¤¤ß¤ÎÀÉ®×¤¤¤ß¡C';
$messages['send_notification'] = 'µo°e³qª¾';
$messages['send_user_notification_help'] = '¥Î¹q¤l¶l¥ó³qª¾³o¦W¨Ï¥ÎªÌ¡C';
$messages['notification_text'] = '³qª¾¤º®e';
$messages['notification_text_help'] = '½Ð¿é¤J±z­n³qª¾³o¦ì¨Ï¥ÎªÌªº«H¥ó¤º®e';
$messages['error_adding_user'] = '¦b¥[¤J¨Ï¥ÎªÌ®Éµo¥Í°ÝÃD¡A½ÐÀË¬d¿é¤Jªº¸ê®Æ¦b­«¸Õ¤@¦¸¡C';
$messages['error_empty_text'] = '³qª¾¤º®e¤£¥i¥H¬OªÅ¥Õ¡C';
$messages['error_adding_user'] = '¦b¥[¤J¨Ï¥ÎªÌ®Éµo¥Í°ÝÃD¡A½ÐÀË¬d¿é¤Jªº¸ê®Æ¦b­«¸Õ¤@¦¸¡C';
$messages['error_invalid_user'] = '¨Ï¥ÎªÌ¡u%s¡v±b¸¹¤£¥¿½T©Î¸Ó¨Ï¥ÎªÌ¤£¦s¦b¡C';
$messages['user_added_to_blog_ok'] = '¨Ï¥ÎªÌ¡u%s¡v¤w¸g¶¶§Q¥[¤J§@ªÌ¦æ¦C¡C';

// blog templates
$messages['error_no_templates_selected'] = '±z¨S¦³¿ï¾Ü¥ô¦ó¼Òª©¡C';
$messages['error_template_is_current'] = '¡u%s¡v¼Òª©µLªk§R°£¡A¸Ó¼Òª©¥¿¦b¨Ï¥Î¤¤¡C';
$messages['error_removing_template'] = '§R°£¼Òª© ¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['template_removed_ok'] = ' ¼Òª© ¡u%s¡v¤w¶¶§Q§R°£¡C';
$messages['templates_removed_ok'] = '¼Òª© ¡u%s¡v¤w¶¶§Q§R°£¡C';

// new blog template
$messages['template_installed_ok'] = '·sªº¼Òª©³]¸m¡u %s¡v¤w¸g¶¶§Q¦w¸Ë§¹¦¨¡C';
$messages['error_installing_template'] = '¦b¦w¸Ë¼Òª©³]¸m¡u %s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_missing_base_files'] = '¦b³o­Ó¼Òª©³]¸m¤¤¦³¨Ç°ò¥»ÀÉ®×¤£¨£¤F¡C';
$messages['error_add_template_disabled'] = '¥»¯¸¤£¤¹³\¨Ï¥ÎªÌ·s¼W¼Òª©ÀÉ®×¡C';
$messages['error_must_upload_file'] = '±z¥²¶·¤W¶ÇÀÉ®×¡C';
$messages['error_uploads_disabled'] = '¥»¯¸¤wÃö³¬ÀÉ®×¤W¶Ç¥\¯à¡C';
$messages['error_no_new_templates_found'] = '§ä¤£¨ì·sªº¼Òª©³]¸m¡C';
$messages['error_template_not_inside_folder'] = '¼Òª©ÀÉ®×¥²¶·©ñ¦b»P¼Òª©¦P¦Wªº¥Ø¿ý·í¤¤¡C';
$messages['error_missing_base_files'] = '¦b³o­Ó¼Òª©³]¸m¤¤¦³¨Ç°ò¥»ÀÉ®×¤£¨£¤F¡C';
$messages['error_unpacking'] = '¦b¸ÑÀ£ÁY®Éµo¥Í¿ù»~¡C';
$messages['error_forbidden_extensions'] = '¦b³o­Ó¼Òª©³]¸m¤¤¦³¨ÇÀÉ®×¸T¤î¦s¨ú¡C';
$messages['error_creating_working_folder'] = '¦bÀË¬d¼Òª©³]¸m®Éµo¥Í¿ù»~¡C';
$messages['error_checking_template'] = '¼Òª©³]¸mµo¥Í¿ù»~ (code = %s)';
$messages['template_package'] = '¼Òª©¦w¸Ë¥]';
$messages['blog_template_package_help']  = '±z¥i¥H¥Î³o­Óªí³æ¡A¤W¶Ç¤@­Ó·sªº¼Òª©¦w¸Ë¥]¡A¸Ó¼Òª©±N¥u¦³§Aªººô»x¯à°÷¨Ï¥Î¡C¦pªG±z¨S¦³¿ìªk¥ÎÂsÄý¾¹¤W¶Ç¡A½Ð¤â°Ê¤W¶Ç¸Ó¼Òª©¨Ã±N¥¦©ñ¸m©ó§Aªººô»x¼ÒªO¸ê®Æ§¨<b>%s</b>¤U,µM«á«ö¤U "<b>±½ºË¼Òª©</b>" «ö¯Ã¡C pLog ·|±½ºË¸Ó¸ê®Æ§¨¨Ã¦Û°Ê·s¼W©Ò§ä¨ìªº·s¼Òª©¡C';
$messages['scan_templates'] = '±½ºË¼Òª©';

// site users
$messages['user_status_active'] = '±Ò¥Î';
$messages['user_status_disabled'] = '°±¥Î';
$messages['user_status_all'] = '©Ò¦³ª¬ºA';
$messages['user_status_unconfirmed'] = '©|¥¼½T»{';
$messages['error_invalid_user2'] = '¨Ï¥ÎªÌ¥N¸¹¡u%s¡v¤£¦s¦b¡C';
$messages['error_deleting_user'] = '¦b°±¥Î¨Ï¥ÎªÌ±b¸¹¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['user_deleted_ok'] = '¨Ï¥ÎªÌ±b¸¹¡u%s¡v¤w¶¶§Q°±¥Î¡C';
$messages['users_deleted_ok'] = '¨Ï¥ÎªÌ±b¸¹¡u%s¡v¤w¶¶§Q°±¥Î¡C';

// create user
$messages['user_added_ok'] = '·s¨Ï¥ÎªÌ±b¸¹¡u%s¡v¤w¶¶§Q·s¼W¡C';
$messages['error_incorrect_username'] = '¨Ï¥ÎªÌ¦WºÙ¤£¥¿½T©Î¤w¸g¦³¤Hµù¥U¬Û¦Pªº¦WºÙ¤F¡C';
$messages['user_status_help'] = '¨Ï¥ÎªÌ±b¸¹¥Ø«eª¬ºA';
$messages['user_blog_help'] = '¨Ï¥ÎªÌ¹w³]ªººô»x';
$messages['none'] = 'µL';

// edit user
$messages['error_invalid_user'] = '¨Ï¥ÎªÌID¤£¥¿½T©Î¨Ï¥ÎªÌ¤£¦s¦b¡C';
$messages['error_updating_user'] = '§ó·s¨Ï¥ÎªÌ³]©w®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ«á¦A­«¸Õ¤@¦¸¡C';
$messages['blogs'] = 'ºô»x';
$messages['user_blogs_helps'] = '¨Ï¥ÎªÌ¾Ö¦³©Î¥i¥H¦s¨úªººô»x¡C';
$messages['site_admin'] = '¥þ¯¸¨t²ÎºÞ²z';
$messages['site_admin_help'] = '¦pªG¨Ï¥ÎªÌ¾Ö¦³¥þ¯¸¨t²ÎºÞ²zÅv­­¡A¥L´N¥i¥H¬Ý¨£[¯¸¥x³]©w]°Ï°ì¡A¥i¥H¶i¦æ¥þ¯¸ªººÞ²z¤u§@¡C';
$messages['user_updated_ok'] = '¨Ï¥ÎªÌ±b¸¹¡u%s¡v¤w¶¶§Q§ó·s¡C';

// site blogs
$messages['blog_status_all'] = '©Ò¦³ª¬ºA';
$messages['blog_status_active'] = '±Ò¥Î';
$messages['blog_status_disabled'] = '°±¥Î';
$messages['blog_status_unconfirmed'] = '©|¥¼½T»{';
$messages['owner'] = 'ºÞ²z­û';
$messages['quota'] = 'ÀÉ®×­­«×';
$messages['bytes'] = 'bytes';
$messages['error_no_blogs_selected'] = '±z¥²¶·­n¿ï¾Ü±z©Ò·Q­n§R°£ªººô»x¯¸¥x¡C';
$messages['error_blog_is_default_blog'] = '¡u%s¡v¬O¨t²Î¹w³]ºô»x¯¸¥x¡AµLªk§R°£¡C';
$messages['blog_deleted_ok'] = '¡u%s¡vºô»x¯¸¥x¤w¶¶§Q§R°£¡C';
$messages['blogs_deleted_ok'] = '¡u%s¡vºô»x¯¸¥x¤w¶¶§Q§R°£¡C';
$messages['error_deleting_blog'] = '¦b§R°£¡u%s¡v³o­Óºô»x¯¸¥x®Éµo¥Í¿ù»~¡C';
$messages['error_deleting_blog2'] = '¦b§R°£ºô»x¯¸¥x®Éµo¥Í¿ù»~¡C(ID:%s)';

// create blog
$messages['error_adding_blog'] = '¦b·s¼Wºô»x®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ¦b­«¸Õ¤@¦¸¡C';
$messages['blog_added_ok'] = '·sªººô»x¯¸¥x¡u%s¡v¤w¦¨¥\¥[¤J¸ê®Æ®w¤¤¡C';

// edit blog
$messages['blog_status_help'] = 'ºô»xª¬ºA';
$messages['blog_owner_help'] = 'ºô»x¯¸¥xºÞ²zªÌ¡A±N¾Ö¦³§¹¾ãªºÅv­­¨Ó­×§ïºô»x³]©w¡C';
$messages['users'] = '¨Ï¥ÎªÌ';
$messages['blog_quota_help'] = 'ÀÉ®×®e¶q­­«×(³æ¦ì¡Gbytes)¡C³]¬°0©ÎªÅ¥Õ±N¨Ï¥Î¨t²Îªº¥þ°ìÀÉ®×­­«×°µ¬°¹w³]­È¡C';
$messages['blog_users_help'] = '¥i¥H¦s¨ú³o­Óºô»xªº¨Ï¥ÎªÌ¡C½Ð±q¥ªÃä¿ï¨ú¨Ï¥ÎªÌ±N¥L²¾¨ì¥kÃä´£¨Ñ¸Ó¨Ï¥ÎªÌ¦s¨úºô»xªºÅv­­¡C';
$messages['edit_blog_settings_updated_ok'] = 'ºô»x ¡u%s¡v¤w¶¶§Q§ó·s¡C';
$messages['error_updating_blog_settings'] = '§ó·sºô»x¯¸¥x ¡u%s¡v®Éµo¥Í¿ù»~¡C';
$messages['error_incorrect_blog_owner'] = '­n³]©w¬°ºô»x¯¸¥xºÞ²z­ûªº¨Ï¥ÎªÌ±b¸¹¤£¦s¦b¡C';
$messages['error_fetching_blog'] = 'Åª¨úºô»x¸ê®Æ®Éµo¥Í¿ù»~¡C';
$messages['error_updating_blog_settings2'] = '§ó·sºô»x®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤J¸ê®Æ¦b­«¸Õ¤@¦¸¡C';
$messages['add_or_remove'] = '·s¼W©Î²¾°£¨Ï¥ÎªÌ';

// site locales
$messages['locale'] = '»y¨t';
$messages['locale_encoding'] = '½s½X¤è¦¡';
$messages['locale_deleted_ok'] = '¡u%s¡v»y¨t¤w¶¶§Q§R°£¡C';
$messages['error_no_locales_selected'] = '±z¨S¦³¿ï¾Ü­n§R°£ªº»y¨t¡C';
$messages['error_deleting_only_locale'] = '±z¤£¥i¥H§R°£³o­Ó»y¨tÀÉ®×¡A¦]¬°³o¬O¨t²Î¤¤¥Ø«e°ß¤@ªº»y¨tÀÉ®×¡C';
$messages['locales_deleted_ok']= '¡u%s¡v»y¨t¤w¶¶§Q§R°£¡C';
$messages['error_deleting_locale'] = '¦b§R°£¡u%s¡v»y¨t®Éµo¥Í¿ù»~¡C';
$messages['error_locale_is_default'] = '±z¤£¥i¥H§R°£¡u%s¡v»y¨t¡A¦]¬°³o¬O¨t²Î¥Ø«eªº¹w³]»y¨t¡C';

// add locale
$messages['error_invalid_locale_file'] = '³o­ÓÀÉ®×¨Ã¤£¬O¥¿½Tªº»y¨tÀÉ®×¡C';
$messages['error_no_new_locales_found'] = '§ä¤£¨ì·sªº»y¨tÀÉ®×¡C';
$messages['locale_added_ok'] = '»y¨t¡u%s¡v¤w¸g¶¶§Q·s¼W';
$messages['error_saving_locale'] = '¦b±N·sªº»y¨tÀÉ®×Àx¦s¦Ü»y¨tÀÉ®×¥Ø¿ý®Éµo¥Í¿ù»~¡C½ÐÀË¬dÀÉ®×¥Ø¿ýªº¼g¤JÅv­­¬O§_¥¿½T¡C';
$messages['scan_locales'] = '±½ºË»y¨tÀÉ';
$messages['add_locale_help'] = '±z¥i¥H¥Î³o­Óªí³æ¡A¤W¶Ç¤@­Ó·sªº»y¨tÀÉ¡C¦pªG±z¨S¦³¿ìªk¥ÎÂsÄý¾¹¤W¶Ç¡A½Ð¤â°Ê¤W¶Ç¸ÓÀÉ®×¨Ã±N¥¦©ñ¸m©ó <b>./locales/</b>¤U,µM«á«ö¤U "<b>±½ºË»y¨tÀÉ</b>" «ö¯Ã¡C pLog ·|±½ºË¸Ó¸ê®Æ§¨¨Ã¦Û°Ê·s¼W©Ò§ä¨ìªº»y¨tÀÉ¡C ';

// site templates
$messages['error_template_is_default'] = '±z¤£¥i¥H§R°£¡u%s¡v¼Òª©¡A¦]¬°³o¬O·sºô»x¥Ø«eªº¹w³]¼Òª©¡C';

// add template
$messages['global_template_package_help'] = '±z¥i¥H¥Î³o­Óªí³æ¡A¤W¶Ç¤@­Ó·sªº¼Òª©¦w¸Ë¥]¡A¸Ó¼Òª©±N´£¨Ñµ¹ºô¯¸¤W©Ò¦³ºô»x¨Ï¥Î¡C¦pªG±z¨S¦³¿ìªk¥ÎÂsÄý¾¹¤W¶Ç¡A½Ð¤â°Ê¤W¶Ç¸Ó¼Òª©¨Ã±N¥¦©ñ¸m©ó§Aªººô»x¼ÒªO¸ê®Æ§¨<b>%s</b>¤U,µM«á«ö¤U "<b>±½ºË¼Òª©</b>" «ö¯Ã¡C pLog ·|±½ºË¸Ó¸ê®Æ§¨¨Ã¦Û°Ê·s¼W©Ò§ä¨ìªº·s¼Òª©¡C';

// global settings
$messages['site_config_saved_ok'] = '¯¸¥x³]©w¤w¶¶§QÀx¦s¡C';
$messages['error_saving_site_config'] = '¦bÀx¦s¯¸¥x³]¸m®Éµo¥Í°ÝÃD¡C';
/// general settings
$messages['help_comments_enabled'] = '±Ò¥Î©Î°±¥Î¥þ¯¸ªº°jÅT¯d¨¥¥\¯à¡C';
$messages['help_beautify_comments_text'] = '¦b¨Ï¥ÎªÌµoªí°jÅT¯d¨¥®É¡A¨Ï¥Î¥L©Ò¿é¤Jªº¤å¦r®æ¦¡¡C';
$messages['help_temp_folder'] = 'pLog¨t²Î¥Î¨ÓÀx¦s¼È¦sÀÉ®×¥Îªº¥Ø¿ý¡C';
$messages['help_base_url'] = '³o­Óºô»x¦w¸Ëªººô§}¡A³o­Ó¶µ¥Ø°È¥²­n¥¿½T¡A½Ð¤p¤ß¿é¤J¡C';
$messages['help_subdomains_enabled'] = '±Ò¥Î©Î°±¥Î¦¸ºô°ì³]©w¡C';
$messages['help_subdomains_base_url'] = '·í¦¸ºô°ì³]©w±Ò¥Î®É¡A³o­Óºô§}±N¥Î¨Ó´À¥N¨t²Îºô§}¡C¨Ï¥Î {blogname}¨Ó¨ú±oºô»x¦WºÙ¤Î{username}¨ú±oºô»x¨Ï¥ÎªÌ¦WºÙ¡A¥Î¨Ó²£¥Í³sµ²¨ìºô»xªººô§}¡C';
$messages['help_include_blog_id_in_url'] = '·í[¦¸ºô°ì]¥\¯à±Ò¥Î¤Î[¤@¯ëºô§}]¥\¯à±Ò¥Î®É¤~¦³·N¸q¡C±j­¢²£¥Íªººô§}¤£­n¥]§t"blogId"³o­Ó°Ñ¼Æ¡C½Ð¤£­nÅÜ§ó³]©w­È¡A°£«D§Aª¾¹D§A¦b°µ¤°»ò¡C';
$messages['help_script_name'] = '¦pªG§A±Nindex.php§ó§ï¬°¨ä¥¦¦WºÙªº¸Ü¡A½Ð¦b¤U¤è¿é¤J§ó§ï«áªºÀÉ®×¦WºÙ¡C';
$messages['help_show_posts_max'] = '¦b­º­¶Åã¥Ü¤å³¹¼Æªº¹w³]­È¡C';
$messages['help_recent_posts_max'] = '¦b­º­¶¡uªñ´Á¤å³¹¡v¦Cªí¤¤Åã¥Ü¤å³¹¼Æªº¹w³]­È¡C';
$messages['help_save_drafts_via_xmlhttprequest_enabled'] = '·íXmlHttpRequest¥\¯à³Q±Ò¥Î®É¡A±N¥i¥H¨Ï¥ÎJavascript¨ÓÀx¦s¤å³¹¯ó½Z¡C';
$messages['help_locale_folder'] = '»y¨tÀÉ®×©Ò¦b¥Ø¿ý¡C';
$messages['help_default_locale'] = '¦b«Ø¥ß·sºô»x¯¸¥x®É¹w³]¨Ï¥Îªº»y¨t¡C';
$messages['help_default_blog_id'] = '¹w³]ºô»xID';
$messages['help_default_time_offset'] = '¹w³]ªººô¯¸¦øªA¾¹®É¶¡®t¡C';
$messages['help_html_allowed_tags_in_comments'] = '¦bµoªí°jÅTµû½×®É¥i¥H¨Ï¥ÎªºHTML»yªk¼ÐÅÒ¡C';
$messages['help_referer_tracker_enabled'] = '¬O§_¨Ï¥Î¤å³¹°f¦V³sµ²¥\¯à¡C(°±¥Î¦¹¥\¯à¥i¥H´£°ª¨t²Î®Ä¯à¡C)';
$messages['help_show_more_enabled'] = '±Ò¥Î©Î°±¥Î¡u¾\Åª¥þ¤å¡v³sµ²¥\¯à¡C';
$messages['help_update_article_reads'] = '¬O§_¨Ï¥Î¤º«ØªºÂI¾\²v²Î­p¤u¨ã­pºâ¨C½g¤å³¹ªºÂI¾\¦¸¼Æ¡C(°±¥Î¦¹¥\¯à¥i¥H´£°ª¨t²Î®Ä¯à¡C)';
$messages['help_update_cached_article_reads'] = '¦b§Ö¨ú¥\¯à¶}±Òªº±¡§Î¤U¡A¬O§_¨Ï¥Î¤º«ØªºÂI¾\²v²Î­p¤u¨ã­pºâ¨C½g¤å³¹ªºÂI¾\¦¸¼Æ¡C';
$messages['help_xmlrpc_ping_enabled'] = '¦b¨t²Î¤¤¦³¤Hµoªí·s¤å³¹®É¡A¬O§_°e¥X XMLRPC ³q§i¡C';
$messages['help_send_xmlrpc_pings_enabled_by_default'] = '¹w³]±Ò¥Î¸Ó¥\¯à¡C·í¦³·s¤å³¹µoªí©Î§ó·s®É¡A¬O§_°e¥X XMLRPC ³q§i¡C¡C';
$messages['help_xmlrpc_ping_hosts'] = 'XMLRPC ³q§i¦Cªí¡A¦pªG±z­n¦V¦h³Bµo°e³q§i¡A½Ð¦b¤å¦r®Ø¤U­±¥[¤J³q§iµo°eºô§}¡A¨C­Óºô§}¤@¦æ¡C';
$messages['help_trackback_server_enabled'] = '¬O§_±µ¨ü±q¯¸¥~¶Ç¨Óªº¤Þ¥Î³q§i¡]TrackBack¡^¡C';
$messages['help_htmlarea_enabled'] = '±Ò¥Î©Î°±¥Î§Yµø§Y©Ò±o¡]WYSIWYG¡^¤å³¹½s¿è¡C';
$messages['help_plugin_manager_enabled'] = '±Ò¥Î©Î°±¥Î¥~±¾µ{¦¡¡C';
$messages['help_minimum_password_length'] = '±K½X³Ìµu»Ý­n¦h¤Ö¦r¤¸¡C';
$messages['help_xhtml_converter_enabled'] = '¦pªG±Ò¥Î¦¹¥\¯à¡ApLog·|¸ÕµÛ±N©Ò¦³ªºHTMLÂà´«¬°¾A·íªºXHTML¡C';
$messages['help_xhtml_converter_aggressive_mode_enabled'] = '¦pªG±Ò¥Î¦¹¥\¯à¡ApLOG·|¸ÕµÛ±NHTML¶i¤@¨BÂà´«¬°XHTML¡A¦ý³o¼Ë¥i¯à·|¾É­P§ó¦hªº¿ù»~¡C';
$messages['help_session_save_path'] = '¦¹³]©w±N¨Ï¥ÎPHPªºsession_save_path()¨ç¼Æ¡A¨Ó§ó§ïpLog¦s©ñsessionªº¸ê®Æ§¨¡C½Ð½T©w¸Ó¸ê®Æ§¨¥i¥H³z¹Lºô¯¸¦øªA¾¹¶i¦æ¼g¤J°Ê§@¡C¦pªG§A­n¨Ï¥ÎPHP¹w³]ªºsession¦s©ñ¸ô®|¡A½Ð±N¦¹³]©wªÅ¥Õ¡C';
// summary settings
$messages['help_summary_page_show_max'] = '¦bºK­n­¶­±¤¤­nÅã¥Ü¦h¤Ö¶µ¥Ø¡C¦¹¿ï¶µ±±¨î¦bºK­n­¶­±¤¤¦C¥Xªº©Ò¦³¶µ¥Ø¡C(¥]¬A³Ì·s¤å³¹¼Æ¥Ø¡B³Ì¬¡ÅDºô»xµ¥)';
$messages['help_summary_blogs_per_page'] = '¦b[ºô»x¦Cªí]¤¤¨C¤@­¶­nÅã¥Ü¦h¤Öºô»x¡C';
$messages['help_forbidden_usernames'] = '¦C¥X©Ò¦³¤£¤¹³\µù¥Uªº¨Ï¥ÎªÌ¦WºÙ¡C';
$messages['help_force_one_blog_per_email_account'] = '¤@­Ó¹q¤l¶l¥ó¬O§_¥u¯àµù¥U¤@­Óºô»x';
$messages['help_summary_show_agreement'] = '¦b¨Ï¥ÎªÌ¶i¦æµù¥U°Ê§@¤§«e¡A¬O§_Åã¥Ü¨Ã½T»{¨Ï¥ÎªÌ¦P·NªA°È±ø´Ú¡C';
$messages['help_need_email_confirm_registration'] = '¬O§_±Ò¥Î¹q¤l¶l¥óªº½T»{³sµ²¨Ó±Ò¥Î±b¸¹¡C';
$messages['help_summary_disable_registration'] = '¬O§_Ãö³¬¨Ï¥ÎªÌµù¥U·sºô»xªº¥\¯à¡C';
// templates
$messages['help_template_folder'] = '¼Òª©ÀÉ®×ªº©Ò¦b¥Ø¿ý¸ô®|¡C';
$messages['help_default_template'] = '¦b·s«Øºô»x¯¸¥x®É¡A¹w³]¨Ï¥Îªº¼Òª©¡C';
$messages['help_users_can_add_templates'] = '¨Ï¥ÎªÌ¬O§_¥i¥H¦b¼Òª©³]¸m·í¤¤¡A¥[¤JÄÝ©ó¦Û¤v±MÄÝ»Ý¨DªºÀÉ®×¡C';
$messages['help_template_compile_check'] = '°±¥Î¦¹¥\¯à®É¡ASmarty¥u¦³¦b¼Òª©¦³§ó§ï®É¤~·|­«·s²£¥Í­¶­±¡C°±¥Î¦¹¥\¯à¥i¥H´£°ª¨t²Î®Ä¯à¡C';
$messages['help_template_cache_enabled'] = '±Ò¥Î¼Òª©§Ö¨ú¥\¯à¡C±Ò¥Î¦¹¥\¯à¡A§Ö¨úªºª©¥»±N·|«ùÄò³Q¨Ï¥Î¡A¦Ó¤£»Ý­n¹ï¸ê®Æ®w¶i¦æ¸ê®Æ¦s¨úªº°Ê§@¡C';
$messages['help_template_cache_lifetime'] = '§Ö¨ú¦s¬¡®É¶¡(³æ¦ì¡G¬í).³]¬°-1§Ö¨ú±N¥Ã¤£¹L´Á¡A©Î³]¬°0¨ÓÃö³¬§Ö¨ú¥\¯à¡C';
$messages['help_template_http_cache_enabled'] = '¬O§_±Ò¥Î¹ïHTTP³sµ²­n¨Dªº§Ö¨ú¤ä´©¡C±Ò¥Î¦¹¥\¯àpLog¥u·|¶Ç°e¥²­nªº¤º®e¡A¥i¥H¸`¬Ùºô¸ôÀW¼e¡C';
$messages['help_allow_php_code_in_templates'] = '¤¹³\¦bSmarty ¼Òª©¤¤ªº{php}...{/php}°Ï¶ô¸m¤J­ì¥ÍPHPµ{¦¡½X(native PHP code)';
// urls
$messages['help_request_format_mode'] = '¦pªG±z³]©w¬°¡u¤@¯ëºô§}¡v¡A¨º»ò¨t²Î©Ò§e²{ªººô§}¡A´N·|¨Ï¥Î±N°Ñ¼Æ¥Hget¤è¦¡¶Ç¤Jªº¤@¯ë¤è¦¡¡C¦pªG±z¿ï¥Î¡uÅý·j´M¤ÞÀº©ö©ó·j´MªºÂ²¼äºô§}¡v¡A¨º»ò´N·|Åýºô§}ÅÜ±oÂ²¼ä¡A·j´M¤ÞÀº¤]®e©ö¨ú±o±zºô¯¸¤Wªº¤º®e¡A¤£¹L±zªºApache¦øªA¾¹¥²¶·­n¯à°÷±µ¨ü.htaccessÀÉ®×¤¤ªºÂÐ¼g³]©w¡C¦pªG¨Ï¥Î¦Û­qºô§}¡A½Ð½Õ¾ã¤U¤èªº³]©w¡C';
$messages['plain'] = '¤@¯ëºô§}';
$messages['search_engine_friendly'] = 'Åý·j´M¤ÞÀº©ö©ó·j´MªºÂ²¼äºô§}';
$messages['custom_url_format'] = '¦Û­qºô§}';
$messages['help_permalink_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡AÀRºA³sµ²ºô§}®æ¦¡¡C';
$messages['help_category_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡Aºô¯¸³sµ²¤ÀÃþºô§}®æ¦¡¡C';
$messages['help_blog_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡Aºô»x³sµ²ºô§}®æ¦¡¡C';
$messages['help_archive_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¤å³¹·J¾ã³sµ²ºô§}®æ¦¡¡C';
$messages['help_user_posts_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¯S©w¨Ï¥ÎªÌµoªíªº¤å³¹³sµ²ºô§}®æ¦¡¡C';
$messages['help_post_trackbacks_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¤Þ¥Î³sµ²ºô§}®æ¦¡¡C';
$messages['help_template_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¦Û­qÀRºA¼Òª©³sµ²ºô§}®æ¦¡¡C';
$messages['help_album_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¸ê®Æ§¨³sµ²ºô§}®æ¦¡¡C';
$messages['help_resource_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡AÀÉ®×³sµ²ºô§}®æ¦¡¡C';
$messages['help_resource_preview_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡AÀÉ®×¹wÄý³sµ²ºô§}®æ¦¡¡C';
$messages['help_resource_medium_size_preview_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡A¤¤«¬ÀÉ®×¹wÄý³sµ²ºô§}®æ¦¡¡C';
$messages['help_resource_download_link_format'] = '·í¨Ï¥Î¦Û­qºô§}®É¡AÀÉ®×¤U¸ü³sµ²ºô§}®æ¦¡¡C';
// email
$messages['help_check_email_address_validity'] = '¦b¨Ï¥ÎªÌµù¥U¥Ó½Ð·sªººô»x¯¸¥x®É¡A¬O§_­n»{ÃÒ¥L©Ò¶ñ¼gªº¹q¤l¶l¥ó«H½c¬O§_¥¿½T¡C';
$messages['help_email_service_enabled'] = '¨Ï¥Î©Î°±¥Î¥Î¨Ó±H°e³qª¾«H¨çªº¹q¤l¶l¥óªA°È¡C';
$messages['help_post_notification_source_address'] = '¨t²Î³qª¾«H¨çªº±H¥ó¤H¹q¤l¶l¥ó«H½c¡C';
$messages['help_email_service_type'] = '¥Î¨Ó±H°e¹q¤l¶l¥óªº¤è¦¡¡A½Ð¦b¦UºØ¤èªk¿ï¾Ü¨ä¤¤¤§¤@¡C';
$messages['help_smtp_host'] = '¦pªG±z¿ï¥ÎSMTP±H°e¹q¤l¶l¥ó¡A½Ð¿é¤J±z­n¥Î¨Óµo°e¶l¥óªº¥D¾÷¡C';
$messages['help_smtp_port'] = '«e¶µ³]©wªºSMTP¥D¾÷³s±µ°ð¡]port¡^';
$messages['help_smtp_use_authentication'] = 'SMTP¥D¾÷¬O§_»Ý­n±ÂÅv»{ÃÒ¡C¦pªG»Ý­nªº¸Ü¡A½ÐÄ~Äò¶ñ¼g¤U­±¨â¶µ³]©w¡C';
$messages['help_smtp_username'] = '¦pªGSMTP¥D¾÷»Ý­n±ÂÅv»{ÃÒ¡A½Ð¶ñ¼g¨Ï¥ÎªÌ±b¸¹¡C';
$messages['help_smtp_password'] = '¦pªGSMTP¥D¾÷»Ý­n±ÂÅv»{ÃÒ¡A½Ð¶ñ¼g¨Ï¥ÎªÌ±K½X¡C';
// helpers
$messages['help_path_to_tar'] = '¡utar¡v«ü¥O©Ò¦b¥Ø¿ý¡C(¥Î¨Ó¸ÑÀ£ÁY¨Ï¥Î .tar.gz ©Î .tar.gz2®æ¦¡À£ÁYªº¼Òª©¥])';
$messages['help_path_to_gzip'] = '¡ugzip¡v«ü¥O©Ò¦b¥Ø¿ý¡C(¥Î¨Ó¸ÑÀ£ÁY¨Ï¥Î .tar.gz ®æ¦¡À£ÁYªº¼Òª©¥])';
$messages['help_path_to_bz2'] = '¡ubzip2¡v«ü¥O©Ò¦b¥Ø¿ý¡C(¥Î¨Ó¸ÑÀ£ÁY¨Ï¥Î .tar.gz2®æ¦¡À£ÁYªº¼Òª©¥])';
$messages['help_path_to_unzip'] = '¡uunzip¡v«ü¥O©Ò¦b¥Ø¿ý¡C(¥Î¨Ó¸ÑÀ£ÁY¨Ï¥Î .zip®æ¦¡À£ÁYªº¼Òª©¥])';
$messages['help_unzip_use_native_version'] = '¨Ï¥ÎPHP¤º«Øªºª©¥»¨Ó¸ÑÀ£ÁY .zip ªºÀÉ®×';
// uploads
$messages['help_uploads_enabled'] = '±Ò¥Î©Î°±¥Î¤W¶ÇÀÉ®×¥\¯à¡C³o­Ó¥\¯à·|¼vÅT¨ì¨Ï¥ÎªÌ¯à§_¤W¶Ç·sªº¼Òª©¦w¸Ë¥]¡A¥H¤Î¦b¼Òª©¤¤²K¥[·sªºÀÉ®×¡C';
$messages['help_maximum_file_upload_size'] = '¨Ï¥ÎªÌ¤W¶ÇÀÉ®×¤j¤pªº¤W­­¡C';
$messages['help_upload_forbidden_files'] = '¸T¤î¨Ï¥ÎªÌ¤W¶ÇªºÀÉ®×Ãþ«¬¡C¦pªG¦³¦h­Ó¤£¦PªºÀÉ®×Ãþ«¬¡A½Ð¦b¤£¦PªºÃþ«¬¶¡¥ÎªÅ¥Õ°Ï¹j¡C¤]¥i¨Ï¥Î\'*\' and \'?\'ªº¤è¦¡¡C';
// interfaces
$messages['help_xmlrpc_api_enabled'] = '±Ò¥Î©Î°±¥ÎXMLRPC¤¶­±¡CXMLRPC¤¶­±ªº¥Î³~¬O¥i¥HÅý±z¨Ï¥Î®à­±ºô»x¼g§@¤u¨ã¥Xª©ºô»x¤å³¹¡C';
$messages['help_rdf_enabled'] = '±Ò¥Î©Î°±¥Î²£¥ÍRSS·s»D¥æ´«ÀÉ®×¥\¯à¡C';
$messages['help_default_rss_profile'] = '¹w³]ªºRSS/RDF·s»D¥æ´«®æ¦¡';
// security
$messages['help_security_pipeline_enabled'] = '±Ò¥Î¨t²Î¦w¥þ¥\¯à¡C¦pªG±zÃö³¬¤F³o­Ó¿ï¶µ¡A¨º»ò©Ò¦³ªº¨t²Î¦w¥þ¥\¯à³£·|°±¥Î¡A¦pªG±z·Q­nÃö³¬¤@¨Ç¨t²Î¦w¥þ¥\¯à¡A«ØÄ³±z±N³o­Ó³]©w³]¬°¶}±Ò¡AµM«á¦b¥H¤Uªº¿ï¶µ¤¤¡A³v¤@°±¥Î§Ú­Ì¤£»Ý­nªº¨t²Î¦w¥þ¥\¯à¶µ¥Ø¡C';
$messages['help_ip_address_filter_enabled'] = '±Ò¥ÎIP¦ì¸m¹LÂo¡C±z¥i¥H¥Î³o­Ó¥\¯àªý¾×¬Y¨Ç¥D¾÷ÂsÄý¥»¯¸¡C';
$messages['help_content_filter_enabled'] = '¨Ï¥Î¥H¥¿³Wªí¥Ü¦¡¬°°òÂ¦ªºÂ²³æ¤º®e¹LÂo¾÷¨î¡A¥ÎÂ²³æªºÃöÁä¦r¹LÂo¤£·í¤º®e¡C¤£¹L«ØÄ³±z¡A±Ä¥Î¨©¤ó¹LÂo·|¬O¤ñ¸û¦nªº¤è®×¡C';
$messages['help_maximum_comment_size'] = '°jÅT¯d¨¥ªº¤º¤å¦r¤¸¼Æ¤W­­¡C';
// bayesian filter
$messages['help_bayesian_filter_enabled'] = '±Ò¥Î©Î°±¥Î¨©¤ó¹LÂo¾÷¨î¡C';
$messages['help_bayesian_filter_spam_probability_treshold'] = '³Q»{©w¬°¬O©U§£°jÅT¯d¨¥ªº¼Æ­È¤U­­¡C³]©w½d³ò¦b0.01¨ì0.99¤§¶¡¡C';
$messages['help_bayesian_filter_nonspam_probability_treshold'] = '³]©w°jÅT¯d¨¥¬O¥¿±`¯d¨¥ªº¼Æ­È¤W­­¡C¥ô¦ó²Å¦X¦b«e¤@³]©w»P¥»³]©w¤§¶¡¼Æ­Èªº¯d¨¥°jÅT¡A³£·|³Q»{©w¬O¥¿±`¦Ó«D©U§£¯d¨¥¡C';
$messages['help_bayesian_filter_min_length_token'] = '¦b¦h¤Ö¦r¤¸¼Æ¥H¤W¤~·|±Ò°Ê¨©¤ó¹LÂo¾÷¨î¡C';
$messages['help_bayesian_filter_max_length_token'] = '¨©¤ó¹LÂo¾÷¨î¥i¥H³B²zªº³Ì¦h¦r¤¸¼Æ¤W­­¡C';
$messages['help_bayesian_filter_number_significant_tokens'] = '¦b°T®§¤¤¥²¶·­n¦³¦h¤ÖÅãµÛ¦³·N¸qªº¤å¦r¡C';
$messages['help_bayesian_filter_spam_comments_action'] = '³B²z©U§£¯d¨¥ªº¤èªk¡C±z¥i¥Hª½±µ²M²z³o¨Ç©U§£¯d¨¥¡]¤£·|¦s¶i¸ê®Æ®w¤¤¡^¡A©Î¬O«O¦s³o¨Ç©U§£¯d¨¥¡A¦ý¬O¥[¤W©U§£¯d¨¥¼Ð¥Ü¼Ð¥Ü¡C«ØÄ³·í±zªº¹LÂo¾÷¨î¦bÁÙ¨S¦³§´µ½«Ø¥ßªý¾×³W«h®É¡A¥ý¥Î«áªÌ¡C';
$messages['keep_spam_comments'] = '«O¦s©U§£°jÅT';
$messages['throw_away_spam_comments'] = '²M²z©U§£°jÅT';
// resources
$messages['help_resources_enabled'] = '±Ò¥Î©ÎÃö³¬ÀÉ®×¤¤¤ß¥\¯à¡C';
$messages['help_resources_folder'] = '¥Î¨Ó¦s©ñÀÉ®×¤¤¤ßªº¥Ø¿ý¡C³o­Ó¥Ø¿ý¤£¤@©w­n¦bºô­¶¥Ø¿ý¤U¡C¦pªG±z¤£§Æ±æ§O¤Hª½±µÂsÄý±zªºÀÉ®×¥Ø¿ý¡A±z¥i¥H§â³o­Ó¥Ø¿ý³]©w¨ì¨ä¥L¦a¤è¡C';
$messages['help_thumbnail_method'] = '±z¥Î¨Ó²£¥ÍÁY¹Ïªº«áºÝ¨t²Î¡C¦pªG¨Ï¥ÎPHP¡AGDªº¤ä´©¬O¥²¶·ªº¡C';
$messages['help_path_to_convert'] = '¥Î¨Ó²£¥ÍÁY¹Ïªº¨t²Î¤u¨ã¸ô®|¡C¦pªG±z­n¨Ï¥ÎImageMagick¡A¨º»ò±z¥²¶·±µµÛ¶ñ¼gImageMagickªº¤u¨ãµ{¦¡¸ô®|¡C';
$messages['help_thumbnail_format'] = '¦b²£¥Í¹wÄýÁY¹Ï®É©Ò¨Ï¥Îªº¹w³]®æ¦¡¡C¦pªG±z¿ï¾Ü¡u»P­ì©l¼v¹³¬Û¦P¡v¡A¨º»ò¹wÄýÁY¹Ï´N·|Àx¦s¦¨»P­ì©l¼v¹³¬Û¦Pªº®æ¦¡¡C';
$messages['help_thumbnail_height'] = 'ÁY¹Ï¹w³]°ª«×¡C';
$messages['help_thumbnail_width'] = 'ÁY¹Ï¹w³]¼e«×¡C';
$messages['help_medium_size_thumbnail_height'] = '¤¤«¬ÁY¹Ï¹w³]°ª«×';
$messages['help_medium_size_thumbnail_width'] = '¤¤«¬ÁY¹Ï¹w³]¼e«×';
$messages['help_thumbnails_keep_aspect_ratio'] = 'ÁY¹Ï¬O§_«O«ù­ì©l¤ñ¨Ò¡C';
$messages['help_thumbnail_generator_force_use_gd1'] = '¬O§_±j­¢pLog¨Ï¥ÎGD1¨ç¼Æ¨Ó²£¥ÍÁY¹Ï';
$messages['help_thumbnail_generator_user_smoothing_algorithm'] = '¬O§_¨Ï¥Îºtºâªk¨Ó¨ÏÁY¹Ïµe­±§ó¥­¶¶¡C¥u¦³·íÁY¹Ï²£¥Í¤u¨ã¬OGD®É¤~¾A¥Î¡C';
$messages['help_resources_quota'] = '¥þ°ìÀÉ®×®e¶q­­ÃB';
$messages['help_resource_server_http_cache_enabled'] = '·íHTTP½Ð¨DÀÉÀY¬°"If-Modified-Since"±Ò¥Î§Ö¨ú¤ä´©¡C±Ò¥Î¦¹¥\¯à¨Ó¸`¬Ùºô¸ôÀW¼e¡C';
$messages['help_resource_server_http_cache_lifetime'] = '«È¤áºÝ¥i¥H¨Ï¥Î§Ö¨úÀÉ®×ªº®É¶¡(³æ¦ì¡G¤d¤À¤§¤@¬í)';
$messages['same_as_image'] = '»P­ì©l¼v¹³¬Û¦P';
// search
$messages['help_search_engine_enabled'] = '±Ò¥Î©Î°±¥Î·j´M¤ÞÀº';
$messages['help_search_in_custom_fields'] = '·j´M¥]§t¦Û­qÄæ¦ì';
$messages['help_search_in_comments'] = '·j´M¥]§t°jÅT';

// cleanup
$messages['purge'] = '²M°£';
$messages['cleanup_spam'] = '²M°£©U§£°jÅT';
$messages['cleanup_spam_help'] = '³o·|²M°£©Ò¦³³Q¨Ï¥ÎªÌ¼Ð¥Ü¬°©U§£ªº°jÅT¡C³Q²M°£ªº©U§£°jÅT±NµLªk¦^´_¡C';
$messages['spam_comments_purged_ok'] = '©U§£°jÅT¤w¶¶§Q²M°£';
$messages['cleanup_posts'] = '²M°£¤å³¹';
$messages['cleanup_posts_help'] = '³o·|²M°£©Ò¦³³Q¨Ï¥ÎªÌ¼Ð¥Ü¬°§R°£ªº¤å³¹¡C ³Q²M°£ªº¤å³¹±NµLªk¦^´_¡C';
$messages['posts_purged_ok'] = '¤å³¹¤w¶¶§Q²M°£';

/// summary ///
// front page
$messages['summary'] = 'ºK­n';
$messages['register'] = 'µù¥U';
$messages['summary_welcome'] = 'Åwªï!';
$messages['summary_most_active_blogs'] = '³Ì¬¡ÅDºô»x';
$messages['summary_most_commented_articles'] = '³Ì¦h°jÅT¤å³¹';
$messages['summary_most_read_articles'] = '³Ì¦h¤H¾\Åª¤å³¹';
$messages['password_forgotten'] = '§Ñ°O±K½X?';
$messages['summary_newest_blogs'] = '³Ì·s«Ø¥ßªººô»x';
$messages['summary_latest_posts'] = '³Ì·sµoªíªº¤å³¹';
$messages['summary_search_blogs'] = '·j´Mºô»x';

// blog list
$messages['updated'] = '§ó·s';
$messages['total_reads'] = 'ÂsÄýÁ`¦¸¼Æ';

// blog profile
$messages['blog'] = 'ºô»x';
$messages['latest_posts'] = '³Ì·sµoªíªº¤å³¹';

// registration
$messages['register_step0_title'] = 'ªA°È±ø´Ú';
$messages['agreement'] = '¦P·N±ø´Ú';
$messages['decline'] = '¤£±µ¨ü';
$messages['accept'] = '±µ¨ü';
$messages['read_service_agreement'] = '½Ð¸Ô²Ó¾\ÅªªA°È±ø´Ú¡A¦pªG§A¦P·N¥H¤W±ø´Ú½Ð«ö¤U±µ¨üÁä¡C';
$messages['register_step1_title'] = '«Ø¥ß¨Ï¥ÎªÌ [1/4]';
$messages['register_step1_help'] = '­º¥ý§A¥²¶·¥ý«Ø¥ß¤@­Ó¨Ï¥ÎªÌ±b¸¹¨Ó¨ú±o¤@­Óºô»x¡A³o­Ó¨Ï¥ÎªÌ¾Ö¦³¸Óºô»x¡A¦P®É¥i¥H¶i¦æ©Ò¦³ºô»x³]©w¥\¯à¡C';
$messages['register_next'] = '¤U¤@¨B';
$messages['register_back'] = '¤W¤@¨B';
$messages['register_step2_title'] = '«Ø¥ßºô»x [2/4]';
$messages['register_blog_name_help'] = 'À°§Aªººô»x¨ú­Ó¦WºÙ';
$messages['register_step3_title'] = '¿ï¾Ü¤@­Ó¼Òª©[3/4]';
$messages['step1'] = '¨BÆJ 1';
$messages['step2'] = '¨BÆJ 2';
$messages['step3'] = '¨BÆJ 3';
$messages['register_step3_help'] = '½Ð¿ï¾Ü¤@­Ó¼Òª©°µ¬°ºô»xªº¹w³]¼Òª©¡C¥u­n§A¤£³ßÅw¡A§A¥i¥HÀH®É§â¥¦´«±¼¡C';
$messages['error_must_choose_template'] = '½Ð¿ï¾Ü¤@­Ó¼Òª©';
$messages['select_template'] = '¿ï¨ú¼Òª©';
$messages['register_step5_title'] = '®¥³ß§A! [4/4]';
$messages['finish'] = 'µù¥U§¹¦¨';
$messages['register_need_confirmation'] = '¤@«Ê¥]§tµù¥U[½T»{°T®§³sµ²]ªº¹q¤l¶l¥ó¤w¸g±H¨ì§Aªº¹q¤l«H½c¤¤¡C½ÐºÉ§ÖÂI¿ï¸Ó³sµ²¨Ó¶}©l§Aªºblogging¥Í¬¡¡I';
$messages['register_step5_help'] = '®¥³ß§A¡A·sªº¨Ï¥ÎªÌ±b¸¹¤Îºô»x¤w¸g¶¶§Q«Ø¥ß¡I';
$messages['register_blog_link'] = '¦pªG§A­n¬Ý¤@¬Ý§Aªº·sºô»x¡A§A²{¦b¥i¥H¨ì<a href="%2$s">%1$s</a>³o¸Ì¬Ý¤@¬Ý¡C';
$messages['register_blog_admin_link'] = '¦pªG§A·Q­n¥ß¨è¶}©lµoªí¤å³¹¡A½ÐÂI¿ï³sµ²¨ì <a href="admin.php">ºÞ²z¤¶­±</a>';
$messages['register_error'] = '¹Lµ{¤¤¦³¿ù»~µo¥Í¡I';
$messages['error_registration_disabled'] = '«Ü©êºp¡Aºô¯¸ºÞ²zªÌ°±¥Îµù¥U·sºô»xªº¥\¯à¡C';
// registration article topic and text
$messages['register_default_article_topic'] = '®¥³ß¡I';
$messages['register_default_article_text'] = '¦pªG§A¥i¥H¬Ý¨ì³o½g¤å³¹¡Aªí¥Üµù¥U¹Lµ{¤w¸g¶¶§Q§¹¦¨¡C²{¦b§A¥i¥H¶}©lblogging¤F¡I';
$messages['register_default_category'] = '¤@¯ë';
// confirmation email
$messages['register_confirmation_email_text'] = '½ÐÂI¿ï¤U­±ªº³sµ²¨Ó±Ò¥Î§Aªººô»x¡G:

%s

¯¬§A¦³­Ó¬ü¦nªº¤@¤Ñ¡I';
$messages['error_invalid_activation_code'] = '«Ü©êºp¡A½T»{½X¤£¥¿½T¡I';
$messages['blog_activated_ok'] = '®¥³ß¡A§Aªº¨Ï¥ÎªÌ±b¸¹©Mºô»x¤w¸g¶¶§Q±Ò¥Î¤F¡I';
// forgot your password?
$messages['reset_password'] = '­«³]±K½X';
$messages['reset_password_username_help'] = '§A­n­«³]¨º­Ó¨Ï¥ÎªÌªº±K½X¡H';
$messages['reset_password_email_help'] = '¨Ï¥ÎªÌ¥Î¨Óµù¥Uªº¹q¤l¶l¥ó¦ì§}';
$messages['reset_password_help'] = '¨Ï¥Î¤U¤èªºªí³æ¨Ó­«³]±K½X¡C½Ð¿é¤J¨Ï¥ÎªÌ¦WºÙ¤Îµù¥U®É¨Ï¥Îªº¹q¤l¶l¥ó¦ì§}¡C';
$messages['error_resetting_password'] = '­«³]±K½X®Éµo¥Í¿ù»~¡C½ÐÀË¬d¿é¤Jªº¸ê®Æ¦A­«¸Õ¤@¦¸¡C';
$messages['reset_password_error_incorrect_email_address'] = '¹q¤l¶l¥ó¦ì§}¿ù»~©ÎµÛ³o¤£¬O§Aµù¥U®É¨Ï¥Îªº¹q¤l¶l¥ó¡C';
$messages['password_reset_message_sent_ok'] = '¤@«Ê¦³µÛ­«³]±K½X³sµ²ªº¹q¤l¶l¥ó¤w¸g°e¨ì§Aªº¹q¤l¶l¥ó«H½c¡A½ÐÂI¿ï¸Ó³sµ²¨Ó­«³]±K½X¡C';
$messages['error_incorrect_request'] = 'ºô§}¤¤ªº°Ñ¼Æ¤£¥¿½T¡C';
$messages['change_password'] = '­«³]±K½X';
$messages['change_password_help'] = '½Ð¿é¤J·s±K½X¤Î½T»{±K½X';
$messages['new_password'] = '·s±K½X';
$messages['new_password_help'] = '¦b³o¸Ì¿é¤J·s±K½X';
$messages['password_updated_ok'] = '§Aªº±K½X¤w¸g¶¶§Q§ó·s';

// Suggested by BCSE, some useful messages that not available in official locale
$messages['upgrade_information'] = '±z©Ò¨Ï¥ÎªºÂsÄý¾¹¥¼²Å¦Xºô­¶³]­p¼Ð·Ç¡A¦]¦¹¥»ºô­¶±N¥H¯Â¤å¦r¼Ò¦¡Åã¥Ü¡C¦p±ý¥H³Ì¨Îªº±Æª©¤è¦¡ÂsÄý¥»¯¸¡A½Ð¦Ò¼{<a href="http://www.webstandards.org/upgrade/" title="The Web Standards Project\'s Browser Upgrade initiative">¤É¯Å</a>±zªºÂsÄý¾¹¡C';
$messages['jump_to_navigation'] = '²¾°Ê¨ì¾ÉÄý¦C¡C';
$messages['comment_email_never_display'] = '¨t²Î·|¦Û°Ê¬°§A³]©w¤À¦æ¡A¥B¤£·|Åã¥Ü§A¯d¤Uªº¶l¥ó¦a§}¡C';
$messages['comment_html_allowed'] = '¥i¨Ï¥Î¤§ <acronym title="Hypertext Markup Language">HTML</acronym> ¼ÐÅÒ¦p¤U¡G&lt;<acronym title="¥Î³~¡G¶W³sµ²">a</acronym> href=&quot;&quot; title=&quot;&quot; rel=&quot;&quot;&gt; &lt;<acronym title="¥Î³~¡GÀY¦r»y¼Ðµù">acronym</acronym> title=&quot;&quot;&gt; &lt;<acronym title="¥Î³~¡G¤Þ¥Î¤å¦r">blockquote</acronym> cite=&quot;&quot;&gt; &lt;<acronym title="¥Î³~¡G§R°£½u">del</acronym>&gt; &lt;<acronym title="¥Î³~¡G±×Åé">em</acronym>&gt; &lt;<acronym title="¥Î³~¡G©³½u">ins</acronym>&gt; &lt;<acronym title="¥Î³~¡G²ÊÅé">strong</acronym>&gt;';
$messages['trackback_uri'] = '³o½g¤å³¹ªº¤Þ¥Î³sµ²ºô§}¡G';
$messages['previous_post'] = '¤W¤@½g';
$messages['next_post'] = '¤U¤@½g';
$messages['comment_default_title'] = '(µL¼ÐÃD)';
$messages['guestbook'] = '¯d¨¥ªO';
$messages['trackbacks'] = '¤Þ¥Î';
$messages['menu'] = '¥D¿ï³æ';
$messages['albums'] = '¸ê®Æ§¨';
$messages['admin'] = 'ºÞ²z¤¶­±';
?>