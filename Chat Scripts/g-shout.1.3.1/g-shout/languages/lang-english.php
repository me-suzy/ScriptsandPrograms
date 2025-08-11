<?
//
// English Language File for G-Shout version 1.3.1
//
// Made by donie <donie@gravitasi.com>
// last updated : February 4, 2005

define("_CHARSET","ISO-8859-1");
define("_YES","Yes");
define("_NO","No");
define("_PAGE","Page");
define("_UNWRITEABLE","The required files are not exist or some files that don't have permission to be written (not writeable). Please read the README file.");

// days
define("_SUNDAY","Sunday");
define("_MONDAY","Monday");
define("_TUESDAY","Tuesday");;
define("_WEDNESDAY","Wednesday");
define("_THURSDAY","Thursday");
define("_FRIDAY","Friday");;
define("_SATURDAY","Saturday");

// months
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","March");;
define("_APRIL","April");
define("_MAY","May");
define("_JUNE","June");;
define("_JULY","July");
define("_AUGUST","August");
define("_SEPTEMBER","September");
define("_OCTOBER","October");
define("_NOVEMBER","November");
define("_DECEMBER","December");

// front page side
define("_PLEASE_WAIT","Please wait for ".$floodwait." minutes and resend you message.");
define("_CLOSE_WINDOW","Close this window");
define("_REPLIED_ON","Replied on");
define("_SHOUTED_ON","Shouted on");
define("_PROCESS_DELETED","Shout successfully deleted");

//prevent users submit these values
define("_DEFAULT_NAME","Name");
define("_DEFAULT_URI","Web/Email");
define("_DEFAULT_MESSAGE","Tell me something");

// admin panel side
define("_CONTROL_PANEL","Control Panel");
define("_EDIT_SHOUT_ENTRIES","Edit Shout Entries");
define("_MY_WEBSITE","My Website");
define("_CURRENT_TIME","Current Time");
define("_MANUAL","Manual");
define("_LOGIN","Login");
define("_ADMIN_LOGIN","Admin Login");
define("_FORGOT_PASSWORD","Forgot Password");
define("_LOGOUT","Log-out");
define("_ID","ID");
define("_EDIT","Edit");
define("_DELETE","Delete");
define("_CONFIGURATION","Configuration");
define("_EDIT_CONFIGURATION","Edit Configuration");
define("_EDIT_SHOUT","Edit Shout");
define("_EDIT_SHOUTS","Edit Shouts");
define("_DATE","Date");
define("_REPLYDATE","Reply Date");
define("_REPLY","Reply");
define("_ADMINISTRATION","Administration");
define("_DISPLAYING","Displaying");
define("_RESULTS","results");
define("_SHOUTS","Shouts");
define("_MESSAGE","Message");
define("_NAME","Name");
define("_SEX","Sex");
define("_M","M");
define("_F","F");
define("_IP_ADDRESS","IP Address");
define("_WEB_EMAIL","Web / Email");
define("_PASSWORD","Password");
define("_FORGOT_PASSWORD","Forgot your password?");
define("_SUBMIT_EMAIL","Submit your email address");
define("_RETURN_TO_LOGIN","Return to Login");
define("_RETURN_TO_FORGOT","Return to Forgot Password");
define("_OR","Or");
define("_ANSWER_THIS","Answer this question");
define("_DISPLAYING_PAGE","Displaying page");
define("_OF","of");
define("_TOTAL","Total");
define("_FROM_MAXIMAL","from maximal");
define("_LAST_SHOUTS","last shouts");
define("_MALE","male");
define("_FEMALE","female");
define("_SHOUTS_PER_PAGE","Shouts per page");
define("_UPDATE","update");
define("_PAGE_GENERATED_IN","Page was generated in");
define("_SECONDS","seconds");
define("_ARE_YOU_SURE","Are you sure want to delete this?\\n  \'OK\' to delete, \'Cancel\' to stop.");

