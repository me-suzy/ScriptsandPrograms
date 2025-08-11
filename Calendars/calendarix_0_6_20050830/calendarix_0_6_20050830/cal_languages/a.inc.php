<?php
# Users have to change alignment to right, and in header file replace <html> with <html dir=rtl> so it would look right
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;
	case "Add": $new = "ÅÖÇÝå"; break ;
	case "Add Category": $new = "ÃÖÝ ÊÕäíÝ"; break;
	case "Add Event": $new = "ÃÖÝ ÍÏË"; break;
	case "Add event": $new = "ÃÖÝ ÍÏË" ; break;
	case "Add new user": $new = "ÅÖÇÝÉ ãÓÊÎÏã ÌÏíÏ"; break;
	case "Adding category": $new = "ÅÖÇÝÉ ÊÕäíÝ"; break;
	case "Adding event": $new = "ÅÖÇÝÉ ÍÏË" ; break ;
	case "Adding user": $new = "ÅÖÇÝÉ ãÓÊÎÏã"; break ;
	case "Administration": $new = "ÇáÅÏÇÑå"; break;
	case "Administrator": $new = "ÇáãÏíÑ"; break ;
	case "All categories": $new = "ßá ÇáÊÕäíÝÇÊ"; break ;		
	case "Approval needed for posting of events.": $new = "áÇÈÏ ãä ÇáãæÇÝÞÉ Úáì ßá ÇáÃÍÏÇË ÇáãÖÇÝå."; break;  
	case "Approvals": $new = "ÇáãæÇÝÞå"; break ;
	case "Approve": $new = "ÞÈæá"; break;
	case "Approving event": $new = "ÞÈæá ÍÏË"; break;
	
	case "Back": $new = "ÚæÏå"; break;
	case "Both passwords entered do not match": $new = "ßáãÇÊ ÇáÓÑ ÛíÑ ãÊØÇÈÞå"; break;	

	case "Calendar": $new = "ÇáÊÞæíã"; break;
	case "Cancel": $new = "ÅáÛÇÁ"; break ;
	case "Cannot delete current login user": $new = "áÇíãßä ÍÐÝ ÇáãÓÊÎÏã ÇáÍÇáí"; break ;   
	case "Cannot change current login user": $new = "áÇíãßä ÊÛííÑ ßáãÉ ÇáÓÑ ááãÓÊÎÏã ÇáÍÇáí"; break;	
	case "Cannot have a category with blank name": $new = "áÇíãßä ÞÈæá ÊÕäíÝ ÈÏæä ÅÓã"; break ;
	case "Categories": $new = "ÇáÊÕäíÝÇÊ"; break;
	case "Category": $new = "ÇáÊÕäíÝ"; break;
	case "Change": $new = "ÊÛííÑ"; break ;
	case "Change password/group": $new = "ÊÛííÑ ßáãÉ ÇáÓÑ/ ÇáãÌãæÚÇÊ"; break; 		
	case "Choose Category": $new = "ÅÎÊÑ ÊÕäíÝ"; break;
	case "Close": $new = "ÅÛáÇÞ ÇáäÇÝÐå"; break;
	case "Confirm delete?": $new = "ÊÃßíÏ ÇáÍÐÝ?" ; break ;			
	case "Confirm delete all historical events before": $new = "ÊÃßíÏ ÍÐÝ ÌãíÚ ÇáÃÍÏÇË ÞÈá"; break ;
	case "confirmed events for today": $new = "ÃÍÏÇË Çáíæã"; break ;
	case "Confirm password": $new = "ÊÃßíÏ ßáãÉ ÇáÓÑ"; break; 		
	case "Copy Event": $new = "äÓÎ ÇáÍÏË"; break ;				
	case "Current Week": $new = "ÇáÃÓÈæÚ ÇáÍÇáí"; break;
	case "Current Month": $new = "ÇáÔåÑ ÇáÌÇÑí"; break;
	case "Current Year": $new = "ÇáÓäÉ ÇáÍÇáíå"; break;		

	case "Date": $new = "ÇáÊÇÑíÎ"; break;
	case "Day": $new = "Çáíæã"; break;
	case "Delete all historical events listed": $new = "ÍÐÝ ÌãíÚ ÇáÃÍÏÇË ÇáÊÇÑíÎíÉ ÇáãÏÑÌå"; break;
	case "Delete category": $new = "ÍÐÝ ÇáÊÕäíÝ"; break;
	case "Delete event": $new = "ÍÐÝ ÇáÍÏË"; break;
	case "Delete user": $new = "ÍÐÝ ÇáãÓÊÎÏã"; break;
	case "Deleting category": $new = "ÍÐÝ ÇáÊÕäíÝ"; break;
	case "Deleting event": $new = "ÍÐÝ ÇáÍÏË"; break ;
	case "Deleting user": $new = "ÍÐÝ ãÓÊÎÏã"; break ;
	case "disabled": $new = "Êã æÞÝ ÇáÚãá ÈåÐÇ ÇáÞÓã"; break;

	case "Edit category": $new = "ÊÚÏíá ÇáÊÕäíÝ"; break;
	case "Edit event": $new = "ÊÚÏíá ÇáÍÏË"; break;
	case "Email": $new = "ÇáÈÑíÏ ÇáÅáßÊÑæäí"; break;
	case "End Time": $new = "ÊÚÏíá ÇáæÞÊ"; break ;
	case "Event": $new = "ÇáÍÏË"; break ;
	case "Event Category": $new = "ÊÕäíÝ ÇáÍÏË"; break;
	case "Event Description": $new = "æÕÝ ÇáÍÏË"; break;
	case "Event repeated": $new = "ÊßÑÇÑ ÇáÍÏË"; break;  
	case "Event Title": $new = "ÚäæÇä ÇáÍÏË"; break;
	case "events": $new = "ÇáÃÍÏÇË"; break;
	case "Events added will be posted immediately.": $new = "ÇáÃÍÏÇË ÇáãÖÇÝå ÓíÊã äÔÑåÇ ãÈÇÔÑÉ."; break ;
	case "events awaiting approval": $new = "ÃÍÏÇË ÈÅäÊÙÇÑ ÇáãæÇÝÞå"; break ;
	case "Events before": $new = "ÃÍÏÇË ÞÈá"; break ;
	case "events for": $new = "ÃÍÏÇË ÎÇÕÉ È"; break;
	case "Events for day": $new = "ÃÍÏÇË íæã"; break;
	case "events for whole calendar": $new = "ßá ÃÍÏÇË ÇáÊÞæíã"; break;
	case "events for year": $new = "ÃÍÏÇË ÇáÓäå"; break;
	case "Events from ": $new = "ÃÍÏÇË ãä "; break;
	case "Events in category": $new = "ÃÍÏÇË ÇáÊÕäíÝ"; break;

	case "From": $new = "ãä"; break ;

	case "Go to": $new = "ÅÐåÈ Åáì"; break;
	case "Go to day": $new = "ÅÐåÈ Åáì íæã"; break;
	case "Go to week": $new = "ÅÐåÈ Åáì ÇáÇÓÈæÚ"; break;

	case "Historical Items": $new = "ÃÍÏÇË ÓÇÈÞå"; break;

	case "Login": $new = "ÇáÏÎæá"; break;
	case "Login session time out in seconds": $new = "ãÏÉ ÕáÇÍíÉ ÇáÏÎæá ÈÇáËæÇäí"; break;
	case "Login session timeout": $new = "ÅäÊåÊ ÕáÇÍíÉ ÇáÏÎæá"; break ;
	case "Logout": $new = "ÎÑæÌ"; break;

	case "Menu": $new = "ÇáÞÇÆãå"; break;
	case "Month": $new = "ÇáÔåÑ"; break;
	case "More info": $new = "ÇáãÒíÏ"; break;

	case "Next": $new = "ÇáÊÇáí"; break;				
	case "Next day": $new = "Çáíæã ÇáÊÇáí"; break;
	case "Next week": $new = "ÇáÃÓÈæÚ ÇáÊÇáí"; break;
	case "No categories yet": $new = "áÇÊæÌÏ ÊÕäíÝÇÊ"; break;
	case "No events": $new = "áÇÊæÌÏ ÃÍÏÇË"; break;
	case "No Repeat": $new = "áÇíæÌÏ ÊßÑÇÑ"; break;
	case "No results": $new = "áÇÊæÌÏ äÊÇÆÌ"; break;
	case "No, go back!": $new = "ÛíÑ ãÊæÝÑ, ÚæÏå!"; break;
	case "noadminapprove": $new = "ÇáÃÍÏÇË ÇáãÖÇÝÉ ãä ÞÈá ÇáãÏíÑ áÇÊÍÊÇÌ Åáì ãæÇÝÞå"; break ;
	case "noapprove": $new = "ÇáÃÍÏÇË ÇáãÖÇÝÉ ãä ÇáãÓÊÎÏãíä áÇÊÍÊÇÌ Åáì ãæÇÝÞå"; break ;
	case "nocat": $new = "íÌÈ Ãä ÊÎÊÇÑ ÊÕäíÝÇ !"; break;
	case "noday": $new = "íÌÈ Ãä ÊÎÊÇÑ Çáíæã !"; break;
	case "nodescription": $new = "íÌÈ æÕÝ ÇáÍÏË !"; break;
	case "nomonth": $new = "íÌÈ Ãä ÊÎÊÇÑ ÇáÔåÑ !"; break;
	case "nonapproved": $new = "ÇáÃÍÏÇË ÇáÊí ÊÍÊÇÌ Åáì ãæÇÝÞå : "; break;
	case "nononapproved": $new = "áÇÊæÌÏ ÃÍÏÇË ÊÊØáÈ ÇáãæÇÝÞÉ ÍÇáíÇ"; break;
	case "notitle": $new = "íÌÈ ÅÚØÇÁ ÚäæÇä ááÍÏË !"; break;
	case "noyear": $new = "íÌÈ Ãä ÊÎÊÇÑ ÇáÓäå !"; break;

	case "on": $new = "Ýí"; break;
	case "Optional": $new = "ÅÎÊíÇÑí"; break;
	case "or month": $new = "Ãæ ÔåÑ"; break;
	case "or week": $new = "Ãæ ÇáÇÓÈæÚ"; break;

	case "password": $new = "ßáãÉ ÇáÓÑ"; break;
	case "Please choose the category you only want to view events for": $new = "ÇáÑÌÇÁ ÅÎÊíÇÑ ÇáÊÕäíÝ ÇáÐí ÊÑÛÈ ãÔÇåÏÉ ÃÍÏÇËå"; break;  
	case "Popup Month": $new = "ÇáÔåÑ ÇáäÇÝÑ"; break ;
	case "Previous": $new = "ÇáÓÇÈÞ"; break;			
	case "Previous day": $new = "Çáíæã ÇáÓÇÈÞ"; break;
	case "Previous week": $new = "ÇáÃÓÈæÚ ÇáãÇÖí"; break;

	case "Read more": $new = "ÇáãÒíÏ"; break;
	case "reallydelcat": $new = "åá ÃäÊ ãÊÃßÏ ãä ÑÛÈÊß ÈÍÐÝ ÇáÊÕäíÝ¿ ßá ÇáÃÍÏÇË ÇáãÑÊÈØÉ ÈåÐÇ ÇáÊÕäíÝ ÓíÊã ÍÐÝåÇ äåÇÆíÇ äÊíÌÉ áÐáß!"; break;
	case "Repeat": $new = "ÊßÑÇÑ"; break;
	case "results": $new = "äÊÇÆÌ"; break;

	case "search": $new = "ÈÍË"; break;
	case "Sort by": $new = "ÊÑÊíÈ ÍÓÈ"; break ;
	case "Sort by date": $new = "ÊÑÊíÈ ÍÓÈ ÇáÊÇÑíÎ"; break ;
	case "Sort by events": $new = "ÊÑÊíÈ ÍÓÈ ÇáÃÍÏÇË"; break ;
	case "Start Time": $new = "æÞÊ ÇáÈÏÇíå"; break ;

	case "thankyou": $new = "ÔßÑÇ áÃÖÇÝÊß áåÐÇ ÇáÍÏË, ÓíÊã äÔÑå ÈÚÏ ÇáãæÇÝÞÉ Úáíå."; break;
	case "thankyoupost": $new = "ÔßÑÇ áÅÖÇÝÊß áåÐÇ ÇáÍÏË, áÞÏ Êã äÔÑå."; break;
	case "till": $new = "ÍÊì"; break;
	case "Time added or updated": $new = "æÞÊ ÇáÅÖÇÝÉ æÇáÊÍÏíË"; break ;
	case "timeout msg": $new = "áä íÊã ÇáÚãá ÈåÐÇ ÇáÊÚÏíá Åáì Ýí ÇáÏÎæá ÇáÊÇáí" ; break ;
	case "times every": $new = "ãÑå ßá"; break;	
	case "To": $new = "ÍÊì"; break ;
	case "To delete category": $new = "áÍÐÝ ÊÕäíÝ"; break ;
	case "Today": $new = "Çáíæã"; break;
	case "Total": $new = "ãÌãæÚ"; break;
	case "Total number of events for the month": $new = "ãÌãæÚ ÃÍÏÇË åÐÇ ÇáÔåÑ"; break ;
	case "Total number of events for user": $new = "ãÌãæÚ ÃÍÏÇË åÐÇ ÇáãÓÊÎÏã"; break ;		
	case "Total unapproved events for the month": $new = "ÇáÃÍÏÇË ÇáÊí ÊäÊÙÑ ÇáãæÇÝÞÉ áåÐÇ ÇáÔåÑ" ; break;
	case "Two weeks": $new = "ÇÓÈæÚíä" ; break;	

	case "Update": $new = "ÊÍÏíË"; break;
	case "Update Event": $new = "ÊÍÏíË ÍÏË"; break;
	case "Updating category": $new = "ÊÍÏíË ÊÕäíÝ"; break ;
	case "Updating event": $new = "ÊÍÏíË ÇáÍÏË"; break;
	case "Updating user": $new = "ÊÍÏíË ÇáãÓÊÎÏã"; break;			
	case "Unapproved events": $new = "ÍÏË áã ÊÊã ÇáãæÇÝÞÉ Úáíå"; break ;
	case "User": $new = "ÇáãÓÊÎÏã"; break ;
	case "User Calendar": $new = "ÊÞæíã ÇáãÓÊÎÏã"; break ;
	case "User description": $new = "æÕÝ ÇáãÓÊÎÏã"; break ;		
	case "User group": $new = "ãÌãæÚÇÊ ÇáãÓÊÎÏãíä"; break ;				
	case "User Management": $new = "ÅÏÇÑÉ ÇáãÓÊÎÏãíä"; break;
	case "userdelok": $new = "åá ÃäÊ ãÊÃßÏ ãäÍÐÝ ÇáãÓÊÎÏã ?"; break;
	case "username": $new = "ÅÓã ÇáãÓÊÎÏã"; break;
	case "Username entered already exists. Please use another username.": $new = "ÅÓã ÇáãÓÊÎÏã ãÓÌá ÓÇÈÞÇ¡ ÇáÑÌÇÁ ÅÓÊÎÏÇã ÅÓã ÂÎÑ."; break;
	case "users": $new = "ãÓÊÎÏã"; break;

	case "View": $new = "ÚÑÖ"; break;
	case "View categories in year": $new = "ãÔÇåÏÉ ÇáÊÕäíÝÇÊ áÓäÉ"; break ;
	case "View details or edit": $new = "ãÔÇåÏæ æÊÚÏíá ÇáÊÝÇÕíá"; break ;
	case "View event": $new = "ÚÑÖ ÇáÍÏË"; break;
	case "View events of user": $new = "ÚÑÖ ÃÍÏÇË ÇáãÓÊÎÏã"; break;
	case "View events under this category in year": $new = "ÚÑÖ ÇáÃÍÏÇË áåÐÇ ÇáÊÕäíÝ áÓäÉ"; break ;
	case "View historical events before": $new = "ÚÑÖ ÇáÃÍÏÇË ÇáÓÇÈÞÉ á"; break ;
	case "View month": $new = "ÚÑÖ ÔåÑ"; break;
	case "View week": $new = "ÚÑÖ ÃÓÈæÚ"; break;

	case "Web Calendar Admin Login": $new = "ÊÓÌíá ÏÎæá ÇáãÏíÑ"; break ;
	case "Web Calendar User Login": $new = "ÊÓÌíá ÇáÏÎæá"; break ;
	case "week number": $new = "ÑÞã ÇáÃÓÈæÚ"; break;
	case "Week starts": $new = "ÈÏÇíÉ ÇáÃÓÈæÚ"; break;
	case "wronglogin": $new = "ÅÓã Ãæ ßáãÉ ÓÑ ÎÇØÆå"; break;

	case "Year": $new = "ÇáÓäå"; break;
	case "Yes, delete event !": $new = "ãÊÃßÏ, ÅÍÐÝ ÇáÍÏË !"; break;
	case "Yes, delete it!": $new = "ãÊÃßÏ, ÅÒÇáå!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>