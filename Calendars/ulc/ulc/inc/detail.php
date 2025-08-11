<div class=titrejournee><a href="#" onClick="go('?<? echo "ts=".$CALPARAMS["date"]["ts"]; ?>')"><? echo strftime($CALANGUAGE["strftime.complete"],$CALPARAMS["date"]["ts"]); ?></a></div>
<?

include("inc/detail-$CALPARAMS[detail].php");

?>
	