//LOGS
define("_VIEW_LOGS","View Logs");
define("_ACTION","Action");
define("_LOG_UNWRITABLE","<br />".$logpath." is not exist or not writeable, please change its permission to be writeable.<br />From SSH you can type: chmod ugo+w logs.php<br />or<br />chmod 0666 logs.php (this sets writeable and readable to all -rw-rw-rw-)<br /><br />or you can do that from some FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), please read their documents.");
define("_LAST_LOGS","last logs");
// inside .log file
define("_LOG_LOGIN_SUCCESS","Successfully Logged In");
define("_LOG_LOGIN_FAIL","Login Failed");
define("_LOG_LOGOUT","Logged Out");
define("_LOG_CHANGE_PASS","Password Changed");
define("_LOG_RIGHT_SECRET_ANSWER","RIGHT Secret Answer");
define("_LOG_WRONG_SECRET_ANSWER","WRONG Secret Answer");
define("_LOG_LOGIN_EXPIRED","Login Expired");

//MESSAGES
define("_EMAIL_SUBJECT","[G-Shout] You have a comment from ".$name." on your G-Shout Box!");
define("_CONF_UPDATED","Configuration updated");
define("_PASSWORDS_UNMATCH","The password and password confirmation do not match");
define("_MUST_ENTER_CURRENT_PASSWORD","You must enter your current password to update this page");
define("_INCORRECT_CURRENT_PASSWORD","You must enter correct current password to update this page");
define("_SHOUT_DELETED","The shout is sucessfully deleted");
define("_SHOUTS_DELETED","The shouts are sucessfully deleted");
define("_PROCESS_DELETEFAILED","Deletion Process Failed");
define("_SHOUT_UPDATED","Shout Updated");
define("_ERROR_EMPTY","There is empty field");
define("_ERROR_NAME","Enter a name / nickname");
define("_ERROR_SEX","Are you a shemale? Select your gender");
define("_ERROR_URI","Enter a valid Web / Email address");
define("_ERROR_MESSAGE","Come on, tell me someshit!");
define("_ERROR_WRITE_DATA","Can't write to $datafile file, please change its permission to be writeable");
define("_ERROR_WRITE_CONF","Can't write to config.php file, please change its permission to be writeable");
define("_ERROR_WRITE_LOG","Tak dapat menulis ke dalam file $logfile, please change its permission to be writeable");
define("_DATA_UNWRITABLE","<br />$datafile is not exist or  not writeable, please change its permission to be writeable.<br />From SSH you can type: chmod ugo+w $datafile<br />or<br />chmod 0666 $datafile (this sets writeable and readable to all -rw-rw-rw-)<br /><br />or you can do that from some FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), please read their documents.");
define("_CONF_UNWRITABLE","<br />config.php is not exist not writeable, please change its permission to be writeable.<br />From SSH you can type: chmod ugo+w config.php<br />or<br />chmod 0666 config.php (this sets writeable and readable to all -rw-rw-rw-)<br /><br />or you can do that from some FTP clients (CuteFTP, LeapFTP, SmartFTP, WS_FTP), please read their documents.");
define("_YOUR_PASSWORD_IS","Your password is");
define("_YOUR_PASSWORD","Your Password");
define("_RELOGIN","Login expired, please re-Login");
define("_WRONG_PASS","Wrong password, try again");


