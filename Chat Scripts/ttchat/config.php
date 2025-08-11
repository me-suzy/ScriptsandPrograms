<? 

/**********************************
*   START OF NUMBER VARIABLES SECTION   *
***********************************/

// A smart webmaster would set values here to ensure the server load is as light as possible,
// while still leaving the chat usable i.e. the more you increase the refresh rate, and 
// decrease the chatter numbers, the less likely your web host will boot YOU.

// Set here the meta refresh rate in seconds, use only numbers, no quotes.
define("meta_refresh_rate", 10);

// Max. lines that the chat text file can have, use only numbers, no quotes.
define("max_chat_lines", 20);

// Max. length of characters allowed per line of chat, use only numbers, no quotes.
define("max_chars_len", 250);

// Min. length of user name, use only numbers, no quotes.
define("min_user_len", 3);

// Max. length of user name, use only numbers, no quotes.
define("max_user_len", 12);

// Max. number of members allowed in the chatroom.
define("max_user_count", 10);

// Banned user cookie length in seconds, use only numbers, no quotes.
define("banned_cookie_len", 300);

// Timer to refresh the users list.
//If you want it to automatically update when a user enters or leaves the chat then set it to 0.
define("users_refresh_rate", 30);

// Max. time the user can be in the room, without chatting, before they're deleted from the chatter listing.
// ***** ATTENTION!!! THIS IS SET IN SECONDS *****
define("user_delete_time", 180);

// Width in pixels of the chat window
define("chat_window_width", 750);

// Height in pixels of the chat window
define("chat_window_height", 550);

/********************************
*  END OF NUMBER VARIABLES SECTION   *
*********************************/



/*********************************
*  START OF STRING VARIABLES SECTION   *
**********************************/

// Name of the chat. It will show in the title of the pages.
define("chat_name", "TigerTom Chat Room");

// Name of the database folder. Remember: this needs write permissions.
// You _may_ need to CHMOD the folder 777 and its text files to 666.
define("chat_db_folder", "dbs");

// Name of the chat text file. Remember: the folder where this file resides needs write permissions.
define("chat_text_file", "msgs.txt");

// Name of the members text file. Remember: the folder where this file resides needs write permissions.
define("users_text_file", "users.txt");

// Banned user message. You can use html in here like <b>, <i>, <font>, etc.
// This will show at the right of the username.
// Remember: you have to use the backslash before a quote in the message.
define("banned_user_msg", " has been banned for <font color=\"#FF0000\">bad input</font>");

// User enters the chat message. YOU CAN´T USE ANY HTML IN HERE, JUST PLAIN TEXT.
// This will show at the right of the username when a new user enters the chat.
define("user_in_msg", "has entered the chat");

// User leaves the chat message. YOU CAN´T USE ANY HTML IN HERE, JUST PLAIN TEXT.
// This will show at the right of the username when a user leaves the chat.
define("user_out_msg", "has left the room");

// Message used when a user has been inactive. YOU CAN´T USE ANY HTML IN HERE, JUST PLAIN TEXT.
// This will show at the right of the username.
define("user_cleared_msg", "has been disconnected because of inactivity");

// Error message to display if the username is too short.
// Leave the min_user_len constant in there to let the user the amount of minimun characters the username must be.
define("username_tooshort_msg", "<b>The username chosen is too short, it must be at least <font color=\"#FF0000\">".min_user_len."</font> characters long</b>");

// Error message to display if the username is too long.
// Leave the define max_user_len variable in there to let the user the amount of minimun characters the username must be.
define("username_toolong_msg", "<b>The username chosen is too long, it must be less than <font color=\"#FF0000\">".max_user_len."</font> characters long</b>");

// Error message to display if the user didn´t enter any username.
define("username_notset_msg", "<b>You must enter a username to get access to the chatroom!</b>");

// Error message to display if the username chosen is already taken.
define("username_taken_msg", "<b>The username chosen is already taken. Please choose a new one and try again.</b>");

// Error message to display if there is too many users in the chatroom.
define("toomany_users_msg", "<b>Too many users in the chatroom already. Please try again later.</b>");

/*******************************
*  END OF STRING VARIABLES SECTION   *
********************************/


/********************************
*  START OF ARRAY VARIABLES SECTION   *
*********************************/

// List of reserved names, add as many as you want. This is a multidimensional array so the value before => is the admin username and the value after the => is the admin password for that username
$admin_list = array("tigertom" => "mystic", "lpin" => "lemmein", "Tazer" => "polic3");

// List of bad words to filter, add as many as you want. Remember: that in an array the values must be between quotes and separated by a colon.
$bad_words = array("fuck", "shit", "suck", "bitch", "cunt");

// List of colors to show in the chat form where the user can pick the color of his message line.
$font_colors = array("aqua", "black", "blue", "fuchsia", "gray", "green", "lime", "maroon", "navy", "olive", "orange", "purple", "red", "silver", "teal", "white", "yellow");

// List of fonts that the user can pick to format his message.
$font_families = array("Arial", "Courier New", "Georgia", "Impact", "Lucida Console", "Tahoma", "Times New Roman", "Verdana");

/*******************************
*   END OF ARRAY VARIABLES SECTION   *
********************************/
 ?>