<?php
// Mortgage Calculators Plus
// ------------------------------------------------------------------------
// Copyright (c) 2005, MortgageCalculatorsPlus.com
// ------------------------------------------------------------------------
// This file is part of "Mortgage Calculators Plus" software
// ------------------------------------------------------------------------

	include('includes/overall.inc.php');
	
	$param = get_request_var('param');
	
	if($param){
		$param['old_loan_amount'] = preg_replace('/[^0-9\.]/', '', $param['old_loan_amount']);
		$param['new_loan_amount'] = preg_replace('/[^0-9\.]/', '', $param['new_loan_amount']);
		
		if($param['old_loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['old_loan_term'] = true;
		if($param['old_loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['old_loan_amount'] = true;
		if($param['old_interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['old_interest_rate'] = true;
		if($param['new_loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['new_loan_term'] = true;
		if($param['new_loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['new_loan_amount'] = true;
		if($param['new_interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['new_interest_rate'] = true;

		if(!$param['months_left'] > 0) $err['months_left'] = true;
		
		if(!isset($err)){
		    $summary['old_monthly_payment'] = $param['old_loan_amount'] * $param['old_interest_rate'] / 100 / 12 / (1 - pow((1 + $param['old_interest_rate'] / 100 / 12), -$param['old_loan_term']*12));
		    $summary['new_monthly_payment'] = $param['new_loan_amount'] * $param['new_interest_rate'] / 100 / 12 / (1 - pow((1 + $param['new_interest_rate'] / 100 / 12), -$param['new_loan_term']*12));
		    $summary['monthly_savings']     = $summary['old_monthly_payment'] - $summary['new_monthly_payment'];
		    $summary['old_total_loan_cost'] = $summary['old_monthly_payment'] * $param['old_loan_term'] * 12;
		    $summary['new_total_loan_cost'] = $summary['new_monthly_payment'] * $param['new_loan_term'] * 12;
		    $summary['total_savings']       = $summary['old_total_loan_cost'] - $summary['new_total_loan_cost'];
		    $summary['already_paid']        = $summary['old_monthly_payment'] * ($param['old_loan_term'] * 12 - $param['months_left']);
		    $summary['months_paid']         = $param['old_loan_term'] * 12 - $param['months_left'];
		    $summary['remaining_balance']   = $param['old_loan_amount'];
		    for($i=0; $i < $summary['months_paid']; $i++) $summary['remaining_balance'] = $summary['remaining_balance'] * (1 + $param['old_interest_rate'] / 100 / 12) - $summary['old_monthly_payment'];
		    
		    $summary['old_monthly_payment'] = $config['currency_symb'].number_format($summary['old_monthly_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['new_monthly_payment'] = $config['currency_symb'].number_format($summary['new_monthly_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['old_total_loan_cost'] = $config['currency_symb'].number_format($summary['old_total_loan_cost'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['new_total_loan_cost'] = $config['currency_symb'].number_format($summary['new_total_loan_cost'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['already_paid']        = $config['currency_symb'].number_format($summary['already_paid'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['remaining_balance']   = $config['currency_symb'].number_format($summary['remaining_balance'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    if($summary['monthly_savings'] > 0){
			    $summary['monthly_savings'] = $config['currency_symb'].number_format($summary['monthly_savings'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    } else {
			    $summary['monthly_savings'] = 0;
		    }
		    if($summary['total_savings'] > 0){
			    $summary['total_savings'] = $config['currency_symb'].number_format($summary['total_savings'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    } else {
			    $summary['total_savings'] = 0;
		    }
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_recoup']) {
		$param['old_loan_amount']   = $config['loan_amount'];
		$param['old_interest_rate'] = $config['interest_rate'];
		$param['old_loan_term']     = $config['loan_term'];
		$param['new_loan_amount']   = $config['new_loan_amount'];
		$param['new_interest_rate'] = $config['new_interest_rate'];
		$param['new_loan_term']     = $config['new_loan_term'];
		$param['months_left']       = $config['months_left'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-recoup.tpl'));
	$smarty->display('main.tpl');
?>