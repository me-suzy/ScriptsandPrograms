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
		$param['tax']         = preg_replace('/[^0-9\.]/', '', $param['tax']);
		$param['debt']        = preg_replace('/[^0-9\.]/', '', $param['debt']);
		
		if($param['loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['loan_amount'] = true;
		if($param['interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['interest_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
		    $monthly_payment = $param['loan_amount'] * $param['interest_rate'] / 100 / 12 / (1 - pow((1 + $param['interest_rate'] / 100 / 12), -$param['loan_term']*12));
			$variant_1 = ($monthly_payment * 12 + $param['tax']) / 0.28;
			$variant_2 = ($monthly_payment * 12 + $param['tax'] + $param['debt'] * 12) / 0.36;
			$summary['salary'] = $variant_1 > $variant_2 ? $variant_1 : $variant_2;
		    $summary['salary'] = $config['currency_symb'].number_format($summary['salary'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_earnhome']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$param['tax']           = $config['tax'];
		$param['debt']          = $config['debt'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-earnhome.tpl'));
	$smarty->display('main.tpl');
?>