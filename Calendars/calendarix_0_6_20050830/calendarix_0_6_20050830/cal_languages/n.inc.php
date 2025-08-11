<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "Over Kalender"; break ;		
	case "Add": $new = "Toevoegen"; break ;
	case "Add Category": $new = "Categorie toevoegen"; break;
	case "Add Event": $new = "Evenement toevoegen"; break;
	case "Add event": $new = "Evenement toevoegen" ; break;
	case "Add new user": $new = "Nieuwe gebruiker toevoegen"; break;
	case "Adding category": $new = "Categorie: toevoeging in verwerking"; break;
	case "Adding event": $new = "Evenement: toevoeging in verwerking" ; break ;
	case "Adding user": $new = "Gebruiker: toevoeging in verwerking"; break ;
	case "Administration": $new = "Administratie"; break;
	case "Administrator": $new = "Hoofdgebruiker"; break ;
	case "All categories": $new = "All categories"; break ;		// translate?
	case "Approval needed for posting of events.": $new = "Toelating vereist om evenementen toe te voegen."; break ;
	case "Approvals": $new = "Toelatingen"; break ;
	case "Approve": $new = "Geef toestemming"; break;
	case "Approving event": $new = "Goedkeuring Evenement"; break;

	case "Back": $new = "Terug"; break;
	case "Both passwords entered do not match": $new = "Beide ingegeven paswoorden stemmen niet overéén"; break;	

	case "Calendar": $new = "Kalender"; break;
	case "Cancel": $new = "Afbreken"; break ;
	case "Cannot delete current login user": $new = "Kan login van huidige gebruiker niet verwijderen"; break ;   
	case "Cannot change current login user": $new = "Kan login van huidige gebruiker niet wijzigen"; break;	
	case "Cannot have a category with blank name": $new = "Categorie mag niet blanco zijn"; break ;
	case "Categories": $new = "Categorie"; break;
	case "Category": $new = "Categorie"; break;
	case "Change": $new = "Wijzig"; break ;
	case "Change password/group": $new = "Wijzig wachtwoord/groep"; break; 		
	case "Choose Category": $new = "Kies Categorie"; break;
	case "Close": $new = "Sluit"; break;
	case "Confirm delete?": $new = "Bevestig verwijderen" ; break ;			
	case "Confirm delete all historical events before": $new = "Bevestig verwijderen van alle vervallen evenementen"; break ;
	case "confirmed events for today": $new = "Bevestigde evenementen voor vandaag"; break ;
	case "Confirm password": $new = "Bevestig wachtwoord"; break; 		
	case "Copy Event": $new = "Kopieer evenement"; break ;
	case "Current Week": $new = "Huidige week"; break;
	case "Current Month": $new = "Huidige maand"; break;
	case "Current Year": $new = "Huidig jaar"; break;

	case "Date": $new = "Datum"; break;
	case "Day": $new = "Dag"; break;
	case "Delete all historical events listed": $new = "Wis alle weergegeven, verlopen evenementen"; break;
	case "Delete category": $new = "Verwijder categorie"; break;
	case "Delete event": $new = "Verwijder evenement"; break;
	case "Delete user": $new = "Verwijder gebruiker"; break;
	case "Deleting category": $new = "Categorie aan het verwijderen"; break;
	case "Deleting event": $new = "Evenement aan het verwijderen"; break ;
	case "Deleting user": $new = "Gebruiker aan het verwijderen"; break ;
	case "disabled": $new = "Dit onderdeel is niet toegankelijk"; break;

	case "Edit category": $new = "Wijzig categorie"; break;
	case "Edit event": $new = "Wijzig evenement"; break;
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Eindtijd"; break ;
	case "Event": $new = "Evenement"; break ;
	case "Event Category": $new = "Evenement categorie"; break;
	case "Event Description": $new = "Evenementomschrijving"; break;
	case "Event repeated": $new = "Evenement herhaald"; break;  
	case "Event Title": $new = "Titel van het evenement"; break;
	case "events": $new = "evenement"; break;
	case "Events added will be posted immediately.": $new = "Toegevoegde evenementen worden onmiddelijk weergegeven."; break ;
	case "events awaiting approval": $new = "Evenementen die nog dienen goedgekeurd te worden"; break ;
	case "Events before": $new = "Verlopen evenementen"; break ;
	case "events for": $new = "Evenementen voor"; break;
	case "Events for day": $new = "Evenementen voor dag"; break;
	case "events for whole calendar": $new = "Evenementen voor de gehele kalender"; break;
	case "events for year": $new = "Evenementen voor jaar"; break;

	case "Events from ": $new = "Evenementen van "; break;
	case "Events in category": $new = "Evenementen per categorie"; break;

	case "From": $new = "Van"; break ;

	case "Go to": $new = "Ga naar"; break;
	case "Go to day": $new = "Ga naar dag"; break;
	case "Go to week": $new = "Ga naar week"; break;

	case "Historical Items": $new = "Verlopen items"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Aantal seconden, waarna de gebruiker uitgelogd wordt"; break;
	case "Login session timeout": $new = "Login sessie verlopen"; break ;
	case "Logout": $new = "Afmelden"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Maand"; break;
	case "More info": $new = "Meer info"; break;

	case "Next": $new = "Volgende"; break;				
	case "Next day": $new = "Volgende dag"; break;
	case "Next week": $new = "Volgende week"; break;
	case "No categories yet": $new = "Geen categorie op dit moment"; break;
	case "No events": $new = "Geen evenementen"; break;
	case "No Repeat": $new = "Geen herhaling"; break;
	case "No results": $new = "Geen resultaten"; break;
	case "No, go back!": $new = "Nee, ga terug!"; break;
	case "noadminapprove": $new = "Goedkeuring evenementen niet vereist voor de hoofdgebruiker zelf"; break ;
	case "noapprove": $new = "Goedkeuring van evenementen,door gebruikers toegevoegd, niet vereist voor hoofdgebruiker"; break ;
	case "nocat": $new = "Gelieve een categorie te selecteren !"; break;
	case "noday": $new = "Gelieve een dag te selecteren !"; break;
	case "nodescription": $new = "Gelieve een evenementomschrijving in te geven!"; break;
	case "nomonth": $new = "Gelieve een maand te selecteren !"; break;
	case "nonapproved": $new = "Evenementen die een goedkeuring vereisen : "; break;
	case "nononapproved": $new = "Op dit ogenblik zijn er geen evenementen die een goedkeuring vereisen "; break;
	case "notitle": $new = "Gelieve een titel voor deze evenement op te geven !"; break;
	case "noyear": $new = "Gelieve een jaartal op te geven !"; break;

	case "on": $new = "aan"; break;
	case "Optional": $new = "Optioneel"; break;
	case "or month": $new = "of maand"; break;
	case "or week": $new = "of week"; break;

	case "password": $new = "wachtwoord"; break;
	case "Please choose the category you only want to view events for": $new = "Kies de categorie waarvan de evenementen alleen zichtbaar van moeten zijn"; break;  
	case "Popup Month": $new = "Popup Maand"; break ;
	case "Previous": $new = "Vorige"; break;			
	case "Previous day": $new = "Vorige dag"; break;
	case "Previous week": $new = "Vorige week"; break;

	case "Read more": $new = "Meer info"; break;
	case "reallydelcat": $new = "Weet u het zeker dat u deze categorie wilt verwijderen? Alle evenementen gekoppeld aan deze categorie zullen definitief verwijderd worden !"; break;

	case "Repeat": $new = "Herhaal"; break;
	case "results": $new = "resultaten"; break;

	case "search": $new = "zoek"; break;
	case "Sort by": $new = "Sorteer op"; break ;
	case "Sort by date": $new = "Sorteer op datum"; break ;
	case "Sort by events": $new = "Sorteer op evenementen"; break ;
	case "Start Time": $new = "Begin uur"; break ;

	case "thankyou": $new = "Dank u voor het toevoegen van deze evenement, ze zal toegevoegd worden na goedkeuring."; break;
	case "thankyoupost": $new = "Dank u voor het toevoegen van een evenement, ze is toegevoegd in de agenda."; break;
	case "till": $new = "tot"; break;
	case "Time added or updated": $new = "Tijd toegevoegd of aangepast"; break ;
	case "timeout msg": $new = "Aanpassingen gedurende de timeout-sessie worden pas effectief na de volgende login" ; break ;
	case "times every": $new = "tijden allemaal"; break;	
	case "To": $new = "Naar"; break ;
	case "To delete category": $new = "Om een categorie te verwijderen"; break ;
	case "Today": $new = "Vandaag"; break;
	case "Total": $new = "Totaal"; break;
	case "Total number of events for the month": $new = "Totaal aantal evenementen voor de maand"; break ;
	case "Total number of events for user": $new = "Totaal aantal evenementen door deze gebruiker ingevoerd"; break ;
	case "Total unapproved events for the month": $new = "Totaal aantal niet goedgekeurde evenementen voor de maand" ; break;
	case "Two weeks": $new = "Twee wekelijks"; break;

	case "Update": $new = "Aanpassing"; break;
	case "Update Event": $new = "Aanpassing evenement"; break;
	case "Updating category": $new = "Aanpassing  categorie"; break ;
	case "Updating event": $new = "Aanpassing evenement"; break;
	case "Updating user": $new = "Aanpassing gebruiker"; break;			
	case "Unapproved events": $new = "Niet goedgekeurde evenementen"; break ;
	case "User": $new = "Gebruiker"; break ;
	case "User Calendar": $new = "Gebruiker kalender"; break ;
	case "User description": $new = "Gebruiker beschrijving"; break ;		
	case "User Management": $new = "Gebruikersbeheer"; break;
	case "User group": $new = "Gebruikersgroep"; break ;				
	case "userdelok": $new = "Bent u zeker dat u deze gebruiker wenst te verwijderen ?"; break;
	case "username": $new = "Gebruikersnaam"; break;
	case "Username entered already exists. Please use another username.": $new = "Ingevoerde gebruikersnaam bestaat reeds. Gelieve een andere gebruikersnaam te kiezen."; break;
	case "users": $new = "gebruikers"; break;

	case "View": $new = "Bekijk"; break;
	case "View categories in year": $new = "Bekijk de categorien van het jaar"; break ;
	case "View details or edit": $new = "Bekijk details of wijzig"; break ;
	case "View event": $new = "Bekijk evenement"; break;
	case "View events of user": $new = "Bekijk de ingevoerde evenementen van deze gebruiker"; break;
	case "View events under this category in year": $new = "Bekijk evenementen in deze categorie voor het jaar"; break ;
	case "View historical events before": $new = "Bekijk verlopen evenementen voor"; break ;
	case "View month": $new = "Bekijk maand"; break;
	case "View week": $new = "Bekijk week"; break;

	case "Web Calendar Admin Login": $new = "Login Hoofdgebruiker"; break ;
	case "Web Calendar User Login": $new = "Login Gebruiker"; break ;
	case "week number": $new = "week nummer"; break;
	case "Week starts": $new = "Week begint"; break;
	case "wronglogin": $new = "Foutieve gebruikersnaam of foutief wachtwoord"; break;

	case "Year": $new = "Jaar"; break;
	case "Yes, delete event !": $new = "Ja, verwijder evenement !"; break;
	case "Yes, delete it!": $new = "Ja, verwijder het!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>