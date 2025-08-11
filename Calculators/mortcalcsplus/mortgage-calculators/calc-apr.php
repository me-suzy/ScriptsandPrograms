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
		$param['other_costs'] = preg_replace('/[^0-9\.]/', '', $param['other_costs']);
		
		if($param['loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['loan_amount'] = true;
		if($param['interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['interest_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
			$periods    = $param['loan_term'] * 12;
			$interest   = $param['interest_rate'] / 100 / 12;
		    $payment    = $param['loan_amount'] * $interest / (1 - pow((1 + $interest), -$periods));
		    $ef_payment = ($param['loan_amount'] + $param['other_costs'] + $param['loan_amount'] * $param['points'] / 100) * $interest / (1 - pow((1 + $interest), -$periods));
		    $apr        = ($param['other_costs'] + $param['loan_amount'] * $param['points'] / 100) / ($param['loan_amount'] - $param['other_costs'] - $param['loan_amount'] * $param['points'] / 100) * 10 + $param['interest_rate'];

		    $summary['st_monthly_payment'] = $config['currency_symb'].number_format($payment, $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['ef_monthly_payment'] = $config['currency_symb'].number_format($ef_payment, $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['apr']                = number_format($apr, $config['decimals'], $config['dec_point'], $config['thousands_sep']).'%';
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_apr']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$param['points']        = $config['points'];
		$param['other_costs']   = $config['other_costs'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-apr.tpl'));
	$smarty->display('main.tpl');
?>