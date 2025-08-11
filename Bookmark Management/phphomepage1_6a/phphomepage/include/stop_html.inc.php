<?
/**
 * [fr]Fichier qui génére le code de fin de page HTML commun à tous les fichiers
 * [en]File which génére the code of end of page HTML common to all the files
 *
 * @copyright    05/08/2005
 * @since	     09/08/2001
 * @version      1.6a
 * @module       star_html
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr]Pour empècher le Hacking du serveur via ce script je rajoute une condition pour vérifier la variable LOCAL_INCLUDE
 */
if (strstr(LOCAL_INCLUDE, 'http')) {
    /**
     * [fr]Variable pour fixer le dossier d'include
     * Laisser vide si vous pouvez utiliser un fichier .htaccess, sinon mettre les chemins réels
     * [en]Variable to fix the file of include
     * To leave empty if you could use a .htaccess file, if not put the real path
     *
     * @const LOCAL_INCLUDE 
     */
    define('LOCAL_INCLUDE', './include/');
}    
/**
 * [fr]Fichier de clôture de connection à la base
 */
require_once(LOCAL_INCLUDE.'close.inc.php');
echo "\n";
echo '    </BODY>'."\n";
echo '</HTML>'."\n";
?>