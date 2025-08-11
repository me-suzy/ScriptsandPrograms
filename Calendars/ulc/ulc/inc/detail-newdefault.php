<form class=new action="form.php?new=default&ts=<? echo $CALPARAMS["date"]["ts"]; ?>" method=post>
<table>
<tr><td></td>
</td><td class=t><? echo $CALANGUAGE["dayevent.newdefault"]; ?></td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.title"]; ?>
</td><td class=d>
<input name=titre maxlength=64 size=32 value="<? if(isset($_COOKIE["titre"])) echo $_COOKIE["titre"]; ?>">
</td></tr>
<tr><td class=g>
<? echo $CALANGUAGE["formevent.date"]; ?>
</td><td class=d>
<input id=debut name=debut maxlength=10 size=10 value="<? echo date("d/m/Y",$CALPARAMS["date"]["ts"]); ?>"><i>(<? echo $CALANGUAGE["formevent.dateformat"]; ?>)</i>
</td></tr>
<tr><td>
</td><td class=d>
<input type=submit value="<? echo $CALANGUAGE["formevent.submit"]; ?>">
<i>(<? echo $CALANGUAGE["formevent.submit.text"]; ?>)</i>
</td></tr>
</table>
</form>
