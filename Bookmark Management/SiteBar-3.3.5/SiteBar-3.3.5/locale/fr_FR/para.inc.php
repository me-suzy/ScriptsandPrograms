<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Bienvenue sur la page d'intégration de SiteBar. Cette page vous permet d'exploiter SiteBar au maximum. Sur la <a href="http://sitebar.org/">page d'accueil de SiteBar</a> vous pourrez découvrir plus en détail toutes les fonctionnalités de SiteBar.
_P;

$para['integrator::header'] = <<<_P
SiteBar a été conçu pour respecter les standards et devrait fonctionner sur la majorité des navigateurs supportant le javascript et les cookies. La table suivante vous indique sur quels navigateurs SiteBar a été testé.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar utilise le clic droit pour ouvrir le menu contextuel des liens et dossiers.
En tant qu'utilisateur d'Opera vous devez activer les "icônes du menu" dans vos préférences SiteBar
et cliquer sur l'icône à coté des liens et répertoires pour ouvrir les menus contextuels. Opera ne
supporte pas <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Il est recommandé de désactiver
l'utilisation de XSLT dans les préférences SiteBar.
_P;

$para['integrator::hint'] = <<<_P
Cliquez sur le lien du navigateur de votre choix ci-dessus pour voir les instructions d'intégration.
Veuillez <a href="http://brablc.com/mailto?o">nous contacter</a> si vous avez pu tester d'autres
navigateurs/systèmes avec succès.
_P;

$para['integrator::hint_window'] = <<<_P
Ceci est un lien ordinaire qui ouvrira SiteBar dans la fenêtre courante. SiteBar a été conçu pour une fenêtre verticale et plutôt étroite. L'ouvrir de cette manière pourrait donc faire perdre de la place.
_P;

$para['integrator::hint_dir'] = <<<_P
En plus de l'affichage sous forme de hiérarchie, SiteBar peut être affiché sous la forme d'un répertoire traditionnel. Cette vue montre un répertoire à la fois ainsi que les détails de chaque lien affiché. Votre navigateur doit supporter <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Si votre navigateur n'offre pas le support de panneau latéral dans lequel SiteBar puisse être intégré, vous devriez utiliser ce bookmarklet*. Il vous permettra d'ouvrir SiteBar dans une fenêtre pop-up similaire à un panneau latéral. Sachez toutefois que votre navigateur pourrait bloquer les fenêtres pop-up!
_P;

