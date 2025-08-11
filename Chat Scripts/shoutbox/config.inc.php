<?
//========================================================================================================
// Database settings
//========================================================================================================

  $db_server = "localhost";      // server name
  $db_user = "root";             // user name
  $db_pass = "";                 // user password
  $db_name = "";                 // database name

  // don't change unless you know what you're doing:
  $tbl_name = "Shoutbox";        // table name
  $fld_id = "ID";                // field name: ID
  $fld_timestamp = "Timestamp";  // field name: timestamp
  $fld_name = "Name";            // field name: name
  $fld_email = "EMail";          // field name: e-mail
  $fld_text = "Text";            // field name: text

//========================================================================================================
// Other settings
//========================================================================================================

  $language = "en";              // shout-box language: de, en, fr
  $boxFolder = "";               // shout-box folder (web-path)
  $boxWidth = 150;               // shout-box width (pixels)
  $boxHeight = 400;              // shout-box height (pixels)
  $boxEntries = 20;              // maximum entries in shout-box (higher values = more traffic!)
  $boxRefresh = 10;              // refresh shout-box every .. seconds (lower values = more traffic!)
  $messageOrder = "DESC";        // message order: ASC (new at bottom) or DESC (new on top)
  $allowHTML = false;            // allow HTML-code in message (true = yes, false = no)

//========================================================================================================
?>
