<?php

	$row = 25;
	$cols = 25;
	$color = ["red", "yellow", "blue", "gray", "maroon", "brown", "green"];

	echo "<table>";

	for ($i=1; $i <= $row ; $i++) { 
		echo "<tr>";
		for ($k=1; $k <= $cols ; $k++) { 
		echo "<td style='background-color:{$color[rand(0, 6)]}'>";
		echo rand();
		echo "</td>";
		}
		echo "</tr>";
	}


	echo "</table>";