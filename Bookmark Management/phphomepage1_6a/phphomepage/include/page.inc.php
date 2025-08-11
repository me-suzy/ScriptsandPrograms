<?php
/**
 * [fr]Fichier de mise en page de la homepage
 * [en]File of formatting of the homepage
 *
 * @copyright    22/03/2004
 * @since	     09/01/2001
 * @version      1.6
 * @module       liens
 * @modulegroup  include
 * @package      php_homepage
 * @access	     public
 * @author       Eric BLAS <webmaster@phphomepage.net>
 */
/**
 * [fr]Gestion des diverses erreurs
 */
if (empty($id) AND !empty($_POST['id'])) {
    $id = $_POST['id'];
}
if (empty($rougeF) AND !empty($_POST['rougeF'])) {
    $rougeF = $_POST['rougeF'];
}
if (empty($vertF) AND !empty($_POST['vertF'])) {
    $vertF = $_POST['vertF'];
}
if (empty($bleuF) AND !empty($_POST['bleuF'])) {
    $bleuF = $_POST['bleuF'];
}
if (empty($rougeR) AND !empty($_POST['rougeR'])) {
    $rougeR = $_POST['rougeR'];
}
if (empty($vertR) AND !empty($_POST['vertR'])) {
    $vertR = $_POST['vertR'];
}
if (empty($bleuR) AND !empty($_POST['bleuR'])) {
    $bleuR = $_POST['bleuR'];
}
if (empty($rougeL) AND !empty($_POST['rougeL'])) {
    $rougeL = $_POST['rougeL'];
}
if (empty($vertL) AND !empty($_POST['vertL'])) {
    $vertL = $_POST['vertL'];
}
if (empty($bleuL) AND !empty($_POST['bleuL'])) {
    $bleuL = $_POST['bleuL'];
}
if (empty($modif) AND !empty($_POST['modif'])) {
    $modif = $_POST['modif'];
}
if (empty($taille_titre) AND !empty($_POST['taille_titre'])) {
    $taille_titre = $_POST['taille_titre'];
}
if (empty($taille_lien) AND !empty($_POST['taille_lien'])) {
    $taille_lien = $_POST['taille_lien'];
}
if (empty($police) AND !empty($_POST['police'])) {
    $police = $_POST['police'];
}
if (empty($titre) AND !empty($_POST['titre'])) {
    $titre = $_POST['titre'];
}
if (empty($target) AND !empty($_POST['target'])) {
    $target = $_POST['target'];
}

/**
 * [fr]Gestion des diverses erreurs
 */
