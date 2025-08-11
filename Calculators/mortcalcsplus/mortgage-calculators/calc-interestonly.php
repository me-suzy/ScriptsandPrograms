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
		$param['loan_amount'] = preg_replace('/[^0-9\.]/', '', $param['loan_amount']);
		if($param['loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['loan_amount'] = true;
		if($param['interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['interest_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
		    $summary['interest_payment']  = $param['interest_rate'] / 100 / 12 * $param['loan_amount'];
		    $summary['amortized_payment'] = $param['loan_amount'] * $param['interest_rate'] / 100 / 12 / (1 - pow((1 + $param['interest_rate'] / 100 / 12), -$param['loan_term'] * 12));
		    $summary['monthly_savings']   = $summary['amortized_payment'] - $summary['interest_payment'];

			$summary['interest_payment']  = $config['currency_symb'].number_format($summary['interest_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['amortized_payment'] = $config['currency_symb'].number_format($summary['amortized_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['monthly_savings']   = $config['currency_symb'].number_format($summary['monthly_savings'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_interestonly']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-interestonly.tpl'));
	$smarty->display('main.tpl');
?>