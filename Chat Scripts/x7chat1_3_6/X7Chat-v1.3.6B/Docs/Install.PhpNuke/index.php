<?

    if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
	die ("You can't access this file directly...");
    }

   $module_name = basename(dirname(__FILE__));

    include("header.php");
    OpenTable();
    	echo '	<script language="javascript" type="text/javascript">
			window.open("http://x7chat.com/Nuke/Chat/","Chat");
		</script>
		Chat will load in a new window......';
    CloseTable();
    include("footer.php");

?>