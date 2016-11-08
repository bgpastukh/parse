<?php

	$arr = [1, 20, 15, 17, 24, 35];
	$result = 0;
	foreach ($arr as $key => $value) {
		$result += $value;		
	}

	echo $result;
	