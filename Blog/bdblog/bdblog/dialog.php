<?php
// Configuration
include('config/config.php');

// Authenticate
if ( !($_SERVER['PHP_AUTH_USER']===ADMIN_USERNAME && $_SERVER['PHP_AUTH_PW']===ADMIN_PASSWORD) )
{
	header('WWW-Authenticate: Basic realm="bd:blog"');
	header('HTTP/1.0 401 Unauthorized');
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Invalid user information</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#FF0000">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="middle" style="color: yellow">Invalid user information</td>
  </tr>
</table>
</body>
</html>
	<?php
	exit();
}

// Libraries
include('lib/bdDB.php');
include('lib/TableHandler.php');
include('lib/CategoriesHandler.php');
include('lib/EntriesHandler.php');

$db = new bdDB( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );

// Handlers
$categoriesHandler = new CategoriesHandler( $db );
$entriesHandler = new EntriesHandler( $db );

// Controls
include('controls/DateControl.php');
include('controls/CategoryControl.php');

// register_globals
import_request_variables('gp');

switch( $_a )
{
	case 'CategoryAdd':
		$categoriesHandler->insert( $_REQUEST );
		break;
	case 'CategoryRename':
		$categoriesHandler->update( $id, $_REQUEST );
		break;
	case 'CategoryDelete':
		$categoriesHandler->delete( $id );
		$entriesHandler->transferCategoryToUnfiled( $id );
		break;
	case 'NewEntry':
		$vars = $_POST;
		$vars['date'] = $year.'-'.$month.'-'.$day;
		$entriesHandler->insert( $vars );
		?>
		<script language="JavaScript">
		<!--
		opener.location = 'index.php?date=<?= $year ?>-<?= $month ?>-<?= $day ?>'
		window.close();
		// -->
		</script>
		<?
		break;
	case 'UpdateEntry':
		$vars = $_POST;
		$vars['date'] = $year.'-'.$month.'-'.$day;
		$entriesHandler->update( $id, $vars );
		?>
		<script language="JavaScript">
		<!--
		opener.location = 'index.php?date=<?= $year ?>-<?= $month ?>-<?= $day ?>'
		window.close();
		// -->
		</script>
		<?
		break;
	case 'DeleteEntry':
		$entriesHandler->delete( $id );
		?>
		<script language="JavaScript">
		<!--
		opener.location = '<?= $referer ?>'
		window.close();
		// -->
		</script>
		<?
		break;
}

switch( $_d )
{
	case 'EditCategories':
		include('dialogs/EditCategoriesDialog.php');
		$contents = new EditCategoriesDialog( $categoriesHandler->getList(), $referer );
		$title = 'Category Editor';
		break;
	case 'NewEntry':
		include('dialogs/NewEntryDialog.php');
		$contents = new NewEntryDialog( new CategoryControl( $categoriesHandler->getFullList(), 'category',0 , false  ) );
		$title = 'New Entry';
		break;
	case 'UpdateEntry':
		include('dialogs/UpdateEntryDialog.php');
		$info = $entriesHandler->getInfo( $id );
		$contents = new UpdateEntryDialog( new CategoryControl( $categoriesHandler->getFullList(), 'category', $info['category'] , false  ), $info, $referer );
		$title = 'Update Entry';
		break;
	case 'DeleteEntry':
		include('dialogs/DeleteEntryDialog.php');
		$contents = new DeleteEntryDialog( $entriesHandler->getInfo( $id ), $referer );
		$title = 'Delete Entry';
		break;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?= $title ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<script language="Javascript1.2"><!-- // load htmlarea
_editor_url = "3rdparty/htmlarea/";                     // URL to htmlarea files
var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
if (win_ie_ver >= 5.5) {
  document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  document.write(' language="Javascript1.2"></scr' + 'ipt>');  
} else { document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); }
// --></script>
<script language="JavaScript" src="scripts.js"></script>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" valign="top"><? $contents->printWidget() ?></td>
  </tr>
</table>
</body>
</html>