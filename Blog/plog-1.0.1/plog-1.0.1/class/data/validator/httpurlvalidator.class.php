<?php

	include_once( PLOG_CLASS_PATH."class/data/validator/validator.class.php" );
	include_once( PLOG_CLASS_PATH."class/data/validator/rules/regexprule.class.php" );
	include_once( PLOG_CLASS_PATH."class/data/validator/rules/nonemptyrule.class.php" );

    /**
     * \ingroup Validator
     *
     * Checks whether the string is a valid http/https url
     *
     * @see NonEmptyRule
     */
    class HttpUrlValidator extends Validator 
    {
    	function HttpUrlValidator()
        {
        	$this->Validator();
			
			$this->addRule( new NonEmptyRule());
        	//$this->addRule( new RegExpRule( "!^http(s)?:\/\/\w+\.\w+(\S+)?$!", false ));
        }
    }
?>