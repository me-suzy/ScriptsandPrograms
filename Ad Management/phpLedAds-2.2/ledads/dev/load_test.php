<?php
	require_once('../ad_class.php');
	
	$max = 20;
	for($i = 0; $i < $max; $i++) {
		$key = $pla_class->random_key( );
		echo $pla_class->adcode( $key );
		echo '<br>';
		
		/* random clicks */
		if($i % rand(0, 3)) {
			echo '<b>CLICK!</b><br>';
			$pla_class->update_click( $key );
		}
	}
?>