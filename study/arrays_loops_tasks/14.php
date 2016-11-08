<?php

	$arr = [4, 2, 5, 19, 13, 0, 10];
	$result = false;

	foreach ($arr as $key => $value) {
		if ($value >= 2 && $value <= 4) {
			$result = true;
		}
	}

	($result) ? print "Есть!" : print "Нет!"; 
