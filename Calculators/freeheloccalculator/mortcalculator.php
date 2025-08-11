<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Sagetips.com Calculator</title>
<style type="text/css">

td {
    font-family: Arial,Helvetica,sans-serif;
    height: 2em;
    font-size: 10pt;
}

td.background {
    padding: 0px;
    background-color: #6666cc;
}

td.header_active {
    padding: 2px 6px 2px 6px;
    color: #ffffcc;
    background-color: #6666cc;
    font-weight: bold;
    font-size: 13pt;
}

td.header_inactive {
    padding: 2px 6px 2px 6px;
    color: #dddddd;
    background-color: #6666cc;
    font-weight: bold;
    font-size: 13pt;
}

td.active {
    padding: 2px 6px 2px 6px;
    color: #333333;
    background-color: #ffffee;
}

td.inactive {
    padding: 2px 6px 2px 6px;
    color: #333333;
    background-color: #eeeeee;
}

td.value_active {
    padding: 2px 6px 2px 6px;
    color: #333333;
    background-color: #ffffee;
    width: 20%;
    text-align: right;
    white-space: nowrap;
}

td.value_inactive {
    padding: 2px 6px 2px 6px;
    color: #333333;
    background-color: #eeeeee;
    width: 20%;
    text-align: right;
    white-space: nowrap;
}

td.error {
    padding: 2px 6px 2px 6px;
    color: #CC0000;
    background-color: #ffffee;
    text-align: center;
}

input.submit {
    width: 7em;
}

</style>
</head>

<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']) ?>">
<table width="80%" cellspacing="0" align="center">
  <tr>
    <td class="background">
      <table width="100%" cellspacing="1">


<?php

// Home Equity Line of Credit Calculator

error_reporting(E_ALL & ~E_NOTICE);

// strip slashes
if (get_magic_quotes_gpc()) {
	clean_array(&$_POST);
	clean_array(&$_SERVER);
}

// trim whitespace on all parameters
trim_array(&$_POST);

// get values passed from form
$step = isset($_POST['step']) ? $_POST['step'] : 0;
$market_value = @$_POST['market_value'];
$balance_owed = @$_POST['balance_owed'];
$ltv = @$_POST['ltv'];
$loan_custom = @$_POST['loan_custom'];
$months = @$_POST['months'];
$rate = @$_POST['rate'];
$pmt = @$_POST['pmt'];
$pmt_custom = @$_POST['pmt_custom'];
$taxrate = @$_POST['taxrate'];
$comprate = @$_POST['comprate'];

if (@$_POST['submit'] == 'Back')
    $step -= 2;

// derived values
if ($step >= 1) {
    $loan_70 = $market_value * .7 - $balance_owed; if ($loan_70 < 0) $loan_70 = '';
    $loan_80 = $market_value * .8 - $balance_owed; if ($loan_80 < 0) $loan_80 = '';
    $loan_90 = $market_value * .9 - $balance_owed; if ($loan_90 < 0) $loan_90 = '';
    $loan_100 = $market_value - $balance_owed; if ($loan_100 < 0) $loan_100 = '';
    $loan_amount = $loan_custom;
    if ($ltv == '70') $loan_amount = $loan_70;
    if ($ltv == '80') $loan_amount = $loan_80;
    if ($ltv == '90') $loan_amount = $loan_90;
    if ($ltv == '100') $loan_amount = $loan_100;
}
if ($step >= 2) {
    $pmt_amort = payment($loan_amount, $rate, $months);
    $pmt_intonly = payment($loan_amount, $rate);
    $pmt_amount = $pmt_custom;
    if ($pmt == 'amort') $pmt_amount = $pmt_amort;
    if ($pmt == 'intonly') $pmt_amount = $pmt_intonly;
}
if ($step >= 3) {
    $total_payments = $pmt_amount * $months;
    $total_interest = $total_payments - $loan_amount;
    $year1_payments = $pmt_amount * 12;
    $prin = $loan_amount;
    for ($i = 0; $i < 12; $i++) {
        $prin -= amortize($prin, $rate, $pmt_amount);
    }
    $year1_interest = $pmt_amount * 12 - ($loan_amount - $prin);
    $tax_savings = $year1_interest * $taxrate / 100;
    $net_payments = $year1_payments - $tax_savings;
    $comp_payments = payment($loan_amount, $comprate, $months) * 12;
    $year1_advantage = $comp_payments - $net_payments;
}