$para['integrator::hint_addpage'] = <<<_P
Ce bookmarklet* peut être utilisé pour ajouter des liens à votre SiteBar. Lorsqu'il est lancé, une nouvelle fenêtre pop-up apparaît, pré-remplie avec les détails de la page courante.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
* Un <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> est un marque-page/favori qui contient du code JavaScript.
Vous pouvez cliquer dessus avec le bouton droit pour l'ajouter à votre barre de favoris. Plus tard lorsque vous cliquerez sur le favori, le code JavaScript sera exécuté.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Ajoute la recherche de favoris SiteBar dans le champ de recherche Web. Permet de rechercher dans les favoris SiteBar sans avoir à ouvrir une vue de SiteBar.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Extension développée spécialement pour SiteBar.
Permet d'ouvrir tous les liens d'un dossier dans des onglets ainsi que d'autres fonctionnalités.
Utilisez le menu Affichage/Barre d'outils/Personnaliser pour placer l'icône SiteBar dans votre barre d'outils.
[<a href="http://sitebarsidebar.mozdev.org/">Page du Projet</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Crée un favori qui peut être utilisé pour ouvrir SiteBar dans un panneau latéral du navigateur.
_P;

$para['integrator::hint_booksync'] = <<<_P
Téléchargez l'extension Bookmarks Synchronizer. Redémarrez Firefox, puis ouvrez le menu Outils/Extensions.
Dans les options de l'extension, sélectionnez <strong>HTTP</strong> comme protocole de fichier distant, précisez le nom
de serveur <strong>%s</strong> et le chemin <strong>%s</strong> . Pour l'instant il n'y a que la synchronisation SiteBar->Firefox
qui soit possible.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Téléchargez la structure de dossiers de tout votre SiteBar dans un fichier. Importez ce fichier dans vos favoris.
Chaque dossier est représenté par un favori dynamique. De cette manière vos favoris SiteBar seront intégrés parmis les autres,
à la différence que le contenu des dossiers sera téléchargé de manière dynamique à partir de votre SiteBar. Si
un dossier dynamique contient des sous-dossiers, son contenu sera affiché dans @Content.

_P;

$para['integrator::hint_mozlinker'] = <<<_P
Téléchargez et installez cette <a href="http://sourceforge.net/projects/mozlinker/">extension</a> (attention, il n'est
pas possible de la désinstaller). Un nouveau menu "MozLinker" apparaît dans le navigateur. Utilisez le sous-menu "Config..."
et ajoutez soit un nouveau menu, soit une nouvelle barre d'outils puis configurez la "Resource URL" avec l'URL du lien
"Extension MozLinker" ci contre.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Ajoute SiteBar dans le panneau latéral. Ce panneau peut être affiché/caché avec F9. Si le temps chargement de
SiteBar dans le panneau dépasse une certaine durée, son affichage échoue dans Mozilla. Il est recommandé
d'afficher SiteBar dans la fenêtre principale pour permettre aux images (favicons) d'être mises dans le cache
du navigateur ou alors de désactiver l'affichage des favicons via les paramètres utilisateur.
_P;

$para['integrator::hint_hotlist'] = <<<_P
Un lien vers SiteBar sera installé dans la barre d'outils rapide. Si vous cliquez sur ce lien, SiteBar s'ouvrira dans le panneau latéral d'Opera.
_P;

$para['integrator::hint_install'] = <<<_P
Installe SiteBar dans le volet d'exploration et dans le menu contextuel - nécessite des changements
dans la base de registres Windows ainsi qu'un redémarrage pour finaliser l'installation. Selon vos droits
d'accès, vous pourriez n'avoir accès qu'à une partie des fonctionnalités.
<br>
Ouvrez le volet d'exploration SiteBar à partir du menu "Vue/Volet d'exploration" ou utilisez la fonction Personnaliser...
de la barre d'outils pour ajouter le bouton d'activation de SiteBar sur cette barre d'outils. Un clic droit sur une page
ou sur un lien permettra d'ajouter la page ou le lien à SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Désinstalle le volet d'exploration (voir ci-dessus).
_P;

$para['integrator::hint_searchbar'] = <<<_P
L'usage de ce bookmarklet* est recommandé dans le cas où l'utilisateur ne dispose pas de privilèges
suffisants pour installer le volet d'exploration. Il charge SiteBar temporairement dans le volet
d'exploration de votre navigateur.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Télécharge un plugin (à partir d'une URL fixe). L'archive doit être extraite dans le répertoire "C:\Program Files\Maxthon\Plugin".
Après redémarrage du navigateur, une nouvelle barre d'exploration est ajoutée.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Télécharge un plugin (à partir d'une URL fixe). L'archive doit être extraite dans le répertoire "C:\Program Files\Maxthon\Plugin".
Après redémarrage du navigateur, une nouvelle icône apparaît dans la barre de plugins.
Cette icône permet d'ajouter la page de l'onglet courant dans SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Lancez la commande <strong>emerge sitebar</strong> pour installer le logiciel SiteBar.
_P;

$para['integrator::hint_debian'] = <<<_P
Lancez la commande <strong>apt-get install sitebar</strong> pour installer le logiciel SiteBar.
_P;

$para['integrator::hint_phplm'] = <<<_P
Le menu PHP Layers est un système de menus hiérarchiques pour générer un menu DHTML
"à la volée" en se basant sur le moteur de PHP pour traiter les données. SiteBar est capable
de fournir un flux de favoris dans la structure correcte. Si la fonction fopen est autorisée
à ouvrir des fichiers distants, le code suivant chargera les données dans le bon format:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright &copy 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> et la <a href='http://sitebar.org/team.php'>SiteBar Team</a>. <a href='http://sitebar.org/forum.php'>Forum</a> de Support et Suivi de <a href='http://sitebar.org/bugs.php'>Bugs</a>.
_P;

