<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "¹ØÓÚCalendarix About Calendarix"; break ;		
	case "Add": $new = "Ìí¼Ó Add"; break ;
	case "Add Category": $new = "Ìí¼ÓÀà±ð Add Category"; break;
	case "Add Event": $new = "Ìí¼Ó»î¶¯ Add Event"; break;
	case "Add event": $new = "Ìí¼Ó»î¶¯ Add event" ; break;
	case "Add new user": $new = "Ìí¼ÓÐÂÓÃ»§ Add new user"; break;
	case "Adding category": $new = "ÕýÔÚÌí¼ÓÀà±ð Adding category"; break;
	case "Adding event": $new = "ÕýÔÚÌí¼Ó»î¶¯ Adding event" ; break ;
	case "Adding user": $new = "ÕýÔÚÌí¼ÓÓÃ»§ Adding user"; break ;
	case "Address": $new = "µØµã Address"; break ;			// master translate?
	case "Administration": $new = "¹ÜÀí Administration"; break;
	case "Administrator": $new = "¹ÜÀíÔ± Administrator"; break ;
	case "All categories": $new = "ËùÓÐÀà±ð All categories"; break ;		
	case "Approval needed for posting of events.": $new = "Ìí¼Ó»î¶¯ÐèÒªÉóºË¡£ Approval needed for posting of events."; break;  
	case "Approvals": $new = "ÉóºË Approvals"; break ;
	case "Approve": $new = "ÉóºË Approve"; break;
	case "Approving event": $new = "ÕýÔÚÉóºË»î¶¯ Approving event"; break;
	
	case "Back": $new = "ÍË»Ø Back"; break;
	case "Both passwords entered do not match": $new = "Á½´ÎÊäÈëµÄÃÜÂë²»Æ¥Åä Both passwords entered do not match"; break;	

	case "Calendar": $new = "ÈÕ³Ì±í Calendar"; break;
	case "Cancel": $new = "È¡Ïû Cancel"; break ;
	case "Cannot delete current login user": $new = "ÎÞ·¨É¾³ýµ±Ç°ÒÑµÇÈëÓÃ»§ Cannot delete current login user"; break ;   
	case "Cannot change current login user": $new = "ÎÞ·¨ÐÞ¸Äµ±Ç°ÒÑµÇÈëÓÃ»§ Cannot change current login user"; break;	
	case "Cannot have a category with blank name": $new = "Àà±ðÃû²»ÄÜÎª¿Õ Cannot have a category with blank name"; break ;
	case "Categories": $new = "Àà±ð Categories"; break;
	case "Category": $new = "Àà±ð Category"; break;
	case "Change": $new = "ÐÞ¸Ä Change"; break ;
	case "Change password": $new = "ÐÞ¸ÄÃÜÂë Change password"; break; 		// master translate?
	case "Change password/group": $new = "ÐÞ¸ÄÃÜÂë/×é Change password/group"; break; 	// master obsolete?	
	case "Choose Category": $new = "Ñ¡ÔñÀà±ð Choose Category"; break;
	case "Close": $new = "¹Ø±Õ Close"; break;
	case "Confirm delete?": $new = "È·ÊµÒªÉ¾³ý£¿ Confirm delete?" ; break ;			
	case "Confirm delete all historical events before": $new = "È·¶¨½«ÒÔÇ°µÄ»î¶¯È«²¿É¾³ý Confirm delete all historical events before"; break ;
	case "confirmed events for today": $new = "½ñÌìµÄ»î¶¯ÒÑÖ¤Êµ confirmed events for today"; break ;
	case "Confirm password": $new = "È·ÈÏ¿ÚÁî Confirm password"; break; 		
	case "Copy Event": $new = "¸´ÖÆ»î¶¯ Copy Event"; break ;				
	case "Current Week": $new = "±¾ÖÜ Current Week"; break;
	case "Current Month": $new = "µ±ÔÂ Current Month"; break;
	case "Current Year": $new = "½ñÄê Current Year"; break;		

	case "Date": $new = "ÈÕÆÚ Date"; break;
	case "Day": $new = "ÈÕ Day"; break;
	case "Delete all historical events listed": $new = "½«ÏÂÁÐËùÓÐÒÔÍùµÄ»î¶¯É¾³ý Delete all historical events listed"; break;
	case "Delete category": $new = "É¾³ýÀà±ð Delete category"; break;
	case "Delete event": $new = "É¾³ý»î¶¯ Delete event"; break;
	case "Delete user": $new = "É¾³ýÓÃ»§ Delete user"; break;
	case "Deleting category": $new = "ÕýÔÚÉ¾³ýÀà±ð Deleting category"; break;
	case "Deleting event": $new = "ÕýÔÚÉ¾³ý»î¶¯ Deleting event"; break ;
	case "Deleting user": $new = "ÕýÔÚÉ¾³ýÓÃ»§ Deleting user"; break ;
	case "disabled": $new = "´Ë¹¦ÄÜ²»¿ÉÓÃ This section has been disabled"; break;

	case "Edit category": $new = "±à¼­Àà±ð Edit category"; break;
	case "Edit event": $new = "±à¼­»î¶¯ Edit event"; break;
	case "Edit information": $new = "±à¼­ÐÅÏ¢ Edit information"; break;	// master translate?
	case "Email": $new = "µçÓÊ Email"; break;
	case "End Time": $new = "½áÊøÊ±¼ä End Time"; break ;
	case "Event": $new = "»î¶¯ Event"; break ;
	case "Event Category": $new = "»î¶¯Àà±ð Event Category"; break;
	case "Event Description": $new = "»î¶¯ÃèÊö Event Description"; break;
	case "Event repeated": $new = "ÖØ¸´µÄ»î¶¯ Event repeated"; break;  
	case "Event Title": $new = "»î¶¯±êÌâ Event Title"; break;
	case "events": $new = "»î¶¯ events"; break;
	case "Events added will be posted immediately.": $new = "ÐÂ¼Ó»î¶¯½«Á¢¿ÌÉúÐ§¡£ Events added will be posted immediately."; break ;
	case "events awaiting approval": $new = "»î¶¯µÈ´ýÉóºËÖÐ events awaiting approval"; break ;
	case "Events before": $new = "ÒÔÇ°µÄ»î¶¯ Events before"; break ;
	case "events for": $new = "events for"; break;
	case "Events for day": $new = "Events for day"; break;
	case "events for whole calendar": $new = "events for whole calendar"; break;
	case "events for year": $new = "events for year"; break;
	case "Events from ": $new = "Events from "; break;
	case "Events in category": $new = "Events in category"; break;

	case "From": $new = "×Ô´Ó From"; break ;
	case "Functions": $new = "¹¦ÄÜ Functions"; break ;	// master translate?

	case "Go to": $new = "Go to"; break;
	case "Go to day": $new = "Go to day"; break;
	case "Go to week": $new = "Go to week"; break;

	case "Historical Items": $new = "ÀúÊ·¼ÇÂ¼ Historical Items"; break;

	case "Login": $new = "µÇÂ¼ Login"; break;
	case "Login session time out in seconds": $new = "µÇÂ¼²Ù×÷¼´½«³¬Ê± Login session time out in seconds"; break;
	case "Login session timeout": $new = "µÇÂ½²Ù×÷³¬Ê± Login session timeout"; break ;
	case "Logout": $new = "×¢ÏúLogout"; break;

	case "Menu": $new = "²Ëµ¥ Menu"; break;
	case "Month": $new = "ÔÂ Month"; break;
	case "More info": $new = "¸ü¶àÐÅÏ¢ More info"; break;

	case "Name": $new = "Ãû×Ö Name"; break;			// master translate?
	case "Next": $new = "ÏÂÒ»¸ö Next"; break;				
	case "Next day": $new = "Ã÷Ìì Next day"; break;
	case "Next week": $new = "ÏÂÐÇÆÚ Next week"; break;
	case "No categories yet": $new = "»¹Ã»ÓÐÀà±ð No categories yet"; break;
	case "No events": $new = "Ã»ÓÐ»î¶¯ No events"; break;
	case "No Repeat": $new = "²»ÖØ¸´ No Repeat"; break;
	case "No results": $new = "Ã»ÓÐ½á¹û No results"; break;
	case "No, go back!": $new = "Ã»ÓÐ£¬Çë»Ø£¡ No, go back!"; break;
	case "No.": $new = "²»¡£ No."; break;			// master translate?
	case "noadminapprove": $new = "¹ÜÀíÔ±Ìí¼ÓµÄ»î¶¯ÎÞÐëÓÉ¹ÜÀíÔ±ÉóºË Approval of events added by administrators not needed by administrator"; break ;
	case "noapprove": $new = "ÓÃ»§Ìí¼ÓµÄ»î¶¯ÎÞÐë¹ÜÀíÔ±ÉóºË Approval of events added by users not needed by administrator"; break ;
	case "nocat": $new = "Äã±ØÐëÖ¸¶¨Ä³¸öÀà±ð£¡ You must select a category !"; break;
	case "noday": $new = "Äã±ØÐëÖ¸¶¨Ä³ÈÕ£¡ You must select a day !"; break;
	case "nodescription": $new = "Äã±ØÐë¶Ô»î¶¯½øÐÐÃèÊö£¡ You must give an event description !"; break;
	case "nomonth": $new = "Äã±ØÐëÖ¸¶¨Ä³ÔÂ£¡ You must select a month !"; break;
	case "nonapproved": $new = "»î¶¯ÐèÒªÉóºË£º Events requiring approval : "; break;
	case "nononapproved": $new = "µ±Ç°Ã»ÓÐ»î¶¯ÐèÒªÉóºË There are no events needing approval at this time"; break;
	case "notitle": $new = "Äã±ØÐë±êÃ÷»î¶¯µÄÖ÷Ìâ£¡ You must give an event title !"; break;
	case "noyear": $new = "Äã±ØÐëÖ¸¶¨Ä³Äê£¡ You must select a year !"; break;

	case "on": $new = "ÔÚ on"; break;
	case "Optional": $new = "²Ù×÷ Optional"; break;
	case "or month": $new = "»òÕßÔÂ or month"; break;
	case "or week": $new = "»òÕßÐÇÆÚ or week"; break;

	case "password": $new = "ÃÜÂë password"; break;
	case "Please choose the category you only want to view events for": $new = "ÇëÑ¡ÔñÄãÏë²é¿´µÄ»î¶¯Àà±ð Please choose the category you only want to view events for"; break;  
	case "Popup Month": $new = "µ¯³öÔÂÀú Popup Month"; break ;
	case "Previous": $new = "Ç°Ò»¸ö Previous"; break;			
	case "Previous day": $new = "Ç°Ò»Ìì Previous day"; break;
	case "Previous week": $new = "ÏÂ¸öÐÇÆÚ Previous week"; break;

	case "Read more": $new = "ÏêÏ¸ÔÄ¶Á Read more"; break;
	case "reallydelcat": $new = "ÄúÈ·ÊµÒªÉ¾³ýÕâ¸öÀà±ð£¿´ËÀà±ðÏÂµÄËùÓÐ»î¶¯¶¼½«É¾³ý£¡ Are you sure to you want remove this category? All events associated with this category will be permanently deleted!"; break;
	case "Repeat": $new = "ÖØ¸´ Repeat"; break;
	case "results": $new = "½á¹û results"; break;
	case "Role": $new = "½ÇÉ« Role"; break;			// master translate?

	case "search": $new = "ËÑË÷ search"; break;
	case "Sort by": $new = "°´ÏÂÁÐË³ÐòSort by"; break ;
	case "Sort by date": $new = "°´ÈÕÆÚÅÅÁÐ Sort by date"; break ;
	case "Sort by events": $new = "°´»î¶¯ÃûÅÅÁÐ Sort by events"; break ;
	case "Start Time": $new = "¿ªÊ¼Ê±¼ä Start Time"; break ;

	case "thankyou": $new = "¸ÐÐ»ÄúÌí¼ÓÁË»î¶¯£¬Ëü½«ÔÚÉóºËºóÉúÐ§¡£ Thank you for entering an event, it will appear after approval."; break;
	case "thankyoupost": $new = "¸ÐÐ»ÄúÌí¼ÓÁË»î¶¯£¬ËüÒÑÉúÐ§¡£ Thank you for entering an event, it has been posted."; break;
	case "till": $new = "Ö±µ½ till"; break;
	case "Time added or updated": $new = "Ôö¼Ó»ò¸üÐÂÊ±¼ä Time added or updated"; break ;
	case "timeout msg": $new = "³¬Ê±µÄÐÞ¸Ä²Ù×÷½«ÔÚÏÂ´ÎµÇÂ¼Ê±ÉúÐ§ Changes in session timeout will only be effective on next login" ; break ;
	case "times every": $new = "Ã¿´Î times every"; break;	
	case "To": $new = "È¥ To"; break ;
	case "To delete category": $new = "É¾³ýÀà±ð To delete category"; break ;
	case "Today": $new = "½ñÌì Today"; break;
	case "Total": $new = "×Ü¹² Total"; break;
	case "Total number of events for the month": $new = "ÕâÔÂ»î¶¯µÄ×ÜÊý Total number of events for the month"; break ;
	case "Total number of events for user": $new = "´ËÓÃ»§µÄ»î¶¯×ÜÊý Total number of events for user"; break ;		
	case "Total unapproved events for the month": $new = "ÕâÔÂÎ´ÉóºËµÄ»î¶¯×ÜÊý Total unapproved events for the month" ; break;
	case "Two weeks": $new = "Á½¸öÐÇÆÚ Two weeks" ; break;	

	case "Update": $new = "¸üÐÂ Update"; break;
	case "Update Event": $new = "¸üÐÂ»î¶¯ Update Event"; break;
	case "Updating category": $new = "ÕýÔÚ¸üÐÂÀà±ð Updating category"; break ;
	case "Updating event": $new = "ÕýÔÚ¸üÐÂ»î¶¯ Updating event"; break;
	case "Updating user": $new = "ÕýÔÚ¸üÐÂÓÃ»§ Updating user"; break;			
	case "Unapproved events": $new = "Î´ÉóºËµÄ»î¶¯ Unapproved events"; break ;
	case "User": $new = "ÓÃ»§ User"; break ;
	case "User Calendar": $new = "ÓÃ»§ÈÕ³Ì±í User Calendar"; break ;
	case "User description": $new = "ÓÃ»§ÃèÊö User description"; break ;		
	case "User group": $new = "ÓÃ»§×é User group"; break ;				
	case "User Management": $new = "ÓÃ»§¹ÜÀí User Management"; break;
	case "userdelok": $new = "È·ÊµÒªÉ¾³ý´ËÓÃ»§ Are you sure to delete this user ?"; break;
	case "username": $new = "ÓÃ»§Ãû username"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "ÓÃ»§ÃûºÍÃÜÂë±ØÐëÊÇ×ÖÄ¸»òÊý×ÖÇÒ²»ÄÜÁô¿Õ¡£ Username and passwords must be alpha-numeric and without spaces."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "ÓÃ»§ÃûÒÑ´æÔÚ¡£ÇëÔÙÆðÒ»¸öÓÃ»§Ãû¡£ Username entered already exists. Please use another username."; break;
	case "users": $new = "ÓÃ»§ users"; break;

	case "View": $new = "²é¿´ View"; break;
	case "View categories in year": $new = "ÒÔÄê²é¿´Àà±ð View categories in year"; break ;
	case "View details or edit": $new = "²é¿´ÏêÏ¸ÄÚÈÝ»ò±à¼­ View details or edit"; break ;
	case "View event": $new = "²é¿´»î¶¯ View event"; break;
	case "View events of user": $new = "²é¿´ÓÃ»§µÄ»î¶¯ View events of user"; break;
	case "View events under this category in year": $new = "ÒÔÄêµÄ²é¿´´ËÀà±ðÏÂµÄ»î¶¯ View events under this category in year"; break ;
	case "View historical events before": $new = "²é¿´ÒÔÍùµÄ»î¶¯ View historical events before"; break ;
	case "View month": $new = "ÔÂ²é¿´ View month"; break;
	case "View week": $new = "ÖÜ²é¿´ View week"; break;

	case "Web Calendar Admin Login": $new = "ÈÕ³Ì±í¹ÜÀíµÇÂ¼ Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "ÈÕ³Ì±íÓÃ»§µÇÂ¼ Calendarix User Login"; break ;
	case "week number": $new = "ÖÜÊý week number"; break;
	case "Week starts": $new = "ÖÜ¿ªÊ¼ Week starts"; break;
	case "wronglogin": $new = "ÓÃ»§Ãû»òÃÜÂë²»¶Ô Incorrect username or password"; break;

	case "Year": $new = "Äê Year"; break;
	case "Yes": $new = "ÊÇ Yes"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "ÊÇ£¬É¾³ý»î¶¯£¡ Yes, delete event !"; break;
	case "Yes, delete it!": $new = "ÊÇ£¬É¾³ýËü£¡ Yes, delete it!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>