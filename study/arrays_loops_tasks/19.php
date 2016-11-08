<?php

	$arr = ["Понеділок", "Вівторок", "Середа", "Четвер", "П'ятниця", "Субота", "Неділя"];
	$day = "Середа";

	foreach ($arr as $key => $value) {
		if ($value == $day) {
			echo "<i>{$value}</i><br>";
		} else {
			echo "{$value}<br>";
		}
	}