<?php

	$arr = ["Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота", "Неділя"];

	foreach ($arr as $key => $value) {
		if ($key == 5 || $key == 6) {
			echo "<b>{$value}</b><br>";
		} else {
			echo "{$value}<br>";
		}
	}