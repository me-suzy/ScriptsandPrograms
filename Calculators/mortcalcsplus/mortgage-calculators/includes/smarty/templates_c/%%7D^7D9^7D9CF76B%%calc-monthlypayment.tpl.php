<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:32:30
         compiled from calc-monthlypayment.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'calc-monthlypayment.tpl', 106, false),)), $this); ?>
<?php $this->assign('title', "Mortgage Calculators - Mortgage payment calculator"); ?>
<?php $this->assign('description', "Want to know how much your monthly payment will be for a particular mortgage?"); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['download_csv']  = "Download spreadsheet of amortization in CSV format to your computer for later viewing in Excel or any other program.";

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

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>Mortgage payment calculator</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
Want to know how much your monthly payment will be for a particular mortgage?<br>Simply fill in the boxes below to find out.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="2">Your Results</th>
		</tr>
		<tr>
			<td align="right"><b>Monthly Payment:</b></td>
			<td><b><?php echo $this->_tpl_vars['summary']['monthly_payment']; ?>
</b></td>
		</tr>
		<tr>
			<td align="right">Loan Amount:</td>
			<td><?php echo $this->_tpl_vars['summary']['loan_amount']; ?>
</td>
		</tr>
		<tr>
			<td align="right">Interest Rate:</td>
			<td><?php echo $this->_tpl_vars['summary']['interest_rate']; ?>
</td>
		</tr>
		<tr>
			<td align="right">Term of Loan:</td>
			<td><?php echo $this->_tpl_vars['summary']['loan_term']; ?>
 years</td>
		</tr>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>Mortgage payment calculator</b></th>
		</tr>
		
		<tr><td align="right">
			Total Home Loan Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_amount]" value="<?php echo $this->_tpl_vars['param']['loan_amount']; ?>
" size="7"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

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
			Term of the Loan:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_term]" value="<?php echo $this->_tpl_vars['param']['loan_term']; ?>
" size="3"> years
		</td><td valign="middle">
			<img id="loan_term" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
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

	<?php if ($this->_tpl_vars['payments']): ?>
	</td><td valign="top">
	<table class="calc" cellpadding="5" cellspacing="0" align="center">
	<tr>
		<th align="center">Year</th>
		<th align="center">Month</th>
		<th align="left">Interest Paid</th>
		<th align="left">Principal Paid</th>
		<th align="left">Balance</th>
	</tr>
	<?php if (count($_from = (array)$this->_tpl_vars['payments'])):
    foreach ($_from as $this->_tpl_vars['payment']):
?>
	<tr class="<?php echo smarty_function_cycle(array('values' => 'fill01,fill02'), $this);?>
">
		<td align="center"><?php echo $this->_tpl_vars['payment']['year']; ?>
</td>
		<td align="center"><?php echo $this->_tpl_vars['payment']['month']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['payment']['interest']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['payment']['principal']; ?>
</td>
		<td align="left"><?php echo $this->_tpl_vars['payment']['balance']; ?>
</td>
	</tr>
	<?php if ($this->_tpl_vars['payment']['totals']): ?>
	<tr>
		<th align="right" colspan="2">Totals for year <?php echo $this->_tpl_vars['payment']['year']; ?>
</th>
		<th align="left"><?php echo $this->_tpl_vars['payment']['totals']['interest']; ?>
</th>
		<th align="left"><?php echo $this->_tpl_vars['payment']['totals']['principal']; ?>
</th>
		<th align="left"><?php echo $this->_tpl_vars['payment']['totals']['balance']; ?>
</th>
	</tr>
	<?php endif; ?>
	<?php endforeach; unset($_from); endif; ?>
	</table>
	<?php endif; ?>
</td></tr></table>
</form>
