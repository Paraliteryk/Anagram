<?php

	session_start();
	
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>
<h1>Anagram</h1>
<div id="gracz">
<?php
echo " Witaj ".$_SESSION['nick'];
echo "<p> Twój ranking: ".$_SESSION['ranking'];
echo "<p> Wygrane: 0";
echo "<p> Przegrane: 0";
echo "<p> Najlepszy wynik: 0 <p>";
?>
<a href="statystyki.php" target="_blank">Zobacz dokładne statystyki</a>
<a href="zmiania.php" >Zmień dane</a>
<a href="index.php" >Wyloguj się</a>
 </div>
<?php
 if(isset($_SESSION['zmieniono']))
	{
		echo $_SESSION['zmieniono'];
		unset($_SESSION['zmieniono']);
	}
?>
</body>
</html>
 
