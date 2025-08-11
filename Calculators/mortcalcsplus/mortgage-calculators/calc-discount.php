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
		if($param['original_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['original_rate'] = true;
		if($param['discount_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['discount_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
			$summary['points']            = $param['points'];
			$summary['original_payment']  = $param['loan_amount'] * $param['original_rate'] / 100 / 12 / (1 - pow((1 + $param['original_rate'] / 100 / 12), -$param['loan_term']*12));
			$summary['discount_payment']  = $param['loan_amount'] * $param['discount_rate'] / 100 / 12 / (1 - pow((1 + $param['discount_rate'] / 100 / 12), -$param['loan_term']*12));
			$summary['payment_saved']     = $summary['original_payment'] - $summary['discount_payment'];
			$summary['recoup_time']       = round(($param['loan_amount'] * $summary['points'] / 100) / $summary['payment_saved']);
			$summary['interest_original'] = $summary['original_payment'] * $param['loan_term'] * 12 - $param['loan_amount'];
			$summary['interest_discount'] = $summary['discount_payment'] * $param['loan_term'] * 12 - $param['loan_amount'];

		    $summary['original_payment']  = $config['currency_symb'].number_format($summary['original_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['discount_payment']  = $config['currency_symb'].number_format($summary['discount_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['payment_saved']     = $config['currency_symb'].number_format($summary['payment_saved'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['interest_original'] = $config['currency_symb'].number_format($summary['interest_original'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['interest_discount'] = $config['currency_symb'].number_format($summary['interest_discount'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_discount']) {
		$param['original_rate'] = $config['interest_rate'];
		$param['discount_rate'] = $config['discount_rate'];
		$param['loan_amount']   = $config['loan_amount'];
		$param['loan_term']     = $config['loan_term'];
		$param['points']        = $config['points'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-discount.tpl'));
	$smarty->display('main.tpl');
?>