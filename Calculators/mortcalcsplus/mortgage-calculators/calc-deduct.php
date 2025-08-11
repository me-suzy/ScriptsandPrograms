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
			$balance  = $param['loan_amount'];
			$periods  = $param['loan_term'] * 12;
			$interest = $param['interest_rate'] / 100 / 12;
		    $payment  = $param['loan_amount'] * $interest / (1 - pow((1 + $interest), -$periods));
			for($period = 1; $period <= $periods; $period++){
				$year = ceil($period / 12);
				$savings[$year]['year']    = $year;
				$savings[$year]['amount'] += $balance * $interest;
				$balance = $balance - $payment + $balance * $interest;
				
				if($payments[$year]['amount'] < 0) $payments[$year]['amount'] = 0;
				if($period % 12 == 0) $savings[$year]['amount']  = $config['currency_symb'].number_format($savings[$year]['amount'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			}
			$smarty->assign('savings', $savings);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_deduct']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-deduct.tpl'));
	$smarty->display('main.tpl');
?>