<?php
/**
 * [fr]Fichier de gestion des homepages
 * [en]File of management of the homepage
 *
 * @copyright    20/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       php_homepage
 * @modulegroup  php_homepage
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr]Fichier qui contient divers paramètres locaux
 */
require_once('./local.inc.php');
/**
 * [fr]Fichier qui génére le code de l'entête HTML commun à tous les fichiers
 */
require_once(LOCAL_INCLUDE.'start_html.inc.php');
echo "\n";
/**
 * [fr]Si le nom de la page n'est pas passé par le formulaire on renvoie sur la page de démarrage
 */
if (empty($_GET['homepage']) AND empty($_POST['homepage']) AND empty($homepage)) {
    echo '        '.$cfg_font_2_r.$lang_ErreurNom."<br>\n";
    echo '        <a href="index.php">index.php</a>'.$cfg_font_fin;
} else {
    echo '        <table width="100%" border="0" cellspacing="0" cellpadding="5">'."\n";
    echo '            <tr>'."\n";
    echo '                <td valign="top" bgcolor="#'.$cfg_FondGauche.'" width="'.$cfg_widthGauche.'">'."\n";
    /**
     * [fr]Fichier pour le menu de navigation
     */
    require_once(LOCAL_INCLUDE.'navig.inc.php');
    echo '                </td>'."\n";
    echo '                <td valign="top">'."\n";
    if (empty($_GET['page']) AND empty($_POST['page']) AND empty($page)) {
        $page = '';
    } elseif (empty($_POST['page'])) {
        $page = $_GET['page'];
    } else {
        $page = $_POST['page'];
    }
    if ($page == 'rubrique') {
        /**
         * [fr]Fichier pour la gestion des rubriques
         */
        require(LOCAL_INCLUDE.'rubrique.inc.php');
    } elseif ($page == 'liens') {
        /**
         * [fr]Fichier pour la gestion des liens
         */
        require(LOCAL_INCLUDE.'liens.inc.php');
    } elseif ($page == 'page') {
        /**
         * [fr]Fichier pour la gestion de la page
         */
        require(LOCAL_INCLUDE.'page.inc.php');
    } else {
        /**
         * [fr]Fichier par défaut
         */
        require(LOCAL_INCLUDE.'main.inc.php');
    }
    echo '                </td>'."\n";
    echo '            </tr>'."\n";
    echo '        </table>';
}
/**
 * [fr]Fichier qui génére le code de fin de page HTML commun à tous les fichiers
 */
require(LOCAL_INCLUDE.'stop_html.inc.php'); ?>