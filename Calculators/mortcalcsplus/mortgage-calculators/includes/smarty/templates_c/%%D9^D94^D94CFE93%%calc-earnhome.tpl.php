<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:54:11
         compiled from calc-earnhome.tpl */ ?>
<?php $this->assign('title', "Mortgage Calculators - How much do I have to earn?"); ?>
<?php $this->assign('description', "Not sure how much money you'll have to earn per year to afford your house payment and accompanying expenses?"); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['interest_rate'] = "Enter the actual interest rate on the loan, as quoted by the lender.";
tips['loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['tax']           = "Enter the amount of Property Tax assessed by the municipality governing your property.";
tips['debt']          = "Add up all monthly installment loan payments (e.g. car, boat, student, furniture), Minimum Monthly Payments on Credit Cards, Monthly Legal Obligations (e.g. child support, alimony, court judgements).";
//--></script>

<?php if ($this->_tpl_vars['err']['loan_amount']): ?><p align="center" class="err">Mortgage amount must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_amount']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_amount']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['interest_rate']): ?><p align="center" class="err">Interest rate must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['loan_term']): ?><p align="center" class="err">Loan term must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_term']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_term']; ?>
.</p><?php endif; ?>

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>How much do I have to earn?</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
Not sure how much money you'll have to earn per year to afford your house payment<br>
and accompanying expenses? Simply fill in the boxes below, and we'll tell you.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr><th colspan="2">Your Result</th></tr>
		<tr><td align="right">Required Salary:</td><td><b><?php echo $this->_tpl_vars['summary']['salary']; ?>
</b></td></tr>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>How much do I have to earn?</b></th>
		</tr>
		
		<tr><td align="right">
			Total Home Mortgage Amount:
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

		<tr><td align="right">
			Annual Real Estate Taxes:
		</td><td>
			<input class="calc_input" type="text" name="param[tax]" value="<?php echo $this->_tpl_vars['param']['tax']; ?>
" size="3"> $
		</td><td valign="middle">
			<img id="tax" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Monthly Debt Obligations:
		</td><td>
			<input class="calc_input" type="text" name="param[debt]" value="<?php echo $this->_tpl_vars['param']['debt']; ?>
" size="3"> $
		</td><td valign="middle">
			<img id="debt" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
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
