<?php
/***************************************************************************
 *   language/english.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 *   IMPORTANT NOTE: if you ever happen to translate this file to a foreign
 *   language which is not included in the e-moBLOG releases yet, I would
 *   be very glad if you could send it to me along with your name and
 *   website URL, such as I can add it to the official e-moBLOG releases
 *   language files (credits with your name & website URL will be
 *   mentionned, of course). Thank you very much.
 *
 ***************************************************************************/

 
// installation
$lang['i_confirm'] = "<b>you are about to install e-moBLOG on your webhosting account.</b><br /><br />please make sure you already edited the file<br />\" /includes/db.php \"<br />and uploaded all necessary files to your server<br />as explained in the \" <a href=\"./HOW-TO.txt\" target=\"_blank\">HOW-TO.txt</a> \" file.";
$lang['i_proceed'] = "click here to proceed";
$lang['i_cancel'] = "this will reset any previous installation of the e-moBLOG system.<br />if you do not want to proceed now, simply close this window.";
$lang['i_done'] = "congratulations, the installation is successful.<br />thank you for choosing e-moBLOG!<br /><br />check for updates and news at:";
$lang['i_link'] = "http://www.e-motionalis.net";
$lang['i_admin'] = "you can now access your admin panel at the following web address:";

// configuration
$lang['c_loginoptions'] = "admin login informations";
$lang['c_general'] = "general configuration";
$lang['c_options'] = "various options";
$lang['c_login'] = "login name:";
$lang['c_password'] = "password:";
$lang['c_confirmpass'] = "confirm password:";
$lang['c_bname'] = "blog name:";
$lang['c_bname_desc'] = "this is the name of your blog - it will appear on the title bar of your browser.";
$lang['c_burl'] = "blog URL:";
$lang['c_burl_desc'] = "this is the complete URL of your blog, with the trailing slash - the file index.php must be located at that URL - example: http://www.mydomain.com/myaccount/blog/";
$lang['c_aname'] = "owner's name:";
$lang['c_aname_desc'] = "this is the name of the owner of this blog.";
$lang['c_aemail'] = "owner's e-mail:";
$lang['c_aemail_desc'] = "this is the e-mail address of the owner of this blog - this is the adress where comments will be sent if there is only one poster for this blog and if you choose to receive the comments by mail (see the options below).";
$lang['c_bdesc'] = "blog description:";
$lang['c_bdesc_desc'] = "this is the description of this blog as it will appear in the meta-tags (and thus in the search engines).";
$lang['c_bkeys'] = "blog keywords:";
$lang['c_bkeys_desc'] = "this is the keywords of this blog, as it will appear in the meta-tags (those will be used bby search engines to refer your blog) - separate each word with a coma.";
$lang['c_comments'] = "comments system:";
$lang['c_comments_desc'] = "determines the way comments should be handled (default = on page).";
$lang['c_center'] = "blog alignment:";
$lang['c_center_desc'] = "this determines if your blog is aligned to left or centered (default = left).";
$lang['c_center_0'] = "left";
$lang['c_center_1'] = "centered";
$lang['c_poster'] = "multiple authors:";
$lang['c_poster_desc'] = "determines if you are the only author of this blog or if there are multiple authors (default = single author).";
$lang['c_smileys'] = "smileys:";
$lang['c_smileys_desc'] = "determines how to handle smileys, if comments are set as \"on page\" (default = standard).";
$lang['c_language'] = "language:";
$lang['c_language_desc'] = "determines the language of this blog (default = english). If you add a language file in the /languages/ directory of the blog on your hosting, it will automatically be listed in this box.";
$lang['c_limit'] = "limit the number of posts:";
$lang['c_limit_desc'] = "enter a number if you want to limit the number of posts displayed by the blog - for example, if you set this option to 3, the index page of the blog will only display the last 3 posts, and all others will be available through the archives - set to 0 if you want to keep all posts from the current month displayed (default = 0).";
$lang['c_maxwidth'] = "width:";
$lang['c_maxwidth_desc'] = "determines the width of this blog - default is 400, which means 400 pixels wide (default = 400 / minimum = 270).";
$lang['c_servertime'] = "server offset:";
$lang['c_servertime_desc'] = "set this to the time offset of your server if you want the dates and times to be displayed correctly - for example, if your server is in NY and you actually are in Paris, time offset is -06 (on the contrary, if you're in NY and your server is in Paris, time offset will be +06 - don't forget the - or + sign, this is important).";
$lang['c_setbutton'] = "set config";
$lang['c_cancelbutton'] = "cancel";
$lang['c_comments_0'] = "no comments";
$lang['c_comments_1'] = "directly on page";
$lang['c_comments_2'] = "sent to the blog owner's e-mail address";
$lang['c_smileys_0'] = "standard";
$lang['c_smileys_1'] = "images smileys";
$lang['c_smileys_2'] = "forbid smileys";
$lang['c_poster_0'] = "single author";
$lang['c_poster_1'] = "multiple authors";
$lang['c_moblogging'] = "mobile blogging options";
$lang['c_moblogging_state'] = "mobile blogging";
$lang['c_moblogging_desc'] = "mobile blogging allows you to post a message on your blog from a portable device, such as a mobile phone or pocket PC. You actually need to send a message from your device to a mail address which will be checked for new messages by the e-moBLOG system. Please note that this may slow down your blog a bit from time to time, depending on the mail server of your mobile blogging target e-mail. Please read the HOW-TO.txt file very carefully before using this option (default = disabled).";
$lang['c_moblogging_0'] = "disabled";
$lang['c_moblogging_1'] = "enabled";
$lang['c_mserver'] = "mail server";
$lang['c_mserver_desc'] = "this is the mail server of the e-mail address to use for mobile blogging. Be aware that you should use an e-mail address that you do not use for anything else, since every message sent to this mail address will be processed, eventually displayed in your blog, then deleted.";
$lang['c_mport'] = "mail server port";
$lang['c_mport_desc'] = "this is the port to connect to your mobile blogging e-mail address mail server (default = 110).";
$lang['c_mtype'] = "mailbox type";
$lang['c_mtype_0'] = "pop3";
$lang['c_mtype_1'] = "imap";
$lang['c_mtype_desc'] = "this is the type of mailbox. If your mailbox does not support either of these protocols, mobile blogging will NOT work (default = pop3).";
$lang['c_mlogin'] = "mailbox login";
$lang['c_mlogin_desc'] = "this is the full login to use to connect to your mobile blogging dedicated mailbox.";
$lang['c_mpassword'] = "mailbox password";
$lang['c_mpassword_desc'] = "this is the password to use to connect to your mobile blogging dedicated mailbox.";
$lang['c_resize'] = "image automatic resize";
$lang['c_resize_desc'] = "determines the way images are handled. Set this to \"enabled\" if you want all images you include in your articles to be automatically resized to the blog width specified below. If you do not want images to be resized, set this to \"disabled\" (default = enabled).";
$lang['c_absolute'] = "blog absolute path";
$lang['c_absolute_desc'] = "this is the absolute path to your blog root directory. It must include the \"/\" sign at the end. (i.e.  /home/yourdomain/public_html/yourblog/  -this is just an example, if you are not sure, ask your system administrator or hosting tech support).";

