<?php

	$arr = [];
	$result = 1;

	for ($i=0; $i <= 10 ; $i++) { 
		$arr[$i] = rand(1, 100);
	}

	foreach ($arr as $key => $value) {
		if ($key % 2) {
					$result *= $value;
				}		
	}

	echo $result."<br>";

	foreach ($arr as $key => $value) {
		if (!($key % 2)) {
					echo $value."<br>";
				}		
	}