unset($error);

// validate inputs for current step
if ($step == 1) {
    if (!is_numeric($market_value) || $market_value <= 0)
        $error = 'Please enter a valid amount for your home\'s market value.';
    elseif (!is_numeric($balance_owed) || $balance_owed < 0)
        $error = 'Please enter a valid amount for your amount still owed.'; 
    elseif ($market_value < $balance_owed)
        $error = 'You have negative equity.'; 
}
if ($step == 2) {
    if (empty($ltv))
        $error = 'Please select a loan amount or enter a custom loan amount';
    elseif ($ltv == 'custom' && (!is_numeric($loan_custom) || $loan_custom <= 0))
        $error = 'Please enter a valid custom loan amount.';
    elseif (!is_numeric($months) || $months <= 0 || $months != intval($months))
        $error = 'Please enter a whole number of months to repay';
    elseif (!is_numeric($rate) || $rate <= 0)
        $error = 'Please enter a valid percentage (APR)';
}
if ($step == 3) {
    if (empty($pmt))
        $error = 'Please select a payment amount or enter a custom payment amount';
    elseif ($pmt == 'custom' && (!is_numeric($pmt_custom) || $pmt_custom <= 0))
        $error = 'Please enter a valid custom payment abount.';
    elseif (!is_numeric($taxrate) || $taxrate < 0)
        $error = 'Please enter a valid marginal tax rate';
}

// if we have any errors, back the step down
if (isset($error)) 
    $step--;

function clean_array(&$arr) {
	// strip slashes recursively through array
	foreach ($arr as $k => $v) {
		if (is_array($v))
			clean_array($arr[$k]);
		else
			$arr[$k] = stripslashes($v);
	}
}

function trim_array(&$arr) {
	// trim whitespace recursively through array
	foreach ($arr as $k => $v) {
		if (is_array($v))
			trim_array($arr[$k]);
		else
			$arr[$k] = trim($v);
	}
}

function payment($amt, $rate, $term = false) {
    // given loan amount, rate (APR), and term in months,
    // return payment. If term is omitted, interest only
    // payment is returned.

    $i = $rate / 100 / 12;      // periodic rate

    if ($term === false)
        return $amt * $i;       // interest only

    $p1 = $amt * $i; 
    $p2 = 1 + $i; 
    $base = $p2;
    $cnt = 1;
    for ($j = 0 ; $j < $term; $j++) {
        $cnt = $cnt * $p2;
    }
    $p2 = 1 / $cnt;
    $p2 = 1 - $p2; 
    return $p2 ? ($p1 / $p2) : 0; 
}

function amortize($amt, $rate, $pmt) {
    // return principal reduction of $amt given APR $rate
    // and payment amount $pmt
    $i = $rate / 100 / 12;      // periodic rate
    $p1 = $amt * $i;            // interest amount
    return $pmt - $p1;          // principal reduction
}

?>


<?php if ($step < 1) { ?>

        <tr>
          <td class="header_active" colspan="2">Step 1: Determine Your <a title="Heloc" href="http://www.sagetips.com" style="cursor:text;visited:white; text-decoration:none; padding: 2px 6px 2px 6px; color: #ffffcc; background-color: #6666cc; font-weight: bold; font-size: 13pt;>Heloc</a>
		   Loan Amount</td>
        </tr>
        <tr>
          <td class="active">Enter the current market value of your home:</td>
          <td class="value_active"><input name="market_value" size="12" value="<?php echo htmlspecialchars($market_value) ?>"></td>
        </tr>
        <tr>
          <td class="active">Enter the total amount still owed on any mortagages on your home:</td>
          <td class="value_active"><input name="balance_owed" size="12" value="<?php echo htmlspecialchars($balance_owed) ?>"></td>
        </tr>

<?php } else { ?>

        <input type="hidden" name="market_value" value="<?php echo htmlspecialchars($market_value) ?>">
        <input type="hidden" name="balance_owed" value="<?php echo htmlspecialchars($balance_owed) ?>">

        <tr>
          <td class="header_inactive" colspan="2">Step 1: Determine Your Loan Amount</td>
        </tr>
        <tr>
          <td class="inactive">Current market value of your home:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($market_value)) ?></td>
        </tr>
        <tr>
          <td class="inactive">Total amount still owed on any mortagages on your home:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($balance_owed)) ?></td>
        </tr>