if (empty($modif)) {
    $modif = '';
}
if ($mise_en_page_id != 0 AND $modif == 1) {
    if (empty($rougeF) AND empty($_POST['rougeF'])) {
        $rougeF = '00';
    }
    if (empty($vertF) AND empty($_POST['vertF'])) {
        $vertF = '00';
    }
    if (empty($bleuF) AND empty($_POST['bleuF'])) {
        $bleuF = '00';
    }
    if (empty($rougeR) AND empty($_POST['rougeR'])) {
        $rougeR = '00';
    }
    if (empty($vertR) AND empty($_POST['vertR'])) {
        $vertR = '00';
    }
    if (empty($bleuR) AND empty($_POST['bleuR'])) {
        $bleuR = '00';
    }
    if (empty($rougeL) AND empty($_POST['rougeL'])) {
        $rougeL = '00';
    }
    if (empty($vertL) AND empty($_POST['vertL'])) {
        $vertL = '00';
    }
    if (empty($bleuL) AND empty($_POST['bleuL'])) {
        $bleuL = '00';
    }
    $fond            = $rougeF.$vertF.$bleuF;
    $couleur_titre   = $rougeR.$vertR.$bleuR;
    $couleur_lien    = $rougeL.$vertL.$bleuL;
    if (empty($titre) AND empty($_POST['titre'])) {
        $titre = '';
    }
    if ($modif == "1") {
        $query3          = "UPDATE mise_en_page SET fond='".$fond."', couleur_titre='".$couleur_titre."', taille_titre='".$taille_titre."', couleur_lien='".$couleur_lien."', taille_lien='".$taille_lien."', police='".$police."', titre='".$titre."', target='".$target."' WHERE id='".$id."'";
        mysql_query ($query3);
        $query4          = "UPDATE homepage SET mise_en_page_id='".$mise_en_page_id."' WHERE nom='".$homepage."'";
        mysql_query ($query4);
        $modif           = 2;
    }
} else {
    if ($modif == "1") {
        if (empty($rougeF) AND empty($_POST['rougeF'])) {
            $rougeF = '00';
        }
        if (empty($vertF) AND empty($_POST['vertF'])) {
            $vertF = '00';
        }
        if (empty($bleuF) AND empty($_POST['bleuF'])) {
            $bleuF = '00';
        }
        if (empty($rougeR) AND empty($_POST['rougeR'])) {
            $rougeR = '00';
        }
        if (empty($vertR) AND empty($_POST['vertR'])) {
            $vertR = '00';
        }
        if (empty($bleuR) AND empty($_POST['bleuR'])) {
            $bleuR = '00';
        }
        if (empty($rougeL) AND empty($_POST['rougeL'])) {
            $rougeL = '00';
        }
        if (empty($vertL) AND empty($_POST['vertL'])) {
            $vertL = '00';
        }
        if (empty($bleuL) AND empty($_POST['bleuL'])) {
            $bleuL = '00';
        }
        $fond            = $rougeF.$vertF.$bleuF;
        $couleur_titre   = $rougeR.$vertR.$bleuR;
        $couleur_lien    = $rougeL.$vertL.$bleuL;
        if (empty($titre) AND empty($_POST['titre'])) {
            $titre = '';
        }
        $query5          = "INSERT INTO mise_en_page VALUES('','".$fond."','".$couleur_titre."','".$taille_titre."','".$couleur_lien."','".$taille_lien."','".$police."','".$titre."','".$target."')";
        mysql_query ($query5);
        $mise_en_page_id = mysql_insert_id();
        $id = $mise_en_page_id;
        $query6          = "UPDATE homepage SET mise_en_page_id='".$mise_en_page_id."' WHERE nom='".$homepage."'";
        mysql_query ($query6);
    }
}
if ($mise_en_page_id != 0) {
    $query2          = 'SELECT id, fond, couleur_titre, taille_titre, couleur_lien, taille_lien, police, titre, target FROM mise_en_page WHERE id = \''.$mise_en_page_id.'\'';
    $req2            = mysql_query ($query2);
    $id              = mysql_result($req2,0,'id');
    $fond            = mysql_result($req2,0,'fond');
    $couleur_titre   = mysql_result($req2,0,'couleur_titre');
    $taille_titre    = mysql_result($req2,0,'taille_titre');
    $couleur_lien    = mysql_result($req2,0,'couleur_lien');
    $taille_lien     = mysql_result($req2,0,'taille_lien');
    $police          = mysql_result($req2,0,'police');
    $titre           = mysql_result($req2,0,'titre');
    $target          = mysql_result($req2,0,'target');
} else {
    $fond            = 'FFFFFF';
    $couleur_titre   = '000000';
    $taille_titre    = '3';
    $couleur_lien    = '0000FF';
    $taille_lien     = '2';
    $police          = 'Verdana';
    $titre           = '';
    $target          = '1';
}
if (!empty($rougeF)) {
    if (empty($vertF)) {
        $vertF = '00';
    }
    if (empty($bleuF)) {
        $bleuF = '00';
    }
    if (empty($rougeR)) {
        $rougeR = '00';
    }
    if (empty($vertR)) {
        $vertR = '00';
    }
    if (empty($bleuR)) {
        $bleuR = '00';
    }
    if (empty($rougeL)) {
        $rougeL = '00';
    }
    if (empty($vertL)) {
        $vertL = '00';
    }
    if (empty($bleuL)) {
        $bleuL = '00';
    }
    $fond            = $rougeF.$vertF.$bleuF;
    $couleur_titre   = $rougeR.$vertR.$bleuR;
    $couleur_lien    = $rougeL.$vertL.$bleuL;
    }

/**
 * [fr]Affichage des divers paramètres modifiables
 */
