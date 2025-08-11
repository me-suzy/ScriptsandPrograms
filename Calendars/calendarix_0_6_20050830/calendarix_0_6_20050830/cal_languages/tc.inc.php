<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "Ãö©óCalendarix¦æ¨Æ¾ä"; break ;		
	case "Add": $new = "·s¼W"; break ;
	case "Add Category": $new = "·s¼W¶µ¥Ø"; break;
	case "Add Event": $new = "·s¼W¨Æ¥ó"; break;
	case "Add event": $new = "·s¼W¨Æ¥ó" ; break;
	case "Add new user": $new = "·s¼W¥Î¤á"; break;
	case "Adding category": $new = "·s¼W¶µ¥Ø¤¤"; break;
	case "Adding event": $new = "·s¼W¨Æ¥ó¤¤" ; break ;
	case "Adding user": $new = "·s¼W¥Î¤á¤¤"; break ;
	case "Address": $new = "¦a§}"; break ;			// master translate?
	case "Administration": $new = "ºÞ²z"; break;
	case "Administrator": $new = "ºÞ²z­û"; break ;
	case "All categories": $new = "©Ò¦³¶µ¥Ø"; break ;		
	case "Approval needed for posting of events.": $new = "¼f®Ö·s¼W¨Æ¥ó¡C"; break;  
	case "Approvals": $new = "¼f®Ö"; break ;
	case "Approve": $new = "¼f®Ö"; break;
	case "Approving event": $new = "¼f®Ö¨Æ¥ó¤¤"; break;
	
	case "Back": $new = "ªð¦^"; break;
	case "Both passwords entered do not match": $new = "¿é¤J¨â¦¸±K½X¿ù»~"; break;	

	case "Calendar": $new = "¦æ¨Æ¾ä"; break;
	case "Cancel": $new = "¨ú®ø"; break ;
	case "Cannot delete current login user": $new = "µLªk§R°£²{¦bµn¤Jªº¥Î¤á"; break ;   
	case "Cannot change current login user": $new = "µLªk­×§ï²{¦bµn¤Jªº¥Î¤á"; break;	
	case "Cannot have a category with blank name": $new = "¶µ¥Ø¦WºÙ¤£¯àªÅ¥Õ"; break ;
	case "Categories": $new = "¶µ¥Ø"; break;
	case "Category": $new = "¶µ¥Ø"; break;
	case "Change": $new = "­×§ï"; break ;
	case "Change password": $new = "­×§ï±K½X"; break; 		// master translate?
	case "Change password/group": $new = "­×§ï±K½X/²Õ"; break; 	// master obsolete?	
	case "Choose Category": $new = "¿ï¾Ü¶µ¥Ø"; break;
	case "Close": $new = "Ãö³¬"; break;
	case "Confirm delete?": $new = "½T©w­n§R°£¡H" ; break ;			
	case "Confirm delete all historical events before": $new = "½T©w­n§R°£¥H«e©Ò¦³ªº¨Æ¥ó¡H"; break ;
	case "confirmed events for today": $new = "½T»{¤µ¤Ñªº¨Æ¥ó"; break ;
	case "Confirm password": $new = "½T»{±K½X"; break; 		
	case "Copy Event": $new = "½Æ»s¨Æ¥ó"; break ;				
	case "Current Week": $new = "¥»¶g"; break;
	case "Current Month": $new = "¥»¤ë"; break;
	case "Current Year": $new = "¤µ¦~"; break;		

	case "Date": $new = "¤é´Á"; break;
	case "Day": $new = "¤é"; break;
	case "Delete all historical events listed": $new = "§R°£¦C¥Xªº¥H«e©Ò¦³¨Æ¥ó"; break;
	case "Delete category": $new = "§R°£¶µ¥Ø"; break;
	case "Delete event": $new = "§R°£¨Æ¥ó"; break;
	case "Delete user": $new = "§R°£¥Î¤á"; break;
	case "Deleting category": $new = "§R°£¶µ¥Ø¤¤"; break;
	case "Deleting event": $new = "§R°£¨Æ¥ó¤¤"; break ;
	case "Deleting user": $new = "§R°£¥Î¤á¤¤"; break ;
	case "disabled": $new = "¦¹¥\¯àµL®Ä"; break;

	case "Edit category": $new = "½s¿è¶µ¥Ø"; break;
	case "Edit event": $new = "½s¿è¨Æ¥ó"; break;
	case "Edit information": $new = "½s¿è¸ê°T"; break;	// master translate?
	case "Email": $new = "¹q¤l¶l¥ó"; break;
	case "End Time": $new = "µ²§ô®É¶¡"; break ;
	case "Event": $new = "¨Æ¥ó"; break ;
	case "Event Category": $new = "¨Æ¥ó¶µ¥Ø"; break;
	case "Event Description": $new = "¨Æ¥ó´y­z"; break;
	case "Event repeated": $new = "­«½Æ¨Æ¥ó"; break;  
	case "Event Title": $new = "¨Æ¥ó¼ÐÃD"; break;
	case "events": $new = "¨Æ¥ó"; break;
	case "Events added will be posted immediately.": $new = "·s¼W¨Æ¥ó¥ß¨è¥Í®Ä¡C"; break ;
	case "events awaiting approval": $new = "«Ý¼f®Ö¨Æ¥ó"; break ;
	case "Events before": $new = "¥H«eªº¨Æ¥ó"; break ;
	case "events for": $new = "¨Æ¥ó¨Ì¾Ú"; break;
	case "Events for day": $new = "¨C¤é¨Æ¥ó"; break;
	case "events for whole calendar": $new = "©Ò¦³¦æ¨Æ¾ä¨Æ¥ó"; break;
	case "events for year": $new = "¥þ¦~¨Æ¥ó"; break;
	case "Events from ": $new = "¨Æ¥ó¨Ó¦Û"; break;
	case "Events in category": $new = "¶µ¥Ø¤¤ªº¨Æ¥ó"; break;

	case "From": $new = "±q"; break ;
	case "Functions": $new = "¥\¯à"; break ;	// master translate?

	case "Go to": $new = "Go to"; break;
	case "Go to day": $new = "Go to day"; break;
	case "Go to week": $new = "Go to week"; break;

	case "Historical Items": $new = "¾ú¥v¬ö¿ý"; break;

	case "Login": $new = "µn¤J"; break;
	case "Login session time out in seconds": $new = "µn¤J®É¶W¹L®É¶¡"; break;
	case "Login session timeout": $new = "µn¤J¼È°±"; break ;
	case "Logout": $new = "µn¥X"; break;

	case "Menu": $new = "¦Cªí"; break;
	case "Month": $new = "¤ë"; break;
	case "More info": $new = "§ó¦h¸ê°T"; break;

	case "Name": $new = "©m¦W"; break;			// master translate?
	case "Next": $new = "¤U¤@­Ó"; break;				
	case "Next day": $new = "©ú¤Ñ"; break;
	case "Next week": $new = "¤U¬P´Á"; break;
	case "No categories yet": $new = "ÁÙ¨S¦³¶µ¥Ø"; break;
	case "No events": $new = "¨S¦³¨Æ¥ó"; break;
	case "No Repeat": $new = "¤£­«½Æ"; break;
	case "No results": $new = "¨S¦³µ²ªG"; break;
	case "No, go back!": $new = "¨S¦³¡A½Ð¦^¡I"; break;
	case "No.": $new = "¤£¡C"; break;			// master translate?
	case "noadminapprove": $new = "ºÞ²z­û·s¼Wªº¨Æ¥ó¤£»Ý­nºÞ²z­û¼f®Ö"; break ;
	case "noapprove": $new = "¥Î¤á·s¼Wªº¨Æ¥ó¤£»Ý­nºÞ²z­û¼f®Ö"; break ;
	case "nocat": $new = "§A¥²¶·¿ï¾Ü¤@­Ó¶µ¥Ø¡I"; break;
	case "noday": $new = "§A¥²¶·¿ï¾Ü¤@­Ó¤é´Á¡I"; break;
	case "nodescription": $new = "§A¥²¶·´y­z¨Æ¥ó¡I"; break;
	case "nomonth": $new = "§A¥²¶·¿ï¾Ü¤@­Ó¤ë¥÷¡I"; break;
	case "nonapproved": $new = "¨Æ¥ó»Ý­n¼f®Ö : "; break;
	case "nononapproved": $new = "¥Ø«e¨S¦³¨Æ¥ó»Ý­n¼f®Ö"; break;
	case "notitle": $new = "§A¥²¶·¼Ð©ú¨Æ¥óªº¥DÃD¡I"; break;
	case "noyear": $new = "§A¥²¶·¿ï¾Ü¦~¥÷¡I"; break;

	case "on": $new = "¦b"; break;
	case "Optional": $new = "¿ï¶ñ"; break;
	case "or month": $new = "©ÎªÌ¤ë"; break;
	case "or week": $new = "©ÎªÌ¬P´Á"; break;

	case "password": $new = "±K½X"; break;
	case "Please choose the category you only want to view events for": $new = "½Ð¿ï¾Ü§A·Q¬d¬Ýªº¶µ¥Ø"; break;  
	case "Popup Month": $new = "¥t¶}¤ë¾äµøµ¡"; break ;
	case "Previous": $new = "«e¤@­Ó"; break;			
	case "Previous day": $new = "«e¤@¤Ñ"; break;
	case "Previous week": $new = "¤W¬P´Á"; break;

	case "Read more": $new = "¸Ô²Ó¾\Åª"; break;
	case "reallydelcat": $new = "§A½T©w­n²¾°£³o­Ó¶µ¥Ø¡H³o­Ó¶µ¥Øªº©Ò¦³¨Æ¥ó±N³Q§R°£¡I"; break;
	case "Repeat": $new = "­«½Æ"; break;
	case "results": $new = "µ²ªG"; break;
	case "Role": $new = "¨¤¦â"; break;			// master translate?

	case "search": $new = "·j´M"; break;
	case "Sort by": $new = "¨Ì¶¶§Ç"; break ;
	case "Sort by date": $new = "¨Ì¤é´Á±Æ¦C "; break ;
	case "Sort by events": $new = "¨Ì¨Æ¥ó±Æ¦C"; break ;
	case "Start Time": $new = "¶}©l®É¶¡"; break ;

	case "thankyou": $new = "·PÁÂ±z·s¼W¨Æ¥ó¡A±N¦b¼f®Ö«á¥Í®Ä¡C"; break;
	case "thankyoupost": $new = "·PÁÂ±z·s¼W¨Æ¥ó¡A¤w¸g·s¼W¥Í®Ä¡C"; break;
	case "till": $new = "ª½¨ì"; break;
	case "Time added or updated": $new = "·s¼W©Î§ó§ï®É¶¡"; break ;
	case "timeout msg": $new = "§ó§ï¤w¶W¹L®É¶¡±N©ó¤U¦¸µn¤J®É¥Í®Ä" ; break ;
	case "times every": $new = "¨C¦¸"; break;	
	case "To": $new = "¨ì"; break ;
	case "To delete category": $new = "§R°£¶µ¥Ø"; break ;
	case "Today": $new = "¤µ¤Ñ"; break;
	case "Total": $new = "Á`­p"; break;
	case "Total number of events for the month": $new = "Á`­p¥»¤ë¨Æ¥ó"; break ;
	case "Total number of events for user": $new = "Á`­p¥Î¤á¨Æ¥ó"; break ;		
	case "Total unapproved events for the month": $new = "Á`­p¥»¤ë¥¼¼f®Ö¨Æ¥ó" ; break;
	case "Two weeks": $new = "¨â­Ó¬P´Á" ; break;	

	case "Update": $new = "§ó·s"; break;
	case "Update Event": $new = "§ó·s¨Æ¥ó"; break;
	case "Updating category": $new = "§ó·s¶µ¥Ø¤¤"; break ;
	case "Updating event": $new = "§ó·s¨Æ¥ó¤¤"; break;
	case "Updating user": $new = "§ó·s¥Î¤á¤¤"; break;			
	case "Unapproved events": $new = "¥¼¼f®Ö¨Æ¥ó"; break ;
	case "User": $new = "¥Î¤á"; break ;
	case "User Calendar": $new = "¥Î¤á¦æ¨Æ¾ä"; break ;
	case "User description": $new = "¥Î¤á´y­z"; break ;		
	case "User group": $new = "¥Î¤á¸s²Õ"; break ;				
	case "User Management": $new = "¥Î¤áºÞ²z"; break;
	case "userdelok": $new = "§A½T©w­n§R°£³o­Ó¥Î¤á¡H"; break;
	case "username": $new = "¥Î¤á¦WºÙ"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "¥Î¤á¦WºÙ©M±K½X¥²¶·¬O­^¤å¦r¥À©Î¼Æ¦r¦Ó¥B¤£¯àªÅ¥Õ¡C"; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "¥Î¤á¦WºÙ¤w¦s¦b¡A½Ð¨Ï¥Î¥t¤@­Ó¦WºÙ¡C"; break;
	case "users": $new = "¥Î¤á"; break;

	case "View": $new = "¬d¬Ý"; break;
	case "View categories in year": $new = "¥H¦~¬d¬Ý¶µ¥Ø"; break ;
	case "View details or edit": $new = "¬d¬Ý²Ó¸`©Î½s¿è"; break ;
	case "View event": $new = "¬d¬Ý¨Æ¥ó"; break;
	case "View events of user": $new = "¬d¬Ý¥Î¤á¨Æ¥ó"; break;
	case "View events under this category in year": $new = "¥H¦~¬d¬Ý³o­Ó¶µ¥Øªº¨Æ¥ó"; break ;
	case "View historical events before": $new = "¬d¬Ý¥H«eªº¨Æ¥ó"; break ;
	case "View month": $new = "¤ë¬d¬Ý"; break;
	case "View week": $new = "¶g¬d¬Ý"; break;

	case "Web Calendar Admin Login": $new = "¦æ¨Æ¾äºÞ²zµn¤J"; break ;
	case "Web Calendar User Login": $new = "¦æ¨Æ¾ä¥Î¤áµn¤J"; break ;
	case "week number": $new = "¶g¼Æ¥Ø"; break;
	case "Week starts": $new = "¶g¶}©l"; break;
	case "wronglogin": $new = "¥Î¤á¦WºÙ¤Î±K½X¿ù»~"; break;

	case "Year": $new = "¦~"; break;
	case "Yes": $new = "¬O"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "¬O¡A§R°£¨Æ¥ó¡I"; break;
	case "Yes, delete it!": $new = "¬O¡A§R°£¥¦¡I"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>