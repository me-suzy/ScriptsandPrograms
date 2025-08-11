<?php

$para['integrator::welcome'] = <<<_P
Welcome on the SiteBar integration page. This page helps you to get
most out of the SiteBar. On the <a href="http://sitebar.org/">SiteBar homepage</a>
you can learn more about SiteBar features.
_P;

$para['integrator::header'] = <<<_P
SiteBar is designed to comply with standards and should work on most browsers with
enabled javascript and cookies. The following table shows on what browsers it has
been tested.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar uses right+click to invoke context menus for links and folders.
As Opera user you must enable so called "Menu Icon" in "User Settings"
and click on the icon beside link or folder icon instead. Opera does not support
<a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. It is recommended to
switch usage of XSLT related features in "User Settings" off.
_P;

$para['integrator::hint'] = <<<_P
Click above on the name of the browser of your choice to see integration instructions.
Please <a href="http://brablc.com/mailto?o">report</a> other verified browsers/platforms.
_P;

$para['integrator::hint_window'] = <<<_P
This is an ordinary link which will open the SiteBar in the current window.
SiteBar is designed for a verticall rather narrow bar. This way a lot of space
would be wasted.
_P;

$para['integrator::hint_dir'] = <<<_P
Apart of the tree like display, SiteBar can be shown as a traditional directory.
This view shows one directory at a time and shows details for displayed links.
The browser must support <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
If your browser does not have a sidebar feature, you may use this bookmarklet*.
It will open SiteBar in a pop-up window similar to a sidebar. Please be aware of the fact
that your browser may block pop-ups!
_P;

