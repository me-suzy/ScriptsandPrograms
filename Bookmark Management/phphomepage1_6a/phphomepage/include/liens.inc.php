<?php
/**
 * [fr]Fichier d'ajout des liens de la homepage
 * [en]File of addition of the links of the homepage
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
if (empty($titre) AND !empty($_POST['titre'])) {
    $titre = $_POST['titre'];
}
if (empty($url) AND !empty($_POST['url'])) {
    $url = $_POST['url'];
}
if (empty($rubrique) AND !empty($_POST['rubrique'])) {
    $rubrique = $_POST['rubrique'];
}
if (empty($sup_lien) AND !empty($_POST['sup_lien'])) {
    $sup_lien = $_POST['sup_lien'];
}
if (empty($new_titre) AND !empty($_POST['new_titre'])) {
    $new_titre = $_POST['new_titre'];
}
if (empty($new_rubrique) AND !empty($_POST['new_rubrique'])) {
    $new_rubrique = $_POST['new_rubrique'];
}
if (empty($new_url) AND !empty($_POST['new_url'])) {
    $new_url = $_POST['new_url'];
}
if (empty($choix_lien) AND !empty($_POST['choix_lien'])) {
    $choix_lien = $_POST['choix_lien'];
}
if (empty($rubriques_id) OR $rubriques_id == '') {
    echo '                    '.$cfg_font_1_r.'<b>'.$lang_ErrorLienRub.'</b>'.$cfg_font_fin.'<br>'."\n";
}
if (isset($sup_lien) OR isset($_POST['sup_lien'])) {
    if (empty($_POST['sup_lien']) OR $sup_lien == '') {
        echo '                    '.$cfg_font_1_r.'<b>'.$lang_ErrorRubNom.'</b>'.$cfg_font_fin.'<br>'."\n";
    } else {
        echo '                    '.$cfg_font_1_v.'<b>'.$lang_LienSupOK.'</b>'.$cfg_font_fin.'<br>'."\n";
        $query2 = 'UPDATE liens SET actif = \'1\' WHERE id = '.$sup_lien;
        mysql_query ($query2);
    }
}
if (isset($titre) OR isset($_POST['titre'])) {
    if ((empty($_POST['titre']) OR $titre == '') OR $url == 'http://' OR $url == '' OR (empty($_POST['rubrique']) OR $rubrique == '')) {
        if (empty($_POST['titre']) OR $titre == '') {
            echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienNom.'</b>'.$cfg_font_fin.'<br>'."\n";
        }
        if ($url == '' OR $url == 'http://') {
            echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienURL.'</b>'.$cfg_font_fin.'<br>'."\n";
        }
        if (empty($_POST['rubrique']) OR $rubrique == "") {
            echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienRub.'</b>'.$cfg_font_fin.'<br>'."\n";
        }
    } else {
        echo '                    '.$cfg_font_1_v.'<b>'.$lang_LienOK.'</b>'.$cfg_font_fin.'<br>'."\n";
        $query3          = 'INSERT INTO liens VALUES'."('','','".$titre."','".$rubrique."','".$url."')";
        mysql_query ($query3);
        $titre = '';
        $url = 'http://';
        $rubrique = '';
    }
}
if (isset($choix_lien) OR isset($_POST['choix_lien'])) {
    if (empty($_POST['choix_lien']) OR $choix_lien == '') {
        echo '                    '.$cfg_font_1_r.'<b>'.$lang_ErrorLienModif.'</b>'.$cfg_font_fin."<br>\n";
    }
    if ((empty($_POST['new_titre']) OR $new_titre == '') OR $new_url == 'http://' OR $new_url == '' OR (empty($_POST['new_rubrique']) OR $new_rubrique == '')) {
        if (empty($_POST['new_titre']) OR $new_titre == '') {
        echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienNom.'</b>'.$cfg_font_fin."<br>\n";
        $new_titre = '';
        }
        if ($new_url == '' OR $new_url == 'http://') {
            echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienURL.'</b>'.$cfg_font_fin.'<br>'."\n";
        }
        if (empty($_POST['new_rubrique']) OR $new_rubrique == "") {
            echo '                    '.$cfg_font_1_r.'<b>'.$lang_LienRub.'</b>'.$cfg_font_fin.'<br>'."\n";
        }
    } else {
        echo '                    '.$cfg_font_1_v.'<b>'.$lang_ModifLienOK.'</b>'.$cfg_font_fin."<br>\n";
        $query5          = "UPDATE liens SET titre='".$new_titre."', rubrique_id='".$new_rubrique."', url='".$new_url."' WHERE id='".$choix_lien."'";
        mysql_query ($query5);
    }
}
/**
 * [fr]Ajout d'un lien
 */
