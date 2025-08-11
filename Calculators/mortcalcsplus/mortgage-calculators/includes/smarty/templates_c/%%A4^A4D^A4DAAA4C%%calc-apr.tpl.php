<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:55:52
         compiled from calc-apr.tpl */ ?>
<?php $this->assign('title', "Mortgage Calculators - APR calculator"); ?>
<?php $this->assign('description', "Find out the annual percentage rate of your loan."); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['points']        = "Enter the sum of Origination and Discount points on the loan.";
tips['other_costs']   = "Enter the total amount of other costs attached to the loan, such as closing costs, and title insurance.";
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

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>APR calculator</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
To find out the annual percentage rate of your loan, enter the loan amount,<br>
interest rate, points, other costs and year-length term into the boxes below.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="2">Stated Loan Amount</th>
			<th colspan="2">Effective Loan Amount</th>
		</tr>
		<tr>
			<td align="right">Monthly payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['st_monthly_payment']; ?>
</td>
			<td align="right">Monthly payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['ef_monthly_payment']; ?>
</td>
		</tr>
		<tr>
			<td align="center" colspan="4"><b>APR: <?php echo $this->_tpl_vars['summary']['apr']; ?>
</b></td>
		</tr>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>APR calculator</b></th>
		</tr>
		
		<tr><td align="right">
			Loan Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_amount]" value="<?php echo $this->_tpl_vars['param']['loan_amount']; ?>
" size="7"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="loan_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Interest Rate:
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
			Points:
		</td><td>
			<input class="calc_input" type="text" name="param[points]" value="<?php echo $this->_tpl_vars['param']['points']; ?>
" size="3">
		</td><td valign="middle">
			<img id="points" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Other Costs:
		</td><td>
			<input class="calc_input" type="text" name="param[other_costs]" value="<?php echo $this->_tpl_vars['param']['other_costs']; ?>
" size="5"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="other_costs" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>
	</table>
	<br>
	<table cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr><td align="center">
			<input class="calc_button" type="submit" name="param[calculate]" value="Calculate">
		</td></tr>
	</table>

	<!-- DO NOT REMOVE THE LINE BELOW. SEE THE LICENSE AGREEMENT. THANKS -->
	<div id="powered_by">Powered by <a href="http://www.mortgagecalculatorsplus.com/">Mortgage Calculators Plus</a></div>
	<!-- DO NOT REMOVE THE LINE ABOVE. SEE THE LICENSE AGREEMENT. THANKS -->

</td></tr></table>
</form>
