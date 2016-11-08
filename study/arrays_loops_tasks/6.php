<?php 
	
	$arr = ["green" => "зеленый", "red" => "красный", "blue" => "голубой"];
	$en = [];
	$ru = [];

	foreach ($arr as $key => $value) {
		array_push($en, $key);
		array_push($ru, $value);
	}

	var_dump($en);
	echo "<br>";
	var_dump($ru);
