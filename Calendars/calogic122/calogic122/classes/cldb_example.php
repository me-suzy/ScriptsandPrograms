<?php

/*
    $sqlstr = "select * from ".$tabpre."_setup";
    $sqlres = $cldb->set_sqlstring($sqlstr);
    if(!$cldb->exec_select($sqlres)) {
	die("Cannot query Standard Setup Table<br><br>DB Class said: ".$cldb->get_classerror($sqlres)."<br><br>MySQL said: ".$cldb->get_sqlerror($sqlres)."<br><br>SQL String: ".$cldb->get_sqlstring($sqlres)."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    if($cldb->get_rowcount($sqlres) == 1) {
	$row = $cldb->get_row($sqlres);
	$cldb->release($sqlres);

    }


    if(!$cldb->exec_nq($sqlres) || $cldb->get_nqresult($sqlres) != 1) {
	die("Error updating User Database<br><br>DB Class said: ".$cldb->get_classerror($sqlres)."<br><br>MySQL said: ".$cldb->get_sqlerror($sqlres)."<br><br>SQL String: ".$cldb->get_sqlstring($sqlres)."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

*/


    $sqlstr = "select * from ".$tabpre."_setup";
    if(!$cldb->set_sqlstring($sqlstr,$sqlres)) {
	$classertxt = ($cldb->get_classerror($sqlres,$classerror)) ? ($classerror) : ("could not get class error text");
	$sqlertxt = ($cldb->get_sqlerror($sqlres,$sqlerror)) ? ($sqlerror) : ("could not get sql error text");
        die("Cannot query Standard Setup Table<br><br>DB Class said: ".$classertxt."<br><br>MySQL said: ".$sqlertxt."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    if(!$cldb->execute($sqlres,$rowcount)) {
	$classertxt = ($cldb->get_classerror($sqlres,$classerror)) ? ($classerror) : ("could not get class error text");
	$sqlertxt = ($cldb->get_sqlerror($sqlres,$sqlerror)) ? ($sqlerror) : ("could not get sql error text");
        die("Cannot query Standard Setup Table<br><br>DB Class said: ".$classertxt."<br><br>MySQL said: ".$sqlertxt."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    #if($cldb->rowcount[$sqlres] === 1) {
    if($rowcount !== 1) {
        die("There is an error in the Setup Table<br>Row count = ".$rowcount."<br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
    }

    	#$row = mysql_fetch_array($query1) or die("Cannot query Setup Table<br><br>MySQL said: ".mysql_error()."<br><br>SQL String: ".$sqlstr);
	if(!$cldb->get_row($sqlres,$row)) {
	    $classertxt = ($cldb->get_classerror($sqlres,$classerror)) ? ($classerror) : ("could not get class error text");
	    $sqlertxt = ($cldb->get_sqlerror($sqlres,$sqlerror)) ? ($sqlerror) : ("could not get sql error text");
	    die("Cannot query Standard Setup Table<br><br>DB Class said: ".$classertxt."<br><br>MySQL said: ".$sqlertxt."<br><br>SQL String: ".$sqlstr."<br><br>File: ".substr(__FILE__,strrpos(__FILE__,"/"))."<br><br>Line: ".__LINE__.$GLOBALS["errep"]);
        }

        $cldb->release($sqlres);




?>
