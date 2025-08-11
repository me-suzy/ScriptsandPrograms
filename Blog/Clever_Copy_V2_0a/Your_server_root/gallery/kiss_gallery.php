<?php
include "languages/default.php";
?>
<html>
<head>
<title>Gallery</title>
<link rel="stylesheet" type="text/css" href="admin/style.css">
</head>
<body>
<?php
// Based on code by http://www.ricocheting.com, converted to use database by Liquid Frog - www.liquidfrog.com and integrated by Clever Copy
include "admin/connect.inc";
$getprefs="SELECT * from CC_gallery";
$getprefs2=mysql_query($getprefs) or die($no_galpreferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$picture_spacing = $getprefs3[picspacing];
$option['cols'] = $getprefs3[galcols];
$option['rows'] = $getprefs3[galrows];
$option[not_found]= $gal_directory_not_found_label;
$option[could_not_create] = $could_not_create_directory;
$option[not_found2] = $try_again;
$option['imagemethod'] = $getprefs3[imagemethod];
$option['convert'] = $getprefs3[convert];
$option['identify'] = $getprefs3[identify];
$option['imagequality'] = $getprefs3[imagequality];
echo "<body bgcolor=$getprefs3[galbackgroundcolor]>";
echo "<center><b><h4> $getprefs3[galtitle]</b></h4></center>";
echo"<table border='0' cellpadding='0' cellspacing=$picture_spacing align='center'bgcolor=$getprefs3[galbackgroundcolor]>";
echo "<tr><td align=\"center\"  colspan=\"$option[cols]\" style=\"padding:3px;\" class=\"border\">\n";
echo $getprefs3[galtopmessage];
echo"<table border='0' cellpadding='0' cellspacing=$picture_spacing align='center'bgcolor=$getprefs3[galbackgroundcolor]>";
$option['fulls']="gallery/photos/";
$option['maxShow'] = 2;
$option['start'] = 0;
$option['max'] = 0;
$option['page'] = isset($_GET['page'])?$_GET['page']:"0";
$option['size'] = 160; // max image width/height
$option['thumbs'] = "$option[fulls]thumb";
if(isset($_GET['entry'])){
        GetEntry();
}else{
        PrintThumbs();
}
function PrintThumbs(){
        global $option;
        if (!file_exists($option['fulls'])) {
                oops("$option[fulls] $option[not_found]");
                die;
        }
        if (!file_exists($option['thumbs'])) {
                if (!mkdir($option['thumbs'], 0755)) {
                        oops("$option[thumbs] $option[could_not_create]");
                        die;
                }
        }
        $imagelist = GetFileList($option['fulls']);
        $option['start']=($option['page']*$option['cols']*$option['rows']);
        $option['max']=( ($option['page']*$option['cols']*$option['rows']) + ($option['cols']*$option['rows']) );
        if($option['max'] > count($imagelist)){$option['max']=count($imagelist);}
        echo "<tr><td align=\"right\"  colspan=\"$option[cols]\" style=\"padding:3px;\" class=\"border\">\n";
        if ($option['max'] == "0"){echo "0/0</td></tr>\n";}
        else{echo "&nbsp;".($option['start']+1)."$config[max]/".count($imagelist)."</td></tr>\n";}
        echo "<tr>";
        $temp=1;
        for($i=$option['start']; $i<$option['max']; $i++){
                $thumb_image = $option['thumbs']."/".$imagelist[$i];
                $thumb_exists = file_exists($thumb_image);
                if(!$thumb_exists){
                        set_time_limit(30);
                        $thumb_exists = ResizeImage("$option[fulls]$imagelist[$i]", $thumb_image, $option['size']);
                }
                $imagelist[$i] = rawurlencode($imagelist[$i]);
                $thumb_image = $option['thumbs']."/".$imagelist[$i];
                echo "<td valign=\"middle\" align=\"center\" class=\"border\"><a href=\"$option[fulls]$imagelist[$i]\" title=\"$imagelist[$i]\" target=\"_blank\">";
                if ($thumb_exists) {
                        echo "<img src=\"$thumb_image\" border=\"0\" alt=\"$imagelist[$i]\">";
                } else {
                        echo "$imagelist[$i]";
                }
                echo "</a></td>\n";
                if(($temp == $option['cols']) && ($i+1 != $option['max'])){
                        echo "</tr><tr><td colspan=\"$option[cols]\" class=\"spacer\">&nbsp;</td></tr><tr>\n";
                        $temp=0;
                }
                $temp++;
        }
        if($option['start'] == $option['max']){
                echo "<td align=\"center\" colspan=\"$option[cols]\" class=\"spacer\"> ------- </td>\n";
        }
        elseif($temp != $option['cols']+1){
                echo "<td align=\"center\" colspan=\"".($option['cols']-$temp+1)."\">&nbsp;</td>\n";
        }
        echo "</tr>";
GetPageNumbers(count($imagelist));
}

function GetEntry(){
        global $option;
if(!file_exists("$option[fulls]$_GET[entry]")){
        oops("$option[not_found]");
        return false;
}
echo "<a href=\"$_SERVER[HTTP_REFERER]\">Back</a><br>";
echo "<img src=\"$option[fulls]$_GET[entry]\">";
}

function GetFileList($dirname="."){
        global $option;
        $list = array();
        if ($handle = opendir($dirname)) {
                while (false !== ($file = readdir($handle))) {
                        if (preg_match("/\.(jpe?g|gif|png)$/i",$file)) {
                                $list[] = $file;
                        }
                }
                closedir($handle);
        }
        sort($list);
        return $list;
}

function oops($msg) {
include "languages/default.php";
?>
<table align=center>
<tr><td class=header>
Error
</td></tr>
<tr><td class=entry>
<br><?=$msg?>
<br><br>
<hr size=1 noshade width="80%" class=desc>
<?php
echo "<center> <a href='javaScript:history.back();'><b>$back_link</b></a> $try_again</center>";
?>
</td></tr></table>
<?php
}

function ResizeImage($image, $newimage, $size) {
   global $option;
   switch ($option['imagemethod']) {
                case "imagemagick":
                return ResizeImageUsingIM($image, $newimage, $size);
                        break;
                case "gd1":
                case "gd2":
                        return ResizeImageUsingGD($image, $newimage, $size);
                        break;
                default:
                        return false;
                        break;
        }
}

function ResizeImageUsingGD($image, $newimage, $size) {
        list ($width,$height,$type) = GetImageSize($image);
        if($im = ReadImageFromFile($image,$type)){
                if($height < $size && $width < $size){
                        $newheight=$height;
                        $newwidth=$width;
                }
                else if($height > $width){
                        $newheight=$size;
                        $newwidth=($width / ($height/$size));
                }
                else{
                        $newwidth=$size;
                        $newheight=($height / ($width/$size));
                }
                $im2=ImageCreateTrueColor($newwidth,$newheight);
                ImageCopyResampled($im2,$im,0,0,0,0,$newwidth,$newheight,$width,$height);
                if(WriteImageToFile($im2,$newimage,$type)){
                        return true;
                }
        }
return false;
}

function ResizeImageUsingIM($image, $newimage, $size) {
   global $option;
   Exec("$option[identify] -ping -format \"%w %h\" \"$image\"", $sizeinfo);
   if (! $sizeinfo ) {
      return false;
   }
   $size = explode(" ", $sizeinfo[0]);
   $width  = $size[0];
   $height = $size[1];
   if (!$width) {
      return false;
   }
                if($height < $size && $width < $size){
                        $newheight=$height;
                        $newwidth=$width;
                }
                else if($height > $width){
                        $newheight=$size;
                        $newwidth=($width / ($height/$size));
                }
                else{
                        $newwidth=$size;
                        $newheight=($height / ($width/$size));
                }
   Exec("$option[convert] -geometry \"$newwidth"."x"."$newheight\" -quality \"$option[imagequality]\" \"$image\" \"$newimage\"");
   return file_exists($newimage);
}

function ReadImageFromFile($filename, $type) {
        $imagetypes = ImageTypes();
        switch ($type) {
                case 1 :
                        if ($imagetypes & IMG_GIF){
                                return $im = ImageCreateFromGIF($filename);
                        }
                break;
                case 2 :
                        if ($imagetypes & IMG_JPEG){
                                return ImageCreateFromJPEG($filename);
                        }
                break;
                case 3 :
                        if ($imagetypes & IMG_PNG){
                                return ImageCreateFromPNG($filename);
                        }
                break;
                default:
                return 0;
        }
}

function WriteImageToFile($im, $filename, $type) {
        global $option;
        switch ($type) {
                case 1 :
                        return ImageGIF($im, $filename);
                case 2 :
                        return ImageJpeg($im, $filename, $option['imagequality']);
                case 3 :
                        return ImagePNG($im, $filename);
                default:
                        return false;
        }
}

function GetPageNumbers($entries) {
        global $option;
        $option['totalPages']=Ceil(($entries)/($option['cols']*$option['rows']));
        echo "<tr><td colspan=$option[cols] align=center height=20 class=border>";
        if( ($option['page']-1) >= 0){
         echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=0\" class=page><img border= '0' src='gallery/photos/buttons/rewind.gif'></a>";
         echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=".($option['page']-1)."\" class=page><img border= '0' src='gallery/photos/buttons/previous.gif'></a>";}
         else{
              echo "<img border= '0' src='gallery/photos/buttons/rewind.gif'>";
              echo "<img border= '0' src='gallery/photos/buttons/previous.gif'>";}
              $start=0;
              $end=$option['totalPages']-1;
              if($option['maxShow'] < $option['page'] || (($option['cols']*$option['rows']*$option['maxShow'])< $entries) ){
                        if($option['page'] >= ($option['maxShow']+1) && $option['page'] < $end-$option['maxShow']){ $start = $option['page']-$option['maxShow'];}
                        elseif($end < $option['page']+$option['maxShow']+1 && $option['totalPages']-1 >= $option['maxShow']*2+1){$start = $option['totalPages']-1-$option['maxShow']*2;}
                        else{$start=0;}
                        if( $option['page']+$option['maxShow']+1 > $option['totalPages']-1 ){$end = $entries/($option['cols']*$option['rows']);}
                        elseif($start == 0 && $end > $option['maxShow']*2){$end = $option['maxShow']*2;}
                        elseif($start == 0 && $option['totalPages'] <= $option['maxShow']*2){$end = $option['totalPages']-1;}
                        else{$end = ($option['page']+$option['maxShow']);}
              }
        if($start > 0){echo " - ";}
        else{echo " - ";}
        for($i=$start; $i<=$end ; $i++){
                if($option['page']==$i){echo "<b><font color = '#C00000'>[</b>".($i+1)."<b>]</font></b> \n";}
                else{echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=$i\" class=page><b>".($i+1)."</b></a> \n";}
        }
        if(Ceil($end) < $option['totalPages']-1){echo " - ";}
        else{echo " - ";}
        if( ($option['page']+1) <= $option['totalPages']-1){
        echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=".($option['page']+1)."\" class=page><img border= '0' src='gallery/photos/buttons/next.gif'></a>";
        echo "<a href=\"$_SERVER[SCRIPT_NAME]?page=".($option['totalPages']-1)."\" class=page><img border= '0' src='gallery/photos/buttons/fastforward.gif'></a>";
        }else{echo " <img border= '0' src='gallery/photos/buttons/next.gif'>";
         echo " <img border= '0' src='gallery/photos/buttons/fastforward.gif'>";
        }
}
?>