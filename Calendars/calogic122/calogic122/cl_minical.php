<?php

    $weekstartonmonday = $curcalcfg["weekstartonmonday"];
    $dispwnum =  $curcalcfg["showweek"];
    $weekselreact =  $curcalcfg["weekselreact"];
    $daybeginhour =  $curcalcfg["daybeginhour"];
    $dayendhour =  $curcalcfg["dayendhour"];
    $dayhourcount = ($dayendhour - $daybeginhour)+1;

    setviewtext($langsel);
     $GLOBALS["CLPATH"] = dirname(__FILE__);
    include_once($GLOBALS["CLPATH"]."/include/efuncs.php");
    include_once($GLOBALS["CLPATH"]."/include/sfuncs.php");

       if(!isset($mcpiviewdate)) {
            $sdtx = time() + $user->gsv("caltzadj");
            $txvd = strftime("%Y",$sdtx).strftime("%m",$sdtx)."01";
            $user->ssv("curviewdate",$txvd);
            $viewdate = $txvd;
        } else {
            $viewdate = $mcpiviewdate;
        }


    $user->ssv("curview",$viewtype) ;
    $user->ssv("curviewdate",$viewdate);

    $startyear=substr($viewdate,0,4);
    $startmonth=substr($viewdate,4,2);
    $startday=substr($viewdate,6,2);

    $cuts = mktime(0,0,0,$startmonth,$startday,$startyear);

    minical($startday,$startmonth,$startyear,0);


  #print "<br><br>viewdate: ".$viewdate;

  #print "<br><br>txvd: ".$txvd;

?>
