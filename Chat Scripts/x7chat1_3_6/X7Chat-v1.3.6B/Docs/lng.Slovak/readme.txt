This directory contains a Slovak version of admin.php.  To use it upload
it into the main X7 Chat folder and replace the existing admin.php.

It is highly recommend if you use the Slovak language file that you do the
following steps to make browsers recognize it correctly.
	In the following files: 
		* roomcontrol.php
		* register.php
		* index.php
		* admin.php
		* all files in the /frames directory.
	
	Find:
	--------------------------------------------------
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	--------------------------------------------------
	
	Replace with:
	--------------------------------------------------
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
	--------------------------------------------------
	
	This line usually occurs near the top of the file.
	
	

Translated to Slovak by: Daniel Gustafik
