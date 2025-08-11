<? include("functions.php");
$associate = template(URL_affiliate);
$associate = str_replace("[title_affiliates]", title_affiliates, $associate);
$associate = str_replace("[money_unit]", money_unit, $associate);
$associate = str_replace("[amount_paid]", number_format(amount_paid / 100, 2), $associate);
$associate = str_replace("[cookie_daysto_expire]", cookie_daysto_expire, $associate);
echo $associate; ?>