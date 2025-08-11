<?php
	// Check to see if we a request.
	if($_REQUEST) {
		// If there's data being sent
		if($_REQUEST['arg'] != '') {

			// Strip HTML tags - you should probably apply a little
			// more form security love to this.
			$shout .= strip_tags($_REQUEST['arg'], "<b><u><i><strong><em>")."\n";

			// Format the shout (add date stamp and line return)
			$shout = "<span class=\"date\">".date("[H:i:s]")."</span> ".stripslashes($shout);

			// Empty shouts.txt if filesize is over 15k
			if((filesize("shouts.txt") / 1024) > 15) {
				// write the shout
				if ($fp = fopen('shouts.txt', 'w')) {
					fwrite ($fp, $shout);
				}
			} else { // otherwise don't clear it.
				// write the shout.
				if ($fp = fopen('shouts.txt', 'a')) {
					fwrite ($fp, $shout);
				}
			}
		}

		// open shouts.txt for reading and get its contents.
		$handle = fopen("shouts.txt", "r");
		$contents = fread($handle, filesize("shouts.txt"));
		fclose($handle);

		// dump said contents into an array by lines.
		$contents = explode("\n", $contents);

		// reverse the array to get newest shouts on top.
		rsort($contents);

		// if there are shouts in the shoutbox
		if(is_array($contents)) {
			$res = '';
			// loop through each of them
			foreach($contents as $val) {
				// Add them to the output if they're not empty
				if(!empty($val) && $val != '') {
					$res .= "<p>".$val."</p>";
				}
			}

		} else {
			// generic loading message, in case we can't read
			// from the file (i.e. if it's being written to at
			// the time.
			$res = "loading...";
		}

		// Echo the final output to the div.
		echo "shout_contents|".$res;

	} else {
		// One more little clean-up in case we get invalid
		// data, we can ignore it and show "loading..." until
		// the timer cycles back around and pulls up the actual
		// data.
		echo "shout_contents| loading...";
	}
?>