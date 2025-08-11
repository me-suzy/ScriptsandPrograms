<?php
/************************************************************************/
/* G-Shout : Gravitasi Shoutbox                                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2005 by Yohanes Pradono                                */
/* http://gravitasi.com                                                 */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/*                                                                      */
/************************************************************************/

// to prevent direct access
if (eregi("footer.inc.php",$_SERVER['PHP_SELF'])) {           
	die("<b>Access Denied!</b><br /><i>You can't access this file directly...</i><br /><br />- G-Shout -");
}

echo "
<div class='copyright'>
<a href='javascript:void(0)' onclick='javascript:about()'>G-Shout ".$version."</a> - Copyright &copy; 2005 - <a href='http://gravitasi.com' target='_blank'>Gravitasi</a>
<br />
"._PAGE_GENERATED_IN." ".number_format(timer_stop(), 2)." "._SECONDS."
</div>
</body>
</html>
";