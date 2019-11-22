<h3>Jelszó módosítás</h3>
<hr>

<?php
if (isset($_POST['passmod'])) {
	$oldpass = escapeshellcmd($_POST['oldpass']);
	$newpass1 = escapeshellcmd($_POST['newpass1']);
	$newpass2 = escapeshellcmd($_POST['newpass2']);

	if (empty($oldpass) || empty($newpass1) || empty($newpass2)) {
		showError("Nem adtál meg minden adatot!");
	} else {
		if ($newpass1 != $newpass2) {
			showError("A megadott új jelszavak nem egyeznek meg!");
		} else {
			$eredmeny = dbquery("SELECT jelszo FROM felhasznalo WHERE ID=" . $_SESSION['uid'], $db);
			$felh = mysqli_fetch_assoc($eredmeny);
			if ($felh['jelszo'] != MD5($oldpass)) {
				showError("Nem jó a jelenlegi jelszó!");
			} else {
				if (!preg_match('/^[0-9A-Za-z!@#$%]{8,12}$/', $newpass1)) {
					showError("A megadott jelszó nem felel meg a biztonsági kritériumoknak!");
				} else {
					$newpass1 = MD5($newpass1);
					dbquery("UPDATE felhasznalo SET jelszo='$newpass1' WHERE ID=" . $_SESSION['uid'], $db);
					showSucces("A jelszó módosítva!");
				}
			}
		}
	}
}
?>
(A jelszó 8-12 karakter, betű, szám, speciális karaktereket kell tartalmazzon.)
<form method="POST" action="index.php?pg=jelszomod">
	<div class="form-group">
		<label>Jelenlegi jelszó:</label>
		<input type="password" name="oldpass" class="form-control">
	</div>
	<div class="form-group">
		<label>Új jelszó:</label>
		<input type="password" name="newpass1" class="form-control">
	</div>
	<div class="form-group">
		<label>Új jelszó jelszó megerősítése:</label>
		<input type="password" name="newpass2" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" name="passmod" value="Jelszó módosítása" class="btn btn-primary">
	</div>
</form>