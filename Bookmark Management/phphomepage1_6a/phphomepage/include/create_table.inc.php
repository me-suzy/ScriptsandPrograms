<?php
/**
 * [fr]Fichier de création de table fonctionnant pour les bases local
 * [en]File of creation of table functioning for the bases room
 *
 * @copyright    15/11/2003
 * @since	     09/01/2001
 * @version      1.5
 * @module       create_table
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */

if (!isset($file)) {
    echo $cfg_font_2_n.$lang_ErrorNomFichier.' http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?<b>file=homepage.sql</b>'.$cfg_font_fin."\n";
} else {
    if (file_exists($file)) {
        $fd = file($file);
        $i = count($fd);
        for ($i = 0; $i < count($fd); $i++) {
            $query = $fd[$i];
            if (strlen(trim($query))) {
                //echo "- $query<br>\n";
                mysql_query($query);
                $errno = mysql_errno();
                $error = mysql_error();
                //echo("$errno - $error<br>\n");
            }
        }
        //mysql_free_result();
    } else {
        echo $cfg_font_2_r.$lang_Fichier.' "<b>'.$file.'</b>" '.$lang_Introuvable.'<br>'.$cfg_font_fin."\n";
    }
}
?>