<?php if ($step < 2) { ?>

        <tr>
          <td class="header_active" colspan="2">Step 2: Determine Your Monthly Payment</td>
        </tr>
        <tr>
          <td class="active" align="right">
            <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
            <td align="left">Select a loan amount based on Loan-To-Value (LTV) percentage:</td>
            <td align="right">70% LTV</td>
            </table>
          </td>
          <td class="value_active">
            <?php if ($loan_70 == '') { echo '(n/a)'; } else { ?>
            <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
            <td align="left">
            <input type="radio" name="ltv" value="70"<?php if ($ltv == '70') echo ' checked="checked"' ?>></td>
            </td>
            <td align="right">
            <?php echo htmlspecialchars(number_format($loan_70)) ?></td>
            </tr>
            </table>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="active" align="right">80% LTV</td>
          <td class="value_active">
            <?php if ($loan_80 == '') { echo '(n/a)'; } else { ?>
            <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
            <td align="left">
            <input type="radio" name="ltv" value="80"<?php if ($ltv == '80') echo ' checked="checked"' ?>></td>
            </td>
            <td align="right">
            <?php echo htmlspecialchars(number_format($loan_80)) ?></td>
            </tr>
            </table>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="active" align="right">90% LTV</td>
          <td class="value_active">
            <?php if ($loan_90 == '') { echo '(n/a)'; } else { ?>
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="ltv" value="90"<?php if ($ltv == '90') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <?php echo htmlspecialchars(number_format($loan_90)) ?>
                </td>
              </tr>
            </table>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="active" align="right">100% LTV</td>
          <td class="value_active">
            <?php if ($loan_100 == '') { echo '(n/a)'; } else { ?>
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="ltv" value="100"<?php if ($ltv == '100') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <?php echo htmlspecialchars(number_format($loan_100)) ?>
                </td>
              </tr>
            </table>
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="active">Or enter a custom loan amount:</td>
          <td class="value_active">
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="ltv" value="custom"<?php if ($ltv == 'custom') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <input name="loan_custom" size="12" value="<?php echo htmlspecialchars($loan_custom) ?>" onchange="document.forms[0].ltv[4].checked=true">
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="active">Enter the number of months to repay:</td>
          <td class="value_active"><input name="months" size="6" value="<?php echo htmlspecialchars($months) ?>"> months</td>
        </tr>
        <tr>
          <td class="active">Enter the Home Equity Line of Credit rate (APR):</td>
          <td class="value_active"><input name="rate" size="6" value="<?php echo htmlspecialchars($rate) ?>"> %</td>
        </tr>

<?php } else { ?>

        <input type="hidden" name="ltv" value="<?php echo htmlspecialchars($ltv) ?>">
        <input type="hidden" name="loan_custom" value="<?php echo htmlspecialchars($loan_custom) ?>">
        <input type="hidden" name="months" value="<?php echo htmlspecialchars($months) ?>">
        <input type="hidden" name="rate" value="<?php echo htmlspecialchars($rate) ?>">

        <tr>
          <td class="header_inactive" colspan="2">Step 2: Determine Your Monthly Payment</td>
        </tr>
        <tr>
          <td class="inactive">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left">Loan Amount:</td>
                <td align="right"><?php echo $ltv == 'custom' ? 'Custom' : "$ltv% LTV" ?></td>
              </tr>
            </table>
          </td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($loan_amount)) ?></td>
        </tr>
        <tr>
          <td class="inactive">Number of months to repay:</td>
          <td class="value_inactive"><?php echo htmlspecialchars($months) ?> months</td>
        </tr>
        <tr>
          <td class="inactive">Home Equity Line of Credit rate (APR):</td>
          <td class="value_inactive"><?php echo htmlspecialchars($rate) ?> %</td>
        </tr>

<?php if ($step < 3) { ?>

        <tr>
          <td class="header_active">Step 3: Determine Your Potential Tax Benefit</td>
        </tr>
        <tr>
          <td class="active" align="right">
            <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
            <td align="left">Select a monthly payment amount:</td>
            <td align="right">Amortized:</td>
            </table>
          </td>
          <td class="value_active">
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="pmt" value="amort"<?php if ($pmt == 'amort') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <?php echo htmlspecialchars(number_format($pmt_amort, 2)) ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="active" align="right">Interest Only:</td>
          <td class="value_active">
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="pmt" value="intonly"<?php if ($pmt == 'intonly') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <?php echo htmlspecialchars(number_format($pmt_intonly, 2)) ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="active">Or enter a custom payment amount:</td>
          <td class="value_active">
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td align="left">
                  <input type="radio" name="pmt" value="custom"<?php if ($pmt == 'custom') echo ' checked="checked"' ?>></td>
                </td>
                <td align="right">
                  <input name="pmt_custom" size="12" value="<?php echo htmlspecialchars($pmt_custom) ?>" onchange="document.forms[0].pmt[2].checked=true">
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="active">Enter your combined (federal + state) marginal income tax rate:</td>
          <td class="value_active"><input name="taxrate" size="6" value="<?php echo htmlspecialchars($taxrate) ?>"> %</td>
        </tr>
        <tr>
          <td class="active">(optional) Enter APR for personal loan you may be considering:</td>
          <td class="value_active"><input name="comprate" size="6" value="<?php echo htmlspecialchars($comprate) ?>"> %</td>
        </tr>

<?php } else { ?>

        <input type="hidden" name="pmt" value="<?php echo htmlspecialchars($pmt) ?>">
        <input type="hidden" name="pmt_custom" value="<?php echo htmlspecialchars($pmt_custom) ?>">
        <input type="hidden" name="taxrate" value="<?php echo htmlspecialchars($taxrate) ?>">
        <input type="hidden" name="comprate" value="<?php echo htmlspecialchars($comprate) ?>">

        <tr>
          <td class="header_inactive">Step 3: Determine Your Potential Tax Benefit</td>
        </tr>
        <tr>
          <td class="inactive">
            <table width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left">Monthly Payment Amount:</td>
                <td align="right"><?php echo $pmt == 'amort' ? 'Amortized' : ($pmt == 'intonly' ? 'Interest Only' : 'Custom') ?></td>
              </tr>
            </table>
          </td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($pmt_amount, 2)) ?></td>
        </tr>
        <tr>
          <td class="inactive">Your combined (federal + state) marginal tax rate:</td>
          <td class="value_inactive"><?php echo htmlspecialchars($taxrate) ?> %</td>
        </tr>
        <?php if (!empty($comprate)) { ?>
        <tr>
          <td class="inactive">APR for personal loan you may be considering:</td>
          <td class="value_inactive"><?php echo htmlspecialchars($comprate) ?> %</td>
        </tr>
        <?php } ?>
        <?php if ($pmt == 'amort') { ?>
        <tr>
          <td class="inactive">Total Home Equity Line of Credit loan cost:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($total_payments, 2)) ?></td>
        </tr>
        <tr>
          <td class="inactive">Total Home Equity Line of Credit interest:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($total_interest, 2)) ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td class="inactive">First year total payments on Home Equity Line of Credit:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($year1_payments, 2)) ?></td>
        </tr>
        <tr>
          <td class="inactive">First year potential tax savings:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($tax_savings, 2)) ?></td>
        </tr>
        <tr>
          <td class="inactive">First year net payments on Home Equity Line of Credit:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($net_payments, 2)) ?></td>
        </tr>
        <?php if (!empty($comprate)) { ?>
        <tr>
          <td class="inactive">First year total payments on personal loan:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($comp_payments, 2)) ?></td>
        </tr>
        <tr>
          <td class="inactive">First year Home Equity Line of Credit advantage over personal loan:</td>
          <td class="value_inactive"><?php echo htmlspecialchars(number_format($year1_advantage, 2)) ?></td>
        </tr>
        <?php } ?>

<?php } ?>

<?php } ?>

<?php } ?>

<?php if (isset($error)) { ?>
        <tr>
          <td class="error" colspan="2"><?php echo htmlspecialchars($error) ?></td>
        </tr>
<?php } ?>

        <tr>
          <td class="header_active" colspan="2">
            <input type="hidden" name="step" value="<?php echo htmlspecialchars($step + 1) ?>">
<?php if ($step < 3) { ?>
        	<input class="submit" type="submit" name="submit" value="Continue &gt;">
<?php } else { ?>
            <input class="submit" type="button" value="Print" onclick="window.print()">
<?php } ?>
<?php if ($step > 0) { ?>
            <input class="submit" type="submit" name="submit" value="Back">
<?php } ?>
          </td>
        </tr>
      </table>
    </td>
  <tr>
</td>

</table>
</form>
<script type="text/javascript" defer="defer">
//document.forms[0].elements[0].focus();
//try { document.forms[0].elements[0].select() } catch(err) {};
</script>

	
</body>
</html>

