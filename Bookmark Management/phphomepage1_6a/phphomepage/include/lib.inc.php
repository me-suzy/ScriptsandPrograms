<?php
/**
 * [fr]Fichier librairie de fonctions
 * [en]File of functions' library
 *
 * @copyright    22/03/2004
 * @since	     09/08/2001
 * @version      1.6
 * @module       lib
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr]Fonction listant les rubriques de la base
 *
 * @access	public
 * @version 1.6
 * @param	string  [fr]0 ou 1 pour utilisation du paramètre selected dans un tag option
 * @return	string  [fr]Liste <option> des rubriques de la homepage
 */
function choix_rubrique($select = 0) {
    GLOBAL $homepage, $choix_rubrique, $rubriques_id, $rubrique, $new_rubrique;
    if (substr($rubriques_id, 0 ,1) != '-') {
        $rubriques_id = '-'.$rubriques_id;
    }
    if (substr($rubriques_id, -1) != '-') {
        $rubriques_id = $rubriques_id.'-';
    }
    $temp_rubrique     = explode ('-',substr($rubriques_id, 1, -1));
    $i            = 0;
    while($i < count($temp_rubrique)) {
        $query1       = 'SELECT id, titre, actif FROM rubriques WHERE id = '.$temp_rubrique[$i];
        $req1         = mysql_query ($query1);
        $id           = mysql_result($req1,0,'id');
        $titre        = mysql_result($req1,0,'titre');
        $actif        = mysql_result($req1,0,'actif');
        if ($actif != 1) {
            echo '                            <option value="'.$id.'"';
            if (($choix_rubrique == $id  AND $select == 1) OR ($rubrique == $id  AND $select == 0) OR ($new_rubrique == $id  AND $select == 0)) {
                echo 'selected';
            }
            echo '>'.$titre.'</option>'."\n";
        }
        $i++;
    }
}
/**
 * [fr]Fonction listant les liens de la base
 *
 * @access	public
 * @version 1.5
 * @return	string  [fr]Liste <option> des liens de la homepage
 */
function choix_lien($select = 0) {
    GLOBAL $rubriques_id, $choix_lien;
    if (substr($rubriques_id, 0 ,1) != '-') {
        $rubriques_id = '-'.$rubriques_id;
    }
    if (substr($rubriques_id, -1) != '-') {
        $rubriques_id = $rubriques_id.'-';
    }
    $rubrique     = explode ('-',substr($rubriques_id, 1, -1));
    $i            = 0;
    while($i<count($rubrique)) {
        $query1       = 'SELECT titre FROM rubriques WHERE id = '.$rubrique[$i];
        $req1         = mysql_query ($query1);
        $titre        = mysql_result($req1,0,'titre');
        $query2       = 'SELECT id, titre, actif FROM liens WHERE rubrique_id = '.$rubrique[$i];
        $req2         = mysql_query ($query2);
        $res2         = mysql_num_rows($req2);
        $j            = 0;
        if ($res2 > 0) {
            echo '                            <optgroup label="'.$titre.'">'."\n";
        }
        while($res2 != $j) {
            $id           = mysql_result($req2,$j,'id');
            $titre        = mysql_result($req2,$j,'titre');
            $actif        = mysql_result($req2,$j,'actif');
            if ($actif != 1) {
                echo '                                 <option';
                if (($choix_lien == $id  AND $select == 1)) {
                    echo ' selected';
                }
                echo ' value="'.$id.'">'.$titre.'</option>'."\n";
            }
            $j++;
        }
        $i++;
        if ($res2 > 0) {
            echo '                            </optgroup>'."\n";
        }
    }
}
/**
 * [fr]Fonction qui décompose une couleur rrvvbb en rr vv bb
 *
 * @access	public
 * @version 1.5
 * @param	string  [fr]La couleur Hexadécimale à décomposer
 * @param	string  [fr]Lettre d'identification pour formulaire multiple
 * @return	string  [fr]HTML décomposition de couleur sous forme de formulaire
 */
function eclat_couleur($couleur,$ident) {
    GLOBAL $cfgFormulaire;
    $couleur1 = substr ($couleur, 0, 2);
    $couleur2 = substr ($couleur, 2, 2);
    $couleur3 = substr ($couleur, 4, 2);
    echo '                                    <input type="text" '.$cfgFormulaire.' name="rouge'.$ident.'" size="2" maxlength="2" value="'.$couleur1.'">
                                    -
                                    <input type="text" '.$cfgFormulaire.' name="vert'.$ident.'" size="2" maxlength="2" value="'.$couleur2.'">
                                    -
                                    <input type="text" '.$cfgFormulaire.' name="bleu'.$ident.'" size="2" maxlength="2"  value="'.$couleur3.'">'."\n";
   }
/**
 * [fr]fonction générant autant de case que configuré dans le fichier config.inc.php et les remplis
 *
 * @access	public
 * @version 1.6
 * @param	string  [fr]numéro de la case
 * @return	string  [fr]Affichage du contenu de la case
 */
function create_case($case) {
    GLOBAL $homepage, $font_rubrique, $font_lien, $cfg_font_fin, $target;
    $query1       = 'SELECT rubriques_id FROM homepage WHERE nom = \''.$homepage.'\'';
    $req1         = mysql_query ($query1);
    $rubriques_id = mysql_result($req1,0,'rubriques_id');
    if (substr($rubriques_id, 0 ,1) != '-') {
        $rubriques_id = '-'.$rubriques_id;
    }
    if (substr($rubriques_id, -1) != '-') {
        $rubriques_id = $rubriques_id.'-';
    }
    $rubrique     = explode ('-',substr($rubriques_id, 1, -1));
    $i            = 0;
    while($i<count($rubrique)) {
        $query2       = 'SELECT titre FROM rubriques WHERE id = '.$rubrique[$i].' AND actif = \'\' AND position = '.$case.' ORDER BY titre';
        $req2         = mysql_query ($query2);
        $res2         = mysql_num_rows($req2);
        if ($res2 !=0) {
            $nom_rubrique = mysql_result($req2,0,'titre');
            echo '                    <p>'.$font_rubrique.'<b>'.$nom_rubrique.'</b>'.$cfg_font_fin."</p>\n";
            $query3       = 'SELECT titre, url, actif FROM liens WHERE rubrique_id = '.$rubrique[$i].' ORDER BY titre';
            $req3         = mysql_query ($query3);
            $res3         = mysql_num_rows($req3);
            $j            = 0;
            while($res3 != $j) {
                $nom_lien     = mysql_result($req3,$j,'titre');
                $url          = mysql_result($req3,$j,'url');
                $actif        = mysql_result($req3,$j,'actif');
                if ($actif != 1) {
                    if ($target != 1) {
                        echo '                    <a href="'.$url.'" target="_blank">'.$font_lien.$nom_lien.$cfg_font_fin.'</a><br>'."\n";
                    } else {
                        echo '                    <a href="'.$url.'" target="_self">'.$font_lien.$nom_lien.$cfg_font_fin.'</a><br>'."\n";
                    }
                }
                $j++;
            }
        }
        $i++;
    }
    echo '                    <br>'."\n";
}
?>