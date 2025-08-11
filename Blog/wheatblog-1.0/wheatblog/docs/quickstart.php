I. Setting Up the Code

	A. Unpack the code, like: /www/wheatblog
	B. Make sure the directory is readable/writable by your web server.


II. Create a database file.

	A. For SQLite users:

		1. cd ~/wheatblog
		2. sqlite wheatblog.db
		3. Type: .read tools/wheatblog.sql
		4. Type: .quit
		5. Make sure wheatblog.db is readable/writable by your web server.


III. Go Over the Settings In settings.php.

	A. For SQLite users:

		1. $database should be the absolute path to your database file,
			i.e. /www/wheatblog/wheatblog.db
