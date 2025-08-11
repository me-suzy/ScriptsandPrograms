<?php
/***************************************************************************
 *   language/francais.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 *   IMPORTANT NOTE: if you ever happen to translate this file to a foreign
 *   language which is not included in the e-moBLOG releases yet, I would
 *   be very glad if you could send it to me along with your name and
 *   website URL, such as I can add it to the official e-moBLOG releases
 *   language files (credits with your name & website URL will be
 *   mentionned, of course). Thank you very much.
 *
 ***************************************************************************/

 
// installation
$lang['i_confirm'] = "<b>ceci va installer e-moBLOG sur votre serveur.</b><br />soyez sûrs d'avoir bien édité le fichier /includes/db.php avant<br />comme indiqué dans le fichier \"how-to.txt\".";
$lang['i_proceed'] = "continuer";
$lang['i_cancel'] = "si vous ne voulez pas continuer, veuillez simplement fermer cette fenêtre.";
$lang['i_done'] = "félicitations, l'installation est terminée.<br />merci d'avoir choisi e-moBLOG!<br /><br />tenez-vous au courant des mises à jours:";
$lang['i_link'] = "http://www.e-motionalis.net";
$lang['i_admin'] = "vous pouvez maintenant accéder à votre panneau de contrôle à l'adresse suivante:";

