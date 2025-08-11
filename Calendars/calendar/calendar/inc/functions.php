<?PHP
	function weekday($i) {
		if ($i == 1) return "Monday";
		if ($i == 2) return "Tuesday";
		if ($i == 3) return "Wednesday";
		if ($i == 4) return "Thursday";
		if ($i == 5) return "Friday";
		if ($i == 6) return "Saturday";
		if ($i == 7) return "Sunday";
	}

	function diffTime($start_time, $end_time) {
		if (strpos($start_time, ":") == 1) $start_time = "0" . $start_time;
		if (strpos($end_time, ":") == 1) $end_time = "0" . $end_time;

		$negative = 1;
		if ( (substr($start_time, 0,2) > substr($end_time, 0,2)) || ( (substr($start_time, 0,2) == substr($end_time, 0,2)) && (substr($start_time, 3,2) > substr($end_time, 3,2)) ) ) {
			$temp_time = $start_time;
			$start_time = $end_time;
			$end_time = $temp_time;
			$negative = -1;
		}

		$diffTime[0] = substr($end_time, 0, 2) - substr($start_time, 0, 2);
			$diffTime[1] = substr($end_time, 3, 2) - substr($start_time, 3, 2);

		if ($diffTime[1] < 0) {
			$diffTime[0]--;
			$diffTime[1] = 60 + $diffTime[1];
		}

		$diffTime[0] *= $negative;

		if (strlen($diffTime[0]) == 1) $diffTime[0] = "0" . $diffTime[0];
		if (strlen($diffTime[1]) == 1) $diffTime[1] = "0" . $diffTime[1];

		return $diffTime;
	}

	function diffTimeAbs($start_time, $end_time) {
		if (strpos($start_time, ":") == 1) $start_time = "0" . $start_time;
		if (strpos($end_time, ":") == 1) $end_time = "0" . $end_time;

		$negative = 1;
		if ( (substr($start_time, 0,2) > substr($end_time, 0,2)) || ( (substr($start_time, 0,2) == substr($end_time, 0,2)) && (substr($start_time, 3,2) > substr($end_time, 3,2)) ) ) {
			$temp_time = $start_time;
			$start_time = $end_time;
			$end_time = $temp_time;
			$negative = -1;
		}

		$diffTime[0] = substr($end_time, 0, 2) - substr($start_time, 0, 2);
			$diffTime[1] = substr($end_time, 3, 2) - substr($start_time, 3, 2);

		if ($diffTime[1] < 0) {
			$diffTime[0]--;
			$diffTime[1] = 60 + $diffTime[1];
		}

		$diffTime[0] *= $negative;

		if (strlen($diffTime[0]) == 1) $diffTime[0] = "0" . $diffTime[0];
		if (strlen($diffTime[1]) == 1) $diffTime[1] = "0" . $diffTime[1];

		$diffTimeAbs = $diffTime[0] * 60 + $diffTime[1];

		return $diffTimeAbs;
	}

	function cycle($i) {
		if ($i == 0) return "weekly";
		if ($i == 1) return "in even weeks";
		if ($i == 2) return "in uneven weeks";
	}
?>