echo '                    '.$cfg_font_3_n.'<b>'.$lang_Lien.'</b>'.$cfg_font_fin."<br>\n";
if (!isset($url)) {
    $url  = 'http://';
}
if (!isset($titre)) {
    $titre  = '';
}
if (!isset($rubrique)) {
    $rubrique  = '';
}
echo '                    <form method="post" action="'.$_SERVER['PHP_SELF'].'" name="ajout_lien">'."\n";
echo '                        <input type="hidden" name="homepage" value="'.$homepage.'">'."\n";
echo '                        <input type="hidden" name="page" value="'.$page.'">'."\n";
echo '                        '.$cfg_font_2_n.$lang_LienNew.$cfg_font_fin.'<br><br>'."\n";
echo '                        '.$cfg_font_1_n.$lang_Nom.$cfg_font_fin.'<input type="text" '.$cfg_Formulaire.' name="titre"  size="20" maxlength="255" value="'.$titre.'"><br>'."\n";
echo '                        <input type="text" '.$cfg_Formulaire.' name="url" size="50" maxlength="255" value="'.$url."\"><br>\n";
echo '                        <select name="rubrique" '.$cfg_Formulaire.'>'."\n";
echo '                            <option value="" ';
if (empty($rubrique)) {
    echo "selected";
}
echo '>'.$lang_ChoixRubrique.'</option>'."\n";
choix_rubrique();
echo '                        </select><br>'."\n";
echo '                        <input type="submit" '.$cfg_Formulaire.' name="Submit" value="'.$lang_Creer.'">'."\n";
echo '                    </form>'."\n";
/**
 * [fr]Supprimer un lien
 */
echo '                    <form method="post" action="'.$_SERVER['PHP_SELF'].'" name="sup_lien">'."\n";
echo '                        <input type="hidden" name="homepage" value="'.$homepage.'">'."\n";
echo '                        <input type="hidden" name="page" value="'.$page.'">'."\n";
echo '                        '.$cfg_font_2_n.$lang_LienSup.$cfg_font_fin.'<br><br>'."\n";
echo '                        <select name="sup_lien" '.$cfg_Formulaire.' size="1">'."\n";
echo '                            <option value="" selected>'.$lang_LienChoix.'</option>'."\n";
choix_lien();
echo '                        </select><br>'."\n";
echo '                        <input type="submit" '.$cfg_Formulaire.' name="Submit" value="'.$lang_Supprimer.'">'."\n";
echo '                    </form>'."\n";
/**
 * [fr]Modification d'une rubrique
 */
if (!isset($new_titre)) {
    $new_titre  = '';
}
if (!isset($new_url)) {
    $new_url  = '';
}
echo '                    <form method="post" action="'.$_SERVER['PHP_SELF'].'" name="modif_lien">'."\n";
echo '                        <input type="hidden" name="homepage" value="'.$homepage.'">'."\n";
echo '                        <input type="hidden" name="page" value="'.$page.'">'."\n";
echo '                        '.$cfg_font_2_n.$lang_ModifUnLien.$cfg_font_fin.'<br><br>'."\n";
echo '                        <select name="choix_lien" '.$cfg_Formulaire.' size="1">'."\n";
echo '                            <option value="">'.$lang_LienChoix.'</option>'."\n";
choix_lien(1);
echo '                        </select>'."\n";
echo '                        <br>'."\n";
echo '                        '.$cfg_font_1_n.$lang_Nom.$cfg_font_fin."\n";
echo '                        <input type="text" '.$cfg_Formulaire.' name="new_titre" size="20" maxlength="255" value="'.$new_titre.'">'."\n";
echo '                        <br>'."\n";
echo '                        <input type="text" '.$cfg_Formulaire.' name="new_url" size="50" maxlength="255" value="'.$new_url."\"><br>\n";
echo '                        <select name="new_rubrique" '.$cfg_Formulaire.'>'."\n";
echo '                            <option value="" ';
if (empty($rubrique)) {
    echo "selected";
}
echo '>'.$lang_ChoixRubrique.'</option>'."\n";
choix_rubrique();
echo '                        </select><br>'."\n";
echo '                        <input type="submit" '.$cfg_Formulaire.' name="Submit" value="'.$lang_Modifier.'">'."\n";
echo '                    </form>'."\n";
?>