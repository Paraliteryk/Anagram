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
<form action="zmien.php" method="post" >

Nowe hasło:<br/> <input type="password" name="haslon1"/> <br/>
Potwierdź nowe hasło:<br/> <input type="password" name="haslon2"/> <br/>
Zmiana maila:<br/> <input type="text" name="mail2"/> <br/><br/>
<input type="submit" value="zmień dane">
</form>
<?php
if(isset($_SESSION['zlehaslon'])) //jezeli istnieje zmienna
	{
		echo'<div class="error">'.$_SESSION['zlehaslon'].'</div>';
		unset($_SESSION['zlehaslon']);
	}
	
	if(isset($_SESSION['zlymail'])) //jezeli istnieje zmienna
	{
		echo'<div class="error">'.$_SESSION['zlymail'].'</div>';
		unset($_SESSION['zlymail']);
	}
?>	
</body>
</html>




