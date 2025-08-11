<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "Ïðî êàëåíäàðèêñ"; break ;		
	case "Add": $new = "Äîáàâèòü"; break ;
	case "Add Category": $new = "Äîáàâèòü êàòåãîðèþ"; break;
	case "Add Event": $new = "Äîáàâèòü Ñîáûòèå"; break;
	case "Add event": $new = "Äîáàâèòü ñîáûòèå" ; break;
	case "Add new user": $new = "Äîáàâèòü íîâîãî ïîëüçîâàòåëÿ"; break;
	case "Adding category": $new = "Äîáàâëåíèå êàòåãîðèè"; break;
	case "Adding event": $new = "Äîáàâëåíèå ñîáûòèÿ" ; break ;
	case "Adding user": $new = "Äîáàâëåíèå ïîëüçîâàòåëÿ"; break ;
	case "Administration": $new = "Àäìèíèñòðèðîâàíèå"; break;
	case "Administrator": $new = "Àäìèíèñòðàòîð"; break ;
	case "All categories": $new = "Âñå êàòåãîðèè"; break ;		
	case "Approval needed for posting of events.": $new = "Äëÿ ïóáëèêàöèè ñîáûòèÿ íåîáõîäèìî îäîáðåíèå àäìèíèñòðàòîðà êàëåíäàðÿ."; break;  
	case "Approvals": $new = "Îäîáðåíèÿ"; break ;
	case "Approve": $new = "Îäîáðåíî"; break;
	case "Approving event": $new = "Îäîáðåííûå ñîáûòèÿ"; break;
	
	case "Back": $new = "Íàçàä"; break;
	case "Both passwords entered do not match": $new = "Îáà ââåäåííûõ ïàðîëÿ íå ñîâïàäàþò"; break;	

	case "Calendar": $new = "Êàëåíäàðü"; break;
	case "Cancel": $new = "Ñáðîñ"; break ;
	case "Cannot delete current login user": $new = "Íå ìîãó óäàëèòü òåêóùèé ïàðîëü ïîëüçîâàòåëÿ"; break ;   
	case "Cannot change current login user": $new = "Íå ìîãó èçìåíèòü òåêóùèé ïàðîëü ïîëüçîâàòåëÿ"; break;	
	case "Cannot have a category with blank name": $new = "Ïîëå Êàòåãîðèÿ íå ìîæåò áûòü ïóñòûì"; break ;
	case "Categories": $new = "Êàòåãîðèè"; break;
	case "Category": $new = "Êàòåãîðèÿ"; break;
	case "Change": $new = "Èçìåíèòü"; break ;
	case "Change password/group": $new = "Èçìåíèòü ïàðîëü/ãðóïïó"; break; 		
	case "Choose Category": $new = "Âûáðàòü êàòåãîðèþ"; break;
	case "Close": $new = "Çàêðûòü"; break;
	case "Confirm delete?": $new = "Ïîäòâåðæäàåòå óäàëåíèå?" ; break ;		
	case "Confirm delete all historical events before": $new = "Ïîäòâåðæäàåòå óäàëåíèå âñåõ ïðåäûäóùèõ ñîáûòèé"; break ;
	case "confirmed events for today": $new = "ïîäòâåðæäàåòå ñîáûòèÿ íà ñåãîäíÿ"; break ;
	case "Confirm password": $new = "Ïîäòâåðæäàåòå ïàðîëü"; break; 		
	case "Copy Event": $new = "Êîïèðîâàòü Ñîáûòèå"; break ;				
	case "Current Week": $new = "Òåêóùàÿ íåäåëÿ"; break;
	case "Current Month": $new = "Òåêóùèé ìåñÿö"; break;
	case "Current Year": $new = "Òåêóùèé ãîä"; break;		

	case "Date": $new = "Äàòà"; break;
	case "Day": $new = "Äåíü"; break;
	case "Delete all historical events listed": $new = "Óäàëèòü âñå çàïèñàííûå â êàëåíäàðü èñòîðè÷åñêèå ñîáûòèÿ"; break;
	case "Delete category": $new = "Óäàëèòü êàòåãîðèþ"; break;
	case "Delete event": $new = "Óäàëèòü ñîáûòèå"; break;
	case "Delete user": $new = "Óäàëèòü ïîëüçîâàòåëÿ"; break;
	case "Deleting category": $new = "Óäàëåíèå êàòåãîðèè"; break;
	case "Deleting event": $new = "Óäàëåíèå ñîáûòèÿ"; break ;
	case "Deleting user": $new = "Óäàëåíèå ïîëüçîâàòåëÿ"; break ;
	case "disabled": $new = "âûâåäåíî èç ñòðîÿ"; break;

	case "Edit category": $new = "Ðåäàêòèðîâàòü êàòåãîðèþ"; break;
	case "Edit event": $new = "Ðåäàêòèðîâàòü ñîáûòèå"; break;
	case "Email": $new = "E-mail"; break;
	case "End Time": $new = "Âðåìÿ îêîí÷àíèÿ"; break ;
	case "Event": $new = "Ñîáûòèå"; break ;
	case "Event Category": $new = "Êàòåãîðèÿ Ñîáûòèÿ"; break;
	case "Event Description": $new = "Îïèñàíèå ñîáûòèÿ"; break;
	case "Event repeated": $new = "Îáíîâèòü ñîáûòèå"; break;  
	case "Event Title": $new = "Íîâîå íàçâàíèå"; break;
	case "events": $new = "ñîáûòèÿ"; break;
	case "Events added will be posted immediately.": $new = "Äîáàâëåííîå ñîáûòèå áóäåò îïóáëèêîâàíî íåìåäëåííî."; break ;
	case "events awaiting approval": $new = "ñîáûòèÿ îæèäàþùèå îäîáðåíèÿ"; break ;
	case "Events before": $new = "Ñîáûòèÿ ïåðåä"; break ;
	case "events for": $new = "ñîáûòèÿ çà"; break;
	case "Events for day": $new = "Ñîáûòèÿ çà äåíü"; break;
	case "events for whole calendar": $new = "ñîáûòèÿ çà âåñü êàëåíäàðü"; break;
	case "events for year": $new = "ñîáûòèÿ çà ãîä"; break;
	case "Events from ": $new = "Ñîáûòèÿ îò "; break;
	case "Events in category": $new = "Ñîáûòèÿ â êàòåãîðèè"; break;

	case "From": $new = "Îò"; break ;

	case "Go to": $new = "Ïåðåéòè ê"; break;
	case "Go to day": $new = "Ïåðåéòè ê äíþ"; break;
	case "Go to week": $new = "Ïåðåéòè ê íåäåëå"; break;

	case "Historical Items": $new = "Èñòîðè÷åñêèå ñîáûòèÿ"; break;

	case "Login": $new = "Ëîãèí"; break;
	case "Login session time out in seconds": $new = "Ñåññèÿ àâòîðèçàöèè ïðåêðàòèòüñÿ ÷åðåç ñåêóíäó"; break;
	case "Login session timeout": $new = "Ñåññèÿ àâòîðèçàöèè ïðåêðàùåíà"; break ;
	case "Logout": $new = "Âûõîä"; break;

	case "Menu": $new = "Ìåíþ"; break;
	case "Month": $new = "Ìåñÿö"; break;
	case "More info": $new = "Áîëüøå èíôîðìàöèè"; break;

	case "Next": $new = "Ñëåäóþùàÿ"; break;				
	case "Next day": $new = "Ñëåäóþùèé äåíü"; break;
	case "Next week": $new = "Ñëåäóþùàÿ íåäåëÿ"; break;
	case "No categories yet": $new = "Ïîêà íåò êàòåãîðèé"; break;
	case "No events": $new = "Íåò ñîáûòèé"; break;
	case "No Repeat": $new = "Íåò îáíîâëåíèé"; break;
	case "No results": $new = "Íåò ðåçóëüòàòîâ"; break;
	case "No, go back!": $new = "Íåò, ïðîéäèòå íàçàä!"; break;
	case "noadminapprove": $new = "Ñîáûòèÿ, äîáàâëÿåìîå àäìèíèñòðàòîðîì, íå òðåáóåò îäîáðåíèÿ"; break ;
	case "noapprove": $new = "Äîáàâëåíèå ñîáûòèÿ ïîëüçîâàòåëåì, íå òðåáóåò îäîáðåíèÿ àäìèíà"; break ;
	case "nocat": $new = "Âûáåðèòå äðóãóþ êàòåãîðèþ !"; break;
	case "noday": $new = "Èçáåðèòå äðóãîé äåíü !"; break;
	case "nodescription": $new = "Âïèøèòå íåäîñòàþùåå îïèñàíèå ñîáûòèÿ !"; break;
	case "nomonth": $new = "Âûáåðèòå äðóãîé ìåñÿö !"; break;
	case "nonapproved": $new = "Ñîáûòèÿ îæèäàþùèå îäîáðåíèÿ : "; break;
	case "nononapproved": $new = "Íåò ñîáûòèé, òðåáóùèõ îäîáðåíèÿ"; break;
	case "notitle": $new = "Âïèøèòå íàçâàíèå ñîáûòèÿ !"; break;
	case "noyear": $new = "Âûáåðèòå îòñóòñòâóþùèé ãîä !"; break;

	case "on": $new = "íà"; break;
	case "Optional": $new = "Âûáîðî÷íî"; break;
	case "or month": $new = "èëè ìåñÿö"; break;
	case "or week": $new = "èëè íåäåëþ"; break;

	case "password": $new = "ïàðîëü"; break;
	case "Please choose the category you only want to view events for": $new = "Âûáåðèòå êàòåãîðèþ â êîòîðîé âû õîòèòå âèäåòü ñîáûòèå"; break;  
	case "Popup Month": $new = "Ìåñÿö ââåðõ"; break ;
	case "Previous": $new = "Ïðåäûäóùàÿ"; break;			
	case "Previous day": $new = "Ïðåäûäóùèé äåíü"; break;
	case "Previous week": $new = "Ïðåäûäóùàÿ íåäåëÿ"; break;

	case "Read more": $new = "×èòàòü äàëåå"; break;
	case "reallydelcat": $new = "Âû äåéñòâèòåëüíî õîòèòå óäàëèòü êàòåãîðèþ? Âñå ñîáûòèÿ â êàòåãîðèè áóäóò òàêæå óäàëåíû!"; break;
	case "Repeat": $new = "Îáíîâëåíèå"; break;
	case "results": $new = "ðåçóëüòàòû"; break;

	case "search": $new = "ïîèñê"; break;
	case "Sort by": $new = "Ñîðòèðîâàòü ïî"; break ;
	case "Sort by date": $new = "Ñîðòèðîâàòü ïî äàòå"; break ;
	case "Sort by events": $new = "Ñîðòèðîâàòü ïî ñîáûòèÿì"; break ;
	case "Start Time": $new = "Äàòà íà÷àëà"; break ;

	case "thankyou": $new = "Ñïàñèáî çà ñîáûòèå, îíî áóäåò îïóáëèêîâàíî ïîñëå ïðîâåðêè."; break;
	case "thankyoupost": $new = "Ñïàñèáî çà âàøå ñîáûòèå, êîòîðîå âû ïîñëàëè."; break;
	case "till": $new = "äî"; break;
	case "Time added or updated": $new = "Âðåìÿ äîáàâëåíèÿ/îáíîâëåíèÿ"; break ;
	case "timeout msg": $new = "Èçìåíåíèÿ, ñäåëàííûå âî âðåìÿ ýòîé àâòîðèçàöèè, ñòàíóò ýôôåêòèâíûìè ïðè ñëåäóþùåé àâòîðèçàöèè" ; break ;
	case "times every": $new = "ïîâòîðÿòü êàæäûé(å)"; break;	
	case "To": $new = "äî"; break ;
	case "To delete category": $new = "Äëÿ óäàëåíèÿ êàòåãîðèè"; break ;
	case "Today": $new = "Ñåãîäíÿ"; break;
	case "Total": $new = "Âñåãî"; break;
	case "Total number of events for the month": $new = "Âñåãî ñîáûòèé çà ìåñÿö"; break ;
	case "Total number of events for user": $new = "Âñåãî êîëè÷åñòâî ñîáûòèé äëÿ ïîëüçîâàòåëÿ"; break ;		
	case "Total unapproved events for the month": $new = "Âñåãî íåîäîáðåííûõ ñîáûòèé çà ìåñÿö" ; break;
	case "Two weeks": $new = "Äâå íåäåëè" ; break;	

	case "Update": $new = "Îáíîâèòü"; break;
	case "Update Event": $new = "Îáíîâèòü Ñîáûòèå"; break;
	case "Updating category": $new = "Îáíîâèòü êàòåãîðèþ"; break ;
	case "Updating event": $new = "Îáíîâèòü ñîáûòèå"; break;
	case "Updating user": $new = "Îáíîâèòü ïîëüçîâàòåëÿ"; break;			
	case "Unapproved events": $new = "Íåîäîáðåííûå ñîáûòèÿ"; break ;
	case "User": $new = "Ïîëüçîâàòåëü"; break ;
	case "User Calendar": $new = "Êàëåíäàðü ïîëüçîâàòåëÿ"; break ;
	case "User description": $new = "Îïèñàíèå ïîëüçîâàòåëÿ"; break ;		
	case "User group": $new = "Ãðóïïà ïîëüçîâàòåëåé"; break ;				
	case "User Management": $new = "Óïðàâëåíèå ïîëüçîâàòåëÿìè"; break;
	case "userdelok": $new = "Âû äåéñòâèòåëüíî õîòèòå óäàëèòü ýòîãî ïîëüçîâàòåëÿ ?"; break;
	case "username": $new = "íèê"; break;
	case "Username entered already exists. Please use another username.": $new = "Ââåäåííûé ïîëüçîâàòåëü óæå ñóùåñòâóåò. Ïðîñèì ââåñòè äðóãîé íèê."; break;
	case "users": $new = "ïîëüçîâàòåëåé"; break;

	case "View": $new = "Ïðîñìîòð"; break;
	case "View categories in year": $new = "Ïðîñìîòð êàòåãîðèé â ãîäó"; break ;
	case "View details or edit": $new = "Ïðîñìîòðåòü äåòàëè èëè ðåäàêòèðîâàòü"; break ;
	case "View event": $new = "Ïðîñìîòð ñîáûòèÿ"; break;
	case "View events of user": $new = "Ïðîñìîòð ñîáûòèé äëÿ ïîëüçîâàòåëÿ"; break;
	case "View events under this category in year": $new = "Ïðîñìîòð ñîáûòèé äëÿ ýòîé êàòåãîðèè â ãîä"; break ;
	case "View historical events before": $new = "Ïðîñìîòð èñòîðè÷åñêèõ ñîáûòèé äî"; break ;
	case "View month": $new = "Ïðîñìîòð ìåñÿöà"; break;
	case "View week": $new = "Ïðîñìîòð íåäåëè"; break;

	case "Web Calendar Admin Login": $new = "Àâòîðèçàöèÿ àäìèíà"; break ;
	case "Web Calendar User Login": $new = "Àâòîðèçàöèÿ ïîëüçîâàòåëÿ"; break ;
	case "week number": $new = "íîìåð íåäåëè"; break;
	case "Week starts": $new = "Íåäåëÿ ñòàðòóåò ñ"; break;
	case "wronglogin": $new = "Íåâåðíî ââåäåí ëîãèí"; break;

	case "Year": $new = "Ãîä"; break;
	case "Yes, delete event !": $new = "Äà, óäàëèòå ñîáûòèÿ !"; break;
	case "Yes, delete it!": $new = "Äà, óäàëèòå èõ!"; break;

	default: $new = "<b>".$msgin."</b> íåîáõîäèìî ïåðåâåñòè !";    break;

    }
    return $new;
}
?>