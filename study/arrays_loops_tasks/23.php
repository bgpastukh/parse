<?php

	$num = "123";
	$arr = str_split($num);
	$result = 0;
	
	foreach ($arr as $key => $value) {
		$result += $value;
	}

	echo $result;