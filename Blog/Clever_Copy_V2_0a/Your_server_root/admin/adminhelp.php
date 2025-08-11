<?php
include ('index.php');
echo '<br><br>';
echo 'This is the admin help file';
?>

<p>Once you have logged in, what you see will depend on your clearance level.
</p>
<p>There are three levels of admin: </p>
<ul>
  <li>Level 1 - Super User. Super Users are able to post news directly to the
  site via the admin panel without admin approval.</li>
  <li>Level 2 - Admin. An Admin is able to to take a more active role in
  managing the site. The functions available to an admin allow him to edit anything a visitor can see.</li>
  <li>Level 3 - God. God is able to perform all functions relating to the site.</li>
</ul>
<p>&nbsp;</p>
<p><b>The menu items and what they do:</b></p>
<table border="0" cellspacing="1" style="border-collapse: collapse" bordercolor="#111111" width="100%" id="AutoNumber1">
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/mainadmin.gif" width="55" height="39"></td>
    <td width="92%">Refresh Admin - This button will always return you to the main admin
    menu regardless of your current location. Any actions in progress will be
    abandoned.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/additem.gif" width="55" height="39"></td>
    <td width="92%">Add News - Allows you to add a new news item to the site. Enter a
    title and the news text. If you wish to have a 'More...' link appear rather
    than trying to fit your whole news item in one section, type the remainder
    of your news text into the 'Long text' field.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/homesite.gif" width="55" height="39"></td>
    <td width="92%">Clever Copy Home Site - Opens a new window and takes you to the Clever Copy home
    page.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/help.gif" width="55" height="39"></td>
    <td width="92%">Admin Help - Starts this file.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/edit.gif" width="55" height="39"></td>
    <td width="92%">Browse in Admin Mode - Allows you to browse the main site in admin mode. You will notice that
    under some items on the page there is an edit or delete option. You may click
    these links to perform the desired action and editing/deleting of comments, news items
    or shouts etc are performed in this way rather than directly from the admin panel.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/banning.gif" width="55" height="39"></td>
    <td width="92%">Ban/Unban IP's - Allows you to ban the IP address of any nuisance visitors.
    This will prevent them from posting comments etc but bear in mind that if
    they visit the site again at a later date, they may have a different IP
    address and the ban will fail. You will need to add the latest IP address to
    ban them again and repeat this process each time they visit. You may also unban
    previous bans.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/scroller.gif" width="55" height="39"></td>
    <td width="92%">Edit Scroller - Edit the contents of the scroller block.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/prune.gif" width="55" height="39"></td>
    <td width="92%">Delete old News - Will remove old news articles from the date you specify.
    Although Clever Copy is based on a&nbsp; fast MySql database backend, over
    time you may notice that the site slows down as more items are added. This
    option allows you to remove news items that are no longer considered worth
    keeping and will speed your site up again.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/prefs.gif" width="55" height="39"></td>
    <td width="92%">Site Preferences - Sets the site wide preferences. The look and feel of the site, as well as
    the way it behaves are controlled through this option. It allows you to set many of the sites'
    features and you should become familiar with each preference item and the effect it has on
    the site in general. If you are looking for a way to change the way something works or looks,
    it is probably in here.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/editadmin.gif" width="55" height="39"></td>
    <td width="92%">Edit/Add Admins - Allows you to add, edit or delete other admins and set their
    clearance levels. </td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/banners.gif" width="55" height="39"></td>
    <td width="92%">Banners - Add, edit or delete banners, check invoices and banners status. If you have set up banners to run on
    your site, this is where the detail will be found. The banner manager is a very
    powerful program and allows you to set multiple modes of operation and includes
    auto invoicing and suspension of banners until invoice is paid. Another option that
    you need to be sure of how it works to get the best from it.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/newsletter.gif" width="55" height="39"></td>
    <td width="92%">News Letter - Create and send a newsletter. Manage archived newsletters, view
    and edit membership list, set newsletter templates etc. Another very powerful
    script that has mulitiple options embedded.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/shout.gif" width="55" height="39"></td>
    <td width="92%">Shout - Edit the shout box settings and behaviour. Deleting of shouts
    is done via the shout box itself whilst browsing the site in admin mode.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/meta.gif" width="55" height="39"></td>
    <td width="92%">RSS Feed - RSS feed settings. Edit the settings to use when automatically generating.
    RSS feeds for your news items. Turning the RSS generator on or off is performed in site preferences.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/downloads.gif" width="55" height="39"></td>
    <td width="92%">Downloads - Add, edit or delete downloads on your site. Before making a download
    available to your visitors through this option, you must first upload the file you
    wish to offer as a download to the downloads directory on your server.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/blocks.gif" width="55" height="39"></td>
    <td width="92%">Block Names & Custom Content - Edit the names of blocks and the content of custom blocks. For example
    in here is where you would change the names of custom blocks to something more suitable to
    your needs.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/stats.gif" width="55" height="39"></td>
    <td width="92%">Site Stats - View the stats for your site. See who has visited, when, for how
    long and which pages. Track the visitors back to their ISP etc. Define the maximum
    number of stats to keep in the database in site preferences.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/query.gif" width="55" height="39"></td>
    <td width="92%">Network query - Throughout the site when browsing in admin mode, you will see
    IP addresses highlighted in red. These are clickable links and will take you
    to this network query function allowing you to trace visitors to your site. You
    may also use it directly by typing in an address or IP.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/web_links.gif" width="55" height="39"></td>
    <td width="92%">Web Links - Weblinks exchange. Allows visitors to automatically add their site
    to your site links block. Before they are able to do this, they must place your
    link on their site. The script will allow you to accept or decline the link before it
    is activated and will automatically check that your link remains in place. If they remove
    your link from their site, Clever Copy will warn you or you can set the option to automatically
    delete their link from your site.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/editmenu.gif" width="55" height="39"></td>
    <td width="92%">Edit Main Nav Menu - Allows you to add, delete or edit items in the main navigation
    menu. You can decide how the link will operate and it provides flexibility and
    expandability to your site.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/ticker.gif" width="55" height="39"></td>
    <td width="92%">News Ticker - Edit the settings and text for the scrolling news ticker. This
    is a great way to grab a visitors attention with your latest announcements or news.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/profile.gif" width="55" height="39"></td>
    <td width="92%">Edit Profile - A way of providing a little personal information about you or your site.
    If you don't want a particular item to show, just leave it blank and it will be ignored.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/editgallery.gif" width="55" height="39"></td>
    <td width="92%">Gallery - Edit the settings for the gallery. The install script should automatically
    insert the various paths needed to run the gallery but you can edit them, and other
    gallery settings such as the title etc by using this admin option. To add pictures to your gallery, upload them to the gallery/photos directory and
    the thumbnails will be automatically generated.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/phpinfo.gif" width="55" height="39"></td>
    <td width="92%">Server Info - Use the inbuilt phpinfo function to find paths and server
    info. This will open in a new window and provides a wealth of information
    about your current server setup.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/editcal.gif" width="55" height="39"></td>
    <td width="92%">Edit Event Calendar - Edit the event calendar settings. This allows you change the
    settings for the event calendar. You may also add, edit or delete events. If you don't
    want to use the event calendar for displaying upcoming events you can use it as a standard
    calendar. To do this just don't add any events and it will function perfectly well.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/blockpos.gif" width="55" height="39"></td>
    <td width="92%">Block weighting, position and view prefs - Allows you to set how each block
    can be viewed. It sets the side, who can view it or whether the block is on or off. If you
    wish to test a block prior to making it available to visitors, set the block viewable only
    by admin.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/usernews.gif" width="55" height="39"></td>
    <td width="92%">Approve User News - Clever Copy allows visitors to your site to
    submit news items to it. You decide whether the item should be posted or not via
    this admin option. You can disallow user posted news in site preferences.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/welcomemsg.gif" width="55" height="39"></td>
    <td width="92%">Welcome Message - Greet your visitors with this welcome message or turn it
    off in site preferences.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/slogan.gif" width="55" height="39"></td>
    <td width="92%">Slogan - Your site slogan. It appears at the top of most pages and
    can be edited in here. If you wish to change the image for your own, you must replace
    the cclogo.gif file in the images directory with your own.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/support.gif" width="55" height="39"></td>
    <td width="92%">Clever Copy Support - Got a tricksy problem? Open a new window and get help here.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/users.gif" width="55" height="39"></td>
    <td width="92%">Edit/Add members - Shows you the details and status of your current site membership.
    Allows you to edit user details, search for users, add or delete users.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/editpoll.gif" width="55" height="39"></td>
    <td width="92%">Change/Edit poll - Change or edit your current poll.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/bug.gif" width="55" height="39"></td>
    <td width="92%">Bug reporting, suggestions etc - Allows you to report bugs, make suggestions
    etc. Sends your message directly to Magus Perde.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/ppc.gif" width="55" height="39"></td>
    <td width="92%">Pay per click - Accept Pay per click advertising just like Google.
    View current ads, ad status, owner status, invoicing and invoicing histories. A
    highly complex script. If you use PPC it is suggested you learn what each option does.</td>
  </tr>
  <tr>
    <td width="8%">
    <img border="0" src="../images/admin/logout.gif" width="55" height="39"></td>
    <td width="92%">Logout - Exits admin and returns you to the main site page. It is strongly
    recommended that you always log out of admin when you have finished in the admin
    panel and it is further recommended that you make any other site admins that you may
    appoint aware of this.</td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>