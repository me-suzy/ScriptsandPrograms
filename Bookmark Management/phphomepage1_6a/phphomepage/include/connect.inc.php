<?
/**
 * [fr]Fichier de connection à la base
 * [en]File database conexion
 *
 * @copyright    15/11/2003
 * @since	     09/08/2001
 * @version      1.5
 * @module       connec.inc
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
$connect_db = mysql_connect($cfg_Host,$cfg_User,$cfg_Pass) or die('<b><font color="#FF0000">'.$lang_ConnexBase.'</font><b>'."\n");
mysql_select_db($cfg_Base,$connect_db);
?>