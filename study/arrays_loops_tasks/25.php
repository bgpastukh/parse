<?php

	$arr = [];
	$min = 0;
	$min_key = 0;
	$max = 0;
	$max_key = 0;

	for ($i=0; $i <= 10 ; $i++) { 
		$arr[$i] = rand();
	}
	
	foreach ($arr as $key => $value) {
		if ($value < $min) {
			$min = $value;
			$min_key = $key;
		}
		if ($value > $max) {
			# code...
			$max = $value;
			$max_key = $key;
		}
	}

	$arr[$min_key] = $max;
	$arr[$max_key] = $min;