// admin pages
$lang['a_name'] = "poster's name:";
$lang['a_email'] = "poster's e-mail:";
$lang['a_title'] = "post title:";
$lang['a_content'] = "post content:";
$lang['a_audio'] = "song of the day:";
$lang['a_quote'] = "quote of the day";
$lang['a_postbutton'] = "add post";
$lang['a_updatebutton'] = "update post";
$lang['a_clearbutton'] = "clear";
$lang['a_addpost'] = "add post";
$lang['a_modtodaypost'] = "add to last post";
$lang['a_editpost'] = "edit posts";
$lang['a_config'] = "configuration";
$lang['a_addline'] = "add line";
$lang['a_postsfrom'] = "posts from";
$lang['a_delete'] = "delete";
$lang['a_edit'] = "edit";
$lang['a_delconfirm'] = "do you really want to delete this post?";
$lang['a_delcommconfirm'] = "do you really want to delete this comment?";
$lang['a_logout'] = "logout";
$lang['a_ccontent'] = "comment";
$lang['a_editcomment'] = "edit comment";
$lang['a_updatecbutton'] = "update comment";
$lang['a_addimage'] = "add/mod image";
$lang['a_url'] = "image url";
$lang['a_descr'] = "description";
$lang['a_delimgconfirm'] = "do you really want to delete this image?";
$lang['saveimages'] = "save article images to the gallery?";

