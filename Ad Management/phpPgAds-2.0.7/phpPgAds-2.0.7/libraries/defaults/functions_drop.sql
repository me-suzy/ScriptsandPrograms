-- $Id: functions_drop.sql,v 2.0 2002/10/31 08:59:49 ciaccia Exp $

-- Drop existing functions before recreating

DROP FUNCTION unix_timestamp(timestamp);
DROP FUNCTION from_unixtime(int4);
DROP FUNCTION to_days(timestamp);
DROP FUNCTION dayofmonth(timestamp);
DROP FUNCTION month(timestamp);
DROP FUNCTION year(timestamp);
DROP FUNCTION week(timestamp);
DROP FUNCTION hour(timestamp);
DROP FUNCTION date_format(timestamp, text);
DROP FUNCTION if(bool, varchar, varchar);
