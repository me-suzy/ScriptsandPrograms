<table class=calnavmois>
<tr class=y>
<td class=w></td>
<td onClick="go('?<? echo "y=".($CALPARAMS["date"]["y"]-1)."&m=".$CALPARAMS["date"]["m"]."&d=".$CALPARAMS["date"]["d"]; ?>')"><img src="img/left.gif"></td>
<td colspan=5 onClick="go('?ts=now')"><? echo $CALPARAMS["date"]["annee"]; ?></td>
<td onClick="go('?<? echo "y=".($CALPARAMS["date"]["y"]+1)."&m=".$CALPARAMS["date"]["m"]."&d=".$CALPARAMS["date"]["d"]; ?>')"><img src="img/right.gif"></td>
</tr>
<tr class=m>
<td class=w></td>
<td onClick="go('?<?
$d=$CALPARAMS["date"]["d"];
$y=$CALPARAMS["date"]["y"];
$m=$CALPARAMS["date"]["m"]-1;
if($m<1) { $m=12; $y--; }
echo "y=$y&m=$m&d=$d";
?>')"><img src="img/left.gif"></td>
<td colspan=5 onClick="go('?ts=now')"><? echo strftime("%B",$CALPARAMS["date"]["ts"]); ?></td>
<td onClick="go('?<?
$d=$CALPARAMS["date"]["d"];
$y=$CALPARAMS["date"]["y"];
$m=$CALPARAMS["date"]["m"]+1;
if($m>12) { $m=1; $y++; }
echo "y=$y&m=$m&d=$d";
?>')"><img src="img/right.gif"></td>
</tr>
<tr class=w>
<td class=w></td>
<?
for($j=0;$j<7;$j++)
{
	$w=($j+CAL_FIRST_DAY_OF_WEEK)%7;
?>
<td><? echo $CALANGUAGE["monthnav.days.$w"]; ?></td>
<?
}
?>
</tr>
<?
$tsd=$CALPARAMS["date"]["mois"]["debut"]+ONEDAY/2;
$w=lang_getw($tsd);
if($w>0)
{
	$wn=lang_getwn($tsd);
?>
<tr class=<? if($wn==lang_getwn($CALPARAMS["date"]["ts"])) echo "s"; else echo "d"; ?>>
<td class=w><? echo $wn; ?></td>
<?
	for($ts=$tsd-ONEDAY*$w,$i=0;$ts<$tsd;$ts+=ONEDAY,$i++)
	{
			$d=date("d",$ts);
			$m=date("m",$ts);
			$y=date("Y",$ts);
?>
<td<? if(isset($PLANNING[$m][$d])) echo " class=e".count($PLANNING[$m][$d]); else echo " class=o"; ?> onClick="go('?<? echo "ts=$ts"; ?>')"><? if($CALPARAMS["now"]["y"]==$y&&$CALPARAMS["now"]["m"]==$m&&$CALPARAMS["now"]["d"]==$d) echo "<b>$d</b>"; else echo $d; ?></td>
<?
	}
	for(;$i<7;$ts+=ONEDAY,$i++)
	{
			$d=date("d",$ts);
			$m=date("m",$ts);
			$y=date("Y",$ts);
?>
<td<? if($d==$CALPARAMS["date"]["d"]) echo " class=s"; else if(isset($PLANNING[$m][$d])) echo " class=e".count($PLANNING[$m][$d]); ?> onClick="go('?<? echo "ts=$ts"; ?>')"><? if($CALPARAMS["now"]["y"]==$y&&$CALPARAMS["now"]["m"]==$m&&$CALPARAMS["now"]["d"]==$d) echo "<b>$d</b>"; else echo $d; ?></td>
<?
	}
?>
</tr>
<?
}
else $ts=$tsd;
for(;;)
{
	if($CALPARAMS["date"]["mois"]["m"]!=date("m",$ts)) break;
	$wn=lang_getwn($ts);
?>
<tr class=<? if($wn==lang_getwn($CALPARAMS["date"]["ts"])) echo "s"; else echo "d"; ?>>
<td class=w><? echo $wn; ?></td>
<?
	for($i=0;$i<7;$ts+=ONEDAY,$i++)
	{
		$d=date("d",$ts);
		$m=date("m",$ts);
		$y=date("Y",$ts);
?>
<td<? if($CALPARAMS["date"]["mois"]["m"]==$m) { if($d==$CALPARAMS["date"]["d"]) echo " class=s"; else if(isset($PLANNING[$m][$d])) echo " class=e".count($PLANNING[$m][$d]); } else if(isset($PLANNING[$m][$d])) echo " class=e".count($PLANNING[$m][$d]); else echo " class=o"; ?> onClick="go('?<? echo "ts=$ts"; ?>')"><? if($CALPARAMS["now"]["y"]==$y&&$CALPARAMS["now"]["m"]==$m&&$CALPARAMS["now"]["d"]==$d) echo "<b class=s>$d</b>"; else echo $d; ?></td>
<?
	}
?>
</tr>
<?
}
?>
<tr></tr>
</table>