// general words
$lang['top'] = "top";
$lang['link'] = "link this post";
$lang['index'] = "index";
$lang['required'] = "note: fields marked with a * are required.";
$lang['no_posts'] = "there are no articles for this month yet.";
$lang['rss'] = "rss";
$lang['search'] = "search";
$lang['search_posts'] = "search posts for";
$lang['numpages'] = "the search returned more results:";
$lang['page'] = "page";
$lang['gallery'] = "gallery";
$lang['frompost'] = "referring post";
$lang['no_images'] = "there are no images to display.";
$lang['numimages'] = "sorted by date - more images:";
$lang['noresults'] = "no results found.";
$lang['visitor'] = "person lost on this blog";
$lang['visitors'] = "people on this blog";
$lang['powered'] = "powered by";

// comments
$lang['comment'] = "comment";
$lang['comments'] = "comments";
$lang['posted_by'] = "posted by";
$lang['no_comments'] = "there are no comments on this article yet.";
$lang['post'] = "post a comment";
$lang['uname'] = "your name";
$lang['uemail'] = "your e-mail";
$lang['ucomment'] = "your comment";
$lang['post_button'] = "post comment";
$lang['clear_button'] = "clear";
$lang['postip'] = "poster's IP";
$lang['delcomm'] = "delete this comment";

// errors
$lang['error'] = "error: ";
$lang['pic_format'] = "unknown picture format.";
$lang['pic_gif'] = "GIF format is not supported.";
$lang['field_error'] = "please fill in the name and comment fields.";
$lang['field2_error'] = "please fill all the fields.";
$lang['pass_error'] = "the passwords you enter do not match.";
$lang['email_error'] = "please enter a valid e-mail address.";

// status confirmations
$lang['add_status'] = "<b>your new post has been added.</b>";
$lang['mod_status'] = "<b>the post has been modified.</b>";
$lang['del_status'] = "<b>the post has been deleted.</b>";
$lang['delcomm_status'] = "<b>the comment has been deleted.</b>";
$lang['conf_status'] = "<b>the configuration has been updated.</b>";
$lang['modc_status'] = "<b>the comment has been modified.</b>";

// comments sent by mail
$lang['mailcomment'] = "send comment";
$lang['mailsubject'] = "[comment from e-moBLOG]";
$lang['mailfrom'] = "sent by";
$lang['mailaddress'] = "e-mail address";
$lang['mailarticle'] = "concerning the article";
$lang['email_sent'] = "your comment has been sent. thank you!";

// archives
$lang['archives'] = "archives";
$lang['archivesfrom'] = "archives from";
$lang['links'] = "links archives";
$lang['all_links'] = "all links archives";
$lang['no_links'] = "there are no links archives for this month yet.";

