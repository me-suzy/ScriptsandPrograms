<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "Om Calendarix"; break ;		
	case "Add": $new = "Lägg till"; break ;
	case "Add Category": $new = "Ny kategori"; break;
	case "Add Event": $new = "Ny händelse"; break;
	case "Add event": $new = "Lägg till" ; break;
	case "Add new user": $new = "Lägg till användare"; break;
	case "Adding category": $new = "Ny kategori"; break;
	case "Adding event": $new = "Lägger till" ; break ;
	case "Adding user": $new = "Lägger till användare"; break ;
	case "Administration": $new = "Admin"; break;
	case "Administrator": $new = "Admin"; break ;
	case "All categories": $new = "Alla kategorier"; break ;
	case "Approval needed for posting of events.": $new = "Du måste vara inloggad för att lägga till händelser."; break;  
	case "Approvals": $new = "Godkännande"; break ;
	case "Approve": $new = "Godkänn"; break;
	case "Approving event": $new = "Godkänner händelse"; break;

	case "Back": $new = "Tillbaka"; break;
	case "Both passwords entered do not match": $new = "Lösenorden var inte lika"; break;

	case "Calendar": $new = "Gå till kalendern utan att logga in"; break;
	case "Cancel": $new = "Avbryt"; break ;
	case "Cannot delete current login user": $new = "Kan inte ta bort en inloggad användare"; break ;
	case "Cannot change current login user": $new = "Kan inte ändra en inloggad användare"; break;
	case "Cannot have a category with blank name": $new = "Kategorin kan inte ha ett tomt namn"; break ;
	case "Categories": $new = "Kategorier"; break;
	case "Category": $new = "Kategori"; break;
	case "Change": $new = "Ändra"; break ;
	case "Change password/group": $new = "Ändra lösen/grupp"; break;
	case "Choose Category": $new = "Välj kategori"; break;
	case "Close": $new = "Stäng"; break;
	case "Confirm delete?": $new = "Bekräfta borttagning?" ; break ;
	case "Confirm delete all historical events before": $new = "Bekräfta borttagning av händelser före"; break ;
	case "confirmed events for today": $new = "bekräftade händelser idag"; break ;
	case "Confirm password": $new = "Bekräfta lösenord"; break;
	case "Copy Event": $new = "Kopiera händelsen"; break ;
	case "Current Week": $new = "Denna vecka"; break;
	case "Current Month": $new = "Denna månad"; break;
	case "Current Year": $new = "Detta år"; break;		

	case "Date": $new = "Datum"; break;
	case "Day": $new = "Dag"; break;
	case "Delete all historical events listed": $new = "Ta bort alla händelser i listan"; break;
	case "Delete category": $new = "Ta bort kategori"; break;
	case "Delete event": $new = "Ta bort händelse"; break;
	case "Delete user": $new = "Ta bort användare"; break;
	case "Deleting category": $new = "Tar bort kategori"; break;
	case "Deleting event": $new = "Tar bort händelse"; break ;
	case "Deleting user": $new = "Tar bort användare"; break ;
	case "disabled": $new = "Denna sektion är borttagen"; break;

	case "Edit category": $new = "Ändra kategori"; break;
	case "Edit event": $new = "Ändra händelse"; break;
	case "Email": $new = "E-post"; break;
	case "End Time": $new = "Sluttid"; break ;
	case "Event": $new = "Händelser"; break ;
	case "Event Category": $new = "Händelsens kategori"; break;
	case "Event Description": $new = "Händelsens beskrivning"; break;
	case "Event repeated": $new = "Repeterad händelse"; break;
	case "Event Title": $new = "Händelsens titel"; break;
	case "events": $new = "händelser"; break;
	case "Events added will be posted immediately.": $new = "Händelsen kommer att läggas till med en gång."; break ;
	case "events awaiting approval": $new = "händelser som väntar på godkännande"; break ;
	case "Events before": $new = "Händelser före"; break ;
	case "events for": $new = "händelser för"; break;
	case "Events for day": $new = "Händelser för dag"; break;
	case "events for whole calendar": $new = "händelser totalt"; break;
	case "events for year": $new = "st. händelser för"; break;
	case "Events from ": $new = "Händelser från"; break;
	case "Events in category": $new = "Händelser i kategorin"; break;

	case "From": $new = "Från"; break ;

	case "Go to": $new = "Gå till"; break;
	case "Go to day": $new = "Gå till dag"; break;
	case "Go to week": $new = "Gå till vecka"; break;

	case "Historical Items": $new = "Gamla händelser"; break;

	case "Login": $new = "Logga in"; break;
	case "Login session time out in seconds": $new = "Login-sessionens längd i sekunder"; break;
	case "Login session timeout": $new = "Login-session timeout"; break ;
	case "Logout": $new = "Logga ut"; break;

	case "Menu": $new = "Meny"; break;
	case "Month": $new = "Månad"; break;
	case "More info": $new = "Mer info"; break;

	case "Next": $new = "Nästa"; break;				
	case "Next day": $new = "Nästa dag"; break;
	case "Next week": $new = "Nästa vecka"; break;
	case "No categories yet": $new = "Inga kategorier ännu"; break;
	case "No events": $new = "Inga händelser"; break;
	case "No Repeat": $new = "Ingen upprepning"; break;
	case "No results": $new = "Inget resultat"; break;
	case "No, go back!": $new = "Nej, tillbaka!"; break;
	case "noadminapprove": $new = "Godkännande av händelser från admin behövs ej "; break ;
	case "noapprove": $new = "Godkännande av händelser från användare behövs ej av admin"; break ;
	case "nocat": $new = "Du måste välja en kategori!"; break;
	case "noday": $new = "Du måste välja en dag!"; break;
	case "nodescription": $new = "Du måste ge händelsen en beskrivning!"; break;
	case "nomonth": $new = "Du måste välja en månad!"; break;
	case "nonapproved": $new = "Händelser som måste godkännas: "; break;
	case "nononapproved": $new = "Inga händelser behöver godkännas nu"; break;
	case "notitle": $new = "Du måste ge händelsen en titel!"; break;
	case "noyear": $new = "Du måste välja ett år!"; break;

	case "on": $new = "den"; break;
	case "Optional": $new = "Frivilligt"; break;
	case "or month": $new = "eller månad"; break;
	case "or week": $new = "eller vecka"; break;

	case "password": $new = "lösenord"; break;
	case "Please choose the category you only want to view events for": $new = "Välj den kategori som du vill se händelser för "; break; 
	case "Popup Month": $new = "Popup Månad"; break ;
	case "Previous": $new = "Föregående"; break;			
	case "Previous day": $new = "Föregående dag"; break;
	case "Previous week": $new = "Föregående vecka"; break;

	case "Read more": $new = "Läs mer"; break;
	case "reallydelcat": $new = "Är du säker att du vill ta bort denna kategori, alla händelser i denna kategori kommer att försvinna!"; break;
	case "Repeat": $new = "Upprepa"; break;
	case "results": $new = "resultat"; break;

	case "search": $new = "sök"; break;
	case "Sort by": $new = "Sortera efter"; break ;
	case "Sort by date": $new = "Sortera efter datum"; break ;
	case "Sort by events": $new = "Sortera efter händelser"; break ;
	case "Start Time": $new = "Starttid"; break ;

	case "thankyou": $new = "Tack för ditt inlägg, det kommer upp efter godkännande av admin."; break;
	case "thankyoupost": $new = "Tack för inlägget, det kommer upp med en gång."; break;
	case "till": $new = "till"; break;
	case "Time added or updated": $new = "Tid ändrad el. tillagd"; break ;
	case "timeout msg": $new = "Ändringar i sessionstiden används först efter nästa inloggning" ; break ;
	case "times every": $new = "ggr varje"; break;
	case "To": $new = "Till"; break ;
	case "To delete category": $new = "För att ta bort kategori"; break ;
	case "Today": $new = "Idag"; break;
	case "Total": $new = "Totalt"; break;
	case "Total number of events for the month": $new = "Antal händelser för månaden"; break ;
	case "Total number of events for user": $new = "Antal händelser för användare"; break ;
	case "Total unapproved events for the month": $new = "Antal ej godkända händelser denna månad" ; break;
	case "Two weeks": $new = "Två veckor" ; break;	

	case "Update": $new = "Uppdatera"; break;
	case "Update Event": $new = "Uppdatera händelse"; break;
	case "Updating category": $new = "Uppdaterar kategori"; break ;
	case "Updating event": $new = "Uppdaterar händelser"; break;
	case "Updating user": $new = "Uppdaterar användare"; break;
	case "Unapproved events": $new = "Ej godkända händelser"; break ;
	case "User": $new = "Användare"; break ;
	case "User Calendar": $new = "Användarkalender"; break ;
	case "User description": $new = "Användarbeskrivning"; break ;
	case "User group": $new = "Användargrupp"; break ;
	case "User Management": $new = "Hantering av användare"; break;
	case "userdelok": $new = "Är du säker på att du vill ta bort denna användare?"; break;
	case "username": $new = "användarnamn"; break;
	case "Username entered already exists. Please use another username.": $new = "Användarnamnet finns redan, vg välj ett annat."; break;
	case "users": $new = "användare"; break;

	case "View": $new = "Visa"; break;
	case "View categories in year": $new = "Visa nya kategorier detta år"; break ;
	case "View details or edit": $new = "Visa eller ändra detaljer"; break ;
	case "View event": $new = "Visa händelse"; break;
	case "View events of user": $new = "Visa händelser för användare"; break;
	case "View events under this category in year": $new = "Visa händelser i kategorin för år"; break ;
	case "View historical events before": $new = "Visa händelser före"; break ;
	case "View month": $new = "Visa månad"; break;
	case "View week": $new = "Visa vecka"; break;

	case "Web Calendar Admin Login": $new = "Admin login"; break ;
	case "Web Calendar User Login": $new = "Användare login"; break ;
	case "week number": $new = "Veckonummer"; break;
	case "Week starts": $new = "Veckan börjar med"; break;
	case "wronglogin": $new = "Felaktigt användarnamn eller lösenord"; break;

	case "Year": $new = "År"; break;
	case "Yes, delete event !": $new = "Ja, ta bort denna händelse!"; break;
	case "Yes, delete it!": $new = "Ja, ta bort den!"; break;

	default: $new = "<b>".$msgin."</b> behöver översättas!";    break;

    }
    return $new;
}
?>