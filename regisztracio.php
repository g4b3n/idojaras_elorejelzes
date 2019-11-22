<h3>Regisztráció</h3>
<hr>
<?php
// rákattintottunk-e a reg gombra?
if (isset($_POST['reg'])) {
	// SQL injection elleni védelem
	$nev = escapeshellcmd($_POST['nev']);
	$email = escapeshellcmd($_POST['email']);
	$jelszo1 = escapeshellcmd($_POST['jelszo1']);
	$jelszo2 = escapeshellcmd($_POST['jelszo2']);

	// megadtunk-e minden adatot?
	if (empty($nev) || empty($email) || empty($jelszo1) || empty($jelszo2)) {
		showError('Hiba! Nem töltötted ki az adatokat!');
	} else {
		$eredmeny = dbquery("SELECT ID FROM felhasznalok WHERE nev='$nev'", $db);
		if (mysqli_num_rows($eredmeny) != 0) {
			showError('Hiba! Ez az felhasználó név már foglalt!');
		} else {
			if ($jelszo1 != $jelszo2) {
				showError('Hiba! A megadott jelszavak nem egyeznek!');
			} else {
				if (!isset($_POST['regfelt'])) {
					showError('Hiba! Nem fogadtad el a regisztrációs feltételeket!');
				} else {
					$jelszo1 = MD5($jelszo1);
					dbquery("INSERT INTO felhasznalo VALUES(null, '$nev', '$jelszo1', '$email', CURRENT_TIMESTAMP, 1)", $db);
					showSuccess("Sikeres regisztráció!");
					$nev = '';
					$email = '';
					$jelszo1 = '';
					$jelszo2 = '';
				}
			}
		}
	}
} else {
	$nev = '';
	$email = '';
	$jelszo1 = '';
	$jelszo2 = '';
}

echo '
	<form method="POST" action="index.php?pg=regisztracio">
		<div class="form-group">
			<label for="nev">Fehasználónév:</label>
			<input type="text" name="nev" class="form-control" value="' . $nev . '">
		</div>
		
		<div class="form-group">
			<label for="email">E-mail cím:</label>
			<input type="email" name="email" class="form-control" value="' . $email . '">
		</div>
		
		<div class="form-group">
			<label for="jelszo1">Jelszó:</label>
			<input type="password" name="jelszo1" class="form-control" value="' . $jelszo1 . '">
		</div>
		
		<div class="form-group">
			<label for="jelszo2">Jelszó megerősítése:</label>
			<input type="password" name="jelszo2" class="form-control" value="' . $jelszo2 . '">
		</div>
		
		<div class="form-group">
			<input type="checkbox" name="regfelt"> A <a href="index.php?pg=regfelt">regisztrációs feltételeket</a> elfogadom!
		</div>

		<div class="form-group">
			<input type="submit" name="reg" value="Regisztráció elküldése" class="btn btn-primary">
		</div>
	</form>';

?>



<!-- vagy HTML szintaktikába ágyazott PHP-vel: 




<form method="POST" action="index.php?pg=regisztracio">
	<div class="form-group">
		<label for="nev">Fehasználónév:</label>
		<input type="text" name="nev" class="form-control" value="<?php echo $nev; ?>">
	</div>
	
	<div class="form-group">
		<label for="email">E-mail cím:</label>
		<input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
	</div>
	
	<div class="form-group">
		<label for="jelszo1">Jelszó:</label>
		<input type="password" name="jelszo1" class="form-control" value="<?php echo $jelszo1; ?>">
	</div>
	
	<div class="form-group">
		<label for="jelszo2">Jelszó megerősítése:</label>
		<input type="password" name="jelszo2" class="form-control" value="<?php echo $jelszo2; ?>">
	</div>
	
	<div class="form-group">
		<input type="submit" name="reg" value="Regisztráció elküldése" class="btn btn-primary">
	</div>
</form>


-->