// help
$lang['help'] = "help";
$lang['helpfile1'] = " You <b>must</b> at least fill the name and comment fields in. The e-mail field is not required.";
$lang['helpfile2'] = " HTML tags are not allowed at all, though you may use some UBB tags.";
$lang['helpfile3'] = " Here is a list of UBB tags allowed and how they work:";
$lang['help_bius'] = "[b] [i] [s] and [u] tags may be used respectively to make a text or portion of it <b>Bold</b>, <i>Italic</i>, <s>Strike</s> and <u>Underline</u>.<br /> Example: [b]<b>bold text</b>[/b]";
$lang['help_center'] = "[center] tag may be used to center a text or image in the blog.<br /> Example: [center]your text or image[/center]";
$lang['help_url'] = "[url=...] tag may be used to make a link to any URL.<br /> Example: [url=http://www.mydomain.com]this is a link[/url] (See note below)";
$lang['help_img'] = "[img] tag may be used to display an image in your comment. Valid images formats are JPG and PNG. The GIF format is <b>not</b> supported and will not be displayed.<br /> Example: [img]http://www.mydomain.com/mypicture.jpg[/img]";
$lang['help_note'] = " <u>Note:</u> Any URL or e-mail address you write in your comment will automatically be formatted as a link to this very URL or e-mail address. You do not need to put any UBB tags for that. Also please do not use spaces in any URL, they will not be accepted.";

// admin help
$lang['a_help'] = "help";
$lang['a_helpfile1'] = " Required fields are always marked with a * sign.";
$lang['a_helpfile2'] = " HTML tags are not allowed at all, though you may use some UBB tags.";
$lang['a_helpfile3'] = " Here is a list of UBB tags allowed and how they work:";
$lang['a_help_bius'] = "[b] [i] [s] and [u] tags may be used respectively to make a text or portion of it <b>Bold</b>, <i>Italic</i>, <s>Strike</s> and <u>Underline</u>.<br /> Example: [b]<b>bold text</b>[/b]";
$lang['a_help_center'] = "[center] tag may be used to center a text or image in the blog.<br /> Example: [center]your text or image[/center]";
$lang['a_help_url'] = "[url=...] tag may be used to make a link to any URL.<br /> Example: [url=http://www.mydomain.com]this is a link[/url] (See note below)";
$lang['a_help_img'] = "[img] tag may be used to display an image in your article. Valid images formats are JPG and PNG. The GIF format is <b>not</b> supported and will not be displayed. Please note that images larger than the maximum width specified in the blog configuration will be automatically resized (if image resizing option is set as enabled), though this could take a lot of server ressources, so we recommend you to resize your images yourself before posting them.<br /> Example: [img]http://www.mydomain.com/mypicture.jpg[/img]<br /><br />You can also choose to align the image to the left or right of your text by using either [img left] or [img right] instead of [img] tag. Please note that if the image auto-resize feature is enabled and you post an image wider than your blog width, we recommend using the simple [img] tag with this image.";
$lang['a_help_note'] = " <u>Note:</u> Any URL or e-mail address you write in your article will automatically be formatted as a link to this very URL or e-mail address. You do not need to put any UBB tags for that. Also please do not use spaces in any URL, they will not be accepted.";

// months short names
$lang['jan'] = "jan";
$lang['feb'] = "feb";
$lang['mar'] = "mar";
$lang['apr'] = "apr";
$lang['may'] = "may";
$lang['june'] = "june";
$lang['july'] = "july";
$lang['aug'] = "aug";
$lang['sep'] = "sep";
$lang['oct'] = "oct";
$lang['nov'] = "nov";
$lang['dec'] = "dec";

// months full names
$lang['jan1'] = "January";
$lang['feb1'] = "February";
$lang['mar1'] = "March";
$lang['apr1'] = "April";
$lang['may1'] = "May";
$lang['june1'] = "June";
$lang['july1'] = "July";
$lang['aug1'] = "August";
$lang['sep1'] = "September";
$lang['oct1'] = "October";
$lang['nov1'] = "November";
$lang['dec1'] = "December";
?>