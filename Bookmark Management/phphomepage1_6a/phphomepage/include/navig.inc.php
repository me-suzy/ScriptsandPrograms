<?
/**
 * [fr]Fichier de navigation pour un ajout de homepage
 * [en]File of navigation for an addition of homepage
 *
 * @copyright    22/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       navig
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr] Récupération des infos
 */
$query1            = 'SELECT `rubriques_id`,`mise_en_page_id` FROM homepage WHERE nom = \''.$homepage.'\'';
$req1              = mysql_query ($query1);
$res1              = mysql_num_rows($req1);
if ($res1 != '') {
    $rubriques_id      = mysql_result($req1,0,'rubriques_id');
    $mise_en_page_id   = mysql_result($req1,0,'mise_en_page_id');
}
echo '                    <p>'.$cfg_font_3_b.'<b>'.$cfg_Version.'</b>'.$cfg_font_fin."</p>\n";
echo '                    <p>'.$cfg_font_1_b.$lang_PourNom.'<b><a href="php_homepage.php?homepage='.$homepage.'">'.$cfg_font_1_b.$homepage.$cfg_font_fin.'</a></b>'.$cfg_font_fin."</p>\n";
/**
 * [fr]Menu d'accès aux rubriques et aux liens
 */
if ($res1 == '' OR $rubriques_id == '') {
    echo '                    <p><a href="'.$_SERVER['PHP_SELF'].'?homepage='.$homepage.'&amp;page=rubrique">'.$cfg_font_1_b.$lang_AjoutRubrique.$cfg_font_fin.'</a></p>'."\n";
} else {
    echo '                    <p><a href="'.$_SERVER['PHP_SELF'].'?homepage='.$homepage.'&amp;page=rubrique">'.$cfg_font_1_b.$lang_ModifRubrique.$cfg_font_fin.'</a></p>'."\n";
    echo '                    <p><a href="'.$_SERVER['PHP_SELF'].'?homepage='.$homepage.'&amp;page=liens">'.$cfg_font_1_b.$lang_ModifLiens.$cfg_font_fin.'</a></p>'."\n";
}
/**
 * [fr]Menu d'accès à la mise en page
 */
echo '                    <p><a href="'.$_SERVER['PHP_SELF'].'?homepage='.$homepage.'&amp;page=page">'.$cfg_font_1_b.$lang_MiseEnPage.$cfg_font_fin.'</a></p>'."\n";
/**
 * [fr]Menu pour afficher la page de démarrage s'il existe une rubrique et une mise en page
 */
if ($res1 != '' AND $rubriques_id != '' AND $mise_en_page_id != 0) {
    echo '                    <p><a href="homepage.php?homepage='.$homepage.'" target="_blanck">'.$cfg_font_1_b.$lang_AffHomepage.$cfg_font_fin.'</a></p>'."\n";
}
/**
 * [fr]Menu pour retour à la choix de la homepage
 */
echo '                    <p><a href="index.php" target="_parent">'.$cfg_font_1_b.$lang_RetourIndex.$cfg_font_fin.'</a></p>'."\n";
echo '                    <p>&nbsp;</p>'."\n";
?>