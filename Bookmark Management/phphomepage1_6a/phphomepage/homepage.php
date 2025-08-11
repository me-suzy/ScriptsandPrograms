<?php
/**
 * [fr]Votre page de démarrage
 * [en]Your homepage
 *
 * @copyright    20/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       homepage
 * @modulegroup  homepage
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
if (empty($homepage)){
    if (!empty($_GET['homepage'])) {
        $homepage = $_GET['homepage'];
    } elseif (!empty($_POST['homepage'])){
        $homepage = $_POST['homepage'];
    }
}
if (empty($homepage)){
    header ("Location: index.php");
}
/**
 * [fr]Fichier qui contient divers paramètres locaux
 */
require_once('./local.inc.php');
/**
 * [fr]Fichier de configuration de Php homepage
 */
require_once (LOCAL_INCLUDE.'config.inc.php');
/**
 * [fr]Fichier qui contient la librairie des fonctions communes
 */
require_once (LOCAL_INCLUDE.'lib.inc.php');
/**
 * [fr]Fichier de connection à la base
 */
require_once (LOCAL_INCLUDE.'connect.inc.php');
/**
 * [fr]Fichier qui contient la traduction de Php Homepage dans la langue choisi
 */
require_once (LOCAL_INCLUDE.'localisation/lang_'.$cfg_Langue.'.inc.php');
/**
 * [fr]Récupération des infos pour générer la page
 */
$query1          = 'SELECT mise_en_page_id FROM homepage WHERE nom = \''.$homepage.'\'';
$req1            = mysql_query ($query1);
$mise_en_page_id = mysql_result($req1,0,"mise_en_page_id");
$query2          = 'SELECT fond, couleur_titre, taille_titre, couleur_lien, taille_lien, police, titre, target FROM mise_en_page WHERE id = \''.$mise_en_page_id.'\'';
$req2            = mysql_query ($query2);
$fond            = mysql_result($req2,0,'fond');
$couleur_titre   = mysql_result($req2,0,'couleur_titre');
$taille_titre    = mysql_result($req2,0,'taille_titre');
$couleur_lien    = mysql_result($req2,0,'couleur_lien');
$taille_lien     = mysql_result($req2,0,'taille_lien');
$police          = mysql_result($req2,0,'police');
$titre           = mysql_result($req2,0,'titre');
$target          = mysql_result($req2,0,'target');
$font_rubrique   = '<font face="'.$police.'" size="'.$taille_titre.'" color="#'.$couleur_titre.'">';
$font_lien       = '<font face="'.$police.'" size="'.$taille_lien.'" color="#'.$couleur_lien.'">';
echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                      "http://www.w3.org/TR/html4/loose.dtd">'."\n";
echo '<HTML>'."\n";
echo '    <HEAD>'."\n";
echo '        <TITLE>';
if ($titre != '') {
    echo $titre;
} else {
    echo $cfg_Version;
   }
echo '</TITLE>'."\n";
echo '        <META http-equiv="Content-Type" content="text/html; charset='.$cfg_charset.'">'."\n";
echo '    </HEAD>'."\n";
echo '    <BODY bgcolor="#'.$fond.'" link="#'.$couleur_lien.'" vlink="#'.$couleur_lien.'" alink="#'.$couleur_lien.'">'."\n";
echo '        <table width="100%" border="0" cellspacing="5" cellpadding="0">'."\n";
$k = 0;
while($cfg_NbrLignes != $k) {
    echo '            <tr valign="top">'."\n";
    $case    = 1 + ($k * $cfg_NbrColonnes);
    $largeur = 100 / $cfg_NbrColonnes;
    $l       = 0;
    while($cfg_NbrColonnes != $l) {
        $case1 = $case + $l;
        echo '                <td width="'.$largeur.'%">'."\n";
        create_case($case1);
        echo '                </td>'."\n";
        $l++;
    }
    echo "            </tr>\n";
    $k++;
}
echo '        </table>'."\n";
echo '        <br>'."\n";
echo '        <p align="right"><font face="'.$police.'" color="#'.$couleur_titre.'" size="1">'.$homepage.' - '.$lang_Realiser.' '.$cfg_Version.$cfg_font_fin.'</p>';
require_once(LOCAL_INCLUDE.'stop_html.inc.php') ?>