$para['command::welcome'] = <<<_P
%s, bienvenue dans SiteBar!
%s
<p>
SiteBar fonctonne via des menus contextuels activés avec un clic droit sur un dossier ou un lien.
Si votre système/navigateur ne supporte pas les clics droits, vous pouvez utiliser CTRL-clic ou alors
activer l'option "icônes du menu" dans les paramètres utilisateur.
<p>
Pour plus d'information au sujet de SiteBar, vous pouvez consulter l'aide en ligne à parir du bouton "Aide".
<p>
Vous êtes maintenant connecté.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Ce serveur SiteBar nécessite la validation de votre
adresse email avant de pouvoir utiliser ses fonctionnalités.
<p>
Si vous avez entré votre adresse email complète, vous devriez
reçevoir un message sous peu. Merci de bien vouloir cliquer
sur le lien qui se trouve dans cet email.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Ce serveur SiteBar nécessite l'approbation par un administrateur
des demandes de nouveaux comptes utilisateurs avant de pouvoir
utiliser ses fonctionnalités.
<p>
Veuillez patienter jusqu'à ce qu'un administrateur ait vérifié la
demande - vous serez informé du status par email.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Ce serveur SiteBar nécessite la validation de votre
adresse email ainsi que l'approbation de votre demande
par un administrateur avant de pouvoir utiliser ses 
fonctionnalités.
<p>
Si vous avez entré votre adresse email complète, vous devriez
reçevoir un message sous peu. Merci de bien vouloir cliquer
sur le lien qui se trouve dans cet email et patienter jusqu'à
ce qu'un administrateur ait vérifié la demande - vous serez informé
du status par email.
_P;

$para['command::account_approved'] = <<<_P
L'administrateur a approuvé votre de demande de compte.
Vous pouvez vous connecter en utilisant votre adresse email %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::account_rejected'] = <<<_P
L'administrateur a rejeté votre de demande de compte
avec l'adresse email %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::account_deleted'] = <<<_P
L'administrateur a supprimé votre compte resté inactif
avec l'adresse email %s.

--
Serveur SiteBar sur %s.
_P;

$para['command::reset_password'] = <<<_P
Une demande de reinitialisation du mot de passe SiteBar a été
demandée pour l'adresse email "%s".

Si vous souhaitez réellement reinitialiser le mot de passe de
ce compte, veuillez cliquer sur le lien suivant:
    %s

--
Serveur SiteBar sur %s.
_P;

$para['command::contact'] = <<<_P
%s


--
Serveur SiteBar sur %s
_P;

$para['command::contact_group'] = <<<_P
Groupe cible: %s

%s


--
Serveur SiteBar sur %s
_P;

$para['command::delete_account'] = <<<_P
<h3>Voulez-vous réellement supprimer votre compte ?</h3>
Ceci est une opération irréversible!<p>
Toutes les hiérarchies seront attribuées aux administrateurs du système.
_P;

$para['command::email_link_href'] = <<<_P
<p>Envoyer un email via votre
<a href="mailto:?subject=Site Internet: %s&body=J'ai trouvé un site internet qui serait susceptible de t'intéresser.
 Va voir à: %s
 -- Message envoyé via SiteBar sur %s
 Serveur de favoris OpenSource http://sitebar.org
">logiciel d'email</a>
_P;

$para['command::email_link'] = <<<_P
J'ai trouvé un site internet qui serait susceptible de t'intéresser.
Je te conseille de visiter ce lien:

   "%s" %s

%s

--
Envoyé via SiteBar sur %s
Serveur de favoris Open Source http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Vous avez demandé une vérification d'email, qui permet l'ajout automatique aux groupes grâce aux règles RegExp et vous permet l'utilisation des fonctionnalités email de SiteBar.

Merci de bien vouloir cliquer sur le lien suivant pour confirmer votre adresse:
  %s
_P;

$para['command::verify_email_must'] = <<<_P
Vous avez effectué une demande de compte SiteBar sur un serveur
SiteBar qui requiert la vérification des adresses email avant de
pouvoir être utilisé.

Veuillez cliquer sur le lien suivant pour vérifier votre email:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer peut importer/exporter les favoris dans le format de fichier des favoris Netscape. Cependant, ce dernier doit être encodé dans le format natif de Windows, le format par défaut UTF-8 ne fonctionnera pas.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer peut exporter ses favoris dans le format de fichier Netscape à partir
du menu "Fichier/Importer et Exporter...". Le fichier exporté est encodé dans le
format natif de Windows. Vous devrez spécifier le bon code de page de caractères lors de l'importation
du fichier, car la valeur par défaut UTF-8 ne fonctionnera pas.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
La conversion des Codepage n'a pas été installée sur ce serveur SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Droits:
<strong>L</strong>ire,
<strong>A</strong>jouter,
<strong>M</strong>odifier,
<strong>S</strong>upprimer,
<strong>P</strong>urger,
<strong>H</strong>abiliter
_P;

