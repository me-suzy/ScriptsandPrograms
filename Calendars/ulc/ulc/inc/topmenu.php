<table class=top>
<tr>
<td class=now onClick="go('?ts=now')"><? echo $CALANGUAGE["topmenu.today"]; ?> <b><? echo strftime($CALANGUAGE["strftime.complete"]); ?></b></td>

<td class=login><?
if(isset($_SESSION["compte"]))
{
?>
<? echo $CALANGUAGE["topmenu.hello"]; ?> <b><? echo $_SESSION["compte"]["nom"]; ?></b>
[<?
if($CALPARAMS["detail"]=="myc")
{
?><a href="#" onClick="go('?')"><? echo $CALANGUAGE["topmenu.events"]; ?></a><?
}
else
{
?><a href="#" onClick="go('?myc')"><? echo $CALANGUAGE["topmenu.calendars"]; ?></a><?
}
?>] 
[<a href="#" onClick="go('login.php?action=deco')"><? echo $CALANGUAGE["topmenu.disconnect"]; ?></a>] 
<?
}
else include("inc/form_login.php");
?>
</td>
</tr>
</table>
