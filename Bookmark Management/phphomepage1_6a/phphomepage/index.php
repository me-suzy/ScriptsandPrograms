<?php
/**
 * [fr]Fichier d'accueil de php homepage
 * [en]File of reception of php homepage
 *
 * @copyright    20/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       index
 * @modulegroup  identification
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
/**
 * [fr]Création des tables dans la base si elles n'y sont pas
 */
$tmp_req    = mysql_list_tables($cfg_Base);
$tmp_table  = mysql_num_rows($tmp_req);
if ($tmp_table == 0) {
    $file = LOCAL_INCLUDE.'homepage.sql';
    /**
     * [fr]Fichier de création de table fonctionnant pour les bases local
     * [en]File of creation of table functioning for the bases room
     */
    require_once(LOCAL_INCLUDE.'create_table.inc.php');
}
/**
 * [fr] Nettoyage de la base de données
 */
$query_net         = 'SELECT `id` FROM `homepage` WHERE mise_en_page_id = 0 AND rubriques_id = \'\'';
$req_net           = mysql_query ($query_net);
$res_net           = mysql_num_rows($req_net);
if ($res_net > 9) {
    $query_delete      = 'DELETE FROM `homepage` WHERE mise_en_page_id = 0 AND rubriques_id = \'\'';
    mysql_query ($query_delete);
    $query_net            = 'SELECT `id` FROM rubriques WHERE actif = 1';
    $req_net              = mysql_query ($query_net);
    $res_net              = mysql_num_rows($req_net);
    if ($res_net != '') {
        for ($i=0;($i < $res_net);$i++) {
            $id                = mysql_result($req_net,$i,'id');
            $query_net1            = 'SELECT `id`,`rubriques_id` FROM homepage WHERE rubriques_id like \''.$id.'-%\' OR rubriques_id like \'%-'.$id.'-%\' OR rubriques_id like \'%-'.$id.'\'';
            $req_net1              = mysql_query ($query_net1);
            $res_net1              = mysql_num_rows($req_net1);
            if ($res_net1 > 0) {
                $rubriques_id2       = mysql_result($req_net1,0,'rubriques_id');
                if (substr($rubriques_id2, 0 ,1) != '-') {
                    $rubriques_id2 = '-'.$rubriques_id2;
                }
                if (substr($rubriques_id2, -1) != '-') {
                    $rubriques_id2 = $rubriques_id2.'-';
                }
                $rubriques_id2       = str_replace('-'.$id.'-','-',$rubriques_id2);
                $query_net2          = 'UPDATE homepage SET rubriques_id=\''.$rubriques_id2.'\' WHERE id = \''.mysql_result($req_net1,0,'id').'\'';
                mysql_query ($query_net2);
            }
            $query_liens         = 'UPDATE liens SET actif = 1 WHERE rubrique_id = '.$id ;
            mysql_query ($query_liens);    
        }
        $query_delete      = 'DELETE FROM `rubriques` WHERE actif = 1';
        mysql_query ($query_optimize);
        unset($query_net,$req_net,$res_net,$id,$query_net1,$req_net1,$res_net1,$rubriques_id2,$query_net2,$query_liens,$query_delete);
    }
    $query_delete      = 'DELETE FROM `liens` WHERE actif = 1';
    mysql_query ($query_delete);
    /**
     * [fr] optimisation de la base de données
     */
    $query_optimize    = 'OPTIMIZE TABLE `homepage`';
    mysql_query ($query_optimize);
    mysql_query ($query_delete);
    $query_optimize    = 'OPTIMIZE TABLE `rubriques`';
    mysql_query ($query_optimize);
    $query_optimize    = 'OPTIMIZE TABLE `liens`';
    mysql_query ($query_optimize);
    $query_optimize    = 'OPTIMIZE TABLE `mise_en_page`';
    mysql_query ($query_optimize);
    }
/**
 * [fr] Affichage du formulaire d'entrée
 */
echo "\n";
echo '        <p>'.$cfg_font_3_n.$lang_Accueil.' <b>'.$cfg_Version.'</b>'.$cfg_font_fin."</p>\n";
echo '        <p>'.$cfg_font_2_n.$lang_NvellePage.$cfg_font_fin."</p>\n";
echo '        <form name="identification" method="post" action="php_homepage.php">'."\n";
echo '            <table width="100%" border="0" cellspacing="0" cellpadding="0">'."\n";
echo '                <tr>'."\n";
echo '                    <td width="100">'.$cfg_font_1_n.$lang_Nom.$cfg_font_fin.'</td>'."\n";
echo '                    <td><input type="text" '.$cfg_Formulaire.' name="homepage" maxlength="255" size="20"></td>'."\n";
echo '                </tr>'."\n";
echo '                <tr>'."\n";
echo '                    <td width="100">&nbsp;</td>'."\n";
echo '                    <td><input type="submit" '.$cfg_Formulaire.' name="Submit" value="'.$lang_Creer.'"></td>'."\n";
echo '                </tr>'."\n";
echo '            </table>'."\n";
echo '        </form>'."\n";
echo '        <p><a href="http://validator.w3.org/check/referer"><img border="0" src="http://www.w3.org/Icons/valid-html401" alt="Valid HTML 4.01!" height="31" width="88"></a></p>';
/**
 * [fr]Fichier qui génére le code de fin de page HTML commun à tous les fichiers
 */
require_once(LOCAL_INCLUDE.'stop_html.inc.php');
?>