$para['command::purge_cache'] = <<<_P
<h3>Voulez-vous réellement supprimer tous les favicon du cache ?</h3>
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL pointant vers cette instance de Sitebar, sans le caractère / final.
_P;

$para['command::tooltip_default_domain'] = <<<_P
Quand le domaine est indiqué, les utilisateurs qui s'identifient avec leur adresse email n'ont plus besoin de le spécifier.
_P;

$para['command::tooltip_respect'] = <<<_P
Envoyer des emails uniquement si l'utilisateur l'a autorisé.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Envoyer des emails uniquement aux adresses vérifiées.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Autoriser les utilisateurs anonymes à contacter l'administrateur.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Si ce n'est pas autorisé, les utilisateurs devront utiliser le moteur de recherche défini ici et ne pourront pas le modifier.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Autoriser l'accès au formulaire d'inscription aux visiteurs pour qu'ils puissent s'enregistrer.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Afficher les commandes d'importation/exportation des descriptions de liens.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Activer le mode de SiteBar destiné à gérer un utilisateur unique.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Autoriser les utilisateurs à créer des hiérarchies supplémentaires.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Autoriser les utilisateurs à supprimer leurs hiérarchies existantes
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Les utilisateurs peuvent créer leurs propres groupes. Sinon seuls les administrateurs disposent de ce privilège.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Utiliser le moteur de conversion (en général une extension de PHP) pour convertir les pages vers un jeu de caractères - important pour importer/exporter des favoris.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Les pages générées par SiteBar peuvent être compressées pour libérer le réseau. La compression n'est utilisée que si le navigateur le supporte.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Dans le cas où la version de PHP utilisée autorise les fonctions mail, les fonctionnalités email peuvent être activées.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Certaines fonctionnalités (cache des favicons) nécessitent l'accès à des adresses distantes depuis votre serveur.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Les utilisateurs doivent être approuvés par un administrateur avant de pouvoir utiliser SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Les utilisateurs doivent vérifier leur adresse email avant de pouvoir utiliser SiteBar.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Afficher le logo en haut - Désactiver l'option si la bande passante est faible, sinon le conserver pour faire connaitre SiteBar.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Afficher dans le panneau SiteBar principal certaines statistiques sur la performance et le contenu.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Permet l'accès direct aux favoris ou au flux de favoris pour les utilisateurs non identifiés. Peut être détourné si l'utilisateur sait reconstruire l'URL!
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Télécharger les favicons de leur serveur d'origine vers le cache de la base de données. Augmente le trafic et accélère le cache des Favicons en réduisant le nombre de serveurs connectés.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
Pile FIFO. Les icônes les plus anciennes seront supprimées du système - à utiliser pour contrôler la taille du cache.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Taille maximale autorisée pour les icônes en octets.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Combien de temps les favicons resteront dans le cache avant qu'elles ne soient rechargées du serveur d'origine.
_P;

$para['command::tooltip_verified'] = <<<_P
Cocher cette case pour marquer l'adresse email comme vérifiée.
_P;

$para['command::tooltip_demo'] = <<<_P
Transformer ce compte en compte de démo, avec des fonctions limitées et sans pouvoir changer le mot de passe.
_P;

$para['command::tooltip_approved'] = <<<_P
Le compte est approuvé et peut être utilisé.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Les dossiers précèdent les liens dans la hiérarchie SiteBar, ou vice versa.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Autoriser les modérateurs à m'ajouter à leurs groupes.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Autoriser les administrateurs et modérateurs du groupe auquel j'appartiens à m'envoyer des emails d'information.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Obtenir automatiquement la favicon lorsqu'elle est absente et que le lien vient d'être ajouté.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Les dossiers ayant des droits d'accès spécifiques seront décorés et ainsi plus facilement identifiables.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Exécuter les commandes en utilisant une fenêtre externe - sans recharger la vue principale après chaque commande.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Cacher les fonctionnalités qui nécessitent un navigateur supportant XSLT.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Charge le contenu des dossiers uniquement lorsqu'ils sont ouverts - permet d'accélérer SiteBar.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Les liens privés seront uniquement chargés si SiteBar est utilisé sur une connexion SSL.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Le dossier racine ne sera pas inclus dans l'export si cela est possible.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Certains navigateurs ne supportent pas le clic droit. Une icône sera disponible pour ouvrir le menu contextuel.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Ne pas afficher le résultat de l'éxécution d'une commande en cas de succès.
_P;

