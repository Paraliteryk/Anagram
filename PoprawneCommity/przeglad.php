<?php

session_start();

?>
<!DOCTYPE HTML>
<html lang="pl">
<head >
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Anagram</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>

</head>
<h1>Słownik</h1>


<div id="slownik">
<?php
		$a=1;
		$nick=$_SESSION['nick'];
		require_once "connect.php";
		$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
		mysqli_set_charset($polaczenie, "utf8");
		$rezultat=$polaczenie->query("SELECT * FROM slownikgracza WHERE nick='$nick' ORDER BY slowo");
		while($r = $rezultat->fetch_assoc()) {
			echo $a.". ".mb_strtolower($r['slowo'],"UTF-8")."<br>";
			$a=$a+1;
		}
					
		$polaczenie->close();
 ?>
</div>

<a href="panel.php"  >Wróć na stronę główną</a>

</body>
</html>
