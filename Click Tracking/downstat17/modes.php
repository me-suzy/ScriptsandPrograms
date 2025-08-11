<?           
             
if(!@include($art."downstat_art/in_html.php")){ exit("upload ".$art."in_html.php"); }   
if(!@include($art."in_php.php")){ exit("upload ".$art."in_php.php"); }   
$lnm=0;      
$fd = fopen( $datafile, 'r' )or die ("Please upload $datafile, and then press \"refresh\".");          
while( !feof($fd) ){        
$fge= fgets($fd);           
$lines[]=$fge;              
if($lnm > 1){
$br=explode('^^',$fge);     
if($add && "$br[2]" !== "Trash"){          
if($br[2] !== Trash)$filedata[$br[0]]=$br[0];    
}// if add   
if("$br[2]" !== "N&ONeF6" && "$br[2]" !== "Trash")$catdata[$br[2]]=$br[2];              
}//if $fge   
$lnm++;      
}//end loop  
$brs=explode('^^',$lines[1]);              
if($brs[11] !== $ip && $brs[12] !== NoLogAT  ){  exit($errorpage[nologin]); }  

     
startpage(); 
if($add){    
if($add == 'file'){         
$fd = @fopen( $filepath, 'r' )or die('Cannot Open '.$filepath);          
while( !feof($fd) ){        
$buffer = fgets( $fd);              
if($buffer)$inputfiles[]=$bacepath.str_replace("\n",'',$buffer);         
  }          
fclose($fd); 
}elseif($add==drive){     

$paths = pathinfo($webpath);    
$bstart =str_replace($_SERVER[DOCUMENT_ROOT],$_SERVER[HTTP_HOST],$webpath);
$d=@dir($webpath)or die ('No Such directory as '.$webpath.'<meta http-equiv="refresh" content="2;URL=modes.php?goto=multi">
');              
while(false!==($entry=$d->read())) if(is_file($webpath.'/'.$entry) && ( ($addonly  &&  eregi(str_replace(',','|',$onlyquery), $entry) ) or  !$addonly)) $inputfiles[]= 'http://'.$bstart.$entry;        
}// if add==drive           
if("$category" == "nXew"){  
$catdata[$cataname]=$cataname;             
$category =$cataname;  }    
$num=1;      
$exi=0;   
              
foreach($inputfiles as $addi){   

if($addi){   
$inidi=$addi;  

             
if($id == afterfilename){   

if($pos == before){
if(!($inidi = substr($addi, 0 , strpos($addi, $char)-0) ))$inidi=$addi;   
}else{ // else if pos == after
if( !($inidi = substr($addi, strrpos($addi, $char) + 1)))$inidi=$addi;
}

}// end of if $id == afterfilename        

if($id==nameid)$inidi=substr($inidi, strrpos($inidi, '/') + 1); 
              
if($id == number )$inidi=$num;             
$exists=false;              
$exists = $filedata[$inidi];

             
if($exists)$exi++;          
if(!$exists){

$filedata[$inidi]=$inidi;
 $lines[]= "$inidi^^$addi^^$category^^off^^off^^off^^^^".time()."^^^^\n";
 $g++;       
 }           
$num++;      
}// if addi  
}// end foreach             
$input=true; 
$alert=words($g,File)." added. ";          
if($exi)$alert .= words($exi,File).' already exist and wasn\\\'t added';
}//if add      
           
function catelistmen($catdata){            
global $category;           
 if("$category" == "N&ONeF6")$s= selected; 
$catemenu .= '<option value="N&ONeF6" '.$s.'></option>';  
if(!empty($catdata)){       
 foreach($catdata as $cnk => $del){        
 $s='';      
 if("$category" == "$cnk")$s= selected;    
if("$cnk" !== "N&ONeF6" && "$cnk" !== "Trash"){           
$catemenu .=  "<option $s>$cnk</option>\n";
 }} }        
 return $catemenu;          
 }      
      
if($goto == multi){         
$tfile=' .txt';             
if($filepath)$tfile=$filepath;             
$catemenu=catelistmen($catdata);           
$thishttp='http://'.str_replace('modes.php', '', $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);          
if($bacepath)$thishttp=$bacepath;
?>           
<style type="text/css">     
<!--         
.inputfield {
	font-size: 11px;           
	background-color: #FAFAFA; 
	border-top: 1px inset #999999;            
	border-right: 1px #999999; 
	border-bottom: 1px #999999;
	border-left: 1px inset #999999;           
}            
-->          
</style>     
<style type="text/css">     
<!--         
.text {      
	font-size: 12px;           
}            
-->          
</style>     
<script language="JavaScript">             
function getid(id){ return document.getElementById(id); } 
function cateselect(crnt){  
if(crnt == 'nXew'){ getid('newcate').style.display='block';              
}else{       
getid('newcate').style.display='none';  }  
}            
</script>    
<form name="form1" method="post" action="">
  <table width="565" border="0" align="center" cellpadding="3" cellspacing="0" class="text">           
    <tr>     
      <td height="32" colspan="3" bgcolor="#BCC0CD"> Add multiple files from TEXT       
        File</td>           
    </tr>    
    <tr>     
      <td width="22" bgcolor="#BCC0CD"><input type="radio" name="add" value="file" <? check($add, 'file') ?>>         
      </td>  
      <td colspan="2" bgcolor="#E2E4E9"><br>              
        TEXT File           
        <input name="filepath" type="text" class="inputfield" id="filepath" value="<? echo $tfile ?>" size="9" onclick="if(this.value=='<? echo $tfile ?>'){this.value=''}">      
        <br> 
        Bace address        
        <input name="bacepath" type="text" class="inputfield" id="bacepath" onclick="if(this.value=='<? echo $thishttp ?>'){this.value=''}" value="<? echo $thishttp ?>" size="30">              
        <br> 
        Downstat will add files from the local text file line by line. <br>             
        Text file must be located on the same directory as downstat.</td>
    </tr>    
    <tr>     
      <td colspan="3"> <p><br>             
        </p></td>           
    </tr>    
    <tr>     
      <td colspan="3" bgcolor="#C0B4B4">Add multiple files from Local web directory.</td>              
    </tr>    
    <tr>     
      <td rowspan="2" bgcolor="#C0B4B4"><input type="radio" name="add" value="drive" <? check($add, drive) ?>>        
        <br> </td>          
      <td colspan="2" bgcolor="#FAFAFA"><p>Downstat will scan the webpath directory     
          and add files.<br>
          <input name="webpath" type="text" class="inputfield" id="webpath" value="<?  echo str_replace('modes.php','',$_SERVER[SCRIPT_FILENAME]) ?>" size="40">   
          <br>              
          <br>              
        </p></td>           
    </tr>    
    <tr>     
      <td colspan="2" bgcolor="#EBEBEB"><input name="addonly" type="checkbox"  value="true" <? check($addonly, true) ?>>             
        Add files that only contain in the filename...<br>
        (not case sensitive)<br> <input name="onlyquery" type="text" class="inputfield"  value="<? if($onlyquery)echo $onlyquery; else echo 'mp3,zip,exe,jpeg';  ?>">             
      </td>  
    </tr>    
    <tr>     
      <td>&nbsp;</td>       
      <td colspan="2">&nbsp;</td>          
    </tr>    
    <tr>     
      <td rowspan="2" bgcolor="#D2D3C9">&nbsp;</td>       
      <td colspan="2" bgcolor="#ECEDE9">For every file found...<br> <input type="radio" name="id" value="number"  <? check($numberids, drive) ?>  <? check($id, number) ?>>       
        Try to number ids, 1,2,3,4,5<br> <input type="radio" name="id" value="afterfilename" <? check($id, afterfilename) ?>>
        Set ID 
        <select name="pos" class="inputfield"  onChange="cateselect(this.options[this.selectedIndex].value)">
          <option value="before">before</option>
          <option value="after" <? if($pos == after)echo selected ?>>after</option>
        </select>
        the charactor 
        <input name="char" type="text" class="inputfield" id="char" size="1" maxlength="1" value="<? echo $char ?>">
        in the filename<br> <input type="radio" name="id" value="nameid" <? if($id == nameid or !$id)echo checked ?>>
        ID as filename<br> </td>            
    </tr>    
    <tr>     
      <td width="190" bgcolor="#ECEDE9">Place in category 
        <select name="category" class="inputfield" id="select" onChange="cateselect(this.options[this.selectedIndex].value)">        
          <? echo $catemenu; ?>
          <option value="nXew">CREATE NEW</option>        
        </select></td>      
      <td width="335" bgcolor="#ECEDE9"><input  style="display:none" name="cataname" type="text" class="inputfield" id="newcate" value="Category Name" onClick="if(this.value=='Category Name'){this.value=''}" size="20"></td>
    </tr>    
    <tr>     
      <td>&nbsp;</td>       
      <td colspan="2"><input type="submit" name="Submit" value="Submit"></td>           
    </tr>    
  </table>   
  </form>    
<?           
}//if goto   
if($input){  
$fp = @fopen($datafile,"w+")or die ("Please set $datafile for read and write permissions, and then press \"refresh\".");             
for($a=0;$a<count($lines);$a++){           
fputs($fp,"$lines[$a]");    
}            
fclose($fp); 
}            
if($alert)echo '<script language="JavaScript">alert(\''.$alert.'\')</script>';          
endpage();   
?>           
