<?php

/***************************************************************
** Title.........: CaLogic MySQL Database class
** Version.......: 1.2.2
** Author........: Philip Boone <philip@boone.at>
** Filename......: dbclass.php
** Last changed..:
** Notes.........:
** Use...........: This class does all the database hadling (I hope)

** functions:
    get_next_free_element()
        class internal use only

    function get_element($element,$name)
        returns the value of the class array[$element]
        $name must be the name of the variable

    release_element($element)
        releases and unsets resources used by $element

    set_sqlstring($sqlstring)
        sets the next element to 1 (in use)
        sets the $class->sqlstring[nextelement] to $sqlstring

        returns $element

    exec_select($element)
        executes the select statement in $class->sqlstring[$element]
        sets $class->query[$element] to the query resource
        sets $class->rowcount[$element] to the number or rows returned
        sets $class->rowset[$element] to the row set returned
        * note, the row set returned will be stripped of slashes properly, according
        * to the magic_quotes settings.

        returns true on success, false on error
        on error also sets $class->sqlerror[$element] to the mysql error message on error

    exec_nqrs($element)
        executes the non Query result set sql statement (insert / update / delete)
        in $class->sqlstring[$element]
        sets $class->nqresult[$element] to the number or rows affected

        returns true on success, false on error,
        on error also sets $class->sqlerror[$element] to the mysql error message on error

*/

class cldbclass {

/***************************************************************
** Class Constructor
***************************************************************/

# table prefix
    var $table_prefix;


# all arrays should always be syncronised. Meaning that, sqlquery[1] will hold the query from
# sqlstring[1]

# array to hold sql error strings
    var $sqlerror_text;

# array to hold sql error setting
    var $sqlerror;

# array to hold class error messages
    var $classerror_text;

# array to hold class error setting
    var $classerror;

# array to hold sql strings
    var $sqlstring;

# array to hold select queries
    var $query;

# array to hold current row of select rowset
    var $rowset;

# array to hold non select queries
    #var $nonselectquery;

# array to hold results (affected rows) of non select query results
    #var $nqresult;

# array to hold row counts of select query results
    var $rowcount;

# array of integer values indicating state of the element
# 0 = not set, 1 = set but not in use (not exected), 2 = inuse (executed)
    var $element_state;

    function cldbclass() {
        # initialize element array
        # 100 should be enuf !
        #for($x=0;$x<100;$x++) {
            #$this->element_state[$x] = 0;
        #}
        $this->element_state[0] = 0;
    }

# set element sqlstring

    function set_sqlstring($sqlstring,&$element) {

        $element = $this->get_next_element();

        if(!is_string($sqlstring)) {
            $this->classerror_text[$element] = "Function set_sqlstring expects a string parameter.";
            $this->classerror[$element] = true;
            return(false);
        }

        if(strlen(trim($sqlstring)) < 6) {
            $this->classerror_text[$element] = "SQL String too short.";
            $this->classerror[$element] = true;
            return(false);
        }

        #$element = $this->get_next_element();

        $this->sqlstring[$element] = $sqlstring;
        $this->rowcount[$element] = 0;

        $this->classerror_text[$element] = "";
        $this->sqlerror_text[$element] = "";

        $this->classerror[$element] = false;
        $this->sqlerror[$element] = false;

        $this->element_state[$element] = 1;

        return(true);

    }

# returns $this->sqlstring[$element]
    function get_sqlstring($element,&$thestring) {

        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] > 0) {
                $thestring = $this->sqlstring[$element];
                return(true);

            } else {

                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{
            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }


# returns $this->rowcount[$element]
    function get_rowcount($element,&$rowcount) {


        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] === 2) {

                $rowcount = $this->rowcount[$element];
                return(true);

            } elseif($this->element_state[$element] === 1) {

                $this->classerror_text[$element] = "Element not executed.";
                $this->classerror[$element] = true;
                return(false);

            }else{

                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{
            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }
    }