//CONFIGURATION
define("_PREFERENCE","Preference");
define("_VALUE","Value");
define("_NICKNAME","Displayed and Protected Nickname");
define("_NICKNAME_SUBTEXT","Your nickname when you reply a shout and visitors can't use it.");
define("_WEBSITE","Website URL");
define("_WEBSITE_SUBTEXT","Enter your own website URL");
define("_SKINS","Skins");
define("_SKINS_SUBTEXT","Select skin for Control Panel");
define("_LANGUAGES","Languages");
define("_LANGUAGES_SUBTEXT","Select your language");
define("_AMOUNT_OF_SHOUTS","Amout of Shouts");
define("_AMOUNT_OF_SHOUTS_SUBTEXT","The amount of comments shown in front page");
define("_ALLOWED_TAGS","Allowed HTML Tags");
define("_ALLOWED_TAGS_SUBTEXT","HTML Tags which be allowed for comments. Empty it if you dont allow any html tags inside message.");
define("_MAXCHARS","Maximum Characters");
define("_MAXCHARS_SUBTEXT","Maximum characters for each comment. Empty it if you don't want to limit it");
define("_KEEP","Keep the last ... shouts");
define("_KEEP_SUBTEXT","Keep the last ... entries. Shouts before these entries, will be auto-deleted. Set to \"all\" if you want to keep all shouts");
define("_KEEP_LOGS","Keep the last ... logs");
define("_KEEP_LOGS_SUBTEXT","All logs before these last logs, will be auto-deleted. Set to \"all\", if you want to keep all logs.");
define("_AUTOLOGOUT","Auto Log-Out on idle (minute)");
define("_AUTOLOGOUT_SUBTEXT","if idle (no activity) within these minutes, will be automatically logged out. Empty it to disable it.");
define("_DELETE_TIME","Delete Time (minute)");
define("_DELETE_TIME_SUBTEXT","How long time user can delete their own post? (in minute). Set to 0 (zero) to disable it.");
define("_FLOOD_PROT","Flood Protection (minute)");
define("_FLOOD_PROT_SUBTEXT","User can post the next shout in ... minutes. Set to 0 (zero) to disable it.");
define("_TEXT_WRAPPING_WIDTH","Text Wrapping Width");
define("_TEXT_WRAPPING_WIDTH_SUBTEXT","The width of the text wrapping. The value is relative to the font width. The width of 'A' is not the same as 'i'. Try checking it by using multiple A's (AAAAAAAAA and on) until it fits your frame. Set it to 0 to disable.");
define("_WRAPPING_SEPARATOR","Wrapping Separator");
define("_WRAPPING_SEPARATOR_SUBTEXT","The character used to seperate wrapped words. '- ' means will be seperated like this: abcde- fghi. Empty ('') means disabling wordwrapping. use ' ' (space) for textwrapping without separator..");
define("_URI_REQUIRED","Web/Email Required?");
define("_URI_REQUIRED_SUBTEXT","Are visitors required to fill Web/Email field?");
define("_USE_HTML_ENCODE","Use HTML Encode");
define("_USE_HTML_ENCODE_SUBTEXT","This will change any url or emails INSIDE the COMMENT to url. Example: 'www.yourdomain.com' will be changed to <a href=\"http://www.yourdomain.com\" target=\"_blank\" title=\"http://www.yourdomain.com\">".$urltextreplacement."</a> and 'email@yourdomain.com' will be changed to <a href=\"mailto:email@yourdomain.com\" target=\"_blank\" title=\"email@yourdomain.com\">[MAIL]</a>.");
define("_SEND_TO_EMAIL","Send comments to Email?");
define("_SEND_TO_EMAIL_SUBTEXT","If you want to receive every comments written to shoutbox via email, set this option to YES.");
define("_EMAIL_ADDRESS","Email Address");
define("_EMAIL_ADDRESS_SUBTEXT","Your Email Address which used to receive shout messages.");
define("_DATE_FORMAT","Date Format");
define("_DATE_FORMAT_SUBTEXT","The syntax used is identical to the <a href=\"http://www.php.net/date\" target=\"_blank\">PHP date() function</a>. Save option to update Output");
define("_OUTPUT","Output");
define("_TIMEZONE","Time Zone");
define("_GMT_IS","<acronym title='Greenwich Mean Time'>GMT</acronym> is");
define("_SECRET_QUESTION","Secret Question");
define("_SECRET_QUESTION_SUBTEXT","Secret question to view your password if you have forgot it.");
define("_SECRET_ANSWER","Secret Answer");
define("_SECRET_ANSWER_SUBTEXT","Secret answer to view your password if you have forgot it.");
define("_PASS_CHANGE_FORM","Password Change Form");
define("_LEAVE_BLANK","Leave blank if you do not wish to change it");
define("_NEW_PASS","New Password");
define("_NEW_PASS_CONFIRM","New Password Confirm");
define("_HAVE_LOG_BACK_IN","Note:  If you change your password you will have to log back in");
define("_EXISTING_PASS","Your Existing Password");
define("_SUBMIT_CURRENT_PASS","You must submit your current password to update this page");



// I have not done to do all language system

?>