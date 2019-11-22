<h3>Eredmények megtekintése</h3>
<hr>
<?php
//$result = dbquery("SELECT * FROM adatok WHERE felhasznaloID=".$_SESSION['uid']." ORDER BY datum ASC", $db);
$result = dbquery("SELECT * FROM adat ORDER BY datum ASC", $db);
$darab = mysqli_num_rows($result);
echo '<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<td class="col-md-1">Dátum</td>
			<td class="col-md-1">Napi maximum</td>
			<td class="col-md-1">Napi minimum</td>
			<td class="col-md-1">Időjárás</td>
		</tr>
	</thead>
	<tbody>';
$osszesen = 0;
while ($adat = mysqli_fetch_assoc($result)) {
	echo '<tr class="table">
			<td class="col-md-1">' . $adat['datum'] . '</td>
			<td class="col-md-1">' . $adat['eredmenynappal'] . '</td>
			<td class="col-md-1">' . $adat['eredmenyejjel'] . '</td>
			<td class="col-md-1">' . $adat['idojaras'] . '</td>
		</tr>';
	$osszesen += $adat['id'];
}
echo '</tbody>
	<tfoot>
		<tr>
			<td>Összesen: ' . szamkiir($darab) . ' rekord</td>
					</tr>
	</tfoot>
	</table>';
?>