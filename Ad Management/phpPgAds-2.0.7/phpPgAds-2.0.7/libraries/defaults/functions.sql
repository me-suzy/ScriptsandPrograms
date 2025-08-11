-- $Id: functions.sql,v 2.0.2.2 2005/07/01 08:21:16 ciaccia Exp $

-- MySQL compatibility functions

BEGIN;

CREATE FUNCTION unix_timestamp(timestamp) RETURNS int8 AS
'SELECT (CASE WHEN $1 = NULL THEN 0 ELSE date_part(\'epoch\', $1) END)::int8' LANGUAGE 'sql';

CREATE FUNCTION from_unixtime(int4) RETURNS timestamp AS
'SELECT (\'epoch\'::timestamptz + ($1 || \' sec\')::interval)::timestamp' LANGUAGE 'sql';

CREATE FUNCTION to_days(timestamp) RETURNS int8 AS
'SELECT CASE WHEN $1 = NULL THEN NULL ELSE floor(unix_timestamp($1)/86400)::int8 END' LANGUAGE 'sql';

CREATE FUNCTION dayofmonth(timestamp) RETURNS int2 AS
'SELECT date_part(\'day\', $1)::int2' LANGUAGE 'sql';

CREATE FUNCTION month(timestamp) RETURNS int2 AS
'SELECT date_part(\'month\', $1)::int2' LANGUAGE 'sql';

CREATE FUNCTION year(timestamp) RETURNS int4 AS
'SELECT date_part(\'year\', $1)::int4' LANGUAGE 'sql';

CREATE FUNCTION week(timestamp) RETURNS int2 AS
'SELECT date_part(\'week\', $1)::int2' LANGUAGE 'sql';

CREATE FUNCTION hour(timestamp) RETURNS int2 AS
'SELECT date_part(\'hour\', $1)::int2' LANGUAGE 'sql';

CREATE FUNCTION date_format(timestamp, text) RETURNS text AS
'SELECT CASE WHEN $1 = NULL THEN \'\' ELSE to_char($1, $2) END' LANGUAGE 'sql';

CREATE FUNCTION if(bool, varchar, varchar) RETURNS varchar AS
'SELECT CASE WHEN $1 THEN $2 ELSE $3 END' LANGUAGE 'sql';

COMMIT;
