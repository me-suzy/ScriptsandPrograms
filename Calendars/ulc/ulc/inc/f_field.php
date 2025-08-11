<?

function write_options_select($valeur,&$options)
{
	reset($options);

	while(list($val,$opt)=each($options))
	{
		$selected="";
		if($val == $valeur) $selected=" selected";
		echo "<option value=\"$val\"$selected>$opt";
	}
}

?>