$para['command::tooltip_show_public'] = <<<_P
Afficher les favoris publiés par d'autres utilisateurs.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Les favicons peuvent ralentir SiteBar. Quand le cache des favicons est utilisé, leur affichage est plus rapide.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Permet de cacher des dossiers. Cette fonction est utilisée pour les dossiers publiés d'autres utilisateurs.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Générer les astuces via SiteBar plutôt que via le navigateur. Cela permet des astuces plus longues et un support de davantage de navigateurs.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Permet de marquer les dossiers et liens supprimés pour qu'ils puissent être restaurés ou purgés ultérieurement.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Permettre aux recherches d'être étendues par les résultats fournis par votre moteur de recherche Web préféré.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Les résultats de la recherche Web seront inclus dans la page de résultats de recherche SiteBar en utilisant un cadre inline.
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Autoriser les utilisateurs à s'ajouter eux-mêmes au groupe.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Autoriser les non membres à contacter un modérateur du groupe.
_P;

$para['command::tooltip_publish'] = <<<_P
Publier ce dossier afin que tout le monde puisse le voir.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Supprimer uniquement le contenu du dossier, plutôt que le dossier lui-même.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Appliquer l'opération au contenu du dossier, et non pas au dossier lui-même.
_P;

$para['command::tooltip_default_folder'] = <<<_P
La prochaine fois que vous utiliserez le bookmarklet, ce dossier sera utilisé comme valeur par défaut.
_P;

$para['command::tooltip_private'] = <<<_P
Ignorer les liens privés dans l'export. Les liens privés sont toujours ignorés pour les utilisateurs autres que le propriétaire.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ne pas tenter de valider ce lien - utiliser pour des liens vers un intranet ou posant des problèmes de validation.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Le lien n'a pas pu être validé. Vous souhaitez peut-être le conserver tout de même actif.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Valider ce dossier de manière récursive avec tous ses sous-dossiers.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Ne pas tester les liens validés récemments - utiliser pour continuer une validation qui ne s'est pas achevée.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Essayer d'analyser la page et trouver les favicons (icônes de raccourcis) manquantes.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Supprimer l'URL de la favicon du lien si elle est invalide - utiliser avec précaution.
_P;

$para['command::tooltip_rename'] = <<<_P
Lors d'une importation, renommer les doublons pour permettre de tout charger.
_P;

$para['command::tooltip_hits'] = <<<_P
Tous les clics sur les liens sont dirigés vers le serveur SiteBar pour génerer des statistiques d'accès.
_P;

$para['command::tooltip_subdir'] = <<<_P
Exporter tous les liens et dossiers de manière récursive.
_P;

$para['command::tooltip_flat'] = <<<_P
Exporter les liens comme s'il n'appartenaient qu'à un seul dossier.
_P;

$para['command::tooltip_cmd'] = <<<_P
Ajoute les commandes principales de SiteBar, pour permettre une connexion facile à SiteBar.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Ce serveur SiteBar demande une vérification de l'adresse email.
Veuillez confirmer votre adresse email, sous peine de suppression du compte utilisateur.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Votre adresse email correspond aux règles d'ajout automatique des groupes fermés suivants:
    %s.

De ce fait pour autoriser votre adhésion, votre adresse email doit être verifiée. Merci de cliquer sur le lien suivant afin de la vérifier:
   %s
_P;

$para['usermanager::signup_info'] = <<<_P
L'utilisateur "%s" <%s> s'est inscrit à votre serveur SiteBar sur %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
L'utilisateur "%s" <%s> s'est inscrit sur votre serveur SiteBar sur %s.
L'utilisateur a déjà confirmé son adresse email.
_P;

$para['usermanager::signup_approval'] = <<<_P
L'utilisateur "%s" <%s> s'est inscrit sur votre serveur SiteBar sur %s.

Approuver le compte:
    %s

Rejeter le compte:
    %s

Voir les utilisateurs en attente:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
L'utilisateur "%s" <%s> s'est inscrit sur votre serveur SiteBar sur %s.
L'utilisateur a déjà confirmé son adresse email.

Approuver le compte:
    %s

Rejeter le compte:
    %s

Voir les utilisateurs en attente:
    %s
_P;

$para['hook::statistics'] = <<<_P
Racines {roots_total}.
Dossiers {nodes_shown}/{nodes_total}.
Liens {links_shown}/{links_total}.
Utilisateurs {users}.
Groupes {groups}.
Requêtes SQL {queries}.
DB/Temps total {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
