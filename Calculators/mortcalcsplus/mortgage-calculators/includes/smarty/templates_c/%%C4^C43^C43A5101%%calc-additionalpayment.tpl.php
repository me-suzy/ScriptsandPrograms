<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:50:38
         compiled from calc-additionalpayment.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'num_decline', 'calc-additionalpayment.tpl', 44, false),array('function', 'html_options', 'calc-additionalpayment.tpl', 94, false),array('function', 'cycle', 'calc-additionalpayment.tpl', 149, false),)), $this); ?>
<?php $this->assign('title', "Mortgage Calculators - Additional payment calculator"); ?>
<?php $this->assign('description', "You can save money and shave years off the length of your loan by paying more on your monthly mortgage payment than your regularly scheduled amount."); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['download_csv']  = "Download spreadsheet of amortization in CSV format to your computer for later viewing in Excel or any other program.";
tips['start_date']    = "The month and year you will start making payments on your loan.";
tips['ap_amount']     = "The dollar amount that exceeds the normally scheduled monthly payment.";
tips['ap_quantity']   = "The number of times a year you will pay the additional amount indicated.";
tips['ap_start_date'] = "The month and year you will start making additional payments on your loan.";
//--></script>

<?php if ($this->_tpl_vars['err']['loan_amount']): ?><p align="center" class="err">Loan amount must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_amount']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_amount']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['interest_rate']): ?><p align="center" class="err">Interest rate must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['loan_term']): ?><p align="center" class="err">Loan term must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_term']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_term']; ?>
.</p><?php endif; ?>

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>Additional payment calculator</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
You can save money and shave years off the length of your loan by paying more on<br>
your monthly mortgage payment than your regularly scheduled amount. How much<br>
can you save? Fill in the boxes below, including the amount of the additional<br>
payment and the number of times you will make that increased payment each year.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th>With no Extra Payments</th>
			<th>With Extra Payments</th>
		</tr>
		<tr>
			<td align="center">Monthly Payment: <?php echo $this->_tpl_vars['summary']['mp_payment']; ?>
</td>
			<td align="center">Monthly Payment: <?php echo $this->_tpl_vars['summary']['ep_payment']; ?>
</td>
		</tr>
		<tr>
			<td align="center">Pay-off time: <?php echo $this->_tpl_vars['summary']['mp_time']; ?>
 years</td>
			<td align="center">Pay-off time: <?php echo $this->_tpl_vars['summary']['ep_time']['years']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['summary']['ep_time']['years'])) ? $this->_run_mod_handler('num_decline', true, $_tmp, 'year', 'years') : smarty_modifier_num_decline($_tmp, 'year', 'years')); ?>
 <?php echo $this->_tpl_vars['summary']['ep_time']['months']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['summary']['ep_time']['months'])) ? $this->_run_mod_handler('num_decline', true, $_tmp, 'month', 'months') : smarty_modifier_num_decline($_tmp, 'month', 'months')); ?>
</td>
		</tr>

		<tr>
			<td colspan="2" align="center"><b>Time Saved: <?php echo $this->_tpl_vars['summary']['time_saved']['years']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['summary']['time_saved']['years'])) ? $this->_run_mod_handler('num_decline', true, $_tmp, 'year', 'years') : smarty_modifier_num_decline($_tmp, 'year', 'years')); ?>
 <?php echo $this->_tpl_vars['summary']['time_saved']['months']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['summary']['time_saved']['months'])) ? $this->_run_mod_handler('num_decline', true, $_tmp, 'month', 'months') : smarty_modifier_num_decline($_tmp, 'month', 'months')); ?>
</b></th>
		</tr>

		<tr>
			<td align="center">Interest Paid: <?php echo $this->_tpl_vars['summary']['mp_interest']; ?>
</td>
			<td align="center">Interest Paid: <?php echo $this->_tpl_vars['summary']['ep_interest']; ?>
</td>
		</tr>

		<tr>
			<td colspan="2" align="center"><b>Total Interest Savings: <?php echo $this->_tpl_vars['summary']['interest_saved']; ?>
</b></th>
		</tr>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>Additional payment calculator</b></th>
		</tr>
		
		<tr><td align="right">
			Loan Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_amount]" value="<?php echo $this->_tpl_vars['param']['loan_amount']; ?>
" size="10"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="loan_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Annual Interest Rate:
		</td><td>
			<input class="calc_input" type="text" name="param[interest_rate]" value="<?php echo $this->_tpl_vars['param']['interest_rate']; ?>
" size="3"> %
		</td><td valign="middle">
			<img id="interest_rate" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Loan Term:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_term]" value="<?php echo $this->_tpl_vars['param']['loan_term']; ?>
" size="3"> years
		</td><td valign="middle">
			<img id="loan_term" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Start Date of Mortgage:
		</td><td>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['config']['month_names'],'selected' => $this->_tpl_vars['param']['start_month'],'name' => "param[start_month]",'class' => 'calc_input'), $this);?>
 <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['years'],'selected' => $this->_tpl_vars['param']['start_year'],'name' => "param[start_year]",'class' => 'calc_input'), $this);?>

		</td><td valign="middle">
			<img id="start_date" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Additional Payment Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[ap_amount]" value="<?php echo $this->_tpl_vars['param']['ap_amount']; ?>
" size="6"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="ap_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Number of times you will make<br>the additional payment per year:
		</td><td>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['config']['times'],'selected' => $this->_tpl_vars['param']['ap_quantity'],'name' => "param[ap_quantity]",'class' => 'calc_input'), $this);?>

		</td><td valign="middle">
			<img id="ap_quantity" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Start Date of Additional Payments:
		</td><td>
			<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['config']['month_names'],'selected' => $this->_tpl_vars['param']['ap_start_month'],'name' => "param[ap_start_month]",'class' => 'calc_input'), $this);?>
 <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['years'],'selected' => $this->_tpl_vars['param']['ap_start_year'],'name' => "param[ap_start_year]",'class' => 'calc_input'), $this);?>

		</td><td valign="middle">
			<img id="ap_start_date" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

	</table>
	<br>
	<table cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr><td align="center">
			<input class="calc_button" type="submit" name="param[calculate]" value="Calculate">
			<input class="calc_button" type="submit" name="param[amortization_schedule]" value="Amortization schedule">
		</td></tr>
		<tr><td align="center" colspan="2">
			<input class="calc_button" type="submit" name="param[download_csv]" value="Download CSV file">
			<img id="download_csv" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>
	</table>

	<!-- DO NOT REMOVE THE LINE BELOW. SEE THE LICENSE AGREEMENT. THANKS -->
	<div id="powered_by">Powered by <a href="http://www.mortgagecalculatorsplus.com/">Mortgage Calculators Plus</a></div>
	<!-- DO NOT REMOVE THE LINE ABOVE. SEE THE LICENSE AGREEMENT. THANKS -->

	<?php if ($this->_tpl_vars['balances']): ?>
	</td><td valign="top">
	<table class="calc" cellpadding="5" cellspacing="0" align="center">
	<tr>
		<th align="center">Year</th>
		<th align="left">Monthly Payment</th>
		<th align="left">With Extra Payments</th>
	</tr>
	<?php if (count($_from = (array)$this->_tpl_vars['balances'])):
    foreach ($_from as $this->_tpl_vars['balance']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'fill01,fill02'), $this);?>
">
		<td align="center">1/1/<?php echo $this->_tpl_vars['balance']['year']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['balance']['mp_balance']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['balance']['ep_balance']; ?>
</td>
	</tr>
	<?php endforeach; unset($_from); endif; ?>
	</table>
	<?php endif; ?>
</td></tr></table>
</form>
