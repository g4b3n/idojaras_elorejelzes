<!-- <h3>Menü</h3>
<ul class="menu">
	<li><a href="index.php?pg=ujadat">Új adat megadása</a></li>
	<li><a href="?pg=eredmenyek">Adatok áttekintése</a></li>
	<li><a href="?pg=grafikon">Grafikon 1. nézet</a></li>
	<li><a href="?pg=grafikon">Grafikon 2. nézet</a></li>
</ul> -->

<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li><a href="index.php?pg=ujadat">Új adat megadása</a></li>
			<li><a href="?pg=eredmenyek">Adatok áttekintése</a></li>
			<li><a href="?pg=grafikon">Grafikon 1. nézet</a></li>
			<li><a href="?pg=grafikon2">Grafikon 2. nézet</a></li>
			<?php
			// ha nem vagyunk belépve, akkor reg és belépés
			if (!isset($_SESSION['uid'])) {
				echo '
			<li><a href="index.php?pg=regisztracio">Regisztráció</a></li>
			<li><a href="index.php?pg=belepes">Belépés</a></li>';
			} else {
				// ha be vagyunk lépve, akkor jelszó mód és kilépés
				echo '
			<li><a href="index.php?pg=jelszomod">Jelszómódosítás</a></li>
			<li><a href="index.php?pg=kilepes">Kilépés</a></li>
			';
			}

			?>


		</ul>
	</div>
</nav>
<?php
