<?php 
	echo "<table>";
	for ($i=1; $i < 10 ; $i++) { 
		echo "<tr>";	
		for ($k=1; $k < 10; $k++) { 
			echo "<td style='border:2px solid #eee; padding: 10px; align: center;'>";	
			echo $i * $k;
			echo "</td>";
		}
		echo "</tr>";	
	}
	echo "</table>";