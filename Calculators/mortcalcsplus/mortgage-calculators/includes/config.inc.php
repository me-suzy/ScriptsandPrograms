<?php
// Mortgage Calculators Plus
// ------------------------------------------------------------------------
// Copyright (c) 2005, MortgageCalculatorsPlus.com
// ------------------------------------------------------------------------
// This file is part of "Mortgage Calculators Plus" software
// ------------------------------------------------------------------------

	/* default settings */
	$config['loan_amount']       = '250,000';
	$config['interest_rate']     = 6.5;
	$config['loan_term']         = 30;
	$config['property_tax']      = 1.25;
	$config['pmi']               = 0.5;
	$config['ap_amount']         = 500;
	$config['ap_quantity']       = 12;
	$config['tax']               = '3,500';
	$config['debt']              = '1,500';
	$config['insurance']         = 300;
	$config['income']            = '120,000';
	$config['discount_rate']     = 6;
	$config['points']            = 2;
	$config['new_loan_amount']   = '200,000';
	$config['new_interest_rate'] = 6.25;
	$config['new_loan_term']     = 30;
	$config['months_left']       = 120;
	$config['other_costs']       = '1,200';

	/* fill fields with default values */
	$config['fill_monthlypayment']    = true;
	$config['fill_additionalpayment'] = true;
	$config['fill_earnhome']          = true;
	$config['fill_affordborrow']      = true;
	$config['fill_discount']          = true;
	$config['fill_recoup']            = true;
	$config['fill_deduct']            = true;
	$config['fill_biweeklypayment']   = true;
	$config['fill_apr']               = true;
	$config['fill_interestonly']      = true;

	/* number formatting */
	$config['currency_symb'] = '$';
	$config['decimals']      = 2;
	$config['dec_point']     = '.';
	$config['thousands_sep'] = ',';
	
	/* parameter ranges */
	$config['max_loan_amount']   = 9999999;
	$config['min_loan_amount']   = 1;
	$config['max_interest_rate'] = 50;
	$config['min_interest_rate'] = 0.1;
	$config['max_start_year']    = 2015;
	$config['min_start_year']    = 1995;
	$config['max_loan_term']     = 50;
	$config['min_loan_term']     = 1;
	$config['max_property_tax']  = 50;
	$config['min_property_tax']  = 0;
	$config['max_pmi']           = 50;
	$config['min_pmi']           = 0;
	
	/* month names */
	$config['month_names'][1]  = 'Jan';
	$config['month_names'][2]  = 'Feb';
	$config['month_names'][3]  = 'Mar';
	$config['month_names'][4]  = 'Apr';
	$config['month_names'][5]  = 'May';
	$config['month_names'][6]  = 'Jun';
	$config['month_names'][7]  = 'Jul';
	$config['month_names'][8]  = 'Aug';
	$config['month_names'][9]  = 'Sep';
	$config['month_names'][10] = 'Oct';
	$config['month_names'][11] = 'Nov';
	$config['month_names'][12] = 'Dec';

	/* # of months */
	$config['times'][1]  = '1 time';
	$config['times'][2]  = '2 times';
	$config['times'][3]  = '3 times';
	$config['times'][4]  = '4 times';
	$config['times'][5]  = '5 times';
	$config['times'][6]  = '6 times';
	$config['times'][7]  = '7 times';
	$config['times'][8]  = '8 times';
	$config['times'][9]  = '9 times';
	$config['times'][10] = '10 times';
	$config['times'][11] = '11 times';
	$config['times'][12] = '12 times';
?>