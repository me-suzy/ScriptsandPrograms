<?php

$destinationDirectory = 'brim';
?>

<html>
<head>
	<title>Brim - Unpack utility</title>
	<style type="text/css">
		body
		{
			font: 14px arial,helvetica,sans-serif
		}
	</style>
</head>

<body>
<?php

if (isset ($_POST['action']) && $_POST['action'] == 'selectTar')
{
	require("Tar.php");
	$tar_object = new Archive_Tar($_POST['packedFile'], "gz");
	$tar_object->extract(".");

	echo '
		If no errors have appeared, then all files are properly
		extracted. Click <a href="brim/install.php">here</a> to
		go to the installation script
	';
}
else if (file_exists ($destinationDirectory) && 
	is_writable ($destinationDirectory))
{
	
	echo '
		<h2>Brim directory found and it is writeable</h2>
		<p>
			Beware that if this directory contains a (older) version
			of brim, that these files will be overwritten. 
			Continue  at your own risk
		</p>
		<p>
			Please provide the <em>exact</em> filename:
		</p>
		<form action="'.$_PHP_SELF.'" method="POST">
		<input type="text" name="packedFile" />
		<input type="hidden" name="action" value="selectTar" />
		<input type="submit" value="Submit" />
		</form>
	';
}
else if (file_exists ($destinationDirectory))
{
	echo '
		<h2>Brim directory found but it is not writeable!</h2>
		<p>
			Set the appropriate permissions on the directory.
			On *nix systems, a chmod 777 of the directory will do.
		</p>
		<p>
			Reload this page when the directory permissions are properly set.
		</p>
	';
}
else
{
	echo '
		<h2>Destination directory (brim) not found!</h2>
		<p>
			Make sure that there is a directory within the current
			directory that is called "brim" and that is is writeable
			(on *nix systems: chmod 777).
		</p>
		<p>
			Reload this page when the directory is created
			and the permissions are properly set.
		</p>
	';
}
?>
</body>
</html>
