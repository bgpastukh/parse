<?php 

	$string = 442158755745;
	$num = 5;
	$arr = str_split($string);
	$result = 0;

	foreach ($arr as $key => $value) {
		if ($value == $num) {
			$result++;
		}
	}

	echo $result;