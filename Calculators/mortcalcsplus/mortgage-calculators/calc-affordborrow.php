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
		$param['income']    = preg_replace('/[^0-9\.]/', '', $param['income']);
		$param['tax']       = preg_replace('/[^0-9\.]/', '', $param['tax']);
		$param['debt']      = preg_replace('/[^0-9\.]/', '', $param['debt']);
		$param['insurance'] = preg_replace('/[^0-9\.]/', '', $param['insurance']);

		if(!$param['income'] > 0) $err['income'] = true;
		if($param['interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['interest_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
			$variant_1 = ($param['income'] * 0.28 - $param['tax'] - $param['insurance']) / 12;
			$variant_2 = ($param['income'] * 0.36 - $param['tax'] - $param['insurance']) / 12 - $param['debt'];
			$summary['monthly_payment'] = $variant_1 < $variant_2 ? $variant_1 : $variant_2;
		    $summary['loan_amount']     = $summary['monthly_payment'] * (1 - pow((1 + $param['interest_rate'] / 100 / 12), -$param['loan_term']*12)) / ($param['interest_rate'] / 100 / 12);
		    $summary['monthly_payment'] = $config['currency_symb'].number_format($summary['monthly_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
		    $summary['loan_amount']     = $config['currency_symb'].number_format($summary['loan_amount'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$smarty->assign('summary', $summary);
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_affordborrow']) {
		$param['income']        = $config['income'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$param['tax']           = $config['tax'];
		$param['debt']          = $config['debt'];
		$param['insurance']     = $config['insurance'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-affordborrow.tpl'));
	$smarty->display('main.tpl');
?>