<?php

$para = array();

$para['integrator::header'] = <<<_P
A SiteBar-t az aktuális szabványokat figyelembe véve terveztük, 
így a legtöbb böngészővel együttműködik, amennyiben a javascript 
és a sütik engedélyezve vannak. A következő táblázatban olvasható, 
hogy mely böngészőkkel teszteltük a SiteBar-t. 
_P;

$para['command::tooltip_private'] = <<<_P
A magáncélú hivatkozásokat nem exportálja. A magáncélú linkeket minden esetben csak tulajdonosuk exportálhatja.
_P;

$para['command::tooltip_subdir'] = <<<_P
Minden hivatkozás és mappa rekurzív kivitele.
_P;

$para['hook::statistics'] = <<<_P
{roots_total} gyökérmappa.
{nodes_shown}/{nodes_total} mappa. 
{links_shown}/{links_total} hivatkozás.
{users} felhasználó.
{groups} csoport. 
{queries} SQL lekérdezés.
Adabázis/Összes idő {time_db}/{time_total} mp ({time_pct}%).
_P;

?>
