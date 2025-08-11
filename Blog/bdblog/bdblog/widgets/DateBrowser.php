<?php

class DateBrowser
{
	var $date;	// Current date
	var $month;	// Current month
	var $year;	// Current year
	var $days = array();	// Dates
	var $extra;	// Extra request values
	var $minYear;
	var $maxYear;
	
	function DateBrowser( $extra = '' )
	{
		$today = getdate();
		$this->month = $today['mon'];
		$this->year = $today['year'];
		$this->date = date('Y-m-d');
		$this->extra = $extra;
		$this->minYear = $today['year']-5;
		$this->maxYear = $today['year']+5;
	}
	
	function setMinYear( $year )
	{
		$this->minYear = $year;
	}
	
	function setMaxYear( $year )
	{
		$this->maxYear = $year;
	}
	
	function setDate( $date )
	{
		list( $year, $month, $day ) = explode( '-', $date );
		$this->date = $date;
		$this->year = $year;
		$this->month = $month;
	}
	
	function addDate( $date )
	{
		list( $year, $month, $day ) = explode( '-', $date );
		if ( $year==$this->year && $month==$this->month )
			$this->days[$day-1] = true;
	}
	
	function setMonth( $year, $month )
	{
		$this->year = $year;
		$this->month = $month;
	}
	
	function printWidget()
	{
		global $PHP_SELF;
		$minDate = getdate(mktime( 0, 0, 0, $this->month, 1, $this->year ));
		$maxDate = getdate(mktime( 0, 0, 0, $this->month+1, 0, $this->year ));
		$today = getdate();
		if ( $today['year']==$this->year && $today['mon']==$this->month )
			$today = $today['mday']-1;
		else
			$today = 32;
		
		$minWeekDay = $minDate['wday']-1;
		// Handle sundays
		if ( $minWeekDay==-1 )
			$minWeekDay = 6;
		$day = -$minWeekDay;
		
		$maxDay = $maxDate['mday'];
		
		$prevMonth = getdate(mktime( 0, 0, 0, $this->month-1, 1, $this->year ));
		$nextMonth = getdate(mktime( 0, 0, 0, $this->month+1, 1, $this->year ));
	?>
	<script language="JavaScript">
	<!--
	function DateBrowser_onSelect()
	{
		var monthSelected = document.DateBrowser.month.selectedIndex;
		var yearSelected = document.DateBrowser.year.selectedIndex;
		var month = document.DateBrowser.month[monthSelected].value;
		var year = document.DateBrowser.year[yearSelected].value;
		
		window.location = '<?= $PHP_SELF ?>?year='+year+'&month='+month+'&<?= $extra ?>';
	}
	// -->
	</script>
	<table width="100%">
	<tr>
		<td colspan="7">
		<table>
		<tr>
			<td class="DateBrowser"><a href="<?= $PHP_SELF ?>?year=<?= $prevMonth['year'] ?>&month=<?= $prevMonth['mon'] ?>&<?= $extra ?>">&laquo;</a></td>
			<form name="DateBrowser">
			<td width="100%" align="center">
			<select name="month" onChange="DateBrowser_onSelect()">
			<?php
			for ( $i=1; $i<13; $i++ )
			{
			?>
				<option value="<?= $i ?>"<? if ($this->month==$i ) echo ' selected'?>><?= str_pad( $i, 2, '0', STR_PAD_LEFT ) ?></option>
			<?php
			}
			?>
			</select>
			<select name="year" onChange="DateBrowser_onSelect()">
			<?php
			for ( $i=$this->minYear; $i<=$this->maxYear; $i++ )
			{
			?>
				<option value="<?= $i ?>"<? if ($this->year==$i ) echo ' selected'?>><?= "'".substr( $i, 2 ) ?></option>
			<?php
			}
			?>
			</select>
			</td>
			</form>
			<td class="DateBrowser"><a href="<?= $PHP_SELF ?>?year=<?= $nextMonth['year'] ?>&month=<?= $nextMonth['mon'] ?>&<?= $extra ?>">&raquo;</a></td>
		</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td class="DateBrowserDayTitle">Pt</td>
		<td class="DateBrowserDayTitle">Sa</td>
		<td class="DateBrowserDayTitle">Çr</td>
		<td class="DateBrowserDayTitle">Pr</td>
		<td class="DateBrowserDayTitle">Cu</td>
		<td class="DateBrowserDayTitle">Ct</td>
		<td class="DateBrowserDayTitle">Pz</td>
	</tr>
	<?
	while( $day<$maxDay )
	{
	?>
	<tr>
	<?
		for( $i=0; $i<7; $i++ )
		{
			if ( $day>=0 && $day<$maxDay )
			{
				$dayString = str_pad( $day+1, 2, '0', STR_PAD_LEFT );
				$class = 'DateBrowserNormal';
				
				// Is this day occupied by an event?
				if ( $this->days[$day]===true )
					$class = 'DateBrowserOccupied';
					
				// Is this day today?
				if ( $day==$today )
				{
					$class = 'DateBrowserToday';					
					// And is it ocuupied
					if ( $this->days[$day]===true ) 
						$class = 'DateBrowserTodayOccupied';
				}
			}
			else
				$class='';			
			?>
			<td class="<?= $class ?>">
			<? if ( $this->days[$day] ) { ?><a href="<?= $PHP_SELF ?>?date=<?= $this->year.'-'.$this->month.'-'.$dayString ?>&<?= $extra ?>"><? } ?>
			<? if ( $day>=0 && $day<$maxDay ) echo $dayString ?>
			<? if ( $this->days[$day] ) { ?></a><? } ?>
			</td>
			<?
			$day++;
		}
	?>
	</tr>
	<?
	}
	?>
	</table>
	<?
	}
}
?>