$para['integrator::hint_addpage'] = <<<_P
This bookmarklet* may be used to add links to your SiteBar. When executed a new pop-up
window will occur that will be prefilled with the details of the current page.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> is a bookmark/favorite
that contains JavaScript code. You can right click it and add to your bookmarks/favorites toolbar.
Later click on this bookmark will execute the JavaScript code.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Adds SiteBar Bookmark Search to the Web Search field. Allows searching in SiteBar bookmarks without
having SiteBar opened.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Extension developed especially for SiteBar.
Allows to open all links from one folder in the tabs and other features.
Use menu View/Toolbar/Customize to put SiteBar icons on your toolbar.
[<a href="http://sitebarsidebar.mozdev.org/">Project page</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Creates a bookmark that can be later clicked to open SiteBar in a sidebar panel.
_P;

$para['integrator::hint_booksync'] = <<<_P
Download the Bookmark Synchronizer extension. Restart Firefox, open Extension manager and
in options set in remote file settings protocol <strong>HTTP</strong>, host <strong>%s</strong>
and path <strong>%s</strong> . At the moment only SiteBar->Firefox synchronization works.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Download folder structure of your entire SiteBar to a file. Import this file to your bookmarks.
Each folder is represented by a Live Bookmark. This way your bookmarks will be integrated among
your other bookmarks, but folder content will be online downloaded from SiteBar.
In case a folder has subfolders, content of the actual folder will be shown in @Content folder.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Download and install <a href="http://sourceforge.net/projects/mozlinker/">extension</a>
(attention, it is not possible to uninstall it). A new menu "MozLinker" appears in
browser's menu. Use "Config..." submenu and add either new menu or new toolbar. As Resource URL use
the URL from the "MozLinker Extension" link on the left side.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Adds SiteBar into the sidebar panel. The panel can be shown/hidden with F9. In
case loading SiteBar into the sidebar exceed certain timelimit, Mozilla fails to
display it. It is recommended to open the SiteBar in the main window to allow
linked images (favicons) be cached in the browser or to switch favicon display
in "User Settings" off.
_P;

$para['integrator::hint_hotlist'] = <<<_P
A link to SiteBar will be shown in the Hotlist panel. Click on it will open SiteBar in the Opera sidebar.
_P;

$para['integrator::hint_install'] = <<<_P
Installs the SiteBar to the Explorer Bar and context menu - requires Windows registry change
and system restart for all features. Depending on your rights only some features might be
installed.
<br>
Open SiteBar Explorer Bar from menu View/Explorer Bar or use toolbars' function Customize...
get the SiteBar Panel toggle button shown on the toolbar. Right click anywhere on the page or
over a link to add the page or link to the SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Uninstalls the Explorer Bar (see above).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Using this bookmarklet* is recommended in case that the user does not have enough privileged
to install the explorer bar. It loads SiteBar temporarily to the Search Explorer Bar of your
browser.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Downloads a plugin (with preset URL). The archive must be extracter to the "C:\\Program Files\\Maxthon\\Plugin"
directory. After restart a new Explorer Bar item will be added.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Downloads a plugin (with preset URL). The archive must be extracter to the "C:\\Program Files\\Maxthon\\Plugin"
directory. After restart a new icon will occur on the Plugin toolbar. This icon allows page in the current
tab be added to the SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Run command <strong>emerge sitebar</strong> to install SiteBar package.
_P;

$para['integrator::hint_debian'] = <<<_P
Run command <strong>apt-get install sitebar</strong> to install SiteBar package.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu is a hierarchical menu system to prepare "on the fly" DHTML
menus relying on the PHP scripting engine for the processing of data items.
SiteBar can serve provide bookmark feed in proper structure. In case fopen
is allowed to open remote files, the following code will load file in proper structure:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &copy; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
and the <a href='http://sitebar.org/team.php'>SiteBar Team</a>.
Support <a href='http://sitebar.org/forum.php'>forum</a> and <a href='http://sitebar.org/bugs.php'>bug</a> tracking.
_P;

/* Command window */

$para['command::welcome'] = <<<_P
%s, welcome to the SiteBar!
%s
<p>
SiteBar is operated via context menus that are invoked using the right-click on a folder or a link.
If your platform/browser does not support right-click, you may try Ctrl-click or turn on "Show Menu Icon"
option in the "User Settings" and click on the icon.
<p>
To read more information about SiteBar please click on the "Help" item in the bottom menu.
<p>
You have been already logged in.
_P;

$para['command::signup_verify'] = <<<_P
<p>
This SiteBar installation requires that your email address
is valid and verified before you can use SiteBar functions.
<p>
Provided you have set correct email address, you should
receive an email shortly. Please click on the link in the
email.
_P;

$para['command::signup_approve'] = <<<_P
<p>
This SiteBar installation requires created accounts be approved
by an administrator before you can use SiteBar functions.
<p>
Please wait for an administrator approval - you will be
informed by an email.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
This SiteBar installation requires that your email address
is valid and verified and that an administrator approves
your account before you can use SiteBar functions.
<p>
Provided you have set correct email address, you should
receive an email shortly. Please click on the link in the
email and wait for an administrator approval - you will be
informed by an email.
_P;

$para['command::account_approved'] = <<<_P
The administrator has approved your account request.
You can login using your email %s.

--
SiteBar installation at %s.
_P;

$para['command::account_rejected'] = <<<_P
The administrator has rejected your account request
with email %s.

--
SiteBar installation at %s.
_P;

$para['command::account_deleted'] = <<<_P
The administrator has deleted your inactive account
with email %s.

--
SiteBar installation at %s.
_P;

$para['command::reset_password'] = <<<_P
A password reset for SiteBar account has been requested for "%s" e-mail.

In case you really want to reset password for this account, please click
on the following link:
    %s

--
SiteBar installation at %s.
_P;

$para['command::contact'] = <<<_P
%s


--
SiteBar installation at %s.
_P;

$para['command::contact_group'] = <<<_P
Target group: %s

%s


--
SiteBar installation at %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Do you really want to delete your account?</h3>
There will be no way to undo that change!<p>
All your remaining trees will be given to the administrator of the system.
_P;

$para['command::email_link_href'] = <<<_P
<p>Send e-mail via your default
<a href="mailto:?subject=Web site: %s&amp;body=I have found a web site you may be interested in.
 Take a look at: %s
 --
 Sent via SiteBar at %s
 Open Source Bookmark Server http://sitebar.org
">e-mail client</a>
_P;

$para['command::email_link'] = <<<_P
I have found a web site you may be interested in.
Take a look at:

    "%s" %s

%s

--
Sent via SiteBar at %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
You have requested e-mail validation that allows joining of
groups with auto join regular expressions and allows you to
make use of SiteBar's e-mail features.

Please click on the following link to verify your email:
    %s
_P;

$para['command::verify_email_must'] = <<<_P
You have signed up for a SiteBar account on SiteBar installation
that requires e-mail verification before first use of SiteBar.

Please click on the following link to verify your email:
    %s
_P;

/*
$para['command::import_bk'] = <<<_P
<br>
Local favorites can be exported to a local file using javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>function</a>.
_P;

$para['command::export_bk'] = <<<_P
<br>
Exported bookmarks can be imported to local favorties using javascript
<a href='javascript:window.external.ImportExportFavorites(true,"")'>function</a>.
_P;
*/

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer can import bookmarks in Netscape Bookmark File format from "File/Import and Export ..." menu.
However, it must be in the native Windows encoding, the default UTF-8 will not work.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer can export bookmarks in Netscape Bookmark File format from "File/Import and Export ..." menu.
The exported file is in the native Windows encoding - please select the codepage when importing the file,
the default UTF-8 will not work.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Codepage conversion not installed on this SiteBar server. Only utf-8 and iso-8859-1 supported.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rights:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete,
<strong>P</strong>urge,
<strong>G</strong>rant
_P;

$para['command::purge_cache'] = <<<_P
<h3>Do you really want to remove all favicons from the cache?</h3>
_P;

$para['command::tooltip_baseurl'] = 'URL without trailing / pointing to this installation.';
$para['command::tooltip_default_domain'] = 'When domain is set, users using emails as login name do not have to specify it.';
$para['command::tooltip_respect'] = 'Send email only if user has allowed it.';
$para['command::tooltip_to_verified'] = 'Send emails only to verified addresses.';
$para['command::tooltip_allow_contact'] = 'Allow administrator be contacted by anonymous users.';
$para['command::tooltip_allow_custom_search_engine'] = 'If not allowed, then all users will use the search engine set on this form and will not be able to modify it.';
$para['command::tooltip_allow_sign_up'] = 'Allow visitors to access the sign up form and register to SiteBar.';
$para['command::tooltip_comment_impex'] = 'Show commands for import and export of link description.';
$para['command::tooltip_personal_mode'] = 'Enable a SiteBar mode aimed at a single user installation.';
$para['command::tooltip_allow_user_trees'] = 'Allow the users to create additional trees.';
$para['command::tooltip_allow_user_tree_deletion'] = 'Allow the users to delete their existing trees.';
$para['command::tooltip_allow_user_groups'] = 'Users are allowed to create their own groups. Otherwise only administrators have this privilege.';
$para['command::tooltip_use_conv_engine'] = 'Use conversion engine (usually extension for PHP) to convert pages with different encoding - important for import and export of bookmarks. May cause blank screens on some implementations.';
$para['command::tooltip_use_compression'] = 'Pages sent by SiteBar can be compressed to save bandwidth. Compression is only used if supported on browser side.';
$para['command::tooltip_use_mail_features'] = 'In case this PHP installation allows "mail" function to be used - e-mail features can be enabled.';
$para['command::tooltip_use_outbound_connection'] = 'Some functions (favicon cache) require to access remote addresses from your server.';
$para['command::tooltip_users_must_be_approved'] = 'Users are must be approved by adminstrator before they can use SiteBar.';
$para['command::tooltip_users_must_verify_email'] = 'Users must verify e-mail before they can use SiteBar.';
$para['command::tooltip_show_logo'] = 'Show logo at the top - should be disabled for slow hostings, otherwise can be used for advertising.';
$para['command::tooltip_show_statistics'] = 'Display some static and performance statistics on the main SiteBar panel.';
$para['command::tooltip_allow_anonymous_export'] = 'Enable direct bookmark download or feed for anonymous users. Can be bypassed if user knows how to construct URL!';
$para['command::tooltip_use_favicon_cache'] = 'Favicons icons will be downloaded by the server to the database cache and upon client requests sent. Increases traffic and speeds up favicon cache by reducing the number of connected servers.';
$para['command::tooltip_max_icon_cache'] = 'FIFO stack. The oldest icons will be discarded from the system - used to control size of the cache.';
$para['command::tooltip_max_icon_size'] = 'Maximal allowed size of icon in bytes.';
$para['command::tooltip_max_icon_age'] = 'How long will favicons stay in the cache before it will be refreshed from the remote server.';
$para['command::tooltip_verified'] = 'Check this to mark the email as verified.';
$para['command::tooltip_demo'] = 'Make this a demo account with limited functionality and no possibility to change password.';
$para['command::tooltip_approved'] = 'Account is approved and can be fully used.';
$para['command::tooltip_mix_mode'] = 'Folders preceed links in the SiteBar tree or vice versa.';
$para['command::tooltip_allow_given_membership'] = 'Allow moderators to add me to their groups.';
$para['command::tooltip_allow_info_mails'] = 'Allow admins and moderators of group that I belong to, to send me info emails.';
$para['command::tooltip_auto_retrieve_favicon'] = 'Retrieve favicon automatically when it is missing and link is being added.';
$para['command::tooltip_show_acl'] = 'Decorate folders with security specification.';
$para['command::tooltip_extern_commander'] = 'Execute commands using external window - without reloads after every command.';
$para['command::tooltip_hide_xslt'] = 'Hides features that need XSLT browser support.';
$para['command::tooltip_load_open_nodes_only'] = 'Loads content of open folders only, content of other folders is loaded only when user clicks on it.';
$para['command::tooltip_private_over_ssl_only'] = 'Private links will be loaded only if SiteBar is used over SSL connection.';
$para['command::tooltip_exclude_root'] = 'The root folder will not be included in the output if possible.';
$para['command::tooltip_menu_icon'] = 'Some browsers/platforms do not handle right click. This will show an icon that can be used instead to show context menus.';
$para['command::tooltip_auto_close'] = 'Do not display command execution status in case of success.';
$para['command::tooltip_show_public'] = 'Shows bookmarks published by other users.';
$para['command::tooltip_use_favicons'] = 'Usage of favicons makes SiteBar nicer and slower. When favicon cache is used by this installation, display of favicons will be significanlty faster.';
$para['command::tooltip_use_hiding'] = 'Allows command to hide folders. Hiding is used for published folders of other users.';
$para['command::tooltip_use_tooltips'] = 'Use SiteBar tooltips instead of browser built-in. Allows longer tips and support for more browsers.';
$para['command::tooltip_use_trash'] = 'Mark deleted folders and links so that they can be undeleted or purged.';
$para['command::tooltip_use_search_engine'] = 'Allows search be redirected to or extended by results provided with your favorite web search engine.';
$para['command::tooltip_use_search_engine_iframe'] = 'The results of your web search engine will be included in the SiteBar search results page using inline frame.';
$para['command::tooltip_allow_addself'] = 'Allow users to add themselves to the group.';
$para['command::tooltip_allow_contact_moderator'] = 'Allow group moderator be contacted by non-members.';
$para['command::tooltip_publish'] = 'Publish this folder so that everyone can see it.';
$para['command::tooltip_delete_content'] = 'Delete only content of the folder, rather than the folder itself.';
$para['command::tooltip_paste_content'] = 'Apply the operation to the content of the folder not to the folder itself.';
$para['command::tooltip_default_folder'] = 'Next time you use the bookmarklet this folder will be set as default.';
$para['command::tooltip_private'] = 'Mark link as private. Only tree owner can see such link even when folder is published.';
$para['command::tooltip_novalidate'] = 'Do not validate this link - use for intranet links or for links that have problems with validations.';
$para['command::tooltip_is_dead_check'] = 'This link did not pass validation. You may still wanted to keep it as active.';
$para['command::tooltip_subfolders'] = 'Validate this folder recursively with all subfolders.';
$para['command::tooltip_ignore_recently'] = 'Do not test links that have been tested recently - used for repeated validation when the previous did not finish.';
$para['command::tooltip_discover_favicons'] = 'Try to analyze the page and find favicons (shortcut icons) that are missing.';
$para['command::tooltip_delete_favicons'] = 'Delete favicon URL from link if the favicon is invalid - use with care.';
$para['command::tooltip_rename'] = 'On import rename duplicate links to have everything loaded.';
$para['command::tooltip_hits'] = 'Route all clicks on links through SiteBar server to generate usage statistics.';
$para['command::tooltip_private'] = 'Ignore private links in the export. Private links are always ignored for other users then owner.';
$para['command::tooltip_subdir'] = 'Recursively export all links and all folders.';
$para['command::tooltip_flat'] = 'Export the links as if they were in one folder.';
$para['command::tooltip_cmd'] = 'Add most important SiteBar Commands to allow easy login to SiteBar.';

/* SiteBar */
$para['sitebar::users_must_verify_email'] = <<<_P
This SiteBar installation requires email verification.
Please verify your email, otherwise your account may be deleted.
_P;

/* User manager */

$para['usermanager::auto_verify_email'] = <<<_P
Your e-mail address matches rules for auto join to following
closed group(s):
    %s.

In order to aprove your membership, your email address must
be verified. Please click on the following link to verify it:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
User "%s" <%s> signed up to your SiteBar installation at %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
User "%s" <%s> signed up to your SiteBar installation at %s.
The user has already verified his email address.
_P;

$para['usermanager::signup_approval'] = <<<_P
User "%s" <%s> signed up to your SiteBar installation at %s.

Approve account:
    %s

Reject account:
    %s

See pending users:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
User "%s" <%s> signed up to your SiteBar installation at %s.
The user has already verified his email address.

Approve account:
    %s

Reject account:
    %s

See pending users:
    %s
_P;

/* Skins */
$para['hook::statistics'] = <<<_P
Roots {roots_total}.
Folders {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Users {users}.
Groups {groups}.
SQL queries {queries}.
DB/Total time {time_db}/{time_total} sec ({time_pct}%).
_P;


?>
