<!-- <h3>Belépés</h3>
<hr> -->

<?php
// ha még nem létezik a munkamenet változó (nem vagyunk belépve)
if (!isset($_SESSION['uid'])) {
	// rákattintottunk-e a belépés gombra?
	if (isset($_POST['belep'])) {
		// SQL injection elleni védekezés
		$felhasznalonev = escapeshellcmd($_POST['felhasznalonev']);


		$jelszo = escapeshellcmd($_POST['jelszo']);
		// megadtunk-e minden kötelező adatot?
		if (empty($felhasznalonev) || empty($jelszo)) {
			showError('Hiba! Nem adtál meg minden adatot!');
		} else {
			$eredmeny = dbquery("SELECT * FROM felhasznalo WHERE nev='$felhasznalonev'", $db);
			if (mysqli_num_rows($eredmeny) == 0) {
				showError('Hiba! Nincs ilyen nevű felhasználó!');
			} else {
				// Megegyezik-e a megadott jelszó az adatbázisban tárolttal?
				$felhasznalo = mysqli_fetch_assoc($eredmeny);
				if (MD5($jelszo) != $felhasznalo['jelszo']) {
					showError('Hiba! A megadott jelszó hibás!');
				} else {
					// beléphet, létrehozzuk a munkamenet változókat
					$_SESSION['uid'] = $felhasznalo['id'];
					$_SESSION['uname'] = $felhasznalo['nev'];
					// újratöltjük az oldalt
					header("location: index.php");
				}
			}
		}
	}

	echo '
		<h3>Belépés</h3>
<hr>
			<form method="POST" action="index.php">
				<div class="form-group  col-xs-3">
					<label for="felhasznalonev">Felhasználónév:</label>
					<input type="text" name="felhasznalonev" class="form-control">
				</div>
				<div class="form-group  col-xs-3">
					<label for="jelszo">Jelszó:</label>
					<input type="password" name="jelszo" class="form-control">
				</div>
					
				<div class="form-group">
									<input type="submit" name="belep" value="Belépés" class="btn btn-primary btn-xs">
				</div>
			</form>';
} else {
	// ha rákattintottunk a kilépés gombra
	if (isset($_POST['kilep'])) {
		unset($_SESSION['uid']);
		unset($_SESSION['uname']);
		// újratöltjük az oldalt
		header("location: index.php");
	}
	include("menu.php");
	echo '
		<h4>A bejelentkezett felhasznaló:</h4>
		<h4>' . $_SESSION['uname'] . '</h4>
		
		<form method="POST" action="index.php">
			<div class="form-group">
				<input type="submit" name="kilep" value="Kilépés" class="btn btn-primary btn-xs">
			</div>
		</form>';
}

?>