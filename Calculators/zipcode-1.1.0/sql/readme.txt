In order to use the zipcode.class.php class, you need to setup your database
to include the appropriate tables and populate those tables with the appropriate
data.  That's what these 5 .sql files are for.  Simply "import" each one of 
these files using phpMyAdmin.  Make sure you import the "zip_code_x.sql" files
in sequence.

You will end up with 2 tables, 'zip_code' and 'state'.

