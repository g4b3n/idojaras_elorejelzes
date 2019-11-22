<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Daily High Temperature at Different Beaches"
	},
	axisX: {
		valueFormatString: "DD MMM,YY"
	},
	axisY: {
		title: "Temperature (in °C)",
		includeZero: false,
		suffix: " °C"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeries
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Napi maximum hőmérséklet",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			<?php
				$result = dbquery("SELECT * FROM adat ORDER BY datum ASC", $db);
				$adatok = '';
				$i=1;
				while($adat = mysqli_fetch_assoc($result))
				{
					$adatok .= '{ x:('.$adat['datum'].','.$i.'), y: '.$adat['eredmenynappal'].' },';
					$i++;
				}
				$adatok = rtrim($adatok, ',');
				echo $adatok;
			?>
        
        // dataPoints: [
		// 	{ x: new Date(2017,6,24), y: 31 },
		// 	{ x: new Date(2017,6,25), y: 31 },
		// 	{ x: new Date(2017,6,26), y: 29 },
		// 	{ x: new Date(2017,6,27), y: 29 },
		// 	{ x: new Date(2017,6,28), y: 31 },
		// 	{ x: new Date(2017,6,29), y: 30 },
		// 	{ x: new Date(2017,6,30), y: 29 }
		// ]
	},
	{
		name: "Napi minimum hőmérséklet",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			{ x: new Date(2017,6,24), y: 20 },
			{ x: new Date(2017,6,25), y: 20 },
			{ x: new Date(2017,6,26), y: 25 },
			{ x: new Date(2017,6,27), y: 25 },
			{ x: new Date(2017,6,28), y: 25 },
			{ x: new Date(2017,6,29), y: 25 },
			{ x: new Date(2017,6,30), y: 25 }
		]
	}
	]
});

}
