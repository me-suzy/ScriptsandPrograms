<form method=POST action="login.php" class=login>
<? echo $CALANGUAGE["topmenu.login.prompt"]; ?> 
<input title="<? echo $CALANGUAGE["topmenu.login"]; ?>" size=8 type=text name=login value="<? echo (isset($_COOKIE["login"])?$_COOKIE["login"]:"") ?>">
<input title="<? echo $CALANGUAGE["topmenu.password"]; ?>" size=8 type=password name=password value="<? echo (isset($_COOKIE["password"])?$_COOKIE["password"]:"") ?>">
<input type=submit value="OK" title="<? echo $CALANGUAGE["topmenu.ok"]; ?>"><input title="<? echo $CALANGUAGE["topmenu.memorize"]; ?>" type=checkbox name=keep value="yes"<? if(isset($_COOKIE["keep"])&&$_COOKIE["keep"]) echo " checked"; ?>>
</form>
