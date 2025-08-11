<? // Admin username and password
define("admin_name", "admin");
define("admin_pass", "Th3B0ss");

// Site title to be showed in the browser title bar
define("site_title", "T. O Donnell Inc.");

// This is the title that it will be show in the top of all the pages by default
define("title_affiliates", "The TigerTom Affiliate Program");

// The main url of your website, this should end in a forward slash /
define("main_url", "http://www.ttwebmaster.com/");

// The root folder where the program is installed, this should end in a forward slash /
define("script_root", "http://www.ttwebmaster.com/ttaps/");

// The name from whom the site emails are sent
define("from_name", "T. O Donnell Incorporated");

// NOTE!: The following _must_ be valid email addresses, or the script won't work!!:

// The main email address to send email messages TO:
define("email_affiliates", "leonardo@cornflakes1.com");

// An email address to send complaints about spam
define("spam_notify_email", "lpin@cornflakes1.com");

// The FROM email address of the sender of the emails (site owner):
define("from_email", "ttaps@cornflakes1.com");

///////////////////////////////////////////////////////////////////////////
// Template configuration begins, all this files should be stored in the templates folder  //
///////////////////////////////////////////////////////////////////////////

// The affiliates data folder where the individual sales logs are going to be stored
define("affiliates_db_folder", "affiliates");

// The templates folder where the html templates are located
define("templates_db_folder", "templates");

// The main db folder where general databases will be stored
define("main_db_folder", "dbs");

// The affiliates data file, where all the personal info about the affiliates is stored
// This file uses the following format:
// nickname|name|email|address|zipcode|city|state|country|telephone|siteurl|password|paid so far
define("affiliates_data_file", "affiliates.dat");

// The pending affiliates data file, where the affiliate info will be stored until he validates it.
define("pending_data_file", "affiliates_pending.dat");

// The general sales log file
define("sales_data_file", "sales.dat");

// The paired data file, where the referer and new affiliate is stored
define("paired_data_file", "paired.dat");

// The general referers log file
define("referred_data_file", "referrals.dat");

// This file contains the database of links to where the affiliate may redirect 
// the user directly to the product of his preference.
// This file uses the following format:
//
// product code name|product title|product url
//
// If you want to specify a default link just leave the 'product code name' field empty.
// See the current file for examples of how this is done.
define("redirect_links_file", "redirect_links.txt");

// The admin login form template
define("admin_enter_template", "admin_enter.html");

// The main admin menu template
define("admin_menu_template", "admin_menu.html");

// Shows a list of affiliates that have earned more that x amount of money
define("admin_earnedlist_template", "admin_earned_list.html");

// Show affiliates data
define("admin_affiliatedata_template", "admin_affiliate_data.html");

// Search results template
define("admin_searchresults_template", "admin_search_results.html");

// Pay all users template
define("admin_payusers_template", "admin_pay_users.html");

// Email form template
define("admin_email_template", "admin_email.html");

// New referred affiliates list
define("admin_referredlist_template", "admin_referred_list.html");

// Sales list
define("admin_saleslist_template", "admin_sales_list.html");

// New affiliate signup form
define("signup_form_template", "affiliate_join.html");

// Validation message page after an affiliate´s signup
define("signup_validation_template", "validate.html");

// Welcome page after an affiliates validation process completes
define("signup_complete_template", "success.html");

// Login form to access the affiliate stats
define("affiliate_statsenter_template", "affiliate_stats_login.html");

// The main affiliate stats page
define("affiliate_stats_template", "affiliate_stats.html");

// The affiliate get code page
define("affiliate_getcode_template", "getcode.html");

// Login form to access the code page
define("affiliate_getcodeenter_template", "getcode_enter.html");

// Password reminder form
define("affiliate_password_reminder", "pass_reminder.html");

// Password reminder sent page
define("affiliate_password_sent", "pass_sent.html");

// Standard error template
define("err_standard_template", "err_std.html");

// Main affiliate page with all the info the affiliate needs, this link will be send in the welcome email message
define("URL_affiliate", "associate.html");

// Thank you page after a purchase has been completed
define("thanks_comm_url", "thanks.html");

// Welcome email message
define("msg_welcome_template", "msg_welcome.txt");

// Email validation message
define("msg_mailvalidation_template", "msg_validate.txt");

// Password reminder email message
define("msg_password_reminder", "msg_password.txt");

////////////////////////////////
// Template configuration finishes   //
////////////////////////////////

// Welcome email subject
define("msg_welcome_subject", "Your new TigerTom Affiliate account");

// Email validation message subject
define("msg_mailvalidation_subject", "TigerTom Affiliate account validation");

// The payment amount threshold, this is set in cents
define("amount_paid", 10000);

// Commission to the referer, this is set in cents
define("upline_comm", 100);

// Money unit used to show the amounts in the admin section
define("money_unit", "$");

// Type of email check to perform for validation
// possible values are: simle|advanced
// simple performs only a string validation
// advanced performs a mx domain lookup of the email address
define("check_email_type", "simple");

// Empty name error message
define("empty_name_msg", "Type your name");

// Empty address error message
define("empty_address_msg", "Type your postal address");

// Empty zip code error message
define("empty_zipcode_msg", "Zip or Post code missing");

// Empty city error message
define("empty_city_msg", "City missing");

// Empty state error message
define("empty_state_msg", "Select your state");

// Empty country error message
define("empty_country_msg", "Country missing");

// Empty telephone number error message
define("empty_tel_msg", "Telephone number missing");

// Invalid email address error message
define("empty_email_msg", "Invalid email address");

// Empty site url error message
define("empty_siteurl_msg", "Web page missing");

// Empty nickname error message
define("empty_nickname_msg", "Type an affiliate ID name");

// Empty password error message
define("empty_pass_msg", "Type a affiliate password");

// Empty password confirmation field error message
define("empty_pass2_msg", "Confirm your affiliate password");

// Password confirmation error message
define("pass2_diff_pass", "Password error: you typed in two different passwords");

// Wrong username or password error message
define("user_pass_wrong", "Login data incorrect. Please try again.");

// User non existant error message
define("not_user_msg", "The id you entered is not in our records. Check them and try again.");

// User not pending for validation message
define("not_pending_msg", "The affiliate id is not pending for validation");

// affiliate already taken error message
define("affiliate_already_inuse", "The affiliate ID you typed is already in use. Pick another one.");

// Not enough money earned error message
define("not_enough_earned", "This affiliate has not earned the amount of money required for payment.");

// Zero affiliates with enough money to get paied error message
define("no_affiliates_topay", "No affiliates are awaiting payment.");

// Main cookie name
define("cookie_name_main", "tigerpal");

// Name of the refer cookie
define("cookie_name_refer", "tiger_refer");

// Name of the admin cookie
define("cookie_name_admin", "tiger_admin");

// How many days in which the cookie should expire
define("cookie_daysto_expire", "365");

// Domain of the cookie
define("cookie_domain", "");

// Path of the cookie
define("cookie_path", "/");

// Is the cookie secure? 1 for true", 0 for false
define("cookie_secure", 0);

// STOP editing HERE!

/*
TigerTom's Affiliate Program Software (TTAPS)
http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
 
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/
?>