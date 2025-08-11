<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = " Ó÷åôéêÜ ìå ôï Calendarix"; break ;		
	case "Add": $new = " ÐñïóèÝóôå "; break ;
	case "Add Category": $new = " ÐñïóèÝóôå Êáôçãïñßá "; break;
	case "Add Event": $new = " ÐñïóèÝóôå ãåãïíüò "; break;
	case "Add event": $new = " ÐñïóèÝóôå ãåãïíüò " ; break;
	case "Add new user": $new = " ÐñïóèÝóôå vÝï ÷ñÞóôç "; break;
	case "Adding category": $new = " ÐñïóèÞêç êáôçãïñßáò "; break;
	case "Adding event": $new = " ÐñïóèÞêç ãåãïíüôïò " ; break ;
	case "Adding user": $new = " ÐñïóèÞêç ÷ñÞóôç "; break ;
	case "Address": $new = " Äéåýèõíóç "; break ;			// master translate?
	case "Administration": $new = " Äéïßêçóç "; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = " ¼ëåò ïé êáôçãïñßåò "; break ;		
	case "Approval needed for posting of events.": $new = " Áðáéôåßôáé Ýãêñéóç ãéá ôçí áðïóôïëÞ ôùí ãåãïíüôùí."; break;  
	case "Approvals": $new = " Åãêñßóåéò "; break ;
	case "Approve": $new = " Åãêñßíåôå "; break;
	case "Approving event": $new = " ¸ãêñéóç ãåãïíüôïò "; break;
	
	case "Back": $new = "Ðßóù"; break;
	case "Both passwords entered do not match": $new = " Ïé êùäéêïß ðïõ ðëçêôñïëïãïýíôáé äåí ôáéñéÜæïõí "; break;	

	case "Calendar": $new = " Çìåñïëüãéï "; break;
	case "Cancel": $new = " ¢êõñï "; break ;
	case "Cannot delete current login user": $new = " Äåí ìðïñåßôå íá äéáãñÜøåôå ôïí ôñÝ÷ïíôá ÷ñÞóôç üóï åßíáé óõíäåäåìÝíïò "; break ;   
	case "Cannot change current login user": $new = " Äåí ìðïñåßôå íá áëëÜîåôå ôïí ôñÝ÷ïíôá ÷ñÞóôç üóï åßíáé óõíäåäåìÝíïò "; break;	
	case "Cannot have a category with blank name": $new = " Äåí ìðïñåßôå íá Ý÷åôå ìéá êáôçãïñßá ìå êåíü üíïìá "; break ;
	case "Categories": $new = " Êáôçãïñßåò "; break;
	case "Category": $new = " Êáôçãïñßá "; break;
	case "Change": $new = " ÁëëáãÞ "; break ;
	case "Change password": $new = " ÁëëáãÞ êùäéêïý ðñüóâáóçò "; break; 		// master translate?
	case "Change password/group": $new = " ÁëëáãÞ êùäéêïý ðñüóâáóçò/ïìÜäáò "; break; 	// master obsolete?	
	case "Choose Category": $new = " ÅðéëÝîôå êáôçãïñßá "; break;
	case "Close": $new = " Êëåßóôå "; break;
	case "Confirm delete?": $new = " Åðéâåâáéþóôå ôç äéáãñáöÞ?" ; break ;			
	case "Confirm delete all historical events before": $new = " Åðéâåâáéþóôå ôç äéáãñáöÞ áðü üëá ôá éóôïñéêÜ ãåãïíüôá ðñéí áðü "; break ;
	case "confirmed events for today": $new = " åðéâåâáéùìÝíá ãåãïíüôá ãéá óÞìåñá "; break ;
	case "Confirm password": $new = " Åðéâåâáéþóôå ôïí êùäéêü ðñüóâáóçò "; break; 		
	case "Copy Event": $new = " ÁíôéãñÜøôå ôï ãåãïíüò "; break ;				
	case "Current Week": $new = " ÔñÝ÷ïõóá åâäïìÜäá "; break;
	case "Current Month": $new = " ÔñÝ÷ùí ìÞíáò "; break;
	case "Current Year": $new = " ÔñÝ÷ïí Ýôïò "; break;		

	case "Date": $new = " Çìåñïìçíßá "; break;
	case "Day": $new = " ÇìÝñá "; break;
	case "Delete all historical events listed": $new = " ÄéáãñÜøôå üëá ôá éóôïñéêÜ ãåãïíüôá ðïõ áðáñéèìïýíôáé "; break;
	case "Delete category": $new = " ÄéáãñÜøôå ôçí êáôçãïñßá "; break;
	case "Delete event": $new = " ÄéáãñÜøôå ôï ãåãïíüò "; break;
	case "Delete user": $new = " ÄéáãñÜøôå ôï ÷ñÞóôç "; break;
	case "Deleting category": $new = " ÄéáãñáöÞ ôçò êáôçãïñßáò "; break;
	case "Deleting event": $new = " ÄéáãñáöÞ ôïõ ãåãïíüôïò "; break ;
	case "Deleting user": $new = " ÄéáãñáöÞ ôïõ ÷ñÞóôç "; break ;
	case "disabled": $new = " Áõôü ôï ôìÞìá Ý÷åé ôåèåß åêôüò ëåéôïõñãßáò "; break;

	case "Edit category": $new = " ÁëëáãÞ ôçò êáôçãïñßáò "; break;
	case "Edit event": $new = " ÁëëáãÞ ôïõ ãåãïíüôïò "; break;
	case "Edit information": $new = " ÁëëáãÞ ôùí ðëçñïöïñßùí "; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = " ×ñüíïò ôÝëïõò "; break ;
	case "Event": $new = " Ãåãïíüò "; break ;
	case "Event Category": $new = " Êáôçãïñßá ãåãïíüôïò "; break;
	case "Event Description": $new = " ÐåñéãñáöÞ ãåãïíüôïò "; break;
	case "Event repeated": $new = " Åðáíáëáìâáíüìåíï ãåãïíüò "; break;  
	case "Event Title": $new = " Ôßôëïò ãåãïíüôïò "; break;
	case "events": $new = " ãåãïíüôá "; break;
	case "Events added will be posted immediately.": $new = " Ôá ãåãïíüôá ðïõ ðñïóôÝèçêáí èá ôá÷õäñïìçèïýí áìÝóùò."; break ;
	case "events awaiting approval": $new = " ãåãïíüôá ðïõ áíáìÝíïõí Ýãêñéóç "; break ;
	case "Events before": $new = " Ãåãïíüôá ðñéí áðü"; break ;
	case "events for": $new = " ãåãïíüôá ãéá "; break;
	case "Events for day": $new = " Ãåãïíüôá ãéá ôçí çìÝñá "; break;
	case "events for whole calendar": $new = " ãåãïíüôá ãéá ïëüêëçñï ôï çìåñïëüãéï "; break;
	case "events for year": $new = " ãåãïíüôá ãéá ôï Ýôïò "; break;
	case "Events from ": $new = " Ãåãïíüôá áðü "; break;
	case "Events in category": $new = " Ãåãïíüôá óôçí êáôçãïñßá "; break;

	case "From": $new = " Áðü "; break ;
	case "Functions": $new = " Ëåéôïõñãßåò "; break ;	// master translate?

	case "Go to": $new = " Ðçãáßíåôå "; break;
	case "Go to day": $new = " Ðçãáßíåôå óôçí çìÝñá "; break;
	case "Go to week": $new = " Ðçãáßíåôå óôçí åâäïìÜäá "; break;

	case "Historical Items": $new = " ÉóôïñéêÜ óôïé÷åßá "; break;

	case "Login": $new = " Óýíäåóç "; break;
	case "Login session time out in seconds": $new = "Login session time out in seconds"; break;
	case "Login session timeout": $new = " ÄéÜëåéììá óõíüäïõ óýíäåóçò "; break ;
	case "Logout": $new = " Áðïóýíäåóç "; break;

	case "Menu": $new = " Ìåíïý "; break;
	case "Month": $new = " ÌÞíáò "; break;
	case "More info": $new = " Ðåñéóóüôåñåò ðëçñïöïñßåò "; break;

	case "Name": $new = " ¼íïìá "; break;			// master translate?
	case "Next": $new = " ¸ðåéôá "; break;				
	case "Next day": $new = " Åðüìåíç çìÝñá "; break;
	case "Next week": $new = " Åðüìåíç åâäïìÜäá "; break;
	case "No categories yet": $new = " Êáìßá êáôçãïñßá áêüìá "; break;
	case "No events": $new = " ÊáíÝíá ãåãïíüò "; break;
	case "No Repeat": $new = " Êáìßá åðáíÜëçøç "; break;
	case "No results": $new = " ÊáíÝíá áðïôÝëåóìá "; break;
	case "No, go back!": $new = "¼÷é, åðéóôñÝøôå!"; break;
	case "No.": $new = " ¼÷é."; break;			// master translate?
	case "noadminapprove": $new = " ¸ãêñéóç ôùí ãåãïíüôùí ðïõ ðñïóôßèåíôáé áðï ôïõò äéïéêçôÝò äåí áðáéôïýíôáé áðü áðü ôï äéïéêçôÞ "; break ;
	case "noapprove": $new = " ¸ãêñéóç ôùí ãåãïíüôùí ðïõ ðñïóôßèåíôáé áðü ôïõò ÷ñÞóôåò äåí áðáéôïýíôáé áðü áðü ôï äéïéêçôÞ "; break ;
	case "nocat": $new = " ÐñÝðåé íá åðéëÝîåôå ìéá êáôçãïñßá!"; break;
	case "noday": $new = " ÐñÝðåé íá åðéëÝîåôå ìéá çìÝñá!"; break;
	case "nodescription": $new = " ÐñÝðåé íá äþóåôå ìéá ðåñéãñáöÞ ãåãïíüôïò!"; break;
	case "nomonth": $new = " ÐñÝðåé íá åðéëÝîåôå Ýíáí ìÞíá!"; break;
	case "nonapproved": $new = " Ãåãïíüôá ðïõ áðáéôïýí ôçí Ýãêñéóç: "; break;
	case "nononapproved": $new = " Äåí õðÜñ÷åé êáíÝíá ãåãïíüò ðïõ ÷ñåéÜæåôáé ôçí Ýãêñéóç áõôÞ ôç óôéãìÞ "; break;
	case "notitle": $new = " ÐñÝðåé íá äþóåôå Ýíáí ôßôëï ãåãïíüôïò!"; break;
	case "noyear": $new = " ÐñÝðåé íá åðéëÝîåôå Ýíá Ýôïò!"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = " Ðñïáéñåôéêüò "; break;
	case "or month": $new = " Þ ìÞíáò "; break;
	case "or week": $new = " Þ åâäïìÜäá "; break;

	case "password": $new = " êùäéêüò ðñüóâáóçò "; break;
	case "Please choose the category you only want to view events for": $new = " Ðáñáêáëþ åðéëÝîôå ôçí êáôçãïñßá ðïõ èÝëåôå ìüíï íá äåßôå ôá ãåãïíüôá ãéá "; break;  
	case "Popup Month": $new = " Õðåñåìöáíéæüìåíïò ìÞíáò "; break ;
	case "Previous": $new = " Ðñïçãïýìåíïò "; break;			
	case "Previous day": $new = " Ðñïçãïýìåíç çìÝñá "; break;
	case "Previous week": $new = " Ðñïçãïýìåíç åâäïìÜäá "; break;

	case "Read more": $new = " ÄéáâÜóôå ðåñéóóüôåñùí "; break;
	case "reallydelcat": $new = " Åßóôå âÝâáéïé óå óáò èÝëåôå áöáéñåßôå áõôÞí ôçí êáôçãïñßá; ¼ëá ôá ãåãïíüôá ðïõ óõíäÝïíôáé ìå áõôÞí ôçí êáôçãïñßá èá äéáãñáöïýí ìüíéìá! "; break;
	case "Repeat": $new = " ÅðáíáëÜâåôå "; break;
	case "results": $new = " áðïôåëÝóìáôá "; break;
	case "Role": $new = " Ñüëïò "; break;			// master translate?

	case "search": $new = " áíáæÞôçóç "; break;
	case "Sort by": $new = " Ôáîéíüìçóç êáôÜ"; break ;
	case "Sort by date": $new = " Ôáîéíüìçóç êáôÜ çìåñïìçíßá "; break ;
	case "Sort by events": $new = " Ôáîéíüìçóç êáôÜ ãåãïíüôá "; break ;
	case "Start Time": $new = " ×ñüíïò Ýíáñîçò "; break ;

	case "thankyou": $new = " Óáò åõ÷áñéóôþ ãéá ôçí åßóïäï ôïõ ãåãïíüôïò, èá åìöáíéóôåß ìåôÜ áðü ôçí Ýãêñéóç."; break;
	case "thankyoupost": $new = " Óáò åõ÷áñéóôþ ãéá ôçí åßóïäï åíüò ãåãïíüôïò, Ý÷åé ôá÷õäñïìçèåß."; break;
	case "till": $new = " ìÝ÷ñé "; break;
	case "Time added or updated": $new = " ×ñüíïò ðñïóèåóçò Þ åíçìåñùóçò "; break ;
	case "timeout msg": $new = " Ïé áëëáãÝò óôï äéÜëåéììá óõíüäïõ èá åßíáé ìüíï áðïôåëåóìáôéêÝò óôçí åðüìåíç óýíäåóç " ; break ;
	case "times every": $new = " öïñÝò êÜèå "; break;	
	case "To": $new = "Ðñüò"; break ;
	case "To delete category": $new = " Ãéá íá äéáãñÜøåé ôçí êáôçãïñßá "; break ;
	case "Today": $new = " ÓÞìåñá "; break;
	case "Total": $new = " Óýíïëï "; break;
	case "Total number of events for the month": $new = " Óõíïëéêüò áñéèìüò ãåãïíüôùí ãéá ôï ìÞíá "; break ;
	case "Total number of events for user": $new = " Óõíïëéêüò áñéèìüò ãåãïíüôùí ãéá ôï ÷ñÞóôç "; break ;		
	case "Total unapproved events for the month": $new = " ÓõíïëéêÜ ãåãïíüôá ãéá Ýãêñéóç ãéá ôï ìÞíá " ; break;
	case "Two weeks": $new = " Äýï åâäïìÜäåò " ; break;	

	case "Update": $new = " ÁíáðñïóáñìïãÞ "; break;
	case "Update Event": $new = "ÁíáíÝùóç ãåãïíüôïò "; break;
	case "Updating category": $new = " ÁíáíÝùóç êáôçãïñßáò "; break ;
	case "Updating event": $new = " ÁíáíÝùóç ãåãïíüôïò "; break;
	case "Updating user": $new = " ÁíáíÝùóç ÷ñÞóôç "; break;			
	case "Unapproved events": $new = " Ãåãïíüôá ðñïò åãêñéóç "; break ;
	case "User": $new = " ×ñÞóôçò "; break ;
	case "User Calendar": $new = " Çìåñïëüãéï ÷ñçóôþí "; break ;
	case "User description": $new = " ÐåñéãñáöÞ ÷ñçóôþí "; break ;		
	case "User group": $new = " ÏìÜäá ÷ñçóôþí "; break ;				
	case "User Management": $new = " Äéá÷åßñéóç ÷ñçóôþí "; break;
	case "userdelok": $new = " Åßóôå âÝâáéïé íá äéáãñÜøåôå áõôüí ôïí ÷ñÞóôç?"; break;
	case "username": $new = " üíïìá ÷ñÞóôç "; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = " Ôï üíïìá ÷ñÞóôç êáé ïé êùäéêïß ðñüóâáóçò ðñÝðåé íá åßíáé áëöáíïõìåñéêïß êáé ÷ùñßò äéáóôÞìáôá."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = " Ôï üíïìá ÷ñÞóôç ðïõ åéóÞ÷èç õðÜñ÷åé Þäç. Ðáñáêáëþ ÷ñçóéìïðïéÞóôå Ýíá Üëëï üíïìá ÷ñÞóôç."; break;
	case "users": $new = " ÷ñÞóôåò "; break;

	case "View": $new = "ÐñïâïëÞ"; break;
	case "View categories in year": $new = " ÐñïâïëÞ êáôçãïñéþí óôï Ýôïò "; break ;
	case "View details or edit": $new = " ÐñïâïëÞ ëåðôïìÝñåéùí Þ áëëáãÞ "; break ;
	case "View event": $new = " ÐñïâïëÞ ãåãïíüôïò"; break;
	case "View events of user": $new = " ÐñïâïëÞ ãåãïíüôùí ôïõ ÷ñÞóôç "; break;
	case "View events under this category in year": $new = " ÐñïâïëÞ ãåãïíüôùí êÜôù áðü áõôÞí ôçí êáôçãïñßá óôï Ýôïò "; break ;
	case "View historical events before": $new = " ÐñïâïëÞ éóôïñéêþí ãåãïíüôùí ðñéí "; break ;
	case "View month": $new = " ÐñïâïëÞ ìÞíá "; break;
	case "View week": $new = " ÐñïâïëÞ åâäïìÜäáò "; break;

	case "Web Calendar Admin Login": $new = "Calendarix Óýíäåóç Admin "; break ;
	case "Web Calendar User Login": $new = "Calendarix Óýíäåóç ÷ñçóôþí "; break ;
	case "week number": $new = " áñéèìüò åâäïìÜäáò "; break;
	case "Week starts": $new = " ÅíÜñîåéò åâäïìÜäáò "; break;
	case "wronglogin": $new = " ËáíèáóìÝíï üíïìá ÷ñÞóôç Þ êùäéêüò ðñüóâáóçò "; break;

	case "Year": $new = " ¸ôïò "; break;
	case "Yes": $new = " Íáé "; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = " Íáé, äéáãñÜøôå ôï ãåãïíüò!"; break;
	case "Yes, delete it!": $new = " Íáé, íá ôï äéáãñÜøåôå!"; break;

	default: $new = "<b>".$msgin."</b> ðñÝðåé íá ìåôáöñáóôåß!";    break;
    }
    return $new;
}
?>
