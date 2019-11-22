<h3>Új adat rögzítése</h3>
<hr>

<?php
// űrlap kiértékelése
// rákattintottunk-e a rögzítés gombra?
if (isset($_POST['rogzit'])) {
	$datum = escapeshellcmd($_POST['datum']);
	$eredmenynappal = escapeshellcmd($_POST['eredmenynappal']);
	$eredmenyejjel = escapeshellcmd($_POST['eredmenyejjel']);
	$tipus = escapeshellcmd($_POST['tipus']);
	if (empty($datum) || empty($eredmenynappal) || empty($eredmenyejjel) || empty($tipus)) {
		showError('Nem adtál meg minden adatot!');
	} else {
		$id = $_SESSION['uid'];
		// lekérdezzük, hogy van-e a felhasználónak arra a napra már rögzített adata, amit fel akarunk vinni
		$eredmenyek = dbquery("SELECT * FROM adat WHERE datum='$datum'", $db);
		if (mysqli_num_rows($eredmenyek) == 0) {
			// ha nincs, akkor hozzáadjuk
			dbquery("INSERT INTO adat VALUES( null, '$datum', $eredmenynappal, $eredmenyejjel, '$tipus')", $db);
		} else {
			// ha van, akkor módosítjuk
			dbquery("UPDATE adat SET eredmenynappal = $eredmenynappal,  eredmenyejjel = $eredmenyejjel , idojaras='$tipus' WHERE datum='$datum'", $db);
		}
	}
}
?>
Add meg az alábbi adatokat a napi időjárási értékek rögzítéséhez:
<form method="POST" action="index.php?pg=ujadat">
	<div class="form-group col-xs-2">
		<label>Dátum:</label>
		<input type="date" name="datum" class="form-control">
	</div>
	<div class="form-group col-xs-2">
		<label>Nappali érték:</label>
		<input type="number" name="eredmenynappal" class="form-control">
	</div>
	<div class="form-group col-xs-2">
		<label>Éjszakai érték:</label>
		<input type="number" name="eredmenyejjel" class="form-control">
	</div>
	<div class="form-group col-xs-3">
		<label>Időjárás:</label>
		<select name="tipus" class="form-control">
			<option value="Napos"> Napos </option>
			<option value="Enyhén felhős"> Enyhén felhős </option>
			<option value="Változóan felhős"> Változóan felhős </option>
			<option value="Borult"> Borult </option>
			<option value="Esős"> Esős </option>
			<option value="Zápor, zivatar"> Zápor, zivatar </option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="rogzit" value="Adatok rögzítése" class="btn btn-primary btn-lg">
	</div>
</form>