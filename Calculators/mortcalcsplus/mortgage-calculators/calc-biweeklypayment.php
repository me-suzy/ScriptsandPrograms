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
			$mo_periods  = $param['loan_term'] * 12;
			$mo_balance  = $bw_balance = $param['loan_amount'];
			$mo_interest = $param['interest_rate'] / 12 / 100;
			$mo_payment  = $mo_balance * $mo_interest / (1 - pow((1 + $mo_interest), -$mo_periods));
			$bw_interest = $param['interest_rate'] / 26 / 100;
			$bw_payment  = $mo_payment / 2;
			$bw_periods  = round(-log(1 - $bw_interest * $bw_balance / $bw_payment) / log(1 + $bw_interest));
			
			for($period = 1; $period <= $mo_periods; $period++){
				$mo_balance = $mo_balance * (1 + $mo_interest) - $mo_payment;
				if($mo_balance < 0) $mo_balance = 0;
				if(($period % 12 == 0) || ($period == $mo_periods)){
					$year = $param['start_year'] + ceil($period / 12);
					$balances[$year]['year']       = $config['month_names'][$param['start_month']].', '.$year;
					if($param['download_csv']){
						$balances[$year]['mo_balance'] = $mo_balance;
					} else {
						$balances[$year]['mo_balance'] = $config['currency_symb'].number_format($mo_balance, $config['decimals'], $config['dec_point'], $config['thousands_sep']);
					}
				}
			}
			for($period = 1; $period <= $bw_periods; $period++){
				$bw_balance = $bw_balance * (1 + $bw_interest) - $bw_payment;
				if($bw_balance < 0) $bw_balance = 0;
				if(($period % 26 == 0) || ($period == $bw_periods)){
					$year = $param['start_year'] + ceil($period / 26);
					$balances[$year]['year']       = $config['month_names'][$param['start_month']].', '.$year;
					if($param['download_csv']){
						$balances[$year]['bw_balance'] = $bw_balance;
					} else {
						$balances[$year]['bw_balance'] = $config['currency_symb'].number_format($bw_balance, $config['decimals'], $config['dec_point'], $config['thousands_sep']);
					}
				}
			}
			if(!$param['calculate']) $smarty->assign('balances', $balances);

			$summary['mo_periods']   = $param['loan_term'] * 12;
			$summary['mo_payment']   = $param['loan_amount'] * $param['interest_rate'] / 12 / 100 / (1 - pow((1 + $param['interest_rate'] / 12 / 100), -$mo_periods));
			$summary['mo_interest']  = $summary['mo_payment'] * $summary['mo_periods'] - $param['loan_amount'];
			$summary['mo_end_date']  = get_date($param['start_year'], $param['start_month'] + $summary['mo_periods'] - 1, 'M, Y', $config['month_names']);
			
			$summary['bw_payment']   = $summary['mo_payment'] / 2;
			$summary['bw_periods']   = round(-log(1 - $param['interest_rate'] / 26 / 100 * $param['loan_amount'] / $summary['bw_payment']) / log(1 + $param['interest_rate'] / 26 / 100));
			$summary['bw_moperiods'] = round(($summary['bw_periods'] / 26) * 12);
			$summary['bw_interest']  = $summary['bw_payment'] * $summary['bw_periods'] - $param['loan_amount'];
			$summary['bw_end_date']  = get_date($param['start_year'], $param['start_month'] + $summary['bw_moperiods'] - 1, 'M, Y', $config['month_names']);
			list($summary['time_saved']['years'], $summary['time_saved']['months']) = get_year_month(0, $mo_periods - $summary['bw_moperiods']);
			$summary['interest_saved'] = $summary['mo_interest'] - $summary['bw_interest'];
			
			$summary['mo_payment']     = $config['currency_symb'].number_format($summary['mo_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['bw_payment']     = $config['currency_symb'].number_format($summary['bw_payment'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['mo_interest']    = $config['currency_symb'].number_format($summary['mo_interest'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['bw_interest']    = $config['currency_symb'].number_format($summary['bw_interest'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			$summary['interest_saved'] = $config['currency_symb'].number_format($summary['interest_saved'], $config['decimals'], $config['dec_point'], $config['thousands_sep']);
			
			$smarty->assign('summary', $summary);
			
			if($param['download_csv']){
				header('Content-Type: application/octetstream');
				header('Content-Disposition: attachment; filename="biweekly-payments.csv"');
				header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0');
				header('Pragma: no-cache');

				echo '"Year","Monthly Payment","Bi-weekly Payment"'."\n";
				foreach($balances as $balance){
					if(!$balance['bw_balance']) $balance['bw_balance'] = 0;
					echo '"'.$balance['year'].'"'.",$balance[mo_balance],$balance[bw_balance]\n";
				}
				exit;
			}
		} else {
			$smarty->assign('err', $err);
		}
	} elseif($config['fill_biweeklypayment']) {
		$param['loan_amount']   = $config['loan_amount'];
		$param['interest_rate'] = $config['interest_rate'];
		$param['loan_term']     = $config['loan_term'];
		$param['start_year']     = date('Y');
		$param['start_month']    = date('n');
		$smarty->assign('param', $param);
	}
	for($i=$config['min_start_year']; $i<=$config['max_start_year']; $i++) $years[$i] = $i;
	$smarty->assign('years', $years);

	$smarty->assign('contents', $smarty->fetch('calc-biweeklypayment.tpl'));
	$smarty->display('main.tpl');

	/* ----- FUNCTIONS ----- */
	function get_date($year, $month, $group_by = 'M, Y', $month_names = array(1=>'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec')){
		$year  = $year + intval($month / 12);
		$month = $month % 12;
		if(!$month){
			$month = 12;
			$year -= 1;
		}
		return str_replace(array('M', 'Y'), array($month_names[$month], $year),$group_by);
	}
	function get_year_month($year, $month){
		$year  = $year + intval($month / 12);
		$month = $month % 12;
		if(!$month){
			$month = 12;
			$year -= 1;
		}
		return array($year, $month);
	}
?>