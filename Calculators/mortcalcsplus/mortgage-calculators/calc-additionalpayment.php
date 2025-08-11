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
		$param['ap_amount']   = preg_replace('/[^0-9\.]/', '', $param['ap_amount']);
		if($param['loan_amount'] < $config['min_loan_amount'] || $param['loan_amount'] > $config['max_loan_amount']) $err['loan_amount'] = true;
		if($param['interest_rate'] < $config['min_interest_rate'] || $param['interest_rate'] > $config['max_interest_rate']) $err['interest_rate'] = true;
		if($param['loan_term'] < $config['min_loan_term'] || $param['loan_term'] > $config['max_loan_term']) $err['loan_term'] = true;
		
		if(!isset($err)){
			$periods    = $param['loan_term'] * 12;
			$interest   = $param['interest_rate'] / 100 / 12;
		    $mp_payment = $param['loan_amount'] * $interest / (1 - pow((1 + $interest), -$periods));
			$mp_balance = $ep_balance = $param['loan_amount'];
			$param['start_year']++;
			$param['ap_start_year']++;

			for($period = 0; $period < $periods; $period++){
				list($year, $month) = get_date($param['start_year'], ($param['start_month'] + $period));
				
				if(($param['ap_start_year'] == $year && $param['ap_start_month'] <= $month) || $param['ap_start_year'] < $year){
					if($ap_last_pay_year != $year){
						$ap_last_pay_year  = $year;
						$ap_this_year_pmts = 0;
					}
				}
				if($ap_last_pay_year && ($ap_this_year_pmts < $param['ap_quantity'])){
					$ep_payment = $mp_payment + $param['ap_amount'];
					$ap_this_year_pmts++;
				} else {
					$ep_payment = $mp_payment;
				}
				
				$summary['mp_interest'] += $mp_balance * $interest;
				if($ep_balance > 1){
					$summary['ep_interest'] += $ep_balance * $interest;
				} elseif(!$ep_end_period) {
					$ep_end_period = $period;
				}
	
				$balances[$year]['year']       = $year;
				$balances[$year]['mp_balance'] = $mp_balance = $mp_balance - $mp_payment + $mp_balance * $interest;
				$balances[$year]['ep_balance'] = $ep_balance = $ep_balance - $ep_payment + $ep_balance * $interest;
				
				if($balances[$year]['mp_balance'] < 0) $balances[$year]['mp_balance'] = 0;
				if($balances[$year]['ep_balance'] < 0) $balances[$year]['ep_balance'] = 0;
				if(!$param['download_csv']) $balances[$year]['mp_balance'] = $config['currency_symb'].number_format($balances[$year]['mp_balance'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
				if(!$param['download_csv']) $balances[$year]['ep_balance'] = $config['currency_symb'].number_format($balances[$year]['ep_balance'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			}
			$summary['mp_payment'] = $mp_payment;
			$summary['ep_payment'] = $mp_payment + $param['ap_amount'];
			$summary['interest_saved'] = $summary['mp_interest'] - $summary['ep_interest'];
			$summary['mp_time'] = $param['loan_term'];
			list($summary['ep_time']['years'], $summary['ep_time']['months']) = get_date(0, $ep_end_period);
			list($summary['time_saved']['years'], $summary['time_saved']['months']) = get_date(0, $periods - $ep_end_period);

			$summary['mp_payment']     = $config['currency_symb'].number_format($summary['mp_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['ep_payment']     = $config['currency_symb'].number_format($summary['ep_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['interest_saved'] = $config['currency_symb'].number_format($summary['interest_saved'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['mp_interest']    = $config['currency_symb'].number_format($summary['mp_interest'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['ep_interest']    = $config['currency_symb'].number_format($summary['ep_interest'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);

			$smarty->assign('summary', $summary);
			if(!$param['calculate']) $smarty->assign('balances', $balances);
			if($param['download_csv']){
				header('Content-Type: application/octetstream');
				header('Content-Disposition: attachment; filename="additional-payment.csv"');
				header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
				header('Pragma: no-cache');

				echo '"Year","Monthly Payment","With Extra Payments"'."\n";
				foreach($balances as $balance){
					echo "$balance[year],$balance[mp_balance],$balance[ep_balance]\n";
				}
				exit;
			}
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_additionalpayment']) {
		$param['loan_amount']    = $config['loan_amount'];
		$param['interest_rate']  = $config['interest_rate'];
		$param['loan_term']      = $config['loan_term'];
		$param['start_year']     = date('Y');
		$param['start_month']    = date('n');
		$param['ap_amount']      = $config['ap_amount'];
		$param['ap_quantity']    = $config['ap_quantity'];
		$param['ap_start_year']  = date('Y', time() + 60*60*24*365*2);
		$param['ap_start_month'] = date('n');
		$smarty->assign('param', $param);
	}

	for($i=$config['min_start_year']; $i<=$config['max_start_year']; $i++) $years[$i] = $i;
	$smarty->assign('years', $years);

	$smarty->assign('contents', $smarty->fetch('calc-additionalpayment.tpl'));
	$smarty->display('main.tpl');

	/* ----- FUNCTIONS ----- */
	function get_date($year, $month){
		$year  = $year + intval($month / 12);
		$month = $month % 12;
		if(!$month){
			$month = 12;
			$year -= 1;
		}
		return array($year, $month);
	}
?>