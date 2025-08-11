Mortgage Calculators Plus
version 1.1.0
README

==================================================================
Copyright:
==================================================================

This program is copyright (c) 2005 by ARSIDIAN.

==================================================================
Installation
==================================================================

1. Upload all files from this directory to a web accessible directory on your server or hosting account. 
2. Change the permissions on the includes/smarty/templates_c directory to be writeable by all - 777 (-rwxrwxrwx) within your FTP Client.
3. Mortgage Calculators Plus should now be available.

==================================================================
Configuration
==================================================================

Check settings in the includes/config.inc.php file.

==================================================================
Incorporation
==================================================================

Here is a step-by-step instruction on incorporating the calculators into your website:
1. Open HTML source of one of your website pages.
2. Replace the contents of the "templates/main.tpl" file with your page's contents.
3. Place somewhere in the <head> these lines (link styles and tip
   displaying script):
   <link href="calculators.css" type="text/css" rel="stylesheet">
   <script type="text/javascript" src="calculators.js"></script>
4. Place somewhere in the <body> this line (it displays tips):
   <div id="tiplayer"></div>
5. Replace your page's text with this: {$contents}. All calculators
   will be appearing at that point.
6. (optional) Replace your page's title with this: {$title}.
   For example,
   BEFORE: <title>ACME Title</title>
    AFTER: <title>{$title}</title>
7. (optional) Replace your page's description with this: {$description}.
   For example,
   BEFORE: <meta name="description" content="ACME Description">
    AFTER: <meta name="description" content="{$description}">
8. Open calculators.php in your web browser.
9. If it is fine, link to it from your website.