if ($mise_en_page_id != 0 AND $modif == 2) {
    echo '                    '.$cfg_font_1_v.'<b>'.$lang_ModifOK.'</b>'.$cfg_font_fin.'<br>'."\n";
} elseif ($mise_en_page_id != 0 AND $modif == 1) {
    echo '                    '.$cfg_font_1_v.'<b>'.$lang_CreerOK.'</b>'.$cfg_font_fin.'<br>'."\n";
}
echo '                    '.$cfg_font_3_n.'<b>'.$lang_MiseEnPage.'</b>'.$cfg_font_fin.'<br>'."\n";
echo '                    <form method="post" action="'.$_SERVER['PHP_SELF'].'" name="mise_en_page">'."\n";
if ($mise_en_page_id != 0) {
    echo '                    <input type="hidden" name="id" value="'.$id.'">'."\n";
}
echo '                        <input type="hidden" name="homepage" value="'.$homepage.'">'."\n";
echo '                        <input type="hidden" name="page" value="'.$page.'">'."\n";
echo '                        <input type="hidden" name="modif" value="1">'."\n";
echo '                        '.$cfg_font_2_n.$lang_CreerMEP.$cfg_font_fin.'<br>'."\n";
echo '                        <table width="75%" border="0" cellspacing="0" cellpadding="0">'."\n";
echo '                            <tr>'."\n";
echo '                                <td>&nbsp;</td>'."\n";
echo '                                <td align="center">'.$cfg_font_1_n.$lang_RVB.$cfg_font_fin.'</td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'.$cfg_font_1_n.$lang_CoulFond.$cfg_font_fin.'</td>'."\n";
echo '                                <td align="center" bgcolor="#'.$cfg_Tableau.'">'."\n";
eclat_couleur($fond,'F');
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td>'.$cfg_font_1_n.$lang_CoulRub.$cfg_font_fin.'</td>'."\n";
echo '                                <td align="center">'."\n";
eclat_couleur($couleur_titre,'R');
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'.$cfg_font_1_n.$lang_TailleRub.$cfg_font_fin.'</td>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'."\n";
echo '                                    <select '.$cfg_Formulaire.' name="taille_titre">'."\n";
echo '                                        <option value="1"';
if ($taille_titre == 1) {
    echo ' selected';
}
echo '>1</option>'."\n";
echo '                                        <option value="2"';
if ($taille_titre == 2) {
    echo ' selected';
}
echo '>2</option>'."\n";
echo '                                        <option value="3"';
if ($taille_titre == 3) {
    echo ' selected';
}
echo '>3</option>'."\n";
echo '                                        <option value="4"';
if ($taille_titre == 4) {
    echo ' selected';
}
echo '>4</option>'."\n";
echo '                                        <option value="5"';
if ($taille_titre == 5) {
    echo ' selected';
}
echo '>5</option>'."\n";
echo '                                        <option value="6"';
if ($taille_titre == 6) {
    echo ' selected';
}
echo '>6</option>'."\n";
echo '                                        <option value="7"';
if ($taille_titre == 7) {
    echo ' selected';
}
echo '>7</option>'."\n";
echo '                                    </select>'."\n";
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td>'.$cfg_font_1_n.$lang_CoulLien.$cfg_font_fin.'</td>'."\n";
echo '                                <td align="center">'."\n";
eclat_couleur($couleur_lien,'L');
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td width="40%" bgcolor="#'.$cfg_Tableau.'">'.$cfg_font_1_n.$lang_TailleLien.$cfg_font_fin.'</td>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'."\n";
echo '                                    <select '.$cfg_Formulaire.' name="taille_lien" size="1">'."\n";
echo '                                        <option value="1"';
if ($taille_lien == 1) {
    echo ' selected';
}
echo '>1</option>'."\n";
echo '                                        <option value="2"';
if ($taille_lien == 2) {
    echo ' selected';
}
echo '>2</option>'."\n";
echo '                                        <option value="3"';
if ($taille_lien == 3) {
    echo ' selected';
}
echo '>3</option>'."\n";
echo '                                        <option value="4"';
if ($taille_lien == 4) {
    echo ' selected';
}
echo '>4</option>'."\n";
echo '                                        <option value="5"';
if ($taille_lien == 5) {
    echo ' selected';
}
echo '>5</option>'."\n";
echo '                                        <option value="6"';
if ($taille_lien == 6) {
    echo ' selected';
}
echo '>6</option>'."\n";
echo '                                        <option value="7"';
if ($taille_lien == 7) {
    echo ' selected';
}
echo '>7</option>'."\n";
echo '                                    </select>'."\n";
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td>'.$cfg_font_1_n.$lang_Police.$cfg_font_fin.'</td>'."\n";
echo '                                <td>'."\n";
echo '                                    <select '.$cfg_Formulaire.' name="police" size="1">'."\n";
echo '                                        <optgroup label="-- PC --">'."\n";
echo '                                            <option value="Arial"           ';
if ($police == 'Arial') {
    echo 'selected';
}
echo '>Arial</option>'."\n";
echo '                                            <option value="Times New Roman" ';
if ($police == 'Times New Roman') {
    echo 'selected';
}
echo '>Times New Roman</option>'."\n";
echo '                                            <option value="Courier New"     ';
if ($police == 'Courier New') {
    echo 'selected';
}
echo '>Courier New</option>'."\n";
echo '                                        </optgroup>'."\n";
echo '                                        <optgroup label="-- Mac --">'."\n";
echo '                                            <option value="Helvetica"       ';
if ($police == 'Helvetica') {
    echo 'selected';
}
echo '>Helvetica</option>'."\n";
echo '                                            <option value="Georgia"         ';
if ($police == 'Georgia') {
    echo 'selected';
}
echo '>Georgia</option>'."\n";
echo '                                            <option value="Times"           ';
if ($police == 'Times') {
    echo 'selected';
}
echo '>Times</option>'."\n";
echo '                                            <option value="Courier"         ';
if ($police == 'Courier') {
    echo 'selected';
}
echo '>Courier</option>'."\n";
echo '                                        </optgroup>'."\n";
echo '                                        <optgroup label="-- PC/Mac --">'."\n";
echo '                                            <option value="Verdana"         ';
if ($police == 'Verdana') {
    echo 'selected';
}
echo '>Verdana</option>'."\n";
echo '                                        </optgroup>'."\n";
echo '                                    </select>'."\n";
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'.$cfg_font_1_n.$lang_Title.$cfg_font_fin.'</td>'."\n";
echo '                                <td bgcolor="#'.$cfg_Tableau.'">'."\n";
echo '                                    <input type="text" '.$cfg_Formulaire.' name="titre" size="20" maxlength="255" value="'.$titre.'">'."\n";
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                            <tr>'."\n";
echo '                                <td width="40%">'.$cfg_font_1_n.$lang_Target.$cfg_font_fin.'</td>'."\n";
echo '                                <td>'."\n";
echo '                                    <select '.$cfg_Formulaire.' name="target" size="1">'."\n";
echo '                                        <option value="1" ';
if ($target == 1) {
    echo 'selected';
}
echo '>'.$lang_Non.'</option>'."\n";
echo '                                        <option value="2" ';
if ($target == 2) {
    echo 'selected';
}
echo '>'.$lang_Oui.'</option>'."\n";
echo '                                    </select>'."\n";
echo '                                </td>'."\n";
echo '                            </tr>'."\n";
echo '                        </table>'."\n";
if ($mise_en_page_id != 0) {
    echo '                        <input type="submit" name="Submit" value="'.$lang_Modifier.'">'."\n";
} else {
    echo '                        <input type="submit" name="Submit" value="'.$lang_Creer.'">'."\n";
}
echo '                    </form>'."\n";
echo '                    <br>'."\n";
/**
 * [fr]Exemple de mise en page pour facilité le choix
 */
$font_rubrique   = '<font face="'.$police.'" size="'.$taille_titre.'" color="#'.$couleur_titre.'">';
$font_lien       = '<font face="'.$police.'" size="'.$taille_lien.'" color="#'.$couleur_lien.'">';
echo '                    <table width="200px" border="1" cellspacing="0" cellpadding="10">'."\n";
echo '                        <tr>'."\n";
echo '                            <td bgcolor="#'.$fond.'">'."\n";
echo '                                <p><br>&nbsp;&nbsp;'.$font_rubrique.'<b>'.$lang_Rubrique.'</b>'.$cfg_font_fin."</p>\n";
echo '                                <p>&nbsp;&nbsp;<a href="#">'.$font_lien.$lang_Lien.$cfg_font_fin."</a></p>\n";
echo '                            </td>'."\n";
echo '                        </tr>'."\n";
echo '                    </table><br>'."\n";
?>