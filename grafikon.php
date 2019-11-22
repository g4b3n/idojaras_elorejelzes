<h3>Grafikon nézet</h3>
<hr>
<div id="chartContainer"></div>

<script>
	window.onload = function() {

		var options = {

			axisX: {
				title: "Dátum",
				valueFormatString: "Dátum"
			},
			axisY: {
				title: "Lépésszám",
				prefix: "",
				suffix: " °C",
				includeZero: false
			},
			data: [{
				yValueFormatString: "#",
				xValueFormatString: "YYYY-MMMM-DD",
				type: "splineArea",
				dataPoints: [
					<?php
					$result = dbquery("SELECT * FROM adat ORDER BY datum ASC", $db);
					$adatok = '';
					$i = 0;
					while ($adat = mysqli_fetch_assoc($result)) {
						$adatok .= '{ x: new Date(' . $adat['datum'] . ',' . $i . '), y: ' . $adat['eredmenynappal'] . ' },';
						$i++;
					}
					$adatok = rtrim($adatok, ',');
					echo $adatok;
					?>
				]
			}]
		};
		$("#chartContainer").CanvasJSChart(options);

	}
</script>