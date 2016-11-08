<?php

	$arr = [2, 5, 9, 15, 0, 4];

	foreach ($arr as $key => $value) {
		if ($value > 3 && $value < 10) {
			echo $value;
			echo "<br>";
		}
	}