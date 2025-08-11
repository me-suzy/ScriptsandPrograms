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
			$summary['loan_amount']     = $config['currency_symb'].number_format($param['loan_amount'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['interest_rate']   = number_format($param['interest_rate'], $config['decimals'], $config['dec_point'], $config['thousands_sep']).'%';
			$summary['loan_term']       = $param['loan_term'];
			$summary['monthly_payment'] = monthly_payment($param['loan_amount'], $param['interest_rate'], $param['loan_term'], $config['currency_symb'], $config['decimals'], $config['dec_point'], $config['thousands_sep'], true);
			$smarty->assign('summary', $summary);
			
			if(!$param['calculate']){
				$payments = loan_payments($param['loan_amount'], $param['interest_rate'], $param['loan_term'], $config['currency_symb'], $config['decimals'], $config['dec_point'], $config['thousands_sep'], true);
				$smarty->assign('payments', $payments);
			}
			if($param['download_csv']){
				$payments = loan_payments($param['loan_amount'], $param['interest_rate'], $param['loan_term'], $config['currency_symb'], $config['decimals'], $config['dec_point'], $config['thousands_sep'], false);

				header('Content-Type: application/octetstream');
				header('Content-Disposition: attachment; filename="monthly-amortization.csv"');
				header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
				header('Pragma: no-cache');
				
				echo '"Year","Month","Interest Paid","Principal Paid","Balance"'."\n";
				foreach($payments as $payment){
					echo "$payment[year],$payment[month],$payment[interest],$payment[principal],$payment[balance]\n";
				}
				exit;
			}
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_monthlypayment']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$smarty->assign('param', $param);
	}
	$smarty->assign('contents', $smarty->fetch('calc-monthlypayment.tpl'));
	$smarty->display('main.tpl');

	/* ----- FUNCTIONS ----- */
	function monthly_payment($loan_amount, $interest_rate, $loan_term, $currency_symb, $decimals, $dec_point, $thousands_sep, $format_numbers = false){
	    $payment = $loan_amount * $interest_rate / 100 / 12 / (1 - pow((1 + $interest_rate / 100 / 12), -$loan_term*12));
	    if($format_numbers) $payment = $currency_symb.number_format($payment, $decimals, $dec_point, $thousands_sep);
		return $payment;
	}
	
	function loan_payments($loan_amount, $interest_rate, $loan_term, $currency_symb, $decimals, $dec_point, $thousands_sep, $format_numbers = false){
		$balance  = $loan_amount;
		$periods  = $loan_term * 12;
		$interest = $interest_rate / 100 / 12;
	    $payment  = $loan_amount * $interest / (1 - pow((1 + $interest), -$periods));
		for($period = 1; $period <= $periods; $period++){
			$payments[$period]['year']      = ceil($period / 12);
			$payments[$period]['month']     = $period % 12 ? $period % 12 : 12;
			$payments[$period]['interest']  = $balance * $interest;
			$payments[$period]['principal'] = $payment - $balance * $interest;
			$payments[$period]['balance']   = $balance = $balance - $payment + $balance * $interest;
			
			$totals['interest']  += $payments[$period]['interest'];
			$totals['principal'] += $payments[$period]['principal'];
			$totals['balance']    = $payments[$period]['balance'];

			if($payments[$period]['balance'] < 0) $payments[$period]['balance'] = 0;

			if($payments[$period]['month'] == 12){
				if($totals['balance'] < 0) $totals['balance'] = 0;
				$totals['interest']  = $currency_symb.number_format($totals['interest'], $decimals, $dec_point, $thousands_sep);
				$totals['principal'] = $currency_symb.number_format($totals['principal'], $decimals, $dec_point, $thousands_sep);
				$totals['balance']   = $currency_symb.number_format($totals['balance'], $decimals, $dec_point, $thousands_sep);

				$payments[$period]['totals'] = $totals;
				$totals = array();
			}
			
			if($format_numbers){
				$payments[$period]['interest']  = $currency_symb.number_format($payments[$period]['interest'], $decimals, $dec_point, $thousands_sep);
				$payments[$period]['principal'] = $currency_symb.number_format($payments[$period]['principal'], $decimals, $dec_point, $thousands_sep);
				$payments[$period]['balance']   = $currency_symb.number_format($payments[$period]['balance'], $decimals, $dec_point, $thousands_sep);
			}
		}
		return $payments;
	}
?>