// configuration
$lang['c_loginoptions'] = "informations d'accès administrateur";
$lang['c_general'] = "configuration générale";
$lang['c_options'] = "options diverses";
$lang['c_login'] = "nom d'utilisateur:";
$lang['c_password'] = "mot de passe:";
$lang['c_confirmpass'] = "confirmation du mot de passe:";
$lang['c_bname'] = "nom du blog:";
$lang['c_bname_desc'] = "ceci est le nom de votre blog - il apparaîtra dans la barre de titre du navigateur.";
$lang['c_burl'] = "URL du blog:";
$lang['c_burl_desc'] = "ceci est l'URL complète de votre blog, avec le slash de fin - le fichier index.php doit se trouver à cette URL - exemple: http://www.mondomaine.com/monaccompte/blog/";
$lang['c_aname'] = "nom du propriétaire:";
$lang['c_aname_desc'] = "ceci est le nom du propriétaire de ce blog.";
$lang['c_aemail'] = "e-mail du propriétaire:";
$lang['c_aemail_desc'] = "ceci est l'adresse e-mail du propriétaire de ce blog - c'est également l'adresse à laquelle les commentaires seront envoyés s'il n'y a qu'un auteur à ce blog et si vous choisissez de recevoir les commentaires des visiteurs par e-mail (voir les options plus bas).";
$lang['c_bdesc'] = "description du blog:";
$lang['c_bdesc_desc'] = "ceci est la description de ce blog telle qu'elle apparaîtra dans les meta-tags (et donc dans les moteurs de recherche).";
$lang['c_bkeys'] = "mots clés du blog:";
$lang['c_bkeys_desc'] = "mettez ici les mots clés de votre blog tels qu'ils seront utilisés par les moteurs de recherche - separez chaque mot par une virgule.";
$lang['c_comments'] = "système de commentaire:";
$lang['c_comments_desc'] = "détermine la manière dont les commentaires seront traités (defaut = sur la page).";
$lang['c_center'] = "alignement du blog:";
$lang['c_center_desc'] = "ceci détermine si votre blog est aligné à gauche ou centré (defaut = à gauche).";
$lang['c_center_0'] = "à gauche";
$lang['c_center_1'] = "centré";
$lang['c_poster'] = "auteurs multiples:";
$lang['c_poster_desc'] = "détermine si vous êtes le seul auteur de ce blog ou s'il y en a plusieurs (defaut = auteur unique).";
$lang['c_smileys'] = "smileys:";
$lang['c_smileys_desc'] = "détermine la manière de traiter les smileys dans les messages (articles et commentaires), si l'option \"sur la page\" est choisie (defaut = standard).";
$lang['c_language'] = "langue:";
$lang['c_language_desc'] = "détermine la langue de ce blog (defaut = english).";
$lang['c_limit'] = "limite du nombre d'articles:";
$lang['c_limit_desc'] = "entrez un nombre si vous souhaitez limiter le nombre d'articles affichés sur le blog - par exemple, si vous réglez cette option sur 3, la page principale du blog n'affichera que les 3 derniers articles postés, tous les autres étant disponibles via les archives - réglez ceci à 0 si vous désirez afficher tous les articles postés pour le mois en cours (defaut = 0).";
$lang['c_maxwidth'] = "largeur:";
$lang['c_maxwidth_desc'] = "détermine la largeur de ce blog - la valeur par défaut est 400, ce qui signifie 400 pixels de large (defaut = 400 / minimum = 270).";
$lang['c_servertime'] = "décallage du serveur:";
$lang['c_servertime_desc'] = "réglez ceci sur le décalage horaire de votre serveur par rapport à votre situation géographique si vous voulez que les dates et heures soient affichées correctement - par exemple, si votre serveur est à NY et que vous habitez à Paris, la valeur de décalage est -06 (au contraire, si vous habitez à NY et que votre serveur se situe à Paris, le décalage horaire du serveur sera de +06 - n'oubliez pas le signe - ou +, c'est important!).";
$lang['c_setbutton'] = "appliquer";
$lang['c_cancelbutton'] = "annuler";
$lang['c_comments_0'] = "sans";
$lang['c_comments_1'] = "sur la page";
$lang['c_comments_2'] = "envoyés par mail";
$lang['c_smileys_0'] = "standard";
$lang['c_smileys_1'] = "images";
$lang['c_smileys_2'] = "sans smileys";
$lang['c_poster_0'] = "auteur unique";
$lang['c_poster_1'] = "auteurs multiples";
$lang['c_moblogging'] = "options mobile blogging";
$lang['c_moblogging_state'] = "mobile blogging";
$lang['c_moblogging_desc'] = "le mobile blogging vous permets de poster un message sur votre blog depuis un périphérique portable, tel un téléphone portable ou un PocketPC. Le principe consiste à envoyer un message de votre périphérique portable vers une adresse e-mail dont les nouveaux messages vont être vérifiés par le système e-moBLOG. Notez que ceci pourrait ralentir quelque peu votre blog de temps à autre, selon la vitesse de réponse du serveur mail où se trouve l'adresse à vérifier. Veuillez lire le fichier HOW-TO.txt *très attentivement* avant d'utiliser cette option (defaut = désactivé).";
$lang['c_moblogging_0'] = "désactivé";
$lang['c_moblogging_1'] = "activé";
$lang['c_mserver'] = "serveur e-mail";
$lang['c_mserver_desc'] = "ceci est l'adresse du serveur mail à utiliser pour le mobile blogging. Attention, vous devez utiliser une adresse e-mail qui ne servira *que* au mobile blogging, car tout message envoyé à cette adresse sera vérifié, affiché sur le blog, et définitivement effacé du serveur.";
$lang['c_mport'] = "port du serveur e-mail";
$lang['c_mport_desc'] = "ceci est le port de connexion au serveur mail précisé ci-dessus (defaut = 110).";
$lang['c_mtype'] = "type de boite e-mail";
$lang['c_mtype_0'] = "pop3";
$lang['c_mtype_1'] = "imap";
$lang['c_mtype_desc'] = "ceci est le type de boite e-mail utilisé. Si votre boite mail ne supporte aucun de ces deux protocoles, le mobile blogging ne marchera pas (defaut = pop3).";
$lang['c_mlogin'] = "nom d'utilisateur de la boite e-mail";
$lang['c_mlogin_desc'] = "ceci est le nom d'utilisateur complet nécessaire pour la connexion à votre boite mail dédiée au mobile blogging.";
$lang['c_mpassword'] = "mot de passe de la boite e-mail";
$lang['c_mpassword_desc'] = "ceci est le mot de passe à utiliser pour la connexion à votre boite mail dédiée au mobile blogging.";
$lang['c_resize'] = "redimensionnement automatique";
$lang['c_resize_desc'] = "determine si les images seront redimensionnées automatiquement ou pas. Réglez ceci à \"activé\" si vous voulez que toutes les images contenues dans vos articles soient rétrécies à la largeur maximum de votre blog (valeur spécifée ci-dessous) lorsqu'elles dépassent cette valeur (defaut = activé).";
$lang['c_absolute'] = "chemin absolu du blog";
$lang['c_absolute_desc'] = "ceci est le chemin absolu du répertoire source de votre blog. Veillez à include le signe \"/\" à la fin. (par ex.  /home/votredomaine/public_html/votreblog/  -ceci est un exemple, si vous n'êtes pas sûr, demandez ce renseignement à votre administrateur système ou à votre support technique).";

