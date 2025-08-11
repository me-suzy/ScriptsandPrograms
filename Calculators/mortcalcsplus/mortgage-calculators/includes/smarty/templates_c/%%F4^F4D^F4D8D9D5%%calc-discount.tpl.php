<?php /* Smarty version 2.6.5-dev, created on 2005-05-12 11:54:19
         compiled from calc-discount.tpl */ ?>
<?php require_once(SMARTY_DIR . 'core' . DIRECTORY_SEPARATOR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'num_decline', 'calc-discount.tpl', 40, false),)), $this); ?>
<?php $this->assign('title', "Mortgage Calculators - Should I pay discount points?"); ?>
<?php $this->assign('description', "Not sure if you should pay discount points on your mortgage loan?"); ?>

<script type="text/javascript"><!--
tips = new Array();
tips['loan_amount']   = "Enter the exact amount of money to be borrowed.";
tips['original_rate'] = "Enter Interest Rate available with no Discount Points.";
tips['discount_rate'] = "Enter Interest Rate available by paying Discount Points.";
tips['loan_term']     = "Enter the number of years over which the loan will be amortized.";
tips['points']        = "Enter the points on the loan, as quoted by the lender.";
//--></script>

<?php if ($this->_tpl_vars['err']['loan_amount']): ?><p align="center" class="err">Mortgage amount must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_amount']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_amount']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['original_rate']): ?><p align="center" class="err">Original Interest Rate must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['discount_rate']): ?><p align="center" class="err">Interest Rate with Discount Points must be in the range from <?php echo $this->_tpl_vars['config']['min_interest_rate']; ?>
 to <?php echo $this->_tpl_vars['config']['max_interest_rate']; ?>
.</p><?php endif; ?>
<?php if ($this->_tpl_vars['err']['loan_term']): ?><p align="center" class="err">Loan term must be in the range from <?php echo $this->_tpl_vars['config']['min_loan_term']; ?>
 to <?php echo $this->_tpl_vars['config']['max_loan_term']; ?>
.</p><?php endif; ?>

<p id="pathway"><img src="images/bullet-path.gif" width="15" height="15" align="absMiddle">&nbsp; &nbsp;<a href="calculators.php">Mortgage calculators</a>&nbsp; /&nbsp; <b>Should I pay discount points?</b></p>

<?php if (! $this->_tpl_vars['summary']): ?>
<table id="texttable" align="center" cellpadding="5"><tr><td align="left">
Not sure if you should pay discount points on your mortgage loan?<br>Fill in the following boxes to find out.
</td></tr></table><br>
<?php endif; ?>

<table align="center" cellpadding="5"><tr><td valign="top">
	<?php if ($this->_tpl_vars['summary']): ?>
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr><th colspan="2">Original Rate</th><th colspan="2">With Discount Points</th></tr>
		<tr>
			<td align="right">Monthly payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['original_payment']; ?>
</td>
			<td align="right">Monthly payment:</td>
			<td><?php echo $this->_tpl_vars['summary']['discount_payment']; ?>
</td>
		</tr>
		<tr>
			<td align="center" colspan="4">Monthly Payment savings: <b><?php echo $this->_tpl_vars['summary']['payment_saved']; ?>
</b></td>
		</tr>
		<tr>
			<td align="center" colspan="4">Recoup time of cost of Discount Points: <b><?php echo $this->_tpl_vars['summary']['recoup_time']; ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['summary']['recoup_time'])) ? $this->_run_mod_handler('num_decline', true, $_tmp, 'month', 'months') : smarty_modifier_num_decline($_tmp, 'month', 'months')); ?>
</b></td>
		</tr>
	</table><br>
	<?php endif; ?>
	<form method="post">
	<table class="calc" cellpadding="5" cellspacing="0" align="center" width="100%">
		<tr>
			<th colspan="3"><b>Should I pay discount points?</b></th>
		</tr>
		
		<tr><td align="right">
			Original Interest Rate:
		</td><td>
			<input class="calc_input" type="text" name="param[original_rate]" value="<?php echo $this->_tpl_vars['param']['original_rate']; ?>
" size="3"> %
		</td><td valign="middle">
			<img id="original_rate" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Interest Rate with Discount Points:
		</td><td>
			<input class="calc_input" type="text" name="param[discount_rate]" value="<?php echo $this->_tpl_vars['param']['discount_rate']; ?>
" size="3"> %
		</td><td valign="middle">
			<img id="discount_rate" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Discount Points:
		</td><td>
			<input class="calc_input" type="text" name="param[points]" value="<?php echo $this->_tpl_vars['param']['points']; ?>
" size="1">
		</td><td>
			<img id="points" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
		</td></tr>

		<tr><td align="right">
			Total Home Mortgage Amount:
		</td><td>
			<input class="calc_input" type="text" name="param[loan_amount]" value="<?php echo $this->_tpl_vars['param']['loan_amount']; ?>
" size="7"> <?php echo $this->_tpl_vars['config']['currency_symb']; ?>

		</td><td>
			<img id="loan_amount" src="images/tip.gif" width="19" height="19" onMouseOver="show_tip(this.id)" onMouseOut="hide_tip()" align="absMiddle">
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
		</td></tr>
	</table>

	<!-- DO NOT REMOVE THE LINE BELOW. SEE THE LICENSE AGREEMENT. THANKS -->
	<div id="powered_by">Powered by <a href="http://www.mortgagecalculatorsplus.com/">Mortgage Calculators Plus</a></div>
	<!-- DO NOT REMOVE THE LINE ABOVE. SEE THE LICENSE AGREEMENT. THANKS -->

</td></tr></table>
</form>
