<?
@header("Location: $url");
?>
<html>
<head>
<script language=Javascript>
<!--
location.href='<? echo ereg_replace("[']","\\'",$url); ?>';
//-->
</script>
</head>
<body>
<a href="<? echo $url; ?>">cliquez ici</a>
</body>
</html>
<? die(); ?>