// admin pages
$lang['a_name'] = "nom de l'auteur:";
$lang['a_email'] = "e-mail de l'auteur:";
$lang['a_title'] = "titre de l'article:";
$lang['a_content'] = "contenu:";
$lang['a_audio'] = "chanson du jour:";
$lang['a_quote'] = "citation du jour:";
$lang['a_postbutton'] = "ajouter";
$lang['a_updatebutton'] = "mettre à jour";
$lang['a_clearbutton'] = "effacer";
$lang['a_addpost'] = "ajouter un article";
$lang['a_modtodaypost'] = "ajouter au dernier article";
$lang['a_editpost'] = "modifier un article";
$lang['a_config'] = "options";
$lang['a_addline'] = "ligne";
$lang['a_postsfrom'] = "articles de";
$lang['a_delete'] = "effacer";
$lang['a_edit'] = "modifier";
$lang['a_delconfirm'] = "voulez-vous vraiment effacer cet article?";
$lang['a_delcommconfirm'] = "voulez-vous vraiment effacer ce commentaire?";
$lang['a_logout'] = "déconnexion";
$lang['a_ccontent'] = "commentaire";
$lang['a_editcomment'] = "modifier commentaire";
$lang['a_updatecbutton'] = "modifier";
$lang['a_addimage'] = "ajouter/modifier image";
$lang['a_url'] = "url de l'image";
$lang['a_descr'] = "description";
$lang['a_delimgconfirm'] = "voulez-vous vraiment effacer cette image?";
$lang['saveimages'] = "ajout des images dans la gallerie?";

// mots à usage général
$lang['top'] = "haut";
$lang['link'] = "lier cet article";
$lang['index'] = "index";
$lang['required'] = "note: les champs marqués d'une * sont obligatoires.";
$lang['no_posts'] = "il n'y a encore aucun article ce mois-ci.";
$lang['rss'] = "rss";
$lang['search'] = "recherche";
$lang['search_posts'] = "chercher dans les articles";
$lang['numpages'] = "il y a d'autres articles trouvés:";
$lang['page'] = "page";
$lang['gallery'] = "gallerie";
$lang['frompost'] = "provenant de";
$lang['no_images'] = "il n'y a pas d'images.";
$lang['numimages'] = "triées par date - plus d'images:";
$lang['noresults'] = "aucun article trouvé.";
$lang['visitor'] = "personne égarée sur ce blog";
$lang['visitors'] = "personnes lisant ce blog";
$lang['powered'] = "powered by";

// commentaires
$lang['comment'] = "commentaire";
$lang['comments'] = "commentaires";
$lang['posted_by'] = "posté par";
$lang['no_comments'] = "il n'y a encore aucun commentaire sur cet article.";
$lang['post'] = "POSTER UN COMMENTAIRE";
$lang['uname'] = "votre nom";
$lang['uemail'] = "votre e-mail";
$lang['ucomment'] = "votre commentaire";
$lang['post_button'] = "poster";
$lang['clear_button'] = "effacer";
$lang['postip'] = "IP";
$lang['delcomm'] = "effacer ce commentaire";

// erreurs
$lang['error'] = "erreur: ";
$lang['pic_format'] = "format non-supporté.";
$lang['pic_gif'] = "format GIF non supporté.";
$lang['field_error'] = "veuillez remplir les champs nom et commentaire.";
$lang['field2_error'] = "veuillez compléter tous les champs.";
$lang['pass_error'] = "les mots de passe entrés ne correspondent pas.";
$lang['email_error'] = "veuillez entrer une adresse e-mail valide.";

// confirmations
$lang['add_status'] = "<b>le nouveau message a été ajouté.</b>";
$lang['mod_status'] = "<b>le message a été modifié.</b>";
$lang['del_status'] = "<b>le message a été effacé.</b>";
$lang['delcomm_status'] = "<b>le commentaire a été effacé.</b>";
$lang['conf_status'] = "<b>la configuration a été mise à jour.</b>";
$lang['modc_status'] = "<b>le commentaire a été modifié.</b>";

// commentaires envoyés par mail
$lang['mailcomment'] = "envoyer un commentaire";
$lang['mailsubject'] = "[commentaire envoyé par e-moBLOG]";
$lang['mailfrom'] = "envoyé par";
$lang['mailaddress'] = "adresse e-mail";
$lang['mailarticle'] = "concernant l'article";
$lang['email_sent'] = "votre commentaire a été envoyé. merci!";

// archives
$lang['archives'] = "archives";
$lang['archivesfrom'] = "archives de";
$lang['links'] = "archives des liens";
$lang['all_links'] = "tous les liens postés";
$lang['no_links'] = "il n'y a encore aucun lien posté ce mois-ci.";

