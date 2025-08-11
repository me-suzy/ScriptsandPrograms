<?php
/**
 * [fr]Fichier d'accueil de création de homepage
 * [en]File of greeting of creation of homepage
 *
 * @copyright    22/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       main
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr]Si première connexion on affiche les explications
 */
if ($res1 == '' OR $rubriques_id == '') {
    $query2 = 'INSERT INTO homepage VALUES'."('','".$homepage."','','')";
    mysql_query ($query2);
    echo '                    <p>'.$cfg_font_3_n.$lang_Accueil.' <b>'.$cfg_Version.'</b>'.$cfg_font_fin."</p>\n";
    echo '                    <p>'.$cfg_font_1_n.$lang_1.$cfg_font_fin."</p>\n";
    echo '                    <p>'.$cfg_font_1_n.$lang_2.$cfg_font_fin."</p>\n";
    echo '                    <p>'.$cfg_font_1_n.$lang_3.$cfg_font_fin."</p>\n";
    echo '                    <p>'.$cfg_font_1_n.$lang_4.$cfg_font_fin."</p>\n";
} else {
    /**
     * [fr]si pas de mise en page on continue à afficher les explications
     */
    if ($mise_en_page_id == 0) {
        echo '                    <p>'.$cfg_font_1_n.$lang_3.$cfg_font_fin."</p>\n";
        echo '                    <p>'.$cfg_font_1_n.$lang_4.$cfg_font_fin."</p>\n";
    }
    /**
     * [fr]Enfin on récapitule les infos contenus dans la page
     */
    echo '                    <p>'.$cfg_font_2_n.$lang_Constituer1.' <b>'.$homepage.'</b> '.$lang_Constituer2.$cfg_font_fin."</p>\n";
    if (substr($rubriques_id, 0 ,1) != '-') {
        $rubriques_id = '-'.$rubriques_id;
    }
    if (substr($rubriques_id, -1) != '-') {
        $rubriques_id = $rubriques_id.'-';
    }
    if (strstr(substr($rubriques_id, 1, -1),'-')) {
        $rubrique     = explode ('-',substr($rubriques_id, 1, -1));
    } else {
        $rubrique     = array(0=>substr($rubriques_id, 1, -1));
    }
    $i            = 0;
    WHILE($i<count($rubrique)) {
        $query2         = 'SELECT `id`, `titre`, `position`, `actif` FROM rubriques WHERE id = '.$rubrique[$i];
        $req2           = mysql_query ($query2);
        $id_rub         = mysql_result($req2,0,'id');
        $nom_rubrique   = mysql_result($req2,0,'titre');
        $place_rubrique = mysql_result($req2,0,'position');
        $actif          = mysql_result($req2,0,'actif');
        if ($actif != 1) {
            echo '                    <p>'.$cfg_font_1_n.' <b>'.$nom_rubrique.'</b> '.$lang_Position.' '.$place_rubrique.$cfg_font_fin."</p>\n";
            $query3         = 'SELECT `id`, `titre`, `url`, `actif` FROM liens WHERE rubrique_id = '.$rubrique[$i];
            $req3           = mysql_query ($query3);
            $res3           = mysql_num_rows($req3);
            $j              = 0;
            WHILE($res3 != $j) {
                $id_lien        = mysql_result($req3,$j,'id');
                $nom_lien       = mysql_result($req3,$j,'titre');
                $url            = mysql_result($req3,$j,'url');
                $actif          = mysql_result($req3,$j,'actif');
                if ($actif != 1) {
                    echo '                    '.$cfg_font_1_n.'<a href="'.$url.'" target="_blank">'.$nom_lien.'</a> - url = '.$url.$cfg_font_fin."<br>\n";
                }
                $j++;
            }
        }
        $i++;
    }
}
?>