# returns $this->rowcount[$element]
    function get_sqlerror($element,&$errtxt) {


        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] > 0) {
                $errtxt = $this->sqlerror_text[$element];
                return(true);
            } else {
                $errtxt = "Element not set.";
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{
            $errtxt = "Element not set.";
            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }

# returns $this->rowcount[$element]
    function is_sqlerror($element,&$errbool) {

        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] > 0) {
                $errbool = $this->sqlerror[$element];
                return(true);
            }else {
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{

            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }

# returns $this->rowcount[$element]
    function get_classerror($element,&$errtxt) {

        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] > 0) {
                $errtxt = $this->classerror_text[$element];
                return(true);
            }else {
                $errtxt = "Element not set.";
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{
            $errtxt = "Element not set.";
            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }
    }


# returns $this->rowcount[$element]
    function is_classerror($element,&$errbool) {

        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] > 0) {
                $errbool = $this->classerror[$element];
                return(true);
            }else {
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }

        }else{

            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }

# sets $class->rowset[$element] to the next row of $class->query[$element]
# returns $class->rowset[$element]
# NOTE, the row will be stripslashed properly according to the magic_quotes settings

    function get_row($element,&$row,&$eoq) {

        $eoq = false;
        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] === 2) {

                if(strtolower(substr($this->sqlstring[$element],0,6)) === "select") {

                    while($this->rowset[$element] = mysql_fetch_array($this->query[$element])) {
                        mqfix_new($this->rowset[$element],1);
                        $row = $this->rowset[$element];
                        $eoq = false;
                        return(true);
                    }

                    # end of query
                    $eoq = true;
                    return(false);

                } else {
                    $this->classerror_text[$element] = "Cannot get row from non select query.";
                    $this->classerror[$element] = true;
                    return(false);
                }


            } elseif($this->element_state[$element] === 1) {
                $this->classerror_text[$element] = "Element not executed.";
                $this->classerror[$element] = true;
                return(false);
            } else {
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            }
        }else{
            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }

# gets the next free element
    function get_next_element() {

        $nextelement = 0;
        foreach($this->element_state as $element => $inuse) {

            if($inuse === 0) {
                $nextelement = $element;
                break;
            }

            $nextelement++;
        }

        return($nextelement);

    }

# release element

    function release($element) {

        if(isset($this->element_state[$element])) {

            @mysql_free_result($this->query[$element]);
            unset($this->query[$element]);
            unset($this->rowset[$element]);
            unset($this->rowcount[$element]);
            unset($this->sqlstring[$element]);
            unset($this->classerror_text[$element]);
            unset($this->sqlerror_text[$element]);
            unset($this->classerror[$element]);
            unset($this->sqlerror[$element]);

            $this->element_state[$element] = 0;

        }

    }

# execute a query
# sets $class->rowcount[$element] to the number of rows returned or affected
# returns false on error,true on success

    function execute($element,&$execrowcount) {

        $execrowcount = 0;
        if(isset($this->element_state[$element])) {

            if($this->element_state[$element] === 0) {
                $this->classerror_text[$element] = "Element not set.";
                $this->classerror[$element] = true;
                return(false);
            } elseif($this->element_state[$element] === 2) {
                $this->classerror_text[$element] = "Element already in use.";
                $this->classerror[$element] = true;
                return(false);
            }

            $this->element_state[$element] = 2;

            $this->query[$element] = mysql_query($this->sqlstring[$element]);
            if(mysql_errno() == 0) {

                if(strtolower(substr($this->sqlstring[$element],0,6)) === "select") {
                    $this->rowcount[$element] = mysql_num_rows($this->query[$element]);
                } else {
                    $this->rowcount[$element] = mysql_affected_rows();
                }

                $execrowcount = $this->rowcount[$element];

                $this->classerror_text[$element] = "";
                $this->sqlerror_text[$element] = "";
                $this->classerror[$element] = false;
                $this->sqlerror[$element] = false;


                return(true);


            } else {

                $this->classerror_text[$element] = "SQL Error.";
                $this->classerror[$element] = true;
                $this->sqlerror_text[$element] = mysql_error() ;
                $this->sqlerror[$element] = true;
                return(false);
            }

        } else {

            $this->classerror_text[$element] = "Element not set.";
            $this->classerror[$element] = true;
            return(false);
        }

    }

}

?>
