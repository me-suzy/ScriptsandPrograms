<?php

$para = array();

$para['integrator::header'] = <<<_P
SiteBar on suunniteltu standardien mukaan ja sen pitäisi toimia
useimmilla selaimilla, joissa on javascript ja evästeet sallittu.
Seuraavassa taulukossa on testatut selaimet.
_P;

$para['integrator::hint_popup'] = <<<_P
Jos selaimesi ei tue "sidebar":a voit käyttää tätä bookmarkelttiä. 
Se avaa SiteBarin pop-up -ikkunassa. Muistathan, että selaimessasi saattaa
olla ponnahdusikkunoiden esto päällä!
_P;

$para['command::noiconv'] = <<<_P
<br>
Koodisivun muuntoa ei ole asennettu tähän SiteBar -palveluun
<br>
_P;

$para['command::security_legend'] = <<<_P
Oikeudet: <strong>R</strong>ead = Lukea, <strong>A</strong>dd = Lisätä, <strong>M</strong>odify = Muokata, <strong>D</strong>elete = poistaa, <strong>P</strong>urge = tyhjentää, <strong>G</strong>rant = vahvistaa
_P;

$para['command::purge_cache'] = <<<_P
<h3>Haluatko varmasti poistaa kaikkia faviconit välimuistista?</h3>
_P;

$para['usermanager::signup_info'] = <<<_P
Uusi käyttäjä "%s" <%s> on lisätty SiteBar -sivustoon: %s.
_P;

?>
