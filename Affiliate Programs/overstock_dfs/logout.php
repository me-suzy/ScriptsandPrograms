<?php
session_start();

session_unset();
session_destroy();

echo "<html><head></head><body>";
echo "<script language='JavaScript'>parent.window.location.href='login.php';</script>  </body></html>";

?>
