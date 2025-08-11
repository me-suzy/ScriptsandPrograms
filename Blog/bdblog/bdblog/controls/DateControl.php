<?php
class DateControl
{
	var $dayName;
	var $monthName;
	var $yearName;
	var $day;
	var $month;
	var $year;
	
	function DateControl( $dayName, $monthName, $yearName, $date="" )
	{
		if ( $date=="" )
		{
			$today = getdate();
			$this->day = $today['mday'];
			$this->month = $today['mon'];
			$this->year = $today['year'];
		}
		else 
			list($this->year,$this->month,$this->day) = explode("-",$date);
		
		$this->dayName = $dayName;
		$this->monthName = $monthName;
		$this->yearName = $yearName;
	}
	
	function getString( $iso )
	{
		list($year,$month,$day) = explode('-',$iso);
		return "$day/$month/$year";
	}
	
	function printControl()
	{
	?>
		<select name="<?= $this->dayName ?>">
	<?
		for ( $i=1; $i<32; $i++ )
		{
		?>
			<option value="<?= $i ?>"<? if ($i==$this->day) echo " selected"?>><?= $i ?></option>
		<?
		}
		?>
		</select>
		<select name="<?= $this->monthName ?>">
		<?
		for( $i=1; $i<13; $i++ )
		{
		?>
			<option value="<?= $i ?>"<? if ($i==$this->month) echo " selected" ?>><?= $i ?></option>
		<?
		}
		?>
		</select>
		<select name="<?= $this->yearName ?>">
		<?
		for( $i=2002; $i<2007; $i++ )
		{
		?>
		<option value="<?= $i ?>"<? if ($i==$this->year) echo " selected" ?>><?= $i ?></option>
		<?
		}
		?>
		</select>
		<?
	}
	
	function printValue( $date="" )
	{
		if ( $date=="" )
		{
			$day = $this->day;
			$month = $this->month;
			$year = $this->year;
		}
		else 
			list($year,$month,$day) = explode("-",$date);
			
		echo $day."/".$month."/".$year;
	}
}
?>