// aide
$lang['help'] = "aide";
$lang['helpfile1'] = " Vous <b>devez</b> au moins remplir les champs nom et commentaire. Le champ e-mail n'est pas obligatoire.";
$lang['helpfile2'] = " Les balises HTML ne sont pas acceptées, mais vous pouvez utiliser certaines balises UBB.";
$lang['helpfile3'] = " Voici une liste des balises UBB qui peuvent être utilisées, avec leur fonctionnement:";
$lang['help_bius'] = "les balises [b] [i] [s] et [u] peuvent être respectivement utilisées pour mettre un texte ou une portion de celui-ci en <b>gras</b>, <i>italique</i>, <s>barré</s> et <u>souligné</u>.<br /> Exemple: [b]<b>texte en gras</b>[/b]";
$lang['help_center'] = "la balise [center] peut être utilisée pour centrer un texte ou une image sur le blog.<br /> Exemple: [center]votre texte ou image[/center]";
$lang['help_url'] = "la balise [url=...] peut être utilisée pour faire un lien vers une URL.<br /> Exemple: [url=http://www.mondomaine.com]ceci est un lien[/url] (Voir la note plus bas)";
$lang['help_img'] = "la balise [img] peut être utilisée pour afficher une image dans votre commentaire. Les formats d'image valides sont le JPG et le PNG. Le format GIF n'est <b>pas</b> supporté et ne sera pas affiché.<br /> Exemple: [img]http://www.mondomaine.com/monimage.jpg[/img]";
$lang['help_note'] = " <u>Note:</u> Toute adresse e-mail ou URL que vous écrivez dans votre commentaire sera automatiquement formatée en un lien vers cette même adresse e-mail ou URL. Vous ne devez employer aucune balise pour cela. Veuillez aussi ne pas utiliser de caractères d'espacement dans les URL."; 

// admin help
$lang['a_help'] = "aide";
$lang['a_helpfile1'] = " Les champs obligatoires sont toujours marqués d'une *";
$lang['a_helpfile2'] = " Les balises HTML ne sont pas acceptées, mais vous pouvez utiliser certaines balises UBB.";
$lang['a_helpfile3'] = " Voici une liste des balises UBB qui peuvent être utilisées, avec leur fonctionnement:";
$lang['a_help_bius'] = "les balises [b] [i] [s] et [u] peuvent être respectivement utilisées pour mettre un texte ou une portion de celui-ci en <b>gras</b>, <i>italique</i>, <s>barré</s> et <u>souligné</u>.<br /> Exemple: [b]<b>texte en gras</b>[/b]";
$lang['a_help_center'] = "la balise [center] peut être utilisée pour centrer un texte ou une image sur le blog.<br /> Exemple: [center]votre texte ou image[/center]";
$lang['a_help_url'] = "la balise [url=...] peut être utilisée pour faire un lien vers une URL.<br /> Exemple: [url=http://www.mondomaine.com]ceci est un lien[/url] (Voir la note plus bas)";
$lang['a_help_img'] = "la balise [img] peut être utilisée pour afficher une image dans votre commentaire. Les formats d'image valides sont le JPG et le PNG. Le format GIF n'est <b>pas</b> supporté et ne sera pas affiché. Veuillez noter que les images plus larges que la largeur maximale spécifiée dans la configuration de ce blog seront automatiquement redimensionnées, mais ceci peut nécessiter beaucoup de ressources au niveau du serveur, c'est pourquoi nous vous recommandons de redimensioner vous-même vos images autant que possible, avant de les poster.<br /> Exemple: [img]http://www.mondomaine.com/monimage.jpg[/img]<br /> Example: [img]http://www.mydomain.com/mypicture.jpg[/img]<br /><br />Vous pouvez également aligner l'image à droite ou à gauche de votre texte en utilisant les balises [img left] ou [img right] au lieu de simplement [img]. Notez que si l'option d'auto-redimensionnement des images est activée et que vous postez une image plus large que la largeur maximale du blog, il est préférable d'utiliser la balise [img].";
$lang['a_help_note'] = " <u>Note:</u> Toute adresse e-mail ou URL que vous écrivez dans votre commentaire sera automatiquement formatée en un lien vers cette même adresse e-mail ou URL. Vous ne devez employer aucune balise pour cela. Veuillez aussi ne pas utiliser de caractères d'espacement dans les URL.";

// abréviations des mois de l'année
$lang['jan'] = "jan";
$lang['feb'] = "fev";
$lang['mar'] = "mar";
$lang['apr'] = "avr";
$lang['may'] = "mai";
$lang['june'] = "juin";
$lang['july'] = "juil";
$lang['aug'] = "août";
$lang['sep'] = "sep";
$lang['oct'] = "oct";
$lang['nov'] = "nov";
$lang['dec'] = "déc";

// noms complets des mois de l'année
$lang['jan1'] = "janvier";
$lang['feb1'] = "février";
$lang['mar1'] = "mars";
$lang['apr1'] = "avril";
$lang['may1'] = "mai";
$lang['june1'] = "juin";
$lang['july1'] = "juillet";
$lang['aug1'] = "aoüt";
$lang['sep1'] = "septembre";
$lang['oct1'] = "octobre";
$lang['nov1'] = "novembre";
$lang['dec1'] = "décembre";
?>