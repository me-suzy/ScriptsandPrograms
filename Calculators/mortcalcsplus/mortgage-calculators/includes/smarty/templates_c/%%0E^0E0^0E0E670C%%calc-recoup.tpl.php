<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:54:23
         compiled from calc-recoup.tpl */ ?>
<?php $this->assign('title', "Mortgage Calculators - How much will you save by refinancing your loan?"); ?>
<?php $this->assign('description', "How much will you save by refinancing your loan?"); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['old_loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['old_interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['old_loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['new_loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['new_interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['new_loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['months_left']       = "Enter the number of months left to pay on Original Loan.";
//--></script>

<?php if ($this->_tpl_vars['err']['old_loan_amount']): ?><p align="center" class="err">Old mortgage amount must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_amount']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_amount']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['old_interest_rate']): ?><p align="center" class="err">Old interest rate must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['old_loan_term']): ?><p align="center" class="err">Old loan term must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_term']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_term']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['new_loan_amount']): ?><p align="center" class="err">New mortgage amount must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_amount']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_amount']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['new_interest_rate']): ?><p align="center" class="err">New interest rate must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['new_loan_term']): ?><p align="center" class="err">New loan term must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_term']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_term']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['months_left']): ?><p align="center" class="err">Time Left to Pay on Original Loan must be greater zero.</p><?php endif; ?>

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>How much will I save by refinancing my loan?</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
How much will you save by refinancing your loan? Fill in the boxes below and we'll tell you.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="2">Old Loan</th>
			<th colspan="2">New Loan</th>
		</tr>
		<tr>
			<td align="center" colspan="4">Remaining Loan Balance: <b><?php echo $this->_tpl_vars['summary']['remaining_balance']; ?>
</b></td>
		</tr>
		<tr>
			<td align="right">Monthly Payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['old_monthly_payment']; ?>
</td>
			<td align="right">Monthly Payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['new_monthly_payment']; ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['summary']['monthly_savings']): ?>
		<tr>
			<td align="center" colspan="4">Monthly Savings: <b><?php echo $this->_tpl_vars['summary']['monthly_savings']; ?>
</b></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td align="right">Total Cost:</td>
			<td><?php echo $this->_tpl_vars['summary']['old_total_loan_cost']; ?>
</td>
			<td align="right">Total Cost:</td>
			<td><?php echo $this->_tpl_vars['summary']['new_total_loan_cost']; ?>
</td>
		</tr>
		<?php if ($this->_tpl_vars['summary']['total_savings']): ?>
		<tr>
			<td align="center" colspan="4">Total Savings: <b><?php echo $this->_tpl_vars['summary']['total_savings']; ?>
</b></td>
		</tr>
		<?php endif; ?>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>How much will I save by refinancing my loan?</b></th>
		</tr>
		
		<tr><td align="right">
			Original Interest Rate:
		</td><td>
			<input class="calc_input" type="text" name="param[old_interest_rate]" value="<?php echo $this->_tpl_vars['param']['old_interest_rate']; ?>
" size="3"> %
		</td><td valign="middle">
			<img id="old_interest_rate" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Original Loan Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[old_loan_amount]" value="<?php echo $this->_tpl_vars['param']['old_loan_amount']; ?>
" size="7"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="old_loan_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Original Loan Term:
		</td><td>
			<input class="calc_input" type="text" name="param[old_loan_term]" value="<?php echo $this->_tpl_vars['param']['old_loan_term']; ?>
" size="3"> years
		</td><td valign="middle">
			<img id="old_loan_term" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Time Left to Pay on Original Loan:
		</td><td>
			<input class="calc_input" type="text" name="param[months_left]" value="<?php echo $this->_tpl_vars['param']['months_left']; ?>
" size="3"> months
		</td><td valign="middle">
			<img id="months_left" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			New Interest Rate:
		</td><td>
			<input class="calc_input" type="text" name="param[new_interest_rate]" value="<?php echo $this->_tpl_vars['param']['new_interest_rate']; ?>
" size="3"> %
		</td><td valign="middle">
			<img id="new_interest_rate" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			New Loan Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[new_loan_amount]" value="<?php echo $this->_tpl_vars['param']['new_loan_amount']; ?>
" size="7"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="new_loan_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			New Loan Term:
		</td><td>
			<input class="calc_input" type="text" name="param[new_loan_term]" value="<?php echo $this->_tpl_vars['param']['new_loan_term']; ?>
" size="3"> years
		</td><td valign="middle">
			<img id="new_loan_term" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
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